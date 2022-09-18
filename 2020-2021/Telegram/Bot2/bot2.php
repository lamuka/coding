<?php


//header('Content-type: text/html; charset=utf-8');

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
function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}
/////

//$user=array("", "", "");

/* if (file_exists('/var/www/html/bot/filestemp1/')==FALSE) { mkdir('/var/www/html/bot/filestemp1/'); }
if (file_exists('/var/www/html/bot/filestemp2/')==FALSE) { mkdir('/var/www/html/bot/filestemp2/'); }
if (file_exists('/var/www/html/bot/videostest/')==FALSE) { mkdir('/var/www/html/bot/videostest/'); }
if (file_exists('/var/www/html/bot/musictest/')==FALSE) { mkdir('/var/www/html/bot/musictest/'); }
if (file_exists('/var/www/html/bot/voicetest/')==FALSE) { mkdir('/var/www/html/bot/voicetest/'); }
if (file_exists('/var/www/html/bot/documentstest/')==FALSE) { mkdir('/var/www/html/bot/documentstest/'); }*/
/////
/////

$bot = new Bot();

$bot->init('php://input');


class Bot
{
	
    private $botToken="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

    private $apiUrl="https://api.telegram.org/bot";
	
/////

	
/////
	public function init($data_php)
    {
		
		$chat_id1='-0000000000000';
		$chat_id2='-1111111111111';
		
		$chatid1='000000000, 111111111, 222222222';
		
		$data=$this->getData($data_php);
	
		$chat_id=$data['message']['chat']['id'];
		$msgid=$data['message']['message_id'];

			
			
		if(preg_match('/'.$chat_id.'/', $chatid1))
		{
			
			
			if (array_key_exists('message', $data)) 
			{
				//file_put_contents('/var/www/html/bot/test.txt', print_r($data, 1) . PHP_EOL,FILE_APPEND);
				
					
				if (array_key_exists('media_group_id', $data['message'])) 
				{
					
					
					if(preg_match('/'.preg_quote($data['message']['media_group_id']).'/', file_get_contents('/var/www/html/bot/mediagroup.txt'))==FALSE)
					{
						$filesdir1='/var/www/html/bot/filestemp1/';
						$filesdir2='/var/www/html/bot/filestemp2/';
						$files=glob(''.$filesdir2.'*.*');
						
						if(count($files)>1)
						{
							$captionfile='/var/www/html/bot/caption.txt';
							
							if(file_exists($captionfile)) 
							{
								$caption=file_get_contents($captionfile);
							}
							else
							{
								$caption='';
							}
							
							
							
							$info=pathinfo($files[0]);
							
							if(preg_match('/jpg/', $info['extension']))
							{
								if($this->sendPhotoAll($chat_id1, $filesdir1, $caption))
								{
									usleep(350000);
								}
								
								if($this->sendPhotoAll($chat_id2, $filesdir2, $caption))
								{
									usleep(350000);
								}
							}
							else
							{
								$this->copyMsg($chat_id1, $chat_id, $msgid);
								usleep(350000);
								$this->copyMsg($chat_id2, $chat_id, $msgid);
								usleep(350000);
							}
							
							if(file_exists($captionfile)) 
							{
								unlink($captionfile);
							}
							
							$files=glob(''.$filesdir1.'*.*');
							$cnt2=count($files);
							for($o2=0;$o2<$cnt2;$o2++)
							{
								unlink($files[$o2]);
								usleep(150000);
							}
						
							$files=glob(''.$filesdir2.'*.*');
							$cnt2=count($files);
							for($o2=0;$o2<$cnt2;$o2++)
							{
								unlink($files[$o2]);
								usleep(150000);
							}
							
						}
						
						

						file_put_contents('/var/www/html/bot/mediagroup.txt', $data['message']['media_group_id']);
						
						
						if (array_key_exists('photo', $data['message'])) 
						{
						
							$text = $this->getFile($data['message']['photo'])
							? ""
							: "Возник какой-то глюк!";
						
							$this->sendMessage($chat_id, $text);
							usleep(350000);
						
							if (array_key_exists('caption', $data['message'])) 
							{
								$caption=$data['message']['caption'];
								file_put_contents('/var/www/html/bot/caption.txt', $caption);
							}
							else
							{
								$caption='';
							}
							
							
							$filesdir1='/var/www/html/bot/filestemp1/';
							
							if($this->changePhoto($filesdir1))
							{
								usleep(250000);
							}
							
						}
						else 
						{
						
							$this->copyMsg($chat_id1, $chat_id, $msgid);
							usleep(350000);
							$this->copyMsg($chat_id2, $chat_id, $msgid);
							usleep(350000);
						
							if (array_key_exists('caption', $data['message'])) 
							{
								$caption=$data['message']['caption'];
								file_put_contents('/var/www/html/bot/caption.txt', $caption);
							}
							else
							{
								$caption='';
							}
						}
					}
					else
					{
						
						if (array_key_exists('photo', $data['message'])) 
						{
						
							$text = $this->getFile($data['message']['photo'])
							? ""
							: "Возник какой-то глюк!";
						
							$this->sendMessage($chat_id, $text);
							usleep(350000);
						
							if (array_key_exists('caption', $data['message'])) 
							{
								$caption=$data['message']['caption'];
								file_put_contents('/var/www/html/bot/caption.txt', $caption);
							}
							else
							{
								$caption='';
							}
							
							
							$filesdir1='/var/www/html/bot/filestemp1/';
							
							if($this->changePhoto($filesdir1))
							{
								usleep(250000);
							}
						}
						else 
						{
							
							$this->copyMsg($chat_id1, $chat_id, $msgid);
							usleep(350000);
							$this->copyMsg($chat_id2, $chat_id, $msgid);
							usleep(350000);
						
							if (array_key_exists('caption', $data['message'])) 
							{
								$caption=$data['message']['caption'];
								file_put_contents('/var/www/html/bot/caption.txt', $caption);
							}
							else
							{
								$caption='';
							}
					
						}	
					}
				}
				else
				{
					
					if(file_exists('/var/www/html/bot/mediagroup.txt')) { unlink('/var/www/html/bot/mediagroup.txt'); }
					
					$filesdir1='/var/www/html/bot/filestemp1/';
					$filesdir2='/var/www/html/bot/filestemp2/';
					$files=glob(''.$filesdir2.'*.*');
					
					if(count($files)>1)
					{
						$captionfile='/var/www/html/bot/caption.txt';
						
						if(file_exists($captionfile)) 
						{
							$caption=file_get_contents($captionfile);
						}
						else
						{
							$caption='';
						}
						
						
						
						$info=pathinfo($files[0]);
						
						if(preg_match('/jpg/', $info['extension']))
						{
							
							
							if($this->sendPhotoAll($chat_id1, $filesdir1, $caption))
							{
								usleep(350000);
							}
							
							if($this->sendPhotoAll($chat_id2, $filesdir2, $caption))
							{
								usleep(350000);
							}
						}
						
						else
						{
							$this->copyMsg($chat_id1, $chat_id, $msgid);
							usleep(350000);
							$this->copyMsg($chat_id2, $chat_id, $msgid);
							usleep(350000);
						}
						
						if(file_exists($captionfile)) 
						{
							unlink($captionfile);
						}
						
						$files=glob(''.$filesdir1.'*.*');
						$cnt2=count($files);
						for($o2=0;$o2<$cnt2;$o2++)
						{
							unlink($files[$o2]);
							usleep(150000);
						}
					
						$files=glob(''.$filesdir2.'*.*');
						$cnt2=count($files);
						for($o2=0;$o2<$cnt2;$o2++)
						{
							unlink($files[$o2]);
							usleep(150000);
						}
						
					}
					
					
					if (array_key_exists('photo', $data['message'])) 
					{
						
						if($this->copyMsg($chat_id1, $chat_id, $msgid))   
						{
							usleep(350000);
						}
						
						$text = $this->getFile($data['message']['photo'])
						? ""
						: "Возник какой-то глюк!";
					
						$this->sendMessage($chat_id, $text);
						usleep(350000);
					
						if (array_key_exists('caption', $data['message'])) 
						{
							$caption=$data['message']['caption'];
						}
						else
						{
							$caption='';
						}
						

						if($this->changePhoto($filesdir1))
						{
							usleep(250000);
						}
						
						if($this->sendPhoto($chat_id2, $filesdir2, $caption))
						{
							usleep(250000);
						}
						
						$files=glob(''.$filesdir1.'*.*');
						$cnt2=count($files);
						for($o2=0;$o2<$cnt2;$o2++)
						{
							unlink($files[$o2]);
							usleep(150000);
						}
						
						$files=glob(''.$filesdir2.'*.*');
						$cnt2=count($files);
						for($o2=0;$o2<$cnt2;$o2++)
						{
							unlink($files[$o2]);
							usleep(150000);
						}
						
					}
					else
					{
						$this->copyMsg($chat_id1, $chat_id, $msgid);
						usleep(350000);
						$this->copyMsg($chat_id2, $chat_id, $msgid);
						usleep(350000);
					}
					
				}
			}
		}			

		//else
		//{
			//$this->sendMessage($chat_id, "К сожалению, вы еще не готовы для работы с ботом!!");
			//file_put_contents('/var/www/html/bot/chatids.txt', $chat_id . "\n",FILE_APPEND);
			//usleep(350000);
		//}
	
	}
	
    

	///// 
	public function forwardMsg($chat_id, $from_chat_id, $msgid)
    {
        $this->requestToTelegram([
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
			'message_id' => $msgid,
			'disable_notification' => TRUE
        ], "forwardMessage");
    }
	
	///// 	
	public function copyMsg($chat_id, $from_chat_id, $msgid)
    {
        $this->requestToTelegram([
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
			'message_id' => $msgid,
			'disable_notification' => TRUE
        ], "copyMessage");
    }
	
	///// 
    public function sendMessage($chat_id, $text)
    {
        $this->requestToTelegram([
            'chat_id' => $chat_id,
            'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			//'reply_markup' => json_encode($this->keyboards['default']),
			//'reply_markup' => json_encode( ['inline_keyboard'=> $this->keyboards['inline']]),
        ], "sendMessage");
    }
	
	
	
	///// 
    public function getFile($data)
    {
		$file_id = $data[count($data) - 1]['file_id'];
		$file_path = $this->getFilePath($file_id);
		
        return $this->copyFile($file_path);
    }

	/////
    public function getFilePath($file_id) 
	{
		$array = json_decode($this->requestToTelegram(['file_id' => $file_id], "getFile"), TRUE);
        return  $array['result']['file_path'];
    }

	/////
    public function copyFile($file_path) 
	{
		$file_from_tgrm = "https://api.telegram.org/file/bot".$this->botToken."/".$file_path;
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
		$temp=generate(10);
		
		return copy($file_from_tgrm, '/var/www/html/bot/filestemp1/'.$time.'_'.$temp.'.'.$fileo.'');
    }
////////////////////
///////////////////
	public function sendPhotoAll($chat_id, $filesdir2, $caption)
    {
		
		$media=[];
		$files=glob(''.$filesdir2.'*.*');
		$cnt3=count($files);
		for($o3=0;$o3<$cnt3;$o3++)
		{
			$filename=$files[$o3];
			$filename=preg_replace('/.*\//', '', $filename);
			$filedir=str_replace('/var/www/html', 'https://domain.com', $filesdir2);
			
			if($o3==0)
			{
				//file_put_contents('/var/www/html/bot/end.txt', $filename);
				$put=['type' => 'photo', 'media' =>  ''.$filedir.'/'.$filename.'', 'caption' => ''.$caption.'' ];
			}
			else
			{
				$put=['type' => 'photo', 'media' =>  ''.$filedir.'/'.$filename.'' ];
			}
		
			$media[$o3]=$put;
		
		}
	
		$this->requestToTelegram([
			'chat_id' => $chat_id,
			'media' => json_encode($media),
			'disable_notification' => TRUE
        ], "sendMediaGroup");
		
	}
///////////////////	
	public function sendOtherAll($chat_id, $filesdir1, $caption)
    {
		
		$media=[];
		$files=glob(''.$filesdir1.'*.*');
		$cnt8=count($files);
		$info=pathinfo($files[0]);
		
		for($o8=0;$o8<$cnt8;$o8++)
		{
			$filename=$files[$o8];
			$filename=preg_replace('/.*\//', '', $filename);
			$filedir=str_replace('/var/www/html', 'https://domain.com', $filesdir1);
			
			
			if(preg_match('/mp4/', $info['extension']))
			{
				if($o8==0)
				{
					$put=['type' => 'video', 'media' =>  ''.$filedir.'/'.$filename.'', 'caption' => ''.$caption.'' ];
				}
				else
				{
					$put=['type' => 'video', 'media' =>  ''.$filedir.'/'.$filename.'' ];
				}
			}
			
			if(preg_match('/mp3/', $info['extension']))
			{
				if($o8==0)
				{
					$put=['type' => 'audio', 'media' =>  ''.$filedir.'/'.$filename.'', 'caption' => ''.$caption.'' ];
				}
				else
				{
					$put=['type' => 'audio', 'media' =>  ''.$filedir.'/'.$filename.'' ];
				}
			}
			
			if(preg_match('/gif/', $info['extension']) || preg_match('/pdf/', $info['extension']) || preg_match('/zip/', $info['extension']))
			{
				if($o8==0)
				{
					$put=['type' => 'document', 'media' =>  ''.$filedir.'/'.$filename.'', 'caption' => ''.$caption.'' ];
				}
				else
				{
					$put=['type' => 'document', 'media' =>  ''.$filedir.'/'.$filename.'' ];
				}
			}
	
			$media[$o3]=$put;
			
		}
	
		$this->requestToTelegram([
			'chat_id' => $chat_id,
			'media' => json_encode($media),
			'caption' => $caption,
			'disable_notification' => TRUE
        ], "sendMediaGroup");
		
	}
	
	///// 
	public function sendPhoto($chat_id, $filesdir2, $caption)
    {
		$files=glob(''.$filesdir2.'*.*');
		$filename1=''.end($files).'';
		$filename1=preg_replace('/.*\//', '', $filename1);
		$filedir1=str_replace('/var/www/html', 'https://domain.com', $filesdir2);
		$photo="$filedir1/$filename1";
		
		$this->requestToTelegram([
			'chat_id' => $chat_id,
			'photo' => $photo,
			'caption' => $caption,
			'disable_notification' => TRUE
		], "sendPhoto");
		
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
			
			$filelogo='/var/www/html/bot/logo.png';
			$imglogo=ImageCreateFromPNG($filelogo);
			$width1=imagesx($imglogo);
			$height1=imagesy($imglogo);
			$cft1=$width1/$height1;
					
			$mainx=imagesx($img);
			$mainy=imagesy($img);
			$percents=25;
			
				
			if($mainx>$mainy)
			{
			$w=floor($mainx*$percents/100);
			$h=floor($w/$cft1);
			}
			
			if($mainx<$mainy)
			{
			$h=floor($mainy*$percents/100);
			$w=floor($h*$cft1);
			}
			
			if($mainx==$mainy)
			{
			$w=floor($mainx*$percents/100);
			$h=floor($w/$cft1);
			}
			
	
			$im1=imagecreateTRUEcolor($w,$h);
			imagealphablending($im1, false);
			imagesavealpha($im1,TRUE);
			$transparent=imagecolorallocatealpha($im1, 255, 255, 255, 127);
			imagefilledrectangle($im1, 0, 0, $w, $h, $transparent);
			imagecopyresampled($im1,$imglogo,0,0,0,0,$w,$h,imagesx($imglogo),imagesy($imglogo));
			
			$width2=imagesx($im1);
			$height2=imagesy($im1);
			
			$wborder=5;
			$hborder=5;
			
			//$difwidth2=$mainx-$width2-35;
			$difwidth=mt_rand(floor($mainx*$wborder/100), (floor($mainx*$wborder/100)+15));
			$difheight=mt_rand(floor($mainy*$hborder/100), (floor($mainy*$hborder/100)+15));
			$difwidth2=$difwidth;
			$difheight2=$mainy-$height2-$difheight;
			$difwidth3=$mainx-$width2-$difwidth;
			$difheight3=$mainy-(2*$height2);
			$difheight4=$mainy-0.9*$mainy;
			
			$img1=imagecreateTRUEcolor($mainx, $mainy);
			$white=imagecolorallocate($img1, 255, 255, 255);
			imagefilledrectangle($img1, 0, 0, $mainx, $mainy, $white);
		
			imagecopy($img1, $img, 0, 0, 0, 0, $mainx, $mainy);
			//imagecopy($img1, $im1, $difwidth2, $difheight2, 0, 0, $width2, $height2);
			//imagecopy($img1, $im1, $difwidth3, $difheight3, 0, 0, $width2, $height2);
			imagecopy($img1, $im1, $difwidth2, $difheight4, 0, 0, $width2, $height2);
			
			$time=time();
			$temp=generate(10);	
			return imagejpeg($img1, '/var/www/html/bot/filestemp2/'.$time.'_'.$temp.'.jpg', 85);
		
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