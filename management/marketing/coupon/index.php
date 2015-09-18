<?
	$con=mysqli_connect("localhost","username","password","database");
	if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
	mysql_query("SET CHARACTER SET utf8 ");
	$con->set_charset("utf8");
	$sql="SELECT * FROM ec_coupon";
	$result=mysqli_query($con,$sql);
	mysqli_close($con);
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

<body>
<div class="btn-group btn-group-justified">
  <div class="btn-group">
    <a href="./new.php" class="btn btn-default">New Coupon</a>
  </div>
</div>
<table class="table">
<? while($row = mysqli_fetch_array($result)){ ?>
	<tr>
    	<td><?=$row['id']?></td>
        <td><?=$row['name']?></td>
        <td><?=$row['rule']?></td>
        <td><?=$row['status']?></td>
        <td><?=$row['expiration_date']?></td>
        <td><a href="../../../ecommerce/?coupon=<?=$row['id']?>" target="_blank" class="btn btn-primary">優惠鏈接</a></td>
        <td></td>
    </tr>
<? } ?>
</table>
</body>
</html>
