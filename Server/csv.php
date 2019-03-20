<?
include_once('../Includes/sessionVerification.php'); 
	 $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 verify($monUrl);
	 $id_Server = $_POST['id_Server'];

    include('../Includes/bdd.php');

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=rdns.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('ip', 'domain'));

// fetch the data
$query = "SELECT IP_IP,name_Domain FROM ip  INNER JOIN domain ON ip.id_Domain_IP=domain.id_Domain WHERE id_Server_IP = $id_Server";
$rows = $bdd->prepare($query);
$rows->execute();
// loop over the rows, outputting them

while ($row = $rows->fetch(PDO::FETCH_ASSOC)){
	
	fputcsv($output, $row);
};





?>