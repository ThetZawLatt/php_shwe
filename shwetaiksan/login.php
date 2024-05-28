<?php
header('Content-Type: application/json');
require_once 'connection.php';
 $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password== $row['password']) {
            // Login successful, start a session
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
        $data = array(
                'name' => $row['name'],
                'phone' => $phone
                );        
           
        
        $result=array(
            "code"=>200,
            "msg"=>"Login successful!",
            "data"=>$data
            
            );
        echo json_encode($result);
        } else {
            $data = array(
                'name' => $row['name'],
                'phone' => $phone
                );        
           
        
        $result=array(
            "code"=>201,
            "msg"=>"Invalid password!",
            "data"=>$data
            
            );
            echo json_encode($result);
        }
    } else {
          $data = array(
                'name' => $row['name'],
                'phone' => $phone
                );        
           
        
        $result=array(
            "code"=>201,
            "msg"=>"Invalid phone or password.",
            "data"=>$data
            
            );
            echo json_encode($result);
        
    }
    ?>