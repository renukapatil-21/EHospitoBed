<!patientTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>HospitoBed</title>

    <!-- Fontfaces CSS-->
    <link href="bootstrap_templete/css/font-face.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="bootstrap_templete/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="bootstrap_templete/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="bootstrap_templete/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="bootstrap_templete/css/theme.css" rel="stylesheet" media="all">
    <style>
	.error {
		color:red;
	}
	</style>
</head>

<body class="animsition">
<?php
		require "connection.php";
		session_start();
		$login_email =$login_patient_name= "";
		$login_err = $login_mode = "";
		$done = 0;
        $sql = "select * from patient where patient_email='".$_SESSION['email']."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc();
            $login_email = $row['patient_email'];
            $login_patient_name=$row['patient_name'];
		} else {
			$login_err = "Invalid Email";
		}
        // for viewing patient
        
	?>
    <div class="page-wrapper">
        
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <div class="overview-wrap">
                        <h2 class="title-1">HospitoBed</h2>
                    </div>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="patient_profile.php">
                                <i class="fas fa-chart-bar active"></i>Profile</a>
                        </li>
                        <li class = "active">
                            <a href="patient_doctors.php">
                                <i class="fas fa-calendar-alt"></i>Doctors</a>
                        </li>
                        <li>
                            <a href="patient_hospital.php">
                                <i class="far fa-check-square"></i>Request Bed</a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap"  style="float:right">
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $login_patient_name; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="profile_bot.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $login_patient_name; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $login_email; ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
            <div class="section__content section__content--p30">
            <div class="overview-wrap">
                            <h2 class="title-2">Doctors</h2>
                        </div>
                <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone no</th>
                                                <th>Hospt Id</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT doc_name, doc_email, gender, bdate, address, phoneno, hospt_id FROM doctor";
                                            if ($result = $conn->query($sql)) {
                                                if ($result->num_rows >= 1) {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<tr><td>" . $row["doc_name"]. "</td><td>" . $row["doc_email"]. "</td><td>" . $row["phoneno"]. "</td><td>" . $row["hospt_id"]. "</td><td><button onclick='view(\"patient_doctor_view_email\", \"" . $row["doc_email"]. "\", \"patient_doctor_view.php\")' class='btn btn-block btn-danger text-white'>View</button></td></tr>";
                                                    }
                                                }
                                            } else {
                                                echo "Query Failed";
                                            } 
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        </div>
            </div>
		</div>
	</section>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="bootstrap_templete/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="bootstrap_templete/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="bootstrap_templete/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="bootstrap_templete/vendor/slick/slick.min.js">
    </script>
    <script src="bootstrap_templete/vendor/wow/wow.min.js"></script>
    <script src="bootstrap_templete/vendor/animsition/animsition.min.js"></script>
    <script src="bootstrap_templete/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="bootstrap_templete/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="bootstrap_templete/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="bootstrap_templete/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="bootstrap_templete/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="bootstrap_templete/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="bootstrap_templete/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="bootstrap_templete/js/main.js"></script>
    <script> 
        function view(name, value, loc) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "set_session.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("session_name=" + name + "&session_value=" + value);
            window.location.replace(loc);
        }
        function add_dept_handler() {
            window.location.replace("ad_add_patient.php");
        }
    </script>
</body>

</html>
<!-- end patientument-->
