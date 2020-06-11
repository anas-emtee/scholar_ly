<!DOCTYPE html>
<html lang="zxx" class="no-js">
  <?php
    include "header.php";
    include "Topic_Class.php";

    if(isset($_POST["cat_item"]) && isset($_POST["sub_item"])){
      $cat_id = $_POST["cat_item"];
      $sub_id = $_POST["sub_item"];
      $cat_tit = $_POST["category"];
      $sub_tit = $_POST["subcateg"];
      $subscribe = $_POST["subscribe"];
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
  				<div class="row pb-50  pt-50 align-items-center justify-content-center">
  					<div class="col-lg-10">
  						<div class="banner-content text-center">
  							<h2><?= $cat_tit ?> Topics  <?= $subscribe ?></h2>
                <small> In <?= $sub_tit ?></small>
  							<p class="breadcrum">
                  <i class="fa fa-home"></i> &rarr;
                  <a href="categories.php"> Categories &rarr; </a>
                  <a href="sub_categories.php?item=<?= $cat_id ?>&category=<?= $cat_tit ?>"> <?= $cat_tit ?> &rarr;</a>
                  <?= $sub_tit ?>
                </p>
  						</div>
  					</div>
  				</div>
  			</div>
  		</section>
  		<!-- End Banner Area -->

      <?php if($HLOGGED && $subscribe){ ?>
        <section class="carousel-area pb-20 pt-10 mt-1">
  				<div class="overlay overlay-bg"></div>
    			<div class="col-lg-12">
  						<div class="row justify-content-center">
  							<div class="mt-10 col-sm-10 col-xs-12 text-center">
  								<h4>You can subscribe to the content of this category and have unlimited access to all the courses under it. Click the button to see pricing.</h4>
  							</div>

  							<div class="mt-10 col-sm-2 col-xs-4">
  								<button data-toggle="modal" data-target="#subscribeNow" type="submit" class="genric-btn btn-block primary circle arrow"> Subscribe Now <span class="pull-right fa fa-bookmark"></span></button>
  							</div>
                <!-- The Modal -->
                <div class="modal fade" id="subscribeNow">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Subscribe To <?= $sub_tit ?> <small> Access Level <?= $_SESSION["logged_user"]["level"] ?></small></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                        <h4 class="text-center">Please select a subscription package and click proceed to continue.</h4>
                        <form method="post" action="subscription.php">
                          <input type="hidden" name="sub_item" value='<?= $sub_id  ?>'>
                          <input type="hidden" name="subcateg" value='<?= $sub_tit  ?>'>
                          <input type="hidden" required name="packid" id="packid" value=''>
                          <input type="hidden" required name="amount" id="amount" value=''>
                          <input type="hidden" required name="unit" id="unit" value=''>
                          <input type="hidden" required name="package" id="package" value=''>

                          <ul class="list-group">
                          <?php
                            $con = Dbcon();
                            $sql_query = mysqli_query($con, "SELECT * FROM `subscription_pricing` WHERE (`scid`='$sub_id')")or die(mysqli_error($con));
                            if(mysqli_num_rows($sql_query)){
                                while($row = mysqli_fetch_array($sql_query)){
                                  $packid = $row["id"];
                                  $amount = $row["id"];
                                  $unit = $row["id"];
                                  $tit = $row["id"];
                                  //echo $row["title"];
                          ?>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="primary-radio">
        											<input required type="radio" onclick="setPackage('<?= $row["id"] ?>','<?= $row["amount"] ?>','<?= $row["unit"] ?>','<?= $row["title"] ?>',this)" value="<?= $row["id"] ?>" name="sub_pack" id="default-radio<?= $row["id"] ?>">
        											<label for="default-radio<?= $row["id"] ?>"></label>
        										</div>
                            <?= $row["title"] ?>
                            <span class="badge badge-primary badge-pill"><?= $row["amount"] ?></span>
                          </li>
                          <?php
                                }
                              }else{
                          ?>
                          <h4 class="text-center"> No Subscription model has been setup for this category yet. Please check later.</h4>
                          <?php } ?>
                          </ul>
                          <button type="submit" class="btn btn-block btn-danger"> Proceed </button>
                          </form>
                      </div>
                      <script>
                        var setPackage = function(pid, amt, unit, pac, elem){
                          //alert("set"+pac+" for "+amt);
                          var check = elem.checked;
                          if(check){
                            document.getElementById("packid").value = pid;
                            document.getElementById("amount").value = amt;
                            document.getElementById("unit").value = unit;
                            document.getElementById("package").value = pac;
                          }
                        }
                      </script>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>
  						</div>
    			</div>
    		</section>
      <?php } ?>

			<!-- Start Carousel Area -->
  		<section class="carousel-area pb-20 pt-20 mt-10">

  			<div class="col-lg-12">
          <div class="list-group">
            <div title="Nof" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-danger">
              <div class="d-flex p-2 justify-content-center">
                <div class="input-group-icon mt-10">
									<div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
									<input type="text" id="filter" placeholder="Filter List" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Filter List'" class="single-input">
								</div>
              </div>
            </div>
            <div style="min-height:60vh; max-height:60vh; overflow-y:scroll;">
            <?php
              $con = Dbcon();
              $sql_query = mysqli_query($con, "SELECT * FROM `class_subjects` WHERE categ='$cat_id' AND subcat='$sub_id' AND `status`='active' ORDER BY `csname` ASC")or die(mysqli_error($con));
            	if(mysqli_num_rows($sql_query)){
            			while($row = mysqli_fetch_array($sql_query)){
                    $count_courses = countCourses($row["csid"]);
                    $total_len = totalLength($row["csid"]);
                    $count_ups = countUploads($row["csid"]);
          	?>
                  <form name="<?= $row["csid"]  ?>" id="<?= $row["csid"]  ?>" method="post" action="courses.php">
                    <input type="hidden" name="cat_item" value="<?= $cat_id  ?>">
                    <input type="hidden" name="sub_item" value='<?= $sub_id  ?>'>
                    <input type="hidden" name="cs_item" value='<?= $row["csid"]  ?>'>
                    <input type="hidden" name="category" value="<?= $cat_tit  ?>">
                    <input type="hidden" name="subcateg" value='<?= $sub_tit  ?>'>
                    <input type="hidden" name="topic" value='<?= $row["csname"]  ?>'>
                  </form>
                  <a onclick="formPost('<?= $row["csid"]  ?>')"  title="<?= $row["csname"]  ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1"><?= $row["csname"]  ?></h5>
                      <small><?= $count_courses ?> Courses</small>
                    </div>
                    <h6 class="mb-1 text-justify">
                      <!--<?= $row["csdesc"]  ?><br />-->
                      <i class="fa fa-clock-o"></i> &nbsp; <?= $total_len ?> Total Hours Of Courses <br />
                      <i class="fa fa-file"></i> &nbsp; <?= $count_ups ?> Course Materials
                    </h6>
                    <div class="d-flex flex-row justify-content-end">
                      <div class="p-2">
                        <i class="fa fa-book"></i> &nbsp;
                        <i class="fa fa-angle-right"></i>
                      </div>
                    </div>
                  </a>
            <?php
                }
            	}
            	mysqli_close($con);
            ?>
            </div>
          </div>
  			</div>
  		</section>
  		<!-- End Carousel Area -->

			<!-- End Contents Here -->
			<?php include "footer.php"; ?>
		</div>
		<?php include "scripts.php"; ?>
    <script>
      var formPost = function(formto){
        document.getElementById(formto).submit();
      }
      $("#filter").keyup(function(){
        var v = this.value;
        $('.list-group-item').each(function(i, obj) {
            var t = obj.title;
            if(t != "Nof" && t.toLocaleLowerCase().indexOf(v.toLocaleLowerCase()) == -1){
              //alert(t.toLocaleLowerCase().indexOf(v)+" : "+v+" = "+t);
              obj.setAttribute("style", "display:none");
            }else{
              obj.removeAttribute("style")
            }
        });

      });
    </script>
	</body>
</html>
