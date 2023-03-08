<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  require('../../config/Database.php');
  require( '../../models/Author.php');


  $database = new Database();
  $db = $database->connect();

  $authors = new Author($db);

  $authors->id = isset($_GET['id']) ? $_GET['id']: die();

  
  
  if($authors->read_single()) {

     echo json_encode(array('id' => $authors->id,'author' => $authors->author));
    }
  else 
  {
    echo json_encode(array( 'message' => 'author_id Not Found' ));

  }
?>