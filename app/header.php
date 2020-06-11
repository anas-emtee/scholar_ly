<?php
session_start();
include "DbCon.php";
include "Content_Class.php";
include "../Mailer.php";
?>
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Scholarly: Learn More</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,500" rel="stylesheet">
	<!-- CSS ============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/course.css">
	<link rel="stylesheet" href="css/colorbox.css" />
</head>
<?php
	$HLOGGED = isset($_SESSION["logged"]);
	$PLOADED = isset($_SESSION["purchases"]);
	if($HLOGGED && !$PLOADED){
		$h_logged_type = $_SESSION["user_type"];
		//Get Purchases
	}
	if($HLOGGED){
		$meid = $_SESSION["user_id"];
		$MY_SAVES = [];
		$MY_CARTED = [];
		$MY_PURCHASED = [];
		if(isset($_SESSION["user_saved"])){
			$MY_SAVES = $_SESSION["user_saved"];
		}else{
			$con = Dbcon();
			$q = "SELECT * FROM  `user_saves` WHERE (save_type='wish' AND `user`=$meid AND `status`='active')";
			$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
			$MY_SAVES = [];
			if(mysqli_num_rows($sql_query)){
				//$_SESSION["user_saved"] = $sql_query;
				while($row = mysqli_fetch_array($sql_query)){
					$st = $row["save_type"];
					$it = $row["item"];
					$MY_SAVES[$it] = $st;
				}
				$_SESSION["user_saved"] = $MY_SAVES;
			}
			mysqli_close($con);
		}
		if(isset($_SESSION["user_carted"])){
			$MY_CARTED = $_SESSION["user_carted"];
		}else{
			$con = Dbcon();
			$q = "SELECT * FROM  `user_saves` WHERE (save_type='cart' AND `user`=$meid  AND status='active')";
			$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
			$MY_CARTED = [];
			if(mysqli_num_rows($sql_query)){
				//$_SESSION["user_saved"] = $sql_query;
				while($row = mysqli_fetch_array($sql_query)){
					$st = $row["save_type"];
					$it = $row["item"];
					$MY_CARTED[$it] = $st;
				}
				$_SESSION["user_carted"] = $MY_CARTED;
			}
			mysqli_close($con);
		}
		if(isset($_SESSION["user_purchased"])){
			$MY_PURCHASED = $_SESSION["user_purchased"];
		}else{
			$con = Dbcon();
			$q = "SELECT * FROM  `user_courses` WHERE (status='active')";
			$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
			$MY_PURCHASED = [];
			if(mysqli_num_rows($sql_query)){
				//$_SESSION["user_saved"] = $sql_query;
				while($row = mysqli_fetch_array($sql_query)){
					$st = $row["item_type"];
					$it = $row["item_id"];
					$MY_PURCHASED[$it] = $st;
				}
				$_SESSION["user_purchased"] = $MY_PURCHASED;
			}
			mysqli_close($con);
		}
		if(isset($_SESSION["user_subs"])){
			$MY_SUBS = $_SESSION["user_subs"];
		}else{
			$con = Dbcon();
			$q = "SELECT * FROM  `subscriptions` WHERE (status='active')";
			$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
			$MY_SUBS = [];
			if(mysqli_num_rows($sql_query)){
				//$_SESSION["user_saved"] = $sql_query;
				while($row = mysqli_fetch_array($sql_query)){
					$st = $row["scid"];
					$it = $row["sublevel"];
					$MY_SUBS[$st] = $it;
				}
				$_SESSION["user_subs"] = $MY_SUBS;
			}
			mysqli_close($con);
		}
		/**print_r($MY_SAVES);
		print_r($MY_CARTED);
		foreach ($MY_SAVES as $key => $value) {
			echo "<br>".$key." = ".$value;
		}

		foreach ($MY_PURCHASED as $key => $value) {
			echo "<br>".$key." = ".$value;
		}
		foreach ($MY_SUBS as $key => $value) {
			echo "<br>".$key." = ".$value;
		}*/
	}else{
		$MY_SAVES = [];
		$MY_CARTED = [];
		$MY_PURCHASED = [];
		$MY_SUBS = [];
	}
?>
