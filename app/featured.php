<!-- Start Carousel Area -->
<h2 class="text-center text-white border mt-20">Featured Courses</h2>
<section class="section mt-20 pt-20 pb-20 carousel-area">
  <div class="overlay overlay-bg"></div>
  <div class="active-bottle-carousel pb-20">
    <?php
      $con = Dbcon();
      $sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `system_flag`='featured' ORDER BY `course_title` ASC")or die(mysqli_error($con));
      //WHERE `csid`='$cs_id'
      if(mysqli_num_rows($sql_query)){
          while($row = mysqli_fetch_array($sql_query)){
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
    <div class="item">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-md-4">
            <div class="carousel-thumb">
              <img src="../system/<?= $row["course_thumbnail"] ?>" alt="" class="img-responsive img-fluid" style="width:100%; height:inherit;">
            </div>
          </div>
          <div class="col-xl-6 col-md-7">
            <div class="carousel-content">
              <h2 class="text-white"><?= $row["course_title"] ?></h2>
              <h5 class="text-white mb-20"><?= $price ?></h5>
              <p class="text-white text-justify mb-30">
                <?= $row["course_desc"] ?>
              </p>
              <a href="course_details.php?course_ref=<?= $row["id"] ?>" class="primary-btn white">View Details<span class="lnr lnr-arrow-right"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
        }
      }else{
    ?>
    <div class="item">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-md-4">
            <div class="carousel-thumb">
              <img src="img/c.jpg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="col-xl-6 col-md-7">
            <div class="carousel-content">
              <h2 class="text-white">Featured Courses</h2>
              <h5 class="text-white mb-20">The Following Course Are Highly Rated</h5>
              <p class="text-white text-justify mb-30">
                Few would argue that, despite the advancements of feminism over the past three decades, women still face a double standard when it comes to their behavior.
              </p>
              <a href="#" class="primary-btn white">View More<span class="lnr lnr-arrow-right"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
      }
      mysqli_close($con);
    ?>

    <div class="item">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-md-4">
            <div class="carousel-thumb">
              <img src="img/c.jpg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="col-xl-6 col-md-7">
            <div class="carousel-content">
              <h2 class="text-white">Ads Here</h2>
              <h5 class="text-white mb-20">The Following Course Are Highly Rated</h5>
              <p class="text-white text-justify mb-30">
                Few would argue that, despite the advancements of feminism over the past three decades, women still face a double standard when it comes to their behavior.
              </p>
              <a href="#" class="primary-btn white">View More<span class="lnr lnr-arrow-right"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="item">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-md-4">
            <div class="carousel-thumb">
              <img src="img/c.jpg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="col-xl-6 col-md-7">
            <div class="carousel-content">
              <h2 class="text-white">Ads Here</h2>
              <h5 class="text-white mb-20">Collect from your nearest supershop imedietely</h5>
              <p class="text-white text-justify mb-30">Few would argue that, despite the advancements of feminism over the past three decades, women still face a double standard when it comes to their behavior.</p>
              <a href="#" class="primary-btn white">View More<span class="lnr lnr-arrow-right"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Carousel Area -->
