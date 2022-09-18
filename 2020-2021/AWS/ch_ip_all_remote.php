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
$instanceId="i-0c54d9bad064ec307";
$ipsquan="11";
$ips="2 3 4 5 6 7 8 9 10 11 12";


preg_match_all('/\d{1,2}(\D|$){1}/', $ips, $out1);

for($i=0;$i<$ipsquan;$i++)
{
	
$i4=$i+2;
$i7=$i+2;

$i4=''.$i4.' ';


require '/home/vip/vendor/autoload.php';

if (in_array(''.$i7.'', $out1[0]) || in_array(''.$i4.'', $out1[0]))
{
$prvips=file('/var/www/html/make1/privateips.txt');
$allocid=file('/var/www/html/make1/allocationid.txt');
$associd=file('/var/www/html/make1/associationid.txt');

$ec2Client[$i] = new Aws\Ec2\Ec2Client([
    'region' => 'us-east-1',
    'version' => 'latest',
    'profile' => 'default'
]);


////////////////////////////////////////////////////////////
///disassociateAddress///
$result0[$i] = $ec2Client[$i]->disassociateAddress(array(
    'AssociationId' => clean($associd[$i]),
));

///releaseAddress///
$result1[$i] = $ec2Client[$i]->releaseAddress(array(
    'AllocationId' => clean($allocid[$i]),
));

////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////
///allocateAddress///

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
file_put_contents('/var/www/html/make1/associationid.txt', $associd);

///////////////////////////////////////////////////////////


}
}



$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }


exit();

