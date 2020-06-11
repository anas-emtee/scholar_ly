<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php
	include "header.php";
	include "Account_Class.php";

	$account = "Default";
	if(isset($_REQUEST["useraction"])){
		$account = $_REQUEST["useraction"];
		$subject = $_REQUEST["subject_action"];
	}
	if(isset($_REQUEST["reset_password"])){
		$check_account = $_REQUEST["user_account"];
		$new_pass = $_REQUEST["new_password"];
		$check_account = str_replace(" ", "+", $check_account);
		$con = Dbcon();
		$q = "SELECT * FROM  `user_reset` WHERE (`fingerprint`='$check_account' AND `status`='valid')";
		echo $q;
		$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
		echo mysqli_num_rows($sql_query);
		if(mysqli_num_rows($sql_query)){

				$q = "SELECT * FROM  `registered` WHERE (`account`='$check_account')";
				$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
				if(mysqli_num_rows($sql_query)){
						$row = mysqli_fetch_array($sql_query);
						//print_r($row);
						$uid = $row['reg_id'];
						$email = $row['email'];
						$new_str = $email."DGREAT91".$new_pass;
						$new_account = accountString($new_str);

						$usql = "UPDATE `registered` SET `account`='$new_account' WHERE (`account`='$check_account')";
						//echo $usql;

						if(mysqli_query($con, $usql) or die(mysqli_error($con))){
								 $result = "sign_in.php?info=Password reset is completed. Please proceed to sign in.";
								 $_SESSION["logged_user"]["account"] = $new_account;
								 $_SESSION["user_account"] = $new_account;

								 mysqli_query($con, "UPDATE `user_reset` SET `status`='Invalid' WHERE `fingerprint`='$check_account'");

						}else {
							$result = "sign_in.php?info=Password reset failed. Please proceed to sign in.";
						}
				}else{
					$result = "sign_in.php?info=Account not found. Please try again.";
				}
		}else{
			$result = "sign_in.php?info=Reset link Expired. Please try again.";
		}
		echo $result;
		//exit();
		echo "<script language='javascript' type='text/javascript'>window.open('".$result."','_self')</script>";

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
					<form action="return_reset_password.php" method="post">
						<input type="text" name="user_account" value="<?= $account ?>" />
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							<input type="password" onkeydown="passcheck();" onkeyup="passcheck();" id="pwd" name="new_password" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							<input type="password" onkeydown="passcheck();" onkeyup="passcheck();" id="pwdc" name="conf_password" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required class="single-input">
							<p style="padding-top:10px;" id="passinfo" class="text-info">Passwords Must Match</p>
						</div>
						<div class="mt-10 text-right">
							<button type="submit" disabled="true" id="reset" name="reset_password" class="genric-btn danger-border circle arrow"> Reset Password <span class="lnr lnr-arrow-right"></span></button>
							<p class="text-left text-white"> &nbsp; </p>
						</div>
					</form>
					<p class="text-white"> <a class="text-white" href="sign_up.php"> Create an Account </a> </p>
  			</div>
				<script type="text/javascript">
						function passcheck() {
								//alert("check");
								if(document.getElementById('pwdc').value == document.getElementById('pwd').value){
									document.getElementById('passinfo').innerHTML = "Passwords Matched!";
									document.getElementById('reset').disabled = false;
									document.getElementById("passinfo").classList.remove('text-info');
									document.getElementById("passinfo").classList.add('text-success');
								}else{
									document.getElementById("passinfo").classList.remove('text-success');
									document.getElementById("passinfo").classList.add('text-info');
									document.getElementById('reset').disabled = true;
									document.getElementById('passinfo').innerHTML = "Passwords Must Match!";
								}
								return false;
						}
				</script>
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
