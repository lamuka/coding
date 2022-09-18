<?php
	
function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
/////
$dir=dirname(__FILE__);

$get=file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
$prname=clean(file_get_contents(''.$dir.'/azure/prname.txt'));
$prpass=clean(file_get_contents(''.$dir.'/azure/prpass.txt'));
$prport=clean(file_get_contents(''.$dir.'/azure/prport.txt'));


if (file_exists(''.$dir.'/azure/ips.txt')) { unlink(''.$dir.'/azure/ips.txt'); touch(''.$dir.'/azure/ips.txt'); } else { touch(''.$dir.'/azure/ips.txt'); }
if (file_exists(''.$dir.'/azure/ips1.txt')) { unlink(''.$dir.'/azure/ips1.txt'); touch(''.$dir.'/azure/ips1.txt'); } else { touch(''.$dir.'/azure/ips1.txt'); }

preg_match_all('/\d{1,3}\..*?(,|\n)/', $get, $out);
//preg_match_all('/(\d{1,3}\.){3}\d{1,3}(,|\n)/', $get, $out);
//preg_match_all('/(((\d{1,3}\.){3}\d{1,3},)|((\d{1,3}\.){3}\d{1,3}\n))/', $get, $out);
//preg_match_all('/(\d{1,3}\.){3}\d{1,3}\n/', $get, $out);
$cnt=count($out[0]);
		
for($i=0;$i<$cnt;$i++)
{
	$out[0][$i]=str_replace(",", '', $out[0][$i]);
	file_put_contents(''.$dir.'/azure/ips.txt', ''.clean($out[0][$i]).':'.$prport.':'.$prname.':'.$prpass.'' . "\n",FILE_APPEND);
	file_put_contents(''.$dir.'/azure/ips1.txt', ''.$prname.':'.$prpass.'@'.clean($out[0][$i]).':'.$prport.'' . "\n",FILE_APPEND);
}


header('Location: azure.html');
///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;

