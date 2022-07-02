<?php 
    try{
        $nav = loadNav();
    }
    catch(PDOException $e) {
        echo "Could not load the nav: " . $e->getMessage();
    }

?>
</div>


<footer class="bg-secondary text-white text-center text-lg-start mt-5">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5 class="text-uppercase">Footer Content</h5>

            
            <p class="lead">
                Here is the footer navigation and all the useful links
            </p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Navigation</h5>

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
                

                <?php foreach($nav as $i => $link): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $link->name?>.php"><?php echo $link->name == 'index' ? "Home" : ucfirst($link->name) ?></a>
                    </li>
                <?php endforeach; ?>


            </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase mb-0">Useful</h5>

            <ul class="list-unstyled">
            <li>
                <a href="docs.pdf" target="_blank" class="text-white">Docs</a>
            </li>
            <li>
                <a href="assets/js/main.js" target="_blank" class="text-white">JS</a>
            </li>
            <li>
                <a href="https://www.linkedin.com/" target="_blank" class="text-white">LinkedIn</a>
            </li>
            <li>
                <a href="https://github.com/" target="_blank" class="text-white">Github</a>
            </li>
            <li>
                <a href="https://pavle-say-what-one-mo-time.lzivadinovic.com/" target="_blank" class="text-white">Portfolio</a>
            </li>
            </ul>
        </div>
        <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <p id="footer-copyright" class="lead">Made by Kibonga</p>
    </div>
    <!-- Copyright -->
</footer>
<script defer src="assets/js/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>