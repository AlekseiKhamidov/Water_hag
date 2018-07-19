<?php
	require_once 'VKFunctions.php';
	require_once 'doPDF.php';
	require_once 'amoCRMFunctions.php';

  header('Access-Control-Allow-Origin: *');

  if (isset($_POST['guid'])) {
  	$files['file1'] = processFile($_FILES['file1'], "_file1", $_POST['guid']);
  	$files['file2'] = processFile($_FILES['file2'], "_file2", $_POST['guid']);
  	$files['file3'] = processFile($_FILES['file3'], "_file3", $_POST['guid']);

    if (isset($_POST['data'])) {
    	if (isset($_POST['partner'])) {
				if (isset($_POST['pipeline']) && $_POST['pipeline'] == "pos-credit") {
					$files[] = doPDF($_POST['data'], $_POST['guid'], $files);
				}
				$attachments = createAttachements($files);
				$message = parseDataForMessage($_POST['data'],
																			$_POST['partner'] && is_numeric($_POST['partner']) ?
																			AMOCRM["lead_CFs"]["partners_list"][$_POST['partner']]
																			: $_POST['partner']);
				$post = postToGroupWall($message, $attachments);
				$VKPostURL = "https://vk.com/aktiv_kredit?w=wall-".VK["group_id"]."_".$post."%2Fall";
			//	sendMessageToChat($message.chr(10).$VKPostURL);
				moveFilesToDocs($files);

				postLead($_POST['data'], $VKPostURL, $_POST['partner'], $_POST['pipeline']);
	    }
		}
	}
?>
