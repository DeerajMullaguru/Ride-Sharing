<?php
include_once('include/header.php');

if(empty($_SESSION['user'])){
    header('location:login.php');
    exit();
}

if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $pick = $_POST['pick'];
    $drop = $_POST['drop'];

    $sql = "SELECT u.name,u.car,u.car_no,r.*
    FROM users u 
    INNER JOIN rides r ON r.added_by = u.id
    WHERE r.schedule_date = ? AND r.pickup_location = ? AND r.drop_location = ?";
    
    $stmt=$connection->prepare($sql);
    $stmt->bind_param("sss",$date,$pick,$drop);
    $stmt->execute();
    $result=$stmt->get_result();

}else{

    
    $sql = "SELECT u.name,u.car,u.car_no,r.*
FROM users u 
INNER JOIN rides r ON r.added_by = u.id
WHERE r.schedule_date >= CURDATE()";

$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->get_result();

}
?>
    <section class="login1 services1">
        <div class="container">
            <div class="login-heading">
                <h1>All Rides</h1>
                <ul>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="active" href="all-rides.php">All-Rides</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="taxi-rate">
        <div class="container">
            <div class="title">
                <h2 class="site-title">Available Rides</h2>
            </div>
            <div class="rate-wrap">
                <div class="row">
                    <?php 
                    if($result->num_rows > 0){
                    while($row=$result->fetch_assoc()){ ?>
                    <div class="col4">
                        <div class="rate-box">
                            <div class="image">
                                <img src="img/taxi.png" alt="rate" title="ride">
                            </div>
                            <div class="rate-text">
                                <h4><?php echo $row['name'] ?></h4>
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
                                    <span><i class="fa fa-calendar"></i> Pickup Time: </span><span> <?php echo date("h:i A",strtotime($row['pickup_time'])) ?> </span>
                                </li>
                                <li>
                                    <span><i class="fa fa-calendar"></i> Drop Time: </span><span> <?php echo date("h:i A",strtotime($row['drop_time'])) ?> </span>
                                </li>
                            </ul>
                            <?php if($row['status'] == 1){ ?>
                            <div class="rate-btn"> <a class="btn" href="book-ride.php?id=<?php echo $row['id']; ?>&_id=<?php echo md5(rand(15,8)) ?>">Book Now <i
                                        class="fa fa-arrow-right"></i></a></div>
                                        <?php } ?>
                            <?php if($row['status'] == 2){ ?>
                            <div class="rate-btn"> <a class="btn" href="#">Full <i
                                        class="fa fa-arrow-right"></i></a></div>
                                        <?php } ?>
                        </div>
                    </div>                    
                    <?php } ?>
                    <?php }else{ ?>
                        <div class="col12">
                        <div class="rate-box test">
                            <h2>No Rides Found</h2>
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