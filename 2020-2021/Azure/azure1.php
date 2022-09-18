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

function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $filez = readdir($dir)) ) {
        if (( $filez != '.' ) && ( $filez != '..' )) {
            $full = $src . '/' . $filez;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src); }
///
////////////////////////////////////////////////
$pubdom=clean($_POST['pubdom1']);
$privip=clean($_POST['privip1']);
$ipnum=clean($_POST['innum1']);
$group=clean($_POST['group1']);
$uname=clean($_POST['uname1']);
$upass=clean($_POST['upass1']);
$instname=clean($_POST['instname1']);
$mainip=clean($_POST['mainip1']);
$pname=clean($_POST['pname1']);


preg_match_all('/(\d{1,3}\.){3}/', $privip, $out1);
$out1[0][0]=clean($out1[0][0]);
////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
$dir=dirname(__FILE__);
if (file_exists(''.$dir.'/azure1/')==FALSE) { mkdir(''.$dir.'/azure1/'); }
$u=10;

for($i=0;$i<$ipnum;$i++)
{

/////SSH KEYS/////
if(file_exists(''.$dir.'/azure1/centos.ppk')==FALSE)
{
system('ssh-keygen -m PEM -t rsa -b 4096 -N "" -f '.$dir.'/azure1/centos.pem');
rename(''.$dir.'/azure1/centos.pem.pub', ''.$dir.'/azure1/centos.pub');
system('puttygen '.$dir.'/azure1/centos.pem -o '.$dir.'/azure1/centos.ppk -O private');
}
///

if (file_exists(''.$dir.'/azure1/'.$instname.''.$i.'/')==FALSE) 
{ 
mkdir(''.$dir.'/azure1/'.$instname.''.$i.'/'); 
} 
else
{
rrmdir(''.$dir.'/azure1/'.$instname.''.$i.'/');
mkdir(''.$dir.'/azure1/'.$instname.''.$i.'/');
} 




/////CREATE INSTANCES/////
if (file_exists(''.$dir.'/azure1/'.$instname.''.$i.'/create.txt')) { unlink(''.$dir.'/azure1/'.$instname.''.$i.'/create.txt'); touch(''.$dir.'/azure1/'.$instname.''.$i.'/create.txt'); } else { touch(''.$dir.'/azure1/'.$instname.''.$i.'/create.txt'); }
$txt=''.$dir.'/azure1/'.$instname.''.$i.'/create.txt';

/* if(file_exists(''.$dir.'/azure1/createall.txt')==FALSE)
{
$b0='az group create --location westeurope --name '.$group.'';
file_put_contents($txt, $b0 . "\n",FILE_APPEND);
} */

$b1='az network vnet create -g '.$group.' -n VNet'.$instname.''.$i.' --location '.$pubdom.' --address-prefix '.$out1[0][0].'0/24 --subnet-name Sub'.$instname.''.$i.' --subnet-prefix '.$out1[0][0].'0/24';
file_put_contents($txt, $b1 . "\n",FILE_APPEND);

$b2='az network nsg create -g '.$group.' -n Nsg'.$instname.''.$i.' --location '.$pubdom.'';
file_put_contents($txt, $b2 . "\n",FILE_APPEND);

$b3='az network nsg rule create -g '.$group.' --nsg-name Nsg'.$instname.''.$i.' -n '.$instname.''.$i.'Rule --priority 100 --source-address-prefixes '.$mainip.'/32 --source-port-ranges &#039;*&#039; --destination-address-prefixes &#039;*&#039; --destination-port-ranges 22 --access Allow --protocol &#039;*&#039;';
file_put_contents($txt, html_entity_decode($b3, ENT_QUOTES) . "\n",FILE_APPEND);

$b5='az vm create --name '.$instname.''.$i.' --resource-group '.$group.' --image Centos --ssh-key-values /home/'.$pname.'/centos.pub --location '.$pubdom.' --size Standard_DS11-1_v2 --authentication-type ssh --admin-username '.$uname.' --data-disk-sizes-gb 16 --vnet-name VNet'.$instname.''.$i.' --vnet-address-prefix '.$out1[0][0].'0/24 --subnet Sub'.$instname.''.$i.' --subnet-address-prefix '.$out1[0][0].'0/24 --private-ip-address '.$out1[0][0].''.$u.' --public-ip-address PubIP'.$instname.''.$i.' --public-ip-address-allocation dynamic --public-ip-address-dns-name static1'.$instname.''.$i.' --public-ip-sku Basic --nsg Nsg'.$instname.''.$i.' --nsg-rule SSH';
file_put_contents($txt, $b5 . "\n",FILE_APPEND);


if (file_exists(''.$dir.'/azure1/createall.txt')==FALSE) { touch(''.$dir.'/azure1/createall.txt'); }
$createall=''.$dir.'/azure1/createall.txt';
$text=file_get_contents($txt);

if(preg_match('/'.$instname.''.$i.'/', $get)==FALSE)
{
file_put_contents($createall, ''.$instname.''.$i.'' . "\n",FILE_APPEND);
file_put_contents($createall, $text . "\n" . "\n",FILE_APPEND);
}



/////PROXY/////
if (file_exists(''.$dir.'/azure1/publicipsall.txt')==FALSE) 
{ 
touch(''.$dir.'/azure1/publicipsall.txt'); 
$proxy=''.$dir.'/azure1/publicipsall.txt';

if(preg_match('/'.$instname.'/', file_get_contents($proxy))==FALSE)
{
$b5='az vm show -d --resource-group '.$group.' -n '.$instname.''.$i.' --query publicIps -o tsv > xxx.txt && download xxx.txt'; 
file_put_contents($proxy, $b5,FILE_APPEND);
}
}
else
{
$proxy=''.$dir.'/azure1/publicipsall.txt';
$get=file_get_contents($proxy);
$get=str_replace("download xxx.txt", "", $get);
file_put_contents($proxy, clean1($get));

$b5='az vm show -d --resource-group '.$group.' -n '.$instname.''.$i.' --query publicIps -o tsv >> xxx.txt && download xxx.txt'; 
file_put_contents($proxy, $b5,FILE_APPEND);
}

/////INSTALL INSTANCES/////
if (file_exists(''.$dir.'/azure1/installall.txt')==FALSE) { touch(''.$dir.'/azure1/installall.txt'); }
$installall=''.$dir.'/azure1/installall.txt';
$text='sh '.$dir.'/azure1/'.$instname.''.$i.'/install';

if(preg_match('/'.$instname.''.$i.'/', file_get_contents($installall))==FALSE)
{
file_put_contents($installall, ''.$text.' && ',FILE_APPEND);
}


$put92='sudo adduser vip
printf &#039;xxxxxxxxxx\nxxxxxxxxxx\n&#039; | sudo passwd vip
sudo chmod a+rwx /etc/ssh/sshd_config
sudo chmod a+rwx /etc/passwd
sudo sed -i &#039;s/#PermitRootLogin yes/PermitRootLogin yes/g&#039; /etc/ssh/sshd_config
sudo sed -i &#039;s/PasswordAuthentication no/PasswordAuthentication yes/g&#039; /etc/ssh/sshd_config
sudo sed -i &#039;s/vip:x:[[:digit:]]*:[[:digit:]]*:/vip:x:0:0:/g&#039; /etc/passwd
sudo sed -i &#039;s/^SELINUX=.*/SELINUX=disabled/g&#039; /etc/selinux/config
sudo setenforce 0
sudo yum -y install httpd mod_ssl mod_fcgid
sudo systemctl start httpd
sudo systemctl enable httpd
sudo systemctl status httpd
sudo chmod a+rwx /etc/httpd/conf/httpd.conf
sudo chmod a+rwx -R /home/vip/
sudo chmod a+rwx -R /var/www/html/
sudo yum install httpd-tools -y
sudo yum install bind-utils -y
sudo yum install yum-utils -y
sudo yum install unzip -y
sudo yum install wget -y
sudo yum install putty -y
sudo yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm -y
sudo yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm -y
sudo yum-config-manager --enable remi-php73
sudo yum install php php-common php-mcrypt php-cli php-gd php-curl php-mysql php-ldap php-zip php-fileinfo php-xml -y
sudo sed -i &#039;s/^max_execution_time = 30/max_execution_time = 10000000/g&#039; /etc/php.ini
sudo sed -i &#039;s/^max_input_time = 60/max_input_time = 10000000/g&#039; /etc/php.ini
sudo sed -i &#039;s/^;max_input_vars = 1000/max_input_vars = 10000000/g&#039; /etc/php.ini
sudo sed -i &#039;s/^memory_limit = 128M/memory_limit = 13000M/g&#039; /etc/php.ini
sudo sed -i &#039;s/^post_max_size = 8M/post_max_size = 2000M/g&#039; /etc/php.ini
sudo sed -i &#039;s/^upload_max_filesize = 2M/upload_max_filesize = 2000M/g&#039; /etc/php.ini
sudo sed -i &#039;s/^max_file_uploads = 20/max_file_uploads = 2000000/g&#039; /etc/php.ini
sudo systemctl restart sshd
sudo systemctl restart httpd';
file_put_contents(''.$dir.'/azure1/'.$instname.''.$i.'/commands.txt', html_entity_decode($put92, ENT_QUOTES) . "\n");


if (file_exists(''.$dir.'/azure1/'.$instname.''.$i.'/install')) { unlink(''.$dir.'/azure1/'.$instname.''.$i.'/install'); touch(''.$dir.'/azure1/'.$instname.''.$i.'/install'); } else { touch(''.$dir.'/azure1/'.$instname.''.$i.'/install'); }
$script=''.$dir.'/azure1/'.$instname.''.$i.'/install';

$put1='#!/usr/bin/sh';
file_put_contents($script, $put1 . "\n");

$a0='echo "y" | plink -i "'.$dir.'/azure1/centos.ppk" '.$uname.'@static1'.$instname.''.$i.'.'.$pubdom.'.cloudapp.azure.com "sudo ifconfig"
plink -batch -i "'.$dir.'/azure1/centos.ppk" '.$uname.'@static1'.$instname.''.$i.'.'.$pubdom.'.cloudapp.azure.com -m '.$dir.'/azure1/'.$instname.''.$i.'/commands.txt > /dev/null';
file_put_contents($script, $a0 . "\n",FILE_APPEND);




//////STOP/////
if (file_exists(''.$dir.'/azure1/'.$instname.''.$i.'/stop.txt')) { unlink(''.$dir.'/azure1/'.$instname.''.$i.'/stop.txt'); touch(''.$dir.'/azure1/'.$instname.''.$i.'/stop.txt'); } else { touch(''.$dir.'/azure1/'.$instname.''.$i.'/stop.txt'); }
$txt=''.$dir.'/azure1/'.$instname.''.$i.'/stop.txt';
$b1='az vm deallocate --resource-group '.$group.' --name '.$instname.''.$i.' > /dev/null 2>&1';
file_put_contents($txt, $b1,FILE_APPEND);

if (file_exists(''.$dir.'/azure1/stopall.txt')==FALSE) { touch(''.$dir.'/azure1/stopall.txt'); }
$stopall=''.$dir.'/azure1/stopall.txt';

if(preg_match('/'.$instname.''.$i.'/', file_get_contents($stopall))==FALSE)
{
file_put_contents($stopall, ''.$b1.' & ',FILE_APPEND);
}
//////


//////START/////
if (file_exists(''.$dir.'/azure1/'.$instname.''.$i.'/start.txt')) { unlink(''.$dir.'/azure1/'.$instname.''.$i.'/start.txt'); touch(''.$dir.'/azure1/'.$instname.''.$i.'/start.txt'); } else { touch(''.$dir.'/azure1/'.$instname.''.$i.'/start.txt'); }
$txt=''.$dir.'/azure1/'.$instname.''.$i.'/start.txt';
if (file_exists(''.$dir.'/azure1/startall.txt')==FALSE) { touch(''.$dir.'/azure1/startall.txt'); }
$startall=''.$dir.'/azure1/startall.txt';

$b1='az vm start --resource-group '.$group.' --name '.$instname.''.$i.' > /dev/null 2>&1';
file_put_contents($txt, $b1 . "\n",FILE_APPEND);

if(preg_match('/'.$instname.''.$i.'/', file_get_contents($startall))==FALSE)
{
file_put_contents($startall, ''.$b1.' & ',FILE_APPEND);
}

//////

$u++;
}


$a=file_get_contents(''.$dir.'/azure.html');

$a=preg_replace('/\$\("#publicdomain1"\)\.val.*/', '$("#publicdomain1").val("'.$pubdom.'")', $a);
$a=preg_replace('/\$\("#privateip1"\)\.val.*/', '$("#privateip1").val("'.$privip.'")', $a);
$a=preg_replace('/\$\("#insnumber1"\)\.val.*/', '$("#insnumber1").val("'.$innum.'")', $a);
$a=preg_replace('/\$\("#resourcegroup1"\)\.val.*/', '$("#resourcegroup1").val("'.$group.'")', $a);
$a=preg_replace('/\$\("#username1"\)\.val.*/', '$("#username1").val("'.$uname.'")', $a);
$a=preg_replace('/\$\("#userpassword1"\)\.val.*/', '$("#userpassword1").val("'.$upass.'")', $a);
$a=preg_replace('/\$\("#instancename1"\)\.val.*/', '$("#instancename1").val("'.$instname.'")', $a);
$a=preg_replace('/\$\("#mainserverip1"\)\.val.*/', '$("#mainserverip1").val("'.$mainip.'")', $a);
$a=preg_replace('/\$\("#portalname1"\)\.val.*/', '$("#portalname1").val("'.$pname.'")', $a);
	
file_put_contents(''.$dir.'/azure.html', $a);

header('Location: azure.html');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;