<?php 


function add_product($conn, array $data){
    $sql= "INSERT INTO products(`path`,`name`,`price`,`quantity`)
        VALUES('$data[path]','$data[name]', '$data[price]','$data[quantity]')";
    $conn->query($sql);
    if ($conn->errno) {
        var_dump($conn);
        die;
    }
}

function update_product($conn, $data){
    $sql ="UPDATE products SET `path` = '$data[path]', 
                `name` =  '$data[name]',
                `price` =  '$data[price]',
                `quantity` =  '$data[quantity]'
                WHERE `id_prod`= '$data[id]'";
    $conn->query($sql);
}



function delete_product($conn, $data){
    $sql = "DELETE FROM products
            WHERE `id_prod` = '$data[id]'
    ";
    $conn->query($sql);
}

function get_all_product($conn){
    $sql = "SELECT * FROM products";
    return $conn->query($sql);
}
