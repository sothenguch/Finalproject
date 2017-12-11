<?php

  include 'dbConnection.php';
  $con = getDatabaseConnection('heroku_3a83060270e607d');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    $sql = "UPDATE products
             SET pName = '$name',
                 price  = '$price'
             WHERE pId = '$id'";
     
     $stmt = $con->prepare($sql);
     $stmt->execute();
     echo "Record has been updated!";

?>
<html>
  <head>
      <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <div class="d-flex justify-content-between">
      <form form action="./admin.php" method="get" >
            <input type="submit" value="Go Back To Admin Page">
      </form>
  </div>
  
</html>