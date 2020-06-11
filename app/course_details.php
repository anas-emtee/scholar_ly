<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
	include "header.php";
	include "Course_Class.php";
	$saved_keys = array_keys($MY_SAVES);
	$carted_keys = array_keys($MY_CARTED);
	if(isset($_REQUEST["course_ref"])){
		$course_id = $_REQUEST["course_ref"];
		$saved = 0;
		$carted = 0;
		$lesson_cnt = 0;
		$con = Dbcon();
		$sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `id`='$course_id' ORDER BY `course_title` ASC")or die(mysqli_error($con));
		if(mysqli_num_rows($sql_query)){
				  $course = mysqli_fetch_array($sql_query);
					$pf = $course["promo_flag"];
					$instid = $course["course_instructor"];
					$sl = "0";
					$date = $course["created"];
					$price = "<span>$".$course["price"]." </span>";
					$flags = '<div class="p-2"><small><i class="fa fa-heartbeat"></i> Thrending </small></div>
					<div class="p-2"><small><i class="fa fa-usd"></i> Hot Selling</small></div>';
					if($pf == "1"){
						$price = "<del>$".$course["price"]."</del><span>$".$course["promo_price"]." </span> ";
					}
					if(in_array($course["id"], $saved_keys)){
						$saved = 1;
					}

					if(in_array($course["id"], $carted_keys)){
						$carted = 1;
					}
					$inst_query = mysqli_query($con, "SELECT * FROM `instructors` WHERE `instid`='$instid'")or die(mysqli_error($con));
					if(mysqli_num_rows($inst_query)){
							  $instructor = mysqli_fetch_array($inst_query);
					}

					$lesson_query = mysqli_query($con, "SELECT * FROM `lessons` WHERE `course`='$course_id'")or die(mysqli_error($con));
					$lesson_prev = mysqli_query($con, "SELECT * FROM `lessons` WHERE `course`='$course_id'")or die(mysqli_error($con));
					if(mysqli_num_rows($lesson_query)){
								$lesson_cnt = mysqli_num_rows($lesson_query);
							  //$lessons = mysqli_fetch_array($lesson_query);
					}
			}
			mysqli_close($con);

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
			<section class="generic-banner relative">
				<div class="container">
					<div class="row pt-50 pb-50 align-items-center justify-content-center">
						<div class="col-lg-10">
							<div class="banner-content text-center">
								<h2><?= $course["course_title"] ?></h2>
								<p><?= $course["course_desc"] ?></p>
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
												<div class="d-flex flex-row justify-content-around">
													<div class="p-2"><small><i class="fa fa-info"></i> <?= $course["course_type"] ?> </small></div>
													<?= $flags ?>
												</div>
												<div class="separator clear-left">
													<?php if($carted){ ?>
														<p class="btn-add"><i class="fa fa-cart-plus"></i><span class="hidden-sm">Added</span></p>
													<?php }else{ ?>
														<p class="btn-add"><i class="fa fa-cart-plus"></i><a onclick="saveItem('<?= $course["id"] ?>','course','cart','1'); return false;" href="#" id="ws<?= $course["id"] ?>" class="hidden-sm">Add To Cart</a></p>
													<?php } ?>
													<p class="btn-details"><i class="fa fa-check-circle"></i><a href="course_details.php?course_ref=<?= $course["id"] ?>" class="hidden-sm">Buy Now</a></p>
												</div>
												<div class="clearfix"></div>
												<div class="separator clear-left" style="margin-top:10px;">
														<p class="btn-add"><i class="fa fa-eye"></i><a href="#" data-toggle="modal" data-target="#myModal" class="hidden-sm">Preview</a></p>
														<p class="btn-details"><i class="fa fa-sign-in"></i><a href='course_enrol.php?course_ref=<?= $course["id"] ?>' class="hidden-sm">Enroll</a></p>
												</div>
												<div class="clearfix"></div>
										</div>
								</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Start Align Area -->
			<div class="white-bg mb-2">
				<div class="container ">
					<div class="section-top-border pt-3">
						<h3 class="mt-10 mb-30">Learning Outcomes</h3>
						<div class="row">
							<div class="col-md-12 mt-sm-20">
									<p class="text-justify"> At the end of this course, you will learn: </p>
									<?php
										$lo = $course["outcomes"];
										$locs = explode("|", $lo);
										foreach ($locs as $outcome) {
									?>
									<blockquote class="generic-blockquote">
										<?= $outcome ?>
									</blockquote>
									<?php
										}
									 ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Start Align Area -->
			<div class="white-bg mb-2">
				<div class="container ">
					<div class="section-top-border pt-3">
						<h3 class="mt-10 mb-30">Class Curriculum</h3>
						<div class="d-flex flex-row justify-content-around border">
							<div class="p-2"><small><i class="fa fa-info"></i> <?= $lesson_cnt ?> Lessons </small></div>
							<div class="p-2"><small><i class="fa fa-info"></i> <span id="uc"></span> Lectures </small></div>
							<div class="p-2"><small><i class="fa fa-info"></i> Duration <span id="mdur"></span> </small></div>
						</div>
						<div class="row">
							<div class="col-md-12 mt-sm-20 pt-10">
									<!--<p class="text-justify"> Lessons Provided In The Class: </p>-->

									<?php if($lesson_cnt > 0) { ?>
											<div class="panel-group" id="accordion">
											<?php
											$uc = 0;
											$mdur = 0;
											while($lesson = mysqli_fetch_array($lesson_query)){ ?>
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $lesson["id"] ?>">
																<?= $lesson["title"] ?> <span class="pull-right"><?= $lesson["total_length"] ?> <span>
															</a>
														</h4>
													</div>
													<div id="collapse<?= $lesson["id"] ?>" class="panel-collapse collapse in">
														<div class="panel-body" style="padding:0px;">
															<ul class="list-group">
																  <?php
																	$lid = $lesson["id"];

																	$con = Dbcon();
																	$up_query = mysqli_query($con, "SELECT * FROM `uploads` WHERE `lesson`='$lid'")or die(mysqli_error($con));
																	if(mysqli_num_rows($up_query)) {
																				//echo mysqli_num_rows($up_query);
																				while($lecture = mysqli_fetch_array($up_query)) {
																					$uc = $uc+1;
																					$prev = $lecture["preview"];
																					$lt = $lecture["content_type"];
																					$dur = $lecture["length"];
																					$src = "../system/".$lecture["source"];
																					$icon = uploadIcon($lt);
																					$mdur = $mdur+$dur;

																	?>
																	<li class="list-group-item d-flex justify-content-between align-items-center">
																			<?= $icon ?>
																			<?= $lecture["title"] ?>
																			<span class="badge badge-primary badge-pill"><?= $dur ?></span>
																	</li>
																	<?php
																				}
																	} else {
																	?>
																	<li class="list-group-item d-flex justify-content-between align-items-center">
																			No Lectures Uploaded
																			<span class="badge badge-primary badge-pill">0</span>
																	</li>
																	<?php
																	}
																	echo "<script>document.getElementById('uc').innerHTML = '".$uc."'</script>";
																	echo "<script>document.getElementById('mdur').innerHTML = '".$mdur."'</script>";
																	mysqli_close($con);
																	?>

																	<!--<li class="list-group-item d-flex justify-content-between align-items-center">
																			Dapibus ac facilisis in
																			<span class="badge badge-primary badge-pill">2</span>
																	</li>
																	<li class="list-group-item d-flex justify-content-between align-items-center">
																			Morbi leo risus
																			<span class="badge badge-primary badge-pill">1</span>
																	</li>-->
															</ul>

														</div>
													</div>
												</div>
											<?php } ?>
											</div>
									<?php } else { ?>
										<div class="row">
											<div class="col-lg-12">
												<blockquote class="generic-blockquote">
													Lessons are yet to start for this class<br />

													Please check back soon. Thank you.
												</blockquote>
											</div>
										</div>
									<?php } ?>

						</div>
					</div>
				</div>
			</div>
			<!-- Start Align Area -->
			<div class="white-bg mb-2">
				<div class="container ">
					<div class="section-top-border pt-3">
						<h3 class="mt-10 mb-30">Tools and Requirements</h3>
						<div class="row">
							<div class="col-md-12 mt-sm-20">
								<?php
									$tl = $course["tools"];
									$tools = explode("|", $tl);
									foreach ($tools as $tool) {
								?>
								<blockquote class="generic-blockquote">
									<?= $tool ?>
								</blockquote>
								<?php
									}
								 ?>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- Start Align Area -->
			<div class="white-bg ">
				<div class="container ">
					<div class="section-top-border pt-3">
						<h3 class="mt-10 mb-30">Descriptions</h3>
						<div class="row">
							<div class="col-md-12 mt-sm-20">
								<p class="text-justify">Recently, the US Federal government banned online casinos from operating in America by making it illegal to transfer money to them through any US bank or payment system. As a result of this law, most of the popular online casino networks such as Party Gaming and PlayTech left the United States. Overnight, online casino players found themselves being chased by the Federal government. But, after a fortnight, the online casino industry came up with a solution and new online casinos started taking root. These began to operate under a different business umbrella, and by doing that, rendered the transfer of money to and from them legal. A major part of this was enlisting electronic banking systems that would accept this new clarification and start doing business with me. Listed in this article are the electronic banking systems that accept players from the United States that wish to play in online casinos.</p>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!--Instructor -->
			<div class="white-bg mb-2 mt-2">
				<div class="container ">
					<div class="row">
						<div class="col-lg-12 mb-10">
	            <div class="col-item">
								<h5 class="text-center border mb-2" style="padding:20px; background:gray;"> About The Instructor </h5>
                <div class="photo">
                    <img src="../system/<?= $instructor["prof_image"] ?>" style="max-height:200px; max-width:200px;"  class="img-fluid img-responsive" alt="a" />
                </div>
                <div class="info">
                    <div class="row">
                        <div class="price col-md-6">
                            <h5> <?= $instructor["name"] ?></h5>
                            <h5 class="price-text-color"><?= $instructor["occupation"] ?></h5>
                        </div>
                        <div class="rating hidden-sm col-md-6">
                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                            </i><i class="fa fa-star"></i>
                        </div>
                    </div>
										<p class="text-dark text-justify">
											<?= $instructor["profile"] ?>
										</p>
										<div class="d-flex flex-row justify-content-around">
											<div class="p-2"><small><i class="fa fa-info"></i> Courses </small></div>
											<div class="p-2"><small><i class="fa fa-info"></i> Reviews </small></div>
											<div class="p-2"><small><i class="fa fa-info"></i> Enrolled </small></div>
										</div>
                    <div class="separator clear-left">

                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Modal Header</h4>
	        </div>
	        <div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<video id="video" muted autoplay style="align-content: center; align-self: center; padding-top: 0px; margin-top: 0px; min-width: 100%; width:100%;"
									src="../system/media/default/welcome.mp4">
								</video>
							</div>
						</div>
	        </div>
					<div class="modal-body border" style="padding:0px; min-height:42vh;  max-height:42vh; overflow-y:scroll;">
						<ul class="list-group">
								<?php
								while($lessonp = mysqli_fetch_array($lesson_prev)){
									$lid = $lessonp["id"];
									$con = Dbcon();
									$up_query = mysqli_query($con, "SELECT * FROM `uploads` WHERE `lesson`='$lid'")or die(mysqli_error($con));
									if(mysqli_num_rows($up_query)) {
												//echo mysqli_num_rows($up_query);
												while($lecture = mysqli_fetch_array($up_query)) {
													$uc = $uc+1;
													$prev = $lecture["preview"];
													$lt = $lecture["content_type"];
													$dur = $lecture["length"];
													$src = "../system/".$lecture["source"];
													$icon = uploadIcon($lt);
													$mdur = $mdur+$dur;
													if($lt == "video"){
								?>
													<a href="#" onclick="playSource('<?= $src ?>')" >
														<li class="list-group-item d-flex justify-content-between align-items-center">
																<?= $icon ?>
																<?= $lecture["title"] ?>
																<span class="badge badge-primary badge-pill"><?= $dur ?></span>
														</li>
													</a>
								<?php
													}
												}
											} else {
								?>
													<li class="list-group-item d-flex justify-content-between align-items-center">
															No Preview Lectures Uploaded
															<span class="badge badge-primary badge-pill">0</span>
													</li>
								<?php
									}
									mysqli_close($con);
								}
								?>

								<!--<li class="list-group-item d-flex justify-content-between align-items-center">
										Dapibus ac facilisis in
										<span class="badge badge-primary badge-pill">2</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
										Morbi leo risus
										<span class="badge badge-primary badge-pill">1</span>
								</li>-->
						</ul>


	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	  </div>
			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
		<script>
			var playSource = function(vsrc){
				//alert(vsrc);
				var video = document.getElementById('video');

				video.setAttribute('src', vsrc);

				video.load();
				video.play();
				video.addEventListener("timeupdate", endPreview);
			};
			var endPreview = function(){
			    if(this.currentTime >= 12) {
			        this.pause();
			    }
			};
			var restartPreview = function(){
			    if(this.currentTime >= 12) {
			        this.currentTime = 1;
							//this.load();
			    }
			};
			$(document).ready(function() {
				$("video").bind("contextmenu",function(){
						return false;
				});
				var video = document.getElementById('video');
				video.addEventListener("timeupdate", endPreview);
				video.addEventListener("pause", restartPreview);
			} );
		</script>
	</body>
</html>
