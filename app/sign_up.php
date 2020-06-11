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
  							<h2>Sign Up</h2>
								<p class="breadcrum">
                  <i class="fa fa-home"></i> &rarr;
                  <a href="sign_in.php"> Sign Up </a>
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
					<form action="register.php" method="post">
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
							<input type="text"  name="fullname" placeholder="Full Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
							<input type="text" name="email" placeholder="User Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'User Email'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
							<input type="date"  name="dob" placeholder="Date Of Birth" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date Of Birth'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
							<input type="text"  name="mobile" placeholder="Mobile Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Number'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
							<div class="form-select">
								<select name="country">
									<option value="1">Select Country</option>
									<option value="1">Nigeria</option>
									<option value="1">India</option>
									<option value="1">England</option>
									<option value="1">Srilanka</option>
								</select>
							</div>
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
							<div class="form-select">
								<select name="school" required>
									<option value="">Select Current School</option>
									<option value="Primary">Primary</option>
									<option value="Secondary">Secondary</option>
									<option value="Tertiary">Tertiary</option>
									<option value="Graduate">Graduate</option>

								</select>
							</div>
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-cubes" aria-hidden="true"></i></div>
							<input type="number"  name="level" placeholder="Class / Level" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Class / Level'" required class="single-input">
							<small class="text-white">Graduate? Please leave empty.</small>
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							<input type="password"  id="npass" name="password" placeholder="Password" onkeydown="passcheck();" onkeyup="passcheck();" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
						</div>
						<div class="input-group-icon mt-10">
							<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							<input type="password" name="cpassword"  id="cnpass" placeholder="Confirm Password" onkeydown="passcheck();" onkeyup="passcheck();" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required class="single-input">
							<small id="passinfo" class="text-warning">Password Must Match.</small>
						</div>
						<div class="mt-10 text-right" id="updatePass" style="visibility:hidden;">
							<button type="submit" name="signup" class="genric-btn danger-border circle arrow"> Sign Up <span class="lnr lnr-arrow-right"></span></button>
							<p class="text-left text-white">  </p>
						</div>
					</form>
					<script type="text/javascript">
							function passcheck() {
									//alert("check");
									if(document.getElementById('npass').value == document.getElementById('cnpass').value){
										document.getElementById('passinfo').innerHTML = "Passwords Matched!";
										document.getElementById("passinfo").classList.remove('text-warning');
										document.getElementById("passinfo").classList.add('text-success');
										document.getElementById("updatePass").setAttribute("style", "visibility:block;");
									}else{
										document.getElementById("passinfo").classList.remove('text-success');
										document.getElementById("passinfo").classList.add('text-warning');
										document.getElementById('passinfo').innerHTML = "Passwords Must Match!";
										document.getElementById("updatePass").setAttribute("style", "visibility:hidden;");

									}
									return false;
							}

					</script>
					<p class="text-right text-white"> <a class="text-white" href="sign_in.php"> Already have an account </a> </p>
  			</div>
  		</section>

  		<!-- End Carousel Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
