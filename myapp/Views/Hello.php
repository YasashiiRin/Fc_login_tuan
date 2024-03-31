<?php
    session_start();
    include '../Models/User.php';


    if (isset($_SESSION["user"])) {
        $user = unserialize($_SESSION["user"]);
        $email =$user->getEmail();
        echo "Hi! $email .And have a good day!";
    } else {
        echo "session is not exists";
    }
?>