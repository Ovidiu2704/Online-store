<?php

require_once './database_connector.php';
require_once './basic_validator.php';

class SigninDelegator{
    private Validator $validator; 
    private $conn;
    private array $data;
    private array $rules;
    function __construct(Validator $validator, array $rules = null ){
        $this->conn = DatabaseConnector::getInstance()->getConnection();
        $this->validator = $validator;
        
        if($rules !== null)
            $this->rules = $rules;
    }  
    
    private function validate(){
        $this->validator->validate($this->data, $this->rules);   
        return $this->validator->hasErrors();
    }

    public function setData(array $data){
        $this->data= $data;
    }

    public function signin(){
        if($this->validate()){
            return $this->validator->getErrors();
        }

        try {
            $this->attemptSignin();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            throw $th;
        }
    }

    private function attemptSignin(){
        $hashed_password=hash("sha256",$this->data['password']);
        $username=$this->data['username'];
        $email=$this->data['email'];
        $sql = "INSERT INTO `users`(`name`, `email`, `password`, `role_id`) VALUES (?,?,?,0); ";
        if(! ($stmt = $this->conn->prepare($sql)))
            $this->throwError("1Oops! Something went wrong. Please try again later. ",502);
        
        $stmt->bind_param("sss", $username, $email,$hashed_password);
        if(!$stmt->execute())
            $this->throwError("2Oops! Something went wrong. Please try again later.",502);
    }



    private function throwError($message, $code = 400){
        throw new Exception($message,$code);
    }

    
}


