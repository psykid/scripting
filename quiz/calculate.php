<html>
<script>
    function logout() {
        window.location = "logout.php";
    }
</script>
<head>
    <title>Results</title>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body class="form-search">
<script src="bootstrap/js/bootstrap.js"></script>
<br><br>
&nbsp;&nbsp
<center>
    <input type="button" class="btn btn-primary" value="logout" onclick="logout();"><br><br><br>


    <?php
    //echo "out of if<br>";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $arr = $_SESSION['order'];
        $quiz_name = $_SESSION['quiz_name'];
        $q_id = $_SESSION['Q_id'];
        echo "<h3>quiz name is $quiz_name</h3><br>";
        $add = 2;
        $sub = 1;
        $score = 0;
        $i = 0;
        $ans_arr = '';

        require($_SERVER["DOCUMENT_ROOT"] . "config/db_conf.php");
        $con = mysqli_connect($db_host, $db_user, $db_password) or die("connection failed");
        mysqli_select_db($con, $db_name);
        //echo "connection established<br> ";
        //print_r($arr);

        for ($i = 1; $i <= count($arr); $i++) {
            $query = "select * from " . $quiz_name . " where ID=$i";
            $result = mysqli_query($con, $query) or die(mysql_error());
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "in while loop<br>";
                $correct_ans = $row['answer'];
                if (isset($_POST[$i]))
                    $ans = (string)$_POST[$i];
                else
                    $ans = '';

                if ($ans == '') $ans_arr .= '0';
                else    $ans_arr .= $ans;
                $qstn = $row['question'];
                echo "for question: $qstn<br>";
                echo "ur response: $ans<br>";
                if ($ans == $correct_ans) {
                    $score += $add;
                    echo "correct!<br><br>";
                } else {
                    $score -= $sub;
                    echo "wrong!!<br><br>";
                }
            }

        }
        print_r($ans_arr);
        echo $score . "is ur final score<br><br>";

        $user = $_SESSION['user'];
        $u_id = $_SESSION['U_ID'];
        $q_id = $_SESSION['Q_id'];
        //echo "<br>$q_id, uid= $u_id";

        $query = "insert into student_score (s_id,q_id,options_selected,score) values('$u_id','$q_id','$ans_arr','$score')";
        mysqli_query($con, $query) or die(mysql_error());
    }
    ?>
</center>
</body>
</html>