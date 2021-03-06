<?php
namespace App\Controllers;
use App\Models;
use Core\App;

class CustomerController extends Controller {
  private $customerModel;

  public function __construct($db = NULL)
  { 
    $this->db = $db;
    $this->customerModel = new Models\Customer($this->db);
  }

  public function index() {
    $data = $this->customerModel->findAll();
    $response = [
      'data' => $data
    ];
    $this->jsonResponse($response);
  }

  public function view($id) {
    $data = $this->customerModel->find($id);
    $addressesData = $this->customerModel->getAddressByCustomerId($id);

    // adding addresses to the customer data
    $data['addresses'] = $addressesData;
    
    if ($data) {
      $this->jsonResponse($data);
    } else {
      $this->notFoundJsonResponse();
    }
  }

  public function add() {
    $_POST = $this->getJSONBodyData();

    if ($this->validateEntity($_POST)) {
      $id = $this->customerModel->insert([
        'firstname' => $_POST['firstname'],
        'lastname'  => $_POST['lastname'],
        'email'     => $_POST['email'],
        'phone'     => $_POST['phone'],
        'gender'    => $_POST['gender'],
        'birthdate' => $_POST['birthdate']
      ]);

      $data = $this->customerModel->find($id);
      $this->createJSONResponse($data);
    } else {
      $this->invalidInputJsonResponse();
    }
  }

  public function addAddress() {
    $_POST = $this->getJSONBodyData();

    if (!empty($_POST['customerId']) && !empty($_POST['addressId'])) {
      try {
        $rowCount = $this->customerModel->insertAddress($_POST['customerId'], $_POST['addressId']);
        $this->createJSONResponse([
          'message' => 'success inserting address to the customer'
        ]);
      } catch(\PDOException $e) {
        $this->createJSONResponse([
          'error' => 'Something went wrong'
        ]);
      }
    } else {
      $this->invalidInputJsonResponse();
    }
  }

  public function edit($id) {
    $putData = $this->getJSONBodyData();

    if ($this->validateEntity($putData)) {
      $rowCount = $this->customerModel->update($id, [
        'firstname' => $putData['firstname'],
        'lastname'  => $putData['lastname'],
        'email'     => $putData['email'],
        'phone'     => $putData['phone'],
        'gender'    => $putData['gender'],
        'birthdate' => $putData['birthdate']
      ]); 

      $data = $this->customerModel->find($id);

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
    $rowCount = $this->customerModel->delete($id);

    if ($rowCount > 0) {
      $this->noContentJsonResponse();
    } else {
      $this->notFoundJsonResponse();
    }
  }

  public function validateEntity($input) {
    if (empty($input['firstname'])) {
      return false;
    }

    if (empty($input['lastname'])) {
      return false;
    }

    return true;
  }
}
