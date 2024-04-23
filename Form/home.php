<?php
session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome <?php echo $_SESSION['username']?></title>
    <style>
        /* CSS for navbar */
        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* CSS for page content */
        .content {
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="feature.php">Features</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="login.php" style="float: right;">Logout</a>
    </div>

    <div class="content">
        <!-- Page content goes here -->
        <h2>Page Content</h2>
        <p>This is the content of the page. You can add your HTML content here.</p>
    </div>

</body>

</html>
