<?php
include 'connection.php';

$userSql = "SELECT * FROM users";
$result = $conn->query($userSql);

$topUpMessage = ""; // Initialize the top-up message variable

if(isset($_POST['topup'])) {
    $user_phone = $_POST['user_phone'];
    $amount = $_POST['amount'];
    
    // Use prepared statements to prevent SQL injection
    $stmt_check = $conn->prepare("SELECT * FROM balance WHERE phone = ?");
    $stmt_check->bind_param("s", $user_phone);
    $stmt_check->execute();
    $checkResult = $stmt_check->get_result();
    
    
}

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>User List</title>';
echo '<style>
    body {
        text-align: center;
        background-color: #f0f0f0;
        font-family: Arial, sans-serif;
    }
    table {
        margin: 0 auto;
    }
    th {
        background-color: #2ecc71; /* Green color */
        color: white;
        padding: 10px;
    }
    select, input[type="text"], button {
        padding: 8px;
        margin: 5px;
        border-radius: 5px;
    }
    button {
        background-color: #2ecc71; /* Green color */
        color: white;
        border: none;
        border-radius: 5px;
    }
</style>';
echo '</head>';
echo '<body>';
echo '<h2>User List</h2>';
echo '<table border="1">';
echo '<tr><th>Name</th><th>Phone</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="2">No users found</td></tr>';
}

echo '</table>';


echo '<br><br>';
echo '<a href="home.php" class="button">
        
        <span>Home</span>
    </a>';
echo '</form>';



echo '</body>';
echo '</html>';

$conn->close();
?>
