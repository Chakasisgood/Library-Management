<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 1) {
} else {
    if (isset($_POST['issue'])) {
        $studentid = strtoupper($_POST['studentid']);
        $bookid = $_POST['bookid'];
        $penaltyfee = $_POST['penaltyfee'];
        $returndate = $_POST['returndate'];
        $isissued = 1;
        $sql = "INSERT INTO tblissuedbookdetails(StudentID,BookId,fine,ReturnDate) VALUES(:studentid,:bookid,:penaltyfee,:returndate);
                UPDATE tblbooks SET isIssued=:isissued WHERE id=:bookid;";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->bindParam(':penaltyfee', $penaltyfee, PDO::PARAM_STR);
        $query->bindParam(':returndate', $returndate, PDO::PARAM_STR);
        $query->bindParam(':isissued', $isissued, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book issued successfully";
            header('location:manage-issued-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-issued-books.php');
        }
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Issue a new Book</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>
            // function for get student name
            function getstudent() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_student.php",
                    data: 'studentid=' + $("#studentid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_student_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }

            //function for book details
            function getbook() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_book.php",
                    data: 'bookid=' + $("#bookid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_book_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
        <style type="text/css">
            .others {
                color: red;
            }
        </style>
    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Borrow Books</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Borrow Books
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Student ID<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <span id="get_student_name" style="font-size:16px;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>ISBN Number or Book Title<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()" required="required" />
                                    </div>
                                    <div class="form-group" id="get_book_name"></div>
                                    <div class="form-group">
                                        <label>Penalty Fee<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="fine" id="fine" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Return Date<span style="color:red;">*</span></label>
                                        <input class="form-control" type="date" name="returndate" id="returndate" required="required" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity<span style="color:red;">*</span></label>
                                            <input class="form-control" type="number" name="price" id="quantity" required="required" autocomplete="off" onBlur="checkisbnAvailability()" />

                                        </div>
                                    </div>
                                    <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book</button>
                                </form>
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
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>