<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
////////////////////////////////////////////////
$pubip=$_POST['pubip'];
$privip=$_POST['privip'];
$pubdom=$_POST['pubdom'];
$admip=$_POST['admip'];
$conport=$_POST['conport'];
$lisport=$_POST['lisport'];
$shost=$_POST['shost'];
$ipnum=$_POST['ipnum'];
$group=$_POST['group'];
$pass=$_POST['pass'];
$nic=$_POST['nic'];

/* $pubip=clean($pubip);
$privip=clean($privip);
$pubdom=clean($pubdom);
$admip=clean($admip);
$conport=clean($conport);
$lisport=clean($lisport);
$shost=clean($shost);
$ipnum=clean($ipnum); */

$check=file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
file_put_contents('c:/inetpub/wwwroot/temp.txt', $check);

if (file_exists('c:/inetpub/wwwroot/pmta/')) { } else { mkdir('c:/inetpub/wwwroot/pmta/'); }
if (file_exists('c:/inetpub/wwwroot/pmta/config_pmta.txt')) { unlink('c:/inetpub/wwwroot/pmta/config_pmta.txt'); touch('c:/inetpub/wwwroot/pmta/config_pmta.txt'); } else { touch('c:/inetpub/wwwroot/pmta/config_pmta.txt'); }
$parse='c:/inetpub/wwwroot/pmta/config_pmta.txt';

////////////////////////////////////
$a1='<source 127.0.0.1>
log-connections no
log-commands no
log-data no
allow-unencrypted-plain-auth yes
allow-mailmerge yes
smtp-service yes
process-x-virtual-mta yes
remove-received-headers true
add-received-header false
hide-message-source true
add-message-id-header true 
add-date-header override
date-header-time delivery 
</source>

<source 0/0>
log-connections no
log-commands no
log-data no
allow-unencrypted-plain-auth yes 
allow-mailmerge yes 
smtp-service yes
process-x-virtual-mta yes
remove-received-headers true
add-received-header false
hide-message-source true
add-message-id-header true
add-date-header override
date-header-time delivery
</source>

<source '.$pubip.'>
log-connections no
log-commands no
log-data no
allow-unencrypted-plain-auth yes 
allow-mailmerge yes 
smtp-service yes
process-x-virtual-mta yes
remove-received-headers true
add-received-header false
hide-message-source true
add-message-id-header true 
add-date-header override
date-header-time delivery 
</source>
######################';
file_put_contents($parse, $a1 . "\n",FILE_APPEND);

///
$a2='<domain *>
retry-after 30s 
smtp-greeting-timeout 5m
#max-smtp-out 20
max-rcpt-per-message 100
bounce-after 4d12h
log-connections no
log-commands no
log-transfer-failures no
log-data no
deliver-local-dsn no
use-starttls yes
dkim-sign yes
smtp-553-means-invalid-mailbox no
bounce-upon-5xx-greeting no
smtp-421-means-mx-unavailable yes
ignore-8bitmime yes
</domain>

##############
# Hotmail Settings
<smtp-pattern-list hotmail-errors>
reply /exceeded the rate limit/ mode=backoff
reply /exceeded the connection limit/ mode=backoff
reply /Mail rejected by Windows Live Hotmail for policy reasons/ mode=backoff
reply /mail.live.com\/mail\/troubleshooting.aspx/ mode=backoff
reply /Please try again/ mode=backoff
</smtp-pattern-list>

domain-macro hotmail hotmail.be,hotmail.ch,hotmail.co.id,hotmail.co.il,hotmail.co.jp,hotmail.co.kr,hotmail.co.nz,hotmail.co.th,hotmail.co.za,hotmail.com,hotmail.com.ar,hotmail.com.au,hotmail.com.br,hotmail.com.hk,hotmail.com.tr,hotmail.com.tw,hotmail.com.vn,hotmail.cz,hotmail.de,hotmail.dk,hotmail.es,hotmail.fi,hotmail.fr,hotmail.gr,hotmail.it,hotmail.my,hotmail.no,hotmail.ph,hotmail.rs,hotmail.se,hotmail.sg,live.at,live.be,live.ca,live.cl,live.cn,live.co.kr,live.co.uk,live.co.za,live.com,live.com.ar,live.com.au,live.com.my,live.com.ph,live.com.pt,live.com.sg,live.de,live.dk,live.fr,live.hk,live.ie,live.in,live.it,live.jp,live.nl,live.no,live.ru,live.se,livemail.tw,msn.com,outlook.com,windowslive.com,hotmail.co.uk

<domain hotmail.queue>
max-smtp-out 20
max-msg-per-connection 100
max-msg-rate 2500/m
max-connect-rate 10/m
smtp-421-means-mx-unavailable yes
smtp-pattern-list hotmail-errors
retry-after 1m
backoff-retry-after 2m
backoff-to-normal-after-delivery true
backoff-max-msg-rate 10000/h
smtp-hosts hotmail.com
#dk-sign yes
dkim-sign yes
</domain>

<domain $hotmail>
  queue-to "hotmail.queue"
</domain>

##############
domain-macro orange
orange.fr,wanadoo.fr

<domain $orange>
queue-to "orange.queue"
</domain>

<domain orange.queue>
max-smtp-out 30
max-msg-per-connection 500
max-rcpt-per-message 1000
max-msg-rate 10000/m
max-connect-rate 3/s
retry-after 1s
smtp-421-means-mx-unavailable yes
smtp-553-means-invalid-mailbox no
bounce-upon-5xx-greeting no
smtp-hosts 193.252.22.65
dkim-sign yes
ignore-8bitmime yes
#smtp-pattern-list virginmedia-errors
#backoff-retry-after 10m
#backoff-to-normal-after-delivery true
#backoff-max-msg-rate 10000/h
</domain>

##############
domain-macro suddenlink
suddenlink.net

<domain $suddenlink>
queue-to "suddenlink.queue"
</domain>

<domain suddenlink.queue>
#max-smtp-out 30
#max-msg-per-connection 500
#max-msg-rate 5000/m
#max-connect-rate 10/m
retry-after 5s
smtp-421-means-mx-unavailable yes
smtp-553-means-invalid-mailbox no
bounce-upon-5xx-greeting no
smtp-hosts 208.180.40.132
dkim-sign yes
ignore-8bitmime yes
#smtp-pattern-list virginmedia-errors
#backoff-retry-after 10m
#backoff-to-normal-after-delivery true
#backoff-max-msg-rate 10000/h
</domain>

##############
domain-macro virginmedia
virginmedia.com,ntlworld.com,virgin.net,blueyonder.co.uk

<domain $virginmedia>
queue-to "virginmedia.queue"
</domain>

<domain virginmedia.queue>
#max-smtp-out 30
#max-msg-per-connection 500
#max-msg-rate 5000/m
#max-connect-rate 10/m
retry-after 5s
smtp-421-means-mx-unavailable yes
smtp-553-means-invalid-mailbox no
bounce-upon-5xx-greeting no
smtp-hosts 212.54.56.11
dkim-sign yes
ignore-8bitmime yes
#smtp-pattern-list virginmedia-errors
#backoff-retry-after 10m
#backoff-to-normal-after-delivery true
#backoff-max-msg-rate 10000/h
</domain>

##############
domain-macro mailru
mail.ru,inbox.ru,list.ru,bk.ru

<domain $mailru>
queue-to "mailru.queue"
</domain>

<domain mailru.queue>
max-smtp-out 30
max-msg-per-connection 500
max-rcpt-per-message 1000
max-msg-rate 10000/m
max-connect-rate 3/s
retry-after 1s
smtp-421-means-mx-unavailable yes
smtp-553-means-invalid-mailbox no
bounce-upon-5xx-greeting no
smtp-hosts 94.100.180.104
dkim-sign yes
ignore-8bitmime yes
#smtp-pattern-list virginmedia-errors
#backoff-retry-after 10m
#backoff-to-normal-after-delivery true
#backoff-max-msg-rate 10000/h
</domain>

##############
domain-macro rambler
rambler.ru,lenta.ru,autorambler.ru,myrambler.ru,ro.ru,rambler.ua

<domain $rambler>
queue-to "rambler.queue"
</domain>

<domain rambler.queue>
max-smtp-out 30
max-msg-per-connection 500
max-rcpt-per-message 1000
max-msg-rate 10000/m
max-connect-rate 3/s
retry-after 1s
smtp-421-means-mx-unavailable yes
smtp-553-means-invalid-mailbox no
bounce-upon-5xx-greeting no
smtp-hosts 81.19.78.66
dkim-sign yes
ignore-8bitmime yes
#smtp-pattern-list virginmedia-errors
#backoff-retry-after 10m
#backoff-to-normal-after-delivery true
#backoff-max-msg-rate 10000/h
</domain>

##############
domain-macro yandex
yandex.ru,yandex.com,yandex.kz,ya.ru

<domain $yandex>
queue-to "yandex.queue"
</domain>

<domain yandex.queue>
max-smtp-out 30
max-msg-per-connection 500
max-rcpt-per-message 1000
max-msg-rate 10000/m
max-connect-rate 3/s
retry-after 1s
smtp-421-means-mx-unavailable yes
smtp-553-means-invalid-mailbox no
bounce-upon-5xx-greeting no
smtp-hosts 77.88.21.89
#smtp-hosts 2a02:6b8::89
dkim-sign yes
ignore-8bitmime yes
#smtp-pattern-list virginmedia-errors
#backoff-retry-after 10m
#backoff-to-normal-after-delivery true
#backoff-max-msg-rate 10000/h
</domain>

##############
#Gmail Settings
<smtp-pattern-list gmail-errors>
reply /has been temporarily blocked/ mode=backoff
</smtp-pattern-list>

<domain gmail.com>
max-smtp-out 1200
max-msg-per-connection 20
smtp-pattern-list gmail-errors
retry-after 5m
backoff-retry-after 2m
backoff-to-normal-after-delivery true
backoff-max-msg-rate 10000/h
smtp-hosts gmail.com
#dk-sign yes
dkim-sign yes
</domain>

##############
# Yahoo Settings
<smtp-pattern-list yahoo-errors>
reply /\[TS03\]/ mode=backoff
reply /\[TS02\]/ mode=backoff
reply /\[TS01\]/ mode=backoff
</smtp-pattern-list>

domain-macro yahoo 
yahoo.com,yahoo.co.uk,yahoo.de,yahoo.dk,yahoo.fr,yahoo.gr,yahoo.it,yahoo.no,yahoo.pl,yahoo.se,rocketmail.com,y7mail.com,yahoo.ca,yahoo.cl,yahoo.co.nz,yahoo.com.ar,yahoo.com.au,yahoo.com.br,yahoo.com.co,yahoo.com.mx,yahoo.com.pe,yahoo.com.tr,yahoo.com.ve,ymail.com,yahoo.com.my,yahoo.com.ph,yahoo.com.sg,yahoo.co.th,yahoo.co.id,yahoo.co.in,yahoo.com.vn,yahoo.in,yahoo.com.my,yahoo.com.ph,yahoo.com.sg,yahoo.co.th,yahoo.co.id,yahoo.co.in,yahoo.com.vn,yahoo.in

<domain yahoo.queue>
max-smtp-out 300 
max-msg-per-connection 1000 
smtp-pattern-list yahoo-errors
retry-after 10s
backoff-retry-after 10s
backoff-to-normal-after-delivery true
backoff-max-msg-rate 100000/h
smtp-hosts yahoo.com
#dk-sign yes
dkim-sign yes
</domain>

<domain $yahoo>
queue-to "yahoo.queue"
</domain>

##############
# Aol Settings
<smtp-pattern-list aol-errors>
reply /421 .* SERVICE NOT AVAILABLE/ mode=backoff
reply /generating high volumes of.* complaints from AOL/ mode=backoff
reply /554 .*aol.com/ mode=backoff
reply /421dynt1/ mode=backoff
reply /HVU:B1/ mode=backoff
reply /DNS:NR/ mode=backoff
reply /RLY:NW/ mode=backoff
reply /DYN:T1/ mode=backoff
reply /RLY:BD/ mode=backoff
reply /RLY:CH2/ mode=backoff
</smtp-pattern-list>

domain-macro aol 
aim.com,aol.at,aol.be,aol.ch,aol.cl,aol.co.nz,aol.co.uk,aol.com,aol.com.ar,aol.com.au,aol.com.br,aol.com.co,aol.com.tr,aol.com.ve,aol.cz,aol.de,aol.dk,aol.es,aol.fi,aol.fr,aol.hk,aol.in,aol.it,aol.jp,aol.kr,aol.nl,aol.pl,aol.ru,aol.se,aol.tw,aolchina.com,aolnorge.no,aolpolska.pl,luckymail.com,wmconnect.com,cs.com,myaol.jp

<domain aol.queue>
   smtp-hosts aol.com
   #dk-sign yes
   dkim-sign yes
   log-transfer-failures no
   log-connections no
   log-commands no
   retry-after 2m
   max-smtp-out 20
   max-msg-per-connection 50
   smtp-pattern-list aol-errors
</domain>

<domain $aol>
  queue-to "aol.queue"
</domain>

##############
# Comcast Settings
<domain comcast.net>
max-smtp-out 3
max-msg-per-connection 1000
#dk-sign yes
dkim-sign yes
</domain>

##############
# Cox Settings
<domain cox.net>
max-smtp-out 3
max-msg-per-connection 100
#dk-sign yes
dkim-sign yes
</domain>

##############
# ATT Settings
<domain att.net>
max-smtp-out 3
max-msg-per-connection 100
dk-sign  yes
dkim-sign yes
</domain>

##############
# Verizon Settings
<domain verizon.net>
max-smtp-out 30
max-msg-per-connection 100
#dk-sign yes
dkim-sign yes
</domain>

##############
# Earthlink Settings
<domain earthlink.net>
max-smtp-out 30
max-msg-per-connection 100
#dk-sign yes
dkim-sign yes
</domain>

##############
# Bellsouth Settings
<domain bellsouth.net>
max-smtp-out 30
max-msg-per-connection 100
#dk-sign yes
dkim-sign yes
</domain>

##############
# SBCGlobal Settings
<smtp-pattern-list Sbcglobal-errors>
#reply /\[140\]/ mode=backoff
#reply /\[160\]/ mode=backoff
reply /\[MC02\]/ mode=backoff
reply /\[GL01\]/ mode=backoff
reply /\[TS03\]/ mode=backoff
reply /\[TS02\]/ mode=backoff
reply /\[TS01\]/ mode=backoff
#reply /421 .* Please try again later/ mode=backoff
reply /421 Message temporarily deferred/ mode=backoff
#reply /VS3-IP5 Excessive unknown recipients/ mode=backoff
#reply /VSS-IP Excessive unknown recipients/ mode=backoff
</smtp-pattern-list>

<domain sbcglobal.net>
max-smtp-out 1200
max-msg-per-connection 1000
smtp-pattern-list sbcglobal-errors
backoff-retry-after 2m
backoff-to-normal-after-delivery true
backoff-max-msg-rate 100000/h
retry-after 2m
smtp-hosts sbcglobal.net
#dk-sign yes
dkim-sign yes
</domain>
##############';
file_put_contents($parse, $a2 . "\n",FILE_APPEND);

///
$a3='http-access '.$admip.' admin
http-access 127.0.0.1 admin
http-access ::1 admin
http-mgmt-port '.$conport.'
run-as-root no

log-file /var/log/pmta/pmta.log 

<spool /var/spool/pmta>
deliver-only no
delete-file-holders yes
</spool>

smtp-listener '.$privip.':'.$lisport.'
###';
file_put_contents($parse, $a3 . "\n",FILE_APPEND);

//////
$accounts=file('./temp.txt');

preg_match_all('/(\d{1,3}\.){3}/', $privip, $out1);
preg_match_all('/.*\d{1,3}/', $pubdom, $out2);
$out2_1=preg_replace('/\d/', '', $out2[0][0]);
$out2_2=preg_replace('/.*\d{1,3}/', '', $pubdom);
$out2_3=preg_replace('/.*\d{1,3}\./', '', $pubdom);
$out2_3=preg_replace('/\..*/', '', $out2_3);

$u=11;
for($i=0;$i<$ipnum;$i++)
{
$a7='host-name '.clean($out2_1).''.$u.''.clean($out2_2).'';
$u++;
file_put_contents($parse, $a7 . "\n",FILE_APPEND);
}

$u=11;
for($i=0;$i<$ipnum;$i++)
{
$out3_1=preg_replace('/:.*/', '', $accounts[$i]);
$out3_2=preg_replace('/^.*:/', '', $accounts[$i]);	
	
$a4='###
<virtual-mta mta'.$u.'>
smtp-source-host '.clean($out1[0][0]).''.$u.' '.clean($out2_1).''.$u.''.clean($out2_2).'
<domain *> 
max-smtp-out 3
#max-msg-rate 30/m
max-connect-rate 10/m
require-starttls no  
use-starttls yes 
smtp-hosts '.$shost.' 
auth-username '.clean($out3_1).'
auth-password '.clean($out3_2).'
use-unencrypted-plain-auth yes 
</domain>
</virtual-mta>';
$u++;
file_put_contents($parse, $a4 . "\n",FILE_APPEND);
}

///
$u=11;
for($i=0;$i<$ipnum;$i++)
{
$a5='###
<smtp-user user'.$u.'>
password password
source auth'.$u.'
</smtp-user>';
$u++;
file_put_contents($parse, $a5 . "\n",FILE_APPEND);
}

///
$u=11;
for($i=0;$i<$ipnum;$i++)
{
$a6='###
<source auth'.$u.'>
allow-mailmerge yes
always-allow-relaying yes 
process-x-virtual-mta yes 
remove-received-headers true
add-received-header false
hide-message-source true
smtp-service yes 
require-auth true
default-virtual-mta mta'.$u.'
</source>';
$u++;
file_put_contents($parse, $a6 . "\n",FILE_APPEND);
}



if (file_exists('c:/inetpub/wwwroot/pmta/atomic.csv')) { unlink('c:/inetpub/wwwroot/pmta/atomic.csv'); touch('c:/inetpub/wwwroot/pmta/atomic.csv'); } else { touch('c:/inetpub/wwwroot/pmta/atomic.csv'); }
$conf='c:/inetpub/wwwroot/pmta/atomic.csv';
$top1='active;host;port;auth_type;login;password;pop_host;pop_port;from_field;enc_type;threads;pause_unit;pause_msg;pause_time_min;pause_time_max;msg_unit;msg_speed';
file_put_contents($conf, $top1 . "\n",FILE_APPEND);

$u=11;
for($i=0;$i<$ipnum;$i++)
{
$out4_1=preg_replace('/:.*/', '', $accounts[$i]);
$h='1;'.clean($pubip).';'.clean($lisport).';5;user'.$u.';"password";;0;'.clean($out4_1).';1;10;1;0;0;0;2;500';
file_put_contents($conf, $h . "\n",FILE_APPEND);
$u++;
}


////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
if (file_exists('c:/inetpub/wwwroot/ip/')) 
{ 
$files=scandir('c:/inetpub/wwwroot/ip/', 1);
$cnt2=count($files)-2;
for($ini=0;$ini<$cnt2;$ini++)
{ unlink('c:/inetpub/wwwroot/ip/'.$files[$ini].''); } 
} 
else { mkdir('c:/inetpub/wwwroot/ip/'); }

if (file_exists('c:/inetpub/wwwroot/ip/ip.cmd')) { unlink('c:/inetpub/wwwroot/ip/ip.cmd'); touch('c:/inetpub/wwwroot/ip/ip.cmd'); } else { touch('c:/inetpub/wwwroot/ip/ip.cmd'); }
$bat='c:/inetpub/wwwroot/ip/ip.cmd';
if (file_exists('c:/inetpub/wwwroot/ip/addips.txt')) { unlink('c:/inetpub/wwwroot/ip/addips.txt'); touch('c:/inetpub/wwwroot/ip/addips.txt'); } else { touch('c:/inetpub/wwwroot/ip/addips.txt'); }
$txt='c:/inetpub/wwwroot/ip/addips.txt';

///
/* for($i=11;$i<=$cnt1;$i++)
{
$a='az network dns record-set cname set-record --resource-group kirgudu --zone-name cloudupgo.com --record-set-name weesteueuroope'.$i.' --cname weesteueuroope'.$i.'.westeurope.cloudapp.azure.com';
file_put_contents($txt, $a . "\n",FILE_APPEND);
} */
///

///
/* for($i=11;$i<=$cnt1;$i++)
{
$b='az network public-ip create -n weesteueuroope'.$i.' -g kirgudu -l westeurope --dns-name weesteueuroope'.$i.' --reverse-fqdn weesteueuroope'.$i.'.cloudupgo.com --sku Standard';
file_put_contents($txt, $b . "\n",FILE_APPEND);
} */
///
$u=11;
for($i=0;$i<$ipnum;$i++)
{
$b='az network public-ip create -n '.clean($out2_1).''.$u.' -g '.clean($group).' -l '.clean($out2_3).' --dns-name '.clean($out2_1).''.$u.' --reverse-fqdn '.clean($out2_1).''.$u.''.clean($out2_2).' --sku Standard';
file_put_contents($txt, $b . "\n",FILE_APPEND);
$u++;
}
///
$u=11;
for($i=0;$i<$ipnum;$i++)
{
$c='az network nic ip-config create --resource-group '.clean($group).' --nic-name '.clean($nic).' --name '.$u.' --private-ip-address '.clean($out1[0][0]).''.$u.' --public-ip-address '.clean($out2_1).''.$u.'';
file_put_contents($txt, $c . "\n",FILE_APPEND);
$u++;
}
///

///
$u=11;
for($i=0;$i<$ipnum;$i++)
{
$e='DEVICE=eth0:'.$i.'
ONBOOT=yes
BOOTPROTO=static
TYPE=Ethernet
USERCTL=no
PEERDNS=yes
IPV6INIT=no
NM_CONTROLLED=no
IPADDR='.clean($out1[0][0]).''.$u.'
PREFIX=24
GATEWAY='.clean($out1[0][0]).'1';
file_put_contents('c:/inetpub/wwwroot/ip/ifconfig'.$i.'.txt', $e);
$u++;
}
///

/////
if (file_exists('c:/inetpub/wwwroot/ip/sockd.txt')) { unlink('c:/inetpub/wwwroot/ip/sockd.txt'); touch('c:/inetpub/wwwroot/ip/sockd.txt'); } else { touch('c:/inetpub/wwwroot/ip/sockd.txt'); }
$txt1='c:/inetpub/wwwroot/ip/sockd.txt';

$a5='logoutput: stderr';
file_put_contents($txt1, $a5 . "\n",FILE_APPEND);


for($i=0;$i<$ipnum;$i++)
{
$h='internal: eth0:'.$i.' port=33333
external: eth0:'.$i.'';
file_put_contents($txt1, $h . "\n",FILE_APPEND);
}

$a6='external.rotation: same-same
socksmethod: none
clientmethod: none

user.privileged: root
user.unprivileged: nobody

client pass {
        from: 0.0.0.0/0 to: 0.0.0.0/0
        log: connect error
}
socks pass {
        from: 0.0.0.0/0 to: 0.0.0.0/0
        log: connect error
}';
file_put_contents($txt1, $a6,FILE_APPEND);
/////

//////////
$a1='echo "y" | plink -batch vip@'.$pubip.' -pw xxxxxxxxxx "sudo adduser valerka && sudo chmod 777 -R /etc/sysconfig/network-scripts/ && sudo yum install http://mirror.ghettoforge.org/distributions/gf/gf-release-latest.gf.el7.noarch.rpm -y && sudo yum --enablerepo=gf-plus install dante-server -y && sudo chmod 777 /etc/sockd.conf && sudo mkdir /var/run/sockd/ && sudo chmod 777 -R /var/run/sockd/"';
file_put_contents($bat, $a1 . "\n",FILE_APPEND);

$a8='echo "y" | plink -batch vip@'.$pubip.' -pw xxxxxxxxxx "printf &#039;'.clean($pass).'&#039;\n&#039;'.clean($pass).'\n&#039; | sudo passwd valerka"';
file_put_contents($bat, html_entity_decode($a8, ENT_QUOTES) . "\n",FILE_APPEND);

$a2='(';
file_put_contents($bat, $a2,FILE_APPEND);

$u=11;
for($i=0;$i<$ipnum;$i++)
{
$f='echo put c:/inetpub/wwwroot/ip/ifconfig'.$i.'.txt /etc/sysconfig/network-scripts/ifcfg-eth0:'.$i.' && ';
file_put_contents($bat, $f,FILE_APPEND);
$g='ifconfig eth0:'.$i.' '.clean($out1[0][0]).''.$u.' netmask 255.255.255.0;ifconfig eth0:'.$i.' up;';
file_put_contents($txt, $g . "\n",FILE_APPEND);
$u++;
}

$u=11;
for($i=0;$i<$ipnum;$i++)
{
	
$j=''.clean($out2_1).''.$u.''.clean($out2_2).':33333:valerka:'.clean($pass).'';
file_put_contents($txt, $j . "\n",FILE_APPEND);
$u++;
}

$a3='echo put c:/inetpub/wwwroot/ip/sockd.txt /etc/sockd.conf && echo "--------------------DONE--------------------") | psftp -batch '.clean($pubip).' -l vip -pw xxxxxxxxxx';
file_put_contents($bat, $a3 . "\n",FILE_APPEND);

$a7='echo "y" | plink -batch vip@'.$pubip.' -pw xxxxxxxxxx "sudo systemctl enable sockd && sudo systemctl stop sockd && sudo systemctl start sockd && sudo systemctl status sockd"';
file_put_contents($bat, $a7 . "\n",FILE_APPEND);

$a4='echo "y" | plink -batch vip@'.$pubip.' -pw xxxxxxxxxx "sudo systemctl restart network"';
file_put_contents($bat, $a4,FILE_APPEND);



$a=file_get_contents('c:/inetpub/wwwroot/index2.html');

$a=preg_replace('/\$\("#publicip"\)\.val.*/', '$("#publicip").val("'.$pubip.'")', $a);
$a=preg_replace('/\$\("#privateip"\)\.val.*/', '$("#privateip").val("'.$privip.'")', $a);
$a=preg_replace('/\$\("#publicdomain"\)\.val.*/', '$("#publicdomain").val("'.$pubdom.'")', $a);
$a=preg_replace('/\$\("#adminip"\)\.val.*/', '$("#adminip").val("'.$admip.'")', $a);
$a=preg_replace('/\$\("#consoleport"\)\.val.*/', '$("#consoleport").val("'.$conport.'")', $a);
$a=preg_replace('/\$\("#listenerport"\)\.val.*/', '$("#listenerport").val("'.$lisport.'")', $a);
$a=preg_replace('/\$\("#smtphost"\)\.val.*/', '$("#smtphost").val("'.$shost.'")', $a);
$a=preg_replace('/\$\("#ipsnumber"\)\.val.*/', '$("#ipsnumber").val("'.$ipnum.'")', $a);
$a=preg_replace('/\$\("#resourcegroup"\)\.val.*/', '$("#resourcegroup").val("'.$group.'")', $a);
$a=preg_replace('/\$\("#password"\)\.val.*/', '$("#password").val("'.$pass.'")', $a);
$a=preg_replace('/\$\("#nicname"\)\.val.*/', '$("#nicname").val("'.$nic.'")', $a);


file_put_contents('./index2.html', $a);
unlink('c:/inetpub/wwwroot/temp.txt');
header('Location: index2.html');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();