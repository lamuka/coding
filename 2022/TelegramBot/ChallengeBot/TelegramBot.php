<?php



class TelegramBot
{

	public $chatidadmin=DataBot::CHATIDADMIN;
	public $adminusernames=DataBot::ADMINUSERNAMES;
	
	//////////////////////////////////
	protected $commands=
	[
		"/start" => "cmd_start",
		"/start_referal" => "cmd_start_referal",
		"/start_lottery" => "cmd_start_lottery",
		"/id" => "cmd_admin_id",
		//"/help" => "cmd_help",
		"/format" => "cmd_format",
		
		
		"📲Актуальное зеркало" => "cmd_active_mirror",
		"🎰Перейти на сайт" => "cmd_active_mirror",
		"💆Пригласить друга" => "cmd_invite_friend",
		"🎫Мои билеты" => "cmd_my_tickets",
		"🤩Информация о розыгрыше" => "cmd_lottery_info",
		"🎁Хочу больше билетов" => "cmd_refresh_data",
		"🎰Официальный канал" => "cmd_casino_official",
		"🤳Приложение для Android" => "cmd_download_app",
		
		"Создать" => "cmd_create_lottery",
		"Инфо" => "cmd_create_lottery_see",
		"Запустить" => "cmd_create_lottery_send",
		"Изменить" => "cmd_change_lottery",
		"Статистика" => "cmd_admin_statistics",
		"Рассылки" => "cmd_message_lottery",
		"Архив" => "cmd_lottery_archieve",
		"Баны" => "cmd_lottery_banusers",
		"Розыгрыши без билетов" => "cmd_lottery_short"
	];
			


	public $keyboards=
	[	
		'default_user_casino' => ['keyboard' => [['📲Актуальное зеркало', '💆Пригласить друга'], ['🤩Информация о розыгрыше', '🎫Мои билеты'], ['🎰Официальный канал', '🤳Приложение для Android'], ['🎁Хочу больше билетов']], 'resize_keyboard' => true],
		
		'default_user_all' => ['keyboard' => [['🎰Перейти на сайт']], 'resize_keyboard' => true],
		
		'default_admin' => ['keyboard' => [['Создать', 'Запустить'], ['Инфо', 'Изменить'], ['Статистика', 'Рассылки'], ['Архив', 'Баны'], ['Розыгрыши без билетов']], 'resize_keyboard' => true],
		
		'default_admin' => ['keyboard' => [['Розыгрыши без билетов']], 'resize_keyboard' => true],
		

		'default_test' => ['keyboard' => [['Создать']], 'resize_keyboard' => true],
		
		'buttonsubchannel' => [  [['text' => '➡️Подписаться на канал ', 'url' => DataBot::URLCHANNEL ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ],
		
		'buttonsubgroup' => [  [['text' => '➡️Присоединиться к чату', 'url' => DataBot::URLGROUP ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ],
		
		'buttonsuball' => [  [['text' => '➡️Подписаться на канал ', 'url' => DataBot::URLCHANNEL], ['text' => '➡️Присоединиться к чату', 'url' => DataBot::URLGROUP ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ],
		
		'urlcasino' => [  [['text' => '🎰Перейти на сайт', 'url' => DataBot::URLMIRROR ]] ],
		
		'inline_admin_short_main' => [  [['text' => 'Создать', 'callback_data' => 'lottery_create_short'], ['text' => 'Изменить', 'callback_data' => 'lottery_change_short']], [['text' => 'Удалить', 'callback_data' => 'lottery_delete_short'], ['text' => 'Статистика', 'callback_data' => 'lottery_stats_short']] ],
		
		
		
		'inline_admin_short_lottery' => [  [['text' => 'Канал розыгрыша', 'callback_data' => 'lottery_short_channel']], [['text' => 'Текст розыгрыша', 'callback_data' => 'lottery_short_text'], ['text' => 'Количество победителей', 'callback_data' => 'lottery_short_winners']], [['text' => 'Дата и время окончания', 'callback_data' => 'lottery_short_enddate'], ['text' => 'Картинка', 'callback_data' => 'lottery_short_image']], [['text' => 'Текст кнопки регистрации', 'callback_data' => 'lottery_short_textbutton'], ['text' => 'Сообщение при регистрации', 'callback_data' => 'lottery_short_message']], [['text' => '✖️Отменить создание', 'callback_data' => 'lottery_short_cancel']] ],
		
		'inline_admin_short_lottery1' => [  [['text' => 'Канал розыгрыша', 'callback_data' => 'lottery_short_channel'], ], [['text' => 'Текст розыгрыша', 'callback_data' => 'lottery_short_text'], ['text' => 'Дата и время окончания', 'callback_data' => 'lottery_short_enddate']], [['text' => 'Количество победителей', 'callback_data' => 'lottery_short_winners'], ['text' => 'Картинка', 'callback_data' => 'lottery_short_image']], [['text' => 'Текст кнопки регистрации', 'callback_data' => 'lottery_short_textbutton'], ['text' => 'Сообщение при регистрации', 'callback_data' => 'lottery_short_message']], [['text' => '✖️Отменить создание', 'callback_data' => 'lottery_short_cancel']], [['text' => '✔️Запустить розыгрыш', 'callback_data' => 'lottery_short_send']] ],
		
		'inline_admin_short_confirm' => [  [['text' => 'Да', 'callback_data' => 'short_lottery_send_confirm_yes']], [['text' => 'Нет', 'callback_data' => 'short_lottery_send_confirm_no']] ],
		
		'inline_admin_change' => [  [['text' => 'Название', 'callback_data' => 'lottery_change_name'], ['text' => 'Текст', 'callback_data' => 'lottery_change_text']], [['text' => 'Дату окончания', 'callback_data' => 'lottery_change_enddate'], ['text' => 'Параметры', 'callback_data' => 'lottery_change_parametrs']], [['text' => 'Количество призовых мест', 'callback_data' => 'lottery_change_topplaces'], ['text' => 'Фейковые призовые места', 'callback_data' => 'lottery_change_fakeplaces']], [['text' => 'Картинку', 'callback_data' => 'admin_lottery_photo_yes'], ['text' => '🔀Смоделировать', 'callback_data' => 'admin_lottery_modelling']], [['text' => '⤵️Применить изменения', 'callback_data' => 'lottery_change_complete']], [['text' => '⏹Удалить розыгрыш', 'callback_data' => 'lottery_change_delete'], ['text' => '⤴️Выйти', 'callback_data' => 'lottery_change_exit']] ],
	
		'inline_admin_change_results' => [  [['text' => 'Фейковые призовые места', 'callback_data' => 'lottery_change_fakeplaces']], [['text' => 'Сгенерировать новые результаты', 'callback_data' => 'lottery_change_generate']], [['text' => 'Прислать вручную', 'callback_data' => 'lottery_change_manual_results']], [['text' => '⏹Удалить розыгрыш', 'callback_data' => 'lottery_change_delete'], ['text' => '⤴️Выйти', 'callback_data' => 'lottery_change_exit']] ],
	
		'usersmessage' => [  [['text' => 'Всем пользователям', 'callback_data' => 'users_message_all']], [['text' => 'Участникам розыгрыша', 'callback_data' => 'users_message_lottery']], [['text' => 'Не участникам розыгрыша', 'callback_data' => 'users_message_notlottery']], [['text' => 'Пользователю по ID', 'callback_data' => 'user_message_byid']], [['text' => '⏹Остановить рассылку', 'callback_data' => 'users_mailing_stop']], [['text' => '⤴️Выйти', 'callback_data' => 'user_message_exit']] ],
		
		'inline_admin_ask_photo' => [  [['text' => 'Да', 'callback_data' => 'admin_lottery_photo_yes']], [['text' => 'Нет', 'callback_data' => 'admin_lottery_photo_no']] ],
		
		'finish_lottery_confirm' => [  [['text' => 'Да', 'callback_data' => 'finish_lottery_confirm_yes']], [['text' => 'Нет', 'callback_data' => 'finish_lottery_confirm_no']] ],
		
		'mailing_stop_confirm' => [  [['text' => 'Да', 'callback_data' => 'mailing_stop_confirm_yes']], [['text' => 'Нет', 'callback_data' => 'mailing_stop_confirm_no']] ],
		
		'delete_lottery_confirm' => [  [['text' => 'Да', 'callback_data' => 'delete_lottery_yes']], [['text' => 'Нет', 'callback_data' => 'delete_lottery_no']] ],
		
		'inline_banusers' => [  [['text' => 'Забанить', 'callback_data' => 'admin_users_ban']], [['text' => 'Разбанить', 'callback_data' => 'admin_users_unban']] ]
	];

/////	
	public $lotteryparametrs=['Реферальная программа', 'За депозиты', 'За регистрационные данные', 'За публикацию'];
	
/////	
	public $dataparametrs=['имя,фамилия,день рождения', 'почта', 'телефон'];

	
/////	
	public $pre='';
	
/////	

	public $testusers='xxxxxxxxxxx, yyyyyyyyyyyyyyy';
/////	
	public function clean($uncleaned) 
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
	public function cmd_array_key_last($array)
	{	
		if (!is_array($array) || empty($array))
		{
            return NULL;
		}
		
		return array_keys($array)[count($array)-1];
	}


	
/////
	public function cmd_sql()
	{	
		include_once(''.dirname(__FILE__).'/SqlBot.php');
		
		$sql=new SqlBot();
		
		$host=$sql->host;
		$user=$sql->user;
		$pass=$sql->pass;
		$dbn=$sql->dbn;
		
		/* $con_sql1=mysqli_connect($host, $user, $pass);
		if(mysqli_query($con_sql1, 'CREATE DATABASE '.$dbn.'')) 
		{ 
			mysqli_close($con_sql1);
		} */
		
		$con_sql2=mysqli_connect($host, $user, $pass, $dbn);
		
		mysqli_set_charset($con_sql2, 'utf8mb4');
		
		return $con_sql2;
	}
	


/////
	public function cmd_sql_searchchatidtable($chatid, $table)
	{	
		
		//$con_sql2=$this->cmd_sql();
		$con_sql2=DataBot::cmd_sql();

		if(DataBot::cmd_if_exists($table))
		{
			if(DataBot::cmd_if_empty($table)==FALSE)
			{
				$query=mysqli_query($con_sql2, 'SELECT 1 FROM '.$table.' WHERE chatid="'.$chatid.'"');
				
				if(!empty(mysqli_num_rows($query)))
				{
					return true;
				}
			}
		}
		
		return false;
	}


/////
	public function cmd_sql_searchcasinoidtable($casinoid, $table)
	{	
		
		$con_sql2=$this->cmd_sql();
		

		if($this->cmd_if_exists($table))
		{
			if($this->cmd_if_empty($table)==FALSE)
			{
				$query=mysqli_query($con_sql2, 'SELECT 1 FROM '.$table.' WHERE casinoid="'.$casinoid.'"');
				
				if(!empty(mysqli_num_rows($query)))
				{
					return true;
				}
			}
		}
		
		return false;
	}


/////
	public function cmd_arraysearch($value, $array)
	{
		if(is_array($array))
		{
			if(!empty($array))
			{
				if(in_array($value, $array))
				{
					return true;
				}
				else
				{
					$arrayvalues=array_values($array);
	
					foreach($arrayvalues as $arrayvalue)
					{
						if(is_array($arrayvalue))
						{
							if(!empty($arrayvalue))
							{
								if($this->cmd_arraysearch($value, $arrayvalue))
								{
									return true;
								}
							}
						}
						else
						{
							if($value==$arrayvalue)
							{
								return true;
							}
						}
					}
				}
			}
		}
		
		return false;
	}

	
/////
	public function cmd_if_exists($table)
	{	
		$con_sql2=DataBot::cmd_sql();

		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$table.' LIMIT 1'))
		{
			return true;
		}
		
		return false;
	}
	

/////
	public function cmd_if_empty($table)
	{	
		$con_sql2=DataBot::cmd_sql();
		
		if(DataBot::cmd_if_exists($table))
		{
			$query=mysqli_query($con_sql2, 'SELECT 1 FROM '.$table.' LIMIT 1');
			
			if(empty(mysqli_num_rows($query)))
			{
				return true;
			}
		}
		else
		{
			return true;
		}
		
		return false;
	}
	

/////
	public function cmd_isadmin()
	{
		if(!empty($this->api->chatId))
		{
			if(preg_match('/'.$this->api->chatId.'/', $this->chatidadmin) || preg_match('/'.$this->api->chatId.'/', $this->adminusernames))
			{
				return true;
			}
			
			if($this->cmd_sql_searchchatidtable($this->api->chatId, 'tabadmin'))
			{
				return true;
			}
		}
		
		if(!empty($this->api->username))
		{
			if(preg_match('/'.preg_quote($this->api->username).'/', $this->adminusernames))
			{
				return true;
			}
		}
		
		
		
		return false;
	}




/////
	public function inchannel_check()
	{
		$arraystatus=['member','creator','administrator'];
		
		$channelid=$this->mainchannel();
		
		$inchannel=json_decode($this->api->getChatMember($channelid), true);
		$inchannel=$inchannel['result'];
		
		if(in_array($inchannel['status'], $arraystatus))
		{
			return true;
		}
		
		return false;
	}




/////
	public function ingroup_check()
	{
		$arraystatus=['member','creator','administrator'];
		
		$groupid=$this->maingroup();
		
		$ingroup=json_decode($this->api->getChatMember($groupid), true);
		$ingroup=$ingroup['result'];
		

		if(in_array($ingroup['status'], $arraystatus))
		{
			return true;
		}
		
		return false;
	}	
	

/////
	public function channel_url()
	{
		$channelid=$this->mainchannel();

		$result=json_decode($this->api->getChat([
		'chat_id' => $channelid
		]), true);
		
		
		if(!empty($result['result']['invite_link']))
		{
			$channel_url=$result['result']['invite_link'];
			
			return $channel_url;
		}
		
		return DataBot::URLCHANNEL;
	}


/////
	public function group_url()
	{
				
		$groupid=$this->maingroup();
		

		$result=json_decode($this->api->getChat([
		'chat_id' => $groupid
		]), true);
		
		if(!empty($result['result']['invite_link']))
		{
			$group_url=$result['result']['invite_link'];
			
			return $group_url;
		}
		
		return DataBot::URLGROUP;
	}
	
	
/////
	public function testusers($chatid = null)
	{
		if(!empty($chatid))
		{
			if(preg_match('/'.$chatid.'/', $this->testusers))
				{
					return true;
				}
		}
		else
		{
			if(!empty($this->api->chatId))
			{
				if(empty($this->api->username))
				{
					if(preg_match('/'.$this->api->chatId.'/', $this->testusers))
					{
						return true;
					}
				}
				else
				{
					if(preg_match('/'.$this->api->chatId.'/', $this->testusers) || preg_match('/'.$this->api->username.'/', $this->testusers))
					{
						return true;
					}
				}
			}
		}
		
		return false;
	}

/////	
	public function id_mainchannel()
	{
		$con_sql2=$this->cmd_sql();

		$tabchannels='tabchannels';
		
		$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.' ORDER BY id ASC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
			
			$channelid=$row[$i][0];
			break;
		}
		
		if($channelid==$this->mainchannel())
		{
			return true;
		}
		
		return false;
		
	}

/////	
	public function id_maingroup()
	{
		$con_sql2=$this->cmd_sql();

		$tabchannels='tabgroups';
		
		$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.' ORDER BY id ASC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
			
			$channelid=$row[$i][0];
			break;
		}
		
		if($channelid==$this->maingroup())
		{
			return true;
		}
		
		return false;
		
	}		
	
/////	
	public function mainchannel()
	{
		$con_sql2=$this->cmd_sql();
		
		$tablottery='tablottery';
		$tabservicelottery='tabservicelottery';
		$tabchannels='tabchannels';
		
		if($this->cmd_if_exists($tablottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tablottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			if(preg_match('/,/', $row[0][0]))
			{
				$alldata=explode(',', $row[0][0]);
				return $alldata[0];
			}
			else
			{
				return $row[0][0];
			}
		}
		elseif($this->cmd_if_exists($tabservicelottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabservicelottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			
			if(preg_match('/,/', $row[0][0]))
			{
				$alldata=explode(',', $row[0][0]);
				return $alldata[0];
			}
			else
			{
				return $row[0][0];
			}
		}
		elseif($this->cmd_if_exists($tabchannels))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.' ORDER BY id ASC');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			return $row[0][0];
		}
	}
	
	
/////	
	public function maingroup()
	{
		$con_sql2=$this->cmd_sql();
		
		$tablottery='tablottery';
		$tabservicelottery='tabservicelottery';
		$tabgroups='tabgroups';
		
		if($this->cmd_if_exists($tablottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tablottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			if(preg_match('/,/', $row[0][0]))
			{
				$alldata=explode(',', $row[0][0]);
				return $alldata[1];
			}
		}
		elseif($this->cmd_if_exists($tabservicelottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabservicelottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			
			if(preg_match('/,/', $row[0][0]))
			{
				$alldata=explode(',', $row[0][0]);
				return $alldata[1];
			}
		}
		elseif($this->cmd_if_exists($tabgroups))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabgroups.' ORDER BY id ASC');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			return $row[0][0];
		}
	}


/////	
	public function cmd_converttext()
	{
		include_once(''.dirname(__FILE__).'/EntityDecoder.php');
		
		$body=json_decode(json_encode($this->api->body, true));

		$entity_decoder = new EntityDecoder('HTML');
		$decoded_text = $entity_decoder->decode($body->message);
		
		return $decoded_text;
	}


	
/////
	public function cmd_admin_id()
	{

		$chatid=$this->api->chatId;
		
		$firstname=$this->api->firstname;
		
		if(!empty($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		
		if(!empty($this->api->username ) )
		{
			$username='@'.$this->api->username.'   <i>- имя пользователя телеграм</i>';
		}
		else
		{
			$username="<i>нет имени пользователя</i>";
		}
		
		if(!empty($this->api->lastname))
		{
		
			$text='<b>'.$chatid.'</b>   <i>- телеграм чат ID</i>'.PHP_EOL.''.$username.''.PHP_EOL.''.$firstname.' '.$lastname.'';
		}
		else
		{
			$text='<b>'.$chatid.'</b>   <i>- телеграм чат ID</i>'.PHP_EOL.''.$username.''.PHP_EOL.''.$firstname.'';
		}
		
		$this->api->sendMessage([
		'text' => $text,
		'parse_mode'=> "HTML"
		]);
		
	}


	/////	
	
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////SHORT LOTTERY////////////////////////////////////////////////////////////////////////////////
/////
	public function inchannel_check_short($lotteryname, $chatid)
	{
		$arraystatus=['member','creator','administrator'];
		
		$channelid=$this->mainchannel_short($lotteryname);
		
		$inchannel=json_decode($this->api->getChatMember([
		'chat_id' => $channelid,
		'user_id' => $chatid
		]), true);
		
		$inchannel=$inchannel['result'];
		
		if(in_array($inchannel['status'], $arraystatus))
		{
			return true;
		}
		
		return false;
	}




/////
	public function ingroup_check_short($lotteryname, $chatid)
	{
		$arraystatus=['member','creator','administrator'];
		
		$groupid=$this->maingroup_short($lotteryname);
		
		$ingroup=json_decode($this->api->getChatMember([
		'chat_id' => $groupid,
		'user_id' => $chatid
		]), true);
		
		$ingroup=$ingroup['result'];
		

		if(in_array($ingroup['status'], $arraystatus))
		{
			return true;
		}
		
		return false;
	}	
	

/////
	public function channel_url_short($lotteryname)
	{
		$channelid=$this->mainchannel_short($lotteryname);

		$result=json_decode($this->api->getChat([
		'chat_id' => $channelid
		]), true);
		
		
		if(!empty($result['result']['invite_link']))
		{
			$channel_url=$result['result']['invite_link'];
			
			return $channel_url;
		}
		
		return false;
	}


/////
	public function group_url_short($lotteryname)
	{
				
		$groupid=$this->maingroup_short($lotteryname);
		

		$result=json_decode($this->api->getChat([
		'chat_id' => $groupid
		]), true);
		
		if(!empty($result['result']['invite_link']))
		{
			$group_url=$result['result']['invite_link'];
			
			return $group_url;
		}
		
		return false;
	}
	

/////	
	public function mainchannel_short($lotteryname)
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$shortlottery='shortlottery'.$lotteryname.'';
		$serviceshortlottery='serviceshortlottery';
		$shortuserservice='shortuserservice'.$chatid.'';
		
		$tabchannels='tabchannels';
		
		if($this->cmd_if_exists($shortlottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$shortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			return $row[0][0];
			
		}
		elseif($this->cmd_if_exists($serviceshortlottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$serviceshortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}

			return $row[0][0];
			
		}
		
	}
	
	
/////	
	public function maingroup_short($lotteryname)
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$shortlottery='shortlottery'.$lotteryname.'';
		$serviceshortlottery='serviceshortlottery';
		$shortuserservice='shortuserservice'.$chatid.'';
		
		$tabgroups='tabgroups';
		
		if($this->cmd_if_exists($shortlottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT groupid FROM '.$shortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			return $row[0][0];

		}
		elseif($this->cmd_if_exists($serviceshortlottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT groupid FROM '.$serviceshortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			return $row[0][0];
			
		}
		
	}
	
	
/////	
	public function if_mainchannel_short($lotteryname)
	{
		$con_sql2=$this->cmd_sql();

		$tabchannels='tabchannels';
		
		$channelid=$this->mainchannel_short($lotteryname);
		
		$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.' ORDER BY id ASC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		if($channelid==$row[0][0])
		{
			return true;
		}
		
		return false;
		
	}

/////	
	public function if_maingroup_short($lotteryname)
	{
		$con_sql2=$this->cmd_sql();

		$tabgroups='tabgroups';
		
		$channelid=$this->maingroup_short($lotteryname);
		
		$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabgroups.' ORDER BY id ASC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		if($channelid==$row[0][0])
		{
			return true;
		}
		
		return false;
		
	}


	
												////////////USERS SHORT////////////
/////
	public function cmd_start_shortlottery($lotteryname)
	{
		$con_sql2=$this->cmd_sql();
		
		$tabusers='tabusers';
		$tabchannels='tabchannels';
		
		$chatid=$this->api->chatId;

		$result=json_decode($this->api->getChat([
		'chat_id' => $chatid
		]), true);

		$firstname=$result['result']['first_name'];
		
		if(!empty($result['result']['last_name']))
		{
			$lastname=$result['result']['last_name'];
		}
		else
		{
			$lastname="0";
		}
		
		if(!empty($result['result']['username']))
		{
			$username='@'.$result['result']['username'].'';
		}
		else
		{
			$username="0";
		}
			
	
		if($this->cmd_sql_searchchatidtable($chatid, $tabusers)==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabusers.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0",refer VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tabusers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
			usleep(250000);
		}
		
		
		$shortlottery='shortlottery'.$lotteryname.'';
		$shortuserslottery='shortuserslottery'.$lotteryname.'';
		$shortuserservice='shortuserservice'.$chatid.'';

		

		if($this->cmd_if_exists($shortlottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT startdate FROM '.$shortlottery.'');
			$con=mysqli_num_rows($query);
			
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$startdate=date("d.m.Y", strtotime($row[0][0]));
			
				$channelurl=$this->channel_url_short($lotteryname);
				$groupurl=$this->group_url_short($lotteryname);
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_short_status('.$lotteryname.')']] ];
				
				//$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_short_status('.$lotteryname.')']] ];
				
				//$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_short_status('.$lotteryname.')']] ];	
				
				
				/* if($this->inchannel_check_short($lotteryname, $chatid)==FALSE && $this->ingroup_check_short($lotteryname, $chatid)==FALSE)
				{
					
					$text='Чтобы принимать участие в розыгрышах, Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'chat_id' => $chatid,
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				} */
				if($this->inchannel_check_short($lotteryname, $chatid)==FALSE)
				{
					$text='Чтобы принимать участие в розыгрышах, Вам нужно <b>подписаться на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'chat_id' => $chatid,
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				/* elseif($this->ingroup_check_short($lotteryname, $chatid)==FALSE)
				{
					$text='Чтобы принимать участие в розыгрышах, Вам нужно <b>присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'chat_id' => $chatid,
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				} */
				
				elseif($this->cmd_sql_searchchatidtable($chatid, $shortuserslottery))
				{
					$lotna=preg_replace('/_.*/', '', $lotteryname);
					$lotna=$this->clean($lotna);
					
					$text='<b>Вы уже зарегистрированы</b> в данном розыгрыше!';
					
					$this->api->sendMessage([
					'chat_id' => $chatid,
					'text' => $text,
					//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$shortuserslottery.' LIKE '.$tabusers.'');
					
					mysqli_query($con_sql2, 'INSERT INTO '.$shortuserslottery.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
					usleep(250000);
					
					
					$query=mysqli_query($con_sql2, 'SELECT messid, channelid, buttontext, usermessage FROM '.$shortlottery.'');
					$con=mysqli_num_rows($query);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					$messageidlottery=$row[0][0];
					$channellottery=$row[0][1];
					$buttontext=$row[0][2];
					$usermessage=$row[0][3];
					
					
					$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$channellottery.'"');
					usleep(250000);
					$con2=mysqli_num_rows($query2);
					
					$row2=[];
					for($i2=0;$i2<$con2;$i2++)
					{
						mysqli_data_seek($query2, $i2);
						$row2[$i2]=mysqli_fetch_row($query2);
					}
					
					
					if(!empty($row2[0][1]))
					{
						$channeltext=''.$row2[0][0].' (@'.$row2[0][1].')';
					}
					else
					{
						$channeltext=''.$row2[0][0].'';
					}
					
					
					
					$con1=mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.''));
					
					$botusername=json_decode($this->api->getMe(), true);
					$botusername=$botusername['result']['username'];
					
					
					$urllottery='https://t.me/'.$botusername.'?start=shortlottery'.$lotteryname.'';
				
					$merge = [  [['text' => '🤝'.$buttontext.' (участников - '.$con1.')', 'url' => $urllottery ]] ];
					
					
					$this->api->editMessageReplyMarkup([
						'chat_id' => $channellottery,
						'message_id' => $messageidlottery,
						'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
					]);
					
					
					//$text=''.$usermessage.' от '.$startdate.'';
					$lotna=preg_replace('/_.*/', '', $lotteryname);
					$lotna=$this->clean($lotna);
					$text=''.$usermessage.' №'.$lotna.' от '.$startdate.' в канале '.$channeltext.'!';
					
					$this->api->sendMessage([
					'chat_id' => $chatid,
					'text' => $text,
					//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				
			
			
		}
		else
		{
			$text='<b>Розыгрыш, в котором Вы пытаетесь зарегистрироваться, не существует!</b>';
				
			$this->api->sendMessage([
			'chat_id' => $chatid,
			'text' => $text,
			//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}	



/////
	public function callback_refresh_short_status($lotteryname)
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}


		$this->cmd_start_shortlottery($lotteryname);
		
	}

												////////////END USERS SHORT////////////
												
												
												
												////////////ADMINS SHORT////////////
/////
	public function cmd_lottery_short()
	{	
		$text='<b>Выберите, что Вы хотите сделать</b>👇';

		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_short_main']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);	
	}


/////
	public function callback_lottery_change_short()
	{
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		if($this->cmd_if_exists($serviceshortlottery))
		{
			$this->cmd_lottery_create_short();
		}
		else
		{
			$text='<b>В данный момент у Вас нет созданного розыгрыша для отправки в канал!</b>';

			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_short_main']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);	
		}
		
		
		
	}


/////
	public function callback_lottery_delete_short()
	{

		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$text='<b>Выберите розыгрыш, который хотите удалить</b>👇';
		
		$merge=$this->cmd_lottery_short_choosedelete();
		usleep(250000);
		
		
		if(array_filter($merge)!==[])
		{
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		
		}
		else
		{
			$text='<b>В данный момент нет действующих розыгрышей!</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_short_main']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}		



/////
	public function cmd_lottery_short_choosedelete()
	{
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		$tabchannels='tabchannels';
		$merge=[];
		
		if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortlottery%_'.$chatid.'"'))))
		{
			$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortlottery%_'.$chatid.'"');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);

			}	
			
			$maxbuttons=1;
			$ceil=ceil($con/$maxbuttons);
			
			
			$u=0;
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{
					$query2=mysqli_query($con_sql2, 'SELECT startdate, lotteryname, channelid FROM '.$row[$u][0].'');
					usleep(250000);
					$con2=mysqli_num_rows($query2);
					
					$row2=[];
					
					for($i2=0;$i2<$con2;$i2++)
					{
						mysqli_data_seek($query2, $i2);
						$row2[$i2]=mysqli_fetch_row($query2);
					}
					
					$startdate=date("d.m.Y", strtotime($row2[0][0]));
					$lotteryname=$row2[0][1];
					
					$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$row2[0][1].'"');
					usleep(250000);
					$con2=mysqli_num_rows($query2);
					
					$row2=[];
					for($i2=0;$i2<$con2;$i2++)
					{
						mysqli_data_seek($query2, $i2);
						$row2[$i2]=mysqli_fetch_row($query2);
					}
					
					
					if(!empty($row2[0][1]))
					{
						$channeltext=''.$row2[0][0].' (@'.$row2[0][1].')';
					}
					else
					{
						$channeltext=''.$row2[0][0].'';
					}

					$buttext='№'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.'';
			
					$put[]=['text' => ''.$buttext.'', 'callback_data' => 'lot_short_chodelete('.$lotteryname.')'];
					
					$u++;	
				}
				
				$merge[]=$put;
				unset($put);
			}
		}
		
		return $merge;
	}		


/////
	public function callback_lot_short_chodelete($lotteryname)
	{	
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		$shortlottery='shortlottery'.$lotteryname.'_'.$chatid.'';
		$shortuserslottery='shortuserslottery'.$lotteryname.'_'.$chatid.'';
		$tabchannels='tabchannels';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$query=mysqli_query($con_sql2, 'SELECT channelid, startdate, messid, chatidadm FROM '.$shortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		
		$channelid=$row[0][0];
		$startdate=date("d.m.Y", strtotime($row[0][1]));
		$messageidchannel=$row[0][2];
		$chatidadm=$row[0][3];
		
		$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$channelid.'"');
		usleep(250000);
		$con2=mysqli_num_rows($query2);
		
		$row2=[];
		for($i2=0;$i2<$con2;$i2++)
		{
			mysqli_data_seek($query2, $i2);
			$row2[$i2]=mysqli_fetch_row($query2);
		}
		
		
		if(!empty($row2[0][1]))
		{
			$channeltext=''.$row2[0][0].' (@'.$row2[0][1].')';
		}
		else
		{
			$channeltext=''.$row2[0][0].'';
		}
		
		$text='К сожалению, <b>розыгрыш был отменен!</b>';
		
		
		$this->api->editMessageText([
			'chat_id' => $channelid,
			'message_id' => $messageidchannel,
			'text' => $text,
			'parse_mode' => "HTML",
		]);
		
		
		if(file_exists(''.dirname(__FILE__).'/pid'.$lotteryname.'_'.$chatid.'.txt'))
		{
			$pid=file_get_contents(''.dirname(__FILE__).'/pid'.$lotteryname.'_'.$chatid.'.txt');
			shell_exec('kill -9 '.$pid.'');
			sleep(1);
			unlink(''.dirname(__FILE__).'/pid'.$lotteryname.'_'.$chatid.'.txt');
			usleep(250000);
		}
			
		if(file_exists(''.dirname(__FILE__).'/shortlottery'.$lotteryname.'_'.$chatid.'.php'))
		{
			unlink(''.dirname(__FILE__).'/shortlottery'.$lotteryname.'_'.$chatid.'.php');
			usleep(250000);
		}
		
			
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$shortlottery.'');
		usleep(250000);
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$shortuserslottery.'');
		usleep(250000);
		
		if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortuserservice%_'.$chatid.'"'))))
		{
			$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortuserservice%_'.$chatid.'"');
			usleep(250000);
			$con=mysqli_num_rows($query);
				
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$row[$i][0].'');
			}	
		}
		usleep(250000);
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);

		$text='<b>Вы успешно удалили Розыгрыш №'.$lotteryname.' от '.$startdate.' из канала '.$channeltext.'!</b>';
		
		$this->api->sendMessage([
		'chat_id' => $chatidadm,
		'text' => $text,
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
			
		
	}


/////
	public function callback_lottery_stats_short()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$serviceshortlottery='serviceshortlottery';
		$tabserviceadmin='tabserviceadmin';
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$serviceshortlottery.'');
		usleep(250000);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_lottery_create_short();
	}	





/////
	public function callback_lottery_create_short()
	{
		
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$serviceshortlottery.'');
		usleep(250000);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_lottery_create_short();
	}

	
/////
	public function cmd_lottery_create_short()
	{	
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabchannels='tabchannels';
		$tabgroups='tabgroups';
		$historyshortlottery='historyshortlottery_'.$chatid.'';
		
		if($this->cmd_if_exists($serviceshortlottery)==FALSE)
		{
			/* mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$serviceshortlottery.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,adminchatid VARCHAR(15) DEFAULT "0",lotteryname VARCHAR(5) DEFAULT "0",channelid VARCHAR(15) DEFAULT "0",lotterytext VARCHAR(4000) DEFAULT "0",startdate VARCHAR(20) DEFAULT "0",enddate VARCHAR(20) DEFAULT "0",topplaces VARCHAR(10) DEFAULT "0",photos VARCHAR(150) DEFAULT "0",buttontext VARCHAR(30) DEFAULT "0",usermessage VARCHAR(4000) DEFAULT "0",messid VARCHAR(35) DEFAULT "0",results VARCHAR(4000) DEFAULT "0",groupid VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000); */
			
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$serviceshortlottery.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,adminchatid VARCHAR(15) DEFAULT "0",lotteryname VARCHAR(5) DEFAULT "0",channelid VARCHAR(15) DEFAULT "0",lotterytext VARCHAR(4000) DEFAULT "0",startdate VARCHAR(20) DEFAULT "0",enddate VARCHAR(20) DEFAULT "0",topplaces VARCHAR(10) DEFAULT "0",photos VARCHAR(150) DEFAULT "0",buttontext VARCHAR(30) DEFAULT "0",usermessage VARCHAR(4000) DEFAULT "0",messid VARCHAR(35) DEFAULT "0",results VARCHAR(4000) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			
			mysqli_query($con_sql2, 'INSERT INTO '.$serviceshortlottery.' (adminchatid) VALUES ("'.$chatid.'")');
			usleep(250000);	
		}	
			
			
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		
		if($this->cmd_if_exists($historyshortlottery)==FALSE)
		{
		
			if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortlottery%_'.$chatid.'"'))))
			{
				$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortlottery%_'.$chatid.'"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
			
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				
				sort($row1, SORT_NATURAL | SORT_FLAG_CASE);
				
				$last=str_replace('shortlottery', '', $row1[$con1-1][0]);
				$last=$this->clean($last);
				$last=$last+1;
				
				mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET lotteryname = REPLACE(lotteryname, "'.$row[0][2].'", "'.$last.'")');
				usleep(250000);
			}
			else
			{
				$last='1';
				
				mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET lotteryname = REPLACE(lotteryname, "'.$row[0][2].'", "'.$last.'")');
				usleep(250000);
			}
		}
		else
		{
			$query3=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$historyshortlottery.' ORDER BY lotteryname + 0 DESC');
			usleep(250000);
			$con3=mysqli_num_rows($query3);
			$row3=[];
			
			for($i3=0;$i3<$con3;$i3++)
			{
				mysqli_data_seek($query3, $i3);
				$row3[$i3]=mysqli_fetch_row($query3);
			}
			
			$last=$row3[0][0];
			$last=$last+1;
			
			if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortlottery%_'.$chatid.'"'))))
			{
				$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "shortlottery%_'.$chatid.'"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
			
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					$row1[$i1]=preg_replace('/_.*/', '', $row1[$i1]);
					$row1[$i1]=$this->clean($row1[$i1]);
				}
				
				sort($row1, SORT_NATURAL | SORT_FLAG_CASE);
				
				$addlast=str_replace('shortlottery', '', $row1[$con1-1][0]);
				$addlast=$this->clean($addlast);
				$last=$last+$addlast;
				
				mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET lotteryname = REPLACE(lotteryname, "'.$row[0][2].'", "'.$last.'")');
				usleep(250000);
			}
			else
			{
				mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET lotteryname = REPLACE(lotteryname, "'.$row[0][2].'", "'.$last.'")');
				usleep(250000);
			}
		}
		
		$lotteryname=$last;
		unset($last);
		
		
		$textall='<b>НОВЫЙ РОЗЫГРЫШ №'.$lotteryname.':</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
		
		
		
		if(!empty($row[0][3]))
		{
			$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$row[0][3].'"');
			usleep(250000);
			$con2=mysqli_num_rows($query2);
		
			$row2=[];
			for($i2=0;$i2<$con2;$i2++)
			{
				mysqli_data_seek($query2, $i2);
				$row2[$i2]=mysqli_fetch_row($query2);
			}
			
			
			if(!empty($row2[0][1]))
			{
				$channeltext=''.$row2[0][0].' (@'.$row2[0][1].')';
			}
			else
			{
				$channeltext=''.$row2[0][0].'';
			}
			
			$text='✅ <b>Канал розыгрыша:</b> '.$channeltext.''.PHP_EOL.''.PHP_EOL.'';
		}
		else
		{
			$channeltext='<i>данные отсутствуют</i>';
			$text='❌ <b>Канал розыгрыша:</b> '.$channeltext.''.PHP_EOL.''.PHP_EOL.'';
		}
		
		$textall=$textall . ''.$text.'';
		
		
		
		/* if(!empty($row[0][13]))
		{
			$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabgroups.' WHERE channelid="'.$row[0][13].'"');
			usleep(250000);
			$con2=mysqli_num_rows($query2);
		
			$row2=[];
			for($i2=0;$i2<$con2;$i2++)
			{
				mysqli_data_seek($query2, $i2);
				$row2[$i2]=mysqli_fetch_row($query2);
			}
			
			
			if(!empty($row2[0][1]))
			{
				$grouptext=''.$row2[0][0].' (@'.$row2[0][1].')';
			}
			else
			{
				$grouptext=''.$row2[0][0].'';
			}
			
			$text='✅ <b>Группа розыгрыша:</b> '.$grouptext.''.PHP_EOL.''.PHP_EOL.'';
		}
		else
		{
			$grouptext='<i>данные отсутствуют</i>';
			
			$text='❌ <b>Группа розыгрыша:</b> '.$grouptext.''.PHP_EOL.''.PHP_EOL.'';
		}
		
		$textall=$textall . ''.$text.''; */
		
		
		
		if(!empty($row[0][4]))
		{
			//$lotterytext=''.$row[0][4].'';
			$lotterytext=html_entity_decode($row[0][4], ENT_QUOTES);
			$text='✅ <b>Текст розыгрыша:</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.$lotterytext.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
		}
		else
		{
			$lotterytext='<i>данные отсутствуют</i>';
			$text='❌ <b>Текст розыгрыша:</b> '.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';
		}
		
		$textall=$textall . ''.$text.'';
		
		
		
		if(!empty($row[0][6]))
		{
			date_default_timezone_set('Europe/Kiev');
			$origin = new DateTime(date("d.m.Y G:i"));
			$target = new DateTime($row[0][6]);
			$interval = $origin->diff($target);
			
			$future=$interval->format('%R');
			
			if($future=="-")
			{
				$enddate=$row[0][6];
				$text='❌ <b>Дата и время окончания:</b> '.$enddate.''.PHP_EOL.''.PHP_EOL.'';
			}
			elseif($future=="+")
			{
				$enddate=$row[0][6];
				$text='✅ <b>Дата и время окончания:</b> '.$enddate.''.PHP_EOL.''.PHP_EOL.'';
			}
		}
		else
		{
			$enddate='<i>данные отсутствуют</i>';
			$text='❌ <b>Дата и время окончания:</b> '.$enddate.''.PHP_EOL.''.PHP_EOL.'';
		}
		
		$textall=$textall . ''.$text.'';
		
		
		
		if(!empty($row[0][7]))
		{
			$topplaces=$row[0][7];
			$text='✅ <b>Количество победителей:</b> '.$topplaces.''.PHP_EOL.''.PHP_EOL.'';
		}
		else
		{
			$topplaces='<i>данные отсутствуют</i>';
			$text='❌ <b>Количество победителей:</b> '.$topplaces.''.PHP_EOL.''.PHP_EOL.'';
		}
		
		$textall=$textall . ''.$text.'';
		
		
		
		if(!empty($row[0][8]))
		{
			//$photo=$row[0][8];
			$photo='Да';
		}
		else
		{
			$photo='Нет <i>(по умолчанию)</i>⚠️';
		}
		
		
				
		$text='✅ <b>Картинка:</b> '.$photo.''.PHP_EOL.''.PHP_EOL.'';
		$textall=$textall . ''.$text.'';
		
		if(!empty($row[0][8]))
		{
			$textall=$textall . '<a href="'.$row[0][8].'">&#160;</a>';
		}
		
		if(!empty($row[0][9]))
		{
			if($row[0][9]!="Участвовать!")
			{
				$buttontext=html_entity_decode($row[0][9], ENT_QUOTES);
				$text='✅ <b>Текст кнопки регистрации:</b> '.$buttontext.''.PHP_EOL.''.PHP_EOL.'';
			}
			else
			{
				$text='✅ <b>Текст кнопки регистрации: </b>Участвовать! <i>(по умолчанию)</i>⚠️'.PHP_EOL.''.PHP_EOL.'';
			
				/* mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET buttontext = REPLACE(buttontext, "'.$row[0][9].'", "Участвовать!")');
				usleep(250000); */
			}
		}
		else
		{
			$text='✅ <b>Текст кнопки регистрации: </b>Участвовать! <i>(по умолчанию)</i>⚠️'.PHP_EOL.''.PHP_EOL.'';
			
			mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET buttontext = REPLACE(buttontext, "'.$row[0][9].'", "Участвовать!")');
			usleep(250000);
		}
		
		$textall=$textall . ''.$text.'';
		
		
		if(!empty($row[0][10]))
		{
			if($row[0][10]!="Вы успешно зарегистрировались в розыгрыше")
			{
				//$usermessage=$row[0][10];
				$usermessage=html_entity_decode($row[0][10], ENT_QUOTES);
				$text='✅ <b>Сообщение при регистрации:</b> '.$usermessage.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			}
			else
			{
				$text='✅ <b>Сообщение при регистрации:</b> Вы успешно зарегистрировались в розыгрыше <i>(по умолчанию)</i>⚠️'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			
				/* mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET usermessage = REPLACE(usermessage, "'.$row[0][10].'", "Вы успешно зарегистрировались в розыгрыше")');
				usleep(250000); */
			}
		}
		else
		{
			$text='✅ <b>Сообщение при регистрации:</b> Вы успешно зарегистрировались в розыгрыше <i>(по умолчанию)</i>⚠️'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			
			mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET usermessage = REPLACE(usermessage, "'.$row[0][10].'", "Вы успешно зарегистрировались в розыгрыше")');
			usleep(250000);
		}
		
		$textall=$textall . ''.$text.'';
		
		if(!empty($row[0][6]))
		{
			date_default_timezone_set('Europe/Kiev');
			$origin = new DateTime(date("d.m.Y G:i"));
			$target = new DateTime($row[0][6]);
			$interval = $origin->diff($target);
			
			$future=$interval->format('%R');
			
			if($future=="-")
			{
				$text='Указанная дата и время окончания розыгрыша <b>"'.$row[0][6].'"</b> уже наступила, пожалуйста, <b>измените ее на дату в будущем</b>👇';
				$textall=$textall . ''.$text.'';	
			}
			elseif($future=="+")
			{
				if(empty($row[0][1]) || empty($row[0][2]) || empty($row[0][3]) || empty($row[0][4]) || empty($row[0][6]) || empty($row[0][7]))
				{
					$text='<b>Заполните все данные с отметкой ❌ для запуска розыгрыша!</b>';
				}
				else
				{
					$text='✅Вы заполнили все необходимые данные. <b>Теперь можно запустить розыгрыш в канал!</b>';
				}
				
				$textall=$textall . ''.$text.'';
			}
		}
		else
		{
			if(empty($row[0][1]) || empty($row[0][2]) || empty($row[0][3]) || empty($row[0][4]) || empty($row[0][6]) || empty($row[0][7]))
			{
				$text='<b>Заполните все данные с отметкой ❌ для запуска розыгрыша!</b>';
			}
			else
			{
				$text='✅Вы заполнили все необходимые данные. <b>Теперь можно запустить розыгрыш в канал!</b>';
			}
			
			$textall=$textall . ''.$text.'';
		}
		
		if(empty($row[0][1]) || empty($row[0][2]) || empty($row[0][3]) || empty($row[0][4]) || empty($row[0][6]) || empty($row[0][7]))
		{
			$this->api->sendMessage([
			'text' => $textall,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_short_lottery']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$this->api->sendMessage([
			'text' => $textall,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_short_lottery1']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		
	}


/////
	public function callback_lottery_short_channel()
	{
		$con_sql2=$this->cmd_sql();
		

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$text='<b>Выберите канал для проведения розыгрыша</b>👇';
		
		$merge=$this->cmd_lottery_short_choosechannel();
		usleep(250000);
		
		
		if(array_filter($merge)!==[])
		{
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		
		}
		else
		{
			$text='<b>Вы не добавили бота ни в один канал!</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_short_lottery']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
	}



/////
	public function cmd_lottery_short_choosechannel()
	{	
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$tabchannels='tabchannels';

		
		$query=mysqli_query($con_sql2, 'SELECT channelid,channeltitle,channelusername FROM '.$tabchannels.' WHERE chatid="'.$chatid.'"');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}	
		
		$maxbuttons=1;
		$ceil=ceil($con/$maxbuttons);
		
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{						
				if(!empty($row[$u][2]))
				{
					$buttext=''.$row[$u][1].' (@'.$row[$u][2].')';
				}
				else
				{
					$buttext=''.$row[$u][1].'';
				}
				
				
				$channelid=$row[$u][0];
		
				$put[]=['text' => ''.$buttext.'', 'callback_data' => 'lot_short_chochan('.$channelid.')'];
				
				$u++;	
			}
			
			$merge[]=$put;
			unset($put);
		}
		
		return $merge;
		
	}	


/////
	public function callback_lot_short_chochan($channelid)
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		
		$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
	
		mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET channelid = REPLACE(channelid, "'.$row[0][0].'", "'.$channelid.'")');
		usleep(250000);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_lottery_create_short();

	}



/////
/* 	public function callback_lottery_short_group()
	{
		$con_sql2=$this->cmd_sql();
		

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$text='<b>Выберите группу для проведения розыгрыша</b>👇';
		
		$merge=$this->cmd_lottery_short_choosegroup();
		usleep(250000);
		
		
		if(array_filter($merge)!==[])
		{
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		
		}
		else
		{
			$text='<b>Вы не добавили бота ни в одну группу!</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_short_lottery']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
	}



/////
	public function cmd_lottery_short_choosegroup()
	{	
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$tabgroups='tabgroups';
		
		$query=mysqli_query($con_sql2, 'SELECT channelid,channeltitle,channelusername FROM '.$tabgroups.' WHERE chatid="'.$chatid.'"');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}	
		
		$maxbuttons=1;
		$ceil=ceil($con/$maxbuttons);
		
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{						
				if(!empty($row[$u][2]))
				{
					$buttext=''.$row[$u][1].' (@'.$row[$u][2].')';
				}
				else
				{
					$buttext=''.$row[$u][1].'';
				}
				
				
				$groupid=$row[$u][0];
		
				$put[]=['text' => ''.$buttext.'', 'callback_data' => 'lot_short_chogro('.$groupid.')'];
				
				$u++;	
			}
			
			$merge[]=$put;
			unset($put);
		}
		
		return $merge;
		
	}	




/////
	public function callback_lot_short_chogro($groupid)
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		
		$query=mysqli_query($con_sql2, 'SELECT groupid FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
	
		mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET groupid = REPLACE(groupid, "'.$row[0][0].'", "'.$groupid.'")');
		usleep(250000);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_lottery_create_short();

	} */




/////
	public function callback_lottery_short_text()
	{
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
		usleep(250000);
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortlotterytext")');
		usleep(250000);
		
		
		$text='Отправьте сообщение с <b>текстом розыгрыша</b>👇';

		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}


/////
	public function cmd_lottery_short_text()
	{
		
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		
		$textmessage=$this->cmd_converttext();
		

		if(strlen($textmessage)>4000)
		{		
			$text='Вы ввели слишком длинный текст, максимальная длина 4000 символов.'.PHP_EOL.''.PHP_EOL.'Отправьте сообщение с <b>текстом розыгрыша</b>👇';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT lotterytext FROM '.$serviceshortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			
			/* mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET lotterytext = REPLACE(lotterytext, "'.$row[0][0].'", "'.html_entity_decode($textmessage, ENT_QUOTES).'")');
			usleep(250000); */
			
			mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET lotterytext = REPLACE(lotterytext, "'.$row[0][0].'", "'.htmlentities($textmessage, ENT_QUOTES).'")');
			usleep(250000);
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			
			$this->cmd_lottery_create_short();
			
		}
		
	}




/////
	public function callback_lottery_short_image()
	{
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
		usleep(250000);
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortlotteryimage")');
		usleep(250000);
		
		
		$text='Отправьте сообщение с <b>картинкой для розыгрыша</b>👇';

		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}




/////
	public function cmd_lottery_short_image()
	{
		if(!empty($this->api->body['message']['photo']))
		{
			if($this->api->getFile($this->api->body['message']['photo'])==FALSE)
			{
				$this->api->sendMessage([
				'text' => "Что-то пошло не так...",
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			$filesdir1=''.dirname(__FILE__).'/filestemp/';
			
			if($this->api->changePhoto($filesdir1))
			{
				usleep(250000);
			}
			
			$filesdir2=''.dirname(__FILE__).'/photos/';
			$files=glob(''.$filesdir2.'*.*');
			$filename1=''.end($files).'';
			$filename1=preg_replace('/.*\//', '', $filename1);
			$filedir1=str_replace(''.dirname(__FILE__).'', 'https://domain.com/miha2', $filesdir2);
			$photo="$filedir1$filename1";
			
			
			$con_sql2=$this->cmd_sql();
			$chatid=$this->api->chatId;
		
			$serviceshortlottery='serviceshortlottery_'.$chatid.'';
			$tabserviceadmin='tabserviceadmin_'.$chatid.'';
			
			$this->api->sendChatAction([
			'action'=> 'upload_photo'
			]);
			sleep(1);
	
	
			$query=mysqli_query($con_sql2, 'SELECT photos FROM '.$serviceshortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
				
			mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET photos = REPLACE(photos, "'.$row[0][0].'", "'.$photo.'")');
			usleep(250000);
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			
			$this->cmd_lottery_create_short();
		}
		else
		{
			$text='Вы прислали что-то не то... Отправьте сообщение с <b>картинкой для розыгрыша</b>👇';

		
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		
	}






/////
	public function callback_lottery_short_winners()
	{
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
		usleep(250000);
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortlotterytopplaces")');
		usleep(250000);
		
		
		$text='Отправьте сообщение с <b>количеством победителей</b>👇';

		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}


/////
	public function cmd_lottery_short_winners()
	{
		
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		$textmessage=$this->api->textmessage;
		
		if(preg_match('/^(\d{1,5})$/', $textmessage))
		{	
			$query=mysqli_query($con_sql2, 'SELECT topplaces FROM '.$serviceshortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			
			mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET topplaces = REPLACE(topplaces, "'.$row[0][0].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'")');
			usleep(250000);
			
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			
			$this->cmd_lottery_create_short();
		}
		else
		{
			$text='Вы ввели данные в неправильном формате, допускаются только числа длиной от 1 до 5 символов.'.PHP_EOL.''.PHP_EOL.'Отправьте сообщение с <b>количеством победителей</b>👇';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
		}
		
	}




/////
	public function callback_lottery_short_enddate()
	{
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
		usleep(250000);
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortlotteryenddate")');
		usleep(250000);
		
		
		$text='Введите <b>дату окончания розыгрыша</b> в формате дд.мм.гггг чч:мм или дд.мм.гггг чч.мм👇';

		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}



/////
	public function cmd_lottery_short_enddate()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		$textmessage=$this->api->textmessage;
		
		if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.[0-9]{4} ([01]?[0-9]|2[0-3])(\.|:)[0-5][0-9]$/", $textmessage))
		{
			date_default_timezone_set('Europe/Kiev');
			
			$origin = new DateTime(date("d.m.Y G:i"));
			$target = new DateTime($textmessage);
			$interval = $origin->diff($target);
		
			$future=$interval->format('%R');
		
			if($future=="-")
			{
				$text='Вы ввели дату в прошлом.'.PHP_EOL.''.PHP_EOL.'Введите <b>дату окончания розыгрыша в будущем</b> в формате дд.мм.гггг чч:мм или дд.мм.гггг чч.мм👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);	
			}
			elseif($future=="+")
			{
				$query=mysqli_query($con_sql2, 'SELECT enddate FROM '.$serviceshortlottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				
				mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET enddate = REPLACE(enddate, "'.$row[0][0].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'")');
				usleep(250000);
				
				
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
				usleep(250000);
				
				$this->cmd_lottery_create_short();
				
			}
			
		}
		else
		{
			$text='Вы ввели дату или время в неправильном формате.'.PHP_EOL.''.PHP_EOL.'Введите <b>дату окончания розыгрыша</b> в формате дд.мм.гггг чч:мм или дд.мм.гггг чч.мм👇';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}





/////
	public function callback_lottery_short_textbutton()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
		usleep(250000);
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortlotterytextbutton")');
		usleep(250000);
		
		
		$text='Введите название <b>кнопки регистрации</b> в розыгрыше👇';

		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}



/////
	public function cmd_lottery_short_textbutton()
	{
		
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		
		$textmessage=$this->api->textmessage;
		
		if(strlen($textmessage)>30)
		{		
			$text='Вы ввели слишком длинный текст, максимальная длина 30 символов.'.PHP_EOL.''.PHP_EOL.'Введите название <b>кнопки регистрации</b> в розыгрыше👇';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{	
			$query=mysqli_query($con_sql2, 'SELECT buttontext FROM '.$serviceshortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			
			mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET buttontext = REPLACE(buttontext, "'.$row[0][0].'", "'.htmlentities($textmessage, ENT_QUOTES).'")');
			usleep(250000);
			
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			
			$this->cmd_lottery_create_short();
		}
		
	}





/////
	public function callback_lottery_short_message()
	{
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
		usleep(250000);
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortlotterymessage")');
		usleep(250000);
		
		
		$text='Введите <b>сообщение участнику</b> после успешной регистрации в розыгрыше👇';

		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}



/////
	public function cmd_lottery_short_message()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		
		$textmessage=$this->cmd_converttext();
		
		if(strlen($textmessage)>4000)
		{		
			$text='Вы ввели слишком длинный текст, максимальная длина 4000 символов.'.PHP_EOL.''.PHP_EOL.'Введите <b>сообщение участнику</b> после успешной регистрации в розыгрыше👇';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{	
			$query=mysqli_query($con_sql2, 'SELECT usermessage FROM '.$serviceshortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			
			mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET usermessage = REPLACE(usermessage, "'.$row[0][0].'", "'.htmlentities($textmessage, ENT_QUOTES).'")');
			usleep(250000);
			
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			
			$this->cmd_lottery_create_short();
		}
		
	}




/////
	public function callback_lottery_short_cancel()
	{
		$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$query=mysqli_query($con_sql2, 'SELECT photos, lotteryname FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		if(!empty($row[0][0]))
		{
			$photopath=str_replace('https://domain.com/miha2', ''.dirname(__FILE__).'', $row[0][0]);
			unlink($photopath);
		}
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$serviceshortlottery.'');
		usleep(250000);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);
		
		$text='<b>Вы успешно отменили создание розыгрыша №'.$row[0][1].'!</b>';
			
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode($this->keyboards['default_admin']),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}


/////
	public function callback_lottery_short_send()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		$tabchannels='tabchannels';

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$lotteryname=$row[0][2];
		$channelid=$row[0][3];
		$startdate=date("d.m.Y");
		
		$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$channelid.'"');
		usleep(250000);
		$con2=mysqli_num_rows($query2);
		
		$row2=[];
		for($i2=0;$i2<$con2;$i2++)
		{
			mysqli_data_seek($query2, $i2);
			$row2[$i2]=mysqli_fetch_row($query2);
		}
		
		
		if(!empty($row2[0][1]))
		{
			$channeltext=''.$row2[0][0].' (@'.$row2[0][1].')';
		}
		else
		{
			$channeltext=''.$row2[0][0].'';
		}			
		
		
		if(!empty($row[0][1]) && !empty($row[0][2]) && !empty($row[0][3]) && !empty($row[0][4]) && !empty($row[0][6]) && !empty($row[0][7]) && !empty($row[0][9]) && !empty($row[0][10]))
		{
			date_default_timezone_set('Europe/Kiev');
			$origin = new DateTime(date("d.m.Y G:i"));
			$target = new DateTime($row[0][6]);
			$interval = $origin->diff($target);
		
			$future=$interval->format('%R');
		
			if($future=="-")
			{
				$this->cmd_lottery_create_short();
			}
			elseif($future=="+")
			{
			
				$textall=''.$row[0][4].''.PHP_EOL.'';
				$buttontext=$row[0][9];
				
				if(!empty($row[0][8]))
				{
					$textall=$textall . '<a href="'.$row[0][8].'">&#160;</a>';
				}
					
					
				$botusername=json_decode($this->api->getMe(), true);
				$botusername=$botusername['result']['username'];
						
				$urllottery='https://t.me/'.$botusername.'?start';
						
				$merge = [  [['text' => '🤝'.$buttontext.' (0 участников)', 'url' => $urllottery ]] ];
				
				$this->api->sendMessage([
				'text' => $textall,
				'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				////'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				
		
				$text='Так будет выглядеть розыгрыш №'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.'👆👆👆'.PHP_EOL.''.PHP_EOL.'<b>Запустить розыгрыш в канал?</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_short_confirm']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);	
			}
		}
		else
		{
			$this->cmd_lottery_create_short();
		}

	}


/////
	public function callback_short_lottery_send_confirm_no()
	{	
	
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		$tabchannels='tabchannels';

		
		$query=mysqli_query($con_sql2, 'SELECT lotteryname, channelid, startdate FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$lotteryname=$row[0][0];
		$channelid=$row[0][1];
		$startdate=date("d.m.Y", strtotime($row[0][2]));
		
		$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$channelid.'"');
		usleep(250000);
		$con2=mysqli_num_rows($query2);
		
		$row2=[];
		for($i2=0;$i2<$con2;$i2++)
		{
			mysqli_data_seek($query2, $i2);
			$row2[$i2]=mysqli_fetch_row($query2);
		}
		
		
		if(!empty($row2[0][1]))
		{
			$channeltext=''.$row2[0][0].' (@'.$row2[0][1].')';
		}
		else
		{
			$channeltext=''.$row2[0][0].'';
		}
		
		
		$text='<b>Вы успешно отменили отправку розыгрыша №'.$lotteryname.' от '.$startdate.' в канал '.$channeltext.'!</b>';
		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_short_lottery']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
		$this->cmd_lottery_create_short();
	}
	
	
/////
	public function callback_short_lottery_send_confirm_yes()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		$tabchannels='tabchannels';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		$tabusers='tabusers';
		$tabcasinousers='tabcasinousers';
		
		
		$query=mysqli_query($con_sql2, 'SELECT startdate FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET startdate = REPLACE(startdate, "'.$row[0][0].'", "'.date('d-m-Y').'")');
		usleep(250000);
		
		
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$serviceshortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		
		
		$query2=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$row[0][3].'"');
		usleep(250000);
		$con2=mysqli_num_rows($query2);
		
		$row2=[];
		for($i2=0;$i2<$con2;$i2++)
		{
			mysqli_data_seek($query2, $i2);
			$row2[$i2]=mysqli_fetch_row($query2);
		}
		
		
		if(!empty($row2[0][1]))
		{
			$channeltext=''.$row2[0][0].' (@'.$row2[0][1].')';
		}
		else
		{
			$channeltext=''.$row2[0][0].'';
		}					
		
		$chatidadm=$row[0][1];
		$lotteryname=$row[0][2];
		$channelid=$row[0][3];
		$lotterytext=$row[0][4];
		$startdate=date("d.m.Y", strtotime($row[0][5]));
		$enddate=$row[0][6];
		$topplaces=$row[0][7];
		$lotteryphoto=$row[0][8];
		$buttontext=$row[0][9];
		$usermessage=$row[0][10];
		
		$lotterydata=''.$lotteryname.'_'.$chatidadm.'';
		
		$shortuserslottery='shortuserslottery'.$lotteryname.'_'.$chatid.'';
		$shortlottery='shortlottery'.$lotteryname.'_'.$chatid.'';
		$historyshortlottery='historyshortlottery_'.$chatid.'';

		$textall=''.$lotterytext.''.PHP_EOL.'';
			
		if(!empty($lotteryphoto))
		{
			$textall=$textall . '<a href="'.$lotteryphoto.'">&#160;</a>';
		}

		
		$botusername=json_decode($this->api->getMe(), true);
		$botusername=$botusername['result']['username'];
	
		$urllottery='https://t.me/'.$botusername.'?start=shortlottery'.$lotterydata.'';
	
		$merge = [  [['text' => '🤝'.$buttontext.' (0 участников)', 'url' => $urllottery ]] ];
		
		
		$result=json_decode($this->api->sendMessage([
		'chat_id' => $channelid,
		'text' => $textall,
		'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
		////'disable_notification' => TRUE,
		////'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]), true);
		usleep(250000);
		
		$messageidlottery=$result['result']['message_id'];
		
		
		
		mysqli_query($con_sql2, 'UPDATE '.$serviceshortlottery.' SET messid = REPLACE(messid, "'.$row[0][11].'", "'.$messageidlottery.'")');
		usleep(250000);
		
		
		
		if($this->cmd_if_exists($shortlottery)==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$shortlottery.' LIKE '.$serviceshortlottery.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$shortlottery.'');
			usleep(250000);
			
		/* 	mysqli_query($con_sql2, 'INSERT INTO '.$shortlottery.' (adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results,groupid) SELECT adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results,groupid FROM '.$serviceshortlottery.''); */
			
			mysqli_query($con_sql2, 'INSERT INTO '.$shortlottery.' (adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results) SELECT adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results FROM '.$serviceshortlottery.'');
			usleep(250000);
		}
		
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$serviceshortlottery.'');
		usleep(250000);
		
		
		$text='<b>Вы успешно запустили</b> розыгрыш №'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.'!';
		
		
		$this->api->sendMessage([
		'chat_id' => $chatidadm,
		'text' => $text,
		//'reply_markup' => json_encode($this->keyboards['default_admin']),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(500000);
		

		file_put_contents(''.dirname(__FILE__).'/'.$shortlottery.'.txt', $enddate);

	}


/////
	public function cmd_finish_shortlot($lotterydata)
	{
		$con_sql2=$this->cmd_sql();
		
		$shortlottery='shortlottery'.$lotterydata.'';
		$shortuserslottery='shortuserslottery'.$lotterydata.'';
		$tabchannels='tabchannels';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$shortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$chatidadm=$row[0][1];
		$lotteryname=$row[0][2];
		$channelid=$row[0][3];
		$lotterytext=$row[0][4];
		$startdate=date("d.m.Y", strtotime($row[0][5]));
		$enddate=$row[0][6];
		$topplaces=$row[0][7];
		$lotteryphoto=$row[0][8];
		$buttontext=$row[0][9];
		$usermessage=$row[0][10];
		$messageidlottery=$row[0][11];
		$results=$row[0][12];
		
		$query1=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$channelid.'"');
		usleep(250000);
		$con1=mysqli_num_rows($query1);
		
		$row1=[];
		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
		}
		
		$channeltitle=$row1[0][0];
		$channelusername=$row1[0][1];
		
		$channeltext=$channeltitle;
		
		if($channelusername)
		{
			$channeltext=''.$channeltitle.' (@'.$channelusername.')';
		}
		
	
		
		if($this->cmd_if_empty($shortuserslottery))
		{
			$textall='<b>Розыгрыш отменен. К сожалению, никто не зарегистрировался!!</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			
			$textall=$textall . ''.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';
			
			if(!empty($lotteryphoto))
			{
				$textall=$textall . '<a href="'.$lotteryphoto.'">&#160;</a>';
			}
			
			$this->api->editMessageText([
			'chat_id' => $channelid,
			'message_id' => $messageidlottery,
			'text' => $textall,
			'parse_mode' => "HTML",
			]);
			
			$text='<b>Розыгрыш №'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.' отменен!</b> К сожалению, никто не зарегистрировался.';
			
			$this->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $text,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$shortlottery.'');
			usleep(250000);
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$shortuserslottery.'');
			usleep(250000);
					
			$this->cmd_delete_shortlottery($lotterydata);
			
		}
		else
		{
			
			$textall='<i>Регистрация приостановлена</i>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			
			$textall=$textall . ''.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';
			
			if(!empty(''.$lotteryphoto.''))
			{
				$textall=$textall . '<a href="'.$lotteryphoto.'">&#160;</a>';
			}
			
			$this->api->editMessageText([
			'chat_id' => $channelid,
			'message_id' => $messageidlottery,
			'text' => $textall,
			'parse_mode' => "HTML",
			]);
			
			if(empty($results))
			{
				$text='<b>Розыгрыш №'.$lotteryname.'</b> от '.$startdate.' в канале '.$channeltext.' успешно завершен! Начат подсчет победителей.';
				
				$this->api->sendMessage([
				'chat_id' => $chatidadm,
				'text' => $text,
				//'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(250000);
			}
			
		
			
	
			$query10=mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.'');
			usleep(250000);
			$con10=mysqli_num_rows($query10);
			
			
			$usersarray=[];
			$row10=[];
			
			for($i10=0;$i10<$con10;$i10++)
			{
				mysqli_data_seek($query10, $i10);
				$row10[$i10]=mysqli_fetch_row($query10);
				
				$usersarray[]=$row10[$i10][0];
			}
			
			$count=count($usersarray);
			
			if($count<$topplaces)
			{
				$topplaces=$count;
			}
			
			$winners=[];
	
			
			for($i=0;$i<$topplaces;$i++)
			{
				$usersarray=array_values($usersarray);
	
				$rand=mt_rand(0, count($usersarray)-1);
				
				$winners[]=$usersarray[$rand];
				
				if($topplaces>1)
				{
					$textidwinners=$textidwinners . ''.$usersarray[$rand].',';
				}
				elseif($topplaces==1)
				{
					$textidwinners=$usersarray[$rand];
				}
				
				unset($usersarray[$rand]);
			}
			
			
			$con_sql2=$this->cmd_sql();
			
			$textfinish='👇<b>Победители розыгрыша №'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.'</b>👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			
			$textresults="";
			//$chatidwinners=[];
			$count=count($winners);
			
			for($y=0;$y<$count;$y++)
			{
				//$chatidwinners[]=$winners[$y];
				$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$shortuserslottery.' WHERE chatid="'.$winners[$y].'"');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
					
					$chatid=$winners[$y];
					$firstname=$row[$i][0];
					$lastname=$row[$i][1];
					$username=$row[$i][2];
					

					if(!empty($username))
					{
						$putuser=$username;
						$text=$putuser;
					}
					elseif(empty($lastname))
					{
						$putuser=$firstname;
						$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
					}
					else
					{
						$putuser=''.$firstname.' '.$lastname.'';
						$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
					}
					

					$textfinish=$textfinish . ''.$text.''.PHP_EOL.'';
					$textresults=$textresults . ''.$text.''.PHP_EOL.'';
					
					
					if(strlen($textfinish)>3500 && strlen($textfinish)<4000)
					{
						
						$this->api->sendMessage([
						'chat_id' => $chatidadm,
						'text' => $textfinish,
						//'reply_markup' => json_encode($this->keyboards['default_admin']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(250000);
						
						
						$textfinish="";
					}
				}
			}
			
			
			if(!empty($textfinish))
			{
				$this->api->sendMessage([
				'chat_id' => $chatidadm,
				'text' => $textfinish,
				//'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			
			$query4=mysqli_query($con_sql2, 'SELECT results, usermessage FROM '.$shortlottery.'');
			usleep(250000);
			$con4=mysqli_num_rows($query4);
			
			for($i4=0;$i4<$con4;$i4++)
			{
				mysqli_data_seek($query4, $i4);
				$row4[$i4]=mysqli_fetch_row($query4);
			}
			
			/* mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET results = REPLACE(results, "'.$row4[0][0].'", "'.$textresults.'")');
			usleep(450000); */
			
			mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET results = REPLACE(results, "'.$row4[0][0].'", "'.implode(",", $winners).'")');
			usleep(450000);
			
			mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET usermessage = REPLACE(usermessage, "'.$row4[0][1].'", "'.implode(",", $winners).'")');
			usleep(450000);
			
			$merge=[];
			$merge[]= [['text' => '🟢Да', 'callback_data' => 'short_results_yes('.$lotterydata.')'], ['text' => '🔴Нет', 'callback_data' => 'short_results_no('.$lotterydata.')']];
			
			
			$textadmin='Сверху Вы можете увидеть список победителей розыгрыша №'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.'👆👆👆'.PHP_EOL.'<b>Вас устраивают такие результаты?</b>';
	
			$this->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textadmin,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_short_confirm_finish']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			//$this->cmd_delete_shortlottery(''.$lotterydata.'');
		}
	}



/////
	public function callback_short_results_yes($lotterydata)
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		//$chatid=$this->api->chatId;

		$con_sql2=$this->cmd_sql();
		$chatid=preg_replace('/.*_/', '', $lotterydata);
		$chatid=$this->clean($chatid);
		
		$shortuserslottery='shortuserslottery'.$lotterydata.'';
		$shortlottery='shortlottery'.$lotterydata.'';
		$historyshortlottery='historyshortlottery_'.$chatid.'';
		$tabusers='tabusers';
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		$serviceshortlottery='serviceshortlottery_'.$chatid.'';
		
		$tabchannels='tabchannels';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$shortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$chatidadm=$row[0][1];
		$lotteryname=$row[0][2];
		$channelid=$row[0][3];
		$lotterytext=$row[0][4];
		$startdate=date("d.m.Y", strtotime($row[0][5]));
		$enddate=$row[0][6];
		$topplaces=$row[0][7];
		$lotteryphoto=$row[0][8];
		$buttontext=$row[0][9];
		$usermessage=$row[0][10];
		$messageidlottery=$row[0][11];
		$results=$row[0][12];
		
		
		$query1=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$channelid.'"');
		usleep(250000);
		$con1=mysqli_num_rows($query1);
		
		$row1=[];
		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
		}
		
		$channeltitle=$row1[0][0];
		$channelusername=$row1[0][1];
		
		$channeltext=$channeltitle;
		
		if($channelusername)
		{
			$channeltext=''.$channeltitle.' (@'.$channelusername.')';
		}
		
	
		
	/* 	$textfinish='<b>Розыгрыш №'.$lotteryname.' в канале '.$channeltext.' от '.$startdate.' успешно завершен!</b> Результаты будут размещены в канале!'.PHP_EOL.''.PHP_EOL.'👇Победители розыгрыша №'.$lotteryname.' от '.$startdate.'!!👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.$results.'';
		
		$this->api->sendMessage([
		'chat_id' => $chatidadm,
		'text' => $textfinish,
		//'reply_markup' => json_encode($this->keyboards['default_admin']),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		 */
		
		$textfinish='👇<b>Победители розыгрыша</b> от '.$startdate.'!!👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';

		
		$winners=explode(",", $results);
		
		$count=count($winners);
		
		for($y=0;$y<$count;$y++)
		{
		
			$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$shortuserslottery.' WHERE chatid="'.$winners[$y].'"');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$chatid=$winners[$y];
				$firstname=$row[$i][0];
				$lastname=$row[$i][1];
				$username=$row[$i][2];
				
		
				if(!empty($username))
				{
					$putuser=$username;
					$text=$putuser;
				}
				elseif(empty($lastname))
				{
					$putuser=$firstname;
					$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
				}
				else
				{
					$putuser=''.$firstname.' '.$lastname.'';
					$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
				}
				
		
				$textfinish=$textfinish . ''.$text.''.PHP_EOL.'';
							
				
				if(strlen($textfinish)>3500 && strlen($textfinish)<4000)
				{
					
					/* $this->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $textfinish,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(250000); */
					
					
					$result=json_decode($this->api->sendMessage([
					'chat_id' => $channelid,
					'text' => $textfinish,
					'parse_mode'=> 'HTML'
					]), true);
					usleep(250000);
					
					if(empty($mesidresults))
					{
						$mesidresults=$result['result']['message_id'];
					}
					
					/* $this->api->pinChatMessage([
					'chat_id' => $channelid,
					'message_id'=> $mesidresults
					]);
					usleep(250000); */
		
					$textfinish="";
				}
			}
		}
		
		
		if(!empty($textfinish))
		{
			/* $this->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textfinish,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]); */
			
			$result=json_decode($this->api->sendMessage([
			'chat_id' => $channelid,
			'text' => $textfinish,
			'parse_mode'=> 'HTML'
			]), true);
			usleep(250000);
			
			$mesidresul=$result['result']['message_id'];
			
			if(empty($mesidresults))
			{
				$mesidresults=$mesidresul;
			}
			
			/* $this->api->pinChatMessage([
			'chat_id' => $channelid,
			'message_id'=> $mesidresul
			]);
			usleep(250000); */
		}
		
		
		$result=json_decode($this->api->getChat([
		'chat_id' => $channelid
		]), true);
		
		$channelusername=$result['result']['username'];
		
		$resultsurl='https://t.me/'.$channelusername.'/'.$mesidresults.'';
		
		$merge = [  [['text' => 'Посмотреть результаты', 'url' => $resultsurl]] ];
		
		
		$textall="";
		$text='<b>Розыгрыш завершен!</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
		$textall=$textall . ''.$text.'';
		
		$textall=$textall . ''.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';
		
		if($lotteryphoto)
		{
			$text='<a href="'.$lotteryphoto.'">&#160;</a>';
			$textall=$textall . ''.$text.'';
		}
		
		$this->api->editMessageText([
			'chat_id' => $channelid,
			'message_id' => $messageidlottery,
			'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
			'text' => $textall,
			'parse_mode' => "HTML",
		]);
		
		
		$textadmin='Результаты розыгрыша №'.$lotteryname.' в канале '.$channeltext.' от '.$startdate.' успешно размещены в канале!';
		
		
		$this->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textadmin,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		
		usleep(250000);
		
		
			
		
		if(preg_match('/,/', $results))
		{
			$alldata=explode(',', $results);
		}
		else
		{
			$alldata=[];
			$alldata[]=$results;
		}
		
		$textuserswinners='Розыгрыш №'.$lotteryname.' в канале '.$channeltext.' от '.$startdate.' завершен!'.PHP_EOL.''.PHP_EOL.'<b>Поздравляю! Вы стали победителем!</b>';
		
		foreach($alldata as $data)
		{				
			$this->api->sendMessage([
			'chat_id' => $data,
			'text' => $textuserswinners,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(250000);
		}
		
		
		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$historyshortlottery.' LIKE '.$shortlottery.'');
		usleep(250000);
		
		/* mysqli_query($con_sql2, 'INSERT INTO '.$historyshortlottery.' (adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results,groupid) SELECT adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results,groupid FROM '.$shortlottery.''); */
		
		mysqli_query($con_sql2, 'INSERT INTO '.$historyshortlottery.' (adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results) SELECT adminchatid,lotteryname,channelid,lotterytext,startdate,enddate,topplaces,photos,buttontext,usermessage,messid,results FROM '.$shortlottery.'');
		usleep(250000);
		
		
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$shortlottery.'');
		usleep(250000);
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$shortuserslottery.'');
		usleep(250000);
				
		$this->cmd_delete_shortlottery($lotterydata);
		
	}


/////
	public function callback_short_results_no($lotterydata)
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}


		$text='<b>Выбирите, что Вы хотите сделать?</b>';
		
		
		$merge=[  [['text' => 'Прислать результаты вручную', 'callback_data' => 'short_manual_results('.$lotterydata.')']], [['text' => 'Сгенерировать новые результаты', 'callback_data' => 'short_generate('.$lotterydata.')']]  ];
		
		$this->api->sendMessage([
		//'chat_id' => $chatidadm,
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}

/////
	public function callback_short_generate($lotterydata)
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_finish_shortlot($lotterydata);
	}
	
/////
	public function callback_short_manual_results($lotterydata)
	{
				
		$con_sql2=$this->cmd_sql();
		
		$chatid=preg_replace('/.*_/', '', $lotterydata);
		$chatid=$this->clean($chatid);
		
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		$lotteryname=preg_replace('/_.*/', '', $lotterydata);
		$lotteryname=$this->clean($lotteryname);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortmanual'.$lotterydata.'")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("shortmanual'.$lotterydata.'")');
			usleep(250000);
		}
		
		
		$text='<b>Пришлите список победителей</b>, указав телеграм чат ID или юзернейм пользователя. Например: <i>3458723682,@username1,@username2,9283477123</i>👇';
		
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);

	}


/////
	public function cmd_short_manual_results($lotterydata)
	{
		$textmessage=$this->api->textmessage;
		
		$con_sql2=$this->cmd_sql();
		
		$shortlottery='shortlottery'.$lotterydata.'';
		$shortuserslottery='shortuserslottery'.$lotterydata.'';
		$tabchannels='tabchannels';
		
		$chatid=preg_replace('/.*_/', '', $lotterydata);
		$chatid=$this->clean($chatid);
		$tabserviceadmin='tabserviceadmin_'.$chatid.'';
		
		$query=mysqli_query($con_sql2, 'SELECT topplaces FROM '.$shortlottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$topplaces=$row[0][0];
		
		if(preg_match('/,/', $textmessage))
		{
			$a=1;
			
			$alldata=explode(',', $textmessage);
			
			if(count($alldata)!=$topplaces)
			{
				$a=0;
			}
			else
			{
				foreach($alldata as $data)
				{
					$data=$this->clean($data);
					
					if(preg_match('/^\d{9,11}$/', $data))
					{
						
						if(empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.' WHERE chatid="'.$data.'" LIMIT 1'))))
						{
							$a=0;
							break;
						}
					}
					elseif(preg_match('/^@\w{3,35}$/', $data))
					{
						
						if(empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.' WHERE username="'.$data.'" LIMIT 1'))))
						{
							$a=0;
							break;
						}
					}
					else
					{
						$a=0;
						break;
					}
				}
			}
			
			
		}
		else
		{
			$a=1;
			
			$alldata=[];
			$alldata[]=$textmessage;
			$data=$textmessage;
			
			if(count($alldata)!=$topplaces)
			{
				$a=0;
				
			}
			elseif(preg_match('/^\d{9,11}$/', $data))
			{
				
				if(empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.' WHERE chatid="'.$data.'" LIMIT 1'))))
				{
					$a=0;
				}
			}
			elseif(preg_match('/^@\w{3,35}$/', $data))
			{
				
				if(empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.' WHERE username="'.$data.'" LIMIT 1'))))
				{
					$a=0;
				}
			}
			else
			{
				$a=0;
			}
			
		}
		
		
		
		if(empty($a))
		{
			$text='Вы ввели данные в неправильном формате.'.PHP_EOL.''.PHP_EOL.'<b>Пришлите список победителей</b>, указав телеграм чат ID или юзернейм пользователя. Например: <i>3458723682,@username1,@username2,9283477123</i>👇';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{	
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$shortlottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$chatidadm=$row[0][1];
			$lotteryname=$row[0][2];
			$channelid=$row[0][3];
			$lotterytext=$row[0][4];
			$startdate=date("d.m.Y", strtotime($row[0][5]));
			$enddate=$row[0][6];
			$topplaces=$row[0][7];
			$lotteryphoto=$row[0][8];
			$buttontext=$row[0][9];
			$usermessage=$row[0][10];
			$messageidlottery=$row[0][11];
			$usersarray=[];
			
			$query1=mysqli_query($con_sql2, 'SELECT channeltitle,channelusername FROM '.$tabchannels.' WHERE channelid="'.$channelid.'"');
			usleep(250000);
			$con1=mysqli_num_rows($query1);
			
			$row1=[];
			for($i1=0;$i1<$con1;$i1++)
			{
				mysqli_data_seek($query1, $i1);
				$row1[$i1]=mysqli_fetch_row($query1);
			}
			
			$channeltitle=$row1[0][0];
			$channelusername=$row1[0][1];
			
			$channeltext=$channeltitle;
			
			if($channelusername)
			{
				$channeltext=''.$channeltitle.' (@'.$channelusername.')';
			}
			
			foreach($alldata as $data)
			{
				if(preg_match('/^\d{9,11}$/', $data))
				{
					$usersarray[]=$data;	
				}
				elseif(preg_match('/^@\w{3,35}$/', $data))
				{
					$query2=mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.' WHERE username="'.$data.'"');
					usleep(250000);
					$con2=mysqli_num_rows($query2);
					
					$row2=[];
					
					for($i2=0;$i2<$con2;$i2++)
					{
						mysqli_data_seek($query2, $i2);
						$row2[$i2]=mysqli_fetch_row($query2);
					}
					
					$usersarray[]=$row2[0][0];
				}
			}
			
			$count=count($usersarray);
			
			if($count<$topplaces)
			{
				$topplaces=$count;
			}
			
			$winners=[];
	
			
			for($i=0;$i<$topplaces;$i++)
			{
				$usersarray=array_values($usersarray);
	
				$rand=mt_rand(0, count($usersarray)-1);
				
				$winners[]=$usersarray[$rand];
				
				if($topplaces>1)
				{
					$textidwinners=$textidwinners . ''.$usersarray[$rand].',';
				}
				elseif($topplaces==1)
				{
					$textidwinners=$usersarray[$rand];
				}
				
				unset($usersarray[$rand]);
			}
			
			
			
			
			$textfinish='👇<b>Результаты розыгрыша №'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.'</b>👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			$textresults="";
			//$chatidwinners=[];
			$count=count($winners);
			
			for($y=0;$y<$count;$y++)
			{
				//$chatidwinners[]=$winners[$y];
				$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$shortuserslottery.' WHERE chatid="'.$winners[$y].'"');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
					
					$chatid=$winners[$y];
					$firstname=$row[$i][0];
					$lastname=$row[$i][1];
					$username=$row[$i][2];
					

					if(!empty($username))
					{
						$putuser=$username;
						$text=$putuser;
					}
					elseif(empty($lastname))
					{
						$putuser=$firstname;
						$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
					}
					else
					{
						$putuser=''.$firstname.' '.$lastname.'';
						$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
					}
					

					$textfinish=$textfinish . ''.$text.''.PHP_EOL.'';
					$textresults=$textresults . ''.$text.''.PHP_EOL.'';
					
					
					if(strlen($textfinish)>3500 && strlen($textfinish)<4000)
					{
						
						$this->api->sendMessage([
						'chat_id' => $chatidadm,
						'text' => $textfinish,
						//'reply_markup' => json_encode($this->keyboards['default_admin']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(250000);
						
						
						$textfinish="";
					}
				}
			}
			
			
			if(!empty($textfinish))
			{
				$this->api->sendMessage([
				'chat_id' => $chatidadm,
				'text' => $textfinish,
				//'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			
			$query4=mysqli_query($con_sql2, 'SELECT results, usermessage FROM '.$shortlottery.'');
			usleep(250000);
			$con4=mysqli_num_rows($query4);
			
			for($i4=0;$i4<$con4;$i4++)
			{
				mysqli_data_seek($query4, $i4);
				$row4[$i4]=mysqli_fetch_row($query4);
			}
			
			/* mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET results = REPLACE(results, "'.$row4[0][0].'", "'.$textresults.'")');
			usleep(450000); */
			
			mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET results = REPLACE(results, "'.$row4[0][0].'", "'.implode(",", $winners).'")');
			usleep(450000);
			
			mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET usermessage = REPLACE(usermessage, "'.$row4[0][1].'", "'.implode(",", $winners).'")');
			usleep(450000);
			
			
			mysqli_query($con_sql2, 'DROP TABLE '.$tabserviceadmin.'');
			usleep(250000);
			
			$merge=[];
			$merge[]= [['text' => '🟢Да', 'callback_data' => 'short_results_yes('.$lotterydata.')'], ['text' => '🔴Нет', 'callback_data' => 'short_results_no('.$lotterydata.')']];
			
			
			$textadmin='Сверху Вы можете увидеть список победителей розыгрыша №'.$lotteryname.' от '.$startdate.' в канале '.$channeltext.'👆👆👆'.PHP_EOL.'<b>Вас устраивают такие результаты?</b>';
	
			$this->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textadmin,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_short_confirm_finish']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}
/* 
/////
	public function cmd_short_manual_results($lotteryname)
	{
		$textmessage=$this->api->textmessage;
		
		
		if(preg_match('/,/', $textmessage))
		{
			$a=1;
			
			$alldata=explode(',', $textmessage);
			
			foreach($alldata as $data)
			{
				$data=$this->clean($data);
				
				if(preg_match('/^\d{9,11}$/', $data)==FALSE || preg_match('/^@\w{3,35}$/', $data)==FALSE)
				{
					$a=0;
					break;
				}
			}
		}
		
		if(empty($a))
		{
			$text='Вы ввели данные в неправильном формате.'.PHP_EOL.''.PHP_EOL.'<b>Пришлите список победителей</b>, указав телеграм чат ID или юзернейм пользователя. Например: <i>3458723682,@username1,@username2,9283477123</i>👇';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{	
			$con_sql2=$this->cmd_sql();
			
			$chatidadm=$this->api->chatId;
			
			$shortuserslottery='shortuserslottery'.$lotteryname.'_'.$chatidadm.'';
			$shortlottery='shortlottery'.$lotteryname.'_'.$chatidadm.'';
			$tabcasinousers='tabcasinousers';
			
			$query2=mysqli_query($con_sql2, 'SELECT startdate, topplaces FROM '.$shortlottery.'');
			usleep(250000);
			$con2=mysqli_num_rows($query2);
			
			$row2=[];
			
			for($i2=0;$i2<$con2;$i2++)
			{
				mysqli_data_seek($query2, $i2);
				$row2[$i2]=mysqli_fetch_row($query2);
			}
			
			$startdate=$row2[0][0];
			$topplaces=$row2[0][1];
					
			$textfinish='👇<b>Победители розыгрыша</b> №'.$lotteryname.' от '.$startdate.'!!👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
		
			$textresults="";
			$textresults1="";
			$textidwinners="";
			
			$alldata=explode(',', $textmessage);
			
			foreach($alldata as $data)
			{
				
				if(preg_match('/^\d{9,11}$/', $data))
				{
					$chatid=$data;	
				}
				elseif(preg_match('/^@\w{3,35}$/', $data))
				{
					$query2=mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.' WHERE username="'.$data.'"');
					usleep(250000);
					$con2=mysqli_num_rows($query2);
					
					$row2=[];
					
					for($i2=0;$i2<$con2;$i2++)
					{
						mysqli_data_seek($query2, $i2);
						$row2[$i2]=mysqli_fetch_row($query2);
					}
					
					$chatid=$row2[0][0];
				}
				
				
				if($topplaces>1)
				{
					$textidwinners=$textidwinners . ''.$chatid.',';
				}
				elseif($topplaces==1)
				{
					$textidwinners=$chatid;
				}
				
				$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$shortuserslottery.' WHERE chatid="'.$chatid.'"');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$emptyprofile="";
				
				$row=[];
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
					
				$firstname=$row[0][0];
				$lastname=$row[0][1];
				$username=$row[0][2];
				
				
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
				usleep(250000);
				$con3=mysqli_num_rows($query3);
				
				$row3=[];
				
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
				
				$casinoid=$row3[0][2];
				$casinofirstname=$row3[0][3];
				$casinolastname=$row3[0][4];
				$casinophone=$row3[0][5];
				$casinoemail=$row3[0][6];
				$casinodeposit=$row3[0][7];
				$casinodepositquan=$row3[0][9];
				$casinobirthday=$row3[0][10];
				
				if(empty($casinofirstname))
				{
					$emptyprofile=$emptyprofile . "имя;";
				}
				if(empty($casinolastname))
				{
					$emptyprofile=$emptyprofile . "фамилия;";
				}
				if(empty($casinobirthday))
				{
					$emptyprofile=$emptyprofile . "День Рождения;";
				}
				
				if(empty($casinophone))
				{
					$emptyphone="номер телефона не указан";
				}
				elseif($casinophone=="1")
				{
					$emptyphone="номер телефона не подтвержден";
				}
				
				if(empty($casinoemail))
				{
					$emptyemail="почта не указана";
				}
				elseif($casinophone=="1")
				{
					$emptyemail="почта не подтверждена";
				}
				
				if($casinodeposit<5)
				{
					$emptydeposit="нет минимального депозита";
				}
				
				
				
				
				$textadd="";
				
				if(empty($emptyprofile))
				{
					$text="✅Профиль";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Профиль ($emptyprofile)";
					$textadd=$textadd . ''.$text.'';
				}
				
				
				if(empty($emptyphone))
				{
					$text="✅Телефон";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Телефон ($emptyphone)";
					$textadd=$textadd . ''.$text.'';
				}
				
				
				if(empty($emptyemail))
				{
					$text="✅Почта";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Почта ($emptyemail)";
					$textadd=$textadd . ''.$text.'';
				}
				
				
				if(empty($emptydeposit))
				{
					$text="✅Мин. депозит";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Мин. депозит ($emptydeposit)";
					$textadd=$textadd . ''.$text.'';
				}
				
				
				
				
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
					
					$text=''.$putuser.'';
				}
				elseif(empty($lenusername))
				{
					$putuser=$firstname;
					
					if(!empty($lastname))
					{
						$putuser=''.$firstname.' '.$lastname.'';
					}
					
					$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
				}
				elseif($lenusername<$lenfio)
				{
					$putuser=$username;
					
					$text=''.$putuser.'';
				}
				elseif($lenusername>$lenfio)
				{
					$putuser=$firstname;
					
					if(!empty($lastname))
					{
						$putuser=''.$firstname.' '.$lastname.'';
					}
					
					$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
					
				}
				elseif($lenusername==$lenfio)
				{
					$putuser=$username;
					
					$text=''.$putuser.'';
				}
				
				$textresults=$textresults . ''.$text.' - '.$textadd.''.PHP_EOL.'';
				$textresults1=$textresults1 . ''.$text.''.PHP_EOL.'';
				//$textfinish=$textfinish . ''.$text.' - '.$textadd.''.PHP_EOL.'';
				$textfinish=$textfinish . ''.$text.''.PHP_EOL.'';
				
				
				
				if(strlen($textfinish)>3500 && strlen($textfinish)<4000)
				{
					
					$this->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $textfinish,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(250000);
					
					
					$textfinish="";
				}
			}
			
		
			if(!empty($textfinish))
			{
				$this->api->sendMessage([
				'chat_id' => $chatidadm,
				'text' => $textfinish,
				//'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		
			$query4=mysqli_query($con_sql2, 'SELECT results, usermessage, buttontext FROM '.$shortlottery.'');
			usleep(250000);
			$con4=mysqli_num_rows($query4);
			
			for($i4=0;$i4<$con4;$i4++)
			{
				mysqli_data_seek($query4, $i4);
				$row4[$i4]=mysqli_fetch_row($query4);
			}
			
			mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET results = REPLACE(results, "'.$row4[0][0].'", "'.$textresults.'")');
			usleep(450000);
			mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET usermessage = REPLACE(usermessage, "'.$row4[0][1].'", "'.$textresults1.'")');
			usleep(450000);
			mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET buttontext = REPLACE(buttontext, "'.$row4[0][2].'", "'.$textidwinners.'")');
			usleep(450000);
			
			$merge=[];
			$merge[]= [['text' => '🟢Да', 'callback_data' => 'short_results_yes('.$lotteryname.')'], ['text' => '🔴Нет', 'callback_data' => 'short_results_no('.$lotteryname.')']];
			
			$textadmin='Сверху Вы можете увидеть список победителей розыгрыша №'.$lotteryname.' от '.$startdate.'👆👆👆'.PHP_EOL.'<b>Вас устраивают такие результаты?</b>';
			
			$this->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textadmin,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_short_confirm_finish']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}	
	}

 */

/////
	/* public function callback_short_generate($lotteryname)
	{
		$con_sql2=$this->cmd_sql();
		
		$chatidadm=$this->api->chatId;
		
		$shortuserslottery='shortuserslottery'.$lotteryname.'_'.$chatidadm.'';
		$shortlottery='shortlottery'.$lotteryname.'_'.$chatidadm.'';
		$historyshortlottery='historyshortlottery_'.$chatidadm.'';
		$tabusers='tabusers';
		$tabcasinousers='tabcasinousers';
		$tabserviceadmin='tabserviceadmin_'.$chatidadm.'';
		$serviceshortlottery='serviceshortlottery_'.$chatidadm.'';
		
		$tabchannels='tabchannels';
		
		$query2=mysqli_query($con_sql2, 'SELECT startdate, topplaces FROM '.$shortlottery.'');
		usleep(250000);
		$con2=mysqli_num_rows($query2);
		
		$row2=[];
		
		for($i2=0;$i2<$con2;$i2++)
		{
			mysqli_data_seek($query2, $i2);
			$row2[$i2]=mysqli_fetch_row($query2);
		}
		
		$startdate=$row2[0][0];
		$topplaces=$row2[0][1];
		
		
		
		$query10=mysqli_query($con_sql2, 'SELECT chatid FROM '.$shortuserslottery.'');
		usleep(250000);
		$con10=mysqli_num_rows($query10);
		
		
		$usersarray=[];
		$row10=[];
		
		for($i10=0;$i10<$con10;$i10++)
		{
			mysqli_data_seek($query10, $i10);
			$row10[$i10]=mysqli_fetch_row($query10);
			
			$usersarray[]=$row10[$i10][0];
		}
		
		$count=count($usersarray);
		

		if($count<$topplaces)
		{
			$topplaces=$count;
		}
		
		$winners=[];
		$textidwinners="";
		
		for($i=0;$i<$topplaces;$i++)
		{
			$rand=mt_rand(0, $count-1);
			
			$winners[]=$usersarray[$rand];
			
			if($topplaces>1)
			{
				$textidwinners=$textidwinners . ''.$usersarray[$rand].',';
			}
			elseif($topplaces==1)
			{
				$textidwinners=$usersarray[$rand];
			}
			
			unset($usersarray[$rand]);
		}
		
		
		$con_sql2=$this->cmd_sql();
		
		
		$textfinish='👇<b>Результаты розыгрыша №'.$lotteryname.' от '.$startdate.'</b>👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
		
		$textresults="";
		$textresults1="";
		
		$count=count($winners);
		
		for($y=0;$y<$count;$y++)
		{
		
			$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$shortuserslottery.' WHERE chatid="'.$winners[$y].'"');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			$emptyprofile="";
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$chatid=$winners[$y];
				$firstname=$row[$i][0];
				$lastname=$row[$i][1];
				$username=$row[$i][2];
				
				
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$winners[$y].'"');
				usleep(250000);
				$con3=mysqli_num_rows($query3);
				
					
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
				
				$casinoid=$row3[0][2];
				$casinofirstname=$row3[0][3];
				$casinolastname=$row3[0][4];
				$casinophone=$row3[0][5];
				$casinoemail=$row3[0][6];
				$casinodeposit=$row3[0][7];
				$casinodepositquan=$row3[0][9];
				$casinobirthday=$row3[0][10];
				
				if(empty($casinofirstname))
				{
					$emptyprofile=$emptyprofile . "имя;";
				}
				if(empty($casinolastname))
				{
					$emptyprofile=$emptyprofile . "фамилия;";
				}
				if(empty($casinobirthday))
				{
					$emptyprofile=$emptyprofile . "День Рождения;";
				}
				
				if(empty($casinophone))
				{
					$emptyphone="номер телефона не указан";
				}
				elseif($casinophone=="1")
				{
					$emptyphone="номер телефона не подтвержден";
				}
				
				if(empty($casinoemail))
				{
					$emptyemail="почта не указана";
				}
				elseif($casinophone=="1")
				{
					$emptyemail="почта не подтверждена";
				}
				
				if($casinodeposit<5)
				{
					$emptydeposit="нет минимального депозита";
				}
				
		
				$textadd="";
				
				if(empty($emptyprofile))
				{
					$text="✅Профиль";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Профиль ('.$emptyprofile.')";
					$textadd=$textadd . ''.$text.'';
				}
				
				
				if(empty($emptyphone))
				{
					$text="✅Телефон";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Телефон ('.$emptyphone.')";
					$textadd=$textadd . ''.$text.'';
				}
				
				
				if(empty($emptyemail))
				{
					$text="✅Почта";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Почта ('.$emptyemail.')";
					$textadd=$textadd . ''.$text.'';
				}
				
				
				if(empty($emptydeposit))
				{
					$text="✅Мин. депозит";
					$textadd=$textadd . ''.$text.'';
				}
				else
				{
					$text="❌Мин. депозит ('.$emptydeposit.')";
					$textadd=$textadd . ''.$text.'';
				}
				
				
		
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
					
					$text=''.$putuser.'';
				}
				elseif(empty($lenusername))
				{
					$putuser=$firstname;
					
					if(!empty($lastname))
					{
						$putuser=''.$firstname.' '.$lastname.'';
					}
					
					$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
				}
				elseif($lenusername<$lenfio)
				{
					$putuser=$username;
					
					$text=''.$putuser.'';
				}
				elseif($lenusername>$lenfio)
				{
					$putuser=$firstname;
					
					if(!empty($lastname))
					{
						$putuser=''.$firstname.' '.$lastname.'';
					}
					
					$text='<a href="tg://user?id='.$chatid.'">'.$putuser.'</a>';
					
				}
				elseif($lenusername==$lenfio)
				{
					$putuser=$username;
					
					$text=''.$putuser.'';
				}
				
				$textresults=$textresults . ''.$text.' - '.$textadd.''.PHP_EOL.'';
				$textresults1=$textresults1 . ''.$text.''.PHP_EOL.'';
				//$textfinish=$textfinish . ''.$text.' - '.$textadd.''.PHP_EOL.'';
				$textfinish=$textfinish . ''.$text.''.PHP_EOL.'';
				
				
				
				if(strlen($textfinish)>3500 && strlen($textfinish)<4000)
				{
					
					$this->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $textfinish,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(250000);
					
					
					$textfinish="";
				}
			}
		}
		
		
		if(!empty($textfinish))
		{
			$this->api->sendMessage([
			'chat_id' => $chatidadm,
			'text' => $textfinish,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		$query4=mysqli_query($con_sql2, 'SELECT results, usermessage, buttontext FROM '.$shortlottery.'');
		usleep(250000);
		$con4=mysqli_num_rows($query4);
		
		for($i4=0;$i4<$con4;$i4++)
		{
			mysqli_data_seek($query4, $i4);
			$row4[$i4]=mysqli_fetch_row($query4);
		}
		
		mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET results = REPLACE(results, "'.$row4[0][0].'", "'.$textresults.'")');
		usleep(450000);
		mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET usermessage = REPLACE(usermessage, "'.$row4[0][1].'", "'.$textresults1.'")');
		usleep(450000);
		mysqli_query($con_sql2, 'UPDATE '.$shortlottery.' SET buttontext = REPLACE(buttontext, "'.$row4[0][2].'", "'.$textidwinners.'")');
		usleep(450000);
		
		
		$merge=[];
		$merge[]= [['text' => '🟢Да', 'callback_data' => 'short_results_yes('.$lotteryname.')'], ['text' => '🔴Нет', 'callback_data' => 'short_results_no('.$lotteryname.')']];
		
		$textadmin='Сверху Вы можете увидеть список победителей розыгрыша №'.$lotteryname.' от '.$startdate.'👆👆👆'.PHP_EOL.'<b>Вас устраивают такие результаты?</b>';
		
		$this->api->sendMessage([
		'chat_id' => $chatidadm,
		'text' => $textadmin,
		'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_short_confirm_finish']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}



 */


/////
	public function cmd_delete_shortlottery($lotterydata)
	{
		if(file_exists(''.dirname(__FILE__).'/pid'.$lotterydata.'.txt'))
		{
			unlink(''.dirname(__FILE__).'/pid'.$lotterydata.'.txt');
		}
			
		if(file_exists(''.dirname(__FILE__).'/shortlottery'.$lotterydata.'.php'))
		{
			unlink(''.dirname(__FILE__).'/shortlottery'.$lotterydata.'.php');
		}

	}	
	
	
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////END SHORT LOTTERY////////////////////////////////////////////////////////////////////////////////



/////
	public function cmd_start_lottery()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$firstname=$this->api->firstname;
		
		if(isset($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		else
		{
			$lastname="0";
		}
		
		if(isset($this->api->username))
		{
			$username='@'.$this->api->username.'';
		}
		else
		{
			$username="0";
		}
		
		$tabadmin='tabadmin';
		$tabusers='tabusers';
		$tablotteryusers='tablotteryusers';
		$tabserviceadmin='tabserviceadmin';
		$tabserviceuser='tabserviceuser'.$chatid.'';
		$tabtempuser='tabtempuser'.$chatid.'';
		$tabcasinousers='tabcasinousers';
		
		$arraystatus=['member','creator','administrator'];
		
		///ADMIN///
		if($this->cmd_isadmin())
		{
			if($this->cmd_sql_searchchatidtable($chatid, $tabadmin)==FALSE)
			{
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
			
				mysqli_query($con_sql2, 'INSERT INTO '.$tabadmin.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
				usleep(250000);
			}
			
			
			$text='<b>Привет, '.$firstname.' (Мой Админ)!</b>✋✋✋';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		
		
		
		
		///USER///
		else
		{
			if($this->cmd_sql_searchchatidtable($chatid, $tabusers)==FALSE)
			{
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabusers.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0",refer VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
				
				mysqli_query($con_sql2, 'INSERT INTO '.$tabusers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
				usleep(250000);
			}
			
			
			$tablottery='tablottery';
			
			
			if($this->cmd_if_exists($tablottery))
			{
				if($this->id_mainchannel())
				{
					if(file_exists(''.dirname(__FILE__).'/enddate.txt'))
					{
						$query7=mysqli_query($con_sql2, 'SELECT lotteryname, startdate FROM '.$tablottery.'');
						usleep(250000);
						$con7=mysqli_num_rows($query7);
					
						for($i7=0;$i7<$con7;$i7++)
						{
							mysqli_data_seek($query7, $i7);
							$row7[$i7]=mysqli_fetch_row($query7);
						}
						
						$lotteryname=$row7[0][0];
						$startdate=$row7[0][1];
						
						$channelurl=$this->channel_url();
						$groupurl=$this->group_url();
						
						$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
		
						$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
					
						$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
						
						
						if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
						{
							
							$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
						
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
						elseif($this->inchannel_check()==FALSE)
						{
							$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
						
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
						elseif($this->ingroup_check()==FALSE)
						{
							$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
						
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
						
						
						
						elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
						{
					
							$text='Чтобы принять участие в розыгрыше, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
						
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							usleep(250000);
					
							
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode($this->keyboards['default_user_all']),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						
						
						}
						elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
						{
							if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
							{
					
								$text='Вы уже <b>зарегистрированы</b> в розыгрыше "'.$lotteryname.'"!';
								
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode($this->keyboards['default_user_casino']),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
							else
							{
								if($this->cmd_if_exists($tabtempuser)==FALSE)
								{
									mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
									usleep(250000);
									
									$query=mysqli_query($con_sql2, 'SELECT casinoid FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
									usleep(250000);
									$con=mysqli_num_rows($query);
									
									$row=[];
									
									for($i=0;$i<$con;$i++)
									{
										mysqli_data_seek($query, $i);
										$row[$i]=mysqli_fetch_row($query);
									}
									
									$idcasino=$row[0][0];

									$postdata=http_build_query(
										[
											'idcasino' => $idcasino,
											'idtelegram' => $chatid,
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
									
									$text='<b>Ваш запрос на регистрацию в розыгрыше "'.$lotteryname.'" успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
									
									$this->api->sendMessage([
									'chat_id' => $chatid,
									'text' => $text,
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
									
									
									date_default_timezone_set('Europe/Kiev');
									@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'long lottery registration date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$idcasino.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
								}
								else
								{
									$text='<b>Ваш предыдущий запрос ещё в обработке</b>😇'.PHP_EOL.''.PHP_EOL.'Подождите немного. Вскоре Вам придет уведомление.';
									
									$this->api->sendMessage([
									'chat_id' => $chatid,
									'text' => $text,
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
								}
								
								
								
								
								
								
								
								
								/* mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tablotteryusers.' LIKE '.$tabusers.'');
								
								mysqli_query($con_sql2, 'INSERT INTO '.$tablotteryusers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
								usleep(250000);
								
								
								$query=mysqli_query($con_sql2, 'SELECT messid, channelid FROM '.$tablottery.'');
								$con=mysqli_num_rows($query);
								
								$row=[];
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
								
								$messageidlottery=$row[0][0];
								$channellottery=$row[0][1];
								
								$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
								usleep(250000);
								$con=mysqli_num_rows($query);
								
								$botusername=json_decode($this->api->getMe(), true);
								$botusername=$botusername['result']['username'];
								
								$urllottery='https://t.me/'.$botusername.'?start=lottery';
								
								$keyb = [  [['text' => '🤝Зарегистрироваться (участников - '.$con.')', 'url' => $urllottery ]] ];
								
								
								$this->api->editMessageReplyMarkup([
									'chat_id' => $channellottery,
									'message_id' => $messageidlottery,
									'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
								]);
								
								
								$query7=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$tablottery.'');
								usleep(250000);
								$con7=mysqli_num_rows($query7);
								
								for($i7=0;$i7<$con7;$i7++)
								{
									mysqli_data_seek($query7, $i7);
									$row7[$i7]=mysqli_fetch_row($query7);
								}
								
								$lotteryname=$row7[0][0];
								
								
								$text='<b>Поздравляю!</b> Вы успешно зарегистрировались в розыгрыше "'.$lotteryname.'"!';
								
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode($this->keyboards['default_user_casino']),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								
								$this->cmd_refresh_data(); */
							}
						}
					}
					else
					{
						if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
						{
							$text='Вы уже <b>зарегистрированы</b> в розыгрыше "'.$lotteryname.'"!';
							
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode($this->keyboards['default_user_casino']),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
						else
						{
							$text='В данный момент регистрация в розыгрыше "'.$lotteryname.'" приостановлена!';
							
							$this->api->sendMessage([
							'text' => $text,
							//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
					}
				}
				else
				{
					if($this->testusers())
					{
						if(file_exists(''.dirname(__FILE__).'/enddate.txt'))
						{
							$query7=mysqli_query($con_sql2, 'SELECT lotteryname, startdate FROM '.$tablottery.'');
							usleep(250000);
							$con7=mysqli_num_rows($query7);
						
							for($i7=0;$i7<$con7;$i7++)
							{
								mysqli_data_seek($query7, $i7);
								$row7[$i7]=mysqli_fetch_row($query7);
							}
							
							$lotteryname=$row7[0][0];
							$startdate=$row7[0][1];
							
							$channelurl=$this->channel_url();
							$groupurl=$this->group_url();
							
							$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
							$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
						
							$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
							
							
							if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
							{
								
								$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
							
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
							elseif($this->inchannel_check()==FALSE)
							{
								$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
							
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
							elseif($this->ingroup_check()==FALSE)
							{
								$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
							
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
							
							
							
							elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
							{
						
								$text='Чтобы принять участие в розыгрыше, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
							
								mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
								usleep(250000);
						
								
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode($this->keyboards['default_user_all']),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							
							
							}
							elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
							{
								if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
								{
						
									$text='Вы уже <b>зарегистрированы</b> в розыгрыше "'.$lotteryname.'"!';
									
									$this->api->sendMessage([
									'text' => $text,
									'reply_markup' => json_encode($this->keyboards['default_user_casino']),
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
								}
								else
								{
									if($this->cmd_if_exists($tabtempuser)==FALSE)
									{
										mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
										usleep(250000);
										
										$query=mysqli_query($con_sql2, 'SELECT casinoid FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
										usleep(250000);
										$con=mysqli_num_rows($query);
										
										$row=[];
										
										for($i=0;$i<$con;$i++)
										{
											mysqli_data_seek($query, $i);
											$row[$i]=mysqli_fetch_row($query);
										}
										
										$idcasino=$row[0][0];
	
										$postdata=http_build_query(
											[
												'idcasino' => $idcasino,
												'idtelegram' => $chatid,
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
										
										$text='<b>Ваш запрос на регистрацию в розыгрыше "'.$lotteryname.'" успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
										
										$this->api->sendMessage([
										'chat_id' => $chatid,
										'text' => $text,
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
										
										
										date_default_timezone_set('Europe/Kiev');
										@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'long lottery registration date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$textmessage.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
									}
									else
									{
										$text='<b>Ваш предыдущий запрос ещё в обработке</b>😇'.PHP_EOL.''.PHP_EOL.'Подождите немного. Вскоре Вам придет уведомление.';
										
										$this->api->sendMessage([
										'chat_id' => $chatid,
										'text' => $text,
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
									}
									
									
									
									
									
									
									
									
									/* mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tablotteryusers.' LIKE '.$tabusers.'');
									
									mysqli_query($con_sql2, 'INSERT INTO '.$tablotteryusers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
									usleep(250000);
									
									
									$query=mysqli_query($con_sql2, 'SELECT messid, channelid FROM '.$tablottery.'');
									$con=mysqli_num_rows($query);
									
									$row=[];
									for($i=0;$i<$con;$i++)
									{
										mysqli_data_seek($query, $i);
										$row[$i]=mysqli_fetch_row($query);
									}
									
									$messageidlottery=$row[0][0];
									$channellottery=$row[0][1];
									
									$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
									usleep(250000);
									$con=mysqli_num_rows($query);
									
									$botusername=json_decode($this->api->getMe(), true);
									$botusername=$botusername['result']['username'];
									
									$urllottery='https://t.me/'.$botusername.'?start=lottery';
									
									$keyb = [  [['text' => '🤝Зарегистрироваться (участников - '.$con.')', 'url' => $urllottery ]] ];
									
									
									$this->api->editMessageReplyMarkup([
										'chat_id' => $channellottery,
										'message_id' => $messageidlottery,
										'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
									]);
									
									
									$query7=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$tablottery.'');
									usleep(250000);
									$con7=mysqli_num_rows($query7);
									
									for($i7=0;$i7<$con7;$i7++)
									{
										mysqli_data_seek($query7, $i7);
										$row7[$i7]=mysqli_fetch_row($query7);
									}
									
									$lotteryname=$row7[0][0];
									
									
									$text='<b>Поздравляю!</b> Вы успешно зарегистрировались в розыгрыше "'.$lotteryname.'"!';
									
									$this->api->sendMessage([
									'text' => $text,
									'reply_markup' => json_encode($this->keyboards['default_user_casino']),
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
									
									$this->cmd_refresh_data(); */
								}
							}
						}
						else
						{
							if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
							{
								$text='Вы уже <b>зарегистрированы</b> в розыгрыше "'.$lotteryname.'"!';
								
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode($this->keyboards['default_user_casino']),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
							else
							{
								$text='В данный момент регистрация в розыгрыше "'.$lotteryname.'" приостановлена!';
								
								$this->api->sendMessage([
								'text' => $text,
								//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
						}
					}
					else
					{
						$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
					
						$this->api->sendMessage([
						'text' => $text,
						//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
			}
			else
			{
				
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);

			}
		}
	}			
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////LONG LOTTERY////////////////////////////////////////////////////////////////////////////////

/////
	public function cmd_start()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$firstname=$this->api->firstname;
		
		if(isset($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		else
		{
			$lastname="0";
		}
		
		if(isset($this->api->username))
		{
			$username='@'.$this->api->username.'';
		}
		else
		{
			$username="0";
		}
		
		$tabadmin='tabadmin';
		$tabusers='tabusers';

		$tabchannels='tabchannels';

		
		///ADMIN///
		if($this->cmd_isadmin())
		{
			/* if($this->cmd_sql_searchchatidtable($chatid, $tabadmin)==FALSE)
			{
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
			
				mysqli_query($con_sql2, 'INSERT INTO '.$tabadmin.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
				usleep(250000);
			} */
			
			if($this->cmd_sql_searchchatidtable($chatid, $tabchannels))
			{
			
				$text='<b>Привет, '.$firstname.' (Мой Админ)!</b>✋✋✋';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				$text='<b>Привет,</b> '.$firstname.'!'.PHP_EOL.''.PHP_EOL.'<b>Чтобы создавать розыгрыши</b>, добавьте бота администратором хотя бы в один канал!';
			
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		
		
		
		
		
		///USER///
		else
		{
			
			$text='<b>Привет,</b> '.$firstname.'!'.PHP_EOL.''.PHP_EOL.'<b>Чтобы создавать розыгрыши</b>, добавьте бота администратором хотя бы в один канал!';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			
			/* if($this->cmd_sql_searchchatidtable($chatid, $tabusers)==FALSE)
			{
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabusers.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0",refer VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
				
				mysqli_query($con_sql2, 'INSERT INTO '.$tabusers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
				usleep(250000);
			} */
			
			
			
		}
	}	
	

/////
	public function cmd_start_referal()
	{
		$con_sql2=$this->cmd_sql();

		$chatid=$this->api->chatId;
		$firstname=$this->api->firstname;
		
		if(isset($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		else
		{
			$lastname="0";
		}
		
		if(isset($this->api->username))
		{
			$username='@'.$this->api->username.'';
		}
		else
		{
			$username="0";
		}
		
		$tabusers='tabusers';
		
		$textmessage=$this->api->textmessage;
		$tablotteryusers='tablotteryusers';
		$tabcasinousers='tabcasinousers';
		$tablottery='tablottery';
		
		if($this->cmd_isadmin())
		{	
			
			$text='<b>Привет, '.$firstname.' (Мой Админ)!</b>✋✋✋';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			if($this->id_mainchannel())
			{
				/* $channelurl=$this->channel_url();
				$groupurl=$this->group_url();
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
				
				
				if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
				{
					
					$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->inchannel_check()==FALSE)
				{
					$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->ingroup_check()==FALSE)
				{
					$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				} */
				if($this->cmd_if_exists($tablottery))
				{
					$query1=mysqli_query($con_sql2, 'SELECT parrefer,pardata,pardeposit,parpublic FROM '.$tablottery.'');
					usleep(150000);
					$con1=mysqli_num_rows($query1);
					
					$row1=[];
					for($i1=0;$i1<$con1;$i1++)
					{
						mysqli_data_seek($query1, $i1);
						$row1[$i1]=mysqli_fetch_row($query1);
					}
					
					$parrefer=$row1[0][0];
				
					if(!empty($parrefer))
					{
						$chatidref=preg_replace('/\/start ref_/', '', $textmessage);
						$chatidref=$this->clean($chatidref);
						
						if($this->cmd_sql_searchchatidtable($chatidref, $tabusers))
						{
							$query7=mysqli_query($con_sql2, 'SELECT username, firstname, lastname FROM '.$tabusers.' WHERE chatid="'.$chatidref.'"');
							usleep(150000);
							$con7=mysqli_num_rows($query7);
							
							$row7=[];
							
							for($y7=0;$y7<$con7;$y7++)
							{
								mysqli_data_seek($query7, $y7);
								$row7[$y7]=mysqli_fetch_row($query7);
							}
							
							$usernameref=$row7[0][0];
							$firstnameref=$row7[0][1];
							$lastnameref=$row7[0][2];
							
							if(empty($usernameref))
							{
								if(empty($lastnameref))
								{
									$text4=''.$firstnameref.'';
								}
								else
								{
									$text4=''.$firstnameref.' '.$lastnameref.'';
								}
							}
							else
							{
								if(empty($lastname4))
								{
									$text4=''.$firstnameref.' ('.$usernameref.')';
								}
								else
								{
									$text4=''.$firstnameref.' '.$lastnameref.' ('.$usernameref.')';
								}
							}
							
							
							//////////////////////NEW USER/////////////////////
							if($this->cmd_sql_searchchatidtable($chatid, $tabusers)==FALSE)
							{
								mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabusers.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0",refer VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
								usleep(250000);
									
								mysqli_query($con_sql2, 'INSERT INTO '.$tabusers.' (chatid,firstname,lastname,username,actiondate,refer) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'", "'.$chatidref.'")');
								usleep(250000);
								
			
								if($this->cmd_sql_searchchatidtable($chatidref, $tablotteryusers)==FALSE)
								{
									$text='Чтобы использовать реферальную ссылку пользователя '.$text4.', он <b>должен быть участником розыгрыша!</b> Как только он зарегистрируется в розыгрыше, пожалуйста, перейдите по данной ссылке еще раз!';
								
									$this->api->sendMessage([
									'text' => $text,
									//'reply_markup' => json_encode($this->keyboards['default_admin']),
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
								}
								else
								{
									$text='Вы <b>успешно осуществили переход</b> по реферальной ссылке пользователя '.$text4.''.PHP_EOL.'Чтобы данный пользователь имел возможность получить розыгрышный билет, Вам необходимо зарегистрироваться в розыгрыше!';
								
									$this->api->sendMessage([
									'text' => $text,
									//'reply_markup' => json_encode($this->keyboards['default_admin']),
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
									
									$this->cmd_start();
								}
								
								
							}
							
							
							//////////////////////OLD USER/////////////////////
							else
							{
								if($this->cmd_sql_searchchatidtable($chatidref, $tablotteryusers)==FALSE)
								{
									$text='Чтобы использовать реферальную ссылку пользователя '.$text4.', он <b>должен быть участником розыгрыша!</b> Как только он зарегистрируется в розыгрыше, пожалуйста, перейдите по данной ссылке еще раз!';
								
									$this->api->sendMessage([
									'text' => $text,
									//'reply_markup' => json_encode($this->keyboards['default_admin']),
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
									
									$this->cmd_start();
								}
								else
								{
									if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'" AND refer!="0" LIMIT 1'))))
									{
										$query3=mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
										usleep(150000);
										$con3=mysqli_num_rows($query3);
											
										for($y=0;$y<$con3;$y++)
										{
											mysqli_data_seek($query3, $y);
											$row3[$y]=mysqli_fetch_row($query3);
										}
										
										$chatidrefnow=$row3[0][0];
										
										if(preg_match('/_/', $row3[0][0]))
										{
											$chatidrefnow=preg_replace('/_.*/', '', $row3[0][0]);
											$chatidrefnow=$this->clean($chatidrefnow);
										}
										else
										{
											$chatidrefnow=$row3[0][0];
										}
										
										if(preg_match('/'.$chatidref.'/', $chatidrefnow))
										{
											if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
											{
												$text='Вы <b>успешно осуществили повторный переход</b> по реферальной ссылке пользователя '.$text4.''.PHP_EOL.'Чтобы данный пользователь имел возможность получить розыгрышный билет, <b>Вам необходимо зарегистрироваться в казино Казино, а потом зарегистрироваться в розыгрыше!</b>';
								
												$this->api->sendMessage([
												'text' => $text,
												//'reply_markup' => json_encode($this->keyboards['default_admin']),
												//'disable_notification' => TRUE,
												//'disable_web_page_preview' => TRUE,
												'parse_mode'=> "HTML"
												]);
									
												$this->cmd_start();
											}
											else
											{
												if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
												{
													$text='Вы <b>успешно осуществили повторный переход</b> по реферальной ссылке пользователя '.$text4.''.PHP_EOL.'Чтобы данный пользователь имел возможность получить розыгрышный билет, <b>Вам необходимо зарегистрироваться в розыгрыше!</b>';
								
													$this->api->sendMessage([
													'text' => $text,
													//'reply_markup' => json_encode($this->keyboards['default_admin']),
													//'disable_notification' => TRUE,
													//'disable_web_page_preview' => TRUE,
													'parse_mode'=> "HTML"
													]);
										
													$this->cmd_start();
			
												}
												else
												{
													$query3=mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
													usleep(150000);
													$con3=mysqli_num_rows($query3);
														
													for($y=0;$y<$con3;$y++)
													{
														mysqli_data_seek($query3, $y);
														$row3[$y]=mysqli_fetch_row($query3);
													}
													
													$chatidrefnow=$row3[0][0];
													
													if(preg_match('/_2/', $row3[0][0]))
													{
														$text='<b>Вы уже зарегистрированы в розыгрыше по данной реферальной ссылке!</b>';
										
														$this->api->sendMessage([
														'text' => $text,
														//'reply_markup' => json_encode($this->keyboards['default_admin']),
														//'disable_notification' => TRUE,
														//'disable_web_page_preview' => TRUE,
														'parse_mode'=> "HTML"
														]);
													}
													else
													{
														$this->cmd_start();
													}
												}
											}
										}
										else
										{
											$text='Вы уже осуществляли переход по реферальной ссылке другого пользователя, поэтому <b>переход по данной реферальной ссылке не будет учтен!</b>';
								
											$this->api->sendMessage([
											'text' => $text,
											//'reply_markup' => json_encode($this->keyboards['default_admin']),
											//'disable_notification' => TRUE,
											//'disable_web_page_preview' => TRUE,
											'parse_mode'=> "HTML"
											]);
										}
									}
									else
									{
										$text='Вы уже являлись пользователем до нажатия на реферальную ссылку, поэтому <b>дальнейшие переходы по реферальным ссылкам не будут учитываться!</b>';
								
										$this->api->sendMessage([
										'text' => $text,
										//'reply_markup' => json_encode($this->keyboards['default_admin']),
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
									}						
								}
							}
						}
						else
						{
							$text='Не стоит так делать! <b>Пользователя, по ссылке которого Вы пытаетесь перейти, не существует!</b>';
						
							$this->api->sendMessage([
							'text' => $text,
							//'reply_markup' => json_encode($this->keyboards['default_admin']),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							
							$this->cmd_start();
						}
					}
					else
					{
						$text='<b>Действующий розыгрыш не предусматривает получение билетов за переходы по реферальным ссылкам!</b>';
						
						$this->api->sendMessage([
						'text' => $text,
						//'reply_markup' => json_encode($this->keyboards['default_admin']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
					
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				if($this->testusers())
				{
					if($this->cmd_if_exists($tablottery))
					{
						$query1=mysqli_query($con_sql2, 'SELECT parrefer,pardata,pardeposit,parpublic FROM '.$tablottery.'');
						usleep(150000);
						$con1=mysqli_num_rows($query1);
						
						$row1=[];
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
						}
						
						$parrefer=$row1[0][0];
					
						if(!empty($parrefer))
						{
							$chatidref=preg_replace('/\/start ref_/', '', $textmessage);
							$chatidref=$this->clean($chatidref);
							
							if($this->cmd_sql_searchchatidtable($chatidref, $tabusers))
							{
								$query7=mysqli_query($con_sql2, 'SELECT username, firstname, lastname FROM '.$tabusers.' WHERE chatid="'.$chatidref.'"');
								usleep(150000);
								$con7=mysqli_num_rows($query7);
								
								$row7=[];
								
								for($y7=0;$y7<$con7;$y7++)
								{
									mysqli_data_seek($query7, $y7);
									$row7[$y7]=mysqli_fetch_row($query7);
								}
								
								$usernameref=$row7[0][0];
								$firstnameref=$row7[0][1];
								$lastnameref=$row7[0][2];
								
								if(empty($usernameref))
								{
									if(empty($lastnameref))
									{
										$text4=''.$firstnameref.'';
									}
									else
									{
										$text4=''.$firstnameref.' '.$lastnameref.'';
									}
								}
								else
								{
									if(empty($lastname4))
									{
										$text4=''.$firstnameref.' ('.$usernameref.')';
									}
									else
									{
										$text4=''.$firstnameref.' '.$lastnameref.' ('.$usernameref.')';
									}
								}
								
								
								//////////////////////NEW USER/////////////////////
								if($this->cmd_sql_searchchatidtable($chatid, $tabusers)==FALSE)
								{
									mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabusers.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0",refer VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
									usleep(250000);
										
									mysqli_query($con_sql2, 'INSERT INTO '.$tabusers.' (chatid,firstname,lastname,username,actiondate,refer) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'", "'.$chatidref.'")');
									usleep(250000);
									
				
									if($this->cmd_sql_searchchatidtable($chatidref, $tablotteryusers)==FALSE)
									{
										$text='Чтобы использовать реферальную ссылку пользователя '.$text4.', он <b>должен быть участником розыгрыша!</b> Как только он зарегистрируется в розыгрыше, пожалуйста, перейдите по данной ссылке еще раз!';
									
										$this->api->sendMessage([
										'text' => $text,
										//'reply_markup' => json_encode($this->keyboards['default_admin']),
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
									}
									else
									{
										$text='Вы <b>успешно осуществили переход</b> по реферальной ссылке пользователя '.$text4.''.PHP_EOL.'Чтобы данный пользователь имел возможность получить розыгрышный билет, Вам необходимо зарегистрироваться в розыгрыше!';
									
										$this->api->sendMessage([
										'text' => $text,
										//'reply_markup' => json_encode($this->keyboards['default_admin']),
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
										
										$this->cmd_start();
									}
									
									
								}
								
								
								//////////////////////OLD USER/////////////////////
								else
								{
									if($this->cmd_sql_searchchatidtable($chatidref, $tablotteryusers)==FALSE)
									{
										$text='Чтобы использовать реферальную ссылку пользователя '.$text4.', он <b>должен быть участником розыгрыша!</b> Как только он зарегистрируется в розыгрыше, пожалуйста, перейдите по данной ссылке еще раз!';
									
										$this->api->sendMessage([
										'text' => $text,
										//'reply_markup' => json_encode($this->keyboards['default_admin']),
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
										
										$this->cmd_start();
									}
									else
									{
										if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'" AND refer!="0" LIMIT 1'))))
										{
											$query3=mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
											usleep(150000);
											$con3=mysqli_num_rows($query3);
												
											for($y=0;$y<$con3;$y++)
											{
												mysqli_data_seek($query3, $y);
												$row3[$y]=mysqli_fetch_row($query3);
											}
											
											$chatidrefnow=$row3[0][0];
											
											if(preg_match('/'.$chatidref.'/', $chatidrefnow))
											{
												if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
												{
													$text='Вы <b>успешно осуществили повторный переход</b> по реферальной ссылке пользователя '.$text4.''.PHP_EOL.'Чтобы данный пользователь имел возможность получить розыгрышный билет, <b>Вам необходимо зарегистрироваться в казино Казино, а потом зарегистрироваться в розыгрыше!</b>';
									
													$this->api->sendMessage([
													'text' => $text,
													//'reply_markup' => json_encode($this->keyboards['default_admin']),
													//'disable_notification' => TRUE,
													//'disable_web_page_preview' => TRUE,
													'parse_mode'=> "HTML"
													]);
										
													$this->cmd_start();
												}
												else
												{
													if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
													{
														$text='Вы <b>успешно осуществили повторный переход</b> по реферальной ссылке пользователя '.$text4.''.PHP_EOL.'Чтобы данный пользователь имел возможность получить розыгрышный билет, <b>Вам необходимо зарегистрироваться в розыгрыше!</b>';
									
														$this->api->sendMessage([
														'text' => $text,
														//'reply_markup' => json_encode($this->keyboards['default_admin']),
														//'disable_notification' => TRUE,
														//'disable_web_page_preview' => TRUE,
														'parse_mode'=> "HTML"
														]);
											
														$this->cmd_start();
				
													}
													else
													{
														$text='<b>Вы уже зарегистрированы в розыгрыше по данной реферальной ссылке!</b>';
										
														$this->api->sendMessage([
														'text' => $text,
														//'reply_markup' => json_encode($this->keyboards['default_admin']),
														//'disable_notification' => TRUE,
														//'disable_web_page_preview' => TRUE,
														'parse_mode'=> "HTML"
														]);
													}
												}
											}
											else
											{
												$text='Вы уже осуществляли переход по реферальной ссылке другого пользователя, поэтому <b>переход по данной реферальной ссылке не будет учтен!</b>';
									
												$this->api->sendMessage([
												'text' => $text,
												//'reply_markup' => json_encode($this->keyboards['default_admin']),
												//'disable_notification' => TRUE,
												//'disable_web_page_preview' => TRUE,
												'parse_mode'=> "HTML"
												]);
											}
										}
										else
										{
											$text='Вы уже являлись пользователем до нажатия на реферальную ссылку, поэтому <b>дальнейшие переходы по реферальным ссылкам не будут учитываться!</b>';
									
											$this->api->sendMessage([
											'text' => $text,
											//'reply_markup' => json_encode($this->keyboards['default_admin']),
											//'disable_notification' => TRUE,
											//'disable_web_page_preview' => TRUE,
											'parse_mode'=> "HTML"
											]);
										}						
									}
								}
							}
							else
							{
								$text='Не стоит так делать! <b>Пользователя, по ссылке которого Вы пытаетесь перейти, не существует!</b>';
							
								$this->api->sendMessage([
								'text' => $text,
								//'reply_markup' => json_encode($this->keyboards['default_admin']),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								
								$this->cmd_start();
							}
						}
						else
						{
							$text='<b>Действующий розыгрыш не предусматривает получение билетов за переходы по реферальным ссылкам!</b>';
							
							$this->api->sendMessage([
							'text' => $text,
							//'reply_markup' => json_encode($this->keyboards['default_admin']),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
					}
					else
					{
						$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
						
						$this->api->sendMessage([
						'text' => $text,
						//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
				
					$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
		}
		
	}

 

/////
	public function callback_refresh_status()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
				
		if($this->id_mainchannel())
		{
			$this->cmd_start();
		}
		else
		{
			if($this->testusers())
			{
				$this->cmd_start();
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}

/* /////
	public function callback_refresh_status()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$firstname=$this->api->firstname;
		
		if(isset($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		else
		{
			$lastname="0";
		}
		
		if(isset($this->api->username))
		{
			$username='@'.$this->api->username.'';
		}
		else
		{
			$username='';
		}
		
		$messageid=$this->api->messageid;
		$tabusers='tabusers';
		$tabcasinousers='tabcasinousers';
		$tabserviceuser='tabserviceuser'.$chatid.'';		
		$tablotteryusers='tablotteryusers';
		$tablottery='tablottery';
		
		$arraystatus=['member','creator','administrator'];
		
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}


		$tablottery='tablottery';
		
		if($this->cmd_if_exists($tablottery))
		{
			$query7=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$tablottery.'');
			usleep(250000);
			$con7=mysqli_num_rows($query7);
		
			for($i7=0;$i7<$con7;$i7++)
			{
				mysqli_data_seek($query7, $i7);
				$row7[$i7]=mysqli_fetch_row($query7);
			}
			
			$lotteryname=$row7[0][0];
		
			$channelurl=$this->channel_url();
			$groupurl=$this->group_url();
			
			$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
			
			
			if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
			{
				
				$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->inchannel_check()==FALSE)
			{
				$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->ingroup_check()==FALSE)
			{
				$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			
			/////CASINO REGISTRATION CHECK/////
			elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
			{
				$text='Чтобы принять участие в розыгрыше, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
				
				
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);

				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode($this->keyboards['default_user_all']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
			{
				if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
				{
					$text='Вы уже <b>зарегистрированы</b> в розыгрыше "'.$lotteryname.'"!';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode($this->keyboards['default_user_casino']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tablotteryusers.' LIKE '.$tabusers.'');
					
					
					mysqli_query($con_sql2, 'INSERT INTO '.$tablotteryusers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
					usleep(250000);
					
					
					$query=mysqli_query($con_sql2, 'SELECT messid, channelid FROM '.$tablottery.'');
					$con=mysqli_num_rows($query);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					$messageidlottery=$row[0][0];
					$channellottery=$row[0][1];
					
					$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					$botusername=json_decode($this->api->getMe(), true);
					$botusername=$botusername['result']['username'];
					
					$urllottery='https://t.me/'.$botusername.'?start=lottery';
					
					$keyb = [  [['text' => '🤝Зарегистрироваться (участников - '.$con.')', 'url' => $urllottery ]] ];
					
					
					$this->api->editMessageReplyMarkup([
						'chat_id' => $channellottery,
						'message_id' => $messageidlottery,
						'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					]);
					
					
					$query7=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$tablottery.'');
					usleep(250000);
					$con7=mysqli_num_rows($query7);
					
					for($i7=0;$i7<$con7;$i7++)
					{
						mysqli_data_seek($query7, $i7);
						$row7[$i7]=mysqli_fetch_row($query7);
					}
					
					$lotteryname=$row7[0][0];
					
					 $this->api->deleteMessage([
					'chat_id' => $chatid,
					'message_id' => $messageid
					]); 
					
					
					$text='<b>Поздравляю!</b> Вы успешно зарегистрировались в розыгрыше "'.$lotteryname.'"!';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode($this->keyboards['default_user_casino']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
		}
		else
		{
			$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	} */	




/////
	public function cmd_id_casino_check()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$chatidadmin=$this->chatidadmin;
		
		$result=json_decode($this->api->getChat([
			'chat_id' => $chatidadmin
			]), true);
			
		$usernameadmin=$result['result']['username'];
		
		$tabusers='tabusers';
		$firstname=$this->api->firstname;
		
		if(isset($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		else
		{
			$lastname="0";
		}
		
		if(isset($this->api->username))
		{
			$username='@'.$this->api->username.'';
		}
		else
		{
			$username="0";
		}
		
		$tabserviceuser='tabserviceuser'.$chatid.'';
		$tabtempuser='tabtempuser'.$chatid.'';
		$tabtempusererr='tabtempusererr'.$chatid.'';
		$tabcasinousers='tabcasinousers';
		$tabbanned='tabbanned';
		$tablotteryusers='tablotteryusers';
		$tabticketsall='tabticketsall';
		$tablottery='tablottery';

		$textmessage=$this->api->textmessage;
		
		$arraystatus=['member','creator','administrator'];
		
		
		$tablottery='tablottery';
		
		if($this->cmd_if_exists($tablottery))
		{
			if($this->id_mainchannel())
			{
				$query7=mysqli_query($con_sql2, 'SELECT lotteryname, startdate FROM '.$tablottery.'');
				usleep(250000);
				$con7=mysqli_num_rows($query7);
			
				for($i7=0;$i7<$con7;$i7++)
				{
					mysqli_data_seek($query7, $i7);
					$row7[$i7]=mysqli_fetch_row($query7);
				}
				
				$lotteryname=$row7[0][0];
				$startdate=$row7[0][1];
			
				$channelurl=$this->channel_url();
				$groupurl=$this->group_url();
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
				
				
				if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
				{
					
					$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->inchannel_check()==FALSE)
				{
					$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->ingroup_check()==FALSE)
				{
					$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif(preg_match('/^\d{9,10}$/', $textmessage) && $textmessage!=$chatid && $this->cmd_sql_searchcasinoidtable($textmessage, $tabcasinousers)==FALSE)
				{
					if($this->cmd_if_exists($tabtempuser)==FALSE)
					{
						mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
						
						
						$postdata=http_build_query(
							[
								'idcasino' => $textmessage,
								'idtelegram' => $chatid,
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
						
						$text='<b>Ваш запрос с ID '.$textmessage.' успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
						
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						
						
						date_default_timezone_set('Europe/Kiev');
						@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'registration date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$textmessage.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
					}
					else
					{
						$text='<b>Ваш предыдущий запрос ещё в обработке</b>😇'.PHP_EOL.''.PHP_EOL.'Подождите немного. Вскоре Вам придет уведомление.';
						
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}	
				else
				{
					$counterlimit=DataBot::COUNTERLIMIT;
					
					if($this->cmd_if_exists($tabtempusererr)==FALSE)
					{ 
						mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempusererr.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(2) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
						
						mysqli_query($con_sql2, 'INSERT INTO '.$tabtempusererr.' (info) VALUES ("1")');
						usleep(250000);
					}
					else
					{
						$query=mysqli_query($con_sql2, 'SELECT info FROM '.$tabtempusererr.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						$row=[];
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						$counter=$row[0][0];
						$counter=($counter+1);
						
						mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempusererr.'');
						usleep(250000);
						
						mysqli_query($con_sql2, 'INSERT INTO '.$tabtempusererr.' (info) VALUES ("'.$counter.'")');
						usleep(250000);
					}
					
					
					$query=mysqli_query($con_sql2, 'SELECT info FROM '.$tabtempusererr.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					$counter=$row[0][0];
					
					
					if($counter!=$counterlimit)
					{
						$tries=($counterlimit-$counter);
						
						$text='<b>Я не смог найти Ваш ID</b> ('.$textmessage.'), потому что его нет в Казино😔'.PHP_EOL.''.PHP_EOL.'Скорее всего, он был указан неправильно.'.PHP_EOL.''.PHP_EOL.'Пожалуйста, пришлите еще раз Ваш номер счета, чтобы стать участником розыгрыша👇'.PHP_EOL.''.PHP_EOL.'<i>Осталось попыток - '.$tries.'</i>';
					
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
				
					}
					else
					{
					
						mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempuser.'');
						usleep(250000);
						
						mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempusererr.'');
						usleep(250000);
						
						
						mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabbanned.' LIKE '.$tabusers.'');
						usleep(250000);
							
						mysqli_query($con_sql2, 'INSERT INTO '.$tabbanned.' (chatid,firstname,lastname,username,actiondate) SELECT chatid,firstname,lastname,username,actiondate FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
						
							
						mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceuser.'');
						usleep(250000);
						
						mysqli_query($con_sql2, 'DELETE FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
						usleep(250000);
						
						mysqli_query($con_sql2, 'DELETE FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
						usleep(250000);
						
						mysqli_query($con_sql2, 'DELETE FROM '.$tablotteryusers.' WHERE chatid="'.$chatid.'"');
						usleep(250000);
						
						
						/* if($this->inchannel_check())
						{
							$this->api->banChatMember([
								'chat_id' => $this->mainchannel(),
								'user_id' => $chatid,
								'revoke_messages' => true,
							]);
						}
						
						
						if($this->ingroup_check())
						{
							$this->api->banChatMember([
								'chat_id' => $this->maingroup(),
								'user_id' => $chatid,
								'revoke_messages' => true,
							]);
						} */
						$arraystatus=['member','creator','administrator'];
					
						$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
							
							$channelid=$row[$i][0];
							
							$inchannel=json_decode($this->api->getChatMember([
							'chat_id' => $channelid,
							'user_id' => $chatid,
							]), true);
							
							$inchannel=$inchannel['result'];
							
							if(in_array($inchannel['status'], $arraystatus))
							{
								$this->api->banChatMember([
									'chat_id' => $channelid,
									'user_id' => $chatid,
									'revoke_messages' => true,
								]);
							}
						}
						
								
					
						$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabgroups.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
							
							$groupid=$row[$i][0];
							
							$ingroup=json_decode($this->api->getChatMember([
							'chat_id' => $groupid,
							'user_id' => $chatid,
							]), true);
							
							$ingroup=$ingroup['result'];
							
							if(in_array($ingroup['status'], $arraystatus))
							{
								$this->api->banChatMember([
									'chat_id' => $groupid,
									'user_id' => $chatid,
									'revoke_messages' => true,
								]);
							}
						}
						
						$text='<b>Вы 5 раз прислали мне непонятно что</b>🥸'.PHP_EOL.''.PHP_EOL.'К сожалению, вынужден Вас заблокировать.'.PHP_EOL.''.PHP_EOL.'Чтобы участвовать в розыгрыше, напишите моему старшему - @'.$usernameadmin.'.';
						
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						'reply_markup' => json_encode( ['remove_keyboard' => true] ),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
			}
			else
			{
				if($this->testusers())
				{
					$query7=mysqli_query($con_sql2, 'SELECT lotteryname, startdate FROM '.$tablottery.'');
					usleep(250000);
					$con7=mysqli_num_rows($query7);
				
					for($i7=0;$i7<$con7;$i7++)
					{
						mysqli_data_seek($query7, $i7);
						$row7[$i7]=mysqli_fetch_row($query7);
					}
					
					$lotteryname=$row7[0][0];
					$startdate=$row7[0][1];
				
					$channelurl=$this->channel_url();
					$groupurl=$this->group_url();
					
					$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
					
					$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
					
					$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
					
					
					if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
					{
						
						$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
					
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif($this->inchannel_check()==FALSE)
					{
						$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
					
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif($this->ingroup_check()==FALSE)
					{
						$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
					
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif(preg_match('/^\d{9,10}$/', $textmessage) && $textmessage!=$chatid && $this->cmd_sql_searchcasinoidtable($textmessage, $tabcasinousers)==FALSE)
					{
						if($this->cmd_if_exists($tabtempuser)==FALSE)
						{
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							usleep(250000);
							
							
							$postdata=http_build_query(
								[
									'idcasino' => $textmessage,
									'idtelegram' => $chatid,
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
							
							$text='<b>Ваш запрос с ID '.$textmessage.' успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
							
							$this->api->sendMessage([
							'chat_id' => $chatid,
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							
							
							date_default_timezone_set('Europe/Kiev');
							@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'registration date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$textmessage.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
						}
						else
						{
							$text='<b>Ваш предыдущий запрос ещё в обработке</b>😇'.PHP_EOL.''.PHP_EOL.'Подождите немного. Вскоре Вам придет уведомление.';
							
							$this->api->sendMessage([
							'chat_id' => $chatid,
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
					}	
					else
					{
						$counterlimit=DataBot::COUNTERLIMIT;
						
						if($this->cmd_if_exists($tabtempusererr)==FALSE)
						{ 
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempusererr.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(2) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							usleep(250000);
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabtempusererr.' (info) VALUES ("1")');
							usleep(250000);
						}
						else
						{
							$query=mysqli_query($con_sql2, 'SELECT info FROM '.$tabtempusererr.'');
							usleep(250000);
							$con=mysqli_num_rows($query);
							
							$row=[];
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								$row[$i]=mysqli_fetch_row($query);
							}
							
							$counter=$row[0][0];
							$counter=($counter+1);
							
							mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempusererr.'');
							usleep(250000);
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabtempusererr.' (info) VALUES ("'.$counter.'")');
							usleep(250000);
						}
						
						
						$query=mysqli_query($con_sql2, 'SELECT info FROM '.$tabtempusererr.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						$row=[];
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						$counter=$row[0][0];
						
						
						if($counter!=$counterlimit)
						{
							$tries=($counterlimit-$counter);
							
							$text='<b>Я не смог найти Ваш ID</b> ('.$textmessage.'), потому что его нет в Казино😔'.PHP_EOL.''.PHP_EOL.'Скорее всего, он был указан неправильно.'.PHP_EOL.''.PHP_EOL.'Пожалуйста, пришлите еще раз Ваш номер счета, чтобы стать участником розыгрыша👇'.PHP_EOL.''.PHP_EOL.'<i>Осталось попыток - '.$tries.'</i>';
						
							$this->api->sendMessage([
							'chat_id' => $chatid,
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
					
						}
						else
						{
						
							mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempuser.'');
							usleep(250000);
							
							mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempusererr.'');
							usleep(250000);
							
							
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabbanned.' LIKE '.$tabusers.'');
							usleep(250000);
								
							mysqli_query($con_sql2, 'INSERT INTO '.$tabbanned.' (chatid,firstname,lastname,username,actiondate) SELECT chatid,firstname,lastname,username,actiondate FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
							
								
							mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceuser.'');
							usleep(250000);
							
							mysqli_query($con_sql2, 'DELETE FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
							usleep(250000);
							
							mysqli_query($con_sql2, 'DELETE FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
							usleep(250000);
							
							mysqli_query($con_sql2, 'DELETE FROM '.$tablotteryusers.' WHERE chatid="'.$chatid.'"');
							usleep(250000);
							
							
							/* if($this->inchannel_check())
							{
								$this->api->banChatMember([
									'chat_id' => $this->mainchannel(),
									'user_id' => $chatid,
									'revoke_messages' => true,
								]);
							}
							
							
							if($this->ingroup_check())
							{
								$this->api->banChatMember([
									'chat_id' => $this->maingroup(),
									'user_id' => $chatid,
									'revoke_messages' => true,
								]);
							} */
							$arraystatus=['member','creator','administrator'];
						
							$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.'');
							usleep(250000);
							$con=mysqli_num_rows($query);
							
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								$row[$i]=mysqli_fetch_row($query);
								
								$channelid=$row[$i][0];
								
								$inchannel=json_decode($this->api->getChatMember([
								'chat_id' => $channelid,
								'user_id' => $chatid,
								]), true);
								
								$inchannel=$inchannel['result'];
								
								if(in_array($inchannel['status'], $arraystatus))
								{
									$this->api->banChatMember([
										'chat_id' => $channelid,
										'user_id' => $chatid,
										'revoke_messages' => true,
									]);
								}
							}
							
									
						
							$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabgroups.'');
							usleep(250000);
							$con=mysqli_num_rows($query);
							
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								$row[$i]=mysqli_fetch_row($query);
								
								$groupid=$row[$i][0];
								
								$ingroup=json_decode($this->api->getChatMember([
								'chat_id' => $groupid,
								'user_id' => $chatid,
								]), true);
								
								$ingroup=$ingroup['result'];
								
								if(in_array($ingroup['status'], $arraystatus))
								{
									$this->api->banChatMember([
										'chat_id' => $groupid,
										'user_id' => $chatid,
										'revoke_messages' => true,
									]);
								}
							}
							
							$text='<b>Вы 5 раз прислали мне непонятно что</b>🥸'.PHP_EOL.''.PHP_EOL.'К сожалению, вынужден Вас заблокировать.'.PHP_EOL.''.PHP_EOL.'Чтобы участвовать в розыгрыше, напишите моему старшему - @'.$usernameadmin.'.';
							
							$this->api->sendMessage([
							'chat_id' => $chatid,
							'text' => $text,
							'reply_markup' => json_encode( ['remove_keyboard' => true] ),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
				
					$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
		
		}
		else
		{
			$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
	}

	



/////
	public function cmd_active_mirror()
	{
		//$con_sql2=$this->cmd_sql();
		$chatid=$this->api->chatId;
		$tabcasinousers='tabcasinousers';
		
		
		if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
		{
			$text='Актуальное зеркало Казино – <b>'.DataBot::URLMIRROR1.'</b>';
		
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['urlcasino']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Регистрируйтесь в Казино, чтобы участвовать в розыгрышах – <b>'.DataBot::URLMIRROR.'</b>';
		
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['urlcasino']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}		




/////
	public function cmd_casino_official()
	{
		/* $channelurl=$this->channel_url();
		$groupurl=$this->group_url();
		
		$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
		
		$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
		
		$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
		
		
		if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
		{
			
			$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		elseif($this->inchannel_check()==FALSE)
		{
			$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		elseif($this->ingroup_check()==FALSE)
		{
			$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{ */
			$text='Подписывайтесь и узнавайте о розыгрышах первым – <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>';
				
			$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			
		//}
	}


/////
	public function cmd_download_app()
	{
		/* $channelurl=$this->channel_url();
		$groupurl=$this->group_url();
		
		$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
		
		$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
		
		$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	 */
		
		
		/* if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
		{
			
			$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		elseif($this->inchannel_check()==FALSE)
		{
			$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		elseif($this->ingroup_check()==FALSE)
		{
			$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{ */
			$text='Нажимайте кнопку снизу и скачивайте приложение на Android👇'.PHP_EOL.''.PHP_EOL.'Актуальное зеркало – <b>'.DataBot::URLMIRROR1.'</b>';
			
				
			$keyb = [  [['text' => 'Скачать приложение', 'url' => DataBot::URLDOWNLOAD ]] ];
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		//}
	}
	


/////
	public function cmd_invite_friend()
	{
		$con_sql2=$this->cmd_sql();
		
		$botusername=json_decode($this->api->getMe(), true);
		$botusername=$botusername['result']['username'];
		
		$chatid=$this->api->chatId;
		$tabrefers='tabrefers'.$chatid.'';
		$tablottery='tablottery';
		$tablotteryusers='tablotteryusers';
		$tabcasinousers='tabcasinousers';
		$tabusers='tabusers';
		
		$reflink='https://t.me/'.$botusername.'?start=ref_'.$chatid.'';
		
		
		$sharelink='https://t.me/share/url?url='.$reflink.'';
		
		if($this->id_mainchannel())
		{
			$groupurl=$this->group_url();
			$channelurl=$this->channel_url();
			
			$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
			
			if($this->cmd_if_exists($tablottery))
			{
				if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
				{
					$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->inchannel_check()==FALSE)
				{
					$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->ingroup_check()==FALSE)
				{
					$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}		
				elseif($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
				{
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE refer="'.$chatid.'" LIMIT 1'))))
					{
						$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabusers.' WHERE refer="'.$chatid.'"');
						usleep(250000);
						$con1=mysqli_num_rows($query1);
						
						$textall='';
						
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
							
							$refchatid=$row1[$i1][1];
							$reffirstname=$row1[$i1][2];
							$reflastname=$row1[$i1][3];
							$refusername=$row1[$i1][4];
							$refactiondate=$row1[$i1][5];
							
							if($this->cmd_sql_searchchatidtable($refchatid, $tabcasinousers))
							{
								if(!empty($reflastname))
								{
									if(!empty($refusername))
									{
										$text=''.$reffirstname.' '.$reflastname.' ('.$refusername.', '.$refactiondate.')';
									}
									else
									{
										$text=''.$reffirstname.' '.$reflastname.' ('.$refactiondate.')';
									}
								}
								else
								{
									if(!empty($refusername))
									{
										$text=''.$reffirstname.' ('.$refusername.', '.$refactiondate.')';
									}
									else
									{
										$text=''.$reffirstname.' ('.$refactiondate.')';
									}
								}
									
								
								if($i1==0)
								{
									$textall=$text;
								}
								else
								{
									$textall=$textall . ', '.$text.'';
								}
							}
						}
							
						if(!empty($textall))
						{
							$text='<b>Ваша реферальная ссылка:</b>'.PHP_EOL.''.PHP_EOL.'<pre>'.$reflink.'</pre>'.PHP_EOL.''.PHP_EOL.'<b>Зарегистрированы по Вашей ссылке:</b> <i>'.$textall.'</i>'.PHP_EOL.''.PHP_EOL.'Чтобы отправить другу, нажмите на кнопку Поделиться👇';
						}
						else
						{
							$text='<b>Ваша реферальная ссылка:</b>'.PHP_EOL.''.PHP_EOL.'<pre>'.$reflink.'</pre>'.PHP_EOL.''.PHP_EOL.'Чтобы отправить другу, нажмите на кнопку Поделиться👇';
						}
						
						
						$keyb = [  [['text' => 'Поделиться', 'url' => ''.$sharelink.'' ]] ];
							
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						
					}
					else
					{
						$text='<b>Ваша реферальная ссылка:</b>'.PHP_EOL.''.PHP_EOL.'<pre>'.$reflink.'</pre>'.PHP_EOL.''.PHP_EOL.'Чтобы отправить другу, нажмите на кнопку Поделиться👇';
						
						$keyb = [  [['text' => 'Поделиться', 'url' => ''.$sharelink.'' ]] ];
							
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					
					}
				}
				else
				{
					$textall="";
					/* $query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					
					
					$textall="";																											
						
					$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
					$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
					
					if($row[0][0]!="0")
					{
						$text='<a href="'.$row[0][0].'">&#160;</a>';
						$textall=$textall . ''.$text.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
					} */
					
					
					$text='Чтобы использовать реферальную ссылку, Вам необходимо <b>принять участие в розыгрыше</b>. Для этого нажмите кнопку <b>Зарегистрироваться</b>👇';
					$textall=$textall . ''.$text.'';
					
					$merge=[];
					$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
					
					
					$this->api->sendMessage([
						'text' => $textall,
						'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		else
		{
			if($this->testusers())
			{
				$groupurl=$this->group_url();
				$channelurl=$this->channel_url();
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
				
				if($this->cmd_if_exists($tablottery))
				{
					if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
					{
						$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
					
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif($this->inchannel_check()==FALSE)
					{
						$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
					
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif($this->ingroup_check()==FALSE)
					{
						$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
					
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}		
					elseif($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
					{
						if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE refer="'.$chatid.'" LIMIT 1'))))
						{
							$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabusers.' WHERE refer="'.$chatid.'"');
							usleep(250000);
							$con1=mysqli_num_rows($query1);
							
							$textall='';
							
							for($i1=0;$i1<$con1;$i1++)
							{
								mysqli_data_seek($query1, $i1);
								$row1[$i1]=mysqli_fetch_row($query1);
								
								$refchatid=$row1[$i1][1];
								$reffirstname=$row1[$i1][2];
								$reflastname=$row1[$i1][3];
								$refusername=$row1[$i1][4];
								$refactiondate=$row1[$i1][5];
								
								if($this->cmd_sql_searchchatidtable($refchatid, $tabcasinousers))
								{
									if(!empty($reflastname))
									{
										if(!empty($refusername))
										{
											$text=''.$reffirstname.' '.$reflastname.' ('.$refusername.', '.$refactiondate.')';
										}
										else
										{
											$text=''.$reffirstname.' '.$reflastname.' ('.$refactiondate.')';
										}
									}
									else
									{
										if(!empty($refusername))
										{
											$text=''.$reffirstname.' ('.$refusername.', '.$refactiondate.')';
										}
										else
										{
											$text=''.$reffirstname.' ('.$refactiondate.')';
										}
									}
										
									
									if($i1==0)
									{
										$textall=$text;
									}
									else
									{
										$textall=$textall . ', '.$text.'';
									}
								}
							}
								
							if(!empty($textall))
							{
								$text='<b>Ваша реферальная ссылка:</b>'.PHP_EOL.''.PHP_EOL.'<pre>'.$reflink.'</pre>'.PHP_EOL.''.PHP_EOL.'<b>Зарегистрированы по Вашей ссылке:</b> <i>'.$textall.'</i>'.PHP_EOL.''.PHP_EOL.'Чтобы отправить другу, нажмите на кнопку Поделиться👇';
							}
							else
							{
								$text='<b>Ваша реферальная ссылка:</b>'.PHP_EOL.''.PHP_EOL.'<pre>'.$reflink.'</pre>'.PHP_EOL.''.PHP_EOL.'Чтобы отправить другу, нажмите на кнопку Поделиться👇';
							}
							
							
							$keyb = [  [['text' => 'Поделиться', 'url' => ''.$sharelink.'' ]] ];
								
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							
						}
						else
						{
							$text='<b>Ваша реферальная ссылка:</b>'.PHP_EOL.''.PHP_EOL.'<pre>'.$reflink.'</pre>'.PHP_EOL.''.PHP_EOL.'Чтобы отправить другу, нажмите на кнопку Поделиться👇';
							
							$keyb = [  [['text' => 'Поделиться', 'url' => ''.$sharelink.'' ]] ];
								
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						
						}
					}
					else
					{
						$textall="";
						/* $query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						
						
						$textall="";																											
							
						$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
						$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
						
						if($row[0][0]!="0")
						{
							$text='<a href="'.$row[0][0].'">&#160;</a>';
							$textall=$textall . ''.$text.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
						} */
						
						
						$text='Чтобы использовать реферальную ссылку, Вам необходимо <b>принять участие в розыгрыше</b>. Для этого нажмите кнопку <b>Зарегистрироваться</b>👇';
						$textall=$textall . ''.$text.'';
						
						$merge=[];
						$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
						
						
						$this->api->sendMessage([
							'text' => $textall,
							'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
						]);
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
				
					$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}




/////
	public function cmd_my_tickets()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		
		$tabticketsall='tabticketsall';
		
		$tablottery='tablottery';
		$tabusers='tabusers';
		$tabcasinousers='tabcasinousers';
		$tablotteryusers='tablotteryusers';
		$tabserviceuser='tabserviceuser'.$chatid.'';
		
		if($this->id_mainchannel())
		{
		
			$channelurl=$this->channel_url();
			$groupurl=$this->group_url();
			
			$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
			
			
			if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
			{
				
				$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->inchannel_check()==FALSE)
			{
				$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->ingroup_check()==FALSE)
			{
				$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->cmd_if_exists($tablottery))
			{
				if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
				{
					$text='Чтобы смотреть данную информацию,, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
						
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode($this->keyboards['default_user_all']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
				{
					$query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					
					
					$textall="";																											
						
					$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
					$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
					
					if($row[0][0]!="0")
					{
						$text='<a href="'.$row[0][0].'">&#160;</a>';
						$textall=$textall . ''.$text.'';
					}
					
					$this->api->sendMessage([
						'text' => $textall,
						'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
					
					
					$text='Чтобы смотреть данную информацию, Вам необходимо <b>принять участие в розыгрыше</b>. Для этого нажмите кнопку <b>Зарегистрироваться</b>👇';
					
					$merge=[];
					$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
					
					
					$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
				}				
				elseif(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'"'))))
				{
					$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'"');
					$con4=mysqli_num_rows($query4);
					$cntall=$con4;
					
				
					$cntref=0;
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="refer"'))))
					{
						$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="refer"');
						$con4=mysqli_num_rows($query4);
						
						$cntref=$con4;
						
						$tickets_ref="";
						$row4=[];
						
						for($i4=0;$i4<$con4;$i4++)
						{
							mysqli_data_seek($query4, $i4);
							$row4[$i4]=mysqli_fetch_row($query4);
							
							if($i4==0)
							{
								$tickets_ref=$row4[$i4][0];
							}
							else
							{
								$tickets_ref=$tickets_ref . ', '.$row4[$i4][0].'';
							}
						}
					}
					
					
					
					
					$cntdep=0;
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="deposit"'))))
					{
						$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="deposit"');
						$con4=mysqli_num_rows($query4);
						
						$cntdep=$con4;
						
						$tickets_dep="";
						$row4=[];
						
						for($i4=0;$i4<$con4;$i4++)
						{
							mysqli_data_seek($query4, $i4);
							$row4[$i4]=mysqli_fetch_row($query4);
							
							if($i4==0)
							{
								$tickets_dep=$row4[$i4][0];
							}
							else
							{
								$tickets_dep=$tickets_dep . ', '.$row4[$i4][0].'';
							}
							
						}
					}
					
					
					
					
					$a=0;
					
					
					$cntdataprofile=0;
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_fio"'))))
					{
						$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_fio"');
						$con4=mysqli_num_rows($query4);
					
						$cntdataprofile=$con4;
						
						$tickets_dataprofile="";
						$row4=[];
						
						for($i4=0;$i4<$con4;$i4++)
						{
							mysqli_data_seek($query4, $i4);
							$row4[$i4]=mysqli_fetch_row($query4);
							
							if($i4==0)
							{
								$tickets_dataprofile=$row4[$i4][0];
							}
							else
							{
								$tickets_dataprofile=$tickets_dataprofile . ', '.$row4[$i4][0].'';
							}	
						}
					
						$a++;
					}
					
					
					
					
					
					
					$cntdataemail=0;
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_email"'))))
					{
						$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_email"');
						$con4=mysqli_num_rows($query4);
						
						$cntdataemail=$con4;
						$tickets_dataemail="";
						$row4=[];
						
						for($i4=0;$i4<$con4;$i4++)
						{
							mysqli_data_seek($query4, $i4);
							$row4[$i4]=mysqli_fetch_row($query4);
							
							if($i4==0)
							{
								$tickets_dataemail=$row4[$i4][0];
							}
							else
							{
								$tickets_dataemail=$tickets_dataemail . ', '.$row4[$i4][0].'';
							}	
						}
					
						$a++;
					}
					
					
					
					
					
					
					$cntdataphone=0;
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_phone"'))))
					{
						$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_phone"');
						$con4=mysqli_num_rows($query4);
						
						$cntdataphone=$con4;
						$tickets_dataphone="";
						$row4=[];
						
						for($i4=0;$i4<$con4;$i4++)
						{
							mysqli_data_seek($query4, $i4);
							$row4[$i4]=mysqli_fetch_row($query4);
							
							if($i4==0)
							{
								$tickets_dataphone=$row4[$i4][0];
							}
							else
							{
								$tickets_dataphone=$tickets_dataphone . ', '.$row4[$i4][0].'';
							}	
						}
					
						$a++;
					}
					
					
					
					
					
					
					$cntpublic=0;
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="public"'))))
					{
						$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="public"');
						$con4=mysqli_num_rows($query4);
					
						$cntpublic=$con4;
						
						$tickets_public="";
						$row4=[];
						
						for($i4=0;$i4<$con4;$i4++)
						{
							mysqli_data_seek($query4, $i4);
							$row4[$i4]=mysqli_fetch_row($query4);
							
							if($i4==0)
							{
								$tickets_public=$row4[$i4][0];
							}
							else
							{
								$tickets_public=$tickets_public . ', '.$row4[$i4][0].'';
							}
							
						}
					}
					
					
					
				
					
					$query1=mysqli_query($con_sql2, 'SELECT parrefer,pardata,pardeposit,parpublic FROM '.$tablottery.'');
					usleep(150000);
					$con1=mysqli_num_rows($query1);
					
					$row1=[];
					for($i1=0;$i1<$con1;$i1++)
					{
						mysqli_data_seek($query1, $i1);
						$row1[$i1]=mysqli_fetch_row($query1);
					}
					
					$parrefer=$row1[0][0];
					$pardata=$row1[0][1];
					$pardeposit=$row1[0][2];
					$parpublic=$row1[0][3];
					
					$text='🎫<b>Ваши билеты:</b>'.PHP_EOL.''.PHP_EOL.'';
					
												//////////////////////////////////DATA///////////////////////////////////
					if(!empty($pardata))
					{
						if($cntdataprofile!=0 && $cntdataemail!=0 && $cntdataphone!=0)
						{
							
							$text=$text . '<i>За заполненный профиль</i> в Казино – есть билет! (<b>'.$tickets_dataprofile.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							$text=$text . '<i>За подтвержденную почту</i> - есть билет!  (<b>'.$tickets_dataemail.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							$text=$text . '<i>За подтвержденный телефон</i> - есть билет!  (<b>'.$tickets_dataphone.'</b>)'.PHP_EOL.''.PHP_EOL.'';
						}
						else
						{
							if($cntdataprofile==0)
							{
								$text=$text . '<i>За заполненный профиль</i> в Казино – нет:('.PHP_EOL.''.PHP_EOL.'';
							}
							else
							{
								$text=$text . '<i>За заполненный профиль</i> в Казино – есть билет! (<b>'.$tickets_dataprofile.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							}
							
							if($cntdataemail==0)
							{
								$text=$text . '<i>За подтвержденную почту</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
							}
							else
							{
								$text=$text . '<i>За подтвержденную почту</i> - есть билет!  (<b>'.$tickets_dataemail.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							}
							
							if($cntdataphone==0)
							{
								$text=$text . '<i>За подтвержденный телефон</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
							}
							else
							{
								$text=$text . '<i>За подтвержденный телефон</i> - есть билет!  (<b>'.$tickets_dataphone.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							}
							
							if($a==2)
							{
								$text=$text . 'Упс! У Вас не хватает билета, который можно с легкостью получить.'.PHP_EOL.''.PHP_EOL.'';
							}
							if($a<2)
							{
								$text=$text . 'Упс! У Вас не хватает билетов, которые можно с легкостью получить.'.PHP_EOL.''.PHP_EOL.'';
							}
						}
					}
									
					
									//////////////////////////////////DEP///////////////////////////////////
					if(!empty($pardeposit))
					{
						if($cntdep!=0)
						{
							$text=$text . '<i>За активную игру</i> - '.$cntdep.' шт.  (<b>'.$tickets_dep.'</b>)'.PHP_EOL.''.PHP_EOL.'';
						}
						else
						{
							$text=$text . '<i>За активную игру</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
							
							$text=$text . 'Ой, кажется, Вы застряли... Не стоит выжидать момент, когда будет поздно!'.PHP_EOL.''.PHP_EOL.'Получайте билеты за игру, пока другие надеяться на удачу, и вырывайтесь на первое место🚀'.PHP_EOL.''.PHP_EOL.'';
						}
					}
					
					if(!empty($parrefer))
					{
										//////////////////////////////////REF///////////////////////////////////
						if($cntref!=0)
						{
							$text=$text . '<i>За приглашенных друзей</i> - '.$cntref.' шт.  (<b>'.$tickets_ref.'</b>)'.PHP_EOL.''.PHP_EOL.'';
						}
						else
						{
							$text=$text . '<i>За приглашенных друзей</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
							
							$text=$text . 'Эй! Разве у Вас нет друзей? Поделитесь с ними ссылкой и состязайтесь командой за первые места, пока другие пытаются в одиночку🏃'.PHP_EOL.''.PHP_EOL.'';
						}
					}
					
									//////////////////////////////////PUB///////////////////////////////////
					if(!empty($parpublic))
					{
						if($cntpublic!=0)
						{
							$text=$text . '<i>За публикации</i> - '.$cntpublic.' шт. (<b>'.$tickets_public.'</b>)'.PHP_EOL.''.PHP_EOL.'';
						}
					}
					
									//////////////////////////////////ALL///////////////////////////////////
					$text=$text . '<b>Всего билетов – '.$cntall.'</b>'.PHP_EOL.''.PHP_EOL.'';				
					
					if(!empty($pardata) && !empty($pardeposit) && !empty($parrefer))
					{
						if($cntdataprofile!=0 && $cntdataemail!=0 && $cntdataphone!=0 && $cntdep!=0 && $cntref!=0)
						{
							$text=$text . 'Вы в топе – так держать! Продолжайте играть как ни в чем не бывало и копите билеты, чтобы быть вне конкуренции!'.PHP_EOL.''.PHP_EOL.'Подсказки всегда скрываются за кнопкой 🎁<b>Хочу больше билетов</b>👇';
						}
						else
						{
							$text=$text . 'Пожалуй, Вам нужно больше билетов😋'.PHP_EOL.''.PHP_EOL.'Нажимайте кнопку 🎁<b>Хочу больше билетов</b> и узнайте как их заполучить👇';
						}
					}
				
					$this->api->sendMessage([
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
					
				}
				else
				{
					$text='😳У Вас нет розыгрышных билетов…'.PHP_EOL.''.PHP_EOL.'Скорее нажимайте кнопку 🎁<b>Хочу больше билетов</b>, чтобы не упустить шанс забрать подарок.';
				
					$this->api->sendMessage([
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		else
		{
			if($this->testusers())
			{
				$channelurl=$this->channel_url();
				$groupurl=$this->group_url();
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
				
				
				if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
				{
					
					$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->inchannel_check()==FALSE)
				{
					$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->ingroup_check()==FALSE)
				{
					$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->cmd_if_exists($tablottery))
				{
					if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
					{
						$text='Чтобы смотреть данную информацию,, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
							
						mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
						
						
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode($this->keyboards['default_user_all']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
					{
						$query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						
						
						$textall="";																											
							
						$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
						$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
						
						if($row[0][0]!="0")
						{
							$text='<a href="'.$row[0][0].'">&#160;</a>';
							$textall=$textall . ''.$text.'';
						}
						
						
						$this->api->sendMessage([
						'text' => $textall,
						'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					
					
						$text='Чтобы смотреть данную информацию, Вам необходимо <b>принять участие в розыгрыше</b>. Для этого нажмите кнопку <b>Зарегистрироваться</b>👇';
						
						$merge=[];
						$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
						
						
						$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
						]);
					}				
					elseif(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'"'))))
					{
						$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'"');
						$con4=mysqli_num_rows($query4);
						$cntall=$con4;
						
					
						$cntref=0;
						
						if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="refer"'))))
						{
							$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="refer"');
							$con4=mysqli_num_rows($query4);
							
							$cntref=$con4;
							
							$tickets_ref="";
							$row4=[];
							
							for($i4=0;$i4<$con4;$i4++)
							{
								mysqli_data_seek($query4, $i4);
								$row4[$i4]=mysqli_fetch_row($query4);
								
								if($i4==0)
								{
									$tickets_ref=$row4[$i4][0];
								}
								else
								{
									$tickets_ref=$tickets_ref . ', '.$row4[$i4][0].'';
								}
							}
						}
						
						
						
						
						$cntdep=0;
						
						if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="deposit"'))))
						{
							$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="deposit"');
							$con4=mysqli_num_rows($query4);
							
							$cntdep=$con4;
							
							$tickets_dep="";
							$row4=[];
							
							for($i4=0;$i4<$con4;$i4++)
							{
								mysqli_data_seek($query4, $i4);
								$row4[$i4]=mysqli_fetch_row($query4);
								
								if($i4==0)
								{
									$tickets_dep=$row4[$i4][0];
								}
								else
								{
									$tickets_dep=$tickets_dep . ', '.$row4[$i4][0].'';
								}
								
							}
						}
						
						
						
						
						$a=0;
						
						
						$cntdataprofile=0;
						
						if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_fio"'))))
						{
							$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_fio"');
							$con4=mysqli_num_rows($query4);
						
							$cntdataprofile=$con4;
							
							$tickets_dataprofile="";
							$row4=[];
							
							for($i4=0;$i4<$con4;$i4++)
							{
								mysqli_data_seek($query4, $i4);
								$row4[$i4]=mysqli_fetch_row($query4);
								
								if($i4==0)
								{
									$tickets_dataprofile=$row4[$i4][0];
								}
								else
								{
									$tickets_dataprofile=$tickets_dataprofile . ', '.$row4[$i4][0].'';
								}	
							}
						
							$a++;
						}
						
						
						
						
						
						
						$cntdataemail=0;
						
						if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_email"'))))
						{
							$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_email"');
							$con4=mysqli_num_rows($query4);
							
							$cntdataemail=$con4;
							$tickets_dataemail="";
							$row4=[];
							
							for($i4=0;$i4<$con4;$i4++)
							{
								mysqli_data_seek($query4, $i4);
								$row4[$i4]=mysqli_fetch_row($query4);
								
								if($i4==0)
								{
									$tickets_dataemail=$row4[$i4][0];
								}
								else
								{
									$tickets_dataemail=$tickets_dataemail . ', '.$row4[$i4][0].'';
								}	
							}
						
							$a++;
						}
						
						
						
						
						
						
						$cntdataphone=0;
						
						if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_phone"'))))
						{
							$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="data_phone"');
							$con4=mysqli_num_rows($query4);
							
							$cntdataphone=$con4;
							$tickets_dataphone="";
							$row4=[];
							
							for($i4=0;$i4<$con4;$i4++)
							{
								mysqli_data_seek($query4, $i4);
								$row4[$i4]=mysqli_fetch_row($query4);
								
								if($i4==0)
								{
									$tickets_dataphone=$row4[$i4][0];
								}
								else
								{
									$tickets_dataphone=$tickets_dataphone . ', '.$row4[$i4][0].'';
								}	
							}
						
							$a++;
						}
						
						
						
						
						
						
						$cntpublic=0;
						
						if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="public"'))))
						{
							$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="public"');
							$con4=mysqli_num_rows($query4);
						
							$cntpublic=$con4;
							
							$tickets_public="";
							$row4=[];
							
							for($i4=0;$i4<$con4;$i4++)
							{
								mysqli_data_seek($query4, $i4);
								$row4[$i4]=mysqli_fetch_row($query4);
								
								if($i4==0)
								{
									$tickets_public=$row4[$i4][0];
								}
								else
								{
									$tickets_public=$tickets_public . ', '.$row4[$i4][0].'';
								}
								
							}
						}
						
						
						
					
						
						$query1=mysqli_query($con_sql2, 'SELECT parrefer,pardata,pardeposit,parpublic FROM '.$tablottery.'');
						usleep(150000);
						$con1=mysqli_num_rows($query1);
						
						$row1=[];
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
						}
						
						$parrefer=$row1[0][0];
						$pardata=$row1[0][1];
						$pardeposit=$row1[0][2];
						$parpublic=$row1[0][3];
						
						$text='🎫<b>Ваши билеты:</b>'.PHP_EOL.''.PHP_EOL.'';
						
													//////////////////////////////////DATA///////////////////////////////////
						if(!empty($pardata))
						{
							if($cntdataprofile!=0 && $cntdataemail!=0 && $cntdataphone!=0)
							{
								
								$text=$text . '<i>За заполненный профиль</i> в Казино – есть билет! (<b>'.$tickets_dataprofile.'</b>)'.PHP_EOL.''.PHP_EOL.'';
								$text=$text . '<i>За подтвержденную почту</i> - есть билет!  (<b>'.$tickets_dataemail.'</b>)'.PHP_EOL.''.PHP_EOL.'';
								$text=$text . '<i>За подтвержденный телефон</i> - есть билет!  (<b>'.$tickets_dataphone.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							}
							else
							{
								if($cntdataprofile==0)
								{
									$text=$text . '<i>За заполненный профиль</i> в Казино – нет:('.PHP_EOL.''.PHP_EOL.'';
								}
								else
								{
									$text=$text . '<i>За заполненный профиль</i> в Казино – есть билет! (<b>'.$tickets_dataprofile.'</b>)'.PHP_EOL.''.PHP_EOL.'';
								}
								
								if($cntdataemail==0)
								{
									$text=$text . '<i>За подтвержденную почту</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
								}
								else
								{
									$text=$text . '<i>За подтвержденную почту</i> - есть билет!  (<b>'.$tickets_dataemail.'</b>)'.PHP_EOL.''.PHP_EOL.'';
								}
								
								if($cntdataphone==0)
								{
									$text=$text . '<i>За подтвержденный телефон</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
								}
								else
								{
									$text=$text . '<i>За подтвержденный телефон</i> - есть билет!  (<b>'.$tickets_dataphone.'</b>)'.PHP_EOL.''.PHP_EOL.'';
								}
								
								if($a==2)
								{
									$text=$text . 'Упс! У Вас не хватает билета, который можно с легкостью получить.'.PHP_EOL.''.PHP_EOL.'';
								}
								if($a<2)
								{
									$text=$text . 'Упс! У Вас не хватает билетов, которые можно с легкостью получить.'.PHP_EOL.''.PHP_EOL.'';
								}
							}
						}
										
						
										//////////////////////////////////DEP///////////////////////////////////
						if(!empty($pardeposit))
						{
							if($cntdep!=0)
							{
								$text=$text . '<i>За активную игру</i> - '.$cntdep.' шт.  (<b>'.$tickets_dep.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							}
							else
							{
								$text=$text . '<i>За активную игру</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
								
								$text=$text . 'Ой, кажется, Вы застряли... Не стоит выжидать момент, когда будет поздно!'.PHP_EOL.''.PHP_EOL.'Получайте билеты за игру, пока другие надеяться на удачу, и вырывайтесь на первое место🚀'.PHP_EOL.''.PHP_EOL.'';
							}
						}
						
						if(!empty($parrefer))
						{
											//////////////////////////////////REF///////////////////////////////////
							if($cntref!=0)
							{
								$text=$text . '<i>За приглашенных друзей</i> - '.$cntref.' шт.  (<b>'.$tickets_ref.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							}
							else
							{
								$text=$text . '<i>За приглашенных друзей</i> – нет:('.PHP_EOL.''.PHP_EOL.'';
								
								$text=$text . 'Эй! Разве у Вас нет друзей? Поделитесь с ними ссылкой и состязайтесь командой за первые места, пока другие пытаются в одиночку🏃'.PHP_EOL.''.PHP_EOL.'';
							}
						}
						
										//////////////////////////////////PUB///////////////////////////////////
						if(!empty($parpublic))
						{
							if($cntpublic!=0)
							{
								$text=$text . '<i>За публикации</i> - '.$cntpublic.' шт. (<b>'.$tickets_public.'</b>)'.PHP_EOL.''.PHP_EOL.'';
							}
						}
						
										//////////////////////////////////ALL///////////////////////////////////
						$text=$text . '<b>Всего билетов – '.$cntall.'</b>'.PHP_EOL.''.PHP_EOL.'';				
						
						if(!empty($pardata) && !empty($pardeposit) && !empty($parrefer))
						{
							if($cntdataprofile!=0 && $cntdataemail!=0 && $cntdataphone!=0 && $cntdep!=0 && $cntref!=0)
							{
								$text=$text . 'Вы в топе – так держать! Продолжайте играть как ни в чем не бывало и копите билеты, чтобы быть вне конкуренции!'.PHP_EOL.''.PHP_EOL.'Подсказки всегда скрываются за кнопкой 🎁<b>Хочу больше билетов</b>👇';
							}
							else
							{
								$text=$text . 'Пожалуй, Вам нужно больше билетов😋'.PHP_EOL.''.PHP_EOL.'Нажимайте кнопку 🎁<b>Хочу больше билетов</b> и узнайте как их заполучить👇';
							}
						}
					
						$this->api->sendMessage([
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
						]);
						
					}
					else
					{
						$text='😳У Вас нет розыгрышных билетов…'.PHP_EOL.''.PHP_EOL.'Скорее нажимайте кнопку 🎁<b>Хочу больше билетов</b>, чтобы не упустить шанс забрать подарок.';
					
						$this->api->sendMessage([
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
						]);
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
				
					$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}	

	

/////
	public function cmd_lottery_info()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$mainchannel=$this->mainchannel();
		
		$tablottery='tablottery';
		$tablotteryusers='tablotteryusers';
		$tabcasinousers='tabcasinousers';
		$tabticketsall='tabticketsall';
				
		$tabserviceuser='tabserviceuser'.$chatid.'';
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceuser.'');
		usleep(250000);
		
		if($this->id_mainchannel())
		{
		
			/////CHECK CHANNEL AND GROUP/////
			$channelurl=$this->channel_url();
			$groupurl=$this->group_url();
			
			$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
			
			if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
			{
				
				$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->inchannel_check()==FALSE)
			{
				$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->ingroup_check()==FALSE)
			{
				$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			
			
			elseif($this->cmd_if_exists($tablottery))
			{
				$query7=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$tablottery.'');
				usleep(250000);
				$con7=mysqli_num_rows($query7);
				
				for($i7=0;$i7<$con7;$i7++)
				{
					mysqli_data_seek($query7, $i7);
					$row7[$i7]=mysqli_fetch_row($query7);
				}
				
				$lotteryname=$row7[0][0];
				
				
				if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
				{	
				
					$query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					
				
					$textall="";																											
					
					$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
					$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
					
					if($row[0][0]!="0")
					{
						$text='<a href="'.$row[0][0].'">&#160;</a>';
						$textall=$textall . ''.$text.'';
					}
				
				
					$this->api->sendMessage([
					'text' => $textall,
					//'disable_notification' => TRUE,
					////'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					
					
					$textall="";																											
						
					$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
					$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
					
					if($row[0][0]!="0")
					{
						$text='<a href="'.$row[0][0].'">&#160;</a>';
						$textall=$textall . ''.$text.'';
					}
					
					$this->api->sendMessage([
						'text' => $textall,
						//'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
					
					
					$text='<b>Чтобы принять участие в розыгрыше</b>, нажмите кнопку <b>Зарегистрироваться</b>👇';
					
					$merge=[];
					$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
					
					
					$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
					
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		else
		{
			if($this->testusers())
			{
				/////CHECK CHANNEL AND GROUP/////
				$channelurl=$this->channel_url();
				$groupurl=$this->group_url();
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
				
				if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
				{
					
					$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->inchannel_check()==FALSE)
				{
					$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->ingroup_check()==FALSE)
				{
					$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				
				
				
				elseif($this->cmd_if_exists($tablottery))
				{
					$query7=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$tablottery.'');
					usleep(250000);
					$con7=mysqli_num_rows($query7);
					
					for($i7=0;$i7<$con7;$i7++)
					{
						mysqli_data_seek($query7, $i7);
						$row7[$i7]=mysqli_fetch_row($query7);
					}
					
					$lotteryname=$row7[0][0];
					
					
					if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
					{	
					
						$query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						
					
						$textall="";																											
						
						$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
						$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
						
						if($row[0][0]!="0")
						{
							$text='<a href="'.$row[0][0].'">&#160;</a>';
							$textall=$textall . ''.$text.'';
						}
					
					
						$this->api->sendMessage([
						'text' => $textall,
						//'disable_notification' => TRUE,
						////'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					else
					{
						$query=mysqli_query($con_sql2, 'SELECT photos FROM '.$tablottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						
						
						$textall="";																											
							
						$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
						$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
						
						if($row[0][0]!="0")
						{
							$text='<a href="'.$row[0][0].'">&#160;</a>';
							$textall=$textall . ''.$text.'';
						}
						
						$this->api->sendMessage([
							'text' => $textall,
							//'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
						]);
						
						
						$text='<b>Чтобы принять участие в розыгрыше</b>, нажмите кнопку <b>Зарегистрироваться</b>👇';
						
						$merge=[];
						$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
						
						
						$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
						]);
						
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
				
					$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}	



/////
	public function callback_takeaction_lottery_user()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$firstname=$this->api->firstname;
		
		if(isset($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		else
		{
			$lastname="0";
		}
		
		if(isset($this->api->username))
		{
			$username='@'.$this->api->username.'';
		}
		else
		{
			$username="0";
		}
		
		$tabadmin='tabadmin';
		$tabusers='tabusers';
		$tablotteryusers='tablotteryusers';
		$tablottery='tablottery';
		$tabserviceadmin='tabserviceadmin';
		$tabcasinousers='tabcasinousers';
		
		
		if($this->id_mainchannel())
		{
			$channelurl=$this->channel_url();
			$groupurl=$this->group_url();
			
			$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
			
			
			if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
			{
				
				$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->inchannel_check()==FALSE)
			{
				$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->ingroup_check()==FALSE)
			{
				$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->cmd_if_exists($tablottery))
			{
				$query7=mysqli_query($con_sql2, 'SELECT lotteryname, startdate FROM '.$tablottery.'');
				usleep(250000);
				$con7=mysqli_num_rows($query7);
				
				for($i7=0;$i7<$con7;$i7++)
				{
					mysqli_data_seek($query7, $i7);
					$row7[$i7]=mysqli_fetch_row($query7);
				}
				
				$lotteryname=$row7[0][0];
				$startdate=$row7[0][1];
				
				if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
				{
				
					$text='Чтобы принять участие в розыгрыше, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
				
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
				
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode($this->keyboards['default_user_all']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
				{
					if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
					{
						if($this->cmd_if_exists($tabtempuser)==FALSE)
						{
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							usleep(250000);
							
							$query=mysqli_query($con_sql2, 'SELECT casinoid FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
							usleep(250000);
							$con=mysqli_num_rows($query);
							
							$row=[];
							
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								$row[$i]=mysqli_fetch_row($query);
							}
							
							$idcasino=$row[0][0];
						
							$postdata=http_build_query(
								[
									'idcasino' => $idcasino,
									'idtelegram' => $chatid,
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
							
							$text='<b>Ваш запрос на регистрацию в розыгрыше успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
							
							$this->api->sendMessage([
							'chat_id' => $chatid,
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							
							
							date_default_timezone_set('Europe/Kiev');
							@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'long lottery registration date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$textmessage.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
						}
						else
						{
							$text='<b>Ваш предыдущий запрос ещё в обработке</b>😇'.PHP_EOL.''.PHP_EOL.'Подождите немного. Вскоре Вам придет уведомление.';
							
							$this->api->sendMessage([
							'chat_id' => $chatid,
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
					}
					else
					{
						$text='Вы уже <b>зарегистрированы</b> в данном розыгрыше!';
				
						$this->api->sendMessage([
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		else
		{
			if($this->testusers())
			{
				$channelurl=$this->channel_url();
				$groupurl=$this->group_url();
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
				
				
				if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
				{
					
					$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->inchannel_check()==FALSE)
				{
					$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->ingroup_check()==FALSE)
				{
					$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->cmd_if_exists($tablottery))
				{
					$query7=mysqli_query($con_sql2, 'SELECT lotteryname, startdate FROM '.$tablottery.'');
					usleep(250000);
					$con7=mysqli_num_rows($query7);
					
					for($i7=0;$i7<$con7;$i7++)
					{
						mysqli_data_seek($query7, $i7);
						$row7[$i7]=mysqli_fetch_row($query7);
					}
					
					$lotteryname=$row7[0][0];
					$startdate=$row7[0][1];
					
					if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
					{
					
						$text='Чтобы принять участие в розыгрыше, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
					
						mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
					
						
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode($this->keyboards['default_user_all']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
					{
						if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
						{
							if($this->cmd_if_exists($tabtempuser)==FALSE)
							{
								mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
								usleep(250000);
								
								$query=mysqli_query($con_sql2, 'SELECT casinoid FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
								usleep(250000);
								$con=mysqli_num_rows($query);
								
								$row=[];
								
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
								
								$idcasino=$row[0][0];
							
								$postdata=http_build_query(
									[
										'idcasino' => $idcasino,
										'idtelegram' => $chatid,
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
								
								$text='<b>Ваш запрос на регистрацию в розыгрыше успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
								
								$this->api->sendMessage([
								'chat_id' => $chatid,
								'text' => $text,
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								
								
								date_default_timezone_set('Europe/Kiev');
								@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'long lottery registration date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$textmessage.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
							}
							else
							{
								$text='<b>Ваш предыдущий запрос ещё в обработке</b>😇'.PHP_EOL.''.PHP_EOL.'Подождите немного. Вскоре Вам придет уведомление.';
								
								$this->api->sendMessage([
								'chat_id' => $chatid,
								'text' => $text,
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
						}
						else
						{
							$text='Вы уже <b>зарегистрированы</b> в данном розыгрыше!';
					
							$this->api->sendMessage([
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
				
					$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}



/////
	public function cmd_refresh_data()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$firstname=$this->api->firstname;
		
		if(isset($this->api->lastname))
		{
			$lastname=$this->api->lastname;
		}
		else
		{
			$lastname="0";
		}
		
		if(isset($this->api->username))
		{
			$username='@'.$this->api->username.'';
		}
		else
		{
			$username="0";
		}
		
		$mainchannel=$this->mainchannel();
		
		$tablottery='tablottery';
		$tablotteryusers='tablotteryusers';
		$tabcasinousers='tabcasinousers';
		$tabserviceuser='tabserviceuser'.$chatid.'';
		$tabticketsall='tabticketsall';
		
		if($this->id_mainchannel())
		{
			$channelurl=$this->channel_url();
			$groupurl=$this->group_url();
			
			$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
			
			$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
			
			if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
			{
				
				$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->inchannel_check()==FALSE)
			{
				$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->ingroup_check()==FALSE)
			{
				$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}		
			elseif($this->cmd_if_exists($tablottery))
			{
				
				$query7=mysqli_query($con_sql2, 'SELECT lotteryname, messid FROM '.$tablottery.'');
				usleep(250000);
				$con7=mysqli_num_rows($query7);
			
				for($i7=0;$i7<$con7;$i7++)
				{
					mysqli_data_seek($query7, $i7);
					$row7[$i7]=mysqli_fetch_row($query7);
				}
				
				$lotteryname=$row7[0][0];
				$messageidlottery=$row7[0][1];


				if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
				{
					$text='Чтобы принять участие в розыгрыше, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
					
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode($this->keyboards['default_user_all']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
				{
					if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
					{					
						$text='<b>Чтобы получать билеты, Вам нужно принять участие в розыгрыше</b>.'.PHP_EOL.''.PHP_EOL.'Для этого нажмите кнопку <b>Зарегистрироваться</b>👇';
						
						$merge=[];
						$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
								
						$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
						]);
					}
					else
					{
				
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						$casinoid=$row[0][2];
						$lasttime=$row[0][8];
						$timenow=date('d.m.Y G:i');
						
		
						if(file_exists(''.dirname(__FILE__).'/enddate.txt'))
						{
		
							$timestamplast=strtotime($lasttime);
							$timestampnow=strtotime($timenow);
							$timediff=($timestampnow-$timestamplast);
						
							
							
							if($lasttime=="0")
							{
								$timepause=ceil(DataBot::REFRESHTIME/60);
								
								$text='<b>Уже был отправлен запрос в казино Казино</b>. К сожалению, данную кнопку можно нажимать <b>1 раз в '.$timepause.' минут.</b>';
										
								$this->api->sendMessage([
								'text' => $text,
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
							elseif($timediff<DataBot::REFRESHTIME)
							{
								
								$timepause=ceil(DataBot::REFRESHTIME/60);
								
								$text='К сожалению, данную кнопку можно нажимать <b>1 раз в '.$timepause.' минут.</b>';
										
								$this->api->sendMessage([
								'text' => $text,
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
							else
							{
								$query4=mysqli_query($con_sql2, 'SELECT startdate FROM '.$tablottery.'');
								$con4=mysqli_num_rows($query4);
							
								for($i4=0;$i4<$con4;$i4++)
								{
									mysqli_data_seek($query4, $i4);
									$row4[$i4]=mysqli_fetch_row($query4);
								}
								
								$startdate=$row4[0][0];
								
								
								$postdata=http_build_query(
									[
										'idcasino' => $casinoid,
										'idtelegram' => $chatid,
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
								
								$text='<b>Ваш запрос на получение данных по казино Казино успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
								
								$this->api->sendMessage([
								'chat_id' => $chatid,
								'text' => $text,
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								
								date_default_timezone_set('Europe/Kiev');
								@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'button date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$casinoid.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
								
							}
						}
						else
						{
							$text='<b>Использование данной кнопки заблокировано</b> в связи подсчетом результатов розыгрыша!';
								
							$this->api->sendMessage([
							'chat_id' => $chatid,
							'text' => $text,
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
					}
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		else
		{
			if($this->testusers())
			{
				$channelurl=$this->channel_url();
				$groupurl=$this->group_url();
				
				$buttonchannel=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttongroup=[  [['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];
				
				$buttonall=[  [['text' => '➡️Подписаться на канал ', 'url' => "$channelurl"], ['text' => '➡️Присоединиться к чату', 'url' => "$groupurl" ]], [['text' => '🔄Обновить статус', 'callback_data' => 'refresh_status']] ];	
				
				if($this->inchannel_check()==FALSE && $this->ingroup_check()==FALSE)
				{
					
					$text='Сначала Вам нужно <b>подписаться на канал и присоединиться к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующие кнопки снизу👇'.PHP_EOL.''.PHP_EOL.'После этих действий, вернитесь в бот и нажмите на кнопку 🔄Обновить статус.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonall]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->inchannel_check()==FALSE)
				{
					$text='Также <b>подпишитесь на канал</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После подписки, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttonchannel]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				elseif($this->ingroup_check()==FALSE)
				{
					$text='Также <b>присоединитесь к чату</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете это сделать нажав на соответствующую кнопку снизу👇'.PHP_EOL.''.PHP_EOL.'После присоединения, вернитесь в бот и нажмите на кнопку <b>🔄Обновить статус</b>.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$buttongroup]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}		
				elseif($this->cmd_if_exists($tablottery))
				{
					
					$query7=mysqli_query($con_sql2, 'SELECT lotteryname, messid FROM '.$tablottery.'');
					usleep(250000);
					$con7=mysqli_num_rows($query7);
				
					for($i7=0;$i7<$con7;$i7++)
					{
						mysqli_data_seek($query7, $i7);
						$row7[$i7]=mysqli_fetch_row($query7);
					}
					
					$lotteryname=$row7[0][0];
					$messageidlottery=$row7[0][1];
	
	
					if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)
					{
						$text='Чтобы принять участие в розыгрыше, Вам необходимо <b>иметь аккаунт в Казино</b>.'.PHP_EOL.''.PHP_EOL.'Если у Вас еще <b>нет аккаунта</b>, перейдите на сайт Казино нажав кнопку <b>🎰Перейти на сайт</b>.'.PHP_EOL.''.PHP_EOL.'Если Вы <b>уже зарегистрированы</b>, пришлите мне Ваш ID (номер счета) в Казино👇';
						
						mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceuser.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
						
						
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode($this->keyboards['default_user_all']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					elseif($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers))
					{
						if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
						{					
							$text='<b>Чтобы получать билеты, Вам нужно принять участие в розыгрыше</b>.'.PHP_EOL.''.PHP_EOL.'Для этого нажмите кнопку <b>Зарегистрироваться</b>👇';
							
							$merge=[];
							$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
									
							$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
							]);
						}
						else
						{
					
							$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
							usleep(250000);
							$con=mysqli_num_rows($query);
							
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								$row[$i]=mysqli_fetch_row($query);
							}
							
							$casinoid=$row[0][2];
							$lasttime=$row[0][8];
							$timenow=date('d.m.Y G:i');
							
			
							if(file_exists(''.dirname(__FILE__).'/enddate.txt'))
							{
			
								$timestamplast=strtotime($lasttime);
								$timestampnow=strtotime($timenow);
								$timediff=($timestampnow-$timestamplast);
							
								
								
								if($lasttime=="0")
								{
									$timepause=ceil(DataBot::REFRESHTIME/60);
									
									$text='<b>Уже был отправлен запрос в казино Казино</b>. К сожалению, данную кнопку можно нажимать <b>1 раз в '.$timepause.' минут.</b>';
											
									$this->api->sendMessage([
									'text' => $text,
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
								}
								elseif($timediff<DataBot::REFRESHTIME)
								{
									
									$timepause=ceil(DataBot::REFRESHTIME/60);
									
									$text='К сожалению, данную кнопку можно нажимать <b>1 раз в '.$timepause.' минут.</b>';
											
									$this->api->sendMessage([
									'text' => $text,
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
								}
								else
								{
									$query4=mysqli_query($con_sql2, 'SELECT startdate FROM '.$tablottery.'');
									$con4=mysqli_num_rows($query4);
								
									for($i4=0;$i4<$con4;$i4++)
									{
										mysqli_data_seek($query4, $i4);
										$row4[$i4]=mysqli_fetch_row($query4);
									}
									
									$startdate=$row4[0][0];
									
									
									$postdata=http_build_query(
										[
											'idcasino' => $casinoid,
											'idtelegram' => $chatid,
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
									
									$text='<b>Ваш запрос на получение данных по казино Казино успешно отправлен</b>😇'.PHP_EOL.''.PHP_EOL.'Вскоре Вам придет уведомление.';
									
									$this->api->sendMessage([
									'chat_id' => $chatid,
									'text' => $text,
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
									
									date_default_timezone_set('Europe/Kiev');
									@file_put_contents(''.dirname(__FILE__).'/id1.txt', 'button date - '.date('d.m.Y G:i:s').''.PHP_EOL.'idcasino - '.$casinoid.', idtelegram - '.$chatid.''.PHP_EOL.''.PHP_EOL.'',FILE_APPEND);
									
								}
							}
							else
							{
								$text='<b>Использование данной кнопки заблокировано</b> в связи подсчетом результатов розыгрыша!';
									
								$this->api->sendMessage([
								'chat_id' => $chatid,
								'text' => $text,
								//'disable_notification' => TRUE,
								//'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							}
						}
					}
				}
				else
				{
					$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊';
				
					$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='<b>В данный момент нет действующих розыгрышей.</b>'.PHP_EOL.''.PHP_EOL.'Узнавайте о них первым, подписавшись на Telegram-канал <a href="'.DataBot::URLOFCHANNEL.'">Казино</a>😊'.$this->pre.'';
			
				$keyb = [  [['text' => 'Узнавать первым', 'url' => DataBot::URLOFCHANNEL ]] ];
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
		}
	}









///////////////////////////////////////////////////////ADMIN///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////CREATE LOTTERY//////////////////////////////////////////////////

/////
	public function cmd_create_lottery()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$chatid=$this->api->chatId;
			
			$firstname=$this->api->firstname;
			
			if(isset($this->api->lastname))
			{
				$lastname=$this->api->lastname;
			}
			else
			{
				$lastname="0";
			}
			
			if(isset($this->api->username))
			{
				$username='@'.$this->api->username.'';
			}
			else
			{
				$username="0";
			}
	
						
			$tablottery='tablottery';
			$tabservicelottery='tabservicelottery';
			$tabserviceadmin='tabserviceadmin';
			$tabadminchange='tabadminchange';
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(250000);
			$query=mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
			usleep(250000);
				
				
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicelottery.' LIMIT 1')==FALSE)
			{
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tablottery.' LIMIT 1')==FALSE)
				{
					if(file_exists(''.dirname(__FILE__).'/adminlottery.txt'))
					{
						unlink(''.dirname(__FILE__).'/adminlottery.txt');
					}
					
					if(empty($firstname))
					{
						$putdata=''.$lastname.' ('.$username.', '.$chatid.')';
					}
					elseif(empty($lastname))
					{
						$putdata=''.$firstname.' ('.$username.', '.$chatid.')';
					}
					else
					{
						$putdata=''.$firstname.' '.$lastname.' ('.$username.', '.$chatid.')';
					}
					
					file_put_contents(''.dirname(__FILE__).'/adminlottery.txt', $putdata);
		
		
					$text='<b>Выбери канал для проведения розыгрыша</b>👇';
					
					$merge=$this->cmd_create_lottery_choosechannel();
					usleep(250000);
					
					if (array_filter($merge) !== [])
					{
						$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
						
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					else
					{
						$text='<b>У Вас нет ни одного канала.</b> Сначала добавьте бота хотя бы в один канал, прежде чем создавать розыгрыш.';
				
						$this->api->sendMessage([
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
				else
				{

					$text='<b>У Вас уже есть действующий розыгрыш в канале!</b> Пожалуйста, дождитесь его завершения или удалите его, чтобы создать новый.';
				
					$this->api->sendMessage([
					'text' => $text,
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				if(!empty($row[0][4]))
				{
					$text='<b>У Вас уже есть сохраненный розыгрыш!</b> Пожалуйста, запустите или удалите его, чтобы создать новый.';
					
					$this->api->sendMessage([
					'text' => $text,
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$text='<b>У Вас уже есть созданный розыгрыш!</b>'.PHP_EOL.'Продолжайте заполнять данные по розыгрышу 👆 или зайдите в меню "Изменить" и внесите нужные данные или удалите розыгрыш и начните создавть заново.';
					
					$this->api->sendMessage([
					'text' => $text,
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				
			}
		}
	}


/////
	public function callback_create_lottery_exit()
	{	
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		$text='Вы вышли в <b>Главное меню</b>';
			
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode($this->keyboards['default_admin']),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
	}



/////
	public function cmd_create_lottery_choosechannel()
	{	
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$chatid=$this->api->chatId;
			$tabserviceadmin='tabserviceadmin';
			$tabchannels='tabchannels';
			
			$query=mysqli_query($con_sql2, 'SELECT channelid,channeltitle,channelusername FROM '.$tabchannels.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
					
			$cnt=$con;
			$maxbuttons=1;
			$ceil=ceil($cnt/$maxbuttons);
			
			
			
			$include=''.dirname(__FILE__).'/include'.$chatid.'.php';
			
			if(file_exists($include)==FALSE)
			{
				touch($include);
				
				$insert='<?php
			
				class TelegramBotfunc{';
				file_put_contents($include, $insert . PHP_EOL,FILE_APPEND);
				
			}
			else
			{
				$getinclude=file($include);
				unset($getinclude[$this->cmd_array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			
			
			
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					
					$channelusername=$row[$u][2];
					$channeltitle=$row[$u][1];
					
					$channelid=$row[$u][0];
					$chanid=str_replace('-', '', $channelid);
					
					$buttext=''.$channeltitle.' (@'.$channelusername.')';
					
					$tabservicelottery='tabservicelottery';
					
					$put[]=['text' => ''.$buttext.'', 'callback_data' => 'create_lottery_choosechannel_'.$chanid.''];
					
					if(preg_match('/callback_create_lottery_choosechannel_'.$chanid.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_create_lottery_choosechannel_'.$chanid.'()
						{
							include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
							
							$bot = new DataBot();
							$bot->api->getWebhookUpdate();
							
							
							$con_sql2=$bot->cmd_sql();
							
							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservicelottery.' LIMIT 1&#039;)==FALSE)
							{
								mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabservicelottery.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,channelid VARCHAR(50) DEFAULT "0",lotteryname VARCHAR(500) DEFAULT "0",messid VARCHAR(35) DEFAULT "0",startdate VARCHAR(20) DEFAULT "0",enddate VARCHAR(20) DEFAULT "0",topplaces VARCHAR(5) DEFAULT "0",parrefer VARCHAR(10) DEFAULT "0",pardeposit VARCHAR(10) DEFAULT "0",pardata VARCHAR(50) DEFAULT "0",parpublic VARCHAR(5) DEFAULT "0",fakeplaces VARCHAR(4000) DEFAULT "0",photos VARCHAR(500) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;);
								usleep(250000);
							}
							else
							{
								mysqli_query($con_sql2, &#039;TRUNCATE TABLE '.$tabservicelottery.'&#039;);
								usleep(250000);
							}
							
							
							mysqli_query($con_sql2, &#039;INSERT INTO '.$tabservicelottery.' (channelid) VALUES ("'.$channelid.'")&#039;);
							usleep(250000);
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							$merge=$bot->cmd_create_lottery_choosegroup();
							usleep(250000);
							
							if (array_filter($merge) !== [])
							{
								
								$merge[] = [[&#039;text&#039; => &#039;Изменить канал&#039;, &#039;callback_data&#039; => &#039;create_lottery_channel_edit&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;create_lottery_exit&#039;]];
								
								$text=&#039;Вы выбрали канал <i>'.$buttext.'</i> для проведения розыгрыша.'.PHP_EOL.''.PHP_EOL.'<b>Выберите группу розыгрыша</b>👇'.PHP_EOL.'&#039;.$bot->pre.&#039;&#039;;
						
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
							
								/* $bot->api->sendMessage([
								&#039;text&#039; => $text,
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
								//&#039;disable_notification&#039; => TRUE,
								//&#039;disable_web_page_preview&#039; => TRUE,
								&#039;parse_mode&#039;=> "HTML"
								]); */
					
							}
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						usleep(250000);
					}
					
					$u++;	
				}
					
				$merge[]=$put;
				unset($put);
				
			}
			
			$insert='}';
			file_put_contents($include, $insert,FILE_APPEND);
			
			return $merge;

		}
	}	




/////
	public function callback_create_lottery_channel_edit()
	{
		
		$text='<b>Выбери канал для проведения розыгрыша</b>👇';
		
		$merge=$this->cmd_create_lottery_choosechannel();
		
		usleep(250000);
		
		if (array_filter($merge) !== [])
		{
			$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
			
			$this->callbackAnswer($text, $merge);
		}
	}



/////
	public function cmd_create_lottery_choosegroup()
	{	
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$chatid=$this->api->chatId;
			$tabserviceadmin='tabserviceadmin';
			$tabgroups='tabgroups';
			
			$query=mysqli_query($con_sql2, 'SELECT channelid,channeltitle,channelusername FROM '.$tabgroups.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
					
			$cnt=$con;
			$maxbuttons=1;
			$ceil=ceil($cnt/$maxbuttons);
			
			
			
			$include=''.dirname(__FILE__).'/include'.$chatid.'.php';
			
			if(file_exists($include)==FALSE)
			{
				touch($include);
				
				$insert='<?php
			
				class TelegramBotfunc{';
				file_put_contents($include, $insert . PHP_EOL,FILE_APPEND);
				
			}
			else
			{
				$getinclude=file($include);
				unset($getinclude[$this->cmd_array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			
			
			
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					
					$channelusername=$row[$u][2];
					$channeltitle=$row[$u][1];
					
					$channelid=$row[$u][0];
					$chanid=str_replace('-', '', $channelid);
					
					$buttext=''.$channeltitle.' (@'.$channelusername.')';
					
					$tabservicelottery='tabservicelottery';
					
					$put[]=['text' => ''.$buttext.'', 'callback_data' => 'create_lottery_choosegroup_'.$chanid.''];
					
					
					if(preg_match('/callback_create_lottery_choosegroup_'.$chanid.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_create_lottery_choosegroup_'.$chanid.'()
						{
							include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
							
							$bot = new DataBot();
							$bot->api->getWebhookUpdate();
							
							
							$con_sql2=$bot->cmd_sql();
							
							$query=mysqli_query($con_sql2, &#039;SELECT channelid FROM '.$tabservicelottery.'&#039;);
							$con=mysqli_num_rows($query);
					
							$row=[];
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								$row[$i]=mysqli_fetch_row($query);
							}
							
							$mainchannel=$row[0][0];
							
							if(preg_match(&#039;/'.$channelid.'/&#039;, $row[0][0])==FALSE)
							{
								mysqli_query($con_sql2, &#039;UPDATE '.$tabservicelottery.' SET channelid = REPLACE(channelid, "&#039;.$row[0][0].&#039;", "&#039;.$mainchannel.&#039;,'.$channelid.'")&#039;);
								usleep(250000);
							}
					

							if($bot->cmd_if_exists(&#039;'.$tabserviceadmin.'&#039;)==false)
							{
								mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;);
								usleep(250000);
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryname")&#039;);
								usleep(250000);
							}
							else
							{
								mysqli_query($con_sql2, &#039;TRUNCATE TABLE '.$tabserviceadmin.'&#039;);
								usleep(250000);
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryname")&#039;);
								usleep(250000);
							}
							
							$merge=[];
							$merge[] = [[&#039;text&#039; => &#039;Изменить группу&#039;, &#039;callback_data&#039; => &#039;create_lottery_group_edit&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;create_lottery_exit&#039;]];
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							$text=&#039;Вы выбрали группу <i>'.$buttext.'</i>.'.PHP_EOL.''.PHP_EOL.'<b>Введите название розыгрыша</b>👇'.PHP_EOL.'&#039;.$bot->pre.&#039;&#039;;
						
							$bot->api->editMessageText([
							&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
							&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
							&#039;text&#039; => $text,
							&#039;parse_mode&#039; => "HTML",
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
							]);
						
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						usleep(250000);
					}
					
					$u++;	
				}
					
				$merge[]=$put;
				unset($put);
				
			}
			
			$insert='}';
			file_put_contents($include, $insert,FILE_APPEND);
			
			return $merge;

		}
	}	
	


/////
	public function callback_create_lottery_group_edit()
	{
		
		$text='<b>Выбери группу розыгрыша</b>👇';
		
		$merge=$this->cmd_create_lottery_choosegroup();
		
		usleep(250000);
		
		if (array_filter($merge) !== [])
		{
			$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
			
			$this->callbackAnswer($text, $merge);
		}
	}
	
	
/////
	public function cmd_create_lottery_name()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tabserviceadmin='tabserviceadmin';
			
			$textmessage=$this->cmd_converttext();
			
			
			
			if(strlen($textmessage)>500)
			{
				$merge=[];
				$merge[] = [['text' => 'Изменить канал', 'callback_data' => 'create_lottery_channel_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
							
				$text='Вы ввели слишком длинное название, максимальная длина 500 символов.'.PHP_EOL.''.PHP_EOL.'<b>Введите название розыгрыша</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
			
			
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				
				mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET lotteryname = REPLACE(lotteryname, "'.$row[0][2].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
				//mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET lotteryname = REPLACE(lotteryname, "'.$row[0][2].'", "'.html_entity_decode($textmessage, ENT_QUOTES).'") WHERE id="'.$row[0][0].'"');
				//mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET lotteryname = REPLACE(lotteryname, "'.$row[0][2].'", "'.base64_encode($textmessage).'") WHERE id="'.$row[0][0].'"');
	
				usleep(250000);
				
			
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytext")');
				usleep(250000);
				
				
				$merge=[];
				$merge[] = [['text' => 'Изменить название', 'callback_data' => 'create_lottery_name_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
				
				$tabadminchange='tabadminchange';
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
				{
					$tabadminchange='tabadminchange';
					
					
					
					$text='Вы указали название розыгрыша '.$textmessage.''.PHP_EOL.''.PHP_EOL.'<b>Введите текст розыгрыша, который отобразится в канале</b>👇';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$text='Вы указали название розыгрыша '.$textmessage.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
		}
	}
	

/////
	public function callback_create_lottery_name_edit()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryname")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryname")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => 'Изменить канал', 'callback_data' => 'create_lottery_channel_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		
		$text='<b>Введите название розыгрыша</b>👇';
		
		$this->callbackAnswer($text, $merge);
		
	}





/////
	public function cmd_create_lottery_text()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tabserviceadmin='tabserviceadmin';
			$tabresults='tabresults';
					
			$textmessage=$this->cmd_converttext();
			
			$messageid=$this->api->messageid;
			
			if(strlen($textmessage)>4096)
			{
				$merge=[];
				$merge[] = [['text' => 'Изменить название', 'callback_data' => 'create_lottery_name_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
							
				$text='Вы ввели слишком длинный текст, максимальная длина 4096 символов.'.PHP_EOL.''.PHP_EOL.'<b>Введите текст розыгрыша, который отобразится в канале</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/lotterytext.txt', $textmessage);
				usleep(250000);
				$tabadminchange='tabadminchange';
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
					usleep(250000);
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryenddate")');
					usleep(250000);
				
					
					$merge=[];
					$merge[] = [['text' => 'Изменить текст', 'callback_data' => 'create_lottery_text_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
				
	
					$text='Вы прислали текст розыгрыша:'.PHP_EOL.''.PHP_EOL.' '.$textmessage.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>Введите дату окончания розыгрыша в формате дд.мм.гггг чч:мм</b>👇'.PHP_EOL.'';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$text='Вы прислали текст розыгрыша:'.PHP_EOL.''.PHP_EOL.' '.$textmessage.''.PHP_EOL.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
		}
	}


/////
	public function callback_create_lottery_text_edit()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytext")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytext")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => 'Изменить название', 'callback_data' => 'create_lottery_name_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		
		$text='<b>Введите текст розыгрыша, который отобразится в канале</b>👇';
		
		$this->callbackAnswer($text, $merge);
		
	}




/////
	public function cmd_create_lottery_enddate()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tabserviceadmin='tabserviceadmin';
			
			$textmessage=$this->api->textmessage;
			
			if($this->cmd_if_exists($tablottery)==false)
			{
				if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.[0-9]{4} ([01]?[0-9]|2[0-3])(:)[0-5][0-9]$/", $textmessage)==FALSE)
				{
					$merge=[];
					$merge[] = [['text' => 'Изменить текст', 'callback_data' => 'create_lottery_text_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
								
					$text='Вы ввели дату или время в неправильном формате.'.PHP_EOL.''.PHP_EOL.'<b>Введите дату окончания розыгрыша в формате дд.мм.гггг чч:мм</b>👇';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					date_default_timezone_set('Europe/Kiev');
					$origin = new DateTime(date("d.m.Y G:i"));
					$target = new DateTime($textmessage);
					$interval = $origin->diff($target);
				
					$future=$interval->format('%R');
				
					if($future=="-")
					{
						
						$merge=[];
						$merge[] = [['text' => 'Изменить текст', 'callback_data' => 'create_lottery_text_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
									
						$text='Вы ввели дату в прошлом.'.PHP_EOL.''.PHP_EOL.'<b>Введите дату окончания розыгрыша в <i>будущем</i> в формате дд.мм.гггг чч:мм</b>👇';
						
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);	
					}
					elseif($future=="+")
					{
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						
						//date_default_timezone_set('Europe/Kiev');
						//$textmessage = new DateTime($textmessage);
						
						mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET enddate = REPLACE(enddate, "'.$row[0][5].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
						usleep(250000);
						
						
						$tabadminchange='tabadminchange';
					
						if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
						{
							if($this->cmd_if_exists($tabserviceadmin)==false)
							{
								mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
								usleep(250000);
								mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytopplaces")');
								usleep(250000);
							}
							else
							{
								mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
								usleep(250000);
								mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytopplaces")');
								usleep(250000);
							}
							
							$merge=[];
							$merge[] = [['text' => 'Изменить дату окончания', 'callback_data' => 'create_lottery_enddate_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
							
							$text='Вы указали дату окончания розыгрыша <b>'.$textmessage.'</b>'.PHP_EOL.''.PHP_EOL.'<b>Введите количество призовых мест розыгрыша</b>👇';
						
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}
						else
						{
							$text='Вы указали дату окончания розыгрыша <b>'.$textmessage.'</b>';
							
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						}	
					}
				}
			}
			else
			{
				if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.[0-9]{4} ([01]?[0-9]|2[0-3])(:)[0-5][0-9]$/", $textmessage)==FALSE)
				{
					$text='Вы ввели дату или время в неправильном формате.'.PHP_EOL.''.PHP_EOL.'<b>Введите дату окончания розыгрыша в формате дд.мм.гггг чч:мм</b>👇';
					
					$this->api->sendMessage([
					'text' => $text,
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					date_default_timezone_set('Europe/Kiev');
					$origin = new DateTime(date("d.m.Y G:i"));
					$target = new DateTime($textmessage);
					$interval = $origin->diff($target);
				
					$future=$interval->format('%R');
				
					if($future=="-")
					{
						$text='Вы ввели дату в прошлом.'.PHP_EOL.''.PHP_EOL.'<b>Введите дату окончания розыгрыша в <i>будущем</i> в формате дд.мм.гггг чч:мм</b>👇';
						
						$this->api->sendMessage([
						'text' => $text,
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);	
					}
					elseif($future=="+")
					{
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						
						//date_default_timezone_set('Europe/Kiev');
						//$textmessage = new DateTime($textmessage);
						
						mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET enddate = REPLACE(enddate, "'.$row[0][5].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
						usleep(250000);
						

						$text='Вы указали дату окончания розыгрыша <b>'.$textmessage.'</b>';
						
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						
					}
				}
			}
		}	
	}


/////
	public function callback_create_lottery_enddate_edit()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryenddate")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryenddate")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => 'Изменить текст', 'callback_data' => 'create_lottery_text_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		
		$text='<b>Введите дату окончания розыгрыша в формате дд.мм.гггг чч:мм</b>👇';
		
		$this->callbackAnswer($text, $merge);
		
	}




/////
	public function cmd_create_lottery_topplaces()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
	
			$tabserviceadmin='tabserviceadmin';
			
			$textmessage=$this->api->textmessage;
			
			if(preg_match('/\d{1,5}/', $textmessage)==FALSE)
			{
				$merge=[];
				$merge[] = [['text' => 'Изменить дату окончания', 'callback_data' => 'create_lottery_enddate_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
							
				$text='Допускаются только числа.'.PHP_EOL.''.PHP_EOL.'<b>Введите количество призовых мест розыгрыша</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			elseif(strlen($textmessage)>3)
			{
				$merge=[];
				$merge[] = [['text' => 'Изменить дату окончания', 'callback_data' => 'create_lottery_enddate_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
							
				$text='Допускаеся максимум пятизначное число '.PHP_EOL.''.PHP_EOL.'<b>Введите количество призовых мест розыгрыша</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
							
				mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET topplaces = REPLACE(topplaces, "'.$row[0][6].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
				usleep(250000);
				
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
				}
				
				$tabadminchange='tabadminchange';
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
				{
				
					$text='Вы указали количество призовых мест - '.$textmessage.''.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
				
					$merge=$this->cmd_create_lottery_chooseparametrs_choose();
					usleep(250000);
					
					if(array_filter($merge)!==[])
					{
						$merge[] = [['text' => 'Изменить количество призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
						
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
				else
				{
					$text='Вы указали количество призовых мест - '.$textmessage.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			
			}
		}
		
	}


/////
	public function callback_create_lottery_topplaces_edit()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytopplaces")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytopplaces")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => 'Изменить дату окончания', 'callback_data' => 'create_lottery_enddate_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		
		$text='<b>Введите количество призовых мест розыгрыша</b>👇';
		
		$this->callbackAnswer($text, $merge);
		
	}





////////////PARAMETRS////////////
/////
	public function cmd_create_lottery_chooseparametrs()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tabadminchange=tabadminchange;
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
			{
				$merge=$this->cmd_create_lottery_chooseparametrs_choose();
				usleep(250000);
				
				if(array_filter($merge)!==[])
				{
					$merge[] = [['text' => 'Изменить количество призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
					
					$text='<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
		}
		
	}
	
/////
	public function cmd_create_lottery_chooseparametrs_choose()
	{	
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			
			$tabserviceadmin='tabserviceadmin';
			
			$table=$this->lotteryparametrs;
	
			$cnt=count($table);
			
			
			
			$maxbuttons=1;
			$ceil=ceil($cnt/$maxbuttons);
			
	
			$include=''.dirname(__FILE__).'/include'.$this->api->chatId.'.php';
			
			if(file_exists($include)==FALSE)
			{
				touch($include);
				
				$insert='<?php
			
				class TelegramBotfunc{';
				file_put_contents($include, $insert . PHP_EOL,FILE_APPEND);
				
			}
			else
			{
				$getinclude=file($include);
				unset($getinclude[$this->cmd_array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					if(isset($table[$u]))
					{
						
						$buttext=''.$table[$u].'';
						
		
						$put[]=['text' => ''.$buttext.'', 'callback_data' => 'create_lottery_chooseparametrs_'.$u.''];
						
						if(preg_match('/callback_create_lottery_chooseparametrs_'.$u.'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_create_lottery_chooseparametrs_'.$u.'()
							{
								include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
								
								$bot = new DataBot();
								$bot->api->getWebhookUpdate();
								
								$buttext="'.$buttext.'";
								
								$con_sql2=$bot->cmd_sql();
								
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM '.$tabservicelottery.'&#039;);
								usleep(250000);
								$con=mysqli_num_rows($query);
								
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
				
								if($buttext=="Реферальная программа")
								{
		
									if($bot->cmd_if_exists(&#039;'.$tabserviceadmin.'&#039;)==false)
									{
										mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;);
										usleep(250000);
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("setparametrsparrefer")&#039;);
										usleep(250000);
									}
									else
									{
										mysqli_query($con_sql2, &#039;TRUNCATE TABLE '.$tabserviceadmin.'&#039;);
										usleep(250000);
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("setparametrsparrefer")&#039;);
										usleep(250000);
									}
									
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;create_lottery_chooseparametrs_edit&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;create_lottery_exit&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
								
									$text=&#039;Вы выбрали параметр <i>&#039;.$buttext.&#039;</i>'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите количество приведенных друзей, за которое будет выдаваться билет</b>👇'.PHP_EOL.'&#039;.$bot->pre.&#039;&#039;;
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									&#039;parse_mode&#039; => "HTML"
									]);	
								}
								
								
								if($buttext=="За депозиты")
								{
									if($bot->cmd_if_exists(&#039;'.$tabserviceadmin.'&#039;)==false)
									{
										mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;);
										usleep(250000);
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("setparametrspardeposit")&#039;);
										usleep(250000);
									}
									else
									{
										mysqli_query($con_sql2, &#039;TRUNCATE TABLE '.$tabserviceadmin.'&#039;);
										usleep(250000);
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("setparametrspardeposit")&#039;);
										usleep(250000);
									}
									
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;create_lottery_chooseparametrs_edit&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;create_lottery_exit&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
								
									$text=&#039;Вы выбрали параметр <i>&#039;.$buttext.&#039;</i>'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите за какую сумму депозита будет выдаваться билет</b>👇'.PHP_EOL.'&#039;.$bot->pre.&#039;&#039;;
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									&#039;parse_mode&#039; => "HTML"
									]);
								}
								
								
								if($buttext=="За регистрационные данные")
								{
									
									$merge=$bot->cmd_create_lottery_dataparams_select();
									usleep(250000);
									
									$con_sql2=$bot->cmd_sql();
									
									$query=mysqli_query($con_sql2, &#039;SELECT * FROM '.$tabservicelottery.'&#039;);
									usleep(250000);
									$con=mysqli_num_rows($query);
									
									for($i=0;$i<$con;$i++)
									{
										mysqli_data_seek($query, $i);
										$row[$i]=mysqli_fetch_row($query);
									}
					
									if($row[0][9]!="0")
									{
										$merge[] = [[&#039;text&#039; => &#039;🔀Сбросить&#039;, &#039;callback_data&#039; => &#039;create_lottery_dataparams_reset&#039;]];
									}
									
	
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;create_lottery_dataparams_back&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;create_lottery_exit&#039;]];
									
									$text=&#039;<b>Выберите, какие регистрационные данные необходимо заполнить, чтобы получить билет</b>👇'.PHP_EOL.'&#039;.$bot->pre.&#039;&#039;;
									
		
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
								
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									&#039;parse_mode&#039; => "HTML"
									]);
								}
								
								
								if($buttext=="За публикацию")
								{
									if($bot->cmd_if_exists(&#039;'.$tabserviceadmin.'&#039;)==false)
									{
										mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;);
										usleep(250000);
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("setparametrsparpublic")&#039;);
										usleep(250000);
									}
									else
									{
										mysqli_query($con_sql2, &#039;TRUNCATE TABLE '.$tabserviceadmin.'&#039;);
										usleep(250000);
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceadmin.' (info) VALUES ("setparametrsparpublic")&#039;);
										usleep(250000);
									}
									
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;create_lottery_chooseparametrs_edit&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;create_lottery_exit&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
								
									$text=&#039;Вы выбрали параметр <i>&#039;.$buttext.&#039;</i>'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите количество публикаций, за которое будет выдаваться билет</b>👇'.PHP_EOL.'&#039;.$bot->pre.&#039;&#039;;
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									&#039;parse_mode&#039; => "HTML"
									]);
								}
		
							}';
							
							file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						}
					}
					
					$u++;	
				}
					
				$merge[]=$put;
				unset($put);
				
			}
			
			$insert='}';
			file_put_contents($include, $insert,FILE_APPEND);
			
			return $merge;
		}

	}



/////
	public function cmd_create_lottery_dataparams_select()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			
			$tabserviceadmin='tabserviceadmin';
			
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
				
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$pardatacurrent=$row[0][9];
			
	
			$table=$this->dataparametrs;
			
	
			$cnt=count($table);
			$maxbuttons=1;
			$ceil=ceil($cnt/$maxbuttons);
			
			
	
			$include=''.dirname(__FILE__).'/include'.$this->api->chatId.'.php';
			
			if(file_exists($include)==FALSE)
			{
				touch($include);
				
				$insert='<?php
			
				class TelegramBotfunc{';
				file_put_contents($include, $insert . PHP_EOL,FILE_APPEND);
				
			}
			else
			{
				$getinclude=file($include);
				unset($getinclude[$this->cmd_array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					if(preg_match('/'.$table[$u].'/', $pardatacurrent)==FALSE)
					{
				
						$buttext=''.$table[$u].'';
						
						$put[]=['text' => ''.$buttext.'', 'callback_data' => 'cre_lot_chopar_'.$u.''];
						
						if(preg_match('/callback_cre_lot_chopar_'.$u.'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_cre_lot_chopar_'.$u.'()
							{
								include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
								
								$bot = new DataBot();
								$bot->api->getWebhookUpdate();
								
														
								$con_sql2=$bot->cmd_sql();
								
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM '.$tabservicelottery.'&#039;);
								usleep(250000);
								$con=mysqli_num_rows($query);
								
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
				
								$paramsdata=$row[0][9];
								
								if($paramsdata=="0")
								{
									$paramsdatanew=&#039;'.$table[$u].'&#039;;
								}
								else
								{
									$paramsdatanew=$paramsdata . &#039;,'.$table[$u].'&#039;;
								}
								
								//$paramsdatanew1=substr($paramsdatanew, 0, -1);
								
								mysqli_query($con_sql2, &#039;UPDATE '.$tabservicelottery.' SET pardata = REPLACE(pardata, "&#039;.$row[0][9].&#039;", "&#039;.$paramsdatanew.&#039;") WHERE id="&#039;.$row[0][0].&#039;"&#039;);
								usleep(250000);
						
								$merge=$bot->cmd_create_lottery_dataparams_select();
								usleep(250000);
								
								$merge[] = [[&#039;text&#039; => &#039;🔀Сбросить&#039;, &#039;callback_data&#039; => &#039;create_lottery_dataparams_reset&#039;]];								
								$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;create_lottery_dataparams_back&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;create_lottery_exit&#039;]];
									
								//$textall=substr($paramsdatanew, 0, -2);
								$textall=$paramsdatanew;
								
								$text=&#039;Вы выбрали следующие регистрационные данные - <b>&#039;.$textall.&#039;</b>.'.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие еще регистрационные данные необходимо заполнить, чтобы получить билет</b>👇'.PHP_EOL.'&#039;.$bot->pre.&#039;&#039;;
									
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								&#039;parse_mode&#039; => "HTML"
								]);
				
							}';
								
							file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						}
					}
					
					$u++;	
				}
					
				$merge[]=$put;
				unset($put);
				
			}
			
			$insert='}';
			file_put_contents($include, $insert,FILE_APPEND);
			
			return $merge;
		}
	}
	


/////
	public function callback_create_lottery_dataparams_reset()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		$table=$this->lotteryparametrs;

		$cnt=count($table);
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}

		
		mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET pardata = REPLACE(pardata, "'.$row[0][9].'", "0") WHERE id="'.$row[0][0].'"');
		usleep(250000);
		
		$merge=$this->cmd_create_lottery_dataparams_select();
		usleep(250000);
		

		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'create_lottery_dataparams_back'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		$text='<i>Регистрационные данные сброшены!</i>'.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие регистрационные данные необходимо заполнить, чтобы получить билет</b>👇';

		$this->api->editMessageText([
		'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
		'message_id' => $this->api->body['callback_query']['message']['message_id'],
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		'parse_mode' => "HTML"
		]);
		
		
	}




	
/////
	public function callback_create_lottery_dataparams_back()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		$table=$this->lotteryparametrs;

		$cnt=count($table);
		
		$query=mysqli_query($con_sql2, 'SELECT parrefer,pardeposit,pardata,parpublic FROM '.$tabservicelottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}


		$count=count($row[0]);
		
		$textall="";
		
		for($i=0;$i<$count;$i++)
		{
			if($row[0][$i]!="0")
			{
				
				$tabtext=''.$table[$i].' ('.$row[0][$i].')';
				
				if($i==0)
				{
					$textall=$tabtext;	
				}
				else
				{
					$textall=$textall . ', '.$tabtext.'';
				}
				
			}
		}
		
		
		
		
		$merge=$this->cmd_create_lottery_chooseparametrs_choose();
		

		if($textall!="")
		{
			$text='Вы выбрали следующие параметры - <b>'.$textall.'</b>.'.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие еще дополнительные параметры будут присутствовать в розыгрыше</b>👇';
			
			$merge[] = [['text' => 'Изменить кол-во призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '🔀Сбросить параметры', 'callback_data' => 'create_lottery_allparams_reset']];
			$merge[] = [["text" => "⤵️Применить параметры", "callback_data" => "create_lottery_ready_chooseparametrs"], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		}
		else
		{
			
			$text='<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
			$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		}
		
		
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
	

		$this->api->editMessageText([
		'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
		'message_id' => $this->api->body['callback_query']['message']['message_id'],
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		'parse_mode' => "HTML"
		]);
		
		
	}


/////
	public function callback_create_lottery_chooseparametrs_edit()
	{
		
		$merge=$this->cmd_create_lottery_chooseparametrs_choose();
	
		
		if(array_filter($merge)!==[])
		{
			
			$merge[] = [["text" => "⤵️Применить параметры", "callback_data" => "create_lottery_ready_chooseparametrs"], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$text='<b>Выберите, какие дополнительные параметры Вы хотите изменить</b>👇';
			
			$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			'parse_mode' => "HTML"
			]);
		}
		
	}


/////
	public function cmd_create_lottery_setparametrsparrefer()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
	
			$textmessage=$this->api->textmessage;
			
			if(preg_match('/\D/', $textmessage))
			{
	
	
				$text='Допускаются только числа.'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите количество приведенных друзей, за которое будет выдаваться билет</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			elseif(strlen($textmessage)>2)
			{
							
				$text='Допускаеся максимум двухзначное число '.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите количество приведенных друзей, за которое будет выдаваться билет</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET parrefer = REPLACE(parrefer, "'.$row[0][7].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
				usleep(250000);
				
				$table=$this->lotteryparametrs;
		
				$cnt=count($table);
				
				$query=mysqli_query($con_sql2, 'SELECT parrefer,pardeposit,pardata,parpublic FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
					
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
		
		
				$count=count($row[0]);
				
				$textall="";
				
				for($i=0;$i<$count;$i++)
				{
					if($row[0][$i]!="0")
					{
						
						if($i==($count-2))
						{
							$row[0][$i]=substr($row[0][$i], 0, -2);
							$tabtext=''.$table[$i].' ('.$row[0][$i].')';
							
						}
						else
						{
							$tabtext=''.$table[$i].' ('.$row[0][$i].')';
						}
						
						if($i==($count-1))
						{
							$textall=$textall . ''.$tabtext.', ';
						}
						else
						{
							$textall=$textall . ''.$tabtext.', ';
						}
						
						
					}
				}
				
	
				$merge=$this->cmd_create_lottery_chooseparametrs_choose();
				usleep(250000);
				
				if($textall!="")
				{
					$textall=substr($textall, 0, -2);
					$text='Вы выбрали следующие параметры - <b>'.$textall.'</b>.'.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие еще дополнительные параметры будут присутствовать в розыгрыше</b>👇';
					
					$merge[] = [['text' => 'Изменить кол-во призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '🔀Сбросить параметры', 'callback_data' => 'create_lottery_allparams_reset']];
					$merge[] = [["text" => "⤵️Применить параметры", "callback_data" => "create_lottery_ready_chooseparametrs"], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
					
				}
				else
				{
					$text='<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
					$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
				}
				
	
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
	
			}
		}
		
	}


/////
	public function cmd_create_lottery_setparametrspardeposit()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			
			$textmessage=$this->api->textmessage;
			
			if(preg_match('/\D/', $textmessage))
			{
	
				$text='Допускаются только числа.'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите за какую сумму депозита будет выдаваться билет</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			elseif(strlen($textmessage)>5)
			{
				$text='Допускаеся максимум 5тизначное число '.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите за какую сумму депозита будет выдаваться билет</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET pardeposit = REPLACE(pardeposit, "'.$row[0][8].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
				usleep(250000);
				
				$table=$this->lotteryparametrs;
		
				$cnt=count($table);
				
				$query=mysqli_query($con_sql2, 'SELECT parrefer,pardeposit,pardata,parpublic FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
					
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
		
		
				$count=count($row[0]);
				
				$textall="";
				
				for($i=0;$i<$count;$i++)
				{
					if($row[0][$i]!="0")
					{
						
						if($i==($count-2))
						{
							$row[0][$i]=substr($row[0][$i], 0, -2);
							$tabtext=''.$table[$i].' ('.$row[0][$i].')';
							
						}
						else
						{
							$tabtext=''.$table[$i].' ('.$row[0][$i].')';
						}
						
						if($i==($count-1))
						{
							$textall=$textall . ''.$tabtext.', ';
						}
						else
						{
							$textall=$textall . ''.$tabtext.', ';
						}
						
						
					}
				}
				
	
				$merge=$this->cmd_create_lottery_chooseparametrs_choose();
				usleep(250000);
				
				if($textall!="")
				{
					$textall=substr($textall, 0, -2);
					$text='Вы выбрали следующие параметры - <b>'.$textall.'</b>.'.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие еще дополнительные параметры будут присутствовать в розыгрыше</b>👇';
					
					$merge[] = [['text' => 'Изменить кол-во призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '🔀Сбросить параметры', 'callback_data' => 'create_lottery_allparams_reset']];
					$merge[] = [["text" => "⤵️Применить параметры", "callback_data" => "create_lottery_ready_chooseparametrs"], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
				}
				else
				{
					$text='<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
					$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
				}
				
	
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		
	}


/////
	public function cmd_create_lottery_setparametrspardata()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			
			$textmessage=$this->api->textmessage;
			
			$dataparametrs=$this->dataparametrs;
			
			$textparamsdata="";
			
			foreach($dataparametrs as $dataparams)
			{
				$textparamsdata=$textparamsdata . ''.$dataparams.',';
			}
			
			$textparamsdata=rtrim($textparamsdata);
			
			
			
			
			if(preg_match('/^(\s{0,}(((\w{1,20},)(\s{0,})){0,})((\w{1,20})(\s{0,})))\Z/u', $textmessage))
			{
				$a=1;
				
				if(preg_match('/,/', $textmessage))
				{
					$textall=explode(',', $textmessage);
					
					
					foreach($textall as $params)
					{
						$params=$this->clean($params);
						
						if(in_array($params, $dataparametrs)==FALSE)
						{
							$a=0;
							break;
						}
					}
					
				}
				else
				{
					$textall=$this->clean($textmessage);
					
					if(in_array($textall, $dataparametrs)==FALSE)
					{
						$a=0;
					}
				}
				
				if($a==0)
				{
					$text='Допускаются только слова <b>'.$textparamsdata.'</b> в любой последовательности через запятую.'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите какие регистрационные данные нужно заполнить, чтобы получить билет</b>👇';
				
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET pardata = REPLACE(pardata, "'.$row[0][9].'", "'.$textmessage.'") WHERE id="'.$row[0][0].'"');
					usleep(250000);
					
					$table=$this->lotteryparametrs;
		
					$cnt=count($table);
					
					$query=mysqli_query($con_sql2, 'SELECT parrefer,pardeposit,pardata,parpublic FROM '.$tabservicelottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
						
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
			
			
					$count=count($row[0]);
					
					$textall="";
					
					for($i=0;$i<$count;$i++)
					{
						if($row[0][$i]!="0")
						{
							
							if($i==($count-2))
							{
								$row[0][$i]=substr($row[0][$i], 0, -2);
								$tabtext=''.$table[$i].' ('.$row[0][$i].')';
								
							}
							else
							{
								$tabtext=''.$table[$i].' ('.$row[0][$i].')';
							}
							
							if($i==($count-1))
							{
								$textall=$textall . ''.$tabtext.', ';
							}
							else
							{
								$textall=$textall . ''.$tabtext.', ';
							}
							
							
						}
					}
					
		
					$merge=$this->cmd_create_lottery_chooseparametrs_choose();
					usleep(250000);
					
					if($textall!="")
					{
						$textall=substr($textall, 0, -2);
						$text='Вы выбрали следующие параметры - <b>'.$textall.'</b>.'.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие еще дополнительные параметры будут присутствовать в розыгрыше</b>👇';
						
						$merge[] = [['text' => 'Изменить кол-во призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '🔀Сбросить параметры', 'callback_data' => 'create_lottery_allparams_reset']];
						$merge[] = [["text" => "⤵️Применить параметры", "callback_data" => "create_lottery_ready_chooseparametrs"], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
					}
					else
					{
						$text='<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
						$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
					}
					
		
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				
		
			}
			else
			{
				$text='Допускаются только слова <b>'.$textparamsdata.'</b> в любой последовательности через запятую.'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите какие регистрационные данные нужно заполнить, чтобы получить билет</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
	
			}
		}
		
	}
	
	
	
	
	
/////
	public function cmd_create_lottery_setparametrsparpublic()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			
			$textmessage=$this->api->textmessage;
			
			if(preg_match('/\D/', $textmessage))
			{
				$text='Допускаются только числа.'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите количество публикаций, за которое будет выдаваться билет</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			elseif(strlen($textmessage)>2)
			{
				$text='Допускаеся максимум двухзначное число '.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, укажите количество публикаций, за которое будет выдаваться билет</b>👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
			
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET parpublic = REPLACE(parpublic, "'.$row[0][10].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
				usleep(250000);
				
				$table=$this->lotteryparametrs;
		
				$cnt=count($table);
				
				$query=mysqli_query($con_sql2, 'SELECT parrefer,pardeposit,pardata,parpublic FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
					
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
		
		
				$count=count($row[0]);
				
				$textall="";
				
				for($i=0;$i<$count;$i++)
				{
					if($row[0][$i]!="0")
					{
						
						if($i==($count-2))
						{
							$row[0][$i]=substr($row[0][$i], 0, -2);
							$tabtext=''.$table[$i].' ('.$row[0][$i].')';
							
						}
						else
						{
							$tabtext=''.$table[$i].' ('.$row[0][$i].')';
						}
						
						if($i==($count-1))
						{
							$textall=$textall . ''.$tabtext.', ';
						}
						else
						{
							$textall=$textall . ''.$tabtext.', ';
						}
						
						
					}
				}
				
	
				$merge=$this->cmd_create_lottery_chooseparametrs_choose();
				usleep(250000);
				
				if($textall!="")
				{
					$textall=substr($textall, 0, -2);
					$text='Вы выбрали следующие параметры - <b>'.$textall.'</b>.'.PHP_EOL.''.PHP_EOL.'<b>Выберите, какие еще дополнительные параметры будут присутствовать в розыгрыше</b>👇';
					
					$merge[] = [['text' => 'Изменить кол-во призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '🔀Сбросить параметры', 'callback_data' => 'create_lottery_allparams_reset']];
					$merge[] = [["text" => "⤵️Применить параметры", "callback_data" => "create_lottery_ready_chooseparametrs"], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
				}
				else
				{
					$text='<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
					$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
				}
				
	
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			
			}
		}
	}


/////
	public function callback_create_lottery_allparams_reset()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		
		mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET parrefer = REPLACE(parrefer, "'.$row[0][7].'", "0") WHERE id="'.$row[0][0].'"');
		usleep(250000);
		
		mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET pardeposit = REPLACE(pardeposit, "'.$row[0][8].'", "0") WHERE id="'.$row[0][0].'"');
		usleep(250000);
		
		mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET pardata = REPLACE(pardata, "'.$row[0][9].'", "0") WHERE id="'.$row[0][0].'"');
		usleep(250000);
		
		mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET parpublic = REPLACE(parpublic, "'.$row[0][10].'", "0") WHERE id="'.$row[0][0].'"');
		usleep(250000);
		
		
		
		$merge=$this->cmd_create_lottery_chooseparametrs_choose();
		$merge[] = [['text' => 'Изменить кол-во призовых мест', 'callback_data' => 'create_lottery_topplaces_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		
		
		$text='<b>Выберите, какие дополнительные параметры будут присутствовать в розыгрыше</b>👇';
		
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
	

		$this->api->editMessageText([
		'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
		'message_id' => $this->api->body['callback_query']['message']['message_id'],
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		'parse_mode' => "HTML"
		]);
		
	}




/////
	public function callback_create_lottery_ready_chooseparametrs()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		$messageid=$this->api->messageid;
		
				
		$table=$this->lotteryparametrs;

		$cnt=count($table);
		
		$query=mysqli_query($con_sql2, 'SELECT parrefer,pardeposit,pardata,parpublic FROM '.$tabservicelottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}


		$count=count($row[0]);
		
		$textall="";
		
		for($i=0;$i<$count;$i++)
		{
			if($row[0][$i]!="0")
			{
				$tabtext=''.$table[$i].' ('.$row[0][$i].')';
				
				if($i==0)
				{
					$textall=$tabtext;
				}
				else
				{
					$textall=$textall . ', '.$tabtext.'';
				}
			}
		}
		
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfakeplaces")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfakeplaces")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => 'Изменить параметры', 'callback_data' => 'create_lottery_chooseparametrs_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$tabadminchange='tabadminchange';
			
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
		{
			$this->cmd_admin_add_photo_ask();
		}
		else
		{
			$text='<b>Вы выбрали следующие параметры розыгрыша - '.$textall.'</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		
	}





/////
	public function cmd_admin_add_photo_ask()
	{
		
		$text='<b>Хотите добавить фото к посту?</b>';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_ask_photo']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
	
/////
	public function callback_admin_lottery_photo_no()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_create_lottery_complete();

	}		
	
	
/////
	public function callback_admin_lottery_photo_yes()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("photo")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("photo")');
			usleep(250000);
		}
		

		$text='<b>Пришлите одну фото (поддерживаются форматы jpg, png, webp, gif)</b>';
			
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_ask_photo']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}



/////
	public function cmd_admin_lottery_photo_make()
	{
		if($this->cmd_isadmin())
		{
			$this->api->sendChatAction([
			'action'=> 'upload_photo'
			]);
			
			if($this->api->getFile($this->api->body['message']['photo'])==FALSE)
			{
				$this->api->sendMessage([
				'text' => "Что-то пошло не так...",
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
			$filesdir1=''.dirname(__FILE__).'/filestemp/';
			
			if($this->api->changePhoto($filesdir1))
			{
				usleep(800000);
			}
			
			$filesdir2=''.dirname(__FILE__).'/photos/';
			$files=glob(''.$filesdir2.'*.*');
			$filename1=''.end($files).'';
			$filename1=preg_replace('/.*\//', '', $filename1);
			$filedir1=str_replace(''.dirname(__FILE__).'', 'https://domain.com/miha2', $filesdir2);
			$photo="$filedir1$filename1";
			
			
			$con_sql2=$this->cmd_sql();
		
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tabserviceadmin='tabserviceadmin';
			
			/* $this->api->sendChatAction([
			'action'=> 'upload_photo'
			]); */
			
						
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(250000);
			
			if($this->cmd_if_exists($tablottery))
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tablottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
					
				$query1='UPDATE '.$tablottery.' SET photos = REPLACE(photos, "'.$row[0][12].'", "'.$photo.'")'; 
				mysqli_query($con_sql2, $query1);
				usleep(250000);
				
				if($this->cmd_if_exists($tabservicelottery))
				{
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
						
					$query1='UPDATE '.$tabservicelottery.' SET photos = REPLACE(photos, "'.$row[0][12].'", "'.$photo.'")'; 
					mysqli_query($con_sql2, $query1);
					usleep(250000);
				}
			}
			else
			{
				if($this->cmd_if_exists($tabservicelottery))
				{
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
						
					$query1='UPDATE '.$tabservicelottery.' SET photos = REPLACE(photos, "'.$row[0][12].'", "'.$photo.'")'; 
					mysqli_query($con_sql2, $query1);
					usleep(250000);
				}
			}
			
			
			$textall="";
			$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
			$textall=$textall . ''.$lotterytext.'';
			
			$text='<a href="'.$photo.'">&#160;</a>';
			$textall=$textall . ''.$text.'';
			
			
			$filesdir1=''.dirname(__FILE__).'/filestemp/';
			$files=glob(''.$filesdir1.'*.*');
			$cnt2=count($files);
			for($o2=0;$o2<$cnt2;$o2++)
			{
				unlink($files[$o2]);
			}
			
			$this->cmd_create_lottery_complete();

		}
	}




/////
	public function cmd_create_lottery_lotteryfakeplaces()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tabresults='tabresults';
			$tabresultsreserve='tabresultsreserve';
			
			$tabserviceadmin='tabserviceadmin';
			$textmessage=$this->api->textmessage;
		
			if(preg_match('/^\s{0,}((\d{1,5}-@)(\w{1,30},)(\s{0,})){0,}((\d{1,5}-@)(\w{1,30}))(\s{0,})\Z/', $textmessage) || preg_match('/\d{1,5}-\d{8,12}/', $textmessage) || $textmessage=="0")
			{
				if(strlen($textmessage)>4000)
				{
					$text='<b>Вы ввели неправильный формат!</b>'.PHP_EOL.''.PHP_EOL.'<b>Введите фейковые призовые места</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
					
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
					usleep(250000);
						
					if($this->cmd_if_exists($tabresults) || $this->cmd_if_exists($tabresultsreserve))
					{
						
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tablottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						if($row[0][11]!="0")
						{
							if(file_exists(''.dirname(__FILE__).'/resultsfake.txt')==FALSE)
							{
								touch(''.dirname(__FILE__).'/resultsfake.txt');
							}
						}
						
						//mysqli_query($con_sql2, 'UPDATE '.$tablottery.' SET fakeplaces = REPLACE(fakeplaces, "'.$row[0][11].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
						//usleep(250000);
						mysqli_query($con_sql2, 'UPDATE '.$tablottery.' SET fakeplaces = REPLACE(fakeplaces, "'.$row[0][11].'", "'.$textmessage.'") WHERE id="'.$row[0][0].'"');
						usleep(250000);
						

						$this->cmd_lottery_change_complete_results();
						
					}
					else
					{

						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						
						mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET fakeplaces = REPLACE(fakeplaces, "'.$row[0][11].'", "'.$textmessage.'") WHERE id="'.$row[0][0].'"');
						usleep(250000);
					
		
						$tabadminchange='tabadminchange';
					
						if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
						{
							$merge = [[["text" => "✅Завершить", "callback_data" => "create_lottery_complete"]], [["text" => "Изменить фейковые призовые места", "callback_data" => "create_lottery_fakeplaces_edit"]], [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']]];
							
							$text='<b>Вы ввели следующие фейковые призовые места:</b>'.PHP_EOL.''.PHP_EOL.''.$textmessage.''.PHP_EOL.''.PHP_EOL.'Вы заполнили всю необходимую информацию. Нажмите кнопку <b>Завершить</b>, чтобы сохранить розыгрыш для дальнейшей публикации его в канале👇';
						
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							
						}
						else
						{
							$text='<b>Вы ввели следующие фейковые призовые места:</b>'.PHP_EOL.''.PHP_EOL.''.$textmessage.'';
								
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							
						}
					}
				}
				
			}
			else
			{
				
				$text='<b>Вы ввели неправильный формат!</b>'.PHP_EOL.''.PHP_EOL.'<b>Введите фейковые призовые места</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
		
	}



/////
	public function callback_create_lottery_fakeplaces_edit()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfakeplaces")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfakeplaces")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => 'Изменить параметры', 'callback_data' => 'create_lottery_chooseparametrs_edit'], ['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
		
		$text='<b>Вы ввели неправильный формат!</b>'.PHP_EOL.''.PHP_EOL.'<b>Введите фейковые призовые места</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
		
		$this->callbackAnswer($text, $merge);
	}


/////
	public function cmd_create_lottery_complete()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		$tabresultsreserve='tabresultsreserve';
		$tabadminchange='tabadminchange';
		$tabserviceadmin='tabserviceadmin';
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);
					
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET startdate = REPLACE(startdate, "'.$row[0][4].'", "'.date('d-m-Y').'") WHERE id="'.$row[0][0].'"');
		usleep(250000);

		$textall="";
		
		$text='<b>Вы выбрали следующие параметры:</b>'.PHP_EOL.''.PHP_EOL.'Название розыгрыша - "'.$row[0][2].'"'.PHP_EOL.'Дата окончания розыгрыша - <b>'.$row[0][5].'</b>'.PHP_EOL.'Количество призовых мест - <b>'.$row[0][6].'</b>'.PHP_EOL.'';
		$textall=$textall . ''.$text.'';
		
		if($row[0][7]!="0")
		{
			$text='Реферальная программа - <b>'.$row[0][7].' чел</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		if($row[0][8]!="0")
		{
			$text='За депозиты - <b>'.$row[0][8].' Евро</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		if($row[0][9]!="0")
		{
			$text='За регистрационные данные - <b>'.$row[0][9].'</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		if($row[0][10]!="0")
		{
			$text='За публикации - <b>'.$row[0][10].'</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		
		
		$text=''.PHP_EOL.''.PHP_EOL.'';
		$textall=$textall . ''.$text.'';
		
		$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
		$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';

		if($row[0][12]!="0")
		{
			$text='<a href="'.$row[0][12].'">&#160;</a>';
			$textall=$textall . ''.$text.'';
		}
		
		$botusername=json_decode($this->api->getMe(), true);
		$botusername=$botusername['result']['username'];
				
		$urllottery='https://t.me/'.$botusername.'?start';
				
		$keyb = [  [['text' => '🤝Зарегистрироваться (0 участников)КНОПКА ДЛЯ ПРИМЕРА', 'url' => $urllottery ]] ];
		
		$this->api->sendMessage([
		'text' => $textall,
		'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
		//'disable_notification' => TRUE,
		////'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabadminchange.' LIMIT 1')==FALSE)
		{
		
			$text='<b>Так будет выглядеть розыгрыш в канале</b>👆👆👆'.PHP_EOL.''.PHP_EOL.'Нажмите на кнопку <b>Запустить розыгрыш</b>, чтобы отправить его в канал!';
		
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
		}
		else
		{
			if($this->cmd_if_exists($tabresultsreserve))
			{
				$text='<b>Так будет выглядеть розыгрыш в канале</b>👆👆👆'.PHP_EOL.''.PHP_EOL.'Если Вы хотите подтвердить изменения, нажмите на кнопку <b>Применить изменения.</b>';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change_results']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				$text='<b>Так будет выглядеть розыгрыш в канале</b>👆👆👆'.PHP_EOL.''.PHP_EOL.'Если Вы хотите подтвердить изменения, нажмите на кнопку <b>Применить изменения.</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}


/////
	public function callback_create_lottery_complete()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		
		$textall="";
		
		$text='<b>Вы выбрали следующие параметры:</b>'.PHP_EOL.''.PHP_EOL.'Название розыгрыша - "'.$row[0][2].'"'.PHP_EOL.'Дата окончания розыгрыша - <b>'.$row[0][5].'</b>'.PHP_EOL.'Количество призовых мест - <b>'.$row[0][6].'</b>'.PHP_EOL.'';
		$textall=$textall . ''.$text.'';
		
		if($row[0][7]!="0")
		{
			$text='Реферальная программа - <b>'.$row[0][7].' чел</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		if($row[0][8]!="0")
		{
			$text='За депозиты - <b>'.$row[0][8].' Евро</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		if($row[0][9]!="0")
		{
			$text='За регистрационные данные - <b>'.$row[0][9].'</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		if($row[0][10]!="0")
		{
			$text='За публикации - <b>'.$row[0][10].'</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
		}
		

		$text=''.PHP_EOL.''.PHP_EOL.'';
		$textall=$textall . ''.$text.'';
		
		$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
		$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
		
		if($row[0][12]!="0")
		{
			$text='<a href="'.$row[0][12].'">&#160;</a>';
			$textall=$textall . ''.$text.'';
		}

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$botusername=json_decode($this->api->getMe(), true);
		$botusername=$botusername['result']['username'];
				
		$urllottery='https://t.me/'.$botusername.'?start';
				
		$keyb = [  [['text' => '🤝Зарегистрироваться (0 участников)КНОПКА ДЛЯ ПРИМЕРА', 'url' => $urllottery ]] ];
		
		$this->api->sendMessage([
		'text' => $textall,
		'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
		//'disable_notification' => TRUE,
		////'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
		$text='<b>Так будет выглядеть розыгрыш в канале</b>👆👆👆'.PHP_EOL.''.PHP_EOL.'Нажмите на кнопку <b>Запустить розыгрыш</b>, чтобы отправить его в канал!';
		
		$this->api->sendMessage([
		'text' => $text,
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}



/////
	public function cmd_create_lottery_see()
	{
		if($this->cmd_isadmin())
		{
			$this->api->sendChatAction([
			'action'=> 'typing'
			]);
			
			
			$con_sql2=$this->cmd_sql();
			
			$tablottery='tablottery';
			$tabservicelottery='tabservicelottery';
			$tablotteryusers='tablotteryusers';
			$tabticketsall='tabticketsall';
			$tabusers='tabusers';
			$tabbanned='tabbanned';
			$tabcasinousers='tabcasinousers';
			
			
			if($this->cmd_if_exists($tablottery))
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tablottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				$textall="";
				
				$text='<b>Информация о действующем розыгрыше</b> "'.$row[0][2].'":'.PHP_EOL.''.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
				
				$text='Название розыгрыша - "'.$row[0][2].'"'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
				$lotteryname=$row[0][2];
				
				$text='Дата начала розыгрыша - <b>'.$row[0][4].'</b>'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
				
				$text='Дата окончания розыгрыша - <b>'.$row[0][5].'</b>'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
				
				$text='Количество призовых мест - <b>'.$row[0][6].'</b>'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
				
				
				if($row[0][7]!="0")
				{
					$text='Реферальная программа - <b>'.$row[0][7].' чел</b>'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
				}
				if($row[0][8]!="0")
				{
					$text='За депозиты - <b>'.$row[0][8].' Евро</b>'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
				}
				if($row[0][9]!="0")
				{
					$text='За регистрационные данные - <b>'.$row[0][9].'</b>'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
				}
				if($row[0][10]!="0")
				{
					$text='За публикации - <b>'.$row[0][10].'</b>'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
				}
				
				$text=''.PHP_EOL.''.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
				
				
				
				
				///
				$quantuserall=0;
	
				if($this->cmd_if_empty($tabusers)==FALSE)
				{
					//$con_sql2=$this->cmd_sql();
					
					$query1=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.'');
					usleep(250000);
					$quantuserall=mysqli_num_rows($query1);
				}
				
				
				///
				$quantuserlot=0;
				
				if($this->cmd_if_empty($tablotteryusers)==FALSE)
				{
					//$con_sql2=$this->cmd_sql();
					
					$query1=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
					usleep(250000);
					$quantuserlot=mysqli_num_rows($query1);
				}
				
				
				///
				$quantusersnotlot=0;
				
				if($this->cmd_if_empty($tabusers)==FALSE)
				{
					//$con_sql2=$this->cmd_sql();
					
					$query1=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.'');
					usleep(250000);
					$con1=mysqli_num_rows($query1);
					
					$b=ceil($con1/2);
					$a=0;
					
					$row1=[];
					for($i1=0;$i1<$con1;$i1++)
					{
						mysqli_data_seek($query1, $i1);
						$row1[$i1]=mysqli_fetch_row($query1);
						
						$userchatid=$row1[$i1][0];
						
						if($this->cmd_sql_searchchatidtable($userchatid, $tablotteryusers)==FALSE)
						{
							$a++;
						}
						
						if($i1==$b)
						{
							$this->api->sendChatAction([
							'action'=> 'typing'
							]);
						}
					}
					
					$quantusersnotlot=$a;
				}
				
			
				///
				$quantuserbanned=0;
	
				if($this->cmd_if_empty($tabbanned)==FALSE)
				{
					//$con_sql2=$this->cmd_sql();
			
					$query1=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabbanned.'');
					usleep(250000);
					
					$quantuserbanned=mysqli_num_rows($query1);
				}
				
				
				///
				$quantusercasino=0;
				
				if($this->cmd_if_empty($tabcasinousers)==FALSE)
				{
					$query1=mysqli_query($con_sql2, 'SELECT casinoid FROM '.$tabcasinousers.'');
					usleep(250000);
					
					if(!empty(mysqli_num_rows($query1)))
					{
						$quantusercasino=mysqli_num_rows($query1);
					}
				}
				/////
				
				
				///
				$quantticketsall=0;
				
				if($this->cmd_if_empty($tabticketsall)==FALSE)
				{
					$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.'');
					usleep(250000);
					
					$quantticketsall=mysqli_num_rows($query1);
				}
				
				
				///
				$quantticketsref=0;
				
				if($this->cmd_if_empty($tabticketsall)==FALSE)
				{
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="refer"'))))
					{	
						$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="refer"');
						usleep(250000);
						$quantticketsref=mysqli_num_rows($query1);
					}
				}
				

				///
				$quantticketsdep=0;
				
				if($this->cmd_if_empty($tabticketsall)==FALSE)
				{
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="deposit"'))))
					{	
						$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="deposit"');
						usleep(250000);
						$quantticketsdep=mysqli_num_rows($query1);
					}
				}
	
				
				///
				$quantticketsprof=0;
				
				if($this->cmd_if_empty($tabticketsall)==FALSE)
				{					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="data_fio"'))))
					{	
						$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="data_fio"');
							usleep(250000);
						$quantticketsprof=mysqli_num_rows($query1);
					}
				}
				
				
				///
				$quantticketsemail=0;
				
				if($this->cmd_if_empty($tabticketsall)==FALSE)
				{
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="data_email"'))))
					{
						$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="data_email"');
						usleep(250000);
						$quantticketsemail=mysqli_num_rows($query1);
					}
				}
	
				
				///
				$quantticketsphone=0;
				
				if($this->cmd_if_empty($tabticketsall)==FALSE)
				{
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="data_phone"'))))
					{	
						$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE status="data_phone"');
						usleep(250000);
						$quantticketsphone=mysqli_num_rows($query1);
					}
				}
				

				$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
				$textall=$textall . ''.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';
				
				if($row[0][12]!="0")
				{
					$text='<a href="'.$row[0][12].'">&#160;</a>';
					$textall=$textall . ''.$text.''.PHP_EOL.''.PHP_EOL.'';
				}
				
				$this->api->sendMessage([
				'text' => $textall,
				//'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				////'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);

				$text='<b>Всего пользователей (кнопка Старт) - '.$quantuserall.' чел.:</b>'.PHP_EOL.''.PHP_EOL.'Участники розыгрыша - <b>'.$quantuserlot.' чел.</b>'.PHP_EOL.'Не участвующие в розыгрыше - <b>'.$quantusersnotlot.' чел.</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<i>Пользователи казино - '.$quantusercasino.' чел.</i>'.PHP_EOL.'<i>Забаненные пользователи - '.$quantuserbanned.' чел.</i>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>Всего активных билетов - '.$quantticketsall.' шт.:</b>'.PHP_EOL.''.PHP_EOL.'Билеты за рефералки - <b>'.$quantticketsref.' шт.</b>'.PHP_EOL.'Билеты за депозиты - <b>'.$quantticketsdep.' шт.</b>'.PHP_EOL.'Билеты за заполненный профиль - <b>'.$quantticketsprof.' шт.</b>'.PHP_EOL.'Билеты за подтвержденную почту - <b>'.$quantticketsemail.' шт.</b>'.PHP_EOL.'Билеты за подтвержденный телефон - <b>'.$quantticketsphone.' шт.</b>'.PHP_EOL.'';
				

				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				////'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->cmd_if_exists($tabservicelottery))
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				if(!empty($row[0][4]))
				{
					$textall="";
					
					$text='<b>Информация о сохраненном розыгрыше</b> "'.$row[0][2].'" для отправки в канал:'.PHP_EOL.''.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
					
					$text='Название розыгрыша - "'.$row[0][2].'"'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
					
					$text='Дата начала розыгрыша - <b>'.$row[0][4].'</b>'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
					
					$text='Дата окончания розыгрыша - <b>'.$row[0][5].'</b>'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
					
					$text='Количество призовых мест - <b>'.$row[0][6].'</b>'.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
					
					
					if($row[0][7]!="0")
					{
						$text='Реферальная программа - <b>'.$row[0][7].' чел</b>'.PHP_EOL.'';
						$textall=$textall . ''.$text.'';
					}
					if($row[0][8]!="0")
					{
						$text='За депозиты - <b>'.$row[0][8].' Евро</b>'.PHP_EOL.'';
						$textall=$textall . ''.$text.'';
					}
					if($row[0][9]!="0")
					{
						$text='За регистрационные данные - <b>'.$row[0][9].'</b>'.PHP_EOL.'';
						$textall=$textall . ''.$text.'';
					}
					if($row[0][10]!="0")
					{
						$text='За публикации - <b>'.$row[0][10].'</b>'.PHP_EOL.'';
						$textall=$textall . ''.$text.'';
					}
					
					$text=''.PHP_EOL.''.PHP_EOL.'';
					$textall=$textall . ''.$text.'';
									
					$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
					$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
					
					if($row[0][12]!="0")
					{
						$text='<a href="'.$row[0][12].'">&#160;</a>';
						$textall=$textall . ''.$text.'';
					}
					
					$this->api->sendMessage([
					'text' => $textall,
					'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					////'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$text='<b>Вы не заполнили необходимые данные для просмотра розыгрыша.</b>'.PHP_EOL.'Продолжайте заполнять данные по розыгрышу 👆 или зайдите в меню "Изменить" и внесите нужные данные или удалите розыгрыш и начните создавть заново.';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='В данный момент <b>нет сохраненного или действующего розыгрыша.</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode($this->keyboards['default_admin']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}



/////
	public function cmd_create_lottery_send()
	{
		if($this->cmd_isadmin())
		{
			
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tabusers='tabusers';
			$tabcasinousers='tabcasinousers';
			$tablotteryusers='tablotteryusers';
			$tabticketsall='tabticketsall';
			$tabadmin='tabadmin';
			$tabserviceadmin='tabserviceadmin';
			$tabadminchange='tabadminchange';
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tablottery.' LIMIT 1')==FALSE)
			{
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicelottery.' LIMIT 1'))
				{
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
						
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					if(!empty($row[0][4]))
					{
					
						$lotteryname=$row[0][2];
						$enddate=$row[0][5];
						
						date_default_timezone_set('Europe/Kiev');
						$origin = new DateTime(date("d.m.Y G:i"));
						$target = new DateTime($enddate);
						$interval = $origin->diff($target);
					
						$future=$interval->format('%R');
					
						if($future=="-")
						{					
							$text='Вы ввели дату в прошлом.'.PHP_EOL.''.PHP_EOL.'<b>Пожалуйста, поменяйте дату окончания розыгрыша на дату в <i>будущем</i> в формате дд.мм.гггг чч:мм</b>👇';
							
							$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);	
						}
						elseif($future=="+")
						{
		
							$textall="";
								
							$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
							$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
							
							if($row[0][12]!="0")
							{
								$text='<a href="'.$row[0][12].'">&#160;</a>';
								$textall=$textall . ''.$text.'';
							}
							
								
							mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET startdate = REPLACE(startdate, "'.$row[0][4].'", "'.date('d-m-Y').'") WHERE id="'.$row[0][0].'"');
							usleep(250000);
							
							$botusername=json_decode($this->api->getMe(), true);
							$botusername=$botusername['result']['username'];
									
							$urllottery='https://t.me/'.$botusername.'?start=lottery';
									
							$keyb = [  [['text' => '🤝Зарегистрироваться (0 участников)', 'url' => $urllottery ]] ];
							
							
							$result=json_decode($this->api->sendMessage([
							'chat_id' => $channelid,
							'text' => $textall,
							'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
							////'disable_notification' => TRUE,
							////'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]), true);
							usleep(250000);
							
							$messageidlottery=$result['result']['message_id'];
							
							
							$this->api->pinChatMessage([
							'chat_id' => $channelid,
							'message_id'=> $messageidlottery
							]);
							
							
							mysqli_query($con_sql2, 'UPDATE '.$tabservicelottery.' SET messid = REPLACE(messid, "'.$row[0][3].'", "'.$messageidlottery.'") WHERE id="'.$row[0][0].'"');
							usleep(250000);
							
							
							if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tablottery.' LIMIT 1')==FALSE)
							{
								mysqli_query($con_sql2, 'CREATE TABLE '.$tablottery.' LIKE '.$tabservicelottery.'');
								usleep(250000);
								
								mysqli_query($con_sql2, 'INSERT INTO '.$tablottery.' (channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos) SELECT channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos FROM '.$tabservicelottery.'');
								usleep(250000);
							}
							else
							{
								mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tablottery.'');
								usleep(250000);
								
								mysqli_query($con_sql2, 'INSERT INTO '.$tablottery.' (channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos) SELECT channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos FROM '.$tabservicelottery.'');
								usleep(250000);
							}
							
							
							mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
							usleep(250000);
							
							mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
							usleep(250000);
							
							mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
							usleep(250000);
							
					
							$result=json_decode($this->api->getChat([
							'chat_id' => $channelid
							]), true);
							
							
							$channelusername=$result['result']['username'];
							
							$text='Вы успешно запустили розыгрыш "'.$lotteryname.'" в канале '.$channelusername.'!';
							
							
							$this->api->sendMessage([
							'text' => $text,
							//'reply_markup' => json_encode($this->keyboards['default_admin']),
							//'disable_notification' => TRUE,
							//'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							usleep(500000);
							
							
							$query8=mysqli_query($con_sql2, 'SELECT enddate FROM '.$tablottery.'');
							usleep(250000);
							$con8=mysqli_num_rows($query8);
							
							for($i8=0;$i8<$con8;$i8++)
							{
								mysqli_data_seek($query8, $i8);
								$row8[$i8]=mysqli_fetch_row($query8);
							}
										
							$enddate=$row8[0][0];
							
							file_put_contents(''.dirname(__FILE__).'/enddate.txt', $enddate);
							
							if($this->id_mainchannel())
							{
								if($this->cmd_if_exists($tabusers))
								{
									
									$lotterylink='https://t.me/'.$channelusername.'/'.$messageidlottery.'';
									
									$query4=mysqli_query($con_sql2, 'SELECT * FROM '.$tabusers.'');
									usleep(250000);
									$con4=mysqli_num_rows($query4);
									
											
									for($i4=0;$i4<$con4;$i4++)
									{
										mysqli_data_seek($query4, $i4);
										$row4[$i4]=mysqli_fetch_row($query4);
										
										$chatiduser=$row4[$i4][1];
										
										$text='В канале начался новый розыгрыш "'.$lotteryname.'"!'.PHP_EOL.''.PHP_EOL.'Чтобы принять участие в розыгрыше, нажмите кнопку <b>Зарегистрироваться</b>👇';
										
	
										$merge=[];
										$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
										
										
										$this->api->sendMessage([
										'chat_id' => $chatiduser,
										'text' => $text,
										'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
									}
								}
							}
							else
							{
								$lotterylink='https://t.me/'.$channelusername.'/'.$messageidlottery.'';
									
								if(preg_match('/,/', $this->testusers))
								{
									$alldata=explode(',', $this->testusers);
									
									foreach($alldata as $data)
									{
										$chatiduser=$data;
										
										$text='В канале начался новый розыгрыш "'.$lotteryname.'"!'.PHP_EOL.''.PHP_EOL.'Чтобы принять участие в розыгрыше, нажмите кнопку <b>Зарегистрироваться</b>👇';
										
										
										$merge=[];
										$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
										
										
										$this->api->sendMessage([
										'chat_id' => $chatiduser,
										'text' => $text,
										'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
										//'disable_notification' => TRUE,
										//'disable_web_page_preview' => TRUE,
										'parse_mode'=> "HTML"
										]);
									}
								}
								else
								{
									$chatiduser=$this->testusers;
										
									$text='В канале начался новый розыгрыш "'.$lotteryname.'"!'.PHP_EOL.''.PHP_EOL.'Чтобы принять участие в розыгрыше, нажмите кнопку <b>Зарегистрироваться</b>👇';
									
								//	$text='В канале начался новый розыгрыш "'.$lotteryname.'"!'.PHP_EOL.''.PHP_EOL.'Посмотреть правила – '.$lotterylink.''.PHP_EOL.''.PHP_EOL.'Чтобы принять участие в розыгрыше, нажмите кнопку <b>Зарегистрироваться</b>👇';
									
									$merge=[];
									$merge[] = [['text' => '🤝Зарегистрироваться', 'callback_data' => 'takeaction_lottery_user']];
									
									
									$this->api->sendMessage([
									'chat_id' => $chatiduser,
									'text' => $text,
									'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
								}
	
								
							}
							
							
							if(file_exists(''.dirname(__FILE__).'/adminlottery.txt'))
							{
								$admincreator=file_get_contents(''.dirname(__FILE__).'/adminlottery.txt');
								usleep(250000);
								$admincreatordata=preg_replace('/, -\d{8,20}/', '', $admincreator);
								unlink(''.dirname(__FILE__).'/adminlottery.txt');
							}
							
							
							
							if(preg_match('/,/', DataBot::ADMINUSERNAMES))
							{
								$alldata=explode(',', DataBot::ADMINUSERNAMES);
							}
							else
							{
								$alldata=[];
								$alldata[]=DataBot::ADMINUSERNAMES;
							}
							
	
							foreach($alldata as $data)
							{							
								$chatidadm=$data;
								
								if(preg_match('/'.$chatidadm.'/', $admincreator)==FALSE)
								{
								
									$textadmin='В канале '.$channelusername.' был <b>запущен новый розыгрыш</b> "'.$lotteryname.'" администратором '.$admincreatordata.'!';
								
									$this->api->sendMessage([
									'chat_id' => $chatidadm,
									'text' => $textadmin,
									'reply_markup' => json_encode($this->keyboards['default_admin']),
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
									usleep(250000);
								}
							}
						}
					}
					else
					{
						$text='<b>Вы не заполнили необходимые данные для запуска розыгрыша.</b>'.PHP_EOL.'Продолжайте заполнять данные по розыгрышу 👆 или зайдите в меню "Изменить" и внесите нужные данные или удалите розыгрыш и начните создавть заново.';
						
						$this->api->sendMessage([
						'text' => $text,
						//'reply_markup' => json_encode($this->keyboards['default_admin']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
				}
				else
				{
					$text='<b>В данный момент нет сохраненных розыгрышей для отправки в канал.</b>';
					
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tablottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
					
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				$lotteryname=$row[0][2];
				
				$result=json_decode($this->api->getChat([
				'chat_id' => $channelid
				]), true);
				

				$channelusername=$result['result']['username'];
				
				$text='В данный момент <b>уже запущен розыгрыш</b> "'.$lotteryname.'" в канале '.$channelusername.'.';
					
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
			}
		}
	}




/////
	public function cmd_change_lottery()
	{
		
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$chatid=$this->api->chatId;
			$channelid=$this->mainchannel();
			$tablottery='tablottery';
			$tabservicelottery='tabservicelottery';
			$tabadminchange='tabadminchange';
			$tabresults='tabresults';
			$tabresultsreserve='tabresultsreserve';
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tablottery.' LIMIT 1')==FALSE )
			{
				if( mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicelottery.' LIMIT 1')==FALSE)
				{
					
					$text='<b>В данный момент нет сохраненных или действующих розыгрышей в канале!</b>';
						
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode($this->keyboards['default_admin']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabadminchange.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					
					$text='<b>Выберите, что Вы хотите изменить</b>👇';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				
				
			}
			else
			{

				if($this->cmd_if_exists($tabresults) || $this->cmd_if_exists($tabresultsreserve))
				{
					$text='<b>Выберите, что Вы хотите изменить</b>👇';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change_results']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
					usleep(250000);
					
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabservicelottery.' LIKE '.$tablottery.'');
					usleep(250000);
		
					mysqli_query($con_sql2, 'INSERT INTO '.$tabservicelottery.' (channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos) SELECT channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos FROM '.$tablottery.'');
					usleep(250000);
						
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabadminchange.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					
					$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
					file_put_contents(''.dirname(__FILE__).'/lotteryreservetext.txt', $lotterytext);
				
					$text='<b>Выберите, что Вы хотите изменить</b>👇';
				
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
		}
	}

	
/////
	public function callback_lottery_change_name()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryname")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryname")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'lottery_change_exit']];
		
		$text='<b>Введите название розыгрыша</b>👇';
		
		$this->callbackAnswer($text, $merge);
	}





/////
	public function callback_lottery_change_text()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytext")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytext")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'lottery_change_exit']];
		
		$text='<b>Введите текст розыгрыша, который отобразится в канале</b>👇';
		
		$this->callbackAnswer($text, $merge);
	}


	
/////
	public function callback_lottery_change_enddate()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryenddate")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryenddate")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'lottery_change_exit']];
		
		$text='<b>Введите дату окончания розыгрыша в формате дд.мм.гггг чч:мм</b>👇';
		
		$this->callbackAnswer($text, $merge);
	}



/////
	public function callback_lottery_change_parametrs()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
			
		$this->cmd_create_lottery_chooseparametrs();
	}



/////
	public function callback_lottery_change_topplaces()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytopplaces")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotterytopplaces")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'lottery_change_exit']];
		
		$text='<b>Введите количество призовых мест розыгрыша</b>👇';
		
		$this->callbackAnswer($text, $merge);
	}	
	
	
	
	
/////
	public function callback_lottery_change_fakeplaces()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		
		$tabserviceadmin='tabserviceadmin';
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfakeplaces")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfakeplaces")');
			usleep(250000);
		}
		
		$merge=[];
		$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'lottery_change_exit']];
		
		$text='<b>Вы ввели неправильный формат!</b>'.PHP_EOL.''.PHP_EOL.'<b>Введите фейковые призовые места</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
		
		$this->callbackAnswer($text, $merge);
	}
	
	
	

/////
	public function callback_lottery_change_delete()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$text='Вы точно <b>хотите удалить</b> розыгрыш?';

		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['delete_lottery_confirm']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}


/////
	public function callback_delete_lottery_no()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$text='Вы <b>отменили удаление</b> розыгрыша!';

		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['delete_lottery_confirm']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
	
/////
	public function callback_delete_lottery_yes()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		$tabticketsall='tabticketsall';
		$tablotteryusers='tablotteryusers';
		$tabadminchange='tabadminchange';
		$tabresults='tabresults';
		$tabresultsreserve='tabresultsreserve';
		$tabserviceadmin='tabserviceadmin';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		if($this->cmd_if_exists($tablottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tablottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$messageidchannel=$row[0][3];
			
			$text='К сожалению, <b>розыгрыш был отменен!</b>';


			$this->api->editMessageText([
				'chat_id' => $this->mainchannel(),
				'message_id' => $messageidchannel,
				'text' => $text,
				'parse_mode' => "HTML",
			]);
			
			$this->api->unpinChatMessage([
				'chat_id' => $this->mainchannel(),
				'message_id'=> $messageidchannel
				]);
			
			
			$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
				
			$row=[];
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$chatidlotteryuser=$row[$i][0];

				$tabrefer='tabrefer'.$chatidlotteryuser.'';

				
			}
			
			if(file_exists(''.dirname(__FILE__).'/lotterytext.txt'))
			{
				unlink(''.dirname(__FILE__).'/lotterytext.txt');
			}
			
			if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
			{
				unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
			}
			
			if(file_exists(''.dirname(__FILE__).'/enddate.txt'))
			{
				unlink(''.dirname(__FILE__).'/enddate.txt');
			}
			
			if(file_exists(''.dirname(__FILE__).'/statistics.txt'))
			{
				unlink(''.dirname(__FILE__).'/statistics.txt');
			}
		
			if(file_exists(''.dirname(__FILE__).'/adminlottery.txt'))
			{
				unlink(''.dirname(__FILE__).'/adminlottery.txt');
			}
		
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tablotteryusers.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabticketsall.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tablottery.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsreserve.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresults.'');
			usleep(250000);
			
			$text='Вы <b>удалили розыгрыш</b> из канала.';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
		}
		elseif($this->cmd_if_exists($tabservicelottery))
		{
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresultsreserve.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabresults.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
			usleep(250000);
			
			if(file_exists(''.dirname(__FILE__).'/lotterytext.txt'))
			{
				unlink(''.dirname(__FILE__).'/lotterytext.txt');
			}
			
			if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
			{
				unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
			}
			
			if(file_exists(''.dirname(__FILE__).'/enddate.txt'))
			{
				unlink(''.dirname(__FILE__).'/enddate.txt');
			}
			
			if(file_exists(''.dirname(__FILE__).'/statistics.txt'))
			{
				unlink(''.dirname(__FILE__).'/statistics.txt');
			}
		
			if(file_exists(''.dirname(__FILE__).'/adminlottery.txt'))
			{
				unlink(''.dirname(__FILE__).'/adminlottery.txt');
			}
			
			$text='Вы <b>удалили сохраненный розыгрыш</b>. Теперь Вы можете создать новый!';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			
			$text='Вы еще <b>не создали и не запустили</b> в канал ни одного розыгрыша';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(250000);

			
		}
	}	


	
	
/////
	public function callback_lottery_change_complete()
	{
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatid=$this->api->chatId;
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		$tablotteryusers='tablotteryusers';
		$tabcasinousers='tabcasinousers';
		$tabadminchange='tabadminchange';
		$tabserviceadmin='tabserviceadmin';
		$tabresults='tabresults';
		$tabresultsreserve='tabresultsreserve';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
			
		if($this->cmd_if_exists($tablottery))
		{
			$query=mysqli_query($con_sql2, 'SELECT enddate FROM '.$tablottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$enddateold=$row[0][0];
			
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tablottery.'');
			usleep(250000);			
		
			mysqli_query($con_sql2, 'INSERT INTO '.$tablottery.' (channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos) SELECT channelid,lotteryname,messid,startdate,enddate,topplaces,parrefer,pardeposit,pardata,parpublic,fakeplaces,photos FROM '.$tabservicelottery.'');
			usleep(250000);
			
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tablottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$lotteryname=$row[0][2];
			$messageidchannel=$row[0][3];	
			$fakeplaces=$row[0][11];
			$enddatenew=$row[0][5];
			
			
			if($enddateold!=$enddatenew)
			{
				file_put_contents(''.dirname(__FILE__).'/enddate.txt', $enddatenew);
			}
			
			
			
			$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
			$lotteryreservetext=file_get_contents(''.dirname(__FILE__).'/lotteryreservetext.txt');
			
			if($lotterytext!=$lotteryreservetext)
			{
				file_put_contents(''.dirname(__FILE__).'/lotteryreservetext.txt', $lotterytext);
				
				
				$query3=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
				usleep(250000);
				
				if(!empty(mysqli_num_rows($query3)))
				{
					$con3=mysqli_num_rows($query3);
				}
				else
				{
					$con3='0';
				}
				
				$botusername=json_decode($this->api->getMe(), true);
				$botusername=$botusername['result']['username'];
				
				$urllottery='https://t.me/'.$botusername.'?start=lottery';
				
				$keyb = [  [['text' => '🤝Зарегистрироваться (участников - '.$con3.')', 'url' => $urllottery ]] ];
				
				$textall="";

				$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
				
				if($row[0][12]!="0")
				{
					$text='<a href="'.$row[0][12].'">&#160;</a>';
					$textall=$textall . ''.$text.'';
				}
				
				$this->api->editMessageText([
					'chat_id' => $this->mainchannel(),
					'message_id' => $messageidchannel,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
					'text' => $textall,
					'parse_mode' => "HTML",
				]);
			}
			


			$text='Вы <b>успешно изменили</b> действующий розыгрыш "'.$lotteryname.'"!';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
				
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(350000);
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
			usleep(350000);
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
			usleep(350000);
			
			if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
			{
				unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
			}
			
		}
		elseif($this->cmd_if_exists($tabservicelottery))
		{
			
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicelottery.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$textall="";
			
			$text='<b>Вы выбрали следующие параметры:</b>'.PHP_EOL.''.PHP_EOL.'Название розыгрыша - "'.$row[0][2].'"'.PHP_EOL.'Дата окончания розыгрыша - <b>'.$row[0][5].'</b>'.PHP_EOL.'Количество призовых мест - <b>'.$row[0][6].'</b>'.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
			
			if($row[0][7]!="0")
			{
				$text='Реферальная программа - <b>'.$row[0][7].' чел</b>'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
			}
			if($row[0][8]!="0")
			{
				$text='За депозиты - <b>'.$row[0][8].' Евро</b>'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
			}
			if($row[0][9]!="0")
			{
				$text='За регистрационные данные - <b>'.$row[0][9].'</b>'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
			}
			if($row[0][10]!="0")
			{
				$text='За публикации - <b>'.$row[0][10].'</b>'.PHP_EOL.'';
				$textall=$textall . ''.$text.'';
			}


			$text=''.PHP_EOL.''.PHP_EOL.'';
			$textall=$textall . ''.$text.'';

			$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
			$textall=$textall . ''.$lotterytext.''.PHP_EOL.'';
			
			if($row[0][12]!="0")
			{
				$text='<a href="'.$row[0][12].'">&#160;</a>';
			}
	

			$botusername=json_decode($this->api->getMe(), true);
			$botusername=$botusername['result']['username'];
					
			$urllottery='https://t.me/'.$botusername.'?start';
					
			$keyb = [  [['text' => '🤝Зарегистрироваться (0 участников)КНОПКА ДЛЯ ПРИМЕРА', 'url' => $urllottery ]] ];
						
			$this->api->sendMessage([
			'text' => $textall,
			'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			

			$text='Вы <b>успешно сохранили изменения</b> в розыгрыше "'.$lotteryname.'"!'.PHP_EOL.''.PHP_EOL.'Так будет выглядеть розыгрыш в канале👆'.PHP_EOL.''.PHP_EOL.'Нажмите на кнопку <b>Запустить розыгрыш</b>, чтобы отправить его в канал!';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
				
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(350000);
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
			usleep(350000);
			
			if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
			{
				unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
			}
			
		}
		else
		{			
			$text='Вы еще <b>не создали и не запустили</b> в канал ни одного розыгрыша';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(350000);
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
			usleep(350000);
			
			if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
			{
				unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
			}
			
		}
	}

	
	
	
/////
	public function callback_user_message_exit()
	{		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$text='Вы вышли в <b>Главное меню</b>';
		
		$this->api->sendMessage([
		'text' => $text,
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
	
	
/////
	public function callback_lottery_change_exit()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabadminchange='tabadminchange';
		$tabserviceadmin='tabserviceadmin';
		$tablottery='tablottery';
		$tabservicelottery='tabservicelottery';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		$text='Вы вышли в <b>Главное меню</b>';
		
		$this->api->sendMessage([
		'text' => $text,
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(350000);
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabadminchange.'');
		usleep(350000);
		
		if($this->cmd_if_exists($tablottery))
		{
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabservicelottery.'');
			usleep(350000);
		}
		
		if(file_exists(''.dirname(__FILE__).'/lotteryreservetext.txt'))
		{
			unlink(''.dirname(__FILE__).'/lotteryreservetext.txt');
		}
		
	}
	




	
////////////////////////////////////////STATISTICS///////////////////////////////////////////////////////////////
/////
	public function cmd_admin_statistics()
	{
		if($this->cmd_isadmin())
		{
			if(file_exists(''.dirname(__FILE__).'/statistics.txt')==FALSE)
			{
				$tabusers='tablotteryusers';
				
				if($this->cmd_if_exists($tabusers) && $this->cmd_if_empty($tabusers)==FALSE)
				{
									
					$chatid=$this->api->chatId;
				
					file_put_contents(''.dirname(__FILE__).'/statistics.txt', $chatid);
					
					
					shell_exec('php '.dirname(__FILE__).'/statistics.php > /dev/null 2>/dev/null &');
					sleep(1);
				}
				else
				{
					$text='В данный момент <b>нет пользователей!</b>';
					
					$this->api->sendMessage([
					'text' => $text,
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				$text='Вы <b>уже запросили статистику</b>, в данный момент она еще формируется.';
					
				$this->api->sendMessage([
				'text' => $text,
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
					
		}

	}

////////////////////////////////////////////////////////////////////	
//////////////////////////////////////BAN USERS//////////////////////////////	
	
	
/////
	public function cmd_lottery_banusers()
	{
		$con_sql2=$this->cmd_sql();
		$tabusers='tabusers';
		$tabbanned='tabbanned';
			
		if($this->cmd_if_exists($tabusers) && $this->cmd_if_empty($tabusers)==FALSE)
		{
			$text='Выберите, что Вы хотите сделать👇';
					
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_banusers']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='В данный момент <b>нет пользователей!</b>';

			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	
	}
	
	
/////
	public function callback_admin_users_ban()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$tabserviceadmin='tabserviceadmin';
		$tabusers='tabusers';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		if($this->cmd_if_exists($tabusers) && $this->cmd_if_empty($tabusers)==FALSE)
		{
			
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("banusers")');
			usleep(250000);
		
			
			$text='Пришлите телеграм ID пользователя, <b>чтобы его забанить</b>👇';
		
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='В данный момент <b>нет пользователей!</b>';
			
			
			$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_banusers']]),
			'parse_mode' => "HTML"
			]);
		}
		
		
	}	
	



/////
	public function cmd_admin_banusers_action()
	{	
		$con_sql2=$this->cmd_sql();
		
		$chatidadmin=$this->api->chatId;

		$tabserviceadmin='tabserviceadmin';
		
		$textmessage=$this->api->textmessage;
		
		$chatiduser=$textmessage;
		
		$tabusers='tabusers';
		$tabbanned='tabbanned';
		$tabchannels='tabchannels';
		$tabgroups='tabgroups';
		$tabserviceuser='tabserviceuser'.$chatiduser.'';
		$tabtempuser='tabtempuser'.$chatiduser.'';
		$tabtempusererr='tabtempusererr'.$chatiduser.'';
		$tabrefer='tabrefer'.$chatiduser.'';
		$tabrefers='tabrefers'.$chatiduser.'';
		$tabcasinousers='tabcasinousers';
		$tablotteryusers='tablotteryusers';
		$tabticketsall='tabticketsall';
		$tablottery='tablottery';
		
		$arraystatus=['member','creator','administrator'];
		
		
		if(preg_match('/\d{9,15}/', $chatiduser) && $this->cmd_sql_searchchatidtable($chatiduser, $tabusers))
		{
		
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
			usleep(250000);
	
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempuser.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempusererr.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceuser.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabrefer.'');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabrefers.'');
			usleep(250000);
			
			
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabbanned.' LIKE '.$tabusers.'');
			usleep(250000);
				
			mysqli_query($con_sql2, 'INSERT INTO '.$tabbanned.' (chatid,firstname,lastname,username,actiondate) SELECT chatid,firstname,lastname,username,actiondate FROM '.$tabusers.' WHERE chatid="'.$chatiduser.'"');
			
	
			mysqli_query($con_sql2, 'DELETE FROM '.$tabusers.' WHERE chatid="'.$chatiduser.'"');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tabcasinousers.' WHERE chatid="'.$chatiduser.'"');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tablotteryusers.' WHERE chatid="'.$chatiduser.'"');
			usleep(250000);
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tabticketsall.' WHERE chatid="'.$chatiduser.'"');
			usleep(250000);
			
			
			
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$channelid=$row[$i][0];
				
				$inchannel=json_decode($this->api->getChatMember([
				'chat_id' => $channelid,
				'user_id' => $chatiduser,
				]), true);
				
				$inchannel=$inchannel['result'];
				
				if(in_array($inchannel['status'], $arraystatus))
				{
					$this->api->banChatMember([
						'chat_id' => $channelid,
						'user_id' => $chatiduser,
						'revoke_messages' => true,
					]);
				}
			}


			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabgroups.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$groupid=$row[$i][0];
				
				$ingroup=json_decode($this->api->getChatMember([
				'chat_id' => $groupid,
				'user_id' => $chatiduser,
				]), true);
				
				$ingroup=$ingroup['result'];
				
				if(in_array($ingroup['status'], $arraystatus))
				{
					$this->api->banChatMember([
						'chat_id' => $groupid,
						'user_id' => $chatiduser,
						'revoke_messages' => true,
					]);
				}
			}
			
			
			
			if(!empty($this->api->username))
			{
				$usernameadmin='@'.$this->api->username.'';
				$text='К сожалению, <b>Вы были заблокированы!</b>'.PHP_EOL.''.PHP_EOL.'Чтобы Вас разблокировали, напишите моему старшему - '.$usernameadmin.'.';
			}
			else
			{
				$text='К сожалению, <b>Вы были заблокированы!</b>';
			}
			
			
			$this->api->sendMessage([
			'chat_id' => $chatiduser,
			'text' => $text,
			'reply_markup' => json_encode( ['remove_keyboard' => true] ),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			
			
			
			
			$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$tabbanned.' WHERE chatid="'.$chatiduser.'"');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$userfirstname=$row[0][0];
			$userlastname=$row[0][1];
			$userusername=$row[0][2];
			
			if(!empty($userusername))
			{
				if(!empty($userlastname))
				{
					$text='Вы <b>успешно заблокировали</b> пользователя <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.' '.$userlastname.'</a> ('.$userusername.') с ID <b>'.$chatiduser.'</b>';
				}
				else
				{
					$text='Вы <b>успешно заблокировали</b> пользователя <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.'</a> ('.$userusername.') с ID <b>'.$chatiduser.'</b>';
				}
			}
			else
			{
				if(!empty($userlastname))
				{
					$text='Вы <b>успешно заблокировали</b> пользователя <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.' '.$userlastname.'</a> с ID <b>'.$chatiduser.'</b>';
				}
				else
				{
					$text='Вы <b>успешно заблокировали</b> пользователя <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.'</a> с ID <b>'.$chatiduser.'</b>';
				}
			}
			
			
			$this->api->sendMessage([
			'chat_id' => $chatidadmin,
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_banusers']]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='<b>Вы ввели несуществующий ID</b>, пожалуйста пришлите правильный телеграм ID пользователя👇';
			
			$this->api->sendMessage([
			'chat_id' => $chatidadmin,
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		
		
	}		
	
	
	
	
/////
	public function callback_admin_users_unban()
	{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$tabserviceadmin='tabserviceadmin';
		$tabusers='tabusers';
		$tabbanned='tabbanned';
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);
			
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		if($this->cmd_if_exists($tabbanned) && $this->cmd_if_empty($tabbanned)==FALSE)
		{
			$text='Выберите пользователя, <b>которого хотите разбанить</b>👇';
			
			$merge=$this->cmd_admin_unbanusers_choose();
			usleep(250000);
			
			//$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
		}
		else
		{
			$text='<b>В данный момент нет забаненных пользователей!</b>';
			
			$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_banusers']]),
			'parse_mode' => "HTML"
			]);
		}

	}	
	
	
	
/////
	public function cmd_admin_unbanusers_choose()
	{	
		
		$con_sql2=$this->cmd_sql();
		
		$chatidadmin=$this->api->chatId;
		$chatid=$this->api->chatId;
		$tabserviceadmin='tabserviceadmin';
		$tabusers='tabusers';
		$tabbanned='tabbanned';
		
		
		$query=mysqli_query($con_sql2, 'SELECT chatid, firstname, lastname, username FROM '.$tabbanned.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		

		$cnt=$con;
		$maxbuttons=1;
		$ceil=ceil($cnt/$maxbuttons);
		
		
		
		$include=''.dirname(__FILE__).'/include'.$chatid.'.php';
		
		if(file_exists($include)==FALSE)
		{
			touch($include);
			
			$insert='<?php
		
			class TelegramBotfunc{';
			file_put_contents($include, $insert . PHP_EOL,FILE_APPEND);
			
		}
		else
		{
			$getinclude=file($include);
			unset($getinclude[$this->cmd_array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		
		
		
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				
				$userchatid=$row[$u][0];
				$userfirstname=$row[$u][1];
				$userlastname=$row[$u][2];
				$userusername=$row[$u][3];
				
				
				if(!empty($userusername))
				{
					$text=''.$userusername.' ('.$userchatid.' - телеграм id)';
				}
				else
				{
					if(!empty($userlastname))
					{
						$text=''.$userfirstname.' '.$userlastname.' ('.$userchatid.' - телеграм id)';
					}
					else
					{
						$text=''.$userfirstname.' ('.$userchatid.' - телеграм id)';
					}
				}
				
				$buttext=$text;
				
				$put[]=['text' => ''.$buttext.'', 'callback_data' => 'adm_unban_user_'.$userchatid.''];
				
				if(preg_match('/callback_adm_unban_user_'.$userchatid.'/', file_get_contents($include))==FALSE)
				{
					$insert='
					public function callback_adm_unban_user_'.$userchatid.'()
					{	
						include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
						
						$bot = new DataBot();
						$bot->api->getWebhookUpdate();
						
						
						$con_sql2=$bot->cmd_sql();
						
						$arraystatus=[&#039;kicked&#039;];
						$tabchannels=&#039;tabchannels&#039;;
						$tabgroups=&#039;tabgroups&#039;;
						
						$query=mysqli_query($con_sql2, &#039;SELECT channelid FROM &#039;.$tabchannels.&#039;&#039;);
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
							
							$channelid=$row[$i][0];
							
							$inchannel=json_decode($bot->api->getChatMember([
							&#039;chat_id&#039; => $channelid,
							&#039;user_id&#039; => &#039;'.$userchatid.'&#039;,
							]), true);
							
							$inchannel=$inchannel[&#039;result&#039;];
							
							if(in_array($inchannel[&#039;status&#039;], $arraystatus))
							{
								$bot->api->unbanChatMember([
								&#039;chat_id&#039; => $channelid,
								&#039;user_id&#039; => &#039;'.$userchatid.'&#039;,
								&#039;only_if_banned&#039; => true,
								]);
								usleep(250000);
							}
						}
			
			
						$query=mysqli_query($con_sql2, &#039;SELECT channelid FROM &#039;.$tabgroups.&#039;&#039;);
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
							
							$groupid=$row[$i][0];
							
							$ingroup=json_decode($bot->api->getChatMember([
							&#039;chat_id&#039; => $groupid,
							&#039;user_id&#039; => &#039;'.$userchatid.'&#039;,
							]), true);
							
							$ingroup=$ingroup[&#039;result&#039;];
							
							if(in_array($ingroup[&#039;status&#039;], $arraystatus))
							{
								$bot->api->unbanChatMember([
								&#039;chat_id&#039; => $groupid,
								&#039;user_id&#039; => &#039;'.$userchatid.'&#039;,
								&#039;only_if_banned&#039; => true,
								]);
								usleep(250000);
							}
						}



						if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
						{
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							$bot->api->answerCallbackQuery($callback_query_id);
						}
						
						$text=&#039;Поздравляю! <b>Вы были разбанены!</b>&#039;.PHP_EOL.&#039;Напишите мне команду /start, чтобы продолжить работу!👇&#039;;
						
						$bot->api->sendMessage([
						&#039;chat_id&#039; => &#039;'.$userchatid.'&#039;,
						&#039;text&#039; => $text,
						//&#039;reply_markup&#039; => json_encode( [&#039;remove_keyboard&#039; => true] ),
						//&#039;disable_notification&#039; => TRUE,
						//&#039;disable_web_page_preview&#039; => TRUE,
						&#039;parse_mode&#039;=> "HTML"
						]);
						
						
						$query=mysqli_query($con_sql2, &#039;SELECT firstname, lastname, username FROM '.$tabbanned.' WHERE chatid="'.$userchatid.'"&#039;);
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						$userfirstname=$row[0][0];
						$userlastname=$row[0][1];
						$userusername=$row[0][2];
						
						if(!empty($userusername))
						{
							if(!empty($userlastname))
							{
								$text=&#039;Вы <b>успешно разбанили</b> пользователя <a href="tg://user?id='.$userchatid.'">&#039;.$userfirstname.&#039; &#039;.$userlastname.&#039;</a> (&#039;.$userusername.&#039;) с ID <b>'.$userchatid.'</b>&#039;;
							}
							else
							{
								$text=&#039;Вы <b>успешно разбанили</b> пользователя <a href="tg://user?id='.$userchatid.'">&#039;.$userfirstname.&#039;</a> (&#039;.$userusername.&#039;) с ID <b>'.$userchatid.'</b>&#039;;
							}
						}
						else
						{
							if(!empty($userlastname))
							{
								$text=&#039;Вы <b>успешно разбанили</b> пользователя <a href="tg://user?id='.$userchatid.'">&#039;.$userfirstname.&#039; &#039;.$userlastname.&#039;</a> с ID <b>'.$userchatid.'</b>&#039;;
							}
							else
							{
								$text=&#039;Вы <b>успешно разбанили</b> пользователя <a href="tg://user?id='.$userchatid.'">&#039;.$userfirstname.&#039;</a> с ID <b>'.$userchatid.'</b>&#039;;
							}
						}
						
			
			
						mysqli_query($con_sql2, &#039;DELETE FROM '.$tabbanned.' WHERE chatid="'.$userchatid.'"&#039;);
						usleep(250000);
						
						
						$merge=$bot->cmd_admin_unbanusers_choose();
						usleep(100000);
						
						if (array_filter($merge) !== [])
						{
							$text=$text . &#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Выберите пользователя, <b>которого хотите разбанить</b>👇&#039;;
							
							$bot->api->editMessageText([
							&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
							&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
							&#039;text&#039; => $text,
							&#039;parse_mode&#039; => "HTML",
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
							]);
							usleep(100000);
						}
						else
						{						
							$text=$text . &#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;В данный момент у Вас <b>нет забаненных пользователей!</b>&#039;;
							
							$bot->api->editMessageText([
							&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
							&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
							&#039;text&#039; => $text,
							&#039;parse_mode&#039; => "HTML",
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_banusers&#039;]]),
							]);
							usleep(100000);
							
						}
						
					}';
						
					file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
				}
				
				$u++;	
			}
				
			$merge[]=$put;
			unset($put);
			
		}
		
		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		return $merge;

		
	}		
	
	
	
	
	
	
///////////////////////////MESSAGES/////////////////////////////////	
/////
	public function cmd_message_lottery()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			$tabusers='tabusers';
			
			if(file_exists(''.dirname(__FILE__).'/mailing.php')==FALSE)
			{
				
				if(!empty(mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.'')))
				{
					$text='Выберите кому хотите <b>отправить сообщение</b>';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$text='<b>В данный момент нет пользователей!</b>';
					
					$this->api->sendMessage([
					'text' => $text,
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
			
				$text='<b>В данный момент уже есть запущенная рассылка, сначала остановите ее или дождитесь завершения.</b>';
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
			
			}
			
		}

	}
	


/////
	public function callback_users_message_all()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadmin='tabserviceadmin';
		$tabusers='tabusers';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(file_exists(''.dirname(__FILE__).'/mailing.php')==FALSE)
		{
			
			if(!empty(mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.'')))
			{
				
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("messageallusers")');
				usleep(250000);
	
				
				$text='Напишите сообщение, чтобы <b>отправить его всем пользователям</b>';
	
				$this->api->sendMessage([
				'text' => $text,
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				$text='<b>В данный момент нет пользователей!</b>';
				
				
				$this->api->editMessageText([
					'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
					'message_id' => $this->api->body['callback_query']['message']['message_id'],
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
					'parse_mode' => "HTML"
					]);
			}
		}
		else
		{
			
			$text='<b>В данный момент уже есть запущенная рассылка, сначала удалите или дождитесь ее завершения.</b>';
			
			$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
			'parse_mode' => "HTML"
			]);
			
		}
		
	}
	


	
/////
	public function callback_users_message_lottery()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadmin='tabserviceadmin';
		$tablotteryusers='tablotteryusers';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(file_exists(''.dirname(__FILE__).'/mailing.php')==FALSE)
		{
			if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.' LIMIT 1'))))
			{
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("messagelotteryusers")');
				usleep(250000);
		
				
				
				$text='Напишите сообщение, чтобы <b>отправить его участникам розыгрыша</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				$text='В данный момент <b>нет участников розыгрыша</b>';
				
				$this->api->editMessageText([
					'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
					'message_id' => $this->api->body['callback_query']['message']['message_id'],
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
					'parse_mode' => "HTML"
					]);
			}
		}
		else
		{
			
			$text='<b>В данный момент уже есть запущенная рассылка, сначала удалите или дождитесь ее завершения.</b>';
			
			$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
			'parse_mode' => "HTML"
			]);
			
		}
		
	}	



/////
	public function callback_user_message_byid()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadmin='tabserviceadmin';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
		usleep(250000);
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
		usleep(250000);
		mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("messageuserbyid")');
		usleep(250000);
		
		$text='<b>Пришлите ID пользователя</b>';
		
		$this->api->sendMessage([
		'text' => $text,
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}


	
/////
	public function callback_users_message_notlottery()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadmin='tabserviceadmin';
		$tabusers='tabusers';
		$tablotteryusers='tablotteryusers';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		if(file_exists(''.dirname(__FILE__).'/mailing.php')==FALSE)
		{
			if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.' LIMIT 1'))))
			{
				$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
	
				$row=[];
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
					$userchatid=$row[$i][0];
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.' LIMIT 1'))))
					{
						if($this->cmd_sql_searchchatidtable($userchatid, $tablotteryusers)==FALSE)
						{
							$a=1;
							break;
						}
					}
					else
					{
						$a=1;
						break;
					}
				}
				
				
				
				if(!empty($a))
				{
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
					usleep(250000);
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("messagenotlotteryusers")');
					usleep(250000);
					
					$text='Напишите сообщение, чтобы <b>отправить его пользователям, которые не участвуют в розыгрыше</b>';
					
					$this->api->sendMessage([
					'text' => $text,
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				else
				{
					$text='В данный момент <b>нет пользователей, которые не участвуют в розыгрыше!</b>';
				
					$this->api->editMessageText([
						'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
						'message_id' => $this->api->body['callback_query']['message']['message_id'],
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
						'parse_mode' => "HTML"
						]);
				}
	
			}
			else
			{
				$text='<b>В данный момент нет пользователей!</b>';
				
				$this->api->editMessageText([
					'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
					'message_id' => $this->api->body['callback_query']['message']['message_id'],
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
					'parse_mode' => "HTML"
					]);
			}
		}
		else
		{
			
			$text='<b>В данный момент уже есть запущенная рассылка, сначала удалите или дождитесь ее завершения.</b>';
			
			$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
			'parse_mode' => "HTML"
			]);
			
		}
		
	}		






	
///////////////////////////////Всем пользователям////////////////////////////	
/////
	public function cmd_messageallusers()
	{
		
			$con_sql2=$this->cmd_sql();
			
			$chatidadmin=$this->api->chatId;
			$fromchatid=$this->api->chatId;
			$tabserviceadmin='tabserviceadmin';
			$messageid=$this->api->messageid;
			$tabusers='tabusers';
			$tabadmin='tabadmin';
			
			
			if(file_exists(''.dirname(__FILE__).'/mailing.php')==FALSE)
			{

				mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
				usleep(250000);
				
				$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$usersquan=$con;
				
				$before='📩📩📩📩📩📩📩📩📩📩📩📩'.PHP_EOL.''.PHP_EOL.'';
				$after=''.PHP_EOL.''.PHP_EOL.'📩📩📩📩📩📩📩📩📩📩📩📩';
				
				$text=''.$before.'📈<b>Рассылка всем пользователям запущена!</b>'.PHP_EOL.''.PHP_EOL.'<i>Отправлено: 0 из '.$usersquan.''.PHP_EOL.'Осталось отправить: '.$usersquan.''.PHP_EOL.'Не удалось отправить: 0'.$after.'</i>';
				
				$merge=[];
				$merge[] = [['text' => '⏹Остановить рассылку', 'callback_data' => 'users_mailing_stop']];
				
				
				$result=json_decode($this->api->sendMessage([
				'chat_id' => $chatidadmin,
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$merge]),	
				'parse_mode'=> 'HTML'
				]), true);
				usleep(250000);
				
				$messageidadmin=$result['result']['message_id'];
				
				$this->api->pinChatMessage([
				'chat_id' => $chatidadmin,
				'message_id'=> $messageidadmin
				]);
				usleep(250000);
				
				$putdata=''.$messageid.','.$fromchatid.','.$messageidadmin.','.$chatidadmin.'';
				
				file_put_contents(''.dirname(__FILE__).'/messidmailing.txt', $putdata);
				usleep(150000);
				
				
				/* $query5=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabadmin.'');
				usleep(250000);
				$con5=mysqli_num_rows($query5);
			
				$row5=[];
				for($i5=0;$i5<$con5;$i5++)
				{
					mysqli_data_seek($query5, $i5);
					$row5[$i5]=mysqli_fetch_row($query5);
				
					$chatidadm=$row5[$i5][0];
					
					$result=json_decode($this->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$merge]),	
					'parse_mode'=> 'HTML'
					]), true);
					usleep(250000);
					
					$messageidadm=$result['result']['message_id'];
					
					$this->api->pinChatMessage([
					'chat_id' => $chatidadm,
					'message_id'=> $messageidadm
					]);
					
					
					$putdata=''.$messageid.','.$fromchatid.','.$messageidadm.','.$chatidadm.'';
					file_put_contents(''.dirname(__FILE__).'/messidmailing.txt', $putdata . PHP_EOL,FILE_APPEND);
					usleep(100000);
				} */
				

				$insert='<?php
				
				set_time_limit(0);
				
				include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
				
				$bot = new DataBot();
				
				$con_sql2=$bot->cmd_sql();
				
				date_default_timezone_set(&#039;Europe/Kiev&#039;);
				
				$pid=getmypid();
				
				file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/pid1.txt&#039;, $pid);
				$tabusers=&#039;tabusers&#039;;
	
				
				$before=&#039;📩📩📩📩📩📩📩📩📩📩📩📩&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$after=&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📩📩📩📩📩📩📩📩📩📩📩📩&#039;;
				
				

				$con=mysqli_num_rows(mysqli_query($con_sql2, &#039;SELECT chatid FROM &#039;.$tabusers.&#039;&#039;));
				
				$allusers=$con;
				$tosend=$con;
				$sent=0;
				$percent=0;
				$percent1=0;
				$notsent=0;
				
				$data=file(&#039;&#039;.dirname(__FILE__).&#039;/messidmailing.txt&#039;);
				$mainparse=explode(&#039;,&#039;, $data[0]);
				$messageid=$mainparse[0];
				$fromchatid=$mainparse[1];
				
				
				$textbadall="";
				
				$merge=[];
				$merge[] = [[&#039;text&#039; => &#039;⏹Остановить рассылку&#039;, &#039;callback_data&#039; => &#039;users_mailing_stop&#039;]];
				
				
				$query=mysqli_query($con_sql2, &#039;SELECT chatid, firstname, lastname, username FROM &#039;.$tabusers.&#039;&#039;);
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$row=[];
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				
					$chatiduser=$row[$i][0];
					$firstname=$row[$i][1];
					$lastname=$row[$i][2];
					$username=$row[$i][3];

					
					$result=json_decode($bot->api->copyMessage([
					&#039;chat_id&#039; => $chatiduser,
					&#039;from_chat_id&#039; => $fromchatid,
					&#039;message_id&#039; => $messageid,
					&#039;parse_mode&#039;=> &#039;HTML&#039;
					]), true);
					usleep(250000);
		
					if($result[&#039;ok&#039;])
					{
						$sent=$sent+1;
						$tosend=$tosend-1;
						$percent=($sent/$allusers)*100;
						$percent=round($percent, 2);
						
						$textall="";
						$text=&#039;&#039;.$before.&#039;📈<b>Рассылка всем пользователям в процессе!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
						if(empty($percent))
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
						}
						else
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
						}
						
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						
						if($percent1==0)
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
						}
						else
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
						}
				
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;

		
						foreach($data as $dataparse)
						{
							$dataparse=explode(&#039;,&#039;, $dataparse);
					
							$messidadm=$dataparse[2];
							$chatidadm=$dataparse[3];
							
							$bot->api->editMessageText([
							&#039;chat_id&#039; => $chatidadm,
							&#039;message_id&#039; => $messidadm,
							&#039;text&#039; => $textall,
							&#039;reply_markup&#039; => json_encode([&#039;inline_keyboard&#039;=>$merge]),
							&#039;parse_mode&#039; => &#039;HTML&#039;,
							]);
							usleep(250000);
						}
					
					}
					else
					{
						$notsent=$notsent+1;
						$tosend=$tosend-1;
						
						$percent1=($notsent/$allusers)*100;
						$percent1=round($percent1, 2);
						
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
						
						

						if(empty($lenusername))
						{
							$putuser=$firstname;
							
							if(!empty($lastname))
							{
								$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
							}
						}
						elseif($lenusername<$lenfio)
						{
							$putuser=$username;
						}
						elseif($lenusername>$lenfio)
						{
							$putuser=$firstname;
							
							if(!empty($lastname))
							{
								$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
							}
						}
						elseif($lenusername==$lenfio)
						{
							$putuser=$username;
						}
						
						
						$textbad=&#039;<a href="tg://user?id=&#039;.$chatiduser.&#039;">&#039;.$putuser.&#039;</a>&#039;;
					
						if($i==0)
						{
							$textbadall=$textbad;
						}
						else
						{
							$textbadall=$textbadall . &#039;, &#039;.$textbad.&#039;&#039;;
						}
						
						
						
						$textall="";
						$text=&#039;&#039;.$before.&#039;📈<b>Рассылка всем пользователям в процессе!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
						if($percent==0)
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
						}
						else
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
						}
						
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						
						if($percent1==0)
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
						}
						else
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
						}
				
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;
						
						
						foreach($data as $dataparse)
						{
							$dataparse=explode(&#039;,&#039;, $dataparse);
					
							$messidadm=$dataparse[2];
							$chatidadm=$dataparse[3];
							
							$bot->api->editMessageText([
							&#039;chat_id&#039; => $chatidadm,
							&#039;message_id&#039; => $messidadm,
							&#039;text&#039; => $textall,
							&#039;reply_markup&#039; => json_encode([&#039;inline_keyboard&#039;=>$merge]),
							&#039;parse_mode&#039; => &#039;HTML&#039;,
							]);
							
							usleep(250000);
						}

					}
				}
				
				$textall="";
				$text=&#039;&#039;.$before.&#039;📈<b>Рассылка всем пользователям завершена!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				if($percent==0)
				{
					$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
				}
				else
				{
					$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
				}
				
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				
				if($percent1==0)
				{
					$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
				}
				else
				{
					$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
				}
		
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;
		
				foreach($data as $dataparse)
				{
					$dataparse=explode(&#039;,&#039;, $dataparse);
				
					$messidadm=$dataparse[2];
					$chatidadm=$dataparse[3];
					
					$bot->api->editMessageText([
					&#039;chat_id&#039; => $chatidadm,
					&#039;message_id&#039; => $messidadm,
					&#039;text&#039; => $textall,
					&#039;parse_mode&#039; => &#039;HTML&#039;,
					]);
					
					usleep(150000);
				}	
				
				
				$text=&#039;<b>Рассылка всем пользователям завершена!</b>&#039;;
				
				foreach($data as $dataparse)
				{
					$dataparse=explode(&#039;,&#039;, $dataparse);
					
					$messidadm=$dataparse[2];
					$chatidadm=$dataparse[3];
					
					$bot->api->unpinChatMessage([
					&#039;chat_id&#039; => $chatidadm,
					&#039;message_id&#039;=> $messidadm
					]);
					
					usleep(150000);
					
					$bot->api->sendMessage([
					&#039;chat_id&#039; => $chatidadm,
					&#039;text&#039; => $text,
					//&#039;disable_notification&#039; => TRUE,
					//&#039;disable_web_page_preview&#039; => TRUE,
					&#039;parse_mode&#039; => "HTML"
					]);
					
					usleep(150000);
				}
				
				$bot->cmd_delete_mailing();
				';
				
				
				
				file_put_contents(''.dirname(__FILE__).'/mailing.php', html_entity_decode($insert, ENT_QUOTES) . PHP_EOL);
				sleep(2);
				shell_exec('php '.dirname(__FILE__).'/mailing.php > /dev/null 2>/dev/null &');
				sleep(1);
			}
			else
			{
				
				$text='<b>В данный момент уже есть текущая рассылка, вы не можете начать новую!</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}


	}





/////
	public function cmd_messagelotteryusers()
	{
		
			$con_sql2=$this->cmd_sql();
			
			$chatidadmin=$this->api->chatId;
			$fromchatid=$this->api->chatId;
			$tabserviceadmin='tabserviceadmin';
			$messageid=$this->api->messageid;
			$tabusers='tabusers';
			$tabadmin='tabadmin';
			$tablotteryusers='tablotteryusers';
			
			
			if(file_exists(''.dirname(__FILE__).'/mailing.php')==FALSE)
			{

				mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
				usleep(250000);
				
				$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$usersquan=$con;
				
				$before='📩📩📩📩📩📩📩📩📩📩📩📩'.PHP_EOL.''.PHP_EOL.'';
				$after=''.PHP_EOL.''.PHP_EOL.'📩📩📩📩📩📩📩📩📩📩📩📩';
				
				$text=''.$before.'📈<b>Рассылка участникам розыгрыша запущена!</b>'.PHP_EOL.''.PHP_EOL.'<i>Отправлено: 0 из '.$usersquan.''.PHP_EOL.'Осталось отправить: '.$usersquan.''.PHP_EOL.'Не удалось отправить: 0'.$after.'</i>';
				
				$merge=[];
				$merge[] = [['text' => '⏹Остановить рассылку', 'callback_data' => 'users_mailing_stop']];
				
				$result=json_decode($this->api->sendMessage([
				'chat_id' => $chatidadmin,
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$merge]),	
				'parse_mode'=> 'HTML'
				]), true);
				usleep(250000);
				
				$messageidadmin=$result['result']['message_id'];
				
				$this->api->pinChatMessage([
				'chat_id' => $chatidadmin,
				'message_id'=> $messageidadmin
				]);
				usleep(250000);
				
				$putdata=''.$messageid.','.$fromchatid.','.$messageidadmin.','.$chatidadmin.'';
				
				file_put_contents(''.dirname(__FILE__).'/messidmailing.txt', $putdata);
				usleep(150000);
				
				/* $query5=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabadmin.'');
				usleep(250000);
				$con5=mysqli_num_rows($query5);
			
				$row5=[];
				for($i5=0;$i5<$con5;$i5++)
				{
					mysqli_data_seek($query5, $i5);
					$row5[$i5]=mysqli_fetch_row($query5);
				
					$chatidadm=$row5[$i5][0];
					
					$result=json_decode($this->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$merge]),	
					'parse_mode'=> 'HTML'
					]), true);
					usleep(250000);
					
					$messageidadm=$result['result']['message_id'];
					
					$this->api->pinChatMessage([
					'chat_id' => $chatidadm,
					'message_id'=> $messageidadm
					]);
					
					
					$putdata=''.$messageid.','.$fromchatid.','.$messageidadm.','.$chatidadm.'';
					file_put_contents(''.dirname(__FILE__).'/messidmailing.txt', $putdata . PHP_EOL,FILE_APPEND);
					usleep(100000);
				} */
				
						
				$insert='<?php
				
				set_time_limit(0);
				
				include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
				
				$bot = new DataBot();
				
				$con_sql2=$bot->cmd_sql();
				
				date_default_timezone_set(&#039;Europe/Kiev&#039;);
				
				$pid=getmypid();
				
				file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/pid1.txt&#039;, $pid);
				$tabusers=&#039;tabusers&#039;;
				$tablotteryusers=&#039;tablotteryusers&#039;;
				
				$before=&#039;📩📩📩📩📩📩📩📩📩📩📩📩&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$after=&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📩📩📩📩📩📩📩📩📩📩📩📩&#039;;
				
				$query=mysqli_query($con_sql2, &#039;SELECT chatid, firstname, lastname, username FROM &#039;.$tablotteryusers.&#039;&#039;);
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$allusers=$con;
				$tosend=$con;
				$sent=0;
				$percent=0;
				$percent1=0;
				$notsent=0;
				
				$data=file(&#039;&#039;.dirname(__FILE__).&#039;/messidmailing.txt&#039;);
				
				$mainparse=explode(&#039;,&#039;, $data[0]);
				$messageid=$mainparse[0];
				$fromchatid=$mainparse[1];
				
				
				$textbadall="";
				
				$merge=[];
				$merge[] = [[&#039;text&#039; => &#039;⏹Остановить рассылку&#039;, &#039;callback_data&#039; => &#039;users_mailing_stop&#039;]];
				
				$row=[];
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				
					$chatiduser=$row[$i][0];
					$firstname=$row[$i][1];
					$lastname=$row[$i][2];
					$username=$row[$i][3];

					
					$result=json_decode($bot->api->copyMessage([
					&#039;chat_id&#039; => $chatiduser,
					&#039;from_chat_id&#039; => $fromchatid,
					&#039;message_id&#039; => $messageid,
					&#039;parse_mode&#039;=> &#039;HTML&#039;
					]), true);
					usleep(250000);
		
					if($result[&#039;ok&#039;])
					{
						$sent=$sent+1;
						$tosend=$tosend-1;
						$percent=($sent/$allusers)*100;
						$percent=round($percent, 2);
						
						$textall="";
						$text=&#039;&#039;.$before.&#039;📈<b>Рассылка участникам розыгрыша в процессе!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
						if($percent==0)
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
						}
						else
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
						}
						
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						
						if($percent1==0)
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
						}
						else
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
						}
				
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;

		
						foreach($data as $dataparse)
						{
							$dataparse=explode(&#039;,&#039;, $dataparse);
					
							$messidadm=$dataparse[2];
							$chatidadm=$dataparse[3];
							
							$bot->api->editMessageText([
							&#039;chat_id&#039; => $chatidadm,
							&#039;message_id&#039; => $messidadm,
							&#039;text&#039; => $textall,
							&#039;reply_markup&#039; => json_encode([&#039;inline_keyboard&#039;=>$merge]),
							&#039;parse_mode&#039; => &#039;HTML&#039;,
							]);
							
							usleep(150000);
						}
					
					}
					else
					{
						$notsent=$notsent+1;
						$tosend=$tosend-1;
						
						$percent1=($notsent/$allusers)*100;
						$percent1=round($percent1, 2);
						
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
						
							
						if(empty($lenusername))
						{
							$putuser=$firstname;
							
							if(!empty($lastname))
							{
								$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
							}
						}
						elseif($lenusername<$lenfio)
						{
							$putuser=$username;
						}
						elseif($lenusername>$lenfio)
						{
							$putuser=$firstname;
							
							if(!empty($lastname))
							{
								$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
							}
						}
						elseif($lenusername==$lenfio)
						{
							$putuser=$username;
						}
						
						
						$textbad=&#039;<a href="tg://user?id=&#039;.$chatiduser.&#039;">&#039;.$putuser.&#039;</a>&#039;;
					
						if($i==0)
						{
							$textbadall=$textbad;
						}
						else
						{
							$textbadall=$textbadall . &#039;, &#039;.$textbad.&#039;&#039;;
						}
						
						
						
						$textall="";
						$text=&#039;&#039;.$before.&#039;📈<b>Рассылка участникам розыгрыша в процессе!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
						if($percent==0)
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
						}
						else
						{
							$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
						}
						
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						
						if($percent1==0)
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
						}
						else
						{
							$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
						}
				
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;
						
						
						foreach($data as $dataparse)
						{
							$dataparse=explode(&#039;,&#039;, $dataparse);
					
							$messidadm=$dataparse[2];
							$chatidadm=$dataparse[3];
							
							$bot->api->editMessageText([
							&#039;chat_id&#039; => $chatidadm,
							&#039;message_id&#039; => $messidadm,
							&#039;text&#039; => $textall,
							&#039;reply_markup&#039; => json_encode([&#039;inline_keyboard&#039;=>$merge]),
							&#039;parse_mode&#039; => &#039;HTML&#039;,
							]);
							
							usleep(150000);
						}
						
						
						
						
					}
					
				}
				
				$textall="";
				$text=&#039;&#039;.$before.&#039;📈<b>Рассылка участникам розыгрыша завершена!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				if($percent==0)
				{
					$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
				}
				else
				{
					$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
				}
				
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				
				if($percent1==0)
				{
					$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
				}
				else
				{
					$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
				}
		
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;
		
				foreach($data as $dataparse)
				{
					$dataparse=explode(&#039;,&#039;, $dataparse);
				
					$messidadm=$dataparse[2];
					$chatidadm=$dataparse[3];
					
					$bot->api->editMessageText([
					&#039;chat_id&#039; => $chatidadm,
					&#039;message_id&#039; => $messidadm,
					&#039;text&#039; => $textall,
					&#039;parse_mode&#039; => &#039;HTML&#039;,
					]);
					
					usleep(150000);
				}	
				
				
				$text=&#039;<b>Рассылка участникам розыгрыша завершена!</b>&#039;;
				
				foreach($data as $dataparse)
				{
					$dataparse=explode(&#039;,&#039;, $dataparse);
					
					$messidadm=$dataparse[2];
					$chatidadm=$dataparse[3];
					
					$bot->api->unpinChatMessage([
					&#039;chat_id&#039; => $chatidadm,
					&#039;message_id&#039;=> $messidadm
					]);
					
					usleep(150000);
					
					$bot->api->sendMessage([
					&#039;chat_id&#039; => $chatidadm,
					&#039;text&#039; => $text,
					//&#039;disable_notification&#039; => TRUE,
					//&#039;disable_web_page_preview&#039; => TRUE,
					&#039;parse_mode&#039;=> "HTML"
					]);
					
					usleep(150000);
				}
				
				$bot->cmd_delete_mailing();
				';
				
				
				
				file_put_contents(''.dirname(__FILE__).'/mailing.php', html_entity_decode($insert, ENT_QUOTES) . PHP_EOL);
				sleep(1);
				shell_exec('php '.dirname(__FILE__).'/mailing.php > /dev/null 2>/dev/null &');
				sleep(1);
			}
			else
			{
				
				$text='<b>В данный момент уже есть текущая рассылка, вы не можете начать новую!</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				
				
			}
		

	}




/////
	public function cmd_messagenotlotteryusers()
	{
		
			$con_sql2=$this->cmd_sql();
			
			$chatidadmin=$this->api->chatId;
			$fromchatid=$this->api->chatId;
			$tabserviceadmin='tabserviceadmin';
			$messageid=$this->api->messageid;
			$tabusers='tabusers';
			$tabadmin='tabadmin';
			$tablotteryusers='tablotteryusers';
			$tabusers='tabusers';
	
			
			if(file_exists(''.dirname(__FILE__).'/mailing.php')==FALSE)
			{

				mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
				usleep(250000);
				
				$query=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabusers.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$a=0;
				$row=[];
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
					$userchatid=$row[$i][0];
					
					if($this->cmd_sql_searchchatidtable($userchatid, $tablotteryusers)==FALSE)
					{
						$a++;
					}
				}
				
				
				
				$usersquan=$a;
				
				$before='📩📩📩📩📩📩📩📩📩📩📩📩'.PHP_EOL.''.PHP_EOL.'';
				$after=''.PHP_EOL.''.PHP_EOL.'📩📩📩📩📩📩📩📩📩📩📩📩';
				
				$text=''.$before.'📈<b>Рассылка не участникам розыгрыша запущена!</b>'.PHP_EOL.''.PHP_EOL.'<i>Отправлено: 0 из '.$usersquan.''.PHP_EOL.'Осталось отправить: '.$usersquan.''.PHP_EOL.'Не удалось отправить: 0'.$after.'</i>';
				
				$merge=[];
				$merge[] = [['text' => '⏹Остановить рассылку', 'callback_data' => 'users_mailing_stop']];
				
				$result=json_decode($this->api->sendMessage([
				'chat_id' => $chatidadmin,
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$merge]),	
				'parse_mode'=> 'HTML'
				]), true);
				usleep(250000);
				
				$messageidadmin=$result['result']['message_id'];
				
				$this->api->pinChatMessage([
				'chat_id' => $chatidadmin,
				'message_id'=> $messageidadmin
				]);
				usleep(250000);
				
				$putdata=''.$messageid.','.$fromchatid.','.$messageidadmin.','.$chatidadmin.'';
				
				file_put_contents(''.dirname(__FILE__).'/messidmailing.txt', $putdata);
				usleep(150000);
				
				/* $query5=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabadmin.'');
				usleep(250000);
				$con5=mysqli_num_rows($query5);
			
				$row5=[];
				for($i5=0;$i5<$con5;$i5++)
				{
					mysqli_data_seek($query5, $i5);
					$row5[$i5]=mysqli_fetch_row($query5);
				
					$chatidadm=$row5[$i5][0];
					
					$result=json_decode($this->api->sendMessage([
					'chat_id' => $chatidadm,
					'text' => $text,
					'reply_markup' => json_encode(['inline_keyboard'=>$merge]),	
					'parse_mode'=> 'HTML'
					]), true);
					usleep(250000);
					
					$messageidadm=$result['result']['message_id'];
					
					$this->api->pinChatMessage([
					'chat_id' => $chatidadm,
					'message_id'=> $messageidadm
					]);
					
					
					$putdata=''.$messageid.','.$fromchatid.','.$messageidadm.','.$chatidadm.'';
					file_put_contents(''.dirname(__FILE__).'/messidmailing.txt', $putdata . PHP_EOL,FILE_APPEND);
					usleep(100000);
				} */
				
						
				$insert='<?php
				
				set_time_limit(0);
				
				include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
				
				$bot = new DataBot();
				
				$con_sql2=$bot->cmd_sql();
				
				date_default_timezone_set(&#039;Europe/Kiev&#039;);
				
				$pid=getmypid();
				
				file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/pid1.txt&#039;, $pid);
				$tabusers=&#039;tabusers&#039;;
				$tablotteryusers=&#039;tablotteryusers&#039;;
				
				$before=&#039;📩📩📩📩📩📩📩📩📩📩📩📩&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$after=&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📩📩📩📩📩📩📩📩📩📩📩📩&#039;;
				
				$data=file(&#039;&#039;.dirname(__FILE__).&#039;/messidmailing.txt&#039;);
				$mainparse=explode(&#039;,&#039;, $data[0]);
				$messageid=$mainparse[0];
				$fromchatid=$mainparse[1];
			
				$textbadall="";
				
				$merge=[];
				$merge[] = [[&#039;text&#039; => &#039;⏹Остановить рассылку&#039;, &#039;callback_data&#039; => &#039;users_mailing_stop&#039;]];
				
				
				$query=mysqli_query($con_sql2, &#039;SELECT chatid FROM &#039;.$tabusers.&#039;&#039;);
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$a=0;
				$row=[];	
				for($i=0;$i<$con;$i++)
				{
	
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
					$userchatid=$row[$i][0];
					
					if($bot->cmd_sql_searchchatidtable($userchatid, $tablotteryusers)==FALSE)
					{
						$a++;
					}
				}
				
				
				
				
				$allusers=$a;
				$tosend=$a;
				$sent=0;
				$percent=0;
				$percent1=0;
				$notsent=0;
				
				$query=mysqli_query($con_sql2, &#039;SELECT chatid, firstname, lastname, username FROM &#039;.$tabusers.&#039;&#039;);
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				$row=[];
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				
					$chatiduser=$row[$i][0];
					$firstname=$row[$i][1];
					$lastname=$row[$i][2];
					$username=$row[$i][3];

					
					if($bot->cmd_sql_searchchatidtable($chatiduser, $tablotteryusers)==FALSE)
					{
						$result=json_decode($bot->api->copyMessage([
						&#039;chat_id&#039; => $chatiduser,
						&#039;from_chat_id&#039; => $fromchatid,
						&#039;message_id&#039; => $messageid,
						&#039;parse_mode&#039;=> &#039;HTML&#039;
						]), true);
						usleep(250000);
			
			
						if($result[&#039;ok&#039;])
						{
							$sent=$sent+1;
							$tosend=$tosend-1;
							$percent=($sent/$allusers)*100;
							$percent=round($percent, 2);
							
							$textall="";
							$text=&#039;&#039;.$before.&#039;📈<b>Рассылка не участникам розыгрыша в процессе!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
					
							if($percent==0)
							{
								$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
							}
							else
							{
								$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
							}
							
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
							
							$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
							
							
							if($percent1==0)
							{
								$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
							}
							else
							{
								$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
							}
					
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
							$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;
	
			
							foreach($data as $dataparse)
							{
								$dataparse=explode(&#039;,&#039;, $dataparse);
						
								$messidadm=$dataparse[2];
								$chatidadm=$dataparse[3];
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $chatidadm,
								&#039;message_id&#039; => $messidadm,
								&#039;text&#039; => $textall,
								&#039;reply_markup&#039; => json_encode([&#039;inline_keyboard&#039;=>$merge]),
								&#039;parse_mode&#039; => &#039;HTML&#039;,
								]);
								
								usleep(250000);
							}
						}
						else
						{
							$notsent=$notsent+1;
							$tosend=$tosend-1;
							
							$percent1=($notsent/$allusers)*100;
							$percent1=round($percent1, 2);
							
							
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
							
								
							if(empty($lenusername))
							{
								$putuser=$firstname;
								
								if(!empty($lastname))
								{
									$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
								}
							}
							elseif($lenusername<$lenfio)
							{
								$putuser=$username;
							}
							elseif($lenusername>$lenfio)
							{
								$putuser=$firstname;
								
								if(!empty($lastname))
								{
									$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
								}
							}
							elseif($lenusername==$lenfio)
							{
								$putuser=$username;
							}
						
							$textbad=&#039;<a href="tg://user?id=&#039;.$chatiduser.&#039;">&#039;.$putuser.&#039;</a>&#039;;
						
							if($i==0)
							{
								$textbadall=$textbad;
							}
							else
							{
								$textbadall=$textbadall . &#039;, &#039;.$textbad.&#039;&#039;;
							}
							
							
							
							$textall="";
							$text=&#039;&#039;.$before.&#039;📈<b>Рассылка не участникам розыгрыша в процессе!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
					
							if($percent==0)
							{
								$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
							}
							else
							{
								$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
							}
							
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
							
							$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
							
							
							if($percent1==0)
							{
								$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
							}
							else
							{
								$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
							}
					
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
							$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;
							
							

							foreach($data as $dataparse)
							{
								$dataparse=explode(&#039;,&#039;, $dataparse);
						
								$messidadm=$dataparse[2];
								$chatidadm=$dataparse[3];
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $chatidadm,
								&#039;message_id&#039; => $messidadm,
								&#039;text&#039; => $textall,
								&#039;reply_markup&#039; => json_encode([&#039;inline_keyboard&#039;=>$merge]),
								&#039;parse_mode&#039; => &#039;HTML&#039;,
								]);
								
								usleep(250000);
							}
						}
					}
				}
				
				$textall="";
				$text=&#039;&#039;.$before.&#039;📈<b>Рассылка не участникам розыгрыша завершена!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				if($percent==0)
				{
					$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039;&#039;.PHP_EOL.&#039;&#039;;
				}
				else
				{
					$text=&#039;Отправлено: &#039;.$sent.&#039; из &#039;.$allusers.&#039; (&#039;.$percent.&#039;%)&#039;.PHP_EOL.&#039;&#039;;
				}
				
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				$text=&#039;Осталось отправить: &#039;.$tosend.&#039;&#039;.PHP_EOL.&#039;&#039;;
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				
				
				if($percent1==0)
				{
					$text=&#039;Не удалось отправить: &#039;.$notsent.&#039;&#039;.$after.&#039;&#039;;
				}
				else
				{
					$text=&#039;Не удалось отправить: &#039;.$notsent.&#039; (&#039;.$percent1.&#039;%&#039;.$textbadall.&#039;)&#039;.$after.&#039;&#039;;
				}
		
				$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
				$textall=&#039;<i>&#039;.$textall.&#039;</i>&#039;;
		
				foreach($data as $dataparse)
				{
					$dataparse=explode(&#039;,&#039;, $dataparse);
				
					$messidadm=$dataparse[2];
					$chatidadm=$dataparse[3];
					
					$bot->api->editMessageText([
					&#039;chat_id&#039; => $chatidadm,
					&#039;message_id&#039; => $messidadm,
					&#039;text&#039; => $textall,
					&#039;parse_mode&#039; => &#039;HTML&#039;,
					]);
					
					usleep(250000);
				}	
				
				
				$text=&#039;<b>Рассылка не участникам розыгрыша завершена!</b>&#039;;
				
				foreach($data as $dataparse)
				{
					$dataparse=explode(&#039;,&#039;, $dataparse);
					
					$messidadm=$dataparse[2];
					$chatidadm=$dataparse[3];
					
					$bot->api->unpinChatMessage([
					&#039;chat_id&#039; => $chatidadm,
					&#039;message_id&#039;=> $messidadm
					]);
					
					usleep(250000);
					
					$bot->api->sendMessage([
					&#039;chat_id&#039; => $chatidadm,
					&#039;text&#039; => $text,
					//&#039;disable_notification&#039; => TRUE,
					//&#039;disable_web_page_preview&#039; => TRUE,
					&#039;parse_mode&#039;=> "HTML"
					]);
					usleep(250000);
				}
				
				$bot->cmd_delete_mailing();
				';
				
				
				
				file_put_contents(''.dirname(__FILE__).'/mailing.php', html_entity_decode($insert, ENT_QUOTES) . PHP_EOL);
				sleep(2);
				shell_exec('php '.dirname(__FILE__).'/mailing.php > /dev/null 2>/dev/null &');
				sleep(1);
			}
			else
			{
				
				$text='<b>В данный момент уже есть текущая рассылка, вы не можете начать новую!</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				
				
			}

	}



/////
	public function cmd_messageuserbyid()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadmin='tabserviceadmin';
		
		$chatiduser=$this->api->textmessage;
		
		$tabusers='tabusers';
		
		if(preg_match('/\d{9,15}/', $chatiduser) && $this->cmd_sql_searchchatidtable($chatiduser, $tabusers))
		{
		
			file_put_contents(''.dirname(__FILE__).'/chatiduser.txt', $chatiduser);
		
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("messageuserbyidsend")');
			usleep(250000);
			
			$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$tabusers.' WHERE chatid="'.$chatiduser.'"');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$userfirstname=$row[0][0];
			$userlastname=$row[0][1];
			$userusername=$row[0][2];
			
			if(!empty($userusername))
			{
				if(!empty($userlastname))
				{
					$text='Пришлите сообщение, которое хотите отправить пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.' '.$userlastname.'</a> ('.$userusername.') с ID <b>'.$chatiduser.'</b>';
				}
				else
				{
					$text='Пришлите сообщение, которое хотите отправить пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.'</a> ('.$userusername.') с ID <b>'.$chatiduser.'</b>';
				}
			}
			else
			{
				if(!empty($userlastname))
				{
					$text='Пришлите сообщение, которое хотите отправить пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.' '.$userlastname.'</a> с ID <b>'.$chatiduser.'</b>';
				}
				else
				{
					$text='Пришлите сообщение, которое хотите отправить пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.'</a> с ID <b>'.$chatiduser.'</b>';
				}
			}
			
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='<b>Вы ввели несуществующий ID, пожалуйста пришлите правильный ID пользователя</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}

/////
	public function cmd_messageuserbyidsend()
	{	
		$con_sql2=$this->cmd_sql();
		
		$fromchatid=$this->api->chatId;
		$tabserviceadmin='tabserviceadmin';
		$messageid=$this->api->messageid;
		$tabusers='tabusers';
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
		usleep(250000);
		
		$chatiduser=file_get_contents(''.dirname(__FILE__).'/chatiduser.txt');
		unlink(''.dirname(__FILE__).'/chatiduser.txt');
		
		
		$result=json_decode($this->api->copyMessage([
		'chat_id' => $chatiduser,
		'from_chat_id' => $fromchatid,
		'message_id' => $messageid,
		'parse_mode'=> 'HTML'
		]), true);
		usleep(250000);
		
		if($result['ok'])
		{
			$query=mysqli_query($con_sql2, 'SELECT firstname, lastname, username FROM '.$tabusers.' WHERE chatid="'.$chatiduser.'"');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$userfirstname=$row[0][0];
			$userlastname=$row[0][1];
			$userusername=$row[0][2];
			
			if(!empty($userusername))
			{
				if(!empty($userlastname))
				{
					$text='Вы <b>успешно отправили</b> сообщение пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.' '.$userlastname.'</a> ('.$userusername.') с ID <b>'.$chatiduser.'</b>';
				}
				else
				{
					$text='Вы <b>успешно отправили</b> сообщение пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.'</a> ('.$userusername.') с ID <b>'.$chatiduser.'</b>';
				}
			}
			else
			{
				if(!empty($userlastname))
				{
					$text='Вы <b>успешно отправили</b> сообщение пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.' '.$userlastname.'</a> с ID <b>'.$chatiduser.'</b>';
				}
				else
				{
					$text='Вы <b>успешно отправили</b> сообщение пользователю <a href="tg://user?id='.$chatiduser.'">'.$userfirstname.'</a> с ID <b>'.$chatiduser.'</b>';
				}
			}
			
			
			$this->api->sendMessage([
			'chat_id' => $fromchatid,
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Ваше сообщение <b>не было доставлено</b> пользователю с ID <b>'.$chatiduser.'</b>';
			
			$this->api->sendMessage([
			'chat_id' => $fromchatid,
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
	}	
		






/////
	public function callback_mailing_stop_confirm_no()
	{
		if($this->cmd_isadmin())
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$text='<b>Вы отменили остановку текущей рассылки пользователям, рассылка продолжается</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}


/////
	public function callback_mailing_stop_confirm_yes()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$chatid=$this->api->chatId;
			$firstname=$this->api->firstname;
			
			if(isset($this->api->lastname))
			{
				$lastname=$this->api->lastname;
			}
			else
			{
				$lastname="0";
			}
			
			if(isset($this->api->username))
			{
				$username='@'.$this->api->username.'';
			}
			else
			{
				$username="нет имени пользователя";
			}
			

			if(!empty($lastname))
			{
				$adminstop=''.$firstname.' '.$lastname.' ('.$username.')';
			}
			else
			{
				$adminstop=''.$firstname.' ('.$username.')';
			}
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$pid1=file_get_contents(''.dirname(__FILE__).'/pid1.txt');
			shell_exec('kill -9 '.$pid1.'');
			sleep(1);
			
			$data=file(''.dirname(__FILE__).'/messidmailing.txt');
				
			$text='Текущая рассылка была остановлена администратором <b>'.$adminstop.'</b>';
			
			foreach($data as $dataparse)
			{
				$dataparse=explode(',', $dataparse);
				
				$messidadm=$dataparse[2];
				$chatidadm=$dataparse[3];
				
				$this->api->unpinChatMessage([
				'chat_id' => $chatidadm,
				'message_id'=> $messidadm
				]);
				usleep(250000);
				
				$this->api->sendMessage([
				'chat_id' => $chatidadm,
				'text' => $text,
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(250000);
			}
			
			if(file_exists(''.dirname(__FILE__).'/pid1.txt'))
			{
				unlink(''.dirname(__FILE__).'/pid1.txt');
			}
				
			if(file_exists(''.dirname(__FILE__).'/mailing.php'))
			{
				unlink(''.dirname(__FILE__).'/mailing.php');
			}
			
			if(file_exists(''.dirname(__FILE__).'/messidmailing.txt'))
			{
				unlink(''.dirname(__FILE__).'/messidmailing.txt');
			}
		
		}
	}
	
	
/////
	public function callback_users_mailing_stop()
	{
		if($this->cmd_isadmin())
		{	
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
		
			
			if(file_exists(''.dirname(__FILE__).'/mailing.php'))
			{
		
				$text='<b>Вы точно хотите остановить рассылку?</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['mailing_stop_confirm']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);

			}
			else
			{
				$text='<b>В данный момент нет запущенной рассылки, нечего останавливать!</b>';
			
				$this->api->editMessageText([
				'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
				'message_id' => $this->api->body['callback_query']['message']['message_id'],
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
				'parse_mode' => "HTML"
				]);
			}
		}
	}
	
	
	
/////
	public function cmd_delete_mailing()
	{
		if(file_exists(''.dirname(__FILE__).'/pid1.txt'))
		{
			unlink(''.dirname(__FILE__).'/pid1.txt');
		}
			
		if(file_exists(''.dirname(__FILE__).'/mailing.php'))
		{
			unlink(''.dirname(__FILE__).'/mailing.php');
		}
		
		if(file_exists(''.dirname(__FILE__).'/messidmailing.txt'))
		{
			unlink(''.dirname(__FILE__).'/messidmailing.txt');
		}
		
	}








/////////////////////////////////MODELLING////////////////////////////////////////
/////
	public function callback_admin_lottery_modelling()
	{
		
			if(file_exists(''.dirname(__FILE__).'/modelling.txt')==FALSE)
			{
				//touch(''.dirname(__FILE__).'/modelling.txt');
				file_put_contents(''.dirname(__FILE__).'/modelling.txt', $this->api->chatId); 
				sleep(1);
				
				shell_exec('php '.dirname(__FILE__).'/resultsgenerator.php > /dev/null 2>/dev/null &');
				usleep(500000);
				
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
			
				$text='Вы <b>успешно отправили</b> запрос на моделирование результатов розыгрыша.';
			
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				
				
			}
			else
			{
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
				
				$text='В данный момент <b>уже отправлен запрос</b> на моделирование результатов розыгрыша. Дождитесь ответа.';
			
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_change']]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			
	
	}
	
	
	
	
	
	
	
	
	
	
//////////////////////////////////////////////////////FINISH///////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function cmd_lottery_finish()
	{	
		if(file_exists(''.dirname(__FILE__).'/resultsfirst.txt')==FALSE)
		{
			touch(''.dirname(__FILE__).'/resultsfirst.txt');
			
			shell_exec('php '.dirname(__FILE__).'/resultsgenerator.php > /dev/null 2>/dev/null &');
			sleep(1);
			
			shell_exec('php '.dirname(__FILE__).'/statistics.php > /dev/null 2>/dev/null &');
			sleep(1);
		}
	}




/////
	public function cmd_lottery_change_complete_results()
	{

		shell_exec('php '.dirname(__FILE__).'/resultsgenerator.php > /dev/null 2>/dev/null &');
		sleep(1);
		
	}



/////
	public function callback_lottery_change_generate()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(file_exists(''.dirname(__FILE__).'/resultsgenerate.txt')==FALSE)
		{
			touch(''.dirname(__FILE__).'/resultsgenerate.txt');
			
			shell_exec('php '.dirname(__FILE__).'/resultsgenerator.php > /dev/null 2>/dev/null &');
			sleep(1);
		}
	}


	


/////
	public function callback_finish_lottery_confirm_no()
	{	
		$con_sql2=$this->cmd_sql();
		
		$chatidadmin=$this->chatidadmin;
		$tabserviceadmin='tabserviceadmin';
		$tabresults='tabresults';
		$tabresultsreserve='tabresultsreserve';
		
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		$text='<b>Выберите, что вы хотите изменить в результатах</b>👇';
		
		$this->api->sendMessage([
		'chat_id' => $chatidadmin,
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_change_results']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}




//////////////////////////////CONFIRM YES//////////////////////////////
/////
	public function callback_finish_lottery_confirm_yes()
	{	
		
		$con_sql2=$this->cmd_sql();
		
		$channelid=$this->mainchannel();
		$chatidadmin=$this->chatidadmin;
		$tablottery='tablottery';
		$tabresults='tabresults';
		
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$query4=mysqli_query($con_sql2, 'SELECT startdate, messid, lotteryname, photos, topplaces, fakeplaces FROM '.$tablottery.'');
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
		
		
		/////////////////////MAIN CHANNEL///////////////////
		
		if($this->cmd_if_empty($tabresults)==FALSE)
		{
		
			$textfinish='👇<b>Результаты розыгрыша</b> "'.$lotteryname.'"!!👇'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			
			
			
			$query=mysqli_query($con_sql2, 'SELECT chatid, firstname, lastname, username, tickets, place FROM '.$tabresults.' ORDER BY place + 0 ASC');
			usleep(650000);
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
					
					$result=json_decode($this->api->sendMessage([
					'chat_id' => $channelid,
					'text' => $textfinish,
					'parse_mode'=> 'HTML'
					]), true);
					usleep(250000);
					
					if(empty($mesidresults))
					{
						$mesidresults=$result['result']['message_id'];
					}
					
					$this->api->pinChatMessage([
					'chat_id' => $channelid,
					'message_id'=> $mesidresults
					]);
					usleep(250000);
	
					$textfinish="";
				}
			}
			
			if(!empty($textfinish))
			{
		
				$result=json_decode($this->api->sendMessage([
				'chat_id' => $channelid,
				'text' => $textfinish,
				'parse_mode'=> 'HTML'
				]), true);
				usleep(250000);
				
				$mesidresul=$result['result']['message_id'];
				
				if(empty($mesidresults))
				{
					$mesidresults=$mesidresul;
				}
				
				$this->api->pinChatMessage([
				'chat_id' => $channelid,
				'message_id'=> $mesidresul
				]);
				usleep(250000);
			}
			
			
			$result=json_decode($this->api->getChat([
			'chat_id' => $channelid
			]), true);
			
			$channelusername=$result['result']['username'];
			
			$resultsurl='https://t.me/'.$channelusername.'/'.$mesidresults.'';
			
			$merge = [  [['text' => 'Посмотреть результаты', 'url' => $resultsurl]] ];
			
			
			$textall="";
			$text='<b>Розыгрыш</b> "'.$lotteryname.'" <b>завершен!</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
			
			$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
			$textall=$textall . ''.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';
			
			if($photo!="0")
			{
				$text='<a href="'.$photo.'">&#160;</a>';
				$textall=$textall . ''.$text.'';
			}
			
			$this->api->editMessageText([
				'chat_id' => $channelid,
				'message_id' => $messageidchannel,
				'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
				'text' => $textall,
				'parse_mode' => "HTML",
			]);
			
			usleep(250000);
			////////////////END MAIN CHANNEL///////////////
			
			
			$textadmin='<b>Розыгрыш</b> "'.$lotteryname.'" <b>был успешно завершен!</b>'.PHP_EOL.''.PHP_EOL.'После уведомления всех участников, админам будет выслан отчет с результатами розыгрыша и финальной статистикой.';
			
			$this->api->sendMessage([
			'chat_id' => $chatidadmin,
			'text' => $textadmin,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			if(file_exists(''.dirname(__FILE__).'/resultsfinish.txt')==FALSE)
			{
				file_put_contents(''.dirname(__FILE__).'/resultsfinish.txt', $resultsurl);
				
				shell_exec('php '.dirname(__FILE__).'/resultsfinish.php > /dev/null 2>/dev/null &');
				sleep(1);
			}
		}	
		else
		{

			$textall="";
			$text='<b>Розыгрыш</b> "'.$lotteryname.'" <b>завершен!</b>'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'';
			$textall=$textall . ''.$text.'';
			
			$lotterytext=file_get_contents(''.dirname(__FILE__).'/lotterytext.txt');
			$textall=$textall . ''.$lotterytext.''.PHP_EOL.''.PHP_EOL.'';
			
			$text='<b>Очень жаль, что в розыгрыше нет победителей!</b>';
			$textall=$textall . ''.$text.''.PHP_EOL.''.PHP_EOL.'';
			
			if($photo!="0")
			{
				$text='<a href="'.$photo.'">&#160;</a>';
				$textall=$textall . ''.$text.'';
			}
			
			$this->api->editMessageText([
				'chat_id' => $channelid,
				'message_id' => $messageidchannel,
				//'reply_markup' => json_encode(['inline_keyboard'=>$merge]),
				'text' => $textall,
				'parse_mode' => "HTML",
			]);
			
			usleep(250000);
			////////////////END MAIN CHANNEL///////////////
			
			
			$textadmin='<b>Розыгрыш</b> "'.$lotteryname.'" <b>был завершен!</b>'.PHP_EOL.''.PHP_EOL.'К сожалению, в розыгрыше нет победителей!';
			
			$this->api->sendMessage([
			'chat_id' => $chatidadmin,
			'text' => $textadmin,
			//'reply_markup' => json_encode($this->keyboards['default_admin']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			if(file_exists(''.dirname(__FILE__).'/resultsfinish.txt')==FALSE)
			{
				touch(''.dirname(__FILE__).'/resultsfinish.txt');
				
				shell_exec('php '.dirname(__FILE__).'/resultsfinish.php > /dev/null 2>/dev/null &');
				sleep(1);
			}
		}			
			
			
			
		
		

		//shell_exec('php '.dirname(__FILE__).'/statistics.php > /dev/null 2>/dev/null &');
		//sleep(1);
		
		
		

	}


/////	
	public function callback_lottery_change_manual_results()
	{	
		$con_sql2=$this->cmd_sql();
		
		$chatidadmin=$this->chatidadmin;
		$tabserviceadmin='tabserviceadmin';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if($this->cmd_if_exists($tabserviceadmin)==false)
		{
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabserviceadmin.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(35)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfinish")');
			usleep(250000);
		}
		else
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(250000);
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("lotteryfinish")');
			usleep(250000);
		}
		
		
		$text='<b>Введите все фейковые призовые места вручную</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
		
		$this->api->sendMessage([
		'chat_id' => $chatidadmin,
		'text' => $text,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['usersmessage']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
	

/////
	public function cmd_lottery_admin_finish()
	{
		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			$channelid=$this->mainchannel();
			$chatid=$this->api->chatId;
			$tabservicelottery='tabservicelottery';
			$tablottery='tablottery';
			$tablotteryusers='tablotteryusers';
			$tabresults='tabresults';
			$tabresultsreserve='tabresultsreserve';
			
			$tabserviceadmin='tabserviceadmin';
			$textmessage=$this->api->textmessage;
		
		
			if(preg_match('/^\s{0,}((\d{1,5}-@)(\w{1,30},)(\s{0,})){0,}((\d{1,5}-@)(\w{1,30}))(\s{0,})\Z/', $textmessage) || preg_match('/\d{1,5}-\d{8,12}/', $textmessage) || $textmessage=="0")
			{
				$query=mysqli_query($con_sql2, 'SELECT topplaces FROM '.$tablottery.'');
				usleep(250000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				
				$topplaces=$row[0][0];
				
				
				$query11=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
				usleep(200000);
				
				$lotusers=mysqli_num_rows($query11);
				
				if($lotusers<$topplaces || $lotusers==$topplaces)
				{
					$topplaces=$lotusers;
				}
				
				$topcompare=substr_count($textmessage, ',');
				$topcompare=$topcompare+1;
				
				if($topcompare==$topplaces)
				{
				
					if(strlen($textmessage)>4000)
					{
						$text='<b>Вы ввели неправильный формат!</b>'.PHP_EOL.''.PHP_EOL.'<b>Введите все фейковые призовые места</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
						
						$this->api->sendMessage([
						'text' => $text,
						//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					}
					else
					{
						mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceadmin.'');
						usleep(250000);	
						
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tablottery.'');
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						/* if($row[0][11]!="0")
						{
							if(file_exists(''.dirname(__FILE__).'/resultsfake.txt')==FALSE)
							{
								touch(''.dirname(__FILE__).'/resultsfake.txt');
							}
						} */
						
						//mysqli_query($con_sql2, 'UPDATE '.$tablottery.' SET fakeplaces = REPLACE(fakeplaces, "'.$row[0][11].'", "'.html_entity_decode($textmessage, ENT_SUBSTITUTE).'") WHERE id="'.$row[0][0].'"');
						//usleep(250000);
						mysqli_query($con_sql2, 'UPDATE '.$tablottery.' SET fakeplaces = REPLACE(fakeplaces, "'.$row[0][11].'", "'.$textmessage.'")');
						usleep(250000);
						
						
						$this->cmd_lottery_change_complete_results();

					}
				}
				else
				{
					$text='<b>Вы прислали не все фейковые призовые места!</b>'.PHP_EOL.''.PHP_EOL.'Общее количество призовых мест - <i>'.$topplaces.'</i>.'.PHP_EOL.''.PHP_EOL.'<b>Введите все фейковые призовые места</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
					
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
			}
			else
			{
				
				$text='<b>Вы ввели неправильный формат!</b>'.PHP_EOL.''.PHP_EOL.'<b>Введите все фейковые призовые места</b>, не более 4000 символов в формате: '.PHP_EOL.''.PHP_EOL.'<i>1-xxx,2-xxx,3-xxx</i> и т.д.,'.PHP_EOL.''.PHP_EOL.'где <i>xxx</i> - имя пользователя или чат id телеграм.👇';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
		}
	}



public function cmd_lottery_archieve()
{

	
		$con_sql2=$this->cmd_sql();
		
		
		$mainchannel=$this->mainchannel();
		
		$tablottery='tablottery';
		$tabservicelottery='tabservicelottery';
		$tabserviceadmin='tabserviceadmin';
		$tabadminchange='tabadminchange';
		$tabhistorylottery='tabhistorylottery';
		
		if($this->cmd_if_exists($tabhistorylottery))
		{
			
			$text='Выберите <b>название розыгрыша</b>👇';
			
								
			$merge=$this->cmd_lottery_archieve_choose();
			usleep(250000);

			$merge[] = [['text' => '⤴️Выйти', 'callback_data' => 'create_lottery_exit']];
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

		}
		else
		{
			$text='В данный момент, у Вас <b>нет ни одного завершенного розыгрыша</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}

}



public function cmd_lottery_archieve_choose()
	{	
		if($this->cmd_isadmin())
		{
		$con_sql2=$this->cmd_sql();
		
		$chatid=$this->api->chatId;
		$tabserviceadmin='tabserviceadmin';
		$tabchannels='tabchannels';
		$tabservicelottery='tabservicelottery';
		$tabadminchange='tabadminchange';
		$tabhistorylottery='tabhistorylottery';
		
		$query=mysqli_query($con_sql2, 'SELECT startdate, enddate, lotteryname FROM '.$tabhistorylottery.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$lotnames=[];
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
			$startdate=preg_replace('/ .*/', '', $row[$i][0]);
			$startdate=$this->clean($startdate);
			
			$enddate=preg_replace('/ .*/', '', $row[$i][1]);
			$enddate=$this->clean($enddate);
			
			$lotteryname=$row[$i][2];
			
			$lotnames[]=''.$lotteryname.' ('.$startdate.'-'.$enddate.')';
		}
		
		
		$cnt=count($lotnames);
		$maxbuttons=1;
		$ceil=ceil($cnt/$maxbuttons);
		
		
		
		$include=''.dirname(__FILE__).'/include'.$chatid.'.php';
		
		if(file_exists($include)==FALSE)
		{
			touch($include);
			
			$insert='<?php
		
			class TelegramBotfunc{';
			file_put_contents($include, $insert . PHP_EOL,FILE_APPEND);
			
		}
		else
		{
			$getinclude=file($include);
			unset($getinclude[$this->cmd_array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		
		
		
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				$buttext=''.$lotnames[$u].'';
				
				$buttext1=preg_replace('/\(.*/', '', $lotnames[$u]);
				$buttext1=$this->clean($buttext1);
				
				$tabservicelottery='tabservicelottery';
				
				$put[]=['text' => ''.$buttext.'', 'callback_data' => 'arch_lot_choose_'.$u.''];
				
				if(preg_match('/callback_arch_lot_choose_'.$u.'/', file_get_contents($include))==FALSE)
				{
					$insert='
					public function callback_arch_lot_choose_'.$u.'()
					{
						include_once(&#039;&#039;.dirname(__FILE__).&#039;/DataBot.php&#039;);
						
						$bot = new DataBot();
						$bot->api->getWebhookUpdate();
						
						if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
						{
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							$bot->api->answerCallbackQuery($callback_query_id);
						}
						
						$con_sql2=$bot->cmd_sql();
						
						$query=mysqli_query($con_sql2, &#039;SELECT * FROM '.$tabhistorylottery.' WHERE lotteryname="'.$buttext1.'"&#039;);
						usleep(250000);
						$con=mysqli_num_rows($query);
						
						
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						$textall="";
						
						$text=&#039;<b>Информация о завершенном розыгрыше</b> "&#039;.$row[0][2].&#039;":&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Название розыгрыша - "&#039;.$row[0][2].&#039;"&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Дата начала розыгрыша - <b>&#039;.$row[0][4].&#039;</b>&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Дата окончания розыгрыша - <b>&#039;.$row[0][5].&#039;</b>&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						$text=&#039;Количество призовых мест - <b>&#039;.$row[0][6].&#039;</b>&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						
						if($row[0][7]!="0")
						{
							$text=&#039;Реферальная программа - <b>&#039;.$row[0][7].&#039; чел</b>&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						}
						if($row[0][8]!="0")
						{
							$text=&#039;За депозиты - <b>&#039;.$row[0][8].&#039; Евро</b>&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						}
						if($row[0][9]!="0")
						{
							$text=&#039;За регистрационные данные - <b>&#039;.$row[0][9].&#039;</b>&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						}
						if($row[0][10]!="0")
						{
							$text=&#039;За публикации - <b>&#039;.$row[0][10].&#039;</b>&#039;.PHP_EOL.&#039;&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						}
						
						$text=&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						
						
						
						$lotterytext=file_get_contents(&#039;&#039;.dirname(__FILE__).&#039;/history/lotterytext&#039;.$row[0][0].&#039;.txt&#039;);
						$textall=$textall . &#039;&#039;.$lotterytext.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						
						
						$query6=mysqli_query($con_sql2, &#039;SELECT photos FROM '.$tabhistorylottery.' WHERE lotteryname="'.$buttext.'"&#039;);
						usleep(250000);
						$con6=mysqli_num_rows($query6);
						
						
						for($i6=0;$i6<$con6;$i6++)
						{
							mysqli_data_seek($query6, $i6);
							$row6[$i6]=mysqli_fetch_row($query6);
						}
								
						if($row6[0][0]!="0")
						{
							$text=&#039;<a href="&#039;.$row6[0][0].&#039;">&#160;</a>&#039;;
							$textall=$textall . &#039;&#039;.$text.&#039;&#039;;
						}
						
						$bot->api->sendMessage([
						&#039;text&#039; => $textall,
						//&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
						&#039;parse_mode&#039; => "HTML",
						]);
						
						
						$textfinish=&#039;👇<b>Результаты розыгрыша</b> "&#039;.$row[0][2].&#039;"👇&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;;
						
						$tabhistoryresults=&#039;tabhistoryresults&#039;.$row[0][0].&#039;&#039;;
						
						$query=mysqli_query($con_sql2, &#039;SELECT chatid, firstname, lastname, username, tickets, place FROM &#039;.$tabhistoryresults.&#039;&#039;);
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
								
								$text=&#039;&#039;.$place.&#039; место - &#039;.$putuser.&#039;, билет &#039;.$ticket.&#039;&#039;;
							}
							elseif(empty($lenusername))
							{
								$putuser=$firstname;
								
								if(!empty($lastname))
								{
									$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
								}
								
								$text=&#039;&#039;.$place.&#039; место - <a href="tg://user?id=&#039;.$chatid.&#039;">&#039;.$putuser.&#039;</a>, билет &#039;.$ticket.&#039;&#039;;
							}
							elseif($lenusername<$lenfio)
							{
								$putuser=$username;
								
								$text=&#039;&#039;.$place.&#039; место - &#039;.$putuser.&#039;, билет &#039;.$ticket.&#039;&#039;;
							}
							elseif($lenusername>$lenfio)
							{
								$putuser=$firstname;
								
								if(!empty($lastname))
								{
									$putuser=&#039;&#039;.$firstname.&#039; &#039;.$lastname.&#039;&#039;;
								}
								
								$text=&#039;&#039;.$place.&#039; место - <a href="tg://user?id=&#039;.$chatid.&#039;">&#039;.$putuser.&#039;</a>, билет &#039;.$ticket.&#039;&#039;;
								
							}
							elseif($lenusername==$lenfio)
							{
								$putuser=$username;
								
								$text=&#039;&#039;.$place.&#039; место - &#039;.$putuser.&#039;, билет &#039;.$ticket.&#039;&#039;;
							}
							
							
							$textfinish=$textfinish . &#039;&#039;.$text.&#039;&#039;.PHP_EOL.&#039;&#039;;
							
							if(strlen($textfinish)>3500 && strlen($textfinish)<4000)
							{
								$bot->api->sendMessage([
								
								&#039;text&#039; => $textfinish,
								//&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_change&#039;]]),
								//&#039;disable_notification&#039; => TRUE,
								//&#039;disable_web_page_preview&#039; => TRUE,
								&#039;parse_mode&#039;=> "HTML"
								]);

								$textfinish="";
							}
						}
						
				
						if(!empty($textfinish))
						{
							$bot->api->sendMessage([
							&#039;text&#039; => $textfinish,
							//&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_change&#039;]]),
							//&#039;disable_notification&#039; => TRUE,
							//&#039;disable_web_page_preview&#039; => TRUE,
							&#039;parse_mode&#039;=> "HTML"
							]);
						}

					}';
						
					file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
				}
				
				$u++;	
			}
				
			$merge[]=$put;
			unset($put);
			
		}
		
		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		return $merge;

		}
	}	














////////////////////////////////////////
public function cmd_finish_data_tickets($error, $chatid, $casinoid, $casinofirstname, $casinolastname, $casinophone, $casinoemail, $casinobirthday, $casinodeposit, $casinodepositperiod)
{
	
	///////////////////////USER EXISTS/////////////////////
	if(empty($error))
	{
		$con_sql2=$this->cmd_sql();

		$tabserviceuser='tabserviceuser'.$chatid.'';
		$tabticketsall='tabticketsall';
		$tabcasinousers='tabcasinousers';
		$tabservicelottery='tabservicelottery';
		$tablottery='tablottery';
		$tabadminchange='tabadminchange';
		$tabserviceadmin='tabserviceadmin';
		$tabusers='tabusers';
		$tablotteryusers='tablotteryusers';
		$tabresults='tabresults';
		$tabresultsreserve='tabresultsreserve';
		$tabtempuser='tabtempuser'.$chatid.'';
		$tabtempusererr='tabtempusererr'.$chatid.'';
		
		$tabadmin='tabadmin';
		
		$query1=mysqli_query($con_sql2, 'SELECT parrefer,pardata,pardeposit,parpublic FROM '.$tablottery.'');
		usleep(150000);
		$con1=mysqli_num_rows($query1);
		
		$row1=[];
		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
		}
		
		$parrefer=$row1[0][0];
		$pardata=$row1[0][1];
		$pardeposit=$row1[0][2];
		$parpublic=$row1[0][3];
		
		
		
		if($this->cmd_if_exists($tabcasinousers)==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabcasinousers.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",casinoid VARCHAR(15) DEFAULT "0",firstname VARCHAR(1) DEFAULT "0",lastname VARCHAR(1) DEFAULT "0",phone VARCHAR(1) DEFAULT "0",email VARCHAR(1) DEFAULT "0",deposit VARCHAR(10) DEFAULT "0",lasttime VARCHAR(25) DEFAULT "0",depositquan VARCHAR(1) DEFAULT "0",birthday VARCHAR(1) DEFAULT "0",promocode VARCHAR(10) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
		}


		
		if($this->cmd_sql_searchchatidtable($chatid, $tabcasinousers)==FALSE)	
		{
			if(!empty($parrefer))
			{
				if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'" AND refer!="0" LIMIT 1'))))
				{
					$query3=mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
					usleep(150000);
					$con3=mysqli_num_rows($query3);
						
					for($y=0;$y<$con3;$y++)
					{
						mysqli_data_seek($query3, $y);
						$row3[$y]=mysqli_fetch_row($query3);
					}
					
					$chatidref=$row3[0][0];
					
					if(preg_match('/_/', $chatidref)==FALSE)
					{
						mysqli_query($con_sql2, 'UPDATE '.$tabusers.' SET refer = REPLACE(refer, "'.$row3[0][0].'", "'.$row3[0][0].'_1") WHERE chatid="'.$chatid.'"');
						usleep(250000);
					}
				}
			}
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tabcasinousers.' (chatid,casinoid,firstname,lastname,phone,email,deposit,depositquan,birthday) VALUES ("'.$chatid.'","'.$casinoid.'","'.$casinofirstname.'","'.$casinolastname.'","'.$casinophone.'","'.$casinoemail.'","'.$casinodepositperiod.'","'.$casinodeposit.'","'.$casinobirthday.'")');
			usleep(250000);
			
			$casdepperold=$casinodepositperiod;
			$lasttime="0";
			
		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
			usleep(150000);
			$con=mysqli_num_rows($query);
			
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$casdepperold=$row[0][7];
			$lasttime=$row[0][8];
			
			if($casinofirstname!=$row[0][3])
			{
				mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET firstname = REPLACE(firstname, "'.$row[0][3].'", "'.$casinofirstname.'") WHERE chatid="'.$chatid.'"');
				usleep(100000);
			}
			if($casinolastname!=$row[0][4])
			{
				mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET lastname = REPLACE(lastname, "'.$row[0][4].'", "'.$casinolastname.'") WHERE chatid="'.$chatid.'"');
				usleep(100000);
			}
			if($casinophone!=$row[0][5])
			{
				mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET phone = REPLACE(phone, "'.$row[0][5].'", "'.$casinophone.'") WHERE chatid="'.$chatid.'"');
				usleep(100000);
			}
			if($casinoemail!=$row[0][6])
			{
				mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET email = REPLACE(email, "'.$row[0][6].'", "'.$casinoemail.'") WHERE chatid="'.$chatid.'"');
				usleep(100000);
			}
			if($casinodepositperiod!=$row[0][7])
			{
				mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET deposit = REPLACE(deposit, "'.$row[0][7].'", "'.$casinodepositperiod.'") WHERE chatid="'.$chatid.'"');
				usleep(100000);
			}
			if($casinodeposit!=$row[0][9])
			{
				mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET depositquan = REPLACE(depositquan, "'.$row[0][9].'", "'.$casinodeposit.'") WHERE chatid="'.$chatid.'"');
				usleep(100000);
			}
			if($casinobirthday!=$row[0][10])
			{
				mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET birthday = REPLACE(birthday, "'.$row[0][10].'", "'.$casinobirthday.'") WHERE chatid="'.$chatid.'"');
				usleep(100000);
			}
		}
		///////
		
		
		
		
		
		$query14=mysqli_query($con_sql2, 'SELECT deposit FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
		usleep(150000);
		$con14=mysqli_num_rows($query14);
		
		$row14=[];
		for($i14=0;$i14<$con14;$i14++)
		{
			mysqli_data_seek($query14, $i14);
			$row14[$i14]=mysqli_fetch_row($query14);
		}
		
		$casdeppernew=$row14[0][0];
		
		$mindep=10;
		
		if($casdeppernew==$mindep || $casdeppernew>$mindep)
		//if($casdeppernew==$mindep || $casdeppernew>$mindep || preg_match('/5181180343/', $chatid))
		{
			if($this->cmd_sql_searchchatidtable($chatid, $tablotteryusers)==FALSE)
			{
				$query1=mysqli_query($con_sql2, 'SELECT firstname,lastname,username FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
				usleep(200000);
				$con1=mysqli_num_rows($query1);
				
				$row1=[];
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				
				$firstname=$row1[0][0];
				$lastname=$row1[0][1];
				$username=$row1[0][2];
				
			
				mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tablotteryusers.' LIKE '.$tabusers.'');
				usleep(200000);
				
				mysqli_query($con_sql2, 'INSERT INTO '.$tablotteryusers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
				usleep(250000);
				
				
				$query8=mysqli_query($con_sql2, 'SELECT messid, channelid, lotteryname FROM '.$tablottery.'');
				usleep(200000);
				$con8=mysqli_num_rows($query8);
				
				$row8=[];
				for($i8=0;$i8<$con8;$i8++)
				{
					mysqli_data_seek($query8, $i8);
					$row8[$i8]=mysqli_fetch_row($query8);
				}
				
				$messageidlottery=$row8[0][0];
				$channellottery=$row8[0][1];
				$lotteryname=$row8[0][2];
				
				
				$query11=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tablotteryusers.'');
				usleep(200000);
				$con11=mysqli_num_rows($query11);
				
				$botusername=json_decode($this->api->getMe(), true);
				usleep(150000);
				$botusername=$botusername['result']['username'];
				
				$urllottery='https://t.me/'.$botusername.'?start=lottery';
				
				$keyb = [  [['text' => '🤝Зарегистрироваться (участников - '.$con11.')', 'url' => $urllottery ]] ];
				
				
				$this->api->editMessageReplyMarkup([
					'chat_id' => $channellottery,
					'message_id' => $messageidlottery,
					'reply_markup' => json_encode(['inline_keyboard'=>$keyb]),
				]);
				usleep(150000);
		
				$text='<b>Поздравляю!</b> Вы успешно зарегистрировались в розыгрыше "'.$lotteryname.'"!'.PHP_EOL.''.PHP_EOL.'';
				
				$this->api->sendMessage([
				'chat_id' => $chatid,
				'text' => $text,
				'reply_markup' => json_encode($this->keyboards['default_user_casino']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(150000);
			}	
	
	
	
	
			//////////////////////////////TICKETS CHECK////////////////////////////////
			$con_sql2=$this->cmd_sql();

			$query5=mysqli_query($con_sql2, 'SELECT username, firstname, lastname FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
			usleep(150000);
			$con5=mysqli_num_rows($query5);
			
			$row5=[];
			for($y1=0;$y1<$con5;$y1++)
			{
				mysqli_data_seek($query5, $y1);
				$row5[$y1]=mysqli_fetch_row($query5);
			}
			
			$username=$row5[0][0];
			$firstname=$row5[0][1];
			$lastname=$row5[0][2];
	
	
	
			/////////////////////////////////TICKET DATA////////////////////////////	
			//////////////////////имя,фамилия,день рождения/////////////////////
			if(!empty($pardata))
			{
				if(preg_match('/,/', $pardata))
				{
					$pardata=explode(',', $pardata);
					
					$empty1=[];
					//$empty2=[];
					//$empty3=[];
					
					foreach($pardata as $param)
					{
						$param=$this->clean($param);
						
						
						if($param=="имя")
						{
							if($casinofirstname=="0")
							{
								$empty1[]=$param;
							}
						}
						
						if($param=="фамилия")
						{
							if($casinolastname=="0")
							{
								$empty1[]=$param;
							}
						}
						
						if($param=="день рождения")
						{
							if($casinobirthday=="0")
							{
								$empty1[]=$param;
							}
						}
						
						/* if($param=="телефон")
						{
							if($casinophone=="0")
							{
								$empty2[]=$param;
								
							}
						}
						
						if($param=="почта")
						{
							if($casinoemail=="0")
							{
								$empty3[]=$param;
							}
						} */
		
					}
					
					
				}
				else
				{
					$empty1=[];
					//$empty2=[];
					//$empty3=[];
					
					$param=$pardata;
					
					if($param=="имя")
					{
						if($casinofirstname=="0")
						{
							$empty1[]=$param;
						}
					}
					
					if($param=="фамилия")
					{
						if($casinolastname=="0")
						{
							$empty1[]=$param;
						}
					}
					
					if($param=="день рождения")
					{
						if($casinobirthday=="0")
						{
							$empty1[]=$param;
						}
					}
					
					/* if($param=="телефон")
					{
						if($casinophone=="0")
						{
							$empty2[]=$param;
						}
					}
					
					if($param=="почта")
					{
						if($casinoemail=="0")
						{
							$empty3[]=$param;
						}
					} */
					
					
				}
				
				
	
				$textall="";
				
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
				usleep(150000);
				$con3=mysqli_num_rows($query3);
				
				$row3=[];
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
	
	
				if(preg_match('/1/', $row3[0][11])==FALSE)
				{
					if(empty($empty1))	
					{
	
						if($this->cmd_if_exists($tabticketsall)==FALSE)
						{
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabticketsall.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",status VARCHAR(15) DEFAULT "0",tickets VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							usleep(250000);
						}
						
			
						if(empty($row3[0][11]))	
						{
							$put='1';
						}
						else
						{
							$put=''.$row3[0][11].'1';
						}
						
						$ticket=$this->api->generate2(11);
						usleep(50000);
						
						mysqli_query($con_sql2, 'INSERT INTO '.$tabticketsall.' (chatid, firstname, lastname, username, status, tickets) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "data_fio", "'.$ticket.'")');
						usleep(150000);
						
						mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET promocode = REPLACE(promocode, "'.$row3[0][11].'", "'.$put.'") WHERE chatid="'.$chatid.'"');
						usleep(150000);
						
		
						$text='<b>Вы – безупречный игрок!</b>'.PHP_EOL.''.PHP_EOL.'Розыгрышный билет <b>'.$ticket.'</b> за полностью заполненный профиль уже у Вас.'.PHP_EOL.''.PHP_EOL.'';
						
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						'reply_markup' => json_encode($this->keyboards['default_user_casino']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(50000);
					}
				}
					
					
					
				
				////////////////////////почта////////////////////////////
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
				usleep(150000);
				$con3=mysqli_num_rows($query3);
				
				$row3=[];
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
				
				if(preg_match('/2/', $row[0][11])==FALSE)
				{	
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
					usleep(150000);
					$con=mysqli_num_rows($query);
				
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}	
				
					if($casinoemail=="2")
					{					
						if($this->cmd_if_exists($tabticketsall)==FALSE)
						{
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabticketsall.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",status VARCHAR(15) DEFAULT "0",tickets VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							usleep(250000);
						}
						
			
						$ticket=$this->api->generate2(11);
						usleep(50000);
						
						mysqli_query($con_sql2, 'INSERT INTO '.$tabticketsall.' (chatid, firstname, lastname, username, status, tickets) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "data_email", "'.$ticket.'")');
						usleep(100000);
						
						if(empty($row[0][11]))
						{
							$put='2';
						}
						else
						{
							$put=''.$row[0][11].'2';
						}
						
	
						mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET promocode = REPLACE(promocode, "'.$row[0][11].'", "'.$put.'") WHERE chatid="'.$chatid.'"');
						usleep(100000);
						
						$text='<b>Поздравляю!</b>'.PHP_EOL.''.PHP_EOL.'Вы получили розыгрышный билет <b>'.$ticket.'</b> за подтвержденную почту в аккаунте 📨'.PHP_EOL.''.PHP_EOL.'';
						
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(50000);
						
					}
					
				}	
					
				
				///////////////////////////////////////////телефон////////////////////////////////////////
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
				usleep(150000);
				$con3=mysqli_num_rows($query3);
				
				$row3=[];
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
				
				if(preg_match('/3/', $row3[0][11])==FALSE)
				{	
					if($casinophone=="2")
					{
						if($this->cmd_if_exists($tabticketsall)==FALSE)
						{
							mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabticketsall.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",status VARCHAR(15) DEFAULT "0",tickets VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							usleep(250000);
						}
						
	
						if(empty($row3[0][11]))
						{
							$put='3';
						}
						else
						{
							$put=''.$row3[0][11].'3';
						}
						
						
						$ticket=$this->api->generate2(11);
						usleep(50000);
						
						mysqli_query($con_sql2, 'INSERT INTO '.$tabticketsall.' (chatid, firstname, lastname, username, status, tickets) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "data_phone", "'.$ticket.'")');
						usleep(250000);
						
						mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET promocode = REPLACE(promocode, "'.$row3[0][11].'", "'.$put.'") WHERE chatid="'.$chatid.'"');
						usleep(250000);
	
						$text='Вы получили розыгрышный билет <b>'.$ticket.'</b> за подтвержденный номер телефона в аккаунте на сайте Казино.'.PHP_EOL.''.PHP_EOL.'';
						
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						'reply_markup' => json_encode($this->keyboards['default_user_casino']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(50000);
					}
				}
			}
			/////////////////////END TICKET DATA//////////////////////////////
			
			
			
			
			
			//////////////////////////////////////////////TICKET REFERAL///////////////////////////////////////////
			if(!empty($parrefer))
			{
			
				if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'" AND refer!="0" LIMIT 1'))))
				{
					$query3=mysqli_query($con_sql2, 'SELECT refer FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
					usleep(150000);
					$con3=mysqli_num_rows($query3);
						
					for($y=0;$y<$con3;$y++)
					{
						mysqli_data_seek($query3, $y);
						$row3[$y]=mysqli_fetch_row($query3);
					}
					
					
					
					if(preg_match('/_/', $row3[0][0]))
					{
						$chatidref=preg_replace('/_.*/', '', $row3[0][0]);
						$chatidref=$this->clean($chatidref);
					}
					else
					{
						$chatidref=$row3[0][0];
					}
					
					$tabrefer='tabrefer'.$chatidref.'';
					$tabrefers='tabrefers'.$chatidref.'';
					
					
					if($this->cmd_sql_searchchatidtable($chatidref, $tabusers) && $this->cmd_sql_searchchatidtable($chatidref, $tablotteryusers))
					{
						if($this->cmd_sql_searchchatidtable($chatid, $tabrefer)==FALSE && $this->cmd_sql_searchchatidtable($chatid, $tablotteryusers))
						{	
							if($this->cmd_if_exists($tabrefer)==FALSE)
							{
								mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabrefer.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(20) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
								usleep(150000);
							}
							
							/* if($this->cmd_if_exists($tabrefers)==FALSE)
							{
								mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabrefers.' LIKE '.$tabrefer.'');
								usleep(150000);
							} */
							
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabrefer.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
							usleep(250000);
								
							/* mysqli_query($con_sql2, 'INSERT INTO '.$tabrefers.' (chatid,firstname,lastname,username,actiondate) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.date('d.m.Y G:i').'")');
							usleep(250000); */
							
	
							$query4=mysqli_query($con_sql2, 'SELECT * FROM '.$tabrefer.'');
							usleep(150000);
							$con4=mysqli_num_rows($query4);
							
							
							
							if($con4==$parrefer)
							{
								if(preg_match('/_2/', $chatidref)==FALSE)
								{
									$row4=[];
									$textall="";
									
							
									for($i4=0;$i4<$con4;$i4++)
									{
										mysqli_data_seek($query4, $i4);
										$row4[$i4]=mysqli_fetch_row($query4);
										
										
										$firstname4=$row4[$i4][2];
										$lastname4=$row4[$i4][3];
										$username4=$row4[$i4][4];
										$actiondate4=$row4[$i4][5];
										
										if(empty($username4))
										{
											if(empty($lastname4))
											{
												$text4=''.$firstname4.' ('.$actiondate4.')';
											}
											else
											{
												$text4=''.$firstname4.' '.$lastname4.' ('.$actiondate4.')';
											}
										}
										else
										{
											if(empty($lastname4))
											{
												$text4=''.$firstname4.' ('.$username4.', '.$actiondate4.')';
											}
											else
											{
												$text4=''.$firstname4.' '.$lastname4.' ('.$username4.', '.$actiondate4.')';
											}
										}
										
										
										if($i4==0)
										{
											$textall=$text4;
										}
										else
										{
											$textall=$textall . ', '.$text4.'';
										}
									}
									
									
									$query7=mysqli_query($con_sql2, 'SELECT username, firstname, lastname FROM '.$tabusers.' WHERE chatid="'.$chatidref.'"');
									usleep(150000);
									$con7=mysqli_num_rows($query7);
									
									$row7=[];
									
									for($y7=0;$y7<$con7;$y7++)
									{
										mysqli_data_seek($query7, $y7);
										$row7[$y7]=mysqli_fetch_row($query7);
									}
									
									$usernameref=$row7[0][0];
									$firstnameref=$row7[0][1];
									$lastnameref=$row7[0][2];
									
									
									if($this->cmd_if_exists($tabticketsall)==FALSE)
									{
										mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabticketsall.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",status VARCHAR(15) DEFAULT "0",tickets VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
										usleep(150000);
									}
									
									$ticket=$this->api->generate2(11);
									usleep(50000);
									
									mysqli_query($con_sql2, 'INSERT INTO '.$tabticketsall.' (chatid, firstname, lastname, username, status, tickets) VALUES ("'.$chatidref.'", "'.$firstnameref.'", "'.$lastnameref.'", "'.$usernameref.'", "refer", "'.$ticket.'")');
									usleep(150000);
									
									
									
									mysqli_query($con_sql2, 'UPDATE '.$tabusers.' SET refer = REPLACE(refer, "'.$row3[0][0].'", "'.$row3[0][0].'_2") WHERE chatid="'.$chatid.'"');
									usleep(250000);
							
									
									mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabrefer.'');
									usleep(150000);
									
							
									$text='<b>Выше всяких похвал!</b>'.PHP_EOL.''.PHP_EOL.'Вы получили билет <b>'.$ticket.'</b> за регистрацию в розыгрыше "'.$lotteryname.'" участника '.$textall.' по Вашей реферальной ссылке'.PHP_EOL.''.PHP_EOL.'';
								
									$this->api->sendMessage([
									'chat_id' => $chatidref,
									'text' => $text,
									//'disable_notification' => TRUE,
									//'disable_web_page_preview' => TRUE,
									'parse_mode'=> "HTML"
									]);
									usleep(50000);
								}
							}
						}
					}
				}
			}
			///////////////////////////////END TICKET REFERAL//////////////////////////////
			
			
			
			////////////////////////////////////////////TICKET DEPOSIT////////////////////////////////////////
			if(!empty($pardeposit))
			{
				//if($casinodepositperiod!=$casdepperold)
				//{
					$ticketsquantity=floor(($casinodepositperiod/$pardeposit));
					$textall="";
					
					if($this->cmd_if_exists($tabticketsall)==FALSE)
					{
						mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabticketsall.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",status VARCHAR(15) DEFAULT "0",tickets VARCHAR(15) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
					}
				
					
					if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="deposit"'))))
					{
						$ticketsuserdep=mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="deposit"'));
					}
					else
					{
						$ticketsuserdep=0;
					}
					
					
	
					if($ticketsquantity>$ticketsuserdep)
					{
						$difftickets=($ticketsquantity-$ticketsuserdep);
						
						for($e=0;$e<$difftickets;$e++)
						{
							
							$ticket=$this->api->generate2(11);
							usleep(50000);
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabticketsall.' (chatid, firstname, lastname, username, status, tickets) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "deposit", "'.$ticket.'")');
							usleep(250000);
							
							$text=$ticket;
							
							if($e==0)
							{
								$textall=$text;
							}
							else
							{
								$textall=$textall . ', '.$text.'';
							}
						}
						
						
						
						$text='<b>Огонь</b>🤩'.PHP_EOL.''.PHP_EOL.'Вы получили розыгрышные билеты за активную игру в Казино (всего '.$difftickets.' шт.):'.PHP_EOL.''.PHP_EOL.'<b>'.$textall.'</b>'.PHP_EOL.''.PHP_EOL.'Вы и дальше будете получать билеты за активную игру, но об этом позже😌'.PHP_EOL.''.PHP_EOL.'';
						
						$this->api->sendMessage([
						'chat_id' => $chatid,
						'text' => $text,
						'reply_markup' => json_encode($this->keyboards['default_user_casino']),
						//'disable_notification' => TRUE,
						//'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(50000);
					}
				//}
			}
			///////////////////////////////////////END DEPOSIT TICKET/////////////////////////////////////////
			
			
			
			$con_sql2=$this->cmd_sql();
			////////////////////////////////////////////////TEXTS/////////////////////////////////////////////
			$text1='🤩Вы умница – вмиг заработали все билеты за аккаунт в Казино! Полностью заполнили профиль, подтвердили почту и телефон. И даже являетесь активным игроком Казино😊'.PHP_EOL.''.PHP_EOL.'🎁Но можно получить ещё больше билетов и забрать самые ценные призы!'.PHP_EOL.''.PHP_EOL.'Нажимайте кнопку 🎁<b>Хочу больше билетов</b> и узнайте как их заполучить👇';
			
			$text2='🤩Вы умница – вмиг заработали все билеты за аккаунт в Казино! Полностью заполнили профиль, подтвердили почту и телефон.'.PHP_EOL.''.PHP_EOL.'🎁Но можно получить ещё больше билетов и забрать самые ценные призы!'.PHP_EOL.''.PHP_EOL.'Нажимайте кнопку 🎁<b>Хочу больше билетов</b> и узнайте как их заполучить👇';
			
			$text3='Упс! У Вас не хватает билета, который можно с легкостью получить.'.PHP_EOL.''.PHP_EOL.'Просто нажмите кнопку 🎁<b>Хочу больше билетов</b>';
			
			$text4='Упс! У Вас не хватает билетов, которые можно с легкостью получить.'.PHP_EOL.''.PHP_EOL.'Просто нажмите кнопку 🎁<b>Хочу больше билетов</b>, чтобы узнать как.';
			
			$text5='<b>Вам не хватает билета за полностью заполненный профиль, который можно с легкостью получить</b>😌'.PHP_EOL.''.PHP_EOL.'<i>Чтобы его заполучить:</i>'.PHP_EOL.'1) перейдите на сайт Казино и авторизуйтесь в своем аккаунте;'.PHP_EOL.'2) перейдите в раздел Личные данные;'.PHP_EOL.'3) нажмите на карандаш и заполните пустые поля (поле Skype можно не заполнять)😉';
			
			$text6='📩<b>Нет билета за подтвержденную почту?</b>'.PHP_EOL.''.PHP_EOL.'<i>Чтобы его забрать:</i>'.PHP_EOL.'1) перейдите на полную версию сайта Казино во вкладку Личные данные, там Вы увидите баннер "Активация аккаунта" (кнопка для перехода называется "Полная версия" и находится внизу мобильной версии);'.PHP_EOL.'2) на баннере нажмите кнопку "Отправить письмо" (письмо придет на ту почту, которая указана в аккаунте);'.PHP_EOL.'3) в письме нажмите кнопку "Подтвердить почту".'.PHP_EOL.''.PHP_EOL.'💻Если Вы столкнетесь с трудностью, рекомендую обратиться в поддержку на сайте.';
			
			$text7='📱<b>Не получили билет за подтвержденный номер телефона?</b>'.PHP_EOL.''.PHP_EOL.'<i>Чтобы его забрать:</i>'.PHP_EOL.'1) перейдите на полную версию сайта Казино во вкладку Личные данные (кнопка для перехода называется "Полная версия" и находится внизу мобильной версии);'.PHP_EOL.'2) нажмите кнопку "Активировать" напротив номера;'.PHP_EOL.'3) введите код, который придет на номер, какой Вы указали в аккаунте.'.PHP_EOL.''.PHP_EOL.'Если к старому номеру у Вас нет доступа, просто нажмите карандаш и укажите новый номер телефона.'.PHP_EOL.''.PHP_EOL.'💻Не получается? Рекомендую обратиться в поддержку на сайте🤗';
			
			$text8='<b>Поздравляю!</b> Вы собрали все тривиальные билеты🤝';
			
			$text9='На протяжении всего времени проведения розыгрыша, Вы будете получать <b>1 розыгрышный билет за каждые '.$pardeposit.' Евро пополнений</b> в Казино☺️'.PHP_EOL.''.PHP_EOL.'Непринужденно играйте в свободное время, <b>получайте билеты</b> и повышайте шанс забрать ценные подарки🎄';
			
			$text10='Вдобавок, во время проведения розыгрыша, Вы получаете <b>1 билет за каждые '.$pardeposit.' Евро пополнений</b> в Казино☺️'.PHP_EOL.''.PHP_EOL.'Играйте как ни в чем не бывало и копите билеты, чтобы шанс забрать желанный приз был предельно высок!';
			
			$text11='🎁Также Вам стоит получить <b>билеты за регистрацию друзей в розыгрыше</b> по Вашей реферальной ссылке.'.PHP_EOL.''.PHP_EOL.'Для этого нажмите кнопку 💆<b>Пригласить друга</b> и отправьте ссылку на бот кому-то из знакомых.';
			
			$text12='<b>Вы – молодец!</b> Но помните, больше друзей – больше розыгрышных билетов!'.PHP_EOL.''.PHP_EOL.'Нажимайте кнопку 💆<b>Пригласить друга</b> и отправляйте ссылку знакомому, чтобы получить еще несколько билетов 😉';
			
			$text13='😥Но не получили ни одного билета.'.PHP_EOL.''.PHP_EOL.'Скорее исправляйте ситуацию, чтобы забрать желанные призы🎄'.PHP_EOL.''.PHP_EOL.'Нажимайте кнопку 🎁<b>Хочу больше билетов</b>, чтобы узнать как👇';
			
			$con4=0;
			
			if(!empty(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'"'))))
			{
				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'"');
				usleep(250000);
				$con4=mysqli_num_rows($query4);
			}
			
			$text99='<b>Общее количество Ваших розыгрышных билетов - '.$con4.' шт.</b>';
	
	
			$query4=mysqli_query($con_sql2, 'SELECT promocode FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
			usleep(250000);
			
			if(!empty(mysqli_num_rows($query4)))
			{
				$con4=mysqli_num_rows($query4);
				
				for($i4=0;$i4<$con4;$i4++)
				{
					mysqli_data_seek($query4, $i4);
					$row4[$i4]=mysqli_fetch_row($query4);
				}
				
				$promocode=$row4[0][0];
				$lenpromo=strlen($promocode);
			}
			else
			{
				$promocode=0;
				$lenpromo=0;
			}
			
			
			$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="deposit"');
			usleep(250000);
			
			$quantdeposit=0;
			
			if(!empty(mysqli_num_rows($query4)))
			{
				$con4=mysqli_num_rows($query4);
				$quantdeposit=$con4;
			}
			
			
			$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatid.'" AND status="refer"');
			usleep(250000);
			
			$quantrefer=0;
			
			if(!empty(mysqli_num_rows($query4)))
			{
				$con4=mysqli_num_rows($query4);
				$quantrefer=$con4;
			}
			
			
	
	
	
			
			//////////////////////первая регистрация//////////////////////////
			
			if(empty($lasttime))
			{
				$textfinal="";
				//////////////////вообще нет билетов//////////////////////////
				if(empty($promocode) && empty($quantdeposit) && empty($quantrefer))
				{
					$textfinal=$textfinal . ''.$text13.'';
				}
				/////////////////////Есть хотя бы один билет//////////////////////
				else
				{
					$textfinal=$textfinal . ''.$text99.''.PHP_EOL.''.PHP_EOL.'';
					
					if(!empty($pardata) && !empty($pardeposit))
					{
						
						////////////Есть все: профиль, почта, номер и депозиты///////////////
						if($lenpromo==3 && !empty($quantdeposit))
						{
							$textfinal=$textfinal . ''.$text1.''.PHP_EOL.''.PHP_EOL.'';
						}
					
					
						//////////////Есть профиль, почта, номер, но нет депозитов//////////////////
						if($lenpromo==3 && empty($quantdeposit))
						{
							$textfinal=$textfinal . ''.$text2.''.PHP_EOL.''.PHP_EOL.'';
						}
					
						////////////Нет профиля и/или почты и/или номера и/или депозитов/////////////////
						//////////билета////////
						if($lenpromo==2)
						//if(preg_match('/1/', $promocode)==FALSE || preg_match('/2/', $promocode)==FALSE || preg_match('/3/', $promocode)==FALSE || $quantdeposit==0)
						{
							$textfinal=$textfinal . ''.$text3.''.PHP_EOL.''.PHP_EOL.'';
						}
						//////////билетов////////
						if($lenpromo==1)
						{
							$textfinal=$textfinal . ''.$text4.''.PHP_EOL.''.PHP_EOL.'';
						}
					}
				}
				
				
				$this->api->sendMessage([
				'chat_id' => $chatid,
				'text' => $textfinal,
				'reply_markup' => json_encode($this->keyboards['default_user_casino']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
			}
			
			

			///////////////////////////Хочу больше билетов//////////////////////////////
			
					////////////////////1-е сообщение///////////////////
			elseif(file_exists(''.dirname(__FILE__).'/enddate.txt'))
			{
				/////////////////1. отправляется всем///////////////////
				$textfinal="";
				$textfinal=$textfinal . ''.$text99.''.PHP_EOL.''.PHP_EOL.'';
				
				
				if(!empty($pardata))
				{
					
					/////////////////2. если нет билета за профиль////////////////
					if(preg_match('/1/', $promocode)==FALSE)
					{
						$textfinal=$textfinal . ''.$text5.''.PHP_EOL.''.PHP_EOL.'';
					}
				
	
					//////////////3. если нет билета за почту/////////////////
					if(preg_match('/2/', $promocode)==FALSE)
					{
						$textfinal=$textfinal . ''.$text6.''.PHP_EOL.''.PHP_EOL.'';
					}
					
					//////////////4. если нет билета за номер /////////////////
					
					if(preg_match('/3/', $promocode)==FALSE)
					{
						$textfinal=$textfinal . ''.$text7.''.PHP_EOL.''.PHP_EOL.'';
					}
					
					//////////////5. если есть билеты за профиль, почту и номер /////////////////
					if($lenpromo==3)
					{
						$textfinal=$textfinal . ''.$text8.''.PHP_EOL.''.PHP_EOL.'';
					}
				}
				
				$this->api->sendMessage([
				'chat_id' => $chatid,
				'text' => $textfinal,
				'reply_markup' => json_encode($this->keyboards['default_user_casino']),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				
				////////////////////2-е сообщение///////////////////
				$textfinal="";
				
				if(!empty($pardeposit))
				{
					
					//////////////6. если нет билетов за игру  /////////////////
					if(empty($quantdeposit))
					{
						if(!empty($pardeposit))
						{
							$textfinal=$textfinal . ''.$text9.''.PHP_EOL.''.PHP_EOL.'';
						}
					}
					//////////////7. если есть билеты за игру  /////////////////
					else
					{
						if(!empty($pardeposit))
						{
							$textfinal=$textfinal . ''.$text10.''.PHP_EOL.''.PHP_EOL.'';
						}
					}
				
					$this->api->sendMessage([
					'chat_id' => $chatid,
					'text' => $textfinal,
					'reply_markup' => json_encode($this->keyboards['default_user_casino']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);
				}
			
					////////////////////3-е сообщение///////////////////
				$textfinal="";
				
				
				if(!empty($parrefer))
				{
					//////////////8. если нет билетов за рефералку   /////////////////
					if(empty($quantrefer))
					{
						if(!empty($parrefer))
						{
							$textfinal=$textfinal . ''.$text11.''.PHP_EOL.''.PHP_EOL.'';
						}
					}
					//////////////9. если есть билеты за рефералку   /////////////////
					else	
					{
						if(!empty($parrefer))
						{
							$textfinal=$textfinal . ''.$text12.''.PHP_EOL.''.PHP_EOL.'';
						}
					}
				
					$this->api->sendMessage([
					'chat_id' => $chatid,
					'text' => $textfinal,
					'reply_markup' => json_encode($this->keyboards['default_user_casino']),
					//'disable_notification' => TRUE,
					//'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);
				}
	
			}

		}
		else
		{
			$query8=mysqli_query($con_sql2, 'SELECT lotteryname FROM '.$tablottery.'');
			usleep(200000);
			$con8=mysqli_num_rows($query8);
			
			$row8=[];
			for($i8=0;$i8<$con8;$i8++)
			{
				mysqli_data_seek($query8, $i8);
				$row8[$i8]=mysqli_fetch_row($query8);
			}
			

			$lotteryname=$row8[0][0];
				
			$text='К сожаленью, <b>Вы не были зарегистрированы</b> в розыгрыше "'.$lotteryname.'", т.к. у Вас <b>нет минимального депозита</b> в казино Казино в размере <b>'.$mindep.' Евро.</b>';
			
			$this->api->sendMessage([
			'chat_id' => $chatid,
			'text' => $text,
			//'reply_markup' => json_encode($this->keyboards['default_user_casino']),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
		
		mysqli_query($con_sql2, 'UPDATE '.$tabcasinousers.' SET lasttime = REPLACE(lasttime, "'.$row[0][8].'", "'.date('d.m.Y G:i').'") WHERE chatid="'.$chatid.'"');
		usleep(200000);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceuser.'');
		usleep(200000);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempuser.'');
		usleep(200000);
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempusererr.'');
		usleep(200000);

	}
	
	
	
	
	
	
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////
	///////////////////////USER DOESN'T EXIST////////////////////////////
	else
	{
		
		$con_sql2=$this->cmd_sql();

		$counterlimit=DataBot::COUNTERLIMIT;
	
		$tabusers='tabusers';
		$tablotteryusers='tablotteryusers';
		$tablottery='tablottery';
		$tabcasinousers='tabcasinousers';
		$tabserviceuser='tabserviceuser'.$chatid.'';
		$tabtempuser='tabtempuser'.$chatid.'';
		$tabtempusererr='tabtempusererr'.$chatid.'';
		$tabticketsall='tabticketsall';
		$tabservicelottery='tabservicelottery';
		$tabadminchange='tabadminchange';
		$tabserviceadmin='tabserviceadmin';
		
		
		$arraystatus=['member','creator','administrator'];
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempuser.'');
		usleep(200000);
		
		
		if($this->cmd_if_exists($tabtempusererr)==FALSE)
		{ 
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabtempusererr.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(2) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tabtempusererr.' (info) VALUES ("1")');
			usleep(150000);
		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT info FROM '.$tabtempusererr.'');
			usleep(150000);
			$con=mysqli_num_rows($query);
			
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
			$counter=$row[0][0];
			$counter=($counter+1);
			
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempusererr.'');
			usleep(150000);
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tabtempusererr.' (info) VALUES ("'.$counter.'")');
			usleep(150000);
		}
		
		
		$query=mysqli_query($con_sql2, 'SELECT info FROM '.$tabtempusererr.'');
		usleep(150000);
		$con=mysqli_num_rows($query);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$counter=$row[0][0];
		
		
		if($counter!=$counterlimit)
		{
			$tries=($counterlimit-$counter);
			
			$text='Я не смог найти Ваш ID ('.$casinoid.'), потому что его нет в Казино😔'.PHP_EOL.''.PHP_EOL.'Скорее всего, он был указан неправильно.'.PHP_EOL.''.PHP_EOL.'Пожалуйста, пришлите еще раз Ваш номер счета, чтобы стать участником розыгрыша👇'.PHP_EOL.''.PHP_EOL.'<i>Осталось попыток - '.$tries.'</i>';
		
			$this->api->sendMessage([
			'chat_id' => $chatid,
			'text' => $text,
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
	
		}
		else
		{
		
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempuser.'');
			usleep(100000);
			
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabtempusererr.'');
			usleep(100000);
			
			
			mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabbanned.' LIKE '.$tabusers.'');
			usleep(200000);
				
			mysqli_query($con_sql2, 'INSERT INTO '.$tabbanned.' (chatid,firstname,lastname,username,actiondate) SELECT chatid,firstname,lastname,username,actiondate FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
			usleep(200000);
				
			mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabserviceuser.'');
			usleep(100000);
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tabusers.' WHERE chatid="'.$chatid.'"');
			usleep(100000);
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tabcasinousers.' WHERE chatid="'.$chatid.'"');
			usleep(100000);
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tablotteryusers.' WHERE chatid="'.$chatid.'"');
			usleep(100000);
			
			
			$arraystatus=['member','creator','administrator'];
					
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$channelid=$row[$i][0];
				
				$inchannel=json_decode($this->api->getChatMember([
				'chat_id' => $channelid,
				'user_id' => $chatid,
				]), true);
				
				$inchannel=$inchannel['result'];
				
				if(in_array($inchannel['status'], $arraystatus))
				{
					$this->api->banChatMember([
						'chat_id' => $channelid,
						'user_id' => $chatid,
						'revoke_messages' => true,
					]);
				}
			}
			
					
		
			$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabgroups.'');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$groupid=$row[$i][0];
				
				$ingroup=json_decode($this->api->getChatMember([
				'chat_id' => $groupid,
				'user_id' => $chatid,
				]), true);
				
				$ingroup=$ingroup['result'];
				
				if(in_array($ingroup['status'], $arraystatus))
				{
					$this->api->banChatMember([
						'chat_id' => $groupid,
						'user_id' => $chatid,
						'revoke_messages' => true,
					]);
				}
			}
			
			
			$chatidadmin=$this->chatidadmin;
			
			$result=json_decode($this->api->getChat([
				'chat_id' => $chatidadmin
				]), true);
			$usernameadmin=$result['result']['username'];
	
	
			$text='<b>Вы 5 раз прислали мне непонятно что!</b>🥸'.PHP_EOL.''.PHP_EOL.'К сожалению, вынужден Вас заблокировать.'.PHP_EOL.''.PHP_EOL.'Чтобы участвовать в розыгрыше, напишите моему старшему - @'.$usernameadmin.'.';
			
			$this->api->sendMessage([
			'chat_id' => $chatid,
			'text' => $text,
			'reply_markup' => json_encode( ['remove_keyboard' => true] ),
			//'disable_notification' => TRUE,
			//'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
	
		}
	
	}
	
}












/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////	
/////
    public function __construct($token=null)
	{
		date_default_timezone_set('Europe/Kiev');
		
		if( !isset( $this->token ) && isset( $token ) )
		{
			$this->token = $token;
		}
		
		include_once(''.dirname(__FILE__).'/TelegramBotApi.php');
		
		$this->api = new TelegramBotApi( $this->token );		
		
		$this->api->debug=true;
	}


/////
	public function __destruct()
	{
        gc_collect_cycles();
    }


/////
	public function replyCommand()
	{
		$this->result=$this->api->getWebhookUpdate();

		if(!empty($this->result))
		{
			//if($this->api->chatId==DataBot::CHATIDADMIN || preg_match('/'.$this->api->chatId.'/', $this->testusers) || preg_match('/'.$this->api->username.'/', $this->testusers))
			//{
				if(!empty($this->result['callback_query']))
				{
					$this->callCallback();
				}
				else
				{
					$this->callCommand();
				}
			//}
			/* else
			{
				$text='В данный момент бот находится в сервисном режиме. Приносим извинения за неудобства.';
			
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['remove_keyboard' => true] ),
				//'disable_notification' => TRUE,
				//'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			} */
		}
		else
		{
			echo "ggggg";
			exit;
		}
	}

	
	


	
/////	
	public function callCallback()
	{
		$query=$this->result['callback_query']['data'];
		
		if(preg_match('/[^_]\(.*\)$/', $query))
		{
			$query=preg_replace('/\(.*/', '', $query);
			$query=$this->clean($query);
			
			$params=preg_replace('/.*\(/', '', $this->result['callback_query']['data']);
			$params=preg_replace('/\).*/', '', $params);
			$params=$this->clean($params);
		}

		$cmd='callback_'.$query.'';

		if(method_exists($this, $cmd))
		{
			if(empty($params))
			{
				$this->$cmd();
			}
			else
			{
				$this->$cmd($params);
			}
		}
		else
		{
			if(file_exists(''.dirname(__FILE__).'/include'.$this->api->chatId.'.php'))
			{
				include_once(''.dirname(__FILE__).'/include'.$this->api->chatId.'.php');
			}

			if(class_exists('TelegramBotfunc'))
			{
				$this->func=new TelegramBotfunc();
			}
			
			if(method_exists($this->func, $cmd))
			{
				$this->func->$cmd($this->result['callback_query']['data']);
			}
			else
			{
				$this->callback_default($this->result['callback_query']['data']);
			}
		}
	}


/////
	public function callCommand()
	{
		if(!empty($this->result["message"]))
		{
			if($this->cmd_isadmin())
			{
				if(!empty($this->result["message"]["text"]))
				{
					$text=$this->result["message"]["text"];
					
					$cmd=$this->getCommand($text);
				}
				
				$chatid=$this->api->chatId;
				$tabserviceadmin='tabserviceadmin_'.$chatid.'';
				
				if(!empty($cmd))
				{
					$this->$cmd();
				}
				elseif($this->cmd_if_exists($tabserviceadmin) && $this->cmd_if_empty($tabserviceadmin)==FALSE)
				{	
					$con_sql2=$this->cmd_sql();
				
					$query=mysqli_query($con_sql2, 'SELECT info FROM '.$tabserviceadmin.'');
					$con=mysqli_num_rows($query);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					$info=$row[0][0];
					
					if($info=='photo')
					{
						if($this->result["message"]["photo"])
						{
							$this->cmd_admin_lottery_photo_make();
						}
					}
					elseif($info=='shortlotteryimage')
					{
						if($this->result["message"]["photo"])
						{
							$this->cmd_lottery_short_image();
						}
					}
					elseif($info=='messageallusers')
					{
						$this->cmd_messageallusers();
					}
					elseif($info=='messagelotteryusers')
					{
						$this->cmd_messagelotteryusers();
					}
					elseif($info=='messagenotlotteryusers')
					{
						$this->cmd_messagenotlotteryusers();
					}
					elseif($info=='lottery')
					{
						$this->cmd_create_lottery_send();
					}
					elseif($info=='lotteryname')
					{
						$this->cmd_create_lottery_name();
					}
					elseif($info=='lotterytext')
					{
						$this->cmd_create_lottery_text();
					}
					elseif($info=='lotteryenddate')
					{
						$this->cmd_create_lottery_enddate();
					}
					elseif($info=='lotterytopplaces')
					{
						$this->cmd_create_lottery_topplaces();
					}
					elseif($info=='setparametrsparrefer')
					{
						$this->cmd_create_lottery_setparametrsparrefer();
					}
					elseif($info=='setparametrspardeposit')
					{
						$this->cmd_create_lottery_setparametrspardeposit();
					}
					elseif($info=='setparametrspardata')
					{
						$this->cmd_create_lottery_setparametrspardata();
					}
					elseif($info=='setparametrsparpublic')
					{
						$this->cmd_create_lottery_setparametrsparpublic();
					}
					elseif($info=='lotteryfakeplaces')
					{
						$this->cmd_create_lottery_lotteryfakeplaces();
					}
					elseif($info=='lotteryfinish')
					{
						$this->cmd_lottery_admin_finish();
					}
					elseif($info=='messageuserbyid')
					{
						$this->cmd_messageuserbyid();
					}
					elseif($info=='messageuserbyidsend')
					{
						$this->cmd_messageuserbyidsend();
					}
					elseif($info=='banusers')
					{
						$this->cmd_admin_banusers_action();
					}
					elseif($info=='shortlotterytext')
					{
						$this->cmd_lottery_short_text();
					}
					elseif($info=='shortlotterytopplaces')
					{
						$this->cmd_lottery_short_winners();
					}
					elseif($info=='shortlotteryenddate')
					{
						$this->cmd_lottery_short_enddate();
					}
					elseif($info=='shortlotterytextbutton')
					{
						$this->cmd_lottery_short_textbutton();
					}
					elseif($info=='shortlotterymessage')
					{
						$this->cmd_lottery_short_message();
					}
					elseif(preg_match('/shortmanual/', $info))
					{
						$lotterydata=str_replace('shortmanual', '', $info);
						$this->cmd_short_manual_results($lotterydata);
					}
					/* elseif($info=='format')
					{
						$this->cmd_result();
					} */
					
					
				}
				
			}
			////USER////
			else
			{
				if(!empty($this->result["message"]["text"]))
				{
					$text=$this->result["message"]["text"];
					$cmd=$this->getCommand($text);
				}
				

				$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
				$shortuserservice='shortuserservice'.$this->api->chatId.'';
		
				if(!empty($cmd))
				{
					$this->$cmd();
				}
				elseif($this->cmd_if_exists($tabserviceuser))
				{
			
					$this->cmd_id_casino_check();
				}
				elseif($this->cmd_if_exists($shortuserservice) && $this->cmd_if_empty($shortuserservice)==FALSE)
				{
					$con_sql2=$this->cmd_sql();
				
					$query=mysqli_query($con_sql2, 'SELECT info FROM '.$shortuserservice.'');
					$con=mysqli_num_rows($query);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					$lotteryname=$row[0][0];
					
					
					
					if(preg_match('/^\d{9,10}$/', $text) && $text!=$this->api->chatId)
					{					
						$this->cmd_id_casino_short_check($lotteryname);
					}
				}
			}
		}
	}
	
	
	/////
	public function getCommand($text)
	{
		if(preg_match('/^\//', $text))
		{
			if(preg_match('/ /', $text))
			{
				
				if(preg_match('/\/start ref_/', $text))
				{
					$text="/start_referal";
				}
				elseif(preg_match('/\/start lottery/', $text))
				{
					$text="/start_lottery";
				}
				elseif(preg_match('/\/start shortlottery/', $text))
				{
					$text=str_replace('/start shortlottery', '', $text);
					
					return $this->cmd_start_shortlottery($text);
				}
				else
				{
					$text = explode(" ", $text );
					$text = $text[0];
				}
			}
		}
		
		if( $text && array_key_exists( $text, $this->commands ) && method_exists( $this, $this->commands[$text] ) )
		{
			return $this->commands[$text];
		}
		
		return false;
	}
	
	/////	
	public function callbackAnswer( $text, $keyboard ){
		$this->api->answerCallbackQuery( $this->result['callback_query']["id"] );
				
		$this->api->editMessageText([
			'chat_id' => $this->result['callback_query']['message']['chat']["id"],
			'message_id' => $this->result['callback_query']['message']['message_id'],
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$keyboard] ),
			//	'resize_keyboard' => true,
			//	'one_time_keyboard' => true
		]);
	}

/////
	public function callback_default( $query )
	{
		$this->api->answerCallbackQuery( [
			'callback_query_id' => $this->result['callback_query']["id"],
			'text' => "Action \"{$query}\" is not working now.",
			'show_alert' => true
		] );
	}
	
	
	
	
	

}