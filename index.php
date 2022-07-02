<?php
    require_once "config/connection.php";
    require_once "models/functions.php";
    require_once "views/head.php";
    require_once "views/nav.php";

?>



<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">This is the index page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is is the subtitle of the index page</p>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
      <hr class="featurette-divider">

      <div class="row featurette my-5 d-flex align-items-center">
        <div class="col-md-7">
          <h4 class="display-6 lead">Need a shirt for every occasion? <span class="text-muted">It’ll blow your mind.</span></h4>
          <p class="lead">Match any combination and rock every style with our shirts. Don't believe us?<a href="shop.php" class="text-muted bg-light"> Check them out</a></p>
        </div>
        <div class="col-md-5">
          <figure>
            <img src="assets/img/hero2.jpg" class="img-fluid" alt="">
          </figure>
        </div>
      </div>
    
      <hr class="featurette-divider">
    
      <div class="row featurette my-5 d-flex align-items-center">
        <div class="col-md-7 order-md-2">
          <h4 class="display-6 lead">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h4>
          <p class="lead">Quality and design are our base principles and only the finest is the best. Our products are made entirely of eco-friendly materials.</p>
        </div>
        <div class="col-md-5 order-md-1">
          <figure>
              <img src="assets/img/hero1.jpg" class="img-fluid" alt="">
          </figure>
        </div>
      </div>
    </div>
  </div>


  <div class="container my-5">
    <hr class="hr">
  </div>





  <section class="py-5 text-center bg-light">
    <div class="container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Be the change you desire</h1>
          <p class="lead text-muted">All of our shirt are certified and proven to be the best by many awards we've gotten over the past 15 years.</p>
          <p>
            <a href='shop.php' class="btn btn-secondary my-2">Start shopping</a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <div class=" py-5">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <figure>
              <img src="assets/img/hero5.jpg" class="img-fluid" alt="">
            </figure>

            <div class="card-body">
              <p class="card-text">Our newest collections have just arrived, and you can be first one to check them out. Remember they rock every style.</p>
              <div class="d-flex justify-content-between align-items-center">
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <figure>
              <img src="assets/img/hero4.jpg" class="img-fluid" alt="">
            </figure>

            <div class="card-body">
              <p class="card-text">Doesn't matter what age you are, our shirts will fit you like no other. After trying them you'll never want to switch back.</p>
              <div class="d-flex justify-content-between align-items-center">
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <figure>
              <img src="assets/img/hero6.jpg" class="img-fluid" alt="">
            </figure>

            <div class="card-body">
              <p class="card-text">Simple but powerful. Our shirts design is our strongest point. Everyday combos never looked this fresh and good.</p>
              <div class="d-flex justify-content-between align-items-center">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>




<?php
    require_once "views/footer.php";
?>
    

    
