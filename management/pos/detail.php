<?
	$id=$_GET['id'];
	
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list = mysqli_query($con,"SELECT * FROM pos_detail WHERE id like '".$id."' ");	
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
<? while($row = mysqli_fetch_array($list)) {
	$items=explode("-",$row['details']);
	$num=count($items);
	?>
<table class="table">
	<tr>
    	<td>Invoice</td><td><?=$row['id'];?></td>
    </tr>
    <tr>
    	<td>Date</td><td><?=$row['time'];?></td>
    </tr>
    <tr>
    	<td>Member ID</td><td><?=$row['member_id'];?></td>
    </tr>
    <tr>
        <td>Sum</td><td><?=$row['sum'];?></td>
    </tr>
</table>
<? }?>
<table class="table">
<tr>
	<td>Product Name</td><td>Price</td><td>Qty</td><td>Number</td>
</tr>
<?
	for($i=0;$i<=$num;$i++){
		$detail=explode(",",$items[$i]);
		echo "<tr>";
		echo "<td>".$detail[1]."</td>";
		echo "<td>".$detail[2]."</td>";
		echo "<td>".$detail[0]."</td>";
		echo "<td>".$detail[3]."</td>";
		echo "</tr>";
	}
?>
</table>
</body>
</html>
