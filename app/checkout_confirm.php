<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php
	include "header.php";

	if(isset($_REQUEST["status"])){
		if($_REQUEST["status"] == "success"){
			$tranx_msg = "Your payment is successfully completed. Please proceed to your course page to access purchased courses.";
			$tranxid = $_REQUEST["tranxid"];
			$items = $_REQUEST["items"];
			$user = $_REQUEST["userid"];
			$code = $_REQUEST["discode"];
			$today = date("Y-m-d");
			$tranx_ref = "CDSHSJ72836";

			$con = Dbcon();
			$tranx_qr = "UPDATE `transaction_record` SET `pay_stat`='paid', `pay_date`='$today', `pay_check`='$tranx_ref' WHERE (`tranxid` = '$tranxid')";
			if(mysqli_query($con, $tranx_qr)or die(mysqli_error($con))){
				$item_list = explode('&', $items);
				foreach ($item_list as $item) {
						// code...Insert User Course
						$item_qr = "UPDATE `user_courses` SET `status`='active' WHERE (`tranxid` = '$tranxid')";
						mysqli_query($con, $item_qr)or die(mysqli_error($con));

						$cart_up = "UPDATE `user_saves` SET status = 'used' WHERE (`user` = '$user' AND `item` = '$item' AND `save_type` = 'cart')";
						mysqli_query($con, $cart_up)or die(mysqli_error($con));

						$disc_up = "UPDATE `user_discount` SET status = 'used' WHERE (`user` = '$user' AND `code` = '$code')";
						mysqli_query($con, $disc_up)or die(mysqli_error($con));
				}
			}
			mysqli_close($con);
		}
	}
?>

	<body class="dup-body">
		<div class="dup-body-wrap">
			<!-- Start Header Area -->
			<?php include "menu.php"; ?>
			<!-- End Header Area -->
			<!-- Start Contents Here -->
      <!-- Start Banner Area -->
  		<section class="generic-banner relative">
  			<div class="container">
  				<div class="row pt-50 pb-50 align-items-center justify-content-center">
  					<div class="col-lg-10">
  						<div class="banner-content text-center">
  							<h2>Check Out</h2>
								<p class="breadcrum">
                  <i class="fa fa-home"></i>
                </p>
  						</div>
  					</div>
  				</div>
  			</div>
  		</section>
  		<!-- End Banner Area -->

			<!-- Start Carousel Area -->
  		<section class="carousel-area pb-20 pt-20 mt-1" style="min-height:220px;">
				<div class="overlay overlay-bg"></div>
  			<div class="col-lg-12 text-center">
  				<h3>Payment Status</h3>
					<p> Transaction Message </p>
					<a class="mt-10" href="user_courses.php">
						<button type="submit" class="genric-btn btn-block info circle arrow">Go To My Courses <span class="pull-right fa caret-right"></span></button>
					</a>
					<!--<a href="user_courses.php">Go To My Courses</a>-->
  			</div>
  		</section>
  		<!-- End Carousel Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
