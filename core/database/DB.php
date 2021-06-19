<?php
namespace Core\Database;
use PDO;

class DB {
  public $pdo;

  public function __construct($db, $username = NULL, $password = NULL, $host = '127.0.0.1', $port = '3307', $dbms='mysql', $options=[])
  {
    $defaultOptions = [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $options = array_replace($defaultOptions, $options);
    $dsn = "$dbms:host=$host;dbname=$db;$port=$port;";

    try {
      $this->pdo = new \PDO($dsn, $username, $password, $options);
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
  }

  public function run($sql, $args = NULL) {
    if (!$args) {
      return $this->pdo->query($sql);
    }
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }
}
