<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

//////////
/* $result='c:/inetpub/wwwroot/accounts/outlook_afterclean.txt';
$raw=file('c:/inetpub/wwwroot/accounts/outlook.txt');
$toclean=file_get_contents('c:/inetpub/wwwroot/accounts/outlook_toclean.txt');

$cnt=count($raw);
$cnt=20000;

for($y=0;$y<$cnt;$y++)
{
	
	$raw[$y]=clean($raw[$y]);
	
	if(preg_match('/'.preg_quote($raw[$y], '/').'/i', $toclean)==FALSE)
	{
		file_put_contents($result, $raw[$y] . "\n",FILE_APPEND);
	}
	unset($raw[$y]);
} */






$datasend=750000;
$base=file('c:/inetpub/wwwroot/accounts/outlook.txt');
$accounts=count($base);
$end=ceil($accounts/$datasend);
//$end=32;
print $end;
unset($base);



$temp='c:/inetpub/wwwroot/accounts/outlook_temp.txt';

$get=file_get_contents('c:/inetpub/wwwroot/accounts/outlook.txt');
file_put_contents($temp, $get);
unset($get);

$base1=file($temp);

$a=0;

for($i=0;$i<$end;$i++)
{
	
	$file='c:/inetpub/wwwroot/accounts/outlook_'.$i.'.txt';
		
	$output1=array_slice($base1, $a, $datasend);
	//$output2=array_slice($base1, $datasend);
	file_put_contents($file, $output1);
	//file_put_contents($temp, $output2);
	
	//unset($output1);
	//unset($output2);
	//unset($base1);
	$a=$a+$datasend;
}	

/////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();