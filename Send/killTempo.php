<?php
	
	
	include_once('../Includes/sessionVerificationMailer.php'); 
    $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    verify($monUrl);
	

	
	 $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 verify($monUrl);
	 include('../Includes/bdd.php');
	 
	 
	 
	 $lien    = $_POST['lien'];
	 $pid     = $_POST['pid'];
	 
	 $ch = curl_init();
	 
	 
	 $fields = array(
		'pid' 		 =>      urlencode($pid)
	 );
	
     foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	 rtrim($fields_string, '&');

	 
	 curl_setopt($ch,CURLOPT_URL, $lien);
	 curl_setopt($ch,CURLOPT_POST, count($fields));
	 curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	 $result = curl_exec($ch);
?>