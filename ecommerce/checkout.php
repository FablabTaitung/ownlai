<?
	session_start();
	$customer_id=$_POST['customer_id'];
	$is_id=0;
	if($customer_id!=null){
		$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		mysql_query("SET CHARACTER SET utf8 ");
		$con->set_charset("utf8");
		$list = mysqli_query($con,"SELECT * FROM  `customer_member_information` WHERE id LIKE '".$customer_id."'");	
		echo "SELECT * FROM  `customer_member_information` WHERE id LIKE '".$customer_id."'";
		mysqli_close($con);
		while($row = mysqli_fetch_array($list)){
			$customer_name=$row['name'];
			$customer_tel=$row['tel'];
			$customer_address=$row['address'];
			$customer_email=$row['email'];
			//echo $customer_name;
		}
		$is_id=1;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>第三步：結賬～艾蘭哥爾咖啡故事館</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="css/main_theme.css" rel="stylesheet">
</head>

<body>
<h1 align="center">艾蘭哥爾咖啡-幸福奇蹟</h1>
<hr />
<div class="cointainer">

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
        <tr><td>總價：</td><td><?=round($cash_total*$_SESSION['coupon_rule']/100,0);?></td>
    </tr>
</table>
<?
	$_SESSION['total']=$cash_total;
	$_SESSION['coupon_total']=round($cash_total*$_SESSION['coupon_rule']/100,0);
?>
<form action="checkout.php" method="post">
	<table class="table">
    	<tr><td>顧客編號：</td><td><input type="text" name="customer_id" ></td>
        <td><input type="submit" value="自動填寫資料" class="btn btn-primary" style=" background-color: #C60; "/></td></tr>
    </table>
</form>
<form action="result.php" method="post">
<table class="table" align="center">
	<tr><td>顧客編號：</td><td><input type="text" name="member_id" value="<?=$customer_id;?>" readonly="readonly"></td>
	<tr><td>顧客名稱</td><td><input type="text" name="customer_name" value="<?=$customer_name;?>"></td></tr>
    <tr><td>顧客電話</td><td><input type="text" name="customer_tel" value="<?=$customer_tel;?>"></td></tr>
    <tr><td>顧客地址</td><td><input type="text" name="customer_address" value="<?=$customer_address;?>"></td></tr>
    <tr><td>顧客電子郵件</td><td><input type="text" name="customer_email" value="<?=$customer_email;?>"/></td></tr>
    <tr><td>付款方式</td><td><input type="text" name="paymethod" value="貨到付款" readonly="readonly"/></td></tr>
    <tr><td>配送方式</td><td><input type="text" name="shipmethod" value="黑貓" readonly="readonly"/></td></tr>
	<tr>
    <td><p align="center"><a class='btn btn-primary' href="./">繼續購物</a></p></td>
    <input type="hidden" name="is_id" value="<?=$is_id;?>"/>
    <td><input type="submit" value="送出訂單" class="btn btn-primary" style=" background-color: #C60; "/></td></tr>
</table>

</form>
</div> 
</body>
</html>
