<?
	$id=$_GET['id'];
	$cmd=$_GET['cmd'];
	
	if($cmd=='1001'){ $new_status="處理中";}
	else if($cmd=='1002'){ $new_status="送貨中";}
	else if($cmd=='1003'){ $new_status="訂單完成";}
	else if($cmd=='1005'){ $new_status="訂單已被取消";}
	
	$sql = "UPDATE `ec_order` SET `status` = '".$new_status."' WHERE `order_id` = '".$id."' LIMIT 1;";
	echo $sql;
	
	$con=mysqli_connect("localhost","username","password","database");
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	mysql_query("SET NAMES 'utf8'", $con); 
    mysql_query("SET CHARACTER_SET_CLIENT=utf8", $con); 
    mysql_query("SET CHARACTER_SET_RESULTS=utf8", $con); 
	$con->set_charset("utf8");
	
	
	mysqli_query($con,$sql);
	mysqli_close($con);
	
	
	
	
	header("location:./");
?>
