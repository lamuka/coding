<?php

//***//
function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
//***//

$file1='./channel_parse_id.txt';
if (file_exists('./result_channel_parse.txt')) { unlink('./result_channel_parse.txt'); touch('./result_channel_parse.txt'); } else { touch('./result_channel_parse.txt'); }
$filenew1='./result_channel_parse.txt';
$string1=file_get_contents($file1);

preg_match_all('/^.*\(\#.*/m', $string1, $out1);

$cnt1=count($out1[0]);

for($i1=0;$i1<$cnt1;$i1++)
{
$out1[0][$i1]=preg_replace('/^.*\[36;1m/', ' ', $out1[0][$i1]);
$out1[0][$i1]=str_replace('[33;1m', '', $out1[0][$i1]);
$out1[0][$i1]=str_replace('(#', '-100', $out1[0][$i1]);
$out1[0][$i1]=str_replace('):', '', $out1[0][$i1]);
$out1[0][$i1]=clean($out1[0][$i1]);
//$out1[0][$i1]='-100'.$out1[0][$i1].'';
file_put_contents($filenew1, $out1[0][$i1] . "\n",FILE_APPEND);
//unset($out1[0][$i1]);
}

unset($out1);
unset($string1);unset($filenew1);unset($file1);unset($i1);unset($cnt1);