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
        $id = $_GET['delid'];
        $query = EquipmentController::getEquipmentByID($id);        
        if ($query->rowCount() == 0) {
            Notification::echoToScreen('Room ' . $id . ' does not existed!');
        } else {
            Query::execute("DELETE FROM equipment WHERE id= ?", [$id]);
            Notification::echoToScreen("Data deleted");
            echo "<script>window.location.href = 'manage-equipments-schedule.php'</script>";
        }
    }
?>
   <!doctype html>
   <html lang="en">

   <head>
      <title>CIMS | Manage Equipments Schedule</title>
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
                        <h4 class="m-t-0 header-title">Manage Equipments Schedule</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Occupied Time</th>
                                    <th>Occupied Day</th>
                                    <th>Equipment ID</th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = Query::execute("SELECT * FROM equipschedule");
                        $results = $query->fetchAll(PDO::FETCH_OBJ);                        
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) { ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($row->occupiedTime); ?></td>
                                    <td><?php echo htmlentities($row->occupiedDay); ?></td>
                                    <td><?php echo htmlentities($row->equipmentID); ?></td>
                                    <td>
                                        <a href="edit-equipment-schedule.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-equipments-schedule.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>
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