<?php
  //inclde our core confi
  include_once '../config/core.php';

  //include the db connection_aborted
  include_once '../config/database.php';


  include_once '../objects/category.php';

  $database = new Database();
  $db = $database->getConnection();
  $category = new Category($db);

  $results = $category->readAll();

  echo $results;
