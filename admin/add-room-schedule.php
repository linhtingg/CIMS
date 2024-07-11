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
        $roomname = $_POST['roomname'];
        if (RoomController::getRoomByID($roomname)->rowCount() == 0) {
            $query = Query::execute(
                "INSERT INTO room (id, occupiedTime, occupiedDay, roomID, avaiableTime) VALUES (?,?,?,?,?)",
                [
                    $roomname,
                    $_POST['occupiedTime'],
                    $_POST['occupiedDay'],
                    $_POST['roomID'],
                    $_POST['availableTimes']
                ]
            );
            if ($query->rowCount() > 0) {
                Notification::echoToScreen("Room added successfully");
            } else {
                Notification::echoToScreen("Failed to add room");
            }
        } else {
            Notification::echoToScreen("Room " . $roomname . " existed! Cannot add room");
        }
        echo "<script>window.location.href = 'manage-rooms.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add Room Schedule</title>
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
                            <h4 class="m-t-0 header-title">Add Room Schedule</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Occupied Time</label>
                                    <div class="col-10">
                                        <select class="form-control" name="occupiedTime" required>
                                            <option>Morning</option>
                                            <option>Afternoon</option>
                                            <option>Evening</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Occupied Day</label>
                                    <div class="col-10">
                                    <input class="form-control" type="date" id="occupiedDate" name="occupiedDate" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Room Name</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="roomname" placeholder="Enter Room Name" required>
                                        <span id="room-availability-status"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Add Room Schedule</button>
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
