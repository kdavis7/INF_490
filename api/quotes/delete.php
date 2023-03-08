<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
    require ('../../config/Database.php');
    require ('../../models/Quote.php');
  
  
    $database = new Database();
    $db = $database->connect();
  
    $quotes = new Quote($db);

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id)){
        echo(json_encode(array('message'=> 'Missing Required Parameters')));
        exit();
    }

    $quotes->id = $data->id;
    if ($quotes->delete())
     {
        echo(json_encode(array('id'=>$quotes->id)));
    }
    else{
        echo(json_encode(array('message'=> 'No Quotes Found')));
    }

?>