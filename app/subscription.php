<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php
	include "header.php";

	$dis_cnt = 0; $dis_code = "none"; $dis_amt = 0;
	$my_user = $_SESSION["logged_user"];
	$generated = "XXXX";
	$total_price = 0;
	$all_items = "";
	$generated = "YYYY";

	if(isset($_POST["sub_pack"])){
		$sub_item = $_POST["sub_item"];
		$subcateg = $_POST["subcateg"];
		$packid = $_POST["packid"];
		$amount = $_POST["amount"];
		$unit = $_POST["unit"];
		$package = $_POST["package"];
	}
	$total_price = $amount;

	if(isset($_POST["discountCode"])){
		echo "discountCode";
		$uid = $my_user["reg_id"];
		$code = $_POST["discountCode"];

		$con = Dbcon();
		$q = "SELECT * FROM  `discount_code` WHERE (`code`='$code' AND `applied`<`limit` AND `status`='valid' AND DATE(validity) > CURDATE())";
		$check_code = mysqli_query($con, $q)or die(mysqli_error($con));
		if(mysqli_num_rows($check_code)){
			echo "Exist";
			$row = mysqli_fetch_array($check_code);
			$valid = $row["validity"];
			$amt = $row["amount"];
			$user_dis_check = mysqli_query($con, "SELECT * FROM `user_discount` WHERE (`code`='$code' AND `user`='$uid')")or die(mysqli_error($con));
			if(mysqli_num_rows($user_dis_check) == 0){
				$user_dis = "INSERT INTO `user_discount` (`user`, `code`, `amount`, `validity`) VALUES ($uid, '$code', '$amt', '$valid')";
				if(mysqli_query($con, $user_dis)or die(mysqli_error($con))){
					$uq = "UPDATE `discount_code` SET `applied` = `applied`+1 WHERE (`code` = '$code')";
					$apply_code = mysqli_query($con, $uq)or die(mysqli_error($con));
				}
			}else{
				echo "User Used This Already";
			}

		}else{
			echo "Not Found";
		}
	}

	$con = Dbcon();
	$myid = $my_user["reg_id"];
	$discount = mysqli_query($con, "SELECT * FROM `user_discount` WHERE  (`user`='$myid' AND `status`='valid' AND DATE(validity) > CURDATE())")or die(mysqli_error($con));
	if(mysqli_num_rows($discount)){
				$dis_cnt = mysqli_num_rows($discount);
				if($dis_cnt){
					$row = mysqli_fetch_array($discount);
					$dis_code = $row["code"];
					$dis_amt = $row["amount"];
				}
	}
	mysqli_close($con);

	$total_price = $total_price - $dis_amt;
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
					<div class="row pb-50  pt-50 align-items-center justify-content-center">
						<div class="col-lg-10">
							<div class="banner-content text-center">
								<h2> Subscription </h2>

								<p class="breadcrum">
									<i class="fa fa-home"></i> &rarr;
									<a href="user_cart.php"> Subscribe </a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>
  		<!-- End Banner Area -->

			<!-- Start Carousel Area -->
  		<section class="carousel-area pb-20 pt-20 mt-10">

  			<div class="col-lg-12">
          <div class="list-group">
            <div title="Nof" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-danger">
              <div class="d-flex p-2 justify-content-center">
                <div class="input-group-icon mt-10">
									<h3>Subscription Package</h3>
								</div>
              </div>
            </div>
            <div >
                  <div title="subscribe" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <a href=""  title="<?= $package  ?>">
                          <h5 class="mb-1"><?= $package  ?></h5>
                      </a>
                      <small class="badge badge-info" style="margin-right:15px;"> <?= $unit  ?> Months</small>
                    </div>
                    <h6 class="mb-1 text-justify">
                    	<?= $subcateg  ?><br />
                    </h6>
                    <div class="d-flex flex-row justify-content-end">
                      <div class="p-2">
                        <button class="genric-btn disable circle"><i class="text-black fa fa-money"></i> <strong><?= $amount  ?> </strong></button>
                        <!--<i class="fa fa-angle-right"></i>-->
                      </div>

                    </div>
                  </div>
            </div>
            <div title="Nof" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <a href="#"  title="Total">
                    <h5 class="mb-1"> Total </h5>
                </a>
                <small>
                  <?php if($dis_cnt){ echo "<i class='fa fa-money'></i> &nbsp;" .$dis_amt." (".$dis_code.")"; }else{ ?>
                    <button data-toggle="modal" data-target="#discountCode" class="genric-btn info-border circle mr-2"><i class="text-white fa fa-trash"></i> Apply Discount Code </button>
                  <?php } ?>
                </small>
              </div>
              <h6 class="mb-1 text-justify">
                Taxes and Surcharges
              </h6>
              <div class="d-flex flex-row justify-content-end">
                <div class="p-2">
                  <button class="genric-btn disable circle"><i class="fa fa-money"></i> <strong><?= $total_price  ?></strong></button>
                  <!--<i class="fa fa-angle-right"></i>-->
                </div>
                <div class="p-2">
                  <i class="text-white fa fa-trashx"></i>
                </div>
                <div class="p-2">
                    <button onclick="formPost('checkout')" class="genric-btn success-border circle"><i class="text-white fa fa-rocket"></i> Checkout Now</button>
                </div>
                <form name="checkout" id="checkout" method="post" action="subscription_pay.php">
                  <input type="hidden" name="amount" value="<?= $total_price  ?>">
                  <input type="hidden" name="discount" value='<?= $dis_amt  ?>'>
                  <input type="hidden" name="discountCode" value='<?= $dis_code  ?>'>
									<input type="hidden" name="sub_item" value='<?= $sub_item  ?>'>
									<input type="hidden" name="subcateg" value='<?= $subcateg  ?>'>
									<input type="hidden" name="packid" value='<?= $packid  ?>'>
									<input type="hidden" name="unit" value='<?= $unit  ?>'>
									<input type="hidden" name="package" value='<?= $package  ?>'>
									<input type="hidden" name="tranxid" value='<?= $generated  ?>'>
                  <input type="hidden" name="user" value='<?= $my_user["reg_id"]  ?>'>
                  <input type="hidden" name="checkout" value='checkout'>
                </form>
              </div>
            </div>
          </div>
  			</div>
  		</section>
  		<!-- End Carousel Area -->

      <!-- Modal -->
<div id="discountCode" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Discount</h4>
      </div>
      <form method="post" novalidate action="#">
				<input type="hidden" name="sub_item" value='<?= $sub_item  ?>'>
				<input type="hidden" name="subcateg" value='<?= $subcateg  ?>'>
				<input type="hidden" required name="packid" id="packid" value='<?= $packid  ?>'>
				<input type="hidden" required name="amount" id="amount" value='<?= $amount  ?>'>
				<input type="hidden" required name="unit" id="unit" value='<?= $unit  ?>'>
				<input type="hidden" required name="package" id="package" value='<?= $package  ?>'>
				<input type="hidden" required name="sub_pack" id="package" value='<?= $packid  ?>'>
      <div class="modal-body justify-content-center">
        <div class="col-lg-12">
          <div id="mc_embed_signup">
            <div class="subscription relative">
              <input type="text" name="discountCode" placeholder="Enter Discount Code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Discount Code'" required>
              <div class="info"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="primary-btn"> Apply <span class="lnr lnr-arrow-right"></span></button>
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
      </form>
    </div>

  </div>
</div>

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
		<script>
      var formPost = function(formto){
        document.getElementById(formto).submit();
      }
      
    </script>
	</body>
</html>
