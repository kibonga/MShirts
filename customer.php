<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
    require_once "config/connection.php";
    require_once "models/functions.php";
    // require_once "models/customer-model.php";
    // require_once "models/polls.php";
    require_once "views/head.php";
    require_once "views/nav.php";

    if($_SESSION['loggedUser']->user_type != "customer") {
        header("Location: index.php");
    }

    // $poll = selectPoll(1);
    // display($poll);

?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">Welcome back <?php echo $_SESSION['loggedUser']->first_name ?></h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">Here you can manage your info</p>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
    <div class="col-md-6">
    <h3 class="lead display-6"><?php echo $_SESSION['loggedUser']->first_name ?>, these are your personal info</h3>
            <div class="mt-3">
                <div class="d-flex align-items-center p-3 bg-light">
                    <span class="material-icons">person</span>
                    <span class="lead ms-3 text-success"><?php echo $_SESSION['loggedUser']->first_name; echo "  " . $_SESSION['loggedUser']->last_name?></span>
                </div>
                <div class="d-flex align-items-center mt-3 p-3 bg-light">
                <span class="material-icons">
                    account_circle
                </span>
                    <span class="lead ms-3 text-success"><?php echo $_SESSION['loggedUser']->username;?></span>
                </div>
                <div class="d-flex align-items-center mt-3 p-3 bg-light">
                <span class="material-icons">
                    alternate_email
                </span>
                    <span class="lead ms-3 text-success"><?php echo $_SESSION['loggedUser']->email;?></span>
                </div>
                <div class="d-flex align-items-center mt-3 p-3 bg-light">
                <span class="material-icons">
                    event
                </span>
                    <span class="lead ms-3 text-success"><?php echo $_SESSION['loggedUser']->date_created;?></span>
                </div>
                <!-- <div class="d-flex align-items-center mt-3 p-3 bg-light">
                <span class="material-icons">
                    lock
                </span>
                    <span class="lead ms-3 text-success"><a data-bs-toggle="collapse" data-bs-target="#collapseExample" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Change password</a> </span>
                </div> -->
                <div class="d-flex align-items-center mt-3 p-3 bg-light">
                <span class="material-icons">
                    receipt_long
                </span>
                <span class="lead ms-3 text-success"><a href="customer-orders.php">View orders</a> </span>
                </div>
                <div class="d-flex align-items-center mt-3 p-3 bg-light">
                <span class="material-icons">
                    email
                </span>
                <span class="lead ms-3 text-success"><a href="customer-messages.php">View messages</a> </span>
                </div>
            </div>
    </div>


    <div id="customer-poll" class='col-md-5 mt-5 ms-auto d-flex-colum align-self-center'>

        
    
    </div>
    </div>


    


</div>









<?php 
require_once "views/footer.php";
?>