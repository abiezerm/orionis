<?php
namespace App\Controllers;
use App\Models;
use Core\App;

class AddressController extends Controller {
  private $addressModel;

  public function __construct($db = NULL)
  { 
    $this->db = $db;
    $this->addressModel = new Models\Address($this->db);
  }

  public function index() {
    $data = $this->addressModel->findAll();
    $response = [
      'data' => $data
    ];
    $this->jsonResponse($data);
  }

  public function view($id) {
    $data = $this->addressModel->find($id);
    if ($data) {
      $this->jsonResponse($data);
    } else {
      $this->notFoundJsonResponse();
    }
  }

  public function add() {
    $_POST = $this->getJSONBodyData();
  
    if ($this->validateEntity($_POST)) {
      $id = $this->addressModel->insert([
        'addressLine1' => $_POST['addressLine1'],
        'addressLine2' => $_POST['addressLine2'],
        'countryId' => $_POST['countryId'],
        'stateId' => $_POST['stateId'],
        'city' => $_POST['city'],
        'zipcode' => $_POST['zipcode']
      ]);

      $data = $this->addressModel->find($id);
      $this->createJSONResponse($data);
    } else {
      $this->invalidInputJsonResponse();
    }
  }

  public function edit($id) {
    $putData = $this->getJSONBodyData();

    if ($this->validateEntity($putData)) {
      $rowCount = $this->addressModel->update($id, [
        'address_line1' => $putData['addressLine1'],
        'address_line2' => $putData['addressLine2'],
        'country_id' => $putData['countryId'],
        'state_id' => $putData['stateId'],
        'city_id' => $putData['cityId'],
        'zipcode' => $putData['zipcode']
      ]);

      $data = $this->addressModel->find($id);

      if ($data) {
        $this->jsonResponse($data);
      } else {
        $this->notFoundJsonResponse();
      }
    } else {
      $this->invalidInputJsonResponse();
    }
  }

  public function delete($id) {
    $rowCount = $this->addressModel->delete($id);

    if ($rowCount > 0) {
      $this->noContentJsonResponse();
    } else {
      $this->notFoundJsonResponse();
    }
  }

  public function validateEntity($input) {
    if (empty($input['addressLine1'])) {
      return false;
    }

    if (empty($input['addressLine2'])) {
      return false;
    }

    if (empty($input['countryId'])) {
      return false;
    }

    if (empty($input['stateId'])) {
      return false;
    }

    if (empty($input['city'])) {
      return false;
    }

    if (empty($input['zipcode'])) {
      return false;
    }

    return true;
  }
}
