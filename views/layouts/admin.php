<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
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

    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/admin.css" />

    <script src="../js/font-awesome.js" crossorigin="anonymous"></script>

    <title>Mama Fish Restaurant Administration</title>
</head>
<body>
<div class="wrapper">
    <!-- side Navigation bar-->
    <aside class="sidebar" id="sidebar">
        <a href="">Mama Fish Admin</a> <br> <a href="/" target="_blank">View Site &nbsp; <i class="fas fa-external-link-square-alt"></i></a>
        <hr />
        <ul class="list-unstyled">
            <li>
                <a href="/admin"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li>
                <a href="/admin_dishes"><i class="fas fa-pizza-slice"></i> Dishes</a>
            </li>
            <li>
                <a href=""><i class="fas fa-user-friends"></i> Users</a>
            </li>
            <li>
                <a href=""><i class="far fa-comments"></i> Comments</a>
            </li>
        </ul>
    </aside>
    <!-- Content-Wrapper -->
    <main class="content-wrapper" id="main-content">
        <!-- Top bar -->
        <nav id="navbar" class="topbar">
            <button
                    id="sidebarToggleTop"
                    class="mr-auto"
            >
                <i class="fa fa-bars"></i>
            </button>
            <div class="dropdown ml-auto">
                <span class="link">Account <i class="fas fa-chevron-circle-down"></i> <!--<ion-icon name="chevron-down-outline" size="medium"></ion-icon> --></span>
                <div class="dropdown-content">
                    <ul>
                        <li>
                            <a href=""><i class="fas fa-user"></i> Profile</a>
                        </li>
                        <br>
                        <li>
                            <a href=""><i class="fas fa-cogs"></i> Change Password</a>
                        </li>
                        <li><hr /></li>
                        <li>
                            <a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
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

        <!-- Content area -->
        <article class="content">

{{content}}
        </article>

    <!-- Footer -->
    <footer class="footer">
        <div class="align-self-center">
            <p class="text-center">All right Reserved. &copy;2020 Mama fish</p>
        </div>
    </footer>
    </main>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../js/main.js"></script>
</body>
</html>