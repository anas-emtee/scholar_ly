<?php
  session_start();
  include "DbCon.php";
  include "Account_Class.php";

  if(isset($_POST["login"]) || isset($_POST["signin"])){
      $username = $_POST["username"];
      $password = $_POST["password"];
      $ut = $_POST["user_to"];

      $acc_str = $username."DGREAT91".$password;
      echo $password;
      $account = accountString($acc_str);
      //echo $account;
      $con = Dbcon();

      $q = "SELECT * FROM  `registered` WHERE account='$account'";
    	$sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
    	if(mysqli_num_rows($sql_query)){
    			$row = mysqli_fetch_array($sql_query);
  				//print_r($row);
  				$uid = $row['reg_id'];
  				$name = $row['fullname'];
  				$email = $row['email'];
  				$passcheck = $row['account'];
  				$utype = $row['usertype'];
    			if(($username == $email)&&($passcheck == $account)){
              $_SESSION["user_id"] = $uid;
              $_SESSION["user_account"] = $passcheck;
              $_SESSION["user_email"] = $email;
              $_SESSION["user_type"] = $utype;
    					$_SESSION["logged_user"] = $row;
    					$_SESSION["logged"] = 'true';

    					if(($utype == "user")){
    						$result = "success";
                if($ut == "Default"){ $ut = "categories.php"; }
    					}else if(($utype == "instructor")){
                $result = "success";
                if($ut == "Default"){ $ut = "system/system_main.php"; }
    					}else if(($utype == "manager")){
    						$result = "success";
                if($ut == "Default"){ $ut = "system/system_main.php"; }
    					}
              //echo "<script language='javascript' type='text/javascript'>window.open('".$ut."','_self')</script>";

            }else{
                $in_error = "Email ".$email." or Password is Incorrect. Please Try Again.";
                $ut = "signin.php?msg=".$in_error;
            }
        }else{
            $in_error = "User does not exit. Please Try Again.";
            $ut = "signin.php?msg=".$in_error;
        }
        mysqli_close($con);
        header("location:".$ut);
  }

  if(isset($_REQUEST["signup_login"])){
    $account = $_REQUEST["account"];

    $acc = urldecode($account);
    $con = Dbcon();

    $q = "SELECT * FROM  `registered` WHERE account='$acc'";
    $sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
    if(mysqli_num_rows($sql_query)){
        $row = mysqli_fetch_array($sql_query);
        //print_r($row);
        $uid = $row['reg_id'];
        $name = $row['fullname'];
        $email = $row['email'];
        $passcheck = $row['account'];
        $utype = $row['usertype'];
        if(($username == $email)&&($passcheck == $account)){
            $_SESSION["user_id"] = $uid;
            $_SESSION["user_account"] = $passcheck;
            $_SESSION["user_email"] = $email;
            $_SESSION["user_type"] = $utype;
            $_SESSION["logged_user"] = $row;
            $_SESSION["logged"] = 'true';

            if(($utype == "user")){
              $result = "success";
              if($ut == "Default"){ $ut = "categories.php"; }
            }else if(($utype == "instructor")){
              $result = "success";
              if($ut == "Default"){ $ut = "system/system_main.php"; }
            }else if(($utype == "manager")){
              $result = "success";
              if($ut == "Default"){ $ut = "system/system_main.php"; }
            }
            //echo "<script language='javascript' type='text/javascript'>window.open('".$ut."','_self')</script>";

        }else{
            $in_error = "Email ".$email." or Password is Incorrect. Please Try Again.";
            $ut = "signin.php?msg=".$in_error;
        }
    }else{
        $in_error = "User does not exit. Please Try Again.";
        $ut = "signin.php?msg=".$in_error;
    }
    mysqli_close($con);
    header("location:".$ut);
  }

?>
