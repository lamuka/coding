<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
/////////////////////////////////////////
$dir=dirname(__FILE__);

if(isset($_POST['access']) && isset($_POST['secret']))
{
	
$access=$_POST['access'];
$secret=$_POST['secret'];
$access=clean($access);
$secret=clean($secret);

/////

if (file_exists(''.$dir.'/sec/')) { } else { mkdir(''.$dir.'/sec/'); }

file_put_contents(''.$dir.'/sec/access.txt', $access);
file_put_contents(''.$dir.'/sec/secret.txt', $secret);

system('dig +short myip.opendns.com @resolver1.opendns.com. > '.$dir.'/sec/publicip.txt');

$head='[default]';
file_put_contents('/home/vip/.aws/credentials', $head . "\n");
file_put_contents('/home/vip/.aws/credentials', 'aws_access_key_id = '.$access.'' . "\n",FILE_APPEND);
file_put_contents('/home/vip/.aws/credentials', 'aws_secret_access_key = '.$secret.'',FILE_APPEND);

$a=file_get_contents(''.$dir.'/amazon.html');

$a=preg_replace('/\$\("#accesskey"\)\.val.*/', '$("#accesskey").val("'.$access.'")', $a);
$a=preg_replace('/\$\("#secretkey"\)\.val.*/', '$("#secretkey").val("'.$secret.'")', $a);

file_put_contents(''.$dir.'/amazon.html', $a);

}

header('Location: amazon.html');

/////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;
