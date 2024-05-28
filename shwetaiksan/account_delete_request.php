<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Delete Your Account</h2>
    <form method="post" action="">
        <label for="user_id">Enter Your User ID:</label><br>
        <input type="text" id="user_id" name="user_id"><br><br>
        <input type="submit" value="Delete Account">
    </form>

    <?php
    // Database connection parameters
  // header('Content-Type: application/json');
require_once 'connection.php';
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user ID from the form and sanitize input
        $user_id = $conn->real_escape_string($_POST['user_id']);

        // SQL query with prepared statement to delete the account from the users table
        $stmt = $conn->prepare("DELETE FROM users WHERE phone = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo "Account with ID $user_id deleted successfully.";
        } else {
            echo "Error deleting account: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
