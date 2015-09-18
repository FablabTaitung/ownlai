<?
	function getrandomstring($length) {
       $template = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rndstring="";
       for ($a = 0; $a <= $length; $a++) {
               $b = rand(0, strlen($template) - 1);
               $rndstring .= $template[$b];
       }

       return $rndstring; 
	}
	
	$id=$_POST['id'];
	$name=$_POST['name'];
	$rule=$_POST['rule'];
	$status=$_POST['status'];
	$date=$_POST['date'];
	if($id!=null&&$name!=null&&$rule!=null){
		$con=mysqli_connect("localhost","username","password","database");
		if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
		mysql_query("SET CHARACTER SET utf8 ");
		$con->set_charset("utf8");
		$sql="INSERT INTO `alanger`.`ec_coupon` (`id`, `name`, `rule`, `status`, `expiration_date`) VALUES ('".$id."', '".$name."', '".$rule."', '".$status."', '".$date."');";
		mysqli_query($con,$sql);
		//echo $sql;
		mysqli_close($con);
		header('location:./');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<form action="new.php" method="post">
	<table class="table">
    	<tr><td>Coupon code</td><td><input type="text" value="<?=getrandomstring(16);?>" readony="readonly" name="id"/></td></tr>
        <tr><td>Name</td><td><input type="text" name="name" /></td></tr>
        <tr><td>Rule</td><td><input type="text" name="rule" /></td></tr>
        <tr><td>Status</td><td>
        	<input type="radio" name="status" value="ap">行銷聯盟
        	<input type="radio" name="status" value="open">開放
            <input type="radio" name="status" value="close">關閉
        </td></tr>
        <tr><td>Date</td><td><input type="text" name="date" /></td></tr>
        <tr><td></td><td><input type="submit" value="Submit" /></td></tr>
    </table>
</form>
<body>
</body>
</html>
