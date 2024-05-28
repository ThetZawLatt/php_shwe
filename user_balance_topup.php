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
    
    if($checkResult->num_rows > 0) {
        // If the user exists, update the balance
        $stmt_update = $conn->prepare("UPDATE balance SET balance = balance + ? WHERE phone = ?");
        $stmt_update->bind_param("is", $amount, $user_phone);
        
        if ($stmt_update->execute()) {
            $topUpMessage = "Balance updated successfully!";
        } else {
            $topUpMessage = "Error updating balance: " . $conn->error;
        }
    } else {
        // If the user does not exist, insert a new record
        $stmt_insert = $conn->prepare("INSERT INTO balance (name, phone, balance) SELECT name, phone, ? FROM users WHERE phone = ?");
        $stmt_insert->bind_param("is", $amount, $user_phone);
        
        if ($stmt_insert->execute()) {
            $topUpMessage = "Top up successful!";
        } else {
            $topUpMessage = "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
}

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>Top Up User Balance</title>';
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

echo '<h2>Select User and Enter Amount to Top Up</h2>';
echo '<form method="post">';
echo '<select name="user_phone">';
// Populate this dropdown with user phone numbers from the user table
if ($result->num_rows > 0) {
    $result = $conn->query($userSql); // Rewind the result set
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['phone'] . '">' . $row['name'] . ' - ' . $row['phone'] . '</option>';
    }
}
echo '</select>';
echo '<input type="text" name="amount" placeholder="Enter Amount">';
echo '<button type="submit" name="topup">Top Up</button>';
echo '<br><br>';
echo '<a href="home.php" class="button">
        
        <span>Home</span>
    </a>';
echo '</form>';

// Display top-up message
if(!empty($topUpMessage)) {
    echo '<h2>' . $topUpMessage . '</h2>';
}

echo '</body>';
echo '</html>';

$conn->close();
?>
