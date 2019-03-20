<?php


error_reporting(-1);
	date_default_timezone_set('UTC');
	 include_once('../Includes/sessionVerification.php'); 
	 $monUrl       = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 verify($monUrl);
	 

    include('../Includes/bdd.php');
	
   
	$name_Domain   			   		   = $_POST['txtDomainName'];
	$saleDate_Domaine   			   = $_POST['txtDateSale'];
	$expirationDate_Domain   		   = $_POST['txtDateExpiration'];
	$id_Domain_Provider_Domain   	   = $_POST['cmbDomainProvider'];
	
	$date 					           = new DateTime($saleDate_Domaine);
	$saleDate_Domaine			       = $date->format('Y-m-d');
	
	$date 					           = new DateTime($expirationDate_Domain);
	$expirationDate_Domain 		       = $date->format('Y-m-d');


  if(isset($_POST['id_Domain']))
   {
      $text = $_POST['txtDomainName'];
      $textAr = explode("\n", $text);
	   foreach ($textAr as $line) {
       $id_Domain = $_POST['id_Domain'];
	   $requete   = $bdd->prepare('update domain set name_Domain = ? , saleDate_Domaine = ? , expirationDate_Domain = ? , id_Domain_Provider_Domain = ? where id_Domain = ?');
	   $requete->execute(array($line,$saleDate_Domaine,$expirationDate_Domain,$id_Domain_Provider_Domain,$id_Domain));
	   }
   }
   else
   
      $text = $_POST['txtDomainName'];
      $textAr = explode("\n", $text);
	   foreach ($textAr as $line) {
        
		$lines = trim($line);
		$requete   = $bdd->prepare('insert into domain Values(?,?,?,?,?)');
		$requete->execute(array(NULL, trim( $lines ) ,$saleDate_Domaine,$expirationDate_Domain,$id_Domain_Provider_Domain));

		/*
		$requete   = $bdd->prepare('INSERT INTO  domain VALUES (NULL,:line,:saleDate_Domaine,:expirationDate_Domain,:id_Domain_Provider_Domain) ');
		$requete->bindParam(":line",$line,PDO::PARAM_STR);
		$requete->bindParam(":saleDate_Domaine",$saleDate_Domaine,PDO::PARAM_STR);
		$requete->bindParam(":expirationDate_Domain",$expirationDate_Domain,PDO::PARAM_STR);
		$requete->bindParam(":id_Domain_Provider_Domain",$id_Domain_Provider_Domain,PDO::PARAM_INT);
		$requete->execute();
		*/
		}
    header('location:ShowDomains.php');
	

?>