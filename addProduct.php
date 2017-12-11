<?php
include 'dbConnection.php';
$con = getDatabaseConnection('heroku_3a83060270e607d');

if (isset($_GET['addFood'])) {  //the add form has been submitted

    $sql = "INSERT INTO products
             (pId, pName, categoryId, price) 
             VALUES
             (NULL, :newName, :newCId, :newPrice)";
    $np = array();
    
    $np[':newName'] = $_GET['name'];
    $np[':newCId'] = $_GET['category'];
    $np[':newPrice'] = $_GET['price1'];
    
    $stmt=$con->prepare($sql);
    $stmt->execute($np);
    
    echo "Item was added!";
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Add new Food to the Menu</title>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
            
            function validateName() {
                    
            $.ajax({
                type: "get",
                url: "api.php",
                dataType: "json",
                data: {
                    'name': $('#name').val(),
                    'action': 'validate-name'
                },
                success: function(data,status) {
                    debugger;
                    
                    if (data.length > 0) {
                        $('#name-valid').html("Name is not available"); 
                    } else {
                        $('#name-valid').html("Name is available");
                    }
                    
                  },
                complete: function(data,status) { //optional, used for debugging purposes
                     //alert(status);
                }
            });
                }
        </script>
    </head>
    <body>
            <h1>Add New Product</h1>
            <div class="d-flex justify-content-between">
            <form method="GET">
                Name:<input onchange="validateName();" id='name' type="text"> <span id="name-valid"></span></span><br>
                Retype the name: <input type="text" name="name"/>
                <br />
                Price:<input type="number" step="0.01" name="price1"/>
                <br /><br />
               Category: 
               <select name="category">
                    <option value=""> - Select One - </option>
                    <option value="10ab">Drink</option>
                    <option value="11ab">Grill</option>
                    <option value="12ab">Appetizer</option>
                    <option value="13ab">Desert</option>
                    <option value="14ab">Alcohol</option>
                    <option value="15ab">Vegan</option>
                </select>
                <br /><br />

                <input type="submit" value="Add To the Menu" name="addFood">
            </form><br />
            <form form action="./admin.php" method="get" >
            <input type="submit" value="Go Back To Admin Page">
            </form>
            </div>
    </body>
</html>
