<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    
    require('../../config/Database.php');
    require('../../models/Category.php');


    $database = new Database();
    $db = $database->connect();

    $categories = new Category($db);

    $categories->id = isset($_GET['id']) ? $_GET['id']: die();

    

    if($categories->read_single()) {
      echo json_encode(array('id' => $categories->id,'category' => $categories->category));
    }
    else {
      echo json_encode(array('message' => 'category_id Not Found'));

  }
  ?>