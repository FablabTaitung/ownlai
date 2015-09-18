<?
//month
	$sql4="SELECT MONTH( ec_order.time ) , SUM( ec_product.total ) , SUM( ec_product.amount ) 
FROM ec_order
INNER JOIN ec_product ON ec_product.order_id = ec_order.order_id
INNER JOIN ec_customer ON ec_customer.customer_id = ec_order.customer_id
GROUP BY MONTH( ec_order.time ) ";
//date
	$sql="SELECT DATE( ec_order.time ) , SUM( ec_product.total ) , SUM( ec_product.amount ) 
FROM ec_order
INNER JOIN ec_product ON ec_product.order_id = ec_order.order_id
INNER JOIN ec_customer ON ec_customer.customer_id = ec_order.customer_id
GROUP BY DATE( ec_order.time ) ";
//weekday
	$sql2="SELECT DAYOFWEEK( ec_order.time ) , SUM( ec_product.total ) , SUM( ec_product.amount ) 
FROM ec_order
INNER JOIN ec_product ON ec_product.order_id = ec_order.order_id
INNER JOIN ec_customer ON ec_customer.customer_id = ec_order.customer_id
GROUP BY DAYOFWEEK( ec_order.time ) ";
//hour
	$sql3="SELECT HOUR( ec_order.time ) , SUM( ec_product.total ) , SUM( ec_product.amount ) 
FROM ec_order
INNER JOIN ec_product ON ec_product.order_id = ec_order.order_id
INNER JOIN ec_customer ON ec_customer.customer_id = ec_order.customer_id
GROUP BY HOUR( ec_order.time ) ";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
