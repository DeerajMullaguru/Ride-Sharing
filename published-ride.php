<?php
include_once('include/header.php');

if(!$_SESSION['user']){
    header('location:login.php');
    exit();
}

$stmt=$connection->prepare("SELECT car,car_no FROM users WHERE id = ?");
$stmt->bind_param("s",$_SESSION['user']['id']);
$stmt->execute();
$result=$stmt->get_result();    
$row=$result->fetch_assoc();

if(isset($_POST['submit'])){
    $pickup=$_POST['pickup'];
    $drop=$_POST['drop'];
    $schedule_date=$_POST['schedule_date'];
    $passengers=$_POST['passengers'];
    $pick_time=$_POST['pick_time'];
    $drop_time=$_POST['drop_time'];
    $cost=$_POST['cost'];
    $status=1;
    $car=$_POST['car'];
    $car_no=$_POST['car_no'];

    $stmt1=$connection->prepare("INSERT INTO rides(added_by,pickup_location,drop_location,total_passenger,pickup_time,drop_time,schedule_date,cost,status,available_seats) VALUES(?,?,?,?,?,?,?,?,?,?)");
    $stmt1->bind_param("ssssssssss",$_SESSION['user']['id'],$pickup,$drop,$passengers,$pick_time,$drop_time,$schedule_date,$cost,$status,$passengers);
    $stmt1->execute();

    $stmt2=$connection->prepare("UPDATE users SET car = ?, car_no = ? WHERE id = ?");
    $stmt2->bind_param("sss",$car,$car_no,$_SESSION['user']['id']);
    if($stmt2->execute()){
        echo "<script>alert('Your Ride Is Published')
        window.location='my-published-rides.php';
        </script>";
    };
}

?>
<section class="login1 ride1">
    <div class="container">
        <div class="login-heading">
            <h1>Published A Ride</h1>
            <ul>
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li>
                    <a class="active" href="published-ride.php">Published Ride</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<section class="ride3 ">
    <div class="container ">
        <div class="book-form ">
            <form action="" method="POST">
                <h2 class="site-title">Published Your Ride in Minutes with <span>Smart Ride</span></h2>
                <p>Our fast and easy booking form allows you to quickly and easily reserve your ride, choose your
                    preferred vehicle type, and select your pickup and drop-off locations.</p>
                    <?php if($row['car'] == NULL && $row['car_no'] == NULL){ ?>
                <div class="input-wrap ">
                    <div class="form-group ">
                        <label for="Pick Up Location ">Car Name</label>
                        <input type="text" name="car" class="form-control" placeholder="Car Name" required>
                    </div>
                    <div class="form-group ">
                        <label for="Drop-off Location ">Car No</label>
                        <input type="text" name="car_no" class="form-control" placeholder="Car No" required>
                    </div>
                </div>
                <?php }else{ ?>
                    <div class="input-wrap ">
                    <div class="form-group ">
                        <label for="Pick Up Location ">Car Name</label>
                        <input type="text" class="form-control" name="car" value="<?php echo $row['car'] ?>" required>
                    </div>
                    <div class="form-group ">
                        <label for="Drop-off Location ">Car No</label>
                        <input type="text" class="form-control" name="car_no" value="<?php echo $row['car_no'] ?>" required>
                    </div>
                </div>
                <?php } ?>
                <div class="input-wrap ">
                    <div class="form-group ">
                        <label for="Pick Up Location ">Pick Up Location</label>
                        <input type="text" name="pickup" class="form-control" placeholder="Pick Up Location" required> <i
                            class="fa fa-map-marker "></i>
                    </div>
                    <div class="form-group ">
                        <label for="Drop-off Location ">Drop-off Location</label>
                        <input type="text" class="form-control" name="drop" placeholder="Drop-off Location" required> <i
                            class="fa fa-map-marker "></i>
                    </div>
                </div>
                <div class="input-wrap ">
                    <div class="form-group ">
                        <label for="Name">Schedule Date</label>
                        <input type="date" name="schedule_date" class="form-control" placeholder="Schedule Date" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Total Passengers</label>
                        <input type="number" name="passengers" class="form-control" min="1" Max="4" placeholder="Total Passengers" required>
                        <i class="fa fa-users"></i>
                    </div>
                </div>
                <div class="input-wrap">
                    <div class="form-group">
                        <label for="Pick Up Date">Pick Up Time</label>
                        <input type="time" name="pick_time" class="form-control" placeholder="Pick Up Date" required>
                    </div>
                    <div class="form-group ">
                        <label for="Pick Up Time ">Drop Time</label>
                        <input type="time" name="drop_time" class="form-control" placeholder="Pick Up Time" required>
                    </div>
                </div>
                <!-- <div class="input-wrap"> -->
                    <div class="form-group">
                        <label for="Pick Up Date ">Cost Per Seat</label>
                        <input type="number" name="cost" class="form-control" placeholder="Cost Per Seat" required>
                    </div>
                    <!-- <div class="form-group ">
                        <label for="Pick Up Time ">Drop Time</label>
                        <input type="time" class="form-control" placeholder="Pick Up Time">
                    </div> -->
                <!-- </div> -->
                <div class="login-text">
                    <div class="left">
                        <input type="checkbox">
                        <p>By using this form you agree to our terms & conditions. </p>
                    </div>
                </div>
                <button class="btn" name="submit">Published Your Ride <i class="fa fa-arrow-right"></i></button>
        </div>
</section>
<?php
include_once('include/footer.php');
?>