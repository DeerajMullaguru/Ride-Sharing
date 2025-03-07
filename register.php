<?php
include_once('include/header.php');

//redirect to home page is already login
if(isset($_SESSION['user'])){
    header('location:home.php');
    exit();
}

//register
if(isset($_POST['register'])){
    $name=$_POST['name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $address=$_POST['address'];
    $role='user';
    $status=1;
    if($_POST['car']){
        $car = $_POST['car'];
    }else{
        $car = NULL;
    }
    if($_POST['car_no']){
        $car_no = $_POST['car_no'];
    }else{
        $car_no = NULL;
    }

    $stmt=$connection->prepare("INSERT INTO users (name,contact,email,password,address,role,status,car,car_no) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssss",$name,$contact,$email,$password,$address,$role,$status,$car,$car_no);
    if($stmt->execute()){
        echo "<script>alert('Registered Successfully')
        window.location='login.php';
        </script>";
    }else{
        echo "<script>alert('!Error Something Went Wrong Try Again')
        </script>";
    }
}


?>
    <section class="login1 register1">
        <div class="container">
            <div class="login-heading">
                <h1>Register</h1>
                <ul>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="active" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="login2">
        <div class="container">
            <div class="form-wrap">
                <div class="login-header">
                    <h2 class="site-title"> <span>Register</span> to Access Our Services</h2>
                </div>
                <form action="" method="POST">
                <div class="input-wrap ">
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="Name">Contact</label>
                        <input type="tel" name="contact" class="form-control" placeholder="Your Contact" required>
                    </div>
                    </div>
                    <div class="input-wrap ">
                    <div class="form-group">
                        <label for="Email Address">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" minlength="8" placeholder="Your Password" required>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="Password">Address</label>
                        <textarea name="address" class="form-control" id="" cols="15" rows="4" placeholder="Address" required></textarea>
                    </div>
                    <div class="login-text" id="caradd">
                        <div class="left">
                            <input type="radio" id="cardetail">
                            <p>Add car Details</p>
                        </div>
                    </div>
                    <div class="login-text" id="hidecar" style="display:none">
                        <div class="left">
                            <input type="radio" id="skipcar">
                            <p>Skip</p>
                        </div>
                    </div>
                    <div id="showcar" style="display:none;">
                    <div class="input-wrap ">
                        <div class="form-group">
                            <label for="Email Address">Car</label>
                            <input type="text" id="car" name="car" class="form-control" placeholder="Car">
                        </div>
                        <div class="form-group">
                            <label for="Password">Car No</label>
                            <input type="text" id="car_no" class="form-control" name="car_no" placeholder="Car No">
                        </div>
                        </div>
                    </div>
                    <!-- <div class="login-text">
                        <div class="left">
                            <input type="checkbox">
                            <p>I agree with the
                                <a href="#">Terms Of Service</a>. </p>
                        </div>
                    </div> -->
                    <div class=" login-btn">
                        <button class="btn" name="register"><i class="fa fa-location-arrow"></i> Register</button>
                    </div>
                    <div class="account">
                        <p>Already have an account?
                            <a href="login.html">Login</a>
                        </p>
                    </div>
                    <div class="social-media">
                        <p>Continue with social media</p>
                        <div class="links">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-google"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
include_once('include/footer.php');
?>