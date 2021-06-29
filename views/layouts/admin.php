<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
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
                <a href=""><i class="fas fa-pizza-slice"></i> Dishes</a>
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
                    onclick="sidebarToggler();"
                    class="mr-auto"
            >
                <i class="fa fa-bars"></i>
            </button>
            <div class="dropdown ml-auto">
                <a href="">Account</a>
                <div class="dropdown-content">
                    <ul>
                        <li>
                            <a href=""><i class="fas fa-user"></i> Profile</a>
                        </li>
                        <br />
                        <li>
                            <a href=""><i class="fas fa-cogs"></i> Change Password</a>
                        </li>
                        <li><hr /></li>
                        <li>
                            <a href=""><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

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

<script src="../js/main.js"></script>
</body>
</html>