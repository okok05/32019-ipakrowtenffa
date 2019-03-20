<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EXT - FTP Tool</title>
	
    <?php include('../Includes/css.php');?>
	<?php include('../Includes/js.php');?>
	
	<script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="../assets/js/pages/form_select2.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="../assets/js/pages/picker_date.js"></script>

</head>
<body>
<div class="row" style="margin:auto;width:100%;margin-bottom:20px;overflow:scroll;height:350px;overflow-x:hidden;border:1px solid #ddd;background-color:#f1f1f1;zoom:1;">
<center>
<?php
date_default_timezone_set('UTC');
include_once('../Includes/sessionVerification.php'); 
$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
verify($monUrl);
include_once('../Includes/bdd.php');

ini_set('default_socket_timeout', 5);


$id_Server = $_GET['id'];
if($id_Server>0){
    echo '<pre>';
    $requete = $bdd->prepare('select * from server where id_Server = ?');
    $requete->execute(array($id_Server));
    extract($requete->fetch());
            
    $requete = $bdd->prepare('select IP_IP from ip where id_IP = ?');
    $requete->execute(array($id_IP_Server));
    extract($requete->fetch());
    
    $logfile = fopen('installation_logs/'.$alias_Server.'_log', "w");
    
    $connection = remote_ssh_connection2($IP_IP, $username_Server, $password_Server);
    if(!$connection){
        echo $rsp = '*** SSH Connection to <b>'.$alias_Server.'</b> (IP:'.$IP_IP.' | Login:'.$username_Server.' | Password:'.$password_Server.') <font color="red">Failed</font>..<br>';
        ob_flush();
        flush();
        fwrite($logfile, $rsp."\n");
        exit();
    }
    else{        
        echo $rsp = 'Start Installation of <b>'.$alias_Server.'</b> (IP:'.$IP_IP.' | Login:'.$username_Server.' | Password:'.$password_Server.')<br>';
        ob_flush();
        flush();
        fwrite($logfile, $rsp."\n");
    }
    
    echo $rsp = 'Create and upload Configuration files to <b>'.$alias_Server.'</b><br>';
    ob_flush();
    flush();
    fwrite($logfile, $rsp."\n");
    
    $cmd = "iptables -F";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "/etc/init.d/iptables save";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
	
	$cmd = "yum -y install sudo.x86_64 wget.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
	
	$cmd = "yum -y install unzip";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
	
	$cmd = "wget -N -P /var/www http://45.56.93.78/FilesApp/slave.zip";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
	
	$cmd = "unzip -o /var/www/slave -d /var/www";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "rm -rf /var/www/slave.zip";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
	

    
    
    
    //Installation commands
    echo $rsp = 'Start installation Commands<br>';
    ob_flush();
    flush();
    fwrite($logfile, $rsp."\n");
    
    $cmd = "echo 'export VISUAL=\"nano\"' >> ~/.bash_profile";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "echo 'export EDITOR=\"nano\"' >> ~/.bash_profile";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br> \n");
    
    $cmd = "echo 'ZONE=\"Africa/Casablanca\"' > /etc/sysconfig/clock";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br> \n");
    
    $cmd = "echo 'UTC=true' >> /etc/sysconfig/clock";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br> \n");
    
    $cmd = "ln -snf /usr/share/zoneinfo/Africa/Casablanca /etc/localtime";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br> \n");
    
    $cmd = "yum -y install ntp.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br> \n");
    
    $cmd = "ntpd -g -q";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br> \n");
    
    $cmd = "hwclock -wu";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install mod_ssl.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install openssh-clients rsync";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install gcc.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install dos2unix.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    
    
    $cmd = "yum -y install perl-ExtUtils-MakeMaker.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install cronie.x86_64 cronie-anacron.x86_64  crontabs.noarch";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install iptraf.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install nano.x86_64 telnet.x86_64 sudo.x86_64 lsof.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install postfix.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install sendmail.x86_64 sendmail-cf";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install httpd.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install php php-cli php-gd php-mysql php-mbstring";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install gcc php-devel php-pear libssh2 libssh2-devel make php-devel php-pear libssh2-devel";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install php-imap";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install httpd httpd-devel httpd-manual httpd-tools mod_auth_kerb mod_auth_mysql mod_auth_pgsql mod_authz_ldap mod_dav_svn mod_dnssd mod_nss mod_perl mod_revocator mod_ssl mod_wsgi";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install libssh2-php";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install net-tools";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install php";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install mysql.x86_64 mysql-devel.x86_64 mysql-server.x86_64 mod_auth_mysql.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install php.x86_64 php-cli.x86_64 php-common.x86_64 php-mysql.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install postfix.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y  install bind.x86_64 bind-utils.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum -y install make.x86_64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    
    
    $cmd = "yum -y install iptables";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum install gzip -y";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "yum install tar -y";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "unalias cp";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "wget -P /root http://80.241.209.193/pmta/PowerMTA-4.0r6-201204021809.x86_64.rpm";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "wget -N -P /etc http://80.241.209.193/httpd/sudoers";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "wget -N -P /etc http://80.241.209.193/httpd/php.ini";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "wget -N -P /etc/httpd/conf http://80.241.209.193/httpd/httpd.conf";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "rpm -ivh /root/PowerMTA-4.0r6-201204021809.x86_64.rpm";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "wget -P /etc/pmta http://80.241.209.193/pmta/license";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "wget -P /etc/pmta http://80.241.209.193/pmta/license.linux64";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "chmod 777 /var/www/exactarget/PMTA/* /var/www/exactarget/PMTA/ /var/www/*";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    
    
    $cmd = "chown pmta:pmta /etc/pmta/config";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/spool/pmtaPickup/";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/spool/pmtaPickup/Pickup";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/spool/pmtaPickup/BadMail";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/spool/pmtaIncoming";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "chown pmta:pmta /var/spool/pmtaIncoming /var/spool/pmtaPickup/*";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "chmod 755 /var/spool/pmtaIncoming";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/log/pmta";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/log/pmtaAccRep";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/log/pmtaErr";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "mkdir -p /var/log/pmtaErrRep";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "chown pmta:pmta  /var/log/pmta /var/log/pmtaAccRep /var/log/pmtaErr /var/log/pmtaErrRep";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "chmod 755 /var/log/pmta /var/log/pmtaAccRep /var/log/pmtaErr /var/log/pmtaErrRep";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "chmod 777 /var/log/pmta/";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    //Create config files
    $url = 'http://45.56.93.78/exactarget/PMTA/build_pmta_config.php';
    $params = "id_server=$id_Server";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);

    curl_close($ch);
    
    echo $rsp = $result;
    ob_flush();
    flush();
    fwrite($logfile, $rsp."\n");
    
    $cmd = "iptables -A INPUT -p tcp -m tcp --dport 2304 -m string --string \"/logs\" --algo kmp --to 50 --icase -j REJECT --reject-with icmp-port-unreachable";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
	
	$cmd = "iptables -I INPUT -j ACCEPT";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "/etc/init.d/iptables save";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    
    
    $cmd = "chmod -R 777 /var/www/exactarget/ /var/www/Creatives/";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "service iptables save";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "echo \"10 0 * * * rm -f /var/log/pmta/log-*\" | tee -a /var/spool/cron/root 2>&1";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "echo \"*/30 * * * * /usr/bin/php /var/www/exactarget/Send/received.php\" | tee -a /var/spool/cron/root 2>&1";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "echo \"*/30 * * * * /usr/bin/php /var/www/exactarget/Send/delivered.php\" | tee -a /var/spool/cron/root 2>&1";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "echo \"*/30 * * * * /usr/bin/php /var/www/exactarget/Send/bounce.php\" | tee -a /var/spool/cron/root 2>&1";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "printf \"\n\" | pecl install -f ssh2";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "echo extension=ssh2.so > /etc/php.d/ssh2.ini";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "service httpd restart";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "service pmta restart";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "service pmtahttp restart";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "service crond restart";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "service postfix restart";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    $cmd = "service sendmail restart";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    echo $rsp = 'End Installation of <b>'.$alias_Server.'</b><br>';
    ob_flush();
    flush();
    fwrite($logfile, $rsp."\n");
    
    $requete = $bdd->prepare('update server set isInstalled_Server = ? where id_Server = ?');
    $requete->execute(array(1,$id_Server));
    
}














function my_ssh2($connection, $cmd){
    $stream = ssh2_exec($connection, $cmd);
    $stream_err = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
    stream_set_blocking($stream, true);
    stream_set_blocking($stream_err, true);
    $status = stream_get_contents($stream);
    $status .= stream_get_contents($stream_err);
    
    return $status;
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

function getMainIpByServerId($id_Server){
    $result = null;
	if(  (is_numeric($id_Server)) && ($id_Server>0)){
	   include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
		$sqlGetMainIpByServerId         =   
		'
        SELECT 	I.IP_IP 
		FROM 	ip I
		WHERE 	I.id_IP 	= 	(select S.id_IP_Server from server S where S.id_Server =  ?  )';
		$cmdGetMainIpByServerId         =   $bdd->prepare($sqlGetMainIpByServerId);
		$cmdGetMainIpByServerId->execute(array($id_Server));
		$server                         =       $cmdGetMainIpByServerId->fetch();
		$result                         =       $server['IP_IP'];
	}
	return $result;
}

function getLoginAndPasswordByIdServer($id_Server){
    $result = array();
	if((is_numeric($id_Server)) && ($id_Server>0)){
		include($_SERVER["DOCUMENT_ROOT"]."/exactarget/Includes/bdd.php");
		$sqlGetLoginAndPasswordByIdServer	=   
		'
        SELECT 	S.username_Server,S.password_Server 
		FROM 	server S 
		WHERE 	S.id_Server =  ? 
		';
		$cmdGetLoginAndPasswordByIdServer   =   $bdd->prepare($sqlGetLoginAndPasswordByIdServer);
		$cmdGetLoginAndPasswordByIdServer->execute(array($id_Server));
		$server		=	$cmdGetLoginAndPasswordByIdServer->fetch();
		$result[0]	=   $server['username_Server'];
		$result[1]	=   $server['password_Server'];
		$cmdGetLoginAndPasswordByIdServer->closeCursor();
	}
	return $result;
}
?>
</center>
</div>