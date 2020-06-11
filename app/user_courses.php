<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
	include "header.php";

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
								<h2 class="text-white">My Courses</h2>
								<em class="text-white"> Active Courses Purchased By USer </em>
								<p class="text-white">
									<i class="text-white fa fa-home"></i> &rarr;
                  <a href="user_profile.php"> User Profile &rarr; </a>
                  <a href="#"> My Courses &rarr;</a>

								</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Banner Area

			<h2 class="text-center text-white border-round">My Courses</h2>-->

			<!-- Start Sample Area -->
			<div class="white-bg">
				<div class="container">
					<div class="section-top-border  pt-3">
							<div class="row">
								<?php
									$purchased_keys = array_keys($MY_PURCHASED);
									$subbed_keys = array_keys($MY_SUBS);
									if(sizeof($purchased_keys) > 0 || sizeof($subbed_keys) > 0){
										$con = Dbcon();
										foreach ($MY_PURCHASED as $key => $value) {
				              $sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `id`='$key'")or die(mysqli_error($con));
				            	if(mysqli_num_rows($sql_query)){
				            			while($row = mysqli_fetch_array($sql_query)){
														$saved = 0;
														$carted = 0;
														$pf = $row["promo_flag"];
														$sl = "0";
														$date = $row["created"];
														$price = "<span>$".$row["price"]." </span>";
														$flags = '<div class="p-2"><small><i class="fa fa-heartbeat"></i> Thrending </small></div>
														<div class="p-2"><small><i class="fa fa-usd"></i> Hot Selling</small></div>';
														if($pf == "1"){
															$price = "<del>$".$row["price"]."</del><span>$".$row["promo_price"]." </span> ";
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
														<div class="separator clear-left">
																<p class="btn-details btn-block" style="width:100%;"><i class="fa fa-list"></i><a href="course_enrol.php?course_ref=<?= $row["id"] ?>" class="hidden-sm">Go To Course</a></p>
														</div>
														<div class="clearfix">
														</div>
												</div>
										</div>
								</div>
								<?php
		                }
									}
								}
								foreach ($MY_SUBS as $key => $value) {
									$sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `sub_id`='$key'")or die(mysqli_error($con));
									if(mysqli_num_rows($sql_query)){
											while($row = mysqli_fetch_array($sql_query)){
												$saved = 0;
												$carted = 0;
												$pf = $row["promo_flag"];
												$sl = "0";
												$cl = $row["course_class_level"];
												$date = $row["created"];
												$price = "<span>$".$row["price"]." </span>";
												$flags = '<div class="p-2"><small><i class="fa fa-heartbeat"></i> Thrending </small></div>
												<div class="p-2"><small><i class="fa fa-usd"></i> Hot Selling</small></div>';
												if($pf == "1"){
													$price = "<del>$".$row["price"]."</del><span>$".$row["promo_price"]." </span> ";
												}
												if($cl == $value){
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
																		<div class="separator clear-left">
																				<p class="btn-details btn-block" style="width:100%;"><i class="fa fa-list"></i><a href="course_enrol.php?course_ref=<?= $row["id"] ?>" class="hidden-sm">Go To Course</a></p>
																		</div>
																		<div class="clearfix">
																		</div>
																</div>
														</div>
												</div>
												<?php
											}
						                }
													}
												}
								mysqli_close($con);
		            }else{
								?>
									<h3 class="mb-30">Sorry!</h3>
									<div class="col-lg-12">
										<blockquote class="generic-blockquote">
											You have not purchased or subscribed to any course. <br />

											Start buying here. Thank you.
										</blockquote>
									</div>
								<?php
								}
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
