<?php
try 
{
	//$bdd = new PDO('mysql:host=localhost;dbname=exactarget', 'YOUR_USR', 'YOUR_PASS');
$bdd= new PDO('mysql:host=localhost;dbname=exactarget','root','');
// $bdd= new PDO('mysql:host=localhost;dbname=exactarget','root','?a_f2HdQ&WEn/3$Q');
}
catch (Exception $e) // On va attraper les exceptions "Exception" s'il y en a une qui est levée
{
	echo 'Error Connection';
}
catch (PDOException $e) // On attrape les exceptions PDOException.
{
  echo 'Error Connection';
  //echo 'Informations : [', $e->getCode(), '] ', $e->getMessage(); 
}
?>
