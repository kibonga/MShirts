<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['loggedUser']->user_type != 'admin') {
        header("Location: index.php");
    }

    require_once "config/connection.php";
    require_once "models/functions.php";
    // require_once "models/admin-model.php";
    require_once "views/head.php";
    require_once "views/nav.php";


?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">Welcome back <?php echo $_SESSION['loggedUser']->username ?></h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is the admin panel, here you have full control</p>
        </div>
    </div>
</div>


<div class="mb-5">
    <div class="container">
        <h3 class="lead  p-3 display-5 mb-3">Admin dashboard</h3>
            <p class="lead col-md-4 bg-light mb-5 p-3">Here you can manage these options</p>
            <nav aria-label="breadcrumb col-md-4 p-0">
                <ol class="breadcrumb text-primary bg-light p-3 border">
                    <li class="breadcrumb-item align-middle"><a href="admin-users.php" class="">
                        <span class="material-icons align-bottom">
                            people
                        </span> Users</a></li>
                    <li class="breadcrumb-item"><a href="admin-products.php">
                    <span class="material-icons align-bottom">
                        local_offer
                    </span>
                        Products
                    </a></li>
                    <li class="breadcrumb-item"><a href="admin-orders.php">
                    <span class="material-icons align-bottom">
                        receipt_long
                    </span>
                    Orders</a>
                    </li>
                    <li class="breadcrumb-item"><a href="admin-messages.php">
                    <span class="material-icons align-bottom">
                        email
                    </span>
                    Messages</a>
                    </li>
                    <li class="breadcrumb-item"><a href="admin-poll.php">
                    <span class="material-icons align-bottom">
                    poll
                    </span>
                    Poll</a>
                    </li>
                </ol>
            </nav>
    </div>
</div>


<?php 
require_once "views/footer.php";
?>