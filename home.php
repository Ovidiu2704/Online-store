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
        require_once './database_connector.php';
        $conn = DatabaseConnector::getInstance()->getConnection();
        $sql = "SELECT * FROM products";
        $data = $conn->query($sql);
        echo "<div class=\"grid-container\">";
        while ($row = $data->fetch_assoc()) {
            echo "
            <div class=\"data__table\">
            <div class=\"img__wrapper\"><img src=\"$row[path]\" alt=\"pestemare\"  height=\"300\"></div>
            <br>
           <p class=\"data__row\"> Name: $row[name] </p>
           <p class=\"data__row\"> Price: $row[price] </p>
           <p class=\"data__row\"> Stock: $row[quantity] </p>
            </div> ";
        

        }
        echo "</div>";
    ?>

        

        

</body>

</html>