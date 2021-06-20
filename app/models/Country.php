<?php
namespace App\Models;

class Country {
  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findAll() {
    $stmt = $this->db->run('SELECT * FROM country');
    return $stmt->fetchAll();
  }

  public function find($id) {
    $stmt = $this->db->run('SELECT * FROM country WHERE id = :id', ['id' => $id]);
    return $stmt->fetch();
  }
}
