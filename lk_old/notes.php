<?php

	require_once "amoconn.php";
	require_once "config.php";
	require_once "functions.php";


	// print_r(getLastLeadNote(3111895));


	################################# GET-функции #########################################

	function getLeadNotes($leadId, $type='lead', $noteType = 4) {
		#Формируем ссылку для запроса
		$link="https://".AMO_SUBDOMAIN.".amocrm.ru/api/v2/notes?type=$type&element_id=$leadId&note_type=$noteType";
		$Response = processCURL($link);
		return $Response['_embedded']['items'];
	};

	function getLastLeadNote($leadId) {
		$notes = getLeadNotes($leadId);
		return $notes ? (isset(end($notes)['text']) ? date('d.m.Y H:i:s', end($notes)['created_at']).': '.cleanText(end($notes)['text']) : "Нет примечаний") : 'Нет примечаний';	
	}

	
?>