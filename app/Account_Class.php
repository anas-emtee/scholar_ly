<?php
function accountString($acct){
	$content = "";
	$plaintext = $acct;

	$config = include('../system/common/config.php');

	$key = $config["account"]["key"];
	$ivlen = $config["account"]["ivlen"];
	$cipher = $config["account"]["cipher"];
	$iv = $config["account"]["iv"];

	$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
	$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
	$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );

	$content = $ciphertext;
	return $content;
}
//$test = "falz@gmail.comDGREATfalzdabg";
//echo accountString($test);
function checkEmail($em){
	$content = TRUE;
	$con = DbCon();
	$sql_query = mysqli_query($con, "SELECT * FROM `registered` WHERE `email`='".$em."'")or die(mysqli_error($con));
	if(mysqli_num_rows($sql_query)){
			$content = FALSE;
	}
	mysqli_close($con);
	return $content;
}

?>
