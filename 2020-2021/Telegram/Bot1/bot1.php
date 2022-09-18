<?php


header('Content-type: text/html; charset=utf-8');

function generate($length1) 
{
    $include_chars1 = "abcdefghijklmnopqrstuvwxyz";
    $charLength1 = strlen($include_chars1);
    $randomString1 = '';
    for ($i1 = 0; $i1 < $length1; $i1++) {
        $randomString1 .= $include_chars1 [rand(0, $charLength1 - 1)];
    }
    return $randomString1;
}
/////
/* if (file_exists('./photos/')==FALSE) { mkdir('./photos/'); }
if (file_exists('./photos1/')==FALSE) { mkdir('./photos1/'); }
if (file_exists('./photos2/')==FALSE) { mkdir('./photos2/'); } */
/////

$bot = new Bot();

$bot->init('php://input');


class Bot
{
	
	
	
    private $botToken="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

    private $apiUrl="https://api.telegram.org/bot";
	
/////
/////
	public function init($data_php)
    {
		date_default_timezone_set('Europe/Kiev');
		$date=date("d.m.y");
		$chat_id1='-0000000000000';
		
		$chatid1='000000000, 111111111, 222222222';
		
		$data=$this->getData($data_php);
	
		$chat_id=$data['message']['chat']['id'];
			
		if(preg_match('/'.$chat_id.'/', $chatid1))
		{
			
			
			/* if(@preg_match('/'.$chat_id.'/', file_get_contents('./chatid.txt'))==FALSE)
			{
				file_put_contents('./chatid.txt', $chat_id . "\n",FILE_APPEND);
			}
			
			if (array_key_exists('channel_post', $data)) 
			{
				$channel_id1 = $data['channel_post']['chat']['id'];
				
				if(@preg_match('/'.$channel_id1.'/', file_get_contents('./channelid.txt'))==FALSE)
				{
					file_put_contents('./channelid.txt', $channel_id1 . "\n",FILE_APPEND);
				}
			} */
			
			
			// включаем логирование будет лежать рядом с этим файлом
			// $this->setFileLog($data, "log.txt");

	
			if (array_key_exists('message', $data)) 
			{
	
			
				if ($data['message']['text'] == "/start") 
				{
					$this->sendMessage($chat_id, "Приветствую!");
					usleep(250000);
				} 
				
								
				if (array_key_exists('photo', $data['message'])) 
				{
					
					//file_put_contents('./caption.txt', print_r($data, 1));
					
					$text = $this->getPhoto($data['message']['photo'])
						? ""
						: "Возник какой-то глюк!";
	
					$this->sendMessage($chat_id, $text);
					usleep(250000);
					
					$dir='/var/www/html/bot/photos/';
					$files=glob(''.$dir.'*.*');
					$filename=''.end($files).'';
					$filename=preg_replace('/.*\//', '', $filename);
				
					$text="https://domain.com/bot/photos/$filename";
					$this->sendMessage($chat_id, $text);
					usleep(250000);
					/* if(@preg_match('/'.$date.'/', file_get_contents('./imagelinks.txt'))==FALSE)
					{
						file_put_contents('./imagelinks.txt', "======================================" . "\n",FILE_APPEND);
						file_put_contents('./imagelinks.txt', "\n" . "\n" . $date . "\n" . "\n",FILE_APPEND);
					}
					file_put_contents('./imagelinks.txt', $text . "\n",FILE_APPEND); */
					
					//$text="https://domain.com/bot/imagelinks.txt";
					//$this->sendFile($chat_id1, $text);
					
					//$text=file_get_contents('/var/www/html/bot/imagelinks.txt');
					//$this->sendMessage($chat_id1, $text);
				}
			}
		}
		else
		{
			$this->sendMessage($chat_id, "К сожалению, вы еще не готовы для работы с ботом!!");
			usleep(250000);
		}
	


	
    }



///// 
    public function sendMessage($chat_id, $text)
    {
        $this->requestToTelegram([
            'chat_id' => $chat_id,
            'text' => $text,
			'disable_notification' => true,
			'disable_web_page_preview' => true
        ], "sendMessage");
    }
	
///// 

public function sendFile($chat_id, $text)
    {
        $this->requestToTelegram([
            'chat_id' => $chat_id,
            'document' => $text,
			'disable_notification' => true
        ], "sendDocument");
    }
	
///// 

	public function sendPhoto($chat_id, $photo, $caption)
    {
        $this->requestToTelegram([
            'chat_id' => $chat_id,
            'photo' => $photo,
			'caption' => $caption,
			'disable_notification' => true
        ], "sendPhoto");
    }

///// 
    public function getPhoto($data)
    {
		$file_id = $data[count($data) - 1]['file_id'];
		$file_path = $this->getPhotoPath($file_id);
		
        return $this->copyPhoto($file_path);
    }

/////   
    public function getPhotoPath($file_id) 
	{
		$array = json_decode($this->requestToTelegram(['file_id' => $file_id], "getFile"), TRUE);
        return  $array['result']['file_path'];
    }

///// 
    public function copyPhoto($file_path) 
	{
       $file_from_tgrm = "https://api.telegram.org/file/bot".$this->botToken."/".$file_path;
		$local_path=str_replace('photos/', '', $file_path);
		$filen=preg_replace('/\..*/', '', $local_path);
		$fileo=preg_replace('/.*\./', '', $local_path);
		$time=time();
		$temp=generate(10);
		
	   return copy($file_from_tgrm, './photos/'.$time.'_'.$temp.'.'.$fileo.'');
    }

///// 
	public function changePhoto($file_path) 
	{
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
		
		$mainx=imagesx($img);
		$mainy=imagesy($img);
		
		$filelogo='/var/www/html/bot/logo.png';
		$imglogo=ImageCreateFromPNG($filelogo);
		$width2=imagesx($imglogo);
		$height2=imagesy($imglogo);
		$difwidth2=$mainx-$width2-35;
		$difheight2=$mainy-$height2;
		
		$img1=imagecreatetruecolor($mainx, $mainy);
		$white=imagecolorallocate($img1, 255, 255, 255);
		imagefilledrectangle($img1, 0, 0, $mainx, $mainy, $white);
	
		imagecopy($img1, $img, 0, 0, 0, 0, $mainx, $mainy);
		imagecopy($img1, $imglogo, $difwidth2, 40, 0, 0, $width2, $height2);
		
		$time=time();
		$temp=generate(10);
		
		return imagejpeg($img1, './photos1/'.$time.'_'.$temp.'.jpg', 90);
	   
    }

///// 
    function setFileLog($data, $file)
    {
        $fh = fopen($file, 'a') or die('can\'t open file');
        ((is_array($data)) || (is_object($data))) ? fwrite($fh, print_r($data, TRUE) . "\n") : fwrite($fh, $data . "\n");
        fclose($fh);
    }

///// 
    function getData($data)
    {
        return json_decode(file_get_contents($data), TRUE);
    }

///// 
    function requestToTelegram($data, $type)
    {
        $result = null;

        if (is_array($data)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $this->botToken . '/' . $type);
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $result = curl_exec($ch);
            curl_close($ch);
        }
        return $result;
    }
}