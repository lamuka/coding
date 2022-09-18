<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
///

function clean1($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
///

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
///

function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
    }else {
        copy( $source, $target );
    }
}

////////////////////////////////
$dir=dirname(__FILE__);

$cntdata=count(file(''.$dir.'/data_all.txt'));
$cntacc=count(file(''.$dir.'/accounts_all.txt'));
$cntip=count(file(''.$dir.'/publicips.txt'));
$dataacc=ceil($cntdata/$cntacc);
$accinst=floor($cntacc/$cntip);
//print $cntacc . PHP_EOL;
//print $cntip . PHP_EOL;
//print $accinst;
$acc=1;
$testacc='korijakekc@comcast.net';
$dirins='/var/www/html';

$templatemain1=file_get_contents(''.$dir.'/template/test.php');
$templatemain1=preg_replace('/\$testacc\=.*/', '$testacc="'.$testacc.'";', $templatemain1);
file_put_contents(''.$dir.'/template/test.php', $templatemain1);

$templatemain2=file_get_contents(''.$dir.'/template/send.php');
$templatemain2=preg_replace('/\$testacc\=.*/', '$testacc="'.$testacc.'";', $templatemain2);
file_put_contents(''.$dir.'/template/send.php', $templatemain2);


if (file_exists(''.$dir.'/instances/')==FALSE) { mkdir(''.$dir.'/instances/'); } else { rrmdir(''.$dir.'/instances/'); mkdir(''.$dir.'/instances/');  }
$dir1=''.$dir.'/instances';

if (file_exists(''.$dir.'/prepare/')==FALSE) { mkdir(''.$dir.'/prepare/'); } else { rrmdir(''.$dir.'/prepare/'); mkdir(''.$dir.'/prepare/');  }
$dir2=''.$dir.'/prepare';



$put1='<?php
	
	function clean($uncleaned) {
	$uncleaned=preg_replace(&#039;/^\h*\v+/m&#039;, &#039;&#039;, $uncleaned);
	$uncleaned=preg_replace(&#039;/^[ \t]+|[ \t]+$/m&#039;, &#039;&#039;, $uncleaned);
	$uncleaned=preg_replace(&#039;/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m&#039;, &#039;&#039;, $uncleaned);
	$uncleaned=ltrim($uncleaned);
	$uncleaned=rtrim($uncleaned);
	$uncleaned=preg_replace(&#039;/\s{2,}/&#039;, &#039; &#039;, $uncleaned);
	return($uncleaned);}
	
	function clean1($uncleaned) {
	$uncleaned=preg_replace(&#039;/^\n+|^[\t\s]*\n+/m&#039;, &#039;&#039;, $uncleaned);
	return($uncleaned);}
	/////////;';

///////////////////////
if (file_exists(''.$dir2.'/prepare_send_all.php')) { unlink(''.$dir2.'/prepare_send_all.php'); touch(''.$dir2.'/prepare_send_all.php'); } else { touch(''.$dir2.'/prepare_send_all.php'); }
file_put_contents(''.$dir2.'/prepare_send_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/prepare_send_all.cmd')) { unlink(''.$dir2.'/prepare_send_all.cmd'); touch(''.$dir2.'/prepare_send_all.cmd'); } else { touch(''.$dir2.'/prepare_send_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/prepare_send_all.php 2>&1 &';

file_put_contents(''.$dir2.'/prepare_send_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/kill_php_all.php')) { unlink(''.$dir2.'/kill_php_all.php'); touch(''.$dir2.'/kill_php_all.php'); } else { touch(''.$dir2.'/kill_php_all.php'); }
file_put_contents(''.$dir2.'/kill_php_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/kill_php_all.cmd')) { unlink(''.$dir2.'/kill_php_all.cmd'); touch(''.$dir2.'/kill_php_all.cmd'); } else { touch(''.$dir2.'/kill_php_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/kill_php_all.php 2>&1 &';

file_put_contents(''.$dir2.'/kill_php_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/grep_php_all.php')) { unlink(''.$dir2.'/grep_php_all.php'); touch(''.$dir2.'/grep_php_all.php'); } else { touch(''.$dir2.'/grep_php_all.php'); }
file_put_contents(''.$dir2.'/grep_php_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/grep_php_all.cmd')) { unlink(''.$dir2.'/grep_php_all.cmd'); touch(''.$dir2.'/grep_php_all.cmd'); } else { touch(''.$dir2.'/grep_php_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/grep_php_all.php 2>&1 &';

file_put_contents(''.$dir2.'/grep_php_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/test_instance_all.php')) { unlink(''.$dir2.'/test_instance_all.php'); touch(''.$dir2.'/test_instance_all.php'); } else { touch(''.$dir2.'/test_instance_all.php'); }
file_put_contents(''.$dir2.'/test_instance_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/test_instance_all.cmd')) { unlink(''.$dir2.'/test_instance_all.cmd'); touch(''.$dir2.'/test_instance_all.cmd'); } else { touch(''.$dir2.'/test_instance_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/test_instance_all.php 2>&1 &';

file_put_contents(''.$dir2.'/test_instance_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/send_instance_all.php')) { unlink(''.$dir2.'/send_instance_all.php'); touch(''.$dir2.'/send_instance_all.php'); } else { touch(''.$dir2.'/send_instance_all.php'); }
file_put_contents(''.$dir2.'/send_instance_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/send_instance_all.cmd')) { unlink(''.$dir2.'/send_instance_all.cmd'); touch(''.$dir2.'/send_instance_all.cmd'); } else { touch(''.$dir2.'/send_instance_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/send_instance_all.php 2>&1 &';

file_put_contents(''.$dir2.'/send_instance_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/sendzip_instance_all.php')) { unlink(''.$dir2.'/sendzip_instance_all.php'); touch(''.$dir2.'/sendzip_instance_all.php'); } else { touch(''.$dir2.'/sendzip_instance_all.php'); }
file_put_contents(''.$dir2.'/sendzip_instance_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/sendzip_instance_all.cmd')) { unlink(''.$dir2.'/sendzip_instance_all.cmd'); touch(''.$dir2.'/sendzip_instance_all.cmd'); } else { touch(''.$dir2.'/sendzip_instance_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/sendzip_instance_all.php 2>&1 &';

file_put_contents(''.$dir2.'/sendzip_instance_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/unzip_instance_all.php')) { unlink(''.$dir2.'/unzip_instance_all.php'); touch(''.$dir2.'/unzip_instance_all.php'); } else { touch(''.$dir2.'/unzip_instance_all.php'); }
file_put_contents(''.$dir2.'/unzip_instance_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/unzip_instance_all.cmd')) { unlink(''.$dir2.'/unzip_instance_all.cmd'); touch(''.$dir2.'/unzip_instance_all.cmd'); } else { touch(''.$dir2.'/unzip_instance_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/unzip_instance_all.php 2>&1 &';

file_put_contents(''.$dir2.'/unzip_instance_all.cmd', $put0,FILE_APPEND);

///

if (file_exists(''.$dir2.'/changedocs_instance_all.php')) { unlink(''.$dir2.'/changedocs_instance_all.php'); touch(''.$dir2.'/changedocs_instance_all.php'); } else { touch(''.$dir2.'/changedocs_instance_all.php'); }
file_put_contents(''.$dir2.'/changedocs_instance_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/changedocs_instance_all.cmd')) { unlink(''.$dir2.'/changedocs_instance_all.cmd'); touch(''.$dir2.'/changedocs_instance_all.cmd'); } else { touch(''.$dir2.'/changedocs_instance_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/changedocs_instance_all.php 2>&1 &';

file_put_contents(''.$dir2.'/changedocs_instance_all.cmd', $put0,FILE_APPEND);


if (file_exists(''.$dir2.'/changedocs_instance_all1.php')) { unlink(''.$dir2.'/changedocs_instance_all1.php'); touch(''.$dir2.'/changedocs_instance_all1.php'); } else { touch(''.$dir2.'/changedocs_instance_all1.php'); }
file_put_contents(''.$dir2.'/changedocs_instance_all1.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/changedocs_instance_all1.cmd')) { unlink(''.$dir2.'/changedocs_instance_all1.cmd'); touch(''.$dir2.'/changedocs_instance_all1.cmd'); } else { touch(''.$dir2.'/changedocs_instance_all1.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/changedocs_instance_all1.php 2>&1 &';

file_put_contents(''.$dir2.'/changedocs_instance_all1.cmd', $put0,FILE_APPEND);

///

if (file_exists(''.$dir2.'/prepare_psftp_all.php')) { unlink(''.$dir2.'/prepare_psftp_all.php'); touch(''.$dir2.'/prepare_psftp_all.php'); } else { touch(''.$dir2.'/prepare_psftp_all.php'); }
file_put_contents(''.$dir2.'/prepare_psftp_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/prepare_psftp_all.cmd')) { unlink(''.$dir2.'/prepare_psftp_all.cmd'); touch(''.$dir2.'/prepare_psftp_all.cmd'); } else { touch(''.$dir2.'/prepare_psftp_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/prepare_psftp_all.php 2>&1 &';

file_put_contents(''.$dir2.'/prepare_psftp_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/delete_instance_all.php')) { unlink(''.$dir2.'/delete_instance_all.php'); touch(''.$dir2.'/delete_instance_all.php'); } else { touch(''.$dir2.'/delete_instance_all.php'); }
file_put_contents(''.$dir2.'/delete_instance_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/delete_instance_all.cmd')) { unlink(''.$dir2.'/delete_instance_all.cmd'); touch(''.$dir2.'/delete_instance_all.cmd'); } else { touch(''.$dir2.'/delete_instance_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/delete_instance_all.php 2>&1 &';

file_put_contents(''.$dir2.'/delete_instance_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/get_instance_all.php')) { unlink(''.$dir2.'/get_instance_all.php'); touch(''.$dir2.'/get_instance_all.php'); } else { touch(''.$dir2.'/get_instance_all.php'); }
file_put_contents(''.$dir2.'/get_instance_all.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
$put00='
if (file_exists(&#039;'.$dir2.'/data_notsend_all.txt&#039;)) { unlink(&#039;'.$dir2.'/data_notsend_all.txt&#039;); touch(&#039;'.$dir2.'/data_notsend_all.txt&#039;); } else { touch(&#039;'.$dir2.'/data_notsend_all.txt&#039;); }
if (file_exists(&#039;'.$dir2.'/accounts_good_all.txt&#039;)) { unlink(&#039;'.$dir2.'/accounts_good_all.txt&#039;); touch(&#039;'.$dir2.'/accounts_good_all.txt&#039;); } else { touch(&#039;'.$dir2.'/accounts_good_all.txt&#039;); }
if (file_exists(&#039;'.$dir2.'/accounts_bad_all.txt&#039;)) { unlink(&#039;'.$dir2.'/accounts_bad_all.txt&#039;); touch(&#039;'.$dir2.'/accounts_bad_all.txt&#039;); } else { touch(&#039;'.$dir2.'/accounts_bad_all.txt&#039;); }';
file_put_contents(''.$dir2.'/get_instance_all.php', html_entity_decode($put00, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
if (file_exists(''.$dir2.'/get_instance_all.cmd')) { unlink(''.$dir2.'/get_instance_all.cmd'); touch(''.$dir2.'/get_instance_all.cmd'); } else { touch(''.$dir2.'/get_instance_all.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/get_instance_all.php 2>&1 &';

file_put_contents(''.$dir2.'/get_instance_all.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/data_prepare.php')) { unlink(''.$dir2.'/data_prepare.php'); touch(''.$dir2.'/data_prepare.php'); } else { touch(''.$dir2.'/data_prepare.php'); }
file_put_contents(''.$dir2.'/data_prepare.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);

if (file_exists(''.$dir.'/data_prepare.cmd')) { unlink(''.$dir.'/data_prepare.cmd'); touch(''.$dir.'/data_prepare.cmd'); } else { touch(''.$dir.'/data_prepare.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/data_prepare.php 2>&1 &';

file_put_contents(''.$dir.'/data_prepare.cmd', $put0,FILE_APPEND);

if (file_exists(''.$dir2.'/accounts_prepare.php')) { unlink(''.$dir2.'/accounts_prepare.php'); touch(''.$dir2.'/accounts_prepare.php'); } else { touch(''.$dir2.'/accounts_prepare.php'); }
file_put_contents(''.$dir2.'/accounts_prepare.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);

if (file_exists(''.$dir.'/accounts_prepare.cmd')) { unlink(''.$dir.'/accounts_prepare.cmd'); touch(''.$dir.'/accounts_prepare.cmd'); } else { touch(''.$dir.'/accounts_prepare.cmd'); }
$put0='start /MIN php.exe '.$dir2.'/accounts_prepare.php 2>&1 &';

file_put_contents(''.$dir.'/accounts_prepare.cmd', $put0,FILE_APPEND);
///

if (file_exists(''.$dir2.'/unzip.php')) { unlink(''.$dir2.'/unzip.php'); touch(''.$dir2.'/unzip.php'); } else { touch(''.$dir2.'/unzip.php'); }
file_put_contents(''.$dir2.'/unzip.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
/////



/////////
$ip=file(''.$dir.'/publicips.txt');
$ip1=file_get_contents(''.$dir.'/publicips.txt');
$ip1=clean1($ip1);

$cmd=count($ip);

$put999='';
for($i=0;$i<$cmd;$i++)
{
	$ip[$i]=clean($ip[$i]);
	
	if (file_exists(''.$dir2.'/instance'.$i.'/')==FALSE) { mkdir(''.$dir2.'/instance'.$i.'/'); }
	$dir3=''.$dir2.'/instance'.$i.'';
	
	if (file_exists(''.$dir1.'/instance'.$i.'/')==FALSE) { mkdir(''.$dir1.'/instance'.$i.'/'); }
		
	
	/////KILL PHP COMMANDS/////
	if (file_exists(''.$dir3.'/kill_php.php')) { unlink(''.$dir3.'/kill_php.php'); touch(''.$dir3.'/kill_php.php'); } else { touch(''.$dir3.'/kill_php.php'); }
	file_put_contents(''.$dir3.'/kill_php.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	$put92='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo kill `pgrep php`"&#039;);';
	file_put_contents(''.$dir3.'/kill_php.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/kill_php.cmd')) { unlink(''.$dir3.'/kill_php.cmd'); touch(''.$dir3.'/kill_php.cmd'); } else { touch(''.$dir3.'/kill_php.cmd'); }
	$put7='start /MIN php.exe '.$dir3.'/kill_php.php 2>&1 &';
	file_put_contents(''.$dir3.'/kill_php.cmd', $put7,FILE_APPEND);
	
	
	$put16='pclose(popen("start /MIN php.exe '.$dir3.'/kill_php.php 2>&1 &", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/kill_php_all.php', html_entity_decode($put16, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////GREP PHP COMMANDS/////
	if (file_exists(''.$dir3.'/grep_php.php')) { unlink(''.$dir3.'/grep_php.php'); touch(''.$dir3.'/grep_php.php'); } else { touch(''.$dir3.'/grep_php.php'); }
	file_put_contents(''.$dir3.'/grep_php.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	$put92='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo pgrep php"&#039;);';
	file_put_contents(''.$dir3.'/grep_php.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/grep_php.cmd')) { unlink(''.$dir3.'/grep_php.cmd'); touch(''.$dir3.'/grep_php.cmd'); } else { touch(''.$dir3.'/grep_php.cmd'); }
	//$put7='start /MIN php.exe '.$dir3.'/grep_php.php && PAUSE';
	//$put7='cmd /K "php.exe '.$dir3.'/grep_php.php && timeout 3 /nobreak"';
	$put7='plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo pgrep php" && PAUSE';
	file_put_contents(''.$dir3.'/grep_php.cmd', $put7,FILE_APPEND);
	
	
	$put16='pclose(popen("start /MIN php.exe '.$dir3.'/grep_php.php 2>&1 &", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/grep_php_all.php', html_entity_decode($put16, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	/////TEST COMMANDS/////
	if (file_exists(''.$dir3.'/test_instance.php')) { unlink(''.$dir3.'/test_instance.php'); touch(''.$dir3.'/test_instance.php'); } else { touch(''.$dir3.'/test_instance.php'); }
	file_put_contents(''.$dir3.'/test_instance.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	$put92='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx -m '.$dir3.'/test_commands.txt&#039;);';
	file_put_contents(''.$dir3.'/test_instance.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/test_instance.cmd')) { unlink(''.$dir3.'/test_instance.cmd'); touch(''.$dir3.'/test_instance.cmd'); } else { touch(''.$dir3.'/test_instance.cmd'); }
	$put7='start /MIN php.exe '.$dir3.'/test_instance.php 2>&1 &';
	
	file_put_contents(''.$dir3.'/test_instance.cmd', $put7,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/test_commands.txt')) { unlink(''.$dir3.'/test_commands.txt'); touch(''.$dir3.'/test_commands.txt'); } else { touch(''.$dir3.'/test_commands.txt'); }
	
	$put16='pclose(popen("start /MIN php.exe '.$dir3.'/test_instance.php 2>&1 &", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/test_instance_all.php', html_entity_decode($put16, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////SEND COMMANDS/////
	if (file_exists(''.$dir3.'/send_instance.php')) { unlink(''.$dir3.'/send_instance.php'); touch(''.$dir3.'/send_instance.php'); } else { touch(''.$dir3.'/send_instance.php'); }
	file_put_contents(''.$dir3.'/send_instance.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	$put92='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx -m '.$dir3.'/send_commands.txt&#039;);';
	file_put_contents(''.$dir3.'/send_instance.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/send_instance.cmd')) { unlink(''.$dir3.'/send_instance.cmd'); touch(''.$dir3.'/send_instance.cmd'); } else { touch(''.$dir3.'/send_instance.cmd'); }
	$put7='start /MIN php.exe '.$dir3.'/send_instance.php 2>&1 &';
	
	file_put_contents(''.$dir3.'/send_instance.cmd', $put7);
	
	if (file_exists(''.$dir3.'/send_commands.txt')) { unlink(''.$dir3.'/send_commands.txt'); touch(''.$dir3.'/send_commands.txt'); } else { touch(''.$dir3.'/send_commands.txt'); }

	$put17='pclose(popen("start /MIN php.exe '.$dir3.'/send_instance.php 2>&1 &", "r"));
	sleep(5);';
	file_put_contents(''.$dir2.'/send_instance_all.php', html_entity_decode($put17, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////PREPARE SEND EMAIL PHP FILES COMMANDS/////
	if (file_exists(''.$dir3.'/prepare_send.php')) { unlink(''.$dir3.'/prepare_send.php'); touch(''.$dir3.'/prepare_send.php'); } else { touch(''.$dir3.'/prepare_send.php'); }
	file_put_contents(''.$dir3.'/prepare_send.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	$put92='system(&#039;psftp -batch -be '.$ip[$i].' -l vip -pw xxxxxxxxxx -b '.$dir3.'/prepare_send_commands.txt&#039;);';
	file_put_contents(''.$dir3.'/prepare_send.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/prepare_send.cmd')) { unlink(''.$dir3.'/prepare_send.cmd'); touch(''.$dir3.'/prepare_send.cmd'); } else { touch(''.$dir3.'/prepare_send.cmd'); }
	$put11='start /MIN php.exe '.$dir3.'/prepare_send.php 2>&1 &';
	
	file_put_contents(''.$dir3.'/prepare_send.cmd', $put11,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/prepare_send_commands.txt')) { unlink(''.$dir3.'/prepare_send_commands.txt'); touch(''.$dir3.'/prepare_send_commands.txt'); } else { touch(''.$dir3.'/prepare_send_commands.txt'); }
	
	$put14='pclose(popen("start /MIN php.exe '.$dir3.'/prepare_send.php 2>&1 &", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/prepare_send_all.php', html_entity_decode($put14, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////PREPARE PSFTP AND PLINK COMMANDS/////
	if (file_exists(''.$dir3.'/prepare_psftp.php')) { unlink(''.$dir3.'/prepare_psftp.php'); touch(''.$dir3.'/prepare_psftp.php'); } else { touch(''.$dir3.'/prepare_psftp.php'); }
	file_put_contents(''.$dir3.'/prepare_psftp.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	$put12='system(&#039;echo y | psftp '.$ip[$i].' -l vip -pw xxxxxxxxxx&#039;);';
	file_put_contents(''.$dir3.'/prepare_psftp.php', html_entity_decode($put12, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/prepare_psftp.cmd')) { unlink(''.$dir3.'/prepare_psftp.cmd'); touch(''.$dir3.'/prepare_psftp.cmd'); } else { touch(''.$dir3.'/prepare_psftp.cmd'); }
	$put13='cmd /K "php.exe '.$dir3.'/prepare_psftp.php && exit"';
	file_put_contents(''.$dir3.'/prepare_psftp.cmd', $put13,FILE_APPEND);
	

	$put15='pclose(popen("start /MIN php.exe '.$dir3.'/prepare_psftp.php", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/prepare_psftp_all.php', html_entity_decode($put15, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////SEND MAIN ZIP TO INSTANCES COMMANDS/////
	if (file_exists(''.$dir3.'/sendzip_instance.php')) { unlink(''.$dir3.'/sendzip_instance.php'); touch(''.$dir3.'/sendzip_instance.php'); } else { touch(''.$dir3.'/sendzip_instance.php'); }
	file_put_contents(''.$dir3.'/sendzip_instance.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	$put10='function addFolderToZip($dirs, $zipArchive, $zipdir = &#039;&#039;){ 
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
/////////////////////////////////
	

	$rootPath1=&#039;'.$dir1.'/instance'.$i.'/&#039;;
	$zipFileName1=&#039;'.$dir2.'/instance'.$i.'/main.zip&#039;;
	$zip1=new ZipArchive();
	$zip1->open($zipFileName1, ZipArchive::CREATE | ZipArchive::OVERWRITE);
	addFolderToZip($rootPath1."/", $zip1, $zipdir1=&#039;&#039;);
	$zip1->close();
	
	system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo rm -R '.$dirins.'/* && sudo hostnamectl set-hostname localhost"&#039;);
	system(&#039;(echo put '.$dir3.'/main.zip '.$dirins.'/main.zip && echo put '.$dir2.'/unzip.php '.$dirins.'/unzip.php) | psftp -batch '.$ip[$i].' -l vip -pw xxxxxxxxxx&#039;);
	system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo php '.$dirins.'/unzip.php && sudo rm -f '.$dirins.'/unzip.php"&#039;);';
	file_put_contents(''.$dir3.'/sendzip_instance.php', html_entity_decode($put10, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	
	if (file_exists(''.$dir3.'/sendzip_instance.cmd')) { unlink(''.$dir3.'/sendzip_instance.cmd'); touch(''.$dir3.'/sendzip_instance.cmd'); } else { touch(''.$dir3.'/sendzip_instance.cmd'); }
	$put11='start /MIN php.exe '.$dir3.'/sendzip_instance.php 2>&1 &';
	
	file_put_contents(''.$dir3.'/sendzip_instance.cmd', $put11,FILE_APPEND);
	
	$put15='pclose(popen("start /MIN php.exe '.$dir3.'/sendzip_instance.php", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/sendzip_instance_all.php', html_entity_decode($put15, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////CHANGE ALL DOCUMENTS (OFFER) INSTANCES COMMANDS/////
	if (file_exists(''.$dir3.'/changedocs_instance.php')) { unlink(''.$dir3.'/changedocs_instance.php'); touch(''.$dir3.'/changedocs_instance.php'); } else { touch(''.$dir3.'/changedocs_instance.php'); }
	file_put_contents(''.$dir3.'/changedocs_instance.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	$put92='system(&#039;psftp -batch -be '.$ip[$i].' -l vip -pw xxxxxxxxxx -b '.$dir3.'/changedocs_commands.txt&#039;);';
	file_put_contents(''.$dir3.'/changedocs_instance.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/changedocs_instance.cmd')) { unlink(''.$dir3.'/changedocs_instance.cmd'); touch(''.$dir3.'/changedocs_instance.cmd'); } else { touch(''.$dir3.'/changedocs_instance.cmd'); }
	$put11='start /MIN php.exe '.$dir3.'/changedocs_instance.php 2>&1 &';
	file_put_contents(''.$dir3.'/changedocs_instance.cmd', $put11,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/changedocs_commands.txt')) { unlink(''.$dir3.'/changedocs_commands.txt'); touch(''.$dir3.'/changedocs_commands.txt'); } else { touch(''.$dir3.'/changedocs_commands.txt'); }
	
	$put15='pclose(popen("start /MIN php.exe '.$dir3.'/changedocs_instance.php", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/changedocs_instance_all.php', html_entity_decode($put15, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	
	
	if (file_exists(''.$dir3.'/changedocs_instance1.php')) { unlink(''.$dir3.'/changedocs_instance1.php'); touch(''.$dir3.'/changedocs_instance1.php'); } else { touch(''.$dir3.'/changedocs_instance1.php'); }
	file_put_contents(''.$dir3.'/changedocs_instance1.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	$put92='system(&#039;psftp -batch -be '.$ip[$i].' -l vip -pw xxxxxxxxxx -b '.$dir3.'/changedocs_commands1.txt&#039;);';
	file_put_contents(''.$dir3.'/changedocs_instance1.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/changedocs_instance1.cmd')) { unlink(''.$dir3.'/changedocs_instance1.cmd'); touch(''.$dir3.'/changedocs_instance1.cmd'); } else { touch(''.$dir3.'/changedocs_instance1.cmd'); }
	$put11='start /MIN php.exe '.$dir3.'/changedocs_instance1.php 2>&1 &';
	file_put_contents(''.$dir3.'/changedocs_instance1.cmd', $put11,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/changedocs_commands1.txt')) { unlink(''.$dir3.'/changedocs_commands1.txt'); touch(''.$dir3.'/changedocs_commands1.txt'); } else { touch(''.$dir3.'/changedocs_commands1.txt'); }
	
	$put15='pclose(popen("start /MIN php.exe '.$dir3.'/changedocs_instance1.php", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/changedocs_instance_all1.php', html_entity_decode($put15, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////GET LEFT DATA FROM INSTANCES/////
	if (file_exists(''.$dir3.'/get_instance.php')) { unlink(''.$dir3.'/get_instance.php'); touch(''.$dir3.'/get_instance.php'); } else { touch(''.$dir3.'/get_instance.php'); }
	file_put_contents(''.$dir3.'/get_instance.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	$put92='system(&#039;psftp -batch -be '.$ip[$i].' -l vip -pw xxxxxxxxxx -b '.$dir3.'/get_instance_commands.txt&#039;);';
	file_put_contents(''.$dir3.'/get_instance.php', html_entity_decode($put92, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/get_instance.cmd')) { unlink(''.$dir3.'/get_instance.cmd'); touch(''.$dir3.'/get_instance.cmd'); } else { touch(''.$dir3.'/get_instance.cmd'); }
	$put11='start /MIN php.exe '.$dir3.'/get_instance.php 2>&1 &';
	
	file_put_contents(''.$dir3.'/get_instance.cmd', $put11,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/get_instance_commands.txt')) { unlink(''.$dir3.'/get_instance_commands.txt'); touch(''.$dir3.'/get_instance_commands.txt'); } else { touch(''.$dir3.'/get_instance_commands.txt'); }
	
	$put34='pclose(popen("start /MIN php.exe '.$dir3.'/get_instance.php 2>&1 &", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/get_instance_all.php', html_entity_decode($put34, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////UNZIP DOCUMENTS COMMANDS/////
	if (file_exists(''.$dir3.'/unzip_instance.php')) { unlink(''.$dir3.'/unzip_instance.php'); touch(''.$dir3.'/unzip_instance.php'); } else { touch(''.$dir3.'/unzip_instance.php'); }
	file_put_contents(''.$dir3.'/unzip_instance.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	$put8='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo php '.$dirins.'/unzip.php && sudo rm -f '.$dirins.'/unzip.php"&#039;);';
	file_put_contents(''.$dir3.'/unzip_instance.php', html_entity_decode($put8, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/unzip_instance.cmd')) { unlink(''.$dir3.'/unzip_instance.cmd'); touch(''.$dir3.'/unzip_instance.cmd'); } else { touch(''.$dir3.'/unzip_instance.cmd'); }
	$put9='start /MIN php.exe '.$dir3.'/unzip_instance.php 2>&1 &';
	
	file_put_contents(''.$dir3.'/unzip_instance.cmd', $put9,FILE_APPEND);
	
	$put23='pclose(popen("start /MIN php.exe '.$dir3.'/unzip_instance.php 2>&1 &", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/unzip_instance_all.php', html_entity_decode($put23, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	/////DELETE FOLDER INSTANCES/////
	if (file_exists(''.$dir3.'/delete_instance.php')) { unlink(''.$dir3.'/delete_instance.php'); touch(''.$dir3.'/delete_instance.php'); } else { touch(''.$dir3.'/delete_instance.php'); }
	file_put_contents(''.$dir3.'/delete_instance.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
	
	$put10='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo rm -R /var/www/html/*"&#039;);';
	file_put_contents(''.$dir3.'/delete_instance.php', html_entity_decode($put10, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	
	if (file_exists(''.$dir3.'/delete_instance.cmd')) { unlink(''.$dir3.'/delete_instance.cmd'); touch(''.$dir3.'/delete_instance.cmd'); } else { touch(''.$dir3.'/delete_instance.cmd'); }
	$put11='start /MIN php.exe '.$dir3.'/delete_instance.php 2>&1 &';
	
	file_put_contents(''.$dir3.'/delete_instance.cmd', $put11,FILE_APPEND);
	
	$put30='pclose(popen("start /MIN php.exe '.$dir3.'/delete_instance.php 2>&1 &", "r"));
	usleep(500000);';
	file_put_contents(''.$dir2.'/delete_instance_all.php', html_entity_decode($put30, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
	/////
	
	
	

	///////////
	///////////
	
	for($y=0;$y<$accinst;$y++)
	{
		
		if (file_exists(''.$dir1.'/instance'.$i.'/account'.$y.'/')==FALSE) { mkdir(''.$dir1.'/instance'.$i.'/account'.$y.'/'); }
		if (file_exists(''.$dir3.'/account'.$y.'/')==FALSE) { mkdir(''.$dir3.'/account'.$y.'/'); }
		
		file_put_contents(''.$dir1.'/instance'.$i.'/account'.$y.'/test.php', file_get_contents(''.$dir.'/template/test.php'));
		file_put_contents(''.$dir1.'/instance'.$i.'/account'.$y.'/send.php', file_get_contents(''.$dir.'/template/send.php'));
		full_copy(''.$dir.'/template/email/', ''.$dir1.'/instance'.$i.'/account'.$y.'/email/');
		/////

		/////TEST EMAIL COMMANDS CREATE/////
		$put6='sudo php '.$dirins.'/account'.$y.'/test.php > /dev/null 2>&1 &';
		file_put_contents(''.$dir3.'/test_commands.txt', $put6 . PHP_EOL,FILE_APPEND);
		
		file_put_contents(''.$dir3.'/account'.$y.'/test_account.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL);
		$put88='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo php '.$dirins.'/account'.$y.'/test.php > /dev/null 2>&1 &"&#039;);';
		file_put_contents(''.$dir3.'/account'.$y.'/test_account.php', html_entity_decode($put88, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
		
		$put89='start /MIN php.exe '.$dir3.'/account'.$y.'/test_account.php 2>&1 &';
		
		file_put_contents(''.$dir3.'/account'.$y.'/test_account.cmd', $put89 . PHP_EOL);
	
	
		/////SEND EMAIL COMMANDS CREATE/////
		$put7='sudo php '.$dirins.'/account'.$y.'/send.php > /dev/null 2>&1 &';
		file_put_contents(''.$dir3.'/send_commands.txt', $put7 . PHP_EOL,FILE_APPEND);
		
		file_put_contents(''.$dir3.'/account'.$y.'/send_account.php', html_entity_decode($put1, ENT_QUOTES) . PHP_EOL . PHP_EOL);
		$put88='system(&#039;plink -batch vip@'.$ip[$i].' -pw xxxxxxxxxx "sudo php '.$dirins.'/account'.$y.'/send.php > /dev/null 2>&1 &"&#039;);';
		file_put_contents(''.$dir3.'/account'.$y.'/send_account.php', html_entity_decode($put88, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
		
		$put89='start /MIN php.exe '.$dir3.'/account'.$y.'/send_account.php 2>&1 &';
		file_put_contents(''.$dir3.'/account'.$y.'/send_account.cmd', $put89 . PHP_EOL);
		
		/////CHANGE DOCUMENTS COMMANDS CREATE/////
		$put10='put '.$dir.'/template/email/froms.txt '.$dirins.'/account'.$y.'/email/froms.txt && put '.$dir.'/template/email/subjects.txt '.$dirins.'/account'.$y.'/email/subjects.txt && put '.$dir.'/template/email/img1.txt '.$dirins.'/account'.$y.'/email/img1.txt && put '.$dir.'/template/email/img2.txt '.$dirins.'/account'.$y.'/email/img2.txt && put '.$dir.'/template/email/img3.txt '.$dirins.'/account'.$y.'/email/img3.txt && put '.$dir.'/template/email/links1.txt '.$dirins.'/account'.$y.'/email/links1.txt && put '.$dir.'/template/email/links2.txt '.$dirins.'/account'.$y.'/email/links2.txt && put '.$dir.'/template/email/links3.txt '.$dirins.'/account'.$y.'/email/links3.txt';
		file_put_contents(''.$dir3.'/changedocs_commands.txt', $put10 . PHP_EOL,FILE_APPEND);
		
		$put10='put '.$dir.'/template/email/subjects.txt '.$dirins.'/account'.$y.'/email/subjects.txt';
		file_put_contents(''.$dir3.'/changedocs_commands1.txt', $put10 . PHP_EOL,FILE_APPEND);
		
		/////PREPARE SEND EMAIL PHP FILES TO INSTANCES/////
		$put10='put '.$dir.'/template/test.php '.$dirins.'/account'.$y.'/test.php > /dev/null 2>&1 &
		put '.$dir.'/template/send.php '.$dirins.'/account'.$y.'/send.php > /dev/null 2>&1 &';
		file_put_contents(''.$dir3.'/prepare_send_commands.txt', clean($put10) . PHP_EOL,FILE_APPEND);


		/////GET LEFT DATA FROM INSTANCES/////
		$put10='get '.$dirins.'/account'.$y.'/data.txt '.$dir3.'/account'.$y.'/data_notsend.txt > /dev/null 2>&1 &
		get '.$dirins.'/account'.$y.'/break.txt '.$dir3.'/account'.$y.'/break.txt > /dev/null 2>&1 &';
		file_put_contents(''.$dir3.'/get_instance_commands.txt', $put10 . PHP_EOL,FILE_APPEND);
		
	}

	
}






/////
$put998='for($i1=0;$i1<'.$cmd.';$i1++)
{
	for($y1=0;$y1<'.$accinst.';$y1++)
	{
		if(file_exists(&#039;'.$dir2.'/instance&#039;.$i1.&#039;/account&#039;.$y1.&#039;/data_notsend.txt&#039;))
		{
			$get1=file_get_contents(&#039;'.$dir2.'/instance&#039;.$i1.&#039;/account&#039;.$y1.&#039;/data_notsend.txt&#039;);
			file_put_contents(&#039;'.$dir2.'/data_notsend_all.txt&#039;, $get1,FILE_APPEND);
		}
		if(file_exists(&#039;'.$dir2.'/instance&#039;.$i1.&#039;/account&#039;.$y1.&#039;/break.txt&#039;)==FALSE)
		{
			$get1=file_get_contents(&#039;'.$dir2.'/instance&#039;.$i1.&#039;/account&#039;.$y1.&#039;/account.txt&#039;);
			file_put_contents(&#039;'.$dir2.'/accounts_good_all.txt&#039;, $get1,FILE_APPEND);
		}
		if(file_exists(&#039;'.$dir2.'/instance&#039;.$i1.&#039;/account&#039;.$y1.&#039;/break.txt&#039;))
		{
			$get1=file_get_contents(&#039;'.$dir2.'/instance&#039;.$i1.&#039;/account&#039;.$y1.&#039;/account.txt&#039;);
			file_put_contents(&#039;'.$dir2.'/accounts_bad_all.txt&#039;, $get1,FILE_APPEND);
		}
	}
}';
file_put_contents(''.$dir2.'/get_instance_all.php', 'sleep(80);' . PHP_EOL,FILE_APPEND);
file_put_contents(''.$dir2.'/get_instance_all.php', html_entity_decode($put998, ENT_QUOTES) . PHP_EOL,FILE_APPEND);


$put999='$put1=file_get_contents(&#039;'.$dir2.'/data_notsend_all.txt&#039;);
$put2=file_get_contents(&#039;'.$dir.'/data_left_all.txt&#039;);
file_put_contents(&#039;'.$dir.'/data_nextsend_all.txt&#039;, $put1 . PHP_EOL);
file_put_contents(&#039;'.$dir.'/data_nextsend_all.txt&#039;, $put2,FILE_APPEND);
$put2=file_get_contents(&#039;'.$dir.'/data_nextsend_all.txt&#039;);
$put2=clean1($put2);
file_put_contents(&#039;'.$dir.'/data_nextsend_all.txt&#039;, $put2);

$put3=file_get_contents(&#039;'.$dir2.'/accounts_good_all.txt&#039;);
$put4=file_get_contents(&#039;'.$dir.'/accounts_left_all.txt&#039;);
file_put_contents(&#039;'.$dir.'/accounts_nextsend_all.txt&#039;, $put3 . PHP_EOL);
file_put_contents(&#039;'.$dir.'/accounts_nextsend_all.txt&#039;, $put4,FILE_APPEND);
$put2=file_get_contents(&#039;'.$dir.'/accounts_nextsend_all.txt&#039;);
$put2=clean1($put2);
file_put_contents(&#039;'.$dir.'/accounts_nextsend_all.txt&#039;, $put2);';

file_put_contents(''.$dir2.'/get_instance_all.php', html_entity_decode($put999, ENT_QUOTES) . PHP_EOL,FILE_APPEND);


//////////DATA PREPARE PHP FILE//////////
$dataprepare='

$dataacc='.$dataacc.';
$accinst='.$accinst.';

$dir=&#039;'.dirname(__FILE__).'&#039;;

$dir2=&#039;&#039;.$dir.&#039;/prepare&#039;;
$dir1=&#039;&#039;.$dir.&#039;/instances&#039;;

//if(file_exists(&#039;&#039;.$dir.&#039;/data_left_all.txt&#039;)==FALSE || file_get_contents(&#039;&#039;.$dir.&#039;/data_left_all.txt&#039;)==&#039;&#039;)
//{
	file_put_contents(&#039;&#039;.$dir.&#039;/data_left_all.txt&#039;, file_get_contents(&#039;&#039;.$dir.&#039;/data_all.txt&#039;));
//}

$ip=file(&#039;&#039;.$dir.&#039;/publicips.txt&#039;);
$cnt=count($ip);

for($i=0;$i<$cnt;$i++)
{
	$data=file(&#039;&#039;.$dir.&#039;/data_left_all.txt&#039;);
	
	$a=0;
	
	for($y=0;$y<$accinst;$y++)
	{
		
		
		if($output1=array_slice($data, $a, $dataacc))
		{
			file_put_contents(&#039;&#039;.$dir1.&#039;/instance&#039;.$i.&#039;/account&#039;.$y.&#039;/data.txt&#039;, $output1);
			unset($output1);
		}
		else
		{
			break 2;
		}
		
		$a=$a+$dataacc;
		
	}
	$output2=array_slice($data, $a);
	file_put_contents(&#039;&#039;.$dir.&#039;/data_left_all.txt&#039;, $output2);
	unset($output2);
	unset($data);
}
	

$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }';

file_put_contents(''.$dir2.'/data_prepare.php', html_entity_decode($dataprepare, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
////////	


//////////ACCOUNTS PREPARE PHP FILE//////////
$accountsprepare='$dataacc='.$dataacc.';
$accinst='.$accinst.';
$acc='.$acc.';

$dir=&#039;'.dirname(__FILE__).'&#039;;

$dir1=&#039;'.$dirins.'&#039;;
$dir2=&#039;&#039;.$dir.&#039;/prepare&#039;;
$dir3=&#039;&#039;.$dir.&#039;/instances&#039;;

//if(file_exists(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;)==FALSE || file_get_contents(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;)==&#039;&#039;)
//{
	file_put_contents(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;, file_get_contents(&#039;&#039;.$dir.&#039;/accounts_all.txt&#039;));
//}

$data=file(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;);
$cnt=count($data);
unlink(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;);
$m5=file(&#039;&#039;.$dir.&#039;/template/email/proxy.txt&#039;);

for($i=0;$i<$cnt;$i++)
{
	$data[$i]=clean($data[$i]);
	
	if(preg_match(&#039;/- proxy/&#039;, $data[$i])==FALSE)
	{
		$proxy=$m5[mt_rand(0, count($m5)-1)];
		$proxy=clean($proxy);
		$put=&#039;&#039;.$data[$i].&#039; - &#039;.$proxy.&#039;&#039;;
		file_put_contents(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;, $put . PHP_EOL,FILE_APPEND);
	}
	else
	{
		file_put_contents(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;, $data[$i] . PHP_EOL,FILE_APPEND);
	}
}
unset($data);
unset($m5);


$ip=file(&#039;&#039;.$dir.&#039;/publicips.txt&#039;);
$cnt=count($ip);

for($i=0;$i<$cnt;$i++)
{
	
	$data=file(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;);
	$a=0;
	
	for($y=0;$y<$accinst;$y++)
	{
		if($output1=array_slice($data, $a, $acc))
		{
			file_put_contents(&#039;&#039;.$dir3.&#039;/instance&#039;.$i.&#039;/account&#039;.$y.&#039;/account.txt&#039;, $output1);
			file_put_contents(&#039;&#039;.$dir2.&#039;/instance&#039;.$i.&#039;/account&#039;.$y.&#039;/account.txt&#039;, $output1);
			unset($output1);
		}
		else
		{
			break 2;
		}
		
		$a=$a+$acc;
	}
	$output2=array_slice($data, $a);
	file_put_contents(&#039;&#039;.$dir.&#039;/accounts_left_all.txt&#039;, $output2);
	unset($output2);
	unset($data);
}


$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit();';

file_put_contents(''.$dir2.'/accounts_prepare.php', html_entity_decode($accountsprepare, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
////////

//////////UNZIP PHP FILE//////////
$unzipprepare='$zip=new ZipArchive; 

if ($zip->open(&#039;'.$dirins.'/main.zip&#039;) === TRUE) 
{ 
	$zip->extractTo(&#039;'.$dirins.'/&#039;); 
	$zip->close(); 
} 
unlink(&#039;'.$dirins.'/main.zip&#039;);

$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit();';

file_put_contents(''.$dir2.'/unzip.php', html_entity_decode($unzipprepare, ENT_QUOTES) . PHP_EOL,FILE_APPEND);
///////////////////////////	
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit();
