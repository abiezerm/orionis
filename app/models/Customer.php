<?php
namespace App\Models;

class Customer {
  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findAll() {
    $stmt = $this->db->run('SELECT * FROM customers');
    return $stmt->fetchAll();
  }
}
