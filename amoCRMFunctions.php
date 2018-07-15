<?php
  require_once "vendor/autoload.php";
  require_once "config.php";
  require_once "functions.php";

  try {
    $listener = new \AmoCRM\Webhooks\Listener();

    // Добавление обработчика на уведомление contacts->add
    $listener->on('add_contact', function ($domain, $id, $data) {
        // $domain Поддомен amoCRM
        // $id Id объекта связанного с уведомлением
        // $data Поля возвращаемые уведомлением
        $GLOBALS["logger"]->info($domain);
        $GLOBALS["logger"]->debug($data);
    });

    // Вызов обработчика уведомлений
    $listener->listen();

  } catch (\AmoCRM\Exception $e) {
    $logger->error(sprintf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage()));
  }
  

  function getContactsAndCompanies($json = false) {
    set_time_limit(0);  // global setting
    try {
      $amo = new \AmoCRM\Client(
        AMOCRM['subdomain'],
        AMOCRM['login'],
        AMOCRM['hash']
      );
      $account = $amo->account;
      $accInfo = $account->apiCurrent();
      // print_r($accInfo);

      $contact = $amo->contact;
      $allContacts = fetchEntities($contact);
      foreach ($allContacts as $cont) {
        $result[] = getEntityInfo($cont, AMOCRM["contact_CFs"]);
      }

      $company = $amo->company;
      $allCompanies = fetchEntities($company);
      foreach ($allCompanies as $comp) {
        $result[] = getEntityInfo($comp, AMOCRM["company_CFs"]);
      }
    } catch (\AmoCRM\Exception $e) {
          printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }

    return $json ? json_encode($result) : $result;
  }
?>
