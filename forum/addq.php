
<?php
require("../includes/auth.php");
require("../includes/db.php");
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="thefarmershub"; // Database name 
$tbl_name="question"; // Table name 
$uid = $_SESSION['uid'];

// Connect to server and select database.
mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($con,"$db_name")or die("cannot select DB");

// get data that sent from form 
$question=$_GET['question'];

$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO $tbl_name(qtext,uid)VALUES('$question','$uid')";
$result=mysqli_query($con,$sql);

if($result){
echo "Successful<BR>";
echo '<a href="../dashboard/dashboard.php">View your question</a>';
}
else {
echo "ERROR";
}
mysqli_close($con);
?>