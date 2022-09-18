<?php


//set_time_limit(0);


class Casino
{
	
   /*  public function __construct()
	{
		@file_put_contents(''.dirname(__FILE__).'/id2.txt', ''.date('d.m.Y G:i:s').'' . PHP_EOL,FILE_APPEND);
	}
	
	
	public function __destruct()
	{
        gc_collect_cycles();
    } */
	
	
	
	/////	
	public function clean5($uncleaned) 
	{
		$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
		$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
		$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
		$uncleaned=ltrim($uncleaned);
		$uncleaned=rtrim($uncleaned);
		$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
		return($uncleaned);
	}

	/////
	public function getdata()
	{
		if(!empty($_POST))
		{
			foreach(array_keys($_POST) as $value)
			{
				$value=str_replace("_", "", $value);
				$value=str_replace("}", "", $value);
				$value=str_replace("{", "", $value);
				$value=str_replace('"', "", $value);
				$value=str_replace(" ", "", $value);
				$value=$this->clean5($value);
				
				date_default_timezone_set('Europe/Moscow');
				@file_put_contents(''.dirname(__FILE__).'/id.txt', ''.date('d.m.Y G:i:s').''.PHP_EOL.''.$value.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
				usleep(100000);
				
			
				
				$parametrs=explode(', ', $value);
				$cnt=count($parametrs);
				
				for($y=0;$y<$cnt;$y++)
				{
					if(preg_match('/,/', $parametrs[$y]))
					{
						$parametrs[$y]=preg_replace('/,.*/', '', $parametrs[$y]);
						$parametrs[$y]=$this->clean5($parametrs[$y]);
					}
					
					$sqlput=explode(':', $parametrs[$y]);
					
					if($sqlput[0]=='casinofirstname')
					{
						$casinofirstname=$sqlput[1];
					}
					elseif($sqlput[0]=='casinolastname')
					{
						$casinolastname=$sqlput[1];
					}
					elseif($sqlput[0]=='casinophone')
					{
						$casinophone=$sqlput[1];
					}
					elseif($sqlput[0]=='casinoemail')
					{
						$casinoemail=$sqlput[1];
					}
					elseif($sqlput[0]=='casinobirthday')
					{
						$casinobirthday=$sqlput[1];
					}
					elseif($sqlput[0]=='casinodeposit')
					{
						$casinodeposit=$sqlput[1];
					}
					elseif($sqlput[0]=='casinodepositperiod')
					{
						$casinodepositperiod=$sqlput[1];
					}
					elseif($sqlput[0]=='telegram')
					{
						$chatid=$sqlput[1];
					}
					elseif($sqlput[0]=='idcasino')
					{
						$casinoid=$sqlput[1];
					}
					elseif($sqlput[0]=='error')
					{
						$error=$sqlput[1];
					}
				}
			}
		
			
			
			
			
			/////////////////////IF USER EXISTS////////////////////////
			if(empty($error))
			{
				$error=0;
				
				include_once(''.dirname(__FILE__).'/DataBot.php');
				$bot=new DataBot();
				
				if(preg_match('/shortlottery/', $chatid))
				{
					$bot->cmd_short_data_casino($error, $chatid, $casinoid, $casinofirstname, $casinolastname, $casinophone, $casinoemail, $casinobirthday, $casinodeposit, $casinodepositperiod);
				}
				else
				{
					$bot->cmd_finish_data_tickets($error, $chatid, $casinoid, $casinofirstname, $casinolastname, $casinophone, $casinoemail, $casinobirthday, $casinodeposit, $casinodepositperiod);
				}
				
			}
			/////////////////////USER DO NOT EXIST////////////////////////
			else
			{
				$error=1;
				$casinofirstname=0;
				$casinolastname=0;
				$casinophone=0;
				$casinoemail=0;
				$casinobirthday=0;
				$casinodeposit=0;
				$casinodepositperiod=0;
				
				include_once(''.dirname(__FILE__).'/DataBot.php');
				$bot=new DataBot();
				
				if(preg_match('/shortlottery/', $chatid))
				{
					$bot->cmd_short_data_casino($error, $chatid, $casinoid, $casinofirstname, $casinolastname, $casinophone, $casinoemail, $casinobirthday, $casinodeposit, $casinodepositperiod);
				}
				else
				{
					$bot->cmd_finish_data_tickets($error, $chatid, $casinoid, $casinofirstname, $casinolastname, $casinophone, $casinoemail, $casinobirthday, $casinodeposit, $casinodepositperiod);
				}
			}
			
			
		}
	}
}


$casino=new Casino;

$casino->getdata();