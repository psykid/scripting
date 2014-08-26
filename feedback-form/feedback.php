<html>
<form action="navigationbar.php" method="post">
<?php 
session_start();
$teachers=$_SESSION['teachers'];
foreach($teachers as $x){
	echo $x."<br>";
	echo "<input type='submit' name='$x' value='submit'><br><br>";}
?>
</form>
</html>
