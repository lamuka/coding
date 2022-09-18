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

require '/home/vip/vendor/autoload.php';

$ec2Client = new Aws\Ec2\Ec2Client([
    'region' => 'us-east-1',
    'version' => 'latest',
    'profile' => 'default'
]);


$result = $ec2Client->rebootInstance(array(
'InstanceId' => $instanceId,
));


$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }


exit();

