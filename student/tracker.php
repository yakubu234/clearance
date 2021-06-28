	<?php 
	include "../classes/db.php"; 
	include "../include/library.php"; 
	include 'geter.php';
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index');
	}
	?>
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">	
	<link rel="stylesheet" type="text/css" href="../vendors/styles/load-uploader.css">
	<style>
		#container-track { text-align: center; margin: 20px; }
.bar-main-container {
  margin: 10px auto;
  width: 400px;
  height: 50px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  font-family: sans-serif;
  font-weight: normal;
  font-size: 0.8em;
  color: #FFF;
}
@media only screen and (max-width: 600px) {
	.bar-main-container {
  margin: 10px auto;
  width: 350px;
  height: 50px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  font-family: sans-serif;
  font-weight: normal;
  font-size: 0.8em;
  color: #FFF;
}
}
.wrap { padding: 8px; }

.bar-percentage {
  float: left;
  background: rgba(0,0,0,0.13);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 9px 0px;
  width: 60px;
  height: 34px;
}

.bar-container {
  float: right;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  height: 10px;
  background: rgba(0,0,0,0.13);
  width: 78%;
  margin: 5px 0px;
  overflow: hidden;
}

.bar {
  float: left;
  background: #FFF;
  height: 100%;
  -webkit-border-radius: 10px 0px 0px 10px;
  -moz-border-radius: 10px 0px 0px 10px;
  border-radius: 10px 0px 0px 10px;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  -moz-opacity: 1;
  -khtml-opacity: 1;
  opacity: 1;
}

/* COLORS */
.violet  { background: #048c0b; }
		
	</style>
	<?php include "../include/header.php"; ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>blank</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">tracker</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="blank.html#" role="button" data-toggle="dropdown">
									button
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<?php
							if (isset($_SESSION['errors'])) {
								echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
							}else if(isset($_SESSION['success'])){
								echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
							}
							?>	
					<div id="container-track" class="col-sm-6"> 					

						<?php 
						$dataFromTrack = GetUpload_Status($matric_num,$userid); 
						$dataFromTrack = json_decode($dataFromTrack);
						$err ='';
						if (!empty($dataFromTrack)) {	
							foreach ($dataFromTrack as $key => $value) {
								$value->status == 2 ? $style ='101':($value->status == 1 ? $style ='56': $style ='5');
							echo '<div id="bar-'.$key.'" class="bar-main-container violet">
							<div class="wrap">
							  <div class="bar-percentage" data-percentage="'.$style.'"></div>
							 <b> '.$value->roles.'</b>
							  <div class="bar-container">								
								<div class="bar"></div>
							  </div>
							</div>
						  </div>';
							}
						}else{
							$err = "<b class='text-danger' >sorry you have not requested for clearance </b>";
						}
						?>
					</div>
					<?php echo $err; ?>
					<!-- https://codepen.io/erwinquita/pen/ZWzVRE -->
				</div>

				<!-- js -->
				<!-- standard js files here -->
				<?php include "../include/footer.php";  ?>
				<!-- standard js files here ended -->
				<script type="text/javascript">
				$('.bar-percentage[data-percentage]').each(function () {
				var progress = $(this);
				var percentage = Math.ceil($(this).attr('data-percentage'));
				$({countNum: 0}).animate({countNum: percentage}, {
					duration: 2000,
					easing:'linear',
					step: function() {
					// What todo on every count
					var pct = Math.floor(this.countNum) + '%';
					progress.text(pct) && progress.siblings().children().css('width',pct);
					}
				});
				});
				</script>
			</body>
			</html>