<?php
    session_start();

    $username = 'admin';
    $password = '@dmin';

    if($_SESSION['login']){
        $_SESSION['login'] = false;
        if(isset($_POST['location']))
            echo json_encode(1);
        else
            header("location:http://troemer.greenriverdev.com/328/Final/");
    }
    else {
        if($_POST['username'] == $username && $_POST['password'] == $password){
            $_SESSION['login'] = true;
            echo json_encode(1);
        } else {
            echo json_encode(-1);
        }
    }

?>