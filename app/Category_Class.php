<?php
function countCourses($cat){
	$content = "";
	$con = DbCon();
	$sql_query = mysqli_query($con, "SELECT COUNT(*) AS `countres` FROM `courses` WHERE `cat_id`=".$cat)or die(mysqli_error($con));
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
