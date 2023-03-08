<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
    require ('../../config/Database.php');
    require ('../../models/Author.php');
  
  
    $database = new Database();
    $db = $database->connect();
  
    $authors = new Author($db);

    $data = json_decode(file_get_contents("php://input"));

    //Determine if variable is declared and Not NULL. Is Id set OR is Author set. 
    if (!isset($data->id)|| !isset($data->author) ) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
    }

    $authors->author = $data->author;
    $authors->id = $data->id;
    
    if ($authors->update()){
        echo json_encode(array('id'=>$authors->id,'author'=>$authors->author));
    }
    else
    {
        echo json_encode(array('message' => 'author_id Not Found'));
    }

    ?>