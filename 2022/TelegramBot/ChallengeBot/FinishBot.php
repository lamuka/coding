<?php

/* if(file_exists(''.dirname(__FILE__).'/xxx.txt')==FALSE)

	touch(''.dirname(__FILE__).'/xxx.txt');
 */

$files=glob(''.dirname(__FILE__).'/shortlottery*.txt');

if($files)
{
	
	foreach($files as $file)
	{
		$enddate=file_get_contents($file);
		
		date_default_timezone_set('Europe/Kiev');
		
		$nowdate=date('d.m.Y G:i');
		
		$stampold=strtotime($enddate);
		$stampnew=strtotime($nowdate);
		
		if($stampnew>$stampold || $stampnew==$stampold)
		{
			include_once(''.dirname(__FILE__).'/DataBot.php');
			$bot=new DataBot();
			
			$lotterydata=preg_replace('/.*\//', '', $file);
			$lotterydata=preg_replace('/\..*/', '', $lotterydata);
			$lotterydata=preg_replace('/shortlottery/', '', $lotterydata);
			$lotterydata=$bot->clean($lotterydata);
			unlink($file);
			

			$bot->cmd_finish_shortlot($lotterydata);
		}
	}
}
else
{
	exit;
}