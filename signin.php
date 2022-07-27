<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNIN</title>
    <link rel="stylesheet" href="./css/app.css"> 
</head>

<body>
    <?php
        require_once "./header.php";
    ?>
    <form action="./register.php" method="post">
        <h2>Signin</h2>
        <?php 
        $errors = $_GET;
        foreach ($errors as $key => $error) {
            echo "<ul class='error' style='list-style-type:none'>";
            foreach ($error as $value) {
                echo "<li>$value</li>";
            }
            echo "</ul>";
        }
        ?>
        <label>User Name</label>
        <input type="text" name="username" placeholder="User Name"><br>
        <label>Email</label>
        <input type="email" name="email" placeholder="Email"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="submit">SignIn</button> 
    </form>
</body>
</html>