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
    $data = $this->addressModel->findById($id);
    if ($data) {
      $this->jsonResponse($data);
    } else {
      $this->notFoundJsonResponse();
    }
  }
}
