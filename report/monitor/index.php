<?
	$con=mysqli_connect("localhost","root","089325108","alanger");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list_sumprice = mysqli_query($con,"SELECT cloud, COUNT( cloud ) FROM ec_monitor WHERE NULLIF(  `cloud` ,  '' ) IS NOT NULL GROUP BY cloud ORDER BY COUNT( cloud ) DESC");
	$list_sumprice1 = mysqli_query($con,"SELECT cloud, COUNT( cloud ) FROM ec_monitor WHERE NULLIF(  `cloud` ,  '' ) IS NOT NULL GROUP BY cloud ORDER BY COUNT( cloud ) DESC");	
	$list_sumbox = mysqli_query($con,"SELECT weather, COUNT( weather ) FROM ec_monitor WHERE NULLIF(  `weather` ,  '' ) IS NOT NULL GROUP BY weather  ORDER BY COUNT( weather ) DESC");
	$list_sumbox1 = mysqli_query($con,"SELECT weather, COUNT( weather ) FROM ec_monitor WHERE NULLIF(  `weather` ,  '' ) IS NOT NULL GROUP BY weather  ORDER BY COUNT( weather ) DESC");
	$list_temp1a=mysqli_query($con,"SELECT COUNT( temp ) , CASE WHEN temp BETWEEN 10 AND 15 THEN  '10-15' WHEN temp BETWEEN 15 AND 20 THEN  '15-20' WHEN temp BETWEEN 20 AND 25 THEN  '20-25' WHEN temp BETWEEN 25 AND 30 THEN  '25-30' WHEN temp BETWEEN 30 AND 35 THEN  '30-35' WHEN temp BETWEEN 35 AND 40 THEN  '35-40' END AS temp_group FROM ec_monitor GROUP BY temp_group");
	$list_temp1b=mysqli_query($con,"SELECT COUNT( temp ) , CASE WHEN temp BETWEEN 10 AND 15 THEN  '10-15' WHEN temp BETWEEN 15 AND 20 THEN  '15-20' WHEN temp BETWEEN 20 AND 25 THEN  '20-25' WHEN temp BETWEEN 25 AND 30 THEN  '25-30' WHEN temp BETWEEN 30 AND 35 THEN  '30-35' WHEN temp BETWEEN 35 AND 40 THEN  '35-40' END AS temp_group FROM ec_monitor GROUP BY temp_group");
	$list_temp1c=mysqli_query($con,"SELECT COUNT( temp ) , CASE WHEN temp BETWEEN 10 AND 15 THEN  '10-15' WHEN temp BETWEEN 15 AND 20 THEN  '15-20' WHEN temp BETWEEN 20 AND 25 THEN  '20-25' WHEN temp BETWEEN 25 AND 30 THEN  '25-30' WHEN temp BETWEEN 30 AND 35 THEN  '30-35' WHEN temp BETWEEN 35 AND 40 THEN  '35-40' END AS temp_group FROM ec_monitor GROUP BY temp_group");
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
<script src="../dist/jquery.jqplot.min.js"></script>
<script src="../dist/plugins/jqplot.pieRenderer.min.js"></script>
<script src="../dist/plugins/jqplot.donutRenderer.min.js"></script>
<script type="text/javascript" src="../dist/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="../dist/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="../dist/plugins/jqplot.pointLabels.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../dist/jquery.jqplot.min.css" />
<script>
	$(document).ready(function(){
		$.jqplot.config.enablePlugins = true;
        var s1 = [<? while($rows = mysqli_fetch_array($list_temp1a)){ echo $rows['COUNT( temp )'].",";}?>];
		var ticks1 = [<? while($rows = mysqli_fetch_array($list_temp1b)){ echo "'".$rows['temp_group']."',";}?>];
		var data_price = [
    <? while($row = mysqli_fetch_array($list_sumprice1)){
		echo "['".$row['cloud']."' , ".$row['COUNT( cloud )']."],"; }?>
  ];
  		var data_box = [
    <? while($row = mysqli_fetch_array($list_sumbox1)){
		echo "['".$row['weather']."' , ".$row['COUNT( weather )']."],"; }?>
  ];
  var plot1= jQuery.jqplot ('chart_price', [data_price], 
    { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
		  sliceMargin: 5,
          showDataLabels: true,
        }
      }, 
      legend: { show:true }
    }
  );
  
  var plot2= jQuery.jqplot ('chart_box', [data_box], 
    { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
		  sliceMargin: 4, 
          showDataLabels: true
        }
      }, 
      legend: { show:true }
    }
  );
  plot3 = $.jqplot('chart_3', [s1], {
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
	});
</script>
<style>
	.chart{
		width:65%;
		float:left;
	}
	.content{
		width:25%;
		float:left;
	}
</style>
</head>

<body>
<h1 align="center">產品分析</h1>
<hr />
<div>
<div id="chart_price" style="height:400; width:400; position: relative;" class="jqplot-target chart">
</div>
<table class="table content">
	<tr>
    	<td>產品</td><td>總收入</td>
    </tr>
<? while($row = mysqli_fetch_array($list_sumprice)){?>
	<tr>
		<td><?=$row['cloud'];?></td>
        <td><?=$row['COUNT( cloud )'];?></td>
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
<? while($row = mysqli_fetch_array($list_sumbox)){?>
	<tr>
		<td><?=$row['weather'];?></td>
        <td><?=$row['COUNT( weather )'];?></td>
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
<? while($rows = mysqli_fetch_array($list_temp1c)){?>
	<tr>
		<td><?=$rows['temp_group'];?></td>
        <td><?=$rows['COUNT( temp )'];?></td>
    </tr>
<? } ?>
</table>
</div>
</div>
</body>
</html>
