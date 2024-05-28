<?php
header('Content-Type: application/json');
require_once 'connection.php';
// Validate Token
// $expectedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2JtaWFncmkuY29tL2FwaS9sb2dpbiIsImlhdCI6MTcwOTg3MjI2NSwibmJmIjoxNzA5ODcyMjY1LCJqdGkiOiJ2UjFQTVpwTktrelRZU2pvIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.70rDlI1IHMF33ot4_Knl98oSW8VYczGsILY5rKN2IOU';
// $receivedToken = $_SERVER['HTTP_AUTHORIZATION'];

// if ($receivedToken != $expectedToken) {
//     http_response_code(401); // Unauthorized
//     echo json_encode(array("message" => "Unauthorized"));
//     exit();
// }

// Registration form handling

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password=$_POST['password'];
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $result=array(
            "code"=>201,
            "msg"=>"User already exist",
            "data"=>array(
                'name' => $name,
        'phone' => $phone)
            
            );
        echo json_encode($result);
        
    } else {
        $sqlLogin = "INSERT INTO users (name, phone, password) VALUES ('$name', '$phone', '$password')";

    if ($conn->query($sqlLogin) === TRUE) {
        
        $data = (array(
        'name' => $name,
        'phone' => $phone
        ));
        $result=array(
            "code"=>200,
            "msg"=>"Registration successful!",
            "data"=>$data
            );
        echo json_encode($result);
    } else {
        echo "Error: " . $sqlLogin . "<br>" . $conn->error;
    }
        
    }
    


?>