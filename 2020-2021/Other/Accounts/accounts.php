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


if (file_exists(''.$dir.'/smtp/temp/')==FALSE) { mkdir(''.$dir.'/smtp/temp/'); } else { rrmdir(''.$dir.'/smtp/temp/'); sleep(15); mkdir(''.$dir.'/smtp/temp/'); }
$dir1=''.$dir.'/smtp/temp/';
if (file_exists(''.$dir.'/smtp/temp/temp.txt')) { unlink(''.$dir.'/smtp/temp/temp.txt'); touch(''.$dir.'/smtp/temp/temp.txt'); } else { touch(''.$dir.'/smtp/temp/temp.txt'); }
$temp=''.$dir.'/smtp/temp/temp.txt';

if($_POST['threads']!=='') { $threads=$_POST['threads']; } else { $threads='1'; }
if($_POST['limit']!=='') { $limit=$_POST['limit']; } else { $limit='0'; }
if($_POST['fremail']!=='') { $fremail=$_POST['fremail']; } else { $fremail=''; }
if($_POST['repemail']!=='') { $repemail=$_POST['repemail']; } else { $repemail=''; }
if($_POST['ussl']!=='') { $ussl='nossl'; $ussl1='0';} else { $ussl='ssl'; $ussl1='1';}
if($_POST['acclimit']!=='') { $acclimit=$_POST['acclimit']; } else { $acclimit='0'; }
if($_POST['lproxy']!=='') { $lproxy=$_POST['lproxy']; } else { $lproxy=''; }



if(isset($_FILES['fileToUpload']['name']))
{
	$total_files=count($_FILES['fileToUpload']['name']);
	
	for($key=0;$key<$total_files;$key++) 
	{
 
		if(isset($_FILES['fileToUpload']['name'][$key]) && $_FILES['fileToUpload']['size'][$key]>0) 
		{
			$original_filename = ru2lat($_FILES['fileToUpload']['name'][$key]);
			$target = $dir1 . basename($original_filename);
			$tmp  = $_FILES['fileToUpload']['tmp_name'][$key];
			move_uploaded_file($tmp, $target);
			
			if(preg_match('/x-zip-compressed/', $_FILES['fileToUpload']['type'][$key]))
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
$files=glob(''.$dir1.'*.*');
$cnt1=count($files);

for($y=0;$y<$cnt1;$y++)	
{
$data=file_get_contents($files[$y]);
file_put_contents($temp, $data . "\n",FILE_APPEND);
unset($data);
}
unset($files);

}





if($_POST['acclist']!=='')
{

	$acclist=$_POST['acclist'];
	//file_put_contents($temp, $acclist . "\n",FILE_APPEND);
	
	preg_match_all('/\S+@\S+(\s|$)/', $acclist, $out);

	$cnt1=count($out[0]);
	for($i=0;$i<$cnt1;$i++)	
	{
		$out[0][$i]=clean($out[0][$i]);
		file_put_contents($temp, $out[0][$i] . "\n",FILE_APPEND);
		unset($out[0][$i]);
	}
	unset($acclist);
}


////////////////////////////////////
// if(isset($_FILES['fileToUpload']['name']) || $_POST['acclist']!=='')
// {

	// if (file_exists(''.$dir.'/smtp/atomic.csv')) { unlink(''.$dir.'/smtp/atomic.csv'); touch(''.$dir.'/smtp/atomic.csv'); } else { touch(''.$dir.'/smtp/atomic.csv'); }
	// $atomic=''.$dir.'/smtp/atomic.csv';
	// if (file_exists(''.$dir.'/smtp/atomic.txt')) { unlink(''.$dir.'/smtp/atomic.txt'); touch(''.$dir.'/smtp/atomic.txt'); } else { touch(''.$dir.'/smtp/atomic.txt'); }
	// $atomic1=''.$dir.'/smtp/atomic.txt';
	// if (file_exists(''.$dir.'/smtp/mailerking.txt')) { unlink(''.$dir.'/smtp/mailerking.txt'); touch(''.$dir.'/smtp/mailerking.txt'); } else { touch(''.$dir.'/smtp/mailerking.txt'); }
	// $mailerking=''.$dir.'/smtp/mailerking.txt';
	// if (file_exists(''.$dir.'/smtp/shuffle.txt')) { unlink(''.$dir.'/smtp/shuffle.txt'); touch(''.$dir.'/smtp/shuffle.txt'); } else { touch(''.$dir.'/smtp/shuffle.txt'); }
	// $shuffle=''.$dir.'/smtp/shuffle.txt';

	// $top='active;host;port;auth_type;login;password;pop_host;pop_port;from_field;enc_type;threads;pause_unit;pause_msg;pause_time_min;pause_time_max;msg_unit;msg_speed';
	// file_put_contents($atomic, $top . "\n",FILE_APPEND);
	// file_put_contents($atomic1, $top . "\n",FILE_APPEND);

	// $dir1=''.$dir.'/smtp/temp/';
	// $files=glob(''.$dir1.'*.*');
	// $cnt1=count($files);

	// for($i=0;$i<$cnt1;$i++)
	// {
		// $data=file($files[$i]);
		// $cnt=count($data);

		// for($y=0;$y<$cnt;$y++)	
		// {
			// $data[$y]=clean($data[$y]);
			// file_put_contents($shuffle, $data[$y] . "\n",FILE_APPEND);
			
			// $login=preg_replace('/:.*/', '', $data[$y]);
			// $password=preg_replace('/^.*:/', '', $data[$y]);
			// $login=clean($login);
			// $password=clean($password);
	
			// if(preg_match('/@outlook\./i', $data[$y]) || preg_match('/@hotmail\.com/i', $data[$y]) || preg_match('/@msn\.com/i', $data[$y]) || preg_match('/@live\.com/i', $data[$y]))
			// {
				// $host='smtp.office365.com';
				// $port='587';
			// }
			
			// if(preg_match('/@gmx\.com/i', $data[$y]) || preg_match('/@gmx\.us/i', $data[$y]))
			// {
				// $host='mail.gmx.com';
				// $port='587';
			// }
			
			// if(preg_match('/@mail\.com/i', $data[$y]) || preg_match('/@mail\.us/i', $data[$y]))
			// {
				// $host='smtp.mail.com';
				// $port='587';
			// }
			
			// if(preg_match('/@aol\.com/i', $data[$y]))
			// {
				// $host='smtp.aol.com';
				// $port='587';
			// }
			
			// if(preg_match('/@yahoo\.com/i', $data[$y]))
			// {
				// $host='smtp.mail.yahoo.com';
				// $port='587';
			// }
			
			
			
			///PL/////
			// if(preg_match('/@wp\.pl/i', $data[$y]))
			// {
				// $host='smtp.wp.pl';
				// $port='587';
			// }
			
			// if(preg_match('/@o2\.pl/i', $data[$y]))
			// {
				// $host='poczta.o2.pl';
				// $port='465';
			// }
			
			// if(preg_match('/@onet\.pl/i', $data[$y]))
			// {
				// $host='smtp.poczta.onet.pl';
				// $port='587';
			// }
			
			// if(preg_match('/@interia\.pl/i', $data[$y]))
			// {
				// $host='poczta.interia.pl';
				// $port='587';
			// }
			
			
			
			///RU/////
			// if(preg_match('/@rambler\.ru/i', $data[$y]))
			// {
				// $host='smtp.rambler.ru';
				// $port='465';
			// }
			
			// if(preg_match('/@mail\.ru/i', $data[$y]) || preg_match('/@bk\.ru/i', $data[$y]) || preg_match('/@list\.ru/i', $data[$y]) || preg_match('/@inbox\.ru/i', $data[$y]))
			// {
				// $host='smtp.mail.ru';
				// $port='587';
			// }
			
			// if(preg_match('/@yandex\.ru/i', $data[$y]) || preg_match('/@yandex\.com/i', $data[$y]))
			// {
				// $host='smtp.yandex.ru';
				// $port='587';
			// }
			
			
		
			
			///DE/////
			// if(preg_match('/@t-online\.de/i', $data[$y]))
			// {
				// $host='securesmtp.t-online.de';
				// $port='465';
			// }
			
			// if(preg_match('/@gmx\.de/i', $data[$y]) || preg_match('/@gmx\.net/i', $data[$y]) || preg_match('/@gmx\.at/i', $data[$y]) || preg_match('/@gmx\.ch/i', $data[$y]))
			// {
				// $host='mail.gmx.net';
				// $port='587';
			// }
			
			// if(preg_match('/@web\.de/i', $data[$y]))
			// {
				// $host='smtp.web.de';
				// $port='587';
			// }

			
			// if(isset($host))
			// {
			// $put='1;'.$host.';'.$port.';1;'.$login.';"'.$password.'";;0;'.$login.';'.$ussl1.';'.$threads.';1;0;0;0;3;'.$limit.'';
			// file_put_contents($atomic, $put . "\n",FILE_APPEND);
			// file_put_contents($atomic1, $put . "\n",FILE_APPEND);
				
			// $put1=''.$host.':'.$port.':'.$login.':'.$password.':'.$fremail.':'.$ussl.':'.$repemail.':::'.$acclimit.':'.$lproxy.'';
			// file_put_contents($mailerking, $put1 . "\n",FILE_APPEND);
			

			// }
			// unset($put);
			// unset($put1);
			// unset($data[$y]);
			// unset($host);
		// }
	// }
	
	// $result=file($shuffle);
	// shuffle($result);
	// file_put_contents($shuffle, $result);
	// unset($result);
	
// }



//unlink($temp);

	

$a=file_get_contents(''.$dir.'/accounts.html');
 $a=preg_replace('/\$\("#smtpthreads"\)\.val.*/', '$("#smtpthreads").val("'.$threads.'")', $a);

 $a=preg_replace('/\$\("#daylimit"\)\.val.*/', '$("#daylimit").val("'.$limit.'")', $a);

 //$a=preg_replace('/\$\("#fromemail"\)\.val.*/', '$("#fromemail").val("'.$fremail.'")', $a);

 //$a=preg_replace('/\$\("#replyemail"\)\.val.*/', '$("#replyemail").val("'.$repemail.'")', $a);

 $a=preg_replace('/\$\("#accountlimit"\)\.val.*/', '$("#accountlimit").val("'.$acclimit.'")', $a);




file_put_contents(''.$dir.'/accounts.html', $a);
header('Location: accounts.html');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit();