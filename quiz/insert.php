<?php
    require($_SERVER["DOCUMENT_ROOT"] . "config/db_conf.php");
    $con = mysqli_connect($db_host, $db_user, $db_password) or die("connection failed");
    mysqli_select_db($con, $db_name);
    $u_id = '2';
    $ans_arr = "ABCDE";
    $query = "insert into student_quiz1 (S_ID,q_id,option_selected) values ('$u_id',1,'$ans_arr')";
    mysqli_query($con, $query) or die(mysql_error());
?>