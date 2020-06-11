<!DOCTYPE html>
<html lang="zxx" class="no-js">
  <?php
    include "header.php";
    include "Sub_Category_Class.php";

    if(isset($_REQUEST["item"]) && isset($_REQUEST["category"])){
      $cat_id = $_REQUEST["item"];
      $cat_tit = $_REQUEST["category"];
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
  							<h2><?= $cat_tit ?></h2>
  							<p class="breadcrum">
                  <i class="fa fa-home"></i> &rarr;
                  <a href="categories.php"> Categories &rarr; </a>
                  <?= $cat_tit ?>
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
									<div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
									<input type="text" id="filter" placeholder="Filter List" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Filter List'" class="single-input">
								</div>
              </div>
            </div>
            <div style="min-height:60vh; max-height:60vh; overflow-y:scroll;">
            <?php
              $con = Dbcon();
              $sql_query = mysqli_query($con, "SELECT * FROM `sub_categories` WHERE categid='$cat_id' AND `status`='active' ORDER BY `scname` ASC")or die(mysqli_error($con));
            	if(mysqli_num_rows($sql_query)){
            			while($row = mysqli_fetch_array($sql_query)){
                    $count_courses = countCourses($row["scid"]);
          	?>
                  <form name="<?= $row["scid"]  ?>" id="<?= $row["scid"]  ?>" method="post" action="topics.php">
                    <input type="hidden" name="cat_item" value="<?= $cat_id  ?>">
                    <input type="hidden" name="sub_item" value='<?= $row["scid"]  ?>'>
                    <input type="hidden" name="category" value="<?= $cat_tit  ?>">
                    <input type="hidden" name="subcateg" value='<?= $row["scname"]  ?>'>
                    <input type="hidden" name="subscribe" value='<?= $row["subscription"]  ?>'>
                  </form>
                  <!-- href="topics.php?cat_item=<?= $row["scid"]  ?>&sub_item=<?= $row["scid"]  ?>&category=<?= $row["scname"]  ?>&subcateg=<?= $row["scname"]  ?>" -->
                  <a onclick="formPost('<?= $row["scid"]  ?>')"  title="<?= $row["scname"]  ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1"><?= $row["scname"]  ?></h5>
                      <small><?= $count_courses ?> Courses</small>
                    </div>
                    <p class="mb-1 text-justify"><?= $row["scdesc"]  ?></p>
                    <div class="d-flex flex-row justify-content-end">
                      <div class="p-2"><small><i class="fa fa-thumbs-up"></i></small></div>
                      <div class="p-2"><small><i class="fa fa-thumbs-up"></i></small></div>
                      <div class="p-2"><small><i class="fa fa-thumbs-up"></i></small></div>
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
