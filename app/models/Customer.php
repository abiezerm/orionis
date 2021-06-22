<?php
namespace App\Models;
use Core\Helpers\QueryHelper;

class Customer {
  protected $db;
  protected $queryHelper;

  public function __construct($db) {
    $this->db = $db;
    $this->queryHelper = new QueryHelper();
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
      INSERT INTO customer (firstname, lastname, email, phone, gender, birthdate) 
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

  // insert an specific address to an specific customer
  public function insertAddress($customerId, $addressId) {
    $stmt = $this->db->run(
      'INSERT INTO customer_address (customer_id, address_id) VALUES (:customerId, :addressId)',
      ['customerId' => $customerId, 'addressId' =>$addressId]);

    return $stmt->rowCount();
  }

  public function update($id, $data) {
    $allowed = [
      'firstname',
      'lastname',
      'email',
      'phone',
      'birthdate',
      'gender',
    ];

    $dynamicQuery = $this->queryHelper->getDynamicUpdateQuery('customer', $id, $data, $allowed);
    $query = $dynamicQuery['sql'];
    $params = $dynamicQuery['params'];

    $stmt = $this->db->run($query, $params);
    
    return $stmt->rowCount();
  }

  public function delete($id) {
    $stmt = $this->db->run('DELETE FROM customer WHERE id = :id', ['id' => $id]);
    return $stmt->rowCount();
  }

  public function getAddressByCustomerId($id) {
    $sqlQuery = <<<SQL
      SELECT address.id,
          address.address_line1,
          address.address_line2,
          country.name as country_name,
          state.name as state_name,
          address.city as city_name
        FROM customer_address
        INNER JOIN customer ON customer.id = customer_address.customer_id
        INNER JOIN address ON address.id = customer_address.address_id
        INNER JOIN country ON country.id = address.country_id
        INNER JOIN state ON state.id = address.state_id
        WHERE customer_address.customer_id = :id
SQL;

    $stmt = $this->db->run($sqlQuery, ['id' => $id]);
    return $stmt->fetchAll();
  }
}
