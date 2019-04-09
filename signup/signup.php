<?php
$con = mysqli_connect("localhost", "root", "", "thefarmershub");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$done = 0;
$success = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['fname'])) {

    $fname = $_POST['fname'];
    $fname = mysqli_real_escape_string($con, $fname);

    $lname = stripslashes($_REQUEST['lname']);
    $lname = mysqli_real_escape_string($con, $lname);

    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $phoneNumber = stripslashes($_REQUEST['phoneNumber']);
    $phoneNumber = mysqli_real_escape_string($con, $phoneNumber);

    $language = stripslashes($_REQUEST['language']);
    $language = mysqli_real_escape_string($con, $language);

    $village = stripslashes($_REQUEST['village']);
    $village = mysqli_real_escape_string($con, $village);

    $dist = stripslashes($_REQUEST['dist']);
    $dist = mysqli_real_escape_string($con, $dist);

    $state = stripslashes($_REQUEST['state']);
    $state = mysqli_real_escape_string($con, $state);

    $query = "SELECT * FROM account WHERE email='$email'";

    $result = mysqli_query($con, $query);

    if ($result == false || mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO account(fname,lname,username,email,password,phoneNumber,language,village,dist,state) 
        VALUES ('$fname', '$lname', '$username', '$email', '" . md5($password) . "', '$phoneNumber', '$language', '$village', '$dist', '$state')";

        $result = mysqli_query($con, $query);

        $done = 1;

        if ($result) {
            $success = 1;
        }
    }
    else {
        $done = 1;
        $success = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
        body, html {
  height: fill;
}
.bg {
  background-image: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);
  height: fill;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
   <title>Signup for TFH</title>
   <meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">  
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $("document").ready(function(){
    $("#signupSuccess").hide();
    $("#signupFailure").hide();
    if(<?php echo $success; ?> && <?php echo $done ?>){$("#signupSuccess").show();}
    else if(<?php echo $done; ?>) {$("#signupFailure").show();}
  });
</script>
</head>
<body class="bg">
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="#">TFH</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../login/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../signup/signup.php">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../forum/forum.php">Forums</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Statistics</a>
      </li>
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="../forum/searchq.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any question" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br>
<div class="alert alert-success" id="signupSuccess">
      <strong>Account created!</strong> Click <a href="../login/login.php">here</a> to login.
</div>
<div class="alert alert-danger" id="signupFailure">
      <strong>Account already exists!</strong> Click <a href="../login/login.php">here</a> to login.
</div>
<br><br>       
<div class="container">
            <form class="form-horizontal" role="form" action="" method="POST">
                <h2 style="color:white">Sign Up for The Farmer's Hub</h2>
            </form>
        </div> 
<div class="container">
<hr>
</div>
<div class="container">
<div class="row"></div>
    <aside class="col-sm-9">
<div class="card" style="margin-bottom: 20px;">
<article class="card-body">
<a href="../login/login.php" class="float-right btn btn-outline-primary">Login</a>
<h4 class="card-title mb-4 mt-1">Sign Up</h4>
    <form method="POST" action="">
                    <div class="form-group">
                    <label for="fname" class="col-sm-3 control-label">First Name </label>
                    <div class="col-sm-9">
                        <input type="text" name="fname" placeholder="First Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-sm-3 control-label">Last Name </label>
                    <div class="col-sm-9">
                        <input type="text" name="lname" placeholder="Last Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" name="username" placeholder="Username" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email </label>
                    <div class="col-sm-9">
                        <input type="email" name="email" placeholder="Email ID" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password </label>
                    <div class="col-sm-9">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-3 control-label">Phone number </label>
                    <div class="col-sm-9">
                        <input type="phoneNumber" name="phoneNumber" placeholder="Phone number" class="form-control">
                    </div>
                </div>
               <div class="form-group">
                    <label for="language" class="col-sm-3 control-label">Language</label>
                    <div class="col-sm-9">
                        <input type="text" name="language" placeholder="Language" class="form-control">
                    </div>
                </div>
               <div class="form-group">
                    <label for="village" class="col-sm-3 control-label">Village</label>
                    <div class="col-sm-9">
                        <input type="text" name="village" placeholder="Village" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dist" class="col-sm-3 control-label">District</label>
                    <div class="col-sm-9">
                        <input type="text" name="dist" placeholder="District" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="state" class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <input type="text" name="state" placeholder="State" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <span class="help-block">&nbsp;All fields are required. </span>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-success btn-block">
</form>
</article>
</div>
</aside>
<aside class="col-sm-2">
</aside>
</body>
</html>