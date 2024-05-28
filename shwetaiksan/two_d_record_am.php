<?php
// Database connection details
header('Content-Type: application/json');
include 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    return htmlspecialchars(stripslashes(trim($data)));
}

// Get the raw POST data
$input = file_get_contents('php://input');
$inputData = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode([
        "code" => 400,
        "msg" => "Invalid JSON data"
    ]));
}

// Extract and sanitize input values
$phone = sanitizeInput($inputData['phone'] ?? '');
$amounts = array_map('intval', $inputData['amount'] ?? []);
$numbers = array_map('intval', $inputData['number'] ?? []);
$date = sanitizeInput($inputData['date'] ?? '');

if (empty($phone) || empty($amounts) || empty($numbers) || empty($date)) {
    die(json_encode([
        "code" => 400,
        "msg" => "Missing required fields"
    ]));
}

if (count($amounts) !== count($numbers)) {
    die(json_encode([
        "code" => 400,
        "msg" => "Amounts and numbers count mismatch"
    ]));
}

// Check if phone number exists in user table
$sql_check = "SELECT * FROM users WHERE phone = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $phone);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // Phone number exists, insert data into two_d_record_am table
    $stmt_insert = $conn->prepare("INSERT INTO two_d_record_am (phone, amount, number, date) VALUES (?, ?, ?, ?)");
    
    $errors = [];
    for ($i = 0; $i < count($amounts); $i++) {
        $amount = $amounts[$i];
        $number = $numbers[$i];

        // Binding parameters
        $stmt_insert->bind_param("siss", $phone, $amount, $number, $date);

        if (!$stmt_insert->execute()) {
            $errors[] = "Error inserting record for number: $number and amount: $amount";
        }
    }

    if (empty($errors)) {
        $data = array(
            'phone' => $phone,
            'date' => $date
        );
        $result = array(
            "code" => 200,
            "msg" => "Transaction successful!",
            "data" => $data
        );
        echo json_encode($result);
    } else {
         $data = array(
            'phone' => $phone,
            'date' => $date
        );
        $result = array(
            "code" => 201,
            "msg" => "Some records could not be inserted.",
            "data" => $data
        );
        echo json_encode($result);
    }
} else {
    // Phone number does not exist
    $result = array(
        "code" => 404,
        "msg" => "Error: Phone number does not exist in the user table."
    );
    echo json_encode($result);
}

// Close the statement and connection
$stmt_check->close();
$stmt_insert->close();
$conn->close();
?>
