<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:header.php');
} else {
    if (isset($_POST['borrow'])) {
        $bookId = $_POST['borrow'];
        $StudentID = $_SESSION['id']; // Assuming you have a session variable for user id
        $StudentName = $_SESSION['name']; // Assuming you have a session variable for student name

        // Check if the book is already issued
        $checkIssued = "SELECT isIssued FROM tblbooks WHERE id = :BookId";
        $checkIssuedStmt = $dbh->prepare($checkIssued);
        $checkIssuedStmt->bindParam(':BookId', $BookId, PDO::PARAM_INT);
        $checkIssuedStmt->execute();
        $isIssued = $checkIssuedStmt->fetchColumn();

        if ($isIssued == '1') {
            $_SESSION['error'] = "Book is already issued.";
            header('location:issued-books.php'); // Redirect to the page where you display issued books
        } else {
            // Issue the book
            $issueBook = "UPDATE tblbooks SET isIssued = '1', IssuedTo = :uStudentID WHERE id = :BookId";
            $issueBookStmt = $dbh->prepare($issueBook);
            $issueBookStmt->bindParam(':StudentID', $StudentID, PDO::PARAM_INT);
            $issueBookStmt->bindParam(':BookId', $BookId, PDO::PARAM_INT);
            $issueBookStmt->execute();

            $_SESSION['success'] = "Book borrowed successfully.";
            header('location:issued-books.php'); // Redirect to the page where you display issued books
        }
    } else {
        $_SESSION['error'] = "Invalid request.";
        header('location:issued-books.php'); // Redirect to the page where you display issued books
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Book</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Borrow Book
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="studentID">Student ID:</label>
                                <input type="text" class="form-control" id="studentID" name="studentID" value="<?php echo $_SESSION['id']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="studentName">Student Name:</label>
                                <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo $_SESSION['name']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="bookId">Book ID:</label>
                                <input type="text" class="form-control" id="bookId" name="bookId" value="<?php echo isset($_POST['borrow']) ? $_POST['borrow'] : ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="borrow">Borrow</button>
                                <a href="issued-books.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
