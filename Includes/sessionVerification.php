<?php

	ini_set('session.bug_compat_warn', 0);
	ini_set('session.bug_compat_42', 0);
	session_start();

  
	function verify($path)
	{
		$originalDomain = $_SERVER['HTTP_HOST'];
		if(!isset($_SESSION['type_Employer']) || $_SESSION['type_Employer']=="Mailer" || $_SESSION['type_Employer']=="Team Leader")
		{
			header('location:http://'.$originalDomain.'/exactarget/index.php?fromURL='.$path);
		}
	}
	
	session_write_close();

?>