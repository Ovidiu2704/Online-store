<?php
require_once './database_connector.php';
require_once './basic_cruds_cart.php';
$conn = DatabaseConnector::getInstance()->getConnection();
if(isset($_POST['send'])){
    $sql = "SELECT * FROM cart
    WHERE `user_id` = '$_POST[user_id]'";
    $data=$conn->query($sql);
        while ($row = $data->fetch_assoc())
        {
                $sql = "SELECT * FROM products WHERE `id_prod`=$row[product_id]";
                $ssd=$conn->query($sql);
                while ($aaa = $ssd->fetch_assoc())
        {
                $aaa['quantity']=$aaa['quantity']-$row['bought_quantity'];
                
                update_stock($conn,$aaa);
        }
        }
    send_command($conn,$_POST);
    $errors=[
        'succes' => 'Ati trimis comanda cu succes.'
    ];
   header('location: ./1home.php?'.http_build_query($errors));
}
if(isset($_POST['remove'])){
    delete_part($conn,$_POST);
    header('location: ./cart.php');
}
if(isset($_POST['add_cart'])){
    if($_POST['quantity']>=$_POST['bought_quantity'])
    {
    add_cart($conn,$_POST);
    $data['id']=$_POST['product_id'];
    $data['quantity']=($_POST['quantity']-$_POST['bought_quantity']);
    header('location: ./cart.php');
    }else
    {
    $errors=[
        'preamult' => 'Ati incercat sa adaugati in cos mai multe produse decat sunt in stock.'
    ];

   header('location: ./1home.php?'.http_build_query($errors));
    }
}

