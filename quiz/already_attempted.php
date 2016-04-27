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

    $query = "SELECT * FROM quiz_students WHERE studentId=" . $uid;
    $result = mysqli_query($con, $query) or die(mysqli_error($con) . " in student score");

    echo "<h4>Your complete previous history of quizzes:</h4><br>";
    while ($row = mysqli_fetch_assoc($result)) {
        //TODO: change the queries according to the new database.
        $q_id = $row['quizzId'];

        $query = "select * from quizzes where quizId='$q_id'";
        $result2 = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($result2);
        $quiz_name = $row2['description'];
        echo "<h2>$quiz_name</h2><br>";

        $query2 = "SELECT * FROM questions WHERE quizId = " .$q_id;
        $result3 = mysqli_query($con, $query2) or die(mysqli_error($con) . " in quiz name");
        echo "<pre><h5>";
        while ($row3 = mysqli_fetch_assoc($result3)) {
            $question = $row3['question'];
            $ques_Id = $row3['quizId'];
            //print the question
            echo $question . "<br>";
            $query_options = "SELECT * FROM answers WHERE questionId = " .$ques_Id;
            $result_options = mysqli_query($con, $query_options) or die(mysqli_error($con));
            //$user_answer
            $query_user_ans = "SELECT answer FROM quiz_students WHERE quizzId = ".$q_id.
                " and studentId = ".$uid. " and questionId = ".$ques_Id;
            $result_user_ans = mysqli_query($con, $query_user_ans) or die(mysqli_error($con));
            $row_user_answer = mysqli_fetch_assoc($result_user_ans);
            $user_answer = $row_user_answer['answer'];
            while ($row_options = mysqli_fetch_assoc($result3)) {
                //TODO #5: have a better way of representing the cases:
                //options available
                $option = $row_options['text'];
                $correctness = $row_options['isCorrect'];
                if($user_answer == $option && $correctness ==1)
                    //user selected correct option
                    echo "<b><i>" .$option . "</b></i><br>";
                elseif($user_answer == $option)
                    //user selected a wrong option
                    echo "<i>" .$option ."</i><br>";
                elseif($correctness == 1)
                    //this is the correct option
                    echo "<b>".$option."</b><br>";
                else
                    //a wrong unselected option
                    echo $option."<br>";
            }
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