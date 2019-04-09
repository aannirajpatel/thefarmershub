<?php
include("../includes/db.php");
include("../includes/auth.php"); 
$uid=$_SESSION['uid'];
if(!isset($_REQUEST['articleid'])){
	echo "Invalid Request";
}
else{
	$articleid=$_REQUEST['articleid'];
	$qry = "SELECT * FROM articleupdown WHERE uid=$uid AND articleid=$articleid";
	$res = mysqli_query($con, $qry);
	if($_REQUEST['vote']=="Upvote"){
		if($res==false || mysqli_num_rows($res)==0){
			$qry = "INSERT INTO articleupdown(uid, articleid, ud) VALUES($uid, $articleid, 1)";
			$res = mysqli_query($con, $qry);
			$qry = "UPDATE article SET upcount=upcount+1 WHERE articleid=$articleid";
			$res = mysqli_query($con, $qry);
			echo 'Upvoted';
		}
		else{
			$row = mysqli_fetch_array($res);
			if($row['ud']==0){
				$qry = "UPDATE articleupdown SET ud=1 WHERE articleid=$articleid AND uid=$uid";
				$res = mysqli_query($con, $qry) or die(mysqli_error());
				$qry = "UPDATE article SET upcount=upcount+1 WHERE articleid=$articleid";
				$res = mysqli_query($con, $qry);
				$qry = "UPDATE article SET downcount=downcount-1 WHERE articleid=$articleid";
				$res = mysqli_query($con, $qry);
				echo 'Upvoted';
			}
			else{
				$qry = "DELETE FROM articleupdown WHERE articleid=$articleid AND uid=$uid";
				$res = mysqli_query($con, $qry);
				if($row['ud']==1){
					$qry = "UPDATE article SET upcount=upcount-1 WHERE articleid=$articleid";
					$res = mysqli_query($con, $qry);
				}
				else if($row['ud']==0){
					$qry = "UPDATE article SET downcount=downcount-1 WHERE articleid=$articleid";
					$res = mysqli_query($con, $qry);
				}
				echo 'Resetted';
			}
		}
	}
	else if($_REQUEST['vote']=="Downvote"){
		if($res==false || mysqli_num_rows($res)==0){
			$qry = "INSERT INTO articleupdown(uid, articleid, ud) VALUES($uid, $articleid, 0)";
			$res = mysqli_query($con, $qry);
			$qry = "UPDATE article SET downcount=downcount+1 WHERE articleid=$articleid";
			$res = mysqli_query($con, $qry);
			echo 'Downvoted';
		}
		else{
			$row = mysqli_fetch_array($res);
			if($row['ud']==1){
				$qry = "UPDATE articleupdown SET ud=0 WHERE articleid=$articleid AND uid=$uid";
				$res = mysqli_query($con, $qry) or die(mysqli_error());
				$qry = "UPDATE article SET upcount=upcount-1 WHERE articleid=$articleid";
				$res = mysqli_query($con, $qry);
				$qry = "UPDATE article SET downcount=downcount+1 WHERE articleid=$articleid";
				$res = mysqli_query($con, $qry);
				echo 'Downvoted';
			}
			else{
				$qry = "DELETE FROM articleupdown WHERE articleid=$articleid AND uid=$uid";
				$res = mysqli_query($con, $qry);
				if($row['ud']==1){
					$qry = "UPDATE article SET upcount=upcount-1 WHERE articleid=$articleid";
					$res = mysqli_query($con, $qry);
				}
				else if($row['ud']==0){
					$qry = "UPDATE article SET downcount=downcount-1 WHERE articleid=$articleid";
					$res = mysqli_query($con, $qry);
				}
				echo 'Resetted';
			}
		}
	}
}