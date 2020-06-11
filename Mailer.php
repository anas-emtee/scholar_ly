<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

function SendMail($to, $content, $subject){
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers smtp.gmail.com
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = "mailermy17@gmail.com";                 // SMTP username enquiry@risaa.rv.gov.ng
		$mail->Password = "my_mailer2017";                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('mailermy17@gmail.com', 'My System');
		//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		$mail->addAddress($to);               // Name is optional
		$mail->addReplyTo('mailermy17@gmail.com', 'No Reply');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $content;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}




?>
