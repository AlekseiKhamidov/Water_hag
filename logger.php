<?php
//	print_r($_POST);
//	print_r($_POST['id']);
//	$id=json_decode()
  if (isset($_POST['data'])) {
	$data = $_POST['data'];
  	//print_r(json_decode($data['client']));
 //  if (isset($_POST['id']) && isset($_POST['fields']) && isset($_POST['stepIndex']) && isset($_POST['date'])) {

   	$text = "date=".$data['date']."\r\nid=".$data['id']."\r\nfields=[".$data['fields']."]\r\nstepIndex=".$data['stepIndex']."\r\nclient=".$data['client']."\r\n";
    if ($data['info']){
      $text = $text."info=".$data['info']."\r\n";
    }
  // 	print_r($_POST['id']);
   	$date = date("Ymd");
   //	print_r($today);
   	$dir =" _logs/$date";
    $id=$data['id'];
   	$file = "log_$id.txt";

   	if (!file_exists($dir)) {
     		 mkdir($dir, 0777, true);
    }


    /*   $dir = __DIR__.$dir;


        $parts = explode('\\', $dir);
        $file = array_pop($parts);
        $dir = '';

        foreach($parts as $part){


            if(!is_dir($dir .= "\\$part"))
            {

            	print_r($dir);
            	mkdir($dir);
			}
		}*/
//        file_put_contents("$dir", $contents);
 // $dir = __DIR__.$dir.'\\'.$file;
 // print_r($dir);

        $fileopen=fopen($dir.'/'.$file, "a+");
		$write="$text\r\n";
		fwrite($fileopen,$write);
		fclose($fileopen);
	}
?>
