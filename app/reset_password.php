<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php
	include "header.php";
	include "Category_Class.php";

	$user_to = "Default";

	if(isset($_REQUEST["reset_password"])){
		$un = $_REQUEST["username"];

		$con = Dbcon();

		$q = "SELECT * FROM  `registered` WHERE (`email`='$un')";
		$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
		if(mysqli_num_rows($sql_query)){
				$row = mysqli_fetch_array($sql_query);
				//print_r($row);
				$uid = $row['reg_id'];
				$email = $row['email'];
				$account = $row['account'];

				$email_text = file_get_contents("reset_password_email.txt");

				mysqli_query($con, "INSERT INTO `user_reset` (`user`, `fingerprint`, `email`) VALUES ('$uid','$account','$email')");
				$emlink = "htp://anas.alpsgateway.com/app/return_reset_password.php?useraction=".$account."&subject_action=".md5($uid)."&quickhashintcheck=".md5($email);
				$msgcont = str_replace("[LINK]", $emlink, $email_text);
				SendMail($email, $msgcont, "My System Password Reset");
				echo "<script language='javascript' type='text/javascript'>window.open('reset_password.php?info=An email has been sent to you. Follow the link to reset your password.','_self')</script>";

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
  							<h2>Reset User Password</h2>
								<p class="breadcrum">
                  <i class="fa fa-home"></i> &rarr;
                  <a href="sign_in.php"> Reset User Password </a>
                </p>
  						</div>
  					</div>
  				</div>
  			</div>
  		</section>
  		<!-- End Banner Area -->

			<!-- Start Carousel Area -->
  		<section class="carousel-area pb-20 pt-20 mt-1" style="min-height:300px;">
				<div class="overlay overlay-bg"></div>
  			<div class="col-lg-12">
					<form action="reset_password.php" method="post">
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
							<input type="text" name="username" placeholder="User Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'User Email'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<br />
						</div>
						<div class="mt-10 text-right">
							<button type="submit" name="reset_password" class="genric-btn danger-border circle arrow"> Reset Password <span class="lnr lnr-arrow-right"></span></button>
							<p class="text-left text-white"> &nbsp; </p>
						</div>
					</form>
					<p class="text-white"> <a class="text-white" href="sign_up.php"> Create an Account </a> </p>
  			</div>
  		</section>
			<section class="carousel-area pb-20 pt-10 mt-1">
				<div class="overlay overlay-bg"></div>
  			<div class="col-lg-12">
						<div class="row">
							<div class="mt-10 col-sm-4 col-xs-12">
								<button type="submit" class="genric-btn btn-block info circle arrow">Sign In With Facebook <span class="pull-right fa fa-facebook"></span></button>
							</div>
							<div class="mt-10  col-sm-4 col-xs-12">
								<button type="submit" class="genric-btn btn-block info-border circle arrow">Sign In With Twitter <span class="pull-right fa fa-twitter"></span></button>
							</div>
							<div class="mt-10 col-sm-4 col-xs-12">
								<button type="submit" class="genric-btn btn-block primary circle arrow">Sign In With Google <span class="pull-right fa fa-google"></span></button>
							</div>
						</div>
  			</div>
  		</section>
  		<!-- End Carousel Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
