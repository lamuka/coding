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

use Aws\Ec2\Ec2Client;

$cnt=2;

for($i=0;$i<$cnt;$i++)
{

require '/home/vip/vendor/autoload.php';


$prvips=file('/home/vip/make/privateips.txt');
$pubips=file('/home/vip/make/publicips.txt');
$allocid=file('/home/vip/make/allocationid.txt');
$associd=file('/home/vip/make/associationid.txt');

$ec2Client[$i] = new Aws\Ec2\Ec2Client([
    'region' => 'us-east-1',
    'version' => 'latest',
    'profile' => 'default'
]);

$instanceId = 'i-0c54d9bad064ec307';

$result0[$i] = $ec2Client[$i]->disassociateAddress(array(
    'AssociationId' => clean($associd[$i]),
));


$result1[$i] = $ec2Client[$i]->releaseAddress(array(
    'AllocationId' => clean($allocid[$i]),
));

$allocation[$i] = $ec2Client[$i]->allocateAddress(array(
    'DryRun' => false,
    'Domain' => 'vpc',
));

$allocid[$i]=$allocation[$i]->get('AllocationId');
$allocid[$i]=clean($allocid[$i]) . "\n";
file_put_contents('/home/vip/make/allocationid.txt', $allocid);

$result2[$i] = $ec2Client[$i]->associateAddress(array(
    'DryRun' => false,
    'InstanceId' => $instanceId,
	'PrivateIpAddress' => clean($prvips[$i]),
    'AllocationId' => $allocation[$i]->get('AllocationId'),
));

//$a=$result2->get('AssociationId');
$associd[$i]=$result2[$i]->get('AssociationId');
$associd[$i]=clean($associd[$i]) . "\n";
file_put_contents('/home/vip/make/associationid.txt', $associd);

$pubips[$i]=$result2[$i]->get('PublicIpAddress');
$pubips[$i]=clean($pubips[$i]) . "\n";
file_put_contents('/home/vip/make/publicips.txt', $pubips);

file_put_contents('/home/vip/make/var0.txt', var_dump_ret($result0[$i]));
file_put_contents('/home/vip/make/var1.txt', var_dump_ret($result1[$i]));
file_put_contents('/home/vip/make/var2.txt', var_dump_ret($result2[$i]));
}

?>