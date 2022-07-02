<?php
    require_once "config/connection.php";
    require_once "models/functions.php";
    require_once "views/head.php";
    require_once "views/nav.php";
?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">This is the about page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is is the subtitle of the about page</p>
        </div>
    </div>
</div>







<div class=" py-5">
    <div class="container">

      <h3 class="lead display-5 mb-4">Who are we</h3>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <figure>
              <img src="assets/img/hero5.jpg" class="img-fluid" alt="">
            </figure>

            <div class="card-body">
              <p class="card-text">We are a mens only store, specialized in selling shirts. Our products have been praised by many around the world.</p>
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
              <p class="card-text">Our top notch materials make for the best quality by which we are recognized. Our shirts have gathered many awards for their pristine design.</p>
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
              <p class="card-text">MShirts has a stong base of satisfied customers, and we tend to keep it that way. Our quality of service is our number one moto.</p>
              <div class="d-flex justify-content-between align-items-center">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>



  <section id="about-hero" class="my-5">
    
  </section>


  <div class="container">
    <hr>
  </div>
  

  <div class="container my-5">
    <h3 class="lead display-5 mb-4">What others think about us</h3>
      <!-- Three columns of text below the carousel -->
    <div class="row my-5">
        <div class="col-lg-4 text-center">
            <img src="assets/img/round1.jpg" class="img-fluid rounded-circle" alt="">
  
            <h4 class="lead my-3">Ben Askren</h4>
          <p>I've been a fan of MShirt from day one. I'm really impressed with the quality and desing, not to mention the prices.</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 text-center">
            <img src="assets/img/round2.jpg" class="img-fluid rounded-circle" alt="">
  
          <h4 class="lead my-3">Jorge Masvidal</h4>
          <p>If you are like me and like to change outfits frequently I would suggest looking into their newest collection, its awsome.</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 text-center">
            <img src="assets/img/round3.jpg" class="img-fluid rounded-circle" alt="">
  
            <h4 class="lead my-3">Kamaru Ousman</h4>
          <p>They have shirts for all the seassons, doesn't matter if its middle of July or just plain December. They rock with everything.</p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
  </div>


  <div class="container">
    <hr>
  </div>



<?php 
require_once "views/footer.php";
?>