<?php
     ini_set ('magic_quotes_gpc', 0);
	 include_once('../Includes/sessionVerificationMailer.php'); 
	 $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 verify($monUrl);
	 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Download DATA</title>
	
	
	
	
	
    <?php include('../Includes/css.php');?>
	<?php include('../Includes/js.php');?>
	
	<script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="../assets/js/pages/form_select2.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="../assets/js/pages/picker_date.js"></script>
	
	

</head>

<body>
	<?php include('../Includes/navbar.php');?>
    
<input id='id_Employer' value="<?php echo $_SESSION['id_Employer'];?>"></input>

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
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Prepare</span> - Send</h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="../indexOfficial.php">Prepare Send</a></li>
						</ul>

			
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Form horizontal -->
					<div class="panel panel-flat">
					<div class="panel-body">
					<div id="loading"> 	<center><span class="label bg-success "> Downloading supprission file...</span> <img src="loadingg.gif"/> </center> </div>
					<form class="form-horizontal" method="POST" action="prepareSendPost.php">
					
					    <fieldset class="content-group">
									<legend class="text-bold">Prepare Send</legend>

									<div class="form-group">
										<label class="control-label col-lg-2"></label>
											<center>
											<table>
									
										    <tr>

											 <td style="padding-right:50px;padding-bottom:50px;">
											 <span class="label bg-success heading-text">ISP</span><br/>
											 <select name="cmbIsps" id="cmbIsps" class="select-clear" data-placeholder="Select ISP" style="width:200px;">
											 <option value="-1">Please Select...</option>
												 
												 <?php
												    $requete = $bdd->query('select * from isp');
													while($row = $requete->fetch())
													{
													   ?> <option value="<?php echo $row['id_Isp'];?>"><?php echo $row['name_isp'];?></option><?php
													} 
												 ?>
											   </select>
											 
											 
											 </td>
											 
											 	<td style="padding-right:50px;padding-bottom:50px;">
											    <span class="label bg-success heading-text">Country</span><br/>
												
											   <select name="cmbCountry" id="cmbCountry" class="select-clear" data-placeholder="Select Country" style="width:200px;">
											   <option value="-1">Select Country...</option>
												   <?php
												     $requete = $bdd->query('select * from country');
													 while($row = $requete->fetch())
													 {
													   ?> <option value="<?php echo $row['id_Country'];?>"><?php echo $row['name_Country'];?></option><?php
													 } 
												   ?>
											   </select>
											   
										        </td>
											 
				
										  </tr>

										  
										  
								 
										  
										  <tr>
										    <td colspan="3">
											    
												<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="background-color:#FFF;border-left:4px solid #2196F3;">
												
												</div>
											
											</td>
											
										  </tr>
										  
										  
										</table></center>
										
										
									</div>
									
<br/>	<br/>
<legend class="text-bold"></legend>	
<center>			
<div class="form-group">
<label class="control-label col-lg-2"></label>								
</div>							
									
						</fieldset>
							
					<input type="hidden" name="idCreative" id="idCreative"/>
					
					<center>
					<div id="divTotalCount" class="bg-blue" style="border-bottom:4px solid orange;">
					  <h3 style="display:inline-block;">Total Mixed : </h3><h3 style="position:relative;left:50px;display:inline-block;" id="spanTotalMixed">0</h3>
					</div>
					</center>
					
					<legend class="text-bold">DATA</legend>
					
					<center>					
						<table id="tableData" class="table table-bordered table-striped">

						</table>
					</center>
			
			               <br/>
								<div class="text-right">
									<button id ="bnt_create_send" type="submit" class="btn btn-primary">Download<i class="icon-arrow-right14 position-right"></i></button>
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

	<script>
	
	//$('#tableData').hide();
	
//$('#tableData').hide();
	
	// @author ANI Fatima zahra 
	// show loading while deleting emails :
	$('#loading').hide();

	
	document.getElementById("id_Employer").disabled = true;
	$('#id_Employer').hide();

	var idMailer= document.getElementById("id_Employer").value;


	$('#cmbOffers').change(function(){
		var idOffer = $(this).val();
		

		$('#loading').show();				
	    document.getElementById("bnt_create_send").disabled = true;
	    
		//alert(idMailer);
		$.post
			(
				'../Offer/Suppression/api_suppression_file.php',
				{id_Offer:idOffer},
				function(ajax_return)
				{
					console.log(ajax_return);
					alert(ajax_return);
					$('#loading').hide();
					document.getElementById("bnt_create_send").disabled = false; 
				}
			);
		

		   
		$.post('ajax.php',{type:'from',id_Offer:idOffer},function(data){
		$('#cmbFroms').html(data);
		});
		   
		$.post('ajax.php',{type:'subject',id_Offer:idOffer},function(data){
		$('#cmbSubjects').html(data);
		 });
		   
		$.post('ajax.php',{type:'creative',id_Offer:idOffer},function(data){
		$('.carousel').html(data);
		idCreative = $('.active:eq(0)').children().attr('id');
		$('#idCreative').val(idCreative);
		   });
		   
		    
		   
		});
	
	
	
	var cpt   = 0;
	
	
	$('#divTotalCount').hide();
	
	
	
	$('#lineNegative').hide();
	
	$('.carousel').carousel({
  interval: 0
		});
		
		$('#cmbSponsors').change(function(){
		   $('#cmbVerticals').val('-1');
		   $('#cmbFroms').html('');
		   $('#cmbSubjects').html('');
		   $('.carousel').html('');
		   var idSponsor = $(this).val();
		   $.post('ajax.php',{type:'sponsor',id_Sponsor:idSponsor},function(data){
		      $('#cmbOffers').html(data);
		   });
		});
		
		$('#cmbVerticals').change(function(){
		   $('#cmbFroms').html('');
		   $('#cmbSubjects').html('');
		   $('.carousel').html('');
		   var idVertical = $(this).val();
		   var idSponsor = $('#cmbSponsors').val();
		   
		   $.post('ajax.php',{type:'vertical',id_Sponsor:idSponsor,id_Vertical:idVertical},function(data){
		      $('#cmbOffers').html(data);
		   });
		});
		
		

		
		
		$('#cmbCountry').change(function(){
		
		   $('#spanTotalMixed').html('0');
		   $('#divTotalCount').show();
		   $('#lineNegative').hide();
		   
		   $('#tableData').html('');
		   var nameISP = $('#cmbIsps option:selected').text();
		   var country = $(this).val();
		   
		   if(nameISP!='warm up')
		    {
			   var idIsp = $("#cmbIsps").val();
			   $.post('ajax.php',{type:'isp',id_Isp:idIsp,country:country},function(data)
			   {
				  $('#tableData').html(data);
				  $('#tableData').show();
				
				// @author ANI Fatima zahra 
				
				   $('#Check_All').on('change', function() 
					{
						var total_fresh=document.getElementById("total_fresh").innerHTML;
						var total_delivered=document.getElementById("total_delivered").innerHTML;
						var total_openers=document.getElementById("total_openers").innerHTML;
						var total_clickers=document.getElementById("total_clickers").innerHTML;
						var total_unsubscribers=document.getElementById("total_unsubscribers").innerHTML;
						
						var fresh = Number(total_fresh);
						var delivered = Number(total_delivered);
						var openers = Number(total_openers);
						var clickers = Number(total_clickers);
						var unsubscribers = Number(total_unsubscribers);
						var sum=fresh+delivered+openers+clickers+unsubscribers;
						
						
						if (this.checked == true)
						{
							$('#tableData').find('input[name^="chkList"]').prop('checked', true);
							var check_all_f = document.getElementById("Check_All_Fresh");
							   if (check_all_f.checked==false)
							   {
								   check_all_f.checked=true;
							   }
							   
							var check_all_d = document.getElementById("Check_All_Delivered");
								if (check_all_d.checked==false)
							   {
								   check_all_d.checked=true;
							   }
							   
							var check_all_o = document.getElementById("Check_All_Openers");
							if (check_all_o.checked==false)
							   {
								   check_all_o.checked=true;
							   }
							var check_all_c = document.getElementById("Check_All_Clickers");
							if (check_all_c.checked==false)
							   {
								   check_all_c.checked=true;
							   }
							   
							var check_all_u = document.getElementById("Check_All_Unsubscribers");
							
							if (check_all_u.checked==false)
							   {
								   check_all_u.checked=true;
							   }
							
							
							cpt=sum;
							$('#spanTotalMixed').html(cpt); 
							//alert(cpt);

						}
						else
						{
							$('#tableData').find('input[name^="chkList"]').prop('checked', false);
							
							var check_all_f = document.getElementById("Check_All_Fresh");
							   if (check_all_f.checked==true)
							   {
								   check_all_f.checked=false;
							   }
							   
							var check_all_d = document.getElementById("Check_All_Delivered");
								if (check_all_d.checked==true)
							   {
								   check_all_d.checked=false;
							   }
							   
							var check_all_o = document.getElementById("Check_All_Openers");
							if (check_all_o.checked==true)
							   {
								   check_all_o.checked=false;
							   }
							var check_all_c = document.getElementById("Check_All_Clickers");
							if (check_all_c.checked==true)
							   {
								   check_all_c.checked=false;
							   }
							   
							var check_all_u = document.getElementById("Check_All_Unsubscribers");
							
							if (check_all_u.checked==true)
							   {
								   check_all_u.checked=false;
							   }
							
							cpt=0;
							$('#spanTotalMixed').html(cpt); 
						}
				    });
				// @author ANI Fatima zahra 	
					$('#Check_All_Fresh').click(function()
					{
						var count=0;					
						var checkboxes = document.getElementsByName('chkList[]');
						var total_fresh=document.getElementById("total_fresh").innerHTML;
						
						if (this.checked == true)
						{
												
							for (var i=0; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==false)
								{
									checkboxes[i].checked=true;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt+=count;
									
								}
								
							}
							
							
							$('#spanTotalMixed').html(cpt); 
														
						}
						else
						{
							
							for (var i=0; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==true)
								{
									checkboxes[i].checked=false;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt-=count;
									
								}
							}
							
							$('#spanTotalMixed').html(cpt);
												
							
						}
				    });
					
					// @author ANI Fatima zahra 
					$('#Check_All_Delivered').on('change', function() 
					{
						var count=0;
						var checkboxes = document.getElementsByName('chkList[]');
						var total_fresh=document.getElementById("total_delivered").innerHTML;
						
						if (this.checked == true)
						{
												
							for (var i=1; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==false)
								{
									checkboxes[i].checked=true;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt+=count;
									
								}
								
							}
							
							
							$('#spanTotalMixed').html(cpt); 
														
						}
						else
						{
							
							for (var i=1; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==true)
								{
									checkboxes[i].checked=false;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt-=count;
									
								}
							}
							
							
							$('#spanTotalMixed').html(cpt);
												
							
						}
						
				    });
					// @author ANI Fatima zahra 
					$('#Check_All_Openers').on('change', function() 
					{
						var count=0 ;
						var checkboxes = document.getElementsByName('chkList[]');
						var total_fresh=document.getElementById("total_openers").innerHTML;
						
						if (this.checked == true)
						{
												
							for (var i=2; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==false)
								{
									checkboxes[i].checked=true;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt+=count;
									
								}
								
							}
							
							
							$('#spanTotalMixed').html(cpt); 
														
						}
						else
						{
							
							for (var i=2; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==true)
								{
									checkboxes[i].checked=false;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt-=count;
									
								}
							}
							
							
							$('#spanTotalMixed').html(cpt);
												
							
						}
						
				    });
					// @author ANI Fatima zahra 
					$('#Check_All_Clickers').on('change', function() 
					{
						var count=0;
						var checkboxes = document.getElementsByName('chkList[]');
						var total_fresh=document.getElementById("total_clickers").innerHTML;
						
						if (this.checked == true)
						{
												
							for (var i=3; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==false)
								{
									checkboxes[i].checked=true;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt+=count;
									
								}
								
							}
							
							
							$('#spanTotalMixed').html(cpt); 
														
						}
						else
						{
							
							for (var i=3; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==true)
								{
									checkboxes[i].checked=false;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt-=count;
									
								}
							}
							
							
							$('#spanTotalMixed').html(cpt);
												
							
						}
						
				    });
						
					// @author ANI Fatima zahra 
					$('#Check_All_Unsubscribers').on('change', function() 
					{
						var count =0;
					    var checkboxes = document.getElementsByName('chkList[]');
						var total_fresh=document.getElementById("total_unsubscribers").innerHTML;
						
						if (this.checked == true)
						{
												
							for (var i=4; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==false)
								{
									checkboxes[i].checked=true;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt+=count;
									
								}
								
							}
							$('#spanTotalMixed').html(cpt); 
														
						}
						else
						{
							
							for (var i=4; i<checkboxes.length; i=i+5)
							{
								if (checkboxes[i].checked==true)
								{
									checkboxes[i].checked=false;
									
									count = parseInt($(checkboxes[i]).prev().html());
									cpt-=count;
									
								}
							}
							
							
							$('#spanTotalMixed').html(cpt);
												
							
						}
						
				    });
								
								
  
					
				  	  
				  $('.chkListSelect').click(function()
					{
					  
					  var checkboxes = document.getElementsByName('chkList[]');
					  
					  var count = parseInt($(this).prev().html());
					 // $('.chkListSelect input[name="chkList[1]"]').checked=true;
					  
					  if($(this).prop('checked')==true)
					  {
						  cpt+=count;
						 
					  }
					  else
						  cpt-=count;
					  $('#spanTotalMixed').html(cpt); 
					});


				});
			}
		   
		   if(nameISP == 'hotmail')
			   $('#lineNegative').show();
		});
		
		
		$('#cmbIsps').change(function(){
		   
				$('#tableData').hide();
				$('#cmbCountry').val("-1");
				
		});
		
		$('#carousel-example-generic').on('slid.bs.carousel', function () {
		 idCreative = $('.active:eq(0)').children().attr('id');
		 $('#idCreative').val(idCreative);
		});

		
		$('#cmbFroms').change(function(){
		  var from = $("#cmbFroms option:selected").text();
		  var header = $('#txtHeader').val();
		  var newHeader = '';
		  var explode = header.split('\n');
		  
		  
		  for(var i=0;i<explode.length;i++)
		  {
		     var parametrs = explode[i].split(':');
			 if(parametrs[0]=='fromName')
			 {
			    if(i<explode.length-1)
				 newHeader+='fromName:'+from+'\n';
				else
				newHeader+='fromName:'+from;
			 }
			 else
			 {
			    if(i<explode.length-1)
				 newHeader+=explode[i]+'\n';
				else
				newHeader+=explode[i];
			 }
		  }
		  $('#txtHeader').val(newHeader);
		});
		
		
		
		$('#cmbSubjects').change(function(){
		  var subject = $("#cmbSubjects option:selected").text();
		  var header = $('#txtHeader').val();
		  var newHeader = '';
		  var explode = header.split('\n');
		  
		  
		  for(var i=0;i<explode.length;i++)
		  {
		     var parametrs = explode[i].split(':');
			 if(parametrs[0]=='subject')
			 {
			    if(i<explode.length-1)
				 newHeader+='subject:'+subject+'\n';
				else
				newHeader+='subject:'+subject;
			 }
			 else
			 {
			    if(i<explode.length-1)
				 newHeader+=explode[i]+'\n';
				else
				newHeader+=explode[i];
			 }
		  }
		  $('#txtHeader').val(newHeader);
		});
		
		
		$('#txtBody').keyup(function(){
		   var codeHTML = $(this).val();
		   $('#bodyPreview').html('').html(codeHTML);
		});
		
		$('#txtARList').hide();
		
		$('#chkAR').click(function(){
		   if($(this).is(":checked"))
		     $('#txtARList').show();
		   else
		     $('#txtARList').hide();
		});
		
		
		$('#reloadNegatives').click(function(){
			
			$.post('reloadNegative.php',{},function(data){
				
				$('#cmbNegative').html('').html(data);
				
			});
		});
		
		$('#cmbTarget').change(function(){
			
			var target = $(this).val();
			if(target == "1" || target == "2")
			{
				$("#tableData").hide();
				$('#tdVerticalTarget').show();
			}
				 
			else
			{
				$('#tdVerticalTarget').hide();
				$('#tableData').show();
			}
				
		});
		
		$('#tdVerticalTarget').hide();
	</script>
</body>
</html>
