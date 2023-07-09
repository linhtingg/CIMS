<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    // Code for deleting request from list
    if (isset($_GET['delid'])) {
        $formid = intval($_GET['delid']);
        $query = Query::execute("SELECT formid FROM equipmentregisterform WHERE formid=? and approved = 1 ", [$formid]);
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            Notification::echoToScreen("Can not delete! The request has already been approve!");
        } else {
            Query::execute("DELETE from equipmentregisterform where formid=?", [$formid]);
            Notification::echoToScreen('Request deleted');
            echo "<script>window.location.href = 'view-equipments-form.php'</script>";
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>View list of equipments</title>
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
                            <h4 class="m-t-0 header-title">List of Equipments</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Purpose</th>
                                        <th>Equipment Type</th>
                                        <th>Number of Each</th>
                                        <th>Borrow Day</th>
                                        <th>Borrow Time</th>
                                        <th>Approved</th>
                                        <th>Reply</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $aid = $_SESSION['sscmsaid'];
                                    $sql = "SELECT * from `equipmentregisterform` where userID = ?";
                                    $query = Query::execute($sql, [$aid]);
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->userID); ?></td>
                                                <td><?php echo htmlentities($row->purpose); ?></td>
                                                <td><?php echo htmlentities($row->equipType); ?></td>
                                                <td><?php echo htmlentities($row->numberOfEach); ?></td>
                                                <td><?php echo htmlentities($row->borrowDay); ?></td>
                                                <td><?php echo htmlentities($row->borrowTime); ?></td>
                                                <td><?php $approved = $row->approved;
                                                    if ($approved == '0') {
                                                        echo "<span style='color:red'>Decline</span>";
                                                    } elseif ($approved == '1') {
                                                        echo "<span style='color: green'>Approve</span>";
                                                    } else {
                                                        echo "<span style='color:gray'>In process</span>";
                                                    }
                                                    ?></td>
                                                <td><?php $reply = $row->reply;
                                                    if ($reply == 1) {
                                                        echo "<span style='color:red'>Decline</span>";
                                                    } elseif ($reply === null) {
                                                        echo "<span style='color: gray'>In process</span>";
                                                    } else {
                                                        echo htmlentities($row->reply);
                                                    }
                                                    ?></td>
                                                <td> <a href="view-equipments-form.php?delid= <?php echo ($row->formid); ?>" onclick="return confirm('Do you really want to delete ?');" class="btn btn-danger">Delete</a>
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