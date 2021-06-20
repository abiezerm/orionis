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
    $data = $this->customerModel->findById($id);
    if ($data) {
      $this->jsonResponse($data);
    } else {
      $this->notFoundJsonResponse();
    }
  }
}
