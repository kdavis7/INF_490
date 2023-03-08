<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    
    require ('../../config/Database.php');
    require ('../../models/Category.php');


    $database = new Database();
    $db = $database->connect();

    $categories = new Category($db);

    $result = $categories->read();

    $num = $result->rowCount();

    if ($num > 0)
    {
      $category_arr = array();
      

      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $categories_item = array('id' => $id,'category' => $category);

      array_push($category_arr, $categories_item);

      }

      echo json_encode($category_arr);

    }
    else {
      echo json_encode(array('message' => "No Categories Found!"));
    }
    ?>