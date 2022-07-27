<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./css/app.css"> 
     
</head>

<body>
    <?php
        require_once "./header.php"
    ?>
    <form action="./authentificator.php" method="post">
        <h2>LOGIN</h2>
        <?php 
        $errors = $_GET;
        foreach ($errors as $key => $error) {
            echo "<ul class='error' style='list-style-type:none'>";
            if($key=='succes')
           echo "<li>Acum va puteti loga</li>";
           else
            foreach ($error as $value) {
                echo "<li>$value</li>";
            }
            echo "</ul>";
        }
        ?>
        <label>User Name</label>
        <input type="text" name="emailOrUsername" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="submit">Login</button> 
    </form>
</body>
</html>