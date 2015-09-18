<?
	
	session_start();
	$time=date("Y-m-d H:i:s");
	$agent=$_SERVER['HTTP_USER_AGENT'];
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	$referer=$_SERVER['HTTP_REFERER'];
	$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip."");
	$city=$xml->geoplugin_countryName.",".$xml->geoplugin_city;
	$weather=simplexml_load_file("http://api.openweathermap.org/data/2.5/weather?lat=".$xml->geoplugin_latitude."&lon=".$xml->geoplugin_longitude."&mode=xml");
	//$weather=(string)$weather->clouds['value'];
	$cloud=$weather->clouds->attributes();
	$status=$weather->weather->attributes();
	$temp=$weather->temperature->attributes();
	$temp['value']=$temp['value']-273.15;
	$coupon=$_GET['coupon'];
	
	$k=$_GET['k'];
	//echo $k;
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	mysqli_query($con,"INSERT INTO `alanger`.`ec_monitor` (`time`, `agent`, `ip`, `referer`, `city`, `temp`, `cloud`, `weather`) VALUES ('".$time."', '".$agent."', '".$ip."', '".$referer."', '".$city."', '".$temp['value']."', '".$cloud['name']."', '".$status['value']."')");
	$con->set_charset("utf8");	
	if($k==null){
	$list = mysqli_query($con,"SELECT * FROM ec_list_products");
	} else {
	$list = mysqli_query($con,"SELECT * FROM ec_list_products WHERE  `name` LIKE  '%".$k."%'");
	//echo "SELECT * FROM ec_list_products WHERE  `name` LIKE  '%".$k."%'";
	}
	
	$list2 = mysqli_query($con,"SELECT * FROM ec_coupon WHERE id LIKE '".$coupon."'");	
	mysqli_close($con);
	while($row = mysqli_fetch_array($list2)){ 
		$_SESSION['coupon_id']=$row['id'];
		$_SESSION['coupon_name']=$row['name'];
		$_SESSION['coupon_rule']=$row['rule'];
		$_SESSION['coupon_status']=$row['status'];
		$_SESSION['coupon_expiration_date']=$row['expiration_date'];
    } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>艾蘭哥爾咖啡-幸福奇蹟</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="css/main_theme.css" rel="stylesheet">
<style>
	.menu{
		background-color: rgba(225, 225, 225, 0.8);
		color:#733912;
	}
	.menu:hover{
		color:#FFF;
		background-color: #733912;
	}
</style>
</head>

<body>
<h1 align="center" style="color:#733912; background-color: rgba(225, 225, 225, 0.6);">艾蘭哥爾咖啡</h1>

<div class="container" align="center">

<h3 class="row" style="color:#733912; background-color: rgba(225, 225, 225, 0.6);">
	<a class="col-xs-6 col-sm-2 menu" href="./?k=義"><img src="http://wiki.openstreetmap.org/w/images/e/e9/Coffee.png" height="30px"/>義式咖啡</a>
    <a class="col-xs-6 col-sm-2 menu" href="./?k=台東"><img src="http://wiki.openstreetmap.org/w/images/e/e9/Coffee.png" height="30px"/>台東咖啡</a>
    <a class="col-xs-6 col-sm-2 menu" href="./?k=濾泡"><img src="http://wiki.openstreetmap.org/w/images/e/e9/Coffee.png" height="30px"/>濾泡咖啡</a>
    <a class="col-xs-6 col-sm-2 menu" href="./?k=豆"><img src="http://wiki.openstreetmap.org/w/images/e/e9/Coffee.png" height="30px"/>咖啡豆</a>
    <a class="col-xs-6 col-sm-2 menu" href="./?k=小吃"><img src="http://wiki.openstreetmap.org/w/images/e/e9/Coffee.png" height="30px"/>咖啡小吃</a>
    <a href="cart.php" class="col-xs-6 col-sm-2 menu"><img src="http://wiki.openstreetmap.org/w/images/e/e9/Coffee.png" height="30px"/>購物車</a>
</h3>

<div class="catalog" align="center">
<? while($row = mysqli_fetch_array($list)){?>
<div class="thumbnail product_box">
<img src=<?=$row['image']?> with='100%' />
<table>
		  <tr><td class='pname' style=' width: 20%; font-weight: bold; font-size: 20px;'><?=$row['name'];?></td></tr>
		  <tr><td style=' width: 10%;	'>單位：<?=$row['size']?></td></tr>  
		  <tr><td style=' width: 10%; '>價錢：<?=$row['price']?></td></tr>
		  <tr><td><a href='./product_detail?id=<?=$row['id']?>' class='btn btn-primary' style=' background-color: #C60; '>詳細資料</a></td></tr>
		  
</table>
</div>
<? }?>
</div>
</div>
</body>
</html>
