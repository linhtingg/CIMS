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
        $sql = "INSERT into equipmentregisterform (`userID`, `purpose`, `equipType`, `numberOfEach`, `borrowTime`, `borrowDay`) VALUES (?,?,?,?,?,?)";
        $query = Query::execute(
            $sql,
            [
                $_POST['userID'],
                $_POST['purpose'],
                $_POST['equiptype'],
                $_POST['howmany'],
                $_POST['borrow_time'],
                $_POST['borrow_day']
            ]
        );
        if ($query->rowCount() > 0) {
            Notification::echoToScreen("Form submitted successfully");
            echo "<script>window.location.href ='view-equipments-form.php'</script>";
        } else {
            Notification::echoToScreen("Something Went Wrong. Please try again");
        }
    }

?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Write equipment request</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Check date js -->
        <script type="text/javascript">
            function checkdate() {
                var curDate = new Date();
                var borDate = document.EquipmentForm.borrow_day.value;
                if( (new Date(borDate).getTime() <= new Date(curDate).getTime())){
                    alert('You must enter a date from '+curDate+' forward.');
                    document.EquipmentForm.borrow_day.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Fill in equipment register form</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="header-title m-t-0">Equipment register form</h4>
                                    <div class="p-20">
                                        <form action="#" method="post" name = "EquipmentForm" onsubmit="return checkdate();">
                                            <div class="form-group">
                                                <label for="userID">User ID <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                                <input readonly type="text" class="form-control" required="true" name="userID" value="<?php echo $_SESSION['sscmsaid']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Phone number <small>(Auto Generated)</small><span class="text-danger">*</span></label>
                                                <input readonly type="text" class="form-control" required="true" name="phone" value="<?php echo $_SESSION['sscmsphone']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Purpose <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="What are you planning to do with the equipment" required="true" name="purpose">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Equipment type <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="What kind of equipment do you need" required="true" name="equiptype">
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Number of equipment <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="How many equipment will you need" required="true" name="howmany">
                                            </div>
                                            <div class="form-group">
                                                <label for="borrow_time">Borrow time <span class="text-danger">*</span></label>
                                                <!-- <input class="form-control" list="borrow_times" required="true" name="borrow_time"> -->
                                                <select class="form-control" name="borrow_time" id="borrow_times" required="true">
                                                    <option value="Morning">Morning</option>
                                                    <option value="Afternoon">Afternoon</option>
                                                    <option value="Evening">Evening</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="userID">Borrow day <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" required="true" name="borrow_day">
                                            </div>
                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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