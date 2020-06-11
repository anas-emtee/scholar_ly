<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php include "header.php"; ?>

		<body>
			<div class="oz-body-wrap">
			<!-- Start Header Area -->
			<?php include "menu.php"; ?>
			<!-- End Header Area -->
			<!-- Start Contents Here -->

			<!-- Start Banner Area -->
			<section class="banner-area relative">
				<div class="container">
					<div class="row fullscreen align-items-center justify-content-center">
						<div class="banner-left col-lg-6">
							<img class="d-flex mx-auto img-fluid" src="img/banner.png" alt="">
						</div>
						<div class="col-lg-6">
							<div class="story-content">
								<h6 class="text-uppercase">From the for User interface</h6>
								<h2>Leverage your <span class="sp-1">expartise</span><br>
								Become an <span class="sp-2">Instructor</span></h2>
								<?php if($HLOGGED){ ?>
									<a href="instructor_reg.php" class="genric-btn primary circle arrow">Get Started<span class="lnr lnr-arrow-right"></span></a>
								<?php }else{ ?>
									<a href="#" class="genric-btn primary circle arrow">Get Started <span class="lnr lnr-arrow-right"></span></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Banner Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
