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
if (file_exists('./3/channel_info_script')) { unlink('./3/channel_info_script'); touch('./3/channel_info_script'); } else { touch('./3/channel_info_script'); }
$script='./3/channel_info_script';
$put1='#!/usr/bin/sh';
file_put_contents($script, $put1 . "\n" . "\n",FILE_APPEND);
//$put2='script /home/vip/x.txt';
//file_put_contents($script, $put2 . "\n",FILE_APPEND);
$put3='sleep 2';
file_put_contents($script, $put3 . "\n",FILE_APPEND);
$put4='cd /home/vip/tg/ && (sleep 3; echo "channel_list"; sleep 3; ';
file_put_contents($script, $put4,FILE_APPEND);

$q1=21;
$q2=22;

for($i=0;$i<$q1;$i++)
{
if(($q1-$i)>1)
{
$put5[$i]='echo "channel_info vipchannel'.$q2.'"; sleep 1; ';
file_put_contents($script, $put5[$i],FILE_APPEND);
}
else
{
$put5[$i]='echo "channel_info vipchannel'.$q2.'"; sleep 1; echo "quit";';
file_put_contents($script, $put5[$i],FILE_APPEND);	
}
$q2++;
}

$put6=') | bin/telegram-cli -W';
file_put_contents($script, $put6 . "\n",FILE_APPEND);
$put7='sleep 5';
file_put_contents($script, $put7 . "\n",FILE_APPEND);
//$put8='exit';
//file_put_contents($script, $put8,FILE_APPEND);
$scr=file_get_contents($script);
$scr=clean($scr);
file_put_contents($script, $scr);

