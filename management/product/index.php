<?
	include('../includes/product_db.php');
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		
	$list = mysqli_query($con,"SELECT * FROM ec_list_products");	
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
<div align="center">
	<a href="./new_product.php" class="btn btn-primary">New Product</a>
</div>
<table class="table">
<tr>
	<td>ID</td><td>Cat_ID</td><td>Name</td><td>Size</td><td>Desc</td><td>Img</td><td>Price</td>
</tr>
<?
	while($row = mysqli_fetch_array($list))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['id'] . "</td>";
		  echo "<td>" . $row['cat_id'] . "</td>";
		  echo "<td>" . $row['name'] . "</td>";
		  echo "<td>" . $row['size'] . "</td>";
		  echo "<td>" . $row['description'] . "</td>";
		  echo "<td><img src=" . $row['image'] . " height='100' with='100' /></td>";
		  echo "<td>" . $row['price'] . "</td>";
		  echo "</tr>";
		  }
?>
</table>
</body>
</html>
