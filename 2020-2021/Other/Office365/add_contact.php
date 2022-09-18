<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}


$a=file('c:/inetpub/wwwroot/contacts.txt');

$cnt=count($a);
if (file_exists('./add_contacts_others.ps1')) { unlink('./add_contacts_others.ps1'); touch('./add_contacts_others.ps1'); } else { touch('./add_contacts_others.ps1'); }
$con='./add_contacts_others.ps1';

//if (file_exists('./add_group_members2.ps1')) { unlink('./add_group_members2.ps1'); touch('./add_group_members2.ps1'); } else { touch('./add_group_members2.ps1'); }
//$mem='./add_group_members2.ps1';

for($i=0;$i<$cnt;$i++)
{
$f[$i]='New-MailContact -Name '.clean($a[$i]).' -ExternalEmailAddress '.clean($a[$i]).';';
file_put_contents($con, $f[$i] . "\n",FILE_APPEND);

//$g[$i]='Add-DistributionGroupMember -Identity "group3" -Member "'.clean($a[$i]).'";';
//file_put_contents($mem, $g[$i] . "\n",FILE_APPEND);
}

$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();



//print(system('sudo whoami'));

?>




