<?php

function var_dump_ret($mixed = null) {
  ob_start();
  var_dump($mixed);
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
//////////////////////////////////////////////////////////////////////////////

use Aws\Ec2\Ec2Client;

//////
//$serverid=$_POST['serverid'];
//$ipsquan=$_POST['ipsquan'];
//$ips=$_POST['ips'];
//////
$serverid="i-0c54d9bad064ec307";
$ipsquan="11";
$ips="2 3 4 5 6 7 8 9 10 11 12";
//$ips="2 5 8 9";


preg_match_all('/\d{1,2}(\D|$){1}/', $ips, $out1);

for($i=0;$i<$ipsquan;$i++)
{
$i4=$i+2;
$i5=$i+2;
$i6=$i+2;
$i7=$i+2;
$i4=''.$i4.' ';
$i5=''.$i5.';';
$i6=''.$i6.',';

require '/home/vip/vendor/autoload.php';

if (in_array(''.$i7.'', $out1[0]) || in_array(''.$i4.'', $out1[0]) || in_array(''.$i5.'', $out1[0]) || in_array(''.$i6.'', $out1[0]))
{
$prvips=file('/var/www/html/make1/privateips.txt');
//$pubips=file('/var/www/html/make1/publicips.txt');
$allocid=file('/var/www/html/make1/allocationid.txt');
$associd=file('/var/www/html/make1/associationid.txt');

$ec2Client[$i] = new Aws\Ec2\Ec2Client([
    'region' => 'us-east-1',
    'version' => 'latest',
    'profile' => 'default'
]);

$instanceId = $serverid;

///disassociateAddress///

$result0[$i] = $ec2Client[$i]->disassociateAddress(array(
    'AssociationId' => clean($associd[$i]),
));

///releaseAddress///

$result1[$i] = $ec2Client[$i]->releaseAddress(array(
    'AllocationId' => clean($allocid[$i]),
));




/* ///allocateAddress///

$allocation[$i] = $ec2Client[$i]->allocateAddress(array(
    'DryRun' => false,
    'Domain' => 'vpc',
));

$allocid[$i]=$allocation[$i]->get('AllocationId');
$allocid[$i]=clean($allocid[$i]) . "\n";
file_put_contents('/var/www/html/make1/allocationid.txt', $allocid);

///associateAddress///

$result2[$i] = $ec2Client[$i]->associateAddress(array(
    'DryRun' => false,
    'InstanceId' => $instanceId,
	'PrivateIpAddress' => clean($prvips[$i]),
    'AllocationId' => $allocation[$i]->get('AllocationId'),
));

$associd[$i]=$result2[$i]->get('AssociationId');
$associd[$i]=clean($associd[$i]) . "\n";
file_put_contents('/var/www/html/make1/associationid.txt', $associd); */
















/* $pubips[$i]=$allocation[$i]->get('PublicIpAddress');
$pubips[$i]=clean($pubips[$i]) . "\n";
file_put_contents('/var/www/html/make1/publicips.txt', $pubips); */

//file_put_contents('/home/vip/make/var0.txt', var_dump_ret($result0[$i]));
//file_put_contents('/home/vip/make/var1.txt', var_dump_ret($result1[$i]));
//file_put_contents('/home/vip/make/var2.txt', var_dump_ret($result2[$i]));
}
}


/* if (file_exists('/var/www/html/make1/index.html')) { unlink('/var/www/html/make1/index.html'); touch('/var/www/html/make1/index.html'); } else { touch('/var/www/html/make1/index.html'); }
$index='/var/www/html/make1/index.html';

$put='<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="ru">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<script>
$(function (){
	$("#input-serverid").val("'.$serverid.'");
	$("#input-ipsquan").val("'.$ipsquan.'");
	$("#input-ips").val("'.$ips.'");
});
</script>
<form action="aws.php" id="formContact" method="post">
<div><input style="width:200px;" id="input-serverid" name="serverid" placeholder="Server ID" type="text" required pattern="i-[\d\w]{17}">Server ID</div><br>
<div><input style="width:200px;" id="input-ipsquan" name="ipsquan" placeholder="IPs quantity" type="text" required pattern="\d{1,2}">IPs quantity</div><br>
<div><input style="width:400px;" id="input-ips" name="ips" placeholder="IPs" type="text" required pattern="(\d{1,2}(,|;| )){0,}((\d{1,2})(| ){0,}){1}">Ips Number</div><br>
<div><input type="Submit" value="Send"></div><br>
</form>
</body>
</html>';
file_put_contents($index, $put);

header('Location: http://ec2-34-196-254-25.compute-1.amazonaws.com/make1/index.html'); */

exit();

