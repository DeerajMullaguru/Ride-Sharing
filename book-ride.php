<?php
include_once('include/header.php');

if(empty($_SESSION['user'])){
    header('location:login.php');
    exit();
}

if(empty($_GET['id'])){
    header('location:home.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = "SELECT * FROM rides WHERE id = " . $id;
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(isset($_POST['submit'])){
    $tickets = $_POST['tickets'];
    $payment = $_POST['payment'];
    $status = 1;

    $stmt1=$connection->prepare("INSERT INTO bookings (user_id,ride_id,total_tickets,payment_type,status) VALUES(?,?,?,?,?)");
    $stmt1->bind_param("sssss",$_SESSION['user']['id'],$id,$tickets,$payment,$status);
    if($stmt1->execute()){
        $ava_seats = $row['available_seats'] - $tickets;
        $stmt2=$connection->prepare("UPDATE rides SET available_seats = ? WHERE id = ?");
        $stmt2->bind_param("ss",$ava_seats,$id);
        if($stmt2->execute()){
            $stmt3=$connection->prepare("SELECT * FROM rides WHERE id = ?");
            $stmt3->bind_param("s",$id);
            $stmt3->execute();
            $result3=$stmt3->get_result();
            $row3=$result3->fetch_assoc();

            if($row3['available_seats'] == 0){
                $stmt4=$connection->prepare("UPDATE rides SET status = 2 WHERE id = ?");
                $stmt4->bind_param("s",$id);
                if($stmt4->execute()){
                    echo "<script>alert('Ride Is Booked')
                    window.location='my-bookings.php';
                    </script>";
                    exit();
                }
            }else{
                echo "<script>alert('Ride Is Booked')
                window.location='my-bookings.php';
                </script>";
                exit();
            }
        }

    }

}

?>
<section class="login1 ride1">
    <div class="container">
        <div class="login-heading">
            <h1>Book A Ride</h1>
            <ul>
                <li>
                    <a href="home.html">Home</a>
                </li>
                <li>
                    <a class="active" href="book-ride.html">Book A Ride</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="ride3 ">
    <div class="container ">
        <div class="book-form ">
            <form action="" method="POST">
                <h2 class="site-title">Book Your Ride in Minutes with <span>Smart Ride</span></h2>
                <p>Our fast and easy booking form allows you to quickly and easily reserve your ride, choose your
                    preferred vehicle type, and select your pickup and drop-off locations.</p>
                    <input type="hidden" id="cost" value="<?php echo $row['cost'] ?>">
                <div class="input-wrap ">
                    <div class="form-group ">
                        <label for="Pick Up Location ">Pick Up Location</label>
                        <input type="text " class="form-control " value="<?php echo $row['pickup_location'] ?>"
                            placeholder="Pick Up Location " readonly> <i class="fa fa-map-marker "></i>
                    </div>
                    <div class="form-group ">
                        <label for="Drop-off Location ">Drop-off Location</label>
                        <input type="text" class="form-control" value="<?php echo $row['drop_location'] ?>"
                            placeholder="Drop-off Location " readonly> <i class="fa fa-map-marker "></i>
                    </div>
                </div>
                <div class="input-wrap">
                    <div class="form-group">
                        <label for="Pick Up Date ">Pick Up Time</label>
                        <input type="date " class="form-control"
                            value="<?php echo date("h:i A", strtotime($row['pickup_time'])) ?>"
                            placeholder="Pick Up Date " readonly>
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="form-group ">
                        <label for="Pick Up Time ">Drop Time</label>
                        <input type="time " class="form-control"
                            value="<?php echo date("h:i A", strtotime($row['drop_time'])) ?>" placeholder="Pick Up Time "
                            readonly> <i class="fa fa-clock-o"></i>
                    </div>
                </div>
                <div class="input-wrap ">
                    <div class="form-group ">
                        <label for="Pick Up Location">Total Seats</label>
                        <input type="number" name="tickets" id="tickets" class="form-control" placeholder="Total Seats" min="1" max="<?php echo $row['available_seats'] ?>" required>
                    </div>
                    <div class="form-group ">
                        <label for="Drop-off Location">Total Cost</label>
                        <input type="text" id="totalcost" class="form-control" placeholder="Cost" readonly>
                    </div>
                </div>
                    <div class="form-group ">
                        <label for="Pick Up Time ">Payment</label>
                        <select class="form-control " name="payment" id="Payment " required>
                            <option value="">Payment</option>
                            <option value="upi">UPI</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                <div class="login-text">
                    <div class="left">
                        <input type="checkbox">
                        <p>By using this form you agree to our terms & conditions. </p>
                    </div>
                </div>
                <button class="btn " name="submit">Book Your Ride <i class="fa fa-arrow-right"></i></button>
        </div>
</section>
<?php
include_once('include/footer.php');
?>