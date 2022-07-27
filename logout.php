<?php


    require_once './login_delegator.php';
    $loginDelegator = new LoginDelegator(new Validator);
    $loginDelegator->logout();
    header('location: ./home.php');
?>