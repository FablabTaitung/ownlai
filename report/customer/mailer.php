<?
	require('./phpmailer.php');
	$email_list=$_POST['receiver'];
	$content=$_POST["content"];
	$coupon=$_POST["coupon"];
	echo $email_list;
	$email_item=explode(",",$email_list);
	$i=1;
	echo $email_item[1];
	do{
		echo $email_item[$i];
		mailer($email_item[$i],$email_item[$i],$content,$coupon);
		echo "<br>";
		$i=$i+1;
	} while ($email_item[$i]!=null)
	
?>