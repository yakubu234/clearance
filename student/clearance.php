	<?php include "../classes/db.php";  include "../include/library.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$uploads = json_decode(GetPostItems($userid,$matric_num));
	$file = $uploads->file_name;
	$ext = getExtension(pathinfo($file, PATHINFO_EXTENSION));
	?>
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<?php include "../include/header.php"; ?>
	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="../vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">
						<?php
						if (isset($_SESSION['errors'])) {
							echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
						}else if(isset($_SESSION['success'])){
							echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
						}
						?>	
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $firstname ." ". $lastname; ?> !</div>
						</h4>
						<p class="font-18 max-width-600">Kindly preview the document you uploaded before requesting for clearance. Please ensure the document is intact befor clicking request for clearance. Kindly note that once review begin on your document you cannot delete the document anymore. <br><br>If you are using a phone and cannot read the document properly, you are advised to <a href="<?php echo $urlServer; ?>pdf/web/viewer.html?file=<?php echo $urlServer; ?>uploads/student/<?php echo $file; ?>" class="text-danger" target="_blank">open this document on a new tab</a></p>
					</div>
					<br><br>
					<?php    
					// $filePath = "../uploads/student/".$file;
					$filePath = $urlServer."uploads/student/".$file;
					echo '<iframe src="'.$urlServer.'pdf/web/viewer.html?file='.$urlServer.'uploads/student/'.$file.'" width="100%" height="400" allowfullscreen webkitallowfullscreen></iframe>';
					?>
					<br><br>
					<div class="btn-list">
						<a href="request"><button type="button" class="btn" data-bgcolor="#00DFA0" data-color="#ffffff"><i class="fa fa-bullhorn"></i> Request Clearance</button></a>
						<a href="tracker"><button type="button" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fas fa-search-location"></i> Track Progress</button></a>
						<a href="deleteDocuments"><button type="button" class="btn" data-bgcolor="#FF0000" data-color="#ffffff"><i class="fa fa-trash-o"></i> Delete Document</button></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12 mb-30">
					<div class="card-box height-100-p widget-style1">
						<a href="">
							<div class="d-flex flex-wrap align-items-center">
								<br><br><br>
							</div>
						</a>
					</div>
				</div>			
			</div>
			
			<!-- js -->
			<!-- standard js files here -->
			<?php include "../include/footer.php";  ?>
			<!-- standard js files here ended -->
			<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
			<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
			<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
			<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
			<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
			<script src="../vendors/scripts/dashboard.js"></script>
			<script type="text/javascript">
				window.onbeforeunload = function (e) {
    // Cancel the event
    e.preventDefault();

    // Chrome requires returnValue to be set
    e.returnValue = 'Really want to quit the game?';
};

//Prevent Ctrl+S (and Ctrl+W for old browsers and Edge)
document.onkeydown = function (e) {
    e = e || window.event;//Get event

    if (!e.ctrlKey) return;

    var code = e.which || e.keyCode;//Get key code

    switch (code) {
        case 83://Block Ctrl+S
        case 87://Block Ctrl+W -- Not work in Chrome and new Firefox
        e.preventDefault();
        e.stopPropagation();
        break;
    }
};
</script>
<?php unset($_SESSION['success']); unset($_SESSION['errors']);unset($_GET['strings']); ?>
</body>
</html>


