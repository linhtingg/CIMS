<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
    <!doctype html>
    <html lang="en">
    <!-- App title -->
    <title> Dashboard</title>
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
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Rooms -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Rooms</h6>
                            <h2 class="m-b-20" data-plugin="counterup"><?php echo htmlentities(RoomController::getAllRooms()->rowCount()); ?></h2>
                            <a href="manage-rooms.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Rooms Available</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(Query::execute("SELECT * from  room where capacity !=0 and usability=1")->rowCount()); ?></span></h2>
                            <a href="manage-rooms.php"><span class="badge badge-success"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Occupied Rooms</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(Query::execute("SELECT * from  room where capacity !=0 and usability=0")->rowCount()); ?></span></h2>
                            <a href="manage-rooms.php"><span class="badge badge-danger"> View Detail </span></a>
                        </div>
                    </div>

                    <!-- Equipments -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Equipments</h6>
                            <h2 class="m-b-20" data-plugin="counterup"><?php echo htmlentities(EquipmentController::getAllEquipments()->rowCount()); ?></h2>
                            <a href="manage-equipments.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Equipments Available</h6>
                            <h2 class="m-b-20" data-plugin="counterup"><?php echo htmlentities(EquipmentController::getAllAvailableEquipments()->rowCount()); ?></h2>
                            <a href="manage-equipments.php"><span class="badge badge-success"> View Detail </span></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Occupied Equipments</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(Query::execute("SELECT * from equipment where id !='1' and usability=0")->rowCount()); ?></span></h2>
                            <a href="manage-equipments.php"><span class="badge badge-danger"> View Detail </span></a>
                        </div>
                    </div>

                    <!-- Room Registered -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Room Requests</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(Query::execute("SELECT * from roomregisterform where reply is null")->rowCount()); ?></span></h2>
                            <a href="manage-room-register-students.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <!-- Equipment Registered -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Equipment Requests</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(Query::execute("SELECT * from equipmentregisterform where reply is null")->rowCount()); ?></span></h2>
                            <a href="manage-equipment-register-students.php"><span class="badge badge-primary"> View Detail </span></a>
                        </div>
                    </div>

                    <!-- Total report -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-desktop float-right"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Recieved Reports</h6>
                            <h2 class="m-b-20"><span data-plugin="counterup"><?php echo htmlentities(Query::execute("SELECT * from reportform")->rowCount()); ?></span></h2>
                            <a href="report.php"><span class="badge badge-primary"> View Detail </span></a>
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
        <script src="assets/js/jquery.app.js"></script>
    </body>

    </html><?php } ?>