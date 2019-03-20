<?php

class Namecheap {

  private $username;
  private $apiKey;
  private $clientIp;
  private $domain;
  private $sld;
  private $IPs;

  public function __construct($username, $apiKey, $clientIp, $domain, $sld, $tld, $IPs) {
    $this->username = $username;
    $this->apiKey = $apiKey;
    $this->clientIp = $clientIp;
	$this->domain = $domain;
	$this->sld = $sld;
	$this->tld = $tld;
	$this->IPs = $IPs;
  }

  
  public function request($postData) {
      $url = 'https://api.namecheap.com/xml.response';
      $postData['ApiUser'] = $this->username;
      $postData['UserName'] = $this->username;
      $postData['ApiKey'] = $this->apiKey;
      $postData['ClientIp'] = $this->clientIp;
	  $postData['DomainName'] = $this->domain;
	  $postData['SLD'] = $this->sld;
	  $postData['TLD'] = $this->tld;
	  
	  
	  
      $naoufal =  $this->IPs; 
	  $array  = explode("\n", $naoufal);
      $someCounted = count($array); 
	  for($i = 0; $i < $someCounted; $i++) {
		  if ($i == 0)
		  {
			  $postData['HostName'.$i] = '@';
	          $postData['RecordType'.$i] = 'A';
	          $postData['Address'.$i] = $array[$i];
			  
			  
		  }  
		    else
			
		 {
		
       $postData['HostName'.$i] = 'support'.$i;
	   $postData['RecordType'.$i] = 'A';
	   $postData['Address'.$i] = $array[$i];
	   
	    
		} 
		
	  }
	  
	 
	  

	  
      $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($postData)
          )
      );
      $context  = stream_context_create($options);
      $apiData = file_get_contents($url, false, $context);
      return $apiData;
  }
}

?>
