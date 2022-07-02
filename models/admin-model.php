<?php 

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// require_once "config/connection.php";
require_once 'functions.php';

function getAllUsers($perPageNum, $pageNum) {

    global $conn;

    $start = ($pageNum-1) * $perPageNum;


    $query = ("SELECT * FROM users WHERE id_user_type <> 1 ORDER BY id ASC LIMIT $start, $perPageNum");
    $users = queryString($query);
    $query = ("SELECT COUNT(*) as amount FROM users WHERE id_user_type <> 1");
    $amount = queryString($query);

    $resp = array(
        "users" => $users,
        "amount" => $amount,
        "page" => $pageNum
    );

    return $resp;

}




function getAllProducts($perPageNum, $pageNum) {

    $start = ($pageNum-1) * $perPageNum;
    // $end = $start + $perPageNum;
    


    $query = ("SELECT p.prod_id as id, p.prod_name as name, p.price, p.date, c.cat_name as cat, b.brand_name as brand, col.color_name as color,  i.path_thumb as img_thumb, i.path_normal as img_normal FROM products p INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN colors col ON p.color_id = col.color_id INNER JOIN image i ON p.img_id = i.img_id WHERE active = 1 ORDER BY p.prod_id ASC LIMIT $start, $perPageNum");
    $products = queryString($query);
    $query = ("SELECT COUNT(*) as amount FROM products WHERE active = 1");
    $amount = queryString($query);

    $resp = array(
        "products" => $products,
        "amount" => $amount,
        "page" => $pageNum
    );

    return $resp;

}


function getAllOrders($perPageNum, $pageNum) {

    $start = ($pageNum-1) * $perPageNum;

    $query = ("SELECT DISTINCT order_id FROM order_details ORDER BY order_id ASC LIMIT $start, $perPageNum");
    $ID = queryString($query);
    // display($ID);

    $in = "(";
    foreach($ID as $i => $id) {
        $in = $in."$id->order_id,";
    }
    $in = substr($in, 0, -1);
    $in = $in .")";

    // display($in);

    $query = ("SELECT o.order_id, u.id as user_id, u.username as customer, p.prod_id, p.prod_name,  c.cat_name as cat, b.brand_name as brand, col.color_name as color, i.path_thumb as img_thumb, i.path_normal as img_normal, od.quantity, p.price as prod_price,  od.total_price, o.order_date FROM products p INNER JOIN order_details od ON p.prod_id = od.prod_id INNER JOIN orders o ON o.order_id = od.order_id INNER JOIN users u ON o.user_id = u.id INNER JOIN brands b ON p.brand_id = b.brand_id INNER JOIN categories c ON p.cat_id = c.cat_id INNER JOIN image i ON p.img_id = i.img_id INNER JOIN colors col ON col.color_id = p.color_id WHERE o.order_id IN $in ORDER BY o.order_id");
    $orders = queryString($query);
    $query = ("SELECT COUNT(*) as amount FROM orders");
    $amount = queryString($query);
    // $query = ("SELECT DISTINCT order_id FROM orders");
    // $distinctOrders = queryString($query);

    $resp = array(
        "orders" => $orders,
        "amount" => $amount,
        "page" => $pageNum,
        "dist" => $ID
    );

    return $resp;


}


function getAllFilters() {

    global $conn;

    $res = array();
    $query = ("SELECT * FROM categories");
    $cats = queryString($query);
    
    $query = ("SELECT * FROM brands");
    $brands = queryString($query);

    $query = ("SELECT * FROM colors");
    $colors = queryString($query);
    
    $res[] = $cats;
    $res[] = $brands;
    $res[] = $colors;

    return $res;

}


function getAllMessages($perPageNum, $pageNum) {
    global $conn;

    $start = ($pageNum-1) * $perPageNum;

    $query = ("SELECT * FROM messages LIMIT $start, $perPageNum");
    $messages = queryString($query);
    $query = ("SELECT COUNT(*) as amount FROM messages");
    $amount = queryString($query);

    $resp = array(
        "messages" => $messages,
        "amount" => $amount,
        "page" => $pageNum
    );
    

    return $resp;


}


function adminRemoveUser($user_id) {
    global $conn;
    if(!empty($user_id) && isset($user_id)) {

        $query = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam(":id", $user_id);

        $query->execute();
        if($query->rowCount() > 0) {
            $query = $conn->prepare("DELETE FROM orders WHERE user_id = :id");
            $query->bindParam(":id", $user_id);

            $res = $query->execute();

            $query = $conn->prepare("DELETE FROM cart WHERE user_id = :id");
            $query->bindParam(":id", $user_id);

            $res = $query->execute();

            $query = $conn->prepare("DELETE FROM users WHERE id = :id");
            $query->bindParam(":id", $user_id);
            $res = $query->execute();
            if($res) {
                return "Success";
            }
            else {
                echo json_encode("Failed to delete user", JSON_FORCE_OBJECT);
                http_response_code(500);
            }
        }
        else {
            echo json_encode("Could not find that user", JSON_FORCE_OBJECT);
            http_response_code(500);
        }
    }
    else {
        echo json_encode("Invalid user id passed", JSON_FORCE_OBJECT);
        http_response_code(404);
    }

}



function adminRemoveOrder($user_id, $order_id) {
    

    if((!empty($user_id) && isset($user_id)) && (!empty($order_id) && isset($order_id))) {
        global $conn;

        $query = $conn->prepare("DELETE FROM orders WHERE order_id = :order_id");
        $query->bindParam(":order_id", $order_id);

        $res = $query->execute();
        if($res) {
            return "Success";
        }
        else {
            echo json_encode("Failed to delete order", JSON_FORCE_OBJECT);
            http_response_code(500);
        }

    }
    else {
        echo json_encode("Could not find that order", JSON_FORCE_OBJECT);
        http_response_code(404);
    }

}



function adminRemoveMessage($msg_id) {
    
    if(!empty($msg_id) && isset($msg_id)) {

        global $conn;

        $query = $conn->prepare("DELETE FROM messages WHERE msg_id = :msg_id");
        $query->bindParam(":msg_id", $msg_id);

        $res = $query->execute();
        if($res) {
            return "Success";
        }
        else {
            echo json_encode("Could not delete message", JSON_FORCE_OBJECT);
            http_response_code(500);
        }

    }
    else {
        echo json_encode("Invalid message ID", JSON_FORCE_OBJECT);
        http_response_code(404);
    }

}


function adminRemoveProduct($prod_id) {
    if(!empty($prod_id) && isset($prod_id)) {

        global $conn;

        $query = $conn->prepare("SELECT * FROM products WHERE prod_id = :prod_id AND active = 1");
        $query->bindParam(":prod_id", $prod_id);

        $resp = $query->execute();

        if($resp) {
            $query = $conn->prepare("UPDATE products SET active = 0 WHERE prod_id = :prod_id");
            $query->bindParam(":prod_id", $prod_id);

            $res = $query->execute();
            if($res) {
                return "Success";
            }else {
                echo json_encode("Could not delete product", JSON_FORCE_OBJECT);
                http_response_code(500);
            }
        }
        else {
            echo json_encode("There is no such product", JSON_FORCE_OBJECT);
            http_response_code(404);
        }
        

    }
    else {
        echo json_encode("Invalid product ID", JSON_FORCE_OBJECT);
        http_response_code(404);
    }
}



function adminPollResults($poll_id) {

    global $conn;

    $query = $conn->prepare("SELECT u.username, pc.choice_text as answer FROM polls p INNER JOIN poll_choices pc ON p.poll_id = pc.poll_id INNER JOIN poll_answers pa ON pa.choice_id = pc.choice_id INNER JOIN users u ON u.id = pa.user_id WHERE p.poll_id = :poll_id");
    $query->bindParam(":poll_id", $poll_id);
    $query->execute();

    $res['users'] = $query->fetchAll(PDO::FETCH_OBJ);
    // display($res);

    $query = $conn->prepare("SELECT choice_id FROM poll_choices WHERE poll_id = :poll_id");
    $query->bindParam(":poll_id", $poll_id);
    $query->execute();
    $choices = $query->fetchAll(PDO::FETCH_OBJ);

    $choice_count = array();
    foreach($choices as $i => $choice_id) {
        // display($choice_id->choice_id);
        $id = $choice_id->choice_id;
        $query = $conn->prepare("SELECT COUNT(*) FROM poll_answers WHERE choice_id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $num = $query->fetch()[0];
        $choice_count[] = $num;

    }
    // display($choice_count);
    $res['results'] = $choice_count;
    // $choice_count;

    $query = $conn->prepare("SELECT choice_text as text, choice_id as id  FROM poll_choices WHERE poll_id = :poll_id");
    $query->bindParam(":poll_id", $poll_id);
    $query->execute();
    $answers = $query->fetchAll(PDO::FETCH_OBJ);
    $res["answers"] = $answers;

    $query = $conn->prepare("SELECT question FROM polls WHERE poll_id = :poll_id");
    $query->bindParam(":poll_id", $poll_id);
    $query->execute();
    $question = $query->fetch()[0];
    $res['question'] = $question;

    // display($choice_count);
    // display($answers);

    return $res;


}