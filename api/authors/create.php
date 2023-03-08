<?php
//Required CORS headers for testing. 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
    require('../../config/Database.php');
    require( '../../models/Author.php');
  
  // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
  
    $authors = new Authors($db);

    
    $data = json_decode(file_get_contents("php://input"));
    
       //CHECK IF EXISTS
    if (!isset($data->author)) { 
        echo json_encode(array('message' => 'Missing Required Parameters'));
    }

   else {
        $authors->author = $data->author;
        $authors->create();
        echo json_encode(array('id'=> $db->lastInsertId(),'author'=>$authors->author));
    }
    ?>