<?php
if(isset($_POST['submit'])){
    require_once './signin_delegator.php';
    $rules = [
        'username' => [
            'required' => true,
            'min_len' => 3,
            'max_len' => 20,
        ],
        'email' => [
            'required' => true,
            'email' => true,
        ],
        'password' => [
            'required' => true,
            'min_len' => 6,
            'max_len' => 20,
        ]
    ];

    $signin_data = [
        "username" => $_POST['username'],
        "email"=> $_POST['email'],
        "password" => $_POST['password']
    ];

    $signinDelegator = new SigninDelegator(new Validator, $rules);
    $signinDelegator->setData($signin_data);
    try{
        $errors = $signinDelegator->signin();
    }catch(Exception $e){
        $errors = [
            'error' => [$e->getMessage()],
        ];
    }
    
    if(isset($errors)){
        header('location: ./signin.php?'.http_build_query($errors));
        exit();
    }  
     $errors=[
         'succes' => 'Succes'
     ];

    header('location: ./login.php?'.http_build_query($errors));
    exit();

}
header('location: ./404.php');
exit();