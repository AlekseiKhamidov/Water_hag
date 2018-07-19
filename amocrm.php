<?php

    require_once "vendor/autoload.php";
    require_once "config.php";

    function postLead($data, $url, $partner, $pipeline = '') {
    	try {
            // Создание клиента
            $amo = new \AmoCRM\Client(AMO_SUBDOMAIN, AMO_LOGIN, AMO_HASH);

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


      		// Вывод информации об аккаунте
      		// $account = $amo->account;
      		// echo "<pre>";
		    // print_r($account->apiCurrent());
		    // echo "</pre>";

		    $lead = $amo->lead;
		    // $lead->debug(true); // Режим отладки
		    
		    $lead['date_create'] = date(strtotime('now'));
		    
		    if ($pipeline == 'leasing') { 
		    	$lead['status_id'] = AMO_LEASING_NEWSTATUS;	
		    	$lead['name'] = $data[$friendName]['a'].' ('.$partner.')';
		    	if ($manager) {
		     		$lead->addCustomField(AMO_LEADFIELD_MANAGER, $data[$manager]['a']);
		     	}
		    } else {
		    	$lead['status_id'] = AMO_POSCREDIT_NEWSTATUS;	
		    	$lead['name'] = $data[$nameKey]['a'].' ('.$partner.')';
		    }

		    $lead['price'] = $data[$priceKey]['a'];
		    $lead['responsible_user_id'] = AMO_RESPUSER_IVAN;
		    
		    $lead['tags'] = ['aktivkredit.ru', $partner];

		    $lead->addCustomField(AMO_LEADFIELD_PRODUCT, $data[$courseKey]['a']);
            $leadId = $lead->apiAdd();


            // Примечания, которые появятся в сделке после принятия неразобранного
            $note = $amo->note;
            $note['element_type'] = \AmoCRM\Models\Note::TYPE_LEAD; // 1 - contact, 2 - lead
            $note['note_type'] = \AmoCRM\Models\Note::COMMON; // @see https://developers.amocrm.ru/rest_api/notes_type.php
            $note['text'] = $url;
            $note['element_id'] = $leadId;
            $noteId = $note->apiAdd();
	
		    $contact = $amo->contact;
		    if ($pipeline == 'leasing') { 
		     	$contact['name'] = $data[$friendName]['a'];
		     	$contact->addCustomField(AMO_CONTACTFIELD_PHONE, $data[$friendPhone]['a'], 'WORK');
		     	
		    } else {
		    	$contact['name'] = $data[$nameKey]['a'];
		    	$contact->addCustomField(AMO_CONTACTFIELD_PHONE, $data[$phoneKey]['a'], 'WORK');
		    	$contact->addCustomField(AMO_CONTACTFIELD_EMAIL, $data[$emailKey]['a'], 'WORK');
				$contact->addCustomField(AMO_CONTACTFIELD_CITY, $data[$cityKey]['a']);
		    }           
            // Добавление ENUM кастомного поля
                      
            $contactId = $contact->apiAdd();


            $link = $amo->links;
		    $link['from'] = 'leads';
		    $link['from_id'] = $leadId;
		    $link['to'] = 'contacts';
		    $link['to_id'] = $contactId;
		    $link->apiLink();


    	} catch (\AmoCRM\Exception $e) {
            printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }

?>