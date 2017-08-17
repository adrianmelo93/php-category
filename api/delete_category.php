<?php

  if($_POST){
    //inclde our core confi
    include_once '../config/core.php';

    //include the db connection_aborted
    include_once '../config/database.php';


    include_once '../objects/category.php';

    $database = new Database();
    $db = $database->getConnection();
    $category = new Category($db);

    $data = json_decode(file_get_contents("php://input"));

    $category->id =$data->id;

    //deleted the category

  if($category->delete()){
    echo "Product was deleted.";
  }else{
    echo "Unable to delete object.";
  }
  }
