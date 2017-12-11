<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</head>
<body>
        <div>
            <h1>Welcome To the Admin Page</h1>
            <form id="indexForm">

            Category:
            <select name = "category">
                <option value = "">Select Category</option>
                <option value = "Drink">Drink</option>
                <option value = "Grill">Grill</option>
                <option value = "Appetizer">Appetizer</option>
                <option value = "Desert">Desert</option>
                <option value = "Alcohol">Alcohol</option>
                <option value = "Vegan">Vegan</option>
            </select>
            <br />
            <label for="price">Sort by Price:</label>
            <input type="radio" name="price" value="asc"> Ascending
  	        <input type="radio" name="price" value="desc"> Descending
  	        <br />
  	        <input type="submit" value="Search" name="submit" />
            </form>
            <form action="addProduct.php">
            <input type="submit" value="Add New Product!" />
            </form>
        </div>

<?php 
include 'dbConnection.php';
$con = getDatabaseConnection('heroku_3a83060270e607d');
session_start();
$sql = "SELECT * FROM products JOIN category WHERE products.categoryId = category.categoryId ";
$results = null;
if(isset($_GET['submit'])){
    if($_GET['category'] != ""){
            $keyword = $_GET['category'];
            $sql .= " AND categoryName = '$keyword'";
    }

    //order items by price asc or desc
    if(isset($_GET['price'])){
        if($_GET['price'] == "asc"){
            $sql .=  " order by Price";
        }
        else{
            $sql .= " order by Price desc";
        }
    }
}
$stmt = $con -> prepare ($sql);
$stmt -> execute($namedParameters);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<table class='table table-bordered'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Price</th>";
echo "<th>Category</th>";
echo "<th>Action</th>";
echo "</tr>";
foreach($results as $result) {
        echo "<tr>";
        echo "<td>".$result['pId']. "</td>";
        echo "<td>".$result['pName']."</td>";
        echo "<td> $ ".$result['price']."</td>";
        echo "<td>".$result['categoryName']."</td>";
        echo "<td>";
        echo "[<a href='updateProduct.php?pId=".$result['pId']."'> Update </a>] ";
        echo "[<a onclick='return confirmDelete()' href='deleteProduct.php?pId=".$result['pId']."'> Delete </a>] <br />";
        echo "</td>";
        echo "</tr>";
}
echo "</table>";
?>
<div>
        <h2> Generate A Report  </h2>
        [<a href='report.php?rId=1'> Click Here to Get Average Price </a>] <br />
        [<a href='report.php?rId=2'> Click Here to See How Many Listing of Products </a>] <br />
        [<a href='report.php?rId=3'> Click Here to the Sum Of all Prices Together </a>] <br />
        <h1> Admin Logout </h1>
        <form action="logout.php">
            <input type="submit" value="Logout!" />
        </form><br>
        </div>
</body>
</html>

