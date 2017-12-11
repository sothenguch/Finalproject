<?php

  include 'dbConnection.php';
  $con = getDatabaseConnection('heroku_3a83060270e607d');
    $id = $_GET['rId'];
    echo "<h1>";echo "Admin : Report";echo "</h1>";
    if($id == 1){
        $sql = "SELECT round(avg(price), 2) as rr FROM products";
        $sen = "The average price of all the products is : $";
    }else if ($id == 2){
        $sql = "SELECT count(*) as rr FROM products";
        $sen = "The amount of products listing is : ";
    }else{
        $sql = "SELECT round(sum(price), 2) as rr FROM products";
        $sen = "The sum of all price is : $";
    }
    
     $stmt = $con->prepare($sql);
     $stmt->execute();
     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
     foreach($results as $result){
        echo $sen, $result['rr'];
     }

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
    <br>
      <form form action="./admin.php" method="get" >
            <input type="submit" value="Go Back To Admin Page">
      </form>
  </div>
  
</html>