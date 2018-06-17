<?php
  function getWallUploadURL($object) {
    return ($object->getWallUploadServer(VK_USER_TOKEN, array('group_id' => VK_AKTIVKREDIT_ID)))['upload_url'];
  };

  function curlUploadFile($url, $filename, $type = 'photo') {
    $img_real_path = __DIR__.$filename;
    $curl_file = curl_file_create($img_real_path, mime_content_type($img_real_path), $filename);

    $ch=curl_init();

    curl_setopt_array($ch, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => array($type => $curl_file)
    ));
    return json_decode(curl_exec($ch), true);
  };

  function savePhoto($photos, $img) {

    $photo = $photos->saveWallPhoto(VK_USER_TOKEN, array(
      'group_id' => VK_AKTIVKREDIT_ID,
      'photo' => $img['photo'],
      'server' => $img['server'],
      'hash' => $img['hash']
    ))[0];

    return $photo;
  };


  function saveDoc($docs, $doc) {
    $doc = $docs->save(VK_USER_TOKEN, array(
      'file' => $doc['file'],
    ))[0];

    return $doc;
  };
?>
