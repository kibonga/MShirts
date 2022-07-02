<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    require_once "../config/connection.php";
    require_once 'functions.php';
    

    if(isset($_POST['register-user'])) {

        display($_POST);

        $errors = false;
        $regUsername = "/^\w{2,25}$/";
        $regName = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/";
        $regEmail = "/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
        $regPass = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,30}$/";
        $regAddress = "/^[#.0-9a-zA-Z\s,-]{2,50}$/";

        if(empty($_POST['username-register'])) {
            $_SESSION['usernameRegisterError'] = "This field cannot be empty";
            $errors = true;
        }
        else if(!preg_match($regUsername, $_POST['username-register'])) {
            $_SESSION['usernameRegisterError'] = "Username or email is not valid";
            $errors = true;
        }else {
            $_SESSION['usernameRegister'] = $_POST['username-register'];
        }


        if(empty($_POST['fname-register'])) {
            $_SESSION['fnameRegisterError'] = "This field cannot be empty";
            $errors = true;
        }
        else if(!preg_match($regName, $_POST['fname-register'])) {
            $_SESSION['fnameRegisterError'] = "First name is not valid";
            $errors = true;
        }else {
            $_SESSION['fnameRegister'] = $_POST['fname-register'];
        }


        if(empty($_POST['lname-register'])) {
            $_SESSION['lnameRegisterError'] = "This field cannot be empty";
            $errors = true;
        }
        else if(!preg_match($regName, $_POST['lname-register'])) {
            $_SESSION['lnameRegisterError'] = "Last name is not valid";
            $errors = true;
        }else {
            $_SESSION['lnameRegister'] = $_POST['lname-register'];
        }


        if(empty($_POST['address-register'])) {
            $_SESSION['addressRegisterError'] = "This field cannot be empty";
            $errors = true;
        }
        else if(!preg_match($regAddress, $_POST['address-register'])) {
            $_SESSION['addressRegisterError'] = "Address is not valid";
            $errors = true;
        }else {
            $_SESSION['addressRegister'] = $_POST['address-register'];
        }


        if(empty($_POST['email-register'])) {
            $_SESSION['emailRegisterError'] = "This field cannot be empty";
            $errors = true;
        }
        else if(!preg_match($regEmail, $_POST['email-register'])) {
            $_SESSION['emailRegisterError'] = "Email is not valid";
            $errors = true;
        }else {
            $_SESSION['emailRegister'] = $_POST['email-register'];
        }


        if(empty($_POST['password-register-1'])) {
            $_SESSION['passwordRegister1Error'] = "This field cannot be empty";
            $errors = true;
        }
        else if(!preg_match($regPass, $_POST['password-register-1'])) {
            $_SESSION['passwordRegister1Error'] = "Password is not valid";
            $errors = true;
        }else {
            $_SESSION['passwordRegister1'] = $_POST['password-register-1'];
        }


        if(empty($_POST['password-register-2'])) {
            $_SESSION['passwordRegister2Error'] = "This field cannot be empty";
            $errors = true;
        }
        else if($_POST['password-register-1'] != $_POST['password-register-2']) {
            $_SESSION['passwordRegister2Error'] = "Passwords do not match";
            $errors = true;
        }else {
            $_SESSION['passwordRegister2'] = $_POST['password-register-2'];
        }

        display($_SESSION);

        if($errors) {
            header("Location: ../register.php");
            die();
        }
        else {
            $username = addslashes($_POST['username-register']);
            $first_name = addslashes($_POST['fname-register']);
            $last_name = addslashes($_POST['lname-register']);
            $email = addslashes($_POST['email-register']);
            $address = addslashes($_POST['address-register']);
            $password = addslashes($_POST['password-register-1']);
            
            $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $query->bindParam(":username", $username);
            $query->execute();
            $rows = $query->rowCount();
            if($rows) {
                $_SESSION['usernameRegisterError'] = "Username is already taken";
                $errors = true;
            }
            $query->bindParam(":email", $email);
            $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $query->bindParam(":email", $email);
            $query->execute();
            $rows = $query->rowCount();
            if($rows) {
                $_SESSION['emailRegisterError'] = "Email is already taken";
                $errors = true;
            }

            if($errors) {
                header("Location: ../register.php");
                die();
            }
            else {
                $query = $conn->prepare("INSERT INTO users (username, first_name, last_name, email, password, address, id_user_type) VALUES (:username, :first_name, :last_name, :email, :password, :address, 2)");
                $query->bindParam(":username", $username);
                $query->bindParam(":first_name", $first_name);
                $query->bindParam(":last_name", $last_name);
                $query->bindParam(":email", $email);
                $query->bindParam(":password", $password);
                $query->bindParam(":address", $address);

                $res = $query->execute();

                if($res == 1) {
                    $query = $conn->prepare("SELECT u.id as user_id, u.username, u.first_name, u.last_name, u.email, u.password, u.date_created, u.id_user_type, ut.id as id_user_type, ut.type as user_type FROM users u JOIN users_types ut ON u.id_user_type = ut.id WHERE (u.username = :username OR u.email = :email) AND u.password = :password");
                    $query->bindParam(":username", $username);
                    $query->bindParam(":email", $email);
                    $query->bindParam(":password", $password);

                    $query->execute();

                    $loggedUser = $query->fetch(PDO::FETCH_OBJ);
                    $_SESSION['loggedUser'] = $loggedUser;

                    header("Location: ../index.php");
                    die();
                }
                else {
                    echo json_encode("Failed to register new user", JSON_FORCE_OBJECT);
                    http_response_code(500);
                }



            }
            
            
        }

    }