<?php
	require_once 'tfpdf/tfpdf.php';
    

    # Конфигурация для удобной работы


	function PDF_Create() {
		$pdf = new tFPDF( 'P', 'mm', 'A4' );
		$pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
		$pdf->AddFont('DejaVu-Bold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVu','',9);
		$pdf->SetTextColor(0, 0, 0); // RGB
	    $pdf->AddPage();

	    return $pdf;
	};

	function PDF_AddLine($pdf, $text, $font = 'DejaVu', $bold = false, $fontWeight = '9') {
		//$text = iconv('utf-8', 'windows-1251', $text);
		if (!$bold) {
		 	$pdf->SetFont( 'DejaVu', '', 9 );
		} else {
			$pdf->SetFont( 'DejaVu-Bold', '', 9 );
		}

	    $pdf->Write( 6, $text." ");
	};

	function PDF_AddParagraph($pdf, $paragraphHeight = 10) {
		$pdf->Ln($paragraphHeight);
	};

	function PDF_AddHeader($pdf, $header) {
		$pdf->SetFont( 'DejaVu', '', 16 );
		$pdf->Cell( 0, 15, $header, 0, 1, 'C' ); // w = 0 (на всю длину), h = 16 (высота), текст, 0 - нет границ, 1 - курсор в начале новой строки, 'C' - выравнивание по центру
	};

	function PDF_AddPictures($pdf, $pictures) {
		$pdf->AddPage();
		$photoH = 85;
		$i = 0;
		foreach ($pictures as $picture) {
		//	print_r($picture);
			if (file_exists($picture)) {
				$pdf->Image($picture, 20, 20 + $photoH * $i++, 0, $photoH);  
			}
		}
	};
	

	function PDF_Save($pdf, $name, $typeOfOutput = 'F') {
		/***
	      Выводим PDF
	        I : Выводить PDF на экран, если такая функция поддерживается браузером, иначе загружать.
	        D : Загружать PDF.
	        F : Сохранять файл в папке на сервере.
	        S : Возвращать данные PDF как строку.
	    ***/
	    PDF_Delete($name);
		$pdf->Output( "$name.pdf", $typeOfOutput);
	};

	function PDF_Delete($name) {
		$filename = "$name.pdf";
		if (file_exists($filename)) {
			unlink($filename);
		}
	};

?>