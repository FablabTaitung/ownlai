<?
	$pos_id="POS".rand(1000000,9999999);
	$time=date("Y-m-d H:i:s");
	$member_id=$_POST['member_id'];
	$sum=$_POST['sum'];
	$text_result=$_POST['text_result'];
	$num=$_POST['num'];
	$items=explode("-",$text_result);
	
	$con=mysqli_connect("localhost","username","password","database");
	mysql_query("SET CHARACTER SET utf8 ");
	$con->set_charset("utf8");
	$order_sql="INSERT INTO `alanger`.`pos_detail` (`id`, `time`, `member_id`, `details`, `sum`) VALUES ('".$pos_id."', '".$time."', '".$member_id."', '".$text_result."', '".$sum."');";
	mysqli_query($con, $order_sql);
	mysqli_close($con);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Check Out</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="./js/jquery.clock.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<table class="table">
	<tr>
    	<td>Invoice</td><td><?=$pos_id;?></td>
    </tr>
    <tr>
    	<td>Date</td><td><?=$time;?></td>
    </tr>
    <tr>
    	<td>Member ID</td><td><?=$member_id;?></td>
    </tr>
    <tr>
        <td>Sum</td><td><?=$sum;?></td>
    </tr>
</table>
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
<p align="center"><a href="./" class="btn btn-primary btn-lagre">繼續購物
</a></p>	
</body>
</html>
