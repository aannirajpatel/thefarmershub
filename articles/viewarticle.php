<?php
session_start();
//require('../includes/auth.php');
if(!isset($_REQUEST['articleid'])){
header('Location: ../articles/articles.php');
}
require("../includes/db.php");
$articleid = $_REQUEST['articleid'];
$canComment = 0;
if(isset($_SESSION["uid"])){
$canComment=1;
$uid = $_SESSION['uid'];
$udqry = "SELECT * FROM articleupdown WHERE articleid= $articleid AND uid= $uid";
$udres = mysqli_query($con, $udqry);
if($udres!=false && mysqli_num_rows($udres)>0){
$udrow = mysqli_fetch_assoc($udres);
if($udrow['ud']==1){
$uvs = '<i id="usvg" data-vi="angle-top" data-vi-size="30" style="color: green;"></i>';
$dvs = '<i id="dsvg" data-vi="angle-bottom" data-vi-size="30" style="color: black;"></i>';
$udsituation="Upvoted";
}
else if($udrow['ud']==0){
$uvs = '<i id="usvg" data-vi="angle-top" data-vi-size="30" style="color: black;"></i>';
$dvs = '<i id="dsvg" data-vi="angle-bottom" data-vi-size="30" style="color: red;"></i>';
$udsituation="Downvoted";
}
}
else{
$uvs = '<i id="usvg" data-vi="angle-top" data-vi-size="30" style="color: black;"></i>';
$dvs = '<i id="dsvg" data-vi="angle-bottom" data-vi-size="30" style="color: black;"></i>';
$udsituation = "Resetted";
}
}
else{
$canComment=0;
}
$qry = "SELECT `text`,topic,uid FROM article WHERE articleid = $articleid";
$res = mysqli_query($con, $qry) or die(mysqli_error($con));
if(mysqli_num_rows($res) == 0){
header('Location: ../error404.php');
}
$row = mysqli_fetch_array($res);
$topic= $row['topic'];
$text = $row['text'];
$postingUser = $row['uid'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style type="text/css">
      body, html, .bg {
        height: fill;
        min-height: 100%;
      }
      .bg {
        background-image: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);
        /*background-image: linear-gradient(to right top, #ff6600, #ff3f6c, #f052b7, #a376e6, #128deb);*/
        min-height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      #articleid{
      	display: none;
      }
    </style>
    <title>View Article
    </title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vivid-icons@1.0.9" type="text/javascript">
    </script>
    <script src="./js/articleupdown.js" type="text/javascript">
    </script>
    <script type="text/javascript">
		function googleTranslateElementInit() {
  			new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
	</script>

	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  </head>
  <body class="bg">
  	<p id='articleid'><?php echo $articleid;?></p>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
      <a class="navbar-brand" href="#">TFH
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?php if($canComment){ ?>
          <li class="nav-item">
            <a class="nav-link" href="../dashboard/dashboard.php">Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../articles/articles.php">Articles
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../forum/forum.php">Forums
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../statistics/statistics.php">Statistics
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout/logout.php">Logout
            </a>
          </li>
          <?php
}
else{
?>
          <li class="nav-item">
            <a class="nav-link" href="../login/login.php">Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../signup/signup.php">Sign Up
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../articles/articles.php">Articles
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../forum/forum.php">Forums
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../statistics/statistics.php">Statistics
            </a>
          </li>	
          <?php } ?>
        </ul>
      </div>
      <form class="form-inline my-2 my-lg-0" style="float:right;" action="searchq.php" method="get">
        <input class="form-control mr-sm-2" style="width: 300px" name="search" type="search" placeholder="Search for any article" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search
        </button>
      </form>
    </nav>
    <br>
    <br>
    <br>
    <div class="container">
      <div class="card">
        <div class = "card-header">
          Topic "<?php echo $topic;?>", by  
          <i>
            <?php
$qry = "SELECT * FROM account WHERE uid=$postingUser";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);
echo $row['fname']." ".$row['lname'];
?>
          </i>
        </div>
        <div class = "card-body">
          <?php echo nl2br($text);
if($canComment==1){
?>
          <br>
          <span style="float: left;">
            <button class="btn btn-default">
              <a style="text-decoration: none;" href= 
                 <?php echo "createcomment.php?articleid=".$articleid; ?>>
              <i data-vi="chat" data-vi-size="30">
              </i>
              </a>
            </button>
          <span id="udformcover">
            <button class="btn btn-default" id="upvote">
              <?php echo $uvs ?>
            </button>
            <button class="btn btn-default" id="downvote">
              <?php echo $dvs ?>
            </button>
          </span>
          </span>
        <br>
        <?php
}
?>
        <br>
        <table class="table">
          <thead>
            <th>User
            </th>
            <th>Comment
            </th>
            <th>Posted On
            </th>
            <th>Upvotes
            </th>
            <th>Downvotes
            </th>
          </thead>
          <?php
$qry = "SELECT * FROM comment WHERE articleid=$articleid ORDER BY (cupcount-cdowncount) DESC, ctimestamp DESC";
$res = mysqli_query($con, $qry) or die(mysqli_error($con));
if($res==false||mysqli_num_rows($res)==0){
?>
          <tr>
            <td>---
            </td>
            <td>No comments yet...
            </td>
            <td>---
            </td>
            <td>-
            </td>
            <td>-
            </td>
            <?php
}
else{
while($row = mysqli_fetch_assoc($res)){
$qry = "SELECT username FROM account WHERE uid=".$row['uid'];
$res2 = mysqli_query($con, $qry) or die(mysqli_error($con));
$r = mysqli_fetch_array($res2);
echo "<tr>
<td>".$r['username']."</td>
<td>".$row['ctext']."</td>
<td>".$row['ctimestamp']."</td>";
if($canComment){
echo "
<td style='color: green;'>
<span>".$row['cupcount']."</span>
<button class='btn btn-default' onclick='commentUpvote(".$row['commentid'].")'>
<span data-vi='angle-top' data-vi-size='20'></span>
</button>
</td>
<td style='color: red;'>
<span>".$row['cdowncount']."</span>
<button class='btn btn-default' onclick='commentDownvote(".$row['commentid'].")'>
<span data-vi='angle-bottom' data-vi-size='20'></span>
</button>
</td>";
}
else{
echo "<td style='color:green;'>".$row['cupcount']."</td>";
echo "<td style='color:red;'>".$row['cdowncount']."</td>";
}
echo "</td>
</tr>";
}
}
?>
        </table>
      </div>
    </div>
    </div>
    <div id="google_translate_element" style="position: absolute;bottom: 0px;right: 0px;"></div>
  </body>
</html>
