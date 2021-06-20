<?php
namespace App\Controllers;
use App\Models;
use Core\App;

class CityController extends Controller {
  private $cityModel;

  public function __construct($db = NULL)
  { 
    $this->db = $db;
    $this->cityModel = new Models\City($this->db);
  }

  public function index() {
    $data = $this->cityModel->findAll();
    $response = [
      'data' => $data
    ];

    $this->jsonResponse($response);
  }

  public function view($id) {
    $data = $this->cityModel->find($id);

    if ($data) {
      $this->jsonResponse($data);
    } else {
      $this->notFoundJsonResponse();
    }
  }
}
