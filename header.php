<header>
    <nav>
        <ul>
            
            <?php
            session_start();
            if(!isset($_SESSION["logged_in"]))
            {
                echo "<li>
                <a href=\"./home.php\">Homepage</a>
            </li>
                <li>
                <a href=\"./login.php\">Login</a>
            </li>
            <li>
                <a href=\"./signin.php\">SignIn</a>
            </li>";
            }
            else{
            echo "<li>
                <a href=\"./1home.php\">Homepage</a>
            </li>"; 
             echo "<li>
            <a href=\"./cart.php\">Cart</a>
            </li>";
            }
            if(isset($_SESSION['is_admin'])&&$_SESSION['is_admin']==1)
            {
                echo "<li>
                <a href=\"./dashboard.php\">Users</a>
            </li>
            <li>
                <a href=\"./products.php\">Products</a>
            </li>";
            }
            if(isset($_SESSION["logged_in"])&&$_SESSION["logged_in"]==true)
            echo " 
            <li>
            <a href=\"./logout.php\">Logout</a>
            </li>";
            
            ?>
        </ul>
    </nav>
</header>