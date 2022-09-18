<?php

///
function clean($uncleaned) { 
$uncleaned=ltrim($uncleaned); 
$uncleaned=rtrim($uncleaned); 
return($uncleaned);} 
///

$publicip=file('/home/vip/publicip.txt'); 
$publicip[0]=clean($publicip[0]); 
$privateip=file('/home/vip/privateip.txt'); 
$privateip[0]=clean($privateip[0]); 
$adminip=file('/home/vip/adminip.txt'); 
$adminip[0]=clean($adminip[0]); 
$hostname=file('/home/vip/hostname.txt'); 
$hostname[0]=preg_replace('/.$/', '', $hostname[0]);
$hostname[0]=clean($hostname[0]); 
$pmta=file_get_contents('/etc/pmta/config'); 
$pmta=str_replace('xxx1', $publicip[0], $pmta); 
$pmta=str_replace('xxx2', $adminip[0], $pmta); 
$pmta=str_replace('xxx3', $hostname[0], $pmta); 
$pmta=str_replace('xxx4', $privateip[0], $pmta); 
file_put_contents('/etc/pmta/config', $pmta);


/////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit(); 