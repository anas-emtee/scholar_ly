<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
	include "header.php";
	include "Course_Class.php";
	$saved_keys = array_keys($MY_SAVES);
	$carted_keys = array_keys($MY_CARTED);
	$subbed_keys = array_keys($MY_SUBS);
	$purchased_keys = array_keys($MY_PURCHASED);
	$subbed = 0;
	$purchased = 0;
	if(isset($_REQUEST["course"]) && isset($_REQUEST["csid"]) && isset($_REQUEST["cat_id"]) && isset($_REQUEST["sub_id"])){
		$course = $_REQUEST["course"];
		$csid = $_REQUEST["csid"];
		$cat_id = $_REQUEST["cat_id"];
		$sub_id = $_REQUEST["sub_id"];
		echo $course;
		$con = Dbcon();
		$sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE (`id`='$course')")or die(mysqli_error($con));
		if(mysqli_num_rows($sql_query)){
					$row = mysqli_fetch_array($sql_query);
					$saved = 0;
					$carted = 0;
					$pf = $row["promo_flag"];
					$class_level = $row["course_class_level"];
					$sub_level = $MY_SUBS[$sub_id];
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

					if(in_array($sub_id, $subbed_keys) && $class_level == $sub_level){
						$subbed = 1;
					}
		}
		mysqli_close($con);
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
								<h2><?= $row["course_title"] ?></h2>
								<p><?= $row["course_desc"] ?></p>

							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Banner Area -->
			<section class="carousel-area pb-20 pt-10 mt-1">
				<div class="overlay overlay-bg"></div>
				<div class="col-lg-12">
						<div class="mt-10 col-sm-10 col-xs-12">
							<h3>Current Lesson: <span id="np_title">None</span> </h3>
						</div>
				</div>
			</section>
			<section class="carousel-area pb-20 pt-20 mt-10">
				<div class="col-lg-12">
				<div class="row">
				<div class="col-lg-6">
					<video id="video" controls controlsList="nodownload" poster="img/banner.png" muted autoplay style="align-content: center; align-self: center; padding-top: 0px; margin-top: 0px; min-width: 100%; width:100%;"
						src="../system/media/default/welcome.mp4">
					</video>
				</div>
				<div class="col-lg-6">
					<div  style="padding:0px; min-height:51vh;  max-height:51vh; overflow-y:scroll;">
					<ul class="list-group">
							<?php
							$con = Dbcon();
							$lesson_prev = mysqli_query($con, "SELECT * FROM `lessons` WHERE (`course`='$course')")or die(mysqli_error($con));
							while($lessonp = mysqli_fetch_array($lesson_prev)){
								$lid = $lessonp["id"];
							?>
							<li class="list-group-item d-flex justify-content-between align-items-center active">
									<?= $lessonp["title"] ?>
									<span class="badge badge-primary badge-pill"><?= $lessonp["total_length"] ?></span>
							</li>
							<?php
								$up_query = mysqli_query($con, "SELECT * FROM `uploads` WHERE `lesson`='$lid'")or die(mysqli_error($con));
								if(mysqli_num_rows($up_query)) {
											//echo mysqli_num_rows($up_query);
											while($lecture = mysqli_fetch_array($up_query)) {

												$lid = $lecture["id"];
												$ltit = $lecture["title"];
												$prev = $lecture["preview"];
												$lt = $lecture["content_type"];
												$dur = $lecture["length"];
												$src = "../system/".$lecture["source"];
												$tsrc = rawurlencode($lecture["source"]);
												$icon = uploadIcon($lt);
												//$mdur = $mdur+$dur;
												if($lt == "video"){
							?>
												<a href="#" onclick="playSource('<?= $src ?>', '<?= $lid ?>', '<?= $ltit ?>'); return false;" >
													<li class="list-group-item d-flex justify-content-between align-items-center">
															<?= $icon ?>
															<?= $lecture["title"] ?>
															<span class="badge badge-primary badge-pill"><?= $dur ?></span>
													</li>
												</a>
							<?php
						}else if($lt == "text"){
							?>

												<a href="#" onclick='showText("<?= $tsrc ?>", "<?= $lid ?>", "<?= $ltit ?>"); return false;' >
													<li class="list-group-item d-flex justify-content-between align-items-center">
															<?= $icon ?>
															<?= $lecture["title"] ?>
															<span class="badge badge-primary badge-pill"><?= $dur ?></span>
													</li>
												</a>
								<?php
							}else if($lt == "activity"){
								?>
												<a href="lesson_activity.php?reference=<?= $tsrc ?>" class='colorlink' >
													<li class="list-group-item d-flex justify-content-between align-items-center">
															<?= $icon ?>
															<?= $lecture["title"] ?>
															<span class="badge badge-primary badge-pill"><?= $dur ?></span>
													</li>
												</a>
								<?php
							}else if($lt == "exercise"){
								?>
												<a href="lesson_exercise.php?reference=<?= $tsrc ?>" class='colorlink' >
													<li class="list-group-item d-flex justify-content-between align-items-center">
															<?= $icon ?>
															<?= $lecture["title"] ?>
															<span class="badge badge-primary badge-pill"><?= $dur ?></span>
													</li>
												</a>
							<?php
						}else if($lt == "quiz"){
							?>
											<a href="lesson_quiz.php?reference=<?= $tsrc ?>" class='colorlink' >
												<li class="list-group-item d-flex justify-content-between align-items-center">
														<?= $icon ?>
														<?= $lecture["title"] ?>
														<span class="badge badge-primary badge-pill"><?= $dur ?></span>
												</li>
											</a>
								<?php
							}else if($lt == "downloadable"){
								?>
												<a href="<?= $src ?>" download target="_blank">
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

							}
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
				</div>
			</section>
			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textContent" class="text-justify"> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
		<?php include "scripts.php"; ?>
		<script>
			var nowplaying = "0";
			var playSource = function(vsrc, xid, xtit){
				//alert(vsrc);
				document.getElementById('np_title').innerHTML = xtit;
				nowplaying = xid;
				var video = document.getElementById('video');

				video.setAttribute('src', vsrc);

				video.load();
				video.play();
				//video.addEventListener("timeupdate", endPreview);
			};
			var showText = function(vsrc, xid, xtit){
				var decoded = decodeURIComponent(vsrc);
				//decoded = decoded.replace(/+/g, " ");
				document.getElementById('np_title').innerHTML = xtit;
				document.getElementById('exampleModalLongTitle').innerHTML = xtit;
				document.getElementById('textContent').innerHTML = decoded;
				nowplaying = xid;
				$('#exampleModalLong').modal({
				  keyboard: false
				})
				return false;
			}
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

				$(".colorlink").colorbox({iframe:true, width:"95%", height:"95%"});
				//var video = document.getElementById('video');
				//video.addEventListener("timeupdate", endPreview);
				//video.addEventListener("pause", restartPreview);
			} );
		</script>
	</body>
</html>
