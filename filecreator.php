
<?php
$txtfile = 'classes/GetData.txt';
$phpfile = "include/api.php";
if(!is_file($txtfile)){
  //Some simple example content.
  $contents = "# this txt file is created on ".date('jS M Y H:i:s a')." \n"." __________________________________________\n"."|                                          |\n"."| PHP LOGGER  BY Yakubu Abiola             |\n"."|__________________________________________|\n\n"." BEGIN LOGFILE ".$txtfile."\n";
  //Save our content to the file.
  file_put_contents($txtfile, $contents);
}