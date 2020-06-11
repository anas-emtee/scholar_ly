<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php
	include "header.php";
	include "Category_Class.php";

	$user_to = "Default";
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
  							<h2>Sign In</h2>
								<p class="breadcrum">
                  <i class="fa fa-home"></i> &rarr;
                  <a href="sign_in.php"> Sign In </a>
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
						<input type="hidden" value="<?= $user_to ?>" name="user_to" />
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
							<input type="text" name="username" placeholder="User Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'User Email'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							<input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
						</div>
						<div class="mt-10 text-right">
							<button type="submit" name="signin" class="genric-btn danger-border circle arrow"> Sign In <span class="lnr lnr-arrow-right"></span></button>
							<p class="text-left text-white"> <a class="text-white" href="reset_password.php"> Forgot Password? </a> </p>
						</div>
					</form>
					<p class="text-right text-white"> <a class="text-white" href="sign_up.php"> Create an Account </a> </p>
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
