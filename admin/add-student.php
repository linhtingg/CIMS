<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $userID = $_POST['userID'];
        if (UserController::getUserID($userID)->rowCount() == 0) {
            $query = Query::execute(
                "INSERT INTO tbluser (`email`, `pass`, `isType`, `fullName`, `schoolID`) VALUES (?,?,?,?,?)",
                [
                    $_POST['email'],
                    md5($userID),
                    $_POST['isType'],
                    $_POST['fullName'],
                    $userID,
                ]
            );
            if ($query->rowCount() > 0) {
                Notification::echoToScreen("User added successfully");
            } else {
                Notification::echoToScreen("Failed to add user");
            }
        } else {
            Notification::echoToScreen("User " . $userID . " existed! Cannot add user");
            echo "<script>window.location.href = 'add-student.php'</script>";
        }
        echo "<script>window.location.href = 'manage-students.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add User</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Add User</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">User ID</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="userID" placeholder="Enter User's ID Number" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Full Name</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="fullName" placeholder="Enter User's Full Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Type</label>
                                    <div class="col-10">
                                        <select class="form-control" name="isType" required placeholder="Student or Lecturer">
                                            <option value="Student">Student</option>
                                            <option value="Lecturer">Lecturer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">School Email</label>
                                    <div class="col-10">
                                        <input type="email" class="form-control" name="email" placeholder="Enter User's Email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Add User</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>

    </html>
<?php } ?>