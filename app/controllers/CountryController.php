<?php
namespace App\Controllers;
use App\Models;
use Core\App;

class CountryController extends Controller {
  private $countryModel;
  private $stateModel;

  public function __construct($db = NULL)
  { 
    $this->db = $db;
    $this->countryModel = new Models\Country($this->db);
    $this->stateModel = new Models\State($this->db);
  }

  public function index() {
    $data = $this->countryModel->findAll();
    $response = [
      'data' => $data
    ];

    $this->jsonResponse($response);
  }

  public function view($id) {
    $data = $this->countryModel->find($id);

    if ($data) {
      $this->jsonResponse($data);
    } else {
      $this->notFoundJsonResponse();
    }
  }

  
  public function getStates($id) {
    $countryData = $this->countryModel->find($id);
    $response = [];

    if ($countryData) {
      $data = $this->stateModel->findByCountryId($id);
      $response['data'] = $data;
      $this->jsonResponse($response);
    } else {
      $this->notFoundJsonResponse();
    }
  }
}
