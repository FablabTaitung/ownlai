<?
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$sql="SELECT HOUR( time ), COUNT( time ) FROM  `ec_monitor` GROUP BY HOUR( time ) ";
	$sql1="SELECT DATE( time ), COUNT( time ) FROM  `ec_monitor` GROUP BY DATE( time ) ";
	$sql2="SELECT DAYOFWEEK( time ), COUNT( time ) FROM  `ec_monitor`  GROUP BY DAYOFWEEK( time ) ";
	$list_1= mysqli_query($con,$sql);	
	$list_1b= mysqli_query($con,$sql);
	$list_1c= mysqli_query($con,$sql);
	$list_2= mysqli_query($con,$sql1);
	$list_2b= mysqli_query($con,$sql1);
	$list_2c= mysqli_query($con,$sql1);
	$list_3= mysqli_query($con,$sql2);
	$list_3b= mysqli_query($con,$sql2);
	$list_3c= mysqli_query($con,$sql2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="../dist/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="../dist/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="../dist/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="../dist/plugins/jqplot.pointLabels.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../dist/jquery.jqplot.min.css" />
<script>
	$(document).ready(function(){
		$.jqplot.config.enablePlugins = true;
        var s1 = [<? while($rows = mysqli_fetch_array($list_1)){ echo $rows['COUNT( time )'].",";}?>];
		var s2 = [<? while($rows = mysqli_fetch_array($list_2)){ echo $rows['COUNT( time )'].",";}?>];
		var s3 = [<? while($rows = mysqli_fetch_array($list_3)){ echo $rows['COUNT( time )'].",";}?>];
        var ticks1 = [<? while($rows = mysqli_fetch_array($list_1b)){ echo "'".$rows['HOUR( time )']."',";}?>];
		var ticks2 = [<? while($rows = mysqli_fetch_array($list_2b)){ echo "'".$rows['DATE( time )']."',";}?>];
		var ticks3 = [<? while($rows = mysqli_fetch_array($list_3b)){ echo "'".$rows['DAYOFWEEK( time )']."',";}?>];
         
        plot1 = $.jqplot('chart_sum', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks1
                }
            },
            highlighter: { show: false }
        });
		
		plot2 = $.jqplot('chart_box', [s2], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks2
                }
            },
            highlighter: { show: false }
        });
		
		plot3 = $.jqplot('chart_3', [s3], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks3
                }
            },
            highlighter: { show: false }
        });
	});
</script>
<style>
	.chart{
		width:55%;
		float:left;
	}
	.content{
		width:30%;
		float:left;
	}
</style>
</head>

<body>
<h1 align="center">時間分析</h1>
<hr />
<div class="container" align="center">
<div>
<div id="chart_sum" style="height:400; width:400; position: relative;" class="jqplot-target chart">
</div>
<table class="table content">
	<tr>
    	<td>時間</td><td>總收入</td>
    </tr>
<? while($rows = mysqli_fetch_array($list_1c)){?>
	<tr>
		<td><?=$rows['HOUR( time )'];?></td>
        <td><?=$rows['COUNT( time )'];?></td>
    </tr>
<? }?>
</table>
</div>
<div>
<div id="chart_box" style="height:400; width:400; position: relative;" class="jqplot-target chart">
</div>
<table class="table content">
	<tr>
    	<td>產品</td><td>總數量</td>
    </tr>
<? while($rows = mysqli_fetch_array($list_2c)){?>
	<tr>
		<td><?=$rows['DATE( time )'];?></td>
        <td><?=$rows['COUNT( time )'];?></td>
    </tr>
<? } ?>
</table>
</div>

<div>
<div id="chart_3" style="height:400; width:400; position: relative;" class="jqplot-target chart">
</div>
<table class="table content">
	<tr>
    	<td>產品</td><td>總數量</td>
    </tr>
<? while($rows = mysqli_fetch_array($list_3c)){?>
	<tr>
		<td><?=$rows['DAYOFWEEK( time )'];?></td>
        <td><?=$rows['COUNT( time )'];?></td>
    </tr>
<? } ?>
</table>
</div>
</div>
</body>
</html>
