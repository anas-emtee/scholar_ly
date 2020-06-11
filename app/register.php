<?php
  session_start();
  include "DbCon.php";
  include "Account_Class.php";

  if(isset($_POST["signup"])){
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $mobile = $_POST["mobile"];
    $country = $_POST["country"];
    $school = $_POST["school"];
    $level = $_POST["level"];
    $password = $_POST["password"];

    $acc_str = $email."DGREAT91".$password;
    $account = accountString($acc_str);

    $con = Dbcon();
    $q = "SELECT * FROM  `registered` WHERE (`email`='$email' OR `mobile`='$mobile')";
    $sql_query = mysqli_query($con, $q)or die(mysqli_error($con));
    if(mysqli_num_rows($sql_query) == 0){
      $i = "INSERT INTO `registered` (`fullname`, `email`, `mobile`, `dob`, `country`, `school`, `level`, `account`) VALUES ('$fullname', '$email', '$mobile', '$dob', '$country', '$school', '$level', '$account')";
      if(mysqli_query($con, $i)or die(mysqli_error($con))){
        $return = "login_auth.php?signup_login=new&account=".$account;
      }
    }else{
      $return = "sign_up.php?info=Email or Phone Number Already Exist";
    }
    mysqli_close($con);
    header("location:".$return);
  }

?>
