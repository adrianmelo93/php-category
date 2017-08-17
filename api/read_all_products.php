<?php
  //inclde our core confi
  include_once '../config/core.php';

  //include the db connection_aborted
  include_once '../config/database.php';


  include_once '../objects/product.php';

  $database = new Database();
  $db = $database->getConnection();
  $product = new Product($db);

  $results = $product->readAll();

  echo $results;
