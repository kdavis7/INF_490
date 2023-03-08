<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type:application/json');
  
  require('../../config/Database.php');
  require('../../models/Quote.php');


  $database = new Database();
  $db = $database->connect();

  $quotes = new Quote($db);

  $quotes->id = isset($_GET['id']) ? $_GET['id']: die();
   

  if($quotes->read_single()) {

    $quote_arr = array(
      'id' => $quotes->id,
      'quote' => $quotes->quote,
      'author' => $quotes->author,
      'category' => $quotes->category
    );
   }
 else {
   $quote_arr = array(
     'message' => 'No Quotes Found'
   );

 }

  print_r(json_encode($quote_arr));

?>