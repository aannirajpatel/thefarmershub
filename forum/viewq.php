<?php
session_start();
if(!isset($_REQUEST['q'])){
	header('Location: ../dashboard/dashboard.php');
}
$qno = $_REQUEST['q'];
$canAnswer = 0;
if(!isset($_SESSION["email"])){
	$canAnswer=0;
}

else{
	$canAnswer=1;
	$uid = $_SESSION['uid'];
}
require("../includes/db.php");

?>