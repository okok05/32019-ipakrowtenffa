<?php
$connection = ssh2_connect('IP', 22);
ssh2_auth_password($connection, 'USER', 'PASSWORD');

$sftp = ssh2_sftp($connection);

//$i= '9';
$IP = $_POST["txtListIPs"];

$mejnon = $IP;
$array  = explode("\n", $mejnon);
$someCounted = count($array);
for($i = 0; $i < $someCounted; $i++) {
$fp = fopen("ssh2.sftp://$sftp/etc/sysconfig/network-scripts/ifcfg-eth0_$i", 'w');
$txt = file_get_contents('Network.txt');
$updateip = trim($array[$i]);
$txt = str_replace("[IP]", $updateip, $txt);
$txt = str_replace("[i]", $i, $txt);
fwrite($fp, $txt);
fclose($fp);
}
echo "done";

?>