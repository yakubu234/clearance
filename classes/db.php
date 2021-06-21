<?php 
session_start();
ob_start();
global $conn; global $urlServer;
include "api.php";
$projectPhase = "";#change to 'online' when going live

function url(){
	$explode = explode('/', $_SERVER["REQUEST_URI"]);
	switch ('http://'.$_SERVER['HTTP_HOST']) {
	case 'http://localhost':
		$base_url = 'http://'.$_SERVER['HTTP_HOST'].DIRECTORY_SEPARATOR.$explode[1].DIRECTORY_SEPARATOR;
		break;	
	default:
		$base_url = 'http://'.$_SERVER['HTTP_HOST'].DIRECTORY_SEPARATOR;
		break;
	}
	return $base_url;
}
$urlServer = url();

function DB(){	
	global $servername;
	global $uname;
	global $pwd;
	global $dbname;	
	global $conn;
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $uname, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		die($e->getMessage());
	}
	return $conn;
	$conn = null;
}

$conn = DB();
$img= "assets/media/favicons/favicon-192x192.png";
$sitename = "wonders store";

function LoadUser($id, $fullName, $email,$function) {
	$connw = DB();
	$urlServer = url();
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version= "";

    // First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}else{
		$platform = $u_agent;
	}

    // Next get the name of the useragent yes seperately and for good reason
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif(preg_match('/Firefox/i',$u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif(preg_match('/Chrome/i',$u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif(preg_match('/Safari/i',$u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif(preg_match('/Opera/i',$u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif(preg_match('/Netscape/i',$u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	}

    // finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
	}
	$href = $_SERVER['HTTP_REFERER'];

    // see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
			$version= $matches['version'][0];
		} else {
			$version= $matches['version'][1];
		}
	} else {
		$version= $matches['version'][0];
	}
	if(!isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	} else {
		$ip = '[cloudflare reports] '.$_SERVER['HTTP_CF_CONNECTING_IP'];
	}
    $date = new DateTime(); // Date+time variable
    $rdate = $date->format('Y-m-d H:i:s'); // Normalizing it
    $ipHos = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    // writting to text file
     $file = $urlServer."classes/GetData.txt";
if(is_writable($file)) {
	$fh = fopen($file, 'a');
	if(filesize($file) < 32) {
		fwrite($fh, " __________________________________________\n");
		fwrite($fh, "|                                          |\n");
		fwrite($fh, "| PHP LOGGER  BY Yakubu Abiola             |\n");
		fwrite($fh, "|__________________________________________|\n\n");
		fwrite($fh, " BEGIN LOGFILE ".$file."\n");
		fwrite($fh, " _____________________\n");
		fwrite($fh, "|\n");
	}
	fwrite($fh, " _____________________\n");
	fwrite($fh, "|\n");
	fwrite($fh, '| Connection from '.$ip.' at '.$rdate ."\n");
	fwrite($fh, '| Hostname: '."". $ipHos ."\n");
	fwrite($fh, '| Browser name: '."".$bname ."\n");
	fwrite($fh, '| User Agent: '."".$u_agent ."\n");
	fwrite($fh, '| Device: '."".$platform."\n");
	fwrite($fh, '| User ID: '."".$id ."\n");
	fwrite($fh, '| User fullname: '."".$fullName ."\n");
	fwrite($fh, '| User email: '."".$email ."\n");
	fwrite($fh, '| User action performed: '."".$function ."\n");
	fwrite($fh, '| HTTP Referer: '."".$href ."\n");
	fwrite($fh, "|_____________________\n");
	fclose($fh);
	// echo $message;
} 
if (empty($id)) {
	exit;
}
$data = [
	'userAgent' => $u_agent,
	'ip' => $ip,
	'ipHost' => $ipHos,
	'href' => $href,
	'dates' => $rdate,
	'name'      => $bname,
	'version'   => $version,
	'platform'  => $platform,
	'pattern'    => $pattern,
	'id'    => $id,
	'fullname'  => $fullName,
	'email'    => $email,
	'function'    => $function
];
try{
	$ins = "INSERT INTO GetData (userAgent,ip,ipHost,href,dates,name,version,platform,pattern,id,fullname,email,function_per) VALUES (:userAgent, :ip, :ipHost, :href, :dates, :name,:version,:platform,:pattern,:id,:fullname,:email, :function)";
	$stmt = $connw->prepare($ins);
	$stmt->execute($data);
}catch (PDOException $e){
// var_dump($e->getMessage());	
}
return $data;
}
// now try it