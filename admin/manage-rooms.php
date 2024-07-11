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
        if ($query->rowCount() == 0) {
            Notification::echoToScreen("Room " . $roomID . " does not existed!");
        } else {
            $query = Query::execute("SELECT * from equipment where currentRoom  = ?", [$roomID]);
            if ($query->rowCount() == 0) {
                $query = Query::execute("SELECT * from roomregisterform where reply = ?", [$roomID]);
                if ($query->rowCount() == 0) {
                    Query::execute("DELETE FROM room WHERE id=?", [$roomID]);
                    Notification::echoToScreen("Data deleted");
                } else {
                    Notification::echoToScreen("Cannot delete room!");
                }
            } else {
                Notification::echoToScreen("Cannot delete room!");
            }
        }
        echo "<script>window.location.href = 'manage-rooms.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Manage Rooms</title>


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
                            <h4 class="m-t-0 header-title">Manage Rooms</h4>
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#filterName">Find room by name </button>
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#filterUsability">Filter by room's usability </button>
                            <p></p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room</th>
                                        <th>Capacity</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $bindParams = [];
                                    $sql = RoomController::getAllRoomsQuery();
                                    if (isset($_GET['room'])) {
                                        $sql = $sql . " and id = ?";
                                        array_push($bindParams,  $_GET['room']);
                                    }
                                    if (isset($_GET['usability'])) {
                                        $sql = $sql . " and usability = ?";
                                        array_push($bindParams,  $_GET['usability']);
                                    }
                                    $query = Query::execute($sql, $bindParams);
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->id); ?></td>
                                                <td><?php echo htmlentities($row->capacity); ?></td>
                                                <td><?php $room_usability = $row->usability;
                                                    if ($room_usability == 0) : echo "<span style='color:red'>Unusable</span>";
                                                    else : echo "<span style='color:green'>Usable</span>";
                                                    endif; ?></td>
                                                <td><?php echo htmlentities($row->description); ?></td>
                                                <td>
                                                    <a href="edit-room.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-rooms.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>
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
        <form method="get">
            <div id="filterName" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Filter Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        </div>
                        <div class="modal-body">
                            <h5 class="font-16">Room</h5>
                            <p><textarea class="form-control" placeholder="Room ID" required="true" name="room" required></textarea></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form method="get">
            <div id="filterUsability" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Filter Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        </div>
                        <div class="modal-body">
                            <h5 class="font-16">Usability</h5>
                            <select class="form-control" name="usability" required>
                                <option style="color: green;" value="1">Available</option>
                                <option style="color: red;" value="0">Not Available</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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