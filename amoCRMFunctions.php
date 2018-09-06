<?php
  require_once "vendor/autoload.php";
  require_once "config.php";
  require_once "mysql.php";

  try {
    $amo = new \AmoCRM\Client(
      AMOCRM['subdomain'],
      AMOCRM['login'],
      AMOCRM['hash']
    );

    $listener = new \AmoCRM\Webhooks\Listener();
    $listener->on(['add_lead', 'update_lead', 'note_lead'], function ($domain, $id, $data) {
        // $domain Поддомен amoCRM
        // $id Id объекта связанного с уведомлением
        // $data Поля возвращаемые уведомлением
        insertLead(getLeadFullInfo($id));
    });

    $listener->on('delete_lead', function ($domain, $id, $data) {
        // $domain Поддомен amoCRM
        // $id Id объекта связанного с уведомлением
        // $data Поля возвращаемые уведомлением
        deleteLead($id);
    });

    // Вызов обработчика уведомлений
    $listener->listen();

  } catch (\AmoCRM\Exception $e) {
    $logger->error(sprintf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage()));
  }

  function getLeadFullInfo($id) {
    // "Потребительский кредит^Отказ^#D5D8DB"
    $pipelines = $GLOBALS["amo"]->pipelines->apiList();
    $lead = $GLOBALS["amo"]->lead;
    $leadObj = fetchEntity($lead, ["id" => $id]);
  //  print_r($leadObj);
    $leadInfo = getEntityInfo($leadObj, AMOCRM["lead_CFs"]);
    $leadInfo["Бюджет"] = $leadObj["price"];
  //  $leadInfo["Дата создания"] = $leadObj["date_create"] > 1483228800 ? $leadObj["date_create"] : $leadObj["last_modified"]; // Дата должна быть больше 01.01.2017
    $leadInfo["Дата создания"] = ($leadObj["date_create"] > 1483228800 && $leadObj["date_create"]<= time()) ? $leadObj["date_create"] : $leadObj["last_modified"]; // Дата должна быть больше 01.01.2017 и меньше текущего дня
    $pipeline = $pipelines[$leadObj["pipeline_id"]];
    $status = $pipeline["statuses"][$leadObj["status_id"]];
    $loss_reason_id = (strpos($status["name"], 'Отказ') !== false)?($leadObj["loss_reason_id"] ? "^".AMOCRM["loss_reasons"][$leadObj["loss_reason_id"]] :""): "";
    //$leadInfo["Статус"] = $pipeline["name"]."^".$status["name"]."^".$status["sort"]."^".$status["color"].($leadObj["loss_reason_id"] ? "^".AMOCRM["loss_reasons"][$leadObj["loss_reason_id"]] :"");
    $leadInfo["Статус"] = $pipeline["name"]."^".$status["name"]."^".$status["sort"]."^".$status["color"].$loss_reason_id;
    $contact = $GLOBALS["amo"]->contact;
    if ($leadObj["main_contact_id"] == ""){
    //  $leadInfo["Имя контакта"] = isset($leadObj["name"])?$leadObj["name"]:"";
      $leadInfo["Имя контакта"] = "";
      $leadInfo["Телефон"] = "";
      $leadInfo["Город"] = "";
    }
    else {
      $contactObj = fetchEntity($contact, ["id" => $leadObj["main_contact_id"]]);
      $contactInfo = getEntityInfo($contactObj, AMOCRM["contact_CFs"]);
      $leadInfo["Имя контакта"] = $contactInfo["Наименование"];
      $leadInfo["Телефон"] = isset($contactInfo["Телефон"]) ? $contactInfo["Телефон"] : "";
      $leadInfo["Город"] = isset($contactInfo["Город"]) ? $contactInfo["Город"] : "";
    }
    $leadInfo["РОП"] = isset($leadInfo["РОП"]) ? $leadInfo["РОП"] : "";
    $leadInfo["Менеджер"] = isset($leadInfo["Менеджер"]) ? $leadInfo["Менеджер"] : "";
    $note = $GLOBALS["amo"]->note;
    $noteObj = fetchEntity($note, [
      "note_type" => 4,
      "type" => "lead",
      "element_id" => $id
    ]);
    $leadInfo["Текст"] = stristr($noteObj["text"], "vk.com") === false ? $noteObj["text"] : "";
    $leadInfo["Дата изменения"]  = $noteObj["last_modified"];

    return $leadInfo;
  }
  function getAllLeads() {
      $lead = $GLOBALS["amo"]->lead;
      return fetchEntities($lead);
  }
  function postLead($data, $VKPostURL, $partner, $pipeline = '') {
    try {
      $data = json_decode($data, true);
      $nameKey = array_search('name', array_column($data, 'id'));
      $phoneKey = array_search('phone', array_column($data, 'id'));
      $emailKey = array_search('email', array_column($data, 'id'));
      $courseKey = array_search('course', array_column($data, 'id'));
      $priceKey = array_search('price', array_column($data, 'id'));
      $cityKey = array_search('city', array_column($data, 'id'));
      $friendName = array_search('friend_name1', array_column($data, 'id'));
      $friendPhone = array_search('friend_phone1', array_column($data, 'id'));
      $manager = array_search('manager', array_column($data, 'id'));
      $lead = $GLOBALS["amo"]->lead;
      //$lead['date_create'] = time();
      $partnerName = $partner && is_numeric($partner) ?
                      AMOCRM["partners_list"][$partner]
                      : "";
      $lead['status_id'] = $pipeline ?
                      AMOCRM["pipelines"][$pipeline]["statuses"]["new"]
                      : AMOCRM["pipelines"]["pos-credit"]["statuses"]["new"];
      $lead['name'] = $nameKey !== false ?
                      $data[$nameKey]['a'].' ('.($partnerName ? $partnerName : $partner).')'
                      : "Имя не найдено";
      $lead['price'] = $priceKey !== false ?
                      $data[$priceKey]['a']
                      : 0;
      $lead['responsible_user_id'] = AMOCRM["users"]["РОП"];
      $lead['tags'] = ['aktivkredit.ru', $partnerName ? $partnerName : $partner];
      if ($manager !== false) {
        $lead->addCustomField(AMOCRM["lead_CFs"]["manager"], $data[$manager]['a']);
      }
      if ($partner) {
        $lead->addCustomField(AMOCRM["lead_CFs"]["partner"], $partner);
      }
      $leadId = $lead->apiAdd();
      // Примечания, которые появятся в сделке после принятия неразобранного
      $note = $GLOBALS["amo"]->note;
      $note['element_type'] = \AmoCRM\Models\Note::TYPE_LEAD; // 1 - contact, 2 - lead
      $note['note_type'] = \AmoCRM\Models\Note::COMMON; // @see https://developers.amocrm.ru/rest_api/notes_type.php
      $note['text'] = $VKPostURL;
      $note['element_id'] = $leadId;
      $noteId = $note->apiAdd();
      $contact = $GLOBALS["amo"]->contact;
      $contact['name'] = $nameKey !== false ?
                        $data[$nameKey]['a']
                        : "Имя не найдено";
      if ($phoneKey !== false) {
        $contact->addCustomField(AMOCRM["contact_CFs"]["phone"], $data[$phoneKey]['a'], "WORK");
      }
      if ($emailKey !== false) {
        $contact->addCustomField(AMOCRM["contact_CFs"]["email"], $data[$emailKey]['a'], "WORK");
      }
      if ($cityKey !== false) {
        $contact->addCustomField(AMOCRM["contact_CFs"]["city"], $data[$cityKey]['a']);
      }
      $contactId = $contact->apiAdd();
      $link = $GLOBALS["amo"]->links;
      $link['from'] = 'leads';
      $link['from_id'] = $leadId;
      $link['to'] = 'contacts';
      $link['to_id'] = $contactId;
      $link->apiLink();
    } catch (\AmoCRM\Exception $e) {
      printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
  }
  function getContactsAndCompanies($json = false) {
    try {
      $contact = $GLOBALS["amo"]->contact;
      $allContacts = fetchEntities($contact);
      foreach ($allContacts as $cont) {
        $result[] = getEntityInfo($cont, AMOCRM["contact_CFs"]);
      }
      $company = $GLOBALS["amo"]->company;
      $allCompanies = fetchEntities($company);
      foreach ($allCompanies as $comp) {
        $result[] = getEntityInfo($comp, AMOCRM["company_CFs"]);
      }
    } catch (\AmoCRM\Exception $e) {
      printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
    return $json ? json_encode($result) : $result;
  }
  function fetchEntity($entity, $params = []) {
    try {
      $result = $entity->apiList($params);
    } catch (\AmoCRM\Exception $e) {
      printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
    return end($result);
  }
  function fetchEntities($entity, $params = []) {
    $i = 0;
    $entityList = array();
    try {
      do {
          $rows_params = [
            'limit_rows' => 500,
            'limit_offset' => 500 * $i++
          ];
          $fetchedEntities = $entity->apiList(array_merge($rows_params, $params));
          $entityList = array_merge($entityList, $fetchedEntities);
          usleep(600);
      } while ($fetchedEntities);
    } catch (\AmoCRM\Exception $e) {
      printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
    return $entityList;
  }
  function getEntityInfo($entity, $fields = []) {
    $result['id'] = $entity['id'];
    $result['Наименование'] = $entity["name"];
    if (isset($entity['custom_fields']) && $entity['custom_fields'] && $fields) {
      foreach ($fields as $id) {
        $CFs = $entity['custom_fields'];
        $key = array_search($id, array_column($CFs, 'id'));
        if ($key !== false) {
          $field = $CFs[$key];
          $result[$field["name"]] = $field["values"][0]["value"];
          if (isset($field["values"][0]["enum"])) {
            $result[$field["name"]] .= "^".$field["values"][0]["enum"];
          }
          // foreach ($field["values"] as $key => $value) {
          //     $result[$field["name"]." #".($key + 1)] = $value["value"];
          // }
        }
      }
    }
    return $result;
  }
?>
