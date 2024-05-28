<?php
include 'connection.php';

$itemsPerPage = 20; // Number of items to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

$start = ($page - 1) * $itemsPerPage; // Calculate the starting point

$userSql = "SELECT * FROM balance LIMIT $start, $itemsPerPage";
$result = $conn->query($userSql);

$topUpMessage = ""; // Initialize the top-up message variable

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<title>User Balance List</title>';
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
echo '<h2>User Balance List</h2>';
echo '<table border="1">';
echo '<tr><th>Name</th><th>Phone</th><th>Balance</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['balance'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="2">No users found</td></tr>';
}

echo '</table>';

// Pagination links
$totalItemsSql = "SELECT COUNT(*) AS total FROM balance";
$totalItemsResult = $conn->query($totalItemsSql);
$totalItems = $totalItemsResult->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

if ($totalPages > 1) {
    echo '<br><br>';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
    }
}

echo '<br><br>';
echo '<a href="home.php" class="button">
        
        <span>Home</span>
    </a>';
echo '</form>';

echo '</body>';
echo '</html>';

$conn->close();
?>
