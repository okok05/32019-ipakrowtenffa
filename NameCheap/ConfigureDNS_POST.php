<?php

require 'namecheap.class.php';

$username = 'USER';
$apiKey = 'APIKEY';
$clientIp = 'IP';
$domain = $_POST['DomainName'];
list( $records['SLD'], $records['TLD'] ) = explode('.', $domain);
$sld = $records['SLD'];
$tld = $records['TLD'];
$IPs = $_POST['txtListIPs'];

$namecheap = new Namecheap ($username, $apiKey, $clientIp,$domain, $sld, $tld, $IPs) ;
$data["Command"] = "namecheap.domains.dns.setHosts";
$returned = $namecheap->request($data);
print_r($returned);

 ?>

 
