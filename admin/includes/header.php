<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="dashboard.php" class="logo">
                    <span>Classroom Inventory Management System</span>
                </a>
            </div>
            <!-- End Logo container-->
            <div class="menu-extras navbar-topbar">
                <ul class="list-inline float-right mb-0">
                    <li class="list-inline-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                            <!-- item-->
                            <?php
                            $query = Query::execute("SELECT * from tbladmin where schoolID =?", [$_SESSION['sscmsaid']]);
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) { ?>
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Welcome !<?php echo htmlentities($row->fullName); ?></small> </h5>
                                    </div>
                            <?php }
                            } ?>
                            <!-- item-->
                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                            </a>

                            <!-- item-->
                            <a href="change-password.php" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                            </a>

                            <a href="logout.php" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-power"></i> <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div> <!-- end menu-extras -->
            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li>
                        <a href="dashboard.php"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>
                    <!---Rooms---->
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-collection-text"></i> <span> Classrooms </span> </a>
                        <ul class="submenu megamenus">
                            <li>
                                <ul>
                                    <li><a href="add-room.php">Add </a></li>
                                    <li><a href="manage-rooms.php">Manage </a></li>
                                    <li><a href="manage-room-register-students.php">Browse Classroom Requests </a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!---Equipments---->
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-collection-text"></i> <span> Equipments </span> </a>
                        <ul class="submenu megamenus">
                            <li>
                                <ul>
                                    <li><a href="add-equipment.php">Add </a></li>
                                    <li><a href="manage-equipments.php">Manage </a></li>
                                    <li><a href="manage-equipment-register-students.php">Browse Equipment Requests </a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li> <a href="report.php"><i class="zmdi zmdi-collection-text"></i> Report forms </a></li>
                    <!-- Students -->
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-collection-text"></i> <span> Students </span> </a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="manage-students.php">Manage </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!---Noti---->
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-collection-text"></i> <span> Notification </span> </a>
                        <ul class="submenu">
                            <li>
                                <ul>
                                    <li><a href="add-notification.php">Add Notification </a></li>
                                    <li><a href="manage-notifications.php">Manage Notification </a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
                <!-- End navigation menu  -->
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->