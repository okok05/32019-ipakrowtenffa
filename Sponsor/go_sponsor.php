<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<?php
header('Access-Control-Allow-Origin: *');

	include_once('../Includes/sessionVerificationMailer.php'); 
	$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	verify($monUrl);
	 

	if(!isset($_GET))
	{
		exit;
		header('location:../logout.php');
	}
	else
	{
		if(   (isset($_GET['id_sponsor'])) and ($_GET['id_sponsor']>0) )
		{
			include('../Includes/bdd.php');
			$id_sponsor					= $_GET['id_sponsor'];
			$tab_sponsor_credentials	=	get_sponsor_credentials_by_id($id_sponsor);
			if(count($tab_sponsor_credentials)==3)
			{
				$login		=	$tab_sponsor_credentials[0];
				$password	=	$tab_sponsor_credentials[1];
				$login_page	=	$tab_sponsor_credentials[2];
				
			}
		}
	}
    
	function	get_sponsor_credentials_by_id($p_id_sponsor)
	{
		$result	=	array();
		
		if($p_id_sponsor>0)
		{
			include('../Includes/bdd.php');
			$requete = $bdd->prepare('select S.login_sponsor,S.password_sponsor,S.url_login_page_sponsor from sponsor S where S.id_Sponsor = ?');
			$requete->execute(array($p_id_sponsor));
			$row = $requete->fetch();
			if($row)
			{
				$login		=	$row['login_sponsor'];
				$password	=	$row['password_sponsor'];
				$login_page	=	$row['url_login_page_sponsor'];
				
				$result[0]	=	$login;
				$result[1]	=	$password;
				$result[2]	=	$login_page;
			}
		}
		return $result;
	}
	
?>

<?php
	if($id_sponsor==8)
	{
?>		
		<div style='display:none;'>
			<form id='login' action="<?php echo $login_page; ?>" method='post'>
				<input type='hidden' id='uname' name='uname' value="<?php echo $login; ?>" />
				
				<input type='hidden' id='pword' name='pword' value="<?php echo $password; ?>" />
				
				<input id="btnGoToSponsorPage" type='submit' value="Login" />
				
				<input type="radio" value="agent" name="utype" id="utype_agent"  checked/>
								
				<input type="radio" value="advertiser" name="utype" id="utype_adv" />
				
				<input type="hidden" name="action" value="login"/>
			</form>
	
			<script language="javascript">
				// send form request
				var objRequest = new Request
				({
					url: 'http://affiliate.idrivecontrol.com/process.php',
					link: 'ignore',
					onSuccess: function(strResponse)
					{
						var objResponse = JSON.decode(strResponse);

						// successful login
						if(objResponse.success && objResponse['location'])
						{
							window.top.location.href = objResponse['location'];
							
						}
					}
				});

				$('#login').submit(function(objEvent)
				{
					var domLoginForm = $('#login');
					strUType = $( 'utype_agent' ).get( 'checked' ) ? 'agent' : 'advertiser';
					objRequest.send( domLoginForm.toQueryString() + '&utype=' + strUType );
				});
				
				
				
				document.getElementById("btnGoToSponsorPage").click();
				
			
				
				
			</script>	
		</div>
<?php
	}


	if($id_sponsor==12)
	{

		
?>		
		<div style='display:none;'>
			<form id='login' action="<?php echo $login_page; ?>" method='post'>
				<input type='hidden' id='uname' name='uname' value="<?php echo $login; ?>" />
				
				<input type='hidden' id='pword' name='pword' value="<?php echo $password; ?>" />
				
				<input id="btnGoToSponsorPage" type='submit' value="Login" />
				
				<input type="radio" value="agent" name="utype" id="utype_agent"  checked/>
								
				<input type="radio" value="advertiser" name="utype" id="utype_adv" />
				
				<input type="hidden" name="action" value="login"/>
			</form>
	
			<script language="javascript">
				send form request
				var objRequest = new Request
				({
					url: 'http://affiliate.loadsmooth.com/process.php',
					link: 'ignore',
					onSuccess: function(strResponse)
					{

						console.log(strResponse);
						var objResponse = JSON.decode(strResponse);

						// successful login
						if(objResponse.success && objResponse['location'])
						{							
							window.top.location.href = objResponse['location'];
						}
					}
				});

				$('#login').submit(function(objEvent)
				{
					var domLoginForm = $('#login');
					strUType = $( 'utype_agent' ).get( 'checked' ) ? 'agent' : 'advertiser';
					objRequest.send( domLoginForm.toQueryString() + '&utype=' + strUType );
				});
				
				
				
				document.getElementById("btnGoToSponsorPage").click();
				
			
				
				
			</script>	
		</div>	
<?php
	}


	if($id_sponsor==11)
	{
?>		
		<div style='display:none;'>
			<form id='login' action="<?php echo $login_page; ?>" method='post'>
				<input type='hidden' id='uname' name='uname' value="<?php echo $login; ?>" />
				
				<input type='hidden' id='pword' name='pword' value="<?php echo $password; ?>" />
				
				<input id="btnGoToSponsorPage" type='submit' value="Login" />
				
				<input type="radio" value="agent" name="utype" id="utype_agent"  checked/>
								
				<input type="radio" value="advertiser" name="utype" id="utype_adv" />
				
				<input type="hidden" name="action" value="login"/>
			</form>
	
			<script language="javascript">
				// send form request
				var objRequest = new Request
				({
					url: 'http://affiliate.loadsmooth.com/process.php',
					link: 'ignore',
					onSuccess: function(strResponse)
					{
						var objResponse = JSON.decode(strResponse);

						// successful login
						if(objResponse.success && objResponse['location'])
						{
							window.top.location.href = objResponse['location'];
							
						}
					}
				});

				$('#login').submit(function(objEvent)
				{
					var domLoginForm = $('#login');
					strUType = $( 'utype_agent' ).get( 'checked' ) ? 'agent' : 'advertiser';
					objRequest.send( domLoginForm.toQueryString() + '&utype=' + strUType );
				});
				
				
				
				document.getElementById("btnGoToSponsorPage").click();
				
			
				
				
			</script>	
		</div>			
<?php
	}
if($id_sponsor==16)
	{
?>		
		<div style='display:none;'>
			<form id='login' action="<?php echo $login_page; ?>" method='post'>
				<input type='hidden' id='uname' name='uname' value="<?php echo $login; ?>" />
				
				<input type='hidden' id='pword' name='pword' value="<?php echo $password; ?>" />
				
				<input id="btnGoToSponsorPage" type='submit' value="Login" />
				
				<input type="radio" value="agent" name="utype" id="utype_agent"  checked/>
								
				<input type="radio" value="advertiser" name="utype" id="utype_adv" />
				
				<input type="hidden" name="action" value="login"/>
			</form>
	
			<script language="javascript">
				// send form request
				var objRequest = new Request
				({
					url: 'http://affiliate.adgtracker.com/process.php',
					link: 'ignore',
					onSuccess: function(strResponse)
					{
						var objResponse = JSON.decode(strResponse);

						// successful login
						if(objResponse.success && objResponse['location'])
						{
							window.top.location.href = objResponse['location'];
							
						}
					}
				});

				$('#login').submit(function(objEvent)
				{
					var domLoginForm = $('#login');
					strUType = $( 'utype_agent' ).get( 'checked' ) ? 'agent' : 'advertiser';
					objRequest.send( domLoginForm.toQueryString() + '&utype=' + strUType );
				});
				
				
				
				document.getElementById("btnGoToSponsorPage").click();
				
			
				
				
			</script>	
		</div>	
<?php
	}
if($id_sponsor==17)
	{
?>		
		<div style='display:none;'>
			<form id='login' action="<?php echo $login_page; ?>" method='post'>
				<input type='hidden' id='uname' name='uname' value="<?php echo $login; ?>" />
				
				<input type='hidden' id='pword' name='pword' value="<?php echo $password; ?>" />
				
				<input id="btnGoToSponsorPage" type='submit' value="Login" />
				
				<input type="radio" value="agent" name="utype" id="utype_agent"  checked/>
								
				<input type="radio" value="advertiser" name="utype" id="utype_adv" />
				
				<input type="hidden" name="action" value="login"/>
			</form>
	
			<script language="javascript">
				// send form request
				var objRequest = new Request
				({
					url: 'http://affiliate.spheredigitalnetworks.com/process.php',
					link: 'ignore',
					onSuccess: function(strResponse)
					{
						var objResponse = JSON.decode(strResponse);

						// successful login
						if(objResponse.success && objResponse['location'])
						{
							window.top.location.href = objResponse['location'];
							
						}
					}
				});

				$('#login').submit(function(objEvent)
				{
					var domLoginForm = $('#login');
					strUType = $( 'utype_agent' ).get( 'checked' ) ? 'agent' : 'advertiser';
					objRequest.send( domLoginForm.toQueryString() + '&utype=' + strUType );
				});
				
				
				
				document.getElementById("btnGoToSponsorPage").click();
				
			
				
				
			</script>	
		</div>			
<?php
	}
if($id_sponsor==13)
	{
		
		// $Curl_Session 			=	curl_init('https://pullstats.com/api/v1/sessions/');
		// curl_setopt ($Curl_Session, CURLOPT_POST, 1);
		// curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=$login&password=$password");
		
		// $response =	curl_exec($Curl_Session);

		// $info = curl_getinfo($Curl_Session);
		// echo $info["http_code"];
		// curl_close ($Curl_Session);

	 // 	$link = 'https://pullstats.com/api/v1/#affiliates/templogin?api_key=98c8f027-6e43-4acc-98a9-c2afa2fe4196';
		// header('Location: '.$link);

		function get_web_page($url) {
		    $options = array(
		        CURLOPT_RETURNTRANSFER => true,   // return web page
		        CURLOPT_HEADER         => false,  // don't return headers
		        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
		        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
		        // CURLOPT_ENCODING       => "",     // handle compressed
		        // CURLOPT_USERAGENT      => "test", // name of client
		        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
		        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
		        CURLOPT_TIMEOUT        => 120, 
		        CURLOPT_POST 		=> 1,
		        CURLOPT_POSTFIELDS	=> "username=nProMarket2&password=pullstats" // time-out on response
		    ); 

 			$ch = curl_init($url);
		    curl_setopt_array($ch, $options);

		    $content  = curl_exec($ch);

		    $response = json_decode($content);

			$token = $response->data->auth_token;		    

	
		    curl_close($ch);


		    $link = 'https://pullstats.com/api/v1/affiliates/autologin/'.$token;

		header('Location: '.$link);

		
		}
		
		get_web_page("https://pullstats.com/api/v1/sessions/");
		
	

		   

?>

<!-- <div style='display:none;'>
			<form id='login' action="<?php echo $login_page; ?>" method='post'>
				<input type='hidden' id='uname' name='uname' value="<?php echo $login; ?>" />
				
				<input type='hidden' id='pword' name='pword' value="<?php echo $password; ?>" />
				
				<input id="btnGoToSponsorPage" type='submit' value="Login" />
				
				<input type="radio" value="agent" name="utype" id="utype_agent"  checked/>
								
				<input type="radio" value="advertiser" name="utype" id="utype_adv" />
				
				<input type="hidden" name="action" value="login"/>
			</form>
	
			<script language="javascript">
				// send form request
				var objRequest = new Request
				({
					url: 'http://affiliate.pullstats.com/process.php',
					link: 'ignore',
					onSuccess: function(strResponse)
					{
						var objResponse = JSON.decode(strResponse);

						// successful login
						if(objResponse.success && objResponse['location'])
						{
							window.top.location.href = objResponse['location'];
							
						}
					}
				});

				$('#login').submit(function(objEvent)
				{
					var domLoginForm = $('#login');
					strUType = $( 'utype_agent' ).get( 'checked' ) ? 'agent' : 'advertiser';
					objRequest.send( domLoginForm.toQueryString() + '&utype=' + strUType );
				});
				
				
				
				document.getElementById("btnGoToSponsorPage").click();
				
			
				
				
			</script>	
		</div> -->
<?php
	}		
	else
	{
?>
		<div style="display:none;">
			<form id='frmGoToSponsorPage' action="<?php echo $login_page; ?>" method='POST'>
				<input type='hidden' id='username' name='u' value="<?php echo $login; ?>" />
				<input type='hidden' id='password' name='p' value="<?php echo $password; ?>" />
				<input class='btn btn-primary' id="btnGoToSponsorPage" type='submit' />
			</form>
			<script language="javascript">
				document.getElementById("btnGoToSponsorPage").click();
			</script>
		</div>	
<?php		
	}
	
//if($id_sponsor==2)
	//header('Location: http://affiliate.idrivecontrol.com');
?>


	
