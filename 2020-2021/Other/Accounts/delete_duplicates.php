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
						
//////////
function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $filez = readdir($dir)) ) {
        if (( $filez != '.' ) && ( $filez != '..' )) {
            $full = $src . '/' . $filez;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src); }
	
////////	
function ru2lat($str)
{
    $tr = array(
    "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
    "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i", 
    "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n", 
    "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t", 
    "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch", 
    "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"", 
    "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b", 
    "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo", 
    "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"j", "к"=>"k", 
    "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", 
    "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", 
    "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch", 
    "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu", 
    "я"=>"ya"
    );
return strtr($str,$tr);
}
////////////////////////////////////////////////
$dir=dirname(__FILE__);
if (file_exists(''.$dir.'/smtp/')==FALSE) { mkdir(''.$dir.'/smtp/'); }
if (file_exists(''.$dir.'/smtp/unique.txt')) { unlink(''.$dir.'/smtp/unique.txt'); touch(''.$dir.'/smtp/unique.txt'); } else { touch(''.$dir.'/smtp/unique.txt'); }
$unique=''.$dir.'/smtp/unique.txt';
if (file_exists(''.$dir.'/smtp/temp1/')==FALSE) { mkdir(''.$dir.'/smtp/temp1/'); } else { rrmdir(''.$dir.'/smtp/temp1/'); mkdir(''.$dir.'/smtp/temp1/'); }
$dir1=''.$dir.'/smtp/temp1/';
if (file_exists(''.$dir.'/smtp/temp1/temp.txt')) { unlink(''.$dir.'/smtp/temp1/temp.txt'); touch(''.$dir.'/smtp/temp1/temp.txt'); } else { touch(''.$dir.'/smtp/temp1/temp.txt'); }
$temp=''.$dir.'/smtp/temp1/temp.txt';


if(isset($_FILES['fileToUpload3']['name']))
{
	$total_files=count($_FILES['fileToUpload3']['name']);
	
	for($key=0;$key<$total_files;$key++) 
	{
 
		if(isset($_FILES['fileToUpload3']['name'][$key]) && $_FILES['fileToUpload3']['size'][$key]>0) 
		{
			$original_filename = ru2lat($_FILES['fileToUpload3']['name'][$key]);
			$target = $dir1 . basename($original_filename);
			$tmp  = $_FILES['fileToUpload3']['tmp_name'][$key];
			move_uploaded_file($tmp, $target);
			
			if(preg_match('/x-zip-compressed/', $_FILES['fileToUpload3']['type'][$key]))
			{
				
				/* $zip=new ZipArchive; 
				if ($zip->open($target) === TRUE)
				{
					$zip->extractTo(''.$dir.'/smtp/raw/');
					$zip->close(); 
				}
				unlink($target); */
				
			
		
				$zip = new ZipArchive;
				if ($zip->open($target) === true) 
				{
					for($i = 0; $i < $zip->numFiles; $i++) 
					{
						$filename = $zip->getNameIndex($i);
						copy('zip://'.$target.'#'.$filename.'', ''.$dir1.''.ru2lat($filename).'');
					}                  
				$zip->close();                  
				}
				
				unlink($target);
			
			}
		}
			
	}
//$check=file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
//file_put_contents($temp, $check);
//unset($check);
}

if($_POST['ddub']!=='')
{

	$acclist=$_POST['ddub'];
	//file_put_contents($temp, $acclist . PHP_EOL,FILE_APPEND);
	
	preg_match_all('/\S+@\S+(\s|$)/', $acclist, $out);

	$cnt1=count($out[0]);
	for($i=0;$i<$cnt1;$i++)	
	{
		$out[0][$i]=clean($out[0][$i]);
		file_put_contents($temp, $out[0][$i] . PHP_EOL,FILE_APPEND);
		unset($out[0][$i]);
	}
	unset($acclist);
}


////////////////////////////////////
if(isset($_FILES['fileToUpload3']['name']) || $_POST['ddub']!=='')
{

	$dir1=''.$dir.'/smtp/temp1/';
	$files=glob(''.$dir1.'*.*');
	$cnt1=count($files);

	for($i=0;$i<$cnt1;$i++)
	{
		$data=file_get_contents($files[$i]);
		file_put_contents($unique, $data . PHP_EOL,FILE_APPEND);
	}
	
	
	$result=file($unique);
	$result=array_unique($result, SORT_STRING);
	file_put_contents($unique, $result);
	unset($result);
	
}



//unlink($temp);

header('Location: accounts.html');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();