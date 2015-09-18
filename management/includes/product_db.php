<?
	function show_list(){
		$con=mysqli_connect("localhost","username","password","database");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		
		$result = mysqli_query($con,"SELECT * FROM ec_list_products");	
		mysqli_close($con);
		return $result;
	}
?>
