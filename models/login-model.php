<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
function loginUser($usernameEmail, $password) {

    global $conn;
    
    $res = array();
    $errors = false;
    $regName = "/^\w{2,25}$/";
    $regEmail = "/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
    $regPass = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";


    if(empty($usernameEmail)) {
        $_SESSION['usernameEmailError'] = "This field cannot be empty";
        $errors = true;
    }
    else if(!preg_match($regName, $usernameEmail) && !preg_match($regEmail, $usernameEmail)) {
        $_SESSION['usernameEmailError'] = "Username or email is not valid";
        $errors = true;
    }else {
        $_SESSION['usernameEmail'] = $usernameEmail;
    }

    if(empty($password)) {
        $_SESSION['passwordError'] = "This field cannot be empty";
        $errors = true;
    }else if(!preg_match($regPass, $password)) {
        $_SESSION['passwordError'] = "Password must contain at least one uppercase and symbol and be min 8 characters";
        $errors = true;
    }else {
        $_SESSION['password'] = $password;
    }

    if($errors) {
        return "Errors";
    }
    else {
            
        $usernameEmail = addslashes($usernameEmail);
        $password = addslashes($password);

        // display($conn);
        $query = $conn->prepare("SELECT u.id as user_id, u.username, u.first_name, u.last_name, u.email, u.password, u.date_created, u.id_user_type, ut.id as id_user_type, ut.type as user_type FROM users u JOIN users_types ut ON u.id_user_type = ut.id WHERE (u.username = :usernameEmail OR u.email = :usernameEmail) AND u.password = :password");
        $query->bindParam(":usernameEmail", $usernameEmail);
        $query->bindParam(":password", $password);
        
        $query->execute();
        $rows = $query->rowCount();
        if($rows == 1) {
            $loggedUser = $query->fetch(PDO::FETCH_OBJ);


            $_SESSION['loggedUser'] = $loggedUser;
            $res['user_id'] = $loggedUser->user_id;

            // display($loggedUser);

            $query = "SELECT * FROM cart WHERE user_id = $loggedUser->user_id";
            $query = $conn->query($query);

            $resp = $query->rowCount();
            // display($res);
            if($resp > 0) {
                // $res['cart'] = $query->fetchAll(PDO::FETCH_OBJ);
                $query = "SELECT p.prod_id, p.prod_name as name, b.brand_name as brand, c.cat_name as cat, col.color_name as color, i.path_thumb as img, p.price, ca.quantity, ca.quantity * p.price as totalPrice FROM products p INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN colors col ON p.color_id = col.color_id INNER JOIN image i ON p.img_id = i.img_id INNER JOIN cart ca ON ca.prod_id = p.prod_id WHERE ca.prod_id = p.prod_id AND ca.user_id = $loggedUser->user_id";
                $cart = queryString($query);
                $res['cart'] = $cart;
                
                // display($cart);

                // $_SESSION['cart'] = $res['cart'];
                return $res;
            }
            return $res;
            
        }
        else {
            $msg = [];
            $_SESSION['errorLogin'] = "Username or password is wrong";
            return $msg['errorLogin'] = "Username or passworrd is wrong AJAX";
        }
        

    }

}