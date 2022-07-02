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


if(isset($_FILES) && isset($_POST)) {

        if(isset($_FILES['img_normal']) && isset($_FILES['img_thumb'])) {

                $post = validatePOST();
                print_r($post);

                if($post) {
                $name = $post['name'];
                $desc = $post['desc'];
                $price = $post['price'];
                $cat = $post['cat'];
                $brand = $post['brand'];
                $color = $post['color'];
                $method = $post['method'];


                
                    $img_normal = $_FILES['img_normal'];
                    $img_thumb = $_FILES['img_thumb'];

                    $img_name1 = $img_normal['name'];
                    $temp1 = $img_normal['tmp_name'];
                    $type1 = $img_normal['type'];
                    $size1 = $img_normal['size'];
                    $errs1 = $img_normal['error'];

                    $img_name2 = $img_thumb['name'];
                    $temp2 = $img_thumb['tmp_name'];
                    $type2 = $img_thumb['type'];
                    $size2 = $img_thumb['size'];
                    $errs2 = $img_thumb['error'];

                    if($errs1 == 0 && $errs2 == 0) {

                        $errs = array();
                        $extenstions = ["image/jpg", "image/jpeg", "image/png"];

                        if(!in_array($type1, $extenstions) || !in_array($type2, $extenstions)) {
                            $errs[] = "Invalid file type!";
                        }
                        if($size1 > 200000 || $size2 > 200000) {
                            $errs[] = "File to large";
                        }

                        if(empty($errs)) {
                            $new_img_normal = time()."_".$img_name1; 
                            $new_img_thumb = time()."_".$img_name2; 

                            $img1 = array(
                                // "img_normal" => $img_normal,
                                "temp1" => $temp1,
                                "type1" => $type1,
                                "size1" => $size1,
                                "new_img_normal" => $new_img_normal
                            );
                            $img2 = array(
                                // "img_thumb" => $img_thumb,
                                "temp2" => $temp2,
                                "type2" => $type2,
                                "size2" => $size2,
                                "new_img_thumb" => $new_img_thumb
                            );


                            if($method == 'insertNewProduct') {
                                insertNewProduct($name, $desc, $price, $cat, $brand, $color, $img1, $img2);
                            }
                            else if($method == 'updateProduct') {
                                $prod_id = $_POST['prod_id'];
                                print_r("Update both");
                                updateProductBothIMG($name, $desc, $price, $cat, $brand, $color, $img1, $img2, $prod_id);
                            }
                            else {
                                echo json_encode("Invalid method", JSON_FORCE_OBJECT);
                                http_response_code(404);
                            }
                            
                            


                        }
                        

                    }
                    else {
                        echo json_encode("Images have errors", JSON_FORCE_OBJECT);
                        http_response_code(404);
                    }
                }

            
            }
            else if(isset($_FILES['img_normal']) || isset($_FILES['img_thumb'])) {
                    print_r("One of two images");
                    $post = validatePOST();
                    print_r($post);

                    $prod_id = null;

                    if(!empty($_POST['prod_id']) && isset($_POST['prod_id'])) {
                        $prod_id = $_POST['prod_id'];
                    }
            
                    if($post && $prod_id) {
                    $name = $post['name'];
                    $desc = $post['desc'];
                    $price = $post['price'];
                    $cat = $post['cat'];
                    $brand = $post['brand'];
                    $color = $post['color'];
                    $method = $post['method'];
            
                    if($method == "updateProduct") {
                        if(isset($_FILES['img_normal'])) {
                            print_r("Updates normal image");
                            $img_normal = $_FILES['img_normal'];
                            
                            $img_name1 = $img_normal['name'];
                            $temp1 = $img_normal['tmp_name'];
                            $type1 = $img_normal['type'];
                            $size1 = $img_normal['size'];
                            $errs1 = $img_normal['error'];
            
                            if($errs1 == 0) {
                                $errs = array();
                                $extenstions = ["image/jpg", "image/jpeg", "image/png"];
            
                                if(!in_array($type1, $extenstions)) {
                                    $errs[] = "Invalid file type!";
                                }
                                if($size1 > 200000) {
                                    $errs[] = "File to large";
                                }
            
            
                                if(empty($errs)) {
                                    $new_img_normal = time()."_".$img_name1; 
            
                                    $img1 = array(
                                        // "img_normal" => $img_normal,
                                        "temp1" => $temp1,
                                        "type1" => $type1,
                                        "size1" => $size1,
                                        "new_img_normal" => $new_img_normal
                                    );
            
                                    if($method == 'updateProduct') {
                                        updateProductNormalIMG($name, $desc, $price, $cat, $brand, $color, $img1, $prod_id);
                                    }
                                }
            
                            }
                        }
                        if(isset($_FILES['img_thumb'])) {
                            // print_r("Updates thumb image");
                            $img_thumb = $_FILES['img_thumb'];
            
                            $img_name2 = $img_thumb['name'];
                            $temp2 = $img_thumb['tmp_name'];
                            $type2 = $img_thumb['type'];
                            $size2 = $img_thumb['size'];
                            $errs2 = $img_thumb['error'];
            
                            if($errs2 == 0) {
                                $errs = array();
                                $extenstions = ["image/jpg", "image/jpeg", "image/png"];
            
                                if(!in_array($type2, $extenstions)) {
                                    $errs[] = "Invalid file type!";
                                }
                                if($size2 > 200000) {
                                    $errs[] = "File to large";
                                }
            
                                if(empty($errs)) {
                                    $new_img_thumb = time()."_".$img_name2; 
            
                                    $img2 = array(
                                        // "img_normal" => $img_normal,
                                        "temp2" => $temp2,
                                        "type2" => $type2,
                                        "size2" => $size2,
                                        "new_img_thumb" => $new_img_thumb
                                    );
            
                                    if($method == 'updateProduct') {
                                        updateProductThumbIMG($name, $desc, $price, $cat, $brand, $color, $img2, $prod_id);
                                    }
                                }
                            }
                        }
                    }
            
                }
            
            }
            else if(!isset($_FILES['img_normal']) && !isset($_FILES['img_normal'])) {

                    $post = validatePOST();
                    
            
                    if($post && isset($_POST['prod_id'])) {
                        $name = $post['name'];
                        $desc = $post['desc'];
                        $price = $post['price'];
                        $cat = $post['cat'];
                        $brand = $post['brand'];
                        $color = $post['color'];
                        $method = $post['method'];
                        $prod_id = $_POST['prod_id'];

                        // print_r("Update product without images");
                        updateProductWithoutIMG($name, $desc, $price, $cat, $brand, $color, $prod_id);
                    }
                
                
            }
}
else if(isset($_POST)){
    // print_r("WITHOUT IMAGES")
    echo json_encode("No data was sent", JSON_FORCE_OBJECT);
    http_response_code(404);
}






function insertNewProduct($name, $desc, $price, $cat, $brand, $color, $img1, $img2) {
    global $conn;
    
    $location1 = '../assets/img/'.$img1['new_img_normal'];
    $location2 = '../assets/img/'.$img2['new_img_thumb'];
    if(move_uploaded_file($img1['temp1'], $location1) && move_uploaded_file($img2['temp2'], $location2)) {
        
        $query = $conn->prepare("INSERT INTO image (path_normal, path_thumb) VALUES(:img_normal, :img_thumb)");
        $query->bindParam(":img_normal", $img1['new_img_normal']);
        $query->bindParam(":img_thumb", $img2['new_img_thumb']);
        if($query->execute()) {
            $img_id = $conn->lastInsertId();


            $query = $conn->prepare("INSERT INTO products(prod_name, prod_desc, price, cat_id, brand_id, img_id, color_id) VALUES(:prod_name, :prod_desc, :price, :cat_id, :brand_id, :img_id, :color_id)");
            $query->bindParam(":prod_name", $name);
            $query->bindParam(":prod_desc", $desc);
            $query->bindParam(":price", $price);
            $query->bindParam(":cat_id", $cat);
            $query->bindParam(":brand_id", $brand);
            $query->bindParam(":img_id", $img_id);
            $query->bindParam(":color_id", $color);

            if($query->execute()) {
                // print_r("PRODUCT ADDED");
                echo json_encode("Product updated", JSON_FORCE_OBJECT);
                http_response_code(200);
            }
            else {
                echo json_encode("Failed to insert product", JSON_FORCE_OBJECT);
                http_response_code(500);
            }

        }
        else {
            echo json_encode("Failed to insert image", JSON_FORCE_OBJECT);
            http_response_code(500);
        }

    }
    
}


function updateProductBothIMG($name, $desc, $price, $cat, $brand, $color, $img1, $img2, $prod_id) {

    global $conn;
    $query = $conn->prepare("SELECT img_id FROM products WHERE prod_id = :prod_id");
    $query->bindParam(":prod_id", $prod_id);
    $query->execute();
    $img_id = $query->fetch()[0];
    

    $location1 = '../assets/img/'.$img1['new_img_normal'];
    $location2 = '../assets/img/'.$img2['new_img_thumb'];
    if(move_uploaded_file($img1['temp1'], $location1) && move_uploaded_file($img2['temp2'], $location2)) {
        $query = $conn->prepare("UPDATE image SET path_normal = :img_normal, path_thumb = :img_thumb WHERE img_id = :img_id");
        $query->bindParam(":img_normal", $img1['new_img_normal']);
        $query->bindParam(":img_thumb", $img2['new_img_thumb']);
        $query->bindParam(":img_id", $img_id);

        if($query->execute()) {
            $query = $conn->prepare("UPDATE products SET prod_name = :name, prod_desc = :desc, price = :price, cat_id = :cat, brand_id = :brand, color_id = :color WHERE prod_id = :prod_id");
            $query->bindParam(":prod_id", $prod_id);
            $query->bindParam(":name", $name);
            $query->bindParam(":desc", $desc);
            $query->bindParam(":price", $price);
            $query->bindParam(":cat", $cat);
            $query->bindParam(":brand", $brand);
            $query->bindParam(":color", $color);

            if($query->execute()) {
                echo json_encode("Product updated", JSON_FORCE_OBJECT);
                http_response_code(200);
            }

        }

    }
    

}
function updateProductNormalIMG($name, $desc, $price, $cat, $brand, $color, $img, $prod_id) {
    global $conn;
    $query = $conn->prepare("SELECT img_id FROM products WHERE prod_id = :prod_id");
    $query->bindParam(":prod_id", $prod_id);
    $query->execute();
    $img_id = $query->fetch()[0];

    $location1 = '../assets/img/'.$img['new_img_normal'];
    if(move_uploaded_file($img['temp1'], $location1)) {
        $query = $conn->prepare("UPDATE image SET path_normal = :img_normal WHERE img_id = :img_id");
        $query->bindParam(":img_normal", $img['new_img_normal']);
        $query->bindParam(":img_id", $img_id);

        if($query->execute()) {
            $query = $conn->prepare("UPDATE products SET prod_name = :name, prod_desc = :desc, price = :price, cat_id = :cat, brand_id = :brand, color_id = :color WHERE prod_id = :prod_id");
            $query->bindParam(":prod_id", $prod_id);
            $query->bindParam(":name", $name);
            $query->bindParam(":desc", $desc);
            $query->bindParam(":price", $price);
            $query->bindParam(":cat", $cat);
            $query->bindParam(":brand", $brand);
            $query->bindParam(":color", $color);

            if($query->execute()) {
                echo json_encode("Product updated", JSON_FORCE_OBJECT);
                http_response_code(200);
            }

        }

    }

}
function updateProductThumbIMG($name, $desc, $price, $cat, $brand, $color, $img, $prod_id) {

    global $conn;
    $query = $conn->prepare("SELECT img_id FROM products WHERE prod_id = :prod_id");
    $query->bindParam(":prod_id", $prod_id);
    $query->execute();
    $img_id = $query->fetch()[0];

    $location1 = '../assets/img/'.$img['new_img_thumb'];
    if(move_uploaded_file($img['temp2'], $location1)) {
        $query = $conn->prepare("UPDATE image SET path_thumb = :img_thumb WHERE img_id = :img_id");
        $query->bindParam(":img_thumb", $img['new_img_thumb']);
        $query->bindParam(":img_id", $img_id);

        if($query->execute()) {
            $query = $conn->prepare("UPDATE products SET prod_name = :name, prod_desc = :desc, price = :price, cat_id = :cat, brand_id = :brand, color_id = :color WHERE prod_id = :prod_id");
            $query->bindParam(":prod_id", $prod_id);
            $query->bindParam(":name", $name);
            $query->bindParam(":desc", $desc);
            $query->bindParam(":price", $price);
            $query->bindParam(":cat", $cat);
            $query->bindParam(":brand", $brand);
            $query->bindParam(":color", $color);

            if($query->execute()) {
                echo json_encode("Product updated", JSON_FORCE_OBJECT);
                http_response_code(200);
            }

        }

    }

}
function updateProductWithoutIMG($name, $desc, $price, $cat, $brand, $color, $prod_id) {

    global $conn;

    $query = $conn->prepare("UPDATE products SET prod_name = :name, prod_desc = :desc, price = :price, cat_id = :cat, brand_id = :brand, color_id = :color WHERE prod_id = :prod_id");
    $query->bindParam(":prod_id", $prod_id);
    $query->bindParam(":name", $name);
    $query->bindParam(":desc", $desc);
    $query->bindParam(":price", $price);
    $query->bindParam(":cat", $cat);
    $query->bindParam(":brand", $brand);
    $query->bindParam(":color", $color);

    if($query->execute()) {
        echo json_encode("Product updated", JSON_FORCE_OBJECT);
        http_response_code(200);
    }

}




function validatePOST() {

    if(!empty($_POST['method']) && isset($_POST['method'])) {
        $method = $_POST['method'];
        


        $regProdName = "/^[\w ]{2,50}$/";
        $regPrice = "/^\d{1,8}(?:\.\d{1,4})?$/";
        // $regDesc = "/^[\wA-ZŠĐŽČĆa-zšđžčć0-9][\wŠĐČĆŽšđžčć0-9\/\s\.!,?]+$/";

        $name = null;
        $desc = null;
        $price = null;
        $cat = null;
        $brand = null;
        $color = null;

        $errors = array();

        if(!empty($_POST['name']) && isset($_POST['name'])) {
            if(!preg_match($regProdName, $_POST['name'])) {
                $errors['name'] = "Name is not valid";
            } 
            else {
                $name = $_POST['name'];
            }
        }
        else {
            $errors['name'] = "Name cannot be empty";
        }


        if(!empty($_POST['desc']) && isset($_POST['desc'])) {
            $desc = $_POST['desc'];
        }
        else {
            $errors['desc'] = "Description cannot be empty";
        }


        if(!empty($_POST['price']) && isset($_POST['price'])) {
            if(!preg_match($regPrice, (float)$_POST['price'])) {
                $errors['price'] = "Price is not valid";
            } 
            else {
                $price = $_POST['price'];
            }
        }
        else {
            $errors['price'] = "Price cannot be empty";
        }


        if(!empty($_POST['cat']) && isset($_POST['cat'])) {
            $cat = $_POST['cat'];
        }
        else {
            $errors['cat'] = "Category cannot be empty";
        }


        if(!empty($_POST['brand']) && isset($_POST['brand'])) {
            $brand = $_POST['brand'];
        }
        else {
            $errors['brand'] = "Brand cannot be empty";
        }


        if(!empty($_POST['color']) && isset($_POST['color'])) {
            $color = $_POST['color'];
        }
        else {
            $errors['color'] = "Color cannot be empty";
        }

        if(!empty($_POST['method']) && isset($_POST['method'])) {
            $method = $_POST['method'];
        }
        else {
            $errors['method'] = "Method cannot be empty";
        }

        if(empty($errors)) {
            $res = array(

               "name" => $name,
               "desc" => $desc,
               "price" => $price,
               "cat" => $cat,
               "brand" => $brand,
               "color" => $color,
               "method" => $method

            );
            return $res;
        }
        else {
            return false;
        }

    }
    else { 
        return false;
    }

}

    