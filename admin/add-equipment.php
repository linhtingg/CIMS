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
        $equipment = $_POST['equipment'];
        $rowCount = EquipmentController::getEquipmentByID($equipment)->rowCount();
        if ($rowCount == 0) {
            $sql = "INSERT INTO equipment VALUES (?,?,?,?,?,?,?,?,1)";
            $query = Query::execute(
                $sql,
                [
                    $_POST['type'],
                    $equipment,
                    $_POST['totalUsedTime'],
                    $_POST['producedYear'],
                    $_POST['description'],
                    $_POST['lastUserUsed'],
                    $_POST['currentRoom'],
                    $_POST['avaiableTimes']
                ]
            );
            if ($query->rowCount() > 0) {
                Notification::echoToScreen('Equipment added successfully');
                echo "<script>window.location.href = 'manage-equipments.php'</script>";
            } else {
                Notification::echoToScreen('Failed to add equipment');
            }
        } else {
            Notification::echoToScreen("Equipment " . $equipment . " existed! Cannot add equipment!");
            echo "<script>window.location.href = 'manage-equipments.php'</script>";
        }
    }
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add Equipment</title>
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
                            <h4 class="m-t-0 header-title">Add Equipment</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Equipment</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment Name" required>
                                        <span id="equipment-availability-status"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Type</label>
                                    <div class="col-10">
                                        <select class="form-control" name="type" required>
                                            <option>Microphone</option>
                                            <option>Oscilloscope</option>
                                            <option>Biến áp</option>
                                            <option>Bảng mạch</option>
                                            <option>Đầu chuyển đổi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Total Used Time</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="totalUsedTime" placeholder="Enter Total Used Time" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Produced Year</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="producedYear" placeholder="Enter Produced Year" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Description</label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="description" placeholder="Enter Equipment Description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Last User Used</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="lastUserUsed" placeholder="Enter Last User Used" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Current Room</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="currentRoom" placeholder="Enter Current Room" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Avaiable Time</label>
                                    <div class="col-10">
                                        <select class="form-control" name="avaiableTimes" multiple required>
                                            <option value="Morning">Morning</option>
                                            <option value="Afternoon">Afternoon</option>
                                            <option value="Evening">Evening</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit">Add Equipment</button>
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