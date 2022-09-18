<?php


//set_time_limit(0);

if(file_exists(''.dirname(__FILE__).'/phplog.txt')==FALSE)
{
	touch(''.dirname(__FILE__).'/phplog.txt');
}

ini_set("error_log", ''.dirname(__FILE__).'/phplog.txt');

include_once(''.dirname(__FILE__).'/TelegramBot.php');

class DataBot extends TelegramBot
{
	protected $token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"; //token
	const URLMIRROR = 'https://tdspro.pw/xxxxxxxxxxxx';
	const URLMIRROR1 = 'https://tdspro.pw/xxxxxxxxxxxxxxx';
	const URLCHANNEL = 'https://t.me/+xxxxxxxxxxxxxxxxx';
	const URLGROUP = 'https://t.me/+xxxxxxxxxxxxxxxx';
	const URLCASINO = 'https://telegram.xxxxxxxxxxxxxxxx.online';
	const URLOFCHANNEL = 'https://t.me/+xxxxxxxxxxxxxxxxx';
	const URLDOWNLOAD = 'https://cutt.ly/xxxxxxxxxxxxxxxxx';
	const COUNTERLIMIT = 5;
	const REFRESHTIME = 3600;
	const REFRESHCASINO = 20;
	const CHATIDADMIN = "0000000000000000";
	const ADMINUSERNAMES = "xxxxxxxxxxxxxxx, xxxxxxxxxxx, xxxxxxxxxxxxxx, xxxxxxxxxxxxxxx";
}