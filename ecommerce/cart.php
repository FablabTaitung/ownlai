<? 
	session_start();
	$cash_total=0; 
	$box_total=0;
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
<h1 align="center">艾蘭哥爾咖啡-幸福奇蹟</h1>
<hr />
<div class="container">

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
				echo "<td>".$_SESSION['cart'][$i]['total']."</td>";
				echo "<td><a href='./remove?id=".$_SESSION['cart'][$i]['id']."' class='btn btn-danger'>移除</a></td></tr>";
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
        <tr><td>優惠方案：</td><td><?=$_SESSION['coupon_rule']?></td></tr>
        <tr><td>總價：</td><td><?=round($cash_total*$_SESSION['coupon_rule']/100,0);?></td>
    </tr>
</table>
<p align="center"><a href="./checkout.php" class="btn btn-primary" style=" background-color: #C60; ">結賬</a>
<a class='btn btn-primary' href="./" style=" background-color: #C60; ">繼續購物</a>
<a href="./includes/clearcart.php" class="btn btn-danger">清除購物車</a>
</p>
<p align="center"></p>
</div>
</body>
</html>