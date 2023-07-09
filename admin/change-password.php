<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['change'])) {
        $query = Query::execute(
            "SELECT * FROM tbladmin WHERE schoolID=? and password=?",
            [
                $_SESSION['sscmsaid'],
                $_POST['currentpassword']
            ]
        );
        if ($query->rowCount() > 0) {
            Query::execute(
                "UPDATE tbladmin set password=? where schoolID=?",
                [
                    $_POST['newPass'],
                    $_SESSION['sscmsaid']
                ]
            );
            Notification::echoToScreen("Your password successully changed");
        } else {
            Notification::echoToScreen("Your current password is wrong");
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Change Password</title>

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script type="text/javascript">
            function checkpass() {
                if (document.changepassword.newPass.value != document.changepassword.confirmpassword.value) {
                    alert('New Password and Confirm Password field does not match');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Change Password</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="header-title m-t-0">Change Password</h4>
                                    <div class="p-20">
                                        <form action="#" method="post" name="changepassword" onsubmit="return checkpass();">
                                            <div class="form-group">
                                                <label for="userName">Current Password<span class="text-danger">*</span></label>
                                                <input type="password" name="currentpassword" id="currentpassword" class="form-control" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress">New Password<span class="text-danger">*</span></label>
                                                <input type="password" name="newPass" class="form-control" required="true">
                                            </div>
                                            <div class="form-group">
                                                <label for="pass1">Confirm Password<span class="text-danger">*</span></label>
                                                <input type="password" name="confirmpassword" id="confirmpassword" value="" class="form-control" required="true">
                                            </div>
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name="change">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

    </html><?php }  ?>