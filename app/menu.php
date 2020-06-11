<?php
	$LOGGED = isset($_SESSION["logged"]);
	if($LOGGED){
		$logged_type = $_SESSION["user_type"];
	}
?>
<!-- Start Header Area -->
<header class="default-header">
	<div class="header-wrap">
		<div class="header-top d-flex justify-content-between align-items-center">
			<div class="logo">
				<a href="../index.php"><img src="img/logo.png" alt=""></a>
			</div>
			<div class="main-menubar d-flex align-items-center">
				<nav class="hide">
					<a href="main.php">Home</a>
					<!--<a href="about.php">AboutUs</a>
					<a href="policies.php">OurPolicies</a>-->
					<a href="categories.php">Classes</a>
					<?php if($LOGGED && $logged_type == "user"){ ?>
						<a href="user_profile.php" class="text-info">Profile</a>
						<?php if(sizeof($MY_CARTED) > 0){ ?>
							<a href="user_cart.php" class="text-info">Cart</a>
						<?php } ?>
						<a href="sign_out.php" class="text-info">SignOut</a>
					<?php }else if($LOGGED && $logged_type == "instructor"){ ?>
						<a href="sign_in.php" class="text-info">Account</a>
						<a href="sign_out.php" class="text-info">SignOut</a>
					<?php }else if($LOGGED && $logged_type == "administrator"){ ?>
						<a href="sign_in.php" class="text-info">Admin</a>
						<a href="sign_out.php" class="text-info">SignOut</a>
					<?php }else{ ?>
						<a href="sign_in.php" class="text-info">Sign In</a>
					<?php } ?>
				</nav>
				<div class="menu-bar"><span class="lnr lnr-menu"></span></div>
			</div>
		</div>
	</div>
</header>
<!-- End Header Area -->
