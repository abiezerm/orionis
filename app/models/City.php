<?php
namespace App\Models;

class City {
  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findAll() {
    $stmt = $this->db->run('SELECT * FROM city');
    return $stmt->fetchAll();
  }

  public function find($id) {
    $stmt = $this->db->run('SELECT * FROM city WHERE id = :id', ['id' => $id]);
    return $stmt->fetch();
  }
}
