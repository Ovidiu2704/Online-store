<?php
require_once './database_connector.php';
require_once './basic_cruds_products.php';
$conn = DatabaseConnector::getInstance()->getConnection();
if(isset($_POST['edit_product'])){
    update_product($conn,$_POST);
    header('location: ./products.php');
}
if(isset($_POST['delete_product'])){
    delete_product($conn,$_POST);
    header('location: ./products.php');
}
if(isset($_POST['add_product'])){
    add_product($conn,$_POST);
    header('location: ./products.php');
}

