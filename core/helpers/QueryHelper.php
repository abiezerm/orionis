<?php
namespace Core\Helpers;

class QueryHelper {
  public function getDynamicUpdateQuery($tablename, $id, $data, $allowed) {
    $result = [
      'sql' => '',
      'params'=> []
    ];
    $updateFields = [];
    foreach ($data as $key => $value) {
        if (array_search($key, $allowed) !== false) {
           $updateFields[] = "$key = :$key";
           $result['params'][$key] = $value; 
        }
    }
    $result['sql'] = "UPDATE $tablename SET " .  implode(', ', $updateFields) . " WHERE id = $id";
    return $result;
  }
}
