<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['rejectForm'])) {
        Query::execute("UPDATE roomregisterform SET approved=0 where formid=?", [intval($_GET['rejectForm'])]);
        Notification::echoToScreen("Form rejected");
        echo "<script>window.location.href = 'manage-room-register-students.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Manage Rooms Registered Student Details</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Manage Room Borrow Requests</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Purpose</th>
                                        <th>Number Of Room</th>
                                        <th>Number Of People</th>
                                        <th>Borrow Time</th>
                                        <th>Borrow Day</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = Query::execute("SELECT * from roomregisterform where approved is NULL");
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($row->formid); ?></td>
                                                <td><?php echo htmlentities($row->userID); ?></td>
                                                <td><?php echo htmlentities($row->purpose); ?></td>
                                                <td><?php echo htmlentities($row->numberOfRoom); ?></td>
                                                <td><?php echo htmlentities($row->numberOfPeople); ?></td>
                                                <td><?php echo htmlentities($row->borrowTime); ?></td>
                                                <td><?php echo htmlentities($row->borrowDay); ?></td>
                                                <td><a href="room-register-student-details.php?stdid=<?php echo htmlentities($row->formid); ?>" class="btn btn-primary">Approve / Decline</a></td>
                                            </tr><?php }
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