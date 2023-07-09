<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['stdid'])) {
        Query::execute("DELETE from tbluser where schoolID=?", [$_GET['stdid']]);
        Notification::echoToScreen("Student deleted");
        echo "<script>window.location.href = 'manage-students.php'</script>";
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Manage Students</title>
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
                            <h4 class="m-t-0 header-title">Manage Student Details</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>School ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = Query::execute("SELECT * from tbluser");
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->email); ?></td>
                                                <td><?php echo htmlentities($row->fullName); ?></td>
                                                <td><?php echo htmlentities($row->phonenumber); ?></td>
                                                <td><?php echo htmlentities($row->schoolID); ?></td>
                                                <td>
                                                    <a href="manage-students.php?stdid=<?php echo ($row->schoolID); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger">Delete</a>
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