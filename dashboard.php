<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>The Advice Shop - Register</title>
    <link href="styles/formstyles.css" rel="stylesheet" type="text/css" media="screen">
    <link href="styles/mainstyles.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<?php
//session_start(); // Start session at the very top

$filename = substr(strrchr($_SERVER['SCRIPT_NAME'], "/"), 1);
$name = substr($filename, 0, strrpos($filename, "."));
?>

<?php include("inc_header.php"); ?>
<?php include("inc_nav.php"); ?>
<section id="content">
    <h2>Welcome to the Dashboard</h2>
    <p>You are logged in! <?= $username ?></p>
    <a href="index.php">Logout</a>
</section>

<?php include("inc_footer.php"); ?>
</body>
</html>

