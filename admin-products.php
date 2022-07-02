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


?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">Products panel</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">View all of the available products </p>
        </div>
    </div>
</div>


<div class="mb-5">
    <div class="container">
        <div class="row">
            <h3 class="lead  p-3 display-5 mb-3">Available products</h3>
            <p class="lead col-md-4 bg-light mb-5 p-3">Here you can mannage all the available products</p>
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
                <li class="breadcrumb-item"><a href="admin-product-add.php">
                    <span class="material-icons align-bottom">
                    add_circle
                    </span>
                    Add new product
                </a></li>
            </ol>

            <div>
                <p class="p-0">Number of items: <span id="item-count"></span></p>
                <div class="mb-2">
                    <div>
                        <p class="lead">Products per page: </p>
                        <div class="d-flex justify-content-start">
                            6
                            <a href="#" class="active-grid grid" data-offset="6">
                                <span class="material-icons  mx-1" >
                                    view_module
                                </span>
                            </a>
                            12
                            <a href="#" class="grid" data-offset="12">
                                <span class="material-icons  rotate-90 mx-1">
                                    view_comfy
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Color</th>
                    <th scope="col">Inserted on</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="admin-products-table" class="table-striped">
                
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