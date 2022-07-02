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
    require_once "models/admin-model.php";
    require_once "views/head.php";
    require_once "views/nav.php";

    $poll = adminPollResults(1);
    // display($poll);
?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">Polls panel</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">View all of the active polls</p>
        </div>
    </div>
</div>


<div class="mb-5">
    <div class="container">
        <div class="row">
            <h3 class="lead  p-3 display-5 mb-3">Poll results</h3>
            <p class="lead col-md-4 bg-light mb-5 p-3">Here you view poll results</p>
            <ol class="breadcrumb text-primary bg-light p-3 border">
                <li class="breadcrumb-item"><a href="admin.php">
                    <span class="material-icons align-bottom">
                        arrow_back
                    </span>
                    Back to dashboard
                </a></li>
                <li class="breadcrumb-item"><a href="shop.php">
                    <span class="material-icons align-bottom">
                    shopping_bag
                    </span>
                    To shop
                </a></li>
            </ol>

            <div>
                <div class="mb-2">
                    <div>
                        <p class="lead">Poll question: <?php echo $poll['question']?></p>
                    </div>
                </div>
            </div>

        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Answer text</th>
                    <th scope="col">Votes</th>
                </tr>
            </thead>
            <tbody id="admin-users-table" class="table-striped">
                <?php foreach($poll['answers'] as $i => $answer): ?>
                    <tr>
                        <th class="lead"><?php echo $i +1 ?></th>
                        <th><?php echo $answer->text?></th>
                        <th><?php echo $poll['results'][$i]?></th>
                    </tr>
                <?php endforeach;?>
            </tbody>
            </table>


        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">User</th>
                    <th scope="col">Answer</th>
                </tr>
            </thead>
            <tbody id="admin-users-table" class="table-striped">
                <?php foreach($poll['users'] as $i => $user): ?>
                    <tr>
                        <th class="lead"><?php echo $i +1 ?></th>
                        <th><?php echo $user->username?></th>
                        <th><?php echo $user->answer?></th>
                    </tr>
                <?php endforeach;?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
<nav aria-label="...">
    <ul class="pagination" id="pagination">

    </ul>
</nav>
</div>



<div id="delete-user-div"></div>

</div>

<?php 
require_once "views/footer.php";
?>