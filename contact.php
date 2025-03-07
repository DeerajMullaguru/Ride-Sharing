<?php
include_once('include/header.php');

if(isset($_POST['submit'])){
    $name= $_POST['name'];
    $contact= $_POST['contact'];
    $email= $_POST['email'];
    $message= $_POST['message'];

    $stmt=$connection->prepare("INSERT INTO contact_us (name,contact,email,message) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss",$name,$contact,$email,$message);
    if($stmt->execute()){
        echo "<script>alert('Thanx For Contact With Us! We response your message shortly')
        window.location='home.php';
        </script>";
    }
}

?>
    <section class="login1 contact1">
        <div class="container">
            <div class="login-heading">
                <h1>Contact</h1>
                <ul>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="active" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="contact2">
        <div class="container">
            <div class="row">
                <div class="col4">
                    <div class="contact-box">
                        <div class="contact-icon">
                            <i class="fa fa-map"></i>
                            <h4>Office Address</h4>
                            <p>25/B Milford, New York, USA</p>
                        </div>
                    </div>
                </div>
                <div class="col4">
                    <div class="contact-box">
                        <div class="contact-icon">
                            <i class="fa fa-phone"></i>
                            <h4>Call Us</h4>
                            <p>+2 123 4565 789</p>
                        </div>
                    </div>
                </div>
                <div class="col4">
                    <div class="contact-box">
                        <div class="contact-icon">
                            <i class="fa fa-envelope"></i>
                            <h4>Email Address</h4>
                            <p>smartride@gmail.com</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="contact3">
        <div class="container">
            <div class="row">
                <div class="col6">

                </div>
                <div class="col6">
                    <div class="contact-right">
                        <form action="" method="POST">
                            <h2 class="site-title">
                                Let's Stay in Touch - <span>Contact Us</span> Now</h2>
                            <p>We love hearing from our customers! Whether you have feedback, suggestions, or simply want to say hello, we're always happy to hear from you. Get in touch with us today. </p>
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="tel" name="contact" class="form-control" placeholder="Your Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label for="Phone">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <label for="Message">Message</label>
                            <textarea class="form-control" cols="20" rows="5" name="message" placeholder="Your Message" required></textarea>
                            <button class="btn" name="submit">Send Message <i class="fa fa-location-arrow"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
include_once('include/footer.php');
?>