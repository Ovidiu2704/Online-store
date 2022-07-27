<?php 


function add_cart($conn, array $data){
    
    $sql= "INSERT INTO cart(`product_id`,`bought_quantity`,`user_id`)
        VALUES('$data[product_id]','$data[bought_quantity]', '$data[user_id]')";
    $conn->query($sql);
    if ($conn->errno) {
        var_dump($conn);
        die;
    }
}
function update_stock($conn, $data){
    $sql ="UPDATE products SET  
                `quantity` =  '$data[quantity]'
                WHERE `id_prod`= '$data[id_prod]'";
    $conn->query($sql);
}

function delete_part($conn, $data){
    $sql = "DELETE FROM cart
            WHERE `product_id` = '$data[product_id]' AND `user_id`='$data[user_id]'
    ";
    $conn->query($sql);
}
function send_command($conn, $data){
    $sql = "DELETE FROM cart
            WHERE `user_id` = '$data[user_id]'
    ";
    $conn->query($sql);
}


