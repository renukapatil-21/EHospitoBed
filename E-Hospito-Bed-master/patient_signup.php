<!doctype html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>HospitoBed</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" type="image/x-icon" href="homepage_templete/assets/img/favicon.ico">
	<!-- Place favicon.ico in the root directory -->

	<!-- ========================= CSS here ========================= -->
	<link rel="stylesheet" href="homepage_templete/assets/css/bootstrap-5.0.5-alpha.min.css">
	<link rel="stylesheet" href="homepage_templete/assets/css/LineIcons.2.0.css">
	<link rel="stylesheet" href="homepage_templete/assets/css/animate.css">
	<link rel="stylesheet" href="homepage_templete/assets/css/tiny-slider.css">
	<link rel="stylesheet" href="homepage_templete/assets/css/main.css">
	<style>
	.error {
		color:red;
	}
	</style>
</head>

<body>
	<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
	<?php
		require "connection.php";
		session_start();
		$email = $password  =$patient_name=$Bdate=$Gender=$PhoneNo=$Address= "";
		$email_err = $password_err =$patient_name_err=$Bdate_err=$PhoneNo_err=$Address_err="";
		$login_err = $login_mode = "";
		$done = 0;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["email"])) {
			  $email_err = "Email is required";
			} else {
			  $email = test_input($_POST["email"]);
			  // check if e-mail address is well-formed
			  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_err = "Invalid email format";
			  } else {
				$email_err = "";
				$done = $done + 1;
			  }			  
			}
		  
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
		}
		// echo $done;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		} 
			if($done == 6) {
				// echo "hey";
				$sql = "select password from patient where patient_email = '". $email . "'";
					$result = $conn->query($sql);
					if ($result->num_rows == 0) {
						// output data of each row
						$sql = "insert into patient values('".$email."', '".$password."', '".$patient_name."', '".$Gender."', '".$Bdate."', '".$Address."', ".$PhoneNo.")";
						if ($conn->query($sql) === TRUE) {
							$_SESSION['email'] = $email;
							echo "<script>window.location = 'patient_profile.php';</script>";
						  } else {
							echo "<script> alert('" . $conn->error."') </script>";
						  }
					} else {
						$login_err = "Email already exist";
					}
					$done = 0;
				$conn->close();
			}
	?>
	<!-- ========================= preloader start ========================= -->
	<div class="preloader">
		<div class="loader">
			<div class="ytp-spinner">
				<div class="ytp-spinner-container">
					<div class="ytp-spinner-rotator">
						<div class="ytp-spinner-left">
							<div class="ytp-spinner-circle"></div>
						</div>
						<div class="ytp-spinner-right">
							<div class="ytp-spinner-circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- preloader end -->

	<!-- ========================= header start ========================= -->
	<header id="home" class="header">

		<div class="header-wrapper">
        <div class="header-top theme-bg">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div class="header-top-left text-center text-md-left">
									<ul>
										<li><a href="#"><i class="lni lni-phone"></i> 7058100198</a></li>
										<li><a href="#"><i class="lni lni-envelope"></i> aniketbhise251@gmail.com</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-4">
								<div class="header-top-right d-none d-md-block">
									<ul>
										<li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
										<li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
										<li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="navbar-area">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<nav class="navbar navbar-expand-lg">
									<a class="navbar-brand" href="index.html">
                                    <h3 class="mb-15 wow fadeInUp" data-wow-delay=".4s">HospitoBed Management</h3>
									</a>
									<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
										aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<span class="toggler-icon"></span>
										<span class="toggler-icon"></span>
										<span class="toggler-icon"></span>
									</button>
				
									<div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
										<ul id="nav" class="navbar-nav ml-auto">
											<li class="nav-item active">
												<a class="page-scroll" href="index.php">Home</a>
                                            </li>
                                            <li class="nav-item active">
												<a class="page-scroll" href="index.php">Login</a>
                                            </li>
                                            <li class="nav-item active">
												<a class="page-scroll active" href="#">SignUp</a>
                                            </li>
                                            <li class="nav-item active">
												<a class="page-scroll" href="index.php">Request Bed</a>
											</li>
										</ul>
									</div> <!-- navbar collapse -->
								</nav> <!-- navbar -->
							</div>
						</div> <!-- row -->
					</div> <!-- container -->
				</div> <!-- navbar area -->
		</div>

		
	</header>
	<!-- ========================= header end ========================= -->



	<!--========================= we-do-section start========================= -->
	
	<!-- ========================= about-section start ========================= -->
	
	<section>
	<section id="login" class="about-section pt-120">
	<div 
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 40%;
>
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
							
                                <div class="card" style=:"align:center">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Create New Account</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" novalidate="novalidate">
										<p class="error"><?php echo $login_err; ?></p>
										<div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Patient Name</label>
                                                <input id="cc-name" name="patient_name" value="<?php echo $patient_name;?>" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $patient_name_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                                <input id="cc-pament" name="email" value="<?php echo $email;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
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
                                                                <input type="radio" id="radio1" name="Gender" value="Male" class="form-check-input" <?php if($Gender == "Male" or $Gender == "") {echo "checked";} ?>>Male
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
                                                <input id="cc-name" name="PhoneNo" value="<?php echo $PhoneNo;?>" type="int" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
												<p class="error"><?php echo $PhoneNo_err; ?></p>
												<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
											</div>
                                            
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">submit</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
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
	
	<!-- ========================= about-section end ========================= -->

	<!--========================= service-section start ========================= -->
	<section id="signup" class="service-section pt-150">
		
	</section>
	<!--========================= service-section end ========================= -->

	<!-- ========================= testimonial-section start ========================= -->
	
	<!-- ========================= testimonial-section end ========================= -->

	<!--========================= faq-section start ========================= -->
	<!--========================= faq-section end ========================= -->

	<!-- ========================= team-section start ========================= -->
	
	<!-- ========================= team-section end ========================= -->

	<!-- ========================= subscribe-section start ========================= -->
	
	<!-- ========================= subscribe-section end ========================= -->

	<!-- ========================= blog-section start ========================= -->
	
	<!-- ========================= blog-section end ========================= -->

	<!-- ========================= contact-section start ========================= -->
	
	<!-- ========================= contact-section end ========================= -->

	<!-- ========================= footer start ========================= -->
	<footer class="footer pt-100 img-bg" style="background-image:url('homepage_templete/assets/img/bg/footer-bg.jpg');">
		<div class="container">
			<div class="footer-widget-wrapper">
				<div class="row">
					<div class="col-xl-4 col-lg-5 col-md-6">
						<div class="footer-widget mb-30">
							<a href="index.html" class="logo"><img src="homepage_templete/assets/img/logo/logo.svg" alt=""></a>
							<p></p>
							<div class="footer-social-links">
								<ul>
									<li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
									<li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
									<li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
									<li><a href="#"><i class="lni lni-instagram-original"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col-xl-4 col-lg-12 col-md-7">
						<div class="footer-widget mb-30">
							<h4>Admin Location</h4>
							<div class="map-canvas">
							<center>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.6089727729645!2d74.59926881393226!3d16.845743822636024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc1237f52c65db5%3A0xa3535676176ded0a!2sWalchand%20College%20of%20Engineering!5e0!3m2!1sen!2sin!4v1609495862469!5m2!1sen!2sin" width="300" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
							</center>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="copyright-area">
				<p class="mb-0 text-center">Designed and Developed By <a href="https://uideck.com/" rel="nofollow">Aniket,Yash and Bhushan</a></p>
			</div>
		</div>
	</footer>
	<!-- ========================= footer end ========================= -->


	<!-- ========================= scroll-top ========================= -->
	<a href="#" class="scroll-top">
		<i class="lni lni-arrow-up"></i>
	</a>

	<!-- ========================= JS here ========================= -->
	<script src="homepage_templete/assets/js/bootstrap.bundle-5.0.0.alpha-min.js"></script>
	<script src="homepage_templete/assets/js/wow.min.js"></script>
	<script src="homepage_templete/assets/js/tiny-slider.js"></script>
	<script src="homepage_templete/assets/js/main.js"></script>
</body>

</html>