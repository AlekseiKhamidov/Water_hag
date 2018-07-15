<?php
  	require_once 'pdf.php';
    require_once 'translit.php';

  	
  	function doPDF($json, $guid, $pictures) {
  		
  		$pdf = PDF_Create();
  		
  		$data = json_decode($json, true);
  		
  		$key = array_search('name', array_column($data, 'id'));

  		PDF_AddHeader($pdf, $data[$key]['a']);
 		
  		foreach ($data as $value) {
  			PDF_AddLine($pdf, $value['q'].":");	
  			PDF_AddLine($pdf, $value['a'], true);
  			PDF_AddParagraph($pdf, 5);
  		}		
		
		if ($pictures) PDF_AddPictures($pdf, $pictures);
		
    $namePDF = $guid.'_'.$data[$key]['a'];
    $namePDF = translit($namePDF);

		PDF_Save($pdf, $namePDF);


    return $namePDF.'.pdf';
		
  }

  

?>