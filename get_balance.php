<?php
header('Content-Type: application/json');
require_once 'connection.php';

if(isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    
    $sql = "SELECT balance FROM balance WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
         $data = array(
                'balance' => $row['balance'],
                'phone' => $phone
                );        
           
        
        $result=array(
            "code"=>200,
            "msg"=>"successful!",
            "data"=>$data
            
            );
        echo json_encode($result);
    } else {
        echo "User balance not found";
    }
}
?>
