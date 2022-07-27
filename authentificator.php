<?php
if(isset($_POST['submit'])){
    require_once './login_delegator.php';
    $rules = [
        'username' => [
            'required' => true,
            'min_len' => 3,
            'max_len' => 20,
        ],
        'password' => [
            'required' => true,
            'min_len' => 6,
            'max_len' => 20,
        ]
    ];

    $login_data = [
        "username" => $_POST['emailOrUsername'],
        "password" => $_POST['password']
    ];

    $loginDelegator = new LoginDelegator(new Validator, $rules);
    $loginDelegator->setData($login_data);
    try{
        $errors = $loginDelegator->login();
    }catch(Exception $e){
        $errors = [
            'error' => [$e->getMessage()],
        ];
    }
    
    if(isset($errors)){
        header('location: ./login.php?'.http_build_query($errors));
        exit();
    }   
    header('location: ./1home.php');
    exit();

}
header('location: ./404.php');
exit();