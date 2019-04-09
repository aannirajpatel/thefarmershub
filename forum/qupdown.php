<?php
include("../includes/db.php");
include("../includes/auth.php"); 
$uid=$_SESSION['uid'];
if(!isset($_REQUEST['q'])){
	echo "Invalid Request";
}
else{
	$qno=$_REQUEST['q'];
	$qry = "SELECT * FROM qupdown WHERE uid=$uid AND qno=$qno";
	$res = mysqli_query($con, $qry);
	if($_REQUEST['vote']=="Upvote"){
		if($res==false || mysqli_num_rows($res)==0){
			$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 1)";
			$res = mysqli_query($con, $qry);
			$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
			$res = mysqli_query($con, $qry);
			echo 'Upvoted';
		}
		else{
			$row = mysqli_fetch_array($res);
			if($row['ud']==0){
				$qry = "UPDATE qupdown SET ud=1 WHERE qno=$qno AND uid=$uid";
				$res = mysqli_query($con, $qry) or die(mysqli_error());
				$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
				$res = mysqli_query($con, $qry);
				$qry = "UPDATE question SET qdowncount=qdowncount-1 WHERE qno=$qno";
				$res = mysqli_query($con, $qry);
				echo 'Upvoted';
			}
			else{
				$qry = "DELETE FROM qupdown WHERE qno=$qno AND uid=$uid";
				$res = mysqli_query($con, $qry);
				if($row['ud']==1){
					$qry = "UPDATE question SET qupcount=qupcount-1 WHERE qno=$qno";
					$res = mysqli_query($con, $qry);
				}
				else if($row['ud']==0){
					$qry = "UPDATE question SET qdowncount=qdowncount-1 WHERE qno=$qno";
					$res = mysqli_query($con, $qry);
				}
				echo 'Resetted';
			}
		}
	}
	else if($_REQUEST['vote']=="Downvote"){
		if($res==false || mysqli_num_rows($res)==0){
			$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 0)";
			$res = mysqli_query($con, $qry);
			$qry = "UPDATE question SET qdowncount=qdowncount+1 WHERE qno=$qno";
			$res = mysqli_query($con, $qry);
			echo 'Downvoted';
		}
		else{
			$row = mysqli_fetch_array($res);
			if($row['ud']==1){
				$qry = "UPDATE qupdown SET ud=0 WHERE qno=$qno AND uid=$uid";
				$res = mysqli_query($con, $qry) or die(mysqli_error());
				$qry = "UPDATE question SET qupcount=qupcount-1 WHERE qno=$qno";
				$res = mysqli_query($con, $qry);
				$qry = "UPDATE question SET qdowncount=qdowncount+1 WHERE qno=$qno";
				$res = mysqli_query($con, $qry);
				echo 'Downvoted';
			}
			else{
				$qry = "DELETE FROM qupdown WHERE qno=$qno AND uid=$uid";
				$res = mysqli_query($con, $qry);
				if($row['ud']==1){
					$qry = "UPDATE question SET qupcount=qupcount-1 WHERE qno=$qno";
					$res = mysqli_query($con, $qry);
				}
				else if($row['ud']==0){
					$qry = "UPDATE question SET qdowncount=qdowncount-1 WHERE qno=$qno";
					$res = mysqli_query($con, $qry);
				}
				echo 'Resetted';
			}
		}
	}
}