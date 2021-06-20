<?php
namespace App\Models;

class State {
  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findAll() {
    $stmt = $this->db->run('SELECT * FROM state');
    return $stmt->fetchAll();
  }

  public function find($id) {
    $stmt = $this->db->run('SELECT * FROM state WHERE id = :id', ['id' => $id]);
    return $stmt->fetch();
  }

  public function findByCountryId($id) {
    $stmt = $this->db->run('SELECT * FROM state WHERE country_id = :country_id', ['country_id' => $id]);
    return $stmt->fetchAll();
  }
}
