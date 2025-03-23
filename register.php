<?php
include 'config.php';

$message = ""; // Variable to store feedback messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if username or email already exists
    $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $message = '<div class="alert error">Username or Email is already in use. Please try another.</div>';
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $message = '<div class="alert success">Registration successful! <a href="login.php">Login here</a></div>';
            header("refresh:2;url=dashboard.php"); // Redirect to login page after 2 seconds
        } else {
            $message = '<div class="alert error">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }

    $check_stmt->close();
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
<?php include("inc_header.php"); ?>
<?php include("inc_nav.php"); ?>

<section id="content">
    <h1>Registration Form</h1>

    <?php echo $message; // Display success or error message ?>

    <form class="form" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</section>

<?php include("inc_footer.php"); ?>
</body>
</html>
