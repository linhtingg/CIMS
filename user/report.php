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
            "INSERT INTO reportform ( `reportDate`,`roomID`, `userReportID`, `desribeCondition`) VALUES (?,?,?,?)",
            [
                $_POST['reportDate'],
                $_POST['roomID'],
                $_POST['userID'],
                $_POST['desribeCondition'],
            ]
        );
        if ($query->rowCount() > 0) {
            Notification::echoToScreen("Report successfully");
        } else {
            Notification::echoToScreen("Something Went Wrong. Please try again");
        }
        echo "<script>window.location.href ='dashboard.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Report a problem </title>
        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h3> Report a problem</h3>
                            <span> What have you encountered? Please elaborate, we will try to fix them as soon as possible! </span>
                            <div class="card-body card-block">
                                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">User ID <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input readonly type="text" class="form-control" required="true" name="userID" value="<?php echo $_SESSION['sscmsaid']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Report date <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input readonly type="text" class="form-control" required="true" name="reportDate" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                                                                        echo date('d-m-Y h:i:s'); ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Room <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" class="form-control" list="room_id" required="true" name="roomID" placeholder="In which room did the problem occur?">
                                            <datalist id="room_id">
                                                <?php
                                                $results = RoomController::getAllRooms()->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($results as $result) {
                                                    echo "<option value= $result->id </option>";
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Descibe the problem<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" class="form-control" required="true" name="desribeCondition">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <p style="text-align: center;"><button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Submit
                                            </button></p>
                                    </div>
                                </form>
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