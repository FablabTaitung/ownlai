<?
	$id=$_POST['id'];
	$cat_id=$_POST['category'];
	$name=$_POST['name'];
	$size=$_POST['size'];
	$desc=$_POST['desc'];
	$img=$_POST['img'];
	$price=$_POST['price'];
	if($name!=null){
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$sql="INSERT INTO `alanger`.`ec_list_products` (`id`, `cat_id`, `name`, `size`, `description`, `image`, `price`) VALUES ('".$id."', '".$cat_id."', '".$name."', '".$size."', '".$desc."', '".$img."', '".$price."');";
	//echo $sql;
	$con->set_charset("utf8");
	mysqli_query($con,$sql);	
	mysqli_close($con);
	}
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
<div id="nav">
	
</div>
<div class="container">
<h2 align="center">新增產品</h2>
<div id="form">
	<form action="new_product.php" method="post">
    	<table class="table">
        	<tr><td>ID</td><td><input type="text" name="id" value="<? echo "PR".rand(1000,9999);?>"></td></tr>
            
            <tr><td>名稱</td><td><input type="text" name="name"></td></tr>
            <tr><td>烘培度</td><td><input type="text" name="category"></td></tr>
            <tr><td>單位</td><td><input type="text" name="size"></td></tr>
            <tr><td>描述</td><td><input type="text" name="desc"></td></tr>
            <tr><td>照片鏈接 </td><td><input type="text" name="img"></td></tr>
            <tr><td>價錢</td><td><input type="text" name="price"></td></tr>
        </table>
        <input type="submit" value="Submit" />
    </form>
</div>
</div>
</body>
</html>
