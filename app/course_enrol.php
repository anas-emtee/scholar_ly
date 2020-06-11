<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
	include "header.php";
	$purchased_keys = array_keys($MY_PURCHASED);
	$subbed_keys = array_keys($MY_SUBS);
	$subbed = 0;
	$sub_level = 0;
	if(isset($_REQUEST["course_ref"])){
			$course_id = $_REQUEST["course_ref"];

			$lesson_cnt = 0;
			$con = Dbcon();
			$sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `id`='$course_id' ORDER BY `course_title` ASC")or die(mysqli_error($con));
			if(mysqli_num_rows($sql_query)){
					  $course = mysqli_fetch_array($sql_query);
						$pf = $course["promo_flag"];
						$sub_id = $course["sub_id"];
						$class_level = $course["course_class_level"];
						$instid = $course["course_instructor"];
						$sub_level = $MY_SUBS[$sub_id];
						$sl = "0";
						$date = $course["created"];
						$price = "<span>$".$course["price"]." </span>";
						$flags = '<div class="p-2"><small><i class="fa fa-heartbeat"></i> Thrending </small></div>
						<div class="p-2"><small><i class="fa fa-usd"></i> Hot Selling</small></div>';
						if($pf == "1"){
							$price = "<del>$".$course["price"]."</del><span>$".$course["promo_price"]." </span> ";
						}

						$inst_query = mysqli_query($con, "SELECT * FROM `instructors` WHERE `instid`='$instid'")or die(mysqli_error($con));
						if(mysqli_num_rows($inst_query)){
								  $instructor = mysqli_fetch_array($inst_query);
						}

						/**$purchase_query = mysqli_query($con, "SELECT * FROM `instructors` WHERE `instid`='$instid'")or die(mysqli_error($con));
						if(mysqli_num_rows($inst_query)){
								  $instructor = mysqli_fetch_array($inst_query);
						}**/

						if(in_array($sub_id, $subbed_keys) && $class_level == $sub_level){
							$subbed = 1;
						}
			}else{
				header("Location:categories.php");
			}
			mysqli_close($con);
	}else{
		header("Location:categories.php");
	}
	?>

	<body class="dup-body">
		<div class="dup-body-wrap">
			<!-- Start Header Area dgreat91@gmail.com-->
			<?php include "menu.php"; ?>
			<!-- End Header Area -->
			<!-- Start Contents Here -->

			<!-- Start Banner Area -->
			<section class="generic-banner relative">
				<div class="container">
					<div class="row pt-50 pb-50 align-items-center justify-content-center">
						<div class="col-lg-10">
							<div class="banner-content text-center">
								<h2><?= $course["course_title"] ?></h2>
								<p><?= $course["course_desc"] ?> <?= $subbed ?></p>
								<small> By: <?= $instructor["name"] ?> </small>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Banner Area -->

			<div class="white-bg mb-2 mt-2">
				<div class="container ">
					<div class="row">
						<div class="col-lg-12 mb-10 mt-10">
								<div class="col-item">
										<div class="photo">
												<img src="../system/<?= $course["course_thumbnail"] ?>" style="max-height:400px" class="img-responsive img-fluid" alt="a" />
										</div>
										<div class="info">
												<div class="row">
														<div class="price col-md-6">
																<h5> <?= $course["course_title"] ?></h5>
																<h5 class="price-text-color mt-3">
																	<?= $price ?>
																</h5>
														</div>

														<div class="rating hidden-sm col-md-6">
																<i class="price-text-color fa fa-star"></i>
																<i class="price-text-color fa fa-star"></i>
																<i class="price-text-color fa fa-star"></i>
																<i class="price-text-color fa fa-star"></i>
																<i class="fa fa-star"></i>
														</div>
												</div>

												<p class="text-dark text-justify">
														<?= $course["course_desc"] ?>
												</p>
												<p class="text-dark text-right">
														Created By : <?= $instructor["name"] ?>
														<br><i class="price-text-color"><?= $instructor["occupation"] ?></i>
												</p>
												<div class="d-flex flex-row justify-content-around">
													<div class="p-2"><small><i class="fa fa-info"></i> <?= $course["course_type"] ?> </small></div>
													<?= $flags ?>
												</div>
												<?php if (in_array($course_id, $purchased_keys) || $subbed){ ?>
													<div class="separator clear-left"  style="margin-top:10px;">
															<form id="enrol" action="course_full_access.php" method="get">
																<input type="hidden" value="<?= $course["id"] ?>" name="course" />
																<input type="hidden" value="<?= $course["csid"] ?>" name="csid" />
																<input type="hidden" value="<?= $course["cat_id"] ?>" name="cat_id" />
																<input type="hidden" value="<?= $course["sub_id"] ?>" name="sub_id" />
																<input type="hidden" value="<?= $instructor["instid"] ?>" name="instructor" />
															</form>
															<p class="btn-details" style="width:100%;"><i class="fa fa-sign-in"></i><a onclick="submitForm('enrol'); return false;" href="#" class="hidden-sm">Start Taking This Class</a></p>
													</div>
												<?php }else{ ?>
												<div class="separator clear-left">
														<p class="btn-add"><i class="fa fa-cart-plus"></i><a href="" class="hidden-sm">Add to cart</a></p>
														<p class="btn-details"><i class="fa fa-check-circle"></i><a href="course_details.php?course_ref=<?= $course["id"] ?>" class="hidden-sm">Buy Now</a></p>
												</div>
												<?php } ?>
												<div class="clearfix"></div>
										</div>
								</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Purchase Check -->
			<div class="white-bg mb-2">
				<div class="container ">
					<div class="section-top-border pt-3">
						<h3 class="mt-10 mb-30">Purchase Info!</h3>
						<div class="row">
							<div class="col-md-12 mt-sm-20">
									<blockquote class="generic-blockquote">
										<?php if (in_array($course_id, $purchased_keys)){ ?>
											You already purchased this course. Have fun learning.
										<?php }else{ ?>
											You have to purchase this course or subscribe to its parent category iin order to enroll. Thank you.
										<?php } ?>
									</blockquote>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
		<script>
			var submitForm = function(fid){
				//alert(fid);
				document.getElementById(fid).submit();
			};
		</script>
	</body>
</html>
