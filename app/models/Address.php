<?php
namespace App\Models;
use Core\Helpers\QueryHelper;

class Address {
  protected $db;
  protected $queryHelper;

  public function __construct($db) {
    $this->db = $db;
    $this->queryHelper = new QueryHelper();
  }

  public function findAll() {
    $stmt = $this->db->run('SELECT * FROM address');
    return $stmt->fetchAll();
  }

  public function find($id) {
    $stmt = $this->db->run('SELECT * FROM address where id = :id', ['id' => $id]);
    return $stmt->fetch();
  }

  public function insert($data) {
    $stmt = $this->db->run(<<<SQL
      INSERT INTO address (address_line1, address_line2, country_id, state_id, city_id, zipcode)
      VALUES (:address_line1, :address_line2, :country_id, :state_id, :city_id, :zipcode);
    SQL, [
      ':address_line1' => $data['addressLine1'],
      ':address_line2' => $data['addressLine2'],
      ':country_id' => $data['countryId'],
      ':state_id' => $data['stateId'],
      ':city_id' => $data['cityId'],
      ':zipcode' => $data['zipcode']
    ]);

    return $this->db->lastInsertId('address_id_seq');
  }

  public function update($id, $data) {
    $allowed = [
      'address_line1',
      'address_line2',
      'country_id',
      'state_id',
      'city_id',
      'zipcode'
    ];

    $dynamicQuery = $this->queryHelper->getDynamicUpdateQuery('address', $id, $data, $allowed);
    $query = $dynamicQuery['sql'];
    $params = $dynamicQuery['params'];

    $stmt = $this->db->run($query, $params);

    return $stmt->rowCount();
  }

  public function delete($id) {
    $stmt = $this->db->run('DELETE FROM address WHERE id = :id', ['id' => $id]);
    return $stmt->rowCount();
  }
}
