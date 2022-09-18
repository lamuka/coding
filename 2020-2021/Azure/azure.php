<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

function clean1($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
//$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
//$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
//$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
////////////////////////////////////////////////
$pubdom=clean($_POST['pubdom']);
$privip=clean($_POST['privip']);
$ipnum=clean($_POST['ipnum']);
$group=clean($_POST['group']);
$prname=clean($_POST['prname']);
$prpass=clean($_POST['prpass']);
$prport=clean($_POST['prport']);
$uname=clean($_POST['uname']);
$upass=clean($_POST['upass']);
$instname=clean($_POST['instname']);
$mainip=clean($_POST['mainip']);
$pname=clean($_POST['pname']);



////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
$dir=dirname(__FILE__);

/////SSH KEYS/////
if (file_exists(''.$dir.'/azure/')==FALSE) { mkdir(''.$dir.'/azure/'); }

if(file_exists(''.$dir.'/azure/centos.ppk')==FALSE)
{
system('ssh-keygen -m PEM -t rsa -b 4096 -N "" -f '.$dir.'/azure/centos.pem');
rename(''.$dir.'/azure/centos.pem.pub', ''.$dir.'/azure/centos.pub');
system('puttygen '.$dir.'/azure/centos.pem -o '.$dir.'/azure/centos.ppk -O private');
}
///

if (file_exists(''.$dir.'/azure/'.$instname.'/')==FALSE) 
{ 
mkdir(''.$dir.'/azure/'.$instname.'/'); 
} 
else
{
$files=scandir(''.$dir.'/azure/'.$instname.'/', 1);
$cnt2=count($files)-2;
for($ini=0;$ini<$cnt2;$ini++)
{ unlink(''.$dir.'/azure/'.$instname.'/'.$files[$ini].''); } 
} 

file_put_contents(''.$dir.'/azure/prname.txt', $prname);
file_put_contents(''.$dir.'/azure/prpass.txt', $prpass);
file_put_contents(''.$dir.'/azure/prport.txt', $prport);



preg_match_all('/(\d{1,3}\.){3}/', $privip, $out1);
$out1[0][0]=clean($out1[0][0]);


/////CREATE INSTANCES/////
if (file_exists(''.$dir.'/azure/'.$instname.'/create.txt')) { unlink(''.$dir.'/azure/'.$instname.'/create.txt'); touch(''.$dir.'/azure/'.$instname.'/create.txt'); } else { touch(''.$dir.'/azure/'.$instname.'/create.txt'); }
$txt=''.$dir.'/azure/'.$instname.'/create.txt';

/* if(file_exists(''.$dir.'/azure/createall.txt')==FALSE)
{
$b0='az group create --location westeurope --name '.$group.'';
file_put_contents($txt, $b0 . "\n",FILE_APPEND);
} */

$b1='az network vnet create -g '.$group.' -n VNet'.$instname.' --location '.$pubdom.' --address-prefix '.$out1[0][0].'0/24 --subnet-name Sub'.$instname.' --subnet-prefix '.$out1[0][0].'0/24';
file_put_contents($txt, $b1 . "\n",FILE_APPEND);

$b2='az network nsg create -g '.$group.' -n Nsg'.$instname.' --location '.$pubdom.'';
file_put_contents($txt, $b2 . "\n",FILE_APPEND);

$b3='az network nsg rule create -g '.$group.' --nsg-name Nsg'.$instname.' -n '.$instname.'Rule --priority 100 --source-address-prefixes 93.183.192.0/18 94.232.72.0/21 188.247.116.0/22 176.102.48.0/20 176.105.168.0/21 176.105.176.0/21 176.105.192.0/20 176.241.104.0/21 176.241.128.0/19 188.247.96.0/20 188.247.120.0/21 176.112.0.0/19 188.0.64.0/19 188.247.112.0/22 176.102.32.0/21 51.116.179.242/32 20.52.2.173/32 '.$mainip.'/32 --source-port-ranges &#039;*&#039; --destination-address-prefixes &#039;*&#039; --destination-port-ranges 22 --access Allow --protocol &#039;*&#039;';
file_put_contents($txt, html_entity_decode($b3, ENT_QUOTES) . "\n",FILE_APPEND);

$b4='az network nsg rule create -g '.$group.' --nsg-name Nsg'.$instname.' -n '.$instname.'Rule1 --priority 110 --source-address-prefixes &#039;*&#039; --source-port-ranges &#039;*&#039; --destination-address-prefixes &#039;*&#039; --destination-port-ranges '.$prport.' --access Allow --protocol &#039;*&#039;';
file_put_contents($txt, html_entity_decode($b4, ENT_QUOTES) . "\n",FILE_APPEND);

$b5='az vm create --name '.$instname.' --resource-group '.$group.' --image Centos --ssh-key-values /home/'.$pname.'/centos.pub --location '.$pubdom.' --size Standard_DS2_v2 --authentication-type ssh --admin-username '.$uname.' --data-disk-sizes-gb 8 --vnet-name VNet'.$instname.' --vnet-address-prefix '.$out1[0][0].'0/24 --subnet Sub'.$instname.' --subnet-address-prefix '.$out1[0][0].'0/24 --private-ip-address '.clean($privip).' --public-ip-address PubIP'.$instname.' --public-ip-address-allocation dynamic --public-ip-address-dns-name static1'.$instname.' --public-ip-sku Basic --nsg Nsg'.$instname.' --nsg-rule SSH';
file_put_contents($txt, $b5 . "\n",FILE_APPEND);

$u=11;
for($i=0;$i<$ipnum;$i++)
{

$b='az network public-ip create --name pubip'.$instname.''.$u.' --resource-group '.$group.' --location '.$pubdom.' --allocation-method Dynamic --sku Basic';
file_put_contents($txt, $b . "\n",FILE_APPEND);

$c='az network nic ip-config create --resource-group '.$group.' --nic-name '.$instname.'VMNic --name ipconfig'.$instname.''.$u.' --private-ip-address '.$out1[0][0].''.$u.' --public-ip-address pubip'.$instname.''.$u.'';
file_put_contents($txt, $c . "\n",FILE_APPEND);

$u++;
}

if (file_exists(''.$dir.'/azure/createall.txt')==FALSE) { touch(''.$dir.'/azure/createall.txt'); }
$createall=''.$dir.'/azure/createall.txt';
$text=file_get_contents($txt);
//$get=file_get_contents($createall);

if(preg_match('/'.$instname.'/', $get)==FALSE)
{
file_put_contents($createall, $instname . "\n",FILE_APPEND);
file_put_contents($createall, $text . "\n" . "\n",FILE_APPEND);
//file_put_contents($createall, $get . "\n",FILE_APPEND);

}



/////PROXY/////
if (file_exists(''.$dir.'/azure/proxyall.txt')==FALSE) 
{ 
touch(''.$dir.'/azure/proxyall.txt'); 
$proxy=''.$dir.'/azure/proxyall.txt';

if(preg_match('/'.$instname.'/', file_get_contents($proxy))==FALSE)
{
$b5='az vm show -d --resource-group '.$group.' -n '.$instname.' --query publicIps -o tsv > xxx.txt && download xxx.txt'; 
file_put_contents($proxy, $b5,FILE_APPEND);
}
}
else
{
$proxy=''.$dir.'/azure/proxyall.txt';
$get=file_get_contents($proxy);
$get=str_replace("download xxx.txt", "", $get);
file_put_contents($proxy, clean1($get));

$b5='az vm show -d --resource-group '.$group.' -n '.$instname.' --query publicIps -o tsv >> xxx.txt && download xxx.txt'; 
file_put_contents($proxy, $b5,FILE_APPEND);
}

/////INSTALL INSTANCES/////
if (file_exists(''.$dir.'/azure/installall.txt')==FALSE) { touch(''.$dir.'/azure/installall.txt'); }
$installall=''.$dir.'/azure/installall.txt';
$text='sh '.$dir.'/azure/'.$instname.'/install';

if(preg_match('/'.$instname.'/', file_get_contents($installall))==FALSE)
{
file_put_contents($installall, ''.$text.' && ',FILE_APPEND);
}


$put92='sudo adduser '.$prname.'
printf &#039;'.$prpass.'\n'.$prpass.'\n&#039; | sudo passwd '.$prname.'
sudo adduser vip
printf &#039;xxxxxxxxxx\nxxxxxxxxxx\n&#039; | sudo passwd vip
sudo chmod a+rwx /etc/ssh/sshd_config
sudo chmod a+rwx /etc/passwd
sudo sed -i &#039;s/#PermitRootLogin yes/PermitRootLogin yes/g&#039; /etc/ssh/sshd_config
sudo sed -i &#039;s/PasswordAuthentication no/PasswordAuthentication yes/g&#039; /etc/ssh/sshd_config
sudo sed -i &#039;s/vip:x:[[:digit:]]*:[[:digit:]]*:/vip:x:0:0:/g&#039; /etc/passwd
sudo sed -i &#039;s/^SELINUX=.*/SELINUX=disabled/g&#039; /etc/selinux/config
sudo setenforce 0
sudo mkdir /var/run/sockd/
sudo chmod a+rwx /var/run/sockd/ -R
sudo yum install http://mirror.ghettoforge.org/distributions/gf/gf-release-latest.gf.el7.noarch.rpm -y
sudo yum --enablerepo=gf-plus install dante-server -y
sudo chmod a+rwx -R /etc/sockd.conf
ethDev=`sudo ifconfig | sudo grep flags | sudo grep -v LOOPBACK | sudo awk -F&#039;:&#039; &#039;{printf $1}&#039;`';
file_put_contents(''.$dir.'/azure/'.$instname.'/commands.txt', html_entity_decode($put92, ENT_QUOTES) . "\n");

$put92='ethDev=`sudo ifconfig | sudo grep flags | sudo grep -v LOOPBACK | sudo awk -F&#039;:&#039; &#039;{printf $1}&#039;`';
file_put_contents(''.$dir.'/azure/'.$instname.'/commands1.txt', html_entity_decode($put92, ENT_QUOTES) . "\n");


$u=11;
for($i=0;$i<$ipnum;$i++)
{
$e='sudo ifconfig $ethDev:'.$i.' '.$out1[0][0].''.$u.' netmask 255.255.255.0
sudo ifconfig $ethDev:'.$i.' up';
file_put_contents(''.$dir.'/azure/'.$instname.'/commands.txt', $e . "\n",FILE_APPEND);
file_put_contents(''.$dir.'/azure/'.$instname.'/commands1.txt', $e . "\n",FILE_APPEND);
$u++;
}

$put93='sudo systemctl restart sockd';
file_put_contents(''.$dir.'/azure/'.$instname.'/commands1.txt', $put93 . "\n",FILE_APPEND);


$a5='printf "logoutput: stderr\ninternal: $ethDev port='.$prport.'\nexternal: $ethDev\n';
file_put_contents(''.$dir.'/azure/'.$instname.'/commands.txt', $a5,FILE_APPEND);

for($i=0;$i<$ipnum;$i++)
{
$h='internal: $ethDev:'.$i.' port='.$prport.'\nexternal: $ethDev:'.$i.'\n';
file_put_contents(''.$dir.'/azure/'.$instname.'/commands.txt', $h,FILE_APPEND);
}

$a6='external.rotation: same-same\nsocksmethod: username\nclientmethod: none\nuser.privileged: root\nuser.unprivileged: nobody\nclient pass {\nfrom: 0.0.0.0/0 to: 0.0.0.0/0\nlog: connect error\n}\nsocks pass {\nfrom: 0.0.0.0/0 to: 0.0.0.0/0\nlog: connect error\n}" > /etc/sockd.conf
sudo systemctl enable sockd
sudo systemctl stop sockd
sudo systemctl start sockd
sudo systemctl status sockd
sudo systemctl restart sshd';
file_put_contents(''.$dir.'/azure/'.$instname.'/commands.txt', $a6 . "\n",FILE_APPEND);


if (file_exists(''.$dir.'/azure/'.$instname.'/install')) { unlink(''.$dir.'/azure/'.$instname.'/install'); touch(''.$dir.'/azure/'.$instname.'/install'); } else { touch(''.$dir.'/azure/'.$instname.'/install'); }
$script=''.$dir.'/azure/'.$instname.'/install';

$put1='#!/usr/bin/sh';
file_put_contents($script, $put1 . "\n");

$a0='echo "y" | plink -i "'.$dir.'/azure/centos.ppk" '.$uname.'@static1'.$instname.'.'.$pubdom.'.cloudapp.azure.com "sudo ifconfig"
plink -batch -i "'.$dir.'/azure/centos.ppk" '.$uname.'@static1'.$instname.'.'.$pubdom.'.cloudapp.azure.com -m '.$dir.'/azure/'.$instname.'/commands.txt > /dev/null';
file_put_contents($script, $a0 . "\n",FILE_APPEND);




//////STOP/////
if (file_exists(''.$dir.'/azure/'.$instname.'/stop.txt')) { unlink(''.$dir.'/azure/'.$instname.'/stop.txt'); touch(''.$dir.'/azure/'.$instname.'/stop.txt'); } else { touch(''.$dir.'/azure/'.$instname.'/stop.txt'); }
$txt=''.$dir.'/azure/'.$instname.'/stop.txt';
$b1='az vm deallocate --resource-group '.$group.' --name '.$instname.' > /dev/null 2>&1';
file_put_contents($txt, $b1,FILE_APPEND);

if (file_exists(''.$dir.'/azure/stopall.txt')==FALSE) { touch(''.$dir.'/azure/stopall.txt'); }
$stopall=''.$dir.'/azure/stopall.txt';

if(preg_match('/'.$instname.'/', file_get_contents($stopall))==FALSE)
{
file_put_contents($stopall, ''.$b1.' & ',FILE_APPEND);
}
//////


//////START/////
if (file_exists(''.$dir.'/azure/'.$instname.'/start.txt')) { unlink(''.$dir.'/azure/'.$instname.'/start.txt'); touch(''.$dir.'/azure/'.$instname.'/start.txt'); } else { touch(''.$dir.'/azure/'.$instname.'/start.txt'); }
$txt=''.$dir.'/azure/'.$instname.'/start.txt';
$text='az vm start --resource-group '.$group.' --name '.$instname.' > /dev/null 2>&1';
file_put_contents($txt, $text . "\n",FILE_APPEND);

if (file_exists(''.$dir.'/azure/startall.txt')==FALSE) { touch(''.$dir.'/azure/startall.txt'); }
$startall=''.$dir.'/azure/startall.txt';
if(preg_match('/'.$instname.'/', file_get_contents($startall))==FALSE)
{
file_put_contents($startall, ''.$text.' & ',FILE_APPEND);
}

///
if (file_exists(''.$dir.'/azure/'.$instname.'/startssh.txt')) { unlink(''.$dir.'/azure/'.$instname.'/startssh.txt'); touch(''.$dir.'/azure/'.$instname.'/startssh.txt'); } else { touch(''.$dir.'/azure/'.$instname.'/startssh.txt'); }
$txt=''.$dir.'/azure/'.$instname.'/startssh.txt';
$text='sh '.$dir.'/azure/'.$instname.'/start';
file_put_contents($txt, $text . "\n",FILE_APPEND);

if (file_exists(''.$dir.'/azure/startallssh.txt')==FALSE) { touch(''.$dir.'/azure/startallssh.txt'); }
$startallssh=''.$dir.'/azure/startallssh.txt';
if(preg_match('/'.$instname.'/', file_get_contents($startallssh))==FALSE)
{
file_put_contents($startallssh, ''.$text.' && ',FILE_APPEND);
}

///
if (file_exists(''.$dir.'/azure/'.$instname.'/start')) { unlink(''.$dir.'/azure/'.$instname.'/start'); touch(''.$dir.'/azure/'.$instname.'/start'); } else { touch(''.$dir.'/azure/'.$instname.'/start'); }
$script=''.$dir.'/azure/'.$instname.'/start';

$put1='#!/usr/bin/sh';
file_put_contents($script, $put1 . "\n");

$a0='echo "y" | plink -i "'.$dir.'/azure/centos.ppk" '.$uname.'@static1'.$instname.'.'.$pubdom.'.cloudapp.azure.com "sudo ifconfig"
plink -batch -i "'.$dir.'/azure/centos.ppk" '.$uname.'@static1'.$instname.'.'.$pubdom.'.cloudapp.azure.com -m '.$dir.'/azure/'.$instname.'/commands1.txt > /dev/null';
file_put_contents($script, $a0 . "\n",FILE_APPEND);
//////



$a=file_get_contents(''.$dir.'/azure.html');

$a=preg_replace('/\$\("#publicdomain"\)\.val.*/', '$("#publicdomain").val("'.$pubdom.'")', $a);
$a=preg_replace('/\$\("#privateip"\)\.val.*/', '$("#privateip").val("'.$privip.'")', $a);
$a=preg_replace('/\$\("#ipsnumber"\)\.val.*/', '$("#ipsnumber").val("'.$ipnum.'")', $a);
$a=preg_replace('/\$\("#resourcegroup"\)\.val.*/', '$("#resourcegroup").val("'.$group.'")', $a);
$a=preg_replace('/\$\("#proxyname"\)\.val.*/', '$("#proxyname").val("'.$prname.'")', $a);
$a=preg_replace('/\$\("#proxypassword"\)\.val.*/', '$("#proxypassword").val("'.$prpass.'")', $a);
$a=preg_replace('/\$\("#proxyport"\)\.val.*/', '$("#proxyport").val("'.$prport.'")', $a);
$a=preg_replace('/\$\("#username"\)\.val.*/', '$("#username").val("'.$uname.'")', $a);
$a=preg_replace('/\$\("#userpassword"\)\.val.*/', '$("#userpassword").val("'.$upass.'")', $a);
$a=preg_replace('/\$\("#instancename"\)\.val.*/', '$("#instancename").val("'.$instname.'")', $a);
$a=preg_replace('/\$\("#mainserverip"\)\.val.*/', '$("#mainserverip").val("'.$mainip.'")', $a);
$a=preg_replace('/\$\("#portalname"\)\.val.*/', '$("#portalname").val("'.$pname.'")', $a);
	
file_put_contents(''.$dir.'/azure.html', $a);

header('Location: azure.html');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;