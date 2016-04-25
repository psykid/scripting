<html>
<head><title>Previous attempts</title>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<script>
    function logout() {
        window.location = "logout.php";
    }
</script>
<body>
<script src="bootstrap/js/bootstrap.js"></script>
<?php
session_start();
$user = $_SESSION['user'];
if ($user != "") {
    echo "<div style=\"text-align: center;\">";
    echo "<br><br><input type='button' class='btn btn-primary' onclick='logout()'; value='Logout'><br>";
    require($_SERVER["DOCUMENT_ROOT"] . "/config/db_conf.php");
    $con = mysqli_connect($db_host, $db_user, $db_password) or die("connection failed");
    mysqli_select_db($con, $db_name);
    //echo "connection established<br>";
    $uid = $_SESSION['U_ID'];
    //echo $uid." hello";

    $query = "SELECT * FROM student_score WHERE S_ID=" . $uid;
    $result = mysqli_query($con, $query) or die(mysqli_error($con) . " in student score");

    echo "<h4>Your complete previous history of quizzes:</h4><br>";
    while ($row = mysqli_fetch_assoc($result)) {

        $q_id = $row['q_id'];
        $s_ans = $row['options_selected'];
        $score = $row['score'];

        $query1 = "select * from all_quiz where Q_ID='$q_id'";
        $result2 = mysqli_query($con, $query1);
        $row2 = mysqli_fetch_assoc($result2);
        $quiz_name = $row2['quiz_name'];
        echo "<h4>$quiz_name</h4><br>";

        $query2 = "SELECT * FROM " . $quiz_name;
        $result3 = mysqli_query($con, $query2) or die(mysqli_error($con) . " in quiz name");
        $i = 0;
        echo "<pre><h5>";
        while ($row3 = mysqli_fetch_assoc($result3)) {
            $echo = $i + 1;
            echo "$echo)  ";
            $qstn = $row3['question'];

            echo $qstn . "<br>";
            if ($s_ans[$i] != '0') {
                $ans = "option" . $s_ans[$i];
                echo "your answer is " . $ans . " ";
                echo "$row3[$ans]<br><br>";
            } else {
                echo "didn't answer $s_ans[$i]<br>";
            }
            $i++;
        }
        echo "</h5></pre>";
        echo "<br><br><br>";
    }
    echo "</center>";
    /*

    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    $ans */
} else {
    header("Location: login.php");
}
?>
</body>
</html>