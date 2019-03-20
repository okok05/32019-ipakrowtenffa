<?php
session_start();
 if(isset($_SESSION['id_Employer']))
   header('location:indexOfficial.php');
 else
 {
	 $url = 'http://localhost/pksol/exactarget/indexOfficial.php';
	  if(isset($_GET['fromURL']))
	    $url = $_GET['fromURL'];
  }
// The Name O Script " 0_...... " 


$APP_NAME = "ExacTarget v2.0";

$INFO = array('URL' => 'http://45.56.93.78/Exactargetv2/','TITLE'=>'Welcom to '.$APP_NAME);

//$login = array("username"=>'Med',"id"=>12,"name_type_employer"=>"Mailer");


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $INFO['TITLE']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="<?php echo $INFO['URL'];?>image/logo.png">
	
	<!-- Css Includes , Plugins
		Bootstrap 	v 4.0 		https://getbootstrap.com/
	-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
	
	<!-- Font Montserrat
		https://fonts.google.com/specimen/Montserrat?selection.family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans
	-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<style type="text/css"> body{ font-family: 'Montserrat', sans-serif; } </style>
	<!-- /Font Montserrat -->

	<!-- Css Custom Style -->
	<style type="text/css">
	.my-auto{
		position: relative;
		top: 50%;
		transform: translateY(-50%);
	}
	.mx-auto{
		display: block;
		margin: auto;
		vertical-align: center;
	}
	.bg-dark-alpha{
		background: rgba(0,0,0,.2);
	}
	.bg-light-alpha{
		background: rgba(255,255,255,.2);	
	}
	.bg-image{
	  position: relative;
	  overflow: hidden;
	  background-size:0;
	  z-index: 1;
	  
	}
	.bg-image::before{
	  position: absolute;
	  top: 0;
	  bottom: 0;
	  right: 0;
	  left: 0;
	  content: "";
	  z-index: -1;
	  width: 100%;
	  height: 100%;
	  background-size: 150%;
	  background-image: inherit;
	  background-position: center;
	  opacity: .3;
	  transition: all .2s;
	}
	.text-orange{
		color : orange;
	}
	.transformSlow{
		transition: all .2s;
	}
	</style>

</head>
<?php

$HomeContent = <<<HomeContent
<img src="{$INFO['URL']}image/logo.png" class="mx-auto" width="100px">
<div class='m-auto' >
	<h1 class="text-center" style="font-weight: 100 "> {$APP_NAME} </h1>
	<h2 class="text-center text-info " style="font-weight: 400 "> v 2.0 </h2>
</div>
HomeContent;


$colsStyleNav 		= ( $login ? "col-2 " : "col-lg-3 col-md-4 col-sm-12" ) ; 
$colsStyleContent	= ( $login ? "col"    : "col-lg-9 col-md-8 col-sm-12 d-none d-sm-block" ) ; 
//$colsStyleContent	= "col" ; 

?>
<body class="bg-dark text-dark ">
	<div id="0_page_content" class="container-fluid ">
		<?php if( $login){ ?>
		<div class="row bg-dark text-light">
			<div class="<?php echo $colsStyleNav?> bg-light-alpha py-2">Nar Brand</div>
			<div class="<?php echo $colsStyleContent?>"></div>
		</div>
		<?php }?>
		<div class="row" style="min-height:100vh">

			<div class="<?php echo $colsStyleNav?> p-0 bg-dark text-info" id="navHoresontal">
			<div class="my-auto m-auto p-3" style="max-width: 400px" >
			<div class="d-block d-sm-none mb-5">
		<?php echo $HomeContent?>
	</div>
	           
				<form action="index_post.php" method="POST">
	  <div class="form-group">
	    <label for="InputUsername"> <i class="fas fa-user-circle"></i> Username </label>
	    <input type="text" name="txtUsername"class="form-control" id="InputUsername" aria-describedby="usernameHelp" placeholder="Enter Username">
		
	  </div>
	  <div class="form-group">
	    <label for="InputPassword"> <i class="fas fa-lock"></i> Password</label>
	    <input type="password" * class="form-control"  name="txtPassword" id="InputPassword" placeholder="Password">
		
	  </div>
	  <input type="submit" name="submit" class="btn btn-outline-warning mx-auto" value="SignIn" >
      <input type="hidden" name="fromURL" value="<?php echo $url;?>"/>
	</form>
	</div>
			</div>
			<div class="<?php echo $colsStyleContent?> p-0 bg-warning bg-image " style="background-image:url( <?php echo $INFO['URL']?>image/landscape-nature-wallpapers.png )">
				
				
					<div id="0_navCenter" class="bg-dark-alpha d-none"><p class="lead">Navbar</p></div>
					<div class="my-auto text-center ">
						<?php echo $HomeContent?>
					</div>
				

			</div>
		</div>

	</div>
	<!-- Javascript's Include , Plugins

 		Bootstrap 	v 4.0 		https://getbootstrap.com/
		jQuery 		v 3.3.1 	https://jquery.com/
		popper.js 	v 1.12.9
		fontawesome v 5.0.9 	https://fontawesome.com/
	-->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" ></script>
	<script type="text/javascript">
		//$("#navHoresontal").hide();
	</script>
</body>	
</html>