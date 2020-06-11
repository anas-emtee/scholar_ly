<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
		include "header.php";
		$uid = "0";
		$quiz_count = 0;
		$next = 0;
		$status = "complete";
		$con = Dbcon();
		if(isset($_REQUEST["reference"])){
			$qcode = $_REQUEST["reference"];
			$sql_query = mysqli_query($con, "SELECT * FROM `uploads` WHERE (`source`='$qcode' AND `content_type`='quiz')")or die(mysqli_error($con));
			if(mysqli_num_rows($sql_query)){
					$upload = mysqli_fetch_array($sql_query);
					$uid = $upload["id"];
			}
			if($uid != "0"){
				$q_query = mysqli_query($con, "SELECT * FROM `quizes` WHERE (`quiz_code`='$qcode')")or die(mysqli_error($con));
				if(mysqli_num_rows($q_query)){
					$quiz_count = mysqli_num_rows($q_query);
				}
			}else{
				//go to not found with message
			}

		}
		if(isset($_REQUEST["confirm_answer"])){
			$uid = $meid;
			$quid = $_REQUEST["quid"];
			$qc = $_REQUEST["qcode"];
			$ans = $_REQUEST["answer"];
			$check = $_REQUEST["answer_check"];
			$res = "failed";
			if($ans == $check){ $res = "passed"; }

			$usql =  "INSERT INTO `user_answers` (`user_id`, `question`, `qid`,`answer`, `result`) VALUES ('$uid','$qc','$quid','$ans','$res')";
	  	if (mysqli_query($con,$usql) or die(mysqli_error($con))){
				$message = "Answer Recorded!";
			}

		}
	?>

	<body class="dup-body">
		<div class="dup-body-wrap">
			<!-- Start Contents Here -->
			<!-- Start Banner Area -->
			<!--<section class="generic-banner element-banner relative">
				<div class="container ">
					<div class="row pb-50 align-items-center justify-content-center">
						<div class="col-lg-10">
							<div class="banner-content text-center">
								<h2 class="text-white">Quiz : </h2>
								<p class="text-white"><?= $upload["subtitle"] ?></p>
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
							<h3 class="text-white text-justify">Quiz : <?= $upload["title"] ?></h3>
							<h5> Total Questions : <?= $quiz_count  ?> </h5>
						</div>
				</div>
			</section>
			<div class="pt-1">
				<div class="row">
					<div class="col-lg-12">
						<blockquote class="generic-blockquote">
							<h3>Instructions :</h3>
							<p class="text-justify"> <?= $upload["subtitle"] ?></p>
						</blockquote>
					</div>
				</div>
			</div>

			<div class="pt-1">
				<div class="row">
					<div class="col-lg-12">
						<?php
						while($question = mysqli_fetch_array($q_query)){
							$next = $next + 1;
							$qid = $question["id"];
							$ans_query = mysqli_query($con, "SELECT * FROM `user_answers` WHERE (`qid`='$qid' AND `user_id`='$meid')")or die(mysqli_error($con));
							if(mysqli_num_rows($ans_query)){
									$answer = mysqli_fetch_array($ans_query);
									$res = $answer["result"];
									$res_col = "text danger";
									$res_icon = "<i class='fa fa-times'></i>";

									if($res == "passed"){
										$res_col = "text-success";
										$res_icon = "<i class='fa fa-check'></i>";
									}
						?>
						<blockquote class="generic-blockquote">
								<h3>Question <?= $next ?> of <?= $quiz_count  ?> :</h3>
								<p class="text-justify"> <?= $question["question"] ?> </p><br />
								<h5 class="<?= $res_col ?>">Your Answer : <?= $answer["answer"] ?> <?= $res_icon ?></h5>
						</blockquote>
						<?php
							}else{
								$status = "incomplete";
						?>
						<blockquote class="generic-blockquote">
							<h3>Question <?= $next ?> of <?= $quiz_count  ?> :</h3>
							<p class="text-justify"> <?= $question["question"] ?></p>
							<form action="#" method="post">
								<input type="hidden" name="quid" value='<?= $question["id"] ?>' />
								<input type="hidden" name="qcode" value='<?= $question["quiz_code"] ?>' />
								<input type="hidden" name="answer_check" value='<?= $question["opt_right"] ?>' />
								<div class="row" style="padding:20px;">
									<div class="switch-wrap d-flex flex-row justify-content-between">
											<p style="padding-right:10px; padding-left:10px;">A. <?= $question["opt_a"] ?></p>
											<div class="confirm-radio">
												<input name="answer" type="radio" value="<?= $question["opt_a"] ?>" id="confirm-radio">
												<label for="confirm-radio"></label>
											</div>
									</div>
									<div class="switch-wrap d-flex flex-row justify-content-between">
											<p style="padding-right:10px; padding-left:10px;">B. <?= $question["opt_b"] ?></p>
											<div class="confirm-radio">
												<input name="answer" type="radio" value="<?= $question["opt_b"] ?>" id="confirm-radio1">
												<label for="confirm-radio1"></label>
											</div>
									</div>
									<div class="switch-wrap d-flex flex-row justify-content-between">
											<p style="padding-right:10px; padding-left:10px;">C. <?= $question["opt_c"] ?></p>
											<div class="confirm-radio">
												<input name="answer" type="radio" value="<?= $question["opt_c"] ?>" id="confirm-radio2">
												<label for="confirm-radio2"></label>
											</div>
									</div>
									<div class="switch-wrap d-flex flex-row justify-content-between">
											<p style="padding-right:10px; padding-left:10px;">D. <?= $question["opt_d"] ?></p>
											<div class="confirm-radio">
												<input name="answer" type="radio" value="<?= $question["opt_d"] ?>" id="confirm-radio3">
												<label for="confirm-radio3"></label>
											</div>
									</div>
									<div class="switch-wrap d-flex flex-row justify-content-between">
											<p style="padding-right:10px; padding-left:10px;">E. <?= $question["opt_e"] ?></p>
											<div class="confirm-radio">
												<input name="answer" type="radio" value="<?= $question["opt_e"] ?>" id="confirm-radio4">
												<label for="confirm-radio4"></label>
											</div>
									</div>
								</div>
								<div class="col-xs-12 mt-20">
									<button name="confirm_answer" class="genric-btn success-border circle arrow"> Confirm Answer<span class="lnr lnr-arrow-right"></span></button>
								</div>
							</form>
						</blockquote>
						<?php
							break;
							}
						}
						mysqli_close($con);
						?>
					</div>
				</div>
			</div>
			<?php if($status == "complete"){ ?>
				<div class="pt-1">
					<div class="row">
						<div class="col-lg-12">
							<blockquote class="generic-blockquote">
								<h3>Completed !</h3>
								<p class="text-justify"> Please proceed to next activity. You can close this window by clicking the <i class="fa fa-times"></i> on the lower right corner.</p>
							</blockquote>
						</div>
					</div>
				</div>
			<?php } ?>
			<!-- End Contents Here -->

		</div>
		<?php include "scripts.php"; ?>
	</body>
</html>
