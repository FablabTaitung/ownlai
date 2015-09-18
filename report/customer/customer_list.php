<?
	$type=$_GET['type'];
	$condition="";
	if($type=="S"){ $condition="HAVING SUM( ec_product.total ) > 99999 ";}
	if($type=="A"){ $condition="HAVING SUM( ec_product.total ) BETWEEN 10000 AND 99999";}
	if($type=="B"){ $condition="HAVING SUM( ec_product.total ) BETWEEN 5000 AND 10000";}
	if($type=="C"){ $condition="HAVING SUM( ec_product.total ) BETWEEN 1000 AND 5000";}
	if($type=="D"){ $condition="HAVING SUM( ec_product.total ) BETWEEN 0 AND 1000";}
	$sql="SELECT ec_customer.customer_email, SUM( ec_product.total ) , SUM( ec_product.amount ) 
FROM ec_order INNER JOIN ec_product ON ec_product.order_id = ec_order.order_id INNER JOIN ec_customer ON ec_customer.customer_id = ec_order.customer_id GROUP BY ec_customer.customer_email ".$condition." ";
	$sql2="SELECT * FROM  `ec_coupon` ";
	//echo $sql;
	//echo $condition;
	//echo $type;
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");
	$list_1= mysqli_query($con,$sql);	
	$list_coupon= mysqli_query($con,$sql2);	
	mysqli_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script>
$(document).ready(function(){
	var receiver="";
	tinymce.init({selector:'textarea'});
	$(".email_item").each(function(){
		var add=$(this).html();
		receiver=receiver+add+",";
	});
	$("#receiver").val(receiver);
});
        
</script>
</head>

<body>
<h1 align="center">精準行銷</h1>
<table class="table">
<? while($row = mysqli_fetch_array($list_1)){?>
	<tr>
		<td class="email_item"><?=$row['customer_email'];?></td>
        <td><?=$row['SUM( ec_product.total )'];?></td>
        <td><?=$row['SUM( ec_product.amount )'];?></td>
    </tr>
<? }?>	
</table>
<br />
<div class="container">
<form method="post" action="mailer.php">
	<p>收信：</p>
	<input type="text" class="form-control" id="receiver" name="receiver"/>
	<textarea name="content"></textarea>
    <p>活動名稱</p>
    <select name="coupon" class="form-control">
        <? while($row = mysqli_fetch_array($list_coupon)){?>
        	<option value="<? echo "
			優惠名稱：".$row['name']."
			<a href='http://vuonggiatuan.notonly.com.tw/alanger/ecommerce/?coupon=".$row['id']."'>優惠連接</a>
			
			";?>
            "><?=$row['name'];?></option>
        <? } ?>
    </select>
    <input type="submit" value="submit" />
</form>
</div>
</body>
</html>
