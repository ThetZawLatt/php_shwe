<?php
require_once 'connection.php';

// Registration form handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
 $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        echo "<p>*User already registered with this number!<p>";
        
    } else {
        $sqlLogin = "INSERT INTO users (name, phone, password) VALUES ('$name', '$phone', '$password')";

    if ($conn->query($sqlLogin) === TRUE) {
        
       
        
        header("Location: index.php"); 
            exit();
    } else {
        echo "Error: " . $sqlLogin . "<br>" . $conn->error;
    }
        
    }
   
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <style>
    p{
        color:red;
    }
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
            margin: 0 auto; /* Center align text input and button */
            border-radius: 5px; /* Add border radius to input fields */
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
    <h2>Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label><input type="text" name="name"><br><br>
        <label for="phone">Phone:</label><input type="text" name="phone"><br><br>
        <label for="password">Password:</label><input type="password" name="password"><br><br>
        <input type="submit" name="register" value="Register">
    </form>

    <p>Already registered? <a href="index.php">Login here</a></p>
</body>
</html>
