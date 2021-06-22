<?php include "classes/db.php"; 
// 'captcha';
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>FUNAAB</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="img/FUNAAB-Logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/FUNAAB-Logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/FUNAAB-Logo.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/frontpage.min.css">
</head>

<body class="login-page">
	<!--  -->
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="img/FUNAAB-Logo.png" alt="" width="100"></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>
	<!--  -->
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="index.php">
					<img src="img/FUNAAB-Logo.png" alt="" width="80">
					<h4 class="logo-text-n">FUNAAB CLEARANCE SYSTEM</h4>
				</a>
			</div>
		</div>
	</div>


	<!-- floatingn -->
	<div class="col-sm-12 overide-zd" >
		<div class="row">
			<div class="col-md-7 col-lg-8 overide-zd-height"></div>
			<div class="col-md-4 "><br><br>
				<div class="login-box bg-white box-shadow border-radius-10">
					<div class="login-title">
						<h2 class="text-center text-primary">Login to the Clearance System</h2>
						<?php
						if (isset($_SESSION['errors'])) {
							echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
						}else if(isset($_SESSION['success'])){
							echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
						}
						?>				

					</div>
					<form method="post" action="authentication" autocomplete="off" id="myForm">
						<div class="select-role">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn active">
									<input type="radio" checked="" name="options" value="student" id="admin">
									<div class="icon"><i class="fas fa-user-graduate" style="font-size: 30px;color: #048c0b;"></i></div>
									<span>I'm</span>
									Student
								</label>
							</div>
						</div>
						<div class="input-group custom">
							<input type="text" name="Username" class="form-control form-control-lg" placeholder="Matric num">
							<div class="input-group-append custom">
								<span class="input-group-text"><i class="fas fa-user-shield" style="color: #048c0b;"></i></span>
							</div>
						</div>
						<div class="input-group custom">
							<input type="password" name="password" class="form-control form-control-lg" placeholder="Surname">
							<div class="input-group-append custom">
								<span class="input-group-text"><i class="fas fa-user-lock" style="color: #048c0b;"></i></span>
							</div>
						</div>


						<div class="input-group custom" >
							<div class="capbox">

								<div id="CaptchaDiv"></div>
								<a  class="btn btn-primary refresh-captcha" onclick="confirmCaptcha();" style="padding: 10px!important;" ><strong>&#x27F3;</strong></a>

								<div class="capbox-inner">
									Type the number:<br>

									<input type="hidden" id="uniqueid" name="uniqueid" readonly="">
									<input type="text" name="capthca-geter" id="CaptchaInput" class="clear-any" size="6" required="" autocomplete="off" pattern="[A-Za-z0-9]{6}" onKeyDown="limitText(this,6);" onKeyUp="limitText(this,6);"><br>

								</div>
							</div>
						</div>

						<div class="row ">
							<div class="col-sm-12">
								<div class="input-group mb-0">

									<input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Sign In">

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- floatingn ended -->

	<div id="landing">
		<div class="slider slider-1">
			<img class="ratio" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7" />

			<input class="slide" type="radio" name="slider-1" id="s-1-1" /><label for="s-1-1"></label>
			<div class="slide-load">
				<img src="img/_NewsSlide_BFSSA_GradCeremony_06June2018.jpg" class="" />
				<div class="overlay-slider" >
					<div class="row">
						<div class="col-sm-7 content">
							<h3>Congratulations Graduate.</h3>
							<p> You’ve worked hard to achieve your goals and now you’re on your way to seek new vistas, dream new dreams, embark on who you are, embrace life with passion and keep reaching for your star. Go for it!</p>
						</div>
					</div>
				</div>
			</div>

			<input class="slide" type="radio" name="slider-1" id="s-1-2" /><label for="s-1-2"></label>
			<div class="slide-load">
				<img src="img/rwanda_grads_853x480-min.jpg" class="" />
				<div class="overlay-slider" >
					<div class="row">
						<div class=" col-sm-7 content">
							<h3>Increase engagement with unique battle and tournament capability</h3>
							<p>Drive more engagement for your games when players fight it out against one another in battles. When players compete, your game wins!</p>
						</div>
					</div>
				</div>
			</div>

			<input class="slide" type="radio" name="slider-1" id="s-1-3" checked /><label for="s-1-3"></label>
			<div class="slide-load">
				<img src="img/_NewsSlide_BFSSA_GradCeremony_06June2018.jpg" class="" />
				<div class="overlay-slider" >
					<div class="row">
						<div class="col-sm-7 content">
							<h3>Launch with us in Taiwan this December and watch your revenues grow!</h3>
							<p>Playphone has partnered with Gamania, the top game publisher in Taiwan, to help monetize your games in the #4 Android gaming market.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div id="mobileshow"><div></div></div> -->
	</div>
	<!-- standard js files here -->
	
	<div class="footer-wrap pd-20 mb-20 card-box">
		FUNAAB <a href="mailto:+2347035925124" target="_blank">OLUWATOSIN</a>
	</div>
</div>
</div>
<!-- scripts -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<!-- <script>document.getElementById("myForm").reset();</script> -->
<script src="vendors/scripts/layout-settings.js"></script>
<!-- standard js files here ended -->
<script type="text/javascript" src="captcha.min.js"></script>
<?php unset($_SESSION['success']); unset($_SESSION['errors']);unset($_GET['strings']); ?>
</body>
</html>