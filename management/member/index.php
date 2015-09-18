<?
	$con=mysqli_connect("localhost","username","password","database");
	if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
	mysql_query("SET CHARACTER SET utf8 ");
	$con->set_charset("utf8");
	$sql="SELECT * FROM customer_member_information";
	$result=mysqli_query($con,$sql);
	mysqli_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CRM</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<p align="center">
<a href="new_customer.php" class="btn btn-primary">New Customer</a>
</p>
<table class="table">
<tr>
	<td>ID</td><td>Type</td><td>Name</td><td>Tel</td><td>Address</td><td>Email</td><td></td>
</tr>
<?
	while($row = mysqli_fetch_array($result))
  		{
		echo "<tr>";
  		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['type']."</td>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['tel']."</td>";
		echo "<td>".$row['address']."</td>";
		echo "<td>".$row['email']."</td>";
		echo "<td><a href='./customer_detail.php?id=".$row['id']."&t=".$row['type']."' class='btn btn-primary'>詳細資料</a></td>";
  		echo "</tr>";
  		}
?>
</table>
</body>
</html>
