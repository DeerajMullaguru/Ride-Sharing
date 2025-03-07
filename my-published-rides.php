<?php
include_once('include/header.php');

if(empty($_SESSION['user'])){
    header('location:login.php');
    exit();
}

$sql = "SELECT u.car,u.car_no,r.*
FROM rides r
INNER JOIN users u ON u.id = r.added_by
WHERE r.added_by = " . $_SESSION['user']['id'];

$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->get_result();

?>
    <section class="login1 services1">
        <div class="container">
            <div class="login-heading">
                <h1>Published Rides</h1>
                <ul>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="active" href="#">Published-Rides</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="taxi-rate">
        <div class="container">
            <div class="title">
                <h2 class="site-title">Published Rides</h2>
            </div>
            <div class="pub_btn">
                <a class="btn" href="published-ride.php">Publish A New Ride</a>
            </div>
            <div class="rate-wrap">
                <div class="row">
                    <?php 
                    if($result->num_rows > 0){
                    while($row=$result->fetch_assoc()){ ?>
                    <div class="col6">
                        <div class="rate-box">
                            <div class="rate-text">
                                <h4><?php echo $row['car'] ."-". $row['car_no']?></h4>
                                <p class="price">$<?php echo $row['cost'] ?></p>
                            </div>
                            <ul>
                                <li>
                                    <span><i class="fa fa-road"></i> Route: </span><span> <?php echo $row['pickup_location'] ." - ". $row['drop_location'] ?> </span>
                                </li>
                                <li>
                                    <span><i class="fa fa-user-o"></i> Passengers: </span><span> <?php echo $row['total_passenger'] ?> </span>
                                </li>
                                <li>
                                    <span><i class="fa fa-user-o"></i> Available Seats: </span><span> <?php echo $row['available_seats'] ?> </span>
                                </li>
                                <li>
                                    <span>
                                        <i class="fa fa-calendar"></i> Schedule Date: </span><span> <?php echo date("d-M-y",strtotime($row['schedule_date'])) ?> </span>
                                </li>
                                <li>
                                    <span><i class="fa fa-calendar"></i> Timings: </span><span> <?php echo date("h:i A",strtotime($row['pickup_time'])) ." - ". date("h:i A",strtotime($row['drop_time'])) ?> </span>
                                </li>
                            </ul>
                            <div class="rate-btn"> <a class="btn" href="ride_passengers.php?id=<?php echo $row['id'] ?>&_id=<?php echo md5(rand(10,5)) ?>">View Details <i
                                        class="fa fa-arrow-right"></i></a></div>
                                      
                        </div>
                    </div>                    
                    <?php } ?>
                    <?php }else{ ?>
                        <div class="col12">
                        <div class="rate-box test">
                            <h2>No Rides Published Yet</h2>
                        </div>
                    </div> 
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    
   <?php
include_once('include/footer.php');
?>