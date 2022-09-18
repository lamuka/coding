<?php


set_time_limit(0);

if(file_exists(''.dirname(__FILE__).'/statistics.txt'))
{
	include_once(''.dirname(__FILE__).'/DataBot.php');

	$bot=new DataBot();
	
	if(file_exists(''.dirname(__FILE__).'/resultsfirst.txt'))
	{
		$chatidadmin=$bot->chatidadmin;

		$textadmin='<b>Запрос финальной статистики успешно отправлен</b>';
	
		$bot->api->sendMessage([
		'chat_id' => $chatidadmin,
		'text' => $textadmin,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change_results']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
	else
	{
		$chatidadmin=file_get_contents(''.dirname(__FILE__).'/statistics.txt');

		$textadmin='<b>Запрос статистики успешно отправлен</b>';
	
		$bot->api->sendMessage([
		'chat_id' => $chatidadmin,
		'text' => $textadmin,
		//'reply_markup' => json_encode( ['inline_keyboard'=>$bot->keyboards['inline_admin_change_results']]),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
	}
	
	$tabusers='tabusers';
	$tabcasinousers='tabcasinousers';
	$tablotteryusers='tablotteryusers';
	$tabticketsall='tabticketsall';		
	$tabbanned='tabbanned';
	
	array_map('unlink', glob(''.dirname(__FILE__).'/pdf/*.zip'));
	usleep(500000);
	
	array_map('unlink', glob(''.dirname(__FILE__).'/pdf/*.xlsx'));
	usleep(500000);
	
	//include(''.dirname(__FILE__).'/pdf/tcpdf.php');

	include_once(''.dirname(__FILE__).'/SimpleXLSXGen.php');
	
	$xlsx= new SimpleXLSXGen;
	



/////////////////////////2222222222222222////////////////////////
	$quantuserall=0;
	
	if($bot->cmd_if_empty($tabusers)==FALSE)
	{
		$con_sql2=$bot->cmd_sql();
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabusers.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		$quantuserall=$con;
		
		$row2=[];
		$row2[]=['<b>Чат ID</b>', '<b>Имя</b>', '<b>Фамилия</b>', '<b>Имя пользователя</b>', '<b>Дата регистрации в боте</b>', '<b>Телеграм ID реферала</b>'];
		
	
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
			
			if(preg_match('/@/', $row[$i][4]))
			{
				$put1=str_replace('@', '', $row[$i][4]);
				$put='<a href="https://t.me/'.$put1.'">'.$row[$i][4].'</a>';
				
			}
			else
			{
				$put=$row[$i][4];
				
			}
				
			$row2[]=[$row[$i][1], $row[$i][2], $row[$i][3], $put, $row[$i][5], $row[$i][6]];
			
		}
		

		$xlsx->addSheet( $row2, 'Все пользователи бота ('.$quantuserall.')' );
		sleep(1);
		$xlsx->saveAs('./pdf/статистика.xlsx');
		sleep(1);
		
		
		if(isset($put)) { unset($put); }
		if(isset($put1)) { unset($put1); }
		if(isset($query)) { unset($query); }
		if(isset($con)) { unset($con); }
		if(isset($row)) { unset($row); }
		if(isset($row2)) { unset($row2); }
	}


	
///////////////////////////3333333333333333333333333////////////////////////////
	if($bot->cmd_if_empty($tabusers)==FALSE)
	{
		$con_sql2=$bot->cmd_sql();
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabusers.'');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		
		$a=0;
		
		$row2=[];
		$row2[]=['<b>Чат ID</b>', '<b>Имя</b>', '<b>Фамилия</b>', '<b>Имя пользователя</b>', '<b>Дата регистрации в боте</b>', '<b>Телеграм ID реферала</b>'];
		
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
			$userchatid=$row[$i][1];
			
	
			if($bot->cmd_sql_searchchatidtable($userchatid, $tablotteryusers)==FALSE)
			{
				if(preg_match('/@/', $row[$i][4]))
				{
					$put1=str_replace('@', '', $row[$i][4]);
					$put='<a href="https://t.me/'.$put1.'">'.$row[$i][4].'</a>';
					
				}
				else
				{
					$put=$row[$i][4];
					
				}
				
				$row2[]=[$row[$i][1], $row[$i][2], $row[$i][3], $put, $row[$i][5], $row[$i][6]];
				

				$a++;
			}
		}
		
		$quantusersnotlot=$a;
		
		$xlsx->addSheet( $row2, 'Не участвуют в розыгрыше ('.$quantusersnotlot.')' );
		sleep(1);
		$xlsx->saveAs('./pdf/статистика.xlsx');
		sleep(1);
		
		
		if(isset($put)) { unset($put); }
		if(isset($put1)) { unset($put1); }
		if(isset($query)) { unset($query); }
		if(isset($con)) { unset($con); }
		if(isset($row)) { unset($row); }
		if(isset($query1)) { unset($query1); }
		if(isset($con1)) { unset($con1); }
		if(isset($row1)) { unset($row1); }
		if(isset($uu)) { unset($uu); }
		if(isset($a)) { unset($a); }
		if(isset($row2)) { unset($row2); }
	}


//////////////////////////111111111111111111111////////////////////////////
	$quantuserlottery=0;
	
	if($bot->cmd_if_exists($tablotteryusers) && $bot->cmd_if_empty($tablotteryusers)==FALSE)
	{
		$con_sql2=$bot->cmd_sql();
		
		$query=mysqli_query($con_sql2, 'SELECT chatid, username, actiondate, firstname, lastname FROM '.$tablotteryusers.'');
		usleep(250000);

		$con=mysqli_num_rows($query);
		$quantuserlottery=$con;
			
	
		if(!empty(mysqli_num_rows($query)))
		{
			$row2=[];
			$row2[]=['<b>Казино ID</b>', '<b>Имя</b>', '<b>Фамилия</b>', '<b>ДР</b>', '<b>Почта</b>', '<b>Телефон</b>', '<b>Кол-во депозитов</b>', '<b>Депозит сумма</b>', '<b>Дата обновления</b>', '<b>Чат ID</b>', '<b>Имя</b>', '<b>Фамилия</b>', '<b>Имя пользователя</b>', '<b>Кол-во билетов</b>', '<b>Дата регистр. в розыгрыше</b>'];
			
			$row=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$chatidlotteryuser=$row[$i][0];
				$firstnamelotteryuser=$row[$i][3];
				$lastnamelotteryuser=$row[$i][4];
				$usernamelotteryuser=$row[$i][1];
				$datereglotteryuser=$row[$i][2];
				
				$ticksuser=0;
				
				if($this->cmd_if_empty($tabticketsall)==FALSE)
				{
					$query1=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatidlotteryuser.'"');
					usleep(100000);

					if(!empty(mysqli_num_rows($query1)))
					{
						$con1=mysqli_num_rows($query1);
						$ticksuser=$con1;
					}
				}
		
				
				$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabcasinousers.' WHERE chatid="'.$chatidlotteryuser.'"');
				usleep(100000);
				
				if(!empty(mysqli_num_rows($query1)))
				{
					$con1=mysqli_num_rows($query1);
	
					$row1=[];
					
					for($i1=0;$i1<$con1;$i1++)
					{
						mysqli_data_seek($query1, $i1);
						$row1[$i1]=mysqli_fetch_row($query1);
						
						$casinoid=$row1[$i1][2];
						$firstname=$row1[$i1][3];
						$lastname=$row1[$i1][4];
						$phone=$row1[$i1][5];
						$email=$row1[$i1][6];
						$deposit=$row1[$i1][7];
						$date=$row1[$i1][8];
						$depositquan=$row1[$i1][9];
						$birthday=$row1[$i1][10];
						
						
						if(preg_match('/@/', $usernamelotteryuser))
						{
							$put1=str_replace('@', '', $usernamelotteryuser);
							$put='<a href="https://t.me/'.$put1.'">'.$usernamelotteryuser.'</a>';
							
						}
						else
						{
							$put=$usernamelotteryuser;
							
						}

						$row2[]=[$casinoid, $firstname, $lastname, $birthday, $email, $phone, $depositquan, $deposit, $date, $chatidlotteryuser, $firstnamelotteryuser, $lastnamelotteryuser, $put, $ticksuser, $datereglotteryuser];
					}
				}

			}
		}
		
		//$xlsx = SimpleXLSXGen::fromArray( $row2 );
		//$xlsx->saveAs('./pdf/участвующие.xlsx');		
		//$xlsx = SimpleXLSXGen::fromArray( $row2 );
		//$xlsx = SimpleXLSXGen::fromArray( $row2 );
		//$xlsx->saveAs('./pdf/пользователи.xlsx');		
		//$xlsx= new SimpleXLSXGen;
		//$xlsx = SimpleXLSXGen::fromArray( $row2 );
		//$xlsx = SimpleXLSXGen::addSheet( $row2, 'пользователи' );
		//$row2[]=['Пользователи на '.date('d.m.Y G:i').' (всего - '.$quantuserall.')'];
		//$row2[]=['Участники розыгрыша на '.date('d.m.Y G:i').' (всего - '.$quantuserlottery.')'];
		//$xlsx = SimpleXLSXGen::addSheet( $row2, 'участвующие' );
		//$xlsx->saveAs('./pdf/статистика.xlsx');
		
		
		$xlsx->addSheet( $row2, 'Участники розыгрыша ('.$quantuserlottery.')' );
		sleep(2);
		$xlsx->saveAs('./pdf/статистика.xlsx');
		sleep(2);
		
		if(isset($put)) { unset($put); }
		if(isset($put1)) { unset($put1); }
		if(isset($query)) { unset($query); }
		if(isset($con)) { unset($con); }
		if(isset($row)) { unset($row); }
		if(isset($query1)) { unset($query1); }
		if(isset($con1)) { unset($con1); }
		if(isset($row1)) { unset($row1); }
		if(isset($row2)) { unset($row2); }
	}


	
	
	//////////////4444444444444444////////////////////////
	$quantuserbanned=0;
	
	if($bot->cmd_if_empty($tabbanned)==FALSE)
	{
		$con_sql2=$bot->cmd_sql();

		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbanned.'');
		usleep(250000);
		
		$con=mysqli_num_rows($query);
		
		$quantuserbanned=$con;
		
		$row2=[];
		$row2[]=['<b>Чат ID</b>', '<b>Имя</b>', '<b>Фамилия</b>', '<b>Имя пользователя</b>', '<b>Дата регистрации в боте</b>', '<b>Телеграм ID реферала</b>'];
		
	
		$row=[];
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
			
			if(preg_match('/@/', $row[$i][4]))
				{
					$put1=str_replace('@', '', $row[$i][4]);
					$put='<a href="https://t.me/'.$put1.'">'.$row[$i][4].'</a>';
					
				}
				else
				{
					$put=$row[$i][4];
					
				}
				
				
			$row2[]=[$row[$i][1], $row[$i][2], $row[$i][3], $put, $row[$i][5], $row[$i][6]];
			
		}
		
		$xlsx->addSheet( $row2, 'Забаненные ('.$quantuserbanned.')' );
		sleep(1);
		$xlsx->saveAs('./pdf/статистика.xlsx');
		sleep(1);
		
		
		if(isset($put)) { unset($put); }
		if(isset($put1)) { unset($put1); }
		if(isset($query)) { unset($query); }
		if(isset($con)) { unset($con); }
		if(isset($row)) { unset($row); }
		if(isset($row2)) { unset($row2); }
	}
	
	
///////////////////////////////////END USERS/////////////////////



				
////////////////////////////////////////////////TICKETS///////////////////////////////////////////////////////////
	///////////////////55555555555555555555555555////////////////////////////
	$textall="";
	$quantall=0;
	$cntrefall=0;
	$cntdepall=0;
	$cntpublicall=0;
	$cntdataprofileall=0;
	$cntdataemailall=0;
	$cntdataphoneall=0;
	$casinolotteryusers=0;
	
	if($bot->cmd_if_exists($tabticketsall) && $bot->cmd_if_empty($tabticketsall)==FALSE)
	{
		$con_sql2=$bot->cmd_sql();
		
		$row2=[];
		
		$row2[]=['<b>Пользователь</b>', '<b>Всего билетов</b>', '<b>Билеты за рефералки (всего)</b>', '<b>Билеты за рефералки</b>', '<b>Билеты за депозиты (всего)</b>', '<b>Билеты за депозиты</b>', '<b>Билеты за заполненный профиль всего</b>', '<b>Билеты за заполненный профиль</b>', '<b>Билеты за подтвержденную почту всего</b>', '<b>Билеты за подтвержденную почту</b>', '<b>Билеты за подтвержденный номер телефона всего</b>', '<b>Билеты за подтвержденный номер телефона</b>', '<b>Билеты за публикации всего</b>', '<b>Билеты за публикации</b>'];
	
		$query=mysqli_query($con_sql2, 'SELECT chatid, firstname, lastname, username, actiondate FROM '.$tablotteryusers.'');
		usleep(250000);
		
		if(!empty(mysqli_num_rows($query)))
		{
			$con=mysqli_num_rows($query);
	
			$row=[];
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				$chatidlotteryuser=$row[$i][0];		
				$fnuserslotteryuser=$row[$i][1];
				$lnuserslotteryuser=$row[$i][2];

				$usernamelotteryuser=$row[$i][3];
				
	
				if(preg_match('/@/', $usernamelotteryuser)==FALSE)
				{
					$usernamelotteryuser="нет имени пользователя";
				}
				else
				{
					$put1=str_replace('@', '', $usernamelotteryuser);
					$usernamelotteryuser='<a href="https://t.me/'.$put1.'">'.$usernamelotteryuser.'</a>';
				}
				
	
				$datereglotteryuser=$row[$i][4];
				
				/////////
				
				
				
				$query1=mysqli_query($con_sql2, 'SELECT casinoid FROM '.$tabcasinousers.' WHERE chatid="'.$chatidlotteryuser.'"');
				usleep(250000);
				
				if(!empty(mysqli_num_rows($query1)))
				{	
					$con1=mysqli_num_rows($query1);
				
					$row1=[];
						
					for($i1=0;$i1<$con1;$i1++)
					{
						mysqli_data_seek($query1, $i1);
						$row1[$i1]=mysqli_fetch_row($query1);
					}
					
					$casinoidlotteryuser=$row1[0][0];
				}
				else
				{
					$casinoidlotteryuser="не зарегистрирован в Casino";
					
				}
				//////////
				
				
				////////////////refer//////////////////
				$tickets_ref="";
				$cntref=0;
				
				
				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatidlotteryuser.'" AND status="refer"');
				usleep(250000);
				
				if(!empty(mysqli_num_rows($query4)))
				{	
					$con4=mysqli_num_rows($query4);
				
					$cntref=$con4;
					$cntrefall=$cntrefall+$cntref;
					
					
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
				
				
				
				
				/////////////deposit////////////////
				$tickets_dep="";
				$cntdep=0;
				
				
				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatidlotteryuser.'" AND status="deposit"');
				usleep(250000);
	
				if(!empty(mysqli_num_rows($query4)))
				{	
					$con4=mysqli_num_rows($query4);
				
					$cntdep=$con4;
					$cntdepall=$cntdepall+$cntdep;
					
					
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
	
				
				
				
				/////////////////////////////////////
				///////////////fio///////////////////
				$tickets_dataprofile="";
				$cntdataprofile=0;
				
				
				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatidlotteryuser.'" AND status="data_fio"');
				usleep(250000);
					
				if(!empty(mysqli_num_rows($query4)))
				{	
					$con4=mysqli_num_rows($query4);
				
				
					$cntdataprofile=$con4;
					$cntdataprofileall=$cntdataprofileall+$cntdataprofile;
					
					
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
				}
				
				
				
				/////////////email//////////////////
				$tickets_dataemail="";
				$cntdataemail=0;
				
				
				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatidlotteryuser.'" AND status="data_email"');
				usleep(250000);
				
				if(!empty(mysqli_num_rows($query4)))
				{
					$con4=mysqli_num_rows($query4);
					
					
					$cntdataemail=$con4;
					$cntdataemailall=$cntdataemailall+$cntdataemail;
					
					
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
				}
	
				
				
				
				//////////////phone//////////////////
				$tickets_dataphone="";
				$cntdataphone=0;
				
				
				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatidlotteryuser.'" AND status="data_phone"');
				usleep(250000);
				
				if(!empty(mysqli_num_rows($query4)))
				{	
					$con4=mysqli_num_rows($query4);
					
					
					$cntdataphone=$con4;
					$cntdataphoneall=$cntdataphoneall+$cntdataphone;
					
					
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
				}
			
				
				
				
				///////////public////////////////
				$tickets_public="";
				$cntpublic=0;
				
				
				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.' WHERE chatid="'.$chatidlotteryuser.'" AND status="public"');
				usleep(250000);
				
				if(!empty(mysqli_num_rows($query4)))
				{	
					$con4=mysqli_num_rows($query4);
	
	
					$cntpublic=$con4;
					$cntpublicall=$cntpublicall+$cntpublic;
					
					
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
				
				
				

				$query4=mysqli_query($con_sql2, 'SELECT tickets FROM '.$tabticketsall.'');
				usleep(250000);
				
				if(!empty(mysqli_num_rows($query4)))
				{
					$con4=mysqli_num_rows($query4);
				
					$quantall=$con4;
				}
				
				
				
				$cntall=($cntpublic+$cntdataphone+$cntdataemail+$cntdataprofile+$cntdep+$cntref);
	
				
				if($tickets_ref!="" || $tickets_dep!="" || $tickets_dataprofile!="" || $tickets_dataemail!="" || $tickets_dataphone!="" || $tickets_public!="")
				{
	

					if(empty($lnuserslotteryuser))
					{
						
						$row2[]=[''.$fnuserslotteryuser.' ('.$usernamelotteryuser.', casino ID <b>'.$casinoidlotteryuser.'</b>, telegram ID <b>'.$chatidlotteryuser.'</b>)', '<b>'.$cntall.'</b>', ''.$cntref.'', ''.$tickets_ref.'', ''.$cntdep.'', ''.$tickets_dep.'', ''.$cntdataprofile.'', ''.$tickets_dataprofile.'', ''.$cntdataemail.'', ''.$tickets_dataemail.'', ''.$cntdataphone.'', ''.$tickets_dataphone.'', ''.$cntpublic.'', ''.$tickets_public.''];
					}
					else
					{
					
						$row2[]=[''.$fnuserslotteryuser.' '.$lnuserslotteryuser.' ('.$usernamelotteryuser.', casino ID <b>'.$casinoidlotteryuser.'</b>, telegram ID <b>'.$chatidlotteryuser.'</b>)', '<b>'.$cntall.'</b>', ''.$cntref.'', ''.$tickets_ref.'', ''.$cntdep.'', ''.$tickets_dep.'', ''.$cntdataprofile.'', ''.$tickets_dataprofile.'', ''.$cntdataemail.'', ''.$tickets_dataemail.'', ''.$cntdataphone.'', ''.$tickets_dataphone.'', ''.$cntpublic.'', ''.$tickets_public.''];
					
					}
					
					
				}
				
			}
			
			
			$xlsx->addSheet( $row2, 'Билеты ('.$quantall.')' );
			sleep(2);
			$xlsx->saveAs('./pdf/статистика.xlsx');
		}	
	}

	sleep(10);
	
	$datenow=date('d_m_y__G_i');
	
	$zip = new ZipArchive;
	$zip->open('pdf/статистика_'.$datenow.'.zip', ZipArchive::CREATE);
    $zip->addFile('pdf/статистика.xlsx', 'статистика.xlsx');
    $zip->close();

	sleep(10);
	
	
	
	$con_sql2=$bot->cmd_sql();
	
	$query4=mysqli_query($con_sql2, 'SELECT casinoid FROM '.$tabcasinousers.'');
	usleep(250000);
	
	if(!empty(mysqli_num_rows($query4)))
	{
		$con4=mysqli_num_rows($query4);
	
		$casinolotteryusers=$con4;
	}
	
	
	
	$tabadmin='tabadmin';
	
	
	$con_sql2=$bot->cmd_sql();
		
	$query5=mysqli_query($con_sql2, 'SELECT chatid FROM '.$tabadmin.'');
	usleep(250000);
	$con5=mysqli_num_rows($query5);
			
	$row5=[];
	for($i5=0;$i5<$con5;$i5++)
	{
		mysqli_data_seek($query5, $i5);
		$row5[$i5]=mysqli_fetch_row($query5);
			
		$chatidadm=$row5[$i5][0];
	
		$bot->api->sendDocument([
		'chat_id' => $chatidadm,
		'document' => 'https://domain.com/telegrambot/pdf/статистика_'.$datenow.'.zip'
		]);
		
		sleep(1);
		
		$textadd='<b>Всего пользователей (кнопка Старт) - '.$quantuserall.' чел.:</b>'.PHP_EOL.''.PHP_EOL.'Участники розыгрыша - '.$quantuserlottery.' чел.'.PHP_EOL.'Не участвующие в розыгрыше - '.$quantusersnotlot.' чел.'.PHP_EOL.''.PHP_EOL.'<i>Пользователи казино</i> - '.$casinolotteryusers.' чел.'.PHP_EOL.'<i>Забаненные пользователи</i> - '.$quantuserbanned.' чел.'.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>Всего активных билетов - '.$quantall.' шт.:</b>'.PHP_EOL.''.PHP_EOL.'Билеты за рефералки - '.$cntrefall.' шт.'.PHP_EOL.'Билеты за депозиты - '.$cntdepall.' шт.'.PHP_EOL.'Билеты за заполненный профиль - '.$cntdataprofileall.' шт.'.PHP_EOL.'Билеты за подтвержденную почту - '.$cntdataemailall.' шт.'.PHP_EOL.'Билеты за подтвержденный телефон - '.$cntdataphoneall.' шт.'.PHP_EOL.''.PHP_EOL.'';
	
		$bot->api->sendMessage([
		'chat_id' => $chatidadm,
		'text' => $textadd,
		'reply_markup' => json_encode($bot->keyboards['default_admin']),
		//'disable_notification' => TRUE,
		//'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		sleep(1);
	
	}



	if(file_exists(''.dirname(__FILE__).'/statistics.txt'))
	{
		unlink(''.dirname(__FILE__).'/statistics.txt');
		usleep(100000);
	}
	
	if(file_exists(''.dirname(__FILE__).'/resultsfinish.txt'))
	{
		$con_sql2=$bot->cmd_sql();
		
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tablotteryusers.'');
		usleep(250000);
	
		mysqli_query($con_sql2, 'DROP TABLE IF EXISTS '.$tabticketsall.'');
		usleep(250000);
		
		unlink(''.dirname(__FILE__).'/resultsfinish.txt');
	}
}