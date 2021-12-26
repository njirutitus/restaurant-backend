<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="apple-touch-icon" sizes="76x76" href="./images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="./images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="./css/main.css" />
    <script src="https://unpkg.com/htmx.org@1.4.1"></script>
    <script src="./assets/9ad9a54963.js" crossorigin="anonymous"></script>

    <title>Mama Fish Restaurant: <?php echo $this->title ?></title>
</head>
<body>
<!-- Navigation bar-->
<nav id="navbar" class="bg-dark">
    <a href="/" class="nav-link"><img src="./images/mama-fish.png" alt="Logo" height="45"></a>
    <ul class="list-unstyled expand">
        <li>
            <a href="/" class="nav-link active">Home</a>
        </li>
        <li>
            <a href="/about" class="nav-link">About us</a>
        </li>
        <li><a href="/menu" class="nav-link">Menu</a></li>
        <li>
            <a href="/contact" class="nav-link">Contact</a>
        </li>
    </ul>

<!--    Mobile Menu-->

    <ul class="collapse list-unstyled">
        <li>
            <a href="/" class="nav-link"><i class="fas fa-home"></i></a>
        </li>
        <li>
            <a href="/about" class="nav-link"><i class="fas fa-info"></i></a>
        </li>
        <li>
            <a href="/menu" class="nav-link"><i class="fas fa-bars"></i></a>
        </li>
        <li>
            <a href="/contact" class="nav-link"><i class="fas fa-id-card"></i> </a>
        </li>
    </ul>
    <?php  if (\tn\phpmvc\Application::isGuest()): ?>
    <div>
        <a href="/cart" class="nav-link"> <i class="fas fa-cart-plus"></i><sup id="cartTotal" class="bg-warning text-center rounded p-3">0</sup> cart</a>
        <a href="/login" class="nav--button"> <i class="fas fa-sign-in-alt"></i> Login</a>&nbsp;&nbsp;&nbsp;
<!--        <a href="/register" class="nav-link"> <i class="fas fa-user-plus"></i> Sign Up</a>-->
    </div>
    <?php else: ?>
    <div>
        <a href="/cart" class="nav-link"> <i class="fas fa-cart-plus"></i><sup id="cartTotal" class="bg-warning text-center rounded p-3">0</sup> cart</a>
        <a href="/profile" class="nav-link"> Profile</a>&nbsp;&nbsp;&nbsp;
        <a href="/logout" class="nav-link"><?php echo \tn\phpmvc\Application::$app->user->getDisplayName(); ?> (Logout)</a>
    </div>
    <?php endif; ?>

</nav>

<div class="feedback">
    <?php if (\tn\phpmvc\Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <ion-icon name="checkmark-outline" size="large"></ion-icon>
            <?php echo \tn\phpmvc\Application::$app->session->getFlash('success'); ?>
            <span class="close-icon" id="close"><i class="fas fa-times"></i></span>
        </div>
    <?php endif; ?>
    <?php if (\tn\phpmvc\Application::$app->session->getFlash('error')): ?>
        <div class="alert alert-error">
            <ion-icon name="alert-circle-outline" size="large"></ion-icon>
            <?php echo \tn\phpmvc\Application::$app->session->getFlash('error'); ?>
            <span class="close-icon" id="close"><ion-icon name="close-sharp" size="large" id="close"></ion-icon></span>
        </div>
    <?php endif; ?>
</div>

        {{content}}
        <footer class="container-fluid">
                <div class="social">
                    <a href="" class="nav-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="" class="nav-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="" class="nav-link" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="" class="nav-link" title="Youtube"><i class="fab fa-youtube"></i></a>
                </div>
                <div>
                    <p class="text-center copyright">All right Reserved. &copy;2021 <a class="nav-link" href="/">Mama fish</a></p>
                </div>
        </footer>



<div class="modal-wrapper" id="reservationModal">

    <div class="modal">
        <!-- Header -->
        <div class="modal__header mb-3">
            <h2>Reservation</h2>
            <span class="close-icon closeModal">
                <i class="fas fa-times fa-2x"></i>
            </span>
        </div>

        <!-- Content -->
        <form action="" method="post" id="reservationForm">
            <div class="form-group row mb-3">
                <label class="col-3" for="reserved_by">Full Name</label>
                <input type="text" name="reserved_by" value="" class="form-control col-6" id="reserved_by">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-3" for="date">Date</label>
                <input type="date" name="date" value="" class="form-control col-6" id="date">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-3" for="time">Time</label>
                <input type="time" name="time" value="" class="form-control col-6" id="time">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-3" for="adults">Number of Adults</label>
                <input type="number" name="adults" min="1"  value="1" class="form-control col-6" id="adults">
                <div class="invalid-feedback"></div>
            </div>
            <!-- Footer -->
            <div class="modal__footer">
                <div class="btn btn-warning closeModal">Cancel</div>
                <input type="submit" class="btn btn-primary" id="reserveTable" value="Reserve">
            </div>
        </form>


    </div>
</div>

<!--<script src="./js/menu.js"></script>-->
<!--<script src="./js/main.js"></script>    -->
<script type="module" src="./js/bundle.js"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </body>
</html>
