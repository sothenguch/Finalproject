<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
        <div>
            <h1>Restaurant Food Menu</h1>
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
        </div>

<?php 
include 'dbConnection.php';
$con = getDatabaseConnection('heroku_3a83060270e607d');
session_start();
function loginProcess() {
    global $con;
    $namedParameters = array();
    if (isset($_POST['loginForm'])) {  
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
            
        $sql = "SELECT *
                FROM Admin
                WHERE userName = :username 
                AND   password = :password ";
            
        $namedParameters = array();
            $namedParameters[':username'] = $username;
            $namedParameters[':password'] = $password;

            $stmt = $con->prepare($sql);
            $stmt->execute($namedParameters);
            $record = $stmt->fetch();
        if (empty($record)) {
                
            echo "Wrong Username or password";
        } else {
            echo "hello3";
            $_SESSION['username'] = $record['userName'];
            $_SESSION['adminName'] = $record['firstName'] . "  " . $record['lastName'];
            //echo $record['firstName'];
            header("Location: admin.php");
        }
    }
}

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
echo "</tr>";
foreach($results as $result) {
        echo "<tr>";
        echo "<td>".$result['pId']. "</td>";
        echo "<td>".$result['pName']."</td>";
        echo "<td> $ ".$result['price']."</td>";
        echo "<td>".$result['categoryName']."</td>";
        echo "</tr>";
}
echo "</table>";
?>
<div>
        <h1> Admin Login </h1>
        <form method="post">
            Username: <input type="text" name="username"/> <br />
            Password: <input type="password" name="password" /> <br />
            <input type="submit" name="loginForm" value="Login!"/>
        </form>
        <?=loginProcess()?>
        </div>
</body>
</html>

