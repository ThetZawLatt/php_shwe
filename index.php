<?php
require_once 'connection.php';
// Login form handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Login successful, start a session
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: home.php"); 
            exit();
        } else {
            $loginError = "Invalid phone or password.";
        }
    } else {
        $loginError = "Invalid phone or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            text-align: center;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        form {
            margin: 20px auto;
            width: 300px;
            padding: 20px;
            border: 2px solid #333;
            border-radius: 10px;
            text-align: left; /* Align labels to the left */
        }
        input {
            margin-bottom: 10px;
            padding: 5px;
            display: block;
            border-radius: 5px;
            margin: 0 auto; /* Center align text input and button */
        }
        label {
            display: inline-block;
            width: 80px; /* Adjust width as needed */
            text-align: left; /* Align label text to left */
            vertical-align: middle; /* Vertical alignment to center */
        }
        input[type="text"],
        input[type="password"] {
            display: inline-block;
            vertical-align: middle; /* Vertical alignment to center */
            width: 200px; /* Adjust width as needed */
        }
        input[type="submit"] {
            background-color: green; /* Green color for the button */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #888; /* Grey color on hover */
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="phone">Phone:</label><input type="text" name="phone"><br><br>
        <label for="password">Password:</label><input type="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
    </form>
    
    <p>Not registered yet? <a href="register_page.php">Register here</a></p>
    
    <?php if(isset($loginError)) { echo '<p style="color: red;">' . $loginError . '</p>'; } ?>
</body>
</html>
