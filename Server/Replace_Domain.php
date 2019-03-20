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
    
    //Create config files
    $url = 'http://45.56.93.78/exactarget/PMTA/build_pmta_config_Domain.php';
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
	
    //Installation commands
    echo $rsp = 'Start installation Commands<br>';
    ob_flush();
    flush();
    fwrite($logfile, $rsp."\n");
    
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
    
    $cmd = "pmta reload";
    echo $rsp = my_ssh2($connection, $cmd);
    ob_flush();
    flush();
    fwrite($logfile, $rsp."<br>\n");
    
    echo $rsp = 'Domain Replaced<b>'.$alias_Server.'</b><br>';
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