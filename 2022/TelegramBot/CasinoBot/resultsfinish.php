<?php


set_time_limit(0);

if(file_exists(''.dirname(__FILE__).'/resultsfinish.txt'))
{
	include_once(''.dirname(__FILE__).'/DataBot.php');
	
	$bot=new DataBot();
	
	$chatidadmin=$bot->chatidadmin;

	$textadmin='<b>Уведомление победителей успешно началось!</b>';
	
	$bot->api->sendMessage([
	'chat_id' => $chatidadmin,
	'text' => $textadmin,
	//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change_results']]),
	//'disable_notification' => TRUE,
	//'disable_web_page_preview' => TRUE,
	'parse_mode'=> "HTML"
	]);
	
	
	$con_sql2=$bot->cmd_sql();
	
	$channelid=$bot->mainchannel();
	
	
	
	$tabservicelottery='tabservicelottery';
	$tablottery='tablottery';
	$tabadminchange='tabadminchange';
	$tabserviceadmin='tabserviceadmin';
	$tabusers='tabusers';
	$tabcasinousers='tabcasinousers';
	$tablotteryusers='tablotteryusers';
	$tabticketsall='tabticketsall';
	$tabresults='tabresults';
	$tabresultsreserve='tabresultsreserve';
	$tabhistorylottery='tabhistorylottery';
	$tabtest='tabtest';
	$tabtest1='tabtest1';
	$tabtest2='tabtest2';
	
	$tabtestfake='tabtestfake';
	$tabtest1fake='tabtest1fake';
	$tabtest2fake='tabtest2fake';
	$tabresultsfake='tabresultsfake';
	$tabresultsreservefake='tabresultsreservefake';
	
	
	$query4=mysqli_query($con_sql2, 'SELECT startdate, messid, lotteryname, photos, topplaces, fakeplaces  FROM '.$tablottery.'');
	usleep(250000);
	$con4=mysqli_num_rows($query4);
	
	for($i4=0;$i4<$con4;$i4++)
	{
		mysqli_data_seek($query4, $i4);
		$row4[$i4]=mysqli_fetch_row($query4);
	}
	
	$startdate=$row4[0][0];
	$messageidchannel=$row4[0][1];
	$lotteryname=$row4[0][2];
	$photo=$row4[0][3];
	$topplaces=$row4[0][4];
	$fakeplacess=$row4[0][5];

	$resultsurl=file_get_contents(''.dirname(__FILE__).'/resultsfinish.txt');

	////////////////////////USERS///////////////////////
	$query=mysqli_query($con_sql2, 'SELECT chatid, username FROM '.$tablotteryusers.'');
	usleep(250000);
	$con=mysqli_num_rows($query);
	
	$row=[];
	
	for($i=0;$i<$con;$i++)
	{
		mysqli_data_seek($query, $i);
		$row[$i]=mysqli_fetch_row($query);
	
	
		$chatidlotteryuser=$row[$i][0];
		$usernamelotteryuser=$row[$i][1];
		
		if($bot->cmd_sql_searchchatidtable($chatidlotteryuser, $tabresults))
		{
			
			$query9=mysqli_query($con_sql2, 'SELECT place FROM '.$tabresults.' WHERE chatid="'.$chatidlotteryuser.'"');
			usleep(250000);
			$con9=mysqli_num_rows($query9);
			
			$row9=[];
			
			for($i9=0;$i9<$con9;$i9++)
			{
				mysqli_data_seek($query9, $i9);
				$row9[$i9]=mysqli_fetch_row($query9);
			}
	
			$placelotteryuser=$row9[0][0];
	
	
			$textuser='Розыгрыш "'.$lotteryname.'" завершен!'.PHP_EOL.''.PHP_EOL.'<b>Поздравляю! Вы заняли '.$placelotteryuser.' место!</b>'.PHP_EOL.''.PHP_EOL.'В течение 48 часов с Вами свяжутся, написав в личные сообщения. Пожалуйста, не меняйте Ваш юзернейм в Telegram в это время.'.PHP_EOL.''.PHP_EOL.'Посмотреть результаты розыгрыша Вы можете по ссылке - '.$resultsurl.'';
			
			$bot->api->sendMessage([
			'chat_id' => $chatidlotteryuser,
			'text' => $textuser,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
		}
		else
		{
			if(!empty($resultsurl))
			{
				$textuser='Розыгрыш "'.$lotteryname.'" завершен! К сожалению, Вы не заняли призового места. Не стоит огорчаться, впереди еще много розыгрышей, и в следующий раз Вам обязательно повезет!😉'.PHP_EOL.''.PHP_EOL.'Посмотреть результаты розыгрыша Вы можете по ссылке - '.$resultsurl.'';
				
				$bot->api->sendMessage([
				'chat_id' => $chatidlotteryuser,
				'text' => $textuser,
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				$textuser='<b>Розыгрыш</b> "'.$lotteryname.'" <b>был завершен!</b>'.PHP_EOL.''.PHP_EOL.'К сожалению, в розыгрыше нет победителей!';
				
				$bot->api->sendMessage([
				'chat_id' => $chatidlotteryuser,
				'text' => $textuser,
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
		}
		
		$tabrefer='tabrefer'.$chatidlotteryuser.'';
		$tabrefers='tabrefers'.$chatidlotteryuser.'';
		$tabserviceuser='tabserviceuser'.$chatidlotteryuser.'';
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabrefer.'');
		usleep(50000);
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabrefers.'');
		usleep(50000);
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceuser.'');
		usleep(50000);
	
	}
	////////////////////////END USERS///////////////////////


	//////////////////////ADMINS///////////////////
	$con_sql2=$bot->cmd_sql();
	
	if(!empty($resultsurl))
	{
		$textfinish='👇<b>Результаты розыгрыша</b> "'.$lotteryname.'"!!👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
	
		
		$query=mysqli_query($con_sql2, 'SELECT chatid, firstname, lastname, username, tickets, place FROM '.$tabresults.' ORDER BY place + 0 ASC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
			
			$chatid=$row[$i][0];
			$firstname=$row[$i][1];
			$lastname=$row[$i][2];
			$username=$row[$i][3];
			$ticket=$row[$i][4];
			$place=$row[$i][5];
			
			$lenfirstname=strlen($firstname);
			$lenfio=$lenfirstname;
			
			if(!empty($lastname))
			{
				$lenlastname=strlen($lastname);
				$lenfio=$lenfirstname+$lenlastname+1;
			}
			
			$lenusername=0;
			
			if(!empty($username))
			{
				$lenusername=strlen($username);
			}
			
			
			
			if(empty($chatid))
			{
				$putuser=$username;
				
				$text=''.$place.' место - '.$putuser.', билет '.$ticket.'';
			}
			elseif(empty($lenusername))
			{
				$putuser=$firstname;
				
				if(!empty($lastname))
				{
					$putuser=''.$firstname.' '.$lastname.'';
				}
				
				$text=''.$place.' место - <a href="tg://user?id='.$chatid.'">'.$putuser.'</a>, билет '.$ticket.'';
			}
			elseif($lenusername<$lenfio)
			{
				$putuser=$username;
				
				$text=''.$place.' место - '.$putuser.', билет '.$ticket.'';
			}
			elseif($lenusername>$lenfio)
			{
				$putuser=$firstname;
				
				if(!empty($lastname))
				{
					$putuser=''.$firstname.' '.$lastname.'';
				}
				
				$text=''.$place.' место - <a href="tg://user?id='.$chatid.'">'.$putuser.'</a>, билет '.$ticket.'';
				
			}
			elseif($lenusername==$lenfio)
			{
				$putuser=$username;
				
				$text=''.$place.' место - '.$putuser.', билет '.$ticket.'';
			}
			
			
			
			$textfinish=$textfinish . ''.$text.''.PHP_EOL.'';
			
			
			if(strlen($textfinish)>3500 && strlen($textfinish)<4000)
			{
				if(preg_match('/,/', DataBot::ADMINUSERNAMES))
				{
					$alldata=explode(',', DataBot::ADMINUSERNAMES);
				}
				else
				{
					$alldata=[];
					$alldata[]=DataBot::ADMINUSERNAMES;
				}
				
				
				if(preg_match('/'.$chatidadmin.'/', DataBot::ADMINUSERNAMES))
				{
					$a=1;
				}
				
				
				foreach($alldata as $data)
				{							
					$chatidadm=$data;
					
					$bot->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $textfinish,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(250000);
					
				}
				
				if(empty($a))
				{
					$bot->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $textfinish,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(250000);
				}
				else
				{
					unset($a);
				}
				
				$textfinish="";
			}
		}
		
		if(!empty($textfinish))
		{
			if(preg_match('/,/', DataBot::ADMINUSERNAMES))
			{
				$alldata=explode(',', DataBot::ADMINUSERNAMES);
			}
			else
			{
				$alldata=[];
				$alldata[]=DataBot::ADMINUSERNAMES;
			}
			
			
			if(preg_match('/'.$chatidadmin.'/', DataBot::ADMINUSERNAMES))
			{
				$a=1;
			}
			
			foreach($alldata as $data)
			{							
				$chatidadm=$data;
				
				$bot->api->sendMessage([
				'chat_id' => $chatidadm,
				'text' => $textfinish,
				//'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(250000);
				
				if(empty($a))
				{
					$bot->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $textfinish,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(250000);
				}
				else
				{
					unset($a);
				}
				
			}
		}
		
		$textadmmain='<b>Поздравляю с успешным завершением розыгрыша</b> "'.$lotteryname.'"!'.PHP_EOL.'Все участники розыгрыша и администраторы уведомлены о результатах.'.PHP_EOL.''.PHP_EOL.'';
		
		$bot->api->sendMessage([
		'chat_id' => $chatidadmin,
		'text' => $textfinish,
		//'reply_markup' => json_encode($this->keyboards['default_admin']),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(250000);
		////////////////////////END ADMINS///////////////////////	
	
	
	
		/////////////////////SAVE TO HISTORY//////////////////////
		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabhistorylottery.' LIKE '.$tablottery.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabhistorylottery.' (channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos) SELECT channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos FROM '.$tablottery.'');
		usleep(250000);
		
		$query=mysqli_query($con_sql2, 'SELECT id FROM '.$tabhistorylottery.' ORDER BY id DESC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		$row=[];
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$historyresultsid=$row[0][0];
		$tabhistoryresults='tabhistoryresults'.$historyresultsid.'';
		
		if (file_exists(''.dirname(__FILE__).'/history/')==FALSE) { mkdir(''.dirname(__FILE__).'/history/'); }
		
		file_put_contents(''.dirname(__FILE__).'/history/lotterytext'.$historyresultsid.'.txt', $lotterytext);
		
		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabhistoryresults.' LIKE '.$tabresults.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabhistoryresults.' (chatid, firstname, lastname, username, status, tickets, place) SELECT chatid, firstname, lastname, username, status, tickets, place FROM '.$tabresults.' ORDER BY place + 0 ASC');
		/////////////////////END SAVE TO HISTORY//////////////////////
	}
	else
	{
		$textadmin='<b>Розыгрыш</b> "'.$lotteryname.'" <b>был завершен!</b>'.PHP_EOL.''.PHP_EOL.'К сожалению, в розыгрыше нет победителей!';
		
		if(preg_match('/,/', DataBot::ADMINUSERNAMES))
		{
			$alldata=explode(',', DataBot::ADMINUSERNAMES);
		}
		else
		{
			$alldata=[];
			$alldata[]=DataBot::ADMINUSERNAMES;
		}
		
		if(preg_match('/'.$chatidadmin.'/', DataBot::ADMINUSERNAMES))
		{
			$a=1;
		}
		
		foreach($alldata as $data)
		{							
			$chatidadm=$data;
			
			$bot->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textadmin,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(250000);
			
		}
		
		if(empty($a))
		{
			$bot->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textadmin,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(250000);
		}
		else
		{
			unset($a);
		}
		/////////////////////SAVE TO HISTORY//////////////////////
		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabhistorylottery.' LIKE '.$tablottery.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabhistorylottery.' (channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos) SELECT channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos FROM '.$tablottery.'');
		usleep(250000);
	}
		
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabreserveservicelottery.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tablottery.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresults.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsreserve.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsfake.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsreservefake.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest1.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest2.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtestfake.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest1fake.'');
	usleep(250000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest2fake.'');
	usleep(250000);
	
	
	$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabserviceuser%"');
	$con=mysqli_num_rows($query);
		
	for($i=0;$i<$con;$i++)
	{
		mysqli_data_seek($query, $i);
		$row[$i]=mysqli_fetch_row($query);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$row[$i][0].'');
		usleep(250000);	
	}
	
	
	
	$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabtempuser%"');
	$con=mysqli_num_rows($query);
		
	for($i=0;$i<$con;$i++)
	{
		mysqli_data_seek($query, $i);
		$row[$i]=mysqli_fetch_row($query);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$row[$i][0].'');
		usleep(250000);	
	}
	
	
	$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabtempusererr%"');
	$con=mysqli_num_rows($query);
		
	for($i=0;$i<$con;$i++)
	{
		mysqli_data_seek($query, $i);
		$row[$i]=mysqli_fetch_row($query);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$row[$i][0].'');
		usleep(250000);	
	}
	
	
	$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabrefer%"');
	$con=mysqli_num_rows($query);
		
	for($i=0;$i<$con;$i++)
	{
		mysqli_data_seek($query, $i);
		$row[$i]=mysqli_fetch_row($query);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$row[$i][0].'');
		usleep(250000);	
	}
	
	
	if(file_exists(''.dirname(__FILE__).'/statistics.txt')==FALSE)
	{
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tablotteryusers.'');
		usleep(250000);
	
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabticketsall.'');
		usleep(250000);
		
		if(file_exists(''.dirname(__FILE__).'/resultsfinish.txt'))
		{
			unlink(''.dirname(__FILE__).'/resultsfinish.txt');
			usleep(250000);
		}
	}
	
	
	array_map('unlink', glob(''.dirname(__FILE__).'/include*.php'));
	usleep(500000);

	if(file_exists(''.dirname(__FILE__).'/lotterytext.txt'))
	{
		unlink(''.dirname(__FILE__).'/lotterytext.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
	{
		unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/adminlottery.txt'))
	{
		unlink(''.dirname(__FILE__).'/adminlottery.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/resultsfirst.txt'))
	{
		unlink(''.dirname(__FILE__).'/resultsfirst.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/resultsgenerate.txt'))
	{
		unlink(''.dirname(__FILE__).'/resultsgenerate.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/resultsfake.txt'))
	{
		unlink(''.dirname(__FILE__).'/resultsfake.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/modelling.txt'))
	{
		unlink(''.dirname(__FILE__).'/modelling.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/messidmailing.txt'))
	{
		unlink(''.dirname(__FILE__).'/messidmailing.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/pid1.txt'))
	{
		unlink(''.dirname(__FILE__).'/pid1.txt');
	}
	usleep(250000);
	
	if(file_exists(''.dirname(__FILE__).'/chatiduser.txt'))
	{
		unlink(''.dirname(__FILE__).'/chatiduser.txt');
	}
	usleep(250000);
	
}