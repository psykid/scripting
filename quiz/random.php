<html>
<?php
function random($num)
{
    $arr = array();
    $rand = 0;
    for ($i = 0; $i < $num; $i++) $arr[$i] = $i + 1;
    for ($i = 0; $i < $num; $i++) {
        $rand = rand(0, $i);
        $dummy = $arr[$i];
        $arr[$i] = $arr[$rand];
        $arr[$rand] = $dummy;
    }
    return $arr;
}

require($_SERVER["DOCUMENT_ROOT"] . "config/db_conf.php");

$con = mysqli_connect($db_host, $db_user, $db_password) or die("connection failed");
mysqli_select_db($con, $db_name);

$query = "select * from " . $quiz_name;
$result = mysqli_query($con, $query) or die(mysqli_error($link));
$qstat = 0;
while ($row = mysqli_fetch_assoc($result)) {
    //echo "$quiz_name from random<br>";
    $qstat++;
}

$aux = random($qstat);
$_SESSION['order'] = $aux;
?>
</html>