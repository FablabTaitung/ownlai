<?
	session_start();
	require('phpmailer.php');
	$customer_name=$_POST['customer_name'];
	$customer_tel=$_POST['customer_tel'];
	$customer_address=$_POST['customer_address'];
	$customer_email=$_POST['customer_email'];
	$is_id=$_POST['is_id'];
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysql_query("SET CHARACTER SET utf8 ");
	$con->set_charset("utf8");
	
	$time=date("Y-m-d H:i:s");
	$order_id="OR".rand(1000000000,9999999999);
	$customer_id="CM".rand(1000000000,9999999999);
	$member_id=$_POST['member_id'];
	$coupon_id=$_SESSION['coupon_id'];
	$total=$_SESSION['total'];
	$coupon_total=$_SESSION['coupon_total'];
	$order_sql="INSERT INTO `ec_order` (`time`, `order_id`, `customer_id`, `member_id`, `coupon_id`, `total`, `coupon_total`, `status`) VALUES ('".$time."', '".$order_id."', '".$customer_id."', '".$member_id."', '".$coupon_id."', '".$total."', '".$coupon_total."', '新訂單');";
	mysqli_query($con, $order_sql);
	
	$customer_sql = "INSERT INTO `ec_customer` (`customer_id`, `customer_name`, `customer_tel`, `customer_address`, `customer_email`, `log`) VALUES ('".$customer_id."', '".$customer_name."', '".$customer_tel."', '".$customer_address."', '".$customer_email."', '".$time."');";
	mysqli_query($con, $customer_sql);
	
	if(is_array($_SESSION['cart'])){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
				$order_line=$order_id.$_SESSION['cart'][$i]['id'].rand(1000,9999);
				$product_sql = "INSERT INTO `ec_product` (`order_id`, `product_id`, `order_line`, `name`, `size`, `price`, `amount`, `total`) VALUES ('".$order_id."', 
				'".$_SESSION['cart'][$i]['id']."', 
				'".$order_line."', 
				'".$_SESSION['cart'][$i]['name']."',
				'".$_SESSION['cart'][$i]['size']."', 
				'".$_SESSION['cart'][$i]['price']."',
				'".$_SESSION['cart'][$i]['amount']."',
				'".$_SESSION['cart'][$i]['total']."');";
				mysqli_query($con, $product_sql);
			}
	}
	
	mysqli_close($con);	
	mailer($customer_email,$customer_name,$order_id,$is_id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="css/main_theme.css" rel="stylesheet">
</head>

<body>
<div class="container">
	<div id="customer">
    	<table class="table">
        	<tr><td>Customer name</td><td><?=$customer_name;?></td></tr>
            <tr><td>Customer tel</td><td><?=$customer_tel;?></td></tr>
            <tr><td>Customer address</td><td><?=$customer_address;?></td></tr>
            <tr><td>Customer email</td><td><?=$customer_email;?></td></tr>
        </table>
    </div>
    <hr />
    <div id="product">
    	<table class="table">
	<tr><td>產品編號</td><td>名字</td><td>單位</td><td>價格</td><td>數量</td><td>總價</td></tr>
	<?
		if(is_array($_SESSION['cart'])){
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
				echo "<tr><td>".$_SESSION['cart'][$i]['id']."</td>";
				echo "<td>".$_SESSION['cart'][$i]['name']."</td>";
				echo "<td>".$_SESSION['cart'][$i]['size']."</td>";
				echo "<td>".$_SESSION['cart'][$i]['price']."</td>";
				echo "<td>".$_SESSION['cart'][$i]['amount']."</td>";
				echo "<td>".$_SESSION['cart'][$i]['total']."</td></tr>";
				$cash_total=$cash_total+$_SESSION['cart'][$i]['total'];
				$box_total=$box_total+$_SESSION['cart'][$i]['amount'];
				//$pname=get_product_name($pid);
				if($_SESSION['cart'][$i]['amount']) continue;
			}
		}
	?>
    <tr>
    	<td></td><td></td><td></td><td>總共：</td><td><?=$box_total;?></td><td><?=$cash_total;?></td>
    </tr>
</table>
<table class="table">
	<tr>
    	<td>優惠名稱：</td><td><?=$_SESSION['coupon_name']?></td></tr>
        <tr><td>優惠編碼：</td><td><?=$_SESSION['coupon_id']?></td></tr>
        <tr><td>優惠截止日期：</td><td><?=$_SESSION['coupon_expiration_date']?></td></tr>
        <tr><td>優惠方案：</td><td>打<?=$_SESSION['coupon_rule']?>％</td></tr>
        <tr><td>總價：</td><td><?=$cash_total*$_SESSION['coupon_rule']/100;?></td>
    </tr>
</table>
    </div>
    <p align="center"><a class='btn btn-primary btn-large' href="./">繼續購物</a></p>
</div>

<?
	session_destroy();
?>
</body>
</html>
