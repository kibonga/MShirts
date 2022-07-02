<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


    require_once "config/connection.php";
    require_once "models/functions.php";
    require_once "models/shop-model.php";
    require_once "views/head.php";
    require_once "views/nav.php";

?>
<div id="single-product-add-div"></div>

<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4" id="single-product-h1"></h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">Here you can learn more about <span id="single-product-p"></span>'s info</p>
        </div>
    </div>
</div>

<div class="container">
    <ol class="breadcrumb text-primary bg-light p-3 border">
    <li class="breadcrumb-item"><a href="shop.php">
        <span class="material-icons align-bottom">
        shopping_bag
        </span>
        To shop
    </a></li>
    <?php if(isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->user_type == 'customer'): ?>
        <li class="breadcrumb-item"><a href="cart.php">Go to cart</a></li>
    <?php endif; ?>
</ol>
</div>


<div id="single-product-div"></div>


<?php 
require_once "views/footer.php";
?>