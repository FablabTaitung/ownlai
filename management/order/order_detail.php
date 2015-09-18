<?
	$id=$_GET['id'];
	$i=0;
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list = mysqli_query($con,"SELECT * FROM ec_order WHERE order_id like '".$id."' ");	
	
	while($row = mysqli_fetch_array($list))
		  {
		  $customer_id=$row['customer_id'];
		  $order_id=$row['order_id'];
		  }
	$customer_list=mysqli_query($con,"SELECT * FROM ec_customer WHERE customer_id like '".$customer_id."' ");	
	$order_list=mysqli_query($con,"SELECT * FROM ec_product WHERE order_id like '".$order_id."' ");	
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
<h1 align="center">訂單編號：<?=$order_id?></h1>
<div class="container">
	<div id="customer">
    <? while($row = mysqli_fetch_array($customer_list))
		  {?>
    	<table class="table">
        	<tr><td>顧客姓名</td><td><?=$row['customer_name'];?></td></tr>
            <tr><td>顧客電話</td><td><?=$row['customer_tel'];?></td></tr>
            <tr><td>顧客地址</td><td><?=$row['customer_address'];?></td></tr>
            <tr><td>顧客信箱</td><td><?=$row['customer_email'];?></td></tr>
        </table>
    <? }?>
    </div>
    <hr />
    <div id="product">
<table class="table">
	<tr><td>產品序號</td><td>產品名稱</td><td>產品單位</td><td>產品價格</td><td>產品數量</td><td>產品價格</td></tr>
    <? while($row = mysqli_fetch_array($order_list)) {
		$i=$i+1;?>
    <tr>
    	<td><?=$i;?></td> 
        <td><?=$row['name'];?></td>
        <td><?=$row['size'];?></td>
        <td><?=$row['price'];?></td>
        <td><?=$row['amount'];?></td>
        <td><?=$row['total'];?></td>
    </tr>	
	<? }?>
</table>
    </div>
</body>
</html>
