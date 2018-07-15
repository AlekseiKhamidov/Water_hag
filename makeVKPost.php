<?php
	require_once 'vendor/autoload.php';
	require_once 'doPDF.php';
	require_once 'config.php';
	// require_once 'addAmoCRMUnsorted.php';
	require_once 'amocrm.php';

	// $data = array( 
	// 	// 'image1' => '/img/79d9f59e_passport1.jpg',
 //  //   	'image2' => '/img/79d9f59e_passport2.png',
 //  //   	'image3' => '/img/79d9f59e_selfie.jpg',
 //    	'pdf' => '/79d9f59e.pdf'
	// );

	// doVKPost($data);


	function doVKPost($files, $json, $guid, $partner, $pipeline = '') {
		

		$vk = new \VK\Client\VKApiClient(); 
		$wall = $vk->wall();

		$attachments = '';

		if (isset($files['image1'])) {

			$info['namePDF'] = doPDF($json, $guid, $files);
			print_r($info);

			# Загружаем фотки в пост
			$photos = $vk->photos();
			$upload_url = getWallUploadURL($photos);

			$uploadedImg = curlUploadFile($upload_url, $files['image3']);
			$savedPhoto = savePhoto($photos, $uploadedImg);
			$attachments .= 'photo'.VK_USER_ID.'_'.$savedPhoto['id'].',';
			if (file_exists($files['image3'])) {
				unlink($files['image3']);
			}

			$uploadedImg = curlUploadFile($upload_url, $files['image1']);
			$savedPhoto = savePhoto($photos,$uploadedImg);
			$attachments .= 'photo'.VK_USER_ID.'_'.$savedPhoto['id'].',';
			if (file_exists($files['image1'])) {
				unlink($files['image1']);
			}

			$uploadedImg = curlUploadFile($upload_url, $files['image2']);
			$savedPhoto = savePhoto($photos,$uploadedImg);
			$attachments .= 'photo'.VK_USER_ID.'_'.$savedPhoto['id'].',';
			if (file_exists($files['image2'])) {
				unlink($files['image2']);
			}
		}

		if (isset($files['doc1'])) {

			doPDF($json, $guid, null);

			$docs = $vk->docs();
			$upload_url = getWallUploadURL($docs);
			
			$uploadedDoc = curlUploadFile($upload_url, $files['doc1'], $type = 'file');
			$savedDoc = saveDoc($docs, $uploadedDoc);
			$attachments .= 'doc-'.VK_AKTIVKREDIT_ID.'_'.$savedDoc['id'].',';
			if (file_exists($files['doc1'])) {
				unlink($files['doc1']);
			}	

			$uploadedDoc = curlUploadFile($upload_url, $files['doc2'], $type = 'file');
			$savedDoc = saveDoc($docs, $uploadedDoc);
			$attachments .= 'doc-'.VK_AKTIVKREDIT_ID.'_'.$savedDoc['id'].',';
			if (file_exists($files['doc2'])) {
				unlink($files['doc2']);
			}	

			$uploadedDoc = curlUploadFile($upload_url, $files['doc3'], $type = 'file');
			$savedDoc = saveDoc($docs, $uploadedDoc);
			$attachments .= 'doc-'.VK_AKTIVKREDIT_ID.'_'.$savedDoc['id'].',';
			if (file_exists($files['doc3'])) {
				unlink($files['doc3']);
			}	
		}

########################################################################################################################################################

		$files['pdf'] = __DIR__.'\\'.$info['namePDF'];
	//$files['pdf'] = __DIR__.'/'.$info['namePDF']; Для хостинга
		print_r($files);

		$docs = $vk->docs();
		$upload_url = getWallUploadURL($docs);
		$uploadedDoc = curlUploadFile($upload_url, $files['pdf'], $type = 'file');
		$savedDoc = saveDoc($docs, $uploadedDoc);
		$attachments .= 'doc-'.VK_AKTIVKREDIT_ID.'_'.$savedDoc['id'].',';
		if (file_exists($files['pdf'])) {
			unlink($files['pdf']);
		}
	
		$tmp = json_decode($json, true);
        $nameKey = array_search('name', array_column($tmp, 'id'));
        $phoneKey = array_search('phone', array_column($tmp, 'id'));
        $termKey = array_search('credit_term', array_column($tmp, 'id'));
        $priceKey = array_search('price', array_column($tmp, 'id'));
        $courseKey = array_search('course', array_column($tmp, 'id'));

		$post = $wall->post(VK_USER_TOKEN, array(
			'owner_id'=>-VK_AKTIVKREDIT_ID, 
			'message'=> 'Партнер: '.$partner.chr(10).
						'Имя: '.$tmp[$nameKey]['a'].chr(10).
						'Продукт: '.$tmp[$courseKey]['a'].chr(10).
						'Стоимость: '.$tmp[$priceKey]['a'].chr(10).
						'Срок кредита: '.$tmp[$termKey]['a'].chr(10).
						'Телефон: '.$tmp[$phoneKey]['a'],						 
			'attachments'=> $attachments))['post_id'];
		
		$postURL = "https://vk.com/aktiv_kredit?w=wall-".VK_AKTIVKREDIT_ID."_".$post."%2Fall";
		postLead($json, $postURL, $partner, $pipeline);



########################################################################################################################################################
	}

	
	function getWallUploadURL($object) {
		return ($object->getWallUploadServer(VK_USER_TOKEN, array('group_id' => VK_AKTIVKREDIT_ID)))['upload_url'];
	};

	function curlUploadFile($url, $filename, $type = 'photo') {
		$img_real_path = $filename;
		$curl_file = curl_file_create($img_real_path, mime_content_type($img_real_path), $filename);
					
		$ch=curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => array($type => $curl_file)
		));
		return json_decode(curl_exec($ch), true);
	};

	function savePhoto($photos, $img) {
		
		$photo = $photos->saveWallPhoto(VK_USER_TOKEN, array(
			'group_id' => VK_AKTIVKREDIT_ID, 
			'photo' => $img['photo'],
			'server' => $img['server'],
			'hash' => $img['hash']
		))[0];

		return $photo;
	};


	function saveDoc($docs, $doc) {
		try {

			$doc = $docs->save(VK_USER_TOKEN, array(
				'file' => $doc['file'], 
				// 'captcha_sid' => 637565283035,
				// 'captcha_key' => 'z57h',
			))[0];
		} catch (VK\Exceptions\Api\VKApiCaptchaException $ex) {
			print_r($ex);
		}


		return $doc;
	};

?>