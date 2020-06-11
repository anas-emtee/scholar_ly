<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
	include "header.php";
	include "Account_Class.php";
	?>

	<body class="dup-body">
		<div class="dup-body-wrap">
			<!-- Start Header Area -->
			<?php include "menu.php"; ?>
			<!-- End Header Area -->
			<!-- Start Contents Here -->
			<?php
				if(isset($_POST["update"])){
					$uid = $_POST["userid"];
					$fullname = $_POST["fullname"];
					$email = $_POST["email"];
					$dob = $_POST["dob"];
					$mobile = $_POST["mobile"];
					$country = $_POST["country"];
					$school = $_POST["school"];
					$level = $_POST["level"];

					$con = Dbcon();
					$usql = "UPDATE `registered` SET `fullname`='$fullname', `email`='$email', `dob`='$dob', `mobile`='$mobile', `country`='$country', `school`='$school', `level`='$level' WHERE `reg_id`=$uid";
					//echo $usql;

					if(mysqli_query($con, $usql) or die(mysqli_error($con))){
							 $result = 'success';
							 $_SESSION["logged_user"]["fullname"] = $fullname;
							 $_SESSION["logged_user"]["email"] = $email;
							 $_SESSION["logged_user"]["dob"] = $dob;
							 $_SESSION["logged_user"]["mobile"] = $mobile;
							 $_SESSION["logged_user"]["country"] = $country;
							 $_SESSION["logged_user"]["school"] = $school;
							 $_SESSION["logged_user"]["level"] = $level;
					}else{
						$result = 'failed';
					}
					mysqli_close($con);
				}
				if(isset($_POST["updatePass"])){
					$uid = $_POST["userid"];
					$username = $_POST["username"];
					$password = $_POST["epass"];
					$new_pass = $_POST["npass"];
					//$com_pass = $_POST["dob"];
					$acc_str = $username."DGREAT91".$password;
					$new_str = $username."DGREAT91".$new_pass;
					$check_account = $_SESSION["user_account"];

					$account = accountString($acc_str);
					$new_account = accountString($new_str);
					$con = Dbcon();

					//echo $account;
					//echo "<br>".$check_account;
					//echo "<br>".$new_account;

					if($account == $check_account){
						$usql = "UPDATE `registered` SET `account`='$new_account' WHERE `account`='$check_account' AND `reg_id`=$uid";
						//echo $usql;

						if(mysqli_query($con, $usql) or die(mysqli_error($con))){
								 $result = 'success';
								 $_SESSION["logged_user"]["account"] = $new_account;
								 $_SESSION["user_account"] = $new_account;
						}else{
							$result = 'failed';
						}
					}
					echo $result;
					mysqli_close($con);
				}
				if(isset($_POST["updateImage"])){
					$uid = $_POST["userid"];
					$un = $_POST["username"];

					$nameString = str_replace(" ", "", $un); //new file name string
					$fileName = $_FILES["file"]["name"]; //the original file name
					$splitName = explode(".", $fileName); //split the file name by the dot
					$fileExt = end($splitName); //get the file extension
					$newFileName  = $nameString.'.'.$fileExt; //join file name and ext.
					$pimg = "../system/media/".$newFileName;

					if (file_exists($pimg)){
						unlink($pimg);
					}
					move_uploaded_file($_FILES["file"]["tmp_name"], $pimg);
					$con = Dbcon();
					$usql = "UPDATE `registered` SET `prof_pic`='$pimg' WHERE `reg_id`=$uid";
					//echo $usql;

					if(mysqli_query($con, $usql) or die(mysqli_error($con))){
							 $result = 'success';
							 $_SESSION["logged_user"]["prof_pic"] = $pimg;
					}else{
						$result = 'failed';
					}
					mysqli_close($con);
				}
				$my_user = $_SESSION["logged_user"];
			?>
			<!-- Start Banner Area -->

			<section class="generic-banner relative">
				<div class="container">
					<div class="row height align-items-center justify-content-center">
						<div class="col-lg-10">

							<div class="banner-content text-center">
									<form name="profForm" method="post" action="#" enctype="multipart/form-data">
	                  <input type="hidden" name="updateImage" value="Update" />
	                  <input type="hidden" name="userid" value="<?= $my_user["reg_id"] ?>" />
	                  <input type="hidden" name="username" value="<?= $my_user["fullname"] ?>" />
	                  <input type="file" id="profImg" accept="image/*" onchange="loadFile(event)" name="file" style="display:none" />
	                </form>
									<a href="#" onclick="profUp(); return false;" class="img-link">
										<img id="output" src="<?= $my_user["prof_pic"] ?>" class="img-circle" alt="Cinque Terre" style="border-radius: 50%; width:20vw; height:20vw;">
									</a>
									<script>
	                  function profUp(){
	                    var up = document.getElementById("profImg");
	                    up.click();
	                  }
	                </script>
	                <script>
	                  var loadFile = function(event) {
	                    var output = document.getElementById('output');
	                    output.src = URL.createObjectURL(event.target.files[0]);
	                    setTimeout(function(){
	                      var r = confirm("Set Uploaded Picture As Profile?");
	                      if (r == true) {
	                          document.profForm.submit();
	                      } else {

	                      }
	                    }, 2000);

	                  };
	                </script>
								<h2><?= $my_user["fullname"] ?></h2>
								<div class="row">
									<div class="p-1 col-sm-4"><?= $my_user["email"] ?></div>
									<div class="p-2 col-sm-4 col-6"><?= $my_user["dob"] ?></div>
									<div class="p-2 col-sm-4 col-6"><?= $my_user["mobile"] ?></div>
								</div>
								<!--<div class="row p-10 mt-20">
									<div class="col-sm-12 text-center">
											<a href="#" data-toggle="modal" data-target="#myEditModal" class="genric-btn btn-block primary circle arrow">Update Profile<span class="fa fa-edit"></span></a>
											<a href="#" data-toggle="modal" data-target="#myPassModal" class="genric-btn btn-block primary circle arrow">Change Password<span class="fa fa-lock"></span></a>
									</div>
								</div>-->
								<!--<div class="d-flex justify-content-around">
								  <div class="p-2">Flex item 2</div>
								  <div class="p-2">Flex item 3</div>
								</div>-->
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Banner Area -->
			<section class="carousel-area pb-20 pt-10 mt-1">
				<div class="overlay overlay-bg"></div>
  			<div class="col-lg-12">
						<div class="row justify-content-center">
							<div class="mt-10 col-sm-3 col-xs-12 text-center">
								<a href="#" data-toggle="modal" data-target="#myEditModal" class="genric-btn btn-block primary circle arrow">Update Profile<span class="fa fa-edit"></span></a>
							</div>
							<div class="mt-10  col-sm-3 col-xs-12">
								<a href="#" data-toggle="modal" data-target="#myPassModal" class="genric-btn btn-block primary circle arrow">Change Password<span class="fa fa-lock"></span></a>
							</div>
							<div class="mt-10 col-sm-3 col-xs-12">
								<a href="user_courses.php"><button type="submit" class="genric-btn btn-block primary circle arrow"> My Courses <span class="pull-right fa fa-bookmark"></span></button></a>
							</div>
						</div>
  			</div>
  		</section>

			<section class="carousel-area pb-20 pt-10 mt-1">
				<div class="overlay overlay-bg"></div>
  			<div class="col-lg-12">
						<div class="row justify-content-center">
							<div class="mt-10 text-center">
								<a href="../instructor/start.php" class="genric-btn btn-block primary circle arrow"> Become an Instructor<span class="fa fa-edit"></span></a>
							</div>
						</div>
  			</div>
  		</section>
			<!-- Modal -->
<div id="myEditModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Profile</h4>
      </div>
      <div class="modal-body">
				<form action="#" method="post">
					<input type="hidden" name="userid" value="<?= $my_user["reg_id"] ?>" />
					<div class="mt-10">
						<input type="text"  name="fullname" value="<?= $my_user["fullname"] ?>" placeholder="Full Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'" required class="single-input">
					</div>
					<div class="mt-10">
						<input type="text"  readonly name="email" value="<?= $my_user["email"] ?>" placeholder="Full Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'" required class="single-input">
					</div>
					<div class="mt-10">
						<input type="date"  name="dob" value="<?= $my_user["dob"] ?>" placeholder="Full Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'" required class="single-input">
					</div>
					<div class="mt-10">
						<input type="text"  name="mobile" value="<?= $my_user["mobile"] ?>" placeholder="Full Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'" required class="single-input">
					</div>
					<div class="input-group-icon mt-10">
						<div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
						<div class="form-select">
							<select name="country">
								<option value="<?= $my_user["country"] ?>"><?= $my_user["country"] ?></option>
								<option value="1">Country</option>
								<option value="1">Bangladesh</option>
								<option value="1">India</option>
								<option value="1">England</option>
								<option value="1">Srilanka</option>
							</select>
						</div>
					</div>
					<div class="input-group-icon mt-10">
						<div class="icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
						<div class="form-select">
							<select name="school" required>
								<option value="<?= $my_user["school"] ?>"><?= $my_user["school"] ?></option>
								<option value="">Select School</option>
								<option value="Primary">Primary</option>
								<option value="Secondary">Secondary</option>
								<option value="Tertiary">Tertiary</option>
								<option value="Graduate">Graduate</option>

							</select>
						</div>
					</div>
					<div class="mt-10">
						<input type="number"  name="level" value="<?= $my_user["level"] ?>" placeholder="Full Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Name'" required class="single-input">
						<small>Graduate? Please leave empty.</small>
					</div>
					<div class="mt-10">
						<button type="submit" name="update" class="genric-btn btn-block primary circle arrow">Update Profile<span class="fa fa-edit"></span></button>
					</div>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myPassModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
				<form action="#"  method="post">
					<input type="hidden" name="userid" value="<?= $my_user["reg_id"] ?>" />
					<input type="hidden"  readonly name="username" value="<?= $my_user["email"] ?>">
					<div class="mt-10">
						<input type="password" name="epass" placeholder="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Existing'" required class="single-input">
					</div>
					<div class="mt-10">
						<input type="password" name="npass" id="npass" onkeydown="passcheck();" onkeyup="passcheck();" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" required class="single-input">
					</div>
					<div class="mt-10">
						<input type="password" name="cnpass" id="cnpass" onkeydown="passcheck();" onkeyup="passcheck();"  placeholder="Confirm New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm New Password'" required class="single-input">
						<small id="passinfo"></small>
					</div>
					<div class="mt-10" id="updatePass" style="visibility:hidden;">
						<button type="submit" name="updatePass" class="genric-btn btn-block primary circle arrow">Update Profile<span class="fa fa-edit"></span></button>
					</div>
				</form>
				<script type="text/javascript">
						function passcheck() {
								//alert("check");
								if(document.getElementById('npass').value == document.getElementById('cnpass').value){
									document.getElementById('passinfo').innerHTML = "Passwords Matched!";
									document.getElementById("passinfo").classList.remove('text-danger');
									document.getElementById("passinfo").classList.add('text-success');
									document.getElementById("updatePass").setAttribute("style", "visibility:block;");
								}else{
									document.getElementById("passinfo").classList.remove('text-success');
									document.getElementById("passinfo").classList.add('text-danger');
									document.getElementById('passinfo').innerHTML = "Passwords Must Match!";
									document.getElementById("updatePass").setAttribute("style", "visibility:hidden;");

								}
								return false;
						}

				</script>
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
	</body>
</html>
