<?
	include('../includes/product_db.php');
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list = mysqli_query($con,"SELECT * FROM ec_order");	
	mysqli_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<table class="table">
<tr>
	<td>Time</td><td>Order ID</td><td>Customer ID</td><td>Member ID</td><td>Status</td>
</tr>
<?
	while($row = mysqli_fetch_array($list))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['time'] . "</td>";
		  echo "<td>" . $row['order_id'] . "</td>";
		  echo "<td>" . $row['customer_id'] . "</td>";
		  echo "<td>" . $row['member_id'] . "</td>";
		  echo "<td>" . $row['status'] . "</td>";
		  echo "<td><a href='./order_detail.php?id=".$row['order_id']."' class='btn btn-primary' >詳細資料</a></td>";
		  if($row['status']=="新訂單"){ 
		  	echo "<td><a href='./change_status.php?id=".$row['order_id']."&cmd=1001' class='btn btn-info'>處理訂單</a></td>";
		  } else if($row['status']=="處理中"){ 
		  	echo "<td><a href='./change_status.php?id=".$row['order_id']."&cmd=1002' class='btn btn-info'>送貨</a></td>";
		  } else if($row['status']=="送貨中"){ 
		  	echo "<td><a href='./change_status.php?id=".$row['order_id']."&cmd=1003' class='btn btn-info'>完成訂單</a></td>";
		  }
		  if ($row['status']!="訂單完成"){
		  	echo "<td><a href='./change_status.php?id=".$row['order_id']."&cmd=1005' class='btn btn-danger' >取消訂單</a></td>";
		  }
		  echo "</tr>";
		  }
?>
</table>
</body>
</html>
