<html>
<?php
function random($num)
{
$arr=array();
$rand=0;
for($i=0;$i<$num;$i++)$arr[$i]=$i+1;
for($i=0;$i<$num;$i++){
$rand=rand(0,$i);
$dummy=$arr[$i];
$arr[$i]=$arr[$rand];
$arr[$rand]=$dummy;}
return $arr;
}
$aux=random(21);
for($i=0;$i<21;$i++) {echo $aux[$i]." ";
if($i==count($aux)/2) echo "<br>";}
echo "<br><br>";

require($_SERVER["DOCUMENT_ROOT"]."config/db_conf.php");

$con=mysqli_connect($db_host,$db_user,$db_password) or die("connection failed");
mysqli_select_db($con,$db_name);
for($i=0;$i<21;$i++){
$query="select * from student_course where s_id='$aux[$i]'";
$result=mysqli_query($con,$query) or die(mysql_error()); 
echo "<table bgcolor='#AAAAAA' border='0' width='75%' cellspacing='1' cellpadding='2'>";
	while($row=mysqli_fetch_assoc($result))
	{
		$name=$row['name'];
		$email=$row['s_id'];
		$comment=$row['subject'];
		$date=$row['teacher'];
		
		$email_len=count($email);
		$show_date=date("h:i:s m/d/Y",$date);
		
		echo "
			<tr>
				<td width='50%' bgcolor=#EEEEEE>
					<font face='arial' size='2'>
					<b>Name: </b>$name<br>
					
					<br>
					<b>Comment: </b>$email
					</font>
				</td>
				<td valign='top' nowrap bgcolor='#EEEEEE'>
					<font face='arial' size='2'>
						<b>Date: </b>$date
					</font>
				</td>
			</tr>";
	}
	echo "</table>";
}
?>
</html>
