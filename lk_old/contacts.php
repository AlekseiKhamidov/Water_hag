<?php

	require_once "amoconn.php";
	require_once "config.php";

	
	################################# GET-функции #########################################

	function getContactById($id) {
		$data = array('id' => $id);
		$query = http_build_query($data);		

		$link='https://'.AMO_SUBDOMAIN.'.amocrm.ru/api/v2/contacts?'.$query;
		$Response = processCURL($link);
		return end($Response['_embedded']['items']);	
	};
	

	function getContactPhones($contact) {
		$result = '';
		foreach ($contact['custom_fields'] as $cf) {
			if ($cf['name'] == 'Телефон') {
				foreach ($cf['values'] as $phone) {
					$result = $phone['value'];
					break;
				}
			}
		}
		return $result;
	};
?>