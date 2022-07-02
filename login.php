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
            <h1 class="display-4">This is the login page</h1>
            <p class="ms-2 lead col-5 py-2" id="hero-paragraf">This is is the subtitle of the login page</p>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <form action="models/login-model.php"  method="POST" class="col-5" id="login-form">
            <div class="mb-3">
                <label class="form-label">Username or email</label>
                <input type="text" class="form-control" name="usernameEmail" id="usernameEmail" value="<?php echo isset($_SESSION['usernameEmail']) ? $_SESSION['usernameEmail'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['usernameEmailError']) ? $_SESSION['usernameEmailError'] : "" ?>
                </span>
            </div>
            <div class="mb-3">
            <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : "" ?>">
                <span class='invalid'>
                    <?php echo isset($_SESSION['passwordError']) ? $_SESSION['passwordError'] : "" ?>
                </span>
            </div>
            <button type="submit" value="login" name='login-user' value="login-user" id="login-user" class='btn btn-secondary'>Login</button><br>
            <span class='invalid'>
                    <?php echo isset($_SESSION['errorLogin']) ? $_SESSION['errorLogin'] : "" ?>
                </span>
            <p class='option mt-4'>Don't have an account? <a class="text-primary" href='<?php echo 'register.php' ?>'>Register now</a></p>
        </form>
    </div>
</div>



<?php 

unset($_SESSION['usernameEmailError']);
unset($_SESSION['passwordError']);
unset($_SESSION['usernameEmail']);
unset($_SESSION['password']);
unset($_SESSION['errorLogin']);

?>

<?php 
require_once "views/footer.php";
?>