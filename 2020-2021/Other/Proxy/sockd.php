<?php

$ip='51.124.184.85';
$pswd='xxxxxxxxxx';
$cnt1='61';

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
if (file_exists('c:/inetpub/wwwroot/ip/a.txt')) { unlink('c:/inetpub/wwwroot/ip/a.txt'); touch('c:/inetpub/wwwroot/ip/a.txt'); } else { touch('c:/inetpub/wwwroot/ip/a.txt'); }
$txt='c:/inetpub/wwwroot/ip/a.txt';

///
for($i=11;$i<=$cnt1;$i++)
{
$a='az network dns record-set cname set-record --resource-group kirgudu --zone-name cloudupgo.com --record-set-name weesteueuroope'.$i.' --cname weesteueuroope'.$i.'.westeurope.cloudapp.azure.com';
file_put_contents($txt, $a . "\n",FILE_APPEND);
}
///

///
for($i=11;$i<=$cnt1;$i++)
{
$b='az network public-ip create -n weesteueuroope'.$i.' -g kirgudu -l westeurope --dns-name weesteueuroope'.$i.' --reverse-fqdn weesteueuroope'.$i.'.cloudupgo.com --sku Standard';
file_put_contents($txt, $b . "\n",FILE_APPEND);
}
///

///
for($i=11;$i<=$cnt1;$i++)
{
$c='az network nic ip-config create --resource-group kirgudu --nic-name centos1VMNic --name '.$i.' --private-ip-address 10.0.0.'.$i.' --public-ip-address weesteueuroope'.$i.'';
file_put_contents($txt, $c . "\n",FILE_APPEND);
}
///

///
$u=0;
for($i=11;$i<=$cnt1;$i++)
{
$e='DEVICE=eth0:'.$u.'
ONBOOT=yes
BOOTPROTO=static
TYPE=Ethernet
USERCTL=no
PEERDNS=yes
IPV6INIT=no
NM_CONTROLLED=no
IPADDR=10.0.0.'.$i.'
PREFIX=24
GATEWAY=10.0.0.1';
file_put_contents('c:/inetpub/wwwroot/ip/ifconfig'.$u.'.txt', $e);
$u++;
}
///

/////
if (file_exists('c:/inetpub/wwwroot/ip/sockd.txt')) { unlink('c:/inetpub/wwwroot/ip/sockd.txt'); touch('c:/inetpub/wwwroot/ip/sockd.txt'); } else { touch('c:/inetpub/wwwroot/ip/sockd.txt'); }
$txt1='c:/inetpub/wwwroot/ip/sockd.txt';

$a5='logoutput: stderr';
file_put_contents($txt1, $a5 . "\n",FILE_APPEND);

$u=0;
for($i=11;$i<=$cnt1;$i++)
{
$h='internal: eth0:'.$u.' port=77'.$i.'
external: eth0:'.$u.'';
file_put_contents($txt1, $h . "\n",FILE_APPEND);
$u++;
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
$a1='echo "y" | plink -batch vip@'.$ip.' -pw xxxxxxxxxx "sudo chmod 777 -R /etc/sysconfig/network-scripts/ && sudo yum install http://mirror.ghettoforge.org/distributions/gf/gf-release-latest.gf.el7.noarch.rpm -y && sudo yum --enablerepo=gf-plus install dante-server -y && sudo chmod 777 /etc/sockd.conf && sudo mkdir /var/run/sockd/ && sudo chmod 777 -R /var/run/sockd/"';
file_put_contents($bat, $a1 . "\n",FILE_APPEND);

$a2='(';
file_put_contents($bat, $a2,FILE_APPEND);

$u=0;
for($i=11;$i<=$cnt1;$i++)
{
$f='echo put c:/inetpub/wwwroot/ip/ifconfig'.$u.'.txt /etc/sysconfig/network-scripts/ifcfg-eth0:'.$u.' && ';
file_put_contents($bat, $f,FILE_APPEND);
$g='ifconfig eth0:'.$u.' 10.0.0.'.$i.' netmask 255.255.255.0;ifconfig eth0:'.$u.' up;';
file_put_contents($txt, $g . "\n",FILE_APPEND);
$u++;
}

$u=0;
for($i=11;$i<=$cnt1;$i++)
{
$j='weesteueuroope'.$i.'.westeurope.cloudapp.azure.com:77'.$i.':valerka:Valerka7788!';
file_put_contents($txt, $j . "\n",FILE_APPEND);
$u++;
}

$a3='echo put c:/inetpub/wwwroot/ip/sockd.txt /etc/sockd.conf && echo "--------------------DONE--------------------") | psftp -batch '.$ip.' -l vip -pw '.$pswd.'';
file_put_contents($bat, $a3 . "\n",FILE_APPEND);

$a7='echo "y" | plink -batch vip@'.$ip.' -pw xxxxxxxxxx "sudo systemctl enable sockd && sudo systemctl stop sockd && sudo systemctl start sockd && sudo systemctl status sockd"';
file_put_contents($bat, $a7 . "\n",FILE_APPEND);

$a4='echo "y" | plink -batch vip@'.$ip.' -pw xxxxxxxxxx "sudo systemctl restart network"';
file_put_contents($bat, $a4,FILE_APPEND);
//////////

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();

?>




