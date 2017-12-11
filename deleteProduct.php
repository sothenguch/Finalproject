<?php
  include 'dbConnection.php';
  $con = getDatabaseConnection('heroku_3a83060270e607d');
  
  $sql = "DELETE FROM products 
          WHERE pId = " . $_GET['pId'];
          
  $stmt = $con->prepare($sql);
  $stmt->execute();
  
  header("Location: admin.php");
  



?>