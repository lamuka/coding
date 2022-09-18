<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
///////////////
$dir=dirname(__FILE__);

$a=file_get_contents(''.$dir.'/sec/amazon.pem');
preg_match_all('/-----BEGIN RSA PRIVATE KEY-----.*-----END RSA PRIVATE KEY-----/', $a, $out);
$out[0][0]=str_replace('-----BEGIN RSA PRIVATE KEY-----\n', '', $out[0][0]);
$out[0][0]=str_replace('\n-----END RSA PRIVATE KEY-----', '', $out[0][0]);
$out[0][0]=str_replace('\n', '', $out[0][0]);
$out[0][0]=wordwrap($out[0][0], 76, "\n", true);
file_put_contents(''.$dir.'/sec/amazon.pem', '-----BEGIN RSA PRIVATE KEY-----' . "\n");
file_put_contents(''.$dir.'/sec/amazon.pem', $out[0][0] . "\n",FILE_APPEND);
file_put_contents(''.$dir.'/sec/amazon.pem', '-----END RSA PRIVATE KEY-----',FILE_APPEND);

/////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;