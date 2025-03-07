<?php
include_once('include/header.php');

$sql = "SELECT u.name,u.car,u.car_no,r.*
FROM users u 
INNER JOIN rides r ON r.added_by = u.id
WHERE r.schedule_date >= CURDATE()
ORDER BY r.schedule_date ASC";

$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->get_result();

?>
    <section class="hero-section">
        <div class="container">
            <div class="hero-title">
                <span class="title-tagline">
                    Welcome to Smart Ride
                </span>
                <h1>Your <span>Ride</span> your <span>Way</span></h1>
                <p>Say goodbye to long waits and expensive rides. Our app connects you with reliable drivers for safe
                    and affordable transportation. Book a ride in seconds and enjoy a hassle-free experience.</p>
                <div class="title-btn"> <a class="btn" href="all-rides.php"><i class="fa fa-taxi"></i> Book Now!</a> <a
                        class="btn btn1" href="about.php"><i class="fa fa-arrow-right"></i> Learn More</a></div>
            </div>
        </div>
    </section>
    <div class="hero-form">
        <div class="container">

            <form action="all-rides.php" method="POST">
            <div class="form-group">
                        <label for="Pick Up Date">Schedule Date</label>
                        <input type="date" name="date" class="form-control" placeholder="Pick Up Date" required>
                        <i class="fa fa-calendar"></i>
                    </div>
                <div class="input-wrap">
                    <div class="form-group">
                        <label for="Pick Up Location">Pick Up Location</label>
                        <input type="text" name="pick" class="form-control" placeholder="Pick Up Location" required> <i
                            class="fa fa-map-marker"></i>
                    </div>
                    <div class="form-group">
                        <label for="Drop-off Location">Drop-off Location</label>
                        <input type="text" name="drop" class="form-control" placeholder="Drop-off Location" required> <i
                            class="fa fa-map-marker"></i>
                    </div>
                </div>
                <div class="book-btn"> <button class="btn" name="submit"><i class="fa fa-taxi"></i> Search Now!</button>
                </div>
            </form>
        </div>
    </div>
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col6">
                    <div class=colleft>
                        <span class="title-tagline">
                            ABOUT US
                        </span>
                        <h2 class="site-title">Connecting <span>Riders</span> and <span>Drivers</span> for Convenient
                            Transportation</h2>
                        <p>Our Smart Ride app provides a seamless platform for riders and drivers to connect, making
                            transportation more convenient than ever. With just a few taps, you can easily request a
                            ride or offer your driving services to those in
                            need. Join our community today and experience hassle-free transportation at your fingertips.
                        </p>
                        <a href="about.php" class="btn">Discover More <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col6">
                    <div class="colright">
                        <img src="img/about-right.jpg" alt="about-right" title="abut-right">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="service-section">
        <div class="container">
            <div class="title">
                <span class="title-tagline">Services</span>
                <h2 class="site-title"><span>Reliable</span> and <span>Affordable</span> Transportation</span>
                </h2>
            </div>
            <div class="row">
                <div class="col6">
                    <div class="service-box">
                        <div class="icon">
                            <a href="services.php"> <i class="fa fa-credit-card"></i></a>
                        </div>
                        <div class="icon-content">
                            <a href="service.php">
                                <h4>Online Booking</h4>
                                <p>Book a ride in advance and have peace of mind knowing your transportation is taken
                                    care of.</p>
                                <div class="icon-btn"> <a href="services.php">Read More <i
                                            class="fa fa-arrow-right"></i></a></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col6">
                    <div class="service-box">
                        <div class="icon">
                            <a href="services.php"> <i class="fa fa-taxi"></i></a>
                        </div>
                        <div class="icon-content">
                            <a href="service.php">
                                <h4>Ride Sharing</h4>
                                <p>Share your ride with others and save money on transportation costs. </p>
                                <div class="icon-btn"> <a href="services.php">Read More <i
                                            class="fa fa-arrow-right"></i></a></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col6">
                    <div class="service-box">
                        <div class="icon">
                            <a href="services.php"> <i class="fa fa-tags"></i></a>
                        </div>
                        <div class="icon-content">
                            <a href="service.php">
                                <h4>Affordable Rate</h4>
                                <p>There are many variations of passages orem psum available but the majority have
                                    suffered alteration in some form by injected. </p>
                                <div class="icon-btn"> <a href="services.php">Read More <i
                                            class="fa fa-arrow-right"></i></a></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col6">
                    <div class="service-box">
                        <div class="icon">
                            <a href="services.php"> <i class="fa fa-check-square-o"></i></a>
                        </div>
                        <div class="icon-content">
                            <a href="service.php">
                                <h4>Fast Pickup</h4>
                                <p>There are many variations of passages orem psum available but the majority have
                                    suffered alteration in some form by injected. </p>
                                <div class="icon-btn"> <a href="services.php">Read More <i
                                            class="fa fa-arrow-right"></i></a></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="taxi-rate">
        <div class="container">
            <div class="title">
                <h2 class="site-title"> Available Rides</h2>
            </div>
            <div class="rate-wrap">
                <div class="row">
                    <?php while($row=$result->fetch_assoc()){ ?>
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
                </div>
            </div>
        </div>
    </section>
    
   
    <section class="offer-ride">
        <div class="container">
            <div class="row">
                <div class="col6">
                    <div class="offer-left">
                        <img src="img/offer.jpg" alt="offer" title="offer">
                    </div>
                </div>
                <div class="col6">
                    <div class="offer-right">
                        <span class="title-tagline">
                            Be a Driver
                        </span>
                        <h2 class="site-title">Offer Your <span>Ride</span> and <span>Help Others</span> Today!</span>
                        </h2>
                        <p>You have the opportunity to offer your car to those in need of reliable transportation. With
                            our easy-to-use platform, you can set your own schedule, choose your own rides, and earn
                            money while helping others get where they need
                            to go. Join our community of drivers today and start making a difference on the road.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="download-app">
        <div class="container">
            <div class="row">
                <div class="col6">
                    <div class="download-left">
                        <span class="title-tagline">Get Our App </span>
                        <h2 class="site-title">Download Our <span>Smart Ride</span> App Now!</h2>
                        <p>Ready to get moving? Download our ride-sharing app and connect with reliable drivers who can
                            take you where you need to go. Whether you're commuting to work, running errands, or
                            exploring a new city, our app makes it easy to get
                            around with confidence. Download our app today and experience the convenience and
                            affordability of ride-sharing! </p>
                        <div class="download-btn">
                            <a href="#"><img src="img/googleplay.png" alt="googleplay" title="googleplay"></a>
                            <a href="#"><img src="img/app-store.png" alt="app-store" title="app-store"></a>

                        </div>
                    </div>
                </div>
                <div class="col6">
                    <div class="download-right">
                        <img src="img/download.jpg" alt="download" title="download">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
include_once('include/footer.php');
?>