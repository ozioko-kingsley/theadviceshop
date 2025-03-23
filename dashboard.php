<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Example user data (fetch from the session or database)
$username = $_SESSION['username'] ?? 'Guest';
$user_email = $_SESSION['email'] ?? 'No Email';

// Function to display recent activities
function displayActivities($activities) {
    echo "<ul>";
    foreach ($activities as $activity) {
        echo "<li>$activity</li>";
    }
    echo "</ul>";
}

// Sample array for recent activities
$recent_activities = [
    "Logged in successfully",
    "Updated profile details",
    "Browsed product catalog",
    "Checked out the latest blog post"
];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Advice Shop - Dashboard</title>
    <link href="styles/formstyles.css" rel="stylesheet" type="text/css" media="screen">
    <link href="styles/mainstyles.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>

<?php include("inc_header.php"); ?>
<?php include("inc_nav.php"); ?>

<section id="content">
    <h2>Welcome to Your Dashboard, <?= htmlspecialchars($username) ?>!</h2>

    <p>Email: <?= htmlspecialchars($user_email) ?></p>

    <h3>Your Recent Activities:</h3>
    <?php displayActivities($recent_activities); ?>

    <?php if ($username !== "Guest"): ?>
        <p><a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="index.php">Login</a></p>
    <?php endif; ?>
</section>

<?php include("inc_footer.php"); ?>

</body>
</html>
