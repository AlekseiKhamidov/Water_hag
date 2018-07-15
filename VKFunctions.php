<?php
  require_once "vendor/autoload.php";
  require_once "config.php";

  $vk = new \VK\Client\VKApiClient();
  //
  // echo "<pre>";
  // $attachments = createAttachements([
  //   "_FACE.jpg",
  //   "_PASSPORT.jpg",
  //   "_PDF.pdf",
  //   "_UROD.png",
  // ]);
  //
  // print_r($attachments);
  //
  // for ($i=0; $i<10; $i++) {
  //   postToGroupWall("Смотрииииии!!!!", $attachments);
  //   sendMessageToChat("Стопудово работает");
  // }
  //   echo "</pre>";
########################################################################################################################################################

	function getWallUploadURL($type = "photo") {
    retryGetWallUploadURL:
    try {
      switch ($type) {
        case "photo":
          $VKApiObject = $GLOBALS['vk']->photos();
          break;
        case "document":
          $VKApiObject = $GLOBALS['vk']->docs();
          break;
      }
      return ($VKApiObject->getWallUploadServer(
        VK["user_token"],
        array(
          "group_id" => VK["group_id"],
      )))['upload_url'];

    } catch (\VK\Exceptions\VKApiException $e) {
      if ($e->getCode() == 6) {
        usleep(1000);
        goto retryGetWallUploadURL;
      } else printf('%s: Error (%d): %s' . PHP_EOL, __FUNCTION__,  $e->getCode(), $e->getMessage());
    }
	}

	function curlUploadFile($url, $filename, $type) {
    try {
      $img_real_path = realpath(dirname(__FILE__).'/'.$filename);
      $curl_file = curl_file_create($img_real_path, mime_content_type($img_real_path), $filename);

      $ch=curl_init();
      curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array($type => $curl_file)
      ));
      return json_decode(curl_exec($ch), true);

    } catch (\Exception $e) {
      printf('%s: Error (%d): %s' . PHP_EOL, __FUNCTION__,  $e->getCode(), $e->getMessage());
    }
	};

  function savePhotoToGroupWall($uploadedPhoto) {
    retrySavePhotoToGroupWall:
    try {
      $photo = $GLOBALS['vk']->photos()->saveWallPhoto(
        VK["user_token"],
        array(
          "group_id" => VK["group_id"],
          "photo" => $uploadedPhoto["photo"],
          "server" => $uploadedPhoto["server"],
          "hash" => $uploadedPhoto["hash"],
      ))[0];
      return $photo;

    } catch (\VK\Exceptions\VKApiException $e) {
      if ($e->getCode() == 6) {
        usleep(1000);
        goto retrySavePhotoToGroupWall;
      } else printf('%s: Error (%d): %s' . PHP_EOL, __FUNCTION__,  $e->getCode(), $e->getMessage());
    }
  }

	function saveDocument($uploadedDocument) {
    retrySaveDocument:
    try {
      $document = $GLOBALS['vk']->docs()->save(
        VK["user_token"],
        array(
          "file" => $uploadedDocument["file"],
      ))[0];
      return $document;

    } catch (\VK\Exceptions\VKApiException $e) {
      if ($e->getCode() == 6) {
        usleep(1000);
        goto retrySaveDocument;
      } else printf('%s: Error (%d): %s' . PHP_EOL, __FUNCTION__,  $e->getCode(), $e->getMessage());
    }
  }

  function sendMessageToChat($message) {
    retrySendMessageToChat:
    try {
      $messages = $GLOBALS['vk']->messages();
      $messages->send(
        VK["user_token"],
        array(
          "owner_id" => VK["user_id"],
          "chat_id" => VK["chat_id"],
          "message" => $message,
        )
      );
    } catch (\VK\Exceptions\VKApiException $e) {
      if ($e->getCode() == 6) {
        usleep(1000);
        goto retrySendMessageToChat;
      } else printf('%s: Error (%d): %s' . PHP_EOL, __FUNCTION__,  $e->getCode(), $e->getMessage());
    }
  }

  function createAttachements($files) {
    $attachments = "";
    try {
      foreach ($files as $file) {
        $fileType = mime_content_type($file);
        switch ($fileType) {
          case 'image/gif':
          case 'image/png':
          case 'image/jpeg':
            $url = getWallUploadURL("photo");
            printf('Файл %s (%s) будет загружен по этой ссылке:<br>%s' . PHP_EOL, $file, $fileType, $url);
            $uploadedPhoto = curlUploadFile($url, $file, "photo");
            $savedPhoto = savePhotoToGroupWall($uploadedPhoto);
            $attachments .= 'photo'.VK["user_id"].'_'.$savedPhoto['id'].',';
            print_r($attachments);
            break;

          case 'application/pdf':
            $url = getWallUploadURL("document");
            printf('Файл %s (%s) будет загружен по этой ссылке:<br>%s' . PHP_EOL, $file, $fileType, $url);
            $uploadedDocument = curlUploadFile($url, $file, "file");
            $savedDocument = saveDocument($uploadedDocument);
            $attachments .= 'doc-'.VK["group_id"].'_'.$savedDocument['id'].',';
            print_r($attachments);
            break;

          default:
              printf('Файл %s (%s) не может быть загружен в VK<br><br>' . PHP_EOL, $file, $fileType);
            break;
        }
      }
      return $attachments;

    } catch (\Exception $e) {
      printf('%s: Error (%d): %s' . PHP_EOL, __FUNCTION__,  $e->getCode(), $e->getMessage());
    }
  }

  function postToGroupWall($message, $attachments) {
    retryPostToGroupWall:
    try {
      $wall = $GLOBALS['vk']->wall();
      return $wall->post(
        VK["user_token"],
        array(
          "owner_id" => -VK["group_id"],
          "message" => $message,
          "attachments" => $attachments,
        )
      )['post_id'];
    } catch (\VK\Exceptions\VKApiException $e) {
      if ($e->getCode() == 6) {
        usleep(1000);
        goto retryPostToGroupWall;
      } else printf('%s: Error (%d): %s' . PHP_EOL, __FUNCTION__,  $e->getCode(), $e->getMessage());
    }
  }
?>
