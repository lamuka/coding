<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

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

if (file_exists(''.$dir.'/smtp/raw/')==FALSE) { mkdir(''.$dir.'/smtp/raw/'); } else { rrmdir(''.$dir.'/smtp/raw/'); mkdir(''.$dir.'/smtp/raw/'); }
$dir1 = ''.$dir.'/smtp/raw/';
 
if( isset($_FILES['fileToUpload2']['name'])) {
 
  $total_files=count($_FILES['fileToUpload2']['name']);
 
  for($key=0;$key<$total_files;$key++) 
  {
 
    if(isset($_FILES['fileToUpload2']['name'][$key]) && $_FILES['fileToUpload2']['size'][$key]>0) 
	{
		
		$original_filename = ru2lat($_FILES['fileToUpload2']['name'][$key]);
		$target = $dir1 . basename($original_filename);
		$tmp  = $_FILES['fileToUpload2']['tmp_name'][$key];
		//file_put_contents(''.$dir.'/smtp/xxx.txt', $_FILES['fileToUpload2']['type'][$key]);
		move_uploaded_file($tmp, $target);


			if(preg_match('/x-zip-compressed/', $_FILES['fileToUpload2']['type'][$key]))
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
						copy('zip://'.$target.'#'.$filename.'', ''.$dir.'/smtp/raw/'.ru2lat($filename).'');
					}                  
				$zip->close();                  
				}
			unlink($target);
			
			}
	}
  }
 

//////////////////////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
$dir1 = ''.$dir.'/smtp/raw/';
$files=glob(''.$dir1.'*.*');
$cnt1=count($files);
print $cnt1;


if (file_exists(''.$dir.'/smtp/result/')==FALSE) { mkdir(''.$dir.'/smtp/result/'); } 
//else { rrmdir(''.$dir.'/smtp/result/'); mkdir(''.$dir.'/smtp/result/'); }

/* if (file_exists(''.$dir.'/smtp/result/orangefr.txt')==FALSE) { touch(''.$dir.'/smtp/result/orangefr.txt'); }
$orangefr=''.$dir.'/smtp/result/orangefr.txt';
if (file_exists(''.$dir.'/smtp/result/outlook.txt')==FALSE) { touch(''.$dir.'/smtp/result/outlook.txt'); }
$outlook=''.$dir.'/smtp/result/outlook.txt'; */
/* if (file_exists(''.$dir.'/smtp/result/interiapl.txt')==FALSE) { touch(''.$dir.'/smtp/result/interiapl.txt'); }
$interiapl=''.$dir.'/smtp/result/interiapl.txt'; */

/* if (file_exists(''.$dir.'/smtp/result/gmxcom.txt')==FALSE) { touch(''.$dir.'/smtp/result/gmxcom.txt'); }
$gmxcom=''.$dir.'/smtp/result/gmxcom.txt';
if (file_exists(''.$dir.'/smtp/result/mailcom.txt')==FALSE) { touch(''.$dir.'/smtp/result/mailcom.txt'); }
$mailcom=''.$dir.'/smtp/result/mailcom.txt';

if (file_exists(''.$dir.'/smtp/result/yahoo.txt')==FALSE) { touch(''.$dir.'/smtp/result/yahoo.txt'); }
$yahoo=''.$dir.'/smtp/result/yahoo.txt';
if (file_exists(''.$dir.'/smtp/result/aol.txt')==FALSE) { touch(''.$dir.'/smtp/result/aol.txt'); }
$aol=''.$dir.'/smtp/result/aol.txt';


if (file_exists(''.$dir.'/smtp/result/wppl.txt')==FALSE) { touch(''.$dir.'/smtp/result/wppl.txt'); }
$wppl=''.$dir.'/smtp/result/wppl.txt';
if (file_exists(''.$dir.'/smtp/result/o2pl.txt')==FALSE) { touch(''.$dir.'/smtp/result/o2pl.txt'); }
$o2pl=''.$dir.'/smtp/result/o2pl.txt';
if (file_exists(''.$dir.'/smtp/result/onetpl.txt')==FALSE) { touch(''.$dir.'/smtp/result/onetpl.txt'); }
$onetpl=''.$dir.'/smtp/result/onetpl.txt';


if (file_exists(''.$dir.'/smtp/result/rambler.txt')==FALSE) { touch(''.$dir.'/smtp/result/rambler.txt'); }
$rambler=''.$dir.'/smtp/result/rambler.txt';
if (file_exists(''.$dir.'/smtp/result/mailru.txt')==FALSE) { touch(''.$dir.'/smtp/result/mailru.txt'); }
$mailru=''.$dir.'/smtp/result/mailru.txt';

if (file_exists(''.$dir.'/smtp/result/yandex.txt')==FALSE) { touch(''.$dir.'/smtp/result/yandex.txt'); }
$yandex=''.$dir.'/smtp/result/yandex.txt'; */


if (file_exists(''.$dir.'/smtp/result/gmxde.txt')==FALSE) { touch(''.$dir.'/smtp/result/gmxde.txt'); }
$gmxde=''.$dir.'/smtp/result/gmxde.txt';
if (file_exists(''.$dir.'/smtp/result/webde.txt')==FALSE) { touch(''.$dir.'/smtp/result/webde.txt'); }
$webde=''.$dir.'/smtp/result/webde.txt';
/* if (file_exists(''.$dir.'/smtp/result/tonlinede.txt')==FALSE) { touch(''.$dir.'/smtp/result/tonlinede.txt'); }
$tonlinede=''.$dir.'/smtp/result/tonlinede.txt'; */


for($i=0;$i<$cnt1;$i++)
{

	$data=file($files[$i]);
	$cnt2=count($data);


	for($y=0;$y<$cnt2;$y++)
	{
	
		$data[$y]=clean($data[$y]);
		
		
		/////US/////
		
		/* if(preg_match('/@outlook\./i', $data[$y])==TRUE || preg_match('/@hotmail\.com/i', $data[$y])==TRUE || preg_match('/@msn\.com/i', $data[$y])==TRUE || preg_match('/@live\.com/i', $data[$y])==TRUE)
		{
			file_put_contents($outlook, $data[$y] . "\n",FILE_APPEND);
		} */
		
		/* if(preg_match('/@gmx\.com/i', $data[$y])==TRUE || preg_match('/@gmx\.us/i', $data[$y])==TRUE)
		{
			
			file_put_contents($gmxcom, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@mail\.com/i', $data[$y])==TRUE || preg_match('/@mail\.us/i', $data[$y])==TRUE)
		{
			file_put_contents($mailcom, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@aol\.com/i', $data[$y])==TRUE)
		{
			file_put_contents($aol, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@yahoo\.com/i', $data[$y])==TRUE)
		{
			file_put_contents($yahoo, $data[$y] . "\n",FILE_APPEND);
		} */
		
		
		
		/////PL/////
		/* if(preg_match('/@wp\.pl/i', $data[$y])==TRUE)
		{
			file_put_contents($wppl, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@o2\.pl/i', $data[$y])==TRUE)
		{
			file_put_contents($o2pl, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@onet\.pl/i', $data[$y])==TRUE)
		{
			file_put_contents($onetpl, $data[$y] . "\n",FILE_APPEND);
		} */
		
		/* if(preg_match('/@interia\.pl/i', $data[$y])==TRUE)
		{
			file_put_contents($interiapl, $data[$y] . "\n",FILE_APPEND);
		} */
		
		
		
		/////RU/////
		/* if(preg_match('/@rambler\.ru/i', $data[$y])==TRUE)
		{
			file_put_contents($ramblerru, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@mail\.ru/i', $data[$y])==TRUE || preg_match('/@bk\.ru/i', $data[$y])==TRUE || preg_match('/@list\.ru/i', $data[$y])==TRUE || preg_match('/@inbox\.ru/i', $data[$y])==TRUE)
		{
			file_put_contents($mailru, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@yandex\.ru/i', $data[$y])==TRUE || preg_match('/@yandex\.com/i', $data[$y])==TRUE)
		{
			file_put_contents($yandex, $data[$y] . "\n",FILE_APPEND);
		} */
		
		

		
		/////DE/////
/* 		if(preg_match('/@t-online\.de/i', $data[$y])==TRUE)
		{
			file_put_contents($tonlinede, $data[$y] . "\n",FILE_APPEND);
		} */
		
		if(preg_match('/@gmx\.de/i', $data[$y])==TRUE || preg_match('/@gmx\.net/i', $data[$y])==TRUE || preg_match('/@gmx\.at/i', $data[$y])==TRUE || preg_match('/@gmx\.ch/i', $data[$y])==TRUE)
		{
			file_put_contents($gmxde, $data[$y] . "\n",FILE_APPEND);
		}
		
		if(preg_match('/@web\.de/i', $data[$y])==TRUE)
		{
			file_put_contents($webde, $data[$y] . "\n",FILE_APPEND);
		}
		
	
		
		unset($data[$y]);
	}


}

}
////////////////
if (file_exists(''.$dir.'/smtp/result/'))
{
	

$datasend=500000;

$dir2 = ''.$dir.'/smtp/result/';
$files2=glob(''.$dir2.'*.*');
$cnt2=count($files2);

if (file_exists(''.$dir.'/smtp/result/accounts/')==FALSE) { mkdir(''.$dir.'/smtp/result/accounts/'); }


for($y=0;$y<$cnt2;$y++)
{
	$filename=preg_replace('/.*\//', '', $files2[$y]);
	$filename=preg_replace('/\..*/', '', $filename);
	$filename=clean($filename);
	if (file_exists(''.$dir.'/smtp/result/accounts/'.$filename.'/')==FALSE) { mkdir(''.$dir.'/smtp/result/accounts/'.$filename.'/'); }
	
	$base1=file($files2[$y]);
	$accounts=count($base1);
	$end=ceil($accounts/$datasend);
	//$end=32;
	//print $end;
		
	$a=0;
	
	for($i=0;$i<$end;$i++)
	{
		
		$file=''.$dir.'/smtp/result/accounts/'.$filename.'/'.$filename.'_'.$i.'.txt';
		$output1=array_slice($base1, $a, $datasend);
		file_put_contents($file, $output1);
		unset($output1);
		
		$a=$a+$datasend;
	}	
	unset($base1);
	
}




$rootPath1 = ''.$dir.'/smtp/result/accounts/';
$zipFileName1 = ''.$dir.'/smtp/ready.zip';
$zip1 = new ZipArchive();
$zip1->open($zipFileName1, ZipArchive::CREATE | ZipArchive::OVERWRITE);
addFolderToZip($rootPath1."/", $zip1, $zipdir1 = '');
$zip1->close();



}

header('Location: accounts.html');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();