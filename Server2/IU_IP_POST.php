<?php
	
	 include_once('../Includes/sessionVerification.php'); 
	 $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 verify($monUrl);
	 

    include('../Includes/bdd.php');
   
    $id_Server = $_POST['id_Server'];
   
    // UPDATE
    if(isset($_POST['id_IPS']))
    {
    
      $nbrIPS = sizeof($_POST['id_IPS']);
	  $ips = $_POST['txtIP'];
	  $domains = $_POST['cmbDomain'];
	  
		  for($i=0;$i<sizeof($_POST['id_IPS']);$i++)
		  {
			 $idIP = $_POST['id_IPS'][$i];
			 $ip = $ips[$i];
			 $domain = $domains[$i];
			 
			 $requete = $bdd->prepare('update ip set IP_IP = ? , id_Domain_IP = ? where id_IP = ?');
			 $requete->execute(array($ip,$domain,$idIP));
		  } 
	  
		  $totalIPS = sizeof($_POST['txtIP']);
		  if($totalIPS > $nbrIPS)
		  {
			 for($i=$nbrIPS;$i<$totalIPS;$i++)
			 {
				 $ip = $ips[$i];
				 $domain = $domains[$i];
				 
				 $requete = $bdd->prepare('insert into ip Values(?,?,?,?)');
				 $requete->execute(array(NULL,$ip,$domain,$id_Server));
			 }
		  }
	  
   }
   
   //UPDATE
   else
   {
      $ips = $_POST['txtIP'];
	  $domains = $_POST['cmbDomain'];
	  
	  for($i=0;$i<sizeof($ips);$i++)
	  {
	      $ip = $ips[$i];
		  $domain = $domains[$i];
		  
		  $requete = $bdd->prepare('insert into ip Values(?,?,?,?)');
		  $requete->execute(array(NULL,$ip,$domain,$id_Server));
		  if($i==0)
		  {
		     $idIpMain = $bdd->lastInsertId();
			 $requete = $bdd->prepare('update server set id_IP_Server = ? where id_Server = ?');
			 $requete->execute(array($idIpMain,$id_Server));
		  }
	  }
   }
   
   header('location:ShowServers.php');
   
   
	
   
	
?>