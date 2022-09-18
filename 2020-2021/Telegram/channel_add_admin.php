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

if (file_exists('./3/')){ } else { mkdir('./3/'); }
if (file_exists('./3/channel_add_admin_script')) { unlink('./3/channel_add_admin_script'); touch('./3/channel_add_admin_script'); } else { touch('./3/channel_add_admin_script'); }
$script='./3/channel_add_admin_script';
$mainnew=file('./3/bots.csv');
$lines=count($mainnew);


$put1='#!/usr/bin/sh';
file_put_contents($script, $put1 . "\n" . "\n",FILE_APPEND);
$put2='cd /home/vip/tg/ && (sleep 2; echo "channel_list"; sleep 3; ';
file_put_contents($script, $put2,FILE_APPEND);



for($n=0;$n<$lines;$n++)
{

$col[$n]=str_getcsv($mainnew[$n]);

$put4[$n]='echo "contact_search '.$col[$n][0].'"; sleep 3; ';
file_put_contents($script, $put4[$n],FILE_APPEND);

$q1=20;
$q2=22;

	for($i=0;$i<$q1;$i++)
	{
	$put5[$i]='echo "channel_set_admin vipchannel'.$q2.' '.$col[$n][0].' 1"; sleep 2;';
	file_put_contents($script, $put5[$i],FILE_APPEND);
	$q2++;
	}

}
$put3=') | bin/telegram-cli -W';
file_put_contents($script, $put3,FILE_APPEND);
$scr=file_get_contents($script);
$scr=clean($scr);
file_put_contents($script, $scr);
