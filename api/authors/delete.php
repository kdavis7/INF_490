<?php
//Required CORS headers for testing
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
    require( '../../config/Database.php');
    require( '../../models/Author.php');
  
  //Initialize DB
    $database = new Database();
    $db = $database->connect();
  
    $authors = new Author($db);

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id)){
        echo(json_encode(array('message' => 'Missing Required Parameters')));
    }
    else
    {
        $authors->id = $data->id;
        $authors->delete();
        echo(json_encode(array('id'=>$authors->id)));
        
    }
?>