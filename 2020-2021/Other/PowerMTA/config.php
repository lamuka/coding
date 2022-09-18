<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

//////////////////////////////////////
$row1=$_POST['servernum'];
$row2=$_POST['ips'];
$row3=$_POST['domain'];
$row4=$_POST['monitorips'];
$row5=$_POST['adminips'];
/////////////////////////////////////
$host='35.228.165.192'; $user='mine'; $pass='xxxxxxxxxx'; $dbn='servers';
$con_sql1=mysqli_connect($host, $user, $pass);
if (mysqli_connect_errno()) {
    printf('Connect failed: %s\n', mysqli_connect_error());
    exit(); }
if($result=mysqli_query($con_sql1, 'CREATE DATABASE servers')) { }
else { }
mysqli_close($con_sql1);

$con_sql2=mysqli_connect($host, $user, $pass, $dbn);
if (mysqli_connect_errno()) {
    printf('Connect failed: %s\n', mysqli_connect_error());
    exit(); }
mysqli_set_charset($con_sql2, 'utf8');
///
if($result1=mysqli_query($con_sql2, 'SELECT 1 FROM serv'.$row1.' LIMIT 1')) 
{ 
$drop1=mysqli_query($con_sql2, 'DROP TABLE serv'.$row1.'') or die(mysqli_error($con_sql2));
$query1='CREATE TABLE serv'.$row1.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,ips VARCHAR(16),domain VARCHAR(30),monitorips VARCHAR(16),adminips VARCHAR(16)) ENGINE = MyISAM;';
$result1=mysqli_query($con_sql2, $query1) or die(mysqli_error($con_sql2)); 
}
else 
{
$query1='CREATE TABLE serv'.$row1.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,ips VARCHAR(16),domain VARCHAR(30),monitorips VARCHAR(16),adminips VARCHAR(16)) ENGINE = MyISAM;';
$result1=mysqli_query($con_sql2, $query1) or die(mysqli_error($con_sql2)); 
}

/////////////////////////////////////
if (file_exists('./pmta/')) { } else { mkdir('./pmta/'); }
if (file_exists('./pmta/'.clean($row1).'')) { } else { mkdir('./pmta/'.clean($row1).''); }
if (file_exists('./pmta/'.clean($row1).'/config')) { unlink('./pmta/'.clean($row1).'/config'); touch('./pmta/'.clean($row1).'/config'); } else { touch('./pmta/'.clean($row1).'/config'); }
$parse1='./pmta/'.clean($row1).'/config';

/////
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

/////
$a='total-max-smtp-in 1000' . "\n" . 'total-max-smtp-out 1000' . "\n" . '' . "\n" . '##############################################' . "\n" . '<source 127.0.0.1>' . "\n" . 'process-x-virtual-mta yes' . "\n" . 'allow-unencrypted-plain-auth yes' . "\n" . 'log-data yes' . "\n" . 'remove-received-headers true' . "\n" . 'add-received-header false' . "\n" . 'hide-message-source true' . "\n" . 'smtp-service yes' . "\n" . 'log-connections yes' . "\n" . 'date-header-time delivery' . "\n" . 'add-message-id-header true' . "\n" . 'log-commands yes' . "\n" . '</source>' . "\n" . '' . "\n" . '<source 0/0>' . "\n" . 'process-x-virtual-mta yes' . "\n" . 'allow-unencrypted-plain-auth yes' . "\n" . 'log-data yes' . "\n" . 'remove-received-headers true' . "\n" . 'add-received-header false' . "\n" . 'hide-message-source true' . "\n" . 'smtp-service yes' . "\n" . 'log-connections yes' . "\n" . 'date-header-time delivery' . "\n" . 'add-message-id-header true' . "\n" . 'log-commands yes' . "\n" . '</source>' . "\n" . '';
file_put_contents($parse1, $a . "\n",FILE_APPEND);

/////
preg_match_all('/\d{1,}\.\d{1,}\.\d{1,}\.\d{1,}/', $row2, $out1);

$cnt1=count($out1[0]);

for($i1=1;$i1<=$cnt1;$i1++)
{
$que1[$i1]='INSERT INTO serv'.clean($row1).' (ips) VALUES ("'.clean($out1[0][$i1]).'")';
$res1[$i1]=mysqli_query($con_sql2, $que1[$i1]) or die(mysqli_error($con_sql2));

$b[$i1]='<source '.clean($out1[0][$i1]).'>' . "\n" . 'process-x-virtual-mta yes' . "\n" . 'allow-unencrypted-plain-auth yes' . "\n" . 'log-data yes' . "\n" . 'remove-received-headers true' . "\n" . 'add-received-header false' . "\n" . 'hide-message-source true' . "\n" . 'smtp-service yes' . "\n" . 'log-connections yes' . "\n" . 'date-header-time delivery' . "\n" . 'add-message-id-header true' . "\n" . 'log-commands yes' . "\n" . '</source>' . "\n" . '';
file_put_contents($parse1, $b[$i1] . "\n",FILE_APPEND);
}
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

$c='<domain *>' . "\n" . 'retry-after 5s' . "\n" . 'smtp-greeting-timeout 5m' . "\n" . 'use-starttls yes' . "\n" . 'dk-sign yes' . "\n" . 'dkim-sign yes' . "\n" . 'smtp-553-means-invalid-mailbox no' . "\n" . 'bounce-upon-5xx-greeting no' . "\n" . 'max-msg-rate 25/m' . "\n" . 'smtp-421-means-mx-unavailable yes' . "\n" . 'ignore-8bitmime yes' . "\n" . '</domain>' . "\n" . '' . "\n" . '##############################################';
file_put_contents($parse1, $c . "\n",FILE_APPEND);

/////
$que2='INSERT INTO serv'.clean($row1).' (domain) VALUES ("'.clean($row3).'")';
$res2=mysqli_query($con_sql2, $que2) or die(mysqli_error($con_sql2));

preg_match_all('/\d{1,}\.\d{1,}\.\d{1,}\.\d{1,}/', $row2, $out2);
$cnt2=count($out2[0]);

for($i2=1;$i2<=$cnt2;$i2++)
{
$d[$i2]='<virtual-mta vmta'.$i2.'>' . "\n" . 'smtp-source-host '.clean($out2[0][$i2]).' mta'.$i2.'.'.clean($row3).'' . "\n" . '<domain *>' . "\n" . 'max-smtp-out 5' . "\n" . 'require-starttls no' . "\n" . 'use-starttls yes' . "\n" . 'use-unencrypted-plain-auth yes' . "\n" . '</domain>' . "\n" . '<domain [*.]azure.com>' . "\n" . 'max-smtp-out 0' . "\n" . '</domain>' . "\n" . '</virtual-mta>' . "\n" . '';
file_put_contents($parse1, $d[$i2] . "\n",FILE_APPEND);
}
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

/////
for($i3=1;$i3<=$cnt2;$i3++)
{
$e[$i3]='<smtp-user user'.$i3.'>' . "\n" . 'password password' . "\n" . 'source auth'.$i3.'' . "\n" . '</smtp-user>' . "\n" . '';
file_put_contents($parse1, $e[$i3] . "\n",FILE_APPEND);
}
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

/////
for($i4=1;$i4<=$cnt2;$i4++)
{
$f[$i4]='<source auth'.$i4.'>' . "\n" . 'allow-mailmerge yes' . "\n" . 'always-allow-relaying yes' . "\n" . 'process-x-virtual-mta yes' . "\n" . 'remove-received-headers true' . "\n" . 'add-received-header false' . "\n" . 'hide-message-source true' . "\n" . 'smtp-service yes' . "\n" . 'require-auth true' . "\n" . 'date-header-time delivery' . "\n" . 'add-message-id-header true' . "\n" . 'default-virtual-mta vmta'.$i4.''  . "\n" . '</source>' . "\n" . '';
file_put_contents($parse1, $f[$i4] . "\n",FILE_APPEND);
}
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

/////
$g='smtp-listener 0/0:2525' . "\n" . 'http-mgmt-port 8080' . "\n" .'http-access 127.0.0.1 monitor' . "\n" . 'http-access 127.0.0.1 admin' . "\n" . '';
file_put_contents($parse1, $g . "\n",FILE_APPEND);

/////
preg_match_all('/\d{1,}\.\d{1,}\.\d{1,}\.\d{1,}/', $row4, $out4);
$cnt4=count($out4[0]);

for($i5=1;$i5<=$cnt4;$i5++)
{
$que3[$i5]='INSERT INTO serv'.clean($row1).' (monitorips) VALUES ("'.clean($out4[0][$i5]).'")';
$res3[$i5]=mysqli_query($con_sql2, $que3[$i5]) or die(mysqli_error($con_sql2));

$h[$i5]='http-access '.clean($out4[0][$i5]).' monitor' . "\n" .''; 
file_put_contents($parse1, $h[$i5] . "\n",FILE_APPEND);
}

/////
preg_match_all('/\d{1,}\.\d{1,}\.\d{1,}\.\d{1,}/', $row5, $out5);
$cnt5=count($out5[0]);

for($i6=1;$i6<=$cnt5;$i6++)
{
$que4[$i6]='INSERT INTO serv'.clean($row1).' (monitorips) VALUES ("'.clean($out5[0][$i6]).'")';
$res4[$i6]=mysqli_query($con_sql2, $que4[$i6]) or die(mysqli_error($con_sql2));

$j[$i6]='http-access '.clean($out5[0][$i6]).' admin' . "\n" . '';
file_put_contents($parse1, $j[$i6] . "\n",FILE_APPEND);
}
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

/////
$k='run-as-root no' . "\n" . '' . "\n" . 'log-file /var/log/pmta/log' . "\n" . '' . "\n" . '<acct-file /var/log/pmta/acct.csv>' . "\n" . '#move-to c:\myapp\pmta-acct' . "\n" . 'move-interval 5m' . "\n" . 'max-size 50M' . "\n" . 'delete-after 7d' . "\n" . '</acct-file>' . "\n" .'';
file_put_contents($parse1, $k . "\n",FILE_APPEND);
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

/////
for($i7=1;$i7<=$cnt2;$i7++)
{
$l[$i7]='#domain-key key1,mta'.$i7.'.'.clean($row3).',/etc/pmta/key1.mta'.$i7.'.'.clean($row3).'.pem';
file_put_contents($parse1, $l[$i7] . "\n",FILE_APPEND);
}
file_put_contents($parse1, '' . "\n" . '##############################################' . "\n",FILE_APPEND);

/////
$m='<spool /var/spool/pmta>' . "\n" . 'deliver-only no' . "\n" . 'delete-file-holders yes' . "\n" . '</spool>' . "\n" . '';
file_put_contents($parse1, $m . "\n",FILE_APPEND);
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);

/////
for($i8=1;$i8<=$cnt2;$i8++)
{
$n[$i8]='host-name mta'.$i8.'.'.clean($row3).'';
file_put_contents($parse1, $n[$i8] . "\n",FILE_APPEND);
}

/////
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);
file_put_contents($parse1, '##############################################' . "\n",FILE_APPEND);
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/* $go=file($parse1);
$gogo=count($go);
for($i7=0;$i7<$gogo;$i7++)
{
echo ''.htmlentities($go[$i7]).'<br>';
} */

