<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->user_type == "admin") {
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
            <h1 class="display-4">This is the contact page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">Here you can send us a message</p>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
      <hr class="featurette-divider">

      

      <div class="container my-5">

        <div class="row">


          <div class="col-md-6">
            <figure>
              <img src="assets/img/hero2.jpg" class="img-fluid" alt="">
            </figure>
          </div>
  
          <div class="col-md-6">
            <div>
              <h4 class="featurette-heading">Have any questions? <span class="text-muted">Send us an mail.</span></h4>
              <p class="lead">Don't hesitate to send us an email if you have any questions, we are here to help.</p>
              <!-- <h4 class="lead text-success d-none col-md-6 py-3" id="contact-success"></h4> -->
            </div>
            <form class="" id="contact-form">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="firstName" class="form-label">First name</label>
                  <input type="text" class="form-control" id="fname" placeholder="Mark"  value="<?php echo (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->user_type == 'customer') ? $_SESSION['loggedUser']->first_name : '' ?>" required>
                  <span clas='text-danger'>
                    <?php echo isset($_SESSION['fnameCon']) ? $_SESSION['fnameCon'] : "" ?>
                  </span>
                </div>
    
                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Last name</label>
                  <input type="text" class="form-control" id="lname" placeholder="Cuban" value="<?php echo (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->user_type == 'customer') ? $_SESSION['loggedUser']->last_name : '' ?>" required>
                  <span clas='text-danger'>
                  <?php echo isset($_SESSION['lnameCon']) ? $_SESSION['lnameCon'] : "" ?>
                  </span>
                </div>
    
                <div class="col-12">
                  <label for="email" class="form-label">Email <span class="text-muted"></span></label>
                  <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->user_type == 'customer') ? $_SESSION['loggedUser']->email : '' ?>">
                  <span clas='text-danger'>
                    <?php echo isset($_SESSION['emailCon']) ? $_SESSION['emailCon'] : "" ?>
                  </span>
                </div>


                <div class="col-12">
                  <label for="subject" class="form-label">Subject <span class="text-muted"></span></label>
                  <input type="text" class="form-control" id="subject" placeholder="Subject" value="">
                  <span clas='text-danger'>
                    <?php echo isset($_SESSION['subjectCon']) ? $_SESSION['subjectCon'] : "" ?>
                  </span>
                </div>

                <div class="col-12">
                  <label for="email" class="form-label">Message <span class="text-muted"></span></label>
                  <textarea name="message" class="form-control" id="message" cols="30" rows="3"></textarea>
                  <span clas='text-danger'>
                  <?php echo isset($_SESSION['messageCon']) ? $_SESSION['messageCon'] : "" ?>
                  </span>
                </div>
    
              <hr class="my-4">
    
                
                <div>
                  <button class="w-35 btn btn-secondary border btn col-md-5 mb-3" id="contact-submit" type="submit">Send</button>
                </div>

                <div>
                    <span id="contact-success" class="bg-light text-success"></span>
                    <span id="contact-fail" class="bg-light invalid"></span>
                </div>
                
                
              </form>
          </div>


        </div>

        

      </div>
    
    </div>
  </div>
</div>





<?php 

unset($_SESSION['fnameCon']);
unset($_SESSION['lnameCon']);
unset($_SESSION['emailCon']);
unset($_SESSION['subjectCon']);
unset($_SESSION['messageCon']);

?>





<?php 
require_once "views/footer.php";
?>