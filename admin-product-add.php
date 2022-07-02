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


    $f = getAllFilters();
    // display($f);


?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">Add new Products panel</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">Here you can add new products</p>
        </div>
    </div>
</div>


<div class="mb-5">
    <div class="container">
        <div class="row">
            <h3 class="lead  p-3 display-5 mb-3">Add new product</h3>
            <p class="lead col-md-4 bg-light mb-5 p-3">Here you can mannage all the the new products</p>
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
                <li class="breadcrumb-item"><a href="admin-products.php">
                <span class="material-icons align-bottom">
                    local_offer
                </span>
                    Back to products
                </a></li>
            </ol>
        </div>
    </div>
</div>

<div clas="m-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label d-block lead bg-light p-2 text-success">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Product name">
                    <span class="invalid"></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label d-block lead bg-light p-2 text-success">Description</label>
                    <textarea class="form-control" id="desc" rows="3" placeholder="Product description"></textarea>
                    <span class="invalid"></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label d-block lead bg-light p-2 text-success">Price</label>
                    <input type="number" class="form-control" id="price" min='1' max='100' placeholder="Price">
                    <span class="invalid"></span>
                </div>
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label d-block lead bg-light p-2 text-success">Category</label>
                <select class="form-select" id="cat" aria-label="">
                    <?php foreach($f[0] as $i => $cat): ?>
                        <option id="cat-<?php echo $cat->cat_id?>" value="<?php echo $cat->cat_id?>"><?php echo $cat->cat_name?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label d-block lead bg-light p-2 text-success">Brand</label>
                <select class="form-select" id="brand" aria-label="">
                    <?php foreach($f[1] as $i => $brand): ?>
                        <option id="brand-<?php echo $brand->brand_id?>" value="<?php echo $brand->brand_id?>"><?php echo $brand->brand_name?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label d-block lead bg-light p-2 text-success">Color</label>
                <select class="form-select" id="color" aria-label="">
                    <?php foreach($f[2] as $i => $color): ?>
                        <option id="color-<?php echo $color->color_id?>" value="<?php echo $color->color_id?>"><?php echo $color->color_name?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block lead bg-light p-2 text-success" for="inputGroupFile01">Upload image - Regular</label>
                    <input type="file" class="form-control" id="img_normal">
                    <span class="invalid"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block lead bg-light p-2 text-success" for="inputGroupFile01">Upload image - Thumbnail</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="img_thumb">
                    <span class="invalid"></span>
                </div>
                <div class="mb-3 lead bg-light p-2 px-4 text-success">
                    <input type="checkbox" id="add-product-agree">
                    <label class="form-label ms-3" for="inputGroupFile01">I confirm that the info provided is valid</label>
                </div>
                <div class="mt-4">
                    <button class="btn btn-secondary" id="submit">Add product</button>
                </div>
                <div class="mt-2">
                    <p id="add-product-invalid" class="invalid lead"></p>
                    <p id="add-product-valid" class="text-success lead"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require_once "views/footer.php";
?>