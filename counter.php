<?php
	require($_SERVER["DOCUMENT_ROOT"]."/config/db_conf.php");
	$con=mysqli_connect($db_host,$db_user,$db_password);
	mysqli_select_db($con,$db_name);
	
	$page=$_SERVER["PHP_SELF"];
	//$_page=www.google.com
	$ip=$_SERVER["REMOTE_ADDR"];
	$date=time();
	
	$query="insert into traker (page,IP,date) values('$page','$ip','$date')";
	mysqli_query($con,$query) or die(mysql_error());
	
	$query="select count(*) from traker where page='$page'";
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_row($result);
	$views=$row[0];
	echo "the views for the site ".$page." are ".$views;
?>
