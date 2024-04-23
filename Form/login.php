<?php
$login = false;
$showError = false;

include '_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $username = $_POST['username'];
        // Check for user with provided email and password
        $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $login = true;
            session_start();
            $_SESSION['logedin']=true;
            $_SESSION['username']=$username;
            header("location:home.php");
        } else {
            $showError = '<div class="alert alert-danger">Invalid email or password.</div>';
        }
    }
?>


<!DOCTYPE html>
<html>

<head>
    <title>Signup Form</title>
    <style>
        /* Optional: Add some basic styling for the form */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        #alert {
            display: <?php echo $showError ? 'block' : 'none'; ?>;
            /* Show if there's an alert */
            color: <?php echo $showError ? 'red' : 'green'; ?>;
            /* Red for error, green for success */
            padding: 10px;
            border: 1px solid <?php echo $showError ? 'red' : 'green'; ?>;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<?php
    echo '<div id="alert">';
    if ($login) {
        echo "You are logedin.";
    }
    if ($showError) {
        echo $showError;
    }
    echo '</div>';
    ?>

    <h2>Login to our website</h2>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <!-- Email field -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <!-- Password field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <!-- Submit button -->
        <button type="submit">Login</button>
    </form>

</body>

</html>