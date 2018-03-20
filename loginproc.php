<?php
    $username = 'budlight';
    $password = 'dilly-dilly';

    if($_POST['username'] && $_POST['password']){
        $_SESSION['login'] = true;
        header('location:'.$_POST['location']);
    } else {

    }
?>