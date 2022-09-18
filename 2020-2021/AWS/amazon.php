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
$region=clean($_POST['region']);
$type=clean($_POST['type']);
$quantity=clean($_POST['quantity']);
$name=clean($_POST['name']);
$password=clean($_POST['password']);
$memlim=clean($_POST['memlim']);

$dir=dirname(__FILE__);

$publicip=clean(file_get_contents(''.$dir.'/sec/publicip.txt'));

/////////////////////////////////////
if (file_exists(''.$dir.'/'.$region.'/')==FALSE) { mkdir(''.$dir.'/'.$region.'/'); }
if (file_exists(''.$dir.'/'.$region.'/script')) { unlink(''.$dir.'/'.$region.'/script'); touch(''.$dir.'/'.$region.'/script'); } else { touch(''.$dir.'/'.$region.'/script'); }
$script=''.$dir.'/'.$region.'/script';
if (file_exists(''.$dir.'/'.$region.'/start')) { unlink(''.$dir.'/'.$region.'/start'); touch(''.$dir.'/'.$region.'/start'); } else { touch(''.$dir.'/'.$region.'/start'); }
$script2=''.$dir.'/'.$region.'/start';
if (file_exists(''.$dir.'/'.$region.'/stop')) { unlink(''.$dir.'/'.$region.'/stop'); touch(''.$dir.'/'.$region.'/stop'); } else { touch(''.$dir.'/'.$region.'/stop'); }
$script3=''.$dir.'/'.$region.'/stop';
if (file_exists(''.$dir.'/'.$region.'/termins')) { unlink(''.$dir.'/'.$region.'/termins'); touch(''.$dir.'/'.$region.'/termins'); } else { touch(''.$dir.'/'.$region.'/termins'); }
$script4=''.$dir.'/'.$region.'/termins';
if (file_exists(''.$dir.'/'.$region.'/publicips')) { unlink(''.$dir.'/'.$region.'/publicips'); touch(''.$dir.'/'.$region.'/publicips'); } else { touch(''.$dir.'/'.$region.'/publicips'); }
$script5=''.$dir.'/'.$region.'/publicips';
if (file_exists(''.$dir.'/'.$region.'/sockdgetlog')) { unlink(''.$dir.'/'.$region.'/sockdgetlog'); touch(''.$dir.'/'.$region.'/sockdgetlog'); } else { touch(''.$dir.'/'.$region.'/sockdgetlog'); }
$script6=''.$dir.'/'.$region.'/sockdgetlog';
if (file_exists(''.$dir.'/'.$region.'/sockdmakelog')) { unlink(''.$dir.'/'.$region.'/sockdmakelog'); touch(''.$dir.'/'.$region.'/sockdmakelog'); } else { touch(''.$dir.'/'.$region.'/sockdmakelog'); }
$script7=''.$dir.'/'.$region.'/sockdmakelog';
if (file_exists(''.$dir.'/'.$region.'/sockdunmakelog')) { unlink(''.$dir.'/'.$region.'/sockdunmakelog'); touch(''.$dir.'/'.$region.'/sockdunmakelog'); } else { touch(''.$dir.'/'.$region.'/sockdunmakelog'); }
$script8=''.$dir.'/'.$region.'/sockdunmakelog';


$put1='#!/usr/bin/sh';
file_put_contents($script, $put1 . "\n");
file_put_contents($script2, $put1 . "\n");
file_put_contents($script3, $put1 . "\n");
file_put_contents($script4, $put1 . "\n");
file_put_contents($script5, $put1 . "\n");
file_put_contents($script6, $put1 . "\n");
file_put_contents($script7, $put1 . "\n");
file_put_contents($script8, $put1 . "\n");


if(file_exists(''.$dir.'/sec/amazon.pem')==FALSE)
{
$put7='aws ec2 --region '.$region.' create-key-pair --key-name amazon > '.$dir.'/sec/amazon.pem;';
file_put_contents($script, $put7 . "\n",FILE_APPEND);

$put8='php '.$dir.'/key.php;
puttygen '.$dir.'/sec/amazon.pem -o '.$dir.'/sec/amazon.ppk -O private;
puttygen '.$dir.'/sec/amazon.pem -o '.$dir.'/sec/amazon.pub -O public;';
file_put_contents($script, $put8 . "\n",FILE_APPEND);

$put58='aws ec2 --region '.$region.' delete-key-pair --key-name amazon;';
file_put_contents($script, $put58 . "\n",FILE_APPEND);
}
	
///////CREATE INSTANCES
$put9='KeyName=`aws ec2 --region '.$region.' describe-key-pairs --query &#039;KeyPairs[].KeyName&#039; --output text`
		if [[ "${KeyName}" == *"amazon"* ]] ;then
		:
		else
			aws ec2 import-key-pair --key-name amazon --public-key-material file://'.$dir.'/sec/amazon.pub --region '.$region.'
		fi;';
file_put_contents($script, html_entity_decode($put9, ENT_QUOTES) . "\n",FILE_APPEND);

$put10='for GroupId in `aws ec2 --region '.$region.' describe-security-groups --query &#039;SecurityGroups[].GroupId&#039; --output text`
			do
				aws ec2 --region '.$region.' authorize-security-group-ingress --group-id $GroupId --protocol tcp --port 22 --cidr '.$publicip.'/32
				aws ec2 --region '.$region.' authorize-security-group-ingress --group-id $GroupId --protocol tcp --port 33333 --cidr 0.0.0.0/0
			done;';
file_put_contents($script, html_entity_decode($put10, ENT_QUOTES) . "\n",FILE_APPEND);

if ($region=="af-south-1") {
$ami="ami-0a2be7731769e6cc1";
}
if ($region=="me-south-1") {
$ami="ami-011c71a894b10f35b";
}
if ($region=="eu-north-1") {
$ami="ami-05788af9005ef9a93";
}
if ($region=="ap-south-1") {
$ami="ami-026f33d38b6410e30";
}
if ($region=="ap-east-1") {
$ami="ami-0e5c29e6c87a9644f";
}
if ($region=="eu-west-3") {
$ami="ami-0cb72d2e599cffbf9";
}
if ($region=="eu-west-2") {
$ami="ami-09e5afc68eed60ef4";
}
if ($region=="eu-west-1") {
$ami="ami-0b850cf02cc00fdc8";
}
if ($region=="eu-south-1") {
$ami="ami-03014b98e9665115a";
}
if ($region=="ap-northeast-2") {
$ami="ami-06e83aceba2cb0907";
}
if ($region=="ap-northeast-1") {
$ami="ami-06a46da680048c8ae";
}
if ($region=="sa-east-1") {
$ami="ami-0b30f38d939dd4b54";
}
if ($region=="ca-central-1") {
$ami="ami-04a25c39dc7a8aebb";
}
if ($region=="ap-southeast-1") {
$ami="ami-07f65177cb990d65b";
}
if ($region=="ap-southeast-2") {
$ami="ami-0b2045146eb00b617";
}
if ($region=="eu-central-1") {
$ami="ami-0e8286b71b81c3cc1";
}
if ($region=="us-east-1") {
$ami="ami-0affd4508a5d2481b";
}
if ($region=="us-east-2") {
$ami="ami-01e36b7901e884a10";
}
if ($region=="us-west-1") {
$ami="ami-098f55b4287a885ba";
}
if ($region=="us-west-2") {
$ami="ami-0bc06212a56393ee1";
}	

$put99='aws ec2 --region '.$region.' describe-security-groups --query &#039;SecurityGroups[].GroupId&#039; --output text';
file_put_contents($script, html_entity_decode($put99, ENT_QUOTES) . "\n",FILE_APPEND);

for($vi=0;$vi<$quantity;$vi++)
{
$put120='aws ec2 --region '.$region.' run-instances --image-id '.$ami.' --count 1 --instance-type '.$type.' --key-name amazon --security-group-ids $GroupId --tag-specifications &#039;ResourceType=instance,Tags=[{Key=Name,Value='.$name.''.$vi.'}]&#039; > /dev/null';
file_put_contents($script, html_entity_decode($put120, ENT_QUOTES) . "\n",FILE_APPEND);
}



$put96='echo "--------------Waiting for 150 sec for all instances to initialize---------------";
sleep 150;';
file_put_contents($script, $put96 . "\n",FILE_APPEND);


////////////
$put91='for PublicIpAddress in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].PublicIpAddress&#039; --output text` 
	do
		echo "y" | plink -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress "sudo ifconfig";
		plink -batch -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress -m '.$dir.'/'.$region.'/commands.txt > /dev/null
done';
file_put_contents($script, html_entity_decode($put91, ENT_QUOTES) . "\n",FILE_APPEND);


$put92='sudo adduser proxy
printf &#039;xxxxxxxxxx\nxxxxxxxxxx\n&#039; | sudo passwd proxy
sudo adduser vip; printf &#039;xxxxxxxxxx\nxxxxxxxxxx\n&#039; | sudo passwd vip
sudo chmod a+rwx /etc/ssh/sshd_config
sudo chmod a+rwx /etc/passwd
sudo sed -i &#039;s/#PermitRootLogin yes/PermitRootLogin yes/g&#039; /etc/ssh/sshd_config
sudo sed -i &#039;s/PasswordAuthentication no/PasswordAuthentication yes/g&#039; /etc/ssh/sshd_config
sudo sed -i &#039;s/vip:x:[[:digit:]]*:[[:digit:]]*:/vip:x:0:0:/g&#039; /etc/passwd
sudo sed -i &#039;s/^SELINUX=.*/SELINUX=disabled/g&#039; /etc/selinux/config
sudo setenforce 0
sudo yum install httpd mod_ssl mod_fcgid -y
sudo systemctl start httpd
sudo systemctl enable httpd
sudo systemctl status httpd
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
sudo chmod a+rwx /etc/httpd/conf/httpd.conf
sudo chmod a+rwx -R /home/vip/
sudo chmod a+rwx -R /var/www/html/
sudo sed -i &#039;s/^max_execution_time = 30/max_execution_time = 10000000/g&#039; /etc/php.ini
sudo sed -i &#039;s/^max_input_time = 60/max_input_time = 10000000/g&#039; /etc/php.ini
sudo sed -i &#039;s/^;max_input_vars = 1000/max_input_vars = 10000000/g&#039; /etc/php.ini
sudo sed -i &#039;s/^memory_limit = 128M/memory_limit = '.$memlim.'M/g&#039; /etc/php.ini
sudo mkdir /var/run/sockd/
sudo chmod a+rwx /var/run/sockd/ -R
sudo yum install http://mirror.ghettoforge.org/distributions/gf/gf-release-latest.gf.el7.noarch.rpm -y
sudo yum --enablerepo=gf-plus install dante-server -y
sudo chmod a+rwx -R /etc/sockd.conf
ethDev=`sudo ifconfig | sudo grep flags | sudo grep -v LOOPBACK | sudo awk -F&#039;:&#039; &#039;{printf $1}&#039;`
printf "logoutput: stderr\ninternal: $ethDev port=33333\nexternal: $ethDev\nsocksmethod: username\nclientmethod: none\nuser.privileged: root\nuser.unprivileged: nobody\nclient pass {\nfrom: 0.0.0.0/0 to: 0.0.0.0/0\nlog: connect error\n}\nsocks pass {\nfrom: 0.0.0.0/0 to: 0.0.0.0/0\nlog: connect error\n}" > /etc/sockd.conf
sudo systemctl enable sockd
sudo systemctl stop sockd
sudo systemctl start sockd
sudo systemctl status sockd
sudo systemctl restart httpd
sudo systemctl restart sshd';
file_put_contents(''.$dir.'/'.$region.'/commands.txt', html_entity_decode($put92, ENT_QUOTES));



$put34='echo "-------------------------------------ALL DONE!--------------------------------------"';
file_put_contents($script, $put34 . "\n",FILE_APPEND);


$file=''.$dir.'/createall.txt';
$put='sh '.$dir.'/'.$region.'/script';

if(file_exists($file)==FALSE) 
{ 
	file_put_contents($file, $put);
}
else
{
	file_put_contents($file, $put . "\n",FILE_APPEND);
}




/////TERMINATE INSTANCES
$put60='for InstanceId in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].InstanceId&#039; --output text`
	do
		aws ec2 --region '.$region.' terminate-instances --instance-ids $InstanceId
done
echo "------------------Instances terminated------------------";';
file_put_contents($script4, html_entity_decode($put60, ENT_QUOTES) . "\n",FILE_APPEND);


$file=''.$dir.'/terminateall.txt';
$put='sh '.$dir.'/'.$region.'/termins';

if(file_exists($file)==FALSE) 
{ 
	file_put_contents($file, $put);
}
else
{
	file_put_contents($file, $put . "\n",FILE_APPEND);
}


/////START INSTANCES
$put60='for InstanceId in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].InstanceId&#039; --output text`
	do
		aws ec2 --region '.$region.' start-instances --instance-ids $InstanceId			
done
echo "------------------Instances started------------------";
echo "------------------Wait for 2 min to get IPs------------------";';
file_put_contents($script2, html_entity_decode($put60, ENT_QUOTES) . "\n",FILE_APPEND);


$file=''.$dir.'/startall.txt';
$put='sh '.$dir.'/'.$region.'/start';

if(file_exists($file)==FALSE) 
{ 
	file_put_contents($file, $put);
}
else
{
	file_put_contents($file, $put . "\n",FILE_APPEND);
}


/////STOP INSTANCES
$put58='for InstanceId in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].InstanceId&#039; --output text`
	do
		aws ec2 --region '.$region.' stop-instances --instance-ids $InstanceId
done
unlink '.$dir.'/'.$region.'/getproxyall1.txt;
unlink '.$dir.'/'.$region.'/getproxyall2.txt;
touch '.$dir.'/'.$region.'/getproxyall1.txt;
touch '.$dir.'/'.$region.'/getproxyall2.txt;
echo "------------------Instances stopped------------------";';
file_put_contents($script3, html_entity_decode($put58, ENT_QUOTES) . "\n",FILE_APPEND);


$file=''.$dir.'/stopall.txt';
$put='sh '.$dir.'/'.$region.'/stop';

if(file_exists($file)==FALSE) 
{ 
	file_put_contents($file, $put);
}
else
{
	file_put_contents($file, $put . "\n",FILE_APPEND);
}


/////PROXY INSTANCES
$put61='unlink '.$dir.'/'.$region.'/proxy1.txt;
unlink '.$dir.'/'.$region.'/proxy2.txt;
for PublicIpAddress in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].PublicIpAddress&#039; --output text`
	do
		echo "$PublicIpAddress:33333:proxy:xxxxxxxxxx" > /dev/null >> '.$dir.'/'.$region.'/proxy1.txt
		echo "proxy:xxxxxxxxxx@$PublicIpAddress:33333" > /dev/null >> '.$dir.'/'.$region.'/proxy2.txt
		echo "$PublicIpAddress:33333:proxy:xxxxxxxxxx" > /dev/null >> '.$dir.'/getproxyall1.txt
		echo "proxy:xxxxxxxxxx@$PublicIpAddress:33333" > /dev/null >> '.$dir.'/getproxyall2.txt
done
echo "------------------PROXY Ips ready------------------";';
file_put_contents($script5, html_entity_decode($put61, ENT_QUOTES) . "\n",FILE_APPEND);


$file=''.$dir.'/getproxyall.txt';
$put='sh '.$dir.'/'.$region.'/publicips';

if(file_exists($file)==FALSE) 
{ 
	file_put_contents($file, $put);
}
else
{
	file_put_contents($file, $put . "\n",FILE_APPEND);
}


/////SOCKDGETLOG INSTANCES
$put58='for PublicIpAddress in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].PublicIpAddress&#039; --output text`
	do
		echo "y" | plink -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress "sudo ifconfig";
		echo "y" | plink -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress "sudo chmod a+rwx -R /var/log/sockd.log";
		(echo get /var/log/sockd.log '.$dir.'/'.$region.'/logs/$PublicIpAddress.txt) | psftp -batch -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress
done;
echo "------------------SOCKDGETLOG Completed------------------";';
file_put_contents($script6, html_entity_decode($put58, ENT_QUOTES) . "\n",FILE_APPEND);


/////SOCKDMAKELOG INSTANCES
$put58='for PublicIpAddress in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].PublicIpAddress&#039; --output text`
	do
		echo "y" | plink -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress "sudo ifconfig"
		plink -batch -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress "sudo sed -i &#039;s/stderr/\/var\/log\/sockd\.log/g&#039; /etc/sockd.conf && sudo systemctl restart sockd";
done;
echo "------------------SOCKDMAKELOG Completed------------------";';
file_put_contents($script7, html_entity_decode($put58, ENT_QUOTES) . "\n",FILE_APPEND);
	

/////SOCKDUNMAKELOG INSTANCES
$put58='for PublicIpAddress in `aws ec2 --region '.$region.' describe-instances --query &#039;Reservations[].Instances[].PublicIpAddress&#039; --output text`
	do
		echo "y" | plink -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress "sudo ifconfig"
		plink -batch -i "'.$dir.'/sec/amazon.ppk" centos@$PublicIpAddress "sudo sed -i &#039;s/\/var\/log\/sockd\.log/stderr/g&#039; /etc/sockd.conf && sudo systemctl restart sockd && sudo chmod a+rwx -R /var/log/sockd.log && sudo rm /var/log/sockd.log";
done;
echo "------------------SOCKDUNMAKELOG Completed------------------";';
file_put_contents($script8, html_entity_decode($put58, ENT_QUOTES) . "\n",FILE_APPEND);

////////////
///////////
///////////


$a=file_get_contents(''.$dir.'/amazon.html');

$a=preg_replace('/\$\("#instancetype"\)\.val.*/', '$("#instancetype").val("'.$type.'")', $a);
$a=preg_replace('/\$\("#instancequantity"\)\.val.*/', '$("#instancequantity").val("'.$quantity.'")', $a);
$a=preg_replace('/\$\("#instancename"\)\.val.*/', '$("#instancename").val("'.$name.'")', $a);
$a=preg_replace('/\$\("#rootpassword"\)\.val.*/', '$("#rootpassword").val("'.$password.'")', $a);
$a=preg_replace('/\$\("#memorylimit"\)\.val.*/', '$("#memorylimit").val("'.$memlim.'")', $a);
file_put_contents(''.$dir.'/amazon.html', $a);

header('Location: amazon.html');


/////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;
