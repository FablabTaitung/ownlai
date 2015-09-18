<?
	$con=mysqli_connect("localhost","root","089325108","alanger");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list = mysqli_query($con,"SELECT DATE(time ) , SUM(sum) FROM pos_detail GROUP BY DATE(time) ");	
	mysqli_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Day Report</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<hr />
<p align="center"><a href="../../pos/" class="btn btn-primary">繼續購物</a></p>
<table class="table">
	<tr>
    	<td>日期</td><td>收入</td>
    </tr>
<? while($row = mysqli_fetch_array($list)){?>
	<tr>
		<td><?=$row['DATE(time )'];?></td>
        <td><?=$row['SUM(sum)'];?></td>
    </tr>
<? }?>
</table>

</body>
</html>
