<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>POS</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="./js/jquery.clock.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script>
	$(document).ready(function(){
		$('#digital-clock').clock({offset: '0', type: 'digital'});
		
		$("#quantity").dialog({ autoOpen: false });
		var result="";
		var string;
		var array;
		var qty;
		var sum=0;
		var num=0;
		$(".item").click(function(){
			string=$(this).text();
			array=string.split(',');
			
			$("#quantity").dialog("open");
		});
		$(".quantity").click(function(){
				$("#quantity").dialog("close");
				qty=$(this).text();
				if(qty!=0){
				$('#total > tbody:last').append('<tr><td>'+array[0]+'</td><td>'+array[1]+'</td><td>'+qty+'</td><td>'+(qty*array[1])+'</td></tr>');}
			result=result+'-'+qty+','+array[0]+','+array[1]+','+(qty*array[1])+'';
			$('#text_result').val(result);
			sum=sum+(qty*array[1]);
			num=num+1;
			$('#sum').val(sum);
			$('#num').val(num);
			});
		$("#quantity_submit").click(function(){
			$("#quantity").dialog("close");
			qty=$("#quantity_textbox").val();
			if(qty!=0){
				$('#total > tbody:last').append('<tr><td>'+array[0]+'</td><td>'+array[1]+'</td><td>'+qty+'</td><td>'+(qty*array[1])+'</td></tr>');}
			result=result+'-'+qty+','+array[0]+','+array[1]+','+(qty*array[1])+'';
			$('#text_result').val(result);
			sum=sum+(qty*array[1]);
			num=num+1;
			$('#sum').val(sum);
			$('#num').val(num);
			$("#quantity_textbox").val("");
		});
		
		$("#member_id").autocomplete({
			source:'customer_list.php', 
			minLength:2,
			select:function(event,ui){
				var vip_sum=0.9*$('#sum').val();
				$('#sum').val(vip_sum);
			}
		});
		
		$('#vip_checkbox').change(function() {
		    if(this.checked) {
			var vip_sum=0.9*$('#sum').val();
			$('#sum').val(vip_sum);
		    } else {
			var vip_sum=$('#sum').val()/0.9;
			$('#sum').val(vip_sum);
		    }
		});
	});
</script>
</head>

<body>

<div id="quantity" title="Quantity" align="center">
	<p class="btn btn-primary quantity" >1</p>
    <p class="btn btn-primary quantity" >2</p>
    <p class="btn btn-primary quantity" >3</p>
    <p class="btn btn-primary quantity" >4</p>
    <p class="btn btn-primary quantity" >5</p>
    <br />
    <p class="btn btn-primary quantity" >6</p>
    <p class="btn btn-primary quantity" >7</p>
    <p class="btn btn-primary quantity" >8</p>
    <p class="btn btn-primary quantity" >9</p>
    <p class="btn btn-primary quantity" >10</p>
    <br />
    <input type="text" id="quantity_textbox"/>
    <p class="btn btn-primary" id="quantity_submit">確認</p>
</div>

<form action="checkout.php" method="post">
<div class="page-header">
<table class="table" align="center">
	<tr>
    	<td>POS 銷售資訊系統</td><td>類別</td>
        <td align="right"><p id="digital-clock" class="digital">
        	<b><? echo date("Y-m-d");?></b>
          <b class="hour"></b>
          <b class="min"></b>
          <b class="sec"></b>
          <b class="meridiem"></b>
		</p></td>
    </tr>
</table>
</div>

<div class="container">
<table class="table">
	<tr>
    	<td rowspan="5">
        	<table>
            	<tr>
                	<td><p class="btn btn-primary item" value="義式咖啡,70">義式咖啡,70</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="台東咖啡,120">台東咖啡,120</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="義式掛耳濾泡咖啡,250">義式掛耳濾泡咖啡,250</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="台東掛耳濾泡咖啡,400">台東掛耳濾泡咖啡,400</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="義式調合咖啡專用豆,225">義式調合咖啡專用豆,225</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="義式咖啡1/2 磅,300">義式咖啡1/2 磅,300</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="台東咖啡豆1/2 磅,550">台東咖啡豆1/2 磅,550</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="台東黃金咖啡豆1/2 磅,650">台東黃金咖啡豆1/2 磅,650</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="台東特選咖啡豆1/2 磅,800">台東特選咖啡豆1/2 磅,550</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="台東經典咖啡豆1/2 磅,1000">台東經典咖啡豆1/2 磅,1000</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-primary item" value="經典咖啡豆1/2 磅,1100">經典咖啡豆1/2 磅,1100</p></td>
                </tr>
                <tr>
                    <td><p class="btn btn-danger item" value="香腸禮盒(2斤裝),500">香腸禮盒(2斤裝),500</p></td>
                </tr>
            </table>
    	</td>
    </tr>
    <tr>
    	<td>
    		<table class="table" id="total">
            	<tbody>
            	<tr><td>品名</td><td>價格</td><td>數量</td><td>總共</td></tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
    	<td>總共:</td><td><input type="text" id="sum" name="sum" readonly="readonly">
        <input type="hidden" id="num" name="num"></td>
    </tr>
    <tr>
    	<td>顧客會員編號:</td><td><input type="text" name="member_id" id="member_id"></td>
    </tr>
    <tr>
	<td>9折優惠</td><td><input type="checkbox" name="vip" id="vip_checkbox" ></td>
    </tr>
</table>
</div>

<div id="customer">
</div>

<div id='result' align="center">
	<input type="hidden" name="text_result" id="text_result" />
    <input type="submit" value="Check Out" class="btn btn-primary item"/>
</div>

</form>
<hr />
<p align="center"><a href="../report/pos/day_report.php" class="btn btn-primary">日報表</a></p>
</body>
</html>
