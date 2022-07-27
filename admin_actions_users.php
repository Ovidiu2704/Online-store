<?php
require_once './database_connector.php';
require_once './basic_cruds_users.php';
$conn = DatabaseConnector::getInstance()->getConnection();
if(isset($_POST['edit_user'])){
    update_user($conn,$_POST);
    header('location: ./dashboard.php');
}
if(isset($_POST['delete_user'])){
    delete_user($conn,$_POST);
    header('location: ./dashboard.php');
}
if(isset($_POST['add_user'])){
    add_user($conn,$_POST);
    header('location: ./dashboard.php');
}

