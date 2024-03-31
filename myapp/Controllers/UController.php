<?php
    session_start();

    include '../database/connect.php';
    include '../Models/User.php';

    class UController{
        public function validateEmail($email){
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
        public function validatePassword($password){
            return strlen($password) >=8;
        }
        public function handelLogin(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST["email"]) && isset($_POST["password"])){
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    // var_dump($email, $password);

                    if(!empty($email) && !empty($password)){
                        if($this->validateEmail($email)){
                            if($this->validatePassword($password)){

                                $db = new DatabasePDO();
                                $conn = $db->connect();
                                
                                if($conn){
                                    try{
                                        $sql = "SELECT id,password FROM customers WHERE email =:email";
                                        $result = $conn->prepare($sql);
                                        // echo "<hr>";
                                        // var_dump($result);
                                        // echo "<hr>";
                                        $result->bindParam(':email',$email);
                                        $result->execute();
                                        $pd = $result->fetch();
                                        // var_dump($pd);
                                        // echo "<hr>";
                                        if($pd && password_verify($password,$pd["password"])){

                                            $id = $pd["id"];
                                            $user = new User($id,$email,$password);

                                            $_SESSION["user"] = serialize($user);
                                            header("Location:  ../Views/Hello.php");

                                        }else{
                                            header("Location: ../index.php?error=login_failed");
                                            exit; 
                                        }
                                    }catch(PDPException $e){
                                        header("Location: ../index.php?error=query_error");
                                        exit; 
                                        // echo "query error".$e->getMessage();
                                    }
                                }

                            }else{
                                header("Location: ../index.php?error=Invalid_pass");
                                exit; 
                            }
                        }else{
                            header("Location: ../index.php?error=Invalid_email");
                            exit; 
                        }
                    }else{
                        header("Location: ../index.php?error=empty_data");
                        exit;
                    }
                }else{
                    header("Location: ../index.php?error=failed");
                    exit;
                }
            }else{
                header("Location: ../index.php?error=failed");
                exit;
            }
        }
    }
    $lg = new UController();
    $lg->handelLogin();
?>