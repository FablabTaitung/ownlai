<?
	$id=$_GET['id'];
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list = mysqli_query($con,"SELECT * FROM ec_list_products WHERE id like '".$id."'");	
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
<link href="css/main_theme.css" rel="stylesheet">
<style>
	.pimg{
	float:left;
	padding: 10px;
	margin:10px;
	}
	.infor{
		float:left;
		margin:10px;
	}
</style>
</head>
<body>
<h1 align="center">艾蘭哥爾咖啡-幸福奇蹟</h1>
<hr />
<div class='container'>
<center>
	<?
	while($row = mysqli_fetch_array($list))
		  {
		  $size = explode("~", $row['size']);	  
			$min=$size[0];
			$max=$size[1];  
			$product_id=$row['id'];
			//$product_id=$row['id'];
			?>
<div class="row" align="center">
	<div class="thumbnail pimg .col-xs-6 .col-md-8 .col-sm-6">
      	<img src="<?=$row['image'];?>" style="width:500px;" />
      </div>    
		<div class="infor .col-xs-6 .col-md-4 thumbnail">
        	<table class="table">
            	<tr><td>名字</td><td><?=$row['name'];?></td></tr>
                <tr><td>尺寸</td><td><?=$row['size'];?></td></tr>
                <tr><td>描述</td><td><?=$row['description'];?></td></tr>
                <tr><td>價錢</td><td><?=$row['price'];?></td></tr>
        
<?		  $name=$row['name'];
		  $size=$row['size'];
		  $price=$row['price']; ?>
        <form action="./includes/addtocart.php" method="post">
        <input type='hidden' name='id' value='<? echo $product_id;?>' />
        <input type='hidden' name='name' value='<? echo $name;?>' />
        <input type='hidden' name='size' value='<? echo $size;?>' />
        <input type='hidden' name='price' value='<? echo $price;?>' />
        <tr>
            <td>數量</td>
            <td><input type="text" name="amount" /></td>
        </tr>
        <tr>
        <td><p align="center"><a class='btn btn-primary' href="./">繼續購物</a></p></td>
        <td><input type="submit" value="加到購物車" class='btn btn-primary' style=" background-color: #C60; "></td>
        </tr>
        
    </form>
    </table>  
     </div>
</div>     
 <? } ?>
 </center>
</div>

</body>
</html>
