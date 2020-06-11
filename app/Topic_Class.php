<?php
function countCourses($cat){
	$content = "";
	$con = DbCon();
	$sql_query = mysqli_query($con, "SELECT COUNT(*) AS `countres` FROM `courses` WHERE `csid`=".$cat)or die(mysqli_error($con));
	if(mysqli_num_rows($sql_query)){
			$row = mysqli_fetch_array($sql_query);
			//print_r($row);
			$content = $row["countres"];
	}else{
			$content = "0";
	}
	mysqli_close($con);
	return $content;
}

function totalLength($cat){
	$content = "";
	$con = DbCon();
	$sql_query = mysqli_query($con, "SELECT ROUND(SUM(duration), 2) AS `countres` FROM `courses` WHERE `csid`=".$cat)or die(mysqli_error($con));
	if(mysqli_num_rows($sql_query)){
			$row = mysqli_fetch_array($sql_query);
			//print_r($row);
			$content = $row["countres"];
	}else{
			$content = "0";
	}

	if($content==""){
		$content = "0";
	}

	mysqli_close($con);
	return $content;
}
function countUploads($cat){
	$content = "";
	$con = DbCon();

	$cs_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `csid`=".$cat)or die(mysqli_error($con));
	$count = 0;
	if(mysqli_num_rows($cs_query)){
		while($row = mysqli_fetch_array($cs_query)){
			$cid = $row["id"];
			$sql_query = mysqli_query($con, "SELECT COUNT(*) AS `countres` FROM `uploads` WHERE `course`=".$cid)or die(mysqli_error($con));
			if(mysqli_num_rows($sql_query)){
					$row = mysqli_fetch_array($sql_query);
					//print_r($row);
					$count = $count + $row["countres"];
			}
		}
	}
	$content = $count;
	mysqli_close($con);
	return $content;
}
function countClasses($cat){
	$content = "";
	$con = DbCon();
	$sql_query = mysqli_query($con, "SELECT `title`, `content`, `subtitle` FROM `web_content` WHERE `name`='".$name."'")or die(mysqli_error($con));
	if(mysqli_num_rows($sql_query)){
			$row = mysqli_fetch_array($sql_query);
			$content = $row;
	}else{
			$content = ["Not Found", "Requested Content Not Found"];
	}
	mysqli_close($con);
	return $content;
}
?>
