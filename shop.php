<?php
    require_once "config/connection.php";
    require_once "models/functions.php";
    require_once "models/shop-model.php";
    require_once "views/head.php";
    require_once "views/nav.php";
    $data = loadFilters();

?>

<div id="shop-add-div"></div>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">This is the shop page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is is the subtitle of the shop page</p>
        </div>
    </div>
</div>



<section class="section-content padding-y">
    <div class="container">
    
    <div class="row">
        <aside class="col-md-3">
            
    <div class="card">
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Shirt type</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_1" >
                <div class="card-body">
                    <form class="pb-3">
                    <div class="input-group">
                      <input type="text" class="form-control" id="search-products" placeholder="Search">
                      <div class="input-group-append">
                        <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    </form>

                    <div id="category">
                        
                    </div>
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group  .// -->


        <!-- #region -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Brands </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_2" >
                <div class="card-body" id="cat">
                    <?php foreach($data['cat'] as $i => $item):?>
                        <label class="custom-control custom-checkbox d-flex justify-content-between mb-2">
                            <div>
                                <input type="checkbox" value='<?php echo $item->cat_id ?>' name="cat" id="cat-<?php echo $item->cat_id ?>"class="custom-control-input"> <?php echo $item->cat_name ?>
                            </div>
                            <span class="badge badge-pill badge-danger bg-primary"></span> 
                        </label>
                    <?php endforeach ?>
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <!-- #endregion -->



        <!-- #region -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Brands </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_2" >
                <div class="card-body" id="brand">
                    <?php foreach($data['brand'] as $i => $item):?>
                        <label class="custom-control custom-checkbox d-flex justify-content-between mb-2">
                            <div>
                                <input type="checkbox" value='<?php echo $item->brand_id ?>' name="brand" id="brand-<?php echo $item->brand_id ?>"class="custom-control-input"> <?php echo $item->brand_name ?>
                            </div>
                            <span class="badge badge-pill badge-danger bg-primary"></span> 
                        </label>
                    <?php endforeach ?>
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <!-- #endregion -->




        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Colors </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_2" >
                <div class="card-body" id="colors">
                    <?php foreach($data['color'] as $i => $item):?>
                        <label class="custom-control custom-checkbox d-flex justify-content-between mb-2">
                            <div>
                                <input type="checkbox" value='<?php echo $item->color_id ?>' name="color" id="color-<?php echo $item->color_id ?>"class="custom-control-input"> <?php echo $item->color_name ?>
                            </div>
                            <span class="badge badge-pill badge-danger bg-primary"></span> 
                        </label>
                    <?php endforeach ?>
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->


        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Price range </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_3" >
                <div class="card-body">
                    <input type="range" class="custom-range" min="0" step="25" max="100" value="100" name="range" id="range">
                    <span id='range-value'>$100</span>

                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
    </div> <!-- card.// -->
    
        </aside> <!-- col.// -->
    <main class="col-md-9">
    
    <header class="border-bottom mb-4 pb-3">
            <div class="form-inline">
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
                <select class="mr-2 form-select" id="select">
                    <option value="">Select</option>
                    <option value="newest">Latest items</option>
                    <option value="nameAsc">Name A-Z</option>
                    <option value="nameDesc">Name Z-A</option>
                    <option value="priceDesc">Most Expensive</option>
                    <option value="priceAsc">Least Expensive</option>
                </select>
            </div>
    </header><!-- sect-heading -->
    
    <div class="row" id="products">

    </div> <!-- row end.// -->
    
    
    <nav aria-label="...">
        <ul class="pagination" id="pagination">

        </ul>
    </nav>
    
    </main> <!-- col.// -->
    
        </div>
    
        </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->









<?php 
require_once "views/footer.php";
?>