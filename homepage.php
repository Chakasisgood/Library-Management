<?php
session_start();
error_reporting(0);
include('includes/config.php');

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Eastern Visayas State University Carigara Campus | Library Management System</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>
        .logo-container {
            /* padding: 10px; */
            width: 100%; /* Set the width */
            height: 50%; /* Set the height */
            margin-bottom: 50px;
            position: relative;
            display: inline-block;
        }

        /*book panel */
        .book-panel {
            margin-bottom: 20px;
        }

        /*Overlay Button*/
        .btn-overlay {
            position: absolute;
            top: 90%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 50px; 
            background-color: white;
        }

        .btn-overlay.first {
            left: 60%;
        }

        .btn-overlay.second {
            left: 80%;
        }

        .text-container {
            background-color: #b01010;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 50px;
            font-size: 15px;
        }

        div.scroll-container {
            background-color: #;
            overflow: auto;
            white-space: nowrap;
            padding: 10px;
            margin-bottom: 50px;
        }

        div.scroll-container img {
            padding: 10px;
        }

        h2 {
            text-align: center;
            font-weight: 20px;
        }

        p {
            text-align: center ;
        }

    </style>
</head>

<body>

<!-- MENU SECTION START-->
<?php include('includes/header.php'); ?>
<!-- MENU SECTION END-->

<div class="logo-container">
    <!-- Logo Image -->
    <img src="assets/img/evsul.png" class="img-responsive" alt="evsulogo" id="logo">
    <!-- Button Overlays -->

    <div class="overlay">
        <button type="submit" name="login" class="btn btn-info btn-overlay first"><a href="index.php">Learn More</a></button>
        <button type="submit" name="login" class="btn btn-info btn-overlay second"><a href="#books">Discover More</a></button>
    </div>
</div>
<div class="content-wrapper">
    <div class="container">
        <div class="col-md-12 align-items-center justify-content-center">
            <!-- Add your text content here -->
            <div class = "text-container">
                <h2>MISSION </h2>
                <p>Complementing the teaching-learning process by providing effective and efficient library resources services to the students,
                            faculty and staff of the University in support of its philosophy, goals and objectives.</p> <br>
                <h3>OBJECTIVES</h3>
                <p>
                        1.	To provide assistance to the students, faculty, non-teaching personnel and other users in their search for library materials and resources. <br>
                        2.	To expand and update the library holdings such as print, non-print and electronic references. <br>
                        3.	To preserve the library collection through an effective technical system of binding and repair of mutilated books not deemed obsolete. <br>
                        4.	To optimize the utilization of the resources by providing access interventions such as bibliographies and indexes. <br>
                        5.	To develop current awareness of the academe to the EVSU library services.
                </p>
            </div>
        </div>

        <h2>VISIT OUR LIBRARY</h2>
            <p>A HOME OF KNOWLEDGE</p>

            <div class="scroll-container">
            <img src="assets/img/IMG_20240419_091905.jpg" alt="" width="600" height="400">
            <img src="assets/img/IMG_20240419_091910.jpg" alt="" width="600" height="400">
            <img src="assets/img/IMG_20240419_091914.jpg" alt="" width="600" height="400">
            <img src="assets/img/IMG_20240419_091917.jpg" alt="" width="600" height="400">
            <img src="assets/img/IMG_20240419_091941.jpg" alt="" width="600" height="400"/>
            <img src="assets/img/IMG_20240419_092336.jpg" alt="" width="600" height="400"/>
            <img src="assets/img/IMG_20240419_092339.jpg" alt="" width="600" height="400"/>
            <img src="assets/img/IMG_20240419_092345.jpg" alt="" width="600" height="400"/>

            </div>
        
        <!-- Display Books -->
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <!-- Panel Section -->
                <div class="panel panel-default">
                    <div class="panel-heading" id = "books">
                        Discover More with our Books
                    </div>
                    <div class="panel-body">
                        <?php
                        $limit = 6; // Number of books to display per page
                        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
                        $offset = ($page - 1) * $limit; // Offset for fetching books
                        
                        // Fetch books from the database with limit and offset
                        $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.id as bookid, tblbooks.bookImage, tblbooks.isIssued 
                                FROM  tblbooks 
                                JOIN tblcategory ON tblcategory.id = tblbooks.CatId 
                                JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId
                                LIMIT $offset, $limit";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                        ?>
                                <!-- Book Panel -->
                                <div class="col-md-4 book-panel">
                                    <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" width="150" height="200"><br />
                                    <b><?php echo htmlentities($result->BookName); ?></b><br />
                                    <?php echo htmlentities($result->CategoryName); ?><br />
                                    <?php echo htmlentities($result->AuthorName); ?><br />
                                    <?php echo htmlentities($result->ISBNNumber); ?><br />
                                </div>
                        <?php
                            }
                        } else {
                            echo "<div class='alert alert-warning'>No books found.</div>";
                        }

                        // Count total number of books
                        $sql = "SELECT COUNT(*) as total FROM tblbooks";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $row = $query->fetch(PDO::FETCH_ASSOC);
                        $totalBooks = $row['total'];

                        // Calculate total pages
                        $totalPages = ceil($totalBooks / $limit);
                        ?>

                    </div>
                </div>
                    <!-- Pagination -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <ul class="pagination">
                            <?php
                            // Render previous arrow
                            $prevClass = ($page == 1) ? "disabled" : "";
                            $prevPage = ($page > 1) ? $page - 1 : 1;
                            ?>
                            <li class="<?php echo $prevClass; ?>"><a href="?page=<?php echo $prevPage; ?>"><span>&laquo;</span></a></li>

                            <?php
                            // Render pagination links
                            for ($i = 1; $i <= $totalPages; $i++) {
                                $active = ($i == $page) ? "active" : "";
                            ?>
                                <li class="<?php echo $active; ?>"><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php } ?>

                            <?php
                            // Render next arrow
                            $nextClass = ($page == $totalPages) ? "disabled" : "";
                            $nextPage = ($page < $totalPages) ? $page + 1 : $totalPages;
                            ?>
                            <li class="<?php echo $nextClass; ?>"><a href="?page=<?php echo $nextPage; ?>"><span>&raquo;</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER SECTION END-->
<?php include('includes/footer.php'); ?>

<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS  -->
<script src="assets/js/custom.js"></script>
</body>

</html>
