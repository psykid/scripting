<html>
<head><title>Welcome</title>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<script>
    function logout() {
        window.location = "logout.php";
    }
    function quiz() {
        window.location = "quiz.php";
    }
    function previous_quizzes() {
        window.location = "already_attempted.php";
    }
</script>

<body class="form-search">
<script src="bootstrap/js/bootstrap.js"></script>
<br><br>
<center><input type="button" class="btn btn-info" value="Logout" onclick="logout();"/></center>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//$user=$_POST["user"];
//$pass=$_POST["pass"];

//echo "values enterd are $user and $pass :D";

    require($_SERVER["DOCUMENT_ROOT"] . "/config/db_conf.php");
    $con = mysqli_connect($db_host, $db_user, $db_password) or die("connection failed");
    //echo "connection established<br>";

    $user = trim(htmlentities(mysqli_real_escape_string($con, $_POST['user'])));
    $pass = trim(htmlentities(mysqli_real_escape_string($con, $_POST['pass'])));

    $query = "select * from users where user_name='$user' and password='$pass'";
    mysqli_select_db($con, $db_name);
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if (empty($row['user_name'])) {
        echo "<center><h4>username or password is incorrect please check again and retry<h4><br></center>";
    } else {
        echo "<center>";
        session_start();
        $_SESSION['user'] = $user;
        echo "<br><h4>login successful</h4><br><br>";
        $uid = $row['UID'];
        $query = "SELECT * FROM `all_quiz` ORDER BY time DESC LIMIT 1";
        $result2 = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $quiz_id = $row2['Q_ID'];
        $quiz_name = $row2['quiz_name'];
        //echo "$quiz_name<br>";

        $query = "select * from student_score where S_ID='$uid' and q_id='$quiz_id'";
        $result2 = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($result2);
        if (empty($row2['score'])) {
            //echo "$uid and $quiz_id";
            include_once('random.php');
            $_SESSION['Q_id'] = $quiz_id;
            $_SESSION['U_ID'] = $uid;
            $_SESSION['quiz_name'] = $quiz_name;
            echo "<input type='button' class='btn btn-warning' onclick='quiz();' value='attempt Quiz $quiz_id'>";
            echo "&nbsp &nbsp &nbsp";
            echo "<input type='button' class='btn btn-primary' onclick='previous_quizzes();' value='check your previous quizzes'>";
            echo "</center>";
            //header("Location: quiz.php");
            //include_once("already_attempted.php");
        } else {
            echo "already attempted $uid and $quiz_id and " . $row2['score'];
            echo "<input type='button' class='btn btn-primary' onclick='previous_quizzes();' value='check your previous quizzes'>";
            echo "</center>";
            $_SESSION['U_ID'] = $row2['UID'];
            //header("Location: already_attempted.php");
        }
    }
}
?>
</body>
</html>