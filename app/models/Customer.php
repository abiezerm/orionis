<?php
namespace App\Models;

class Customer {
  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findAll() {
    $stmt = $this->db->run('SELECT * FROM customer');
    return $stmt->fetchAll();
  }

  public function findById($id) {
    $stmt = $this->db->run('SELECT * FROM customer where id = :id', ['id' => $id]);
    return $stmt->fetch();
  }
}
