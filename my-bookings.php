<?php
include_once('include/header.php');

// print_r(date("h:i:s"));
// exit;

if(empty($_SESSION['user'])){
    header('location:login.php');
    exit();
}

$sql = "SELECT u.car,u.car_no,u.name,r.pickup_location,r.drop_location,r.schedule_date,r.pickup_time,r.drop_time,r.cost,b.*
FROM bookings b
INNER JOIN rides r ON r.id = b.ride_id
INNER JOIN users u ON u.id = r.added_by
WHERE b.user_id = " . $_SESSION['user']['id'];

$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->get_result();

?>
    <section class="login1 services1">
        <div class="container">
            <div class="login-heading">
                <h1>Booked Rides</h1>
                <ul>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="active" href="#">Booked-Rides</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="taxi-rate">
        <div class="container">
            <div class="title">
                <h2 class="site-title">Booked Rides</h2>
            </div>
            <div class="pub_btn">
                <a class="btn" href="all-rides.php">Book A New Ride</a>
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
                                    <span><i class="fa fa-user-o"></i> Total Tickets: </span><span> <?php echo $row['total_tickets'] ?> </span>
                                </li>
                                <li>
                                    <span><i class="fa fa-user-o"></i> Status: </span><span> <?php if($row['schedule_date'] > date('Y-m-d')){ if($row['status'] == 1){ echo "Approve"; }elseif($row['status' == 0]){ echo "Decline"; } }else{ echo "Ride Complete"; } ?> </span>
                                </li>
                                <li>
                                    <span>
                                        <i class="fa fa-calendar"></i> Schedule Date: </span><span> <?php echo date("d-M-y",strtotime($row['schedule_date'])) ?> </span>
                                </li>
                                <li>
                                    <span><i class="fa fa-calendar"></i> Timings: </span><span> <?php echo date("h:i A",strtotime($row['pickup_time'])) ." - ". date("h:i A",strtotime($row['drop_time'])) ?> </span>
                                </li>
                            </ul>
                            <?php if($row['is_review'] == 0){if($row['schedule_date'] < DATE("Y-m-d")){ ?>
                            <div class="rate-btn"> <a class="btn" href="feedback.php?id=<?php echo $row['id'] ?>&_id=<?php echo md5(rand(10,5)) ?>">Review You Ride<i
                                        class="fa fa-arrow-right"></i></a></div>
                                        <?php } } ?>
                                      
                        </div>
                    </div>                    
                    <?php } ?>
                    <?php }else{ ?>
                        <div class="col12">
                        <div class="rate-box test">
                            <h2>No Bookings Yet ! Book A New Ride</h2>
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