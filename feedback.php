<?php
include_once('include/header.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_POST['submit'])){
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $stmt=$connection->prepare("INSERT INTO reviews (booking_id,rating,review) VALUES(?,?,?)");
    $stmt->bind_param("sss",$id,$rating,$review);
    if($stmt->execute()){
        $stmt1=$connection->prepare("UPDATE bookings SET is_review = 1 WHERE id = ?");
        $stmt1->bind_param("s",$id);
        if($stmt1->execute()){
            echo "<script>alert('Thanx For Share Your Feedback!')
            window.location='my-bookings.php';
            </script>";
        }
    }
}

?>
<section class="login1 feedback1">
        <div class="container">
            <div class="login-heading">
                <h1>Feedback</h1>
                <ul>
                    <li>
                        <a href="home.html">Home</a>
                    </li>
                    <li>
                        <a class="active" href="feedback.html">Feedback</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="feedback2">
        <div class="container">
            <div class="row">
                <div class="col6">
                    <div class="feedback-left">
                        <img src="img/feedback-left.jpg" alt="feedback" title="feedback">
                    </div>
                </div>
                <div class="col6">
                    <div class="feedback-right">
                        <form action="" method="POST">
                            <h2 class="site-title">
                                <span>Feedback</span> Form</h2>
                            <p>Share your thoughts on our ride-sharing services. </p>
                            <div class="form-group">
                                <label for="Name">Ratings</label>
                                <input type="number" class="form-control" name="rating" min="0" max="5" placeholder="Rating" required>
                            </div>
                            <label for="Message">Reviews</label>
                            <textarea class="form-control" cols="20" rows="5" name="review" placeholder="Your Review" required></textarea>
                            <button class="btn" name="submit">Send Message <i class="fa fa-location-arrow"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="title">
                <span class="title-tagline">Testimonials</span>
                <h2 class="site-title">What Our Client <span>Say's</span></h2>
            </div>

            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="testimonial-box">
                        <div class="testimonial-top">
                            <div class="testimonial-image">
                                <img src="img/testimonial1.png" alt="testimonial" title="testimonial">
                            </div>
                            <div class="testimonial-content">
                                <h3>Eredrik Johanson </h3>
                                <span>Driver
                                </span>
                            </div>
                        </div>
                        <div class="testimonial-bottom">
                            <p>As a driver, I've had a fantastic experience using this smart ride website. It's easy to manage my rides and communicate with riders, and the payment system is seamless. I've met some really interesting people and have even
                                made some new friends through this service. Highly recommend!</p>
                            <ul>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-box">
                        <div class="testimonial-top">
                            <div class="testimonial-image">
                                <img src="img/testimonial2.png" alt="testimonial" title="testimonial">
                            </div>
                            <div class="testimonial-content">

                                <h3>Sarah A. Holland </h3>
                                <span>Customer
                                    </span>
                            </div>
                        </div>
                        <div class="testimonial-bottom">
                            <p>I'm so glad I found this website! As someone who doesn't own a car, it can be tough to find reliable transportation sometimes. But with this service, I can easily connect with riders who are willing to give me a ride. The process
                                is simple and efficient, and I've had nothing but positive experiences so far.</p>
                            <ul>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="testimonial-box">
                        <div class="testimonial-top">
                            <div class="testimonial-image">
                                <img src="img/testimonial3.png" alt="testimonial" title="testimonial">
                            </div>
                            <div class="testimonial-content">
                                <h3>Alfred A. Phan</h3>
                                <span>Driver
                                </span>
                            </div>
                        </div>
                        <div class="testimonial-bottom">
                            <p>This ride website has been a lifesaver for me as a driver. I was struggling to make ends meet before I started driving for this service, but now I have a reliable source of income that fits with my schedule. The website is
                                easy to use and the support team is always helpful and responsive.</p>
                            <ul>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include_once('include/footer.php');
?>