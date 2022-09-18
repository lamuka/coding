<?php


function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}



/////////////////////	
//$a=file_get_contents(''.dirname(__FILE__).'/mihaauth.php');
foreach($_POST as $post)
{
	if(!empty($post))
	{
		$set=1;
		break;
	}
}

if(!empty($set))
{
	if(file_exists(''.dirname(__FILE__).'/bottest.php')==FALSE) { touch(''.dirname(__FILE__).'/bottest.php'); } else {unlink(''.dirname(__FILE__).'/bottest.php'); touch(''.dirname(__FILE__).'/bottest.php'); }
	
	$fileget=file(''.dirname(__FILE__).'/DataBot.php');
	
	foreach($fileget as $file)
	{
	
		if(preg_match('/const URLMIRROR .*/', $file))
		{
			if(!empty($_POST['privip']))
			{
				$privip=clean($_POST['privip']); // зеркало
			
				$file=preg_replace('/const URLMIRROR .*/', 'const URLMIRROR = "'.$privip.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#privateip"\)\.val.*/', '$("#privateip").val("'.$privip.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const URLMIRROR1.*/', $file))
		{
			if(!empty($_POST['privip1']))
			{
				$privip1=clean($_POST['privip1']); // зеркало
	
				$file=preg_replace('/const URLMIRROR1.*/', 'const URLMIRROR1 = "'.$privip1.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#privateip1"\)\.val.*/', '$("#privateip1").val("'.$privip1.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const URLCASINO.*/', $file))
		{
			if(!empty($_POST['ipnum']))
			{
				$ipnum=clean($_POST['ipnum']); // URL данные казино
				
				$file=preg_replace('/const URLCASINO.*/', 'const URLCASINO = "'.$ipnum.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#ipsnumber"\)\.val.*/', '$("#ipsnumber").val("'.$ipnum.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const CHATIDADMIN.*/', $file))
		{
			if(!empty($_POST['group']))
			{
				$group=clean($_POST['group']); // указать главного админа
	
				$file=preg_replace('/const CHATIDADMIN.*/', 'const CHATIDADMIN = "'.$group.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#resourcegroup"\)\.val.*/', '$("#resourcegroup").val("'.$group.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const REFRESHCASINO.*/', $file))
		{
			if(!empty($_POST['uname']))
			{
				$uname=clean($_POST['uname']); // частота обновления данных
	
				$file=preg_replace('/const REFRESHCASINO.*/', 'const REFRESHCASINO = '.$uname.';', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#username"\)\.val.*/', '$("#username").val("'.$uname.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const ADMINUSERNAMES.*/', $file))
		{
			if(!empty($_POST['upass']))
			{
				$upass=clean($_POST['upass']); // добавить администратора
			
				if(preg_match('/^@/', $upass))
				{
					$upass=preg_replace('/^@/', '', $upass);
				}
				
				$file=preg_replace('/const ADMINUSERNAMES.*/', 'const ADMINUSERNAMES = "'.$upass.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#userpassword"\)\.val.*/', '$("#userpassword").val("'.$upass.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const COUNTERLIMIT.*/', $file))
		{
			if(!empty($_POST['prpass']))
			{
				$prpass=clean($_POST['prpass']); // попытки
	
				$file=preg_replace('/const COUNTERLIMIT.*/', 'const COUNTERLIMIT = '.$prpass.';', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#proxypassword"\)\.val.*/', '$("#proxypassword").val("'.$prpass.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const REFRESHTIME.*/', $file))
		{
			if(!empty($_POST['prport']))
			{
				$prport=clean($_POST['prport']); // частота нажатия на кнопку Хочу больше билетов
	
				$file=preg_replace('/const REFRESHTIME.*/', 'const REFRESHTIME = '.$prport.';', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#proxyport"\)\.val.*/', '$("#proxyport").val("'.$prport.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const URLCHANNEL.*/', $file))
		{
			if(!empty($_POST['instname']))
			{
				$instname=clean($_POST['instname']); //ссылка на канал
	
				$file=preg_replace('/const URLCHANNEL.*/', 'const URLCHANNEL = "'.$instname.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#instancename"\)\.val.*/', '$("#instancename").val("'.$instname.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const URLGROUP.*/', $file))
		{
			if(!empty($_POST['mainip']))
			{
				$mainip=clean($_POST['mainip']); // ссыка на группу
	
				$file=preg_replace('/const URLGROUP.*/', 'const URLGROUP = "'.$mainip.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#mainserverip"\)\.val.*/', '$("#mainserverip").val("'.$mainip.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const URLOFCHANNEL.*/', $file))
		{
			if(!empty($_POST['urloffic']))
			{
				$urloffic=clean($_POST['urloffic']); // ссылка-приглашение на официальный канал 
	
				$file=preg_replace('/const URLOFCHANNEL.*/', 'const URLOFCHANNEL = "'.$urloffic.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#urlofficial"\)\.val.*/', '$("#urlofficial").val("'.$urloffic.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/const URLDOWNLOAD.*/', $file))
		{
			if(!empty($_POST['urldown']))
			{
				$urldown=clean($_POST['urldown']); // ссылка для скачивания приложения для Android
	
				$file=preg_replace('/const URLDOWNLOAD.*/', 'const URLDOWNLOAD = "'.$urldown.'";', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#urldownload"\)\.val.*/', '$("#urldownload").val("'.$urldown.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
		}
		elseif(preg_match('/protected.*/', $file))
		{
			if(!empty($_POST['botchange']) && !empty($_POST['prname']))
			{
				$prname=clean($_POST['prname']); // токен
	
				$file=preg_replace('/protected.*/', 'protected $token = "'.$prname.'"; //token', $file);
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
				//$a=preg_replace('/\$\("#urldownload"\)\.val.*/', '$("#urldownload").val("'.$urldown.'")', $a);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
			}
			
		}
		else
		{
			file_put_contents(''.dirname(__FILE__).'/bottest.php', $file,FILE_APPEND);
		}
	
	}	
		
		
	if(!empty($_POST['webhookname']) && !empty($_POST['botu']) && !empty($_POST['prname']))
	{
		///////////Set webhook//////////////
	
		$botu=clean($_POST['botu']);  //URL бота
		$prname=clean($_POST['prname']); // токен
		
		//$a=preg_replace('/\$\("#proxyname"\)\.val.*/', '$("#proxyname").val("'.$prname.'")', $a);
		
		$boturl='https://api.telegram.org/bot'.$prname.'/setWebhook?url='.$botu.'&max_connections=100';
		$result = file_get_contents($boturl);
		//$a=preg_replace('/\$\("#boturl"\)\.val.*/', '$("#boturl").val("'.$botu.'")', $a);
		
		
	}
	
	
	if(!empty($_POST['webhookdelete']) && !empty($_POST['prname']))
	{
		///////////Delete webhook//////////////
		$prname=clean($_POST['prname']); // токен
		
		$boturl='https://api.telegram.org/bot'.$prname.'/deleteWebhook?drop_pending_updates=true';
		$result = file_get_contents($boturl);
		
		//$a=preg_replace('/\$\("#proxyname"\)\.val.*/', '$("#proxyname").val("'.$prname.'")', $a);
		
	}
	
	
	file_put_contents(''.dirname(__FILE__).'/DataBot.php', file_get_contents(''.dirname(__FILE__).'/bottest.php'));
	unlink(''.dirname(__FILE__).'/bottest.php');

}



header('Location: AdminBot.php');

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset($$var); }

exit;