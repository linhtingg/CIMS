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
      $query = Query::execute("SELECT * FROM notification WHERE id= ?", [$id]);
      if ($query->rowCount() == 0) {
         Notification::echoToScreen("Notification ID " . $id . " does not existed!");
      } else {
         Query::execute("DELETE FROM notification WHERE id= ?", [$id]);
         Notification::echoToScreen("Notification deleted");
         echo "<script>window.location.href = 'manage-notifications.php'</script>";
      }
   }
?>
   <!doctype html>
   <html lang="en">

   <head>
      <title>CIMS | Manage Notifications</title>
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
                     <h4 class="m-t-0 header-title">Manage Notifications</h4>
                     <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Content</th>
                              <th>Expired</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $query = Query::execute("SELECT * from notification");
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           if ($query->rowCount() > 0) {
                              foreach ($results as $row) { ?>
                                 <tr>
                                    <td><?php echo htmlentities($row->id); ?></td>
                                    <td><?php echo htmlentities($row->notiContent); ?></td>
                                    <td><?php echo htmlentities($row->valid_til); ?></td>
                                    <td>
                                       <a href="edit-notification.php?did=<?php echo htmlentities($row->id); ?>" class="btn btn-primary">Edit </a> | <a href="manage-notifications.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</i></a>
                                    </td>
                                 </tr>
                           <?php }
                           } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div> <!-- End wrapper -->
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