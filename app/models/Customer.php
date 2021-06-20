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

  public function find($id) {
    $stmt = $this->db->run('SELECT * FROM customer where id = :id', ['id' => $id]);
    return $stmt->fetch();
  }

  public function insert($data) {
    $stmt = $this->db->run(<<<SQL
      INSERT INTO customer(firstname, lastname, email, phone, gender, birthdate) 
      VALUES (:firstname, :lastname, :email, :phone, :gender, :birthdate)
    SQL, [
      'firstname' => $data['firstname'],
      'lastname' => $data['lastname'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'gender' => $data['gender'],
      'birthdate' => $data['birthdate']
    ]);

    return $this->db->lastInsertId('customer_id_seq');
  }
}
