<?
	$con=mysqli_connect("localhost","username","password","database");
	if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
	mysql_query("SET CHARACTER SET utf8 ");
	$con->set_charset("utf8");
	$sql="SELECT * FROM customer_member_information";
	$result=mysqli_query($con,$sql);
	mysqli_close($con);
	
	
	while( $row = mysqli_fetch_array($result) )
		{
			//echo "Hello";
			$data[] = array('label' => $row['id'].",".$row['name'], 'value' => $row['id'] );
			//echo $row['id'];
		}

	echo json_encode($data);
	flush();
?>
