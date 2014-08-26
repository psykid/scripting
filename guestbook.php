<!--"php echo htmlspecialchars($_SERVER["PHP_SELF"]);?" -->
<html>
<head>
	<title>The guest book</title>
</head>
<body>
<center>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" accept-charset=utf-8> 
<font face="arial" size="3">
	Email: <input type="text" name="email" /><br><br>
	Name: <input type="text" name="txt_name" /><br><br>
	Comments:<br>
	<textarea style="width:60%" rows="10" name="comment" ></textarea>
	<center>
		<input type="submit" value="Submit" />
	</center>
</font>	
</form>

</script>
</center>
</body>
</html>

<html>
<body>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require($_SERVER["DOCUMENT_ROOT"]."/config/db_conf.php");
	$con=mysqli_connect($db_host,$db_user,$db_password) or die("connection failed");
	
	mysqli_select_db($con,$db_name);
	$name=mysqli_real_escape_string($con,$_POST['txt_name']);
	$var=strlen($name);
	if($var>0)
	{
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$comment=$_POST["comment"];
		$date=time();
		$query="insert into guest_book (ID,name,email,comment,date) values(NULL,'$name','$email','$comment','$date')";
		mysqli_query($con,$query) or die(mysql_error());
	}
	}
?>

<table bgcolor="#AAAAAA" border="0" width="75%" cellspacing="1" cellpadding="2">
<?php
include 'tracker.php';
	$query ="select * from guest_book order by date desc";
	$result=mysqli_query($con,$query) or die(mysql_error()); 
	while($row=mysqli_fetch_assoc($result))
	{
		$name=$row['name'];
		$email=$row['email'];
		$comment=$row['comment'];
		$date=$row['date'];
		
		$email_len=count($email);
		$show_date=date("h:i:s m/d/Y",$date);
		
		echo "
			<tr>
				<td width='50%' bgcolor=#EEEEEE>
					<font face='arial' size='2'>
					<b>Name: </b>$name<br>
					
					<br>
					<b>Comment: </b>$comment
					</font>
				</td>
				<td valign='top' nowrap bgcolor='#EEEEEE'>
					<font face='arial' size='2'>
						<b>Date: </b>$show_date
					</font>
				</td>
			</tr>";
	}
?>
</table>
</body>
<!--echo '<b>Name:</b> <a href="mailto:'.$email.'">'.$name.'</a>';>
</html>
