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
        Query::execute(
            "update tbladmin set fullName=?,email=? where schoolID=?",
            [
                $_POST['adminname'],
                $_POST['email'],
                $_SESSION['sscmsaid']
            ]
        );
        Notification::echoToScreen("Your profile has been updated!");
        echo "<script>window.location.href ='profile.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Profile</title>
        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Profile</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="header-title m-t-0">Admin Profile</h4>
                                    <div class="p-20">
                                        <form action="#" method="post">
                                            <?php
                                            $query = Query::execute("SELECT * from tbladmin where schoolID=?", [$_SESSION['sscmsaid']]);
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) { ?>
                                                    <div class="form-group">
                                                        <label for="userName">Admin Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="adminname" value="<?php echo $row->fullName; ?>" class="form-control" required='true'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emailAddress">User Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="username" value="<?php echo $row->UserName; ?>" class="form-control" readonly="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pass1">Email<span class="text-danger">*</span></label>
                                                        <input type="email" name="email" value="<?php echo $row->email; ?>" class="form-control" required='true'>
                                                    </div>
                                            <?php
                                                }
                                            } ?>
                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">
                                                    Submit
                                                </button>
                                            </div>
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