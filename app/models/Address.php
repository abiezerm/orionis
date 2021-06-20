<?php
namespace App\Models;

class Address {
  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findAll() {
    $stmt = $this->db->run('SELECT * FROM address');
    return $stmt->fetchAll();
  }

  public function findById($id) {
    $stmt = $this->db->run('SELECT * FROM address where id = :id', ['id' => $id]);
    return $stmt->fetch();
  }
}
