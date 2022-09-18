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

///CREATE INSTANCES///
if (file_exists('c:/xampp/htdocs/DigitalOcean/instances.txt')) { unlink('c:/xampp/htdocs/DigitalOcean/instances.txt'); touch('c:/xampp/htdocs/DigitalOcean/instances.txt'); } else { touch('c:/xampp/htdocs/DigitalOcean/instances.txt'); }

for($i=1;$i<=15;$i++)
{
	
$data = array("name" => "droplet$i", "region" => "fra1", "size" => "s-1vcpu-1gb", "image" => "centos-7-x64", "backups" => false, "ipv6" => false, "user_data" => null, "private_networking" => null, "volumes" => null);
$data_string = json_encode($data);

$ch = curl_init('https://api.digitalocean.com/v2/droplets');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);
//$http_code=curl_getinfo($ch);
$result=preg_replace('/,.*/', '', $result);
$result=preg_replace('/.*:/', '', $result);
file_put_contents('c:/xampp/htdocs/DigitalOcean/instances.txt', clean1($result) . "\n",FILE_APPEND);

}
//print_r($result[0]);
