<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
    require('../../config/Database.php');
    require('../../models/Category.php');
  
  
    $database = new Database();
    $db = $database->connect();
  
    $categories = new Category($db);

    $data = json_decode(file_get_contents("php://input"));
    
   

    if(!isset($data->category)){
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }
    else {
        $categories->category = $data->category;
        $categories->create();
        echo json_encode(array('id'=> $db->lastInsertId(),'category'=>$categories->category));
    }

?>