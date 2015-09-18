<?
	$id=$_GET['id'];
	$t=$_GET['t'];
	$con=mysqli_connect("localhost","username","password","database");
	if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
	mysql_query("SET CHARACTER SET utf8 ");
	$con->set_charset("utf8");
	$sql="SELECT * FROM customer_member_information where id like '".$id."' and type like '".$t."'";
	$result=mysqli_query($con,$sql);
	mysqli_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Customer Detail</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<h1 align="center">顧客詳細資料</h1>
<p align="center">
	<a href="./" class="btn btn-primary">回到主頁</a>
</p>
<?
	while($row = mysqli_fetch_array($result))
  		{
?>
	<table class="table">
	<tr>
    	<td>會員編號</td><td><?=$row['id'];?></td>
    </tr>
    <tr>
    	<td>姓名</td><td><?=$row['name'];?></td>
    </tr>
    <tr>
    	<td>類型</td><td><?=$row['type'];?></td>
    </tr>
    <tr>
    	<td>性別</td><td><?=$row['sex'];?></td>
    </tr>
    <tr>
    	<td>電話號碼</td><td><?=$row['tel'];?></td>
    </tr>
    <tr>
    	<td>地址</td><td><?=$row['address'];?></td>
    </tr>
    <tr>
    	<td>電子信箱</td><td><?=$row['email'];?></td>
    </tr>
</table>
<hr />
	<h2 align="center">進一步了解</h2>
<table class="table">
    <tr>
    	<td>生日</td><td><?=$row['birthday'];?></td>
    </tr>
    <tr>
    	<td>工作</td>
        <td>
        	<?=$row['job'];?>
        </td>
    </tr>
    <tr >
    	<td rowspan="2">咖啡嗜好: <br />咖啡豆</td>
        <td>
            <?=$row['type1'];?>
        </td>
        
    </tr>
    <tr>
    	<td>
        	<?=$row['type2'];?>
        </td>
    </tr>
</table>
<hr />
<h2 align="center">備註:</h2>
<p align="center"><?=$row['remark'];?></p>
<?
  		}
?>
</body>
</html>
