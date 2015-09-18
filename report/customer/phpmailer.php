<?
	function mailer($customer_email,$customer_name,$content,$coupon ){
		require_once('../../mailer/class.phpmailer.php');
		//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		
		$mail             = new PHPMailer();
		
		$body             = $content.$coupon;
		
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "smtp.googlemail.com"; // SMTP server
		$mail->SMTPSecure = 'tls';
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "smtp.googlemail.com"; // sets the SMTP server
		$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
		$mail->Username   = "username@gmail.com"; // SMTP account username
		$mail->Password   = "password";        // SMTP account password
		
		$mail->SetFrom("username@gmail.com", 'Alanger Coffee Shop');
		
		$mail->AddReplyTo("username@gmail.com","Alanger Coffee Shop");
		
		$mail->Subject    = "Alanger Coffee Shop Order Mail";
		
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 
		
		$mail->MsgHTML($body);
		$mail->CharSet = 'UTF-8';
		$mail->AddAddress($customer_email, $customer_name);
		
		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  //echo "Message sent!";
		}
	
	}
?>
