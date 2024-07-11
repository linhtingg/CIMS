<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['delid'])) {
        $roomID = $_GET['delid'];
        $query = RoomController::getRoomByID($roomID);
        $sql = "SELECT roomID, occupiedTime, occupiedDay FROM roomschedule";

        if ($query->rowCount() == 0) {
            Notification::echoToScreen("Room " . $roomID . " does not existed!");
        } else {
            $query = Query::execute("SELECT * from equipment where currentRoom  = ?", [$roomID]);
            if ($query->rowCount() == 0) {
                $query = Query::execute("SELECT * from roomregisterform where reply = ?", [$roomID]);
                if ($query->rowCount() == 0) {
                    Query::execute("DELETE FROM room WHERE roomID=?", [$roomID]);
                    Notification::echoToScreen("Data deleted");
                } else {
                    Notification::echoToScreen("Cannot delete room!");
                }
            } else {
                Notification::echoToScreen("Cannot delete room!");
            }
        }
        echo "<script>window.location.href = 'manage-rooms-schedule.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Manage Rooms Schedule</title>


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
                            <h4 class="m-t-0 header-title">Manage Rooms Schedule</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Occupied Time</th>
                                        <th>Occupied Day</th>
                                        <th>Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $bindParams = [];
                                    $sql = RoomController::getAllRoomsQuery();
                                    $sql = "SELECT roomID, occupiedTime, occupiedDay FROM roomschedule";
                                    if (isset($_GET['room'])) {
                                        $sql = $sql . " and roomID = ?";
                                        array_push($bindParams,  $_GET['room']);
                                    }
                                    $query = Query::execute($sql, $bindParams);
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->occupiedTime); ?></td>
                                                <td><?php echo htmlentities($row->occupiedDay); ?></td>
                                                <td><?php echo htmlentities($row->roomID); ?></td>
                                                <td>
                                                    <a href="edit-room-schedule.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-rooms-schedule.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>
                                                </td>
                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </tbody>
                            </table>
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