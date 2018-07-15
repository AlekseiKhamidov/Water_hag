<?php

	require_once "config.php";
	require_once "curl.php";
	
	auth();

	// echo "<pre>";
	// print_r(getLeadCustomFieldEnums(AMO_CFID_PARTNER));
	// echo "</pre>";
	
	function makeStatusesJSON() {
		$pipelines = getPipelines();
		$data = array();
		foreach ($pipelines as $pipeline) {
			//print_r($pipeline);
				$data[$pipeline['sort']]["name"] = $pipeline['name'];
				$data[$pipeline['sort']]["is_main"] = $pipeline['is_main'];
			foreach ($pipeline['statuses'] as $status) {

				$data[$pipeline['sort']]['status'][] = $pipeline['name'].'^'.$status['name'].'^'.$status['color'];
			}
		}

		//$data = array('data' => $data);
		return json_encode($data);
	};


	function getPipelines(){
		#Формируем ссылку для запроса
		$link='https://'.AMO_SUBDOMAIN.'.amocrm.ru/api/v2/pipelines';
		$Response = processCURL($link);
		return $Response['_embedded']['items'];
	};

	function getCustomFieldsInfo() {
		$link='https://'.AMO_SUBDOMAIN.'.amocrm.ru/api/v2/account?with=custom_fields';
		$Response = processCURL($link);
		return $Response;
	};


	// Получение массива значений из дополнительного поля типа "список"
	function getLeadCustomFieldEnums($customFieldId) {
		$CFInfo = getCustomFieldsInfo();
		$custom_fields = $CFInfo['_embedded']['custom_fields']['leads'];

		foreach ($custom_fields as $value) {
			if ($value['id'] == $customFieldId) {	
				return $value['enums'];
			}
		}	
	};
	
	############################### Авторизация #########################################

	function auth() {
		#Массив с параметрами, которые нужно передать методом POST к API системы
		$post=array(
		  'USER_LOGIN'=>AMO_LOGIN, 
		  'USER_HASH'=>AMO_HASH 
		);
		 
		#Формируем ссылку для запроса
		$link='https://'.AMO_SUBDOMAIN.'.amocrm.ru/private/api/auth.php?type=json';

		$Response = processCURL($link, $post);

		if(isset($Response['response']['auth'])) #Флаг авторизации доступен в свойстве "auth"
		  return 'Авторизация прошла успешно';
		return 'Авторизация не удалась';
	};

	
?>