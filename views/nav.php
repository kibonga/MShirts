<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    try{
        $nav = loadNav();
    }
    catch(PDOException $e) {
        echo "Could not load the nav: " . $e->getMessage();
    }
    // display($_SESSION['loggedUser']);
    
?>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><?php echo WEBISTE?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
             

            <?php foreach($nav as $i => $link): ?>
              
              <?php if((!isset($_SESSION['loggedUser']) || $_SESSION['loggedUser']->user_type != 'customer') && $link->name == "cart") {
                continue;
              }?>
              <?php if((isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->user_type == 'admin') && $link->name == "contact") {
                continue;
              }?>
              <li class="nav-item">
                  <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], $link->name.'.php') ? "active text-primary" : "" ?>" aria-current="page" href="<?php echo $link->name?>.php"><?php echo $link->name == 'index' ? "Home" : ucfirst($link->name) ?></a>
              </li>
            <?php endforeach; ?>

        </ul>

        <ul class="navbar-nav mb-2 mb-lg-0 d-flex justify-content-end" id="navUser">
              <?php if(isset($_SESSION['loggedUser'])) { ?>

                  <?php if($_SESSION['loggedUser']->user_type == 'admin') {?>
                    <li class="nav-item">
                      <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'admin') ? "active text-primary" : "" ?>" href="<?= 'admin.php'?>">
                          <span class="material-icons">
                              account_circle
                          </span>
                      </a>
                    </li>
                  <?php } elseif($_SESSION['loggedUser']->user_type == 'customer') { ?>
                    <li class="nav-item">
                      <a class="nav-link  rounded-circle" href="cart.php" tabindex="-1" aria-disabled="true">
                          <span class="material-icons">
                              shopping_cart
                          </span>
                          <span class='badge' id='customer-cart-quantity'></span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'customer') ? "active text-primary" : "" ?>" href="<?= 'customer.php' ?>">
                          <span class="material-icons">
                              account_circle
                          </span>
                      </a>
                    </li>
                  <?php } ?>
                  <li class="nav-item">
                    <a class="nav-link" id="user-logout" href="<?php echo "models/logout.php" ?>">Logout</a>
                  </li>


              <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'login.php') ? "active text-primary" : "" ?>"  href="<?= 'login.php' ?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'register.php') ? "active text-primary" : "" ?>" href="<?= 'register.php' ?>">Register</a>
                </li>
              <?php } ?>

        </ul>

        <?php if(isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']->user_type == "customer"): ?>
          <input type="hidden" name="customer-id" id="customer-id" value="<?php echo $_SESSION['loggedUser']->user_id ?>">
          <input type="hidden" name="customer-type" id="customer-type" value="<?php echo $_SESSION['loggedUser']->user_type ?>">
          <?php if(isset($_SESSION['cart'])): ?>
              <?php foreach($_SESSION['cart'] as $i => $prod): ?>
                
                <input type="hidden" class="prod_id" name="prod-cart-<?php echo $i?>" id="session-cart-<?php echo $i?>" value="<?php echo $prod->prod_id ?>">
                <input type="hidden" class="prod_quantity" name="quantity-cart-<?php echo $i?>" id="session-cart-<?php echo $i?>" value="<?php echo $prod->quantity ?>">
              
              <?php endforeach; ?>
          <?php endif; ?>
          
        <?php endif; ?>
    </div>
  </div>
</nav>