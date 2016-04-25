<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $var = $_POST['txt'];
    echo $var . "<br>";
    $var = $_POST['second'];
    echo $var;
}
?>