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
        // for admin login details
        $login_email = $login_patient_name= "";
		$login_err = $login_mode = "";
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
        // for hosspital adding data
		$hospt_id=$hospt_name=$bdate=$address=$Phoneno=$dist=$gen_bed=$gen_price=$spec_bed=$spec_price=$gen_bed_2days=$spec_bed_2days=$gen_tatkal_price=$spec_tatkal_price= "";
		$hospt_id_err=$hospt_name_err=$bdate_err=$dist_err=$address_err=$phoneno_err=$gen_bed_err=$gen_price_err=$spec_bed_err=$spec_price_err=$gen_bed_2days_err=$spec_bed_2days_err=$gen_tatkal_price_err=$spec_tatkal_price_err= "";
		$login_err = $login_mode = "";
		$done = 0;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["hospt_id"])) {
			  $hospt_id_err = "hospt_id is required";
			} else {
			  $hospt_id = test_input($_POST["hospt_id"]);
			  $hospt_id_err = "";
			  $done = $done + 1;
            }
            if (empty($_POST["spec_tatkal_price"])) {
                $spec_tatkal_price_err = "spec_tatkal_price is required";
              } else {
                $spec_tatkal_price = test_input($_POST["spec_tatkal_price"]);
                $spec_tatkal_price_err = "";
                $done = $done + 1;
              }
            if (empty($_POST["gen_tatkal_price"])) {
                $gen_tatkal_price_err = "gen_tatkal_price is required";
              } else {
                $gen_tatkal_price = test_input($_POST["gen_tatkal_price"]);
                $gen_tatkal_price_err = "";
                $done = $done + 1;
              }
            if (empty($_POST["spec_bed_2days"])) {
                $spec_bed_2days_err = "spec_bed_2days is required";
              } else {
                $spec_bed_2days = test_input($_POST["spec_bed_2days"]);
                $spec_bed_2days_err = "";
                $done = $done + 1;
              }
            if (empty($_POST["gen_bed_2days"])) {
                $gen_bed_2days_err = "gen_bed_2days is required";
              } else {
                $gen_bed_2days = test_input($_POST["gen_bed_2days"]);
                $gen_bed_2days_err = "";
                $done = $done + 1;
              }
            if (empty($_POST["spec_price"])) {
                $spec_price_err = "spec_price is required";
              } else {
                $spec_price = test_input($_POST["spec_price"]);
                $spec_price_err = "";
                $done = $done + 1;
              }
            
            if (empty($_POST["spec_bed"])) {
                $spec_bed_err = "spec_bed is required";
              } else {
                $spec_bed = test_input($_POST["spec_bed"]);
                $spec_bed_err = "";
                $done = $done + 1;
              }
            if (empty($_POST["gen_price"])) {
                $gen_price_err = "gen_price is required";
              } else {
                $gen_price = test_input($_POST["gen_price"]);
                $gen_price_err = "";
                $done = $done + 1;
              }
            if (empty($_POST["gen_bed"])) {
                $gen_bed_err = "gen_bed is required";
              } else {
                $gen_bed = test_input($_POST["gen_bed"]);
                $gen_bed_err = "";
                $done = $done + 1;
              }
			if (empty($_POST["dist"])) {
                $dist_err = "district is required";
              } else {
                $dist = test_input($_POST["dist"]);
                $dist_err = "";
                $done = $done + 1;
              }
			if (empty($_POST["hospt_name"])) {
				$hospt_name_err = "Name is required";
			  } else {
				$hospt_name = test_input($_POST["hospt_name"]);
				$hospt_name_err = "";
				$done = $done + 1;
			  }
			if (empty($_POST["address"])) {
				$address_err = "address is required";
			  } else {
				$address = test_input($_POST["address"]);
				$address_err = "";
				$done = $done + 1;
			  }
			  
			
			  if (empty($_POST["PhoneNo"])) {
				$Phoneno_err = "Phoneno is required";
			  } else {
				$Phoneno = test_input($_POST["PhoneNo"]);
				$Phoneno_err = "";
				$done = $done + 1;
              }
		}
		// echo $done;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		} 
			if($done == 13) {
                // echo "hey";
                $sql = "select hospt_name from hospital where hospt_id = ". $hospt_id;
                $result = $conn->query($sql);
					if ($result->num_rows == 0) {
						// output data of each row
						$sql = "insert into hospital values(".$hospt_id.", '".$hospt_name."', '".$address."', '".$dist."', '".$PhoneNo."', ".$gen_bed.", ".$gen_price.", ".$spec_bed.", ".$spec_price.", ".$gen_bed_2days.", ".$spec_bed_2days.", ".$gen_tatkal_price.", ".$spec_tatkal_price.")";
						if ($conn->query($sql) === TRUE) {
							$_SESSION['ad_hospt_view_id'] = $hospt_id;
							echo "<script>window.location = 'ad_hospt_view.php';</script>";
						  } else {
                            echo "<script> alert(' " . $conn->error."') </script>";
                            $login_err = $conn->error;
						  }
					} else {
						$login_err = "Hospital id already exist";
					}
					$done = 0;
				$conn->close();
            } else {
                echo $done;
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
                        <li class = "active">
                            <a href="ad_hospital.php">
                                <i class="fas fa-table"></i>Hospitals</a>
                        </li>
                        <li>
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
                <div class="container-fluid">
                        <div class="overview-wrap">
                                        <h2 class="title-2">Add Hospital</h2>
                                    </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
							
                                <div class="card" style=:"align:center">
                                    <div class="card-body">
                                        <form action="" method="post" novalidate="novalidate">
										<p class="error"><?php echo $login_err; ?></p>
										<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">hospital Name</label>
                                                <input id="cc-name" name="hospt_name" value="<?php echo $hospt_name;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $hospt_name_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Hospital Id</label>
                                                <input id="cc-pament" name="hospt_id" value="<?php echo $hospt_id;?>" type="int" class="form-control" aria-required="true" aria-invalid="false">
                                                <p class="error"><?php echo $hospt_id_err; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">district</label>
                                                <input id="cc-pament" name="dist" value="<?php echo $dist;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
		  										<p class="error"><?php echo $dist_err; ?></p>
											</div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">address</label>
                                                <input id="cc-name" name="address" value="<?php echo $address;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $address_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
											
											<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Phoneno</label>
                                                <input id="cc-name" name="PhoneNo" value="<?php echo $Phoneno;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $phoneno_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_bed</label>
                                                <input id="cc-name" name="gen_bed" value="<?php echo $gen_bed;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $gen_bed_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_price</label>
                                                <input id="cc-name" name="gen_price" value="<?php echo $gen_price;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $gen_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_bed</label>
                                                <input id="cc-name" name="spec_bed" value="<?php echo $spec_bed;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $spec_bed_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_price</label>
                                                <input id="cc-name" name="spec_price" value="<?php echo $spec_price;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $spec_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_tatkal_price</label>
                                                <input id="cc-name" name="gen_tatkal_price" value="<?php echo $gen_tatkal_price;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $gen_tatkal_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_tatkal_price</label>
                                                <input id="cc-name" name="spec_tatkal_price" value="<?php echo $spec_tatkal_price;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $spec_tatkal_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_bed_2days</label>
                                                <input id="cc-name" name="gen_bed_2days" value="<?php echo $gen_bed_2days;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $gen_bed_2days_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_bed_2days</label>
                                                <input id="cc-name" name="spec_bed_2days" value="<?php echo $spec_bed_2days;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $spec_bed_2days_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Add</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
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
            window.location.replace("ad_add_hospt.php");
        }
    </script>
</body>

</html>
<!-- end document-->
