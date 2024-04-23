<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_db.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $exists = false;

    // Check if any required field is empty
    if (empty($username) || empty($password) || empty($cpassword) || empty($gender) || empty($email)) {
        $showError = '<div class="alert alert-danger">All fields are required.</div>';
    } else {
        // Check if username or email already exists in the database
        $sql = "SELECT * FROM `users` WHERE `username`='$username' OR `email`='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $showError = '<div class="alert alert-danger">Username or email already exists.</div>';
        } else {
            if ($password == $cpassword) {
                $sql = "INSERT INTO `users` (`username`, `password`, `gender`, `date`, `email`) VALUES ('$username', '$password', '$gender', current_timestamp(), '$email')";
                if (mysqli_query($conn, $sql)) {
                    $showAlert = true;
                } else {
                    $showError = '<div class="alert alert-danger">Error in database insertion: ' . mysqli_error($conn) . '</div>';
                }
            } else {
                $showError = '<div class="alert alert-danger">Password does not match.</div>';
            }
        }
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
            display: <?php echo ($showAlert || $showError) ? 'block' : 'none'; ?>;
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
    if ($showAlert) {
        echo "Your account is now created. You can now <a href='login.php'>login</a>.";
    }
    if ($showError) {
        echo $showError;
    }
    echo '</div>';
    ?>

    <h2>Signup to our website</h2>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <!-- Username field -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <!-- Email field -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <!-- Password field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <!-- Confirm Password field -->
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="cpassword" required>
        <small>Make sure your password matches.</small>

        <!-- Gender field -->
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
            <option value="prefer-not-to-say">Prefer not to say</option>
        </select>

        <!-- Submit button -->
        <button type="submit">Sign Up</button>
        
    </form>

</body>

</html>