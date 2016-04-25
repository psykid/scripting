<html>
<head>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<script src="bootstrap/js/bootstrap.js"></script>
<h5>
    <?php

    require($_SERVER["DOCUMENT_ROOT"] . "config/db_conf.php");
    $table_name = $_SESSION['quiz_name'];
    echo "$table_name<br>";
    $con = mysqli_connect($db_host, $db_user, $db_password) or die("connection failed");
    mysqli_select_db($con, $db_name);
    $count = 1;
    for ($i = 0; $i < count($arr); $i++) {
        $query = "select * from $table_name where ID='$arr[$i]'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        echo "<table bgcolor='#AAAAAA' border='0' width='100%' cellspacing='1' cellpadding='2'>";
        while ($row = mysqli_fetch_assoc($result)) {
            $qstn = $row['question'];
            $A = $row['optionA'];
            $B = $row['optionB'];
            $C = $row['optionC'];
            $D = $row['optionD'];
            $E = $row['optionE'];

            $id = $arr[$i];
            echo "
				<tr>
					<td width='50%' bgcolor=#EEEEEE>
						<font face='arial' size='3'>
						<b>$count </b>&nbsp$qstn<br>
						</font>
						<font face='arial' size='2'>
						<br>&nbsp
						<b>A</b>&nbsp<input type='radio' name='$id' value='A'>&nbsp$A
						<br>
						
						<br>&nbsp
						<b>B</b>&nbsp<input type='radio' name='$id' value='B'>&nbsp$B
						<br>
						
						<br>&nbsp
						<b>C</b>&nbsp<input type='radio' name='$id' value='C'>&nbsp$C
						<br>
						
						<br>&nbsp
						<b>D</b>&nbsp<input type='radio' name='$id' value='D'>&nbsp$D
						<br>";

            if ($E != '')
                echo "<br>&nbsp
						<b>E</b>&nbsp<input type='radio' name='$id' value='E'>&nbsp$E
						<br>";

            echo "</font>
					</td>
				</tr><br><br>";
            $count++;
        }
        echo "</table>";

    }
    ?>
</h5>
</body>
</html>