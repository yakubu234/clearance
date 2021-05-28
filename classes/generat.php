<?php



// chmod($targetPath, 0777);
// $targetPath = "qr/";    
//     if (! is_dir("qrcodeOnline/".$targetPath)) {
//         mkdir($targetPath, 0777, true);
//     }




#. rerwite the html file
if(file_exists("index.html")){
$fh = fopen("index.html", "w+");
// $dd = <head> <meta http-equiv="refresh" content="0; URL='index.php'" /></head>
fwrite($fh, "<Files 'index.html'> \n smdm all denied \n</Files>");
while(is_resource($fh)){
  //Handle still open
fclose($fh);
}

}

#.htaccess deny
// if(file_exists(".htaccess")){
//   $fh = fopen(".htaccess", "w+");
//   fwrite($fh, "php_value max_input_vars 40000\n");
//   fwrite($fh, "php_value suhosin.get.max_vars 40000\n");
//   fwrite($fh, "php_value suhosin.post.max_vars 40000\n");
//   fwrite($fh, "php_value suhosin.request.max_vars 40000\n");
//   fwrite($fh, "<Files 'index.html'> Require all denied</Files>");
//   while(is_resource($fh)){
//     //Handle still open
//   fclose($fh);
//   }
//   }

# to read the text file
if(file_exists("assets/js/.lisence")){
$file_handle = fopen("assets/js/.lisence", "r");
$ser = array();
$i = 0;
while (!feof($file_handle)) {

    $ser[$i] = fgets($file_handle);
    $sers = explode("=", $ser[$i]);
    $ser[$i] = trim($sers[1]);
    $i++;
}

fclose($file_handle);
$servername = $ser[0];
$username = $ser[1];
$password = $ser[2];
}



# create a txt file for getting logs and the api.php file
$txtfile = 'classes/GetData.txt';
$phpfile = "include/api.php";
if(!is_file($txtfile)){
  //Some simple example content.
  $contents = "# this txt file is created on ".date('jS M Y H:i:s a')." \n"." __________________________________________\n"."|                                          |\n"."| PHP LOGGER  BY Yakubu Abiola             |\n"."|__________________________________________|\n\n"." BEGIN LOGFILE ".$txtfile."\n";
  //Save our content to the file.
  file_put_contents($txtfile, $contents);
}

?>