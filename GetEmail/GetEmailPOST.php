<?php
	ini_set('display_errors', 1); 
	error_reporting(E_ALL);
	include_once('../Includes/sessionVerificationMailer.php'); 
	$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	verify($monUrl);
	 


    include('../Includes/bdd.php');
	
  
    
	

	 
	
	
	
	
	   

	$mail_id = $_POST['txtListWarmUP']; 
	foreach(preg_split("/((\r?\n)|(\r\n?))/", $mail_id) as $line)
	{
	
	
	$cats = trim($line);
    $query = $bdd->prepare('SELECT DISTINCT email_Email FROM email, vl_clickers WHERE email.id_Email = vl_clickers.id_Email and email.id_Email = :uid');
    $query->bindValue(':uid', $cats, PDO::PARAM_INT);
    $query->execute();
    
	//echo $cats. "<br>";
    while ($row = $query->fetch(PDO::FETCH_ASSOC))
    {
        echo $row['email_Email']. "<br>";
    }

				
	}		
			
    	

?>