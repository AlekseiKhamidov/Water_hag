<?php
	require_once 'makeVKPost.php';

    header('Access-Control-Allow-Origin: *');


    if (isset($_POST['guid'])) {

    	$files['doc1'] = processFile($_FILES['doc1'], "_doc1", $_POST['guid']);
    	$files['doc2'] = processFile($_FILES['doc2'], "_doc2", $_POST['guid']);
    	$files['doc3'] = processFile($_FILES['doc3'], "_doc3", $_POST['guid']);
    	
    	print_r($files);

	    if (isset($_POST['data'])) {
	    	if (isset($_POST['partner'])) {
	    		doVKPost($files, $_POST['data'], $_POST['guid'], $_POST['partner'], 'leasing');
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