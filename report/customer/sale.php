<?
	$group['S']=0;
	$group['A']=0;
	$group['B']=0;
	$group['C']=0;
	$group['D']=0;
	$sum['S']=0;
	$sum['A']=0;
	$sum['B']=0;
	$sum['C']=0;
	$sum['D']=0;
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$sql="SELECT ec_customer.customer_email, SUM( ec_product.total ) , SUM( ec_product.amount ) FROM ec_order INNER JOIN ec_product ON ec_product.order_id = ec_order.order_id
INNER JOIN ec_customer ON ec_customer.customer_id = ec_order.customer_id GROUP BY ec_customer.customer_email ";
	$list_1= mysqli_query($con,$sql." ORDER BY SUM( ec_product.total ) DESC");	
	$list_2= mysqli_query($con,$sql." ORDER BY SUM( ec_product.amount ) DESC");
	$list_3= mysqli_query($con,$sql." ORDER BY SUM( ec_product.total ) DESC");
	$list_3b= mysqli_query($con,$sql." ORDER BY SUM( ec_product.amount ) DESC");
	$list_4= mysqli_query($con,$sql." ORDER BY SUM( ec_product.total ) DESC");
	$list_5= mysqli_query($con,$sql." ORDER BY SUM( ec_product.amount ) DESC");
	$sql_group="SELECT ec_customer.customer_email, SUM( ec_product.total ) AS sum, CASE WHEN SUM(ec_product.total ) BETWEEN 0 AND 100 THEN  'D' WHEN SUM( ec_product.total ) BETWEEN 1000 AND 5000 
THEN  'C' WHEN SUM( ec_product.total ) BETWEEN 5000 AND 10000 THEN  'B' WHEN SUM( ec_product.total ) BETWEEN 10000 AND 99999 THEN  'A' WHEN SUM( ec_product.total ) >99999 THEN  'S' END AS customer_group FROM ec_order INNER JOIN ec_product ON ec_product.order_id = ec_order.order_id INNER JOIN ec_customer ON ec_customer.customer_id = ec_order.customer_id GROUP BY ec_customer.customer_email";
	$list_group1= mysqli_query($con,$sql_group);
	//$list_group2= mysqli_query($con,$sql_group);
	//$list_group3= mysqli_query($con,$sql_group);
	mysqli_close($con);
	while($rows = mysqli_fetch_array($list_group1)){
		if($rows['customer_group']=='S'){ $group['S']=$group['S']+1; $sum['S']=$sum['S']+$rows['sum'];}
		else if($rows['customer_group']=='A'){ $group['A']=$group['A']+1; $sum['A']=$sum['A']+$rows['sum'];}
		else if($rows['customer_group']=='B'){ $group['B']=$group['B']+1; $sum['B']=$sum['B']+$rows['sum'];}
		else if($rows['customer_group']=='C'){ $group['C']=$group['C']+1; $sum['C']=$sum['C']+$rows['sum'];}
		else if($rows['customer_group']=='D'){ $group['D']=$group['D']+1; $sum['D']=$sum['D']+$rows['sum'];}
	}
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
        var s1 = [<? while($rows = mysqli_fetch_array($list_1)){ echo $rows['SUM( ec_product.total )'].",";}?>];
		var s2 = [<? while($rows = mysqli_fetch_array($list_2)){ echo $rows['SUM( ec_product.amount )'].",";}?>];
		var s3 = [<?=$group['S']?>,<?=$group['A']?>,<?=$group['B']?>,<?=$group['C']?>,<?=$group['D']?>];
        var ticks1 = [<? while($rows = mysqli_fetch_array($list_3)){ echo "'".$rows['customer_email']."',";}?>];
		var ticks2 = [<? while($rows = mysqli_fetch_array($list_3b)){ echo "'".$rows['customer_email']."',";}?>];
        var ticks3 = ['S','A','B','C','D']; 
		var data_price = [['S',<?=$sum['S'];?>],['A',<?=$sum['A'];?>],['B',<?=$sum['B'];?>],['C',<?=$sum['C'];?>],['D',<?=$sum['D'];?>]];
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
		var plot4= jQuery.jqplot ('chart_4', [data_price], 
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
<h1 align="center">顧客分析</h1>
<hr />
<div class="container" align="center">
<div>
<div id="chart_3" style="height:400; width:400; position: relative;" class="jqplot-target chart">
</div>
<table class="table content">
	<tr>
    	<td>產品</td><td>總收入</td><td></td>
    </tr>
	<tr><td>S</td><td><?=$group['S'];?></td><td><a href="./customer_list.php?type=S" class="btn btn-primary">詳細</a></td></tr>
    <tr><td>A</td><td><?=$group['A'];?></td><td><a href="./customer_list.php?type=A" class="btn btn-primary">詳細</a></td></tr>
    <tr><td>B</td><td><?=$group['B'];?></td><td><a href="./customer_list.php?type=B" class="btn btn-primary">詳細</a></td></tr>
    <tr><td>C</td><td><?=$group['C'];?></td><td><a href="./customer_list.php?type=C" class="btn btn-primary">詳細</a></td></tr>
    <tr><td>D</td><td><?=$group['D'];?></td><td><a href="./customer_list.php?type=D" class="btn btn-primary">詳細</a></td></tr>
</table>
</div>

<div>
<div id="chart_4" style="height:400; width:400; position: relative;" class="jqplot-target chart">
</div>
<table class="table content">
	<tr>
    	<td>產品</td><td>總收入</td>
    </tr>
	<tr><td>S</td><td><?=$sum['S'];?></td></tr>
    <tr><td>A</td><td><?=$sum['A'];?></td></tr>
    <tr><td>B</td><td><?=$sum['B'];?></td></tr>
    <tr><td>C</td><td><?=$sum['C'];?></td></tr>
    <tr><td>D</td><td><?=$sum['D'];?></td></tr>
</table>
</div>

<div>
<div id="chart_sum" style="height:400; width:400; position: relative;" class="jqplot-target chart">
</div>
<table class="table content">
	<tr>
    	<td>產品</td><td>總收入</td>
    </tr>
<? while($rows = mysqli_fetch_array($list_4)){?>
	<tr>
		<td><?=$rows['customer_email'];?></td>
        <td><?=$rows['SUM( ec_product.total )'];?></td>
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
<? while($rows = mysqli_fetch_array($list_5)){?>
	<tr>
		<td><?=$rows['customer_email'];?></td>
        <td><?=$rows['SUM( ec_product.amount )'];?></td>
    </tr>
<? } ?>
</table>
</div>
</div>
</body>
</html>
