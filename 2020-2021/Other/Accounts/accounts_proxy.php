<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
///////// 
function addFolderToZip($dirs, $zipArchive, $zipdir = ''){ 
        if (is_dir($dirs)) { 
            if ($dh = opendir($dirs)) { 
                if(!empty($zipdir)) $zipArchive->addEmptyDir($zipdir); 
                while (($files = readdir($dh)) !== false) { 
                    if(!is_file($dirs . $files)){ 
                        if( ($files !== ".") && ($files !== "..")){ 
                            addFolderToZip($dirs . $files . "/", $zipArchive, $zipdir . $files . "/");
                        } 
                    }else{ 
                        $zipArchive->addFile($dirs . $files, $zipdir . $files); } } } } }
						

////////////////////////////////////////////////
$prport='33333';
$prname='proxy';
$prpass='xxxxxxxxxx';
	
	
$dir=dirname(__FILE__);
if (file_exists(''.$dir.'/smtp/')==FALSE) { mkdir(''.$dir.'/smtp/'); }
if( isset($_FILES['fileToUpload1']['tmp_name']))
//if(file_get_contents($_FILES["fileToUpload1"])!==NULL)
{
if (file_exists(''.$dir.'/smtp/temp.txt')) { unlink(''.$dir.'/smtp/temp.txt'); touch(''.$dir.'/smtp/temp.txt'); } else { touch(''.$dir.'/smtp/temp.txt'); }
$temp=''.$dir.'/smtp/temp.txt';
if (file_exists(''.$dir.'/smtp/ips.txt')) { unlink(''.$dir.'/smtp/ips.txt'); touch(''.$dir.'/smtp/ips.txt'); } else { touch(''.$dir.'/smtp/ips.txt'); }
if (file_exists(''.$dir.'/smtp/ips1.txt')) { unlink(''.$dir.'/smtp/ips1.txt'); touch(''.$dir.'/smtp/ips1.txt'); } else { touch(''.$dir.'/smtp/ips1.txt'); }
if (file_exists(''.$dir.'/smtp/ips2.txt')) { unlink(''.$dir.'/smtp/ips2.txt'); touch(''.$dir.'/smtp/ips2.txt'); } else { touch(''.$dir.'/smtp/ips2.txt'); }
if (file_exists(''.$dir.'/smtp/ips3.txt')) { unlink(''.$dir.'/smtp/ips3.txt'); touch(''.$dir.'/smtp/ips3.txt'); } else { touch(''.$dir.'/smtp/ips3.txt'); }
if (file_exists(''.$dir.'/smtp/ips5.txt')) { unlink(''.$dir.'/smtp/ips5.txt'); touch(''.$dir.'/smtp/ips5.txt'); } else { touch(''.$dir.'/smtp/ips5.txt'); }
if (file_exists(''.$dir.'/smtp/ips6.txt')) { unlink(''.$dir.'/smtp/ips6.txt'); touch(''.$dir.'/smtp/ips6.txt'); } else { touch(''.$dir.'/smtp/ips6.txt'); }
if (file_exists(''.$dir.'/smtp/ips7.txt')) { unlink(''.$dir.'/smtp/ips7.txt'); touch(''.$dir.'/smtp/ips7.txt'); } else { touch(''.$dir.'/smtp/ips7.txt'); }
if (file_exists(''.$dir.'/smtp/ips8.txt')) { unlink(''.$dir.'/smtp/ips8.txt'); touch(''.$dir.'/smtp/ips8.txt'); } else { touch(''.$dir.'/smtp/ips8.txt'); }
if (file_exists(''.$dir.'/smtp/ips9.txt')) { unlink(''.$dir.'/smtp/ips9.txt'); touch(''.$dir.'/smtp/ips9.txt'); } else { touch(''.$dir.'/smtp/ips9.txt'); }
if (file_exists(''.$dir.'/smtp/ips10.txt')) { unlink(''.$dir.'/smtp/ips10.txt'); touch(''.$dir.'/smtp/ips10.txt'); } else { touch(''.$dir.'/smtp/ips10.txt'); }

//$get=file($_FILES["fileToUpload1"]["tmp_name1"]);
$check=file_get_contents($_FILES["fileToUpload1"]["tmp_name"]);
$get=file($_FILES["fileToUpload1"]["tmp_name"]);
//file_put_contents($temp, $check);
//$get=file($temp);
//$cnt=count($get);
//unlink($temp);

preg_match_all('/(\d{1,3}\.){3}\d{1,3}/', $check, $out);
$cnt=count($out[0]);
	//preg_match_all('/\d{1,3}\..*?(\W)/', $get, $out);
//preg_match_all('/(\d{1,3}\.){3}\d{1,3}(,|\n)/', $get, $out);
//preg_match_all('/(((\d{1,3}\.){3}\d{1,3},)|((\d{1,3}\.){3}\d{1,3}\n))/', $get, $out);
//preg_match_all('/(\d{1,3}\.){3}\d{1,3}\n/', $get, $out);
preg_match_all('/(\d{1,3}\.){3}\d{1,3}\W\d{2,5}/', $check, $out1);

	for($i=0;$i<$cnt;$i++)
	{
		
	$data=explode(":", $get[$i]);
	$prip1=clean($data[0]);
	$prport1=clean($data[1]);
	$prname1=clean($data[2]);
	$prpass1=clean($data[3]);
	$ip=clean($out[0][$i]);
	$out1[0][$i]=clean($out1[0][$i]);
	file_put_contents(''.$dir.'/smtp/ips7.txt', $out1[0][$i] . "\n",FILE_APPEND);

	file_put_contents(''.$dir.'/smtp/ips.txt', ''.$ip.':'.$prport.':'.$prname.':'.$prpass.'' . "\n",FILE_APPEND);
	file_put_contents(''.$dir.'/smtp/ips1.txt', ''.$prname.':'.$prpass.'@'.$ip.':'.$prport.'' . "\n",FILE_APPEND);
	file_put_contents(''.$dir.'/smtp/ips2.txt', 'socks5://'.$prname.':'.$prpass.'@'.$ip.':'.$prport.'	0		0' . "\n",FILE_APPEND);
	file_put_contents(''.$dir.'/smtp/ips8.txt', 'socks5://'.$prname1.':'.$prpass1.'@'.$prip1.':'.$prport1.'	0		0' . "\n",FILE_APPEND);
	file_put_contents(''.$dir.'/smtp/ips3.txt', 'socks5://'.$out1[0][$i].'	0		0' . "\n",FILE_APPEND);
	$change=str_replace(':', '	', $out1[0][$i]);
	file_put_contents(''.$dir.'/smtp/ips5.txt', ''.$ip.'	'.$prport.'	2	'.$prname.'	'.$prpass.'' . "\n",FILE_APPEND);
	file_put_contents(''.$dir.'/smtp/ips6.txt', ''.$change.'	0		' . "\n",FILE_APPEND);
	
	file_put_contents(''.$dir.'/smtp/ips9.txt', ''.$prip1.':'.$prport1.':'.$prname1.':'.$prpass1.'' . "\n",FILE_APPEND);
	file_put_contents(''.$dir.'/smtp/ips10.txt', ''.$prname1.':'.$prpass1.'@'.$prip1.':'.$prport1.'' . "\n",FILE_APPEND);
	
	unset($data);
	unset($out[0][$i]);
	unset($out1[0][$i]);
	}
unset($check);

$get=file(''.$dir.'/smtp/ips.txt');
shuffle($get);
file_put_contents(''.$dir.'/smtp/ips4.txt', $get);
unset($get);
}


if($_POST['prlist']!=='')
{
	if (file_exists(''.$dir.'/smtp/ips.txt')) { unlink(''.$dir.'/smtp/ips.txt'); touch(''.$dir.'/smtp/ips.txt'); } else { touch(''.$dir.'/smtp/ips.txt'); }
	if (file_exists(''.$dir.'/smtp/ips1.txt')) { unlink(''.$dir.'/smtp/ips1.txt'); touch(''.$dir.'/smtp/ips1.txt'); } else { touch(''.$dir.'/smtp/ips1.txt'); }
	if (file_exists(''.$dir.'/smtp/ips2.txt')) { unlink(''.$dir.'/smtp/ips2.txt'); touch(''.$dir.'/smtp/ips2.txt'); } else { touch(''.$dir.'/smtp/ips2.txt'); }
	if (file_exists(''.$dir.'/smtp/ips3.txt')) { unlink(''.$dir.'/smtp/ips3.txt'); touch(''.$dir.'/smtp/ips3.txt'); } else { touch(''.$dir.'/smtp/ips3.txt'); }
	if (file_exists(''.$dir.'/smtp/ips5.txt')) { unlink(''.$dir.'/smtp/ips5.txt'); touch(''.$dir.'/smtp/ips5.txt'); } else { touch(''.$dir.'/smtp/ips5.txt'); }
	if (file_exists(''.$dir.'/smtp/ips6.txt')) { unlink(''.$dir.'/smtp/ips6.txt'); touch(''.$dir.'/smtp/ips6.txt'); } else { touch(''.$dir.'/smtp/ips6.txt'); }
	if (file_exists(''.$dir.'/smtp/ips7.txt')) { unlink(''.$dir.'/smtp/ips7.txt'); touch(''.$dir.'/smtp/ips7.txt'); } else { touch(''.$dir.'/smtp/ips7.txt'); }
	if (file_exists(''.$dir.'/smtp/ips8.txt')) { unlink(''.$dir.'/smtp/ips8.txt'); touch(''.$dir.'/smtp/ips8.txt'); } else { touch(''.$dir.'/smtp/ips8.txt'); }
	if (file_exists(''.$dir.'/smtp/ips9.txt')) { unlink(''.$dir.'/smtp/ips9.txt'); touch(''.$dir.'/smtp/ips9.txt'); } else { touch(''.$dir.'/smtp/ips9.txt'); }
	if (file_exists(''.$dir.'/smtp/ips10.txt')) { unlink(''.$dir.'/smtp/ips10.txt'); touch(''.$dir.'/smtp/ips10.txt'); } else { touch(''.$dir.'/smtp/ips10.txt'); }
	// $acclist=file_get_contents($_POST['acclist']);
	$prlist=$_POST['prlist'];
	// file_put_contents($temp, $acclist . "\n",FILE_APPEND);
	
	preg_match_all('/(\d{1,3}\.){3}\d{1,3}/', $prlist, $out);
	//preg_match_all('/\S+(\s|$)/', $prlist, $out);
	// preg_match_all('/\w+@\w+', $acclist, $out);
	// preg_match_all('/\w+@\w/', $acclist, $out);
	$cnt1=count($out[0]);
	
	preg_match_all('/(\d{1,3}\.){3}\d{1,3}\W\d{2,5}/', $prlist, $out1);
	
	preg_match_all('/\S+(\s|$)/', $prlist, $out2);
	
	for($i=0;$i<$cnt1;$i++)	
	{
		$data=explode(":", clean($out2[0][$i]));
		$prip1=clean($data[0]);
		$prport1=clean($data[1]);
		$prname1=clean($data[2]);
		$prpass1=clean($data[3]);
		$ip=clean($out[0][$i]);
		$out1[0][$i]=clean($out1[0][$i]);
		file_put_contents(''.$dir.'/smtp/ips7.txt', $out1[0][$i] . "\n",FILE_APPEND);
		
		file_put_contents(''.$dir.'/smtp/ips.txt', ''.$ip.':'.$prport.':'.$prname.':'.$prpass.'' . "\n",FILE_APPEND);
		file_put_contents(''.$dir.'/smtp/ips1.txt', ''.$prname.':'.$prpass.'@'.$ip.':'.$prport.'' . "\n",FILE_APPEND);
		file_put_contents(''.$dir.'/smtp/ips2.txt', 'socks5://'.$prname.':'.$prpass.'@'.$ip.':'.$prport.'	0		0' . "\n",FILE_APPEND);
		file_put_contents(''.$dir.'/smtp/ips8.txt', 'socks5://'.$prname1.':'.$prpass1.'@'.$prip1.':'.$prport1.'	0		0' . "\n",FILE_APPEND);
		file_put_contents(''.$dir.'/smtp/ips3.txt', 'socks5://'.$out1[0][$i].'	0		0' . "\n",FILE_APPEND);
		$change=str_replace(':', '	', $out1[0][$i]);
		file_put_contents(''.$dir.'/smtp/ips5.txt', ''.$ip.'	'.$prport.'	2	'.$prname.'	'.$prpass.'' . "\n",FILE_APPEND);
		file_put_contents(''.$dir.'/smtp/ips6.txt', ''.$change.'	0		' . "\n",FILE_APPEND);
		
		file_put_contents(''.$dir.'/smtp/ips9.txt', ''.$prip1.':'.$prport1.':'.$prname1.':'.$prpass1.'' . "\n",FILE_APPEND);
		file_put_contents(''.$dir.'/smtp/ips10.txt', ''.$prname1.':'.$prpass1.'@'.$prip1.':'.$prport1.'' . "\n",FILE_APPEND);
	
		unset($data);
		unset($out[0][$i]);
		unset($out1[0][$i]);
	}
	
	unset($prlist);
	$get=file(''.$dir.'/smtp/ips.txt');
	shuffle($get);
	file_put_contents(''.$dir.'/smtp/ips4.txt', $get);
	unset($get);
}

header('Location: accounts.html');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();