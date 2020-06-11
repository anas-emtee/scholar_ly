<!-- Start Carousel Area -->
<h2 class="text-center text-white border mt-20">Recomended Courses</h2>
<!-- Start Sample Area -->
<div class="white-bg mt-20">
  <div class="container">
    <div class="section-top-border  pt-3">
        <div class="row">
          <?php
            $con = Dbcon();
            $sql_query = mysqli_query($con, "SELECT * FROM `courses` WHERE `system_flag`='recommended' ORDER BY `course_title` ASC")or die(mysqli_error($con));
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
                          <p class="btn-add"><i class="fa fa-heart"></i><a href="" class="hidden-sm">Wish List</a></p>
                          <p class="btn-details"><i class="fa fa-list"></i><a href="course_details.php?course_ref=<?= $row["id"] ?>" class="hidden-sm">More details</a></p>
                      </div>
                      <div class="clearfix">
                      </div>
                  </div>
              </div>
          </div>
          <?php
              }
            }else{
          ?>
            <div class="col-lg-12 mt-50">
              <blockquote class="generic-blockquote">
                No Recommendations
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
