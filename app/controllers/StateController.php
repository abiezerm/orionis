<?php
namespace App\Controllers;
use App\Models;
use Core\App;

class StateController extends Controller {
  private $stateModel;
  private $cityModel;

  public function __construct($db = NULL)
  { 
    $this->db = $db;
    $this->stateModel = new Models\State($this->db);
    $this->cityModel = new Models\City($this->db);
  }

  public function index() {
    $data = $this->stateModel->findAll();
    $response = [
      'data' => $data
    ];

    $this->jsonResponse($response);
  }

  public function view($id) {
    $data = $this->stateModel->find($id);

    if ($data) {
      $this->jsonResponse($data);
    } else {
      $this->notFoundJsonResponse();
    }
  }

  public function getCities($id) {
    $stateData = $this->stateModel->find($id);
    $response = [];
    
    if ($stateData) {
      $data = $this->cityModel->findByStateId($id);
      $response['data'] = $data;
      $this->jsonResponse($response);
    } else {
      $this->notFoundJsonResponse();
    }
  }
}
