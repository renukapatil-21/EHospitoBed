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
		$login_email =$login_patient_name= "";
		$login_err = $login_mode = "";
		$done = 0;
        $sql = "select * from admin where ad_email='".$_SESSION['email']."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc();
            $login_email = $row['ad_email'];
            $login_patient_name=$row['ad_name'];
		} else {
			$login_err = "Invalid Email";
		}
        // for viewing doctor
        $email = $password  =$patient_name=$Bdate=$Gender=$PhoneNo=$Address= $hospt_id = "";
		$email_err = $password_err =$patient_name_err=$Bdate_err=$PhoneNo_err=$Address_err="";
		$login_err = $login_mode = "";
		$done = 0;
        $sql = "select * from doctor where doc_email='".$_SESSION['ad_doctor_view_email']."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc();
            $email = $row['doc_email'];
            $password = $row['password'];
            $patient_name = $row['doc_name'];
            $Bdate = $row['bdate'];
            $Gender = $row['gender'];
            $PhoneNo = $row['phoneno'];
            $Address = $row['address'];
            $hospt_id = $row['hospt_id'];
		} else {
			$login_err = "Invalid Email";
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["password"])) {
			  $password_err = "Password is required";
			} else {
			  $password = test_input($_POST["password"]);
			  $password_err = "";
			  $done = $done + 1;
			}
			
			if (empty($_POST["patient_name"])) {
				$patient_name_err = "Name is required";
			  } else {
				$patient_name = test_input($_POST["patient_name"]);
				$patient_name_err = "";
				$done = $done + 1;
			  }
			  if (empty($_POST["Address"])) {
				$Address_err = "Address is required";
			  } else {
				$Address = test_input($_POST["Address"]);
				$Address_err = "";
				$done = $done + 1;
			  }
			  $Gender = test_input($_POST["Gender"]);
			
			  if (empty($_POST["PhoneNo"])) {
				$PhoneNo_err = "PhoneNo is required";
			  } else {
				$PhoneNo = test_input($_POST["PhoneNo"]);
				$PhoneNo_err = "";
				$done = $done + 1;
			  }
			  if (empty($_POST["Bdate"])) {
				$Bdate_err = "Bdate is required";
			  } else {
				$Bdate = test_input($_POST["Bdate"]);
				$Bdate_err = "";
				$done = $done + 1;
              }
              $hospt_id = test_input($_POST['hospt_id']);
		}
		// echo $done;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		} 
			if($done == 5) {
				// echo "hey";
				$sql = "update doctor set password = '".$password."', doc_name = '".$patient_name."', gender = '".$Gender."', bdate = '".$Bdate."', address = '".$Address."', phoneno = ".$PhoneNo.", hospt_id = ".$hospt_id." where doc_email = '". $email ."'";
				if ($conn->query($sql) === TRUE) {
					// $_SESSION['email'] = $email;
					echo "<script>window.location = 'ad_doctor_view.php';</script>";
				} else {
					echo "<script> alert('" . $conn->error."'); </script>";
				}
				$done = 0;
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
                            <a href="ad_profile.php">
                                <i class="fas fa-chart-bar active"></i>Profile</a>
                        </li>
                        <li>
                            <a href="ad_hospital.php">
                                <i class="fas fa-table"></i>Hospitals</a>
                        </li>
                        <li class = "active">
                            <a href="ad_doctor.php">
                                <i class="far fa-check-square"></i>Doctors</a>
                        </li>
                        <li>
                            <a href="ad_patient.php">
                                <i class="fas fa-calendar-alt"></i>Patients</a>
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
                        <div class="row">
                            <div class="col-lg-12">
							
                                <div class="card" style=:"align:center">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Doctor Profile</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" novalidate="novalidate">
										<p class="error"><?php echo $login_err; ?></p>
										<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Name</label>
                                                <input id="cc-name" name="patient_name" value="<?php echo $patient_name;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $patient_name_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                                <input id="cc-pament" name="email" value="<?php echo $email;?>" type="text" class="form-control" aria-required="true" aria-invalid="false" disabled>
		  										<p class="error"><?php echo $email_err; ?></p>
											</div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Password</label>
                                                <input id="cc-name" name="password" value="<?php echo $password;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $password_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
											
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Gender</label>
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" name="Gender" value="Male" class="form-check-input" <?php if($Gender == "Male") {echo "checked";} ?>>Male
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="Gender" value="Female" class="form-check-input" <?php if($Gender == "Female") {echo "checked";} ?>>Female
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio3" class="form-check-label ">
                                                                <input type="radio" id="radio3" name="Gender" value="Other" class="form-check-input" <?php if($Gender == "Other") {echo "checked";} ?>>Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
											<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Bdate</label>
                                                <input id="cc-name" name="Bdate" value="<?php echo $Bdate;?>" type="date" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $Bdate_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
											<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Address</label>
                                                <input id="cc-name" name="Address" value="<?php echo $Address;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $Address_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
											<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">PhoneNo</label>
                                                <input id="cc-name" name="PhoneNo" value="<?php echo $PhoneNo;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $PhoneNo_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Hospital</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="hospt_id" id="select" class="form-control">
                                                    <?php
                                                    $sql = "SELECT hospt_id, hospt_name FROM hospital";
                                                    if ($result = $conn->query($sql)) {
                                                        if ($result->num_rows >= 1) {
                                                            // echo "<script>alert('heyu ron');</script> sdfgvhbjnk";
                                                            // echo "<option value='34' > hey ron </option>";
                                                            while($row = $result->fetch_assoc()) {
                                                                if ($hospt_id == $row['hospt_id']) {
                                                                    echo "<option value='".$row['hospt_id']."' selected> " . $row["hospt_id"]. " : ".$row['hospt_name']. " </option>";
                                                                } else {
                                                                    echo "<option value='".$row['hospt_id']."' > " . $row["hospt_id"]. " : ".$row['hospt_name']. " </option>";
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        echo "Query Failed";
                                                        // echo "<option value='34' > hey Query fail </option>";
                                                    }
                                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Update</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
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
            window.location.replace("ad_add_doctor.php");
        }
    </script>
</body>

</html>
<!-- end document-->
