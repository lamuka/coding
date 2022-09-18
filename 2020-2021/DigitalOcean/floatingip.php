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
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
/////////////

if (file_exists('c:/xampp/htdocs/DigitalOcean/floatingips.txt')) { unlink('c:/xampp/htdocs/DigitalOcean/floatingips.txt'); touch('c:/xampp/htdocs/DigitalOcean/floatingips.txt'); } else { touch('c:/xampp/htdocs/DigitalOcean/floatingips.txt'); }

$get=file('c:/xampp/htdocs/DigitalOcean/instances.txt');
$cnt=count($get);


for($i=0;$i<$cnt;$i++)
{
$get[$i]=clean1($get[$i]);
$data = array("droplet_id" => "$get[$i]");
$data_string = json_encode($data);

$ch = curl_init('https://api.digitalocean.com/v2/floating_ips');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);
file_put_contents('c:/xampp/htdocs/DigitalOcean/floatingips.txt', clean1($result) . "\n",FILE_APPEND);
}
