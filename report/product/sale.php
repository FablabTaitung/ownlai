<?
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list_sumprice = mysqli_query($con,"SELECT name, SUM( total ) FROM ec_product GROUP BY product_id ORDER BY SUM( total ) DESC");
	$list_sumprice1 = mysqli_query($con,"SELECT name, SUM( total ) FROM ec_product GROUP BY product_id ORDER BY SUM( total ) DESC");	
	$list_sumbox = mysqli_query($con,"SELECT name, SUM( amount ) FROM ec_product GROUP BY product_id ORDER BY SUM( amount ) DESC");
	$list_sumbox1 = mysqli_query($con,"SELECT name, SUM( amount ) FROM ec_product GROUP BY product_id ORDER BY SUM( amount ) DESC");
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../dist/jquery.jqplot.min.css" />
<script>
	$(document).ready(function(){
		var data_price = [
    <? while($row = mysqli_fetch_array($list_sumprice1)){
		echo "['".$row['name']."' , ".$row['SUM( total )']."],"; }?>
  ];
  		var data_box = [
    <? while($row = mysqli_fetch_array($list_sumbox1)){
		echo "['".$row['name']."' , ".$row['SUM( amount )']."],"; }?>
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
		<td><?=$row['name'];?></td>
        <td><?=$row['SUM( total )'];?></td>
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
		<td><?=$row['name'];?></td>
        <td><?=$row['SUM( amount )'];?></td>
    </tr>
<? } ?>
</table>
</div>

</body>
</html>
