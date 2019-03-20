<?php
	 include_once('../Includes/sessionVerificationMailer.php'); 
	 $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 verify($monUrl);
	 
	 
	function	format_lists($p_str_mixed_lists)
	{
		return str_replace(',','<br/>',$p_str_mixed_lists);
	}
	 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EXT - Send History</title>
	
	<style>

	</style>
	
    <?php include('../Includes/css.php');?>
	<?php include('../Includes/js.php');?>
	
	<script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="datatables4_basic.js"></script>

	
	
	
	
	
</head>

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
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"></span>Send History</h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="../indexOfficial.php">Send</a></li>
							<li class="active">Send History</li>
						</ul>

			
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Form horizontal -->
					<div class="panel panel-flat">
					    <div class="panel-body">
					
							<table class="table datatable-basic">
							<thead>
								<tr>
									<th>ID SEND</th>
									<th>Creative</th>
									<th>ISP</th>
									<!--<th>Mailer</th>-->
									<th>Offer</th>
									<th>From</th>
									<th>Subject</th>
									<th>Mixed Lists</th>
									
								</tr>
							</thead>
							
							<tbody>
							
							<?php
							    include('../Includes/bdd.php');
								
								$idMailer = $_SESSION['id_Employer'];
								
								$requete = $bdd->prepare
								('
									SELECT		O.name_Offer,S.id_Send,F.text_From,SB.text_Subject,C.name_Creative,E.lastName_Employer,P.name_isp,P.logo_isp
									FROM		send S,froms F,subjects SB,creatives C,employer E,isp P,offer O
									WHERE		S.id_Offer_Send		=	O.id_offer
									AND			S.id_From_Send		=	F.id_From
									AND			S.id_Subject_Send	=	SB.id_Subject
									AND			S.id_Creative_Send	=	C.id_Creative
									AND			S.id_Employer_Send	=	E.id_Employer
									AND			S.id_ISP_Send		=	P.id_Isp
									ORDER BY	S.id_Send DESC
									LIMIT		0,50
								');
								$requete->execute(array());
								while($row = $requete->fetch())
								{
									$idSend = $row['id_Send'];
									
									$subRequete = $bdd->prepare
									('
										SELECT		SL.id_List,L.name_List,T.abr_TypeList
										FROM		sendlist SL,list L,typelist T
										WHERE		SL.id_Send			=	?
										AND			SL.id_List			=	L.id_List	
										AND			L.id_Type_List		=	T.id_TypeList
										ORDER BY	L.name_List ASC,T.abr_TypeList ASC
									');
									$subRequete->execute(array($idSend));
									$concat='';
									$cptLit	=	0;
									while($subRow = $subRequete->fetch())
									{
										$cptLit++;
										$concat.=$subRow['name_List'].'-'.$subRow['abr_TypeList'].',';
									}
									$concat=rtrim($concat,',');
									?>
									  <tr>
									    <td><?php echo $row['id_Send'];?></td>
										<td><a class='lnkShowModalCreative' data-toggle="modal" data-target="#mdl-creative" id="<?php echo $row["name_Creative"];?>"><img src="<?php echo '../../Creatives/'.$row["name_Creative"];?>" width="50px;"height="50px;"/></a></td>
										<td><img src="<?php echo '../ISP/Images/'.$row["logo_isp"];?>" width="32px;"height="32px;"/></td>
										<!--<td><?php //echo $row['lastName_Employer'];?></td>-->
										<td><?php echo $row['name_Offer'];?></td>
										<td><?php echo $row['text_From'];?></td>
										<td><?php echo $row['text_Subject'];?></td>
										<td style='cursor:pointer;'><span class="label bg-success-400" data-popup="tooltip" data-html="true" data-placement="left" data-original-title="<?php echo format_lists($concat);?>"><?php echo $cptLit;?></span></td>
									  </tr>
									<?php
								}
							   
							?>
								
								
							</tbody>
						</table>
					
					    </div>
					</div>
					<!-- /form horizontal -->

					<!-- Modal Creative -->
					<div id="mdl-creative" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-info">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
									<div id="div-mdl-img">
										
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal Creative -->
					
					
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

<script>
	$('.lnkShowModalCreative').click(function()
	{
		var image_name =	$(this).attr('id');
		$('#div-mdl-img').html('<center><img src="../../Creatives/'+image_name+'" title="'+image_name+'" /></center>');
	});
</script>



