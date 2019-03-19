<?php
include("../includes/db.php");
include("../includes/auth.php"); 
$auid=$_REQUEST['auid'];
$vuid=$_REQUEST['vuid'];
$qno=$_REQUEST['q'];
$qry = "SELECT * FROM aupdown WHERE vuid= $vuid AND auid= $auid AND qno= $qno";
$res = mysqli_query($con, $qry) or die(mysqli_error($con));
if($_REQUEST['vote']=="Upvote"){
	if($res==false || mysqli_num_rows($res)==0){
		$qry = "INSERT INTO aupdown(auid, vuid, qno, ud) VALUES($auid, $vuid, $qno, 1)";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		$qry = "UPDATE answer SET aupcount=aupcount+1 WHERE qno= $qno AND uid= $auid";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		echo 'Upvoted';
	}
	else{
		$row = mysqli_fetch_array($res);
		if($row['ud']==0){
			$qry = "UPDATE aupdown SET ud=1 WHERE qno= $qno AND auid= $auid AND vuid= $vuid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET aupcount=aupcount+1 WHERE qno= $qno AND uid= $auid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET adowncount=adowncount-1 WHERE qno= $qno AND uid= $auid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			echo 'Upvoted';
		}
		else{
			$qry = "DELETE FROM aupdown WHERE qno= $qno AND auid= $auid AND vuid= $vuid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			if($row['ud']==1){
				$qry = "UPDATE answer SET aupcount=aupcount-1 WHERE qno= $qno AND uid= $auid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			else if($row['ud']==0){
				$qry = "UPDATE answer SET adowncount=adowncount-1 WHERE qno= $qno AND uid= $auid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			echo 'Resetted';
		}
	}
}
else if($_REQUEST['vote']=="Downvote"){
	if($res==false || mysqli_num_rows($res)==0){
		$qry = "INSERT INTO aupdown(auid, vuid, qno, ud) VALUES( $auid, $vuid, $qno, 0)";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		$qry = "UPDATE answer SET adowncount=adowncount+1 WHERE qno= $qno AND uid= $auid";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		echo "Downvoted";
	}
	else{
		$row = mysqli_fetch_array($res);
		if($row['ud']==1){
			$qry = "UPDATE aupdown SET ud=0 WHERE qno= $qno AND auid= $auid AND vuid= $vuid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET aupcount=aupcount-1 WHERE qno= $qno AND uid= $auid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET adowncount=adowncount+1 WHERE qno= $qno AND uid= $auid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			echo 'Downvoted';
		}
		else{
			$qry = "DELETE FROM aupdown WHERE qno=$qno AND auid= $auid AND vuid= $vuid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			if($row['ud']==1){
				$qry = "UPDATE answer SET aupcount=aupcount-1 WHERE qno= $qno AND uid= $auid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			else if($row['ud']==0){
				$qry = "UPDATE answer SET adowncount=adowncount-1 WHERE qno= $qno AND uid= $auid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			echo 'Resetted';
		}
	}
}