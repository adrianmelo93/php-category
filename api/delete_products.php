<?php

  if($_POST){
    //inclde our core confi
    include_once '../config/core.php';

    //include the db connection_aborted
    include_once '../config/database.php';


    include_once '../objects/product.php';

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    $data = json_decode(file_get_contents("php://input"));

    $product->id =$data->id;

    //deleted the product

  if($product->delete()){
    echo "Product was deleted.";
  }else{
    echo "Unable to delete object.";
  }
}  
