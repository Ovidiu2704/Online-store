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
    require_once './basic_cruds_users.php';
        $conn = DatabaseConnector::getInstance()->getConnection();
        $sql = "SELECT * FROM users";
        $data = $conn->query($sql);
        while ($row = $data->fetch_assoc()) {
            echo 'ID: '.$row['id'];
            echo '<form action="admin_actions_users.php" method="post">';
            echo '<input type="hidden" name="id" value="'.$row['id'].'">';
            echo '<input type="text" name="name" value="'.$row['name'].'">';
            echo '<input type="text" name="email" value="'.$row['email'].'">';
            echo '<input type="hidden" name="password" value="'.$row['password'].'">';
            echo '<input type="submit" name="edit_user" value="Edit User">';
            echo '<input type="submit" name="delete_user" value="Delete User">';
            echo '</form>';
        }
        echo "<form action=\"./admin_actions_users.php\" method=\"post\">
    <h2>Add User</h2>
    <label>User Name</label>
    <input type=\"text\" name=\"name\" placeholder=\"User Name\"><br>
    <label>Email</label>
    <input type=\"text\" name=\"email\" placeholder=\"Email\"><br>
    <label>Password</label>
    <input type=\"password\" name=\"password\" placeholder=\"Password\"><br>
    <button type=\"submit\" name=\"add_user\">Add</button>
</form>";
        
    ?>


            

</body>

</html>
