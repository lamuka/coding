<?php


/* 

ua_82734682721_bot
927227049:AAGalM70KtsVolhevc_wVmjZbF0Zx1H607Q

ua_283746865234_bot
950154436:AAGrCnd4WH1vUJahym_2r52ENcjfiDPsDyw

ua_39823546783_bot
920898641:AAH7JuF96A9Lpal1i7ikym2MAKfezvQk5xE

ua_732856863346_bot
944477771:AAEPQvqVSL8_6aK5lFagbr6kGr8eWpLbrpg

ua_892347678692_bot
988323905:AAG7vbFudh2Ery3NDigVFPwelj-bYRtR_hU


https://api.telegram.org/bot927227049:AAGalM70KtsVolhevc_wVmjZbF0Zx1H607Q/setWebhook?url=https://northusip.northcentralus.cloudapp.azure.com/bot/ua/ua_82734682721_bot.php			
https://api.telegram.org/bot927227049:AAGalM70KtsVolhevc_wVmjZbF0Zx1H607Q/sendMessage?chat_id=-1001365748970&text=hollo&disable_notification=true&parse_mode=html

*/
///**///
function curl($urlweb) {
$ch=curl_init();
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch, CURLOPT_URL, $urlweb); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
//curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataparse=curl_exec($ch);
$http_code=curl_getinfo($ch);
curl_close($ch);
return($dataparse); }	
///**///

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


//////
$date=''.date("dm").'';

//////
require_once('/var/www/html/Snoopy.class.php');

//////
if (file_exists('/var/www/html/fileid.txt')) { unlink('/var/www/html/fileid.txt'); touch('/var/www/html/fileid.txt'); } else { touch('/var/www/html/fileid.txt'); }
$fileid='/var/www/html/fileid.txt';
$channel=file('/var/www/html/channelid.txt');

$lines=count($channel);

for($i=0;$i<$lines;$i++)
{
$urlweba[$i]='https://api.telegram.org/bot927227049:AAGalM70KtsVolhevc_wVmjZbF0Zx1H607Q/sendMessage?chat_id='.clean($channel[$i]).'&text=Information&disable_notification=true&parse_mode=html';
$makerawa[$i]=curl($urlweba[$i]);
preg_match('/message_id.*/', $makerawa[$i], $messid[$i]);
$messid[$i][0]=str_replace('message_id":', '', $messid[$i][0]);
$messid[$i][0]=preg_replace('/\,.*/', '', $messid[$i][0]);
$messid[$i][0]=clean($messid[$i][0]);
file_put_contents($fileid, $messid[$i][0] . "\n",FILE_APPEND);
$urlweba1[$i]='https://api.telegram.org/bot927227049:AAGalM70KtsVolhevc_wVmjZbF0Zx1H607Q/pinChatMessage?chat_id='.clean($channel[$i]).'&message_id='.clean($messid[$i][0]).'&disable_notification=true';
$makerawa1[$i]=curl($urlweba1[$i]);
}

exit();
	

?>
