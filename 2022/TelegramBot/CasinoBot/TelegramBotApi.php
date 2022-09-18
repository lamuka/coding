<?php



class TelegramBotApi
{
	protected $apiUrl = "https://api.telegram.org/bot";
	public $chatId = null;
	public $debug = false;


/////
    public function __construct($token=null)
	{
		if( isset( $token ) )
		{
			$this->apiToken = $token;
		}
	}

/////
	public function __destruct()
	{
        gc_collect_cycles();
    }
	
	
/////	
	public function getWebhookUpdate()
	{
		$body=json_decode(file_get_contents('php://input'), true);
		
		$this->body=$body;
		
		
		
		if(!empty($body["message"]) && !empty($body["message"]["chat"]["type"]))
		{

			if($body["message"]["chat"]["type"]=='private')
			{
				$this->message = $body["message"];
				
				if(!empty($body["message"]["message_id"]))
				{
					$this->messageid = $body["message"]["message_id"];
				}
				if(!empty($body["message"]["chat"]["id"]))
				{
					$this->chatId = $body["message"]["chat"]["id"];
				}
				if(!empty($body["message"]["chat"]["first_name"]))
				{
					$this->firstname = $body["message"]["chat"]["first_name"];
				}
				if(!empty($body["message"]["chat"]["last_name"]))
				{
					$this->lastname = $body["message"]["chat"]["last_name"];
				}
				if(!empty($body["message"]["chat"]["username"]))
				{
					$this->username = $body["message"]["chat"]["username"];
				}
				if(!empty($body["message"]["text"]))
				{
					$this->textmessage = $body["message"]["text"];
				}
				
				if( $this->debug )
				{
					@file_put_contents( "log.txt", print_r( $body, 1 ) . PHP_EOL, FILE_APPEND );
				}
			}
		}
		elseif(isset($body['callback_query']["message"]) && !empty($body['callback_query']["message"]["chat"]["type"]))
		{
			if($body['callback_query']["message"]["chat"]["type"]=='private')
			{
				$this->message = $body['callback_query']["message"];
				
				if(!empty($body['callback_query']["message"]["message_id"]))
				{
					$this->messageid = $body['callback_query']["message"]["message_id"];
				}
				if(!empty($body['callback_query']["message"]["chat"]["id"]))
				{
					$this->chatId = $body['callback_query']["message"]["chat"]["id"];
				}
				if(!empty($body['callback_query']["message"]["chat"]["first_name"]))
				{
					$this->firstname = $body['callback_query']["message"]["chat"]["first_name"];
				}
				if(!empty($body['callback_query']["message"]["chat"]["last_name"]))
				{
					$this->lastname = $body['callback_query']["message"]["chat"]["last_name"];
				}
				if(!empty($body['callback_query']["message"]["chat"]["username"]))
				{
					$this->username = $body['callback_query']["message"]["chat"]["username"];
				}
				if(!empty($body['callback_query']["message"]["text"]))
				{
					$this->textmessage = $body['callback_query']["message"]["text"];
				}
				
				if( $this->debug )
				{
					@file_put_contents( "log.txt", print_r( $body, 1 ) . PHP_EOL, FILE_APPEND );
				}
			}
			
		}
		elseif(!empty($body["my_chat_member"]["from"]["id"]) && $body["my_chat_member"]["from"]["id"]==DataBot::CHATIDADMIN)
		{
			
			if(!empty($body["my_chat_member"]["new_chat_member"]["user"]["is_bot"]) && !empty($body["my_chat_member"]["new_chat_member"]["status"]) && !empty($body["my_chat_member"]["chat"]["type"]))
			{
				
				$newuser=$body["my_chat_member"]["new_chat_member"]["user"]["is_bot"];
				$status=$body["my_chat_member"]["new_chat_member"]["status"];
				$type=$body["my_chat_member"]["chat"]["type"];
				
				if($newuser==1 && $status=='administrator' && $type=='channel')
				{
					
					$con_sql2=DataBot::cmd_sql();
								
					$tabchannels='tabchannels';
					
					if(!empty($body["my_chat_member"]["chat"]["id"]))
					{
						$channelid=$body["my_chat_member"]["chat"]["id"];
					}
				
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabchannels.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,channelid VARCHAR(25) DEFAULT "0",channeltitle VARCHAR(64) DEFAULT "0",channelusername VARCHAR(35) DEFAULT "0",chatid VARCHAR(30) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(25) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					
					$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.'');
					usleep(250000);
					$con=mysqli_num_rows($query);
					
					$row=[];
					$array=[];
					
					if(!empty($con))
					{
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
							$array[]=$row[$i][0];
						}
					}
					
					
					if(!empty($channelid))
					{
						if(in_array($channelid, $array)==FALSE)
						{
							if(!empty($body["my_chat_member"]["chat"]["title"]))
							{
								$channeltitle=$body["my_chat_member"]["chat"]["title"];
							}
							else
							{
								$channeltitle="0";
							}
							
							if(!empty($body["my_chat_member"]["chat"]["username"]))
							{
								$channelusername=$body["my_chat_member"]["chat"]["username"];
							}
							else
							{
								$channelusername="0";
							}
							
							$chatid=$body["my_chat_member"]["from"]["id"];
							
							if(!empty($body["my_chat_member"]["from"]["first_name"]))
							{
								$firstname=$body["my_chat_member"]["from"]["first_name"];
							}
							else
							{
								$firstname="0";
							}

							if(!empty($body["my_chat_member"]["from"]["last_name"]))
							{
								$lastname=$body["my_chat_member"]["from"]["last_name"];
							}
							else
							{
								$lastname="0";
							}
							
							if(!empty($body["my_chat_member"]["from"]["username"]))
							{
								$username=$body["my_chat_member"]["from"]["username"];
							}
							else
							{
								$username="0";
							}
							
							$actiondate=date('d.m.Y G:i');
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabchannels.' (channelid,channeltitle,channelusername,chatid,firstname,lastname,username,actiondate) VALUES ("'.$channelid.'", "'.$channeltitle.'", "'.$channelusername.'", "'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.$actiondate.'")');
							usleep(250000);
						}
					}
					
				}
				elseif($newuser==1 && $status=='administrator' && ($type=='supergroup' || $type=='group'))
				{
					$con_sql2=DataBot::cmd_sql();
				
					$tabchannels='tabgroups';
					
					if(!empty($body["my_chat_member"]["chat"]["id"]))
					{
						$channelid=$body["my_chat_member"]["chat"]["id"];
					}
				
					mysqli_query($con_sql2, 'CREATE TABLE IF NOT EXISTS '.$tabchannels.' (id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,channelid VARCHAR(25) DEFAULT "0",channeltitle VARCHAR(64) DEFAULT "0",channelusername VARCHAR(35) DEFAULT "0",chatid VARCHAR(30) DEFAULT "0",firstname VARCHAR(64) DEFAULT "0",lastname VARCHAR(64) DEFAULT "0",username VARCHAR(35) DEFAULT "0",actiondate VARCHAR(25) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
				
				
					$query=mysqli_query($con_sql2, 'SELECT channelid FROM '.$tabchannels.'');
					$con=mysqli_num_rows($query);
					
					$row=[];
					$array=[];
					
					if(!empty($con))
					{
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
							$array[]=$row[$i][0];
						}
					}
					
					if(!empty($channelid))
					{
						if(in_array($channelid, $array)==FALSE)
						{
							if(!empty($body["my_chat_member"]["chat"]["title"]))
							{
								$channeltitle=$body["my_chat_member"]["chat"]["title"];
							}
							else
							{
								$channeltitle="0";
							}
							
							if(!empty($body["my_chat_member"]["chat"]["username"]))
							{
								$channelusername=$body["my_chat_member"]["chat"]["username"];
							}
							else
							{
								$channelusername="0";
							}
							
							$chatid=$body["my_chat_member"]["from"]["id"];
							
							if(!empty($body["my_chat_member"]["from"]["first_name"]))
							{
								$firstname=$body["my_chat_member"]["from"]["first_name"];
							}
							else
							{
								$firstname="0";
							}

							if(!empty($body["my_chat_member"]["from"]["last_name"]))
							{
								$lastname=$body["my_chat_member"]["from"]["last_name"];
							}
							else
							{
								$lastname="0";
							}
							
							if(!empty($body["my_chat_member"]["from"]["username"]))
							{
								$username=$body["my_chat_member"]["from"]["username"];
							}
							else
							{
								$username="0";
							}
							
							$actiondate=date('d.m.Y G:i');
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabchannels.' (channelid,channeltitle,channelusername,chatid,firstname,lastname,username,actiondate) VALUES ("'.$channelid.'", "'.$channeltitle.'", "'.$channelusername.'", "'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.$actiondate.'")');
							usleep(250000);
						}
					}
				}
			}
		}

		return $body;
	}






/////////////////////METHODS//////////////////////////////
/////
	public function setMyCommands($params)
	{
		return $this->call("setMyCommands", $params);
	}
	
/////
	public function getChatMember( $params )
	{
		if( !is_array( $params ) )
		{
			$params = ['chat_id' => $params];
			
			if( !isset( $params['user_id'] ) && isset( $this->chatId ) )
			{
				$params['user_id'] = $this->chatId;
			}
		}
		
		return $this->call("getChatMember", $params);
	}


/////
	public function unbanChatMember( $params )
	{
		if( !is_array( $params ) )
		{
			$params = ['chat_id' => $params];
			
			if( !isset( $params['user_id'] ) && isset( $this->chatId ) )
			{
				$params['user_id'] = $this->chatId;
			}
		}
		
		return $this->call("unbanChatMember", $params);
	}

/////
	public function banChatMember( $params )
	{
		if( !is_array( $params ) )
		{
			$params = ['chat_id' => $params];
			
			if( !isset( $params['user_id'] ) && isset( $this->chatId ) )
			{
				$params['user_id'] = $this->chatId;
			}
		}
		
		return $this->call("banChatMember", $params);
	}
/////
	public function getMe(){
		
		return $this->call("getMe");
	}
	
/////	
	public function getChat( $params ){
		if( !is_array( $params ) ){
			$params = ['chat_id' => $params];
		}
		return $this->call("getChat", $params);
	}
	
/////
	public function sendChatAction( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("sendChatAction", $params);
	}
	
/////
	public function pinChatMessage( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("pinChatMessage", $params);
	}

/////
	public function unpinChatMessage( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("unpinChatMessage", $params);
	}
	
/////
	public function editMessageText( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("editMessageText", $params);
	}

/////
	public function editMessageReplyMarkup( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("editMessageReplyMarkup", $params);
	}	
	
/////
	public function editMessageCaption( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("editMessageCaption", $params);
	}
	
/////
	public function editMessageMedia( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("editMessageMedia", $params);
	}
	
/////
	public function deleteMessage( $params ){
		if( !is_array( $params ) ){
			$params = [ 'message_id' => $params ];
		}
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("deleteMessage", $params);
	}

/////
	public function answerCallbackQuery( $params ){
		if( !is_array( $params ) ){
			$params = ['callback_query_id' => $params];
		}
		return $this->call("answerCallbackQuery", $params);
	}

/////
	public function copyMessage( $params )
	{	
		if( !isset( $params['from_chat_id'] ) && isset( $this->chatId ) )
		{
			$params['from_chat_id'] = $this->chatId;
		}
			
		return $this->call("copyMessage", $params);
	}
	
/////
	public function sendAudio( $params, $caption = null ){
		if( is_string( $params ) ){
			$params = ['audio' => $params];
		}
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		if( !isset( $params['caption'] ) && isset( $caption ) ){
			$params['caption'] = $caption;
		}
		return $this->call("sendAudio", $params);
	}

/////
	public function sendDocument( $params, $caption = null ){
		if( is_string( $params ) ){
			$params = ['document' => $params];
		}
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		if( !isset( $params['caption'] ) && isset( $caption ) ){
			$params['caption'] = $caption;
		}
		return $this->call("sendDocument", $params);
	}
	
/////
	public function sendMediaGroup( $params, $caption = null ){
		
		if( is_string( $params ) ){
			$params = ['media' => $params];
		}
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		if( !isset( $params['caption'] ) && isset( $caption ) ){
			$params['caption'] = $caption;
		}
		return $this->call("sendMediaGroup", $params);
	}

/////
	public function getFile($data)
    {
		$file_id = $data[count($data) - 1]['file_id'];
		$file_path = $this->getFilePath($file_id);
		usleep(250000);
        return $this->copyFile($file_path);
    }
	
/////	
	public function getFiles($data)
    {
		$cnt=count($data);
		for($i=0;$i<$cnt;$i++)
		{
			$file_id = $data[$i]['file_id'];
			$file_path = $this->getFilePath($file_id);
			usleep(250000);
			return $this->copyFile($file_path);
		}
    }
	
/////
	public function getFilePath( $params ){
		if( is_string( $params ) ){
			$params = ['file_id' => $params];
		}
		return $this->call("getFile", $params);
	}
	
/////
    public function copyFile($file_path) 
	{
		$file_path=json_decode($file_path, TRUE);
		$file_path=$file_path['result']['file_path'];
			
		$file_from_tgrm = "https://api.telegram.org/file/bot".$this->apiToken."/".$file_path;
		$local_path=preg_replace('/.*\//', '', $file_path);
		$local_path=preg_replace('/^\h*\v+/m', '', $local_path);
		$local_path=preg_replace('/^[ \t]+|[ \t]+$/m', '', $local_path);
		$local_path=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $local_path);
		$local_path=ltrim($local_path);
		$local_path=rtrim($local_path);
		$local_path=preg_replace('/\s{2,}/', ' ', $local_path);
		
		$filen=preg_replace('/\..*/', '', $local_path);
		$fileo=preg_replace('/.*\./', '', $local_path);
		$time=time();
		$temp=$this->generate(10);
		if(file_exists(''.dirname(__FILE__).'/filestemp/')==FALSE) { mkdir(''.dirname(__FILE__).'/filestemp/'); }
		usleep(250000);
		return copy($file_from_tgrm, ''.dirname(__FILE__).'/filestemp/'.$time.'_'.$temp.'.'.$fileo.'');
    } 


///// 
   public function changePhoto($filesdir1) 
	{
		
		$files=glob(''.$filesdir1.'*.*');
		$filename1=''.end($files).'';
		$file_path=$filename1;
		
		if(preg_match('/png/', $file_path))
		{
			$img=ImageCreateFromPng($file_path);
		}
		
		if(preg_match('/webp/', $file_path))
		{
			$img=ImageCreateFromWebp($file_path);
		}
		
		if(preg_match('/gif/', $file_path))
		{
			$img=ImageCreateFromGif($file_path);
		}
		
		if(preg_match('/jpg/', $file_path) OR preg_match('/jpeg/', $file_path))
		{
			$img=ImageCreateFromJpeg($file_path);
		}
		
		unlink($file_path);
		
		$time=time();
		$temp=$this->generate(10);
		
		if(file_exists(''.dirname(__FILE__).'/photos/')==FALSE) { mkdir(''.dirname(__FILE__).'/photos/'); }
		usleep(250000);
		
		return imagejpeg($img, ''.dirname(__FILE__).'/photos/'.$time.'_'.$temp.'.jpg', 95);
    }
	
/////
	public function sendMessage( $params ){
		if( is_string( $params ) ){
			$params = ['text' => $params];
		}
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("sendMessage", $params);
	}

/////	
	public function sendPhoto( $params, $caption = null ){
		
		if( is_string( $params ) ){
			$params = ['photo' => $params];
		}
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		if( !isset( $params['caption'] ) && isset( $caption ) ){
			$params['caption'] = $caption;
		}
		return $this->call("sendPhoto", $params);
	}
	
/////
	public function generate($length1) 
	{
		$include_chars1 = "abcdefghijklmnopqrstuvwxyz";
		$charLength1 = strlen($include_chars1);
		$randomString1 = '';
		for($i1=0;$i1< $length1;$i1++) 
		{
			$randomString1 .= $include_chars1 [rand(0, $charLength1 - 1)];
		}
		return $randomString1;
	}
	
/////
	public function generate1($length1) 
	{
		$include_chars1 = "1234567890";
		$charLength1 = strlen($include_chars1);
		$randomString1 = '';
		for($i1=0;$i1< $length1;$i1++) 
		{
			$randomString1 .= $include_chars1 [rand(0, $charLength1 - 1)];
		}
		return $randomString1;
	}
	
/////
	public function generate2($length1) 
	{
		$include_chars1 = "abcdefghijklmnopqrstuvwxyz1234567890";
		$charLength1 = strlen($include_chars1);
		$randomString1 = '';
		for($i1=0;$i1< $length1;$i1++) 
		{
			$randomString1 .= $include_chars1 [rand(0, $charLength1 - 1)];
		}
		return $randomString1;
	}






/////		
/////
	public function call( $api_method = null, $params = null )
	{
		if( !$api_method )
		{
            throw new Exception('Required "api_method" not supplied for call()');
		}

		$query = "{$this->apiUrl}{$this->apiToken}/{$api_method}";
		
		if( is_array( $params ) )
		{
			$query .= "?" . http_build_query( $params );
		}

		if( $this->debug )
		{
			@file_put_contents( "log.txt", $query . "\n", FILE_APPEND );
		}

		$context = $this->getStreamContext();

		ini_set('display_errors' , 1 );
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		ob_start();
		
		$result = file_get_contents( $query, false, $context );
		$decoded = $result ? @json_decode( $result, 1 ) : [];
		$err = ob_get_clean();
		
		if( !$result || !$decoded['ok'] )
		{
			if( $this->debug )
			{
				@file_put_contents( "log.txt", "Api request fail - {$err}\n {$result}\n", FILE_APPEND );
			}
            //throw new Exception("Api request fail. Message: {$decoded['description']}. Query was: {$query}");
		}

		return $result;
	}

/////
	private function getStreamContext()
	{
		$stream_options=
		[
			'http' =>
			[
				'method'  => 'POST',
				'ignore_errors' => '1'
			]
		];
		
		
		/* if($this->debug)
		{
			@file_put_contents("log.txt", print_r( $stream_options, 1) . "\n", FILE_APPEND);
			
		} */
		
		return stream_context_create($stream_options);
	}

}