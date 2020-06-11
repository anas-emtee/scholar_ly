<?php
  session_start();
  include "DbCon.php";

  if(isset($_REQUEST["save"])){
    $save_type = $_REQUEST["save"];
    $item_type = $_REQUEST["item_type"];
    $user = $_SESSION["user_id"];
    //$_REQUEST["username"];
    $item = $_REQUEST["item"];

    $con = Dbcon();
    $usql =  "INSERT INTO `user_saves` (`save_type`, `item_type`, `user`,`item`) VALUES ('$save_type','$item_type','$user','$item')";

  	if (mysqli_query($con,$usql)){
  		$newid=mysqli_insert_id($con);
      echo $newid;
      $q = "SELECT * FROM  `user_saves` WHERE `user`=$user";
      $sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
      $MY_SAVES = [];
    	if(mysqli_num_rows($sql_query)){
        //$_SESSION["user_saved"] = $sql_query;
        while($row = mysqli_fetch_array($sql_query)){
          $st = $row["save_type"];
          $it = $row["item"];
          $MY_SAVES[$it] = $st;
        }
        $_SESSION["user_saved"] = $MY_SAVES;
      }
    }
    mysqli_close($con);
  }
?>
