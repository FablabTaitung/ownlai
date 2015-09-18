<?
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list = mysqli_query($con,"SELECT * FROM pos_detail");	
	mysqli_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Untitled Document</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<table class="table">
	<tr>
    	<td>ID</td><td>Time</td><td>Member ID</td><td>Sum</td>
    </tr>
<? while($row = mysqli_fetch_array($list)){?>
	<tr>
		<td><?=$row['id'];?></td>
        <td><?=$row['time'];?></td>
        <td><?=$row['member_id'];?></td>
        <td><?=$row['sum'];?></td>
        <td><a href="./detail.php?id=<?=$row['id'];?>" class="btn btn-primary">詳細資料</a></td>
    </tr>
<? }?>
</table>
</body>
</html>
