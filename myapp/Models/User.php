<?php

    class User{

        private $id;
        private $email;
        private $password;
     

        public function __construct($id,$email,$password){
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;

        }
        public function serialize() {
            return serialize([$this->id, $this->email, $this->password]);
        }
    
        public function unserialize($serialized) {
            list($this->id, $this->email, $this->password) = unserialize($serialized);
        }
        
        public function getEmail(){
            return $this->email;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getId(){
            return $this->id;
        }
    }
?>