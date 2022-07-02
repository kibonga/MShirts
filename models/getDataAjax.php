<?php
    // require_once "../config/connection.php";
    require_once "functions.php";
    require_once "shop-model.php";
    require_once "admin-model.php";
    require_once "customer-model.php";
    require_once "logout-model.php";
    require_once "login-model.php";
    require_once "register-model.php";
    require_once "orders-model.php";
    require_once "message-model.php";
    require_once "polls-model.php";
    

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = file_get_contents("php://input");
    $data = json_decode($data, true);

    switch($data['method']) {
        case "getAllProductsShop" : {
            $resp = getAllProductsShop($data['params']['perPageNum'], $data['params']['pageNum']);
        }
        break;
        case "getFilteredProducts" : {
            $resp = getFilteredProducts($data['params']);
        }
        break;
        case "getAllUsers" : {
            // display($data);
            $resp = getAllUsers($data['params']['perPageNum'], $data['params']['pageNum']);
        }
        break;
        case "getAllProducts" : {
            $resp = getAllProducts($data['params']['perPageNum'], $data['params']['pageNum']);
        }
        break;
        case "getAllOrders" : {
            $resp = getAllOrders($data['params']['perPageNum'], $data['params']['pageNum']);
        }
        break;
        case "getProductID" : {
            $resp = getProductID($data['params']['prodID']);
        }
        break;
        case "getAllOrdersID" : {
            $resp = getAllOrdersID($data['params']['user_id'], $data['params']['perPageNum'], $data['params']['pageNum']);
        }
        break;
        case "logoutCustomer" : {
            // display($data['params']["user_id"]);
            // display($data['params']["cart"]);
            if(isset($data['params']['cart'])) {
                $resp = logoutCustomer($data['params']["user_id"], $data['params']["cart"]);
            }else {
                $resp = logoutCustomer($data['params']["user_id"]);
            }
            
        }
        break;
        case "selectProductsID" : {
            // display($data['params']['prodsID']);
            // display($data['params']["user_id"]);
            // display($data['params']["cart"]);
            $resp = selectProductsID($data['params']['prodsID']);
        }
        break;
        case "loginUser" : {
            $resp = loginUser($data['params']['usernameEmail'], $data['params']['password']);
        }
        break;
        case "registerUser" : {
            // display($data);
            $resp = registerUser($data['params']['username'], $data['params']['fname'], $data['params']['lname'], $data['params']['address'], $data['params']['email'], $data['params']['password1'], $data['params']['password2'],);
        }
        break;
        case "insertOrders" : {
            // display($data);
            $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "insertMessage" : {
            // display($data);
            $resp = insertMessage($data['params']['fname'], $data['params']['lname'], $data['params']['email'], $data['params']['subject'], $data['params']['message']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "getAllMessages" : {
            // display($data);
            $resp = getAllMessages($data['params']['perPageNum'], $data['params']['pageNum']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "getAllMessagesID" : {
            // display($data);
            $resp = getAllMessagesID($data['params']['user_id'], $data['params']['perPageNum'], $data['params']['pageNum']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "adminRemoveUser" : {
            // display($data);
            $resp = adminRemoveUser($data['params']['userID']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "adminRemoveOrder" : {
            // display($data);
            $resp = adminRemoveOrder($data['params']['user_id'], $data['params']['order_id']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "adminRemoveMessage" : {
            // display($data);
            $resp = adminRemoveMessage($data['params']['msg_id']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "adminRemoveProduct" : {
            // display($data);
            $resp = adminRemoveProduct($data['params']['prod_id']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "selectPollID" : {
            // display($data);
            $resp = selectPollID($data['params']['poll_id'], $data['params']['user_id']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "insertPollAnswer" : {
            // display($data);
            $resp = insertPollAnswer($data['params']['choice_id'], $data['params']['user_id']);
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;
        case "getAllFilters" : {
            // display("YO WE IN");
            $resp = getAllFilters();
            // $resp = insertOrders($data['params']['orders'], $data['params']['userID']);
        }
        break;

    }

    // $resp = "RESPONSE!!!";
    if($resp) {
        echo json_encode($resp, JSON_FORCE_OBJECT);
    }
    


    // if(isset($data)) {

        
    // }
    // else {
    //     header("Location: ../404.php");
    //     die();
    // }



    

}