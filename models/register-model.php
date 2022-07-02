<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

function registerUser($username, $fname, $lname, $address, $email, $password1, $password2) {

    $errors = false;
    $regUsername = "/^\w{2,25}$/";
    $regName = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/";
    $regEmail = "/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
    $regPass = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,30}$/";
    $regAddress = "/^[#.0-9a-zA-Z\s,-]{2,50}$/";

    if(empty($username)) {
        $_SESSION['usernameRegisterError'] = "This field cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regUsername, $username)) {
        $_SESSION['usernameRegisterError'] = "Username is not valid";
        $errors = true;
    }else {
        $_SESSION['usernameRegister'] = $username;
    }


    if(empty($fname)) {
        $_SESSION['fnameRegisterError'] = "First name cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regName, $fname)) {
        $_SESSION['fnameRegisterError'] = "First name is not valid";
        $errors = true;
    }else {
        $_SESSION['fnameRegister'] = $fname;
    }

    if(empty($lname)) {
        $_SESSION['lnameRegisterError'] = "Last name cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regName, $lname)) {
        $_SESSION['lnameRegisterError'] = "Last name is not valid";
        $errors = true;
    }else {
        $_SESSION['lnameRegister'] = $lname;
    }


    if(empty($address)) {
        $_SESSION['addressRegisterError'] = "Address cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regAddress, $address)) {
        $_SESSION['addressRegisterError'] = "Address is not valid";
        $errors = true;
    }else {
        $_SESSION['addressRegister'] = $address;
    }



    if(empty($password1)) {
        $_SESSION['passwordRegister1Error'] = "Password cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regPass, $password1)) {
        $_SESSION['passwordRegister1Error'] = "Password is not valid";
        $errors = true;
    }else {
        $_SESSION['passwordRegister1'] = $password1;
    }


    if(empty($password2)) {
        $_SESSION['passwordRegister2Error'] = "Confirm password cannot be empty";
        $errors = true;
    }
    else if($password1 != $password2) {
        $_SESSION['passwordRegister2Error'] = "Passwords do not match";
        $errors = true;
    }else {
        $_SESSION['passwordRegister2'] = $password2;
    }






    if($errors) {
        return "There were errors";
    }
    else {
        global $conn;
        
        $username = addslashes($username);
        $first_name = addslashes($fname);
        $last_name = addslashes($lname);
        $email = addslashes($email);
        $address = addslashes($address);
        $password = addslashes($password1);
        
        $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam(":username", $username);
        $query->execute();
        $rows = $query->rowCount();
        if($rows) {
            $_SESSION['usernameRegisterError'] = "Username is already taken";
            $errors = true;
            return "Username is already taken";
        }
        $query->bindParam(":email", $email);
        $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $rows = $query->rowCount();
        if($rows) {
            $_SESSION['emailRegisterError'] = "Email is already taken";
            $errors = true;
            return "Email is already taken";
        }

        if($errors) {
            return "Something went wrong";
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
                $res = array();
                $query = $conn->prepare("SELECT u.id as user_id, u.username, u.first_name, u.last_name, u.email, u.password, u.date_created, u.id_user_type, ut.id as id_user_type, ut.type as user_type FROM users u JOIN users_types ut ON u.id_user_type = ut.id WHERE (u.username = :username OR u.email = :email) AND u.password = :password");
                $query->bindParam(":username", $username);
                $query->bindParam(":email", $email);
                $query->bindParam(":password", $password);

                $query->execute();

                $loggedUser = $query->fetch(PDO::FETCH_OBJ);
                $_SESSION['loggedUser'] = $loggedUser;
                // $id = queryString("SELECT id FROM users ORDER BY id DESC LIMIT 1"); 
                // display($id);

                // $res['loggedUser'] = $loggedUser;
                $res['user_id'] = $loggedUser->user_id;
                return $res;
            }



        }
        
        
    }




///////////////////////
}
    






















