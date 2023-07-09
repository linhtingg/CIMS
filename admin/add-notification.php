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
        $query = Query::execute(
            "INSERT INTO notification (notiContent, valid_til) VALUES (?,?);",
            [
                $_POST['content'],
                $_POST['date']
            ]
        );
        if ($query->rowCount() > 0) {
            Notification::echoToScreen("Notification added successfully");
        } else {
            Notification::echoToScreen("Failed to add notification");
        }
        echo "<script>window.location.href = 'manage-notifications.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add Notification</title>
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
                            <h4 class="m-t-0 header-title">Add Notification</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Content</label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="content" placeholder="Enter Room Description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Expired Date</label>
                                    <div class="col-10">
                                        <input class="form-control" type="date" id="date" name="date" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Add Notification</button>
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