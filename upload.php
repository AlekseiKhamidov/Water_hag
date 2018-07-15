<?php
	require_once 'makeVKPost.php';

    header('Access-Control-Allow-Origin: *');


    if (isset($_POST['guid'])) {

    	$files['image1'] = processFile($_FILES['photo_passport'], "_passport1", $_POST['guid']);
    	$files['image2'] = processFile($_FILES['photo_passport_reg'], "_passport2", $_POST['guid']);
    	$files['image3'] = processFile($_FILES['photo_selfi'], "_selfie", $_POST['guid']);
    	
    	print_r($files);

	    if (isset($_POST['data'])) {
	    	if (isset($_POST['partner'])) {
	    		doVKPost($files, $_POST['data'], $_POST['guid'], $_POST['partner']);
		    }
		}
	}


	function processFile($file, $postfix, $guid) {
		print_r($file);

		if ( 0 < $file['error'] ) {
	        echo 'Error: ' . $file['error'] . '<br>';
	        return null;
	    } else {
	    	$ext = substr($file['name'], strripos($file['name'], '.'));
			$newFilename = __DIR__.'\\'.$guid .$postfix.$ext;
			//$newFilename = __DIR__.'/'.$guid .$postfix.$ext;
	    	move_uploaded_file($file['tmp_name'], $newFilename);
	        return $newFilename;
	    }
	};
?>