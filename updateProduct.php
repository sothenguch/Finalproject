<?php

  include 'dbConnection.php';
  $con = getDatabaseConnection('heroku_3a83060270e607d');
    $id = $_GET['pId'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Update User </title>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h1> Tech Checkout System: Updating User's Info </h1>
        <div class="d-flex justify-content-between">
        <form method="POST" action="updated.php" class="form-group row">
            <input type="hidden" name="id" value="<?=$id?>" />
            Name:<input type="text" name="name" placeholder="Change the Name"/>
            <br />
            Price:<input type="text" name="price" placeholder="Change the Price"/>
            <br />
            <input type="submit" value="submit">
        </form><br />
        <form form action="./admin.php" method="get" >
            <input type="submit" value="Go Back To Admin Page">
        </form>
        </div>
    </body>
</html>