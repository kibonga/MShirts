<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(isset($_SESSION['loggedUser'])) {
        header("Location: index.php");
    }
    
    require_once "models/functions.php";
    require_once "config/connection.php";
    require_once "views/head.php";
    require_once "views/nav.php";

?>


<div class="mb-5" id="hero-slider">
    <div class="container py-5">
        <div class="row">
            <h1 class="display-4">This is the register page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is is the subtitle of the register page</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <form action="models/register-model.php"  method="POST" class="col-5" id="login-form">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username-register" id="username" value="<?php echo isset($_SESSION['usernameRegister']) ? $_SESSION['usernameRegister'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['usernameRegisterError']) ? $_SESSION['usernameRegisterError'] : "" ?>
                </span>
            </div>
            <div class="mb-3">
                <label class="form-label">First name</label>
                <input type="text" class="form-control" name="fname-register" id="fname" value="<?php echo isset($_SESSION['fnameRegister']) ? $_SESSION['fnameRegister'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['fnameRegisterError']) ? $_SESSION['fnameRegisterError'] : "" ?>
                </span>
            </div>
            <div class="mb-3">
                <label class="form-label">Last name</label>
                <input type="text" class="form-control" name="lname-register" id="lname" value="<?php echo isset($_SESSION['lnameRegister']) ? $_SESSION['lnameRegister'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['lnameRegisterError']) ? $_SESSION['lnameRegisterError'] : "" ?>
                </span>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="address-register" id="address" value="<?php echo isset($_SESSION['addressRegister']) ? $_SESSION['addressRegister'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['addressRegisterError']) ? $_SESSION['addressRegisterError'] : "" ?>
                </span>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email-register" id="email" value="<?php echo isset($_SESSION['emailRegister']) ? $_SESSION['emailRegister'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['emailRegisterError']) ? $_SESSION['emailRegisterError'] : "" ?>
                </span>
            </div>
            <div class="mb-3">
            <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password-register-1" id="password1" value="<?php echo isset($_SESSION['passwordRegister1']) ? $_SESSION['passwordRegister1'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['passwordRegister1Error']) ? $_SESSION['passwordRegister1Error'] : "" ?>
                </span>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password-register-2" id="password2" value="<?php echo isset($_SESSION['passwordRegister2']) ? $_SESSION['passwordRegister2'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['passwordRegister2Error']) ? $_SESSION['passwordRegister2Error'] : "" ?>
                </span>
            </div>
            </div>
            <div class="mb-3">
                <button type="submit" name='register-user' value="register-user" id="register-user" class='btn btn-secondary'>Register</button><br>
                <span class='invalid'>
                        <?php echo isset($_SESSION['errorRegister']) ? $_SESSION['errorRegister'] : "" ?>
                    </span>
                <p class='option mt-4'>Already have an account? <a class="text-primary" href='<?php echo 'login.php' ?>'>Login now</a></p>
                </div>
            </div>
            
        </form>
    </div>
</div>

<?php

unset($_SESSION['usernameRegisterError']);
unset($_SESSION['usernameRegister']);
unset($_SESSION['fnameRegisterError']);
unset($_SESSION['fnameRegister']);
unset($_SESSION['lnameRegisterError']);
unset($_SESSION['lnameRegister']);
unset($_SESSION['passwordRegister1Error']);
unset($_SESSION['passwordRegister1']);
unset($_SESSION['passwordRegister2Error']);
unset($_SESSION['passwordRegister2']);
unset($_SESSION['addressRegisterError']);
unset($_SESSION['addressRegister']);
unset($_SESSION['emailRegisterError']);
unset($_SESSION['emailRegister']);
unset($_SESSION['errorRegister']);


?>

<?php 
require_once "views/footer.php";
?>