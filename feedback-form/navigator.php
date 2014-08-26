<html>
<head><title>Teacher</title>
</head>
<body>
please give the feedback for prof. 
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
session_start();
//echo "hello";
$teachers=$_SESSION['teachers'];
//echo $teachers[0];
foreach($teachers as $x)
	{
	if(isset($_POST[$x]))
		{
			echo $x;
			$_SERVER['current']=$x;
		}
	
	}

}
?>
</body>
</html>
