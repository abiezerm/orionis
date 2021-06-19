<?php
use Core\App;
use Dotenv\DotEnv;
use Core\Database\DB;
require 'vendor/autoload.php';

// loading environment variables

// injecting data in the dependency injection container
if (isset($ENV['ENVIRONMENT']) && $_ENV['ENVIRONMENT'] === 'production') {
  // production config
} else {
  // development config
  $dotEnv = DotEnv::createImmutable(__DIR__);
  $dotEnv->load();

  App::bind('database', new DB(
    $_ENV['DB_NAME'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_HOST'],
    $_ENV['DB_PORT'],
    $_ENV['DBMS']
  ));
}

var_dump(App::get('database'));

// $stmt = $db->run("SELECT * FROM customer WHERE id = :id", ['id' => 1]);
// $result = $stmt->fetchAll();
// var_dump($result);
