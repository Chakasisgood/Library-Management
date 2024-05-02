<?php if ($_SESSION['login']) {
?>
    <!-- <div class="navbar navbar-inverse set-radius-zero">
        <div class="divlogo">
            <img class="logo" src="assets/img/logo.gif" />
            <div id="nav" class="navbar-header">
                <p>HURAM: Library Management System</p>
            </div>
        </div>
    </div> -->
<?php } ?>
<?php if ($_SESSION['login']) {
?>
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-left"> <!-- Changed navbar-right to navbar-left -->
                            <!-- <li><a href="homepage.php" class="menu-top-active">Homepage</a></li> -->
                            <li><a href="listed-books.php">List of Books</a></li>
                            <!-- <li><a href="borrow-book.php">Borrow Books</a></li> -->
                            <li><a href="issued-books.php">Issued Books</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">My Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else { ?>
    <section class="menu-section">
        <div class="container">
            <!-- <p><img src="assets/img/books.png" alt="books" style= "width:100px;height;100px;">HURAM Library Management System</p> -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-left"> <!-- Changed navbar-right to navbar-left -->
                            <li><a href="homepage.php">Home</a></li>
                            <li><a href="index.php">Student Login</a></li>
                            <!-- <li><a href="signup.php">User Signup</a></li>-->
                            <li><a href="adminlogin.php">Admin Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php } ?>