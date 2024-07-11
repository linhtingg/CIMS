<?php
session_start();
error_reporting(0);
foreach (glob("../helper/*.php") as $file) {
    include $file;
}
if (strlen($_SESSION['sscmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $equipment = $_POST['equipment'];
        $rowCount = EquipmentController::getEquipmentByID($equipment)->rowCount();
        if ($rowCount == 0) {
            $sql = "INSERT INTO `equipment` (`type`, `id`, `totalUsedTime`, `producedYear`, `description`, `currentRoom`) VALUES (?,?,?,?,?,?)";
            $query = Query::execute(
                $sql,
                [
                    $_POST['equipType'],
                    $equipment,
                    $_POST['totalUsedTime'],
                    $_POST['producedYear'],
                    $_POST['description'],
                    $_POST['currentRoom'],
                ]
            );
            if ($query->rowCount() > 0) {
                Notification::echoToScreen('Equipment added successfully');
                echo "<script>window.location.href = 'manage-equipments.php'</script>";
            } else {
                Notification::echoToScreen('Failed to add equipment');
                echo "<script>window.location.href = 'add-equipment.php'</script>";
            }
        } else {
            Notification::echoToScreen("Equipment " . $equipment . " existed! Cannot add equipment!");
            echo "<script>window.location.href = 'add-equipment.php'</script>";
        }
    }
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>CIMS | Add Equipment</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Add Equipment</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Equipment ID</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="equipment" placeholder="Enter Equipment ID" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Equipment Type</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" list="equipType" required name="equipType" placeholder="Equipment type" >
                                            <datalist id="equipType">
                                                <?php
                                                $results = EquipmentController::getAllTypeEquipments()->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($results as $result) {
                                                    echo "<option value= '$result->type'> </option>";
                                                }
                                                ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Total Used Time</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="totalUsedTime" placeholder="Enter Total Used Time">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Produced Year</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="producedYear" placeholder="Enter Produced Year" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Description</label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="description" placeholder="Enter Equipment Description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Current Room</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" list="currentRoom" name="currentRoom" placeholder="Enter Current Room">
                                        <datalist id="currentRoom">
                                            <?php
                                            $results = RoomController::getAllRooms()->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($results as $result) {
                                                echo "<option value= '$result->id'> </option>";
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit">Add Equipment</button>
                                    </div>
                                </div>
                            </form>
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

    </html>
<?php } ?>