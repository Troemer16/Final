<?php
    session_start();

    $username = 'budlight';
    $password = 'dilly-dilly';

    if($_SESSION['login']){
        $_SESSION['login'] = false;
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