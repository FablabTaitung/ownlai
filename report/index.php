<?
	session_start();
	if($_SESSION['username']==null){
		header("location:./login");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Main Control</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script>
	$(document).ready(function(){
		$("#product_report_btn").click(function() {
    		$("#content_frame").attr('src', './product/sale.php');
		});
		$("#customer_report_btn").click(function() {
    		$("#content_frame").attr('src', './customer/sale.php');
		});
		$("#time_report_btn").click(function() {
    		$("#content_frame").attr('src', './time/index.php');
		});
		$("#monitor_report_btn").click(function() {
    		$("#content_frame").attr('src', './monitor/index.php');
		});
	});
	
	
</script>
<style>
	#control{
		float:left;
		width:20%;
		height:100%;
	}
	#content{
		float:left;
		width:80%;
		height:100%;
	}
</style>
</head>

<body>
<div class="container">
	<div id="control" align="center">
    	<img src="http://www.mbackcard.net/store_image/803/0311be7527b0802328df3073e60d764c.jpg" height="200" width="240"/>
        
    	<hr/>
        <p>User:<?=$_SESSION['username'];?>
        <a href="./login/?cmd=logout" class="btn btn-danger">登出</a></p><br />
    	
        <hr />
        <h2>報告</h2>
        <div class="btn-group-vertical">
			<p id="product_report_btn" class="btn btn-primary">產品分析</p><br />
            <p id="customer_report_btn" class="btn btn-primary">顧客分析</p><br />
            <p id="time_report_btn" class="btn btn-primary">時間分析</p><br />
            <p id="monitor_report_btn" class="btn btn-primary">流量分析</p><br />
		</div>
    </div>
    <div id="content">
    	<iframe id="content_frame" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%"></iframe>
    </div>
</div>
</body>
</html>