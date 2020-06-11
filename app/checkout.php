<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php
	include "header.php";

	if(isset($_POST["checkout"]) && isset($_POST["tranxid"])){
		$tranxid = $_POST["tranxid"];
		$amount = $_POST["amount"];
		$discount = $_POST["discount"];
		$discode = $_POST["discountCode"];
		$items = $_POST["items"];
		$user = $_POST["user"];
		$con = Dbcon();
		$tranx_qr = "INSERT INTO `transaction_record` (`user`, `pay_amount`, `tranxid`, `discount`, `discount_code`, `items`) VALUES ('$user', '$amount', '$tranxid', '$discount', '$discode', '$items' )";
		if(mysqli_query($con, $tranx_qr)or die(mysqli_error($con))){
			$item_list = explode('&', $items);
			foreach ($item_list as $item) {
					// code...Insert User Course
					$item_qr = "INSERT INTO `user_courses` (`user`, `item_id`, `item_type`, `tranxid`) VALUES ('$user', '$item', 'course', '$tranxid')";
					mysqli_query($con, $item_qr)or die(mysqli_error($con));


			}
		}
		mysqli_close($con);
	}
	$RETURN_URL = "checkout_confirm.php?items=".$items."&tranxid=".$tranxid."&userid=".$user."&discode=".$discode;
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
                  <i class="fa fa-home"></i> Please Confirm Transaction.
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
  			<div class="col-lg-12">
					<form action="login_auth.php" method="post">
						<input type="hidden" value="<?= $RETURN_URL ?>" name="returnurl" />
						<input type="hidden" name="amount" value="<?= $amount  ?>">
						<input type="hidden" name="discount" value='<?= $discount  ?>'>
						<input type="hidden" name="discountCode" value='<?= $discode  ?>'>
						<input type="hidden" name="items" value="<?= $items  ?>">
						<input type="hidden" name="tranxid" value='<?= $tranxid  ?>'>
						<input type="hidden" name="user" value='<?= $user  ?>'>
						<input type="hidden" name="checkout" value='checkout'>
						<div class="mt-70 col-xs-12">
							<button type="submit" name="signin" class="genric-btn btn-block danger-border circle arrow">Proceed To Payment <span class="lnr lnr-arrow-right"></span></button>
						</div>
					</form>
  			</div>
  		</section>
			<section class="carousel-area pb-20 pt-10 mt-1">
				<div class="overlay overlay-bg"></div>
  			<div class="col-lg-12">

								<a class="mt-10" href="<?= $RETURN_URL ?>&status=success">
									<button type="submit" class="genric-btn btn-block info circle arrow">Test Payment Confirmation <span class="pull-right fa caret-right"></span></button>
								</a>

  			</div>
  		</section>
  		<!-- End Carousel Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
