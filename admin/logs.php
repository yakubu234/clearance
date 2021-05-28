	<?php include "../classes/db.php";  include "../include/library.php";include "../classes/fethcer.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$function = "admin with name  ".$full_name." is viewing user logs ";
	LoadUser($userid, $full_name, $admin_email, $function);

	$allData =getLog();
	?>
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<?php include "../include/admin_header.php"; ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>View activity log</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">View activity log</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 ">
							<?php
							if (isset($_SESSION['errors'])) {
								echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
							}else if(isset($_SESSION['success'])){
								echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
							}
							?>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				
				<!-- Export Datatable start -->
				<div class="card-box mb-30"><br>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export " width="100%">
							<thead>
								<tr>
									<th > </th>
									<th class="table-plus datatable-nosort">name</th>
									<th>email</th>
									<th>action performed</th>
									<th>device</th>
									<th>medium</th>
									<th>link visited</th>
									<th>dates</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(!empty($allData)){
								foreach ($allData as $key => $value) {
									echo '
									<tr>
									<td >'.($key +1).'</td>
									<td class="table-plus">'.$value["fullname"].'</td>
									<td>'.$value["email"].'</td>
									<td style="width:40%;">'.$value["function_per"].'</td>
									<td>'.$value["platform"].'</td>
									<td>'.$value["userAgent"].' </td>
									<td>'.$value["href"].'</td>
									<td>'.$value["dates"].'</td>
									</tr>
								';
								}
							}
								 ?>
								
								
							</tbody>
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>
	<!-- standard js files here -->
	<?php include "../include/footer.php";  ?>
	<!-- standard js files here ended -->
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="../vendors/scripts/datatable-setting.js"></script></body>
	<?php unset($_SESSION['success']); unset($_SESSION['errors']); ?>
</html>