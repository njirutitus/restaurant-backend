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
    <script src="./js/font-awesome.js" crossorigin="anonymous"></script>

    <title>Mama Fish Restaurant: Home</title>
</head>
<body>
<!-- Navigation bar-->
<nav id="navbar" class="bg-dark">
    <a href="/" class="bg-dark">Mama Fish</a>
    <ul class="list-unstyled">
        <li>
            <a href="/" class="bg-dark"
            ><i class="fas fa-home"></i> Home /</a
            >
        </li>
        <li>
            <a href="/about" class="bg-dark"
            ><i class="fas fa-info"></i> About us /</a
            >
        </li>
        <li>
            <a href="/menu" class="bg-dark dropdown"
            ><i class="fas fa-bars"></i> Menu /</a
            >
        </li>
        <li>
            <a href="/contact" class="bg-dark">
                <i class="fas fa-id-card"></i> Contact us</a
            >
        </li>
    </ul>
    <?php  if (\tn\phpmvc\Application::isGuest()): ?>
    <div>
        <a href="/login" class="bg-dark"> <i class="fas fa-sign-in-alt"></i> Login</a>&nbsp;&nbsp;&nbsp;
        <a href="/register" class="bg-dark b"> <i class="fas fa-user-plus"></i> Sign Up</a>
    </div>
    <?php else: ?>
    <div>
        <a href="/profile" class="bg-dark"> Profile</a>&nbsp;&nbsp;&nbsp;
        <a href="/register" class="bg-dark b">  Welcome <?php echo \tn\phpmvc\Application::$app->user->getDisplayName(); ?> (Logout)</a>
    </div>
    <?php endif; ?>

</nav>

<!-- Jumbotron -->
<header class="jumbotron row">
    <div class="col-6">
        <h1 class="bg-dark">Mama Fish Restaurant</h1>
        <p>
            We take inspiration from the World's best cuisines, and create a
            unique fusion experience. Our lipsmacking creations will tickle your
            culinary senses!
        </p>
    </div>
    <div class="col-6">
        <a href="/" class="ml-auto btn bg-primary">Make a Reservation</a>
    </div>
</header>

        {{content}}

        <footer class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <h2>links</h2>
                    <ul class="list-unstyled">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About us</a></li>
                        <li><a href="/menu">Menu</a></li>
                        <li><a href="/contact">Contact us</a></li>
                    </ul>
                </div>

                <div class="col-3">
                    <h2>Address</h2>
                    <p>
                        anniversary towers <br />
                        along University way <br />
                        Email:
                        <a href="mailto:info@mamafish.com">info@mamafish.com</a> Tel:
                        <a href="tel:254701234567">254701234567</a>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 align-self-center">
                    <p class="text-center">All right Reserved. &copy;2020 Mama fish</p>
                </div>
            </div>
        </footer>
<script src="./js/menu.js"></script>

    </body>
</html>
