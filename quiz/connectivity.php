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
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require($_SERVER["DOCUMENT_ROOT"] . "/config/db_conf.php");
    $con = mysqli_connect($db_host, $db_user, $db_password) or die("connection failed");

    $user = trim(htmlentities(mysqli_real_escape_string($con, $_POST['user'])));
    $pass = trim(htmlentities(mysqli_real_escape_string($con, $_POST['pass'])));

    $query = "select * from students where sId='$user' and password ='$pass'";
    mysqli_select_db($con, $db_name);
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if (empty($row['sId'])) {
        echo "<div style=\"text-align: center;\"><h4>The password given for user $user didnt match. Please check and retry<h4><br></div>";
    } else {
        //login successful
        echo "<div style=\"text-align: center;\"><input type=\"button\" class=\"btn btn-info\" value=\"Logout\" onclick=\"logout();\"/></div>";
        //TODO #3: show all the previous attempts of the user and if there are any new quizzes available
        echo "<div style=\"text-align: center;\">";
        session_start();
        $_SESSION['user'] = $user;
        echo "<br><h4>login successful</h4><br><br>";
        $uid = $row['UID'];
        $query = "SELECT * FROM `quizzes` ORDER BY start_time DESC LIMIT 1";
        $result2 = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $quiz_id = $row2['Q_ID'];
        $quiz_name = $row2['quiz_name'];

        $query = "select * from quiz_students where studentId='$uid' and quizzId='$quiz_id'";
        $result2 = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($result2);
        if (empty($row2['score'])) {
            //first attempt
            //echo "$uid and $quiz_id";
            include_once('random.php');
            $_SESSION['Q_id'] = $quiz_id;
            $_SESSION['U_ID'] = $uid;
            $_SESSION['quiz_name'] = $quiz_name;
            echo "<input type='button' class='btn btn-warning' onclick='quiz();' value='attempt Quiz $quiz_id'>";
            echo "&nbsp &nbsp &nbsp";
            echo "<input type='button' class='btn btn-primary' onclick='previous_quizzes();' value='check your previous quizzes'>";
            echo "</div>";
            //header("Location: quiz.php");
            //include_once("already_attempted.php");
        } else {
            echo "already attempted $uid and $quiz_id and " . $row2['score'];
            echo "<input type='button' class='btn btn-primary' onclick='previous_quizzes();' value='check your previous quizzes'>";
            echo "</div>";
            $_SESSION['U_ID'] = $row2['UID'];
            //header("Location: already_attempted.php");
        }
    }
}
?>
</body>
</html>