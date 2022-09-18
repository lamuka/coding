<?php


if(file_exists(''.dirname(__FILE__).'/enddate.txt'))
{
	date_default_timezone_set('Europe/Moscow');
	
	$enddate=file_get_contents(''.dirname(__FILE__).'/enddate.txt');
	$nowdate=date('d.m.Y G:i');
	
	$stampold=strtotime($enddate);
	$stampnew=strtotime($nowdate);
	
	if($stampnew>$stampold || $stampnew==$stampold)
	{
		unlink(''.dirname(__FILE__).'/enddate.txt');
		
		if(file_exists(''.dirname(__FILE__).'/statistics.txt')==FALSE)
		{
			touch(''.dirname(__FILE__).'/statistics.txt');
		}
		
		shell_exec('php '.dirname(__FILE__).'/FinishBotAction.php > /dev/null 2>/dev/null &');
		sleep(1);
	}
	
}

exit;