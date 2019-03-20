<?php

 include_once('../Includes/sessionVerificationMailer.php'); 
 $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 verify($monUrl);

 header("Access-Control-Allow-Origin: *");
 date_default_timezone_set('UTC');
 include('../Includes/bdd.php');
 
 $emailTestPost     	 = $_POST['txtEmailTest'];
 $returnPathOriginal     = $_POST['txtReturnPath'];
 $headerOriginal 		 = $_POST['txtHeader'];
 $bodyOriginal			 = $_POST['txtBody'];
 $tab_ips				 = $_POST['txtIPS'];
 $file					 = $_POST['txtFILE'];
 $idMailer 				 = $_SESSION['id_Employer'];
 //echo $idMailer;
 $ch = curl_init();
 //var_dump($tab_ips);
 //exit;

 
	foreach($tab_ips as $id_ip)
	{
		
			
			
		$requete = $bdd->prepare('select I.IP_IP from ip I where I.id_IP =  ?');
		$requete->execute(array($id_ip));
		$row 	= $requete->fetch();
		$ip		=	trim($row['IP_IP']);
		
		
		
	
		$requete = $bdd->prepare('select d.name_Domain,s.alias_Server from domain d , ip i , server s where i.id_IP = ? and i.id_Domain_IP = d.id_Domain and i.id_Server_IP = s.id_Server');
		$requete->execute(array($id_ip));
		$row = $requete->fetch();
		$domain = $row['name_Domain'];
		$aliasServer = $row['alias_Server'];
		
		
		
       
			
		$fileExplode = explode(PHP_EOL,$file);
		
		if(count($fileExplode)==0)
			$fileExplode[]=0;
		  
		foreach($fileExplode as $val)
		{	   
		
					$explodeEmailTest = explode(PHP_EOL,$emailTestPost);
					
					foreach($explodeEmailTest as $emailTest)
					{
						
					
							$header =    $headerOriginal;
							$body =      $bodyOriginal;
							
							preg_match_all('#\[[a-zA-Z0-9/]+\]#',$header,$out);
							
							foreach($out[0] as $tag)
							{
								$header =    str_replace($tag,strtolower($tag),$header);
							}
							
							preg_match_all('#\[[a-zA-Z0-9/]+\]#',$body,$out);
							
							foreach($out[0] as $tag)
							{
								$body =    str_replace($tag,strtolower($tag),$body);
							}
							
							// Random In Header
							preg_match_all('[random[cd]+/[0-9]+]',$header,$out);
									   
							$chaineChars    ='azertyuiopqsdfghjklmwxcvbn';
							$chaineDigitals ='0123456789';
							$chaineCD       ='a0z1e2r3t4y5u6i7o8p9q0s1d2f3g4h5j6k7l8m9wx0c1v2bn';
							   
							foreach($out[0] as $random)
							{
								$splitRandom = explode('/',$random);
									 
								$typeRandom = $splitRandom[0];
								$numberRandom = $splitRandom[1];
								$concat      = '';
									 
								switch($typeRandom)
								{
									
									case 'randomc':
										
										for($i=0;$i<$numberRandom;$i++)
										{
												 $rand = rand(0,strlen($chaineChars)-1);
												 $concat.=$chaineChars[$rand];
										}
												
										$header = preg_replace("#\[randomc/$numberRandom+\]#",$concat,$header,1);
										
									break;
											 
											 
									case 'randomd':
									
										for($i=0;$i<$numberRandom;$i++)
										{
												 $rand = rand(0,strlen($chaineDigitals)-1);
												 $concat.=$chaineDigitals[$rand];
										}
										
										$header = preg_replace("#\[randomd/$numberRandom+\]#",$concat,$header,1);
										
									break;
											 
											 
									case 'randomcd':
									
											for($i=0;$i<$numberRandom;$i++)
											{
												 $rand = rand(0,strlen($chaineCD)-1);
												 $concat.=$chaineCD[$rand];
											}
											
											$header = preg_replace("#\[randomcd/$numberRandom+\]#",$concat,$header,1);
											
									break;
										 
										 
								}
								
							}
							 

							
							
							// Random In Body
							preg_match_all('[random[cd]+/[0-9]+]',$body,$out);
									   
							$chaineChars    ='azertyuiopqsdfghjklmwxcvbn';
							$chaineDigitals ='0123456789';
							$chaineCD       ='a0z1e2r3t4y5u6i7o8p9q0s1d2f3g4h5j6k7l8m9wx0c1v2bn';
							   
							foreach($out[0] as $random)
							{
								$splitRandom = explode('/',$random);
									 
								$typeRandom = $splitRandom[0];
								$numberRandom = $splitRandom[1];
								$concat      = '';
									 
								switch($typeRandom)
								{
									
									case 'randomc':
										
										for($i=0;$i<$numberRandom;$i++)
										{
												 $rand = rand(0,strlen($chaineChars)-1);
												 $concat.=$chaineChars[$rand];
										}
												
										$body = preg_replace("#\[randomc/$numberRandom+\]#",$concat,$body,1);
										
									break;
											 
											 
									case 'randomd':
									
										for($i=0;$i<$numberRandom;$i++)
										{
												 $rand = rand(0,strlen($chaineDigitals)-1);
												 $concat.=$chaineDigitals[$rand];
										}
										
										$body = preg_replace("#\[randomd/$numberRandom+\]#",$concat,$body,1);
										
									break;
											 
											 
									case 'randomcd':
									
											for($i=0;$i<$numberRandom;$i++)
											{
												 $rand = rand(0,strlen($chaineCD)-1);
												 $concat.=$chaineCD[$rand];
											}
											
											$body = preg_replace("#\[randomcd/$numberRandom+\]#",$concat,$body,1);
											
									break;
										 
										 
								}
								
							}
							
							
							
							   
							$to         = $emailTest;
							 $link = substr($to, 0, strrpos($to, '@'));  
							$returnPath = $returnPathOriginal;
							$returnPath = preg_replace('#\[domain\]#',$domain,$returnPath);
							$returnPath = preg_replace('#\[file\]#',$val,$returnPath);
							$returnPath = preg_replace('#\[ip\]#',$ip,$returnPath);
							
							$date = date(DATE_RFC2822);
							 
	   
	                         
							$header =    preg_replace('#\[file\]#',$val,$header);
							$header =    preg_replace('#\[sr\]#',$aliasServer,$header);
							$header =    preg_replace('#\[ip\]#',$ip,$header);
							$header =    preg_replace('#\[date\]#',$date,$header);
							$header =    preg_replace('#\[to\]#',$to,$header);
							$header =    preg_replace('#\[domain\]#',$domain,$header);
							$header =      preg_replace('#\[link\]#',$link,$header); 

							$body =      preg_replace('#\[link\]#',$link,$body); 
							$body =      preg_replace('#\[domain\]#',$domain,$body);
							$body =      preg_replace('#\[file\]#',$val,$body); 
							$body =      preg_replace('#\[ip\]#',$ip,$body);
							
							$split = explode(PHP_EOL,$header);
							$from = '';
							   
							$fromName  = '';
							$fromEmail = '';
								  
							foreach($split as $line)
							{
								$params = explode(':',$line);

								if(strtolower($params[0]) == 'fromname')
								   $fromName = $params[1];
								  
								if(strtolower($params[0]) == 'fromemail')
								   $fromEmail = $params[1];
							}
							   
							$from=$fromName.$fromEmail;
							   
							$headerTelNet = '';
							  
							foreach($split as $line)
							{
								$params = explode(':',$line,2);
								  
								if(strtolower($params[0]) == 'fromname')
								   $headerTelNet.="from:$from\n";
								   
								else
								{
									if(strtolower($params[0]) != 'fromemail')
									  $headerTelNet.=$params[0].':'.trim($params[1])."\n";
								}
								  
							}
							   
							$headerTelNet.="x-job:0-0-$idMailer-0\nx-virtual-mta: mta-$ip\n$body\n.\n";
							   

							/*$chaine = 'ip='.$ip.'&domain='.$domain.'&returnPath='.$returnPath.'&to='.$to.'&header='.$headerTelNet;
							   

							curl_setopt($ch, CURLOPT_URL,'http://'.$ip.'/exactarget/Send/TestGlobal_POST.php');
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS,$chaine);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$server_output = curl_exec ($ch);*/

							
							
							
							if($ip == 'IP')
							  $url = 'http://45.56.93.78/exactarget/Send/TestGlobal_POST.php';
						  
						    else
							  $url = 'http://'.$ip.'/exactarget/Send/TestGlobal_POST.php';
						  
							$fields = array(
								'ip' 		 => urlencode($ip),
								'domain'     => urlencode($domain),
								'returnPath' => urlencode($returnPath),
								'to'         => urlencode($to),
								'header'     => urlencode($headerTelNet)
							);


							foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');

							
							curl_setopt($ch,CURLOPT_URL, $url);
							curl_setopt($ch,CURLOPT_POST, count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							
							$result = curl_exec($ch);
							if(strlen($result)==0)
							  echo 'Cant connect to this ip : '.$ip.'<br/>';
				    }
					//END FILE EXPLODE
		}
		
	  
		
	}
	echo '/Email Test Finished';
 
 //curl_close ($ch);
?>
