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
<script> 
    function show_request_form() {
        // alert("hey botd");
        var x = document.getElementById("requestform");
        x.style.display = "none";
        x.style.visibility = "hidden";
    }
    function show_request_pending() {
        var x = document.getElementById("requestform");
        x.style.display = "block";
    }
    function show_request_approved() {
        var x = document.getElementById("requestform");
        x.style.display = "block";
    }
    function show_request_rejected() {
        var x = document.getElementById("requestform");
        x.style.display = "block";
    }
</script>
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
        // for viewing hospital details
        $hospt_id=$hospt_name=$bdate=$address=$Phoneno=$dist=$gen_bed=$gen_price=$spec_bed=$spec_price=$gen_bed_2days=$spec_bed_2days=$gen_tatkal_price=$spec_tatkal_price= "";
		$hospt_id_err=$hospt_name_err=$bdate_err=$dist_err=$address_err=$phoneno_err=$gen_bed_err=$gen_price_err=$spec_bed_err=$spec_price_err=$gen_bed_2days_err=$spec_bed_2days_err=$gen_tatkal_price_err=$spec_tatkal_price_err= "";
		$login_err = $login_mode = "";
        $done = 0;
        $test = "";
        $hospt_id = $_SESSION['patient_hospt_view_id'];
        $sql = "select * from hospital where hospt_id='".$hospt_id."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc();
            $hospt_id= $row['hospt_id'];
            $hospt_name= $row['hospt_name'];
            $address= $row['address'];
            $Phoneno= $row['phoneno'];
            $dist= $row['dist'];
            $gen_bed= $row['gen_bed'];
            $gen_price= $row['gen_price'];
            $spec_bed= $row['spec_bed'];
            $spec_price= $row['spec_price'];
            $gen_bed_2days= $row['gen_bed_2days'];
            $spec_bed_2days= $row['spec_bed_2days'];
            $gen_tatkal_price= $row['gen_tatkal_price'];
            $spec_tatkal_price= $row['spec_tatkal_price'];
		} else {
			$login_err = "Invalid Email";
        }
        // for requesting bed
        $category = "";
        $category_err = "";
        $req_err = "";
        $transaction_id = "";
        $transaction_id_err = "";
        $mode = "";
        $bed_request_status = "pending";
        // checking if request is done or not
        
        $sql = "select * from request_bed where patient_email = '". $login_email ."' and hospt_id = ". $hospt_id ."";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            $req_index = $row['req_index'];
            $req_category= $row['category'];
            $req_status= $row['status'];
            $req_date= $row['req_date'];
            $transaction_id = $row['transaction_id'];
            $already_requested_status = "true";
            $already_requested = "You Have requested ". $req_category ." bed in this hospital on ". $req_date ." with status : ". $req_status ."";
        }else {
            $already_requested = "";
            $already_requested_status = "false";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["category"])) {
			  $category_err = "Category is required";
			} else {
              $category = test_input($_POST["category"]);
              if($category == "gen") {
                  if($gen_bed == 0) {
                      echo "<script> alert('General beds are no more available'); </script>";
                  } else {
                        $category_err = "";
                        $done = $done + 1;
                  }
              } else {
                  if($spec_bed == 0) {
                      echo "<script> alert('Special beds are no more available'); </script>";
                  } else {
                        $category_err = "";
                        $done = $done + 1;
                  }
              }
            }
            if ($_POST['mode'] == "tatkal") {
                $mode = $_POST['mode'];
                if(empty($_POST["transaction_id"])) {
                    $transaction_id_err = "Payment details are required for tatkal bed request.";
                } else {
                    $transaction_id_err = "";
                    $transaction_id = $_POST["transaction_id"];
                    $done = $done + 1;
                }
                $bed_request_status = "approved";
              } else {
                  $done = $done + 1;
              }
            $transaction_id = $_POST["transaction_id"];
		}
		// echo $done;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		} 
        // handling request
        if($done == 2) {
            // echo "hey";
            $todays_date = date('Y-m-d');
            if ($already_requested_status == "false") {
                $sql = "insert into request_bed(patient_email, hospt_id, category, status, req_date, transaction_id) values('". $login_email ."', ". $hospt_id .", '". $category ."', '". $bed_request_status ."', '". $todays_date ."', '". $transaction_id ."')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>window.location = 'patient_hospt_view.php';</script>";
                } else {
                    echo "<script> alert('hey boies'); </script>";
                }
            } else {
                $sql = "update request_bed set category = '". $category ."', status = '". $bed_request_status ."', req_date = '". $todays_date ."', transaction_id = '". $transaction_id ."' where req_index = ". $req_index ."";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>window.location = 'patient_hospt_view.php';</script>";
                } else {
                    echo "<script> alert('hey boies'); </script>";
                }
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
                            <a href="patient_profile.php">
                                <i class="fas fa-chart-bar active"></i>Profile</a>
                        </li>
                        <li>
                            <a href="patient_doctors.php">
                                <i class="fas fa-calendar-alt"></i>Doctors</a>
                        </li>
                        <li class = "active">
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
                <div class="container-fluid">
                        <div id = "requestform" style="display: block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card" style=:"align:center">
                                        <div class="card-body">
                                            <form action="" method="post" novalidate="novalidate">
                                                <label for="cc-name" class="control-label mb-1"><p><?php echo $already_requested; ?></p></label>
                                                <p class="error"><?php echo $login_err; ?></p>
                                                <p class="error"><?php echo $category_err; ?></p>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                         <label class=" form-control-label">Category</label>
                                                    </div>
                                                    <div class="col col-md-6">
                                                        <div class="form-check">
                                                            <div class="radio">
                                                                <label for="radio1" class="form-check-label ">
                                                                    <input type="radio" id="radio1" name="category" value="gen" class="form-check-input" <?php if($category == "gen") {echo "checked";} ?>>General Bed
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label for="radio2" class="form-check-label ">
                                                                    <input type="radio" id="radio2" name="category" value="spec" class="form-check-input" <?php if($category == "spec") {echo "checked";} ?>>Special Bed
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-md-3">
                                                        <div class="form-check">
                                                            <img src="QR_Code.png" alt="John Doe" />
                                                        </div>
                                                    </div>
                                                    <div class="col col-md-3">
                                                         <label class=" form-control-label">Mode</label>
                                                    </div>
                                                    <div class="col col-md-9">
                                                        <div class="form-check">
                                                            <label for="checkbox1" class="form-check-label ">
                                                                <input type="checkbox" id="checkbox1" name="mode" value="tatkal" class="form-check-input" <?php if($mode == "tatkal") {echo "checked";} ?> >Tatkal
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col col-md-6">
                                                        <div class="form-group has-success">
                                                            <label for="cc-name" class="control-label mb-1">Bill Payment Transaction ID</label>
                                                                <input id="cc-name" name="transaction_id" value="<?php echo $transaction_id;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                                autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                            <p class="error"><?php echo $transaction_id_err; ?></p>
                                                        </div>
                                                    </div>

                                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                        <span id="payment-button-amount"><?php if($already_requested_status == 'true') {echo 'Request Again';} else {echo 'Request';} ?></span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
        
                                <div class="card" style=:"align:center">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Hospital Details</h3>
                                        </div>
                                        <hr>
										<p class="error"><?php echo $login_err; ?></p>
										<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">hospital Name</label>
                                                <input id="cc-name" name="hospt_name" value="<?php echo $hospt_name;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $hospt_name_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Hospital Id</label>
                                                <input id="cc-pament" name="hospt_id" value="<?php echo $hospt_id;?>" type="int" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                                <p class="error"><?php echo $hospt_id_err; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">district</label>
                                                <input id="cc-pament" name="dist" value="<?php echo $dist;?>" type="text" class="form-control" aria-required="true" aria-invalid="false" disabled>
		  										<p class="error"><?php echo $dist_err; ?></p>
											</div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">address</label>
                                                <input id="cc-name" name="address" value="<?php echo $address;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $address_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
											
											<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Phoneno</label>
                                                <input id="cc-name" name="PhoneNo" value="<?php echo $Phoneno;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $phoneno_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_bed</label>
                                                <input id="cc-name" name="gen_bed" value="<?php echo $gen_bed;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $gen_bed_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_price</label>
                                                <input id="cc-name" name="gen_price" value="<?php echo $gen_price;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $gen_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_bed</label>
                                                <input id="cc-name" name="spec_bed" value="<?php echo $spec_bed;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $spec_bed_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_price</label>
                                                <input id="cc-name" name="spec_price" value="<?php echo $spec_price;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $spec_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_tatkal_price</label>
                                                <input id="cc-name" name="gen_tatkal_price" value="<?php echo $gen_tatkal_price;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $gen_tatkal_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_tatkal_price</label>
                                                <input id="cc-name" name="spec_tatkal_price" value="<?php echo $spec_tatkal_price;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $spec_tatkal_price_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">gen_bed_2days</label>
                                                <input id="cc-name" name="gen_bed_2days" value="<?php echo $gen_bed_2days;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $gen_bed_2days_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">spec_bed_2days</label>
                                                <input id="cc-name" name="spec_bed_2days" value="<?php echo $spec_bed_2days;?>" type="number" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
												<p class="error"><?php echo $spec_bed_2days_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
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
    </script>
</body>

</html>
<!-- end patientument-->
