<?php
include_once('include/header.php');

//redirect to home page is already login
if(isset($_SESSION['user'])){
    header('location:home.php');
    exit();
}

//login
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $stmt=$connection->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $result=$stmt->get_result();
    if($row=$result->fetch_assoc()){
        if($row['status'] == 0){
            echo "<script>alert('Account Is Disabled Contact Admin')
            window.location='login.php';
            </script>";
            exit();
        }else{
            $_SESSION['user'] = $row;
            echo "<script>alert('Login Successfully')
            window.location='home.php';
            </script>";
        }
    }else{
        echo "<script>alert('Incorrect email/password Try Again!')
        </script>";
    }
}

?>
    <section class="login1">
        <div class="container">
            <div class="login-heading">
                <h1>Login</h1>
                <ul>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="active" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="login2">
        <div class="container">
            <div class="form-wrap">
                <div class="login-header">
                    <h2 class="site-title"> Securely <span>Login</span> to Your Profile</h2>
                </div>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="Email Address">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Your Password" required>
                    </div>
                    <div class="login-text">
                        <div class="left">
                            <input type="checkbox">
                            <p>Remember Me </p>
                        </div>
                        <div class="right">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div class=" login-btn">
                        <button class="btn" name="login"><i class="fa fa-sign-in"></i> Login</button>
                    </div>
                    <div class="account">
                        <p>Don't have an account?
                            <a href="register.html">Register</a>
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