<?
	require('phpmailer.php');
	$date=$_POST['date'];
	$id=$_POST['id'];
	$name=$_POST['name'];
	$type=$_POST['type'];
	$sex=$_POST['sex'];
	$tel=$_POST['tel'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$birthday=$_POST['birthday'];
	$job=$_POST['job'];
	$type1=implode(",",$_POST['type1']);
	$type2=implode(",",$_POST['type2']);
	$remark=$_POST['remark'];
	
	if($name!=null&&$email!=null){
	mailer($email, $name, $id);
	$con=mysqli_connect("localhost","username","password","database");
	if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
	mysql_query("SET CHARACTER SET utf8 ");
	$con->set_charset("utf8");
	$sql="INSERT INTO `alanger`.`customer_member_information` (`id`, `name`, `type`, `sex`, `tel`, `address`, `email`, `birthday`, `job`, `type1`, `type2`, `remark`, `date`) VALUES ('".$id."', '".$name."', '".$type."', '".$sex."', '".$tel."', '".$address."', '".$email."', '".$birthday."', '".$job."', '".$type1."', '".$type2."', '".$remark."', '".$date."');";
	mysqli_query($con,$sql);
	//echo $sql;
	mysqli_close($con);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>增加新會員</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
</head>

<body>
<form action="./new_customer.php" method="post">
<p align="center">Date:<input type="text" name="date" value="<?=date("Y-m-d");?>"/></p>
<hr />
<h2 align="center">基本資料</h2>
<hr />
<table class="table">
	<tr>
    	<td>會員編號</td><td><input type="text" name="id" value="<?="MEM".rand(1000,9999);?>"/></td>
    </tr>
    <tr>
    	<td>姓名</td><td><input type="text" name="name" /></td>
    </tr>
    <tr>
    	<td>類型</td><td><input type="radio" name="type" value="normal"/>一般會員
        <input type="radio" name="type" value="vip"/>VIP會員</td>
    </tr>
    <tr>
    	<td>性別</td><td><input type="radio" name="sex" value="male"/>男性
        <input type="radio" name="sex" value="female"/>女性</td>
    </tr>
    <tr>
    	<td>電話號碼</td><td><input type="text" name="tel" /></td>
    </tr>
    <tr>
    	<td>地址</td><td><input type="text" name="address" /></td>
    </tr>
    <tr>
    	<td>電子信箱</td><td><input type="text" name="email" /></td>
    </tr>
</table>
<hr />
	<h2 align="center">進一步了解</h2>
<table class="table">
    <tr>
    	<td>生日</td><td><input type="text" name="birthday" /></td>
    </tr>
    <tr>
    	<td>工作</td>
        <td>
        	<input type="radio" name="job" value="學生"/>學生
            <input type="radio" name="job" value="公－軍－教"/>公－軍－教
            <input type="radio" name="job" value="商人"/>商人
        </td>
    </tr>
    <tr >
    	<td rowspan="2">咖啡嗜好: <br />咖啡豆</td>
        <td>
            <input type="checkbox" name="type1[]" value="淺焙豆" />淺焙豆
            <input type="checkbox" name="type1[]" value="中淺焙豆" />中淺焙豆
            <input type="checkbox" name="type1[]" value="中焙" />中焙
            <input type="checkbox" name="type1[]" value="中深焙豆" />中深焙豆
            <input type="checkbox" name="type1[]" value="深焙豆" />深焙豆
        </td>
        
    </tr>
    <tr>
    	<td>
        	<input type="checkbox" name="type2[]" value="日曬豆" />日曬豆
            <input type="checkbox" name="type2[]" value="水洗豆" />日曬豆
            <input type="checkbox" name="type2[]" value="半水洗豆" />半水洗豆
            <input type="checkbox" name="type2[]" value="密處理豆" />密處理豆
        </td>
    </tr>
</table>
<hr />
<h2 align="center">備註</h2>
<textarea name="remark"></textarea>
<p align="center"><input type="submit" value="加新會員" class="btn btn-primary"/></p>
</form>
</body>
</html>
