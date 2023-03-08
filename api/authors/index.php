<?php

     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     $method = $_SERVER['REQUEST_METHOD'];
 
     if ($method === 'OPTIONS')
     {
         header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
         header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
         exit();
     } 

     
     if ($method === 'PUT'){
        require('update.php');
      }
      else if ($method === 'GET' && isset($_GET['id'])){
        require('read_single.php');
        die();
      }
      else if ($method === 'GET'){
        require('read.php');
      }
      else if ($method === 'DELETE'){
        require('delete.php');
      }
      else ($method === 'POST'){
        require('create.php');
      }








?>