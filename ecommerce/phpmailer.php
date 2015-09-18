<?
	function mailer($customer_email,$customer_name,$order_id,$is_id ){
		require_once('../mailer/class.phpmailer.php');
		//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		
		$mail             = new PHPMailer();
		if($is_id==0){
		$body             = '
		<center>
		<h4 align="center">訂單編號：'.$order_id.'</h4>
		<h3>感謝您使用我們的商店的服務，為了更進一步地了解您的需求，希望您能夠加入成為我們商店的會員之一，享受更多的優惠</h3>
		<h2><a href="http://vuonggiatuan.notonly.com.tw/alanger/management/member/new_customer/">點擊這裡，成為我們的會員</a></h2>
		<h3>查詢訂單鏈接：</h3>
			<h2><a href="http://vuonggiatuan.notonly.com.tw/alanger/management/order/order_detail.php?id='.$order_id.'">點擊這裡，查詢訂單資訊</a></h2>
		</center>
		';
		} else if($is_id==1){
			$body             = '
			<center>
			<h3 align="center">訂單編號：'.$order_id.'</h3>
			<h3>查詢訂單鏈接：</h3>
			<h2><a href="http://vuonggiatuan.notonly.com.tw/alanger/management/order/order_detail.php?id='.$order_id.'">點擊這裡，查詢訂單資訊</a></h2>
			</center>
			';
		}
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
		
		$mail->AddAddress($customer_email, $customer_name);
		
		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  //echo "Message sent!";
		}
	
	}
?>
