<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HURAM Library Management System | Issued Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>
        /* Center the search bar */
        .search-container {
            text-align: left;
            margin-bottom: 20px;        
        }
        .slider {
            text-align: left;
            margin-bottom: 20px; 
            margin-top: 50px;
            max-width: 100%;

        }
        .logo-container {
            padding: 10px;
            background-color: #d30707;
            max-width: 100%; /* Adjust the width as needed */
            margin: 0 auto; /* Center the logo-container horizontally */
            min-height: 40%;
        }
        .category-container {
            margin-top: 20px;
            padding: 10px;
            background-color: #d30707;
            border: 1px solid #ddd;
            color: white;
            align-items: center;
        }
        .category-container h4 {
            margin-top: 0;
        }
        .category-list {
            list-style-type: none;
            padding: 0;
        }
        .category-list li {
            margin-bottom: 10px;
        }
        .category-list li a {
            text-decoration: none;
            color: white;
        }
        .category-list li a:hover {
            color: white;
        }
        .category-list li i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="logo-container">
        <img src="assets/img/cc.png" class="img-responsive" alt="evsulogo" id = "logo">
    </div>
    <div class="content-wrapper">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                    <!-- Panel Section -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Books
                        </div>
                        <div class="panel-body">
                            <form action="borrow.php" method="post">
                                <?php
                                // Check if search query is set
                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $search = $_GET['search'];
                                    // Store search query in session variable
                                    $_SESSION['search'] = $search;
                                    $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued 
                                            FROM  tblbooks 
                                            JOIN tblcategory ON tblcategory.id=tblbooks.CatId 
                                            JOIN tblauthors ON tblauthors.id=tblbooks.AuthorId
                                            WHERE tblbooks.BookName LIKE '%$search%' OR tblcategory.CategoryName LIKE '%$search%' OR tblauthors.AuthorName LIKE '%$search%' OR tblbooks.ISBNNumber LIKE '%$search%'";
                                } elseif (isset($_GET['category']) && !empty($_GET['category'])) {
                                    $category = $_GET['category'];
                                    $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued 
                                            FROM  tblbooks 
                                            JOIN tblcategory ON tblcategory.id=tblbooks.CatId 
                                            JOIN tblauthors ON tblauthors.id=tblbooks.AuthorId
                                            WHERE tblcategory.CategoryName = '$category'";
                                } else {
                                    $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued 
                                            FROM  tblbooks 
                                            JOIN tblcategory ON tblcategory.id=tblbooks.CatId 
                                            JOIN tblauthors ON tblauthors.id=tblbooks.AuthorId";
                                }
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                        <div class="col-md-4" style="height:400px;">
                                            <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" width="150" height="200">
                                            <br /><b><?php echo htmlentities($result->BookName); ?></b><br />
                                            <?php echo htmlentities($result->CategoryName); ?><br />
                                            <?php echo htmlentities($result->AuthorName); ?><br />
                                            <?php echo htmlentities($result->ISBNNumber); ?><br />
                                            <?php if ($result->isIssued == '1') : ?>
                                                <p style="color:red;">Book Already issued</p>
                                            <?php endif; ?>
                                        </div>
                                <?php
                                        $cnt = $cnt + 1;
                                    }
                                } ?>
                            </form>
                        </div>
                    </div>
                    <!-- End Panel Section -->
                </div>
                <div class="col-sm-6">
                    <!-- Search Container -->
                    <div class="search-container">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for books..." name="search" value="<?php echo $search; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- End Search Container -->
                    <!-- Category Container -->
                    <div class="category-container">
                        <h4>Categories</h4>
                        <ul class="category-list">
                            <?php
                            $categorySql = "SELECT DISTINCT CategoryName FROM tblcategory";
                            $categoryQuery = $dbh->prepare($categorySql);
                            $categoryQuery->execute();
                            $categories = $categoryQuery->fetchAll(PDO::FETCH_COLUMN);
                            foreach ($categories as $category) {
                            ?>
                                <li><a href="?category=<?php echo urlencode($category); ?>"><i class="fa fa-book"></i><?php echo htmlentities($category); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- End Category Container -->
                    <div class = "slider">
<!-- Slider---->
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="assets/img/IMG_20240419_091905.jpg" alt="" />
                        </div>
                        <div class="item">
                            <img src="assets/img/IMG_20240419_091910.jpg" alt="" />
                        </div>
                        <div class="item">
                            <img src="assets/img/IMG_20240419_091914.jpg" alt="" /> 
                        </div>
                    </div>
                    <!-- INDICATORS -->
                     <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol>
                    <!--PREVIUS-NEXT BUTTONS-->
                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
              </div>
             </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>

</html>

<?php } ?>
