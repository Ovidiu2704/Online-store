<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/app.css">    
</head>

<body>
    <?php 
    require_once './header.php';
    echo "<br><br><br><br><br>";
    if ($_SESSION['is_admin'] !=1 ) {
        header("Location: ./home.php");
        exit();
    }
    require_once './database_connector.php';
    require_once './basic_cruds_products.php';
        $conn = DatabaseConnector::getInstance()->getConnection();
        $sql = "SELECT * FROM products";
        $data = $conn->query($sql);
        while ($row = $data->fetch_assoc()) {
            echo 'ID: '.$row['id_prod'];
            echo '<form action="admin_actions_products.php" method="post">';
            echo '<input type="hidden" name="id" value="'.$row['id_prod'].'">';
            echo '<input type="text" name="path" value="'.$row['path'].'">';
            echo '<input type="text" name="name" value="'.$row['name'].'">';
            echo '<input type="text" name="price" value="'.$row['price'].'">';
            echo '<input type="text" name="quantity" value="'.$row['quantity'].'">';
            echo '<input type="submit" name="edit_product" value="Edit Product">';
            echo '<input type="submit" name="delete_product" value="Delete Product">';
            echo '</form>';
        }
        echo "<form action=\"./admin_actions_products.php\" method=\"post\">
    <h2>Add Product</h2>
    <label>Path</label>
    <input type=\"text\" name=\"path\" placeholder=\"Path\"><br>
    <label>Name</label>
    <input type=\"text\" name=\"name\" placeholder=\"Name\"><br>
    <label>Price</label>
    <input type=\"text\" name=\"price\" placeholder=\"Price\"><br>
    <label>Quantity</label>
    <input type=\"text\" name=\"quantity\" placeholder=\"Quantity\"><br>
    <button type=\"submit\" name=\"add_product\">Add</button>
</form>";
        
    ?>


            

</body>

</html>
