<?php
namespace App\Controllers;
use Core\Database;
use Core\Helpers;

class Controller {
  protected $db;

  protected function jsonResponse($data = [], $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
  }

  protected function getJSONBodyData() {
    $jsonData = json_decode(file_get_contents('php://input'), true);
    return $jsonData;
  }

  // 201 created
  protected function createJSONResponse($data) {
    $this->jsonResponse($data, 201);
  }

  // 404 Not found - view or delete
  protected function notFoundJsonResponse($response = ['error' => 'Not found']) {
    $this->jsonResponse($response, 404);
  }

  // 204 - No content delete
  protected function noContentJsonResponse() {
    $this->jsonResponse(NULL, 204);
  }

  // 400 Bad Request - add
  protected function invalidInputJsonResponse($response = ['error' => 'Invalid Input']) {
    $this->jsonResponse($response, 400);
  }
}
