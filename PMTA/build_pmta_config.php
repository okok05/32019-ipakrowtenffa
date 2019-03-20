<?php	
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$originalConnectionTimeout = ini_get('default_socket_timeout');
ini_set('default_socket_timeout', 5);


if(!isset($_POST))
{
	echo '$_POST is not set';
	exit;
}
else
{
	if(   (isset($_POST['id_server']))  &&  (is_numeric($_POST['id_server']))  &&  ($_POST['id_server']>0)  )
	{
		$id_server	=	$_POST['id_server'];
		if($id_server>0)
		{
			$main_ip	=	trim(getMainIpByServerId($id_server));
			if(!is_null($main_ip))
			{
				$tab_credentials	=	getLoginAndPasswordByIdServer($id_server);
				if(count($tab_credentials)==2)
				{
					$login		=	trim($tab_credentials[0]);
					$password	=	trim($tab_credentials[1]);
					
					//echo $main_ip."_____".$login."____".$password."<br>";
                    
                    
                    $connection = remote_ssh_connection2($main_ip, $login, $password);
                    if(!$connection){
                        echo '*** SSH Connection to remot Server Failed..'."\n";
                        exit();
                    }
                    
                    $rsp = '';
					
					
					
					
					
					//Créer + Uploader : /etc/httpd/conf.d/exactarget.conf
					getHttpdConfigFile($main_ip);
					$sourceHttpdConfigFile	=	'/var/www/exactarget/PMTA/config/exactarget.conf';
					$targetHttpdConfigFile	=	'/etc/httpd/conf.d/exactarget.conf';
                    $msg = 'HTTPD config file';
					$rsp .= uploadFile($sourceHttpdConfigFile,$targetHttpdConfigFile,$connection,0644,$msg);
					delete_file($sourceHttpdConfigFile);
					
                    
                    //Créer + Uploader : /var/named/serverxx.hosts
					generate_dns_zone_file($id_server);
					$sourceDnsZoneFile	=	'/var/www/exactarget/PMTA/config/server'.$id_server.'.hosts';
					$targetDnsZoneFile	=	'/var/named/server'.$id_server.'.hosts';
                    $msg = 'DNS zone file';
					$rsp .= uploadFile($sourceDnsZoneFile,$targetDnsZoneFile,$connection,0644,$msg);
					delete_file($sourceDnsZoneFile);
                    
                    
                    //Créer + Uploader : /etc/named.conf
					generate_dns_configuration($id_server);
					$sourceDnsConf	=	'/var/www/exactarget/PMTA/config/named.conf';
					$targetDnsConf	=	'/etc/named.conf';
                    $msg = 'BIND Configuration file';
					$rsp .= uploadFile($sourceDnsConf,$targetDnsConf,$connection,0644,$msg);
					delete_file($sourceDnsConf);
                    
					
					
					//Créer + Uploader : hostName.txt
					create_hostname_file($id_server);
					$sourceFile	=	'/var/www/exactarget/PMTA/config/hostName.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/hostName.txt';
                    $msg = 'Hostname';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					delete_file($sourceFile);
					
					
					//Créer + Uploader : relayDomain.txt
					create_relay_domain_file($id_server);
					$sourceFile	=	'/var/www/exactarget/PMTA/config/relayDomain.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/relayDomain.txt';
                    $msg = 'Relay Domain';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					delete_file($sourceFile);
					
					
					//Créer + Uploader : smtpListener.txt
					create_smtpListener_file($id_server);
					$sourceFile	=	'/var/www/exactarget/PMTA/config/smtpListener.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/smtpListener.txt';
                    $msg = 'SMTP Listener';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					delete_file($sourceFile);
					
					
					
					//Créer + Uploader : source.txt
					create_source_file($id_server);
					$sourceFile	=	'/var/www/exactarget/PMTA/config/source.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/source.txt';
                    $msg = 'Source';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					delete_file($sourceFile);
					
					
					
					//Créer + Uploader : vmta.txt
					create_vmta_file($id_server);
					$sourceFile	=	'/var/www/exactarget/PMTA/config/vmta.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/vmta.txt';
                    $msg = 'Vmtas';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					delete_file($sourceFile);
					
					
					
					//Créer + Uploader : http.txt
					$sourceFile	=	'/var/www/exactarget/PMTA/config/http.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/http.txt';
                    $msg = 'HTTP';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					
					
					//Créer + Uploader : aol-config.txt
					$sourceFile	=	'/var/www/exactarget/PMTA/config/aol-config.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/aol-config.txt';
                    $msg = 'AOL Config';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					
					
					
					//Créer + Uploader : gmail-config.txt
					$sourceFile	=	'/var/www/exactarget/PMTA/config/gmail-config.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/gmail-config.txt';
                    $msg = 'Gmail Config';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					
					
					
					//Créer + Uploader : hotmail-config.txt
					$sourceFile	=	'/var/www/exactarget/PMTA/config/hotmail-config.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/hotmail-config.txt';
                    $msg = 'Hotmail Config';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					
					
					
					//Créer + Uploader : yahoo-config.txt
					$sourceFile	=	'/var/www/exactarget/PMTA/config/yahoo-config.txt';
					$targetFile	=	'/var/www/exactarget/PMTA/yahoo-config.txt';
                    $msg = 'Yahoo Config';
					$rsp .= uploadFile($sourceFile,$targetFile,$connection,0777,$msg);
					
					
					//Créer + Uploader : /etc/pmta/config
					buildPmtaConfigFile();
					$sourcePmtaConfigFile	=	'/var/www/exactarget/PMTA/config/config';
					$targetPmtaConfigFile	=	'/etc/pmta/config';
                    $msg = 'PMTA config file';
					$rsp .= uploadFile($sourcePmtaConfigFile,$targetPmtaConfigFile,$connection,0777,$msg);
                    unset($connection);
					
					
                    
                    echo $rsp;
				}
				else
				{
					echo 'Login/Password is NULL';
				}
			}
			else
			{
				echo 'Main IP is NULL';
			}
		}
		else
		{
			echo 'id_server<=0';
		}
	}
	else
	{
		echo 'Here';
	}
}

	function	create_hostname_file($p_id_server)
	{
		if(  (is_numeric($p_id_server)) && ($p_id_server>0))
		{
			include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetHostNames  =   
			'
				SELECT		D.name_Domain
				FROM		domain D,ip I
				WHERE		I.id_Domain_IP	=	D.id_Domain
				AND			I.id_Server_IP	=	?
			';
			$cmdGetHostNames  	=   $bdd->prepare($sqlGetHostNames);
			$cmdGetHostNames->execute(array($p_id_server));

			$hostnames_file     =       fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/hostName.txt", "w");
			while($hostNames  	=   	$cmdGetHostNames->fetch())
			{
				$hostName    	=   	$hostNames['name_Domain'];
				$strHostName 	=       "host-name ".trim($hostName)."\r\n";
				fwrite($hostnames_file, $strHostName);
			}
			fclose($hostnames_file);
			$cmdGetHostNames->closeCursor();
		}
	}


	function	create_relay_domain_file($p_id_server)
	{
		if(  (is_numeric($p_id_server)) && ($p_id_server>0))
		{
			include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetRelayDomains  =   
			'
				SELECT		D.name_Domain
				FROM		domain D,ip I
				WHERE		I.id_Domain_IP	=	D.id_Domain
				AND			I.id_Server_IP	=	?
			';
			$cmdGetRelayDomains  =   $bdd->prepare($sqlGetRelayDomains);
			$cmdGetRelayDomains->execute(array($p_id_server));

			$rdomains_file      =       fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/relayDomain.txt", "w");
			while($relayDomain  =   	$cmdGetRelayDomains->fetch())
			{
				$relayDomain    =   	$relayDomain['name_Domain'];
				$strRelayDomain =       "relay-domain ".trim($relayDomain)."\r\n";
				fwrite($rdomains_file, $strRelayDomain);
			}
			fclose($rdomains_file);
			$cmdGetRelayDomains->closeCursor();
		}
	}


	function	create_smtpListener_file($p_id_server)
	{
		if(  (is_numeric($p_id_server)) && ($p_id_server>0))
		{
			include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetServerIPs  =   
			'
				SELECT		I.IP_IP
				FROM		ip I
				WHERE		I.id_Server_IP	=	?
			';
			$cmdGetServerIPs  	=   $bdd->prepare($sqlGetServerIPs);
			$cmdGetServerIPs->execute(array($p_id_server));

			$smtp_listener_file =       fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/smtpListener.txt", "w");
			//fwrite($smtp_listener_file, "smtp-listener 127.0.0.1:25\r\n");
			while($serverIPs  	=   	$cmdGetServerIPs->fetch())
			{
				$ip    			=   	trim($serverIPs['IP_IP']).":25";
				$strIP 			=       "smtp-listener ".trim($ip)."\r\n";
				fwrite($smtp_listener_file, $strIP);
			}
			fclose($smtp_listener_file);
			$cmdGetServerIPs->closeCursor();
		}
	}


	function	create_source_file($p_id_server)
	{
	   if(  (is_numeric($p_id_server)) && ($p_id_server>0))
		{
			include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetServerIPs 	=   
			'
				SELECT		I.IP_IP
				FROM		ip I
				WHERE		I.id_Server_IP	=	?
			';
			$cmdGetServerIPs	=   $bdd->prepare($sqlGetServerIPs);
			$cmdGetServerIPs->execute(array($p_id_server));

			$source_file 		=   fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/source.txt", "w");
			while($serverIPs	=	$cmdGetServerIPs->fetch())
			{
				$vmta_ip        =   trim($serverIPs['IP_IP']);
				$strSourceIP 	=   getLocalSourceIPString($vmta_ip);
				fwrite($source_file, $strSourceIP);
			}
			
			$strSourceIpCentral	=	getGlobalSourceIPString('80.241.209.193');
			fwrite($source_file, $strSourceIpCentral);
			
			fclose($source_file);
			$cmdGetServerIPs->closeCursor();
		}
	}

	

	function	create_vmta_file($p_id_server)
	{
		if(  (is_numeric($p_id_server)) && ($p_id_server>0))
		{
			include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetServerIPsDomains =   
			'
				SELECT		I.IP_IP,D.name_Domain
				FROM		ip I,domain D
				WHERE		I.id_Domain_IP	=	D.id_Domain
				AND			I.id_Server_IP	=	?
			';
			$cmdGetServerIPsDomains =   $bdd->prepare($sqlGetServerIPsDomains);
			$cmdGetServerIPsDomains->execute(array($p_id_server));

			$vmta_file 				=   fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/vmta.txt", "w");
			while($serverIPsDmomains=	$cmdGetServerIPsDomains->fetch())
			{
				$vmta_ip        =   trim($serverIPsDmomains['IP_IP']);
				$vmta_domain    =   trim($serverIPsDmomains['name_Domain']);
				$strVMTA 		=   getVmtaString($vmta_ip,$vmta_domain);
				fwrite($vmta_file, $strVMTA);
			}
			fclose($vmta_file);
			$cmdGetServerIPsDomains->closeCursor();
		}
	}


	function 	delete_file($p_filename)
	{
		if (file_exists($p_filename))
		{
			unlink($p_filename);
		}
	}
	
	
	function 	getMainIpByServerId($p_id_server)
	{
		$result =       null;
		if(  (is_numeric($p_id_server)) && ($p_id_server>0))
		{
			include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetMainIpByServerId         =   
			'
				SELECT 	I.IP_IP 
				FROM 	ip I
				WHERE 	I.id_IP 	= 	(select S.id_IP_Server from server S where S.id_Server =  ?  )';
			$cmdGetMainIpByServerId         =   $bdd->prepare($sqlGetMainIpByServerId);
			$cmdGetMainIpByServerId->execute(array($p_id_server));
			$server                         =       $cmdGetMainIpByServerId->fetch();
			
			$result                         =       $server['IP_IP'];
		}
		return $result;
	}
	
	
	function 	getLoginAndPasswordByIdServer($p_server_id)
	{
		$result =       array();
		if(  (is_numeric($p_server_id)) && ($p_server_id>0))
		{
			include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetLoginAndPasswordByIdServer	=   
			'
				SELECT 	S.username_Server,S.password_Server 
				FROM 	server S 
				WHERE 	S.id_Server =  ? 
			';
			$cmdGetLoginAndPasswordByIdServer   =   $bdd->prepare($sqlGetLoginAndPasswordByIdServer);
			$cmdGetLoginAndPasswordByIdServer->execute(array($p_server_id));
			$server		=	$cmdGetLoginAndPasswordByIdServer->fetch();

			$result[0]	=   $server['username_Server'];
			$result[1]	=   $server['password_Server'];

			$cmdGetLoginAndPasswordByIdServer->closeCursor();
		}
		return $result;
	}

	
	function 	uploadFileOLD($p_source_file,$p_destination_file,$p_main_ip,$user,$p_password)
	{
		$result =       null;

		if(function_exists("ssh2_connect"))
		{
			$connection = ssh2_connect($p_main_ip, 22);
			if($connection)
			{
				//echo "je suis dans IF";
				if(ssh2_auth_password($connection, $user, $p_password))
				{
					if(ssh2_scp_send($connection,$p_source_file,$p_destination_file,0777)=== TRUE)
					{
							//$result.='0';
							$result.="Transfer <font color='green'> successful </font> for <b>[$p_main_ip]</b> !<br />";
					}
					else
					{
							$result.="Transfer <font color='red'> failed for </font><b>[$p_main_ip]</b> !<br /> <br />";
					}
				}
				else
				{
						$result =       'Failed to authenticate !';
				}
			}
			else
			{
					$result =       "SSH validation failed for Server <b>[$p_main_ip]</b>";
			}
			ssh2_exec($connection, 'exit');
			unset($connection);
		}
		else
		{
				//echo "je suis dans else";
				$result =       'ssh2_connect() doesn\'t exists.';
		}

		return $result;
	}
	
	
	function 	getVmtaString($p_vmta_ip,$p_vmta_domain)
    {
        // Get Parent Domain :
		$fqdn               =       explode('.',$p_vmta_domain);
		if(count($fqdn)==3)
			$main_domain    =       $fqdn[1].'.'.$fqdn[2];
		else
			$main_domain    =       $p_vmta_domain;

		
		//Build VMTA string :
		$vMtaString =   "<virtual-mta [VMTA_NAME]>\r\n";
        $vMtaString.=   "\tsmtp-source-ip [VMTA_IP]\r\n";
        $vMtaString.=   "\thost-name [VMTA_DOMAINE]\r\n";
        //$vMtaString.=   "\tdomain-key cle,[VMTA_DOMAINE],/etc/pmta/domainKeys/cle.[VMTA_MAIN_DOMAINE].pem\r\n";
        $vMtaString.=   "</virtual-mta>\r\n\n";


		$vMtaString = str_replace("[VMTA_NAME]",'mta-'.$p_vmta_ip,$vMtaString);
        $vMtaString = str_replace("[VMTA_IP]",$p_vmta_ip,$vMtaString);
		$vMtaString = str_replace("[VMTA_DOMAINE]",$p_vmta_domain,$vMtaString);
        $vMtaString = str_replace("[VMTA_MAIN_DOMAINE]",$main_domain,$vMtaString);

        return $vMtaString;
    }
	
	
	function	getLocalSourceIPString($p_vmta_ip)
	{
		//Build SourceIP string :
		$sourceIPString =   "#_____LOCAL___________\r\n";
		$sourceIPString.=   "<source ".$p_vmta_ip.">\r\n";
        $sourceIPString.=   "\talways-allow-relaying yes\r\n";
        $sourceIPString.=   "\tsmtp-service yes\r\n";
        $sourceIPString.=   "\tlog-connections no\r\n";
		$sourceIPString.=   "\tlog-commands no\r\n";
        $sourceIPString.=   "\tprocess-x-envid true\r\n";
		$sourceIPString.=   "\tprocess-x-job true\r\n";
        $sourceIPString.=   "\tprocess-x-virtual-mta yes\r\n";
		$sourceIPString.=   "\tadd-received-header no\r\n";
        $sourceIPString.=   "\tallow-mailmerge true\r\n";
        $sourceIPString.=   "</source>\r\n\n";
		
		return $sourceIPString;
	}
	
	
	function	getGlobalSourceIPString($p_vmta_ip)
	{
		//Build SourceIP string :
		$sourceIPString =   "#_____CENTRAL___________\r\n";
		$sourceIPString.=   "<source ".$p_vmta_ip.">\r\n";
        $sourceIPString.=   "\talways-allow-relaying yes\r\n";
        $sourceIPString.=   "\tsmtp-service yes\r\n";
        $sourceIPString.=   "\tlog-connections no\r\n";
		$sourceIPString.=   "\tlog-commands no\r\n";
        $sourceIPString.=   "\tprocess-x-envid true\r\n";
		$sourceIPString.=   "\tprocess-x-job true\r\n";
        $sourceIPString.=   "\tprocess-x-virtual-mta yes\r\n";
		$sourceIPString.=   "\tadd-received-header no\r\n";
        $sourceIPString.=   "\tallow-mailmerge true\r\n";
        $sourceIPString.=   "</source>\r\n\n";
		
		return $sourceIPString;
	}
	
	
	function uploadFile($p_source_file,$p_destination_file,$connection,$p_permission,$msg)
	{
        if(ssh2_scp_send($connection,$p_source_file,$p_destination_file,$p_permission)=== TRUE)
		{
            $result	="Transfer of <font color='green'>".$msg." successful !</font><br>\n";
        }
		else
		{
            $result	="Transfer of <font color='red'>".$msg." failed !</font><br>\n"; 
        }
        return $result;
	}
		
	
	function buildPmtaConfigFile()
	{
		$config_file		=	fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/config", "w");
		$defaultConfig		=	getDefaultPmtaConfig();
		fwrite($config_file, $defaultConfig);
		fclose($config_file);
	}	
	
	function getHttpdConfigFile($p_main_ip_server)
	{
		if(!empty($p_main_ip_server))
		{
			$httpd_config_file	=	fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/exactarget.conf", "w");
			
			$strNewVirtualHost ="DocumentRoot /var/www/\r\n";
			
			$strNewVirtualHost.="<Directory />\r\n";
				$strNewVirtualHost.="\tOptions FollowSymLinks\r\n";
				$strNewVirtualHost.="\tRewriteEngine On\r\n";
				$strNewVirtualHost.="\tAllowOverride All\r\n";
			$strNewVirtualHost.="</Directory>\r\n";

			
			$strNewVirtualHost.="<Directory /var/www/exactarget/>\r\n";
				$strNewVirtualHost.="\tOrder Deny,Allow\r\n";
				$strNewVirtualHost.="\tDeny from all\r\n";
				$strNewVirtualHost.="\tAllow from 149.56.24.162\r\n";
				$strNewVirtualHost.="\tOptions -Indexes\r\n";
			$strNewVirtualHost.="</Directory>\r\n";
			
			
			$strNewVirtualHost.="<Directory /var/www/Creatives/>\r\n";
				$strNewVirtualHost.="\tAllow from all\r\n";
			$strNewVirtualHost.="</Directory>\r\n";


			$strNewVirtualHost.="<Directory /var/www/RDT/>\r\n";
				$strNewVirtualHost.="\tAllow from all\r\n";
			$strNewVirtualHost.="</Directory>\r\n";
			
			
			$strNewVirtualHost.="<Directory /var/www/>\r\n";
				$strNewVirtualHost.="\tAllow from all\r\n";           
				$strNewVirtualHost.="\tOptions +FollowSymlinks\r\n";
				$strNewVirtualHost.="\tRewriteEngine On\r\n";
				$strNewVirtualHost.="\tRewriteRule ^([0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2})$ /var/www/RDT/controller.php?chaine=$1\r\n";
				$strNewVirtualHost.="\tRewriteRule ^([a-zA-Z0-9]+.(jpg|png|gif|jpeg))$ http://images.exac-interactive.com/Creatives/$1\r\n";
				$strNewVirtualHost.="\tRewriteRule ^([0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2}[0-9]+[a-zA-Z]{2}[0-9]+=((\[sender\])|(<[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,10}>)))$ /var/www/RDT/o.php?chaine=$1\r\n";
			$strNewVirtualHost.="</Directory>\r\n";
			
			
			
			
			$strNewVirtualHost.="<VirtualHost *:80>\r\n";
			$strNewVirtualHost.="\tServerName ".$p_main_ip_server."\r\n";
			$strNewVirtualHost.="\tServerAlias ".$p_main_ip_server."\r\n";
			$strNewVirtualHost.="\tDocumentRoot /var/www/\r\n";
			$strNewVirtualHost.="\tErrorLog /var/log/httpd/error_log.".$p_main_ip_server."\r\n";
			$strNewVirtualHost.="\tTransferLog /var/log/httpd/access_log.".$p_main_ip_server."\r\n";
			$strNewVirtualHost.="</VirtualHost>\r\n";
			
			
			fwrite($httpd_config_file, $strNewVirtualHost);
			fclose($httpd_config_file);
		}
	}
	
	
	function getDefaultPmtaConfig()
	{
		return 
		'
			include /var/www/exactarget/PMTA/http.txt

			include /var/www/exactarget/PMTA/hostName.txt

			include /var/www/exactarget/PMTA/relayDomain.txt

			include /var/www/exactarget/PMTA/smtpListener.txt

			include /var/www/exactarget/PMTA/vmta.txt

			include /var/www/exactarget/PMTA/source.txt



			log-file /var/log/pmta/log
			spool   /var/spool/pmta

			include /var/www/exactarget/PMTA/gmail-config.txt

			include /var/www/exactarget/PMTA/aol-config.txt

			include /var/www/exactarget/PMTA/hotmail-config.txt

			include /var/www/exactarget/PMTA/yahoo-config.txt




			<acct-file /var/log/pmta/acct-bounced.csv>
					records b
					max-size 50M
					#move-to /opt/pmta/pmta-acct-old-bounced
					record-fields b jobId,dsnDiag,*,!timeImprinted,!dlvEsmtpAvailable,!rcpt
			</acct-file>


			<acct-file /var/log/pmta/totalBounced.csv>
					records b
					max-size 50M
					#move-to /opt/pmta/pmta-acct-old-bounced
					record-fields b jobId,dsnDiag,*,!timeImprinted,!dlvEsmtpAvailable,!rcpt
			</acct-file>




			<acct-file /var/log/pmta/acct-delivered.csv>
					records d
					max-size 50M
					#move-to /opt/pmta/pmta-acct-old-delivered
					record-fields d jobId,*,!timeImprinted,!dlvEsmtpAvailable,!rcpt
			</acct-file>



			<acct-file /var/log/pmta/acct-recieved.csv>
					records r
					record-fields r *,!rcpt
					max-size 50M
					#move-to /opt/pmta/pmta-acct-old-recieved,!rcpt
			</acct-file>
		';
	}

    function remote_ssh_connection2($remoteip, $remoteuser, $remotepasswd){
        $ssh = ssh2_connect($remoteip, 22);
        if($ssh === FALSE){
            return FALSE;
        }
        else{
            $auth = ssh2_auth_password($ssh, $remoteuser, $remotepasswd);
            if ($auth === FALSE){
                return FALSE;
            }
            else{
                return $ssh;
            }
        }
    }

    function generate_dns_zone_file($id_server){
        if(  (is_numeric($id_server)) && ($id_server>0)){
            include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
			$sqlGetServerIPsDomains =   
			'
				SELECT		I.IP_IP,D.name_Domain
				FROM		ip I,domain D
				WHERE		I.id_Domain_IP	=	D.id_Domain
				AND			I.id_Server_IP	=	?
			';
            $dns_zone_file	=	fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/server$id_server.hosts", "w");
			$cmdGetServerIPsDomains =   $bdd->prepare($sqlGetServerIPsDomains);
			$cmdGetServerIPsDomains->execute(array($id_server));
            $c = 0;
            $spf = '"v=spf1 ';
            $dnsstr = '$ttl 38400\r\n';
            while($serverIPsDmomains=	$cmdGetServerIPsDomains->fetch())
			{
                $ip        =   trim($serverIPsDmomains['IP_IP']);
				$domain    =   trim($serverIPsDmomains['name_Domain']);
                $maindomainexp = explode('.', $domain);
                $main_domain = $maindomainexp[1].'.'.$maindomainexp[2];
                if($c == 0){
                    $dnsstr .= '@     IN      SOA     ns1.'.$main_domain.'.        root.'.$main_domain.'. (
		1484
		10800
		3600
		2419190
		38400 )\r\n';
                    $dnsstr .= '@     IN      NS      ns1.'.$main_domain.'.
@     IN      NS      ns2.'.$main_domain.'.\r\n';
                    $dnsstr .= $main_domain.'.      IN      A       '.$ip.'\r\n';
                    $dnsstr .= 'www.'.$main_domain.'.      IN      A       '.$ip.'\r\n';
                    $dnsstr .= 'ns1.'.$main_domain.'.      IN      A       '.$ip.'\r\n';
                    $dnsstr .= 'ns2.'.$main_domain.'.      IN      A       '.$ip.'\r\n';
                    $dnsstr .= 'mail.'.$main_domain.'.      IN      A       '.$ip.'\r\n';
                    $dnsstr .= $main_domain.'.      IN      MX         5  mail.'.$main_domain.'.\r\n\r\n';
                    $c++;
                }
                $dnsstr .= $domain.'.      IN      A       '.$ip.'\r\n';
                $dnsstr .= $domain.'.      IN      TXT       "v=spf1 a include:'.$main_domain.' -all"\r\n';
                $dnsstr .= $domain.'.      IN      MX         5  mail.'.$main_domain.'.\r\n\r\n';
                $spf .= 'ip4:'.$ip.' ';
			}
            $spf .= '-all"';
            $dnsstr .= $spf;
            fwrite($dns_zone_file, $dnsstr);
            fclose($dns_zone_file);
            $cmdGetServerIPsDomains->closeCursor();
        }
        
    }

    function generate_dns_configuration($id_server){
        if(  (is_numeric($id_server)) && ($id_server>0)){
            $dns_zone_file = fopen($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/named.conf", "w");
            $conf	=	file_get_contents($_SERVER["DOCUMENT_ROOT"]."/exactarget/PMTA/config/named.conf.tpl");
            $conf .= '\r\n\r\n\r\n';
            $conf .= 'zone "server'.$id_server.'.dns" {
	type master;
	file "/var/named/server'.$id_server.'.hosts";
	allow-transfer {
		127.0.0.1;
		localnets;
		};
	};';
            fwrite($dns_conf_file, $conf);
            fclose($dns_conf_file);
        }
    }
	

?>
