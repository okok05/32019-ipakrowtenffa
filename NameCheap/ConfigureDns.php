<?php
	 include_once('../Includes/sessionVerification.php'); 
	 $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 verify($monUrl);
	 
	include('../Includes/bdd.php');
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EXT - Configure Dns</title>
	
    <?php include('../Includes/css.php');?>
	<?php include('../Includes/js.php');?>
	

</head>
<style>
#txtListIPs::-webkit-input-placeholder::after {
    display:block;
    content:"Line 2\A Line 3";
}
</style>
<body>
	<?php include('../Includes/navbar.php');?>
    


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
		<?php Include('../Includes/sidebar.php');?>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Configure DNS</span> - Configure DNS</h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="../indexOfficial.php"><i class="icon-home2 position-left"></i> Home</a></li>
							<li>Configure DNS</li>
							<li class="active">Configure DNS</li>
						</ul>

			
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Form horizontal -->
					<div class="panel panel-flat">
					    <div class="panel-body">
					
					<form class="form-horizontal" method="POST" action="ConfigureDNS_POST.php">
					
					    <fieldset class="content-group">
							<legend class="text-bold">Configure DNS</legend>
                             							<div class="form-group">
							<label class="control-label col-lg-2">Domains</label>
								<div class="col-lg-10">
									<input class="form-control" name="DomainName" id="DomainName"  rows="1" placeholder="Domain.com"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2">IPs</label>
								<div class="col-lg-10">
									<textarea class="form-control" name="txtListIPs" id="txtListIPs" cols="10" rows="10" placeholder="Hello"> </textarea>
								</div>
							</div>
						</fieldset>
								
						<div class="text-right">
							<button type="submit" class="btn btn-primary">Configure Dns<i class="icon-arrow-right14 position-right"></i></button>
						</div>
								
								
					</form>
					
					    </div>
					</div>
					<!-- /form horizontal -->

					
					<!-- Footer -->
					<?php include'../Includes/footer.php'; ?>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>

</html>
