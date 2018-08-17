<?php
  require_once "vendor/autoload.php";

  function translit($s) {
    $s = (string) $s; // преобразуем в строковое значение
    $s = strip_tags($s); // убираем HTML-теги
    $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
    $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
  }

  function moveFilesToDocs($files) {
    $date = date('Ymd');

    if (!file_exists("_docs/$date")) {
      mkdir("_docs/$date", 0777, true);
    }
    foreach ($files as $filename) {
      if (!file_exists("_docs/$date/$filename")){
        print_r($filename);
        rename($filename, "_docs/$date/$filename");
      }
      $newFiles[] = "_docs/$date/$filename";

    }
    return $newFiles;
  }

  function parseDataForMessage($json, $partner) {
    $tmp = json_decode($json, true);
        $nameKey = array_search('name', array_column($tmp, 'id'));
        $phoneKey = array_search('phone', array_column($tmp, 'id'));
        $termKey = array_search('credit_term', array_column($tmp, 'id'));
        $priceKey = array_search('price', array_column($tmp, 'id'));
        $courseKey = array_search('course', array_column($tmp, 'id'));
    // var_dump($tmp[$termKey]['a']);
    $message = 'Партнер: '.$partner.chr(10).
              ($nameKey !== false ? 'Имя: '. $tmp[$nameKey]['a'] .chr(10) : "").
              ($courseKey !== false  ? 'Продукт: '.$tmp[$courseKey]['a'].chr(10) : "").
              ($priceKey !== false ? 'Стоимость: '.$tmp[$priceKey]['a'].chr(10) : "").
              ($termKey !== false ? 'Срок кредита: '.$tmp[$termKey]['a'].chr(10) : "").
              ($phoneKey !== false ? 'Телефон: '.$tmp[$phoneKey]['a'] : "");

    return $message;
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
