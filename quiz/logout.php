<?php
    session_start();
    if (!isset($_SESSION['user'])):
        header("Location: login.html");

    elseif (isset($_SESSION['user'])):
        unset($_SESSION);
        session_destroy();
        session_write_close();
        header('Location: login.html');
        die;
    endif;
?>