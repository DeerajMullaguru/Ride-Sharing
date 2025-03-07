<?php
include_once('connection/connection.php');

if(isset($_POST) == "bookings"){
    $id = $_POST['id'];

    $sql = "SELECT u.name,b.*
    FROM bookings b 
    INNER JOIN users u ON u.id = b.user_id
    WHERE b.ride_id = " . $id;

    $stmt=$connection->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    // $row=$stmt->fetch_assoc();
    while($row=$result->fetch_assoc()){
        echo json_encode($row);
    }
    
}

?>