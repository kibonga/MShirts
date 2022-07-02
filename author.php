<?php
    require_once "config/connection.php";
    require_once "models/functions.php";
    require_once "views/head.php";
    require_once "views/nav.php";

?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">This is the author page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is is the subtitle of the author page</p>
        </div>
    </div>
</div>


<div class="container">
    
<div class="row">
<hr class="featurette-divider">

<div class="row featurette my-5 d-flex align-items-center">
<div class="col-md-7">
    <h2 class="lead display-6">Author</h2>
    <p class="lead">My name is Pavle and as you can see... I'm doing just fine. My main goal is to become a professional web developer. I like problem solving and building things, that's probably the reason i enjoy web development so much.</p>
    <hr>
    <h3 class="lead mb-3 display-6">Personal info</h3>
    <p class="lead">Making this shitsite got me like:</p>
    <p class="ps-4">"Yeah well, I'm gonna build my own PHP framework...With blackjack and hookers! In fact, forget about PHP framework..."</p>
    <p class="lead">Favourite book:</p>
    <p>Illiad by Homer, <small>the chaddest book</small></p>
    <p class="lead">Miscellaneous:</p>
    <p>I really hate jQuery</p>
    <hr>
</div>
<div class="col-md-5">
    <figure>
    <img src="assets/img/kursevi-ict.jpg" class="img-fluid" alt="">
    </figure>
</div>
</div>
</div>

    <hr class="featurette-divider">


<?php 
require_once "views/footer.php";
?>