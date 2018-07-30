<?php
  require_once "vendor/autoload.php";
  require_once "config.php";

  // use Monolog\Logger;
  // use Monolog\Handler\PhpConsoleHandler;
  // use Monolog\Handler\StreamHandler;
  //
  //
  // // Create the logger
  // $logger = new Logger('my_logger');
  // // Now add some handlers
  // $logger->pushHandler(new PHPConsoleHandler());
  // $stream = new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG);
  // // $logger->pushHandler($stream);
  //

  try {
  //   $listener = new \AmoCRM\Webhooks\Listener();
  //
  //   // Добавление обработчика на уведомление contacts->add
  //   $listener->on('add_contact', function ($domain, $id, $data) {
  //       // $domain Поддомен amoCRM
  //       // $id Id объекта связанного с уведомлением
  //       // $data Поля возвращаемые уведомлением
  //       $GLOBALS["logger"]->info("Add Contact", [print_r($data, true)]);
  //   });
  //
  //   $listener->on('add_lead', function ($domain, $id, $data) {
  //       // $domain Поддомен amoCRM
  //       // $id Id объекта связанного с уведомлением
  //       // $data Поля возвращаемые уведомлением
  //       $GLOBALS["logger"]->info("Add Lead", [print_r($data, true)]);
  //   });
  //
  //   $listener->on('update_lead', function ($domain, $id, $data) {
  //       // $domain Поддомен amoCRM
  //       // $id Id объекта связанного с уведомлением
  //       // $data Поля возвращаемые уведомлением
  //       $GLOBALS["logger"]->info("Update Lead", [print_r($data, true)]);
  //   });
  //
  //   $listener->on('update_contact', function ($domain, $id, $data) {
  //       // $domain Поддомен amoCRM
  //       // $id Id объекта связанного с уведомлением
  //       // $data Поля возвращаемые уведомлением
  //       $GLOBALS["logger"]->info("Update Contact", [print_r($data, true)]);
  //   });
  //
  //   $listener->on('note_lead', function ($domain, $id, $data) {
  //       // $domain Поддомен amoCRM
  //       // $id Id объекта связанного с уведомлением
  //       // $data Поля возвращаемые уведомлением
  //       $GLOBALS["logger"]->info("Note Lead", [print_r($data, true)]);
  //   });
  //
  //   $listener->on('delete_contact', function ($domain, $id, $data) {
  //       // $domain Поддомен amoCRM
  //       // $id Id объекта связанного с уведомлением
  //       // $data Поля возвращаемые уведомлением
  //       $GLOBALS["logger"]->info("Delete Contact", [print_r($data, true)]);
  //   });
  //
  //   $listener->on('delete_lead', function ($domain, $id, $data) {
  //       // $domain Поддомен amoCRM
  //       // $id Id объекта связанного с уведомлением
  //       // $data Поля возвращаемые уведомлением
  //       $GLOBALS["logger"]->info("Delete Lead", [print_r($data, true)]);
  //   });
  //
  //   // Вызов обработчика уведомлений
  //   $listener->listen();

    $amo = new \AmoCRM\Client(
      AMOCRM['subdomain'],
      AMOCRM['login'],
      AMOCRM['hash']
    );

  } catch (\AmoCRM\Exception $e) {
    $logger->error(sprintf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage()));
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
      // $lead['date_create'] = time();

      $partnerName = $partner && is_numeric($partner) ?
                      AMOCRM["lead_CFs"]["partners_list"][$partner]
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
        $contact->addCustomField(AMOCRM["contact_CFs"]["email"], $data[$emailKey]['a'],"WORK");
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
          // $result[$field["name"]] = '';
          foreach ($field["values"] as $key => $value) {
              $result[$field["name"]." #".($key + 1)] = $value["value"];
          }
        }
      }
    }
    return $result;
  }

?>
