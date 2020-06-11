<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
		include "header.php";
		if($HLOGGED){
			$logged_user = $_SESSION["logged_user"];
		}
	?>

		<body>
			<div class="oz-body-wrap">
			<!-- Start Header Area -->
			<?php include "menu.php"; ?>
			<!-- End Header Area -->
			<!-- Start Contents Here -->

			<!-- Start Banner Area -->
			<section class="generic-banner relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row pt-100 pb-100 align-items-center justify-content-center">
						<div class="col-lg-10">
							<div class="banner-content text-center">
								<h2>The Generic Page</h2>
								<p>It won’t be a bigger problem to find one video game lover in your <br> neighbor. Since the introduction of Virtual Game.</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Banner Area -->

			<!-- Start Conatct- Area -->
			<section class="contact-area pt-100 pb-100 relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-center text-center">
						<div class="single-contact col-lg-6 col-md-8">
							<p class="text-white">
								Most people who work in an office environment, buy computer products.
							</p>
						</div>
					</div>
					<form action="#" method="post" class="contact-form">
						<input type="hidden" name="regid" value="<?= $logged_user['reg_id'] ?>" />
						<input type="hidden" name="profimg" value="<?= $logged_user['prof_pic'] ?>" />
						<input type="hidden" name="account" value="<?= $logged_user['account'] ?>" />
						<div class="row justify-content-center">
							<div class="col-lg-5">
								<input name="fname" value="<?= $logged_user['fullname'] ?>" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mt-20" required="" type="text">
							</div>
							<div class="col-lg-5">
								<input name="email" value="<?= $logged_user['email'] ?>" placeholder="Enter email address"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mt-20" required="" type="text">
							</div>
							<div class="col-lg-10">
								<input name="occupation" placeholder="Expertise / Title" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Expertise / Title'" class="common-input mt-20" required="" type="text">
							</div>
							<div class="col-lg-10">
								<textarea class="common-textarea mt-20" name="message" placeholder="Instructor Profile" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Instructor Profile'" required=""></textarea>
							</div>
							<div class="col-lg-10 d-flex justify-content-end">
								<button class="primary-btn white-bg d-inline-flex align-items-center mt-20"><span class="mr-10">Send Message</span><span class="lnr lnr-arrow-right"></span></button> <br>
							</div>
							<div class="alert-msg"></div>
						</div>
					</form>
				</div>
			</section>
			<!-- End Conatct- Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
