<?php
include_once('connection/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT r.available_seats,b.ride_id,b.total_tickets
    FROM rides r 
    INNER JOIN bookings b ON b.ride_id = r.id
    WHERE b.id = " . $id;

$stmt1=$connection->prepare($sql);
$stmt1->execute();
$result1=$stmt1->get_result();
$row1=$result1->fetch_assoc();

    $stmt=$connection->prepare("UPDATE bookings SET status = 0 WHERE id = ?");
    $stmt->bind_param("s",$id);
    if($stmt->execute()){

        $available_rides = $row1['available_seats'] + $row1['total_tickets'];
        $stmt2=$connection->prepare("UPDATE rides SET status = 1, available_seats = ? WHERE id = ?");
        $stmt2->bind_param("ss",$available_rides,$row1['ride_id']);
        if($stmt2->execute()){
            echo "<script>alert('Ride Decline')
            window.location='my-published-rides.php';
            </script>";
        }
    };



}
?>