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

    <head>
        <title>View list of rooms</title>
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
                            <h4 class="m-t-0 header-title">List of Room</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room number</th>
                                        <th>Capacity</th>
                                        <th>Usability</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = RoomController::getAllRooms();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->id); ?></td>
                                                <td><?php echo htmlentities($row->capacity); ?></td>
                                                <td><?php $usability = $row->usability;
                                                    if ($usability == 0) : echo "<span style='color:red'>Unavailable</span>";
                                                    else : echo "<span style='color:green'>Available</span>";
                                                    endif; ?></td>
                                                <td><?php echo htmlentities($row->description); ?></td>
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