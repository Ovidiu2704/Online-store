<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/app.css" />
</head>

<body>

    <?php
        require_once './header.php';
        if(!isset($_SESSION["logged_in"])) {
            header("Location: ./home.php");
            exit();
        }
        echo "<br><br><br><br>";
        $errors = $_GET;
       
        foreach ($errors as $key => $error) {
            echo "<ul class='error' style='list-style-type:none'>";
            echo "$error";
            echo "</ul>";
        }
        require_once './database_connector.php';
        $conn = DatabaseConnector::getInstance()->getConnection();
        $sql = "SELECT * FROM products";
        $data = $conn->query($sql);
        echo "<div class=\"grid-container\">";
        while ($row = $data->fetch_assoc()) {
            echo "
            <div class=\"data__table\">
            <div class=\"img__wrapper\"><img src=\"$row[path]\" alt=\"caine\"  height=\"300\"></div>
            <br>
           <p class=\"data__row\"> Name: $row[name] </p>
           <p class=\"data__row\"> Price: $row[price] </p>
           <p class=\"data__row\"> Stock: $row[quantity] </p>";
           echo"<form action=\"admin_actions_cart.php\" method=\"post\">";
           echo '<input type="hidden" name="product_id" value="'.$row['id_prod'].'">';
           echo '<input type="hidden" name="quantity" value="'.$row['quantity'].'">';
           echo"<input type=\"text\" name=\"bought_quantity\" placeholder=\"Quantity\">";
           echo '<input type="hidden" name="user_id" value="'.$_SESSION['id'].'">';
        echo"<button type=\"submit\" name=\"add_cart\">Add to Cart</button>
        </form>
            </div> ";
        

        }
        echo "</div>";
    ?>

        

        

</body>

</html>