<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($_SESSION['loggedUser']->user_type != "customer") {
        header("Location: index.php");
    }
    require_once "config/connection.php";
    require_once "models/functions.php";
    require_once "models/shop-model.php";
    require_once "views/head.php";
    require_once "views/nav.php";

?>

<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">This is the cart page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is is the subtitle of the cart page</p>
        </div>
    </div>
</div>


<div id="product-add-div"></div>


<div id="popup-cart">

<div class="modal fade" id="remove-prod-cart-modal" tabindex="-1" aria-labelledby="remove-prod-cart-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title lead" id="remove-prod-cart-modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 class="lead">Details: </h4>
            <p class="lead">Name: <span id="remove-prod-cart-modal-name" class="bg-light border p-1"></span></p>
            <p class="lead" >Color: <span id="remove-prod-cart-modal-color" class="bg-light border p-1"></span></p>
            <p class="lead" >Price: <span id="remove-prod-cart-modal-price" class="bg-light border p-1"></span></p>
            <p class="lead" >Brand: <span id="remove-prod-cart-modal-brand" class="bg-light border p-1"></span></p>
        </div>
        <div class="modal-footer">
            <a href="shop.php" class="btn btn-secondary">Continue shopping</a>
            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

</div>


   


      <section class="section-pagetop bg">
          <div class="container">
              <h2 class="title-page">Shopping cart</h2>
              <p class="lead">No. items in cart: <span id="modal-number-products-cart"></span></p>
          </div> <!-- container //  -->
      </section>


      <div class="container">
      <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Color</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody id="cart-orders-list" class="table-striped">
                
            </tbody>
            </table>
      </div>

      <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
  <div class="container">
  
  <div class="row">
      <main class="col-md-9">
  <div class="card">

    <div>
        <input type="hidden" name="cart-user-id" id="cart-user-id" value="<?php echo $_SESSION['loggedUser']->user_id?>">
    </div>

  



  <!-- <div class="my-5">
    <h3 class="lead display-4 my-5">Cart</h3>
    <table id="cart"> 

    </table>
</div> -->


  
  <div class="card-body border-top">
      <a href="#" class="btn btn-secondary float-md-right" id="cart-make-purchase"> Make Purchase </a>
      <a href="shop.php" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
  </div>
  <p class="lead text-danger ms-3" id="cart-no-item"></p>	
  <p class="lead text-success ms-3" id="cart-success"></p>	
  </div> <!-- card.// -->
  
  <div class="alert alert-success mt-3">
      <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
  </div>
  
      </main> <!-- col.// -->
      <aside class="col-lg-3">
          <div class="card">
              <div class="card-body">
                    <div class="card-title">
                        <h3 class="lead">Order</h3>
                    </div>
                    <dl class="dlist-align">
                    <dt>Price:</dt>
                    <dd class="text-right" >&dollar;<span id='price'></span></dd>
                    </dl>
                    <hr>
                    <dl class="dlist-align">
                    <dt>Total:</dt>
                    <dd class="text-right  h5">&dollar;<strong id="total-price"></strong></dd>
                    </dl>
              </div>  <!-- card .// -->
      </aside> <!-- col.// -->
  </div>
  
  </div> <!-- container .//  -->
  </section>
  <!-- ========================= SECTION CONTENT END// ========================= -->




<?php 
require_once "views/footer.php";
?>