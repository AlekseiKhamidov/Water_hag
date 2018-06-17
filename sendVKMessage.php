<?php
	require_once 'vendor/autoload.php';
	require_once 'config.php';

	$vk = new \VK\Client\VKApiClient();
	$wall = $vk->wall();

	$attachments = '';

	# Загружаем фотки в пост
	$photos = $vk->photos();
	$upload_url = getWallUploadURL($photos);

	$uploadedImg = curlUploadFile($upload_url, '/img/Uspeh.jpg');
	$savedPhoto = savePhoto($photos, $uploadedImg);
	$attachments .= 'photo'.VK_USER_ID.'_'.$savedPhoto['id'].',';

	$uploadedImg = curlUploadFile($upload_url, '/img/million.jpg');
	$savedPhoto = savePhoto($photos,$uploadedImg);
	$attachments .= 'photo'.VK_USER_ID.'_'.$savedPhoto['id'].',';

########################################################################################################################################################

	$docs = $vk->docs();
	$upload_url = getWallUploadURL($docs);
	$uploadedDoc = curlUploadFile($upload_url, '/docs/ex.pdf', $type = 'file');
	$savedDoc = saveDoc($docs, $uploadedDoc);
	$attachments .= 'doc-'.VK_AKTIVKREDIT_ID.'_'.$savedDoc['id'].',';


	$wall->post(VK_USER_TOKEN, array('owner_id'=>-VK_AKTIVKREDIT_ID, 'message'=>'ПЕРДЫХХ!!', 'attachments'=> $attachments));
	$docs->delete(VK_USER_TOKEN, array('owner_id'=>-VK_AKTIVKREDIT_ID, 'doc_id'=>$savedDoc['id'] ));

########################################################################################################################################################

	

?>
