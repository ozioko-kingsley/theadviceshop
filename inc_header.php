<?php
// Start session only if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$filename = substr(strrchr($_SERVER['SCRIPT_NAME'], "/"), 1);
$name = substr($filename, 0, strrpos($filename, "."));
?>

<header id="pageHeader">
    <a href="index.php">
        <h1><span class="glyphicon glyphicon-ok"></span> The Advice Shop</h1>
    </a>

    <aside id="login">
        <?php 
        if (!empty($_SESSION['user_id']) && !empty($_SESSION['username'])) { 
            $username = htmlspecialchars($_SESSION['username']); // Ensure username is safely displayed

            echo "<p class='small'>Welcome, <strong>$username</strong></p>";
            echo "<form action='logout.php' method='post' style='display:inline;'>
                    <button type='submit' class='btn btn-danger'>Logout</button>
                    <button class='btn btn-danger'><a class='small' href='dashboard.php'>Dashboard</a></small></button>
                  </form>";
        } else {
            // If not logged in, show login form
            echo '
            <form action="login.php?page=' . htmlspecialchars($name) . '" method="post">
                <input name="username" id="username" type="text" placeholder="Username" required>
                <input name="password" id="password" type="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>';

            if ($filename !== "register.php") {
                echo '<small>In need of an account? Let\'s <a class="small" href="register.php">Get Started!</a></small>';
            }
        }
        ?>
    </aside>
</header>
