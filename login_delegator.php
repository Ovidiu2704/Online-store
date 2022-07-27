<?php

session_start();
require_once './database_connector.php';
require_once './basic_validator.php';

class LoginDelegator{
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

    public function login(){
        if($this->validate()){
            return $this->validator->getErrors();
        }

        try {
            $this->attemptLogin();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            throw $th;
        }
    }

    private function attemptLogin(){
        $sql = "SELECT * FROM users WHERE `name` = ? OR `email` = ? ";
        if(! ($stmt = $this->conn->prepare($sql)))
            $this->throwError("1Oops! Something went wrong. Please try again later.",502);
        
        $stmt->bind_param("ss", $param_username, $param_username);
        $param_username = $this->data['username'];

        if(!$stmt->execute())
            $this->throwError("2Oops! Something went wrong. Please try again later.",502);
        
        $stmt->store_result();
        
        if($stmt->num_rows != 1)
            $this->throwError("Invalid username or password.");
        
        $stmt->bind_result($id, $username,$email, $hashed_password, $role);

        if($stmt->fetch()){
            if(hash("sha256",$this->data['password']) != $hashed_password)
                $this->throwError("Invalid username or password.");

            $_SESSION["logged_in"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;   
            $_SESSION['is_admin'] = $role == 1;             
        }
        $stmt->close();
    }

    public function logout(){
        session_destroy();
    }

    private function throwError($message, $code = 400){
        throw new Exception($message,$code);
    }

    public static function isLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
    }
}


