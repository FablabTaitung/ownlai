<?
	session_start();
	$id=$_GET['id'];
	if(is_array($_SESSION['cart'])){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($id==$_SESSION['cart'][$i]['id']){
				unset($_SESSION['cart'][$i]);
			}
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']);
	header('location:cart.php');
	
?>