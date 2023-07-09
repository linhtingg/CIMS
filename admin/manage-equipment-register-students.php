<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
   include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
   header('location:logout.php');
} else {
   // Code for deleting form details
   if (isset($_GET['rejectForm'])) {
      Query::execute("UPDATE equipmentregisterform SET reply='1', approve='0' where formid=?", [intval($_GET['rejectForm'])]);
      Notification::echoToScreen("Form rejected");
      echo "<script>window.location.href = 'manage-equipment-register-students.php'</script>";
   }
?>
   <!doctype html>
   <html lang="en">

   <head>
      <title>CIMS | Manage Equipments Registered Student Details</title>

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
                     <h4 class="m-t-0 header-title">Manage Equipment Borrow Requests</h4>
                     <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>User ID</th>
                              <th>Purpose</th>
                              <th>Equip Type</th>
                              <th>Number Of Each</th>
                              <th>Borrow Time</th>
                              <th>Borrow Day</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $query = Query::execute("SELECT * from equipmentregisterform where reply is null");
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           if ($query->rowCount() > 0) {
                              foreach ($results as $row) { ?>
                                 <tr>
                                    <td><?php echo htmlentities($row->formid); ?></td>
                                    <td><?php echo htmlentities($row->userID); ?></td>
                                    <td><?php echo htmlentities($row->purpose); ?></td>
                                    <td><?php echo htmlentities($row->equipType); ?></td>
                                    <td><?php echo htmlentities($row->numberOfEach); ?></td>
                                    <td><?php echo htmlentities($row->borrowTime); ?></td>
                                    <td><?php echo htmlentities($row->borrowDay); ?></td>
                                    <td><a href="equipment-register-student-details.php?formID=<?php echo htmlentities($row->formid); ?>" class="btn btn-primary">Approve / Decline</a></td>
                                 </tr>
                           <?php }
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