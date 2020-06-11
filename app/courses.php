<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
	include "header.php";
	$subbed_keys = array_keys($MY_SUBS);
	$saved_keys = array_keys($MY_SAVES);
	$carted_keys = array_keys($MY_CARTED);
	$purchased_keys = array_keys($MY_PURCHASED);
	$purchased = 0;
	$subbed = 0;
	if(isset($_POST["cat_item"]) && isset($_POST["sub_item"])){
		$cat_id = $_POST["cat_item"];
		$sub_id = $_POST["sub_item"];
		$cs_id = $_POST["cs_item"];
		$cat_tit = $_POST["category"];
		$sub_tit = $_POST["subcateg"];
		$cs_tit = $_POST["topic"];

		if(in_array($sub_id, $subbed_keys)){
			$subbed = 1;
		}
	}else{
		header("Location:categories.php");
	}
	?>

	<body class="dup-body">
		<div class="dup-body-wrap">
			<!-- Start Header Area -->
			<?php include "menu.php"; ?>
			<!-- End Header Area -->
			<!-- Start Contents Here -->
			<!-- Start Banner Area -->
			<section class="generic-banner element-banner relative">
				<div class="container">
					<div class="row pt-40 pb-50 align-items-center justify-content-center">
						<div class="col-lg-10">
							<div class="banner-content text-center">
								<h2 class="text-white"><?= $cs_tit ?></h2>
								<em class="text-white"> In <?= $sub_tit ?> under <?= $cat_tit ?> </em>
								<p class="text-white">
									<i class="text-white fa fa-home"></i> &rarr;
                  <a href="categories.php"> Categories &rarr; </a>
                  <a href="sub_categories.php?item=<?= $cat_id ?>&category=<?= $cat_tit ?>"> <?= $cat_tit ?> &rarr;</a>
									<?= $sub_tit ?> &rarr;
									<?= $cs_tit ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Banner Area -->


			<h2 class="text-center text-white border mb-10">Courses</h2>

			<!-- Start Sample Area -->
			<div class="white-bg">
				<div class="container">
					<div class="section-top-border  pt-3">
							<div class="row">
								<?php
		              $con = Dbcon();
		              $sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `csid`='$cs_id' ORDER BY `course_title` ASC")or die(mysqli_error($con));
		            	if(mysqli_num_rows($sql_query)){
		            			while($row = mysqli_fetch_array($sql_query)){
												$saved = 0;
												$carted = 0;
												$pf = $row["promo_flag"];
												$class_level = $row["course_class_level"];
												$sub_level = "";//$MY_SUBS[$sub_id];
												$sl = "0";
												$date = $row["created"];
												$price = "<span>$".$row["price"]." </span>";
												$flags = '<div class="p-2"><small><i class="fa fa-heartbeat"></i> Thrending </small></div>
												<div class="p-2"><small><i class="fa fa-usd"></i> Hot Selling</small></div>';
												if($pf == "1"){
													$price = "<del>$".$row["price"]."</del><span>$".$row["promo_price"]." </span> ";
												}

												if(in_array($row["id"], $saved_keys)){
													$saved = 1;
												}

												if(in_array($row["id"], $carted_keys)){
													$carted = 1;
												}

												if(in_array($row["id"], $purchased_keys)){
													$purchased = 1;
												}

		          	?>
								<div class="col-xs-12 col-sm-6 col-md-4 mb-10">
										<div class="col-item">
												<div class="photo">
														<img src="../system/<?= $row["course_thumbnail"] ?>" class="img-responsive" alt="a" />
												</div>
												<div class="info">
														<div class="row">
																<div class="price col-md-6">
																		<h5> <?= $row["course_title"] ?></h5>
																		<h5 class="price-text-color mt-3">
																			<?= $price ?>
																		</h5>
																</div>
																<div class="rating hidden-sm col-md-6">
																		<a href="#" title="2000 Ratings">
																			<i class="price-text-color fa fa-star"></i>
																			<i class="price-text-color fa fa-star"></i>
																			<i class="price-text-color fa fa-star"></i>
																			<i class="price-text-color fa fa-star"></i>
																			<i class="fa fa-star"></i>
																		</a>
																</div>

														</div>

														<p class="text-dark text-justify">
															<?= $row["course_desc"] ?>
														</p>
														<div class="d-flex flex-row justify-content-around">
															<div class="p-2"><small><i class="fa fa-info"></i> <?= $row["course_type"] ?> </small></div>
															<?= $flags ?>
														</div>
														<?php if(($subbed && $class_level == $sub_level) || $purchased){ ?>
														<div class="separator clear-left">
															<p class="btn-details btn-block" style="width:100%;"><i class="fa fa-list"></i><a href="course_enrol.php?course_ref=<?= $row["id"] ?>" class="hidden-sm">Go To Course</a></p>
														</div>
														<?php }else{ ?>
														<div class="separator clear-left">
															  <?php if($saved){ ?>
																	<p class="btn-add"><i class="fa fa-heart"></i><span class="hidden-sm">Saved</span></p>
																<?php }else{ ?>
																	<p class="btn-add"><i class="fa fa-heart"></i><a onclick="saveItem('<?= $row["id"] ?>','course','wish','1'); return false;" href="#" id="ws<?= $row["id"] ?>" class="hidden-sm">Wish List</a></p>
																<?php } ?>
																<p class="btn-details"><i class="fa fa-list"></i><a href="course_details.php?course_ref=<?= $row["id"] ?>" class="hidden-sm">More details</a></p>
														</div>
														<?php } ?>
														<div class="clearfix">
														</div>
												</div>
										</div>
								</div>
								<?php
		                }
		            	}else{
								?>
									<h3 class="mb-30">Sorry!</h3>
									<div class="col-lg-12">
										<blockquote class="generic-blockquote">
											There are no active courses in <?= $cs_tit ?> <br />

											Please check back soon. Thank you.
										</blockquote>
									</div>
								<?php
									}
		            	mysqli_close($con);
		            ?>
							</div>
						</div>
					</div>
				</div>
				<!-- End Sample Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
