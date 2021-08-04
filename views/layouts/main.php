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
    <script src="./js/font-awesome.js" crossorigin="anonymous"></script>

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
<!--        <a href="" class="nav-link"> <i class="fas fa-cart-plus"></i></a>-->
        <a href="/login" class="nav--button"> <i class="fas fa-sign-in-alt"></i> Login</a>&nbsp;&nbsp;&nbsp;
<!--        <a href="/register" class="nav-link"> <i class="fas fa-user-plus"></i> Sign Up</a>-->
    </div>
    <?php else: ?>
    <div>
        <a href="" class="nav-link"> <i class="fas fa-cart-plus"></i></a>
        <a href="/profile" class="nav-link"> Profile</a>&nbsp;&nbsp;&nbsp;
        <a href="/logout" class="nav-link">  Welcome <?php echo \tn\phpmvc\Application::$app->user->getDisplayName(); ?> (Logout)</a>
    </div>
    <?php endif; ?>

</nav>

<div class="feedback">
    <?php if (\tn\phpmvc\Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo \tn\phpmvc\Application::$app->session->getFlash('success'); ?>
            <span class="close-icon" id="close"><i class="fas fa-times"></i></span>
        </div>
    <?php endif; ?>
    <?php if (\tn\phpmvc\Application::$app->session->getFlash('error')): ?>
        <div class="alert alert-error">
            <?php echo \tn\phpmvc\Application::$app->session->getFlash('error'); ?>
            <span class="close-icon" id="close"><i class="fas fa-times"></i></span>
        </div>
    <?php endif; ?>
</div>

        {{content}}
        <footer class="container-fluid">
                <div class="social">
                    <a href="" class="nav-link"><i class="fab fa-twitter"></i></a>
                    <a href="" class="nav-link"><i class="fab fa-instagram"></i></a>
                    <a href="" class="nav-link"><i class="fab fa-facebook"></i></a>
                    <a href="" class="nav-link"><i class="fab fa-youtube"></i></a>
                </div>
                <div>
                    <p class="text-center copyright">All right Reserved. &copy;2021 <a class="nav-link" href="/">Mama fish</a></p>
                </div>
        </footer>



<div class="modal-wrapper" id="reservationModal">

    <div class="modal">
        <!-- Header -->
        <div class="modal__header">
            <h2>Reservation</h2>
            <span class="close-icon closeModal">
                <i class="fas fa-times fa-2x"></i>
            </span>
        </div>

        <!-- Content -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group row mb-3">
                <label class="col-3">Full Name</label>
                <input type="text" name="item_title" value="" class="form-control col-6" id="item_title">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-3">Date</label>
                <input type="date" name="price" value="" class="form-control col-6" id="price">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-3">Time</label>
                <input type="time" name="price" value="" class="form-control col-6" id="price">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-3">Number of Adults</label>
                <input type="number" name="item_category" value="" class="form-control col-6" id="item_category">
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

<script src="./js/menu.js"></script>
<script src="./js/main.js"></script>

    </body>
</html>
