<?php

///**///
function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
return($uncleaned);}

///**///
function get_curl($urlweb) {
$userAgent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2';
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $urlweb); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//curl_setopt($ch, CURLOPT_USERAGENT, $userAgent); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, TRUE); 
//curl_setopt($ch, CURLOPT_NOBODY, TRUE);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
//curl_setopt($ch, CURlOPT_COOKIEJAR, './cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataparse=curl_exec($ch);
$http_code=curl_getinfo($ch);
curl_close($ch);
return($dataparse); }

///**///
function curl($urlweb) {
$ch=curl_init();
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch, CURLOPT_URL, $urlweb); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataparse=curl_exec($ch);
$http_code=curl_getinfo($ch);
curl_close($ch);
return($dataparse); }	

///**///
function randomstring($length=13) {
$strrand="";
$characters=array_merge(range('2','9'));
$max=count($characters)-1;
for ($i=0; $i<$length; $i++) {
$rand=mt_rand(0, $max);
$strrand .= $characters[$rand];}
return $strrand;}

///**///
function ftp_putAll($con_ftp, $src_dir, $dst_dir) {
   $d = dir($src_dir);
   while($file = $d->read()) {
       if ($file != "." && $file != "..") {
           if (is_dir($src_dir."/".$file)) {
               if (ftp_nlist($con_ftp, $dst_dir."/".$file)) {
                   ftp_mkdir($con_ftp, $dst_dir."/".$file);
               }
               ftp_putAll($con_ftp, $src_dir."/".$file, $dst_dir."/".$file);
           } else {
               $upload = ftp_put($con_ftp, $dst_dir."/".$file, $src_dir."/".$file,FTP_BINARY);
           }
       }
	}
   $d->close();
}

///**///
function ftp_rmdirr($handle, $path)
{
    if(ftp_delete($handle, $path))
    {
        $list = ftp_nlist($handle, $path);
        if(!empty($list))
            foreach($list as $value)
                ftp_rmdirr($handle, $value);
    }
    
    if(ftp_rmdir($handle, $path))
        return true;
    else
        return false;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
<?php

///**///
function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
return($uncleaned);}

///**///
function get_curl($urlweb) {
$userAgent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2';
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $urlweb); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//curl_setopt($ch, CURLOPT_USERAGENT, $userAgent); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, TRUE); 
//curl_setopt($ch, CURLOPT_NOBODY, TRUE);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
//curl_setopt($ch, CURlOPT_COOKIEJAR, './cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataparse=curl_exec($ch);
$http_code=curl_getinfo($ch);
curl_close($ch);
return($dataparse); }

///**///
function curl($urlweb) {
$ch=curl_init();
curl_setopt($ch, CURLOPT_POST, 0); 
curl_setopt($ch, CURLOPT_URL, $urlweb); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataparse=curl_exec($ch);
$http_code=curl_getinfo($ch);
curl_close($ch);
return($dataparse); }	

///**///
function randomstring($length=13) {
$strrand="";
$characters=array_merge(range('2','9'));
$max=count($characters)-1;
for ($i=0; $i<$length; $i++) {
$rand=mt_rand(0, $max);
$strrand .= $characters[$rand];}
return $strrand;}

///**///
function ftp_putAll($con_ftp, $src_dir, $dst_dir) {
   $d = dir($src_dir);
   while($file = $d->read()) {
       if ($file != "." && $file != "..") {
           if (is_dir($src_dir."/".$file)) {
               if (ftp_nlist($con_ftp, $dst_dir."/".$file)) {
                   ftp_mkdir($con_ftp, $dst_dir."/".$file);
               }
               ftp_putAll($con_ftp, $src_dir."/".$file, $dst_dir."/".$file);
           } else {
               $upload = ftp_put($con_ftp, $dst_dir."/".$file, $src_dir."/".$file,FTP_BINARY);
           }
       }
	}
   $d->close();
}

///**///
function ftp_rmdirr($handle, $path)
{
    if(ftp_delete($handle, $path))
    {
        $list = ftp_nlist($handle, $path);
        if(!empty($list))
            foreach($list as $value)
                ftp_rmdirr($handle, $value);
    }
    
    if(ftp_rmdir($handle, $path))
        return true;
    else
        return false;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
$date=''.date("dm").'';
unlink('./res.txt');
$a=file_get_contents('./1.txt');
$b='./res.txt';
//$c=substr_count($a, '[K[33;1mUser');
$c=substr_count($a, '33;1mUser');

preg_match_all('/33;1mUser.*/m', $a, $d);

for($i=0;$i<$c;$i++)
{
$d[0][$i]=clean($d[0][$i]);
$d[0][$i]=str_replace("33;1mUser [0;31m", "", $d[0][$i]);
$d[0][$i]=str_replace("[33;1m", "", $d[0][$i]);
$d[0][$i]=str_replace(":", "", $d[0][$i]);
$d[0][$i]=clean($d[0][$i]);
file_put_contents($b, $d[0][$i] . "\n", FILE_APPEND);
}