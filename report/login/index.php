<?
	session_start();
	$cmd=$_GET['cmd'];
	echo $cmd;
	$username=$_POST['username'];
	$password=$_POST['password'];
	$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
	$con->set_charset("utf8");	
	$list = mysqli_query($con,"SELECT * FROM ec_admin WHERE username='".$username."' and password=PASSWORD('".$password."')");
	while($row = mysqli_fetch_array($list)){
		if($row['username']==$username){
			$_SESSION['username']=$username;
			header("location:../");
		}
	}
	mysqli_close($con);
	if($cmd=="logout"){
		session_destroy();
		header("location:../");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
<p align="center"><img src="http://www.mbackcard.net/store_image/803/0311be7527b0802328df3073e60d764c.jpg" height="400" width="440"/></p>
<form action="./" method="post">
<table class="table" class="table">
	<tr>
    	<td>Username</td><td><input type="text" name="username" /></td>
    </tr>
    <tr>
    	<td>Password</td><td><input type="password" name="password"></td>
    </tr>
</table>
<p align="center"><input type="submit" value="Submit" class="btn btn-primary"/></p>
</form>
</div>
</body>
</html>
