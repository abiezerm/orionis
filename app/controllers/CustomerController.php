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
    var_dump('Customer Controller Index');
  }

  public function view($id) {
    var_dump("Customer View: $id");
  }
}
