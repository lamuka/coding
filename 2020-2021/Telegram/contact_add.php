<?php


///**///
function get_curl($urlweb) {
$userAgent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2';
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $urlweb); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//curl_setopt($ch, CURLOPT_USERAGENT, $userAgent); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, TRUE); 
//curl_setopt($ch, CURLOPT_NOBODY, TRUE);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
//curl_setopt($ch, CURlOPT_COOKIEJAR, './cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataparse=curl_exec($ch);
$http_code=curl_getinfo($ch);
curl_close($ch);
return($dataparse); }

///**///
function curl($urlweb) {
$ch=curl_init();
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch, CURLOPT_URL, $urlweb); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataparse=curl_exec($ch);
$http_code=curl_getinfo($ch);
curl_close($ch);
return($dataparse); }	
///**///
function snoopy($urlweb) {
$snoopy=new Snoopy;
$snoopy->fetch($urlweb);
//unset($snoopy);
}

///**///
function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);
}
///**///

require_once('Snoopy.class.php');
///**///
//add_contact +380977359256 Vit Vit
if (file_exists('./4/resname.txt')) { unlink('./4/resname.txt'); touch('./4/resname.txt'); } else { touch('./4/resname.txt'); }
if (file_exists('./4/restel.txt')) { unlink('./4/restel.txt'); touch('./4/restel.txt'); } else { touch('./4/restel.txt'); }
$file1='./4/name.txt';
$file2='./4/tel.txt';

$filenew1=file_get_contents($file1);
$filenew2=file_get_contents($file2);
$filenew3=file($file2);

$put1='./4/resname.txt';
$put2='./4/restel.txt';

$filenew1=str_replace('"', '', $filenew1);
$filenew1=clean($filenew1);
file_put_contents($put1, $filenew1);

$l=count($filenew3);




for($u=0;$u<$l;$u++)
{

preg_match_all('/^(067|097|098|096|068|050|099|073|093|063|066|095|\+3).*/', $filenew3[$u], $out2[$u]);
	$n[$u]=count($out2[$u][0]);
	
	for($o=0;$o<$n[$u];$o++)
	{
	$out2[$u][0][0]=clean($out2[$u][0][0]);
	file_put_contents($put2, $out2[$u][0][0] . "\n",FILE_APPEND);
	}
}

if (file_exists('./4/res.csv')) { unlink('./4/res.csv'); touch('./4/res.csv'); } else { touch('./4/res.csv'); }

$csv='./4/res.csv';

$get1=file($put1);
$get2=file($put1);
$get3=file($put2);

$cnt=count($get1);

for($e=0;$e<$cnt;$e++)
{
	
///
$get3[$e]=str_replace("+38", "", $get3[$e]);
$get3[$e]=str_replace("(", "", $get3[$e]);
$get3[$e]=str_replace(")", "", $get3[$e]);
$get3[$e]=str_replace('"', "", $get3[$e]);
$get3[$e]=str_replace("-", "", $get3[$e]);
$get3[$e]=str_replace(" ", "", $get3[$e]);
$get3[$e]=preg_replace('/,.*/', "", $get3[$e]);
$get3[$e]=clean($get3[$e]);
file_put_contents($csv, '+38'.$get3[$e].',',FILE_APPEND);
///
///
$cnt1[$e]=substr_count($get1[$e], ' ');

if($cnt1[$e]>1)
{
$get1[$e]=preg_replace('/\s\S+$/', '', $get1[$e]);
$get1[$e]=str_replace(' ', ',', $get1[$e]);
$get1[$e]=clean($get1[$e]);
}
else
{
$get1[$e]=str_replace(' ', ',', $get1[$e]);
$get1[$e]=clean($get1[$e]);
}
file_put_contents($csv, ''.$get1[$e].',' . "\n",FILE_APPEND);
///
}


////////////////////////////////////////////////////////
///////////////////////////////////////////////////////
if (file_exists('./4/contact_add_script')) { unlink('./4/contact_add_script'); touch('./4/contact_add_script'); } else { touch('./4/contact_add_script'); }
$script='./4/contact_add_script';

$mainnew=file('./4/res.csv');
$lines=count($mainnew);

$put3='#!/usr/bin/sh';
file_put_contents($script, $put3 . "\n" . "\n",FILE_APPEND);
$put4='cd /home/vip/tg/ && (sleep 2; ';
file_put_contents($script, $put4,FILE_APPEND);


for($n=0;$n<$lines;$n++)
{
$col[$n]=str_getcsv($mainnew[$n]);
$put5[$n]='echo "add_contact '.$col[$n][0].' '.$col[$n][2].' '.$col[$n][1].'"; sleep 2; ';
file_put_contents($script, $put5[$n],FILE_APPEND);
}

$put6=') | bin/telegram-cli -W';
file_put_contents($script, $put6,FILE_APPEND);
$scr=file_get_contents($script);
$scr=clean($scr);
file_put_contents($script, $scr);


















