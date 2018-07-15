<?php
  require_once "vendor/autoload.php";

  function fetchEntities($entity) {
    $i = 0;
    $entityList = array();
    try {
      do {
          $fetchedEntities = $entity->apiList([
            'limit_rows' => 500,
            'limit_offset' => 500 * $i++
          ]);
          $entityList = array_merge($entityList, $fetchedEntities);
          usleep(600);
      } while ($fetchedEntities);
    } catch (\AmoCRM\Exception $e) {
      printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
    return $entityList;
  }

  function getEntityInfo($entity, $fields = []) {
    $result['id'] = $entity['id'];
    $result['Наименование'] = $entity["name"];
    if (isset($entity['custom_fields']) && $entity['custom_fields'] && $fields) {
      foreach ($fields as $id) {
        $CFs = $entity['custom_fields'];
        $key = array_search($id, array_column($CFs, 'id'));
        if ($key !== false) {
          $field = $CFs[$key];
          // $result[$field["name"]] = '';
          foreach ($field["values"] as $key => $value) {
              $result[$field["name"]." #".($key + 1)] = $value["value"];
          }
        }
      }
    }
    return $result;
  }
?>
