<?php


set_time_limit(0);

include_once(''.dirname(__FILE__).'/DataBot.php');

$bot=new DataBot();

$chatidadmin=$bot->chatidadmin;

$textadmin='<b>Генерация результатов успешно началась!</b>';

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
$chatidadmin=$bot->chatidadmin;


$tablottery='tablottery';
$tabusers='tabusers';
$tabcasinousers='tabcasinousers';
$tablotteryusers='tablotteryusers';
$tabticketsall='tabticketsall';
$tabserviceadmin='tabserviceadmin';
$tabadminchange='tabadminchange';
$tabservicelottery='tabservicelottery';
$tabresults='tabresults';
$tabresultsreserve='tabresultsreserve';
		
$query4=mysqli_query($con_sql2, 'SELECT startdate, messid, lotteryname, photos, topplaces, fakeplaces FROM '.$tablottery.'');
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
	
	

if(file_exists(''.dirname(__FILE__).'/resultsfirst.txt') || file_exists(''.dirname(__FILE__).'/resultsgenerate.txt') || file_exists(''.dirname(__FILE__).'/resultsfake.txt') || file_exists(''.dirname(__FILE__).'/modelling.txt'))
{
	if(file_exists(''.dirname(__FILE__).'/modelling.txt')==FALSE)
	{
		$tabtest='tabtest';
		$tabtest1='tabtest1';
		$tabtest2='tabtest2';
		$tabresults='tabresults';
		$tabresultsreserve='tabresultsreserve';
	}
	else
	{
		$tabtest='tabtestfake';
		$tabtest1='tabtest1fake';
		$tabtest2='tabtest2fake';
		$tabresults='tabresultsfake';
		$tabresultsreserve='tabresultsreservefake';
	}
	
	
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest.'');
	usleep(150000);	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest1.'');
	usleep(150000);		
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest2.'');
	usleep(150000);
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresults.'');
	usleep(150000);
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsreserve.'');
	usleep(150000);
	
	
	$query=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tabticketsall.'');
	usleep(150000);
	
	$con=mysqli_num_rows($query);
	$usersquan=$con;
	
	$array=range(1, $topplaces);
	$countarray=count($array);
	
	
	if($usersquan<$topplaces || $usersquan==$topplaces)
	{
		$count=$usersquan;
	}
	else
	{
		$count=$topplaces;
	}
	
	
	
	mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtest.' LIKE '.$tabticketsall.'');
	usleep(450000);
	
	mysqli_query($con_sql2, 'INSERT INTO '.$tabtest.' (chatid, firstname, lastname, username, status, tickets) SELECT chatid, firstname, lastname, username, status, tickets FROM '.$tabticketsall.'');
	sleep(4);
	
	mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtest1.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",status VARCHAR(35) DEFAULT "0",tickets VARCHAR(15) DEFAULT "0", place INT(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
	usleep(650000);
	
	
	for($y=0;$y<$count;$y++)
	{
		$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabtest.'');
		usleep(850000);
		$con1=mysqli_num_rows($query1);
		
		$ticketsarray=[];
		
		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
			$ticketsarray[]=$row1[$i1][0];
		}
		
		
		for($y1=0;$y1<$usersquan;$y1++)
		{
			shuffle($ticketsarray);
		}
		
		$randticket=$ticketsarray[mt_rand(0, (count($ticketsarray)-1))];
		
		$query1=mysqli_query($con_sql2, 'SELECT chatid, firstname, lastname, username, tickets FROM '.$tabtest.' WHERE tickets="'.$randticket.'"');
		usleep(150000);
		$con1=mysqli_num_rows($query1);
		
		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
		}
		
		mysqli_query($con_sql2, 'INSERT INTO '.$tabtest1.' (chatid, firstname, lastname, username, tickets, place) VALUES ("'.$row1[0][0].'", "'.$row1[0][1].'", "'.$row1[0][2].'", "'.$row1[0][3].'", "'.$randticket.'", "'.$array[$y].'")');
		usleep(150000);
		
		mysqli_query($con_sql2, 'DELETE FROM '.$tabtest.' WHERE chatid="'.$row1[0][0].'"');
		usleep(500000);
	}
	
	mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabresults.' LIKE '.$tabtest1.'');
	usleep(150000);
	
	mysqli_query($con_sql2, 'INSERT INTO '.$tabresults.' (chatid, firstname, lastname, username, status, tickets, place) SELECT chatid, firstname, lastname, username, status, tickets, place FROM '.$tabtest1.' ORDER BY place + 0 ASC');
	usleep(450000);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsreserve.'');
	usleep(150000);
	
	mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabresultsreserve.' LIKE '.$tabresults.'');
	usleep(150000);
	
	mysqli_query($con_sql2, 'INSERT INTO '.$tabresultsreserve.' (chatid, firstname, lastname, username, status, tickets, place) SELECT chatid, firstname, lastname, username, status, tickets, place FROM '.$tabresults.' ORDER BY place + 0 ASC');
	usleep(450000);
	
}

	
	
$con_sql2=$bot->cmd_sql();

if($fakeplacess!="0")
{
	if(preg_match('/,/', $fakeplacess))
	{		
		$fakeplaces1=explode(',', $fakeplacess);
		$fakeusersquan=count($fakeplaces1);
	}
	else
	{
		$fakeplaces1=[];
		$fakeplaces1[]=$fakeplacess;
		$fakeusersquan=count($fakeplaces1);
	}	
		
	foreach($fakeplaces1 as $fakeplace1)
	{
		if(preg_match('/@/', $fakeplace1))
		{
			$faplace=preg_replace('/-.*/', '', $fakeplace1);
			$faplace=$bot->clean($faplace);
	
			$fakeusername=preg_replace('/.*-/', '', $fakeplace1);
			$fakeusername=$bot->clean($fakeusername);
			
			$query1=mysqli_query($con_sql2, 'SELECT chatid, firstname, lastname FROM '.$tabusers.' WHERE username="'.$fakeusername.'"');
			usleep(150000);
			$con1=mysqli_num_rows($query1);
			
			for($i1=0;$i1<$con1;$i1++)
			{
				mysqli_data_seek($query1, $i1);
				$row1[$i1]=mysqli_fetch_row($query1);
			}
			
			$fakechatid=$row1[0][0];
			$fakefirstname=$row1[0][1];
			$fakelastname=$row1[0][2];
			
	
			if($bot->cmd_sql_searchchatidtable($fakechatid, $tabticketsall)==FALSE)
			{
				$faketicket=$bot->api->generate2(11);
			}
			else
			{
				$query2=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				$con2=mysqli_num_rows($query2);
				
				for($i2=0;$i2<$con2;$i2++)
				{
					mysqli_data_seek($query2, $i2);
					$row2[$i2]=mysqli_fetch_row($query2);
				}
				
				$faketicket=$row2[mt_rand(0, $con2-1)][0];
			}
			
			
			if($bot->cmd_sql_searchchatidtable($fakechatid, $tabresults))
			{
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabresults.' WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				$con3=mysqli_num_rows($query3);
				
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
				
				
				
				$query4=mysqli_query($con_sql2, 'SELECT * FROM '.$tabresults.' WHERE place="'.$faplace.'"');
				usleep(150000);
				$con4=mysqli_num_rows($query4);
			
				for($i4=0;$i4<$con4;$i4++)
				{
					mysqli_data_seek($query4, $i4);
					$row4[$i4]=mysqli_fetch_row($query4);
				}
				
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET chatid = REPLACE(chatid, "'.$row3[0][1].'", "'.$row4[0][1].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET firstname = REPLACE(firstname, "'.$row3[0][2].'", "'.$row4[0][2].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET lastname = REPLACE(lastname, "'.$row3[0][3].'", "'.$row4[0][3].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET username = REPLACE(username, "'.$row3[0][4].'", "'.$row4[0][4].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET tickets = REPLACE(tickets, "'.$row3[0][6].'", "'.$row4[0][6].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET chatid = REPLACE(chatid, "'.$row4[0][1].'", "'.$fakechatid.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET firstname = REPLACE(firstname, "'.$row4[0][2].'", "'.$fakefirstname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET lastname = REPLACE(lastname, "'.$row4[0][3].'", "'.$fakelastname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET username = REPLACE(username, "'.$row4[0][4].'", "'.$fakeusername.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET tickets = REPLACE(tickets, "'.$row4[0][6].'", "'.$faketicket.'") WHERE place="'.$faplace.'"');
				usleep(150000);
			}
			else
			{
				$query4=mysqli_query($con_sql2, 'SELECT * FROM '.$tabresults.' WHERE place="'.$faplace.'"');
				usleep(150000);
				$con4=mysqli_num_rows($query4);
			
				for($i4=0;$i4<$con4;$i4++)
				{
					mysqli_data_seek($query4, $i4);
					$row4[$i4]=mysqli_fetch_row($query4);
				}
				
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET chatid = REPLACE(chatid, "'.$row4[0][1].'", "'.$fakechatid.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET firstname = REPLACE(firstname, "'.$row4[0][2].'", "'.$fakefirstname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET lastname = REPLACE(lastname, "'.$row4[0][3].'", "'.$fakelastname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET username = REPLACE(username, "'.$row4[0][4].'", "'.$fakeusername.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET tickets = REPLACE(tickets, "'.$row4[0][6].'", "'.$faketicket.'") WHERE place="'.$faplace.'"');
				usleep(150000);
			}
		}
		else
		{
			$faplace=preg_replace('/-.*/', '', $fakeplace1);
			$faplace=$bot->clean($faplace);
	
			$fakechatid=preg_replace('/.*-/', '', $fakeplace1);
			$fakechatid=$bot->clean($fakechatid);
			
			
			$query1=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$tabusers.' WHERE chatid="'.$fakechatid.'"');
			usleep(150000);
			$con1=mysqli_num_rows($query1);
			
			for($i1=0;$i1<$con1;$i1++)
			{
				mysqli_data_seek($query1, $i1);
				$row1[$i1]=mysqli_fetch_row($query1);
			}
			
			$fakefirstname=$row1[0][0];
			$fakelastname=$row1[0][1];
			$fakeusername=$row1[0][2];
			
			if($bot->cmd_sql_searchchatidtable($fakechatid, $tabticketsall)==FALSE)
			{
				$faketicket=$bot->api->generate2(11);
			}
			else
			{
				$query2=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				$con2=mysqli_num_rows($query2);
				
				for($i2=0;$i2<$con2;$i2++)
				{
					mysqli_data_seek($query2, $i2);
					$row2[$i2]=mysqli_fetch_row($query2);
				}
				
				$faketicket=$row2[mt_rand(0, $con2-1)][0];
			}
			
			
			if($bot->cmd_sql_searchchatidtable($fakechatid, $tabresults))
			{
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabresults.' WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				$con3=mysqli_num_rows($query3);
				
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
				
				
				$query4=mysqli_query($con_sql2, 'SELECT * FROM '.$tabresults.' WHERE place="'.$faplace.'"');
				usleep(150000);
				$con4=mysqli_num_rows($query4);
			
				for($i4=0;$i4<$con4;$i4++)
				{
					mysqli_data_seek($query4, $i4);
					$row4[$i4]=mysqli_fetch_row($query4);
				}
				
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET chatid = REPLACE(chatid, "'.$row3[0][1].'", "'.$row4[0][1].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET firstname = REPLACE(firstname, "'.$row3[0][2].'", "'.$row4[0][2].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET lastname = REPLACE(lastname, "'.$row3[0][3].'", "'.$row4[0][3].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET username = REPLACE(username, "'.$row3[0][4].'", "'.$row4[0][4].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET tickets = REPLACE(tickets, "'.$row3[0][6].'", "'.$row4[0][6].'") WHERE chatid="'.$fakechatid.'"');
				usleep(150000);
				
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET chatid = REPLACE(chatid, "'.$row4[0][1].'", "'.$fakechatid.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET firstname = REPLACE(firstname, "'.$row4[0][2].'", "'.$fakefirstname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET lastname = REPLACE(lastname, "'.$row4[0][3].'", "'.$fakelastname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET username = REPLACE(username, "'.$row4[0][4].'", "'.$fakeusername.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET tickets = REPLACE(tickets, "'.$row4[0][6].'", "'.$faketicket.'") WHERE place="'.$faplace.'"');
				usleep(150000);
			}
			else
			{
				$query4=mysqli_query($con_sql2, 'SELECT * FROM '.$tabresults.' WHERE place="'.$faplace.'"');
				usleep(150000);
				$con4=mysqli_num_rows($query4);
			
				for($i4=0;$i4<$con4;$i4++)
				{
					mysqli_data_seek($query4, $i4);
					$row4[$i4]=mysqli_fetch_row($query4);
				}
				
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET chatid = REPLACE(chatid, "'.$row4[0][1].'", "'.$fakechatid.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET firstname = REPLACE(firstname, "'.$row4[0][2].'", "'.$fakefirstname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET lastname = REPLACE(lastname, "'.$row4[0][3].'", "'.$fakelastname.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET username = REPLACE(username, "'.$row4[0][4].'", "'.$fakeusername.'") WHERE place="'.$faplace.'"');
				usleep(150000);
				mysqli_query($con_sql2, 'UPDATE '.$tabresults.' SET tickets = REPLACE(tickets, "'.$row4[0][6].'", "'.$faketicket.'") WHERE place="'.$faplace.'"');
				usleep(150000);
			}
		}
	}
}	
	


$con_sql2=$bot->cmd_sql();

//$textfinish="";

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
		if(file_exists(''.dirname(__FILE__).'/modelling.txt')==FALSE)
		{
			$bot->api->sendMessage([
			'chat_id' => $chatidadmin,
			'text' => $textfinish,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$bot->api->sendMessage([
			'chat_id' => file_get_contents(''.dirname(__FILE__).'/modelling.txt'),
			'text' => $textfinish,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		
		$textfinish="";
	}
}



if(!empty($textfinish))
{
	
	if(file_exists(''.dirname(__FILE__).'/modelling.txt')==FALSE)
	{
		$bot->api->sendMessage([
		'chat_id' => $chatidadmin,
		'text' => $textfinish,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
	else
	{
		$bot->api->sendMessage([
		'chat_id' => file_get_contents(''.dirname(__FILE__).'/modelling.txt'),
		'text' => $textfinish,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
}



if(file_exists(''.dirname(__FILE__).'/modelling.txt')==FALSE)
{

	$textadmin='Вас <b>устраивают такие результаты</b> розыгрыша "'.$lotteryname.'"?';


	$bot->api->sendMessage([
	'chat_id' => $chatidadmin,
	'text' => $textadmin,
	'reply_markup' => json_encode(['inline_keyboard'=>$bot->keyboards['finish_lottery_confirm']]),
	//'disable_notification' => TRUE,
	//'disable_web_page_preview' => TRUE,
	'parse_mode'=> "HTML"
	]);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest.'');
	usleep(150000);	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest1.'');
	usleep(150000);		
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest2.'');
	usleep(150000);
}
else
{
	$textadmin='Сверху Вы видите <b>смоделированные результаты</b> розыгрыша "'.$lotteryname.'"🖕';
	
	$bot->api->sendMessage([
	'chat_id' => file_get_contents(''.dirname(__FILE__).'/modelling.txt'),
	'text' => $textadmin,
	//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change']]),
	//'disable_notification' => TRUE,
	//'disable_web_page_preview' => TRUE,
	'parse_mode'=> "HTML"
	]);
	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest.'');
	usleep(150000);	
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest1.'');
	usleep(150000);		
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtest2.'');
	usleep(150000);
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresults.'');
	usleep(150000);
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsreserve.'');
	usleep(150000);
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
	usleep(150000);
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
	usleep(150000);
	mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
	usleep(250000);


	if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
	{
		unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
	}
	
}



if(file_exists(''.dirname(__FILE__).'/resultsfirst.txt'))
{
	unlink(''.dirname(__FILE__).'/resultsfirst.txt');
}

if(file_exists(''.dirname(__FILE__).'/resultsgenerate.txt'))
{
	unlink(''.dirname(__FILE__).'/resultsgenerate.txt');
}

if(file_exists(''.dirname(__FILE__).'/resultsfake.txt'))
{
	unlink(''.dirname(__FILE__).'/resultsfake.txt');
}

if(file_exists(''.dirname(__FILE__).'/modelling.txt'))
{
	unlink(''.dirname(__FILE__).'/modelling.txt');
}

