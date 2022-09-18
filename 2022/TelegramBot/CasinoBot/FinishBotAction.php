<?php

set_time_limit(0);

date_default_timezone_set('Europe/Moscow');

include_once(''.dirname(__FILE__).'/DataBot.php');

$bot=new DataBot();

$con_sql2=$bot->cmd_sql();

$tablottery='tablottery';
$tabcasinousers='tabcasinousers';
$tablotteryusers='tablotteryusers';


$query4=mysqli_query($con_sql2, 'SELECT messid, photos FROM '.$tablottery.'');
$con4=mysqli_num_rows($query4);

for($i4=0;$i4<$con4;$i4++)
{
	mysqli_data_seek($query4, $i4);
	$row4[$i4]=mysqli_fetch_row($query4);
}

$channelid=$bot->mainchannel();
$messageidchannel=$row4[0][0];
$photo=$row4[0][1];

$textall="";
	
$text='<i>Регистрация приостановлена</i>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
$textall=$textall . ''.$text.'';

$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
$textall=$textall . ''.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';


if($photo!="0")
{
	$text='<a href="'.$photo.'">&#160;</a>';
	$textall=$textall . ''.$text.'';
}


$bot->api->editMessageText([
	'chat_id' => $channelid,
	'message_id' => $messageidchannel,
	//'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
	'text' => $textall,
	'parse_mode' => "HTML",
]);


$chatidadmin=$bot->chatidadmin;

$textadmin='<b>Проверка пользователей казино успешно началась</b>';

$bot->api->sendMessage([
'chat_id' => $chatidadmin,
'text' => $textadmin,
//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change_results']]),
//'disable_notification' => TRUE,
//'disable_web_page_preview' => TRUE,
'parse_mode'=> "HTML"
]);






$query8=mysqli_query($con_sql2, 'SELECT startdate FROM '.$tablottery.'');
usleep(250000);
$con8=mysqli_num_rows($query8);

for($i8=0;$i8<$con8;$i8++)
{
	mysqli_data_seek($query8, $i8);
	$row8[$i8]=mysqli_fetch_row($query8);
}

$startdate=$row8[0][0];

$query10=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tablotteryusers.'');
usleep(250000);
$con10=mysqli_num_rows($query10);

$row10=[];

for($i10=0;$i10<$con10;$i10++)
{
	$con_sql2=$bot->cmd_sql();
	
	mysqli_data_seek($query10, $i10);
	$row10[$i10]=mysqli_fetch_row($query10);
	
	$chatidlotteryuser=$row10[$i10][0];
	
	$query11=mysqli_query($con_sql2, 'SELECT casinoid, lasttime FROM '.$tabcasinousers.' WHERE chatid="'.$chatidlotteryuser.'"');
	usleep(250000);
	$con11=mysqli_num_rows($query11);
	
	$row11=[];
	
	for($i11=0;$i11<$con11;$i11++)
	{
		mysqli_data_seek($query11, $i11);
		$row11[$i11]=mysqli_fetch_row($query11);
	
		$casinoidlotteryuser=$row11[$i11][0];

		mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET lasttime = REPLACE(lasttime, "'.$row11[$i11][1].'", "1") WHERE chatid="'.$chatidlotteryuser.'"');
		usleep(250000);
	}
	
	
	$postdata=http_build_query(
		[
			'idcasino' => $casinoidlotteryuser,
			'idtelegram' => $chatidlotteryuser,
			'startdate' => $startdate
		]
	);
	
	$opts = ['http' =>
		[
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $postdata
		]
	];
	
	$context = stream_context_create($opts);
	file_get_contents(''.DataBot::URLCASINO.'', false, $context);
	sleep(1);
	@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$casinoidlotteryuser.', idtelegram - '.$chatidlotteryuser.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
	sleep(14);
	
}

$sleepall=DataBot::REFRESHCASINO * $con10;
sleep($sleepall);


$bot->cmd_lottery_finish();
