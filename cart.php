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
    if(!isset($_SESSION["logged_in"])) {
        header("Location: ./home.php");
        exit();
    }
    require_once './database_connector.php';
        $conn = DatabaseConnector::getInstance()->getConnection();
        $sql = "SELECT * FROM products,cart WHERE  id_prod=product_id  " ;
        $data = $conn->query($sql);
        echo "<div class=\"grid-container\">";
        while ($row = $data->fetch_assoc()) {
            if( $_SESSION["id"]==$row["user_id"])
           { echo "
            <div class=\"data__table\">
            <div class=\"img__wrapper\"><img src=\"$row[path]\" alt=\"pestemare\"  height=\"300\"></div>
            <br>
            <p class=\"data__row\"> Name: $row[name] </p>
            <p class=\"data__row\"> Price: $row[price] </p>
            <p class=\"data__row\"> Stock: $row[quantity] </p>
            <p class=\"data__row\"> Quantity: $row[bought_quantity] </p>";
            echo"<form action=\"admin_actions_cart.php\" method=\"post\">";
           echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'">';
           echo '<input type="hidden" name="user_id" value="'.$row['user_id'].'">';
           echo "<input type=\"submit\" name=\"remove\" value=\"Remove from cart\">
           </form>
           </div>"; }
        

        }
        echo "</div>";
        echo"<form action=\"admin_actions_cart.php\" method=\"post\">";
        echo '<input type="hidden" name="user_id" value="'.$_SESSION['id'].'">';
        echo "<input type=\"submit\" name=\"send\" value=\"Send order\">
        </form>";
        
    ?>


            

</body>

</html>
