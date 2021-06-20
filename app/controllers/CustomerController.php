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
    $this->jsonResponse($data);
  }

  public function view($id) {
    $data = $this->customerModel->find($id);
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
