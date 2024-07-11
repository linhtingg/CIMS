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
         echo "<script>window.location.href = 'manage-equipments.php'</script>";
      }
   }
?>
   <!doctype html>
   <html lang="en">

   <head>
      <title>CIMS | Manage Equipments</title>
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
                     <h4 class="m-t-0 header-title">Manage Equipments</h4>
                     <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Type</th>
                              <th>Equipment</th>
                              <th>Produced Year</th>
                              <th>Description</th>
                              <th>Last User Used</th>
                              <th>Current Room</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $query = EquipmentController::getAllEquipments();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           $cnt = 1;
                           if ($query->rowCount() > 0) {
                              foreach ($results as $row) { ?>
                                 <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($row->type); ?></td>
                                    <td><?php echo htmlentities($row->id); ?></td>
                                    <td><?php echo htmlentities($row->producedYear); ?></td>
                                    <td><?php echo htmlentities($row->description); ?></td>
                                    <td><?php echo htmlentities($row->lastUserUsed); ?></td>
                                    <td><?php echo htmlentities($row->currentRoom); ?></td>
                                    <td>
                                       <a href="edit-equipment.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-equipments.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>
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