<?php
	$conn= new mysqli('localhost','root','','test_1');
	if ($conn->connect_error) {
		die('connection failed');
	} 
	

	$usr= $_POST['usr'];
	$pass= $_POST['pass'];

	$sql="select * from lgn_info where usr_name = '$usr' and usr_pwd = '$pass' ";

	$res= $conn->query($sql);

	if ($res-> num_rows>0) {
		while ( $row=$res->fetch_assoc()) {
			header('Location: home.html');

		}
	} else {
		$message = "Username and/or Password incorrect.\\nTry again.";
		$returl = "index.html";
  		echo "<script type='text/javascript'>alert('$message'); window.location = ('$returl');</script>";
  		

	}
		
	
?>
