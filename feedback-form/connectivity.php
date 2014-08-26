<html>
<head><title>Welcome</title></head>
<header>Welcome to feedback form</header>
<body>
<?php 

if($_SERVER["REQUEST_METHOD"]=="POST"){

$user=$_POST["user"];
$pass=$_POST["pass"];
//echo "values enterd are $user and $pass :D";

require($_SERVER["DOCUMENT_ROOT"]."/config/db_conf.php");
	$con=mysqli_connect($db_host,$db_user,$db_password) or die("connection failed");
	echo "connection established<br>";
	$query="select * from users where user_name='$user' and password='$pass'";
	mysqli_select_db($con,$db_name);
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($result);
	if(empty($row['user_name']))
	{
		echo "<center>username or password is incorrect please check again and retry<br></center>";
	}
	else
	{	session_start();
		$_SERVER["session"]=$pass;
		echo "login successful<br>";
		$query="SELECT teacher FROM student_course WHERE name='$user' "; 
		$teach = mysqli_query($con,$query) or die("error in query");
		echo "<ul>";
		$teacher_list=array(); $i=0;
		while($row=mysqli_fetch_assoc($teach)){
			$teacher_list=array_merge((array)$teacher_list,(array)$row['teacher']);
			echo "<li><a href='index.php'>".$teacher_list[$i]." &nbsp </a> ";
			echo "<button type='button' onclick=''>Click Me!</button> </li>"; $i++;}
		echo "</ul> <br>";
	}
	$_SESSION['teachers']=$teacher_list;
	header("Location: http://localhost:80/feedback/feedback.php");
	//header("Location: http://$_SERVER['DOCUMENT_ROOT'].'feedback.php'");
}
?>
</body>
</html>
