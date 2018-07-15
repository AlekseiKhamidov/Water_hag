<?php
	require_once 'VKFunctions.php';
	require_once 'doPDF.php';

  header('Access-Control-Allow-Origin: *');

  if (isset($_POST['guid'])) {
  	$files['image1'] = processFile($_FILES['photo_passport'], "_passport1", $_POST['guid']);
  	$files['image2'] = processFile($_FILES['photo_passport_reg'], "_passport2", $_POST['guid']);
  	$files['image3'] = processFile($_FILES['photo_selfi'], "_selfie", $_POST['guid']);


    if (isset($_POST['data'])) {
    	if (isset($_POST['partner'])) {
				print_r($_POST['partner']);
				$files[] = doPDF($_POST['data'], $_POST['guid'], $files);
				$attachments = createAttachements($files);
				$message = parseDataForMessage($_POST['data'], $_POST['partner']);
				$post = postToGroupWall($message, $attachments);
				$postURL = "https://vk.com/aktiv_kredit?w=wall-".VK["group_id"]."_".$post."%2Fall";
				sendMessageToChat($message.chr(10).$postURL);
				moveFilesToDocs($files);

				// postLead($json, $postURL, $partner, $pipeline);
	    }
		}
	}


	function processFile($file, $postfix, $guid) {
		if ( 0 < $file['error'] ) {
	        echo 'Error: ' . $file['error'] . '<br>';
	        return null;
	    } else {
	    	$ext = substr($file['name'], strripos($file['name'], '.'));
				// $newFilename = __DIR__.'\\'.$guid .$postfix.$ext;
				// $newFilename = __DIR__.'/'.$guid .$postfix.$ext;
				$newFilename = $guid.$postfix.$ext;
	    	move_uploaded_file($file['tmp_name'], $newFilename);
	      return $newFilename;
	    }
	};
?>
