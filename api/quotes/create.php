<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
    
    require ('../../config/Database.php');
    require ( '../../models/Quote.php');
    require ('../../models/Author.php');
    require ('../../models/Category.php');
  
  
    $database = new Database();
    $db = $database->connect();
  
    $quotes = new Quote($db);

    $authors = new Author($db);
    $categories = new Category($db);

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id))
    {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();

    }
               
        $quotes->quote = $data->quote;
        $quotes->author_id = $data->author_id;
        $quotes->category_id = $data->category_id;

        $authors->id = $data->author_id;
        $categories->id = $data->category_id;
        
        $authors->read_single();
        $categories->read_single();

        if (!$authors->author) { 
            echo json_encode(array('message' => 'author_id Not Found')); 
        }
        else if (!$categories->category) {
            echo json_encode(array('message' => 'category_id Not Found'));
        }
        else if ($quotes->create()){
            echo json_encode(array('id'=> $db->lastInsertId(),'quote'=> $quotes->quote, 'author_id'=>$quotes->author_id, 'category_id'=>$quotes->category_id));
        }
        else
        {
            echo json_encode(array('message' => 'Quote not added'));
        }
?>