<?php
	
	
	function cleanText($str) {
		$str = preg_replace("|[\n]+|", " ", $str); // убрать переводы строк
		$str = preg_replace("|[\s]+|", " ", $str); // убрать лишние пробелы
		$str = str_replace("'", '', $str);
		return $str;
	};
	
?>