<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    require_once "../config/connection.php";
    require_once 'functions.php';
    

    if(isset($_POST['login-user'])) {

        $errors = false;
        $regName = "/^\w{2,25}$/";
        $regEmail = "/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
        $regPass = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";

        if(empty($_POST['usernameEmail'])) {
            $_SESSION['usernameEmailError'] = "This field cannot be empty";
            $errors = true;
        }
        else if(!preg_match($regName, $_POST['usernameEmail']) && !preg_match($regEmail, $_POST['usernameEmail'])) {
            $_SESSION['usernameEmailError'] = "Username or email is not valid";
            $errors = true;
        }else {
            $_SESSION['usernameEmail'] = $_POST['usernameEmail'];
        }

        if(empty($_POST['password'])) {
            $_SESSION['passwordError'] = "This field cannot be empty";
            $errors = true;
        }else if(!preg_match($regPass, $_POST['password'])) {
            $_SESSION['passwordError'] = "Password must contain at least one uppercase and symbol and be min 8 characters";
            $errors = true;
        }else {
            $_SESSION['password'] = $_POST['password'];
        }

        if($errors) {
            header("Location: ../login.php");
            die();
        }
        else {
            
            $usernameEmail = addslashes($_POST['usernameEmail']);
            $password = addslashes($_POST['password']);

            // display($conn);
            $query = $conn->prepare("SELECT u.id as user_id, u.username, u.first_name, u.last_name, u.email, u.password, u.date_created, u.id_user_type, ut.id as id_user_type, ut.type as user_type FROM users u JOIN users_types ut ON u.id_user_type = ut.id WHERE (u.username = :usernameEmail OR u.email = :usernameEmail) AND u.password = :password");
            $query->bindParam(":usernameEmail", $usernameEmail);
            $query->bindParam(":password", $password);
            
            $query->execute();
            $rows = $query->rowCount();
            if($rows == 1) {
                $loggedUser = $query->fetch(PDO::FETCH_OBJ);


                $_SESSION['loggedUser'] = $loggedUser;

                // display($loggedUser);

                $query = "SELECT * FROM cart WHERE user_id = $loggedUser->user_id";
                $query = $conn->query($query);

                $res = $query->rowCount();
                // display($res);
                if($res > 0) {
                    $res = $query->fetchAll(PDO::FETCH_OBJ);
                    $_SESSION['cart'] = $res;
                    // display($_SESSION);
                    // $query = "DELETE FROM cart WHERE user_id = $loggedUser->user_id";
                    // $query = $conn->query($query);
                    header("Location: ../index.php");
                    die();
                }
                header("Location: ../index.php");
                die();
                // global $conn;
                // $query = $conn->query($query);
                // return $query->fetchAll(PDO::FETCH_OBJ);

                
            }
            else {
                $_SESSION['errorLogin'] = "Username or password is wrong";
                header("Location: ../login.php");
            }
            

        }

    }