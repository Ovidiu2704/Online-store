<?php 


function add_user($conn, array $data){
    $data['password']=hash("sha256",$data['password']);
    $sql= "INSERT INTO users(`name`,`email`,`password`,`role_id`)
        VALUES('$data[name]','$data[email]', '$data[password]','0')";
    $conn->query($sql);
    if ($conn->errno) {
        var_dump($conn);
        die;
    }
}

function update_user($conn, $data){
    $sql ="UPDATE users SET `name` = '$data[name]', 
                `email` =  '$data[email]',
                `password` =  '$data[password]'
                WHERE `id`= '$data[id]'";
    $conn->query($sql);
}


function delete_user($conn, $data){
    $sql = "DELETE FROM users
            WHERE `id` = '$data[id]'
    ";
    $conn->query($sql);
}

function get_all_users($conn){
    $sql = "SELECT * FROM users";
    return $conn->query($sql);
}


function get_user_by_email($conn, $email){
    $sql = "SELECT * FROM users WHERE `email` = '$email'";
    return $conn->query($sql);
}