<?php
  session_start();
	$LOGGED = isset($_SESSION["logged"]);
	if($LOGGED){
		$logged_type = $_SESSION["user_type"];
    session_destroy();
	}
  header("location:../index.php");
?>
