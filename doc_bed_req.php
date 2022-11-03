<!DOCTYPE html>
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
        if(isset($_SESSION['accept'])) {
            if($_SESSION['accept'] == "false") {
                echo "<script> alert('Bed of required category is not available!!!');</script>";
            } else if ($_SESSION['accept'] == "mail sent") {
                echo "<script> alert('Mail sent!!!');</script>";
            } else if ($_SESSION['accept'] == "mail not sent") {
                echo "<script> alert('Mail not sent!!!');</script>";
            } else if ($_SESSION['accept'] != "true") {
                echo "<script> alert('". $_SESSION['accept'] ."');</script>";
            } else {
                // echo "<script> alert('hey ron". $_SESSION['accept'] ."');</script>";
            }
        }
        $_SESSION['accept'] = "true";
        // echo "<script> alert('Bed of required category is not available!!!');</script>";
		$email = $patient_name = $hospt_id = "";
		$login_err = $login_mode = "";
		$done = 0;
        $sql = "select * from doctor where doc_email='".$_SESSION['email']."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc();
            $email = $row['doc_email'];
            $patient_name=$row['doc_name'];
            $hospt_id = $row['hospt_id'];
		} else {
			$login_err = "Invalid Email";
        }
        // for applying filter
        $filter = "all";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $filter = test_input($_POST["filter"]);
		}
		// echo $done;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
        
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
                            <a href="doc_profile.php">
                                <i class="fas fa-chart-bar active"></i>Profile</a>
                        </li>
                        <li>
                            <a href="doc_hospital.php">
                                <i class="fas fa-table"></i>Hospitals</a>
                        </li>
                        <li>
                            <a href="doc_patient.php">
                                <i class="fas fa-calendar-alt"></i>Patients</a>
                        </li>
                        <li class = "active">
                            <a href="doc_bed_req.php">
                                <i class="far fa-check-square"></i>Bed Requests</a>
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
                                            <a class="js-acc-btn" href="#"><?php echo $patient_name; ?></a>
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
                                                        <a href="#"><?php echo $patient_name; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $email; ?></span>
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
                    <h2 class="title-2">Bed Requests</h2>
                </div>
                <br>
                <form method = "POST">
                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="filter">
                                                <option <?php if($filter == "all" or $filter == "") {echo 'selected="selected"';} ?>  value="all">All</option>
                                                <option <?php if($filter == "pending") {echo 'selected="selected"';} ?>value="pending">Pending</option>
                                                <option <?php if($filter == "approved") {echo 'selected="selected"';} ?>value="approved">Approved</option>
                                                <option <?php if($filter == "rejected") {echo 'selected="selected"';} ?>value="rejected">Rejected</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">Apply Filter</button>
                                    </div>
                                </div>
                </form>
                <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Patient Email</th>
                                                <th>Patient Name</th>
                                                <th>Catagory</th>
                                                <th>Transaction ID</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM request_bed where hospt_id = ". $hospt_id ."";
                                            if ($result = $conn->query($sql)) {
                                                if ($result->num_rows >= 1) {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        // featching patient name
                                                        $sql1 = "select patient_name from patient where patient_email = '".$row['patient_email']."'";
                                                        $result1 = $conn->query($sql1);
                                                        if ($result1->num_rows >= 1) {
                                                            while($row1 = $result1->fetch_assoc()) {
                                                                $req_patient_name = $row1['patient_name'];
                                                            }
                                                        }
                                                        if($row['status'] == "pending" and ($filter == "pending" or $filter == "all")) {
                                                            echo "<tr><td>" . $row["req_date"]. "</td><td>" . $row["patient_email"]. "</td><td>" . $req_patient_name. "</td><td>" . $row["category"]. "</td><td>" . $row["transaction_id"]. "</td><td><button onclick='accept(" . $row["req_index"]. ")' class='btn btn-success  d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light'>Accept</button></td><td><button onclick='reject(" . $row["req_index"]. ")' class='btn btn-block btn-danger text-white'>Reject</button></td></tr>";
                                                        } elseif ($row['status'] == "approved" and ($filter == "approved" or $filter == "all")) {
                                                            echo "<tr><td>" . $row["req_date"]. "</td><td>" . $row["patient_email"]. "</td><td>" . $req_patient_name. "</td><td>" . $row["category"]. "</td><td>" . $row["transaction_id"]. "</td><td colspan = 2><span class='status--process'>Approved</span></td></tr>";
                                                        } elseif ($row['status'] == "rejected" and ($filter == "rejected" or $filter == "all")){
                                                            echo "<tr><td>" . $row["req_date"]. "</td><td>" . $row["patient_email"]. "</td><td>" . $req_patient_name. "</td><td>" . $row["category"]. "</td><td>" . $row["transaction_id"]. "</td><td colspan = 2><span class='status--denied'>Rejected</span></td></tr>";
                                                        }
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
        function accept(req_id) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "accept_bed_req.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("req_id=" + req_id);
            window.location.replace("doc_bed_req.php");
        }
        function reject(req_id) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "reject_bed_req.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("req_id=" + req_id);
            window.location.replace("doc_bed_req.php");
        }
    </script>
</body>

</html>
<!-- end document-->
