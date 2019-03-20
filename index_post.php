<?php
session_start();
include('Includes/bdd.php');
$login = $_POST['txtUsername'];
$password = $_POST['txtPassword'];
$fromURL  = $_POST['fromURL'];



if($login == "USER" && $password =="PASS")
{
      $_SESSION['id_Employer'] 					= 0;
	  $_SESSION['firstName_Employer']		    = "ADMIN";
	  $_SESSION['lastName_Employer'] 			= "ADMIN";
	  $_SESSION['id_type_Employer_Employer'] 	= 0;
	  $_SESSION['id_Isp_Employer'] 				= 0;
	  $_SESSION['type_Employer'] 				= "IT";
	  header('location:'.$fromURL);
}
else
{
	$requete = $bdd->prepare('select id_Employer,firstName_Employer,lastName_Employer,id_type_Employer_Employer,id_Isp_Employer from employer where lastName_Employer = ? and password_Employer = ?');
	$requete->execute(array($login,$password));
	$row = $requete->fetch();
	if($row)
	{
	  $_SESSION['id_Employer'] 					= $row['id_Employer'];
	  $_SESSION['firstName_Employer']		    = $row['firstName_Employer'];
	  $_SESSION['lastName_Employer'] 			= $row['lastName_Employer'];  
	  $_SESSION['id_type_Employer_Employer'] 	= $row['id_type_Employer_Employer'];
	  $_SESSION['id_Isp_Employer'] 				= $row['id_Isp_Employer'];
	  
	  $requete = $bdd->prepare('select name_type_Employer from type_employer where id_type_Employer = ?');
	  $requete->execute(array($row['id_type_Employer_Employer']));
	  $row = $requete->fetch();
	  $_SESSION['type_Employer'] = $row['name_type_Employer'];
	  header('location:'.$fromURL);
	} 
	else
	header('location:index.php');
}

?>
