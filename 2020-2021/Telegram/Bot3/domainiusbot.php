<?php




//$dir=dirname(__FILE__);
//$date=date('dm');
//$time=date('h');

/* if (file_exists(''.dirname(__FILE__).'/filestemp1/')==FALSE) { mkdir(''.dirname(__FILE__).'/filestemp1/'); }
if (file_exists(''.dirname(__FILE__).'/filestemp2/')==FALSE) { mkdir(''.dirname(__FILE__).'/filestemp2/'); }
if (file_exists(''.dirname(__FILE__).'/photos/')==FALSE) { mkdir(''.dirname(__FILE__).'/photos/'); } */

/* if(file_exists(''.dirname(__FILE__).'/include789924953.php'))
{
	require(''.dirname(__FILE__).'/include789924953.php');
}	 */

//array_map('require', glob(''.dirname(__FILE__).'/include*.php'));

/* $filesdir1=''.dirname(__FILE__).'/';
$files=glob(''.$filesdir1.'include*.php');
$cnt2=count($files);
for($o2=0;$o2<$cnt2;$o2++)
{
	require($files[$o2]);
} */
			
			
class TelegramBot{

	public $mainchannel='-1001666944517';  //✈️Pack It🛍БАРАХОЛКА (КАНАЛ)
	
	
	public $chatidadmin='000000000';
	public $adminusernames=["xxxxxxx"];
	public $adminchatids=["000000000"];


	//////////////////////////////////
	public $arraybuttonstype=['🧥Одежда', '👠Обувь', '👜Сумки', '👓Аксессуары', '🧸Игрушки', '💄Косметика', '🛍Прочеe'];
	public $arraycallbacktype=['clothes', 'shoes', 'bags', 'accessories', 'toys', 'cosmetics', 'other1'];
	
	///
	public $arraybuttonsclothes=['🥼Верхняя одежда', '🧥Пиджаки', '🦺Кофты', '👕Футболки', '👚Рубашки', '👙Нижнее белье', '👖Джинсы', '👖Штаны', '👗Платья', '🩳Пляжная одежда', '👗Юбки', '🛍Прочee'];
	public $arraycallbackclothes=['jackets', 'blazers', 'sweatshirts', 'tshirts', 'shirts', 'underwear', 'jeans', 'pants', 'dress', 'beachwear', 'skirts', 'other2'];
	
	public $arraybuttonsshoes=['🥾Ботинки', '👞Туфли', '👟Кроссовки', '🩴Летняя обувь', '👢Сапоги', '🛍Прoчее'];
	public $arraycallbackshoes=['boots', 'tufels', 'sneakers', 'summerfoot', 'sapogi', 'other3'];
	
	public $arraybuttonsaccessories=['Часы', 'Головные уборы', 'Бижутерия', 'Зонты', 'Очки', 'Перчатки', 'Пояса', 'Аксессуары для волос', 'Пpочее'];
	public $arraycallbackaccessories=['watches', 'hats', 'jewelry', 'umbrellas', 'glasses', 'gloves', 'belts', 'hair', 'other4'];
	
	public $arraybuttonstoys=['Мягкие игрушки', 'Конструкторы', 'Куклы', 'Электронные игрушки', 'Настольные игры', 'Наборы', 'Головоломки', 'Спортивные товары', 'Прoчеe'];
	public $arraycallbacktoys=['stuffed', 'kits', 'dolls', 'electro', 'boards', 'sets', 'puzzles', 'sports', 'other5'];
	
	public $arraybuttonsbags=['Рюкзаки', 'Кошельки', 'Ручные сумки', 'Дорожные сумки', 'Для ноутбуков', 'Пpочеe'];
	public $arraycallbackbags=['backpacks', 'wallets', 'handbags', 'roadbags', 'notebook', 'other6'];
	
	public $arraybuttonscosmetics=['Гигиена', 'Make Up', 'Уход', 'Прoчeе'];
	public $arraycallbackcosmetics=['hygiene', 'makeup', 'nursing', 'other7'];
	
	public $arraybuttonsother=['🛍Пpочeе'];
	public $arraycallbackother=['other8'];
	
	///
	public $arraybuttonsgender=['Мужчины', 'Женщины', 'Дети', 'Унисекс'];
	public $arraycallbackgender=['male', 'female', 'kids', 'unisex'];
	
	///
	public $arraybuttonsgender1=['Мальчики', 'Девочки', 'Унисeкс'];
	public $arraycallbackgender1=['boys', 'girls', 'unisex1'];
	
	///
	public $arraybuttonscond=['Новое', 'Б/у'];
	public $arraycallbackcond=['new', 'used'];
	//////////////////////////////////
	
	
	
	
	protected $token = null; 
	protected $bot_name = null;
	public    $api = null;
	protected $result = null;
	protected $commands = [
			"/start" => "cmd_start",
			"/help" => "cmd_help",
			"/admin" => "cmd_admin",
			"/buy" => "cmd_buy",
			"/sell" => "cmd_sell",
			"/main" => "cmd_main",
			
			/* "🛒КУПИТЬ" => "cmd_buy_main_keyboard",
			"💰ПРОДАТЬ" => "cmd_sell_main_keyboard",
			"👁‍🗨АДМИН" => "cmd_admin_main_keyboard", */
			];
	public $proxy = "";
		
	public $keyboards = 
	[	
		//'default_user' => [  'keyboard' => [['🛒КУПИТЬ', '💰ПРОДАТЬ']]  ],
		//'default_admin' => [  'keyboard' => [ ['🛒КУПИТЬ', '💰ПРОДАТЬ'], ['👁‍🗨АДМИН']]   ],
		
		'inline_ask_admin' => [  [['text' => '🟢Да', 'callback_data' => 'admin_yes'], ['text' => '🔴Нет', 'callback_data' => 'admin_no']], [['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_ask_admin_channel' => [  [['text' => 'ℹ️Посмотреть', 'callback_data' => 'admin_ask_channel_see']], [['text' => 'ℹ️Удалить', 'callback_data' => 'admin_ask_channel_delete']], [['text' => 'ℹ️Отправить в канал', 'callback_data' => 'admin_ask_channel_send']], [['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_ask_admin_buy' => [  [['text' => 'ℹ️Посмотреть', 'callback_data' => 'admin_ask_buy_see'], ['text' => 'ℹ️Подтвердить', 'callback_data' => 'admin_ask_buy_approve']], [['text' => 'ℹ️Отказать', 'callback_data' => 'admin_ask_buy_deny']], [['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_phone_user' => [ [['text'=>'📞Отправить номер телефона', 'request_contact'=>true]] ],
		
		'inline_want_user' => [  [['text' => '📣Отправить запрос', 'callback_data' => 'admin_default_newuser'], ['text' => '⤴️Отмена', 'callback_data' => 'exit_want_user']]	],
		
		'inline_default_admin' => [  [['text' => '🛒КУПИТЬ', 'callback_data' => 'default_buy'], ['text' => '💰ПРОДАТЬ', 'callback_data' => 'default_sell']], [['text' => '👁‍🗨АДМИН', 'callback_data' => 'default_admin']]  ],
		
		'inline_admin_main' => [  [['text' => '✅Пользователи', 'callback_data' => 'admin_users'], ['text' => '✅Объявления', 'callback_data' => 'admin_records']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_main'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_admin_users' => [  [['text' => '✅Утвержденные', 'callback_data' => 'admin_approvedusers']], [['text' => '✅Все пользователи', 'callback_data' => 'admin_allusers']], [['text' => '❔Отказанные', 'callback_data' => 'admin_deniedusers']], [['text' => '❌Забаненные', 'callback_data' => 'admin_bannedusers'], ['text' => '❔Запросившие', 'callback_data' => 'admin_wantusers']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_users'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_allusers']]	],
		
		'inline_admin_approvedusers' => [  [['text' => 'ℹ️Инфо на экран', 'callback_data' => 'admin_showapprovedusers'], ['text' => 'ℹ️Инфо в файл', 'callback_data' => 'admin_showapprovedusers_file']], [['text' => 'ℹ️Объявления для канала', 'callback_data' => 'admin_showallrecordsapprovedusers'], ['text' => 'ℹ️Товары в канале', 'callback_data' => 'admin_showchannelrecordsapprovedusers']], [['text' => 'ℹ️Удалить для канала', 'callback_data' => 'admin_deleterecordsapprovedusers'], ['text' => 'ℹ️Удалить из канала', 'callback_data' => 'admin_deleterecordsapprovedusers_channel']], [['text' => 'ℹ️Разместить в канале', 'callback_data' => 'admin_sendchannelapprovedusers'], ['text' => 'ℹ️Отметить продажу', 'callback_data' => 'admin_send_sold_channel']], [['text' => 'ℹ️Забанить пользователя', 'callback_data' => 'admin_banapprovedusers']], [['text' => 'ℹ️Отправить сообщение всем пользователям', 'callback_data' => 'admin_sendmessageapprovedusers']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_main_menu'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_admin_allusers' => [  [['text' => 'ℹ️Инфо на экран', 'callback_data' => 'admin_showallusers'], ['text' => 'ℹ️Инфо в файл', 'callback_data' => 'admin_showallusers_file']], [['text' => 'ℹ️Забанить пользователя', 'callback_data' => 'admin_banallusers']],[['text' => '⬅️Назад', 'callback_data' => 'admin_back_main_menu'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_admin_deniedusers' => [  [['text' => 'ℹ️Показать отказанных', 'callback_data' => 'admin_showdeniedusers'], ['text' => 'ℹ️Утвердить отказанных', 'callback_data' => 'admin_unbandeniedusers']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_main_menu'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_admin_bannedusers' => [  [['text' => 'ℹ️Показать забаненных', 'callback_data' => 'admin_showbannedusers'], ['text' => 'ℹ️Разбанить забаненных', 'callback_data' => 'admin_unbanbannedusers']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_main_menu'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_admin_wantusers' => [  [['text' => 'ℹ️Показать запросивших', 'callback_data' => 'admin_showwantusers'], ['text' => '⏹Утвердить запросивших', 'callback_data' => 'admin_approvewantusers'], ['text' => '⏹Отказать запросившим', 'callback_data' => 'admin_denywantusers']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_main_menu'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']]	],
		
		'inline_admin_records' => [  [['text' => 'ℹ️Показать товар по ID', 'callback_data' => 'admin_show_records_channel']], [['text' => 'ℹ️Все товары в файл', 'callback_data' => 'admin_show_records_channel_file'], ['text' => 'ℹ️Удалить товары', 'callback_data' => 'admin_delete_records_channel']], [['text' => 'ℹ️Отметить продажу', 'callback_data' => 'admin_sendsold_records_channel'], ['text' => 'ℹ️Посмотреть заказы', 'callback_data' => 'admin_orders_records_channel']], [['text' => 'ℹ️Проданные товары', 'callback_data' => 'admin_sold_records_channel']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_records_menu'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_records_menu']]	],
		
		'inline_admin_orders_records_channel' => [  [['text' => 'ℹ️На экран', 'callback_data' => 'admin_orders_records_channel_display'], ['text' => 'ℹ️Файл', 'callback_data' => 'admin_orders_records_channel_file']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_orders_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_orders_records_channel']]	],
		
		'inline_admin_sold_records_channel' => [  [['text' => 'ℹ️На экран', 'callback_data' => 'admin_sold_records_channel_display'], ['text' => 'ℹ️Файл', 'callback_data' => 'admin_sold_records_channel_file']], [['text' => '⬅️Назад', 'callback_data' => 'admin_back_sold_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_sold_records_channel']]	],
		
		
		
		

		'inline_default' => [  [['text' => '🛒КУПИТЬ', 'callback_data' => 'default_buy'], ['text' => '💰ПРОДАТЬ', 'callback_data' => 'default_sell']]  ],
		
		//'inline_buy_default' => [  [['text' => 'ℹ️Показать', 'callback_data' => 'ready_buy']], [['text' => 'ℹ️Купить по ID товара', 'callback_data' => 'byrecordid_default_buy']], [['text' => 'ℹ️Фильтр', 'callback_data' => 'filter_default_buy'], ['text' => '🔀Сбросить фильтры', 'callback_data' => 'resetfilters_default_buy']], [['text' => '⬅️Назад', 'callback_data' => 'buy_back_main'], ['text' => '⤴️Выйти', 'callback_data' => 'buy_exit_main']]  ],
		
		'inline_buy_default' => [  [['text' => 'ℹ️Выбрать', 'callback_data' => 'choose_default_buy']], [['text' => 'ℹ️Купить по ID товара', 'callback_data' => 'byrecordid_default_buy']], [['text' => '⬅️Назад', 'callback_data' => 'buy_back_main'], ['text' => '⤴️Выйти', 'callback_data' => 'buy_exit_main']]  ],
		
		'inline_buy_filter' => [  [['text' => '📖Категория', 'callback_data' => 'filter_buy_type'], ['text' => '🧾Вид', 'callback_data' => 'filter_buy_cat'], ['text' => '👨‍👩‍👦Пол', 'callback_data' => 'filter_buy_gender']], [['text' => '🎏Состояние', 'callback_data' => 'filter_buy_cond'], ['text' => '💵Цена', 'callback_data' => 'filter_buy_price']], [['text' => '🔀Сбросить фильтры', 'callback_data' => 'filter_resetfilters_buy']], [['text' => '⬅️Назад', 'callback_data' => 'filter_buy_back_main'], ['text' => '⤴️Выйти', 'callback_data' => 'filter_buy_exit_main']]  ],
		
		'inline_sell' => [  [['text' => '✅Создать объявление', 'callback_data' => 'sell_add']], [['text' => '🖋Изменить объявление', 'callback_data' => 'sell_change']], [['text' => '⬅️Назад', 'callback_data' => 'back_sell_main'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_main']]  ],
		
		//'inline_change' => [  [['text' => '🔣Объявления в канале', 'callback_data' => 'change_channel_records'], ['text' => '🔤Все объявления', 'callback_data' => 'change_all_records']], [['text' => '🔣Удалить объявления в канале', 'callback_data' => 'change_delete_records_channel'], ['text' => '🔣Удалить другие объявления', 'callback_data' => 'change_delete_records_other']], [['text' => '🔤Разместить в канале', 'callback_data' => 'change_send_channel'], ['text' => '🔤Отметить продажу', 'callback_data' => 'change_send_sold']], [['text' => '⬅️Назад', 'callback_data' => 'change_back_main'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_main']]  ],
		
		'inline_change' => [  [['text' => '📃Мои размещенные объявления', 'callback_data' => 'change_channel_records']], [['text' => '💾Мои сохраненные для публикации', 'callback_data' => 'change_all_records']], [['text' => '🗑Удалить сохраненные для публикации', 'callback_data' => 'change_delete_records_other']], [['text' => '🚀Опубликовать сохраненные для публикации', 'callback_data' => 'change_askadmin_send_channel']], [['text' => '⬅️Назад', 'callback_data' => 'change_back_main'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_main']]  ],
		
		
		'inline_photo' => [  [['text' => '✅Да', 'callback_data' => 'inline_photo_yes'], ['text' => '❌Нет', 'callback_data' => 'inline_photo_no']], [['text' => '🔄Изменить фото', 'callback_data' => 'change_sell_add_photo']], [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_photo'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_photo']]	],
		
		'inline_sell_moderate' => [  [['text' => '🚀Отправить в канал', 'callback_data' => 'inline_add_send_moderate']], [['text' => '🗑Удалить объявление', 'callback_data' => 'inline_add_send_delete']], [['text' => '⏳Сохранить для отправки позже', 'callback_data' => 'inline_add_send_later']], [['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_photo']]	],
		
	];
	
	
	
	public $pre='<pre>                                                                                                       ❗️</pre>';
	
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
	public function convert_rus($input) 
	{
		$arraybuttons=array_merge($this->arraybuttonstype, $this->arraybuttonsclothes, $this->arraybuttonsshoes, $this->arraybuttonsaccessories, $this->arraybuttonstoys, $this->arraybuttonsbags, $this->arraybuttonscosmetics, $this->arraybuttonsother, $this->arraybuttonsgender, $this->arraybuttonsgender1, $this->arraybuttonscond);
		$arraycallback=array_merge($this->arraycallbacktype, $this->arraycallbackclothes, $this->arraycallbackshoes, $this->arraycallbackaccessories, $this->arraycallbacktoys, $this->arraycallbackbags, $this->arraycallbackcosmetics, $this->arraycallbackother, $this->arraycallbackgender, $this->arraycallbackgender1, $this->arraycallbackcond);

		$count=count($arraycallback);
		
		for($i=0;$i<$count;$i++)
		{
			if($input==$arraycallback[$i])
			{
				$output=$arraybuttons[$i];
				break;
			}
		}
		return $output;
	}
	
/////	
	public function convert_en($input) 
	{
		$arraybuttons=array_merge($this->arraybuttonstype, $this->arraybuttonsclothes, $this->arraybuttonsshoes, $this->arraybuttonsaccessories, $this->arraybuttonstoys, $this->arraybuttonsbags, $this->arraybuttonscosmetics, $this->arraybuttonsother, $this->arraybuttonsgender, $this->arraybuttonsgender1, $this->arraybuttonscond);
		$arraycallback=array_merge($this->$arraycallbacktype, $this->arraycallbackclothes, $this->arraycallbackshoes, $this->arraycallbackaccessories, $this->arraycallbacktoys, $this->arraycallbackbags, $this->arraycallbackcosmetics, $this->arraycallbackother, $this->arraycallbackgender, $this->arraycallbackgender1, $this->arraycallbackcond);

		$count=count($arraybuttons);
		for($i=0;$i<$count;$i++)
		{
			if($input==$arraybuttons[$i])
			{
				$output=$arraycallback[$i];
				break;
			}
		}
		return $output;
	}
	
/////	
	public function convert_type_cat($input) 
	{
		if($input=='clothes')
		{
			$arraybuttons=$this->arraybuttonsclothes;
			$arraycallback=$this->arraycallbackclothes;
		}
		elseif($input=='shoes')
		{
			$arraybuttons=$this->arraybuttonsshoes;
			$arraycallback=$this->arraycallbackshoes;
		}
		elseif($input=='accessories')
		{
			$arraybuttons=$this->arraybuttonsaccessories;
			$arraycallback=$this->arraycallbackaccessories;
		}
		elseif($input=='toys')
		{
			$arraybuttons=$this->arraybuttonstoys;
			$arraycallback=$this->arraycallbacktoys;
		}
		elseif($input=='bags')
		{
			$arraybuttons=$this->arraybuttonsbags;
			$arraycallback=$this->arraycallbackbags;
		}
		elseif($input=='cosmetics')
		{
			$arraybuttons=$this->arraybuttonscosmetics;
			$arraycallback=$this->arraycallbackcosmetics;
		}
		elseif($input=='other8')
		{
			$arraybuttons=$this->arraybuttonsother;
			$arraycallback=$this->arraycallbackother;
		}
		
		
		
		$arraybuttons=array_merge($this->arraybuttonstype, $this->arraybuttonsclothes, $this->arraybuttonsshoes, $this->arraybuttonsaccessories, $this->arraybuttonstoys, $this->arraybuttonsbags, $this->arraybuttonscosmetics, $this->arraybuttonsother, $this->arraybuttonsgender, $this->arraybuttonscond);
		$arraycallback=array_merge($this->$arraycallbacktype, $this->arraycallbackclothes, $this->arraycallbackshoes, $this->arraycallbackaccessories, $this->arraycallbacktoys, $this->arraycallbackbags, $this->arraycallbackcosmetics, $this->arraycallbackother, $this->arraycallbackgender, $this->arraycallbackcond);

		$count=count($arraybuttons);
		for($i=0;$i<$count;$i++)
		{
			if($input==$arraybuttons[$i])
			{
				$output=$arraycallback[$i];
				break;
			}
		}
		return $output;
	}
	
/////
	public function cmd_sql()
	{		
		$host='127.0.0.1'; 
		$user='xxxxxxx'; 
		$pass='xxxxxxx'; 
		$dbn='baraholka';
	
		$con_sql1=mysqli_connect($host, $user, $pass);
		if(mysqli_query($con_sql1, 'CREATE DATABASE '.$dbn.'')) 
		{ 
			mysqli_close($con_sql1);
		}
		
		$con_sql2=mysqli_connect($host, $user, $pass, $dbn);
		if (mysqli_connect_errno()) 
		{
			printf('Connect failed: %s\n', mysqli_connect_error());
			exit;
		}
		

		mysqli_set_charset($con_sql2, 'utf8mb4');
		
		return $con_sql2;
	}
	

/////


/////
	public function cmd_sql_createchatidtable($table)
	{		
		$con_sql2=$this->cmd_sql();
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$table.' LIMIT 1')==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$table.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,chatid VARCHAR(15),firstname VARCHAR(50),lastname VARCHAR(50),username VARCHAR(50),phone VARCHAR(15),fio VARCHAR(100)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(100000);
		}
	}


/////
	public function cmd_sql_searchchatidtable($table, $chatid)
	{	
		
		$con_sql2=$this->cmd_sql();

		$query=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$table.'');
		usleep(100000);
		$con=mysqli_num_rows($query);
		usleep(50000);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			usleep(50000);
			$row[$i]=mysqli_fetch_row($query);
			usleep(50000);
		}
		
		if($this->cmd_arraysearch($row, $chatid))
		//if(in_array($chatid, $row))
		{
			return true;
		}
		
		return false;
	}

/////
	public function cmd_arraysearch($array, $value)
	{
		if(is_array($array))
		{
			if(!empty($array))
			{
				$arrayvalues=array_values($array);
				
				foreach($arrayvalues as $arrayvalue)
				{
					if(is_array($arrayvalue))
					{
						if(!empty($arrayvalue))
						{
							if($this->cmd_arraysearch($arrayvalue, $value))
							{
								return true;
							}
						}
					}
					else
					{
						if(in_array($value, $arrayvalues))
						{
							return true;
						}
					}
				}
			}
		}
		
		return false;
	}


/////	
	public function cmd_buy_main_keyboard()
	{
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcat'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabgender'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
	
		$tab='tabprice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		

		$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con1=mysqli_num_rows($query1);
		
		if($con1!=0)
		{	
		
			$table=[];
			$check=0;
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$tab=$row1[$i][0];
				
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by id ASC');
				usleep(100000);
				$con=mysqli_num_rows($query);
					
				if($con!=0)
				{	
					$check=1;
					break;
				}
			}
			
			if($check==1)
			{
			
				$text='Вы находитесь в меню <b>Купить</b>.'.PHP_EOL.'Для просмотра товаров нажмите кнопку <b>Выбрать</b>'.PHP_EOL.'Для покупки товара по номеру ID нажмите кнопку <b>Купить по ID товара.</b>'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				//$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			else
			{

				if($this->cmd_isadmin())
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в главном меню.'.$this->pre.'';
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					
					//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
					usleep(100000);
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в главном меню.'.$this->pre.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
					usleep(100000);
				}
					
			}
			
		}
		else
		{
			if($this->cmd_isadmin())
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в главном меню.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
				usleep(100000);
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в главном меню.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
				usleep(100000);
			}
		}
		
	}
	
/////	
	public function cmd_sell_main_keyboard()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtempphoto.'');
			usleep(100000);
		}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		}
		
		if($this->cmd_isadmin())
		{
			$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.''))
			{
				usleep(100000);
			}
		}
		
		$text='Вы находитесь в главном меню 💰<b>Продать</b>.'.$this->pre.'';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(100000);
	}
	
/////	
	public function cmd_admin_main_keyboard()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.''))
		{
			usleep(100000);
		}
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.''))
		{
			usleep(100000);
		}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.''))
		{
			usleep(100000);
		}
		
		$tabservicefio='tabservicefio'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabservicefio.''))
		{
			usleep(100000);
		}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		if(mysqli_query($con_sql2, 'DROP TABLE '.$tabtempphoto.''))
		{
			usleep(100000);
		}
		
		$tab='tabtype'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
		{
			usleep(100000);
		}
		$tab='tabcat'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
		{
			usleep(100000);
		}
		$tab='tabgender'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
		{
			usleep(100000);
		}
		$tab='tabcond'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
		{
			usleep(100000);		
		}
		$tab='tabprice'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
		{
			usleep(100000);	
		}
		$tab='tabservice'.$this->api->chatId.'';
		if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
		{
			usleep(100000);
		}
			
		$text='Вы находитесь в главном меню 👁‍🗨<b>Админ</b>.'.$this->pre.'';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(100000);
	}
	

/////
	public function cmd_isadmin()
	{
		
		if(isset($this->api->username))
		{
			if(in_array($this->api->username, $this->adminusernames))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			if(in_array($this->api->chatId, $this->adminchatids))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
	}
	
	
/////
	public function cmd_isadmin1($chatid)
	{
		
			if(in_array($chatid, $this->adminchatids))
			{
				return true;
			}
			else
			{
				return false;
			}
		
		
	}
/////
	public function cmd_user_get_fio($chatid)
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceusers='tabserviceusers';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE chatid="'.$chatid.'"');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$userfio=$row[0][6];
		
		return $userfio;
		
	}

/////
	public function cmd_user_get_chatid_fio($userfio)
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceusers='tabserviceusers';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE fio="'.$userfio.'"');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$userchatid=$row[0][1];
		
		return $userchatid;
		
	}
	
/////
	public function cmd_user_get_phone($chatid)
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceusers='tabserviceusers';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE chatid="'.$chatid.'"');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$userphone=$row[0][5];
		
		return $userphone;
		
	}
	
/////
	public function cmd_user_get_chatid_phone($userphone)
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceusers='tabserviceusers';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE phone="'.$userphone.'"');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$userchatid=$row[0][1];
		
		return $userchatid;
		
	}
	
/////
	public function cmd_user_get_fiophone($chatid)
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceusers='tabserviceusers';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE chatid="'.$chatid.'"');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$userfio=$row[0][6];
		$userphone=$row[0][5];
		$userfiophone=''.$userfio.' ('.$userphone.')';
		
		return $userfiophone;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/////////////////////////////////////////////////////////////START//////////////////////////////////////////////////////	
//////////
	public function cmd_start()
	{
				
		$tabserviceapproved='tabserviceapproved';
		$tabservicewant='tabservicewant';
		$tabserviceusers='tabserviceusers';
		$tabservicebanned='tabservicebanned';
		$tabservicedenied='tabservicedenied';
		
		$userinfo=''.$this->api->firstname.' '.$this->api->lastname.'';

		if($this->cmd_isadmin())
		{
			$con_sql2=$this->cmd_sql();
			
			if($this->cmd_sql_createchatidtable($tabserviceapproved))
			{
				usleep(100000);
			}
			if($this->cmd_sql_createchatidtable($tabservicewant))
			{
				usleep(100000);
			}
			if($this->cmd_sql_createchatidtable($tabserviceusers))
			{
				usleep(100000);
			}
			if($this->cmd_sql_createchatidtable($tabservicebanned))
			{
				usleep(100000);
			}
			if($this->cmd_sql_createchatidtable($tabservicedenied))
			{
				usleep(100000);
			}


			$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.''))
			{
				usleep(100000);
			}
			$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.''))
			{
				usleep(100000);
			}
			
			$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.''))
			{
				usleep(100000);
			}
		
			$tabservicefio='tabservicefio'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabservicefio.''))
			{
				usleep(100000);
			}
			
			$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tabtempphoto.''))
			{
				usleep(100000);
			}
			
			$tab='tabtype'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			$tab='tabcat'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			$tab='tabgender'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			$tab='tabcond'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);		
			}
			$tab='tabprice'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);	
			}
			$tab='tabservice'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			
			$result=json_decode($this->getChat(''.$this->api->chatId.''), true);
			$result=$result['result'];
				
			if($this->cmd_sql_searchchatidtable($tabserviceusers, $this->api->chatId)==FALSE)
			{
				mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceusers.' (chatid, firstname, lastname, username, phone, fio) VALUES ("'.$this->api->chatId.'", "'.$result['first_name'].'", "'.$result['last_name'].'", "'.$result['username'].'", "admin", "admin")');
				usleep(100000);
			}
			
			if(file_exists(''.dirname(__FILE__).'/usersall.txt'))
			{
				if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersall.txt'))==FALSE)
				{
					file_put_contents(''.dirname(__FILE__).'/usersall.txt', $this->api->chatId . PHP_EOL,FILE_APPEND);
				}
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/usersall.txt', $this->api->chatId . PHP_EOL,FILE_APPEND);
			}
			
			
			if($this->cmd_sql_searchchatidtable($tabserviceapproved, $this->api->chatId)==FALSE)
			{
				mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceapproved.' (chatid, firstname, lastname, username, phone, fio) VALUES ("'.$this->api->chatId.'", "'.$result['first_name'].'", "'.$result['last_name'].'", "'.$result['username'].'", "admin", "admin")');
				usleep(100000);
			}
			
			if(file_exists(''.dirname(__FILE__).'/usersapproved.txt'))
			{
				if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt'))==FALSE)
				{
					file_put_contents(''.dirname(__FILE__).'/usersapproved.txt', $this->api->chatId . PHP_EOL,FILE_APPEND);
				}
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/usersapproved.txt', $this->api->chatId . PHP_EOL,FILE_APPEND);
			}
			
			
			
			$text='Привет, <b>'.$userinfo.'!</b>'.PHP_EOL.''.PHP_EOL.'О мой Бог, это же АДМИН!'.PHP_EOL.''.PHP_EOL.'Жми на кнопки снизу!'.$this->pre.'';
			
			/* $this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['keyboard'=>$this->keyboards['default_admin'], 'resize_keyboard' => true] ),
				'reply_markup' => json_encode($this->keyboards['default_admin']),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]); */
			
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		else
		{
			$con_sql2=$this->cmd_sql();
			
			$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.''))
			{
				usleep(100000);
			}
			
			$tabservicefio='tabservicefio'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabservicefio.''))
			{
				usleep(100000);
			}
			
			$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
			if(mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.''))
			{
				usleep(100000);
			}
			
			$tab='tabtype'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			$tab='tabcat'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			$tab='tabgender'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			$tab='tabcond'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);		
			}
			$tab='tabprice'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);	
			}
			$tab='tabservice'.$this->api->chatId.'';
			if(mysqli_query($con_sql2, 'DROP TABLE '.$tab.''))
			{
				usleep(100000);
			}
			
			
			/* $this->api->sendMessage([
				'text' => "dgfhmdghmdghm",
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]); */
				
			if($this->cmd_sql_searchchatidtable($tabserviceusers, $this->api->chatId))
			{

				$query=mysqli_query($con_sql2, 'SELECT fio FROM '.$tabserviceusers.' WHERE chatid="'.$this->api->chatId.'"');
				usleep(100000);
				$con=mysqli_num_rows($query);
					
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				usleep(100000);
				$userinfo=$row[0][0];
				
				$text='Привет, <b>'.$userinfo.'!</b>'.PHP_EOL.''.PHP_EOL.'Приступим! Вы хотите купить или продать товар?👇'.$this->pre.'';
				
				/* $this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode($this->keyboards['default_user']),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]); */
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
			/* elseif($this->cmd_sql_searchchatidtable($tab2, $this->api->chatId))
			{
				$text='Вы уже внесли номер телефона и отправили запрос админу. Пожалуйста, потерпите немного!';
		
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			} */
			/* elseif($this->cmd_sql_searchchatidtable($tab3, $this->api->chatId))
			{
				$text='Вы уже внесли номер телефона, теперь отправьте запрос админу!';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_want_user']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			} */
			else
			{
				$text='Вы являетесь новым пользователем, поэтому Вам <b>необходимо авторизироваться</b>. Для этого укажите Ваш <b>номер телефона</b>, нажав на кнопку снизу👇';
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( [
						'keyboard'=>$this->keyboards['inline_phone_user'], 
						'resize_keyboard' => true, 
						'one_time_keyboard' => true, 
						'input_field_placeholder' => 'нажмите кнопку снизу'
						] ),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
			}
		
		}
	}



/////	
	public function cmd_help()
	{
		
		if($this->cmd_isadmin())
		{
			$text = 'Помощь для админа:'.PHP_EOL.'Бла-бла-бла'.$this->pre.'';
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode(['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		else
		{
			
			if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt')))
			{
				
				$text = 'Помощь для пользователя:'.PHP_EOL.'Бла-бла-бла'.$this->pre.'';
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
			
		}
	}


/////	
	public function cmd_buy()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
		
		$tab='tabcat'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);	
		//}
		
		$tab='tabgender'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
	
		$tab='tabprice'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
		
		$tab='tabservice'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
		

		$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con1=mysqli_num_rows($query1);
		
		if($con1!=0)
		{	
		
			$table=[];
			$check=0;
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$tab=$row1[$i][0];
				
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by id ASC');
				usleep(100000);
				$con=mysqli_num_rows($query);
					
				if($con!=0)
				{	
					$check=1;
					break;
				}
			}
			
			if($check==1)
			{
			
				$text='Вы находитесь в меню <b>Купить</b>.'.PHP_EOL.'Для просмотра товаров нажмите кнопку <b>Выбрать</b>.'.PHP_EOL.'Для покупки товара по номеру ID нажмите кнопку <b>Купить по ID товара.</b>'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				//$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			else
			{

				if($this->cmd_isadmin())
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в <b>Главном меню</b>.'.$this->pre.'';
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);
					
					//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
					
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в <b>Главном меню</b>.'.$this->pre.'';
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);
					
					//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
					
				}
					
			}
		}
		else
		{
			if($this->cmd_isadmin())
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в <b>Главном меню</b>.'.$this->pre.'';
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
				
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>.'.PHP_EOL.'Вы находитесь в <b>Главном меню</b>.'.$this->pre.'';
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
				
			}
		}
			
	}
	


	public function cmd_sell()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceapproved='tabserviceapproved';
		$tabservicewant='tabservicewant';
		$tabserviceusers='tabserviceusers';
		$tabservicebanned='tabservicebanned';
		$tabservicedenied='tabservicedenied';
		

		if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt')))
		{
		
		
			$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
			//{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
				usleep(100000);
			//}
			
			$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
			//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
			//{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
				usleep(100000);
			//}
			
			$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
			//{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
				usleep(100000);
			//}
			
			if($this->cmd_isadmin())
			{
				$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
				usleep(100000);
			}
			
			$text='Вы находитесь в меню <b>Продать</b>. <b>Выберите, что Вы хотите сделать</b>👇'.$this->pre.'';
			
			//$this->callbackAnswer( $text, $this->keyboards['inline_sell']);
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
	
		}
		elseif(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersall.txt')))
		{
			if($this->cmd_sql_searchchatidtable($tabservicedenied, $this->api->chatId))
			{
				$text='К сожалению, Вам <b>было отказано</b> в праве размещать объявления в канале!'.$this->pre.'';
				//$this->callback_inline_close($this->api->messageid);
				//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId))
			{
				$text='Вы <b>уже отправили запрос админу</b> на получение права размещать объявления в канале! Вы получите служебное уведомление о результатах.'.$this->pre.'';
				//$this->callbackAnswer3( $text );
				//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			else
			{
				$text='Чтобы размещать объявления в канале, Вам необходимо <b>подтверждение админа.</b>'.PHP_EOL.'Вы можете отправить запрос админу, нажав кнопку 📣<b>Отправить запрос</b> снизу👇'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_want_user']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			
			}
		}
	}
	

	/////	
/* 	public function cmd_sell()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}

		if($this->cmd_isadmin())
		{
			$text = 'Вы находитесь в разделе <b>Продать</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		else
		{
			$text = 'Вы находитесь в разделе <b>Продать</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
	} */
	
	/////	
	public function cmd_main()
	{
		

		if($this->cmd_isadmin())
		{
			$text = 'Вы находитесь в <b>Главном меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		else
		{
			$text = 'Вы находитесь в <b>Главном меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
	}
/////	
	public function callback_inline_close($id)
	{
				
		for($i=1;$i<100;$i++)
		{
			$this->api->deleteMessage(($id-$i));
			usleep(50000);
		}
	}



/////
	public function cmd_admin_add_phone()
	{
		
		$phone=$this->api->body["message"]["contact"]["phone_number"];
		$firstname=$this->api->firstname;
		$lastname=$this->api->lastname;
		$chatid=$this->api->chatId;
		
		if(isset($this->api->body["message"]["chat"]["username"] ) )
		{
			$username=$this->api->username;
		}
		else
		{
			$username='нет данных';
		}
		

		$tabserviceusers='tabserviceusers';
		$tabservicefio='tabservicefio'.$this->api->chatId.'';
		
		$con_sql2=$this->cmd_sql();
		
		/* if($this->cmd_sql_searchchatidtable($tabserviceusers, $this->api->chatId))
		{
	
			if($this->cmd_sql_searchchatidtable($tabserviceapproved, $this->api->chatId))
			{
				$text='Вы уже утверждены админом.';
		
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);

			}
			elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId))
			{
				$text='Вы уже внесли номер телефона, ФИО и отправили запрос админу. Пожалуйста, потерпите немного!';
		
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
			elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId)==FALSE)
			{
				$text='Вы уже внесли номер телефона и ФИО, теперь отправьте запрос админу!';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_want_user']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}

		}
		else
		{ */
			
			
			if($this->cmd_sql_searchchatidtable($tabserviceusers, $this->api->chatId)==FALSE)
			{
				
				$queue='INSERT INTO '.$tabserviceusers.' (chatid, firstname, lastname, username, phone, fio) VALUES ("'.$chatid.'", "'.$firstname.'", "'.$lastname.'", "'.$username.'", "'.$phone.'", "0")';
				mysqli_query($con_sql2, $queue);
				usleep(100000);
			}
			
			/* $text='Отлично! Ваш номер телефона получен!';
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['remove_keyboard' => true] ),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000); */
			
			
			$text='Для начала работы, пожалуйста, укажите Ваши имя и фамилию📣';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите Ваши имя и фамилию'] ),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicefio.' LIMIT 1')==FALSE)
			{
				$query1='CREATE TABLE '.$tabservicefio.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,fio VARCHAR(50)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';
				mysqli_query($con_sql2, $query1);
				usleep(250000);
			}
				
		//}
	}




/////
	public function cmd_admin_add_fio()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceusers='tabserviceusers';
		$tabservicefio='tabservicefio'.$this->api->chatId.'';
		
		$fio=$this->api->textmessage;
		
		if(strlen($fio)>50)
		{
			
			$text='Вы ввели слишком длинный текст. Максимальная длина 50 символов.'.PHP_EOL.'Пожалуйста, укажите Ваши имя и фамилию📣';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите Ваши имя и фамилию'] ),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE chatid="'.$this->api->chatId.'"');
			usleep(100000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			usleep(250000);
			
			
			$query='UPDATE '.$tabserviceusers.' SET fio = REPLACE(fio, "'.$row[0][6].'", "'.$fio.'") WHERE chatid="'.$this->api->chatId.'"'; 
			mysqli_query($con_sql2, $query);
			usleep(250000);
			
			mysqli_query($con_sql2, 'DROP TABLE '.$tabservicefio.'');
			usleep(250000);	
			
			
			if(file_exists(''.dirname(__FILE__).'/usersall.txt'))
			{
				if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersall.txt'))==FALSE)
				{
					file_put_contents(''.dirname(__FILE__).'/usersall.txt', $this->api->chatId . PHP_EOL,FILE_APPEND);
				}
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/usersall.txt', $this->api->chatId . PHP_EOL,FILE_APPEND);
			}
			
			//$text='Теперь вы можете отправить запрос админу, нажав снизу на кнопку 📣<b>Отправить запрос</b>.';
				
			/* $this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_want_user']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
			$this->cmd_start();
		
		}
	}


/////
	public function callback_admin_default_newuser()
	{

		$tabserviceapproved='tabserviceapproved';
		$tabservicewant='tabservicewant';
		$tabserviceusers='tabserviceusers';
		$tabservicebanned='tabservicebanned';
		$tabservicedenied='tabservicedenied';
		
		if($this->cmd_sql_searchchatidtable($tabservicedenied, $this->api->chatId))
		{
			$text='Вам <b>уже отказали</b> в праве размещать объявления в канале!'.$this->pre.'';
			//$this->callback_inline_close($this->api->messageid);
			$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
		}
		elseif($this->cmd_sql_searchchatidtable($tabserviceapproved, $this->api->chatId))
		{
			$text='Вам <b>уже дали право</b>размещать объявления в канале!'.$this->pre.'';
			//$this->callbackAnswer3( $text );
			$this->callbackAnswer( $text, $this->keyboards['inline_default']);
		}
		
		elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId))
		{
			$text='Вы уже <b>отправили запрос админу!</b> Вы получите служебное уведомление о результатах.'.$this->pre.'';
			//$this->callbackAnswer3( $text );
			//$this->callbackAnswer6( $text );
			$this->callbackAnswer( $text, $this->keyboards['inline_default']);
		}
		else
		{
			
			$con_sql2=$this->cmd_sql();
			
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE chatid="'.$this->api->chatId.'"');
			usleep(100000);
			$con=mysqli_num_rows($query);
			
			for($i1=0;$i1<$con;$i1++)
			{
				mysqli_data_seek($query, $i1);
				$row[$i1]=mysqli_fetch_row($query);
				$chatid=$row[0][1];
				$firstname=$row[0][2];
				$lastname=$row[0][3];
				$username=$row[0][4];
				$phone=$row[0][5];
				$fio=$row[0][6];
			}
			
			if($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId)==FALSE)
			{
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservicewant.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tabserviceusers.' WHERE chatid="'.$this->api->chatId.'"');
			}
			
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}	
			
			$text='Вы <b>успешно отправили запрос админу</b>. Вы получите служебное уведомление о результатах.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			]);
			usleep(100000);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}	

			
			if(preg_match('/нет данных/', $username)==FALSE)
			{
				$text='Пользователь <b>'.$fio.'</b> отправил запрос на право <b>размещения объявлений в канале.</b>'.PHP_EOL.''.PHP_EOL.'<b>Добавить пользователя?</b>'.PHP_EOL.''.PHP_EOL.'Имя пользователя в телеграме - <b>@'.$username.'</b>'.PHP_EOL.'Имя в телеграме - <b>'.$firstname.'</b>'.PHP_EOL.'Фамилия в телеграме - <b>'.$lastname.'</b>'.PHP_EOL.''.PHP_EOL.'Телефон - <b>'.$phone.'</b>'.PHP_EOL.'ФИО - <b>'.$fio.'</b>'.PHP_EOL.'id пользователя - '.$chatid.''.$this->pre.'';
			}
			else
			{
				$text='Пользователь <b>'.$fio.'</b> отправил запрос на право <b>размещения объявлений в канале.</b>'.PHP_EOL.''.PHP_EOL.'<b>Добавить пользователя?</b>'.PHP_EOL.''.PHP_EOL.'Имя пользователя в телеграме - <b>'.$username.'</b>'.PHP_EOL.'Имя в телеграме - <b>'.$firstname.'</b>'.PHP_EOL.'Фамилия в телеграме - <b>'.$lastname.'</b>'.PHP_EOL.''.PHP_EOL.'Телефон - <b>'.$phone.'</b>'.PHP_EOL.'ФИО - <b>'.$fio.'</b>'.PHP_EOL.'id пользователя - '.$chatid.''.$this->pre.'';
			}
			
			$this->api->sendMessage([
			'chat_id' => $this->chatidadmin,
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin']]),
			]);
			usleep(100000);
			
			
			
		}
		
	}


/////
	public function callback_exit_want_user()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_start();
	}
	
	
	
/////	
	public function callback_admin_yes()
	{	

		$tabserviceapproved='tabserviceapproved';
		$tabservicewant='tabservicewant';
		
		$text1=$this->api->textmessage;
		
		preg_match_all('/id пользователя - .*\d/', $text1, $out);
		$chatid1=preg_replace('/id пользователя - /', '', $out[0][0]);
		$chatid1=$this->clean($chatid1);
		$fio=$this->cmd_user_get_fio($chatid1);
		$phone=$this->cmd_user_get_phone($chatid1);
		
		if($this->cmd_sql_searchchatidtable($tabserviceapproved, $chatid1)==FALSE)
		{
			$con_sql2=$this->cmd_sql();
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceapproved.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tabservicewant.' WHERE chatid="'.$chatid1.'"');
			usleep(100000);
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tabservicewant.' WHERE chatid="'.$chatid1.'"');
			usleep(100000);
				
			if(file_exists(''.dirname(__FILE__).'/usersapproved.txt'))
			{
				if(preg_match('/'.$chatid1.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt'))==FALSE)
				{
					file_put_contents(''.dirname(__FILE__).'/usersapproved.txt', $chatid1 . PHP_EOL,FILE_APPEND);
				}
			}
			else
			{
				file_put_contents(''.dirname(__FILE__).'/usersapproved.txt', $chatid1 . PHP_EOL,FILE_APPEND);
			}
			
			
			$text2='Вы <b>успешно дали право</b> на размещение объявлений в канале пользователю 👤<b>'.$fio.' ('.$phone.').</b>'.$this->pre.'';
			
			/* if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}

			$this->api->sendMessage([
			'text' => $text2,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */

			$this->callbackAnswer( $text2, $this->keyboards['inline_default_admin']);
			//$this->callbackAnswer6($text2);

			$text3='Теперь Вы <b>имеете право размещать объявления в канале!</b>'.PHP_EOL.'Приступим! Вы хотите купить или продать товар?👇'.$this->pre.'';
			
			$this->api->sendMessage([

				'chat_id' => $chatid1,
				'text' => $text3,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'parse_mode' => "HTML",
				]);
			usleep(100000);
			
			
				
				/* $this->api->sendMessage([
				'chat_id' => $chatid1,
				'text' => $text3,
				'reply_markup' => json_encode($this->keyboards['default_user']),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]); */
			
			
		}
		else
		{
			$text2='Вы <b>уже дали право</b> пользователю <b>'.$fio.' ('.$phone.')</b> размещать объявления в канале.'.$this->pre.'';
			$this->callbackAnswer6($text2);
		}
		
	}
	
	/////	
	public function callback_admin_no()
	{

		$tabservicewant='tabservicewant';
		$tabservicedenied='tabservicedenied';
		
		$text1=$this->api->textmessage;
		
		preg_match_all('/id пользователя - .*\d/', $text1, $out);
		$chatid1=preg_replace('/id пользователя - /', '', $out[0][0]);
		$chatid1=$this->clean($chatid1);
		$fio=$this->cmd_user_get_fio($chatid1);
		$phone=$this->cmd_user_get_phone($chatid1);
		
		$con_sql2=$this->cmd_sql();
		//if($this->cmd_sql_searchchatidtable($tab, $chatid1)==FALSE)
		//{
			//$con_sql2=$this->cmd_sql();
			
			/* mysqli_query($con_sql2, 'INSERT INTO '.$tab.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tab1.' WHERE chatid="'.$chatid1.'"');
			usleep(100000); */
			
			/* $queue='DELETE FROM '.$tab1.' WHERE chatid="'.$chatid1.'"';
			$result=mysqli_query($con_sql2, $queue);
			usleep(100000); */
			
			//$text2='Вы <b>отказали и забанили пользователя '.$chatid1.'.</b>';
			
		if($this->cmd_sql_searchchatidtable($tabservicedenied, $chatid1)==FALSE)
		{
			mysqli_query($con_sql2, 'INSERT INTO '.$tabservicedenied.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tabservicewant.' WHERE chatid="'.$chatid1.'"');
			usleep(100000); 
		
			$queue='DELETE FROM '.$tabservicewant.' WHERE chatid="'.$chatid1.'"';
			$result=mysqli_query($con_sql2, $queue);
			usleep(100000);
		
			
			
			$text2='Вы <b>отказали</b> пользователю 👤<b>'.$fio.' ('.$phone.')</b> в праве на размещение объявлений в канале.'.$this->pre.'';
			
			/* if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
			'text' => $text2,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
			$this->callbackAnswer( $text2, $this->keyboards['inline_default_admin']);

			$text3='К сожалению, Вам <b>не дали право</b> размещать объявления в канале!'.$this->pre.'';
			
			$this->api->sendMessage([
			'chat_id' => $chatid1,
			'text' => $text3,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'parse_mode' => "HTML"
			]);
			usleep(100000);
		}
		else
		{
			$text2='Вы <b>уже отказали</b> пользователю <b>'.$fio.' ('.$phone.')</b>  в праве на размещение объявлений в канале.'.$this->pre.'';
			$this->callbackAnswer6($text2);
		}
	}

///////////////////////////////////////////////////////////////ADMIN//////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////
	public function callback_default_admin()
	{
		
		$text='Вы находитесь в <b>Главном меню</b>. О мой <b>Админ</b>, Выбирите необходмый раздел.'.$this->pre.'';
		
		/* $this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]); */
		
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
	}

/////	
	public function callback_admin_back_main()
	{		
		
		$text='Вы вернулись в <b>Главное меню</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
	
	}
	
/////	
	public function callback_admin_back_main_menu()
	{		
		
		$text='Вы вернулись в <b>Главное меню администратора</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);	
	
	}
	
/////	
	public function callback_admin_exit_main()
	{		
		
		$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
		//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
	}
	
	
//////////////////////////////////////////////////////////////////////USERS/////////////////////////////////////////////////////////////	
public function callback_admin_users()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceusers';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		}
		else
		{
			$text='Вы находитесь в разделе <b>Пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
		}
		
	}
	
/////	
	public function callback_admin_back_users()
	{		
		
		$text='Вы вернулись в главное меню раздела <b>Админ</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
	
	}

/////	
	public function callback_admin_exit_allusers()
	{		
		
		$text='Вы вышли в <b>Главное меню.</b>'.$this->pre.'';
		//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
	}
	
		
///////////////////////////////////////////////////////////ALL USERS/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/////	
	public function callback_admin_allusers()
	{		
		$text='Вы находитесь в разделе <b>Все пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_allusers']);
	}
	
/////	
	public function callback_admin_showallusers()
	{		
		
		$merge=$this->cmd_admin_showallusers();
		usleep(100000);
		
		if (array_filter($merge) !== [])
		{
			$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_allusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
			$text='Вы находитесь в подразделе <b>Показать всех пользователей</b>. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.'.$this->pre.'';
			$this->callbackAnswer( $text, $merge);
		}
		else
		{
			$text='В данный момент <b>нет пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		}
			
		
	}


/////
	public function callback_admin_back_allusers()
	{
		$text='Вы вернулись в подраздел <b>Все пользователи</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_allusers']);
	}
	
	
/////
	public function cmd_admin_showallusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceusers';
		
		
			$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
			$con1=mysqli_num_rows($query1);
		
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
	
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
				unset($getinclude[array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					if(isset($table[$u]) && $this->cmd_isadmin1($table[$u])==FALSE)
					{
						$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
						
						$put[]=["text" => "$buttext", "callback_data" => "admin_showalluser_$table[$u]"];
						
						if(preg_match('/callback_admin_showalluser_'.$table[$u].'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_admin_showalluser_'.$table[$u].'()
							{	
					
								$bot = new TestBot;
								$bot->api->getWebhookUpdate();
												
								$con_sql2=$bot->cmd_sql();
								$tab=&#039;tabserviceusers&#039;;
								$tabserviceapproved=&#039;tabserviceapproved&#039;;
								$tabservicewant=&#039;tabservicewant&#039;;
								$tabservicedenied=&#039;tabservicedenied&#039;;


								$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tab.&#039; WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								$con=mysqli_num_rows($query);
								
								for($i1=0;$i1<$con;$i1++)
								{
									mysqli_data_seek($query, $i1);
									$row[$i1]=mysqli_fetch_row($query);
									$chatid=$row[0][1];
									$firstname=$row[0][2];
									$lastname=$row[0][3];
									$username=$row[0][4];
									$phone=$row[0][5];
									$fio=$row[0][6];
									

									if(preg_match(&#039;/'.$table[$u].'/&#039;, file_get_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;)))
									{
										if($bot->cmd_isadmin1('.$table[$u].'))
										{
											$status="Админ";
										}
										else
										{
											$status="Премиум";
										}
									}
									elseif($bot->cmd_sql_searchchatidtable($tabservicewant, '.$table[$u].'))
									{
										$status="Обычный (+премиум)";
									}
									elseif($bot->cmd_sql_searchchatidtable($tabservicedenied, '.$table[$u].'))
									{
										$status="Обычный (-премиум)";
									}
									else
									{
										$status="Обычный";
									}
								}
								
								if($username==&#039;нет данных&#039;)
								{
									$text=&#039;Имя пользователя: <b>&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;Статус: <b>&#039;.$status.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать всех пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
								else
								{
									$text=&#039;Имя пользователя: <b>@&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;Статус: <b>&#039;.$status.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать всех пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
								
								
								$merge=$bot->cmd_admin_showallusers();

								usleep(100000);
								$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_allusers_show&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
								]);
								
								
								usleep(100000);
								
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

/////
	public function callback_admin_back_allusers_show()
	{
		$text='Вы вернулись в подраздел <b>Все пользователи</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_allusers']);
	}		



///////	
	public function callback_admin_showallusers_file()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceusers='tabserviceusers';
		$tabservicewant='tabservicewant';
		$tabservicedenied='tabservicedenied';
		
		$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceusers.' WHERE id LIKE "%"');
		$con1=mysqli_num_rows($query1);
		

		require_once(''.dirname(__FILE__).'/pdf/tcpdf.php');
		$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->SetCreator(PDF_CREATOR);
		
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
		$pdf->setFooterData(array(0,0,0), array(0,0,0));
		
		
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
		
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		if (@file_exists(dirname(__FILE__).'/pdf/lang/eng.php')) {
			require_once(dirname(__FILE__).'/pdf/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		
		$pdf->SetFont('dejavusans', '', 8, '', true);
		
		$pdf->AddPage();
		$date=date('d.m.Y');
		$time=date('G:i:s');
		
		$htmladd='
<div style="align: center; font-size: 16px; text-align: center"><b>Все пользователи по состоянию на '.$date.' '.$time.'</b></div><br><br>
<table border="1" cellspacing="0">
<tr style="line-height: 50px;">
<td align="center" valign="middle" width="60px"><b>№</b></td>
<td align="center" valign="middle" width="90px"><b>Чат ID</b></td>
<td align="center" valign="middle" width="100px"><b>Имя</b></td>
<td align="center" valign="middle" width="100px"><b>Фамилия</b></td>
<td align="center" valign="middle" width="120px"><b>Имя пользователя</b></td>
<td align="center" valign="middle" width="120px"><b>Телефон</b></td>
<td align="center" valign="middle" width="220px"><b>ФИО</b></td>
<td align="center" valign="middle" width="200px"><b>Статус</b></td>
</tr>';

		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
			
			$htmladd=''.$htmladd.''.PHP_EOL.'<tr>';
							
			$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][0].'</td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][1].'</td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][2].'</td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][3].'</td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][4].'</td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][5].'</td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			$put='<td style="text-align: center; valign: middle; font-size: 10px;"><b>'.$row1[$i1][6].'</b></td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			
			if(preg_match('/'.$row1[$i1][1].'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt')))
			{
				if($this->cmd_isadmin1($row1[$i1][1]))
				{
					$status="Админ";
				}
				else
				{
					$status="Премиум";
				}
			}
			elseif($this->cmd_sql_searchchatidtable($tabservicewant, $row1[$i1][1]))
			{
				$status="Обычный (+премиум)";
			}
			elseif($this->cmd_sql_searchchatidtable($tabservicedenied, $row1[$i1][1]))
			{
				$status="Обычный (-премиум)";
			}
			else
			{
				$status="Обычный";
			}
			
			
			$put='<td style="text-align: center; valign: middle; font-size: 10px;"><b>'.$status.'</b></td>';
			$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
			
			$htmladd=''.$htmladd.''.PHP_EOL.'</tr>';
		}
				
			
			
		$htmladd=''.$htmladd.''.PHP_EOL.'</table>';
$html=<<<EOD
$htmladd
EOD;
			
		array_map('unlink', glob(''.dirname(__FILE__).'/pdf/allusers*.pdf'));
		usleep(250000);
		
		$time=date('G.i.s');
		
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		$pdf->Output(''.dirname(__FILE__).'/pdf/allusers_'.$date.'_'.$time.'.pdf', 'F');
		usleep(250000);
		
		$this->api->sendDocument([
			'document' => 'https://domain.com/pdf/allusers_'.$date.'_'.$time.'.pdf',
			'disable_notification' => TRUE,
			'parse_mode'=> "HTML"
			]);
		usleep(250000);
		
		
		$text='Вам был выслан файл с информацией о всех пользователях.'.PHP_EOL.'Вы находитесь в разделе <b>Все пользователи</b>.'.$this->pre.'';
			
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_allusers']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		usleep(100000);
				
	}




///////	
	public function callback_admin_banallusers()
	{		

		$merge=$this->cmd_admin_banallusers();
		usleep(100000);
		
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_allusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
		$text='Вы находитесь в подразделе <b>Забанить всех пользователей</b>.'.PHP_EOL.'Выберите необходимого пользователя, чтобы забанить его.'.$this->pre.'';
		$this->callbackAnswer( $text, $merge);

	}
	
/////	
	public function cmd_admin_banallusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		

		$tab='tabserviceapproved';
		$tab1='tabservicebanned';
		$tab2='tabserviceusers';
		
		$tabserviceapproved='tabserviceapproved';
		$tabservicebanned='tabservicebanned';
		$tabserviceusers='tabserviceusers';
		$tabservicewant='tabservicewant';
		
		
			$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tabserviceusers.'');
			usleep(100000);
			$con1=mysqli_num_rows($query1);
		
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
	
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
				unset($getinclude[array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					if(isset($table[$u]) && $this->cmd_isadmin1($table[$u])==FALSE)
					{	

						//$buttext="👤$table[$u]";
						$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
						
						$put[]=["text" => "$buttext", "callback_data" => "admin_banalluser_$table[$u]"];
						
						if(preg_match('/callback_admin_banalluser_'.$table[$u].'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_admin_banalluser_'.$table[$u].'()
							{	
					
								$bot = new TestBot;
								$bot->api->getWebhookUpdate();
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								
								$con_sql2=$bot->cmd_sql();
								$tabserviceusers=&#039;tabserviceusers&#039;;

									
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabservicebanned.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tabserviceusers.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(250000);
								
								mysqli_query($con_sql2, &#039;DELETE FROM '.$tabserviceusers.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								mysqli_query($con_sql2, &#039;DELETE FROM '.$tabserviceapproved.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								mysqli_query($con_sql2, &#039;DELETE FROM '.$tabservicewant.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								
								$get=file_get_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersall.txt&#039;);
								$get=str_replace("'.$table[$u].'", "", $get);
								$get=$bot->clean($get);
								file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersall.txt&#039;, $get . PHP_EOL);
								
								$get=file_get_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;);
								$get=str_replace("'.$table[$u].'", "", $get);
								$get=$bot->clean($get);
								file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;, $get . PHP_EOL);
								
								
								$text="К сожалению, Вы были <b>забанены админом!</b>";
								
								$bot->api->sendMessage([
									&#039;chat_id&#039; => '.$table[$u].',
									&#039;text&#039; => $text,
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
								]);
								usleep(100000);
								
								$text=&#039;Вы <b>успешно забанили пользователя '.$buttext.'</b>.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Забанить всех пользователей</b>.&#039;.PHP_EOL.&#039;Выберите необходимого пользователя, чтобы забанить его.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_banallusers();
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
								
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_allusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;В данный момент <b>нет пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
								]);
								usleep(100000);
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





/////	
	public function callback_admin_deniedusers()
	{		
		$text='Вы находитесь в разделе <b>Отказанные пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_deniedusers']);
	}
	
/////	
	public function callback_admin_showdeniedusers()
	{		
		
		$merge=$this->cmd_admin_showdeniedusers();
		usleep(100000);
		
		if (array_filter($merge) !== [])
		{
			$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_allusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
			$text='Вы находитесь в подразделе <b>Показать отказанных пользователей</b>. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.'.$this->pre.'';
			$this->callbackAnswer( $text, $merge);
		}
		else
		{
			$text='В данный момент <b>нет отказанных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		}
			
		
	}


/////
	public function cmd_admin_showdeniedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicedenied';
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				if(isset($table[$u]) && $this->cmd_isadmin1($table[$u])==FALSE)
				{
					$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_showdenieduser_$table[$u]"];
					
					if(preg_match('/callback_admin_showdenieduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_showdenieduser_'.$table[$u].'()
						{	
				
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
											
							$con_sql2=$bot->cmd_sql();
							$tab=&#039;tabservicedenied&#039;;
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE id LIKE "%" LIMIT 1&#039;);
							$con1=mysqli_num_rows($query1);
							usleep(100000);
							
							if($con1!=0)
							{
								
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tab.&#039; WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								$con=mysqli_num_rows($query);
								
								for($i1=0;$i1<$con;$i1++)
								{
									mysqli_data_seek($query, $i1);
									$row[$i1]=mysqli_fetch_row($query);
									$chatid=$row[0][1];
									$firstname=$row[0][2];
									$lastname=$row[0][3];
									$username=$row[0][4];
									$phone=$row[0][5];
									$fio=$row[0][6];
								}
								
								$status="Обычный (-премиум)";
								
								if($username==&#039;нет данных&#039;)
								{
									$text=&#039;Имя пользователя: <b>&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;Статус: <b>&#039;.$status.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать отказанных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
								else
								{
									$text=&#039;Имя пользователя: <b>@&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;Статус: <b>&#039;.$status.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать отказанных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
								
								
								$merge=$bot->cmd_admin_showdeniedusers();
								
								if (array_filter($merge) !== [])
								{
									usleep(100000);
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
		
									$bot->api->sendMessage([
										&#039;text&#039; => $text,
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
										&#039;disable_notification&#039; => TRUE,
										&#039;disable_web_page_preview&#039; => TRUE,
										&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
								}
								else
								{
									$text=&#039;В данный момент <b>нет отказанных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
		
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
								}
							}
							else
							{
								$text=&#039;В данный момент <b>нет отказанных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
									
								$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
								]);
								usleep(100000);
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



/////	
	public function callback_admin_unbandeniedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceвутшув';
		
		
		
			$merge=$this->cmd_admin_unbandeniedusers();
			usleep(100000);
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_allusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Утвердить отказанных пользователей</b>. Выберите необходимого пользователя, чтобы утвердить его.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет отказанных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
			}
			
		
	}


/////
	public function cmd_admin_unbandeniedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicedenied';
		$tab1='tabserviceapproved';
		
		$tabservicedenied='tabservicedenied';
		$tabserviceapproved='tabserviceapproved';
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tabservicedenied.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
					
					$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_unbandenieduser_$table[$u]"];
					
					if(preg_match('/callback_admin_unbandenieduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_unbandenieduser_'.$table[$u].'()
						{	
				
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservicedenied.' WHERE chatid="'.$table[$u].'"&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							if($con1!=0)
							{
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceapproved.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tabservicedenied.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(250000);
								
								$queue=&#039;DELETE FROM '.$tabservicedenied.' WHERE chatid="'.$table[$u].'"&#039;;
								mysqli_query($con_sql2, &#039;DELETE FROM '.$tabservicedenied.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								
								file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;, &#039;'.$table[$u].'&#039; . PHP_EOL,FILE_APPEND);
								
								$text="Теперь Вы <b>имеете право размещать объявления в канале!</b>&#039;.$bot->pre.&#039;";

								$bot->api->sendMessage([
									&#039;chat_id&#039; => '.$table[$u].',
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_default&#039;]]),
									//&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
								]);
								usleep(100000);
								
								$text="Вы <b>успешно дали право пользователю '.$buttext.'</b> размещать объявления в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Утвердить отказанных пользователей</b>. Пожалуйста, выбирите пользователя, чтобы утвердить его.&#039;.$bot->pre.&#039;";
								
								$merge=$bot->cmd_admin_unbandeniedusers();
								usleep(100000);
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_allusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;Вы <b>успешно дали право пользователю '.$buttext.'</b> размещать объявления в канале.&#039;.PHP_EOL.&#039;.В данный момент <b>нет отказанных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
								}
							}
							else
							{
								$text=&#039;В данный момент <b>нет отказанных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->answerCallbackQuery($callback_query_id);
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
								]);
								usleep(100000);
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














































///////////////////////////////////////////////////////////APPROVED USERS/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////	
	public function callback_admin_approvedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		}
		else
		{
			$text='Вы находитесь в разделе <b>Утвержденные пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
		}
		
	}


///////////////////////////////////////////////////////////Информация о пользователе/////////////////////////////////////////////////////////////////////////
	
/////	
	public function callback_admin_showapprovedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		}
		else
		{
			$merge=$this->cmd_admin_showapprovedusers();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Показать утвержденных пользователей</b>. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
			}
			
		}
	}


/////
	public function cmd_admin_showapprovedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			
			$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		else
		{
			$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
			$con1=mysqli_num_rows($query1);
		
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
	
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
				unset($getinclude[array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					if(isset($table[$u]) && $this->cmd_isadmin1($table[$u])==FALSE)
					{
						$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
						
						$put[]=["text" => "$buttext", "callback_data" => "admin_showapproveduser_$table[$u]"];
						
						if(preg_match('/callback_admin_showapproveduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_admin_showapproveduser_'.$table[$u].'()
							{	
					
								$bot = new TestBot;
								$bot->api->getWebhookUpdate();
									/* if(file_exists(&#039;&#039;.dirname(__FILE__).&#039;/include&#039;.$bot->api->chatId.&#039;.php&#039;))
									{
										include_once(&#039;&#039;.dirname(__FILE__).&#039;/include&#039;.$bot->api->chatId.&#039;.php&#039;);
									}	 */						
								$con_sql2=$bot->cmd_sql();
								$tab=&#039;tabserviceapproved&#039;;
								
								$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE id LIKE "%" LIMIT 1&#039;);
								$con1=mysqli_num_rows($query1);
								usleep(100000);
								
								if($con1!=0)
								{
									
									$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tab.&#039; WHERE chatid="'.$table[$u].'"&#039;);
									usleep(100000);
									$con=mysqli_num_rows($query);
									
									for($i1=0;$i1<$con;$i1++)
									{
										mysqli_data_seek($query, $i1);
										$row[$i1]=mysqli_fetch_row($query);
										$chatid=$row[0][1];
										$firstname=$row[0][2];
										$lastname=$row[0][3];
										$username=$row[0][4];
										$phone=$row[0][5];
										$fio=$row[0][6];
									}
									
									if($username==&#039;нет данных&#039;)
									{
										$text=&#039;Имя пользователя: <b>&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать утвержденных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
									}
									else
									{
										$text=&#039;Имя пользователя: <b>@&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать утвержденных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
									}
									
									/* $result=json_decode($bot->getChat(&#039;'.$table[$u].'&#039;), true);
									$result=$result[&#039;result&#039;]; 
									if(isset($result[&#039;username&#039;]))
									{
										$text=&#039;Имя пользователя: <b>@&#039;.$result[&#039;username&#039;].&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$result[&#039;first_name&#039;].&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$result[&#039;last_name&#039;].&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>'.$table[$u].'</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать утвержденных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
									}
									else
									{
										$text=&#039;Имя пользователя: <b>не указано</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$result[&#039;first_name&#039;].&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$result[&#039;last_name&#039;].&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>'.$table[$u].'</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать утвержденных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
									} */
	
									
									$merge=$bot->cmd_admin_showapprovedusers();
									
									if (array_filter($merge) !== [])
									{
										usleep(100000);
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
										
										
										if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
										{
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											$bot->api->answerCallbackQuery($callback_query_id);
										}

										$bot->api->sendMessage([
											&#039;text&#039; => $text,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
											&#039;disable_notification&#039; => TRUE,
											&#039;disable_web_page_preview&#039; => TRUE,
											&#039;parse_mode&#039;=> "HTML"
										]);
			
			
										/* $bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->editMessageText([
											&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
											&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
											&#039;text&#039; => $text,
											&#039;parse_mode&#039; => "HTML",
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
										]); */
										
										
										usleep(100000);
									}
									else
									{
										$text=&#039;В данный момент <b>нет утвержденных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;

										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
										]);
										usleep(100000);
									}
								}
								else
								{
									$text=&#039;В данный момент <b>нет утвержденных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
										{
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											$bot->api->answerCallbackQuery($callback_query_id);
										}
										
									$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
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



///////	
	public function callback_admin_showapprovedusers_file()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceapproved='tabserviceapproved';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceapproved.' WHERE id LIKE "%"'))!=0)
		{
			
			$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceapproved.'  WHERE id LIKE "%"');
			$con1=mysqli_num_rows($query1);
		
		
			
			require_once(''.dirname(__FILE__).'/pdf/tcpdf.php');
			$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetCreator(PDF_CREATOR);
			
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
			$pdf->setFooterData(array(0,0,0), array(0,0,0));
			
			
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			if (@file_exists(dirname(__FILE__).'/pdf/lang/eng.php')) {
				require_once(dirname(__FILE__).'/pdf/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			$pdf->SetFont('dejavusans', '', 8, '', true);

			$pdf->AddPage();
			$date=date('d.m.Y');
			$time=date('G:i:s');
			
			$htmladd='
<div style="align: center; font-size: 16px; text-align: center"><b>Утвержденные пользователи на '.$date.' '.$time.'</b></div><br><br>
<table border="1" cellspacing="0">
<tr style="line-height: 50px;">
<td align="center" valign="middle" width="60px"><b>№</b></td>
<td align="center" valign="middle" width="100px"><b>Чат ID</b></td>
<td align="center" valign="middle" width="120px"><b>Имя</b></td>
<td align="center" valign="middle" width="120px"><b>Фамилия</b></td>
<td align="center" valign="middle" width="150px"><b>Имя пользователя</b></td>
<td align="center" valign="middle" width="150px"><b>Телефон</b></td>
<td align="center" valign="middle" width="250px"><b>ФИО</b></td>
</tr>';

				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					
					$htmladd=''.$htmladd.''.PHP_EOL.'<tr>';
									
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][0].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][1].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][2].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][3].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][4].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][5].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;"><b>'.$row1[$i1][6].'</b></td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					
					
					$htmladd=''.$htmladd.''.PHP_EOL.'</tr>';
				}
				
			
			
			$htmladd=''.$htmladd.''.PHP_EOL.'</table>';
			$html = <<<EOD
$htmladd
EOD;
			
			array_map('unlink', glob(''.dirname(__FILE__).'/pdf/users*.pdf'));
			usleep(250000);
			
			$time=date('G.i.s');
			
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			$pdf->Output(''.dirname(__FILE__).'/pdf/users_'.$date.'_'.$time.'.pdf', 'F');
			usleep(250000);
			
			$this->api->sendDocument([
				'document' => 'https://domain.com/pdf/users_'.$date.'_'.$time.'.pdf',
				'disable_notification' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(250000);
			
			
			$text='Вам был выслан файл с информацией об утвержденных пользователях.'.PHP_EOL.'Вы находитесь в разделе <b>Утвержденные пользователи</b>.'.$this->pre.'';
				
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_approvedusers']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
				
		}

		else
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
				
			$text='В данный момент у Вас <b>нет ни одного утвержденного пользователя</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_approvedusers']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}
/////////////////////////////////////////////////////////////Забанить пользователя/////////////////////////////////////////////////////
///////	
	public function callback_admin_banapprovedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		}
		else
		{
			$merge=$this->cmd_admin_banapprovedusers();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Забанить утвержденных пользователей</b>.'.PHP_EOL.'Выберите необходимого пользователя, чтобы забанить его.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
			}
			
		}
	}
	
/////	
	public function cmd_admin_banapprovedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		

		$tab='tabserviceapproved';
		$tab1='tabservicedenied';
		$tab2='tabserviceusers';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			
			$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		else
		{
			$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
			usleep(100000);
			$con1=mysqli_num_rows($query1);
		
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
	
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
				unset($getinclude[array_key_last($getinclude)]);
				file_put_contents($include, $getinclude);
			}
			
			$u=0;
			$merge=[];
			
			for($i1=0;$i1<$ceil;$i1++)
			{
				$put=[];
				for($i2=0;$i2<$maxbuttons;$i2++)
				{	
					if(isset($table[$u]) && $this->cmd_isadmin1($table[$u])==FALSE)
					{	

						//$buttext="👤$table[$u]";
						$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
						
						$put[]=["text" => "$buttext", "callback_data" => "admin_banapproveduser_$table[$u]"];
						
						if(preg_match('/callback_admin_banapproveduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_admin_banapproveduser_'.$table[$u].'()
							{	
					
								$bot = new TestBot;
								$bot->api->getWebhookUpdate();
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								
								$con_sql2=$bot->cmd_sql();
								$tab=&#039;tabserviceapproved&#039;;
								
								$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE id LIKE "%" LIMIT 1&#039;);
								usleep(100000);
								$con1=mysqli_num_rows($query1);
								
								if($con1!=0)
								{
								
									$con_sql2=$bot->cmd_sql();
									
									mysqli_query($con_sql2, &#039;INSERT INTO '.$tab1.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tab2.' WHERE chatid="'.$table[$u].'"&#039;);
									usleep(250000);
									
									$queue=&#039;DELETE FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;;
									$result=mysqli_query($con_sql2, $queue);
									usleep(100000);
									
									
									$get=file_get_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;);
									$get=str_replace("'.$table[$u].'", "", $get);
									$get=$bot->clean($get);
									file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;, $get . PHP_EOL);
									

									$text="К сожалению, у Вас <b>больше нет права</b> размещать объявления в канале!&#039;.$bot->pre.&#039;";
	
									$bot->api->sendMessage([
										&#039;chat_id&#039; => '.$table[$u].',
										&#039;text&#039; => $text,
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_default&#039;]]),
										&#039;disable_notification&#039; => TRUE,
										&#039;disable_web_page_preview&#039; => TRUE,
										&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
	
									$text=&#039;Вы <b>отказали</b> пользователю <b>'.$buttext.'</b> в праве на размещение объявлений в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Забанить утвержденных пользователей</b>.&#039;.PHP_EOL.&#039;Выберите необходимого пользователя, чтобы забанить его.&#039;.$bot->pre.&#039;&#039;;
									
									$merge=$bot->cmd_admin_banapprovedusers();
									usleep(100000);
									
									if (array_filter($merge) !== [])
									{
									
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
		
										$bot->api->answerCallbackQuery($callback_query_id);
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
										$text=&#039;В данный момент <b>нет утвержденных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
									}

								}
								else
								{
									$text=&#039;В данный момент <b>нет утвержденных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
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
public function callback_admin_sendmessageapprovedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет утвержденных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		}
		else
		{
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
			{
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("message")');
				usleep(100000);
			}
			else
			{
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))==0)
				{
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("message")');
					usleep(100000);
				}
				else
				{
					mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
					usleep(100000);
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("message")');
					usleep(100000);
				}
			}
					
			$text='Пришлите сообщение, чтобы отправить его всем пользователям!'.$this->pre.'';
			
			$merge=[];
			$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_admin_sendmessageapprovedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_admin_sendmessageapprovedusers']];
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
			}

	}
		


/////
	public function callback_back_admin_sendmessageapprovedusers()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
				
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вернулись в подменю <b>Утвержденные пользователи</b> основного меню Пользователи.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
		usleep(100000);
	}
/////		
	public function callback_exit_admin_sendmessageapprovedusers()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вышли в <b>Главное Меню</b>.'.$this->pre.'';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(100000);
	}

/////	
	public function cmd_admin_sendmessageapprovedusers()
	{
		$con_sql2=$this->cmd_sql();

		$fromchatid=$this->api->chatId;
		$messageid=$this->api->messageid;
		$tabserviceapproved='tabserviceapproved';
		
		$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceapproved.' WHERE id LIKE "%"');
		$con1=mysqli_num_rows($query1);
		
		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
			$chatiduser=$row1[$i1][1];
			
			if($chatiduser!==$this->chatidadmin)
			{
				$this->api->copyMessage([
				'chat_id' => $chatiduser,
				'from_chat_id' => $fromchatid,
				'message_id' => $messageid,
				'disable_notification' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
			}
		}

		$text='Вы <b>успешно отправили сообщение</b> всем утвержденным пользователям.'.PHP_EOL.'Вы находитесь в модменю <b>Утвержденные пользователи</b>.'.$this->pre.'';
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_approvedusers']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		
		
	}
	
////////////////////////////////////////////////////////////////////Объявления для канала//////////////////////////////////////////////////////////////////
/////	
	public function callback_admin_showallrecordsapprovedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		$tabmain='tabmain'.$this->api->chatId.'';
		
			
			$merge=$this->cmd_admin_showallrecordsapprovedusers();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Показать объявления пользователя для канала.</b> Выберите необходимого пользователя, чтобы посмотреть его объявления.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у пользователей <b>нет товаров</b> для размещения в канале.'.PHP_EOL.'Вы находитесь в подменю <b>Утвержденные пользователи</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
			}

		
	}


/////
	public function cmd_admin_showallrecordsapprovedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';

		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
	
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	

				$tabmain='tabmain'.$table[$u].'';
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' LIMIT 1'))
				{
					
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE pic!="0" AND messid="0" LIMIT 1'))!=0)
					{
		
						$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
						$put[]=["text" => "$buttext", "callback_data" => "admin_showallrecordsapproveduser_$table[$u]"];
						
						if(preg_match('/callback_admin_showallrecordsapproveduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_admin_showallrecordsapproveduser_'.$table[$u].'()
							{	
								$bot = new TestBot;
								$bot->api->getWebhookUpdate();
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								
								$con_sql2=$bot->cmd_sql();
								
								$tab=&#039;tabmain'.$table[$u].'&#039;;
								$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE pic!="0" AND messid="0" LIMIT 1&#039;);
								usleep(100000);
								$con1=mysqli_num_rows($query1);
								
								if($con1!=0)
								{
									
									$text=&#039;⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️&#039;.PHP_EOL.&#039;Объявления пользователя <b>'.$buttext.'</b>&#039;;
									$bot->api->sendMessage([
										&#039;text&#039; => $text,
										&#039;disable_notification&#039; => TRUE,
										&#039;disable_web_page_preview&#039; => TRUE,
										&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
									
									$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tab.&#039; WHERE pic!="0" AND messid="0" ORDER by id ASC&#039;);
									usleep(100000);
									$con=mysqli_num_rows($query);
										
									for($i=0;$i<$con;$i++)
									{
										mysqli_data_seek($query, $i);
										$row[$i]=mysqli_fetch_row($query);
									}
									usleep(100000);
									
									
									for($i=0;$i<$con;$i++)
									{
									
									
										$type=$bot->convert_rus($row[$i][1]);
										$cat=$bot->convert_rus($row[$i][2]);
										$gender=$bot->convert_rus($row[$i][3]);
										$cond=$bot->convert_rus($row[$i][12]);
									
									
									
										/* $text=&#039;<b>Объявление №&#039;.$row[$i][0].&#039;</b>&#039;;
										
										$bot->api->sendMessage([
										&#039;text&#039; => $text,
										&#039;disable_notification&#039; => TRUE,
										&#039;disable_web_page_preview&#039; => TRUE,
										&#039;parse_mode&#039;=> "HTML"
										]);
										usleep(100000); */
										
										$caption=&#039;📖Категория: <b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: <b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: <b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;🎏Состояние: <b>&#039;.$cond.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: <b>&#039;.$row[$i][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: <b>&#039;.$row[$i][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: <b>&#039;.$row[$i][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#039;.$row[$i][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Объявление №&#039;.$row[$i][0].&#039;</b>&#039;;
										
										$photo=$row[$i][8];
										
										if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
										{
											$bot->api->sendPhoto([
											&#039;photo&#039; => $photo,
											&#039;caption&#039; => $caption,
											&#039;disable_notification&#039; => TRUE,
											&#039;parse_mode&#039; => "HTML"
											]);
											usleep(250000);
										
										}
										else
										{
											$media=[];
											$temp=explode(&#039;;&#039;, $photo);
											$cnt=count($temp);
											for($o=0;$o<$cnt;$o++)
											{
											
											
												if($o==0)
												{
													$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039;, &#039;caption&#039; => &#039;&#039;.$caption.&#039;&#039;, &#039;parse_mode&#039; => "HTML" ];
												}
												else
												{
													$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039; ];
												}
										
												$media[$o]=$put;
											}
											
											
											$bot->api->sendMediaGroup([
											&#039;media&#039; => json_encode($media),
											]);
								
										}
										

									}
									
									$text=&#039;Сверху показаны объявления пользователя <b>'.$buttext.'</b> для размещения в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Показать объявления пользователей для канала.</b> Нажмите кнопку снизу, чтобы показать объявления выбранного пользователя.&#039;.$bot->pre.&#039;&#039;;
				
									$merge=$bot->cmd_admin_showallrecordsapprovedusers();
									
									if (array_filter($merge) !== [])
									{
										usleep(100000);
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
										
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->sendMessage([
											&#039;text&#039; => $text,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
											&#039;disable_notification&#039; => TRUE,
											&#039;disable_web_page_preview&#039; => TRUE,
											&#039;parse_mode&#039;=> "HTML"
										]);
										usleep(100000);
									}
									else
									{
										
										$text=&#039;В данный момент у пользователей <b>нет товаров</b> для размещения в канале.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Утвержденные пользователи</b> главного меню администратора.&#039;.$bot->pre.&#039;&#039;;
										
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->sendMessage([
											&#039;text&#039; => $text,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]]),
											&#039;disable_notification&#039; => TRUE,
											&#039;disable_web_page_preview&#039; => TRUE,
											&#039;parse_mode&#039;=> "HTML"
										]);
										usleep(100000);

									}
								}
								else
								{
									
									$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет товаров для размещения в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать объявления пользователей для канала. нажмите кнопку снизу, чтобы показать объявления выбранного пользователя.&#039;.$bot->pre.&#039;&#039;;
									
									$merge=$bot->cmd_admin_showallrecordsapprovedusers();
									usleep(100000);
									
									if (array_filter($merge) !== [])
									{
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];

										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->editMessageText([
											&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
											&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
											&#039;text&#039; => $text,
											&#039;parse_mode&#039; => "HTML",
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
											]);
									}
									else
									{
										$text=&#039;В данный момент у пользователя 👤<b>'.$buttext.'</b> нет товаров для размещения в канале.&#039;.PHP_EOL.&#039;В данный момент у пользователей <b>нет товаров</b> для размещения в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать объявления пользователей не в канале. нажмите кнопку снизу, чтобы показать объявления выбранного пользователя.&#039;.$bot->pre.&#039;&#039;;
										
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->editMessageText([
											&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
											&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
											&#039;text&#039; => $text,
											&#039;parse_mode&#039; => "HTML",
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
											]);
											
										/* $bot->api->sendMessage([
											&#039;text&#039; => $text,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]]),
											&#039;disable_notification&#039; => TRUE,
											&#039;disable_web_page_preview&#039; => TRUE,
											&#039;parse_mode&#039;=> "HTML"
										]); */
										usleep(100000);
									}
								}
								
								
							}';
							file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						}
					
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



/////////////////////////////////////////////////////////////////Товары в канале//////////////////////////////////////////////////////////////////////
/////	
	public function callback_admin_showchannelrecordsapprovedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		
			$merge=$this->cmd_admin_showchannelrecordsapprovedusers();
			
			if (array_filter($merge) !== [])
			{
				usleep(100000);
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Показать товары пользователей в канале</b>. Выберите необходимого пользователя, чтобы посмотреть его товары.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет пользователей,</b> у которых размещены товары в канале!'.PHP_EOL.'Вы находитесь в подменю <b>Утвержденные пользователи</b> главного меню администратора.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
			}
			
	}


/////
	public function cmd_admin_showchannelrecordsapprovedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';

		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
	
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				$tabmain='tabmain'.$table[$u].'';
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' LIMIT 1'))
				{
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE pic!="0" AND messid!="0" LIMIT 1'))!=0)
				{
					
					$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_showchannelrecordsapproveduser_$table[$u]"];
					
					if(preg_match('/callback_admin_showchannelrecordsapproveduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_showchannelrecordsapproveduser_'.$table[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							
							$tab=&#039;tabmain'.$table[$u].'&#039;;
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE messid!="0" LIMIT 1&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							if($con1!=0)
							{
								
								$text=&#039;⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️&#039;.PHP_EOL.&#039;Товары пользователя <b>'.$buttext.'</b> в канале:&#039;;
								$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
								]);
								usleep(100000);
								
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tab.&#039; WHERE messid!="0"&#039;);
								usleep(100000);
								$con=mysqli_num_rows($query);
									
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
								usleep(100000);
								
				
								for($i=0;$i<$con;$i++)
								{
								
									$type=$bot->convert_rus($row[$i][1]);
									$cat=$bot->convert_rus($row[$i][2]);
									$gender=$bot->convert_rus($row[$i][3]);
									$cond=$bot->convert_rus($row[$i][12]);
								
								
								
									/* $text=&#039;<b>ID товара №&#039;.$row[$i][11].&#039;</b>&#039;;
									
									$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000); */


									$caption=&#039;📖Категория: &#160;&#160;<b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: &#160;&#160;<b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: &#160;&#160;<b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;🎏Состояние: &#160;&#160;<b>&#039;.$cond.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: &#160;&#160;<b>&#039;.$row[$i][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: &#160;&#160;<b>&#039;.$row[$i][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: &#160;&#160;<b>&#039;.$row[$i][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#160;&#160;&#039;.$row[$i][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>ID товара: &#039;.$row[$i][11].&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📁📁📁📁📁📁📁📁📁📁📁📁&#039;;
									
									$photo=$row[$i][8];
									
									if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
									{
										$bot->api->sendPhoto([
										&#039;photo&#039; => $photo,
										&#039;caption&#039; => $caption,
										&#039;disable_notification&#039; => TRUE,
										&#039;parse_mode&#039; => "HTML"
										]);
										usleep(250000);
									
									}
									else
									{
										$media=[];
										$temp=explode(&#039;;&#039;, $photo);
										$cnt=count($temp);
										for($o=0;$o<$cnt;$o++)
										{
										
										
											if($o==0)
											{
												$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039;, &#039;caption&#039; => &#039;&#039;.$caption.&#039;&#039;, &#039;parse_mode&#039; => "HTML" ];
											}
											else
											{
												$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039; ];
											}
									
											$media[$o]=$put;
										}
										
										
										$bot->api->sendMediaGroup([
										&#039;media&#039; => json_encode($media),
										]);
							
									}
								}
								
								$text=&#039;Сверху показаны все товары пользователя <b>'.$buttext.'</b> в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Показать товары пользователей в канале</b>. нажмите кнопку снизу, чтобы показать товары выбранного пользователя в канале.&#039;.$bot->pre.&#039;&#039;;
				
								$merge=$bot->cmd_admin_showchannelrecordsapprovedusers();
								
								if (array_filter($merge) !== [])
								{
									usleep(100000);
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->sendMessage([
										&#039;text&#039; => $text,
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
										&#039;disable_notification&#039; => TRUE,
										&#039;disable_web_page_preview&#039; => TRUE,
										&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
								}
								else
								{
									
									$text=&#039;В данный момент <b>нет пользователей,</b> у которых размещены товары в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Утвержденные пользователи</b> главного меню администратора.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->sendMessage([
										&#039;text&#039; => $text,
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]]),
										&#039;disable_notification&#039; => TRUE,
										&#039;disable_web_page_preview&#039; => TRUE,
										&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
				
								}
							}
							else
							{
								
								$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Показать товары пользователей в канале</b>. нажмите кнопку снизу, чтобы показать товары выбранного пользователя.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_showchannelrecordsapprovedusers();
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
				
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
										]);
								}
								else
								{
									$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет товаров, размещенных в канале!&#039;.PHP_EOL.&#039;В данный момент <b>нет пользователей,</b> у которых размещены товары в канале!&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Утвержденные пользователи</b> главного меню администратора.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
										]);
										
									/* $bot->api->sendMessage([
										&#039;text&#039; => $text,
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]]),
										&#039;disable_notification&#039; => TRUE,
										&#039;disable_web_page_preview&#039; => TRUE,
										&#039;parse_mode&#039;=> "HTML"
									]); */
									usleep(100000);
								}
							}
							
							
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
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


///////////////////////////////////////////////////////////////////Удалить объявления для канала//////////////////////////////////////////////////////////
/////	
	public function callback_admin_deleterecordsapprovedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
			
			$merge=$this->cmd_admin_deleterecordsapprovedusers();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Удалить объявления пользователей для канала.</b> Выберите необходимого пользователя, чтобы удалить его объявления.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у пользователей <b>нет объявлений</b> для размещения в канале.'.PHP_EOL.' Вы находитесь в меню утвержденных пользователей.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
				
				
			}
		
	}


/////
	public function cmd_admin_deleterecordsapprovedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				$tabmain='tabmain'.$table[$u].'';
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' LIMIT 1'))
				{
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE pic!="0" AND messid="0" LIMIT 1'))!=0)
				{
					
					$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_deleterecordsapproveduser_$table[$u]"];
					
					if(preg_match('/callback_admin_deleterecordsapproveduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_deleterecordsapproveduser_'.$table[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							$tab=&#039;tabserviceapproved&#039;;
							//$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE pic!="0" AND messid="0" LIMIT 1&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
				
							$text=&#039;Для того, чтобы удалить объявление пользователя <b>'.$buttext.'</b>, Вам нужно нажать на кнопку с номером объявления.&#039;.$bot->pre.&#039;&#039;;
				
							$merge=$bot->cmd_admin_deleterecordsapprovedusers_records('.$table[$u].');
							
							usleep(100000);
							if (array_filter($merge) !== [])
							{
								$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
								$bot->api->answerCallbackQuery($callback_query_id);
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
								$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039; Вы находитесь в подменю <b>Удалить объявления</b> меню утвержденных пользователей. Пожалуйста, <b>выбирите пользователя</b>, чтобы удалить его объявления.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_deleterecordsapprovedusers();
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									]);
								}
								else
								{
									$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет объявлений для размещения в канале. В данный момент <b>нет пользователей</b>, у которых есть объявления для размещения в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
									]);
								}
							}
							
							
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
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




/////
	public function cmd_admin_deleterecordsapprovedusers_records($input)
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		$tabmain='tabmain'.$input.'';
			
			
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE pic!="0" AND messid="0"');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' LIMIT 1'))
				if(isset($table[$u]))
				{	
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE pic!="0" AND messid="0"'))!=0)
				{
					$buttext='№'.$table[$u].'';
					$put[]=["text" => ''.$buttext.'', "callback_data" => 'adm_delrecappuser_user'.$input.'_rec'.$table[$u].''];
					
					$butuser='👤'.$this->cmd_user_get_fiophone($input).'';
					
					if(preg_match('/callback_adm_delrecappuser_user'.$input.'_rec'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_adm_delrecappuser_user'.$input.'_rec'.$table[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							$tabmain=&#039;tabmain'.$input.'&#039;;
							$tabserviceask=&#039;tabserviceask'.$input.'&#039;;
							
							
							$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT id FROM &#039;.$tabmain.&#039; WHERE pic!="0" AND messid="0"&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
				
							if($con1!=0)
							{
								
								$query=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabmain.&#039; WHERE id="'.$table[$u].'"&#039;);
								usleep(100000);
								$query=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabserviceask.&#039; WHERE record="'.$table[$u].'"&#039;);
								usleep(100000);
								
								$text2=&#039;Ваше объявление <b>№'.$table[$u].'</b> было <b>удалено администратором</b> и <b>не будет размещено в канале</b>.&#039;.$bot->pre.&#039;&#039;;
									
								$bot->api->sendMessage([
								
									&#039;chat_id&#039; => '.$input.',
									&#039;text&#039; => $text2,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_sell&#039;]]),
									&#039;parse_mode&#039; => "HTML",
									]);
								usleep(100000);
								
								$text=&#039;Выбранное объявление <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удалено.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Удалить объявления для размещения в канале пользователя <b>'.$butuser.'</b>. Пожалуйста, выбирите объявление, чтобы удалить его.&#039;.$bot->pre.&#039;&#039;;
								
				
								$merge=$bot->cmd_admin_deleterecordsapprovedusers_records('.$input.');
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
								
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_deleterecords_users&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;Выбранное объявление <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удалено.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;.$bot->pre.&#039;&#039;;
									$merge=$bot->cmd_admin_deleterecordsapprovedusers();
									
									if (array_filter($merge) !== [])
									{
									
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_deleterecords_users&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
										$bot->api->answerCallbackQuery($callback_query_id);
								
										$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
										]);
										
									}
									else
									{
										$text=&#039;Выбранное объявление <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удалено.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039;В данный момент у пользователей <b>нет объявлений</b> для размещения в канале.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Утвержденные пользователи</b> главного меню администратора.&#039;.$bot->pre.&#039;&#039;;
									
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->sendMessage([
											&#039;text&#039; => $text,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]]),
											&#039;disable_notification&#039; => TRUE,
											&#039;disable_web_page_preview&#039; => TRUE,
											&#039;parse_mode&#039;=> "HTML"
										]);
										usleep(100000);
									}
								}
							}
							else
							{
								
								$merge=$bot->cmd_admin_deleterecordsapprovedusers();
								
								
								if (array_filter($merge) !== [])
								{
									
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$text=&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет товаров для размещения в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Удалить объявления для размещения в канале раздела Утвержденные пользователи. Пожалуйста, выбирите пользователя, у которого Вы хотите удалить объявления.&#039;.$bot->pre.&#039;&#039;;
									$bot->api->answerCallbackQuery($callback_query_id);
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									]);
								}
								else
								{
									$text=&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет товаров для размещения в канале. В данный момент у пользователей <b>нет товаров</b> для размещения в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
									]);
								}
							}
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
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
	
/////	
	public function callback_admin_back_deleterecords_users()
	{	
		$text='Вы вернулись в главное меню Утвержденные пользователи.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
	}
	
	
	

///////////////////////////////////////////////////////////////////////////Удалить из канала///////////////////////////////////////////////////////////////////////////
/////	
	public function callback_admin_deleterecordsapprovedusers_channel()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		
			/* $tabserviceadmin='tabserviceadmin';
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
			{
				mysqli_query($con_sql2, 'DROP TABLE '.$tabserviceadmin.'');
				usleep(100000);
			} */
			
			$merge=$this->cmd_admin_deleterecordsapprovedusers_channel();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Удалить объявления пользователей в канале</b>. Выберите необходимого пользователя, чтобы удалить его объявления.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у пользователей <b>нет товаров</b>, размещенных в канале.'.PHP_EOL.' Вы находитесь в меню утвержденных пользователей.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
				
				
			}
		
	}


/////
	public function cmd_admin_deleterecordsapprovedusers_channel()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();

		$tab='tabserviceapproved';
		
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				$tabmain='tabmain'.$table[$u].'';
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' LIMIT 1'))
				{	
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE messid!="0" LIMIT 1'))!=0)
					{
						
						$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
						$put[]=["text" => "$buttext", "callback_data" => "admin_deleterecordsapproveduser_channel_$table[$u]"];
						
						if(preg_match('/callback_admin_deleterecordsapproveduser_channel_'.$table[$u].'/', file_get_contents($include))==FALSE)
						{
							$insert='
							public function callback_admin_deleterecordsapproveduser_channel_'.$table[$u].'()
							{	
								$bot = new TestBot;
								$bot->api->getWebhookUpdate();
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								
								$con_sql2=$bot->cmd_sql();
								$tab=&#039;tabserviceapproved&#039;;
								//$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
								
								$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE messid!="0" LIMIT 1&#039;);
								usleep(100000);
								$con1=mysqli_num_rows($query1);

								$text=&#039;Для того, чтобы удалить объявление пользователя <b>'.$buttext.'</b> в канале, Вам нужно нажать на соответствующую кнопку.&#039;.$bot->pre.&#039;&#039;;
			
								$merge=$bot->cmd_admin_deleterecordsapprovedusers_channel_records('.$table[$u].');
								
								usleep(100000);
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039; Вы находитесь в подменю Удалить товары из канала меню Утвержденные пользователи. Пожалуйста, выбирите пользователя, чтобы удалить его товары в канале.&#039;.$bot->pre.&#039;&#039;;
									
									$merge=$bot->cmd_admin_deleterecordsapprovedusers_channel();
									usleep(100000);
									
									if (array_filter($merge) !== [])
									{
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
										
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
										]);
									}
									else
									{
										$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет товаров, размещенных в канале. В данный момент у пользователей нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;.$bot->pre.&#039;&#039;;
										
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
										]);
									}
								}
								
								
							}';
								
							file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						}
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




/////
	public function cmd_admin_deleterecordsapprovedusers_channel_records($input)
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		$tabmain='tabmain'.$input.'';
			
			
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT messid FROM '.$tabmain.' WHERE messid!="0"');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				//$tabmain='tabmain'.$input.'';
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' LIMIT 1'))
				if(isset($table[$u]))
				{	
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE messid!="0" LIMIT 1'))!=0)
				{
					$buttext='№'.$table[$u].'';
					$butuser='👤'.$this->cmd_user_get_fiophone($input).'';
					
					$put[]=["text" => ''.$buttext.'', "callback_data" => 'admin_channel_user'.$input.'_record'.$table[$u].''];
					
					if(preg_match('/callback_admin_channel_user'.$input.'_record'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_channel_user'.$input.'_record'.$table[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							$tabmain=&#039;tabmain'.$input.'&#039;;
							
							
							$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT messid FROM &#039;.$tabmain.&#039; WHERE messid!="0"&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
				
							if($con1!=0)
							{
								
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
								usleep(100000);
								$con=mysqli_num_rows($query);
									
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
								
								$photo=$row[0][8];
								$messageid=$row[0][11];
								$timeold=$row[0][10];
								$timediff=time()-$timeold;
								
								if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
								{
									if($timediff>172000)
									{
										$text=&#039;<b><i>Товар удален</i></b>&#039;.PHP_EOL.&#039;⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️&#039;;
									
										$photodelete=&#039;https://domain.com/photodelete.png&#039;;
										
										$bot->api->editMessageMedia([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid,
										&#039;media&#039; => json_encode( [&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; => $photodelete]),
										]);
									
										$bot->api->editMessageCaption([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid,
										&#039;caption&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										]);
										
										
										$photo=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photo);
										unlink($photo);
										usleep(100000);
									}
									else
									{
										$bot->api->deleteMessage([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid
										]);
										
										$photo=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photo);
										unlink($photo);
										usleep(100000);
									}
								}
								else
								{
									
									$tabservicerecords=&#039;tabservicerecords&#039;;
									$text=&#039;<b><i>Товар удален</i></b>&#039;.PHP_EOL.&#039;⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️&#039;;
									$photodelete=&#039;https://domain.com/photodelete.png&#039;;
									
									if($timediff>172000)
									{
		
										$bot->api->editMessageCaption([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid,
										&#039;caption&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										]);
										
										
										$query2=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabservicerecords.&#039; WHERE record="&#039;.$messageid.&#039;"&#039;);
										$con2=mysqli_num_rows($query2);
					
										for($i2=0;$i2<$con2;$i2++)
										{
											mysqli_data_seek($query2, $i2);
											$row2[$i2]=mysqli_fetch_row($query2);
										}
										
										$messageids=explode(&#039;;&#039;, $row2[0][2]);
										$count1=count($messageids);
										
										for($e=0;$e<$count1;$e++)
										{
											if($e==0)
											{
												$bot->api->editMessageMedia([
												&#039;chat_id&#039; => $bot->mainchannel,
												&#039;message_id&#039; => $messageids[$e],
												&#039;media&#039; => json_encode( [&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; => $photodelete, &#039;caption&#039; => $text, &#039;parse_mode&#039; => "HTML" ]),
												]);

											}
											else
											{
												$bot->api->editMessageMedia([
												&#039;chat_id&#039; => $bot->mainchannel,
												&#039;message_id&#039; => $messageids[$e],
												&#039;media&#039; => json_encode( [&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; => $photodelete]),
												]);
											}
										}
										
										$photos=explode(&#039;;&#039;, $photo);
										$cnt=count($photos);
										
										for($y=0;$y<$cnt;$y++)
										{
											$photos[$y]=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photos[$y]);
											unlink($photos[$y]);
											usleep(100000);
										}
									}
									else
									{
										
										$query2=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabservicerecords.&#039; WHERE record="&#039;.$messageid.&#039;"&#039;);
										$con2=mysqli_num_rows($query2);
					
										for($i2=0;$i2<$con2;$i2++)
										{
											mysqli_data_seek($query2, $i2);
											$row2[$i2]=mysqli_fetch_row($query2);
										}
										
										$messageids=explode(&#039;;&#039;, $row2[0][2]);
										$count1=count($messageids);
										
										for($e=0;$e<$count1;$e++)
										{
											$bot->api->deleteMessage([
											&#039;chat_id&#039; => $bot->mainchannel,
											&#039;message_id&#039; => $messageids[$e]
											]);
											usleep(100000);
										}
										
										$photos=explode(&#039;;&#039;, $photo);
										$cnt=count($photos);
										
										for($y=0;$y<$cnt;$y++)
										{
											$photos[$y]=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photos[$y]);
											unlink($photos[$y]);
											usleep(100000);
										}
										
									}
									
									mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabservicerecords.&#039; WHERE record="&#039;.$messageid.&#039;"&#039;);
									
								}
								
								$query=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
								usleep(100000);
								
								$query4=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabservicebuy%"&#039;);
								$con4=mysqli_num_rows($query4);
								
								if($con4!=0)
								{
								
									for($i4=0;$i4<$con4;$i4++)
									{
										mysqli_data_seek($query4, $i4);
										$row4[$i4]=mysqli_fetch_row($query4);
										
										if(mysqli_num_rows(mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$row4[$i4][0].&#039; WHERE messid="'.$table[$u].'"&#039;))!=0)
										{
											
												mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$row4[$i4][0].&#039; WHERE messid="'.$table[$u].'"&#039;);
												usleep(100000);
												
												$chatidbuyers=str_replace(&#039;tabservicebuy&#039;, &#039;&#039;, $row4[$i4][0]);
												$chatidbuyers=$bot->clean($chatidbuyers);
												
												$text3=&#039;Ваша заявка на покупку товара с ID <b>№'.$table[$u].'</b> была <b>отменена администратором</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;К сожалению, данного товара нет в наличии. Извините за неудобства.&#039;.$bot->pre.&#039;&#039;;
												
												$bot->api->sendMessage([
												&#039;chat_id&#039; => $chatidbuyers,
												&#039;text&#039; => $text3,
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_buy_default&#039;]]),
												&#039;parse_mode&#039; => "HTML",
												]);
												usleep(100000);
												
										}
										
									}
								}
								
								$text2=&#039;Ваш товар с ID <b>№'.$table[$u].'</b> был <b>удален администратором из канала</b>. Приносим извинения за неудобства.&#039;.$bot->pre.&#039;&#039;;

								$bot->api->sendMessage([
									&#039;chat_id&#039; => '.$input.',
									&#039;text&#039; => $text2,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_default&#039;]]),
									&#039;parse_mode&#039; => "HTML",
									]);
								usleep(100000);
								
								$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Удалить товары пользователя <b>'.$butuser.'</b> из канала. Пожалуйста, выбирите ID товара, чтобы удалить его из канала.&#039;.$bot->pre.&#039;&#039;;
								
				
								$merge=$bot->cmd_admin_deleterecordsapprovedusers_channel_records('.$input.');
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
								
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_deleterecords_users&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;.$bot->pre.&#039;&#039;;
									$merge=$bot->cmd_admin_deleterecordsapprovedusers_channel();
									
									if (array_filter($merge) !== [])
									{
									
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_deleterecords_users&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
										$bot->api->answerCallbackQuery($callback_query_id);
								
										$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
										]);
										
									}
									else
									{
										$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039;В данный момент <b>нет пользователей,</b> у которых размещены товары в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Утвержденные пользователи</b> главного меню администратора.&#039;.$bot->pre.&#039;&#039;;
									
										$bot->api->answerCallbackQuery($callback_query_id);
										$bot->api->sendMessage([
											&#039;text&#039; => $text,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]]),
											&#039;disable_notification&#039; => TRUE,
											&#039;disable_web_page_preview&#039; => TRUE,
											&#039;parse_mode&#039;=> "HTML"
										]);
										usleep(100000);
									}
								}
							}
							else
							{
								
								$merge=$bot->cmd_admin_deleterecordsapprovedusers_channel();
								
								
								if (array_filter($merge) !== [])
								{
									
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет товаров, размещенных в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе удаления объявлений утвержденных пользователей. Пожалуйста, выбирите пользователя, у которого Вы хотите удалить товары из канала.&#039;.$bot->pre.&#039;&#039;;
									$bot->api->answerCallbackQuery($callback_query_id);
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									]);
								}
								else
								{
									$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет товаров, размещенных в канале. В данный момент у пользователей нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
									]);
								}
							}
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
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
	
	



///////////////////////////////////////////////////////Разместить в канале//////////////////////////////////////////////////////////
/////	
	public function callback_admin_sendchannelapprovedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		

			$merge=$this->cmd_admin_sendchannelapprovedusers();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Разместить в канале</b>. Выберите необходимого пользователя, чтобы разместить в канале его объявления.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у пользователей <b>нет запросов</b> на отправку объявлений в канал.'.PHP_EOL.' Вы находитесь в меню утвержденных пользователей.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
				
				
			}
		
	}


/////
	public function cmd_admin_sendchannelapprovedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();

		$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabserviceask%"');
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		
		$puttemp=[];
		
		for($i=0;$i<$con1;$i++)
		{
			$tab=$table[$i];
		
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE messid="0" AND pic!="0" LIMIT 1'))!=0)
			if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%"'))!=0)
			{
				$user=str_replace("tabserviceask", "", $tab);
				
				if(in_array($user, $puttemp)==FALSE)
				{
					$puttemp[]=$user;
				}
			}
		}
		
		$cnt=count($puttemp);
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				$tabserviceask='tabserviceask'.$puttemp[$u].'';
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceask.' LIMIT 1'))
				{
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceask.' WHERE id LIKE "%"'))!=0)
				{
					
					//$buttext='👤'.$puttemp[$u].'';
					$buttext='👤'.$this->cmd_user_get_fiophone($puttemp[$u]).'';
					
					$put[]=["text" => ''.$buttext.'', "callback_data" => 'admin_sendchannelapprovedusers_user'.$puttemp[$u].''];
					
					$user=str_replace("tabmain", "", $tabmain);
					
					if(preg_match('/callback_admin_sendchannelapprovedusers_user'.$puttemp[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_sendchannelapprovedusers_user'.$puttemp[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();
							
							$text=&#039;Для того, чтобы отправить объявления пользователя <b>'.$buttext.'</b> в канал, Вам нужно нажать на соответствующую кнопку объявления.&#039;.$bot->pre.&#039;&#039;;
				
							$merge=$bot->cmd_admin_sendchannelapprovedusers_records('.$puttemp[$u].');
							
							usleep(100000);
							if (array_filter($merge) !== [])
							{
								$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_sendchannelapprovedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
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
								$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подменю Разместить в канале меню Утвержденные пользователи. Пожалуйста, выбирите пользователя, чтобы разместить его объявления в канале.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_sendchannelapprovedusers();
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									]);
								}
								else
								{
									$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039; В данный момент у пользователей нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню Утвержденные пользователи.&#039;.$bot->pre.&#039;&#039;;
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
									]);
								}
							}
							
							
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
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




/////
	public function cmd_admin_sendchannelapprovedusers_records($input)
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		$tabserviceask='tabserviceask'.$input.'';
		$tabmain='tabmain'.$input.'';
		
		//$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE messid="0" AND pic!="0" ORDER by id ASC');
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT record FROM '.$tabserviceask.' WHERE id LIKE "%"');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceask.' WHERE id LIKE "%"'))!=0)
				{

					$butuser='👤'.$this->cmd_user_get_fiophone($input).'';
					$buttext='№'.$table[$u].'';
					$put[]=["text" => ''.$buttext.'', "callback_data" => 'adm_sendchanusers_user'.$input.'_rec'.$table[$u].''];

					
					
					if(preg_match('/callback_adm_sendchanusers_user'.$input.'_rec'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_adm_sendchanusers_user'.$input.'_rec'.$table[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();
							
								if(mysqli_num_rows(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabmain.' WHERE messid="0" AND pic!="0" LIMIT 1&#039;))!=0)
								{
									
									$query=mysqli_query($con_sql2, &#039;SELECT * FROM '.$tabmain.' WHERE id="'.$table[$u].'"&#039;);
									usleep(100000);
									$con=mysqli_num_rows($query);
									
									for($i=0;$i<$con;$i++)
									{
										mysqli_data_seek($query, $i);
										$row[$i]=mysqli_fetch_row($query);
									}
									usleep(250000);
									
									$mainchannel=$bot->mainchannel;
									
									$type=$bot->convert_rus($row[0][1]);
									$cat=$bot->convert_rus($row[0][2]);
									$gender=$bot->convert_rus($row[0][3]);
									$cond=$bot->convert_rus($row[0][12]);
									
									/* $text=&#039;❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️&#039;;
									$bot->api->sendMessage([
									&#039;chat_id&#039; => $mainchannel,
									&#039;text&#039; => $text,
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> &#039;HTML&#039;
									]); */

									
									$caption=&#039;📖Категория: &#160;&#160;<b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: &#160;&#160;<b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: &#160;&#160;<b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;🎏Состояние: &#160;&#160;<b>&#039;.$cond.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: &#160;&#160;<b>&#039;.$row[0][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: &#160;&#160;<b>&#039;.$row[0][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: &#160;&#160;<b>&#039;.$row[0][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#160;&#160;&#039;.$row[0][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📁📁📁📁📁📁📁📁📁📁📁📁&#039;;
									
									$photo=$row[0][8];
							
									if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
									{
										$result=json_decode($bot->api->sendPhoto([
										&#039;chat_id&#039; => $mainchannel,
										&#039;photo&#039; => $photo,
										&#039;caption&#039; => $caption,
										&#039;disable_notification&#039; => TRUE,
										&#039;parse_mode&#039; => "HTML"
										]), true);
										usleep(250000);
										$messageid=$result[&#039;result&#039;][&#039;message_id&#039;];
									}
									else
									{
										$tabservicerecords=&#039;tabservicerecords&#039;;
										
										if(mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tabservicerecords.&#039; LIMIT 1&#039;)==FALSE)
										{
											mysqli_query($con_sql2, &#039;CREATE TABLE &#039;.$tabservicerecords.&#039; (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,record VARCHAR(20),messids VARCHAR(250)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;);
											usleep(250000);
										}
										
										
										$media=[];
										$temp=explode(&#039;;&#039;, $photo);
										$cnt=count($temp);
										
										for($o=0;$o<$cnt;$o++)
										{
											if($o==0)
											{
												$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039;, &#039;caption&#039; => &#039;&#039;.$caption.&#039;&#039;, &#039;parse_mode&#039; => "HTML" ];
											}
											else
											{
												$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039; ];
											}
									
											$media[$o]=$put;
										}
										
										
									
										$result=json_decode($bot->api->sendMediaGroup([
										&#039;chat_id&#039; => $mainchannel,
										&#039;media&#039; => json_encode($media),
										]), true);
										usleep(350000);
										
										$messageid=$result[&#039;result&#039;][0][&#039;message_id&#039;];
										
										mysqli_query($con_sql2, &#039;INSERT INTO &#039;.$tabservicerecords.&#039; (record, messids) VALUES ("&#039;.$messageid.&#039;", "0")&#039;);
										usleep(150000);
										
										$cnt=count($result[&#039;result&#039;]);
										
										for($o=0;$o<$cnt;$o++)
										{
											$messageids=$result[&#039;result&#039;][$o][&#039;message_id&#039;];
											
											if($o==0)
											{
												$put=$messageids;
											}
											else
											{
												$put=&#039;&#039;.$put.&#039;;&#039;.$messageids.&#039;&#039;;
											}
											
											
										}
										
										$query2=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabservicerecords.&#039; WHERE record="&#039;.$messageid.&#039;"&#039;);
										$con2=mysqli_num_rows($query2);
										
										for($i2=0;$i2<$con2;$i2++)
										{
											mysqli_data_seek($query2, $i2);
											$row2[$i2]=mysqli_fetch_row($query2);
										}
										
										$query1=&#039;UPDATE &#039;.$tabservicerecords.&#039; SET messids = REPLACE(messids, "&#039;.$row2[0][2].&#039;", "&#039;.$put.&#039;") WHERE record="&#039;.$messageid.&#039;"&#039;; 
										$result1=mysqli_query($con_sql2, $query1);
										usleep(100000);	
									}
							
									$date=date("d.m.Y");
									$time=time();
									
									$query2=&#039;UPDATE '.$tabmain.' SET date = REPLACE(date, "&#039;.$row[0][9].&#039;", "&#039;.$date.&#039;") WHERE id="'.$table[$u].'"&#039;; 
									$result2=mysqli_query($con_sql2, $query2);
									
									$query2=&#039;UPDATE '.$tabmain.' SET time = REPLACE(time, "&#039;.$row[0][10].&#039;", "&#039;.$time.&#039;") WHERE id="'.$table[$u].'"&#039;; 
									$result2=mysqli_query($con_sql2, $query2);
									
									$query2=&#039;UPDATE '.$tabmain.' SET messid = REPLACE(messid, "&#039;.$row[0][11].&#039;", "&#039;.$messageid.&#039;") WHERE id="'.$table[$u].'"&#039;; 
									$result2=mysqli_query($con_sql2, $query2);
									
									$query=mysqli_query($con_sql2, &#039;DELETE FROM '.$tabserviceask.' WHERE record="'.$table[$u].'"&#039;);
									usleep(100000);
									
									$caption1=&#039;📖Категория: &#160;&#160;<b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: &#160;&#160;<b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: &#160;&#160;<b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;🎏Состояние: &#160;&#160;<b>&#039;.$cond.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: &#160;&#160;<b>&#039;.$row[0][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: &#160;&#160;<b>&#039;.$row[0][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: &#160;&#160;<b>&#039;.$row[0][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#160;&#160;&#039;.$row[0][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>ID товара: &#039;.$messageid.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📁📁📁📁📁📁📁📁📁📁📁📁&#039;;
									
									$bot->api->editMessageCaption([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid,
										&#039;caption&#039; => $caption1,
										&#039;parse_mode&#039; => "HTML",
										]);
									
									usleep(250000);
									
									$text2=&#039;Ваше объявление <b>№'.$table[$u].'</b> успешно размещено в канале с <b>ID товара № &#039;.$messageid.&#039;</b>.&#039;.$bot->pre.&#039;&#039;;
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
										
									$bot->api->sendMessage([
							
										&#039;chat_id&#039; => $row[0][13],
										&#039;text&#039; => $text2,
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_sell&#039;]]),
										&#039;parse_mode&#039; => "HTML",
										]);
									usleep(100000);
									
									$merge=$bot->cmd_admin_sendchannelapprovedusers_records('.$input.');
									usleep(100000);
									
									if (array_filter($merge) !== [])
									{
										$text=&#039;Выбранное объявление <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно размещено в канале с <b>ID товара № &#039;.$messageid.&#039;</b>.&#039;.PHP_EOL.&#039;Вы находитесь в подменю Разместить в канале, пользователя <b>'.$butuser.'</b>. Пожалуйста, выбирите еще одно объявление, чтобы разместить ее в канале.&#039;.$bot->pre.&#039;&#039;;
										
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_sendchannelapprovedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
										
										if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
										{
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											$bot->api->answerCallbackQuery($callback_query_id);
										}
										
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
										
										$merge=$bot->cmd_admin_sendchannelapprovedusers();
										usleep(100000);
										
										if (array_filter($merge) !== [])
										{
											$text=&#039;Выбранное объявление №'.$table[$u].' пользователя <b>'.$butuser.'</b> успешно размещено в канале с <b>ID товара № &#039;.$messageid.&#039;</b>.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подменю Разместить в канале меню Утвержденные пользователи. Пожалуйста, выбирите пользователя, чтобы разместить его объявления в канале.&#039;.$bot->pre.&#039;&#039;;
											
											$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
											
											if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
											{
												$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
												$bot->api->answerCallbackQuery($callback_query_id);
											}
											
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
											$text=&#039;Выбранное объявление <b>№'.$table[$u].'</b> пользователя <b>'.$butuser.'</b> успешно размещено в канале с <b>ID товара № &#039;.$messageid.&#039;</b>.&#039;.PHP_EOL.&#039;В данный момент у пользователя <b>'.$butuser.'</b> нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039;В данный момент у пользователей нет объявлений для размещения в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню <b>Утвержденные пользователи</b>.&#039;.$bot->pre.&#039;&#039;;
									
											if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
											{
												$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
												$bot->api->answerCallbackQuery($callback_query_id);
											}
											$bot->api->editMessageText([
											&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
											&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
											&#039;text&#039; => $text,
											&#039;parse_mode&#039; => "HTML",
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
											]);
										}
										
									}
								
								}
								
								
								/* else
								{
									$text=&#039;В данный момент у Вас нет ни одного объявления для размещения в канал!&#039;.PHP_EOL.&#039; Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
										{
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											$bot->api->answerCallbackQuery($callback_query_id);
										}
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
									]);
								} */
							

						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
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


/////
public function callback_admin_back_sendchannelapprovedusers()
	{		
	
		
		$merge=$this->cmd_admin_sendchannelapprovedusers();
		usleep(100000);
		
		if (array_filter($merge) !== [])
		{
			
			$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
			$text='Вы находитесь в подразделе <b>Отметить продажу</b> объявлений пользователей. Выберите необходимого пользователя, чтобы <b>Отметить о продаже</b> его объявления.'.$this->pre.'';
			
			$this->callbackAnswer( $text, $merge);
		}
		else
		{
			$text='В данный момент у пользователей нет объявлений для размещения в канале.'.PHP_EOL.' Вы находитесь в меню утвержденных пользователей.'.$this->pre.'';
			
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
			
			
		}
		
	}



////////////////////////////////////////////////////////////////Отметить продажу//////////////////////////////////////////////////////////
/////	
	public function callback_admin_send_sold_channel()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';

			$merge=$this->cmd_admin_send_sold_channel();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_approvedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Отметить продажу</b> товаров пользователей в канале. Выберите необходимого пользователя, чтобы <b>отметить продажу</b> товаров пользователей в канале.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у пользователей <b>нет товаров,</b> размещенных в канале.'.PHP_EOL.' Вы находитесь в меню утвержденных пользователей.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
				
				
			}
		
	}


/////
	public function cmd_admin_send_sold_channel()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		
		$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$table[$u].' LIMIT 1'))
				{
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$table[$u].' WHERE messid!="0" LIMIT 1'))!=0)
				{
					
					$chatidbuyer=str_replace('tabservicebuy', '', $table[$u]);
					$buttext='👤'.$this->cmd_user_get_fiophone($chatidbuyer).'';
					$put[]=["text" => "$buttext", "callback_data" => "admin_send_sold_channel_$table[$u]"];
					
					if(preg_match('/callback_admin_send_sold_channel_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_send_sold_channel_'.$table[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							$tab=&#039;tabserviceapproved&#039;;
							//$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$table[$u].' WHERE messid!="0" LIMIT 1&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
				
							$text=&#039;Для того, чтобы отметить продажу товара пользователю <b>'.$buttext.'</b>, Вам нужно нажать на соответствующую кнопку с <b>ID товара</b>.&#039;.$bot->pre.&#039;&#039;;
				
							$merge=$bot->cmd_admin_send_sold_channel_records('.$table[$u].');
							
							usleep(100000);
							if (array_filter($merge) !== [])
							{
								$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
								$bot->api->answerCallbackQuery($callback_query_id);
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
								$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039; Вы находитесь в подменю Отметить продажу меню утвержденных пользователей. Пожалуйста, выбирите пользователя, чтобы отметить продажу его товара.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_send_sold_channel();
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									]);
								}
								else
								{
									$text=&#039;В данный момент у пользователя <b>'.$buttext.'</b> нет товаров, размещенных в канале. В данный момент у пользователей нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
									]);
								}
							}
							
							
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
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




/////
	public function cmd_admin_send_sold_channel_records($input)
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
			
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT messid FROM '.$input.' WHERE messid!="0"');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' LIMIT 1'))
				if(isset($table[$u]))
				{
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT messid FROM '.$input.' WHERE messid!="0"'))!=0)
				{
					$buttext="№$table[$u]";
					$chatidbuyer=str_replace('tabservicebuy', '', $input);
					$butuser='👤'.$this->cmd_user_get_fiophone($chatidbuyer).'';
					
					$put[]=["text" => "$buttext", "callback_data" => 'adm_se_so_chan_user'.$chatidbuyer.'_rec'.$table[$u].''];
					
					if(preg_match('/callback_adm_se_so_chan_user'.$chatidbuyer.'_rec'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_adm_se_so_chan_user'.$chatidbuyer.'_rec'.$table[$u].'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							
							
							$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT messid FROM '.$input.' WHERE messid!="0"&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
				
							if($con1!=0)
							{
								
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM '.$input.' WHERE messid="'.$table[$u].'"&#039;);
								usleep(100000);
								$con=mysqli_num_rows($query);
									
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
								
								$photo=$row[0][8];
								$messageid=$row[0][11];
								$timeold=$row[0][10];
								$timediff=time()-$timeold;
								
								if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
								{
									if($timediff>172000)
									{
										$text=&#039;<b><i>Товар продан</i></b>&#039;.PHP_EOL.&#039;⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️&#039;;
										$photosold=&#039;https://domain.com/photosold.png&#039;;
										
										$bot->api->editMessageMedia([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid,
										&#039;media&#039; => json_encode( [&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; => $photosold]),
										]);
									
										$bot->api->editMessageCaption([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid,
										&#039;caption&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										]);
										
										$photo=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photo);
										unlink($photo);
										usleep(100000);
									}
									else
									{
										$bot->api->deleteMessage([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid
										]);
										
										$photo=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photo);
										unlink($photo);
										usleep(100000);
									}
								}
								else
								{
									
									$tabservicerecords=&#039;tabservicerecords&#039;;
									$text=&#039;<b><i>Товар продан</i></b>&#039;.PHP_EOL.&#039;⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️&#039;;
									$photosold=&#039;https://domain.com/photosold.png&#039;;
									
									if($timediff>172000)
									{
		
										$bot->api->editMessageCaption([
										&#039;chat_id&#039; => $bot->mainchannel,
										&#039;message_id&#039; => $messageid,
										&#039;caption&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										]);
										
										
										$query2=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabservicerecords.&#039; WHERE record="&#039;.$messageid.&#039;"&#039;);
										$con2=mysqli_num_rows($query2);
					
										for($i2=0;$i2<$con2;$i2++)
										{
											mysqli_data_seek($query2, $i2);
											$row2[$i2]=mysqli_fetch_row($query2);
										}
										
										$messageids=explode(&#039;;&#039;, $row2[0][2]);
										$count1=count($messageids);
										
										for($e=0;$e<$count1;$e++)
										{
											if($e==0)
											{
												$bot->api->editMessageMedia([
												&#039;chat_id&#039; => $bot->mainchannel,
												&#039;message_id&#039; => $messageids[$e],
												&#039;media&#039; => json_encode( [&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; => $photosold, &#039;caption&#039; => $text, &#039;parse_mode&#039; => "HTML" ]),
												]);

											}
											else
											{
												$bot->api->editMessageMedia([
												&#039;chat_id&#039; => $bot->mainchannel,
												&#039;message_id&#039; => $messageids[$e],
												&#039;media&#039; => json_encode( [&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; => $photosold]),
												]);
											}

										}
										
										$photos=explode(&#039;;&#039;, $photo);
										$cnt=count($photos);
										
										for($y=0;$y<$cnt;$y++)
										{
											$photos[$y]=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photos[$y]);
											unlink($photos[$y]);
											usleep(100000);
										}
									}
									else
									{
										
										$query2=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabservicerecords.&#039; WHERE record="&#039;.$messageid.&#039;"&#039;);
										$con2=mysqli_num_rows($query2);
					
										for($i2=0;$i2<$con2;$i2++)
										{
											mysqli_data_seek($query2, $i2);
											$row2[$i2]=mysqli_fetch_row($query2);
										}
										
										$messageids=explode(&#039;;&#039;, $row2[0][2]);
										$count1=count($messageids);
										
										for($e=0;$e<$count1;$e++)
										{
											$bot->api->deleteMessage([
											&#039;chat_id&#039; => $bot->mainchannel,
											&#039;message_id&#039; => $messageids[$e]
											]);
											usleep(100000);
										}
										
										$photos=explode(&#039;;&#039;, $photo);
										$cnt=count($photos);
										
										for($y=0;$y<$cnt;$y++)
										{
											$photos[$y]=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photos[$y]);
											unlink($photos[$y]);
											usleep(100000);
										}
										
									}
									
									mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabservicerecords.&#039; WHERE record="&#039;.$messageid.&#039;"&#039;);
									
								}
								
				
								$chatidseller=$row1[0][15];
								$tabsold=&#039;tabservicesold&#039;.$chatidseller.&#039;&#039;;
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tabsold.&#039; LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE &#039;.$tabsold.&#039; LIKE '.$input.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO &#039;.$tabsold.&#039; (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller FROM '.$input.' WHERE messid="'.$table[$u].'"&#039;);
								
								$query2=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabsold.&#039; WHERE messid="'.$table[$u].'"&#039;);
								$con2=mysqli_num_rows($query2);
								usleep(100000);
								
								for($i2=0;$i2<$con2;$i2++)
								{
									mysqli_data_seek($query2, $i2);
									$row2[$i2]=mysqli_fetch_row($query2);
								}
								
							
								$tabseller=&#039;tabmain&#039;.$chatidseller.&#039;&#039;;
				
								$time=time();
								$date=date("d.m.Y");
								
								$query2=&#039;UPDATE &#039;.$tabsold.&#039; SET date = REPLACE(date, "&#039;.$row2[0][9].&#039;", "&#039;.$date.&#039;") WHERE messid="'.$table[$u].'"&#039;; 
								$result2=mysqli_query($con_sql2, $query2);
								usleep(100000);
								
								$query2=&#039;UPDATE &#039;.$tabsold.&#039; SET time = REPLACE(time, "&#039;.$row2[0][10].&#039;", "&#039;.$time.&#039;") WHERE messid="'.$table[$u].'"&#039;; 
								$result2=mysqli_query($con_sql2, $query2);
								usleep(100000);
								
								$query2=mysqli_query($con_sql2, &#039;DELETE FROM '.$input.' WHERE messid="'.$table[$u].'"&#039;);
								usleep(100000);
								
								$query2=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabseller.&#039; WHERE messid="'.$table[$u].'"&#039;);
								usleep(100000);
								
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								
								$query4=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabservicebuy%"&#039;);
								$con4=mysqli_num_rows($query4);
								
								if($con4!=0)
								{
								
									for($i4=0;$i4<$con4;$i4++)
									{
										mysqli_data_seek($query4, $i4);
										$row4[$i4]=mysqli_fetch_row($query4);
										
										if(mysqli_num_rows(mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$row4[$i4][0].&#039; WHERE messid="'.$table[$u].'"&#039;))!=0)
										{
											if($row4[$i4][0]!==&#039;'.$input.'&#039;)
											{
												$query2=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$row4[$i4][0].&#039; WHERE messid="'.$table[$u].'"&#039;);
												usleep(100000);
												
												$chatidbuyers=str_replace(&#039;tabservicebuy&#039;, &#039;&#039;, $row4[$i4][0]);
												$chatidbuyers=$bot->clean($chatidbuyers);
												
												$text3=&#039;Ваша заявка на покупку товара с ID <b>№'.$table[$u].'</b> была <b>отменена администратором</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;К сожалению, данного товара нет в наличии. Извините за неудобства.&#039;.$bot->pre.&#039;&#039;;
												
												$bot->api->sendMessage([
												&#039;chat_id&#039; => $chatidbuyers,
												&#039;text&#039; => $text3,
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_buy_default&#039;]]),
												&#039;parse_mode&#039; => "HTML",
												]);
												usleep(100000);
											}	
										}
										
									}
								}
	
								$text2=&#039;Ваша заявка на покупку товара с ID <b>№'.$table[$u].'</b> была <b>согласована администратором</b>.&#039;.PHP_EOL.&#039;В ближайшее время с вами <b>свяжется Продавец.</b>&#039;.$bot->pre.&#039;&#039;;
			
								$bot->api->sendMessage([
					
								&#039;chat_id&#039; => '.$chatidbuyer.',
								&#039;text&#039; => $text2,
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_buy_default&#039;]]),
								&#039;parse_mode&#039; => "HTML",
								]);
								usleep(100000);
							
								$merge=$bot->cmd_admin_send_sold_channel_records('.$input.');
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
									
									$text=&#039;<b>Вы ПОДТВЕРДИЛИ покупку:</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Покупатель 👤<b>&#039;.$row2[0][14].&#039;</b>, Продавец 👤<b>&#039;.$row2[0][15].&#039;</b>, ID товара <b>№'.$table[$u].'</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы можете выбрать другой <b>ID товара</b>, чтобы продать его пользователю 👤<b>&#039;.$row2[0][14].&#039;</b>.&#039;.$bot->pre.&#039;&#039;;
									
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_deleterecords_users&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
								
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
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
									
									$text=&#039;Вы ПОДТВЕРДИЛИ покупку:</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Покупатель 👤<b>&#039;.$row2[0][14].&#039;</b>, Продавец 👤<b>&#039;.$row2[0][15].&#039;</b>, ID товара <b>№'.$table[$u].'</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы можете выбрать другой <b>ID товара</b>, чтобы продать его пользователю 👤<b>&#039;.$row2[0][14].&#039;</b>.&#039;.PHP_EOL.&#039;В данный момент у пользователя 👤<b>'.$row2[0][14].'</b> нет заказанных товаров.&#039;.PHP_EOL.&#039; Вы находитесь в подразделе Отметить продажу. Пожалуйста, выбирите пользователя, чтобы продать ему товар.&#039;.$bot->pre.&#039;&#039;;
									
									$merge=$bot->cmd_admin_send_sold_channel();
									
									if (array_filter($merge) !== [])
									{
									
										$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_deleterecords_users&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
								
										$bot->api->editMessageText([
										&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
										&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
										&#039;text&#039; => $text,
										&#039;parse_mode&#039; => "HTML",
										&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
										]);
										
									}
									else
									{
										
										if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
										{
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											$bot->api->answerCallbackQuery($callback_query_id);
										}
										
										$text=&#039;<b>Вы ПОДТВЕРДИЛИ покупку:</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Покупатель 👤<b>&#039;.$row2[0][14].&#039;</b>, Продавец 👤<b>&#039;.$row2[0][15].&#039;</b>, ID товара <b>№'.$table[$u].'</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы можете выбрать другой <b>ID товара</b>, чтобы продать его пользователю 👤<b>&#039;.$row2[0][14].&#039;</b>.&#039;.PHP_EOL.&#039;В данный момент у пользователя 👤<b>'.$row2[0][14].'</b> нет заказанных товаров.&#039;.PHP_EOL.&#039;В данный момент <b>нет пользователей,</b> у которых есть заказанные товары.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Утвержденные пользователи</b> главного меню администратора.&#039;.$bot->pre.&#039;&#039;;
									
										
										$bot->api->sendMessage([
											&#039;text&#039; => $text,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]]),
											&#039;disable_notification&#039; => TRUE,
											&#039;disable_web_page_preview&#039; => TRUE,
											&#039;parse_mode&#039;=> "HTML"
										]);
										usleep(100000);
									}
								}
							}
						/* 	else
							{
								
								$merge=$bot->cmd_admin_send_sold_channel();
								
								
								if (array_filter($merge) !== [])
								{
									
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_approvedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
									
									$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> пользователя 👤<b>'.$input.'</b> был успешно отмечен как проданный.&#039;.PHP_EOL.&#039;В данный момент у пользователя 👤<b>'.$input.'</b> нет товаров, размещенных в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Отметить продажу пользователей. Пожалуйста, выбирите пользователя, чтобы отметить его товары как проданные.&#039;;
									$bot->api->answerCallbackQuery($callback_query_id);
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
									]);
								}
								else
								{
									$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> пользователя 👤<b>'.$input.'</b> был успешно отмечен как проданный.&#039;.PHP_EOL.&#039;В данный момент у пользователя 👤<b>'.$table[$u].'</b> нет товаров, размещенных в канале. В данный момент у пользователей нет товаров, размещенных в канале.&#039;.PHP_EOL.&#039; Вы находитесь в меню утвержденных пользователей.&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_approvedusers&#039;]] ),
									]);
								}
							} */
						}';
							
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
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


/////	
	public function callback_admin_back_approvedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabserviceapproved';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент нет <b>утвержденных пользователей!</b>'.PHP_EOL.'Вы вернулись в <b>главное меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
		}
		else
		{
			$text='Вы вернулись в раздел <b>Утвержденные пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
		}
	
	}
	
////////////////////BANNED/////////////////
public function callback_admin_bannedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicebanned';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет забаненных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
		}
		else
		{
			$text='Вы находитесь в разделе <b>Забаненные пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_bannedusers']);
		}
		
	}
	
/////	
	public function callback_admin_showbannedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicebanned';
		
		
			$merge=$this->cmd_admin_showbannedusers();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_bannedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Показать забаненных пользователей</b>. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет забаненных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
			}
			
		
	}


/////	
	public function callback_admin_back_bannedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicebanned';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет забаненных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
		}
		else
		{
			$text='Вы вернулись в раздел <b>Забаненные пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_bannedusers']);
		}
	
	}

/////
	public function cmd_admin_showbannedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();

		$tab='tabservicebanned';
		
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
					$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE chatid="'.$table[$u].'"');
					usleep(100000);
					$con2=mysqli_num_rows($query2);
					for($i2=0;$i2<$con2;$i2++)
					{
						mysqli_data_seek($query2, $i2);
						$row2[$i2]=mysqli_fetch_row($query2);
					}
					
					$phone=$row2[0][5];
					$fio=$row2[0][6];
					
					$buttext='👤'.$fio.' ('.$phone.')';
					
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_showbanneduser_$table[$u]"];
					
					if(preg_match('/callback_admin_showbanneduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_showbanneduser_'.$table[$u].'()
						{	
				
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							$tab=&#039;tabservicebanned&#039;;
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tab.&#039; WHERE id LIKE "%" LIMIT 1&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							if($con1!=0)
							{
								
								
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tab.&#039; WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								$con=mysqli_num_rows($query);
								
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
								
								$chatid=$row[0][1];
								$firstname=$row[0][2];
								$lastname=$row[0][3];
								$username=$row[0][4];
								$phone=$row[0][5];
								$fio=$row[0][6];
								
								if($username==&#039;нет данных&#039;)
								{
									$text=&#039;Имя пользователя: <b>&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать забаненных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
								else
								{
									$text=&#039;Имя пользователя: <b>@&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;ФИО: <b>&#039;.$fio.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать забаненных пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
		
								
								
								$merge=$bot->cmd_admin_showbannedusers();
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_bannedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;В данный момент <b>нет забаненных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
								}
							}
							else
							{
								$text=&#039;В данный момент <b>нет забаненных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->answerCallbackQuery($callback_query_id);
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
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



/////	
	public function callback_admin_unbanbannedusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicebanned';
		
		
		
			$merge=$this->cmd_admin_unbanbannedusers();
			usleep(100000);
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_bannedusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Разбанить забаненных пользователей</b>. Выберите необходимого пользователя, чтобы разбанить его.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет забаненных пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
			}
			
		
	}


/////
	public function cmd_admin_unbanbannedusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicebanned';
		$tab1='tabserviceusers';
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
					$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE chatid="'.$table[$u].'"');
					usleep(100000);
					$con2=mysqli_num_rows($query2);
					for($i2=0;$i2<$con2;$i2++)
					{
						mysqli_data_seek($query2, $i2);
						$row2[$i2]=mysqli_fetch_row($query2);
					}
					
					$phone=$row2[0][5];
					$fio=$row2[0][6];
					
					$buttext='👤'.$fio.' ('.$phone.')';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_unbanbanneduser_$table[$u]"];
					
					if(preg_match('/callback_admin_unbanbanneduser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_unbanbanneduser_'.$table[$u].'()
						{	
				
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							if($con1!=0)
							{
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tab1.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(250000);
								
								$queue=&#039;DELETE FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;;
								$result=mysqli_query($con_sql2, $queue);
								usleep(100000);
								
								file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersall.txt&#039;, &#039;'.$table[$u].'&#039; . PHP_EOL,FILE_APPEND);
								
								$text=&#039;Поздравляю, Вы были <b>разбанены</b> админом!&#039;.$bot->pre.&#039;&#039;;

								$bot->api->sendMessage([
									&#039;chat_id&#039; => '.$table[$u].',
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_default&#039;]]),
									//&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
								]);
								usleep(100000);
								
								$text=&#039;Вы <b>успешно разбанили пользователя '.$buttext.'</b>.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Разбанить забаненных пользователей</b>. Пожалуйста, выбирите пользователя, чтобы разбанить его.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_unbanbannedusers();
								usleep(100000);
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_bannedusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;Вы <b>успешно разбанили пользователя '.$buttext.'</b>.&#039;.PHP_EOL.&#039;В данный момент <b>нет забаненных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
								}
							}
							else
							{
								$text=&#039;В данный момент <b>нет забаненных пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->answerCallbackQuery($callback_query_id);
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
								]);
								usleep(100000);
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
	
	
	
//////////////////////WANT//////////////////////
	public function callback_admin_wantusers()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет запросивших пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
		}
		else
		{
			$text='Вы находитесь в разделе <b>Запросившие пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_wantusers']);
		}
	}
	
/////	
	public function callback_admin_back_wantusers()
	{	
	
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
		{
			$text='В данный момент <b>нет запросивших пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
		}
		else
		{
			$text='Вы вернулись в раздел <b>Запросившие пользователи</b>. Выберите необходимый подраздел, нажав на кнопки ниже.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_wantusers']);
		}
	
	}

/////	
	public function callback_admin_showwantusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		
		
			$merge=$this->cmd_admin_showwantusers();
			usleep(100000);
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_wantusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Показать запросивших пользователей</b>. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет запросивших пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_users']);
			}
			
		
	}


/////
	public function cmd_admin_showwantusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		

		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
					
					$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_showwantuser_$table[$u]"];
					
					if(preg_match('/callback_admin_showwantuser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_showwantuser_'.$table[$u].'()
						{	
				
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							if($con1!=0)
							{
								$query=mysqli_query($con_sql2, &#039;SELECT * FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(100000);
								$con=mysqli_num_rows($query);
								
								for($i=0;$i<$con;$i++)
								{
									mysqli_data_seek($query, $i);
									$row[$i]=mysqli_fetch_row($query);
								}
								
								$chatid=$row[0][1];
								$firstname=$row[0][2];
								$lastname=$row[0][3];
								$username=$row[0][4];
								$phone=$row[0][5];
								
								if($username==&#039;нет данных&#039;)
								{
									$text=&#039;Имя пользователя: <b>&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать запросивших пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
								else
								{
									$text=&#039;Имя пользователя: <b>@&#039;.$username.&#039;</b>&#039;.PHP_EOL.&#039;Имя: <b>&#039;.$firstname.&#039;</b>&#039;.PHP_EOL.&#039;Фамилия: <b>&#039;.$lastname.&#039;</b>&#039;.PHP_EOL.&#039;Чат: <b>&#039;.$chatid.&#039;</b>&#039;.PHP_EOL.&#039;Телефон: <b>&#039;.$phone.&#039;</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Показать запросивших пользователей. Выберите необходимого пользователя, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
								}
								

								$merge=$bot->cmd_admin_showwantusers();
								usleep(100000);
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_wantusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;В данный момент <b>нет запросивших пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									
									$bot->api->answerCallbackQuery($callback_query_id);
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
								}
							}
							else
							{
								$text=&#039;В данный момент <b>нет запросивших пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->answerCallbackQuery($callback_query_id);
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
								]);
								usleep(100000);
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
	
/////	
	public function callback_admin_approvewantusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		$tab1='tabserviceapproved';
		
		
			$merge=$this->cmd_admin_approvewantusers();
			usleep(100000);
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_wantusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Утвердить запросивших пользователей</b>. Выберите необходимого пользователя, чтобы утвердить его.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет запросивших пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>Главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
			}
			
		
	}


/////
	public function cmd_admin_approvewantusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		$tab1='tabserviceapproved';
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		usleep(100000);
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
					
					$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_approvewantuser_$table[$u]"];
					
					if(preg_match('/callback_admin_approvewantuser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_approvewantuser_'.$table[$u].'()
						{	
				
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							if($con1!=0)
							{
								
								$con_sql2=$bot->cmd_sql();
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tab1.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(250000);
								
								$queue=&#039;DELETE FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;;
								$result=mysqli_query($con_sql2, $queue);
								usleep(100000);
								
								file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;, &#039;'.$table[$u].'&#039; . PHP_EOL,FILE_APPEND);
								
								$text=&#039;Теперь Вы <b>имеете право размещать объявления в канале!</b>&#039;.$bot->pre.&#039;&#039;;
		
								$bot->api->sendMessage([
									&#039;chat_id&#039; => '.$table[$u].',
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_default&#039;]]),
									//&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
								]);
								usleep(100000);
								
								$text=&#039;Вы <b>успешно дали право</b> на размещение объявлений в канале пользователю 👤<b>'.$buttext.'</b>&#039;.PHP_EOL.&#039;Вы находитесь в подразделе <b>Утвердить запросивших пользователей</b>.&#039;.PHP_EOL.&#039;Выберите необходимого пользователя, чтобы утвердить его.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_approvewantusers();
								usleep(100000);
								
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_wantusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;Вы <b>успешно утвердили пользователя '.$buttext.'</b>.&#039;.PHP_EOL.&#039;В данный момент <b>нет запросивших пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									$bot->api->answerCallbackQuery($callback_query_id);
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
								}
							}
							else
							{
								$text=&#039;В данный момент <b>нет запросивших пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
								$bot->api->answerCallbackQuery($callback_query_id);
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
								]);
								usleep(100000);
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
	


/////	
	public function callback_admin_denywantusers()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		$tab1='tabservicebanned';
		
		
			$merge=$this->cmd_admin_denywantusers();
			usleep(100000);
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_wantusers'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_main']];
				$text='Вы находитесь в подразделе <b>Отказать запросившим пользователям</b>. Выберите необходимого пользователя, чтобы отказать и забанить его.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент <b>нет запросивших пользователей!</b>'.PHP_EOL.'Вы находитесь в <b>главном меню администратора</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
			}
		
	}


/////
	public function cmd_admin_denywantusers()
	{
		$adminid=$this->chatidadmin;		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabservicewant';
		$tab1='tabservicedenied';

		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT chatid FROM '.$tab.'');
		$con1=mysqli_num_rows($query1);
		
		$table=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$table[]=$row1[$i][0];	
		}
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
					
					$buttext='👤'.$this->cmd_user_get_fiophone($table[$u]).'';
					
					$put[]=["text" => "$buttext", "callback_data" => "admin_denywantuser_$table[$u]"];
					
					if(preg_match('/callback_admin_denywantuser_'.$table[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_admin_denywantuser_'.$table[$u].'()
						{	
				
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							
							$con_sql2=$bot->cmd_sql();
							
							$query1=mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							if($con1!=0)
							{
								
								$con_sql2=$bot->cmd_sql();
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tab1.' (chatid, firstname, lastname, username, phone, fio) SELECT chatid, firstname, lastname, username, phone, fio FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;);
								usleep(250000);
								
								$queue=&#039;DELETE FROM '.$tab.' WHERE chatid="'.$table[$u].'"&#039;;
								$result=mysqli_query($con_sql2, $queue);
								usleep(100000);
								
								$get=file_get_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;);
								$get=str_replace("'.$table[$u].'", "", $get);
								$get=$bot->clean($get);
								file_put_contents(&#039;&#039;.dirname(__FILE__).&#039;/usersapproved.txt&#039;, $get . PHP_EOL);
								

								$text=&#039;К сожалению, Вам <b>не дали право</b> размещать объявления в канале!&#039;.$bot->pre.&#039;&#039;;
																
								$bot->api->sendMessage([
									&#039;chat_id&#039; => '.$table[$u].',
									&#039;text&#039; => $text,
									//&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
								]);
								usleep(100000);
								
								$text=&#039;Вы <b>отказали</b> пользователю <b>'.$buttext.'</b> в праве на размещение объявлений в канале.&#039;.PHP_EOL.&#039;Вы находитесь в подразделе Забанить запросивших пользователей.&#039;.PHP_EOL.&#039;Выберите необходимого пользователя, чтобы отказать и забанить его.&#039;.$bot->pre.&#039;&#039;;
								
								$merge=$bot->cmd_admin_denywantusers();
								usleep(100000);
								if (array_filter($merge) !== [])
								{
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_wantusers&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_main&#039;]];
								
									$bot->api->answerCallbackQuery($callback_query_id);
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
									$text=&#039;Вы <b>отказали</b> пользователю <b>'.$buttext.'</b> в праве на размещение объявлений в канале.&#039;.PHP_EOL.&#039;В данный момент <b>нет запросивших пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
									$bot->api->answerCallbackQuery($callback_query_id);
								
									$bot->api->editMessageText([
									&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
									&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
									&#039;text&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
									]);
									usleep(100000);
								}
							}
							else
							{
								$text=&#039;В данный момент <b>нет запросивших пользователей!</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в <b>главном меню администратора</b>.&#039;.$bot->pre.&#039;&#039;;
								$bot->api->answerCallbackQuery($callback_query_id);
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_main&#039;]] ),
								]);
								usleep(100000);
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
	



//////////////////////////////////////////////////////////////BUY////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function callback_default_buy()
	{	
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
		
		$tab='tabcat'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);	
		//}
		
		$tab='tabgender'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
	
		$tab='tabprice'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
		
		$tab='tabservice'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(100000);
		//}
		

		$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con1=mysqli_num_rows($query1);
		
		if($con1!=0)
		{	
		
			$table=[];
			$check=0;
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$tab=$row1[$i][0];
				
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by id ASC');
				usleep(100000);
				$con=mysqli_num_rows($query);
					
				if($con!=0)
				{	
					$check=1;
					break;
				}
			}
			
			if($check==1)
			{
			
				$text='Вы находитесь в меню <b>Купить</b>.'.PHP_EOL.'Для просмотра товаров нажмите кнопку <b>Выбрать</b>.'.PHP_EOL.'Для покупки товара по номеру ID нажмите кнопку <b>Купить по ID товара.</b>'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			else
			{

				if($this->cmd_isadmin())
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в <b>Главном меню.</b>'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
					usleep(100000);
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в <b>Главном меню.</b>'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_default']);
					usleep(100000);
				}
					
			}
			
		}
		else
		{
			if($this->cmd_isadmin())
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в <b>Главном меню.</b>'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
				usleep(100000);
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в <b>Главном меню.</b>'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_default']);
				usleep(100000);
			}
		}
		
		
		
		
		
		
		
	}	


/////
	public function callback_ready_buy()
	{
		$con_sql2=$this->cmd_sql();
		$tabservice='tabservice'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1')==FALSE)
		{
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			if($con1!=0)
			{	
			
				$table=[];
				$check=0;
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					$tab=$row1[$i1][0];
					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by messid ASC');
					usleep(100000);
					$con=mysqli_num_rows($query);
						
					if($con!=0)
					{	

						$check=1;
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
		
						for($i=0;$i<$con;$i++)
						{
						
						
							$type=$this->convert_rus($row[$i][1]);
							$cat=$this->convert_rus($row[$i][2]);
							$gender=$this->convert_rus($row[$i][3]);
							$cond=$this->convert_rus($row[$i][12]);
						
						
						
							/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
							
							$this->api->sendMessage([
							'text' => $text,
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							usleep(100000); */
							
							
							$messageid=$row[$i][11];
							
							$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[$i][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[$i][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[$i][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[$i][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
							
							$photo=$row[$i][8];
							
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
								unset($getinclude[array_key_last($getinclude)]);
								file_put_contents($include, $getinclude);
							}
							
		
							$merge=[];
							$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_'.$messageid.'']]  ;
							
							if(preg_match('/callback_buy_ready_'.$messageid.'/', file_get_contents($include))==FALSE)
							{
								$insert='
								public function callback_buy_ready_'.$messageid.'()
								{	
						
									$bot = new TestBot;
									$bot->api->getWebhookUpdate();

									$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
							
									$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
									
								}';
								file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
								
							}
							
							$insert='}';
							file_put_contents($include, $insert,FILE_APPEND);
							
							if(preg_match('/;/', $photo)==FALSE)
							{
								$this->api->sendPhoto([
								'photo' => $photo,
								'caption' => $caption,
								//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin']]),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'parse_mode' => "HTML"
								]);
								usleep(250000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
								
							
							}
							else
							{
								$media=[];
								$temp=explode(';', $photo);
								$cnt=count($temp);
								for($o=0;$o<$cnt;$o++)
								{
								
								
									if($o==0)
									{
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => ['inline_keyboard'=>$merge]];
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => 'inline_keyboard'=>$this->keyboards['inline_ask_admin']];
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML"];
									}
									else
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].''];
									}
							
									$media[$o]=$put;
								}
								
								
								$this->api->sendMediaGroup([
								'media' => json_encode($media),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge])
								]);
								usleep(350000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
							}
						}
			
					}
				}
				
				if($check==1)
				{
				
					

					$text='Сверху <b>показаны все товары</b>, согласно Вашего запроса.'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить товар</b>.'.$this->pre.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);
					
					/* $tab='tabtype'.$this->api->chatId.'';
		
					// if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					// {
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					// }
					
					$tab='tabcat'.$this->api->chatId.'';
					
					// if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					// {
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					// }
					
					$tab='tabgender'.$this->api->chatId.'';
					
					// if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					// {
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					// }
				
					$tab='tabcond'.$this->api->chatId.'';
					
					// if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					// {
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					// }
				
					$tab='tabprice'.$this->api->chatId.'';
					
					// if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					// {
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					// }
					
					
					$tab='tabservice'.$this->api->chatId.'';
					
					// if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					// {
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					// } */
					
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню Купить товар.'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
				}
				
				
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню Купить товар.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
			}
			
		}
		else
		{
			$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservice.' WHERE messid!="0" ORDER by messid ASC');
			usleep(100000);
			$con1=mysqli_num_rows($query1);
				
			if($con1!=0)
			{					
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				usleep(100000);
				
			
				for($i1=0;$i1<$con1;$i1++)
				{
				
				
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
				
				
					/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
					
					$this->api->sendMessage([
					'text' => $text,
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000); */
					
					
					$messageid=$row1[$i1][11];
					
					$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
					
					$photo=$row1[$i1][8];
					
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
						unset($getinclude[array_key_last($getinclude)]);
						file_put_contents($include, $getinclude);
					}
					
					
					$merge=[];
					$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_'.$messageid.'']]  ;
					
					if(preg_match('/callback_buy_ready_'.$messageid.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_ready_'.$messageid.'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
					
							$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
							$merge=[];
							$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
							$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							$bot->api->sendMessage([
							&#039;text&#039; => $text,
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
							&#039;disable_notification&#039; => TRUE,
							&#039;disable_web_page_preview&#039; => TRUE,
							&#039;parse_mode&#039;=> "HTML"
							]);
							usleep(100000);
							
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						$insert='}';
						file_put_contents($include, $insert,FILE_APPEND);
					}
					
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);
					
					
						
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
						
											
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					}
				}
				
				/* if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				} */
											
				$text='<b>Сверху показаны все товары, согласно Вашего запроса.</b>'.PHP_EOL.''.PHP_EOL.'Вы находитесь в разделе <b>Купить.</b>'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				/* $tab='tabtype'.$this->api->chatId.'';
		
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);	
					//}
					
					$tab='tabcat'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabgender'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabcond'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabprice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					
					$tab='tabservice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//} */
			
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню Купить товар.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			
		}
		
	}
	


/////
	public function callback_byrecordid_default_buy()
	{
		
		$con_sql2=$this->cmd_sql();
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		

		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$b=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$b=1;
					
					$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
					
					if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' LIMIT 1')==FALSE)
					{
						mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceuser.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceuser.' (info) VALUES ("byrecordid")');
						usleep(100000);
					}
					else
					{
						if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))==0)
						{
							mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceuser.' (info) VALUES ("byrecordid")');
							usleep(100000);
						}
						else
						{
							mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
							usleep(100000);
							mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceuser.' (info) VALUES ("byrecordid")');
							usleep(100000);
						}
					}
				/* 	$text='Введите <b>ID товара</b>.';
		
					$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
					]);
					usleep(100000); */
					

					$text='Введите <b>ID товара</b>, чтобы заказать его.'.$this->pre.'';
					$merge=[];
					$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_byrecordid_default_buy'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_byrecordid_default_buy']];
					
					
					$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
					usleep(100000);
					
					break;
				}
				
				
			}
			
			if($b==0)
			{
				$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
			}
			
			
		}
		else
		{
			$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}

	}

/////
	public function callback_back_byrecordid_default_buy()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		}
		
		$text='Вы вернулись в раздел  <b>Купить товар</b>'.$this->pre.'';

		$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
	}
	
/////
	public function callback_exit_byrecordid_default_buy()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		}
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
						
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
	}


/////
	public function cmd_byrecordid_default_buy()
	{
		$con_sql2=$this->cmd_sql();
		
		$record=$this->api->textmessage;
		$tabbuy='tabservicebuy'.$this->api->chatId.'';
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$a=0;
			$b=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$b=1;
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid="'.$record.'"'))!=0)
					{
						$a=1;
						
						$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid="'.$record.'"');
						usleep(100000);
						$con1=mysqli_num_rows($query1);
							
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
						}
						
							$type=$this->convert_rus($row1[0][1]);
							$cat=$this->convert_rus($row1[0][2]);
							$gender=$this->convert_rus($row1[0][3]);
							$cond=$this->convert_rus($row1[0][12]);
						
							$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[0][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[0][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[0][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[0][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$row1[0][11].'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';

							$photo=$row1[0][8];
							
							if(preg_match('/;/', $photo)==FALSE)
							{
								$this->api->sendPhoto([
								'photo' => $photo,
								'caption' => $caption,
								'disable_notification' => TRUE,
								'parse_mode' => "HTML"
								]);
								usleep(250000);
							
							}
							else
							{
								$media=[];
								$temp=explode(';', $photo);
								$cnt=count($temp);
								for($o=0;$o<$cnt;$o++)
								{
								
								
									if($o==0)
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
									}
									else
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
									}
							
									$media[$o]=$put;
								}
								
								
								$this->api->sendMediaGroup([
								'media' => json_encode($media),
								]);
								usleep(350000);
							}

							$text='Сверху показан товар с <b>ID №'.$record.'.</b> '.PHP_EOL.''.PHP_EOL.'<b>Вы точно хотите купить его?</b>'.$this->pre.'';
							$merge=[];
							$merge[] = [['text' => '🟢Да', 'callback_data' => 'byrecordid_default_buy_yes'], ['text' => '🔴Нет', 'callback_data' => 'byrecordid_default_buy_no']];
							$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_byrecordid_default_buy'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_byrecordid_default_buy']];
							
							
							$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							usleep(100000);
						

						break;
						
					}
				}
			}
			
			if($b==0)
			{
				$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
			}
			elseif($a==0)
			{
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_byrecordid_default_buy'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_byrecordid_default_buy']];
				
				/* $text='Пожалуйста, введите другой ID товара.';
				$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						usleep(100000); */
						
				$text='Товара с ID <b>'.$record.' не существует</b>.'.PHP_EOL.'Пожалуйста, введите другой ID товара.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
		}
		else
		{
			$text='В данный момент у пользователей <b>нет ни одного объявления</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}
		

/////
	public function callback_byrecordid_default_buy_yes()
	{
		$con_sql2=$this->cmd_sql();
				
		$text1=$this->api->textmessage;
		
		preg_match_all('/ID №.*\./', $text1, $out);
		$record=$out[0][0];
		$record=preg_replace('/ID №/', '', $record);
		$record=preg_replace('/\./', '', $record);
		
		$record=$this->clean($record);
		
		$tabbuy='tabservicebuy'.$this->api->chatId.'';
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		
				
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$a=0;
			$b=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$b=1;
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid="'.$record.'"'))!=0)
					{
						$a=1;
						
						$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid="'.$record.'"');
						usleep(100000);
						$con1=mysqli_num_rows($query1);
							
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
						}
						
							

						if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabbuy.' LIMIT 1')==FALSE)
						{
							$query1='CREATE TABLE '.$tabbuy.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(20), cat VARCHAR(20), gender VARCHAR(20), brand VARCHAR(30), size VARCHAR(30), price NUMERIC(7,0), alt VARCHAR(512), pic VARCHAR(512), date VARCHAR(20), time VARCHAR(20), messid VARCHAR(20), cond VARCHAR(20), chatid VARCHAR(20), buyer VARCHAR(100) DEFAULT "0", seller VARCHAR(100) DEFAULT "0") ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';
							$result1=mysqli_query($con_sql2, $query1);
							usleep(250000);
						}
						
						mysqli_query($con_sql2, 'INSERT INTO '.$tabbuy.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$row[$i][0].' WHERE messid="'.$record.'"');
						usleep(250000);
						
						$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbuy.' WHERE messid="'.$record.'" ORDER BY id ASC');
						usleep(100000);
						$con2=mysqli_num_rows($query2);
						
						for($i2=0;$i2<$con2;$i2++)
						{
							mysqli_data_seek($query2, $i2);
							$row2[$i2]=mysqli_fetch_row($query2);
						}
						

						$fiobuyer=$this->cmd_user_get_fio($this->api->chatId);
						$phonebuyer=$this->cmd_user_get_phone($this->api->chatId);
						
						$chatidseller=str_replace('tabmain', '', $row[$i][0]);
						$fioseller=$this->cmd_user_get_fio($chatidseller);
						$phoneseller=$this->cmd_user_get_phone($chatidseller);

						mysqli_query($con_sql2, 'UPDATE '.$tabbuy.' SET buyer = REPLACE(buyer, "'.$row2[0][14].'", "'.$fiobuyer.' ('.$phonebuyer.')") WHERE messid="'.$record.'"');
						usleep(250000);
						
						mysqli_query($con_sql2, 'UPDATE '.$tabbuy.' SET seller = REPLACE(seller, "'.$row2[0][15].'", "'.$fioseller.' ('.$phoneseller.')") WHERE messid="'.$record.'"');
						usleep(250000);

						$time=time();
						$date=date('d.m.Y');
						
						mysqli_query($con_sql2, 'UPDATE '.$tabbuy.' SET date = REPLACE(date, "'.$row2[0][9].'", "'.$date.'") WHERE messid="'.$record.'"');
						usleep(250000);
						mysqli_query($con_sql2, 'UPDATE '.$tabbuy.' SET time = REPLACE(time, "'.$row2[0][10].'", "'.$time.'") WHERE messid="'.$record.'"');
						usleep(250000);
						
						if(isset($this->api->body['callback_query']["id"]))
						{
							$callback_query_id=$this->api->body['callback_query']["id"];
							$this->api->answerCallbackQuery($callback_query_id);
						}
						
						$text='Пользователь 👤<b>'.$fiobuyer.' ('.$phonebuyer.')</b> хочет купить товар с <b>ID №'.$record.'</b> у пользователя 👤<b>'.$fioseller.' ('.$phoneseller.')</b>. Что вы хотите сделать с данным товаром?'.$this->pre.'';
						
						$this->api->sendMessage([
						'chat_id' => $this->chatidadmin,
						'text' => $text,
						'parse_mode' => "HTML",
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin_buy']]),
						]);
						
						$text='Вы успешно отправили запрос на покупку товара с <b>ID №'.$record.'!</b> Вам придет уведомление о результате.'.$this->pre.'';
						$this->api->sendMessage([
						'text' => $text,
						'parse_mode' => "HTML",
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
						]);
							
						
						break;
						
					}
				}
			}
			
			if($b==0)
			{
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
				$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
			}
			elseif($a==0)
			{
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_byrecordid_default_buy'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_byrecordid_default_buy']];
				
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
				/* $text='Пожалуйста, введите другой ID товара.';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000); */
						
				$text='Товара с ID <b>'.$record.' не существует</b>.'.PHP_EOL.'Пожалуйста, введите другой ID товара, чтобы купить его.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
		}
		else
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
		
			$text='В данный момент у пользователей <b>нет ни одного объявления</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}

/////
	public function callback_byrecordid_default_buy_no()
	{
		
		$text1=$this->api->textmessage;
		
		preg_match_all('/ID №.*\./', $text1, $out);
		$record=$out[0][0];
		$record=preg_replace('/ID №/', '', $record);
		$record=preg_replace('/\./', '', $record);
		
		$record=$this->clean($record);
		
		$text='Вы отменили покупку товара с <b>ID №'.$record.'</b>.'.PHP_EOL.'Вы находитесь в разделе <b>Купить товар</b>.'.$this->pre.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
	}
	

/////
	public function callback_admin_ask_buy_see()
	{
		$con_sql2=$this->cmd_sql();
		
		$text1=$this->api->textmessage;
		
		$phonebuyer=preg_replace('/\).*/', '', $text1);
		$phonebuyer=preg_replace('/.*\(/', '', $phonebuyer);
		$phonebuyer=$this->clean($phonebuyer);
		$chatidbuyer=$this->cmd_user_get_chatid_phone($phonebuyer);
		$fiobuyer=$this->cmd_user_get_fio($chatidbuyer);
			
		$phoneseller=preg_replace('/.*\(/', '', $text1);
		$phoneseller=preg_replace('/\).*/', '', $phoneseller);
		$phoneseller=$this->clean($phoneseller);
		$chatidseller=$this->cmd_user_get_chatid_phone($phoneseller);
		$fioseller=$this->cmd_user_get_fio($chatidseller);
		
		
		
		preg_match_all('/ID №\d{1,}/', $text1, $out1);
		
		$record=preg_replace('/ID №/', '', $out1[0][0]);
		$record=$this->clean($record);

		$tabbuy='tabservicebuy'.$chatidbuyer.'';

		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbuy.' WHERE messid="'.$record.'"');
		usleep(100000);
		$con=mysqli_num_rows($query);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		usleep(100000);
		

			$type=$this->convert_rus($row[0][1]);
			$cat=$this->convert_rus($row[0][2]);
			$gender=$this->convert_rus($row[0][3]);
			$cond=$this->convert_rus($row[0][12]);
		
		
			$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[0][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[0][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[0][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[0][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$row[0][11].'</b>'.PHP_EOL.'Продавец:<b> '.$row[0][15].'</b>'.PHP_EOL.'Покупатель:<b> '.$row[0][14].'</b>';
			
			
			$photo=$row[0][8];
			
			if(preg_match('/;/', $photo)==FALSE)
			{
				$this->api->sendPhoto([
				'photo' => $photo,
				'caption' => $caption,
				'disable_notification' => TRUE,
				'parse_mode' => "HTML"
				]);
				usleep(250000);
			
			}
			else
			{
				$media=[];
				$temp=explode(';', $photo);
				$cnt=count($temp);
				for($o=0;$o<$cnt;$o++)
				{
				
				
					if($o==0)
					{
						$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
					}
					else
					{
						$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
					}
			
					$media[$o]=$put;
				}
				
				
				$this->api->sendMediaGroup([
				'media' => json_encode($media),
				]);
				usleep(350000);
			}

		$text='Пользователь 👤<b>'.$fiobuyer.' ('.$phonebuyer.')</b> хочет купить товар с <b>ID №'.$record.'</b> у пользователя 👤<b>'.$fioseller.' ('.$phoneseller.')</b>. Что вы хотите сделать с данным товаром?'.$this->pre.'';
		
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin_buy']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000);
	}
	

/////
	public function callback_admin_ask_buy_approve()
	{
		$con_sql2=$this->cmd_sql();
		
		$text1=$this->api->textmessage;
		
		$phonebuyer=preg_replace('/\).*/', '', $text1);
		$phonebuyer=preg_replace('/.*\(/', '', $phonebuyer);
		$phonebuyer=$this->clean($phonebuyer);
		$chatidbuyer=$this->cmd_user_get_chatid_phone($phonebuyer);
		$fiobuyer=$this->cmd_user_get_fio($chatidbuyer);
			
		$phoneseller=preg_replace('/.*\(/', '', $text1);
		$phoneseller=preg_replace('/\).*/', '', $phoneseller);
		$phoneseller=$this->clean($phoneseller);
		$chatidseller=$this->cmd_user_get_chatid_phone($phoneseller);
		$fioseller=$this->cmd_user_get_fio($chatidseller);
		
		preg_match_all('/ID №\d{1,}/', $text1, $out1);
		
		$record=preg_replace('/ID №/', '', $out1[0][0]);
		$record=$this->clean($record);

		$tabbuy='tabservicebuy'.$chatidbuyer.'';
		$tabseller='tabmain'.$chatidseller.'';
		$tabsold='tabservicesold'.$chatidseller.'';
		
		$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbuy.' WHERE messid="'.$record.'"');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
			
		for($i1=0;$i1<$con1;$i1++)
		{
			mysqli_data_seek($query1, $i1);
			$row1[$i1]=mysqli_fetch_row($query1);
		}
		
		$photo=$row1[0][8];
		$messageid=$row1[0][11];
		$timeold=$row1[0][10];
		$timediff=time()-$timeold;
		
		
		if(preg_match('/;/', $photo)==FALSE)
		{
			if($timediff>172000)
			{
				$text='<b><i>Товар продан</i></b>'.PHP_EOL.'⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️';
				$photosold='https://domain.com/photosold.png';
				
				$this->api->editMessageMedia([
				'chat_id' => $this->mainchannel,
				'message_id' => $messageid,
				'media' => json_encode( ['type' => 'photo', 'media' => $photosold]),
				]);
			
				$this->api->editMessageCaption([
				'chat_id' => $this->mainchannel,
				'message_id' => $messageid,
				'caption' => $text,
				'parse_mode' => "HTML",
				]);
				
				$photo=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photo);
				unlink($photo);
				usleep(100000);
			}
			else
			{
				$this->api->deleteMessage([
				'chat_id' => $this->mainchannel,
				'message_id' => $messageid
				]);
				
				$photo=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photo);
				unlink($photo);
				usleep(100000);
			}
		}
		else
		{
			
			$tabservicerecords='tabservicerecords';
			$text='<b><i>Товар продан</i></b>'.PHP_EOL.'⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️';
			$photosold='https://domain.com/photosold.png';
			
			if($timediff>172000)
			{
			
				$this->api->editMessageCaption([
				'chat_id' => $this->mainchannel,
				'message_id' => $messageid,
				'caption' => $text,
				'parse_mode' => "HTML",
				]);
				
				
				$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
				$con2=mysqli_num_rows($query2);
			
				for($i2=0;$i2<$con2;$i2++)
				{
					mysqli_data_seek($query2, $i2);
					$row2[$i2]=mysqli_fetch_row($query2);
				}
				
				$messageids=explode(';', $row2[0][2]);
				$count1=count($messageids);
				
				for($e=0;$e<$count1;$e++)
				{
					
					if($e==0)
					{
						$this->api->editMessageMedia([
						'chat_id' => $this->mainchannel,
						'message_id' => $messageids[$e],
						'media' => json_encode( ['type' => 'photo', 'media' => $photosold, 'caption' => $text, 'parse_mode' => "HTML" ]),
						]);
					}
					else
					{
						$this->api->editMessageMedia([
						'chat_id' => $this->mainchannel,
						'message_id' => $messageids[$e],
						'media' => json_encode( ['type' => 'photo', 'media' => $photosold]),
						]);
					}
			
				}
				
				$photos=explode(';', $photo);
				$cnt=count($photos);
				
				for($y=0;$y<$cnt;$y++)
				{
					$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
					unlink($photos[$y]);
					usleep(100000);
				}
			}
			else
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
				$con2=mysqli_num_rows($query2);
			
				for($i2=0;$i2<$con2;$i2++)
				{
					mysqli_data_seek($query2, $i2);
					$row2[$i2]=mysqli_fetch_row($query2);
				}
				
				$messageids=explode(';', $row2[0][2]);
				$count1=count($messageids);
				
				for($e=0;$e<$count1;$e++)
				{
					$this->api->deleteMessage([
					'chat_id' => $this->mainchannel,
					'message_id' => $messageids[$e]
					]);
					usleep(100000);
				}
				
				$photos=explode(';', $photo);
				$cnt=count($photos);
				
				for($y=0;$y<$cnt;$y++)
				{
					$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
					unlink($photos[$y]);
					usleep(100000);
				}
				
			}
			
			mysqli_query($con_sql2, 'DELETE FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
			
		}
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabsold.' LIMIT 1')==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabsold.' LIKE '.$tabbuy.'');
			usleep(250000);
		}
		
		mysqli_query($con_sql2, 'INSERT INTO '.$tabsold.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller FROM '.$tabbuy.' WHERE messid="'.$record.'"');
						
		$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabsold.' WHERE messid="'.$record.'"');
		$con2=mysqli_num_rows($query2);
		usleep(100000);
		
		for($i2=0;$i2<$con2;$i2++)
		{
			mysqli_data_seek($query2, $i2);
			$row2[$i2]=mysqli_fetch_row($query2);
		}
				
		$time=time();
		$date=date('d.m.Y');
		
		$query2='UPDATE '.$tabsold.' SET date = REPLACE(date, "'.$row2[0][9].'", "'.$date.'") WHERE messid="'.$record.'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		
		$query2='UPDATE '.$tabsold.' SET time = REPLACE(time, "'.$row2[0][10].'", "'.$time.'") WHERE messid="'.$record.'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		
		$query2=mysqli_query($con_sql2, 'DELETE FROM '.$tabseller.' WHERE messid="'.$record.'"');
		usleep(100000);
		
		$query2=mysqli_query($con_sql2, 'DELETE FROM '.$tabbuy.' WHERE messid="'.$record.'"');
		usleep(100000);
		
		$query4=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
		$con4=mysqli_num_rows($query4);
		
		if($con4!=0)
		{
		
			for($i4=0;$i4<$con4;$i4++)
			{
				mysqli_data_seek($query4, $i4);
				$row4[$i4]=mysqli_fetch_row($query4);
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row4[$i4][0].' WHERE messid="'.$record.'"'))!=0)
				{
					if($row4[$i4][0]!==''.$tabbuy.'')
					{
						$query2=mysqli_query($con_sql2, 'DELETE FROM '.$row4[$i4][0].' WHERE messid="'.$record.'"');
						usleep(100000);
						
						$chatidbuyers=str_replace('tabservicebuy', '', $row4[$i4][0]);
						$chatidbuyers=$this->clean($chatidbuyers);
						
						$text3='Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>отменена администратором</b>.'.PHP_EOL.''.PHP_EOL.'К сожалению, данного товара нет в наличии. Извините за неудобства.'.$this->pre.'';
						
						$this->api->sendMessage([
						'chat_id' => $chatidbuyers,
						'text' => $text3,
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
						'parse_mode' => "HTML",
						]);
						usleep(100000);
					}	
				}
				
			}
		}
		

		$text='<b>Вы ПОДТВЕРДИЛИ покупку:</b>'.PHP_EOL.''.PHP_EOL.'Покупатель 👤<b>'.$fiobuyer.' ('.$phonebuyer.')</b>, Продавец 👤<b>'.$fioseller.' ('.$phoneseller.')</b>, ID товара <b>№'.$record.'</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
		
		/* if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000); */
		
		/* $text='Вы находитесь в <b>Главном меню администратора.</b>';
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000); */
		
		$text2='Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>согласована администратором</b>.'.PHP_EOL.'В ближайшее время с вами <b>свяжется Продавец.</b>'.$this->pre.'';
			
		$this->api->sendMessage([

			'chat_id' => $chatidbuyer,
			'text' => $text2,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
			'parse_mode' => "HTML",
			]);
		usleep(100000);
		
		
		
	}
	
	
/////
	public function callback_admin_ask_buy_deny()
	{
		$con_sql2=$this->cmd_sql();
		
		$text1=$this->api->textmessage;
		
		$phonebuyer=preg_replace('/\).*/', '', $text1);
		$phonebuyer=preg_replace('/.*\(/', '', $phonebuyer);
		$phonebuyer=$this->clean($phonebuyer);
		$chatidbuyer=$this->cmd_user_get_chatid_phone($phonebuyer);
		$fiobuyer=$this->cmd_user_get_fio($chatidbuyer);
			
		$phoneseller=preg_replace('/.*\(/', '', $text1);
		$phoneseller=preg_replace('/\).*/', '', $phoneseller);
		$phoneseller=$this->clean($phoneseller);
		$chatidseller=$this->cmd_user_get_chatid_phone($phoneseller);
		$fioseller=$this->cmd_user_get_fio($chatidseller);
		
		preg_match_all('/ID №\d{1,}/', $text1, $out1);
		
		$record=preg_replace('/ID №/', '', $out1[0][0]);
		$record=$this->clean($record);

		$tabbuy='tabservicebuy'.$chatidbuyer.'';
		$tabseller='tabmain'.$chatidseller.'';
		$tabsold='tabservicesold'.$chatidseller.'';
		
		$query2=mysqli_query($con_sql2, 'DELETE FROM '.$tabbuy.' WHERE messid="'.$record.'"');
		usleep(100000);
		
		$text='<b>Вы ОТМЕНИЛИ покупку:</b>'.PHP_EOL.''.PHP_EOL.'Покупатель 👤<b>'.$fiobuyer.' ('.$phonebuyer.')</b>, Продавец 👤<b>'.$fioseller.' ('.$phoneseller.')</b>, ID товара <b>№'.$record.'</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
		
		/* if(isset($this->api->body['callback_query']["id"]))
		
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000);
		
		
		$text='Вы находитесь в <b>Главном меню администратора.</b>';
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000); */
		
		$text2='Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>отменена администратором</b>.'.PHP_EOL.''.PHP_EOL.'К сожалению, данного товара нет в наличии. Извините за неудобства.'.$this->pre.'';
			
		$this->api->sendMessage([

			'chat_id' => $chatidbuyer,
			'text' => $text2,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
			'parse_mode' => "HTML",
			]);
		usleep(100000);
	}



	
/* /////
	public function callback_resetfilters_default_buy()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcat'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabgender'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcond'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
	
		$tab='tabprice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		
		$text='<b>Ваши фильтры сброшены!</b>'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить товар</b>.';
		//$this->callbackAnswer5( $text, $this->keyboards['inline_buy_default']);
		$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
	} */

/////
	public function callback_buy_back_main()
	{

		if($this->cmd_isadmin())
		{
			$text='Вы вернулись в <b>Главное меню.</b>'.PHP_EOL.''.PHP_EOL.'Пожалуйста, сделайте свой выбор, о мой Админ!'.$this->pre.'';
		
			$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			usleep(100000);
		}
		else
		{
			$text='Вы вернулись в <b>Главное меню.</b>'.$this->pre.'';
		
			$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			usleep(100000);
		}

	}
	
/////
	public function callback_buy_exit_main()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcat'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabgender'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
	
		$tab='tabcond'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
	
		$tab='tabprice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		
		$tab='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню.</b>'.PHP_EOL.''.PHP_EOL.'Пожалуйста, сделайте свой выбор, о мой Админ!'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		
		}
		else
		{
			$text='Вы вышли в <b>Главное меню.</b>'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
	}




/////////////////////////////////////////////////////////CHOOSE//////////////////////////////////////////////////////////////////////////
/////
	public function callback_choose_default_buy()
	{	
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(100000);
		$tab='tabcat'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(250000);	
		$tab='tabgender'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(100000);
		$tab='tabcond'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(100000);
		$tab='tabprice'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(100000);
		$tab='tabservice'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(100000);
		
		
		$merge=$this->cmd_filter_buy_type();
		//$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_type_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_type"]];
		//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
		$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_choose_main"],["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
		
		$text='Выбирите одну или несколько <b>Категорий</b>, затем <b>нажмите кнопку Далее</b> для выбора <b>Вида</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $merge);
		
	}
	
/////
	public function callback_buy_back_choose_main()
	{		
		
		$text='Вы вернулись в раздел <b>Купить.</b> Пожалуйста, сделайте свой выбор.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
	
	}
	
/////
	public function callback_buy_exit_choose_main()
	{		
		$con_sql2=$this->cmd_sql();
		
		
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню.</b>'.PHP_EOL.''.PHP_EOL.'Пожалуйста, сделайте свой выбор, о мой Админ!'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		
		}
		else
		{
			$text='Вы вышли в <b>Главное меню.</b> Пожалуйста, сделайте свой выбор.'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
			
	}


/////
	public function callback_resetfilters_buy_choose()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(250000);
		$tab='tabcat'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(250000);	
		$tab='tabgender'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(250000);
		$tab='tabcond'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(250000);
		$tab='tabprice'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(250000);
		$tab='tabservice'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
		usleep(250000);
		
		
		$merge=$this->cmd_filter_buy_type();
		$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_type_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_type"]];
		$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
		$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_choose_main"],["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
		
		$text='<b>Ваши фильтры сброшены!</b>'.PHP_EOL.''.PHP_EOL.'Выбирите одну или несколько <b>категорий товара</b>, затем нажмите кнопку <b>Далее</b> для продолжения сортировки.'.$this->pre.'';
		$this->callbackAnswer( $text, $merge);
	}





/////
	public function cmd_filter_buy_type()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabtype='tabtype'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabservice.' WHERE messid!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tab.' WHERE messid!="0"');
				usleep(100000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
		
		$cnt=count($put);
	
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
	
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_type_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_type_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_type_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();
							
							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabtype.' LIMIT 1&#039;)==FALSE)
								{
									if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabmain.' LIMIT 1&#039;)==FALSE)
									{
										$query1=&#039;CREATE TABLE '.$tabmain.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(15), cat VARCHAR(15), gender VARCHAR(10), brand VARCHAR(30), size VARCHAR(30), price NUMERIC(7,0), alt VARCHAR(512), pic VARCHAR(512), date VARCHAR(11), time VARCHAR(11), messid VARCHAR(15), cond VARCHAR(10), chatid VARCHAR(15)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;;
										mysqli_query($con_sql2, $query1);
										usleep(100000);
									}
									
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabtype.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabtype.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE type="'.$put[$u].'"&#039;);
								usleep(250000);
								
								$merge=$bot->cmd_filter_buy_type();
								usleep(100000);
								
								$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_type_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_type"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = &#039;Вы выбрали категорию <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одну или нажать кнопку <b>Далее</b> для выбора <b>Вида</b>.&#039;.$bot->pre.&#039;&#039;;
								
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
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabtype.' LIMIT 1&#039;)==FALSE)
								{
									if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabmain.' LIMIT 1&#039;)==FALSE)
									{
										$query1=&#039;CREATE TABLE '.$tabmain.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(15), cat VARCHAR(15), gender VARCHAR(10), brand VARCHAR(30), size VARCHAR(30), price NUMERIC(7,0), alt VARCHAR(512), pic VARCHAR(512), date VARCHAR(11), time VARCHAR(11), messid VARCHAR(15), cond VARCHAR(10), chatid VARCHAR(15)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;;
										mysqli_query($con_sql2, $query1);
										usleep(100000);
									}
									
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabtype.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabtype.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE type="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{	
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
												
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabtype.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE type="'.$put[$u].'"&#039;);
											usleep(250000);
										}
									}
								}
									
								$merge=$bot->cmd_filter_buy_type();
								usleep(100000);
								
								$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_type_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_type"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = &#039;Вы выбрали категорию <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одну или нажать кнопку <b>Далее</b> для выбора <b>Вида</b>.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
							}
								
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	}


/////
	public function callback_ready_buy_type()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabtype='tabtype'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabtype.'');
				usleep(250000);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'DROP TABLE '.$tabtype.'');
				usleep(250000);
			}	
		}
		

		$tabservice='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1')==FALSE)
		{
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			if($con1!=0)
			{	
			
				$table=[];
				$check=0;
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					$tab=$row1[$i1][0];
					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by messid ASC');
					usleep(100000);
					$con=mysqli_num_rows($query);
						
					if($con!=0)
					{	

						$check=1;
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
		
						for($i=0;$i<$con;$i++)
						{
						
						
							$type=$this->convert_rus($row[$i][1]);
							$cat=$this->convert_rus($row[$i][2]);
							$gender=$this->convert_rus($row[$i][3]);
							$cond=$this->convert_rus($row[$i][12]);
						
						
						
							/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
							
							$this->api->sendMessage([
							'text' => $text,
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							usleep(100000); */
							
							
							$messageid=$row[$i][11];
							
							$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[$i][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[$i][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[$i][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[$i][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
							
							$photo=$row[$i][8];
							
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
								unset($getinclude[array_key_last($getinclude)]);
								file_put_contents($include, $getinclude);
							}
							
		
							$merge=[];
							$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_type_'.$this->api->chatId.'_'.$messageid.'']]  ;
							
							if(preg_match('/callback_buy_ready_type_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
							{
								$insert='
								public function callback_buy_ready_type_'.$this->api->chatId.'_'.$messageid.'()
								{	
						
									$bot = new TestBot;
									$bot->api->getWebhookUpdate();

									$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
							
									$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
									
								}';
								file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
							}
							
							$insert='}';
							file_put_contents($include, $insert,FILE_APPEND);
							
							if(preg_match('/;/', $photo)==FALSE)
							{
								$this->api->sendPhoto([
								'photo' => $photo,
								'caption' => $caption,
								//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin']]),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'parse_mode' => "HTML"
								]);
								usleep(250000);
						
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
								
							
							}
							else
							{
								$media=[];
								$temp=explode(';', $photo);
								$cnt=count($temp);
								for($o=0;$o<$cnt;$o++)
								{
								
								
									if($o==0)
									{
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => ['inline_keyboard'=>$merge]];
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => 'inline_keyboard'=>$this->keyboards['inline_ask_admin']];
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML"];
									}
									else
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].''];
									}
							
									$media[$o]=$put;
								}
								
								
								$this->api->sendMediaGroup([
								'media' => json_encode($media),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge])
								]);
								usleep(350000);
						
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
							}
						}
			
					}
				}
				
				if($check==1)
				{
					/* $tab='tabtype'.$this->api->chatId.'';
		
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabcat'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabgender'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabcond'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabprice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					
					$tab='tabservice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//} */
					
					if(isset($this->api->body['callback_query']["id"]))
						{
							$callback_query_id=$this->api->body['callback_query']["id"];
							$this->api->answerCallbackQuery($callback_query_id);
						}

					$text='Сверху <b>показаны все товары</b>, согласно Вашего запроса.'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);	
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
				}
				
				
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
			}
			
		}
		else
		{
			$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservice.' WHERE messid!="0" ORDER by messid ASC');
			usleep(100000);
			$con1=mysqli_num_rows($query1);
				
			if($con1!=0)
			{					
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				usleep(100000);
				
			
				for($i1=0;$i1<$con1;$i1++)
				{
				
				
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
				
				
					/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
					
					$this->api->sendMessage([
					'text' => $text,
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000); */
					
					
					$messageid=$row1[$i1][11];
					
					$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
					
					$photo=$row1[$i1][8];
					
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
						unset($getinclude[array_key_last($getinclude)]);
						file_put_contents($include, $getinclude);
					}
					
					
					$merge=[];
					$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_type_'.$this->api->chatId.'_'.$messageid.'']]  ;
					
					if(preg_match('/callback_buy_ready_type_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_ready_type_'.$this->api->chatId.'_'.$messageid.'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
					
							$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
							$merge=[];
							$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
							$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							$bot->api->sendMessage([
							&#039;text&#039; => $text,
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
							&#039;disable_notification&#039; => TRUE,
							&#039;disable_web_page_preview&#039; => TRUE,
							&#039;parse_mode&#039;=> "HTML"
							]);
							usleep(100000);
							
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						
					}
					
					$insert='}';
					file_put_contents($include, $insert,FILE_APPEND);
					
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);

						
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
						
						
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					}
				}
				
				/* $tab='tabtype'.$this->api->chatId.'';
		
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);	
				//}
				
				$tab='tabcat'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabgender'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabcond'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabprice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				
				$tab='tabservice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//} */
					
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
											
				$text='<b>Сверху показаны все товары, согласно Вашего запроса.</b>'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				
				
				
			
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			
		}
		
	}

/////
	public function callback_filter_buy_type_next()
	{	
		$con_sql2=$this->cmd_sql();
		
		$tabtype='tabtype'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"') ;
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали категории товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали категорию товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.'.$this->pre.'';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabtype.'');
				usleep(250000);
				
				
				$merge=$this->cmd_filter_buy_cat();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cat_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cat"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите один или несколько <b>Видов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Пола</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);

			}
			else
			{
				$merge=$this->cmd_filter_buy_cat();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cat_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cat"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите один или несколько <b>Видов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Пола</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"') ;
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали категории товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали категорию товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.'.$this->pre.'';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'DROP TABLE '.$tabtype.'');
				usleep(250000);
				
				$merge=$this->cmd_filter_buy_cat();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cat_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cat"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите один или несколько <b>Видов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Пола</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$merge=$this->cmd_filter_buy_cat();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cat_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cat"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите один или несколько <b>Видов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Пола</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			
			
		}
	}
	
	
	
	


/////
	public function cmd_filter_buy_cat()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabcat='tabcat'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabservice.' WHERE messid!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tab.' WHERE messid!="0"');
				usleep(100000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
			
		$cnt=count($put);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_cat_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_cat_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_cat_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();
							

							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcat.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcat.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcat.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE cat="'.$put[$u].'"&#039;);
								usleep(250000);
								

								$merge=$bot->cmd_filter_buy_cat();
								usleep(100000);
								
								$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cat_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cat"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = &#039;Вы выбрали вид <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще один или нажать кнопку <b>Далее</b> для выбора <b>Пола</b>.&#039;.$bot->pre.&#039;&#039;;
								
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
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcat.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcat.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcat.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cat="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
									
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
			
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcat.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cat="'.$put[$u].'"&#039;);
											usleep(250000);
										}
									}
								}
		
								$merge=$bot->cmd_filter_buy_cat();
								usleep(100000);
								
								$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cat_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cat"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = &#039;Вы выбрали вид <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще один или нажать кнопку <b>Далее</b> для выбора <b>Пола</b>.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
								
								
							}
		
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	}


/////
	public function callback_ready_buy_cat()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabcat='tabcat'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcat.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcat.'');
				usleep(250000);

			}
			
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcat.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcat.'');
				usleep(250000);
			}
		}
		
		
		
		
		$tabservice='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1')==FALSE)
		{
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			if($con1!=0)
			{	
			
				$table=[];
				$check=0;
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					$tab=$row1[$i1][0];
					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by messid ASC');
					usleep(100000);
					$con=mysqli_num_rows($query);
						
					if($con!=0)
					{	

						$check=1;
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
		
						for($i=0;$i<$con;$i++)
						{
						
						
							$type=$this->convert_rus($row[$i][1]);
							$cat=$this->convert_rus($row[$i][2]);
							$gender=$this->convert_rus($row[$i][3]);
							$cond=$this->convert_rus($row[$i][12]);
						
						
						
							/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
							
							$this->api->sendMessage([
							'text' => $text,
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							usleep(100000); */
							
							
							$messageid=$row[$i][11];
							
							$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[$i][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[$i][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[$i][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[$i][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
							
							$photo=$row[$i][8];
							
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
								unset($getinclude[array_key_last($getinclude)]);
								file_put_contents($include, $getinclude);
							}
							
		
							$merge=[];
							$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_cat_'.$this->api->chatId.'_'.$messageid.'']]  ;
							
							if(preg_match('/callback_buy_ready_cat_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
							{
								$insert='
								public function callback_buy_ready_cat_'.$this->api->chatId.'_'.$messageid.'()
								{	
						
									$bot = new TestBot;
									$bot->api->getWebhookUpdate();

									$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
							
									$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
									
								}';
								file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
								
							}
							
							$insert='}';
							file_put_contents($include, $insert,FILE_APPEND);
							
							
							if(preg_match('/;/', $photo)==FALSE)
							{
								$this->api->sendPhoto([
								'photo' => $photo,
								'caption' => $caption,
								//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin']]),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'parse_mode' => "HTML"
								]);
								usleep(250000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
								
							
							}
							else
							{
								$media=[];
								$temp=explode(';', $photo);
								$cnt=count($temp);
								for($o=0;$o<$cnt;$o++)
								{
								
								
									if($o==0)
									{
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => ['inline_keyboard'=>$merge]];
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => 'inline_keyboard'=>$this->keyboards['inline_ask_admin']];
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML"];
									}
									else
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].''];
									}
							
									$media[$o]=$put;
								}
								
								
								$this->api->sendMediaGroup([
								'media' => json_encode($media),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge])
								]);
								usleep(350000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
							}
						}
			
					}
				}
				
				if($check==1)
				{
					/* $tab='tabtype'.$this->api->chatId.'';
		
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabcat'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabgender'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabcond'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabprice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					
					$tab='tabservice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//} */
					
					if(isset($this->api->body['callback_query']["id"]))
						{
							$callback_query_id=$this->api->body['callback_query']["id"];
							$this->api->answerCallbackQuery($callback_query_id);
						}

					$text='Сверху <b>показаны все товары</b>, согласно Вашего запроса.'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить товар</b>.'.$this->pre.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);	
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
				}
				
				
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
			}
			
		}
		else
		{
			$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservice.' WHERE messid!="0" ORDER by messid ASC');
			usleep(100000);
			$con1=mysqli_num_rows($query1);
				
			if($con1!=0)
			{					
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				usleep(100000);
				
			
				for($i1=0;$i1<$con1;$i1++)
				{
				
				
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
				
				
					/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
					
					$this->api->sendMessage([
					'text' => $text,
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000); */
					
					
					$messageid=$row1[$i1][11];
					
					$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
					
					$photo=$row1[$i1][8];
					
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
						unset($getinclude[array_key_last($getinclude)]);
						file_put_contents($include, $getinclude);
					}
					
					
					$merge=[];
					$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_cat_'.$this->api->chatId.'_'.$messageid.'']]  ;
					
					if(preg_match('/callback_buy_ready_cat_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_ready_cat_'.$this->api->chatId.'_'.$messageid.'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
					
							$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
							$merge=[];
							$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
							$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							$bot->api->sendMessage([
							&#039;text&#039; => $text,
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
							&#039;disable_notification&#039; => TRUE,
							&#039;disable_web_page_preview&#039; => TRUE,
							&#039;parse_mode&#039;=> "HTML"
							]);
							usleep(100000);
							
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						
					}
					
					$insert='}';
					file_put_contents($include, $insert,FILE_APPEND);
						
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);
					
						
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
						
						
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					}
				}
				
				/* $tab='tabtype'.$this->api->chatId.'';
		
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);	
				//}
				
				$tab='tabcat'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabgender'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabcond'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabprice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				
				$tab='tabservice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//} */
					
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
											
				$text='<b>Сверху показаны все товары, согласно Вашего запроса.</b>'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить.</b>'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				
			
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			
		}
		
	}

/////
	public function callback_filter_buy_cat_next()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabcat='tabcat'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали наименования товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового наименования товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали вид <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового вида товара.'.$this->pre.'';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcat.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcat.'');
				usleep(250000);
				
				$merge=$this->cmd_filter_buy_gender();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_gender_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_gender"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите один или несколько <b>Полов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Состояния</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
				
			}
			else
			{
				$merge=$this->cmd_filter_buy_gender();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_gender_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_gender"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];

				$text='Выбирите один или несколько <b>Полов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Состояния</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали наименования товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового наименования товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали вид <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового наименования товара.'.$this->pre.'';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcat.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcat.'');
				usleep(250000);
				/* mysqli_query($con_sql2, 'DROP TABLE '.$tabcat.'');
				usleep(250000); */
				
				$merge=$this->cmd_filter_buy_gender();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_gender_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_gender"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];

				$text='Выбирите один или несколько <b>Полов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Состояния</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$merge=$this->cmd_filter_buy_gender();
				$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_gender_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_gender"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];

				$text='Выбирите один или несколько <b>Полов</b>, затем нажмите кнопку <b>Далее</b> для выбора <b>Состояния</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			
		}
		
	}	



/////
	public function cmd_filter_buy_gender()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabgender='tabgender'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabservice.' WHERE messid!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tab.' WHERE messid!="0"');
				usleep(100000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
		
		
		$cnt=count($put);

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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
	
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_gender_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_gender_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_gender_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();

							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
						
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabgender.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabgender.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabgender.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE gender="'.$put[$u].'"&#039;);
								usleep(250000);
								
								$merge=$bot->cmd_filter_buy_gender();
								usleep(100000);
								
								$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_gender_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_gender"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = &#039;Вы выбрали пол <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще один или нажать кнопку <b>Далее</b> для выбора <b>Состояния</b>.&#039;.$bot->pre.&#039;&#039;;
								
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
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabgender.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabgender.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabgender.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE gender="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
									
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
												
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabgender.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE gender="'.$put[$u].'"&#039;);
											usleep(250000);
										}
										
									}
								}

								$merge=$bot->cmd_filter_buy_gender();
								usleep(100000);
								
								$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_gender_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_gender"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = &#039;Вы выбрали пол <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще один или нажать кнопку <b>Далее</b> для выбора <b>Состояния</b>.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
								
							}

						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	}



/////
	public function callback_ready_buy_gender()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabgender='tabgender'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
					
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabgender.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabgender.'');
				usleep(250000);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabgender.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabgender.'');
				usleep(250000);
				/* mysqli_query($con_sql2, 'DROP TABLE '.$tabgender.'');
				usleep(250000); */

			}	
		}
		
		
		
		
		$tabservice='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1')==FALSE)
		{
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			if($con1!=0)
			{	
			
				$table=[];
				$check=0;
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					$tab=$row1[$i1][0];
					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by messid ASC');
					usleep(100000);
					$con=mysqli_num_rows($query);
						
					if($con!=0)
					{	

						$check=1;
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
		
						for($i=0;$i<$con;$i++)
						{
						
						
							$type=$this->convert_rus($row[$i][1]);
							$cat=$this->convert_rus($row[$i][2]);
							$gender=$this->convert_rus($row[$i][3]);
							$cond=$this->convert_rus($row[$i][12]);
						
						
						
							/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
							
							$this->api->sendMessage([
							'text' => $text,
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							usleep(100000); */
							
							
							$messageid=$row[$i][11];
							
							$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[$i][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[$i][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[$i][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[$i][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
							
							$photo=$row[$i][8];
							
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
								unset($getinclude[array_key_last($getinclude)]);
								file_put_contents($include, $getinclude);
							}
							
		
							$merge=[];
							$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_gender_'.$this->api->chatId.'_'.$messageid.'']]  ;
							
							if(preg_match('/callback_buy_ready_gender_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
							{
								$insert='
								public function callback_buy_ready_gender_'.$this->api->chatId.'_'.$messageid.'()
								{	
						
									$bot = new TestBot;
									$bot->api->getWebhookUpdate();

									$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
							
									$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
									
								}';
								file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
								
							}
							
							$insert='}';
							file_put_contents($include, $insert,FILE_APPEND);
							
							
							if(preg_match('/;/', $photo)==FALSE)
							{
								$this->api->sendPhoto([
								'photo' => $photo,
								'caption' => $caption,
								//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin']]),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'parse_mode' => "HTML"
								]);
								usleep(250000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
								
							
							}
							else
							{
								$media=[];
								$temp=explode(';', $photo);
								$cnt=count($temp);
								for($o=0;$o<$cnt;$o++)
								{
								
								
									if($o==0)
									{
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => ['inline_keyboard'=>$merge]];
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => 'inline_keyboard'=>$this->keyboards['inline_ask_admin']];
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML"];
									}
									else
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].''];
									}
							
									$media[$o]=$put;
								}
								
								
								$this->api->sendMediaGroup([
								'media' => json_encode($media),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge])
								]);
								usleep(350000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
							}
						}
			
					}
				}
				
				if($check==1)
				{
					/* $tab='tabtype'.$this->api->chatId.'';
		
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabcat'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabgender'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabcond'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabprice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					
					$tab='tabservice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//} */
					if(isset($this->api->body['callback_query']["id"]))
						{
							$callback_query_id=$this->api->body['callback_query']["id"];
							$this->api->answerCallbackQuery($callback_query_id);
						}
					

					$text='Сверху <b>показаны все товары</b>, согласно Вашего запроса.'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);	
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
				}
				
				
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
			}
			
		}
		else
		{
			$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservice.' WHERE messid!="0" ORDER by messid ASC');
			usleep(100000);
			$con1=mysqli_num_rows($query1);
				
			if($con1!=0)
			{					
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				usleep(100000);
				
			
				for($i1=0;$i1<$con1;$i1++)
				{
				
				
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
				
				
					/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
					
					$this->api->sendMessage([
					'text' => $text,
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000); */
					
					
					$messageid=$row1[$i1][11];
					
					$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
					
					$photo=$row1[$i1][8];
					
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
						unset($getinclude[array_key_last($getinclude)]);
						file_put_contents($include, $getinclude);
					}
					
					
					$merge=[];
					$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_gender_'.$this->api->chatId.'_'.$messageid.'']]  ;
					
					if(preg_match('/callback_buy_ready_gender_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_ready_gender_'.$this->api->chatId.'_'.$messageid.'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
					
							$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
							$merge=[];
							$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
							$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							$bot->api->sendMessage([
							&#039;text&#039; => $text,
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
							&#039;disable_notification&#039; => TRUE,
							&#039;disable_web_page_preview&#039; => TRUE,
							&#039;parse_mode&#039;=> "HTML"
							]);
							usleep(100000);
							
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						
					}
					
					$insert='}';
					file_put_contents($include, $insert,FILE_APPEND);
					
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);
					
						
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
						
			
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					}
				}
				
				/* $tab='tabtype'.$this->api->chatId.'';
		
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);	
				//}
				
				$tab='tabcat'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabgender'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabcond'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabprice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				
				$tab='tabservice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//} */
					
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
											
				$text='<b>Сверху показаны все товары, согласно Вашего запроса.</b>'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить.</b>'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				
			
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			
		}
		
	}


/////
	public function callback_filter_buy_gender_next()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabgender='tabgender'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали Пол <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали Пол <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.'.$this->pre.'';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabgender.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabgender.'');
				usleep(250000);
				
				
				$merge=$this->cmd_filter_buy_cond();
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cond_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите одно или несколько <b>Состояний</b>, затем нажмите кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
				

			}
			else
			{
				$merge=$this->cmd_filter_buy_cond();
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cond_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите одно или несколько <b>Состояний</b>, затем нажмите кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.'.$this->pre.'';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabgender.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabgender.'');
				usleep(250000);
				/* mysqli_query($con_sql2, 'DROP TABLE '.$tabgender.'');
				usleep(250000); */
				
				$merge=$this->cmd_filter_buy_cond();
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cond_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите одно или несколько <b>Состояний</b>, затем нажмите кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$merge=$this->cmd_filter_buy_cond();
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cond_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Выбирите одно или несколько <b>Состояний</b>, затем нажмите кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			
		}
		
	}	




	public function cmd_filter_buy_cond()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabcond='tabcond'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabservice.' WHERE messid!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tab.' WHERE messid!="0"');
				usleep(100000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
		
		
		$cnt=count($put);

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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
	
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_cond_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_cond_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_cond_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();

							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
						
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcond.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcond.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcond.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE cond="'.$put[$u].'"&#039;);
								usleep(250000);
								
								$merge=$bot->cmd_filter_buy_cond();
								usleep(100000);
								
								$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
								//$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cond_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = &#039;Вы выбрали состояние <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одно или нажать кнопку <b>Показать</b> для отображения результатов.&#039;.$bot->pre.&#039;&#039;;
								
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
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcond.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcond.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcond.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cond="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
									
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
												
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcond.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cond="'.$put[$u].'"&#039;);
											usleep(250000);
										}
										
									}
								}

								$merge=$bot->cmd_filter_buy_cond();
								usleep(100000);
								
								$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
								//$merge[] = [["text" => "➡️Далее", "callback_data" => "filter_buy_cond_next"], ["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
								//$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
								$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = &#039;Вы выбрали состояние<b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одно или нажать кнопку <b>Показать</b> для отображения результатов.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
								
							}

						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	}



/////
	public function callback_ready_buy_cond()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabcond='tabcond'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{

				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcond.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcond.'');
				usleep(250000);

			}
		
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcond.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcond.'');
				usleep(250000);
				/* mysqli_query($con_sql2, 'DROP TABLE '.$tabcond.'');
				usleep(250000); */
			
			}
		}
		
		
		
		
		$tabservice='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1')==FALSE)
		{
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			if($con1!=0)
			{	
			
				$table=[];
				$check=0;
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					$tab=$row1[$i1][0];
					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by messid ASC');
					usleep(100000);
					$con=mysqli_num_rows($query);
						
					if($con!=0)
					{	

						$check=1;
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
		
						for($i=0;$i<$con;$i++)
						{
						
						
							$type=$this->convert_rus($row[$i][1]);
							$cat=$this->convert_rus($row[$i][2]);
							$gender=$this->convert_rus($row[$i][3]);
							$cond=$this->convert_rus($row[$i][12]);
						
						
						
							/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
							
							$this->api->sendMessage([
							'text' => $text,
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
							usleep(100000); */
							
							
							$messageid=$row[$i][11];
							
							$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[$i][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[$i][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[$i][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[$i][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
							
							$photo=$row[$i][8];
							
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
								unset($getinclude[array_key_last($getinclude)]);
								file_put_contents($include, $getinclude);
							}
							
		
							$merge=[];
							$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_cond_'.$this->api->chatId.'_'.$messageid.'']]  ;
							
							if(preg_match('/callback_buy_ready_cond_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
							{
								$insert='
								public function callback_buy_ready_cond_'.$this->api->chatId.'_'.$messageid.'()
								{	
						
									$bot = new TestBot;
									$bot->api->getWebhookUpdate();

									$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
									$merge=[];
									$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
									$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
									
									if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
									{
										$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
										$bot->api->answerCallbackQuery($callback_query_id);
									}
							
									$bot->api->sendMessage([
									&#039;text&#039; => $text,
									&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
									&#039;disable_notification&#039; => TRUE,
									&#039;disable_web_page_preview&#039; => TRUE,
									&#039;parse_mode&#039;=> "HTML"
									]);
									usleep(100000);
									
								}';
								file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
								
							}
							
							$insert='}';
							file_put_contents($include, $insert,FILE_APPEND);
							
							
							if(preg_match('/;/', $photo)==FALSE)
							{
								$this->api->sendPhoto([
								'photo' => $photo,
								'caption' => $caption,
								//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin']]),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'parse_mode' => "HTML"
								]);
								usleep(250000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
								
							
							}
							else
							{
								$media=[];
								$temp=explode(';', $photo);
								$cnt=count($temp);
								for($o=0;$o<$cnt;$o++)
								{
								
								
									if($o==0)
									{
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => ['inline_keyboard'=>$merge]];
										//$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML", 'reply_markup' => 'inline_keyboard'=>$this->keyboards['inline_ask_admin']];
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML"];
									}
									else
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].''];
									}
							
									$media[$o]=$put;
								}
								
								
								$this->api->sendMediaGroup([
								'media' => json_encode($media),
								//'reply_markup' => json_encode( ['inline_keyboard'=>$merge])
								]);
								usleep(350000);
								
								$text='Купить <b>ID №'.$messageid.'</b>';
								$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
								usleep(100000);
							}
						}
			
					}
				}
				
				if($check==1)
				{
					/* $tab='tabtype'.$this->api->chatId.'';
		
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabcat'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					$tab='tabgender'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabcond'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
				
					$tab='tabprice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//}
					
					
					$tab='tabservice'.$this->api->chatId.'';
					
					//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
					//{
						mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
						usleep(100000);
					//} */
					
					if(isset($this->api->body['callback_query']["id"]))
						{
							$callback_query_id=$this->api->body['callback_query']["id"];
							$this->api->answerCallbackQuery($callback_query_id);
						}

					$text='Сверху <b>показаны все товары</b>, согласно Вашего запроса.'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);	
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
				}
				
				
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
			}
			
		}
		else
		{
			$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservice.' WHERE messid!="0" ORDER by messid ASC');
			usleep(100000);
			$con1=mysqli_num_rows($query1);
				
			if($con1!=0)
			{					
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				usleep(100000);
				
			
				for($i1=0;$i1<$con1;$i1++)
				{
				
				
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
				
				
					/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
					
					$this->api->sendMessage([
					'text' => $text,
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000); */
					
					
					$messageid=$row1[$i1][11];
					
					$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$messageid.'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
					
					$photo=$row1[$i1][8];
					
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
						unset($getinclude[array_key_last($getinclude)]);
						file_put_contents($include, $getinclude);
					}
					
					
					$merge=[];
					$merge[]= [['text' => '🛒Купить', 'callback_data' => 'buy_ready_cond_'.$this->api->chatId.'_'.$messageid.'']]  ;
					
					if(preg_match('/callback_buy_ready_cond_'.$this->api->chatId.'_'.$messageid.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_ready_cond_'.$this->api->chatId.'_'.$messageid.'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
					
							$text=&#039;Вы запросили товар с <b>ID №'.$messageid.'.</b> &#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Вы точно хотите купить его?</b>&#039;.$bot->pre.&#039;&#039;;
							$merge=[];
							$merge[] = [[&#039;text&#039; => &#039;🟢Да&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_yes&#039;], [&#039;text&#039; => &#039;🔴Нет&#039;, &#039;callback_data&#039; => &#039;byrecordid_default_buy_no&#039;]];
							$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;back_byrecordid_default_buy&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;exit_byrecordid_default_buy&#039;]];
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							$bot->api->sendMessage([
							&#039;text&#039; => $text,
							&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
							&#039;disable_notification&#039; => TRUE,
							&#039;disable_web_page_preview&#039; => TRUE,
							&#039;parse_mode&#039;=> "HTML"
							]);
							usleep(100000);
							
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
						
					}
					
					$insert='}';
					file_put_contents($include, $insert,FILE_APPEND);
					
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);
					

						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
						

						
						$text='Купить <b>ID №'.$messageid.'</b>';
						$this->api->sendMessage([
						'text' => $text,
						'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
						'disable_notification' => TRUE,
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						usleep(100000);
					}
				}
				
				/* $tab='tabtype'.$this->api->chatId.'';
		
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);	
				//}
				
				$tab='tabcat'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabgender'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabcond'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				$tab='tabprice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//}
				
				
				$tab='tabservice'.$this->api->chatId.'';
				
				//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
				//{
					mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
					usleep(100000);
				//} */
					
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
											
				$text='<b>Сверху показаны все товары, согласно Вашего запроса.</b>'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Купить.</b>'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
				
				
			
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню <b>Купить</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
			}
			
		}
		
	}

/////
	public function callback_filter_buy_cond_next()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabcond='tabcond'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.'.$this->pre.'';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcond.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcond.'');
				usleep(250000);
				
				
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Нажмите кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);

			}
			else
			{
				
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Нажмите кнопку Показать для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.'.$this->pre.'';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcond.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcond.'');
				usleep(250000);
				/* mysqli_query($con_sql2, 'DROP TABLE '.$tabgender.'');
				usleep(250000); */
				
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Нажмите кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$merge[] = [["text" => "▶️Показать", "callback_data" => "ready_buy_cond"]];
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_buy_choose"]];
				$merge[] = [["text" => "⤴️Выйти", "callback_data" => "buy_exit_choose_main"]];
				
				$text='Нажмите кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			
			
		}
		
		
	}









/////////////////////////////////////////////////FILTER///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////
	/* public function callback_filter_default_buy()
	{		
		$con_sql2=$this->cmd_sql();
		$tabservice='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1')==FALSE)
		{
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			if($con1!=0)
			{	
			
				$table=[];
				$check=0;
				
				for($i=0;$i<$con1;$i++)
				{
					mysqli_data_seek($query1, $i);
					$row1[$i]=mysqli_fetch_row($query1);
					$tab=$row1[$i][0];
					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by id ASC');
					usleep(100000);
					$con=mysqli_num_rows($query);
						
					if($con!=0)
					{	
						$check=1;
						break;
					}
				}
				
				if($check==1)
				{
				
					$text="Выбирите необходимые фильтры. После настройки фильтров, нажмите кнопку Назад для перехода в меню Купить товар.";
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
					usleep(100000);
				}
				else
				{
					$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню Купить товар.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
				}
				
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню Купить товар.';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
			}
		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservice.' WHERE messid!="0" ORDER by id ASC');
			usleep(100000);
			$con=mysqli_num_rows($query);
			
			if($con!=0)
			{	
				$text="Выбирите необходимые фильтры. После настройки фильтров, нажмите кнопку Назад для перехода в меню Купить товар.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			else
			{
				$text='К сожалению в данный момент <b>нет товаров в продаже</b>. Вы находитесь в меню Купить товар.';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);	
			}
		}
		
	}	 */



/////////////////////////////////////////////////FILTER TYPE///////////////////////////////////////////////////////
/////
/* 	public function callback_filter_buy_type()
	{	
		$con_sql2=$this->cmd_sql();
	
		$tabtype='tabtype'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';

		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"') ;
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					

					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы уже выбрали категории товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
				else
				{
					$text='Вы уже выбрали категорию товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
			}
			else
			{
				$merge=$this->cmd_filter_buy_type();
				$merge[] = [["text" => "🔃Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
				$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_type"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

				$text="Выбирите одну или несколько категорий товара, затем нажмите кнопку Назад для продолжения сортировки. ";
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			$merge=$this->cmd_filter_buy_type();
			$merge[] = [["text" => "🔃Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
			$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_type"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

			$text="Выбирите одну или несколько категорий товара, затем нажмите кнопку Назад для продолжения сортировки. ";
			$this->callbackAnswer( $text, $merge);
		}
	}	

/////
	public function cmd_filter_buy_type()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabtype='tabtype'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabservice.' WHERE messid!="0"') ;
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"') ;
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"') ;
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tab.' WHERE messid!="0"') ;
				usleep(150000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"') ;
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
		
		$cnt=count($put);
	
		$maxbuttons=1;
		$ceil=ceil($cnt/$maxbuttons);

		$include=''.dirname(__FILE__).'/include.php';
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
	
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_type_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_type_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_type_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql1();
							
							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabtype.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabtype.' LIKE '.$tabmain.'&#039;) ;
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabtype.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE type="'.$put[$u].'"&#039;);
								usleep(250000);
								
								$merge=$bot->cmd_filter_buy_type();
								usleep(150000);
								
								$merge[] = [["text" => "🔃Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_type"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = "Вы выбрали категорию товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одну или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(150000);
				
							}
							else
							{
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabtype.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabtype.' LIKE '.$tabmain.'&#039;) ;
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;) ;
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabtype.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE type="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{	
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"&#039;) ;
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;) ;
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
												
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabtype.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE type="'.$put[$u].'"&#039;);
											usleep(250000);
										}
									}
								}
									
								$merge=$bot->cmd_filter_buy_type();
								usleep(150000);
								
								$merge[] = [["text" => "🔃Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_type"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = "Вы выбрали категорию товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одну или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(150000);
							}
								
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	}



/////
	public function callback_buy_back_filter_type()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabtype='tabtype'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"') ;
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали категории товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.';
					
				}
				else
				{
					$text='Вы выбрали категорию товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabtype.'');
				usleep(250000);
				
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);

			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар. Пожалуйста, сделайте свой выбор.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtype.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT type FROM '.$tabtype.' WHERE messid!="0"') ;
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали категории товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.';
					
				}
				else
				{
					$text='Вы выбрали категорию товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой категории товара.';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabtype.'');
				usleep(250000);
				mysqli_query($con_sql2, 'DROP TABLE '.$tabtype.'');
				usleep(250000);
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар. Пожалуйста, сделайте свой выбор.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			
			
		}
		
		
	}	
	

/////
	public function callback_buy_exit_filter_type()
	{		
		$con_sql2=$this->cmd_sql();
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в главное меню. Пожалуйста, сделайте свой выбор.';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
	
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(150000);
		}
		else
		{
			$text='Вы вышли в главное меню. Пожалуйста, сделайте свой выбор.';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);

			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(150000);
		}
			
	} */
/////////////////////////////////////////////////FILTER CAT///////////////////////////////////////////////////////
/////
/* 	public function callback_filter_buy_cat()
	{	
		$con_sql2=$this->cmd_sql();
	
		$tabcat='tabcat'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';

		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы уже выбрали наименования товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора другого наименования товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
				else
				{
					$text='Вы уже выбрали вид <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора другого наименования товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
			}
			else
			{
				$merge=$this->cmd_filter_buy_cat();
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
				$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cat"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

				$text="Выбирите одно или несколько наименований товара, затем нажмите кнопку Назад для продолжения сортировки. ";
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			$merge=$this->cmd_filter_buy_cat();
			$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
			$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cat"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

			$text="Выбирите одно или несколько наименований товара, затем нажмите кнопку Назад для продолжения сортировки. ";
			$this->callbackAnswer( $text, $merge);
		}
	}	


/////
	public function cmd_filter_buy_cat()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabcat='tabcat'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabservice.' WHERE messid!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tab.' WHERE messid!="0"');
				usleep(100000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
			
		$cnt=count($put);
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_cat_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_cat_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_cat_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();
							

							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcat.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcat.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcat.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE cat="'.$put[$u].'"&#039;);
								usleep(250000);
								

								$merge=$bot->cmd_filter_buy_cat();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cat"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = "Вы выбрали вид <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одно или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
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
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcat.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcat.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcat.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cat="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
									
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
			
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcat.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cat="'.$put[$u].'"&#039;);
											usleep(250000);
										}
									}
								}
		
								$merge=$bot->cmd_filter_buy_cat();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cat"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = "Вы выбрали вид <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще один или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
								
								
							}
		
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	}

 */

/////
	/* public function callback_buy_back_filter_cat()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabcat='tabcat'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали наименования товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового наименования товара.';
					
				}
				else
				{
					$text='Вы выбрали вид <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового вида товара.';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcat.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcat.'');
				usleep(250000);
				
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);

			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcat.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cat FROM '.$tabcat.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали наименования товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового наименования товара.';
					
				}
				else
				{
					$text='Вы выбрали вид <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового наименования товара.';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcat.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcat.'');
				usleep(250000);
				mysqli_query($con_sql2, 'DROP TABLE '.$tabcat.'');
				usleep(250000);
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			
			
		}
		
		
	}	 */
	

/////////////////////////////////////////////////FILTER GENDER///////////////////////////////////////////////////////
/////
	/* public function callback_filter_buy_gender()
	{	
		$con_sql2=$this->cmd_sql();
	
		$tabgender='tabgender'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';

		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы уже выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
				else
				{
					$text='Вы уже выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
			}
			else
			{
				$merge=$this->cmd_filter_buy_gender();
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
				$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_gender"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

				$text="Выбирите один или несколько полов товара, затем нажмите кнопку Назад для продолжения сортировки.";
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			$merge=$this->cmd_filter_buy_gender();
			$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
			$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_gender"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

			$text="Выбирите один или несколько полов товара, затем нажмите кнопку Назад для продолжения сортировки.";
			$this->callbackAnswer( $text, $merge);
		}
	}	 */

/* /////
	public function cmd_filter_buy_gender()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabgender='tabgender'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabservice.' WHERE messid!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tab.' WHERE messid!="0"');
				usleep(100000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
		
		
		$cnt=count($put);

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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
	
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_gender_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_gender_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_gender_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();

							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
						
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabgender.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabgender.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabgender.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE gender="'.$put[$u].'"&#039;);
								usleep(250000);
								
								$merge=$bot->cmd_filter_buy_gender();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_gender"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = "Вы выбрали пол товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще один или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
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
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabgender.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabgender.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabgender.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE gender="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
									
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
												
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabgender.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE gender="'.$put[$u].'"&#039;);
											usleep(250000);
										}
										
									}
								}

								$merge=$bot->cmd_filter_buy_gender();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_gender"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = "Вы выбрали пол товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще один или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
								
							}

						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	} */



/////
/* 	public function callback_buy_back_filter_gender()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabgender='tabgender'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					
				}
				else
				{
					$text='Вы выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabgender.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabgender.'');
				usleep(250000);
				
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);

			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabgender.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT gender FROM '.$tabgender.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					
				}
				else
				{
					$text='Вы выбрали пол товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabgender.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabgender.'');
				usleep(250000);
				mysqli_query($con_sql2, 'DROP TABLE '.$tabgender.'');
				usleep(250000);
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			
			
		}
		
		
	}	 */
	


/////////////////////////////////////////////////FILTER COND///////////////////////////////////////////////////////
/////
/* 	public function callback_filter_buy_cond()
	{	
		$con_sql2=$this->cmd_sql();
	
		$tabcond='tabcond'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';

		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы уже выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
				else
				{
					$text='Вы уже выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового пола товара.';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
			}
			else
			{
				$merge=$this->cmd_filter_buy_cond();
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
				$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cond"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

				$text="Выбирите один или несколько состояний товара, затем нажмите кнопку Назад для продолжения сортировки.";
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			$merge=$this->cmd_filter_buy_cond();
			$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
			$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cond"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

			$text="Выбирите один или несколько состояний товара, затем нажмите кнопку Назад для продолжения сортировки.";
			$this->callbackAnswer( $text, $merge);
		}
	}	 */

/////
/* 	public function cmd_filter_buy_cond()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabcond='tabcond'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabservice.' WHERE messid!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if(in_array($row2[$i1][0], $puttemp)==FALSE)								
				{
					$puttemp[]=$row2[$i1][0];
				}
			}
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
			$puttemp=[];
		
			for($i=0;$i<$con1;$i++)
			{
				
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tab.' WHERE messid!="0"');
				usleep(100000);
				$con2=mysqli_num_rows($query2);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
						
						if(in_array($row2[$i1][0], $puttemp)==FALSE)								
						{
							$puttemp[]=$row2[$i1][0];
						}
					}
				}
				
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if(in_array($row2[$i1][0], $puttemp))
					{	
						$search=array_search($row2[$i1][0], $puttemp);
						unset($puttemp[$search]);
					}
				}
			}
			
		}
		
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
		
		
		$cnt=count($put);

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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
	
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					
					$buttext=$this->convert_rus($put[$u]);
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_cond_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_cond_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_cond_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();

							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
						
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcond.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcond.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcond.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE cond="'.$put[$u].'"&#039;);
								usleep(250000);
								
								$merge=$bot->cmd_filter_buy_cond();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cond"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = "Вы выбрали состояние товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одно или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
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
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabcond.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabcond.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									$table=[];
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[]=$row2[$i][0];	
											
										mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcond.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cond="'.$put[$u].'"&#039;);
										usleep(250000);
									}
								}
								else
								{
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									}
									
									if(in_array(&#039;'.$put[$u].'&#039;, $row1)==FALSE)
									{
									
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										$table=[];
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[]=$row2[$i][0];	
												
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabcond.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE cond="'.$put[$u].'"&#039;);
											usleep(250000);
										}
										
									}
								}

								$merge=$bot->cmd_filter_buy_cond();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_cond"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = "Вы выбрали состояние товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одно или нажать кнопку <b>Назад</b> для применения выбранных фильтров.";
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
								
							}

						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	} */



/////
/* 	public function callback_buy_back_filter_cond()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabcond='tabcond'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.';
					
				}
				else
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.';
					
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcond.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcond.'');
				usleep(250000);
				
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);

			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabcond.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT cond FROM '.$tabcond.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
					
					$row2[$i1][0]=$this->convert_rus($row2[$i1][0]);
					
					
					if($i1==0)
					{
						$addtext=$row2[$i1][0];
					}
					else
					{
						$addtext = $addtext . ', '.$row2[$i1][0].'';
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.';
					
				}
				else
				{
					$text='Вы выбрали состояние товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора нового состояния товара.';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabcond.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabcond.'');
				usleep(250000);
				mysqli_query($con_sql2, 'DROP TABLE '.$tabgender.'');
				usleep(250000);
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			else
			{
				$text="Вы вернулись в раздел Фильтр меню Купить товар.";
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			
			
		}
		
		
	} */
/////////////////////////////////////////////////FILTER PRICE///////////////////////////////////////////////////////

/////
	public function callback_filter_buy_price()
	{	
		$con_sql2=$this->cmd_sql();
	
		$tabprice='tabprice'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';

		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabprice.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT price FROM '.$tabprice.' WHERE messid!="0" AND price!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
							
					if($row2[$i1][0]<1000 && $row2[$i1][0]>0)
					{
						$price='До 1000 грн';
					}
					if($row2[$i1][0]>=1000 && $row2[$i1][0]<=5000)
					{
						$price='От 1000 до 5000 грн';
					}
					if($row2[$i1][0]>5000)
					{
						$price='Свыше 5000 грн';
					}
					
					if(preg_match('/'.preg_quote($price).'/', $addtext)==FALSE)
					{
						if($i1==0)
						{
							$addtext=$price;
						}
						else
						{
							$addtext = $addtext . ', '.$price.'';
						}
					}
				}
				
				if(explode(',', $addtext))
				{
					$text='Вы уже выбрали стоимость товара <b>'.$addtext.'</b>. Выбирите другие параметры или нажмите Сбросить фильтры для выбора новой стоимости товара.'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
				else
				{
					$text='Вы уже выбрали стоимость товара <b>'.$addtext.'</b>. Выбирите другие параметры или нажмите Сбросить фильтры для выбора новой стоимости товара.'.$this->pre.'';
					$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
				}
			}
			else
			{
				$merge=$this->cmd_filter_buy_price();
				$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
				$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_price"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

				$text='Выбирите одну или несколько цен товара, затем нажмите кнопку Назад для продолжения сортировки.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
		}
		else
		{
			$merge=$this->cmd_filter_buy_price();
			$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
			$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_price"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];

			$text='Выбирите одну или несколько цен товара, затем нажмите кнопку Назад для продолжения сортировки.'.$this->pre.'';
			$this->callbackAnswer( $text, $merge);
		}
	}	

/////
	public function cmd_filter_buy_price()
	{
		
		$con_sql2=$this->cmd_sql();
	
		$tabprice='tabprice'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{

			$query2=mysqli_query($con_sql2, 'SELECT DISTINCT price FROM '.$tabservice.' WHERE messid!="0" AND price!="0"');
			$con2=mysqli_num_rows($query2);
			
			$puttemp=[];
			
			for($i1=0;$i1<$con2;$i1++)
			{
				mysqli_data_seek($query2, $i1);
				$row2[$i1]=mysqli_fetch_row($query2);
			
				if($row2[$i1][0]<1000 && $row2[$i1][0]>0)
				{
					$price1='lesshundred';
				}
				if($row2[$i1][0]>=1000 && $row2[$i1][0]<=5000)
				{
					$price1='middlehundred';
				}
				if($row2[$i1][0]>5000)
				{
					$price1='overhundred';
				}
				
				if(in_array($price1, $puttemp)==FALSE)
				{
					$puttemp[]=$price1;
				}
			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabprice.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT price FROM '.$tabprice.' WHERE messid!="0" AND price!="0"');
				$con2=mysqli_num_rows($query2);
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if($row2[$i1][0]<1000 && $row2[$i1][0]>0)
					{
						$price2='lesshundred';
					}
					if($row2[$i1][0]>=1000 && $row2[$i1][0]<=5000)
					{
						$price2='middlehundred';
					}
					if($row2[$i1][0]>5000)
					{
						$price2='overhundred';
					}
					
					if(in_array($price2, $puttemp))
					{	
						$search=array_search($price2, $puttemp);
						unset($puttemp[$search]);
					}
				}
			}

		}
		else
		{
		
			$query1=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
			$con1=mysqli_num_rows($query1);
			
			$table=[];
			
			for($i=0;$i<$con1;$i++)
			{
				mysqli_data_seek($query1, $i);
				$row1[$i]=mysqli_fetch_row($query1);
				$table[]=$row1[$i][0];	
			}
			
		
			$puttemp=[];
					
			for($i=0;$i<$con1;$i++)
			{
				$tab=$table[$i];
	
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT price FROM '.$tab.' WHERE messid!="0" AND price!="0"');
				$con2=mysqli_num_rows($query2);
				usleep(100000);
				
				if($con2!=0)
				{
					for($i1=0;$i1<$con2;$i1++)
					{
						mysqli_data_seek($query2, $i1);
						$row2[$i1]=mysqli_fetch_row($query2);
					
						
						if($row2[$i1][0]<1000 && $row2[$i1][0]>0)
						{
							$price1='lesshundred';
						}
						if($row2[$i1][0]>=1000 && $row2[$i1][0]<=5000)
						{
							$price1='middlehundred';
						}
						if($row2[$i1][0]>5000)
						{
							$price1='overhundred';
						}
						
						if(in_array($price1, $puttemp)==FALSE)								
						{
							$puttemp[]=$price1;
						}
					}
				}
				
			}
			
				/* foreach($puttemp as $value)
				{
					$this->api->sendMessage([
					'text' => $value,
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				$this->api->sendMessage([
					'text' => "***************************",
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]); */
				
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabprice.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT price FROM '.$tabprice.' WHERE messid!="0" AND price!="0"');
				$con2=mysqli_num_rows($query2);
				
							
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if($row2[$i1][0]<1000 && $row2[$i1][0]>0)
					{
						$price2='lesshundred';
					}
					if($row2[$i1][0]>=1000 && $row2[$u][0]<=5000)
					{
						$price2='middlehundred';
					}
					if($row2[$i1][0]>5000)
					{
						$price2='overhundred';
					}
										
					if(in_array($price2, $puttemp))
					{	
						$search=array_search($price2, $puttemp);
						unset($puttemp[$search]);
					}
				}
				
			}
			
		}
		
		$put=[];
		
		foreach($puttemp as $value)
		{
			$put[]=$value;
		}
			
		
		sort($put);
		$cnt=count($put);
				
		
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
		
		$u=0;
		$merge=[];
		
		
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put1=[];
			
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
		
				if(isset($put[$u]))
				{
					if($put[$u]=='lesshundred')
					{
						$buttext='До 1000 грн';
					}
					elseif($put[$u]=='middlehundred')
					{
						$buttext='От 1000 до 5000 грн';
					}
					elseif($put[$u]=='overhundred')
					{
						$buttext='Свыше 5000 грн';
					}
				
					
					$put1[]=["text" => "$buttext", "callback_data" => 'buy_select_price_'.$this->api->chatId.'_'.$put[$u].''];
					
					if(preg_match('/callback_buy_select_price_'.$this->api->chatId.'_'.$put[$u].'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_buy_select_price_'.$this->api->chatId.'_'.$put[$u].'()
						{	
					
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();
							
							$priceinput=&#039;'.$put[$u].'&#039;;


							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabservice.' LIMIT 1&#039;))
							{	
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabprice.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabprice.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
								}
								
								if($priceinput==&#039;lesshundred&#039;)
								{
									$cat1=1000;
									mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE price<"&#039;.$cat1.&#039;" AND price>"0" AND messid!="0"&#039;);
									usleep(250000);
									$buttext="До 1000 грн";
								}
								elseif($priceinput==&#039;middlehundred&#039;)
								{
									$cat1=1000;
									$cat2=5000;
									mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE price>"&#039;.$cat1.&#039;" AND price<"&#039;.$cat2.&#039;" AND messid!="0"&#039;);
									usleep(250000);
									$buttext="От 1000 до 5000 грн";
								}
								elseif($priceinput==&#039;overhundred&#039;)
								{
									$cat1=5000;
									mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabservice.' WHERE price>"&#039;.$cat1.&#039;" AND messid!="0"&#039;);
									usleep(250000);
									$buttext="Свыше 5000 грн";
								}
								

								$merge=$bot->cmd_filter_buy_price();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_price"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								
								$text = &#039;Вы выбрали стоимость товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одну или нажать кнопку <b>Назад</b> для применения выбранных фильтров.&#039;.$bot->pre.&#039;&#039;;
								
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
								
								if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabprice.' LIMIT 1&#039;)==FALSE)
								{
									mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabprice.' LIKE '.$tabmain.'&#039;);
									usleep(250000);
									
									$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
									$con2=mysqli_num_rows($query2);
									
								
									for($i=0;$i<$con2;$i++)
									{
										mysqli_data_seek($query2, $i);
										$row2[$i]=mysqli_fetch_row($query2);
										$table[$i]=$row2[$i][0];	
									
										if($priceinput==&#039;lesshundred&#039;)
										{
											$cat1=1000;
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE price<"&#039;.$cat1.&#039;"  AND price>"0" AND messid!="0"&#039;);
											usleep(250000);
										}
										elseif($priceinput==&#039;middlehundred&#039;)
										{
											$cat1=1000;
											$cat2=5000;
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE price>"&#039;.$cat1.&#039;" AND price<"&#039;.$cat2.&#039;" AND messid!="0"&#039;);
											usleep(250000);
										}
										elseif($priceinput==&#039;overhundred&#039;)
										{
											$cat1=5000;
											mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE price>"&#039;.$cat1.&#039;" AND messid!="0"&#039;);
											usleep(250000);
										}
									}
								}
								else
								{
									$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT price FROM '.$tabprice.' WHERE messid!="0" AND price!="0"&#039;);
									$con1=mysqli_num_rows($query1);
									
									$price3=[];
									
									for($i1=0;$i1<$con1;$i1++)
									{
										mysqli_data_seek($query1, $i1);
										$row1[$i1]=mysqli_fetch_row($query1);
									
									
										if($row1[$i1][0]<1000 && $row1[$i1][0]>0)
										{
											$putprice=&#039;lesshundred&#039;;
										}
										if($row1[$i1][0]>=1000 && $row1[$i1][0]<=5000)
										{
											$putprice=&#039;middlehundred&#039;;
										}
										if($row1[$i1][0]>5000)
										{
											$putprice=&#039;overhundred&#039;;
										}
										
										if(in_array($putprice, $price3)==FALSE)
										{
											$price3[]=$putprice;
										}
									}
									
									if(in_array($priceinput, $price3)==FALSE)
									{
									
										$query2=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabmain%"&#039;);
										$con2=mysqli_num_rows($query2);
										
									
										for($i=0;$i<$con2;$i++)
										{
											mysqli_data_seek($query2, $i);
											$row2[$i]=mysqli_fetch_row($query2);
											$table[$i]=$row2[$i][0];	
									
											if($priceinput==&#039;lesshundred&#039;)
											{
												$cat1=1000;
												mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE price<"&#039;.$cat1.&#039;" AND price>"0" AND messid!="0"&#039;);
												usleep(250000);
											}
											elseif($priceinput==&#039;middlehundred&#039;)
											{
												$cat1=1000;
												$cat2=5000;
												mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE price>"&#039;.$cat1.&#039;" AND price<"&#039;.$cat2.&#039;" AND messid!="0"&#039;);
												usleep(250000);
											}
											elseif($priceinput==&#039;overhundred&#039;)
											{
												$cat1=5000;
												mysqli_query($con_sql2, &#039;INSERT INTO '.$tabprice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$table[$i].&#039; WHERE price>"&#039;.$cat1.&#039;" AND messid!="0"&#039;);
												usleep(250000);
											}
										}
									}
								
								}
								
								$merge=$bot->cmd_filter_buy_price();
								usleep(100000);
								
								$merge[] = [["text" => "🔀Сбросить фильтры", "callback_data" => "resetfilters_default_buy"]];
								$merge[] = [["text" => "⬅️Назад", "callback_data" => "buy_back_filter_price"], ["text" => "⤴️Выйти", "callback_data" => "buy_exit_filter_type"]];
								
								if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
								{
									$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
									$bot->api->answerCallbackQuery($callback_query_id);
								}
								$text = &#039;Вы выбрали стоимость товара <b>'.$buttext.'</b>.'.PHP_EOL.'Можете выбрать еще одну или нажать кнопку <b>Назад</b> для применения выбранных фильтров.&#039;.$bot->pre.&#039;&#039;;
								
								$bot->api->editMessageText([
								&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
								&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
								&#039;text&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
								]);
								usleep(100000);
								
							}
		
						}';
						file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
					}
				
				}
				
				$u++;
			}	
			
			$merge[]=$put1;
			unset($put1);
			
		}
		

		$insert='}';
		file_put_contents($include, $insert,FILE_APPEND);
		
		
		return $merge;
	}



/////
	public function callback_buy_back_filter_price()
	{		
		$con_sql2=$this->cmd_sql();
		
		$tabprice='tabprice'.$this->api->chatId.'';
		$tabservice='tabservice'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservice.' LIMIT 1'))
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabprice.' LIMIT 1'))
			{
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT price FROM '.$tabprice.' WHERE messid!="0" AND price!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				$buttextarray=[];
				
				for($i1=0;$i1<$con2;$i1++)
				{
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					if($row2[$i1][0]<1000 && $row2[$i1][0]>0)
					{
						$buttext='До 1000 грн';
					}
					if($row2[$i1][0]>=1000 && $row2[$i1][0]<=5000)
					{
						$buttext='От 1000 до 5000 грн';
					}
					if($row2[$i1][0]>5000)
					{
						$buttext='Свыше 5000 грн';
					}
					
					if(in_array($buttext, $buttextarray)==FALSE)
					{
						$buttextarray[]=$buttext;
					}
				}
				
				
				$cnt=count($buttextarray);
				
				for($i1=0;$i1<$cnt;$i1++)
				{
					if($i1==0)
					{
						$addtext=$buttextarray[$i1];
					}
					else
					{
						$addtext = $addtext . ', '.$buttextarray[$i1].'';
					}
				}
		
				
				if(preg_match('/,/', $addtext))
				{
					$text='Вы выбрали стоимость товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой стоимости товара.'.$this->pre.'';
				}
				else
				{
					$text='Вы выбрали стоимость товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой стоимости товара.'.$this->pre.'';
				}
				
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabprice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabprice.'');
				usleep(250000);
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);

			}
			else
			{
				$text='Вы вернулись в раздел Фильтр меню Купить товар.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabprice.' LIMIT 1'))
			{
				
				$query2=mysqli_query($con_sql2, 'SELECT DISTINCT price FROM '.$tabprice.' WHERE messid!="0"');
				$con2=mysqli_num_rows($query2);
				$addtext="";
				$buttextarray=[];
				for($i1=0;$i1<$con2;$i1++)
				{
					
					mysqli_data_seek($query2, $i1);
					$row2[$i1]=mysqli_fetch_row($query2);
				
					
			
					if($row2[$i1][0]<1000 && $row2[$i1][0]>0)
					{
						$buttext='До 1000 грн';
					}
					if($row2[$i1][0]>=1000 && $row2[$i1][0]<=5000)
					{
						$buttext='От 1000 до 5000 грн';
					}
					if($row2[$i1][0]>5000)
					{
						$buttext='Свыше 5000 грн';
					}
					
					if(in_array($buttext, $buttextarray)==FALSE)
					{
						$buttextarray[]=$buttext;
					}
					
				}
				
				
				$cnt=count($buttextarray);
				for($i1=0;$i1<$cnt;$i1++)
				{
					if($i1==0)
					{
						$addtext=$buttextarray[$i1];
					}
					else
					{
						$addtext = $addtext . ', '.$buttextarray[$i1].'';
					}
				}
		
				
				if(preg_match('/,/', $addtext))
				{
					$text='Вы выбрали стоимость товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой стоимости товара.'.$this->pre.'';
					
				}
				else
				{
					$text='Вы выбрали стоимость товара <b>'.$addtext.'</b>.'.PHP_EOL.'Выбирите другой параметр или нажмите <b>Сбросить фильтры</b> для выбора новой стоимости товара.'.$this->pre.'';
					
				}
				
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservice.' LIKE '.$tabprice.'');
				usleep(250000);
				mysqli_query($con_sql2, 'INSERT INTO '.$tabservice.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM '.$tabprice.'');
				usleep(250000);
				/* mysqli_query($con_sql2, 'DROP TABLE '.$tabprice.'');
				usleep(250000); */
				
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			else
			{
				$text='Вы вернулись в раздел Фильтр меню Купить товар.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
			}
			
			
		}
		
		
	}
	

///////////////////////////////////////////////END FILTER/////////////////////////////////////////////////
/////
	public function callback_filter_buy_back_main()
	{

		$text='Вы вернулись в главное меню <b>Купить товар</b>.'.PHP_EOL.'Можете нажать кнопку <b>Показать</b> для отображения результатов.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_buy_default']);
	}	

/////
	public function callback_filter_buy_exit_main()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcat'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabgender'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcond'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
	
		$tab='tabprice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		
		$tab='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		


		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		
	
	}
	

/////
	public function callback_filter_resetfilters_buy()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tab='tabtype'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcat'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabgender'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		$tab='tabcond'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
	
		$tab='tabprice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		
		$tab='tabservice'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1'))
		{
			$query1=mysqli_query($con_sql2, 'DROP TABLE '.$tab.'');
			usleep(250000);	
		}
		
		
		$text='<b>Ваши фильтры сброшены!</b>'.PHP_EOL.''.PHP_EOL.'Вы находитесь в подразделе <b>Фильтр</b> раздела <b>Купить товар</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_buy_filter']);
	}
	



///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////SELL//////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
	public function callback_default_sell()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceapproved='tabserviceapproved';
		$tabservicewant='tabservicewant';
		$tabserviceusers='tabserviceusers';
		$tabservicebanned='tabservicebanned';
		$tabservicedenied='tabservicedenied';
		
		
		
		
		if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt')))
		{
		
		
			$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
			//{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
				usleep(100000);
			//}
			
			$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
			//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
			//{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
				usleep(100000);
			//}
			
			$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
			//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
			//{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
				usleep(100000);
			//}
			
			if($this->cmd_isadmin())
			{
				$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
				usleep(100000);
			}
			
			$text='Вы находитесь в меню <b>Продать</b>. <b>Выберите, что Вы хотите сделать</b>👇'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_sell']);
		}
		elseif(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersall.txt')))
		{
			if($this->cmd_sql_searchchatidtable($tabservicedenied, $this->api->chatId))
			{
				$text='К сожалению, Вам <b>было отказано</b> в праве размещать объявления в канале!'.$this->pre.'';
				//$this->callback_inline_close($this->api->messageid);
				$this->callbackAnswer( $text, $this->keyboards['inline_default']);
				
			}
			elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId))
			{
				$text='Вы <b>уже отправили запрос админу</b> на получение права размещать объявления в канале! Вы получите служебное уведомление о результатах.'.$this->pre.'';
				//$this->callbackAnswer3( $text );
				$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			}
			else
			{
				$text='Чтобы размещать объявления в канале, Вам необходимо <b>подтверждение админа.</b>'.PHP_EOL.'Вы можете отправить запрос админу, нажав кнопку 📣<b>Отправить запрос</b> снизу👇'.$this->pre.'';
				
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_want_user']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
			}
		}

	}
	
////	
	public function callback_back_sell_main()
	{
		if($this->cmd_isadmin())
		{
			$text='Вы вернулись в <b>Главное меню</b>.'.$this->pre.'';
		
			$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			usleep(100000);
		}
		else
		{
			$text='Вы вернулись в <b>Главное меню</b>.'.$this->pre.'';
		
			$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			usleep(100000);
		}
	}
	
////	
	public function callback_exit_sell_main()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}
		
		
		if($this->cmd_isadmin())
		{
			
			$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);

			
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		
		
	}	
	
	
	
//////////////////////////////////////////////////////////////ADD/////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////ADD TYPE//////////////////////////////////////////////////////////////////////////	
/* 	public function callback_sell_add()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		
		$tabservicetime='tabservicetime'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetime.'');
		usleep(100000);
		
		$tabservicetemp='tabservicetemp'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetemp.'');
		usleep(100000);
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}
			
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1')==FALSE)
		{
			$query1='CREATE TABLE '.$tab.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(15), cat VARCHAR(15), gender VARCHAR(10), brand VARCHAR(30), size VARCHAR(30), price NUMERIC(7,0), alt VARCHAR(512), pic VARCHAR(512), date VARCHAR(11), time VARCHAR(11), messid VARCHAR(15), cond VARCHAR(10), chatid VARCHAR(15)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';
			$result1=mysqli_query($con_sql2, $query1);
			usleep(250000);
			
			$queue='INSERT INTO '.$tab.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) VALUES ("0","0","0","0","0","0","0","0","0","0","0","0","0")';
			$result=mysqli_query($con_sql2, $queue);
			usleep(100000);
		}
		else
		{
			if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
			{
				
				$queue='INSERT INTO '.$tab.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) VALUES ("0","0","0","0","0","0","0","0","0","0","0","0","0")';
				$result=mysqli_query($con_sql2, $queue);
				usleep(100000);
			}
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
				usleep(100000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
					usleep(100000);
				
				if($row[$con-1][8]!=="0")
				{
					$queue='INSERT INTO '.$tab.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) VALUES ("0","0","0","0","0","0","0","0","0","0","0","0","0")';
					$result=mysqli_query($con_sql2, $queue);
					usleep(100000);
				}
				
			}
			
		}


		$merge=$this->cmd_sell_add_type();
		usleep(100000);
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_type'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_type']];
		$text='📂Укажите <b>категорию</b>👇';
		$this->callbackAnswer( $text, $merge);
	
	} */
	


	public function callback_sell_add()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
		usleep(100000);

		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
		usleep(100000);
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
		usleep(100000);
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1')==FALSE)
		{
			$query1='CREATE TABLE '.$tab.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(15), cat VARCHAR(15), gender VARCHAR(10), brand VARCHAR(30), size VARCHAR(30), price NUMERIC(7,0), alt VARCHAR(512), pic VARCHAR(512), date VARCHAR(11), time VARCHAR(11), messid VARCHAR(15), cond VARCHAR(10), chatid VARCHAR(15)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';
			$result1=mysqli_query($con_sql2, $query1);
			usleep(100000);
			
			$queue='INSERT INTO '.$tab.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) VALUES ("0","0","0","0","0","0","0","0","0","0","0","0","0")';
			$result=mysqli_query($con_sql2, $queue);
			usleep(100000);
		}
		else
		{
			if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id LIKE "%" LIMIT 1'))==0)
			{
				
				$queue='INSERT INTO '.$tab.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) VALUES ("0","0","0","0","0","0","0","0","0","0","0","0","0")';
				$result=mysqli_query($con_sql2, $queue);
				usleep(100000);
			}
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
				usleep(100000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
					usleep(100000);
				
				if($row[$con-1][8]!=="0")
				{
					$queue='INSERT INTO '.$tab.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) VALUES ("0","0","0","0","0","0","0","0","0","0","0","0","0")';
					$result=mysqli_query($con_sql2, $queue);
					usleep(100000);
				}
				
			}
			
		}


		$merge=$this->cmd_sell_add_type();
		usleep(100000);
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_type'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_type']];
		
		$text='📂Укажите <b>категорию</b>👇'.$this->pre.'';
		//$text='<pre>                                                                                                       ❗️</pre>';
		$this->callbackAnswer( $text, $merge);
	
	}
	

/////
	public function cmd_sell_add_type()
	{
		
		$arraybuttons=$this->arraybuttonstype;
		$arraycallback=$this->arraycallbacktype;
	
		$cnt=count($arraybuttons);
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
			
		$u=0;
		$merge=[];
			
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				
				$buttext=''.$arraybuttons[$u].'';
				$put[]=["text" => "$buttext", "callback_data" => 'sell_add_type_'.$this->api->chatId.'_'.$arraycallback[$u].''];
				
				if(preg_match('/callback_sell_add_type_'.$this->api->chatId.'_'.$arraycallback[$u].'/', file_get_contents($include))==FALSE)
				{
					$insert='
					public function callback_sell_add_type_'.$this->api->chatId.'_'.$arraycallback[$u].'()
					{	
				
						$bot = new TestBot;
						$bot->api->getWebhookUpdate();
							
						$con_sql2=$bot->cmd_sql();
						$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
						
						$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE id LIKE "%" ORDER by id ASC&#039;);
						$con=mysqli_num_rows($query);
						usleep(100000);
				
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						

						$query1=&#039;UPDATE &#039;.$tabmain.&#039; SET type = REPLACE(type, "&#039;.$row[$con-1][1].&#039;", "'.$arraycallback[$u].'") WHERE id="&#039;.$row[$con-1][0].&#039;"&#039;; 
						$result1=mysqli_query($con_sql2, $query1);
						
						if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
						{
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							$bot->api->answerCallbackQuery($callback_query_id);
						}
								
						//$bot->cmd_sell_add_cat_main("'.$arraybuttons[$u].'", "'.$arraycallback[$u].'");
						$bot->cmd_sell_add_cat_main();

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


////	
	public function callback_back_sell_add_type()
	{
	
		$text='Вы вернулись в раздел <b>Продать</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_sell']);

	}
	
////	
	public function callback_exit_sell_add_type()
	{

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}
			
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}

	}



///////////////////////////////////////////////////////ADD CAT//////////////////////////////////////////////////////////////////////////

////
	//public function cmd_sell_add_cat_main($arraybuttons, $arraycallback)
	public function cmd_sell_add_cat_main()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
			
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
		
		
		$type=$this->convert_rus($row[$con-1][1]);
		
		$text='Вы выбрали категорию <b>'.$type.'</b>.'.PHP_EOL.''.PHP_EOL.'Укажите <b>вид</b>👇'.$this->pre.'';
		
		$merge=$this->cmd_sell_add_cat_cat($row[$con-1][1]);
		usleep(100000);
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_cat'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_cat']];
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge] ),
		]);
		
	}
	
	
	
public function cmd_sell_add_cat_cat($arraycallback1)
	{
		if($arraycallback1=='clothes')
		{
			$arraybuttons=$this->arraybuttonsclothes;
			$arraycallback=$this->arraycallbackclothes;
		}
		elseif($arraycallback1=='shoes')
		{
			$arraybuttons=$this->arraybuttonsshoes;
			$arraycallback=$this->arraycallbackshoes;
		}
		elseif($arraycallback1=='accessories')
		{
			$arraybuttons=$this->arraybuttonsaccessories;
			$arraycallback=$this->arraycallbackaccessories;
		}
		elseif($arraycallback1=='toys')
		{
			$arraybuttons=$this->arraybuttonstoys;
			$arraycallback=$this->arraycallbacktoys;
		}
		elseif($arraycallback1=='bags')
		{
			$arraybuttons=$this->arraybuttonsbags;
			$arraycallback=$this->arraycallbackbags;
		}
		elseif($arraycallback1=='cosmetics')
		{
			$arraybuttons=$this->arraybuttonscosmetics;
			$arraycallback=$this->arraycallbackcosmetics;
		}
		elseif($arraycallback1=='other1')
		{
			$arraybuttons=$this->arraybuttonsother;
			$arraycallback=$this->arraycallbackother;
		}
		
	
		$cnt=count($arraybuttons);
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
			
		$u=0;
		$merge=[];
			
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				
				$buttext=''.$arraybuttons[$u].'';
				$put[]=["text" => "$buttext", "callback_data" => 'sell_add_cat_'.$this->api->chatId.'_'.$arraycallback[$u].''];
				
				if(preg_match('/callback_sell_add_cat_'.$this->api->chatId.'_'.$arraycallback[$u].'/', file_get_contents($include))==FALSE)
				{
					$insert='
					public function callback_sell_add_cat_'.$this->api->chatId.'_'.$arraycallback[$u].'()
					{	
				
						$bot = new TestBot;
						$bot->api->getWebhookUpdate();
						
						$con_sql2=$bot->cmd_sql();
						$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
						
						$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE id LIKE "%" ORDER by id ASC&#039;);
						$con=mysqli_num_rows($query);
						usleep(100000);
				
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
						if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
						{
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							$bot->api->answerCallbackQuery($callback_query_id);
						}
						
						$query1=&#039;UPDATE &#039;.$tabmain.&#039; SET cat = REPLACE(cat, "&#039;.$row[$con-1][2].&#039;", "'.$arraycallback[$u].'") WHERE id="&#039;.$row[$con-1][0].&#039;"&#039;; 
						mysqli_query($con_sql2, $query1);


						//$bot->cmd_sell_add_gender_main("'.$arraybuttons[$u].'", "'.$arraycallback[$u].'");
						$bot->cmd_sell_add_gender_main();

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
	
	
////	
	public function callback_back_sell_add_cat()
	{
		
		$merge=$this->cmd_sell_add_type();
		usleep(100000);
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_type'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_type']];
		$text='Вы вернулись к выбору 📂<b>категории</b>.'.PHP_EOL.''.PHP_EOL.'Выбирите 📂<b>категорию</b>👇'.$this->pre.'';
		$this->callbackAnswer( $text, $merge);
		
	}
	
////	
	public function callback_exit_sell_add_cat()
	{
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}

		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}		
			
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
	}
	



///////////////////////////////////////////////////////ADD GENDER//////////////////////////////////////////////////////////////////////////	
/////
	//public function cmd_sell_add_gender_main($arraybuttons, $arraycallback)
	public function cmd_sell_add_gender_main()
	{
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
		
		$cat=$this->convert_rus($row[$con-1][2]);
		$text='Вы выбрали раздел <b>'.$cat.'</b>.'.PHP_EOL.''.PHP_EOL.'Укажите <b>пол</b>👇'.$this->pre.'';
		
		$merge=$this->cmd_sell_add_gender_gender($cat);
		usleep(100000);
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_gender'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_gender']];
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge] ),
		]);
		
		
	}
	
/////	
	public function cmd_sell_add_gender_gender($input)
	{
		
		$arraybuttons=$this->arraybuttonsgender;
		$arraycallback=$this->arraycallbackgender;
		
		if($input=="Мягкие игрушки")
		{
			$arraybuttons=$this->arraybuttonsgender1;
			$arraycallback=$this->arraycallbackgender1;
		}
		
		$cnt=count($arraybuttons);
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
			
		$u=0;
		$merge=[];
			
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				
				$buttext=''.$arraybuttons[$u].'';
				$put[]=["text" => "$buttext", "callback_data" => 'sell_add_gender_'.$this->api->chatId.'_'.$arraycallback[$u].''];
				
				if(preg_match('/callback_sell_add_gender_'.$this->api->chatId.'_'.$arraycallback[$u].'/', file_get_contents($include))==FALSE)
				{
					$insert='
					public function callback_sell_add_gender_'.$this->api->chatId.'_'.$arraycallback[$u].'()
					{	
				
						$bot = new TestBot;
						$bot->api->getWebhookUpdate();

						$con_sql2=$bot->cmd_sql();
						$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
						
						$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE id LIKE "%" ORDER by id ASC&#039;);
						$con=mysqli_num_rows($query);
						usleep(100000);
				
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
						$query1=&#039;UPDATE &#039;.$tabmain.&#039; SET gender = REPLACE(gender, "&#039;.$row[$con-1][3].&#039;", "'.$arraycallback[$u].'") WHERE id="&#039;.$row[$con-1][0].&#039;"&#039;; 
						mysqli_query($con_sql2, $query1);
						
						if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
						{
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							$bot->api->answerCallbackQuery($callback_query_id);
						}
						
						//$bot->cmd_sell_add_cond_main("'.$arraybuttons[$u].'", "'.$arraycallback[$u].'");
						$bot->cmd_sell_add_cond_main();

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
	
	
	
////	
	public function callback_back_sell_add_gender()
	{
	
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$this->cmd_sell_add_cat_main();
		
	}
	
////	
	public function callback_exit_sell_add_gender()
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}

		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}			
			
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}
	
	
	
	
///////////////////////////////////////////////////////ADD COND//////////////////////////////////////////////////////////////////////////	
/////
	//public function cmd_sell_add_cond_main($arraybuttons, $arraycallback)
	public function cmd_sell_add_cond_main()
	{
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
			
		$gender=$this->convert_rus($row[$con-1][3]);
		
		$text='Вы выбрали пол товара <b>'.$gender.'</b>.'.PHP_EOL.''.PHP_EOL.'Укажите <b>состояние товара</b>👇'.$this->pre.'';
		
		$merge=$this->cmd_sell_add_cond_cond();
		usleep(100000);
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_cond'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_cond']];
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge] ),
		]);
	
	}
	
/////	
	public function cmd_sell_add_cond_cond()
	{
		
		
		$arraybuttons=$this->arraybuttonscond;
		$arraycallback=$this->arraycallbackcond;
	
		$cnt=count($arraybuttons);
		$maxbuttons=2;
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
			unset($getinclude[array_key_last($getinclude)]);
			file_put_contents($include, $getinclude);
		}
			
		$u=0;
		$merge=[];
			
		for($i1=0;$i1<$ceil;$i1++)
		{
			$put=[];
			for($i2=0;$i2<$maxbuttons;$i2++)
			{	
				
				$buttext=''.$arraybuttons[$u].'';
				$put[]=["text" => "$buttext", "callback_data" => 'sell_add_cond_'.$this->api->chatId.'_'.$arraycallback[$u].''];
				
				if(preg_match('/callback_sell_add_cond_'.$this->api->chatId.'_'.$arraycallback[$u].'/', file_get_contents($include))==FALSE)
				{
					$insert='
					public function callback_sell_add_cond_'.$this->api->chatId.'_'.$arraycallback[$u].'()
					{	
				
						$bot = new TestBot;
						$bot->api->getWebhookUpdate();

						$con_sql2=$bot->cmd_sql();
						$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
						
						$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE id LIKE "%" ORDER by id ASC&#039;);
						$con=mysqli_num_rows($query);
						usleep(100000);
				
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						usleep(100000);
						
						$query1=&#039;UPDATE &#039;.$tabmain.&#039; SET cond = REPLACE(cond, "&#039;.$row[$con-1][12].&#039;", "'.$arraycallback[$u].'") WHERE id="&#039;.$row[$con-1][0].&#039;"&#039;; 
						mysqli_query($con_sql2, $query1);
						
						if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
						{
							$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
							$bot->api->answerCallbackQuery($callback_query_id);
						}
						
						//$bot->cmd_sell_add_brand_main("'.$arraybuttons[$u].'");
						$bot->cmd_sell_add_brand_main();
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
	
	
	
////	
	public function callback_back_sell_add_cond()
	{
	
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$this->cmd_sell_add_gender_main();
	}
	
////	
	public function callback_exit_sell_add_cond()
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}			
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}
	
///////////////////////////////////////////////////////ADD BRAND//////////////////////////////////////////////////////////////////////////
	public function cmd_sell_add_brand_main()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabserviceadd'.$this->api->chatId.'';	
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' LIMIT 1')==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tab.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(10)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(100000);
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tab.' (info) VALUES ("brand")');
			usleep(100000);
		}
		else
		{
			if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE id="1" LIMIT 1'))==0)
			{
				mysqli_query($con_sql2, 'INSERT INTO '.$tab.' (info) VALUES ("brand")');
				usleep(100000);
			}
			else
			{
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id="1"');
				usleep(100000);
				$con=mysqli_num_rows($query);
				
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				usleep(100000);
								
				$query1='UPDATE '.$tab.' SET info = REPLACE(info, "'.$row[0][1].'", "brand") WHERE id="'.$row[0][0].'"'; 
				mysqli_query($con_sql2, $query1);
			}
			
		}
		
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
			
		$cond=$this->convert_rus($row[$con-1][12]);
		
		$text='Укажите <b>название бренда</b> (на английском языке, как указано на этикетке товара) отправив сообщение👇'.$this->pre.'';
		
		$merge=[];
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_brand'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_brand']];
				
			
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	

		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);

			
		/* $text='Укажите <b>название бренда</b> (на английском языке, как указано на этикетке товара) в строке сообщения👇';
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите название бренда'] ),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(100000); */
	
	}

/////
	public function cmd_sell_add_brand()
	{
	
		$con_sql2=$this->cmd_sql();
		$tabmain='tabmain'.$this->api->chatId.'';
		
		$input=$this->api->body["message"]["text"];
		if(strlen($input)>30)
		{
			
			$text='Вы ввели слишком длинный текст. Максимальная длина 30 символов.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

			
			$this->cmd_sell_add_brand_main();
		}
		else
		{
			
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
			$con=mysqli_num_rows($query);
			usleep(100000);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			usleep(100000);
			
			$query1='UPDATE '.$tabmain.' SET brand = REPLACE(brand, "'.$row[$con-1][4].'", "'.$this->api->body["message"]["text"].'") WHERE id="'.$row[$con-1][0].'"'; 
			mysqli_query($con_sql2, $query1);
			
			$this->cmd_sell_add_size_main();
		}
	
	}

////	
	public function callback_back_sell_add_brand()
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$this->cmd_sell_add_cond_main();
	}
	
////	
	public function callback_exit_sell_add_brand()
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}	
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}




///////////////////////////////////////////////////////ADD Size//////////////////////////////////////////////////////////////////////////
/////
	public function cmd_sell_add_size_main()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabserviceadd'.$this->api->chatId.'';	
		$tabmain='tabmain'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id="1"');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
						
		$query1='UPDATE '.$tab.' SET info = REPLACE(info, "'.$row[$con-1][1].'", "size") WHERE id="'.$row[$con-1][0].'"'; 
		mysqli_query($con_sql2, $query1);
		

		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
		
		
		$brand=$row[$con-1][4];
		
		
		$merge=[];
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_size'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_size']];
		
		$text='Вы указали бренд <b>'.$brand.'</b>.'.PHP_EOL.''.PHP_EOL.'Укажите <b>размер</b> (желательно также указать реальные замеры в см) отправив сообщение👇'.$this->pre.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		
		/* $text='Укажите <b>размер товара</b>';
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите размер'] ),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

		
		
	}

/////
public function cmd_sell_add_size()
	{
	
		$con_sql2=$this->cmd_sql();
		$tabmain='tabmain'.$this->api->chatId.'';
		$input=$this->api->body["message"]["text"];
		
		if(strlen($input)>30)
		{
			
			$text='Вы ввели слишком длинный текст. Максимальная длина 30 символов.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

			
			$this->cmd_sell_add_size_main();
		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
			$con=mysqli_num_rows($query);
			usleep(100000);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			usleep(100000);
			
			$query1='UPDATE '.$tabmain.' SET size = REPLACE(size, "'.$row[$con-1][5].'", "'.$this->api->body["message"]["text"].'") WHERE id="'.$row[$con-1][0].'"'; 
			mysqli_query($con_sql2, $query1);
			
			$this->cmd_sell_add_price_main();
		}
		
		
		
		
	}

////	
	public function callback_back_sell_add_size()
	{
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_sell_add_brand_main();
	}
	
////	
	public function callback_exit_sell_add_size()
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}	
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}



///////////////////////////////////////////////////////ADD Price//////////////////////////////////////////////////////////////////////////
/////
	public function cmd_sell_add_price_main()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabserviceadd'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
						
		$query1='UPDATE '.$tab.' SET info = REPLACE(info, "'.$row[$con-1][1].'", "price") WHERE id="'.$row[$con-1][0].'"'; 
		mysqli_query($con_sql2, $query1);
		
	
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
		
		
		$size=$row[$con-1][5];
		
		$text='Вы указали размер <b>'.$size.'</b>.'.PHP_EOL.''.PHP_EOL.'Укажите <b>стоимость товара</b> в UAH (гривне) в строке сообщения (допускаются только целые числа)👇'.$this->pre.'';
		$merge=[];
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_price'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_price']];
			
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		/* $text='Укажите <b>стоимость товара</b>';
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите стоимость'] ),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

		
		
	}

/////
public function cmd_sell_add_price()
	{
	
		$con_sql2=$this->cmd_sql();
		$tabmain='tabmain'.$this->api->chatId.'';
		$textmessage=$this->api->textmessage;
		
		if(preg_match('/\D/', $textmessage))
		{
			$merge=[];
			$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_price'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_price']];
			
			/* $text='Укажите <b>стоимость товара</b>';
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите стоимость'] ),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
			$text='Вы указали неправильные данные. Допускаются только цифры.'.PHP_EOL.''.PHP_EOL.'Укажите <b>стоимость товара</b> в UAH (гривне) в строке сообщения (допускаются только целые числа)👇'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

		}
		elseif(strlen($textmessage)>7)
		{
			$merge=[];
			$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_price'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_price']];
			
			/* $text='Укажите <b>стоимость товара</b>';
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите стоимость'] ),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
			$text='Вы указали слишком большое число, максимально допускается <b>семизначное число!</b>'.PHP_EOL.''.PHP_EOL.'Укажите <b>стоимость товара</b> в UAH (гривне) в строке сообщения (допускаются только целые числа)👇'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
			$con=mysqli_num_rows($query);
			usleep(100000);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			usleep(100000);
			
			$query1='UPDATE '.$tabmain.' SET price = REPLACE(price, "'.$row[$con-1][6].'", "'.$this->api->body["message"]["text"].'") WHERE id="'.$row[$con-1][0].'"'; 
			mysqli_query($con_sql2, $query1);
			
			$this->cmd_sell_add_alt_main();
		}

	}

////	
	public function callback_back_sell_add_price()
	{

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_sell_add_size_main();
	}
	
////	
	public function callback_exit_sell_add_price()
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}




/////
	public function cmd_sell_add_alt_main()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabserviceadd'.$this->api->chatId.'';	
		$tabmain='tabmain'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
						
		$query1='UPDATE '.$tab.' SET info = REPLACE(info, "'.$row[$con-1][1].'", "alt") WHERE id="'.$row[$con-1][0].'"'; 
		mysqli_query($con_sql2, $query1);
		
	
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			usleep(100000);
				
		$price=$row[$con-1][6];

		$text='Вы указали стоимость <b>'.$price.' UAH</b>.'.PHP_EOL.''.PHP_EOL.'Укажите <b>подробное описание товара</b> отправив сообщение👇'.$this->pre.'';
		
		$merge=[];
		$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_alt'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_alt']];
		
			
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		/* $text='Укажите <b>описание товара</b>';
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Укажите описание'] ),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		
	}

/////
public function cmd_sell_add_alt()
	{
	
		$con_sql2=$this->cmd_sql();
		$tabmain='tabmain'.$this->api->chatId.'';
		$input=$this->api->body["message"]["text"];
		
		if(strlen($input)>512)
		{
			
			$text='Вы ввели слишком длинный текст. Максимальная длина 512 символов.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);

			$this->cmd_sell_add_alt_main();
		}
		else
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
			$con=mysqli_num_rows($query);
			usleep(100000);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			usleep(100000);
			
			$query1='UPDATE '.$tabmain.' SET alt = REPLACE(alt, "'.$row[$con-1][7].'", "'.$this->api->body["message"]["text"].'") WHERE id="'.$row[$con-1][0].'"'; 
			mysqli_query($con_sql2, $query1);
			
			$this->cmd_sell_add_photo_main();
		}

	}

////	
	public function callback_back_sell_add_alt()
	{
			
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->cmd_sell_add_price_main();
	}
	
////	
	public function callback_exit_sell_add_alt()
	{
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}	
		
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtempphoto.'');
			usleep(100000);
		//}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		//}	
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
	}
	
	
	
	









/////	
	public function callback_admin_ask_channel_see()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$text1=$this->api->textmessage;
		
		preg_match_all('/\(.*\)/', $text1, $out1);
		
		$phone=preg_replace('/\(/', '', $out1[0][0]);
		$phone=preg_replace('/\)/', '', $phone);
		$phone=$this->clean($phone);
		
		$userchatid=$this->cmd_user_get_chatid_phone($phone);
		
		$tabmain='tabmain'.$userchatid.'';
		
		$fio=$this->cmd_user_get_fio($userchatid);
		
		preg_match_all('/№.*для/', $text1, $out2);
		
		$record=preg_replace('/№/', '', $out2[0][0]);
		$record=preg_replace('/для/', '', $record);
		$record=$this->clean($record);
		
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id="'.$record.'"');
		usleep(100000);
		$con=mysqli_num_rows($query);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		usleep(100000);
		
		
		for($i=0;$i<$con;$i++)
		{
		
			/* $text='<b>Объявление №'.$record.'</b>';
			
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000); */
			
			$type=$this->convert_rus($row[0][1]);
			$cat=$this->convert_rus($row[0][2]);
			$gender=$this->convert_rus($row[0][3]);
			$cond=$this->convert_rus($row[0][12]);
						
			$caption='<b>Объявление: №'.$record.'</b>'.PHP_EOL.''.PHP_EOL.'📖Категория: <b>'.$type.'</b>'.PHP_EOL.'🧾Вид: <b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: <b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®Бренд: <b>'.$row[0][4].'</b>'.PHP_EOL.'↕️Размер: <b>'.$row[0][5].'</b>'.PHP_EOL.'💵Цена: <b>'.$row[0][6].'</b>'.PHP_EOL.'📋Описание: '.$row[0][7].''.PHP_EOL.''.PHP_EOL.'Пользователь: <b>'.$fio.' ('.$phone.')</b>';
			
			$photo=$row[0][8];
			
			if(preg_match('/;/', $photo)==FALSE)
			{
				$this->api->sendPhoto([
				'photo' => $photo,
				'caption' => $caption,
				'disable_notification' => TRUE,
				'parse_mode' => "HTML"
				]);
				usleep(250000);
			
			}
			else
			{
				$media=[];
				$temp=explode(';', $photo);
				$cnt=count($temp);
				for($o=0;$o<$cnt;$o++)
				{
				
				
					if($o==0)
					{
						$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
					}
					else
					{
						$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
					}
			
					$media[$o]=$put;
				}
				
				
				$this->api->sendMediaGroup([
				'media' => json_encode($media),
				]);
				usleep(350000);
			}
			
		
		}

		$text='Пользователь 👤<b>'.$fio.' ('.$phone.')</b> добавил объявление <b>№'.$record.'</b> для размещения в канале. Что вы хотите сделать с данным объявлением?'.$this->pre.'';
		
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin_channel']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000);
	
	}


/////	
	public function callback_admin_ask_channel_delete()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$text1=$this->api->textmessage;
		
		preg_match_all('/\(.*\)/', $text1, $out1);
		
		$phone=preg_replace('/\(/', '', $out1[0][0]);
		$phone=preg_replace('/\)/', '', $phone);
		$phone=$this->clean($phone);
		
		$userchatid=$this->cmd_user_get_chatid_phone($phone);
		
		$tabmain='tabmain'.$userchatid.'';
		
		$fio=$this->cmd_user_get_fio($userchatid);
		
		preg_match_all('/№.*для/', $text1, $out2);
		
		$record=preg_replace('/№/', '', $out2[0][0]);
		$record=preg_replace('/для/', '', $record);
		$record=$this->clean($record);
		
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id="'.$record.'"');
		usleep(100000);
		$con=mysqli_num_rows($query);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		usleep(100000);
		
		
		$query=mysqli_query($con_sql2, 'DELETE FROM '.$tabmain.' WHERE id="'.$record.'"');
		usleep(100000);
		
		$text='Выбранное объявление <b>№'.$record.'</b> пользователя 👤<b>'.$fio.' ('.$phone.')</b> успешно удалено и не будет размещено в канале.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
		
		/* if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000); */
		
		$text2='К сожалению, Ваше объявление <b>№'.$record.' было удалено</b> после модерации и <b>не будет размещено в канале</b>.'.$this->pre.'';
			
		$this->api->sendMessage([

			'chat_id' => $userchatid,
			'text' => $text2,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
			'parse_mode' => "HTML",
			]);
		usleep(100000);
	}


/////	
	public function callback_admin_ask_channel_send()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$text1=$this->api->textmessage;
		
		preg_match_all('/\(.*\)/', $text1, $out1);
		
		$phone=preg_replace('/\(/', '', $out1[0][0]);
		$phone=preg_replace('/\)/', '', $phone);
		$phone=$this->clean($phone);
		
		$userchatid=$this->cmd_user_get_chatid_phone($phone);
		
		$tabserviceask='tabserviceask'.$userchatid.'';
		$tabmain='tabmain'.$userchatid.'';
		
		$fio=$this->cmd_user_get_fio($userchatid);
		
		preg_match_all('/№.*для/', $text1, $out2);
		
		$record=preg_replace('/№/', '', $out2[0][0]);
		$record=preg_replace('/для/', '', $record);
		$record=$this->clean($record);
		
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id="'.$record.'"');
		usleep(100000);
		$con=mysqli_num_rows($query);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		usleep(100000);
		
		$mainchannel=$this->mainchannel;
		
		
		/* $text='❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️';
		$this->api->sendMessage([
		'chat_id' => $mainchannel,
		'text' => $text,
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> 'HTML'
		]); */
		
		$type=$this->convert_rus($row[0][1]);
		$cat=$this->convert_rus($row[0][2]);
		$gender=$this->convert_rus($row[0][3]);
		$cond=$this->convert_rus($row[0][12]);
		
		$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: &#160;&#160;<b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[0][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[0][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[0][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[0][7].''.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
		
		$photo=$row[0][8];
		
		if(preg_match('/;/', $photo)==FALSE)
		{
			$result=json_decode($this->api->sendPhoto([
			'chat_id' => $mainchannel,
			'photo' => $photo,
			'caption' => $caption,
			'disable_notification' => TRUE,
			'parse_mode' => "HTML"
			]), true);
			usleep(350000);
			
			$messageid=$result['result']['message_id'];
		}
		else
		{
			$tabservicerecords='tabservicerecords';
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicerecords.' LIMIT 1')==FALSE)
			{
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservicerecords.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,record VARCHAR(20),messids VARCHAR(250)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(250000);
			}
			
			
			$media=[];
			$temp=explode(';', $photo);
			$cnt=count($temp);
			
			for($o=0;$o<$cnt;$o++)
			{
				if($o==0)
				{
					$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
				}
				else
				{
					$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
				}
		
				$media[$o]=$put;
			}
			
			
		
			$result=json_decode($this->api->sendMediaGroup([
			'chat_id' => $mainchannel,
			'media' => json_encode($media),
			]), true);
			usleep(350000);
			
			$messageid=$result['result'][0]['message_id'];
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tabservicerecords.' (record, messids) VALUES ("'.$messageid.'", "0")');
			usleep(150000);
			
			$cnt=count($result['result']);
			
			for($o=0;$o<$cnt;$o++)
			{
				$messageids=$result['result'][$o]['message_id'];
				
				if($o==0)
				{
					$put=$messageids;
				}
				else
				{
					$put=''.$put.';'.$messageids.'';
				}

			}
			
			$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
			$con2=mysqli_num_rows($query2);
			
			for($i2=0;$i2<$con2;$i2++)
			{
				mysqli_data_seek($query2, $i2);
				$row2[$i2]=mysqli_fetch_row($query2);
			}
			
			$query1='UPDATE '.$tabservicerecords.' SET messids = REPLACE(messids, "'.$row2[0][2].'", "'.$put.'") WHERE record="'.$messageid.'"'; 
			$result1=mysqli_query($con_sql2, $query1);
			usleep(100000);			
			
		}
		
		$date=date("d.m.Y");
		$time=time();
		
		$query2='UPDATE '.$tabmain.' SET date = REPLACE(date, "'.$row[0][9].'", "'.$date.'") WHERE id="'.$record.'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		
		$query2='UPDATE '.$tabmain.' SET time = REPLACE(time, "'.$row[0][10].'", "'.$time.'") WHERE id="'.$record.'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		
		$query2='UPDATE '.$tabmain.' SET messid = REPLACE(messid, "'.$row[0][11].'", "'.$messageid.'") WHERE id="'.$record.'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		
		$query2=mysqli_query($con_sql2, 'DELETE FROM '.$tabserviceask.' WHERE record="'.$record.'"');
		usleep(100000);
		
		$caption1='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: &#160;&#160;<b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row[0][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row[0][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row[0][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row[0][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<i>ID товара: '.$messageid.'</i>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
		
		$this->api->editMessageCaption([
			'chat_id' => $this->mainchannel,
			'message_id' => $messageid,
			'caption' => $caption1,
			'parse_mode' => "HTML",
			]);
		
		usleep(250000);
		
		$text='Выбранное объявление <b>№'.$record.'</b> пользователя 👤<b>'.$fio.' ('.$phone.')</b> успешно размещено в канале с <b>ID товара № '.$messageid.'</b>.'.$this->pre.'';
		
		$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
		/* if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
		]);
		usleep(100000); */
		
		$text2='Ваше объявление <b>№'.$record.'</b> успешно размещено в канале с <b>ID товара № '.$messageid.'</b>.'.$this->pre.'';
		
		/* if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		} */
		
		/* $this->api->editMessageText([
				'chat_id' => $userchatid,
				'message_id' => $this->api->body['message']['message_id'],
				'text' => $text,
				'parse_mode' => "HTML",
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
			]);
			usleep(100000); */
			
/* 			$this->api->editMessageText([
				'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
				'message_id' => $this->api->body['callback_query']['message']['message_id'],
				'text' => $text,
				'parse_mode' => "HTML",
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
			]);
			usleep(100000); */
			
		$this->api->sendMessage([

			'chat_id' => $userchatid,
			'text' => $text2,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
			'parse_mode' => "HTML",
			]);
		usleep(100000);
	
	}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////RECORDS/////////////////////////////////////////////////////////////////////
	public function callback_admin_records()
	{
		$con_sql2=$this->cmd_sql();
		
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(100000);
		}
		
		$tabservicefio='tabservicefio'.$this->api->chatId.'';
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicefio.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabservicefio.'');
			usleep(100000);
		}
		
		$tabtempphoto='tabtempphoto'.$this->api->chatId.'';
		//if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' WHERE id LIKE "%" LIMIT 1'))!=0)
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtempphoto.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtempphoto.'');
			usleep(100000);
		}
		
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceuser.'');
			usleep(100000);
		}
		
		$text='Вы находитесь в подменю <b>Объявления</b> основного меню Админ.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
	}


/////	
	public function callback_admin_back_records_menu()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
				
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вернулись в главное меню <b>Админ</b> основного меню.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_main']);
		usleep(100000);
	}	
		/////	
	public function callback_admin_exit_records_menu()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вышли в <b>Главное Меню</b>.'.$this->pre.'';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(100000);
	}
	
	
/////////////////////////////////////////////show records//////////////////////////////////////////
/////	
	public function callback_admin_show_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$a=0;
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$a=1;
					break;

				}
			}
			
			if($a==0)
			{
				$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
				usleep(100000);
				
			}
			else
			{
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("show")');
					usleep(100000);
				}
				else
				{
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))==0)
					{
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("show")');
						usleep(100000);
					}
					else
					{
						mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
						usleep(100000);
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("show")');
						usleep(100000);
					}
				}
				
				/* if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				} */
				
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
				
				$text='Введите <b>ID товара</b>, чтобы посмотреть информацию о нем.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
				/* $this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
				]); */
			
			}
			
		}
		else
		{
			$text='В данный момент у пользователей <b>нет ни одного объявления</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
		
		}
		
		
	}

		
/////		
	public function cmd_admin_show_records_channel()
	{
	
		$con_sql2=$this->cmd_sql();
		$record=$this->api->textmessage;

		/* if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		} */
		

		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$a=0;
			$b=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$b=1;
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row[$i][0].' WHERE messid="'.$record.'"'))!=0)
					{
						$a=1;
						$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid="'.$record.'"');
						$con1=mysqli_num_rows($query1);
						
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
							

							$fio=$this->cmd_user_get_fio($row1[$i1][13]);
							$phone=$this->cmd_user_get_phone($row1[$i1][13]);
							
							$type=$this->convert_rus($row1[$i1][1]);
							$cat=$this->convert_rus($row1[$i1][2]);
							$gender=$this->convert_rus($row1[$i1][3]);
							$cond=$this->convert_rus($row1[$i1][12]);
							
							$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$row1[$i1][11].'</b>'.PHP_EOL.'Продавец:<b> '.$fio.' ('.$phone.')</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
							
							$photo=$row1[$i1][8];
							
							if(preg_match('/;/', $photo)==FALSE)
							{
								$this->api->sendPhoto([
								'photo' => $photo,
								'caption' => $caption,
								'disable_notification' => TRUE,
								'parse_mode' => "HTML"
								]);
								usleep(250000);
							
							}
							else
							{
								$media=[];
								$temp=explode(';', $photo);
								$cnt=count($temp);
								for($o=0;$o<$cnt;$o++)
								{
								
								
									if($o==0)
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
									}
									else
									{
										$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
									}
							
									$media[$o]=$put;
								}
								
								
								$this->api->sendMediaGroup([
								'media' => json_encode($media),
								]);
								usleep(350000);
							}

							$text='Сверху показан товар в канале с ID <b>№'.$record.'</b> пользователя <b>'.$fio.' ('.$phone.').</b>'.PHP_EOL.''.PHP_EOL.'Можете ввести другой <b>ID товара</b>, чтобы посмотреть информацию о нем.'.$this->pre.'';
							$merge=[];
							$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
							
							
							$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							usleep(100000);
							
							
							/* $text='Введите ID товара!';
							
							$this->api->sendMessage([
								'text' => $text,
								'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
								'disable_notification' => TRUE,
								'disable_web_page_preview' => TRUE,
								'parse_mode'=> "HTML"
								]);
							usleep(100000); */
							
							break 2;
						}
					}
				}
			}
			
			if($b==0)
			{
				$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_records']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
			}
			elseif($a==0)
			{
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
				
				/* $text='Пожалуйста, введите другой ID товара.';
				$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						usleep(100000); */
						
				$text='Товара с ID <b>'.$record.' не существует</b>.'.PHP_EOL.'Пожалуйста, введите другой ID товара.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
		}
		else
		{
			$text='В данный момент у пользователей <b>нет ни одного объявления</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}

////	
	public function callback_admin_back_show_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
				
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вернулись в подменю <b>Объявления</b> основного меню Админ.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
		usleep(100000);
		
	}
	
	
////	
	public function callback_admin_exit_show_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вышли в <b>Главное Меню</b>.'.$this->pre.'';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(100000);
		
	}	
	


/////		
	public function callback_admin_show_records_channel_file()
	{
		$con_sql2=$this->cmd_sql();
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			
			require_once(''.dirname(__FILE__).'/pdf/tcpdf.php');
			$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetCreator(PDF_CREATOR);
			
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
			$pdf->setFooterData(array(0,0,0), array(0,0,0));
			
			
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			if (@file_exists(dirname(__FILE__).'/pdf/lang/eng.php')) {
				require_once(dirname(__FILE__).'/pdf/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			$pdf->SetFont('dejavusans', '', 8, '', true);

			$pdf->AddPage();
			$date=date('d.m.Y');
			$time=date('G:i:s');
			
			$htmladd='
<div style="align: center; font-size: 16px; text-align: center"><b>Товары в продаже на '.$date.' '.$time.'</b></div><br><br>
<table border="1" cellspacing="0">
<tr style="line-height: 50px;">
<td align="center" valign="middle" width="90px"><b>Категория</b></td>
<td align="center" valign="middle" width="90px"><b>Вид</b></td>
<td align="center" valign="middle" width="60px"><b>Пол</b></td>
<td align="center" valign="middle" width="60px"><b>Состояние</b></td>
<td align="center" valign="middle" width="100px"><b>Бренд</b></td>
<td align="center" valign="middle" width="70px"><b>Размер</b></td>
<td align="center" valign="middle" width="100px"><b>Цена</b></td>
<td align="center" valign="middle" width="160px"><b>Описание</b></td>
<td align="center" valign="middle" width="60px"><b>ID товара</b></td>
<td align="center" valign="middle" width="160px"><b>Продавец</b></td>
</tr>';
			$a=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			
				$tabbuy=$row[$i][0];

				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabbuy.' WHERE messid!="0"'))!=0)
				{
					$a=1;
					$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbuy.' WHERE messid!="0"');
					$con1=mysqli_num_rows($query1);
					
					for($i1=0;$i1<$con1;$i1++)
					{
						mysqli_data_seek($query1, $i1);
						$row1[$i1]=mysqli_fetch_row($query1);
						
						$type=$this->convert_rus($row1[$i1][1]);
						$cat=$this->convert_rus($row1[$i1][2]);
						$gender=$this->convert_rus($row1[$i1][3]);
						$cond=$this->convert_rus($row1[$i1][12]);
						
					
						$htmladd=''.$htmladd.''.PHP_EOL.'<tr>';
					
	
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$type.'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$cat.'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$gender.'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$cond.'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][4].'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][5].'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][6].'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 8px;">'.$row1[$i1][7].'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][11].'</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						$fioseller=$this->cmd_user_get_fio($row1[$i1][13]);
						$phoneseller=$this->cmd_user_get_phone($row1[$i1][13]);
						
						$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$fioseller.' ('.$phoneseller.')</td>';
						$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
						
						
						
						$htmladd=''.$htmladd.''.PHP_EOL.'</tr>';
					}
				}
				
			}
			
			$htmladd=''.$htmladd.''.PHP_EOL.'</table>';
			$html = <<<EOD
$htmladd
EOD;
			
			if($a==1)
			{
				array_map('unlink', glob(''.dirname(__FILE__).'/pdf/channel*.pdf'));
				usleep(250000);
				
				$time=date('G.i.s');
				
				$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
				$pdf->Output(''.dirname(__FILE__).'/pdf/channel_'.$date.'_'.$time.'.pdf', 'F');
				usleep(250000);
				
				$this->api->sendDocument([
					'document' => 'https://domain.com/pdf/channel_'.$date.'_'.$time.'.pdf',
					'disable_notification' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(250000);
				
				
				$text='Вам был выслан файл с информацией о товарах в продаже. Вы находитесь в меню <b>Объявления</b>.'.$this->pre.'';
					
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_records']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
			else
			{
				$text='В данный момент у Вас <b>нет ни одного товара в канале</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
				usleep(100000);
			}
				
		}
		else
		{
							
			$text='В данный момент у Вас <b>нет ни одного товара в канале</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
			usleep(100000);
		}
	}



/////	
	public function callback_admin_delete_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$a=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$a=1;
					break;

				}
			}
			
			if($a==0)
			{

				$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
				usleep(100000);
				
			}
			else
			{
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("delete")');
					usleep(100000);
				}
				else
				{
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))==0)
					{
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("delete")');
						usleep(100000);
					}
					else
					{
						mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
						usleep(100000);
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("delete")');
						usleep(100000);
					}
				}
				
				/* if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				} */
				
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
				
				$text='Введите <b>ID товара</b>, чтобы удалить его из канала.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $merge);
				
				/* $this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
				]); */
			
			}
			
		}
		else
		{
	
			$text='В данный момент у пользователей <b>нет ни одного объявления</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
			
		}
		
	}
	
/////		
	public function cmd_admin_delete_records_channel()
	{
	
		$con_sql2=$this->cmd_sql();

		$record=$this->api->textmessage;
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabmain%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$a=0;
			$b=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$b=1;
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row[$i][0].' WHERE messid="'.$record.'"'))!=0)
					{
						$a=1;
						
						$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid="'.$record.'"');
						usleep(100000);
						$con1=mysqli_num_rows($query1);
							
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
						}
						
						$photo=$row1[0][8];
						$messageid=$row1[0][11];
						$timeold=$row1[0][10];
						$timediff=time()-$timeold;
						

						if(preg_match('/;/', $photo)==FALSE)
						{
							if($timediff>172000)
							{
								$text='<b><i>Товар удален</i></b>'.PHP_EOL.'⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️';
								$photodelete='https://domain.com/photodelete.png';
								
								$this->api->editMessageMedia([
								'chat_id' => $this->mainchannel,
								'message_id' => $messageid,
								'media' => json_encode( ['type' => 'photo', 'media' => $photodelete]),
								]);
							
								$this->api->editMessageCaption([
								'chat_id' => $this->mainchannel,
								'message_id' => $messageid,
								'caption' => $text,
								'parse_mode' => "HTML",
								]);
								
								
								$photo=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photo);
								unlink($photo);
								usleep(100000);
							}
							else
							{
								$this->api->deleteMessage([
								'chat_id' => $this->mainchannel,
								'message_id' => $messageid
								]);
								
								$photo=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photo);
								unlink($photo);
								usleep(100000);
							}
						}
						else
						{
							$tabservicerecords='tabservicerecords';
							$text='<b><i>Товар удален</i></b>'.PHP_EOL.'⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️⛔️';
							$photodelete='https://domain.com/photodelete.png';
							
							if($timediff>172000)
							{

								$this->api->editMessageCaption([
								'chat_id' => $this->mainchannel,
								'message_id' => $messageid,
								'caption' => $text,
								'parse_mode' => "HTML",
								]);
								
								
								$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
								$con2=mysqli_num_rows($query2);
			
								for($i2=0;$i2<$con2;$i2++)
								{
									mysqli_data_seek($query2, $i2);
									$row2[$i2]=mysqli_fetch_row($query2);
								}
								
								$messageids=explode(';', $row2[0][2]);
								$count1=count($messageids);
								
								for($e=0;$e<$count1;$e++)
								{
									if($e==0)
									{
										$this->api->editMessageMedia([
										'chat_id' => $this->mainchannel,
										'message_id' => $messageids[$e],
										'media' => json_encode( ['type' => 'photo', 'media' => $photodelete, 'caption' => $text, 'parse_mode' => "HTML" ]),
										]);
									}
									else
									{
										$this->api->editMessageMedia([
										'chat_id' => $this->mainchannel,
										'message_id' => $messageids[$e],
										'media' => json_encode( ['type' => 'photo', 'media' => $photodelete]),
										]);
									}
								}
								
								$photos=explode(';', $photo);
								$cnt=count($photos);
								
								for($y=0;$y<$cnt;$y++)
								{
									$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
									unlink($photos[$y]);
									usleep(100000);
								}
							}
							else
							{
								
								$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
								$con2=mysqli_num_rows($query2);
			
								for($i2=0;$i2<$con2;$i2++)
								{
									mysqli_data_seek($query2, $i2);
									$row2[$i2]=mysqli_fetch_row($query2);
								}
								
								$messageids=explode(';', $row2[0][2]);
								$count1=count($messageids);
								
								for($e=0;$e<$count1;$e++)
								{
									$this->api->deleteMessage([
									'chat_id' => $this->mainchannel,
									'message_id' => $messageids[$e]
									]);
									usleep(100000);
								}
								
								$photos=explode(';', $photo);
								$cnt=count($photos);
								
								for($y=0;$y<$cnt;$y++)
								{
									$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
									unlink($photos[$y]);
									usleep(100000);
								}
								
							}
							
							mysqli_query($con_sql2, 'DELETE FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
							
						}
						
						
						mysqli_query($con_sql2, 'DELETE FROM '.$row[$i][0].' WHERE messid="'.$record.'"');
						
						
						$query4=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
						$con4=mysqli_num_rows($query4);
						
						if($con4!=0)
						{
						
							for($i4=0;$i4<$con4;$i4++)
							{
								mysqli_data_seek($query4, $i4);
								$row4[$i4]=mysqli_fetch_row($query4);
								
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row4[$i4][0].' WHERE messid="'.$record.'"'))!=0)
								{
									
										mysqli_query($con_sql2, 'DELETE FROM '.$row4[$i4][0].' WHERE messid="'.$record.'"');
										usleep(100000);
										
										$chatidbuyers=str_replace('tabservicebuy', '', $row4[$i4][0]);
										$chatidbuyers=$this->clean($chatidbuyers);
										
										$text3='Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>отменена администратором</b>.'.PHP_EOL.''.PHP_EOL.'К сожалению, данного товара нет в наличии. Извините за неудобства.'.$this->pre.'';
										
										$this->api->sendMessage([
										'chat_id' => $chatidbuyers,
										'text' => $text3,
										'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
										'parse_mode' => "HTML",
										]);
										usleep(100000);
										
								}
								
							}
						}
						
						
						
						$userchatid=str_replace('tabmain', '', $row[$i][0]);
						$fio=$this->cmd_user_get_fio($userchatid);
						$phone=$this->cmd_user_get_phone($userchatid);
						
						$text2='Ваш товар с ID <b>№'.$record.'</b> был <b>удален администратором из канала</b>. Приносим извинения за неудобства.'.$this->pre.'';

						$this->api->sendMessage([
							'chat_id' => $userchatid,
							'text' => $text2,
							'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
							'parse_mode' => "HTML",
							]);
						usleep(100000);
						
						$text='Выбранный товар с <b>ID №'.$record.'</b> пользователя 👤<b>'.$fio.' ('.$phone.').</b> успешно удален из канала.'.PHP_EOL.''.PHP_EOL.'Вы можете ввести новый ID товара, чтобы удалить его из канала.'.$this->pre.'';
						$merge=[];
						$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
						
						
						$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						usleep(100000);
						
						
						/* $text='Введите ID товара!';
						
						$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						usleep(100000); */
										
						break;
						
					}
				}
			}
			
			if($b==0)
			{
				$text='В данный момент <b>нет товаров, размещенных в канале!</b>'.$this->pre.'';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_records']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
			}
			elseif($a==0)
			{
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
				
				/* $text='Пожалуйста, введите другой ID товара.';
				$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						usleep(100000); */
						
				$text='Товара с ID <b>'.$record.' не существует</b>.'.PHP_EOL.'Пожалуйста, введите другой ID товара.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
		}
		else
		{
			$text='В данный момент у пользователей <b>нет ни одного объявления</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}	
	


	
/////	
	public function callback_admin_sendsold_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			
			$a=0;
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$a=1;
					break;

				}
			}
			
			if($a==0)
			{

				$text='В данный момент у Вас <b>нет заказов</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
				usleep(100000);
				
			}
			else
			{
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(250000);
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("sendsold")');
					usleep(100000);
				}
				else
				{
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))==0)
					{
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("sendsold")');
						usleep(100000);
					}
					else
					{
						mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
						usleep(100000);
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("sendsold")');
						usleep(100000);
					}
				}
				

				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
				
				
		
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
				
				/* $text='Введите ID товара.';
				$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						usleep(100000); */
						
				$text='Введите <b>ID товара</b>, чтобы отметить его как проданный.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
			
		}
		else
		{
	
			$text='В данный момент у Вас <b>нет заказов</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
			usleep(100000);
		}
			
	}

		
/////		
	public function cmd_admin_sendsold_records_channel()
	{
	
		$con_sql2=$this->cmd_sql();

		$record=$this->api->textmessage;
		
		
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
		
			$a=0;
			$b=0;
			$table=[];
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$a=1;
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row[$i][0].' WHERE messid="'.$record.'"'))!=0)
					{
						$b=$b+1;
						$table[]=$row[$i][0];
					}
				}
			}
			
			if($a==0)
			{
				$text='В данный момент у Вас <b>нет заказов</b>.'.$this->pre.'';
		
				$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_records']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
			}
			elseif($b==0)
			{
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
				
				/* $text='Пожалуйста, введите другой ID товара.';
				$this->api->sendMessage([
							'text' => $text,
							'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]);
						usleep(100000); */
						
				$text='Заказов с ID товара <b>№'.$record.' не существует</b>.'.PHP_EOL.'Пожалуйста, введите другой ID товара.'.$this->pre.'';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
			}
			elseif($b==1)
			{
				$tabbuy=$table[0];
				$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbuy.' WHERE messid="'.$record.'"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
				}
				
				$photo=$row1[0][8];
				$messageid=$row1[0][11];
				$timeold=$row1[0][10];
				$timediff=time()-$timeold;
				
				
				if(preg_match('/;/', $photo)==FALSE)
				{
					if($timediff>172000)
					{
						$text='<b><i>Товар продан</i></b>'.PHP_EOL.'⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️';
						$photosold='https://domain.com/photosold.png';
						
						$this->api->editMessageMedia([
						'chat_id' => $this->mainchannel,
						'message_id' => $messageid,
						'media' => json_encode( ['type' => 'photo', 'media' => $photosold]),
						]);
					
						$this->api->editMessageCaption([
						'chat_id' => $this->mainchannel,
						'message_id' => $messageid,
						'caption' => $text,
						'parse_mode' => "HTML",
						]);
						
						$photo=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photo);
						unlink($photo);
						usleep(100000);
					}
					else
					{
						$this->api->deleteMessage([
						'chat_id' => $this->mainchannel,
						'message_id' => $messageid
						]);
						
						$photo=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photo);
						unlink($photo);
						usleep(100000);
					}
				}
				else
				{
					
					$tabservicerecords='tabservicerecords';
					$text='<b><i>Товар продан</i></b>'.PHP_EOL.'⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️';
					$photosold='https://domain.com/photosold.png';
					
					if($timediff>172000)
					{
					
						$this->api->editMessageCaption([
						'chat_id' => $this->mainchannel,
						'message_id' => $messageid,
						'caption' => $text,
						'parse_mode' => "HTML",
						]);
						
						
						$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
						$con2=mysqli_num_rows($query2);
					
						for($i2=0;$i2<$con2;$i2++)
						{
							mysqli_data_seek($query2, $i2);
							$row2[$i2]=mysqli_fetch_row($query2);
						}
						
						$messageids=explode(';', $row2[0][2]);
						$count1=count($messageids);
						
						for($e=0;$e<$count1;$e++)
						{
							
							if($e==0)
							{
								$this->api->editMessageMedia([
								'chat_id' => $this->mainchannel,
								'message_id' => $messageids[$e],
								'media' => json_encode( ['type' => 'photo', 'media' => $photosold, 'caption' => $text, 'parse_mode' => "HTML" ]),
								]);
							}
							else
							{
								$this->api->editMessageMedia([
								'chat_id' => $this->mainchannel,
								'message_id' => $messageids[$e],
								'media' => json_encode( ['type' => 'photo', 'media' => $photosold]),
								]);
							}
					
						}
						
						$photos=explode(';', $photo);
						$cnt=count($photos);
						
						for($y=0;$y<$cnt;$y++)
						{
							$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
							unlink($photos[$y]);
							usleep(100000);
						}
					}
					else
					{
						
						$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
						$con2=mysqli_num_rows($query2);
					
						for($i2=0;$i2<$con2;$i2++)
						{
							mysqli_data_seek($query2, $i2);
							$row2[$i2]=mysqli_fetch_row($query2);
						}
						
						$messageids=explode(';', $row2[0][2]);
						$count1=count($messageids);
						
						for($e=0;$e<$count1;$e++)
						{
							$this->api->deleteMessage([
							'chat_id' => $this->mainchannel,
							'message_id' => $messageids[$e]
							]);
							usleep(100000);
						}
						
						$photos=explode(';', $photo);
						$cnt=count($photos);
						
						for($y=0;$y<$cnt;$y++)
						{
							$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
							unlink($photos[$y]);
							usleep(100000);
						}
						
					}
					
					mysqli_query($con_sql2, 'DELETE FROM '.$tabservicerecords.' WHERE record="'.$messageid.'"');
					
				}
				

				$chatidseller=$row1[0][13];
				$tabsold='tabservicesold'.$chatidseller.'';
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabsold.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabsold.' LIKE '.$tabbuy.'');
					usleep(250000);
				}
	
				mysqli_query($con_sql2, 'INSERT INTO '.$tabsold.' (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller FROM '.$tabbuy.' WHERE messid="'.$record.'"');
				
				$query2=mysqli_query($con_sql2, 'SELECT * FROM '.$tabsold.' WHERE messid="'.$record.'"');
				$con2=mysqli_num_rows($query2);
				usleep(100000);
				
				for($i2=0;$i2<$con2;$i2++)
				{
					mysqli_data_seek($query2, $i2);
					$row2[$i2]=mysqli_fetch_row($query2);
				}
				
				
				//$chatidbuyer=str_replace('tabservicebuy', '', $row[$i][0]);
				$chatidbuyer=$row2[0][14];
				$tabseller='tabmain'.$chatidseller.'';

				$time=time();
				$date=date('d.m.Y');
				
				$query2='UPDATE '.$tabsold.' SET date = REPLACE(date, "'.$row2[0][9].'", "'.$date.'") WHERE messid="'.$record.'"'; 
				$result2=mysqli_query($con_sql2, $query2);
				usleep(100000);

				$query2='UPDATE '.$tabsold.' SET time = REPLACE(time, "'.$row2[0][10].'", "'.$time.'") WHERE messid="'.$record.'"'; 
				$result2=mysqli_query($con_sql2, $query2);
				usleep(100000);
				
				$query2=mysqli_query($con_sql2, 'DELETE FROM '.$tabbuy.' WHERE messid="'.$record.'"');
				usleep(100000);
				
				$query2=mysqli_query($con_sql2, 'DELETE FROM '.$tabseller.' WHERE messid="'.$record.'"');
				usleep(100000);
				
				$query4=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
				$con4=mysqli_num_rows($query4);
				
				if($con4!=0)
				{
				
					for($i4=0;$i4<$con4;$i4++)
					{
						mysqli_data_seek($query4, $i4);
						$row4[$i4]=mysqli_fetch_row($query4);
						
						if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT * FROM '.$row4[$i4][0].' WHERE messid="'.$record.'"'))!=0)
						{
							if($row4[$i4][0]!==''.$tabbuy.'')
							{
								$query2=mysqli_query($con_sql2, 'DELETE FROM '.$row4[$i4][0].' WHERE messid="'.$record.'"');
								usleep(100000);
								
								$chatidbuyers=str_replace('tabservicebuy', '', $row4[$i4][0]);
								$chatidbuyers=$this->clean($chatidbuyers);
								
								$text3='Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>отменена администратором</b>.'.PHP_EOL.''.PHP_EOL.'К сожалению, данный товар был куплен. Извините за неудобства.'.$this->pre.'';
								
								$this->api->sendMessage([
								'chat_id' => $chatidbuyers,
								'text' => $text3,
								'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
								'parse_mode' => "HTML",
								]);
								usleep(100000);
							}	
						}
						
					}
				}
				
				
				$text='<b>Вы ПОДТВЕРДИЛИ покупку:</b>'.PHP_EOL.''.PHP_EOL.'Покупатель 👤<b>'.$row2[0][14].'</b>, Продавец 👤<b>'.$row2[0][15].'</b>, ID товара <b>№'.$record.'</b>.'.PHP_EOL.''.PHP_EOL.'Вы можете ввести новый <b>ID товара</b>, чтобы отметить его как проданный.'.$this->pre.'';
				
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'admin_back_show_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'admin_exit_show_records_channel']];
				
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000);
				
				
				/* $text='Введите ID товара!';
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Введите ID товара'] ),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				usleep(100000); */
				
				
				$text2='Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>согласована администратором</b>.'.PHP_EOL.'В ближайшее время с вами <b>свяжется Продавец.</b>'.$this->pre.'';
			
				$this->api->sendMessage([
				
					'chat_id' => $chatidbuyer,
					'text' => $text2,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_buy_default']]),
					'parse_mode' => "HTML",
					]);
				usleep(100000);
			}
			elseif($b>1)
			{
				$merge=$this->cmd_admin_sendsold_records_channel_keyboard($record, $table);
				usleep(100000);
				
				if (array_filter($merge) !== [])
				{
					$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_admin_sendsold_records_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_admin_sendsold_records_channel']];
					
					$text='Выбранный товар с <b>ID №'.$record.'</b> хотят купить несколько пользователей. Выберите необходимого пользователя, чтобы <b>продать</b> ему данный товар.'.$this->pre.'';
					
					//$this->callbackAnswer( $text, $merge);
					$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(100000);
				}
				/* else
				{
					$text='В данный момент у пользователей <b>нет товаров,</b> размещенных в канале.'.PHP_EOL.' Вы находитесь в меню утвержденных пользователей.';
					
					$this->callbackAnswer( $text, $this->keyboards['inline_admin_approvedusers']);
				} */
			}
		}
		else
		{
			$text='В данный момент у пользователей <b>нет ни одного объявления</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}	


////	
	public function callback_back_admin_sendsold_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
				
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вернулись в подменю <b>Объявления</b> основного меню Админ.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
		usleep(100000);
		
	}
	
	
////	
	public function callback_exit_admin_sendsold_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		
		$text='Вы вышли в <b>Главное Меню</b>.'.$this->pre.'';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(100000);
		
	}		

/////
public function cmd_admin_sendsold_records_channel_keyboard($record, $table)
	{
		$record=$record;
		$table=$table;
		
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
			unset($getinclude[array_key_last($getinclude)]);
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
					$tabbuy=$table[$u];
					$arraybuyers=$table;
					$chatidbuyer=str_replace('tabservicebuy', '', $tabbuy);
					$chatidbuyer=$this->clean($chatidbuyer);
					$fiobuyer=$this->cmd_user_get_fio($chatidbuyer);
					$phonebuyer=$this->cmd_user_get_phone($chatidbuyer);
					$buttext='👤'.$this->cmd_user_get_fiophone($chatidbuyer).'';
					//$buttext="👤$fiobuyer";
					$put[]=["text" => "$buttext", "callback_data" => 'adm_sendsold_rec_chan_'.$chatidbuyer.'_'.$record.''];
					
					if(preg_match('/callback_adm_sendsold_rec_chan_'.$chatidbuyer.'_'.$record.'/', file_get_contents($include))==FALSE)
					{
						$insert='
						public function callback_adm_sendsold_rec_chan_'.$chatidbuyer.'_'.$record.'()
						{	
							$bot = new TestBot;
							$bot->api->getWebhookUpdate();
							
							$con_sql2=$bot->cmd_sql();
							$query1=mysqli_query($con_sql2, &#039;SELECT * FROM '.$tabbuy.' WHERE messid="'.$record.'"&#039;);
							usleep(100000);
							$con1=mysqli_num_rows($query1);
							
							
							for($i1=0;$i1<$con1;$i1++)
							{
								mysqli_data_seek($query1, $i1);
								$row1[$i1]=mysqli_fetch_row($query1);
							}
							
							$photo=$row1[0][8];
							$messageid=$row1[0][11];
							$timeold=$row1[0][10];
							$timediff=time()-$timeold;
							
							
							if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
							{
								if($timediff>172000)
								{
									$text="<b><i>Товар продан</i></b>";
									$photosold=&#039;https://domain.com/photosold.png&#039;;
									
									$bot->api->editMessageMedia([
									&#039;chat_id&#039; => $bot->mainchannel,
									&#039;message_id&#039; => $messageid,
									&#039;media&#039; => json_encode( [&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; => $photosold]),
									]);
								
									$bot->api->editMessageCaption([
									&#039;chat_id&#039; => $bot->mainchannel,
									&#039;message_id&#039; => $messageid,
									&#039;caption&#039; => $text,
									&#039;parse_mode&#039; => "HTML",
									]);
									
									$photo=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photo);
									unlink($photo);
									usleep(100000);
								}
								else
								{
									$bot->api->deleteMessage([
									&#039;chat_id&#039; => $bot->mainchannel,
									&#039;message_id&#039; => $messageid
									]);
									
									$photo=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photo);
									unlink($photo);
									usleep(100000);
								}
							}
							else
							{
								
								$text="<b><i>Товар продан</i></b>";
								
								$bot->api->editMessageCaption([
								&#039;chat_id&#039; => $bot->mainchannel,
								&#039;message_id&#039; => $messageid,
								&#039;caption&#039; => $text,
								&#039;parse_mode&#039; => "HTML",
								]);
								
								$photos=explode(&#039;;&#039;, $photo);
								$cnt=count($photos);
								
								for($y=0;$y<$cnt;$y++)
								{
									$photos[$y]=str_replace(&#039;https://domain.com&#039;, &#039;&#039;.dirname(__FILE__).&#039;&#039;, $photos[$y]);
									unlink($photos[$y]);
									usleep(100000);
								}
								
							}
							
			
							$chatidseller=$row1[0][13];
							$tabsold=&#039;tabservicesold&#039;.$chatidseller.&#039;&#039;;
							
							if(mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tabsold.&#039; LIMIT 1&#039;)==FALSE)
							{
								mysqli_query($con_sql2, &#039;CREATE TABLE &#039;.$tabsold.&#039; LIKE '.$tabbuy.'&#039;);
								usleep(250000);
							}
							
							mysqli_query($con_sql2, &#039;INSERT INTO &#039;.$tabsold.&#039; (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid, buyer, seller FROM '.$tabbuy.' WHERE messid="'.$record.'"&#039;);
							
							$query2=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabsold.&#039; WHERE messid="'.$record.'"&#039;);
							$con2=mysqli_num_rows($query2);
							usleep(100000);
							
							for($i2=0;$i2<$con2;$i2++)
							{
								mysqli_data_seek($query2, $i2);
								$row2[$i2]=mysqli_fetch_row($query2);
							}
							
						
							$tabseller=&#039;tabmain&#039;.$chatidseller.&#039;&#039;;
			
							$time=time();
							$date=date("d.m.Y");
							
							$query2=&#039;UPDATE &#039;.$tabsold.&#039; SET date = REPLACE(date, "&#039;.$row2[0][9].&#039;", "&#039;.$date.&#039;") WHERE messid="'.$record.'"&#039;; 
							$result2=mysqli_query($con_sql2, $query2);
							usleep(100000);
							
							$query2=&#039;UPDATE &#039;.$tabsold.&#039; SET time = REPLACE(time, "&#039;.$row2[0][10].&#039;", "&#039;.$time.&#039;") WHERE messid="'.$record.'"&#039;; 
							$result2=mysqli_query($con_sql2, $query2);
							usleep(100000);
							
							$query2=mysqli_query($con_sql2, &#039;DELETE FROM '.$tabbuy.' WHERE messid="'.$record.'"&#039;);
							usleep(100000);
							
							$query2=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabseller.&#039; WHERE messid="'.$record.'"&#039;);
							usleep(100000);
							
							
							if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
							{
								$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
								$bot->api->answerCallbackQuery($callback_query_id);
							}
							
							
							$query4=mysqli_query($con_sql2, &#039;SHOW TABLES LIKE "tabservicebuy%"&#039;);
							$con4=mysqli_num_rows($query4);
							
							if($con4!=0)
							{
							
								for($i4=0;$i4<$con4;$i4++)
								{
									mysqli_data_seek($query4, $i4);
									$row4[$i4]=mysqli_fetch_row($query4);
									
									if(mysqli_num_rows(mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$row4[$i4][0].&#039; WHERE messid="'.$record.'"&#039;))!=0)
									{
										if($row4[$i4][0]!==&#039;'.$tabbuy.'&#039;)
										{
											$query2=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$row4[$i4][0].&#039; WHERE messid="'.$record.'"&#039;);
											usleep(100000);
											
											$chatidbuyers=str_replace(&#039;tabservicebuy&#039;, &#039;&#039;, $row4[$i4][0]);
											$chatidbuyers=$bot->clean($chatidbuyers);
											
											$text3=&#039;Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>отменена администратором</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;К сожалению, данного товара нет в наличии. Извините за неудобства.&#039;.$bot->pre.&#039;&#039;;
											
											$bot->api->sendMessage([
											&#039;chat_id&#039; => $chatidbuyers,
											&#039;text&#039; => $text3,
											&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_buy_default&#039;]]),
											&#039;parse_mode&#039; => "HTML",
											]);
											usleep(100000);
										}	
									}
									
								}
							}

							
							$text=&#039;<b>Вы ПОДТВЕРДИЛИ покупку:</b>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Покупатель 👤<b>&#039;.$row2[0][14].&#039;</b>, Продавец 👤<b>&#039;.$row2[0][15].&#039;</b>, ID товара <b>№'.$record.'</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы можете ввести новый <b>ID товара</b>, чтобы отметить его как проданный.&#039;.$bot->pre.&#039;&#039;;
							
							/* $merge=[];
							$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;admin_back_show_records_channel&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;admin_exit_show_records_channel&#039;]];
							
							
							$bot->api->sendMessage([
								&#039;chat_id&#039; => $chatidbuyer,
								&#039;text&#039; => $text,
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
								&#039;disable_notification&#039; => TRUE,
								&#039;disable_web_page_preview&#039; => TRUE,
								&#039;parse_mode&#039;=> "HTML"
								]);
							usleep(100000);
							
							
							$text=&#039;Введите ID товара!&#039;;
							
							$bot->api->sendMessage([
								&#039;text&#039; => $text,
								&#039;reply_markup&#039; => json_encode( [&#039;force_reply&#039; => true, &#039;input_field_placeholder&#039; => &#039;Введите ID товара&#039;] ),
								&#039;disable_notification&#039; => TRUE,
								&#039;disable_web_page_preview&#039; => TRUE,
								&#039;parse_mode&#039;=> "HTML"
								]);
							usleep(100000); */
							
							
							$bot->api->sendMessage([
								&#039;text&#039; => $text,
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_admin_records&#039;]]),
								&#039;disable_notification&#039; => TRUE,
								&#039;disable_web_page_preview&#039; => TRUE,
								&#039;parse_mode&#039;=> "HTML"
								]);
							usleep(100000);
							
							
							$text2=&#039;Ваша заявка на покупку товара с ID <b>№'.$record.'</b> была <b>согласована администратором</b>.&#039;.PHP_EOL.&#039;В ближайшее время с вами <b>свяжется Продавец.</b>&#039;.$bot->pre.&#039;&#039;;
			
							$bot->api->sendMessage([
					
								&#039;chat_id&#039; => '.$chatidbuyer.',
								&#039;text&#039; => $text2,
								&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_buy_default&#039;]]),
								&#039;parse_mode&#039; => "HTML",
								]);
							usleep(100000);
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



/////	
	public function callback_admin_orders_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			
			$a=0;
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
					$a=1;
					
					if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
					{
						mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("orders")');
						usleep(100000);
					}
					else
					{
						if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))==0)
						{
							mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("orders")');
							usleep(100000);
						}
						else
						{
							mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
							usleep(100000);
							mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("orders")');
							usleep(100000);
						}
					}
			
					$text='Выбирите способ вывода информации о <b>текущих заказах</b>, нажав на соответствующую кнопку'.$this->pre.'';
			
					$this->callbackAnswer( $text, $this->keyboards['inline_admin_orders_records_channel']);
					usleep(100000);
					
					break;
				}
				
			}
			
			if($a==0)
			{
				$text='В данный момент у Вас <b>нет ни одного заказа</b>.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
				usleep(100000);
			}
			
		}
		else
		{
			$text='В данный момент у Вас <b>нет ни одного заказа</b>.'.$this->pre.'';
		
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
			usleep(100000);
		}

	}


/////
	public function callback_admin_orders_records_channel_display()
	{

		$con_sql2=$this->cmd_sql();
		

		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			
				$tabbuy=$row[$i][0];
				
				$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbuy.'');
				$con1=mysqli_num_rows($query1);
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
					
					$caption='📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$row1[$i1][11].'</b>'.PHP_EOL.'Продавец:<b> '.$row1[$i1][15].'</b>'.PHP_EOL.'Покупатель:<b> '.$row1[$i1][14].'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
					
					$photo=$row1[$i1][8];
					
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
					}
							
	
				}
			}
				
			$text='Сверху показаны <b>все существующие на данный момент заказы.</b>'.PHP_EOL.'Вы находитесь в меню <b>Посмотреть заказы.</b>'.$this->pre.'';
				
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_orders_records_channel']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
				
		}

		else
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
				
			$text='В данный момент у Вас <b>нет ни одного заказа</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}

	}
	
	
/////	
	public function callback_admin_orders_records_channel_file()
	{
		$con_sql2=$this->cmd_sql();
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicebuy%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			
			require_once(''.dirname(__FILE__).'/pdf/tcpdf.php');
			$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetCreator(PDF_CREATOR);
			
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
			$pdf->setFooterData(array(0,0,0), array(0,0,0));
			
			
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			if (@file_exists(dirname(__FILE__).'/pdf/lang/eng.php')) {
				require_once(dirname(__FILE__).'/pdf/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			$pdf->SetFont('dejavusans', '', 8, '', true);

			$pdf->AddPage();
			$date=date('d.m.Y');
			$time=date('G:i:s');
			
			$htmladd='
<div style="align: center; font-size: 16px; text-align: center"><b>Заказы на '.$date.' '.$time.'</b></div><br><br>
<table border="1" cellspacing="0">
<tr style="line-height: 50px;">
<td align="center" valign="middle" width="90px"><b>Категория</b></td>
<td align="center" valign="middle" width="90px"><b>Вид</b></td>
<td align="center" valign="middle" width="60px"><b>Пол</b></td>
<td align="center" valign="middle" width="60px"><b>Состояние</b></td>
<td align="center" valign="middle" width="90px"><b>Бренд</b></td>
<td align="center" valign="middle" width="60px"><b>Размер</b></td>
<td align="center" valign="middle" width="90px"><b>Цена</b></td>
<td align="center" valign="middle" width="160px"><b>Описание</b></td>
<td align="center" valign="middle" width="60px"><b>ID товара</b></td>
<td align="center" valign="middle" width="150px"><b>Продавец</b></td>
<td align="center" valign="middle" width="150px"><b>Покупатель</b></td>
</tr>';

			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			
				$tabbuy=$row[$i][0];

				$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabbuy.'');
				$con1=mysqli_num_rows($query1);
				
				
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
					
					
					$htmladd=''.$htmladd.''.PHP_EOL.'<tr>';
				

					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$type.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$cat.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$gender.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$cond.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][4].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][5].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][6].' грн</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 8px;">'.$row1[$i1][7].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][11].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][15].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;"><b>'.$row1[$i1][14].'</b></td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					
					
					$htmladd=''.$htmladd.''.PHP_EOL.'</tr>';
				}
				
			}
			
			$htmladd=''.$htmladd.''.PHP_EOL.'</table>';
			$html = <<<EOD
$htmladd
EOD;
			
			array_map('unlink', glob(''.dirname(__FILE__).'/pdf/orders*.pdf'));
			usleep(250000);
			
			$time=date('G.i.s');
			
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			$pdf->Output(''.dirname(__FILE__).'/pdf/orders_'.$date.'_'.$time.'.pdf', 'F');
			usleep(250000);
			
			$this->api->sendDocument([
				'document' => 'https://domain.com/pdf/orders_'.$date.'_'.$time.'.pdf',
				'disable_notification' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(250000);
			
			
			$text='Вам был выслан файл с текущими заказами. Вы находитесь в меню <b>Посмотреть заказы.</b>'.$this->pre.'';
				
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_orders_records_channel']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
				
		}

		else
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
				
			$text='В данный момент у Вас <b>нет ни одного заказа</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}
	
/////
	public function callback_admin_back_orders_records_channel()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		$text='Вы вернулись в раздел <b>Объявления.</b>'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
		usleep(100000);
	}
	
/////
	public function callback_admin_exit_orders_records_channel()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		$text='Вы вышли в <b>Главное меню.</b>'.$this->pre.'';
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		usleep(100000);
	}
	


/////	
	public function callback_admin_sold_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicesold%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			$a=0;
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$row[$i][0].' WHERE messid!="0"'))!=0)
				{
			
					$a=1;
					
					if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1')==FALSE)
					{
						mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadmin.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
						usleep(250000);
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("sold")');
						usleep(100000);
					}
					else
					{
						if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))==0)
						{
							mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("sold")');
							usleep(100000);
						}
						else
						{
							mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
							usleep(100000);
							mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadmin.' (info) VALUES ("sold")');
							usleep(100000);
						}
					}
				
					$text='Выбирите способ вывода информации о <b>завершенных продажах</b>, нажав на соответствующую кнопку'.$this->pre.'';
				
					$this->callbackAnswer( $text, $this->keyboards['inline_admin_sold_records_channel']);
					usleep(100000);
					
					break;
				}
			}
			
			if($a==0)
			{
				$text='В данный момент у Вас <b>нет ни одной продажи</b>.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
				usleep(100000);
			}
			
		}
		else
		{
			$text='В данный момент у Вас <b>нет ни одной продажи</b>.'.$this->pre.'';
				
			$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
			usleep(100000);
		}

	}


/////
	public function callback_admin_sold_records_channel_display()
	{

		$con_sql2=$this->cmd_sql();
		

		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicesold%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			
				$tabsold=$row[$i][0];
				
				$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabsold.'');
				$con1=mysqli_num_rows($query1);
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
					
					$caption=''.PHP_EOL.''.PHP_EOL.'📖Категория: &#160;&#160;<b>'.$type.'</b>'.PHP_EOL.'🧾Вид: &#160;&#160;<b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: &#160;&#160;<b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: &#160;&#160;<b>'.$row1[$i1][4].'</b>'.PHP_EOL.'↕️Размер: &#160;&#160;<b>'.$row1[$i1][5].'</b>'.PHP_EOL.'💵Цена: &#160;&#160;<b>'.$row1[$i1][6].'</b>'.PHP_EOL.'📋Описание: &#160;&#160;'.$row1[$i1][7].''.PHP_EOL.''.PHP_EOL.''.PHP_EOL.'<b>ID товара: '.$row1[$i1][11].'</b>'.PHP_EOL.'Покупатель:<b> '.$row1[$i1][14].'</b>'.PHP_EOL.'Продавец:<b> '.$row1[$i1][15].'</b>'.PHP_EOL.''.PHP_EOL.'📁📁📁📁📁📁📁📁📁📁📁📁';
					
					$photo=$row1[$i1][8];
					
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
					}
							
	
				}
			}
				
			$text='Сверху показаны <b>все завершенные на данный момент продажи.</b>'.PHP_EOL.'Вы находитесь в меню <b>Посмотреть продажи.</b>'.$this->pre.'';
				
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_sold_records_channel']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
				
		}

		else
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
				
			$text='В данный момент у Вас <b>нет ни одной завершенной продажи</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_records']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}

	}
	
	
/////	
	public function callback_admin_sold_records_channel_file()
	{
		$con_sql2=$this->cmd_sql();
		
		$query=mysqli_query($con_sql2, 'SHOW TABLES LIKE "tabservicesold%"');
		$con=mysqli_num_rows($query);
		
		if($con!=0)
		{
			
			require_once(''.dirname(__FILE__).'/pdf/tcpdf.php');
			$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetCreator(PDF_CREATOR);
			
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
			$pdf->setFooterData(array(0,0,0), array(0,0,0));
			
			
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			if (@file_exists(dirname(__FILE__).'/pdf/lang/eng.php')) {
				require_once(dirname(__FILE__).'/pdf/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			$pdf->SetFont('dejavusans', '', 8, '', true);

			$pdf->AddPage();
			$date=date('d.m.Y');
			$time=date('G:i:s');
			
			
			$htmladd='
<div style="align: center; font-size: 16px; text-align: center"><b>Продажи на '.$date.' '.$time.'</b></div><br><br>
<table border="1" cellspacing="0">
<tr style="line-height: 50px;">
<td align="center" valign="middle" width="80px"><b>Категория</b></td>
<td align="center" valign="middle" width="80px"><b>Вид</b></td>
<td align="center" valign="middle" width="60px"><b>Пол</b></td>
<td align="center" valign="middle" width="60px"><b>Состояние</b></td>
<td align="center" valign="middle" width="90px"><b>Бренд</b></td>
<td align="center" valign="middle" width="60px"><b>Размер</b></td>
<td align="center" valign="middle" width="90px"><b>Цена</b></td>
<td align="center" valign="middle" width="130px"><b>Описание</b></td>
<td align="center" valign="middle" width="60px"><b>ID товара</b></td>
<td align="center" valign="middle" width="130px"><b>Покупатель</b></td>
<td align="center" valign="middle" width="130px"><b>Продавец</b></td>
</tr>';
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			
				$tabsold=$row[$i][0];

				$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabsold.'');
				$con1=mysqli_num_rows($query1);
				
				
				
				for($i1=0;$i1<$con1;$i1++)
				{
					mysqli_data_seek($query1, $i1);
					$row1[$i1]=mysqli_fetch_row($query1);
					
					$type=$this->convert_rus($row1[$i1][1]);
					$cat=$this->convert_rus($row1[$i1][2]);
					$gender=$this->convert_rus($row1[$i1][3]);
					$cond=$this->convert_rus($row1[$i1][12]);
				

					$htmladd=''.$htmladd.''.PHP_EOL.'<tr>';
				

					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$type.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$cat.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$gender.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$cond.'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][4].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][5].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][6].' грн</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 8px;">'.$row1[$i1][7].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][11].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][14].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$put='<td style="text-align: center; valign: middle; font-size: 10px;">'.$row1[$i1][15].'</td>';
					$htmladd=''.$htmladd.''.PHP_EOL.''.$put.'';
					
					$htmladd=''.$htmladd.''.PHP_EOL.'</tr>';
				}
				
			}
			
			$htmladd=''.$htmladd.''.PHP_EOL.'</table>';
			$html = <<<EOD
$htmladd
EOD;

			array_map('unlink', glob(''.dirname(__FILE__).'/pdf/sales*.pdf'));
			usleep(250000);
			
			$time=date('G.i.s');
			
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			$pdf->Output(''.dirname(__FILE__).'/pdf/sales_'.$date.'_'.$time.'.pdf', 'F');
			usleep(250000);
			
			$this->api->sendDocument([
				'document' => 'https://domain.com/pdf/sales_'.$date.'_'.$time.'.pdf',
				'disable_notification' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(250000);
			
			
			$text='Вам был выслан файл с <b>завершенными продажами</b> на текущий момент.'.PHP_EOL.'Вы находитесь в меню <b>Посмотреть продажи.</b>'.$this->pre.'';
				
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_sold_records_channel']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
				
		}

		else
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
				
			$text='В данный момент у Вас <b>нет завершенных продаж</b>.'.$this->pre.'';
		
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_admin_main']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			usleep(100000);
		}
	}
	
/////
	public function callback_admin_back_sold_records_channel()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		$text='Вы вернулись в раздел <b>Объявления.</b>'.$this->pre.'';
				
		$this->callbackAnswer( $text, $this->keyboards['inline_admin_records']);
		usleep(100000);
	}
	
/////
	public function callback_admin_exit_sold_records_channel()
	{
		$con_sql2=$this->cmd_sql();
		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadmin.'');
			usleep(100000);
		}
		
		$text='Вы вышли в <b>Главное меню.</b>'.$this->pre.'';
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		usleep(100000);
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	








///////////////////////////////////////////////////////////CHANGE////////////////////////////////////////////////////	

	public function callback_sell_change()
	{
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		$query1=mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE pic!="0"');
		$con1=mysqli_num_rows($query1);
		if($con1!=0)
		{
			$text='Вы находитесь в меню <b>Измененить объявление</b>. Выбирите интересующий Вас раздел.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}
		else
		{
			$text='Вы еще не добавили ни одного объявления!'.PHP_EOL.'Воспользуйтесь меню <b>Создать объявление</b> основного меню Продать.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_sell']);
		}
		
		
	}
	
	
////	
	public function callback_change_back_main()
	{
		
		$text='Вы вернулись в раздел <b>Продать.</b> Выбирите интересующий Вас раздел.'.$this->pre.'';
		
		$this->callbackAnswer( $text, $this->keyboards['inline_sell']);
		usleep(100000);
	}
	
////	
	public function callback_change_exit_main()
	{
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
		
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
	}	



/////	
	public function callback_change_channel_records()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE messid!="0"'))==0)
		{
			$text='В данный момент у Вас <b>нет ни одного объявления</b>, размещенного в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}

		else
		{
			
			$merge=$this->cmd_change_channel_records();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'change_back_channel_records'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_channel_records']];
				
				$text='Вы находитесь в разделе <b>Мои размещенные объявления</b>. Выберите необходимый ID товара, чтобы посмотреть объявление.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у Вас <b>нет ни одного объявления</b>, размещенного в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
			}
			
		}
	
	}
	
	
	
/////
	public function cmd_change_channel_records()
	{
				
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
			
			
				$query1=mysqli_query($con_sql2, 'SELECT DISTINCT messid FROM '.$tabmain.' WHERE messid!="0"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
					$table=[];
					
					for($i=0;$i<$con1;$i++)
					{
						mysqli_data_seek($query1, $i);
						$row1[$i]=mysqli_fetch_row($query1);
						$table[]=$row1[$i][0];	
					}
					usleep(100000);
					
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
						unset($getinclude[array_key_last($getinclude)]);
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
								//$tabmain='tabmain'.$table[$u].'';
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE messid!="0"'))!=0)
								{
									$buttext="ID №$table[$u]";
									$put[]=["text" => "$buttext", "callback_data" => 'chan_chan_charecor_'.$this->api->chatId.'_'.$table[$u].''];
									
									if(preg_match('/callback_chan_chan_charecor_'.$this->api->chatId.'_'.$table[$u].'/', file_get_contents($include))==FALSE)
									{
										$insert='
										public function callback_chan_chan_charecor_'.$this->api->chatId.'_'.$table[$u].'()
										{	
											$bot = new TestBot;
											$bot->api->getWebhookUpdate();
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											
											$con_sql2=$bot->cmd_sql();
											$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
											$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT messid FROM &#039;.$tabmain.&#039; WHERE messid!="0"&#039;);
											usleep(100000);
											$con1=mysqli_num_rows($query1);
		
											if($con1!=0)
											{
		
												$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
												usleep(100000);
												$con=mysqli_num_rows($query);
													
												for($i=0;$i<$con;$i++)
												{
													mysqli_data_seek($query, $i);
													$row[$i]=mysqli_fetch_row($query);
												}
												

												$type=$bot->convert_rus($row[0][1]);
												$cat=$bot->convert_rus($row[0][2]);
												$gender=$bot->convert_rus($row[0][3]);
												$cond=$bot->convert_rus($row[0][12]);
												
							
												$caption=&#039;📖Категория: <b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: <b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: <b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;🎏Состояние: <b>&#039;.$cond.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: <b>&#039;.$row[0][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: <b>&#039;.$row[0][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: <b>&#039;.$row[0][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#039;.$row[0][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>ID товара № &#039;.$row[0][11].&#039;</b>&#039;;
												
												$photo=$row[0][8];
												
												if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
												{
													$bot->api->sendPhoto([
													&#039;photo&#039; => $photo,
													&#039;caption&#039; => $caption,
													//&#039;reply_markup&#039; => json_encode($bot->keyboards[&#039;default1&#039;]),
													&#039;disable_notification&#039; => TRUE,
													&#039;parse_mode&#039; => "HTML"
													]);
													usleep(250000);
												
												}
												else
												{
													$media=[];
													$temp=explode(&#039;;&#039;, $photo);
													$cnt=count($temp);
													for($o=0;$o<$cnt;$o++)
													{
													
													
														if($o==0)
														{
															$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039;, &#039;caption&#039; => &#039;&#039;.$caption.&#039;&#039;, &#039;parse_mode&#039; => "HTML" ];
														}
														else
														{
															$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039; ];
														}
												
														$media[$o]=$put;
													}
													
													
													$bot->api->sendMediaGroup([
													&#039;media&#039; => json_encode($media),
													]);
													usleep(350000);
												}
					
				
				
												$text=&#039;Сверху показано Ваше объявление с <b>ID товара №'.$table[$u].'</b>.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в меню <b>Мои размещенные объявления</b>. Выбирите ID товара на кнопках снизу, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
												

												$merge=$bot->cmd_change_channel_records();
												usleep(100000);
												
												if (array_filter($merge) !== [])
												{
												
													$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;change_back_channel_records&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;change_exit_channel_records&#039;]];
													
													/* $bot->api->answerCallbackQuery($callback_query_id);
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
													]);
													usleep(100000); */
													
													$bot->api->answerCallbackQuery($callback_query_id);
													$bot->api->sendMessage([
														&#039;text&#039; => $text,
														&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
														&#039;disable_notification&#039; => TRUE,
														&#039;disable_web_page_preview&#039; => TRUE,
														&#039;parse_mode&#039;=> "HTML"
													]);
													usleep(100000);
													
													
												}
												else
												{
													$text=&#039;В данный момент у Вас <b>нет ни одного объявления</b>, размещенного в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
													
												/* 	$bot->api->answerCallbackQuery($callback_query_id);
												
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
													]); */
													
													$bot->api->answerCallbackQuery($callback_query_id);
													$bot->api->sendMessage([
														&#039;text&#039; => $text,
														&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
														&#039;disable_notification&#039; => TRUE,
														&#039;disable_web_page_preview&#039; => TRUE,
														&#039;parse_mode&#039;=> "HTML"
													]);
													usleep(100000);
													
													
												}
											}
											else
											{
												
												$text=&#039;В данный момент у Вас <b>нет ни одного объявления</b>, размещенного в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
												$bot->api->answerCallbackQuery($callback_query_id);
												
												$bot->api->editMessageText([
												&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
												&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
												&#039;text&#039; => $text,
												&#039;parse_mode&#039; => "HTML",
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
												]);
											}
										}';
											
										file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
									}
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
	
////	
	public function callback_change_back_channel_records()
	{
		
		$text='Вы вернулись в раздел <b>Изменить объявление</b> главного меню <b>Продать.</b>'.$this->pre.'';
		
		$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		usleep(100000);
	}
	
////	
	public function callback_change_exit_channel_records()
	{
		
		if($this->cmd_isadmin())
		{
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
		
			$text='Вы вышли в <b>Главное Меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
		}
		else
		{
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
		
			$text='Вы вышли в <b>Главное Меню</b>.'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
		}
	}	
/////
/* 	
	public function callback_change_channel_records()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		$query1=mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE pic!="0"');
		$con1=mysqli_num_rows($query1);
		
		if($con1!=0)
		{
		
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid!="0" ORDER by id ASC');
			usleep(250000);
			$con=mysqli_num_rows($query);
			
			if($con!=0)
			{
			
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				usleep(250000);
				
				for($i=0;$i<$con;$i++)
				{
				
					$text='⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️'.PHP_EOL.'<b>ID товара № '.$row[$i][11].'</b>';
					
					$this->api->sendMessage([
					'text' => $text,
					//'reply_markup' => json_encode($this->keyboards['default1']),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					

					$type=$this->convert_rus($row[$i][1]);
					$cat=$this->convert_rus($row[$i][2]);
					$gender=$this->convert_rus($row[$i][3]);
					$cond=$this->convert_rus($row[$i][12]);
					

					$caption='📖Категория: <b>'.$type.'</b>'.PHP_EOL.'🧾Вид: <b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: <b>'.$gender.'</b>'.PHP_EOL.'Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: <b>'.$row[$i][4].'</b>'.PHP_EOL.'↕️Размер: <b>'.$row[$i][5].'</b>'.PHP_EOL.'💵Цена: <b>'.$row[$i][6].'</b>'.PHP_EOL.'📋Описание: '.$row[$i][7].''.PHP_EOL.'<b>ID товара № '.$row[$i][11].'</b>';
					
					$photo=$row[$i][8];
					
					if(preg_match('/;/', $photo)==FALSE)
					{
						$this->api->sendPhoto([
						'photo' => $photo,
						'caption' => $caption,
						//'reply_markup' => json_encode($this->keyboards['default1']),
						'disable_notification' => TRUE,
						'parse_mode' => "HTML"
						]);
						usleep(250000);
					
					}
					else
					{
						$media=[];
						$temp=explode(';', $photo);
						$cnt=count($temp);
						for($o=0;$o<$cnt;$o++)
						{
						
						
							if($o==0)
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
							}
							else
							{
								$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
							}
					
							$media[$o]=$put;
						}
						
						
						$this->api->sendMediaGroup([
						'media' => json_encode($media),
						]);
						usleep(350000);
					}
					
				}
				
				$text='Сверху показаны Ваши товары, размещенные в канале.'.PHP_EOL.''.PHP_EOL.'Вы находитесь в меню <b>Измененить товар</b>. Выбирите интересующий Вас раздел на кнопках снизу.';
				
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_change']]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
				]);
				
			}
			else
			{
				$text='У Вас еще нет ни одного товара, размещенного в канале!'.PHP_EOL.'Воспользуйтесь подменю Разместить в канале меню Изменить объявление.';
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
			}
		}
		else
		{
			$text='Вы еще не добавили ни одного товара!'.PHP_EOL.'Воспользуйтесь меню Добавить товар основного меню Продать.';
			$this->callbackAnswer( $text, $this->keyboards['inline_sell']);
		}
		//$this->callback_sell_delete();
		
		$this->api->sendMessage([
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_delete']]),
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
	}
 */	
/////




/////	
	public function callback_change_all_records()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE pic!="0" AND messid="0"'))==0)
		{
			$text='В данный момент у Вас <b>нет сохраненных объявлений</b> для размещения в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}

		else
		{
			
			$merge=$this->cmd_change_all_records();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'change_back_channel_records'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_channel_records']];
				
				$text='Вы находитесь в разделе <b>Мои сохраненные для публикации</b>. Выберите необходимый <b>№ объявления</b>, чтобы посмотреть его.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у Вас нет сохраненных объявлений для публикации в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в разделе <b>Изменить объявление</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
			}
			
		}
	
	}
	
	
	
/////
	public function cmd_change_all_records()
	{
				
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
			
			
				$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE pic!="0" AND messid="0" ORDER by id ASC');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
					$table=[];
					
					for($i=0;$i<$con1;$i++)
					{
						mysqli_data_seek($query1, $i);
						$row1[$i]=mysqli_fetch_row($query1);
						$table[]=$row1[$i][0];	
					}
					usleep(100000);
					
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
						unset($getinclude[array_key_last($getinclude)]);
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
								//$tabmain='tabmain'.$table[$u].'';
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE pic!="0" AND messid="0"'))!=0)
								{
									$buttext="№$table[$u]";
									$put[]=["text" => "$buttext", "callback_data" => 'chan_chan_allrecor_'.$this->api->chatId.'_'.$table[$u].''];
									
									if(preg_match('/callback_chan_chan_allrecor_'.$this->api->chatId.'_'.$table[$u].'/', file_get_contents($include))==FALSE)
									{
										$insert='
										public function callback_chan_chan_allrecor_'.$this->api->chatId.'_'.$table[$u].'()
										{	
											$bot = new TestBot;
											$bot->api->getWebhookUpdate();
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											
											$con_sql2=$bot->cmd_sql();
											$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
											$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT id FROM &#039;.$tabmain.&#039; WHERE pic!="0" AND messid="0"&#039;);
											usleep(100000);
											$con1=mysqli_num_rows($query1);
		
											if($con1!=0)
											{
		
												$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE id="'.$table[$u].'"&#039;);
												usleep(100000);
												$con=mysqli_num_rows($query);
													
												for($i=0;$i<$con;$i++)
												{
													mysqli_data_seek($query, $i);
													$row[$i]=mysqli_fetch_row($query);
												}
												

												$type=$bot->convert_rus($row[0][1]);
												$cat=$bot->convert_rus($row[0][2]);
												$gender=$bot->convert_rus($row[0][3]);
												$cond=$bot->convert_rus($row[0][12]);
												
							
												$caption=&#039;📖Категория: <b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: <b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: <b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;🎏Состояние: <b>&#039;.$cond.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: <b>&#039;.$row[0][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: <b>&#039;.$row[0][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: <b>&#039;.$row[0][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#039;.$row[0][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<b>Объявление № &#039;.$row[0][0].&#039;</b>&#039;;
												
												$photo=$row[0][8];
												
												if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
												{
													$bot->api->sendPhoto([
													&#039;photo&#039; => $photo,
													&#039;caption&#039; => $caption,
													//&#039;reply_markup&#039; => json_encode($bot->keyboards[&#039;default1&#039;]),
													&#039;disable_notification&#039; => TRUE,
													&#039;parse_mode&#039; => "HTML"
													]);
													usleep(250000);
												
												}
												else
												{
													$media=[];
													$temp=explode(&#039;;&#039;, $photo);
													$cnt=count($temp);
													for($o=0;$o<$cnt;$o++)
													{
													
													
														if($o==0)
														{
															$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039;, &#039;caption&#039; => &#039;&#039;.$caption.&#039;&#039;, &#039;parse_mode&#039; => "HTML" ];
														}
														else
														{
															$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039; ];
														}
												
														$media[$o]=$put;
													}
													
													
													$bot->api->sendMediaGroup([
													&#039;media&#039; => json_encode($media),
													]);
													usleep(350000);
												}
					
				
				
												$text=&#039;Сверху показано Ваше объявление <b>№'.$table[$u].'</b> для публикации в канале.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в меню <b>Мои сохраненные для публикации</b>. Выбирите № объявления на кнопках снизу, чтобы посмотреть информацию о нем.&#039;.$bot->pre.&#039;&#039;;
												

												$merge=$bot->cmd_change_all_records();
												usleep(100000);
												
												if (array_filter($merge) !== [])
												{
												
													$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;change_back_channel_records&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;change_exit_channel_records&#039;]];
													
													/* $bot->api->answerCallbackQuery($callback_query_id);
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
													]);
													usleep(100000); */
													
													$bot->api->answerCallbackQuery($callback_query_id);
													$bot->api->sendMessage([
														&#039;text&#039; => $text,
														&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
														&#039;disable_notification&#039; => TRUE,
														&#039;disable_web_page_preview&#039; => TRUE,
														&#039;parse_mode&#039;=> "HTML"
													]);
													usleep(100000);
												}
												else
												{
													$text=&#039;Сверху показано Ваше объявление <b>№'.$table[$u].'</b> для публикации в канале.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;В данный момент у Вас нет сохраненных объявлений для публикации в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
													
													/* $bot->api->answerCallbackQuery($callback_query_id);
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
													]); */
													
													$bot->api->answerCallbackQuery($callback_query_id);
													$bot->api->sendMessage([
														&#039;text&#039; => $text,
														&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
														&#039;disable_notification&#039; => TRUE,
														&#039;disable_web_page_preview&#039; => TRUE,
														&#039;parse_mode&#039;=> "HTML"
													]);
													usleep(100000);
												}
											}
											else
											{
												
												$text=&#039;В данный момент у Вас нет сохраненных объявлений для публикации в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
												$bot->api->answerCallbackQuery($callback_query_id);
												
												$bot->api->editMessageText([
												&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
												&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
												&#039;text&#039; => $text,
												&#039;parse_mode&#039; => "HTML",
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
												]);
											}
										}';
											
										file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
									}
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




/* 
	public function callback_change_all_records()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		$query1=mysqli_query($con_sql2, 'SELECT 1 FROM '.$tab.' WHERE pic!="0" AND messid="0"');
		$con1=mysqli_num_rows($query1);
		
		if($con1!=0)
		{
		
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE pic!="0" AND messid="0" ORDER by id ASC');
			usleep(250000);
			$con=mysqli_num_rows($query);
				
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			usleep(250000);
			
			
			$text='⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️⚡️'.PHP_EOL.''.PHP_EOL.'';
			$this->api->sendMessage([
				'text' => $text,
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
			]);
			
			for($i=0;$i<$con;$i++)
			{
			
				$text='<b>Объявление №'.$row[$i][0].'</b>';
				
				$this->api->sendMessage([
				'text' => $text,
				//'reply_markup' => json_encode($this->keyboards['default1']),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				
				$type=$this->convert_rus($row[$con-1][1]);
				$cat=$this->convert_rus($row[$con-1][2]);
				$gender=$this->convert_rus($row[$con-1][3]);
				$cond=$this->convert_rus($row[$con-1][12]);
				
				
				$caption='📖Категория: <b>'.$type.'</b>'.PHP_EOL.'🧾Вид: <b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: <b>'.$gender.'</b>'.PHP_EOL.'Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: <b>'.$row[$con-1][4].'</b>'.PHP_EOL.'↕️Размер: <b>'.$row[$con-1][5].'</b>'.PHP_EOL.'💵Цена: <b>'.$row[$con-1][6].'</b>'.PHP_EOL.'📋Описание: '.$row[$con-1][7].''.PHP_EOL.''.PHP_EOL.'<b>Объявление №'.$row[$i][0].'</b>';
				
				$photo=$row[$i][8];
				
				if(preg_match('/;/', $photo)==FALSE)
				{
					$this->api->sendPhoto([
					'photo' => $photo,
					'caption' => $caption,
					//'reply_markup' => json_encode($this->keyboards['default1']),
					'disable_notification' => TRUE,
					'parse_mode' => "HTML"
					]);
					usleep(250000);
				
				}
				else
				{
					$media=[];
					$temp=explode(';', $photo);
					$cnt=count($temp);
					for($o=0;$o<$cnt;$o++)
					{
					
					
						if($o==0)
						{
							$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
						}
						else
						{
							$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
						}
				
						$media[$o]=$put;
					}
					
					
					$this->api->sendMediaGroup([
					'media' => json_encode($media),
					]);
					usleep(350000);
				}
			}
			
			if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				}
			
			
			$text=''.PHP_EOL.''.PHP_EOL.'Сверху показаны все Ваши товары, которые не размещены в канале.'.PHP_EOL.''.PHP_EOL.'Вы находитесь в подменю Изменить объявление меню Продать товар.';
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_change']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
			]);
		}
		else
		{
			$text='У Вас нет ни одного товара, который не размещен в канале. Воспользуйтесь меню Отправить в канал основного меню Изменить объявление.';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}
	
		
	}

 */

/////	
/* 	public function callback_change_delete_records_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE pic!="0" AND messid!="0"'))==0)
		{
			$text='В данный момент у Вас нет ни одного товара, размещенного в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}

		else
		{
			
			$merge=$this->cmd_change_delete_records_channel();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'change_back_delete_records'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_delete_records']];
				
				$text='Вы находитесь в подразделе <b>Удалить товары в канале</b>. Выберите необходимый ID товара №, чтобы удалить его.';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у Вас <b>нет ни одного товара</b>, размещенного в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.';
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
			}
			
		}
	
	}

 */
////	
	public function callback_change_back_delete_records()
	{
		
		$text='Вы вернулись в подменю <b>Изменить объявление</b> главного меню Продать.'.$this->pre.'';
		
		$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		usleep(100000);
	}
	
////	
	public function callback_change_exit_delete_records()
	{
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
	}	


/* 
/////
	public function cmd_change_delete_records_channel()
	{
				
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
			
			
				$query1=mysqli_query($con_sql2, 'SELECT DISTINCT messid FROM '.$tabmain.' WHERE messid!="0"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
					$table=[];
					
					for($i=0;$i<$con1;$i++)
					{
						mysqli_data_seek($query1, $i);
						$row1[$i]=mysqli_fetch_row($query1);
						$table[]=$row1[$i][0];	
					}
					usleep(100000);
					
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
						unset($getinclude[array_key_last($getinclude)]);
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
								//$tabmain='tabmain'.$table[$u].'';
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE messid!="0"'))!=0)
								{
									$buttext="$table[$u]";
									$put[]=["text" => "$buttext", "callback_data" => 'cha_del_rec_chan_'.$this->api->chatId.'_'.$table[$u].''];
									
									if(preg_match('/callback_cha_del_rec_chan_'.$this->api->chatId.'_'.$table[$u].'/', file_get_contents($include))==FALSE)
									{
										$insert='
										public function callback_cha_del_rec_chan_'.$this->api->chatId.'_'.$table[$u].'()
										{	
											$bot = new TestBot;
											$bot->api->getWebhookUpdate();
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											
											$con_sql2=$bot->cmd_sql();
											$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
											$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT messid FROM &#039;.$tabmain.&#039; WHERE messid!="0"&#039;);
											usleep(100000);
											$con1=mysqli_num_rows($query1);
		
											if($con1!=0)
											{
		
												$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
												usleep(100000);
												$con=mysqli_num_rows($query);
													
												for($i=0;$i<$con;$i++)
												{
													mysqli_data_seek($query, $i);
													$row[$i]=mysqli_fetch_row($query);
												}
												

												$messageid=$row[0][11];
												$timeold=$row[0][10];
												$timediff=time()-$timeold;
												
												//if($timediff>172000)
												//{
													$text="<b><i>Товар удален</i></b>";
												
													$bot->api->editMessageCaption([
													&#039;chat_id&#039; => $bot->mainchannel,
													&#039;message_id&#039; => $messageid,
													&#039;caption&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													//&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
													]);
												//}
												else
												{
													$bot->api->deleteMessage([
													&#039;chat_id&#039; => $bot->mainchannel,
													&#039;message_id&#039; => $messageid
													]);
												}
												
												
												$query=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
												usleep(100000);
												
												
												$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Удалить товар из канала</b>. Пожалуйста, выбирите ID товара, чтобы удалить его.&#039;;
												

												$merge=$bot->cmd_change_delete_records_channel();
												usleep(100000);
												
												if (array_filter($merge) !== [])
												{
												
													$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;change_back_delete_records&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;change_exit_delete_records&#039;]];
													
													$bot->api->answerCallbackQuery($callback_query_id);
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
													$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;В данный момент у Вас нет ни одного товара, размещенного в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;;
													
													$bot->api->answerCallbackQuery($callback_query_id);
												
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
													]);
												}
											}
											else
											{
												
												$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> успешно удален из канала.&#039;.PHP_EOL.&#039;В данный момент у Вас нет ни одного товара, размещенного в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;;
												$bot->api->answerCallbackQuery($callback_query_id);
												
												$bot->api->editMessageText([
												&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
												&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
												&#039;text&#039; => $text,
												&#039;parse_mode&#039; => "HTML",
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
												]);
											}
										}';
											
										file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
									}
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
			
				
	} */







/////	
	public function callback_change_delete_records_other()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE pic!="0" AND messid="0"'))==0)
		{
			$text='В данный момент у Вас <b>нет ни одного сохраненного объявления</b> для публикации в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}

		else
		{
			
			$merge=$this->cmd_change_delete_records_other();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'change_back_delete_records'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_delete_records']];
				
				$text='Вы находитесь в разделе <b>Удалить сохраненные для публикации.</b> Выберите необходимое объявление, чтобы удалить его.'.$this->pre.'';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у Вас <b>нет ни одного сохраненного объявления</b> для публикации в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.'.$this->pre.'';
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
			}
			
		}
	
	}




/////
	public function cmd_change_delete_records_other()
	{
				
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
			
			
				$query1=mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE pic!="0" AND messid="0"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
					$table=[];
					
					for($i=0;$i<$con1;$i++)
					{
						mysqli_data_seek($query1, $i);
						$row1[$i]=mysqli_fetch_row($query1);
						$table[]=$row1[$i][0];	
					}
					usleep(100000);
					
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
						unset($getinclude[array_key_last($getinclude)]);
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
								//$tabmain='tabmain'.$table[$u].'';
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE pic!="0" AND messid="0"'))!=0)
								{
									$buttext="№$table[$u]";
									$put[]=["text" => "$buttext", "callback_data" => 'change_del_rec_other_'.$this->api->chatId.'_'.$table[$u].''];
									
									if(preg_match('/callback_change_del_rec_other_'.$this->api->chatId.'_'.$table[$u].'/', file_get_contents($include))==FALSE)
									{
										$insert='
										public function callback_change_del_rec_other_'.$this->api->chatId.'_'.$table[$u].'()
										{	
											$bot = new TestBot;
											$bot->api->getWebhookUpdate();
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											
											$con_sql2=$bot->cmd_sql();
											$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
											$tabserviceask=&#039;tabserviceask&#039;.$bot->api->chatId.&#039;&#039;;
											$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT id FROM &#039;.$tabmain.&#039; WHERE pic!="0" AND messid="0"&#039;);
											usleep(100000);
											$con1=mysqli_num_rows($query1);
		
											if($con1!=0)
											{
		

												$query=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabmain.&#039; WHERE id="'.$table[$u].'"&#039;);
												usleep(100000);
												
												$query=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabserviceask.&#039; WHERE record="'.$table[$u].'"&#039;);
												usleep(100000);
												
												
												$text=&#039;Выбранное <b>объявление №'.$table[$u].'</b> успешно удалено.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в разделе <b>Удалить сохраненные для публикации</b>. Пожалуйста, выбирите объявление, чтобы удалить его.&#039;.$bot->pre.&#039;&#039;;
												

												$merge=$bot->cmd_change_delete_records_other();
												usleep(100000);
												
												if (array_filter($merge) !== [])
												{
												
													$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;change_back_delete_records&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;change_exit_delete_records&#039;]];
													
													$bot->api->answerCallbackQuery($callback_query_id);
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
													$text=&#039;Выбранное <b>объявление №'.$table[$u].'</b> успешно удалено.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;В данный момент у Вас <b>нет сохраненных объявлений</b> для публикации в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в разделе <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
													
													$bot->api->answerCallbackQuery($callback_query_id);
												
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
													]);
												}
											}
											else
											{
												
												$text=&#039;В данный момент у Вас <b>нет сохраненных объявлений</b> для публикации в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в разделе <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
												$bot->api->answerCallbackQuery($callback_query_id);
												
												$bot->api->editMessageText([
												&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
												&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
												&#039;text&#039; => $text,
												&#039;parse_mode&#039; => "HTML",
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
												]);
											}
										}';
											
										file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
									}
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



/////	
	public function callback_change_askadmin_send_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid="0" AND pic!="0" ORDER by id ASC');
		$con1=mysqli_num_rows($query1);
		
		if($con1!=0)
		{
		
			$merge=$this->cmd_change_askadmin_send_channel();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'change_back_askadmin_send_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_askadmin_send_channel']];
				$text='Выбирите объявление, которое вы хотите <b>опубликовать в канале</b>, нажав на соответствующую кнопку снизу.'.$this->pre.'';
				
				/* if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				
				}
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
				]); */
				
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у Вас <b>нет сохраненных объявлений</b> для публикации в канале!'.PHP_EOL.'Вы находитесь в разделе <b>Изменить объявление</b>.'.$this->pre.'';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
				
				
			}
		}
		else
		{
			$text='В данный момент у Вас <b>нет сохраненных объявлений</b> для публикации в канале!'.PHP_EOL.'Вы находитесь в разделе <b>Изменить объявление</b>.'.$this->pre.'';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}

		
	}
	


/////
	public function cmd_change_askadmin_send_channel()
	{
				
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
		$tabserviceask='tabserviceask'.$this->api->chatId.'';
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceask.' LIMIT 1'))
				{
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceask.' WHERE id LIKE "%" LIMIT 1'))!=0)
					{
						$query1=mysqli_query($con_sql2, 'SELECT DISTINCT record FROM '.$tabserviceask.' WHERE id LIKE "%"');
						usleep(100000);
						$con1=mysqli_num_rows($query1);
				
						$tabletemp=[];
					
						for($i=0;$i<$con1;$i++)
						{
							mysqli_data_seek($query1, $i);
							$row1[$i]=mysqli_fetch_row($query1);
							$tabletemp[]=$row1[$i][0];	
						}
						usleep(100000);
					}
				}	
				
				$cntu=count($tabletemp);
				
				
				$query1=mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE messid="0" AND pic!="0"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
					$table=[];
					
					for($i=0;$i<$con1;$i++)
					{
						mysqli_data_seek($query1, $i);
						$row1[$i]=mysqli_fetch_row($query1);
						
						//if(in_array($row1[$i][0], array_values($tabletemp))==FALSE)
						//$search=array_search($row1[$i][0], $tabletemp);
						//unset($puttemp[$search]);
						//$cntu=count($tabletemp);
						//if($this->cmd_arraysearch($tabletemp, $row1[$i][0])==FALSE)
						//if(array_search($row1[$i][0], $tabletemp))	
						//if(preg_match('/'.$row1[$i][0].'/', $tabletemp)==FALSE)
							
						if(in_array($row1[$i][0], $tabletemp)==FALSE)
						{
						
							/* $this->api->sendMessage([
							'text' => "fgfsghfsg fsghsfgh",
							'disable_notification' => TRUE,
							'disable_web_page_preview' => TRUE,
							'parse_mode'=> "HTML"
							]); */
							$table[]=$row1[$i][0];
						}
							
					}
					usleep(100000);
					
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
						unset($getinclude[array_key_last($getinclude)]);
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
								//$tabmain='tabmain'.$table[$u].'';
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE messid="0" AND pic!="0"'))!=0)
								{
									$buttext="№$table[$u]";
									$put[]=["text" => "$buttext", "callback_data" => 'chan_se_chan_'.$this->api->chatId.'_'.$table[$u].''];
									
									if(preg_match('/callback_chan_se_chan_'.$this->api->chatId.'_'.$table[$u].'/', file_get_contents($include))==FALSE)
									{
										$insert='
										public function callback_chan_se_chan_'.$this->api->chatId.'_'.$table[$u].'()
										{	
											$bot = new TestBot;
											$bot->api->getWebhookUpdate();
										
											
											$con_sql2=$bot->cmd_sql();
											$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
											
											if(mysqli_num_rows(mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tabmain.&#039; WHERE pic!="0" AND messid="0"&#039;))!=0)
											{
											
												$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT id FROM &#039;.$tabmain.&#039; WHERE messid="0" AND pic!="0"&#039;);
												usleep(100000);
												$con1=mysqli_num_rows($query1);
		
												if($con1!=0)
												{
													
													if(mysqli_query($con_sql2, &#039;SELECT 1 FROM '.$tabserviceask.' LIMIT 1&#039;)==FALSE)
													{
														mysqli_query($con_sql2, &#039;CREATE TABLE '.$tabserviceask.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,record VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;);
														usleep(250000);
													}
														
													
														$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT record FROM '.$tabserviceask.' WHERE id LIKE "%"&#039;);
														usleep(100000);
														$con1=mysqli_num_rows($query1);
												
														$tabletemp=[];
													
														for($i=0;$i<$con1;$i++)
														{
															mysqli_data_seek($query1, $i);
															$row1[$i]=mysqli_fetch_row($query1);
															$tabletemp[]=$row1[$i][0];	
														}
														
														if(in_array('.$table[$u].', $tabletemp)==FALSE)
														{
															mysqli_query($con_sql2, &#039;INSERT INTO '.$tabserviceask.' (record) VALUES ("'.$table[$u].'")&#039;);
															usleep(100000);
															
															
															$userfio=$bot->cmd_user_get_fio($bot->api->chatId);
															$userphone=$bot->cmd_user_get_phone($bot->api->chatId);
														
															$text=&#039;Пользователь 👤<b>&#039;.$userfio.&#039; (&#039;.$userphone.&#039;)</b> добавил объявление <b>№'.$table[$u].'</b> для размещения в канале. Что вы хотите сделать с данным объявлением?&#039;.$bot->pre.&#039;&#039;;
															
															$bot->api->sendMessage([
															&#039;chat_id&#039; => $bot->chatidadmin,
															&#039;text&#039; => $text,
															&#039;parse_mode&#039; => "HTML",
															&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_ask_admin_channel&#039;]]),
															]);
															
															
															
															$text=&#039;Вы успешно отправили Ваше объявление <b>№'.$table[$u].'</b> на <b>модерацию админу</b>. Вам придет уведомление о результатах.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Можете выбрать еще одно объявление, чтобы опубликовать его в канале.&#039;.$bot->pre.&#039;&#039;;
															
															$merge=$bot->cmd_change_askadmin_send_channel();
			
															usleep(100000);
															
															if (array_filter($merge) !== [])
															{
															
																$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;change_back_askadmin_send_channel&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;change_exit_askadmin_send_channel&#039;]];
																
																if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
																{
																	$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
																	$bot->api->answerCallbackQuery($callback_query_id);
																}
																	
																$bot->api->sendMessage([
																&#039;text&#039; => $text,
																&#039;parse_mode&#039; => "HTML",
																&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge]),
																]);
															}
															else
															{
																$text=&#039;Вы успешно отправили Ваше объявление <b>№'.$table[$u].'</b> на <b>модерацию админу</b>. Вам придет уведомление о результатах.&#039;.PHP_EOL.&#039;У Вас больше нет сохраненных объявлений для публикации в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в разделе <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
													
																if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
																{
																	$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
																	$bot->api->answerCallbackQuery($callback_query_id);
																}
															
																$bot->api->editMessageText([
																&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
																&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
																&#039;text&#039; => $text,
																&#039;parse_mode&#039; => "HTML",
																&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
																]);
															}
														}
														else
														{
															$text=&#039;Вы уже отправили данное объявление на модерацию админу. Имейте терпение!&#039;.$bot->pre.&#039;&#039;;
												
															if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
															{
																$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
																$bot->api->answerCallbackQuery($callback_query_id);
															}
												
															$bot->api->editMessageText([
															&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
															&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
															&#039;text&#039; => $text,
															&#039;parse_mode&#039; => "HTML",
															&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
															]);
														}
													

												}
												else
												{
													$text=&#039;У Вас больше нет сохраненных объявлений для публикации в канале!&#039;.PHP_EOL.&#039; Вы находитесь в разделе <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
													
													if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
													{
														$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
														$bot->api->answerCallbackQuery($callback_query_id);
													}
												
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
													]);
												}
											}
											else
											{
												
												$text=&#039;У Вас больше нет сохраненных объявлений для публикации в канале!&#039;.PHP_EOL.&#039; Вы находитесь в разделе <b>Изменить объявление</b>.&#039;.$bot->pre.&#039;&#039;;
												
												if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
												{
													$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
													$bot->api->answerCallbackQuery($callback_query_id);
												}
												
												$bot->api->editMessageText([
												&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
												&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
												&#039;text&#039; => $text,
												&#039;parse_mode&#039; => "HTML",
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
												]);
											}
										}';
											
										file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
									}
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
	

////	
	public function callback_change_back_askadmin_send_channel()
	{
		
		$text='Вы вернулись в раздел <b>Изменить объявление</b> главного меню <b>Продать</b>.'.$this->pre.'';
		
		$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		usleep(100000);
	}
	
////	
	public function callback_change_exit_askadmin_send_channel()
	{
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
	}		

	
	
	
	
	


















/////	
/* 	public function callback_change_send_channel()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';
		$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE messid="0" AND pic!="0" ORDER by id ASC');
		$con1=mysqli_num_rows($query1);
		
		if($con1!=0)
		{
		
			$merge=$this->cmd_change_send_channel();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'change_back_send_channel'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_send_channel']];
				$text='Выбирите объявление, которое вы хотите отправить в канал, нажав на соответствующую кнопку снизу.';
				
				if(isset($this->api->body['callback_query']["id"]))
				{
					$callback_query_id=$this->api->body['callback_query']["id"];
					$this->api->answerCallbackQuery($callback_query_id);
				
				}
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
				]);
				
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у Вас нет объявлений для размещения в канале!'.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.';
				
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
				
				
			}
		}
		else
		{
			$text='В данный момент у Вас нет объявлений для размещения в канале!'.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}

		
	}
	

////	
	public function callback_change_back_send_channel()
	{
		
		$text='Вы вернулись в подменю Изменить объявление главного меню Продать.';
		
		$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		usleep(100000);
	}
	
////	
	public function callback_change_exit_send_channel()
	{
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.';
			//$this->callbackAnswer( $text, $this->keyboards['inline_default_admin']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.';
			//$this->callbackAnswer( $text, $this->keyboards['inline_default']);
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				usleep(100000);
		}
	}		

	
/////
	public function cmd_change_send_channel()
	{
				
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
			
			
				$query1=mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE messid="0" AND pic!="0"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
					$table=[];
					
					for($i=0;$i<$con1;$i++)
					{
						mysqli_data_seek($query1, $i);
						$row1[$i]=mysqli_fetch_row($query1);
						$table[]=$row1[$i][0];	
					}
					usleep(100000);
					
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
						unset($getinclude[array_key_last($getinclude)]);
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
								//$tabmain='tabmain'.$table[$u].'';
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE messid="0" AND pic!="0"'))!=0)
								{
									$buttext="$table[$u]";
									$put[]=["text" => "$buttext", "callback_data" => "change_send_channel_$table[$u]"];
									
									if(preg_match('/callback_change_send_channel_'.$table[$u].'/', file_get_contents($include))==FALSE)
									{
										$insert='
										public function callback_change_send_channel_'.$table[$u].'()
										{	
											$bot = new TestBot;
											$bot->api->getWebhookUpdate();
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											
											$con_sql2=$bot->cmd_sql();
											$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
											
											if(mysqli_num_rows(mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tabmain.&#039; WHERE pic!="0"&#039;))!=0)
											{
											
												$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT id FROM &#039;.$tabmain.&#039; WHERE messid="0" AND pic!="0"&#039;);
												usleep(100000);
												$con1=mysqli_num_rows($query1);
		
												if($con1!=0)
												{
													
													$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE id="'.$table[$u].'"&#039;);
													usleep(100000);
													$con=mysqli_num_rows($query);
													
													for($i=0;$i<$con;$i++)
													{
														mysqli_data_seek($query, $i);
														$row[$i]=mysqli_fetch_row($query);
													}
													usleep(250000);
													
													$mainchannel=$bot->mainchannel;
													
													$arraybuttons=$bot->arraybuttonstype;
													$arraycallback=$bot->arraycallbacktype;
													
													$count=count($arraycallback);
													
													for($y=0;$y<$count;$y++)
													{
														if($row[0][1]==$arraycallback[$y])
														{
															$type=$arraybuttons[$y];
															break;
														}
													}
													

													if($row[0][1]==&#039;clothes&#039;)
													{
														$arraybuttons=$bot->arraybuttonsclothes;
														$arraycallback=$bot->arraycallbackclothes;
													}
													elseif($row[0][1]==&#039;shoes&#039;)
													{
														$arraybuttons=$bot->arraybuttonsshoes;
														$arraycallback=$bot->arraycallbackshoes;
													}
													elseif($row[0][1]==&#039;accessories&#039;)
													{
														$arraybuttons=$bot->arraybuttonsaccessories;
														$arraycallback=$bot->arraycallbackaccessories;
													}
													elseif($row[0][1]==&#039;toys&#039;)
													{
														$arraybuttons=$bot->arraybuttonstoys;
														$arraycallback=$bot->arraycallbacktoys;
													}
													
													$count=count($arraycallback);
													
													for($y=0;$y<$count;$y++)
													{
														if($row[0][2]==$arraycallback[$y])
														{
															$cat=$arraybuttons[$y];
															break;
														}
													}
													
													
													$arraybuttons=$bot->arraybuttonsgender;
													$arraycallback=$bot->arraycallbackgender;
													
													$count=count($arraycallback);
													
													for($y=0;$y<$count;$y++)
													{
														if($row[0][3]==$arraycallback[$y])
														{
															$gender=$arraybuttons[$y];
															break;
														}
													}
													
													$text=&#039;❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️❇️&#039;;
													$bot->api->sendMessage([
													&#039;chat_id&#039; => $mainchannel,
													&#039;text&#039; => $text,
													&#039;disable_notification&#039; => TRUE,
													&#039;disable_web_page_preview&#039; => TRUE,
													&#039;parse_mode&#039;=> &#039;HTML&#039;
													]);
													
													$userid=$bot->api->chatId;
													
													$caption=&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📖Категория: &#160;&#160;<b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: &#160;&#160;<b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: &#160;&#160;<b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: &#160;&#160;<b>&#039;.$row[0][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: &#160;&#160;<b>&#039;.$row[0][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: &#160;&#160;<b>&#039;.$row[0][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#160;&#160;&#039;.$row[0][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<i>id продавца:&#039;.$userid.&#039;</i>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📁📁📁📁📁📁📁📁📁📁📁📁&#039;.PHP_EOL.&#039;&#039;;
													
													$photo=$row[0][8];
				
													if(preg_match(&#039;/;/&#039;, $photo)==FALSE)
													{
														$result=json_decode($bot->api->sendPhoto([
														&#039;chat_id&#039; => $mainchannel,
														&#039;photo&#039; => $photo,
														&#039;caption&#039; => $caption,
														&#039;disable_notification&#039; => TRUE,
														&#039;parse_mode&#039; => "HTML"
														]), true);
														
														$messageid=$result[&#039;result&#039;][&#039;message_id&#039;];
													}
													else
													{
														$media=[];
														$temp=explode(&#039;;&#039;, $photo);
														$cnt=count($temp);
														for($o=0;$o<$cnt;$o++)
														{
														
														
															if($o==0)
															{
																$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039;, &#039;caption&#039; => &#039;&#039;.$caption.&#039;&#039;, &#039;parse_mode&#039; => "HTML" ];
															}
															else
															{
																$put=[&#039;type&#039; => &#039;photo&#039;, &#039;media&#039; =>  &#039;&#039;.$temp[$o].&#039;&#039; ];
															}
													
															$media[$o]=$put;
														}
														
														

														$result=json_decode($bot->api->sendMediaGroup([
														&#039;chat_id&#039; => $mainchannel,
														&#039;media&#039; => json_encode($media),
														]), true);
														
														$messageid=$result[&#039;result&#039;][0][&#039;message_id&#039;];
													}
				
													$date=$bot->api->chatId;
													$time=time();
													
													$query2=&#039;UPDATE &#039;.$tabmain.&#039; SET date = REPLACE(date, "&#039;.$row[0][9].&#039;", "&#039;.$date.&#039;") WHERE id="'.$table[$u].'"&#039;; 
													$result2=mysqli_query($con_sql2, $query2);
													
													$query2=&#039;UPDATE &#039;.$tabmain.&#039; SET time = REPLACE(time, "&#039;.$row[0][10].&#039;", "&#039;.$time.&#039;") WHERE id="'.$table[$u].'"&#039;; 
													$result2=mysqli_query($con_sql2, $query2);
													
													$query2=&#039;UPDATE &#039;.$tabmain.&#039; SET messid = REPLACE(messid, "&#039;.$row[0][11].&#039;", "&#039;.$messageid.&#039;") WHERE id="'.$table[$u].'"&#039;; 
													$result2=mysqli_query($con_sql2, $query2);
													
													
													$caption1=&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📖Категория: &#160;&#160;<b>&#039;.$type.&#039;</b>&#039;.PHP_EOL.&#039;🧾Вид: &#160;&#160;<b>&#039;.$cat.&#039;</b>&#039;.PHP_EOL.&#039;👨‍👩‍👦Пол: &#160;&#160;<b>&#039;.$gender.&#039;</b>&#039;.PHP_EOL.&#039;®️Бренд: &#160;&#160;<b>&#039;.$row[0][4].&#039;</b>&#039;.PHP_EOL.&#039;↕️Размер: &#160;&#160;<b>&#039;.$row[0][5].&#039;</b>&#039;.PHP_EOL.&#039;💵Цена: &#160;&#160;<b>&#039;.$row[0][6].&#039;</b>&#039;.PHP_EOL.&#039;📋Описание: &#160;&#160;&#039;.$row[0][7].&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;<i>id продавца: &#039;.$userid.&#039;</i>&#039;.PHP_EOL.&#039;<i>ID товара: &#039;.$messageid.&#039;</i>&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;📁📁📁📁📁📁📁📁📁📁📁📁&#039;.PHP_EOL.&#039;&#039;;
													
													$bot->api->editMessageCaption([
														&#039;chat_id&#039; => $bot->mainchannel,
														&#039;message_id&#039; => $messageid,
														&#039;caption&#039; => $caption1,
														&#039;parse_mode&#039; => "HTML",
														]);
													
													
													
													$text=&#039;Выбранное объявление №'.$table[$u].' успешно размещено в канале с ID &#039;.$messageid.&#039;.&#039;.PHP_EOL.&#039;Вы находитесь в подменю Разместить в канале меню Изменить объявления. Пожалуйста, выбирите объявление, чтобы отправить ее в канал.&#039;;
												
													$merge=$bot->cmd_change_send_channel();
													usleep(100000);
													
													if (array_filter($merge) !== [])
													{
													
														$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;change_back_send_channel&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;change_exit_send_channel&#039;]];
														
														if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
														{
															$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
															$bot->api->answerCallbackQuery($callback_query_id);
														}
														
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
														$text=&#039;Выбранное объявление №'.$table[$u].' успешно размещено в канале с ID &#039;.$messageid.&#039;.&#039;.PHP_EOL.&#039;В данный момент у Вас нет ни одного объявления для размещения в канал!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;;
											
														if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
														{
															$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
															$bot->api->answerCallbackQuery($callback_query_id);
														}
													
														$bot->api->editMessageText([
														&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
														&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
														&#039;text&#039; => $text,
														&#039;parse_mode&#039; => "HTML",
														&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
														]);
													}
												
												}
												else
												{
													$text=&#039;В данный момент у Вас нет ни одного объявления для размещения в канал!&#039;.PHP_EOL.&#039; Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;;
													
													if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
														{
															$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
															$bot->api->answerCallbackQuery($callback_query_id);
														}
												
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
													]);
												}
											}
											else
											{
												
												$text=&#039;В данный момент у Вас <b>нет ни одного объявления</b> для размещения в канал!&#039;.PHP_EOL.&#039; Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;;
												
												if(isset($bot->api->body[&#039;callback_query&#039;]["id"]))
														{
															$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
															$bot->api->answerCallbackQuery($callback_query_id);
														}
												
												$bot->api->editMessageText([
												&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
												&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
												&#039;text&#039; => $text,
												&#039;parse_mode&#039; => "HTML",
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
												]);
											}
										}';
											
										file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
									}
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
	





/////	
	public function callback_change_send_sold()
	{
		
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabmain.' WHERE pic!="0" AND messid!="0"'))==0)
		{
			$text='В данный момент у Вас <b>нет ни одного товара</b>, размещенного в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.';
			$this->callbackAnswer( $text, $this->keyboards['inline_change']);
		}

		else
		{
			
			$merge=$this->cmd_change_send_sold();
			usleep(100000);
			
			if (array_filter($merge) !== [])
			{
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'change_back_delete_records'], ['text' => '⤴️Выйти', 'callback_data' => 'change_exit_delete_records']];
				
				$text='Вы находитесь в подразделе <b>Отметить продажу</b>. Выберите необходимое объявление, чтобы отметить продажу.';
				$this->callbackAnswer( $text, $merge);
			}
			else
			{
				$text='В данный момент у Вас <b>нет ни одного товара</b>, размещенного в канале!'.PHP_EOL.''.PHP_EOL.'Вы находитесь в главном меню <b>Изменить объявление</b>.';
				$this->callbackAnswer( $text, $this->keyboards['inline_change']);
			}
			
		}
	
	}





/////
	public function cmd_change_send_sold()
	{
				
		$con_sql2=$this->cmd_sql();
		
		$tabmain='tabmain'.$this->api->chatId.'';
			
			
				$query1=mysqli_query($con_sql2, 'SELECT DISTINCT messid FROM '.$tabmain.' WHERE pic!="0" AND messid!="0"');
				usleep(100000);
				$con1=mysqli_num_rows($query1);
				
					$table=[];
					
					for($i=0;$i<$con1;$i++)
					{
						mysqli_data_seek($query1, $i);
						$row1[$i]=mysqli_fetch_row($query1);
						$table[]=$row1[$i][0];	
					}
					usleep(100000);
					
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
						unset($getinclude[array_key_last($getinclude)]);
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
								//$tabmain='tabmain'.$table[$u].'';
								if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT DISTINCT id FROM '.$tabmain.' WHERE pic!="0" AND messid!="0"'))!=0)
								{
									$buttext="$table[$u]";
									$put[]=["text" => "$buttext", "callback_data" => "change_send_sold_$table[$u]"];
									
									if(preg_match('/callback_change_send_sold_'.$table[$u].'/', file_get_contents($include))==FALSE)
									{
										$insert='
										public function callback_change_send_sold_'.$table[$u].'()
										{	
											$bot = new TestBot;
											$bot->api->getWebhookUpdate();
											$callback_query_id=$bot->api->body[&#039;callback_query&#039;]["id"];
											
											$con_sql2=$bot->cmd_sql();
											$tabmain=&#039;tabmain&#039;.$bot->api->chatId.&#039;&#039;;
											$query1=mysqli_query($con_sql2, &#039;SELECT DISTINCT messid FROM &#039;.$tabmain.&#039; WHERE pic!="0" AND messid!="0"&#039;);
											usleep(100000);
											$con1=mysqli_num_rows($query1);
		
											if($con1!=0)
											{
		
												$query=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
												usleep(100000);
												$con=mysqli_num_rows($query);
													
												for($i=0;$i<$con;$i++)
												{
													mysqli_data_seek($query, $i);
													$row[$i]=mysqli_fetch_row($query);
												}
												

												$messageid=$row[0][11];
												$timeold=$row[0][10];
												$timediff=time()-$timeold;
												
												//if($timediff>172000)
												//{
													$text="<b><i>Товар продан</i></b>";
												
													$bot->api->editMessageCaption([
													&#039;chat_id&#039; => $bot->mainchannel,
													&#039;message_id&#039; => $messageid,
													&#039;caption&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													//&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$merge] ),
													]);
												//}
												else
												{
													$bot->api->deleteMessage([
													&#039;chat_id&#039; => $bot->mainchannel,
													&#039;message_id&#039; => $messageid
													]);
												}
												
												
												$tabsold=&#039;tabservicesold&#039;;
												if(mysqli_query($con_sql2, &#039;SELECT 1 FROM &#039;.$tabsold.&#039; LIMIT 1&#039;)==FALSE)
												{
													$query1=&#039;CREATE TABLE &#039;.$tabsold.&#039; (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,type VARCHAR(20), cat VARCHAR(20), gender VARCHAR(20), brand VARCHAR(30), size VARCHAR(30), price NUMERIC(7,0), alt VARCHAR(512), pic VARCHAR(512), date VARCHAR(20), time VARCHAR(20), messid VARCHAR(20), cond VARCHAR(20), chatid VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;&#039;;
													$result1=mysqli_query($con_sql2, $query1);
													usleep(250000);

												}
												
												mysqli_query($con_sql2, &#039;INSERT INTO &#039;.$tabsold.&#039; (type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid) SELECT type, cat, gender, brand, size, price, alt, pic, date, time, messid, cond, chatid FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
												
												$query1=mysqli_query($con_sql2, &#039;SELECT * FROM &#039;.$tabsold.&#039; WHERE id LIKE "%" ORDER by id ASC&#039;);
												$con1=mysqli_num_rows($query1);
												usleep(100000);
				
												for($i1=0;$i1<$con1;$i1++)
												{
													mysqli_data_seek($query1, $i1);
													$row1[$i1]=mysqli_fetch_row($query1);
												}
												
												$date=$bot->api->chatId;
												$time=time();
												
												$query1=&#039;UPDATE &#039;.$tabsold.&#039; SET date = REPLACE(date, "&#039;.$row1[$con1-1][9].&#039;", "&#039;.$date.&#039;") WHERE id="&#039;.$row1[$con1-1][0].&#039;"&#039;; 
												$result1=mysqli_query($con_sql2, $query1);
												
												$query1=&#039;UPDATE &#039;.$tabsold.&#039; SET time = REPLACE(time, "&#039;.$row1[$con1-1][10].&#039;", "&#039;.$time.&#039;") WHERE id="&#039;.$row1[$con1-1][0].&#039;"&#039;; 
												$result1=mysqli_query($con_sql2, $query1);
												
												
												$query=mysqli_query($con_sql2, &#039;DELETE FROM &#039;.$tabmain.&#039; WHERE messid="'.$table[$u].'"&#039;);
												usleep(100000);
												
												
												$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> успешно отмечен как проданый.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в подменю <b>Отметить продажу</b>. Пожалуйста, выбирите ID товара, чтобы <b>отметить продажу</b>.&#039;;
												

												$merge=$bot->cmd_change_send_sold();
												usleep(100000);
												
												if (array_filter($merge) !== [])
												{
												
													$merge[] = [[&#039;text&#039; => &#039;⬅️Назад&#039;, &#039;callback_data&#039; => &#039;change_back_delete_records&#039;], [&#039;text&#039; => &#039;⤴️Выйти&#039;, &#039;callback_data&#039; => &#039;change_exit_delete_records&#039;]];
													
													$bot->api->answerCallbackQuery($callback_query_id);
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
													$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> успешно отмечен как проданый.&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;В данный момент у Вас нет ни одного товара, размещенного в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;;
													
													$bot->api->answerCallbackQuery($callback_query_id);
												
													$bot->api->editMessageText([
													&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
													&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
													&#039;text&#039; => $text,
													&#039;parse_mode&#039; => "HTML",
													&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
													]);
												}
											}
											else
											{
												
												$text=&#039;Выбранный ID товара <b>№'.$table[$u].'</b> успешно отмечен как проданый.&#039;.PHP_EOL.&#039;В данный момент у Вас нет ни одного товара, размещенного в канале!&#039;.PHP_EOL.&#039;&#039;.PHP_EOL.&#039;Вы находитесь в главном меню <b>Изменить объявление</b>.&#039;;
												$bot->api->answerCallbackQuery($callback_query_id);
												
												$bot->api->editMessageText([
												&#039;chat_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;chat&#039;]["id"],
												&#039;message_id&#039; => $bot->api->body[&#039;callback_query&#039;][&#039;message&#039;][&#039;message_id&#039;],
												&#039;text&#039; => $text,
												&#039;parse_mode&#039; => "HTML",
												&#039;reply_markup&#039; => json_encode( [&#039;inline_keyboard&#039;=>$bot->keyboards[&#039;inline_change&#039;]] ),
												]);
											}
										}';
											
										file_put_contents($include, html_entity_decode($insert, ENT_QUOTES) . PHP_EOL . PHP_EOL,FILE_APPEND);
									}
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
	 */


///////////////////////////////////////////////////////////////////////PHOTO////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////
/* 
	public function cmd_sell_add_photo_main()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabservicetime='tabservicetime'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$time=time();
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
					 
			mysqli_query($con_sql2, 'UPDATE '.$tabmain.' SET time = REPLACE(time, "'.$row[$con-1][10].'", "'.$time.'") WHERE id="'.$row[$con-1][0].'"');
			usleep(100000);
			
			if($row[$con-1][8]!="0")
			{
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1')==FALSE)
				{
				
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabtemp.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(100000);
					
					mysqli_query($con_sql2, 'INSERT INTO '.$tabtemp.' (info) VALUES ("1")');
					usleep(100000);
					
					$text='<b>Хотите добавить еще фотографии?</b>';
					
						$this->api->sendMessage([
						'text' => $text,
						'disable_notification' => TRUE,
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						
				}
				else
				{						
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' WHERE id="1" LIMIT 1'))==0)
					{
						mysqli_query($con_sql2, 'INSERT INTO '.$tabtemp.' (info) VALUES ("1")');
						usleep(100000);
						
						$text='<b>Хотите добавить еще фотографии?</b>';
					
						$this->api->sendMessage([
						'text' => $text,
						'disable_notification' => TRUE,
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);

					}
				}

			}
			else
			{
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadd.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(10)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(100000);
					
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadd.' (info) VALUES ("photo")');
					usleep(100000);
				}
				else
				{
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id="1" LIMIT 1'))==0)
					{
						
						mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadd.' (info) VALUES ("photo")');
						usleep(100000);
					}
					else
					{
						$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id="1"');
						usleep(100000);
						$con1=mysqli_num_rows($query1);
						
						for($i1=0;$i1<$con1;$i1++)
						{
							mysqli_data_seek($query1, $i1);
							$row1[$i1]=mysqli_fetch_row($query1);
						}
						usleep(100000);
										
						$query2='UPDATE '.$tabserviceadd.' SET info = REPLACE(info, "'.$row1[0][1].'", "photo") WHERE id="'.$row1[0][0].'"'; 
						mysqli_query($con_sql2, $query2);
					}
				
				}
				
				
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabtemp.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(100000);
				}
				
				
				$alt=$row[$con-1][7];
				
		
				$text='Вы указали описание: '.$alt.''.PHP_EOL.''.PHP_EOL.'Пришлите <b>фотографию товара</b> через скрепку слева от окна сообщения. <b>Фотографии необходимо присылать по одной</b> (всего желательно 3-5 шт. в разных ракурсах)👇';
				
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_photo'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_photo']];
				
				
				$text='Пришлите <b>фото товара</b>';
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Пришлите фото'] ),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					usleep(250000);
					
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);

			}
			
			
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicetime.' LIMIT 1')==FALSE)
			{
				mysqli_query($con_sql2, 'CREATE TABLE '.$tabservicetime.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
				usleep(100000);
			}
			else
			{
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetime.'');
				usleep(100000);
			}

	}


 */
 
 
	public function cmd_sell_add_photo_main()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(250000);
		$con=mysqli_num_rows($query);
		
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
		
			if($row[$con-1][8]!="0")
			{
				
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1')==FALSE)
				{
				
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabtemp.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(100000);
					
					mysqli_query($con_sql2, 'INSERT INTO '.$tabtemp.' (info) VALUES ("1")');
					usleep(100000);
					
					$text='<b>Хотите добавить еще фотографии?</b>'.$this->pre.'';
					
					$this->api->sendMessage([
					'text' => $text,
					'disable_notification' => TRUE,
					'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
						
				}
				else
				{						
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' WHERE id="1" LIMIT 1'))==0)
					{
						mysqli_query($con_sql2, 'INSERT INTO '.$tabtemp.' (info) VALUES ("1")');
						usleep(100000);
						
						$text='<b>Хотите добавить еще фотографии?</b>'.$this->pre.'';
					
						$this->api->sendMessage([
						'text' => $text,
						'disable_notification' => TRUE,
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);

					}
				}

			}
			else
			{
				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceadd.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(10)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(100000);
					
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadd.' (info) VALUES ("photo")');
					usleep(100000);
				}
				else
				{
					mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
					usleep(100000);
					
					mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceadd.' (info) VALUES ("photo")');
					usleep(100000);
				}
				
				

				if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1')==FALSE)
				{
					mysqli_query($con_sql2, 'CREATE TABLE '.$tabtemp.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
					usleep(100000);
				}
				
				
				$alt=$row[$con-1][7];
				
		
				$text='Вы указали описание: '.$alt.''.PHP_EOL.''.PHP_EOL.'Пришлите <b>фото товара</b> через скрепку слева от окна сообщения (всего желательно 3-5 шт. в разных ракурсах)👇'.$this->pre.'';
				
				$merge=[];
				$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_photo'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_photo']];
				
				$this->api->sendMessage([
					'text' => $text,
					'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
			}

	}


//////
/* 
	public function cmd_sell_add_useraction_photos()
	{
		
		$con_sql2=$this->cmd_sql();

		$tabmain='tabmain'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabservicetime='tabservicetime'.$this->api->chatId.'';	
		$tabservicetemp='tabservicetemp'.$this->api->chatId.'';			
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id="1"');
		//$query=mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.'');
		$con=mysqli_num_rows($query);
		//usleep(250000);
			
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		//usleep(100000);
			
		$info=$row[0][1];
			
		if($info=='photo')
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
			//usleep(250000);
			$con=mysqli_num_rows($query);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			//usleep(250000);
			
			$timeold=$row[$con-1][10];
			$timenew=$this->api->body['message']['date'];
			

			if(($timenew-$timeold)<3)
			{

				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
				//usleep(250000);
				
				$query3=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicetemp.' WHERE id="1"');
				$con3=mysqli_num_rows($query3);
				//usleep(250000);
					
				for($i3=0;$i3<$con3;$i3++)
				{
					mysqli_data_seek($query3, $i3);
					$row3[$i3]=mysqli_fetch_row($query3);
				}
				//usleep(100000);
					
				$info3=$row3[0][1];
				
				$this->api->deleteMessage([
				'message_id' => $info3
				]);
				
				mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetemp.'');
				//usleep(250000);
				
				//mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabservicetime.'');
				//usleep(250000);
				
				mysqli_query($con_sql2, 'UPDATE '.$tabmain.' SET pic = REPLACE(pic, "'.$row[$con-1][8].'", "0") WHERE id="'.$row[$con-1][0].'"');
				
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicetime.' WHERE id="1" LIMIT 1'))==0)
				{
					
					mysqli_query($con_sql2, 'INSERT INTO '.$tabservicetime.' (info) VALUES ("1")');
					//usleep(250000);
					$text='Вы прислали <b>недопустимое количество фото</b>, пожалуйста, пришлите одно фото👇';
						
						
					$this->api->sendMessage([
					'text' => $text,
					'disable_notification' => TRUE,
					//'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
				}
				
				if($row[$con-1][8]!="0")
				{
					if(preg_match('/;/', $row[$con-1][8])==FALSE)
					{
						$photos=$row[$con-1][8];
						$photos=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos);
						unlink($photos);
						//usleep(100000);
					}
					else
					{
						$photos=explode(';', $row[$con-1][8]);
						$cnt=count($photos);
						
						for($y=0;$y<$cnt;$y++)
						{
							$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
							unlink($photos[$y]);
							//usleep(100000);
						}
					}
					
					
				}
			}
			else
			{
			
				if($this->api->getFile($this->api->body['message']['photo'])==FALSE)
				{
					$this->api->sendMessage([
					'text' => "Что-то пошло не так...",
					'disable_notification' => TRUE,
					'disable_web_page_preview' => TRUE,
					'parse_mode'=> "HTML"
					]);
					//usleep(250000);
				}
				
				$filesdir1=''.dirname(__FILE__).'/filestemp'.$this->api->chatId.'/';
				
				
				if($this->api->changePhoto($filesdir1))
				{
					//usleep(250000);
				}
				
				$filesdir2=''.dirname(__FILE__).'/photos'.$this->api->chatId.'/';
				$files=glob(''.$filesdir2.'*.*');
				$filename1=''.end($files).'';
				$filename1=preg_replace('/.*\//', '', $filename1);
				$filedir1=str_replace(''.dirname(__FILE__).'', 'https://domain.com', $filesdir2);
				$photo="$filedir1$filename1";
				
				
				
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
				//usleep(250000);
				$con=mysqli_num_rows($query);

				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					$row[$i]=mysqli_fetch_row($query);
				}
				//usleep(250000);
				
				if($row[$con-1][8]=="0")
				{
					$photoreplace=''.$photo.'';
				}
				else
				{
					$photoreplace=''.$row[$con-1][8].';'.$photo.'';
				}
					
				
				mysqli_query($con_sql2, 'UPDATE '.$tabmain.' SET pic = REPLACE(pic, "'.$row[$con-1][8].'", "'.$photoreplace.'") WHERE id="'.$row[$con-1][0].'"');
				//usleep(250000);
					
				
				mysqli_query($con_sql2, 'UPDATE '.$tabmain.' SET time = REPLACE(time, "'.$row[$con-1][10].'", "'.time().'") WHERE id="'.$row[$con-1][0].'"');
				//usleep(250000);
				
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' WHERE id="1" LIMIT 1'))==0)
					{
						mysqli_query($con_sql2, 'INSERT INTO '.$tabtemp.' (info) VALUES ("1")');
						//usleep(250000);

						$text='Хотите добавить еще фотографии?';
					
						$result=$this->api->sendMessage([
						'text' => $text,
						'disable_notification' => TRUE,
						'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
						'disable_web_page_preview' => TRUE,
						'parse_mode'=> "HTML"
						]);
						
						$result=json_decode($result, true);
						$messageid=$result['result']['message_id'];
						
						if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicetemp.' LIMIT 1')==FALSE)
						{
							mysqli_query($con_sql2, 'CREATE TABLE '.$tabservicetemp.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(15)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
							//usleep(250000);
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabservicetemp.' (info) VALUES ("'.$messageid.'")');
							//usleep(150000);
						}
						else
						{
							mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabservicetemp.'');
							//usleep(250000);
							
							mysqli_query($con_sql2, 'INSERT INTO '.$tabservicetemp.' (info) VALUES ("'.$messageid.'")');
							//usleep(150000);
						}
					}
				
			}	

		}	

	}

 */



//////
	public function cmd_sell_add_useraction_photos()
	{
		
		$con_sql2=$this->cmd_sql();

		$tabmain='tabmain'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
				

		if($this->api->getFile($this->api->body['message']['photo'])==FALSE)
		{
			$this->api->sendMessage([
			'text' => "Что-то пошло не так...",
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}
		
		$filesdir1=''.dirname(__FILE__).'/filestemp'.$this->api->chatId.'/';
		
		if($this->api->changePhoto($filesdir1))
		{
			usleep(100000);
		}
		
		$filesdir2=''.dirname(__FILE__).'/photos'.$this->api->chatId.'/';
		$files=glob(''.$filesdir2.'*.*');
		$filename1=''.end($files).'';
		$filename1=preg_replace('/.*\//', '', $filename1);
		$filedir1=str_replace(''.dirname(__FILE__).'', 'https://domain.com', $filesdir2);
		$photo="$filedir1$filename1";
		
		if($row[$con-1][8]=="0")
		{
			$photoreplace=''.$photo.'';
		}
		else
		{
			$photoreplace=''.$row[$con-1][8].';'.$photo.'';
		}
			
		$query1='UPDATE '.$tabmain.' SET pic = REPLACE(pic, "'.$row[$con-1][8].'", "'.$photoreplace.'") WHERE id="'.$row[$con-1][0].'"'; 
		mysqli_query($con_sql2, $query1);
		usleep(100000);
			
		
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		{
			if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' WHERE id="1" LIMIT 1'))==0)
			{
				mysqli_query($con_sql2, 'INSERT INTO '.$tabtemp.' (info) VALUES ("1")');
				usleep(100000);

				$text='<b>Хотите добавить еще фотографии?</b>'.$this->pre.'';
			
				$this->api->sendMessage([
				'text' => $text,
				'disable_notification' => TRUE,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			}
	
		}
		else
		{						
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabtemp.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,info VARCHAR(1)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(100000);
			
			mysqli_query($con_sql2, 'INSERT INTO '.$tabtemp.' (info) VALUES ("1")');
			usleep(100000);
			
			$text='<b>Хотите добавить еще фотографии?</b>'.$this->pre.'';
			
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_photo']]),
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
		}

	}





////	
/* 	public function callback_back_sell_add_photo()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';

		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabservicetime='tabservicetime'.$this->api->chatId.'';
		$tabservicetemp='tabservicetemp'.$this->api->chatId.'';
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetime.'');
		usleep(100000);
			
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetemp.'');
		usleep(100000);
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtemp.'');
			usleep(100000);
		//}
		

		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
			
			$this->cmd_sell_add_alt_main();
		
	}
 */

/////
	public function callback_back_sell_add_photo()
	{
		$con_sql2=$this->cmd_sql();
		
		$tab='tabmain'.$this->api->chatId.'';

		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
		usleep(100000);
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}


		$this->cmd_sell_add_alt_main();
	}



////	
/* 	public function callback_exit_sell_add_photo()
	{
		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabservicetime='tabservicetime'.$this->api->chatId.'';
		$tabservicetemp='tabservicetemp'.$this->api->chatId.'';
		$tab='tabmain'.$this->api->chatId.'';
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtemp.'');
			usleep(100000);
		//}	
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}	
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetime.'');
		usleep(100000);
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetemp.'');
		usleep(100000);
			
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
	
	
		
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			

			if($row[$con-1][8]!="0")
			{
				if(preg_match('/;/', $row[$con-1][8])==FALSE)
				{
					$photos=$row[$con-1][8];
					$photos=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos);
					unlink($photos);
					usleep(100000);
				}
				else
				{
					$photos=explode(';', $row[$con-1][8]);
					$cnt=count($photos);
					
					for($y=0;$y<$cnt;$y++)
					{
						$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
						unlink($photos[$y]);
						usleep(100000);
					}
				}
				
				$query1='UPDATE '.$tab.' SET pic = REPLACE(pic, "'.$row[$con-1][8].'", "0") WHERE id="'.$row[$con-1][0].'"'; 
				$result1=mysqli_query($con_sql2, $query1);
			}
		
		
		$filesdir1=''.dirname(__FILE__).'/filestemp'.$this->api->chatId.'/';
		$files=glob(''.$filesdir1.'*.*');
		$cnt2=count($files);
		for($o2=0;$o2<$cnt2;$o2++)
		{
			unlink($files[$o2]);
			usleep(100000);
		}
		
		
		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.';
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.';
						
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
		
		
	}
 */
 
 
 
 
////	
	public function callback_exit_sell_add_photo()
	{
		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
		
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
		usleep(100000);
		
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
		usleep(100000);
		

		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
	
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		
		if($row[$con-1][8]!="0")
		{
			if(preg_match('/;/', $row[$con-1][8])==FALSE)
			{
				$photos=$row[$con-1][8];
				$photos=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos);
				unlink($photos);
				
			}
			else
			{
				$photos=explode(';', $row[$con-1][8]);
				$cnt=count($photos);
				
				for($y=0;$y<$cnt;$y++)
				{
					$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
					unlink($photos[$y]);
					
				}
			}
			
			$query1='UPDATE '.$tabmain.' SET pic = REPLACE(pic, "'.$row[$con-1][8].'", "0") WHERE id="'.$row[$con-1][0].'"'; 
			$result1=mysqli_query($con_sql2, $query1);
		}
		

		if($this->cmd_isadmin())
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default_admin']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
		}
		else
		{
			$text='Вы вышли в <b>Главное меню</b>.'.$this->pre.'';
						
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_default']]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
		}
		
		
	}
	
	
////	
/* 	public function callback_change_sell_add_photo()
	{
		
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';

		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabservicetime='tabservicetime'.$this->api->chatId.'';
		$tabservicetemp='tabservicetemp'.$this->api->chatId.'';
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetime.'');
		usleep(100000);
			
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetemp.'');
		usleep(100000);
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtemp.'');
			usleep(100000);
		//}
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
					
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				$row[$i]=mysqli_fetch_row($query);
			}
			
					
			if($row[$con-1][8]!="0")
			{
				if(preg_match('/;/', $row[$con-1][8])==FALSE)
				{
					$photos=$row[$con-1][8];
					$photos=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos);
					unlink($photos);
					//usleep(100000);
				}
				else
				{
					$photos=explode(';', $row[$con-1][8]);
					$cnt=count($photos);
					
					for($y=0;$y<$cnt;$y++)
					{
						$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
						unlink($photos[$y]);
						//usleep(100000);
					}
				}
				
				$query1='UPDATE '.$tab.' SET pic = REPLACE(pic, "'.$row[$con-1][8].'", "0") WHERE id="'.$row[$con-1][0].'"'; 
				$result1=mysqli_query($con_sql2, $query1);
			}
			
			$filesdir1=''.dirname(__FILE__).'/filestemp'.$this->api->chatId.'/';
			$files=glob(''.$filesdir1.'*.*');
			$cnt2=count($files);
			for($o2=0;$o2<$cnt2;$o2++)
			{
				unlink($files[$o2]);
				//usleep(100000);
			}
		
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			

			$this->cmd_sell_add_photo_main();
		
	}

 */
 
 
 
////	
	public function callback_change_sell_add_photo()
	{
		$this->api->sendChatAction([
		'action'=> 'upload_photo'
		]);
		sleep(5);
		$this->api->sendChatAction([
		'action'=> 'upload_photo'
		]);
		sleep(5);
		$con_sql2=$this->cmd_sql();
		$tab='tabmain'.$this->api->chatId.'';

		$tabtemp='tabtempphoto'.$this->api->chatId.'';

		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
		usleep(100000);
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tab.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
					
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		
		if($row[$con-1][8]!="0")
		{
			if(preg_match('/;/', $row[$con-1][8])==FALSE)
			{
				$photos=$row[$con-1][8];
				$photos=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos);
				unlink($photos);
			}
			else
			{
				$photos=explode(';', $row[$con-1][8]);
				$cnt=count($photos);
				
				for($y=0;$y<$cnt;$y++)
				{
					$photos[$y]=str_replace('https://domain.com', ''.dirname(__FILE__).'', $photos[$y]);
					unlink($photos[$y]);
				}
			}
			
			$query1='UPDATE '.$tab.' SET pic = REPLACE(pic, "'.$row[$con-1][8].'", "0") WHERE id="'.$row[$con-1][0].'"'; 
			$result1=mysqli_query($con_sql2, $query1);
		}
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		
		$this->cmd_sell_add_photo_main();	
	}


/////
/* 
public function callback_inline_photo_yes()
	{
		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabservicetime='tabservicetime'.$this->api->chatId.'';
		$tabservicetemp='tabservicetemp'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetime.'');
		usleep(100000);
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicetemp.' WHERE id="1"');
		usleep(250000);
		$con=mysqli_num_rows($query);

		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$info=$row[0][1];
				
		$this->api->deleteMessage([
		'message_id' => $info
		]);
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetemp.'');
		usleep(100000);
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtemp.'');
			usleep(100000);
		//}
		else
		{
			if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' WHERE id LIKE "%" LIMIT 1'))!=0)
			{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
				usleep(250000);
			}
			else
			{
				mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
				usleep(250000);
			}
		}
		
		$text="Пришлите <b>еще одно фото товара</b> через скрепку слева от окна сообщения👇";
		$this->api->sendMessage([
		'text' => $text,
		//'reply_markup' => json_encode( ['force_reply' => true, 'input_field_placeholder' => 'Пришлите еще фото товара'] ),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		

	}
	 */



/////
	public function callback_inline_photo_yes()
	{
		$this->api->sendChatAction([
		'action'=> 'upload_photo'
		]);
		sleep(5);
		$this->api->sendChatAction([
		'action'=> 'upload_photo'
		]);
		sleep(5);
		
		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
		usleep(100000);
		
		
		$text='Пришлите <b>еще фото товара</b> через скрепку слева от окна сообщения👇'.$this->pre.'';
		$this->api->sendMessage([
		'text' => $text,
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		

	}

	
/////
/* 	public function callback_inline_photo_no()
	{
		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabservicetime='tabservicetime'.$this->api->chatId.'';
		$tabservicetemp='tabservicetemp'.$this->api->chatId.'';
		
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabtemp.'');
			usleep(100000);
		//}	
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'DROP TABLE '.$tabserviceadd.'');
			usleep(100000);
		//}	
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetime.'');
		usleep(100000);
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicetemp.' WHERE id="1"');
		usleep(250000);
		$con=mysqli_num_rows($query);

		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		
		$info=$row[0][1];
				
		$this->api->deleteMessage([
		'message_id' => $info
		]);
		
		mysqli_query($con_sql2, 'DROP TABLE '.$tabservicetemp.'');
		usleep(100000);

		$this->cmd_sell_add_useraction_photos_complete();	
	}
 */



/////
	public function callback_inline_photo_no()
	{
		$this->api->sendChatAction([
		'action'=> 'upload_photo'
		]);
		sleep(5);
		$this->api->sendChatAction([
		'action'=> 'upload_photo'
		]);
		sleep(5);
		$this->api->sendChatAction([
		'action'=> 'upload_photo'
		]);
		sleep(4);
		//sleep(14);
		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
				
		if(isset($this->api->body['callback_query']["id"]))
		{
			$callback_query_id=$this->api->body['callback_query']["id"];
			$this->api->answerCallbackQuery($callback_query_id);
		}
		
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
		usleep(100000);
		
		mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
		usleep(100000);


		$this->cmd_sell_add_useraction_photos_complete();	
	}


//////
	public function cmd_sell_add_useraction_photos_complete()
	{
		
		$con_sql2=$this->cmd_sql();

		$tabmain='tabmain'.$this->api->chatId.'';

		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id LIKE "%" ORDER by id ASC');
		usleep(100000);
		$con=mysqli_num_rows($query);
	
		
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
		usleep(100000);
		
		$date=date("d.m.Y");
		$time=time();
		
		$query2='UPDATE '.$tabmain.' SET date = REPLACE(date, "'.$row[$con-1][9].'", "'.$date.'") WHERE id="'.$row[$con-1][0].'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		$query2='UPDATE '.$tabmain.' SET time = REPLACE(time, "'.$row[$con-1][10].'", "'.$time.'") WHERE id="'.$row[$con-1][0].'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		$query2='UPDATE '.$tabmain.' SET chatid = REPLACE(chatid, "'.$row[$con-1][13].'", "'.$this->api->chatId.'") WHERE id="'.$row[$con-1][0].'"'; 
		$result2=mysqli_query($con_sql2, $query2);
		usleep(100000);
		/* $text='<b>Объявление №'.$row[$con-1][0].'</b>';
		
		$this->api->sendMessage([
		'text' => $text,
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> 'HTML'
		]);
		usleep(100000); */
		
						
		$type=$this->convert_rus($row[$con-1][1]);
		$cat=$this->convert_rus($row[$con-1][2]);
		$gender=$this->convert_rus($row[$con-1][3]);
		$cond=$this->convert_rus($row[$con-1][12]);
		
		$caption='<b>Объявление №'.$row[$con-1][0].'</b>'.PHP_EOL.''.PHP_EOL.'📖Категория: <b>'.$type.'</b>'.PHP_EOL.'🧾Вид: <b>'.$cat.'</b>'.PHP_EOL.'👨‍👩‍👦Пол: <b>'.$gender.'</b>'.PHP_EOL.'🎏Состояние: <b>'.$cond.'</b>'.PHP_EOL.'®️Бренд: <b>'.$row[$con-1][4].'</b>'.PHP_EOL.'↕️Размер: <b>'.$row[$con-1][5].'</b>'.PHP_EOL.'💵Цена: <b>'.$row[$con-1][6].'</b>'.PHP_EOL.'📋Описание: '.$row[$con-1][7].'';
		
		$photo=$row[$con-1][8];
		
		
		
		
		if(preg_match('/;/', $photo)==FALSE)
		{
			$this->api->sendPhoto([
			'photo' => $photo,
			'caption' => $caption,
			'disable_notification' => TRUE,
			'parse_mode' => "HTML"
			]);
			
		usleep(100000);
		}
		else
		{
			$media=[];
			$temp=explode(';', $photo);
			$cnt=count($temp);
			for($o=0;$o<$cnt;$o++)
			{
			
			
				if($o==0)
				{
					$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'', 'caption' => ''.$caption.'', 'parse_mode' => "HTML" ];
				}
				else
				{
					$put=['type' => 'photo', 'media' =>  ''.$temp[$o].'' ];
				}
		
				$media[$o]=$put;
			}
			
			
			$this->api->sendMediaGroup([
			'media' => json_encode($media),
			]);
			usleep(100000);
		}
		
		
		$text='Спасибо! Ваше объявление <b>№'.$row[$con-1][0].' успешно добавлено!</b>'.PHP_EOL.''.PHP_EOL.'Сверху вы видите, как объявление будет выглядеть в канале. Если Вы указали неверные данные, нажмите кнопку <b>Удалить объявление</b> и начните добавление заново.'.PHP_EOL.''.PHP_EOL.'Если все указано верно, нажмите кнопку <b>Отправить в канал.</b> При этом объявление будет <b>отправлено на модерацию</b>. В случае успешной модерации, Ваше объявление будет размещено в канале. <b>Вам прийдет служебное уведомление о результатах.</b>'.$this->pre.'';
		
		$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell_moderate']]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);

	}


/////
public function callback_inline_add_send_moderate()
	{
		
		$userfio=$this->cmd_user_get_fio($this->api->chatId);
		$userphone=$this->cmd_user_get_phone($this->api->chatId);
		$text1=$this->api->textmessage;
		
		preg_match_all('/№.*успешно/', $text1, $out2);
		
		$record=preg_replace('/№/', '', $out2[0][0]);
		$record=preg_replace('/успешно/', '', $record);
		$record=$this->clean($record);
		
		$con_sql2=$this->cmd_sql();
		$tabserviceask='tabserviceask'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceask.' LIMIT 1')==FALSE)
		{
			mysqli_query($con_sql2, 'CREATE TABLE '.$tabserviceask.' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,record VARCHAR(20)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
			usleep(250000);
		}
		
		
		$query1=mysqli_query($con_sql2, 'SELECT DISTINCT record FROM '.$tabserviceask.' WHERE id LIKE "%"');
		usleep(100000);
		$con1=mysqli_num_rows($query1);
		
		$tabletemp=[];
		
		for($i=0;$i<$con1;$i++)
		{
			mysqli_data_seek($query1, $i);
			$row1[$i]=mysqli_fetch_row($query1);
			$tabletemp[]=$row1[$i][0];	
		}
		
		if(in_array($record, $tabletemp)==FALSE)
		{
			mysqli_query($con_sql2, 'INSERT INTO '.$tabserviceask.' (record) VALUES ("'.$record.'")');
			usleep(100000);

			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			
			$text='Пользователь 👤<b>'.$userfio.' ('.$userphone.')</b> добавил объявление <b>№'.$record.'</b> для размещения в канале. Что вы хотите сделать с данным объявлением?'.$this->pre.'';
			$this->api->sendMessage([
				'chat_id' => $this->chatidadmin,
				'text' => $text,
				'parse_mode' => "HTML",
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_ask_admin_channel']]),
				]);
			
			$text='Вы успешно отправили Ваше объявление <b>№'.$record.'</b> на <b>модерацию админу</b>. Вам придет уведомление о результатах.'.$this->pre.'';
			
			$this->api->editMessageText([
				'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
				'message_id' => $this->api->body['callback_query']['message']['message_id'],
				'text' => $text,
				'parse_mode' => "HTML",
				'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
			]);
			usleep(100000);
				
			/* $this->api->sendMessage([
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']]),
			]); */
		}
		else
		{
			$text='Вы уже отправили данное объявление <b>№'.$record.'</b> на <b>модерацию админу</b>. Имейте терпение!'.$this->pre.'';
			
			if(isset($this->api->body['callback_query']["id"]))
			{
				$callback_query_id=$this->api->body['callback_query']["id"];
				$this->api->answerCallbackQuery($callback_query_id);
			}
			
			$this->api->editMessageText([
			'chat_id' => $this->api->body['callback_query']['message']['chat']["id"],
			'message_id' => $this->api->body['callback_query']['message']['message_id'],
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$this->keyboards['inline_sell']] ),
			]);
		}
	}


/////
public function callback_inline_add_send_delete()
	{
		
		$userfio=$this->cmd_user_get_fio($this->api->chatId);
		$userphone=$this->cmd_user_get_phone($this->api->chatId);
		$text1=$this->api->textmessage;
		
		preg_match_all('/№.*успешно/', $text1, $out2);
		
		$record=preg_replace('/№/', '', $out2[0][0]);
		$record=preg_replace('/успешно/', '', $record);
		$record=$this->clean($record);

		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
				
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
			usleep(250000);
		//}	
		
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(250000);
		//}	
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabmain.' WHERE id="'.$record.'"');
		$con=mysqli_num_rows($query);
				
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			$row[$i]=mysqli_fetch_row($query);
		}
			
		mysqli_query($con_sql2, 'UPDATE '.$tabmain.' SET pic = REPLACE(pic, "'.$row[0][8].'", "0") WHERE id="'.$record.'"');
		usleep(250000);
		
		//mysqli_query($con_sql2, 'DELETE FROM '.$tabmain.' WHERE id="'.$record.'"');
		//usleep(100000);
				
		$text='Ваше объявление было успешно удалено. Вы находитесь в подменю <b>Продать</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_sell']);
	}
	

/////
public function callback_inline_add_send_later()
	{
		
		$userfio=$this->cmd_user_get_fio($this->api->chatId);
		$userphone=$this->cmd_user_get_phone($this->api->chatId);
		$text1=$this->api->textmessage;
		
		preg_match_all('/№.*успешно/', $text1, $out2);
		
		$record=preg_replace('/№/', '', $out2[0][0]);
		$record=preg_replace('/успешно/', '', $record);
		$record=$this->clean($record);

		$con_sql2=$this->cmd_sql();
		$tabtemp='tabtempphoto'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabmain='tabmain'.$this->api->chatId.'';
				
		//if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabtemp.' LIMIT 1'))
		//{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabtemp.'');
			usleep(250000);
		//}	
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1'))
		{
			mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabserviceadd.'');
			usleep(250000);
		}	

		$text='Ваше объявление <b>№'.$record.'</b> было успешно сохранено. Вы находитесь в разделе <b>Продать</b>.'.$this->pre.'';
		$this->callbackAnswer( $text, $this->keyboards['inline_sell']);
	}


///////////////////////////////////////////////////////////////////////
/////	
	public function cmd_default(){
		$this->api->sendMessage( 'Данная команда не поддерживается'.$this->pre.'' );
	}
	
/////	
	public function cmd_default1(){
		$this->api->sendMessage( 'Такие данные не принимаются'.$this->pre.'' );
	}
	
/////	
	public function cmd_sell_add_adminaction_text()
	{
		
		$con_sql2=$this->cmd_sql();

		$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		
		if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadmin.' WHERE id LIKE "%"');
			usleep(100000);
			$con=mysqli_num_rows($query);
			usleep(50000);
			
				
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				usleep(50000);
				$row[$i]=mysqli_fetch_row($query);
				usleep(50000);
			}
			
			$info=$row[0][1];
			
			if($info=='show')
			{
				$this->cmd_admin_show_records_channel();
			}
			elseif($info=='delete')
			{
				$this->cmd_admin_delete_records_channel();
			}
			elseif($info=='sendsold')
			{
				$this->cmd_admin_sendsold_records_channel();
			}
			elseif($info=='orders')
			{
				$this->cmd_admin_orders_records_channel();
			}
			elseif($info=='sold')
			{
				$this->cmd_admin_sold_records_channel();
			}
		}		
		elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
		{
			$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id LIKE "%"');
			usleep(100000);
			$con=mysqli_num_rows($query);
			usleep(50000);
			
			for($i=0;$i<$con;$i++)
			{
				mysqli_data_seek($query, $i);
				usleep(50000);
				$row[$i]=mysqli_fetch_row($query);
				usleep(50000);
			}
			
			$info=$row[0][1];
			
			if($info=='brand')
			{
				$this->cmd_sell_add_brand();
			}
			elseif($info=='size')
			{
				$this->cmd_sell_add_size();
			}
			elseif($info=='price')
			{
				$this->cmd_sell_add_price();
			}
			elseif($info=='alt')
			{
				$this->cmd_sell_add_alt();
			}
		}
		else
		{
			$this->cmd_default();
		}

	}



/////
	public function cmd_sell_add_useraction_text()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabmain='tabmain'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabservicefio='tabservicefio'.$this->api->chatId.'';
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicefio.' LIMIT 1'))
		{
			$this->cmd_admin_add_fio();
		}

	}


/////
/* 	public function cmd_sell_add_useraction_text()
	{
		
		$con_sql2=$this->cmd_sql();
		$tabmain='tabmain'.$this->api->chatId.'';
		$tabserviceadd='tabserviceadd'.$this->api->chatId.'';
		$tabservicefio='tabservicefio'.$this->api->chatId.'';
		$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
		
		if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicefio.' LIMIT 1'))
		{
			$this->cmd_admin_add_fio();
		}
		else
		{
			if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' LIMIT 1'))
			{
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
				{
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceuser.' WHERE id LIKE "%"');
					usleep(100000);
					$con=mysqli_num_rows($query);
					usleep(50000);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						usleep(50000);
						$row[$i]=mysqli_fetch_row($query);
						usleep(50000);
					}
					
					
					$info=$row[0][1];
					
					if($info=='byrecordid')
					{
						$this->cmd_byrecordid_default_buy();
					}
					
				}
				elseif(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1'))
				{
				
					if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
					{
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id LIKE "%" ORDER by id ASC');
						usleep(100000);
						$con=mysqli_num_rows($query);
						usleep(50000);
						
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							usleep(50000);
							$row[$i]=mysqli_fetch_row($query);
							usleep(50000);
						}
						
						$info=$row[0][1];
						
						if($info=='brand')
						{
							$this->cmd_sell_add_brand();
						}
						elseif($info=='size')
						{
							$this->cmd_sell_add_size();
						}
						elseif($info=='price')
						{
							$this->cmd_sell_add_price();
						}
						elseif($info=='alt')
						{
							$this->cmd_sell_add_alt();
						}
					}
					else
					{
						$this->cmd_default();
					}
				}
				else
				{
					$this->cmd_default();
				}
			}
			elseif(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1'))
			{
			
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id LIKE "%" LIMIT 1'))!=0)
				{
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id LIKE "%" ORDER by id ASC');
					usleep(100000);
					$con=mysqli_num_rows($query);
					usleep(50000);
					
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						usleep(50000);
						$row[$i]=mysqli_fetch_row($query);
						usleep(50000);
					}
					
					$info=$row[0][1];
					
					if($info=='brand')
					{
						$this->cmd_sell_add_brand();
					}
					elseif($info=='size')
					{
						$this->cmd_sell_add_size();
					}
					elseif($info=='price')
					{
						$this->cmd_sell_add_price();
					}
					elseif($info=='alt')
					{
						$this->cmd_sell_add_alt();
					}
				}
				else
				{
					$this->cmd_default();
				}
			}
			else
			{
				$this->cmd_default();
			}
		
		}

	} */

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
/* 	function callbackAnswer( $text, $keyboard ){
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
	} */	
	
	public function callbackAnswer( $text, $keyboard ){
		$this->api->answerCallbackQuery( $this->result['callback_query']["id"] );
				
		$this->api->editMessageText([
			'chat_id' => $this->result['callback_query']['message']['chat']["id"],
			'message_id' => $this->result['callback_query']['message']['message_id'],
			'text' => $text,
			'parse_mode' => "HTML",
			'reply_markup' => json_encode( ['inline_keyboard'=>$keyboard] ),
		]);
	}
	
/////	
	public function callbackAnswer1( $text, $keyboard ){

		$this->api->answerCallbackQuery([
			'callback_query_id' => $this->result['callback_query']["id"],
			'text' => $text,
			'show_alert' => false,
		]);
		
		$this->api->sendMessage([
			'text'=> $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$keyboard]),
			'parse_mode'=> "HTML",
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			]);
			
		$id=$this->api->messageid;
		
		$this->api->deleteMessage($id);
	}	

	
/////	
	public function callbackAnswer2( $text, $keyboard ){
		
		
		$this->api->answerCallbackQuery([
			'callback_query_id' => $this->result['callback_query']["id"],
			'text' => $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$keyboard]),
			//'show_alert' => true
		]);
		
		$id=$this->api->messageid;
		
		$this->api->deleteMessage($id);
	}	
	
/////	
	public function callbackAnswer3( $text ){

		$this->api->answerCallbackQuery([
			'callback_query_id' => $this->api->body['callback_query']["id"],
			'text' => $text,
			'parse_mode'=> "HTML"
		]);
	}	


/////	
	public function callbackAnswer4( $text, $keyboard ){

		$this->api->answerCallbackQuery([
			'callback_query_id' => $this->result['callback_query']["id"],
			'text' => 'Выборка готова!',
			'show_alert' => false,
		]);
		
		$this->api->sendMessage([
			'text'=> $text,
			'reply_markup' => json_encode( ['inline_keyboard'=>$keyboard]),
			'parse_mode'=> "HTML",
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			]);

	}

/////
	public function callbackAnswer5( $text ){
		$this->api->answerCallbackQuery([
			'callback_query_id' => $this->result['callback_query']["id"],
			'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$keyboard]),
			//'show_alert' => true
		]);
		
		$id=$this->api->messageid;
		
		$this->api->deleteMessage($id);
		
	}		
	
	
/////
	public function callbackAnswer6( $text ){
		$this->api->answerCallbackQuery([
			'callback_query_id' => $this->result['callback_query']["id"],
			//'text' => $text,
			//'reply_markup' => json_encode( ['inline_keyboard'=>$keyboard]),
			//'show_alert' => true
		]);
		
		$id=$this->api->messageid;
		
		$this->api->deleteMessage($id);
		
		$this->api->sendMessage([
			'text'=> $text,
			'parse_mode'=> "HTML",
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			]);
		
	}

///
	public function mailing( $message, $userIdList, $params = null ){
		$errors = false;
		for( $i=0; $i < count($userIdList); $i++ ){
			$defaults = [
					'chat_id' => $userIdList[$i],
					'text' => $message,
					'parse_mode'=> "HTML"
				];
			$params = is_array( $params ) ? array_merge( $params, $defaults ) : $defaults;
			try{
				$this->api->sendMessage( $params );
			}
			catch( Exception $e ){
				if( !is_array( $errors ) ){
					$errors = array();
				}
				$errors[] = $userIdList[$i];
			}
		}
		return $errors;
	}
	

/////	
	public function getChat( $params ){
		if( !is_array( $params ) ){
			$params = ['chat_id' => $params];
		}
		return $this->api->call("getChat", $params);
	}
		
////////

    public function __construct( $token = null ){
		if( !isset( $this->token ) && !isset( $token ) ){
			$this->showWebhookForm();
		}
		if( !isset( $this->token ) && isset( $token ) ){
			$this->token = $token;
		}
		$this->api = new TelegramBotApi( $this->token );		
		
		if( $this->proxy ){
			$this->api->proxy = $this->proxy;
		}
	
		/* if(class_exists('TelegramBotfunc'))
		{
			$this->func = new TelegramBotfunc();
			
		} */
		
		$this->api->debug = true;
		//$this->api->debug = false;
	}

///
	public function replyCommand(){
		
		$this->result = $this->api->getWebhookUpdate();
		
		if( !empty($this->result) )
		{
			
			if( isset( $this->result['callback_query'] ) )
			{
				$this->callCallback();
			}
			else
			{
				$this->callCommand();
			}
		}
		else
		{
			echo "good";
			exit;
		}
	}


///	
	public function callCallback()
	{
		
		if(file_exists(''.dirname(__FILE__).'/include'.$this->api->chatId.'.php'))
		{
			require_once(''.dirname(__FILE__).'/include'.$this->api->chatId.'.php');
		}

		if(class_exists('TelegramBotfunc'))
		{
			$this->func = new TelegramBotfunc();
		}
		
		$query = explode(" ", $this->result['callback_query']['data'] );
		$cmd = "callback_{$query[0]}";
		//if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt')))
		if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersall.txt')))
		{
			if( method_exists( $this, $cmd ) )
			{
				$this->$cmd( $this->result['callback_query']['data'] );
			}
			elseif( method_exists( $this->func, $cmd ) )
			{
				$this->func->$cmd( $this->result['callback_query']['data'] );
			}
			else
			{
				$this->callback_default( $this->result['callback_query']['data'] );
			}
		}
		else
		{
			
			$tabserviceusers='tabserviceusers';
			$tabservicebanned='tabservicebanned';
			
			if($this->cmd_sql_searchchatidtable($tabservicebanned, $this->api->chatId)==FALSE)
			{
				
				if($this->cmd_sql_searchchatidtable($tabserviceusers, $this->api->chatId))
				{
					if( method_exists( $this, $cmd ) )
					{
						$this->$cmd( $this->result['callback_query']['data'] );
					}
					elseif( method_exists( $this->func, $cmd ) )
					{
						$this->func->$cmd( $this->result['callback_query']['data'] );
					}
					else
					{
						$this->callback_default( $this->result['callback_query']['data'] );
					}
				}
			}
		}
	}



	
///
/* 	public function callCommand()
	{
		if($this->result["message"])
		{
			
			$tabserviceapproved='tabserviceapproved';
			$tabservicewant='tabservicewant';
			$tabservicebanned='tabservicebanned';
			$tabserviceusers='tabserviceusers';
			
			if($this->cmd_isadmin())
			{
				
				$con_sql2=$this->cmd_sql();
				
				$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';	
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadmin.' WHERE id="1"');
				usleep(250000);
				$con=mysqli_num_rows($query);
				usleep(50000);
				
				$row=[];
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					usleep(50000);
					$row[$i]=mysqli_fetch_row($query);
					usleep(50000);
				}
				
				$info=$row[0][1];
				
				if($info=='message')
				{
					$this->cmd_admin_sendmessageapprovedusers();
				}
				elseif($this->result["message"]["text"])
				{
					$text=$this->result["message"]["text"];
					$cmd=$this->getCommand($text);
					if($cmd)
					{
						$this->$cmd();
					}
					else
					{
						$this->cmd_sell_add_adminaction_text();
					}
				}
				elseif($this->result["message"]["photo"])
				{
				
					$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	

					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id="1"');
					usleep(100000);
					$con=mysqli_num_rows($query);
					usleep(50000);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						usleep(50000);
						$row[$i]=mysqli_fetch_row($query);
						usleep(50000);
					}
						
					$info=$row[0][1];
						
					if($info=='photo')
					{
						$this->cmd_sell_add_useraction_photos();
					}
				}
				else
				{
					$this->cmd_default1();
				}
				
			}
			else
			{
				//if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt')))
				if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersall.txt')))
				{
						
					$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	
					$tabservicefio='tabservicefio'.$this->api->chatId.'';
					$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
					$tabservicetime='tabservicetime'.$this->api->chatId.'';
							
					$con_sql2=$this->cmd_sql();
					
					if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicefio.' LIMIT 1'))
					{
						if($this->result["message"]["text"])
						{
							$this->cmd_admin_add_fio();
						}
						else
						{
							$this->cmd_admin_text_error();
						}
						
					}
					//elseif(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' LIMIT 1'))
					//{
						elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id="1" LIMIT 1'))!=0)
						{
							
							$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id="1"');
							//usleep(100000);
							$con=mysqli_num_rows($query);
							//usleep(50000);
							
							$row=[];
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								//usleep(50000);
								$row[$i]=mysqli_fetch_row($query);
								//usleep(50000);
							}
								
							$info=$row[0][1];
							
							if($info=='photo')
							{
								
								$query1=mysqli_query($con_sql2, 'SELECT * FROM '.$tabservicetime.' WHERE id="1"');
								
								$con1=mysqli_num_rows($query1);
							
								$row1=[];
								for($i1=0;$i1<$con1;$i1++)
								{
									mysqli_data_seek($query1, $i1);
									//usleep(50000);
									$row1[$i1]=mysqli_fetch_row($query1);
									//usleep(50000);
								}
									
								$info1=$row1[0][1];
								
								if($info1!="1")
								{
									if($this->result["message"]["photo"])
									{
										$this->cmd_sell_add_useraction_photos();
									}
									else
									{
										$this->cmd_admin_photo_error();
									}
								}
								else
								{
									mysqli_query($con_sql2, 'TRUNCATE TABLE '.$tabservicetime.'');
									exit;
								}
							}
							else
							{
								if($this->result["message"]["text"])
								{
									if($info=='brand')
									{
										$this->cmd_sell_add_brand();
									}
									elseif($info=='size')
									{
										$this->cmd_sell_add_size();
									}
									elseif($info=='price')
									{
										$this->cmd_sell_add_price();
									}
									elseif($info=='alt')
									{
										$this->cmd_sell_add_alt();
									}
								}
								else
								{
									$this->cmd_admin_text_error();
								}
							}
						}
					//}
					//elseif(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' LIMIT 1'))
					//{
						elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id="1" LIMIT 1'))!=0)
						{
							$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceuser.' WHERE id="1"');
							//usleep(100000);
							$con=mysqli_num_rows($query);
							//usleep(50000);
							
							$row=[];
							for($i=0;$i<$con;$i++)
							{
								mysqli_data_seek($query, $i);
								//usleep(50000);
								$row[$i]=mysqli_fetch_row($query);
								//usleep(50000);
							}
							
							
							$info=$row[0][1];
							if($this->result["message"]["text"])
							{
								if($info=='byrecordid')
								{
									$this->cmd_byrecordid_default_buy();
								}
							}
							else
							{
								$this->cmd_admin_text_error();
							}
						}
					//}
					elseif($this->result["message"]["text"])
					{
						
						
						$text=$this->result["message"]["text"];
						
						$cmd=$this->getCommand($text);
						if($cmd)
						{
							$this->$cmd();
						}
						else
						{
							$this->cmd_default();
						}
					}
					else
					{
						$this->cmd_default1();
					}

				}
				//elseif(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersbanned.txt')))
				elseif($this->cmd_sql_searchchatidtable($tabservicebanned, $this->api->chatId))
				{
					//$text='К сожалению, Вы забанены админом!';
					//$this->api->sendMessage( $text );
				}
				//elseif(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/userswant.txt')))
				elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId))
				{
					$text='Вы уже отправили запрос админу! Потерпите немного!';
					$this->api->sendMessage( $text );
				}
				elseif($this->result["message"]["contact"]["phone_number"])
				{
					$this->cmd_admin_add_phone();
				}
				else
				{
					$text=$this->result["message"]["text"];
						$cmd=$this->getCommand($text);
						if($cmd)
						{
							$this->$cmd();
						}
						else
						{
							
							$this->cmd_sell_add_useraction_text();
							if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicefio.' LIMIT 1'))
							{
								if($this->result["message"]["text"])
								{
									$this->cmd_admin_add_fio();
								}
								else
								{
									$this->cmd_admin_text_error();
								}
							}
						}
					//$this->cmd_sell_add_useraction_text();
					//$this->cmd_start();
					$this->api->sendMessage([
				'text' => "nfgnfgfgn",
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				}
			}
			
		}
		
	}
 */



///
	public function callCommand()
	{
		if($this->result["message"])
		{
			
			$tabserviceapproved='tabserviceapproved';
			$tabservicewant='tabservicewant';
			$tabservicebanned='tabservicebanned';
			$tabserviceusers='tabserviceusers';
			
			if($this->cmd_isadmin())
			{
				
				$con_sql2=$this->cmd_sql();
				$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	
				$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
				$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';
				
				if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadmin.' WHERE id="1" LIMIT 1'))!=0)
				{					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadmin.' WHERE id="1"');
					$con=mysqli_num_rows($query);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					$info=$row[0][1];
					
					if($info=='message')
					{
						$this->cmd_admin_sendmessageapprovedusers();
					}
					elseif($info=='show')
					{
						$this->cmd_admin_show_records_channel();
					}
					elseif($info=='delete')
					{
						$this->cmd_admin_delete_records_channel();
					}
					elseif($info=='sendsold')
					{
						$this->cmd_admin_sendsold_records_channel();
					}
					elseif($info=='orders')
					{
						$this->cmd_admin_orders_records_channel();
					}
					elseif($info=='sold')
					{
						$this->cmd_admin_sold_records_channel();
					}
				}
				elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id="1" LIMIT 1'))!=0)
				{
					
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id="1"');
					$con=mysqli_num_rows($query);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
						
					$info=$row[0][1];
					
					if($info=='photo')
					{
						if($this->result["message"]["photo"])
						{
							$this->cmd_sell_add_useraction_photos();
						}
						/* else
						{
							$this->cmd_admin_photo_error();
						} */
					}
					else
					{
						if($this->result["message"]["text"])
						{
							if($info=='brand')
							{
								$this->cmd_sell_add_brand();
							}
							elseif($info=='size')
							{
								$this->cmd_sell_add_size();
							}
							elseif($info=='price')
							{
								$this->cmd_sell_add_price();
							}
							elseif($info=='alt')
							{
								$this->cmd_sell_add_alt();
							}
						}
						else
						{
							$this->cmd_admin_text_error();
						}
					}
				}
				elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id="1" LIMIT 1'))!=0)
				{
					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceuser.' WHERE id="1"');
					$con=mysqli_num_rows($query);
				
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						$row[$i]=mysqli_fetch_row($query);
					}
					
					$info=$row[0][1];
					
					if($this->result["message"]["text"])
					{
						if($info=='byrecordid')
						{
							$this->cmd_byrecordid_default_buy();
						}
					}
					else
					{
						$this->cmd_admin_text_error();
					}
				}
				elseif($this->result["message"]["text"])
				{
				
					$text=$this->result["message"]["text"];
					
					$cmd=$this->getCommand($text);
					if($cmd)
					{
						$this->$cmd();
					}
				}
				else
				{
					$this->cmd_default();
				}
				
			}
			else
			{
				if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersall.txt')))
				{
						
					$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	
					$tabservicefio='tabservicefio'.$this->api->chatId.'';
					$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
												
					$con_sql2=$this->cmd_sql();
					
					if(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabservicefio.' LIMIT 1'))
					{
						if($this->result["message"]["text"])
						{
							$this->cmd_admin_add_fio();
						}
						else
						{
							$this->cmd_admin_text_error();
						}
						
					}
					elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id="1" LIMIT 1'))!=0)
					{
						
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id="1"');
						$con=mysqli_num_rows($query);
						
						$row=[];
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
							
						$info=$row[0][1];
						
						if($info=='photo')
						{
							if($this->result["message"]["photo"])
							{
								$this->cmd_sell_add_useraction_photos();
							}
							/* else
							{
								$this->cmd_admin_photo_error();
							} */
						}
						else
						{
							if($this->result["message"]["text"])
							{
								if($info=='brand')
								{
									$this->cmd_sell_add_brand();
								}
								elseif($info=='size')
								{
									$this->cmd_sell_add_size();
								}
								elseif($info=='price')
								{
									$this->cmd_sell_add_price();
								}
								elseif($info=='alt')
								{
									$this->cmd_sell_add_alt();
								}
							}
							else
							{
								$this->cmd_admin_text_error();
							}
						}
					}
					elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id="1" LIMIT 1'))!=0)
					{
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceuser.' WHERE id="1"');
						$con=mysqli_num_rows($query);
					
						$row=[];
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							$row[$i]=mysqli_fetch_row($query);
						}
						
						$info=$row[0][1];
						
						if($this->result["message"]["text"])
						{
							if($info=='byrecordid')
							{
								$this->cmd_byrecordid_default_buy();
							}
						}
						else
						{
							$this->cmd_admin_text_error();
						}
					}
					elseif($this->result["message"]["text"])
					{

						$text=$this->result["message"]["text"];
						
						$cmd=$this->getCommand($text);
						if($cmd)
						{
							$this->$cmd();
						}
					}
				}
				elseif($this->cmd_sql_searchchatidtable($tabservicebanned, $this->api->chatId))
				{	
				}
				elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId))
				{
					$text='Вы уже отправили запрос админу! Потерпите немного!'.$this->pre.'';
					$this->api->sendMessage( $text );
				}
				elseif($this->result["message"]["contact"]["phone_number"])
				{
					$this->cmd_admin_add_phone();
				}
				else
				{
					
					$text=$this->result["message"]["text"];
					$cmd=$this->getCommand($text);
					if($cmd)
					{
						$this->$cmd();
					}
					else
					{
						$this->cmd_sell_add_useraction_text();
					}
				}
			}
		}
	}
	
	
/////
public function cmd_admin_text_error()
{
	
	$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	
	$tabservicefio='tabservicefio'.$this->api->chatId.'';
	$tabserviceuser='tabserviceuser'.$this->api->chatId.'';
			
	$con_sql2=$this->cmd_sql();
	
	if(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceadd.' WHERE id="1" LIMIT 1'))!=0)
	{
		
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id="1"');
		usleep(100000);
		$con=mysqli_num_rows($query);
		usleep(50000);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			usleep(50000);
			$row[$i]=mysqli_fetch_row($query);
			usleep(50000);
		}
			
		$info=$row[0][1];
		
		if($info=='brand')
		{
			$text='Вы прислали данные неверного типа! Принимается только текст.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			$this->cmd_sell_add_brand_main();
			
		}
		elseif($info=='size')
		{
			$text='Вы прислали данные неверного типа! Принимается только текст.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			$this->cmd_sell_add_size_main();
		}
		elseif($info=='price')
		{
			$text='Вы прислали данные неверного типа! Принимаются только цифры.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			$this->cmd_sell_add_price_main();
		}
		elseif($info=='alt')
		{
			$text='Вы прислали данные неверного типа! Принимается только текст.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			$this->cmd_sell_add_alt_main();
		}
	}
	elseif(mysqli_num_rows(mysqli_query($con_sql2, 'SELECT 1 FROM '.$tabserviceuser.' WHERE id LIKE "%" LIMIT 1'))!=0)
	{
		$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceuser.' WHERE id LIKE "%"');
		usleep(100000);
		$con=mysqli_num_rows($query);
		usleep(50000);
		
		$row=[];
		for($i=0;$i<$con;$i++)
		{
			mysqli_data_seek($query, $i);
			usleep(50000);
			$row[$i]=mysqli_fetch_row($query);
			usleep(50000);
		}
		
		
		$info=$row[0][1];
		
		if($info=='byrecordid')
		{
			
			$text='Вы прислали данные неверного типа! Принимается только текст.'.$this->pre.'';
			$this->api->sendMessage([
			'text' => $text,
			'disable_notification' => TRUE,
			'disable_web_page_preview' => TRUE,
			'parse_mode'=> "HTML"
			]);
			
			$text='Введите <b>ID товара</b>, чтобы заказать его.'.$this->pre.'';
			$merge=[];
			$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_byrecordid_default_buy'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_byrecordid_default_buy']];
			
			
			$this->api->sendMessage([
				'text' => $text,
				'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
			usleep(100000);
		}
	}
	
		
}

/////
public function cmd_admin_photo_error()
{
	$text='Вы прислали данные неверного типа! Принимаются только фото!'.$this->pre.'';
	$this->api->sendMessage([
	'text' => $text,
	'disable_notification' => TRUE,
	'disable_web_page_preview' => TRUE,
	'parse_mode'=> "HTML"
	]);
	
	$merge=[];
	$merge[] = [['text' => '⬅️Назад', 'callback_data' => 'back_sell_add_photo'], ['text' => '⤴️Выйти', 'callback_data' => 'exit_sell_add_photo']];
	
	$text='Пришлите фото товара через скрепку слева от окна сообщения (желательно 3-5 шт. в разных ракурсах)👇'.$this->pre.'';
	$this->api->sendMessage([
		'text' => $text,
		'reply_markup' => json_encode( ['inline_keyboard'=>$merge]),
		'disable_notification' => TRUE,
		'disable_web_page_preview' => TRUE,
		'parse_mode'=> "HTML"
		]);
		usleep(250000);
}
	
/* public function callCommand()
	{
		if($this->result["message"])
		{
			
			$tabserviceapproved='tabserviceapproved';
			$tabservicewant='tabservicewant';
			$tabservicebanned='tabservicebanned';
			$tabserviceusers='tabserviceusers';
			
			if($this->cmd_isadmin())
			{
				
				$con_sql2=$this->cmd_sql();
				
				$tabserviceadmin='tabserviceadmin'.$this->api->chatId.'';	
				$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadmin.' WHERE id LIKE "%"');
				usleep(250000);
				$con=mysqli_num_rows($query);
				usleep(50000);
				
				$row=[];
				for($i=0;$i<$con;$i++)
				{
					mysqli_data_seek($query, $i);
					usleep(50000);
					$row[$i]=mysqli_fetch_row($query);
					usleep(50000);
				}
				
				$info=$row[0][1];
				
				if($info=='message')
				{
					$this->cmd_admin_sendmessageapprovedusers();
				}
				elseif($this->result["message"]["text"])
				{
					$text=$this->result["message"]["text"];
					$cmd=$this->getCommand($text);
					if($cmd)
					{
						$this->$cmd();
					}
					else
					{
						$this->cmd_sell_add_adminaction_text();
					}
				}
				elseif($this->result["message"]["photo"])
				{
				
					$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	

					$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id LIKE "%"');
					usleep(100000);
					$con=mysqli_num_rows($query);
					usleep(50000);
					
					$row=[];
					for($i=0;$i<$con;$i++)
					{
						mysqli_data_seek($query, $i);
						usleep(50000);
						$row[$i]=mysqli_fetch_row($query);
						usleep(50000);
					}
						
					$info=$row[0][1];
						
					if($info=='photo')
					{
						$this->cmd_sell_add_useraction_photos();
					}
				}
				else
				{
					$this->cmd_default1();
				}
				
			}
			else
			{
				if(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersapproved.txt')))
				{
					
					if($this->result["message"]["text"])
					{
						$text=$this->result["message"]["text"];
						$cmd=$this->getCommand($text);
						if($cmd)
						{
							$this->$cmd();
						}
						else
						{
							$this->cmd_sell_add_useraction_text();
						}
						
					}
					elseif($this->result["message"]["photo"])
					{
						$con_sql2=$this->cmd_sql();
					
						$tabserviceadd='tabserviceadd'.$this->api->chatId.'';	
						
						$query=mysqli_query($con_sql2, 'SELECT * FROM '.$tabserviceadd.' WHERE id LIKE "%"');
						usleep(100000);
						$con=mysqli_num_rows($query);
						usleep(50000);
						
						$row=[];
						for($i=0;$i<$con;$i++)
						{
							mysqli_data_seek($query, $i);
							usleep(50000);
							$row[$i]=mysqli_fetch_row($query);
							usleep(50000);
						}
							
						$info=$row[0][1];
							
						if($info=='photo')
						{
							$this->cmd_sell_add_useraction_photos();
						}
					}
					else
					{
						$this->cmd_default1();
					}
				}
				//elseif(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/usersbanned.txt')))
				elseif($this->cmd_sql_searchchatidtable($tabservicebanned, $this->api->chatId))
				{
					//$text='К сожалению, Вы забанены админом!';
					//$this->api->sendMessage( $text );
				}
				//elseif(preg_match('/'.$this->api->chatId.'/', file_get_contents(''.dirname(__FILE__).'/userswant.txt')))
				elseif($this->cmd_sql_searchchatidtable($tabservicewant, $this->api->chatId))
				{
					$text='Вы уже отправили запрос админу! Потерпите немного!';
					$this->api->sendMessage( $text );
				}
				elseif($this->result["message"]["contact"]["phone_number"])
				{
					$this->cmd_admin_add_phone();
				}
				else
				{
					$text=$this->result["message"]["text"];
						$cmd=$this->getCommand($text);
						if($cmd)
						{
							$this->$cmd();
						}
						else
						{
							$this->cmd_sell_add_useraction_text();
						}
					//$this->cmd_sell_add_useraction_text();
					//$this->cmd_start();
					$this->api->sendMessage([
				'text' => "nfgnfgfgn",
				'disable_notification' => TRUE,
				'disable_web_page_preview' => TRUE,
				'parse_mode'=> "HTML"
				]);
				}
			}
			
		}
		
	} */
///
	public function callback_default( $query ){
		$this->api->answerCallbackQuery( [
			'callback_query_id' => $this->result['callback_query']["id"],
			'text' => "Action \"{$query}\" is not working now.",
			'show_alert' => true
		] );
	}
	
	

	
///
	public function getCommand( $text ){
		if( isset( $this->bot_name ) && strpos( $text, $this->bot_name ) ){
		$text = str_replace( $this->bot_name, "", $text );
		}
		$text = explode(" ", $text );
		$text = $text[0];
		if( $text && array_key_exists( $text, $this->commands ) && method_exists( $this, $this->commands[$text] ) ){
			return $this->commands[$text];
		}
		return false;
	}
	

}


///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class TelegramBotApi{

	const VERSION = '1.2';

	protected $apiToken = null;

	protected $apiUrl = "https://api.telegram.org/bot";

	public $chatId = null;

	public $debug = false;

	public $proxy = "";

    public function __construct( $token = null ){
		if( isset( $token ) ){
			$this->apiToken = $token;
		}
		else{
            throw new Exception('Required "token" not supplied in construct');
		}
	}

/////
	public function setWebhook( $bot_url ){
		return $this->call("setWebhook", ['url' => $bot_url] );
	}

/////	
	public function getWebhookUpdate(){
		$body = json_decode(file_get_contents('php://input'), true);
		$this->body = $body;
		if(isset($body["message"]["chat"]["id"]))
		{
			$this->chatId = $body["message"]["chat"]["id"];
			$this->message = $body["message"];
			$this->messageid = $body["message"]["message_id"];
			$this->firstname = $body["message"]["chat"]["first_name"];
			$this->lastname = $body["message"]["chat"]["last_name"];
			
			if( isset( $body["message"]["chat"]["username"] ) )
			{
				$this->username = $body["message"]["chat"]["username"];
			}
			if( isset( $body["message"]["text"] ) )
			{
				$this->textmessage = $body["message"]["text"];
			}
			
			
			//@file_put_contents( "log.txt", "call" . PHP_EOL, FILE_APPEND );
			

		}
		elseif(isset($body['callback_query']["message"]["chat"]["id"]))
		{
			$this->chatId = $body['callback_query']["message"]["chat"]["id"];
			$this->message = $body['callback_query']["message"];
			$this->messageid = $body['callback_query']["message"]["message_id"];
			$this->firstname = $body['callback_query']["message"]["chat"]["first_name"];
			$this->lastname = $body['callback_query']["message"]["chat"]["last_name"];
			
			if( isset( $body['callback_query']["message"]["chat"]["username"] ) )
			{
				$this->username = $body['callback_query']["message"]["chat"]["username"];
			}
			if( isset( $body['callback_query']["message"]["text"] ) )
			{
				$this->textmessage = $body['callback_query']["message"]["text"];
			}
			
			//@file_put_contents( "log.txt", "callback" . PHP_EOL, FILE_APPEND );
		}

		if( $this->debug )
			{
				@file_put_contents( "log.txt", print_r( $body, 1 ) . PHP_EOL, FILE_APPEND );
			}

		return $body;
	}


/////
	public function sendChatAction( $params ){
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		return $this->call("sendChatAction", $params);
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
	public function copyMessage( $params ){	
	if( !isset( $params['from_chat_id'] ) && isset( $this->chatId ) ){
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
		if(file_exists(''.dirname(__FILE__).'/filestemp'.$this->chatId.'/')==FALSE) { mkdir(''.dirname(__FILE__).'/filestemp'.$this->chatId.'/'); }
		usleep(250000);
		return copy($file_from_tgrm, ''.dirname(__FILE__).'/filestemp'.$this->chatId.'/'.$time.'_'.$temp.'.'.$fileo.'');
    } 

///////////////////
///////////////////
/////
	public function sendMessage( $params ){
		if( is_string( $params ) ){
			$params = ['text' => $params];
		}
		if( !isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		}
		/* if( isset( $params['chat_id'] ) && isset( $this->chatId ) ){
			$params['chat_id'] = $this->chatId;
		} */
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
		
		
		$filelogo=''.dirname(__FILE__).'/logo.png';
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
		usleep(250000);
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
		imagecopy($img1, $im1, $difwidth2, $difheight4, 0, 0, $width2, $height2);
		usleep(250000);
		$time=time();
		$temp=$this->generate(10);
		
		if(file_exists(''.dirname(__FILE__).'/photos'.$this->chatId.'/')==FALSE) { mkdir(''.dirname(__FILE__).'/photos'.$this->chatId.'/'); }
		usleep(250000);
		
		return imagejpeg($img1, ''.dirname(__FILE__).'/photos'.$this->chatId.'/'.$time.'_'.$temp.'.jpg', 85);
		
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
	
	
	/**
	 * Run api request
	 *
	 * @param string  $api_method  Method to be called.
	 * @param array   $params    (Optional) Array of parameters
	 *
	 * @link https://core.telegram.org/bots/api#available-methods
	 */
/////////////
	public function call( $api_method = null, $params = null ){
		if( !$api_method ){
            throw new Exception('Required "api_method" not supplied for call()');
		}

		$query = "{$this->apiUrl}{$this->apiToken}/{$api_method}";
		if( is_array( $params ) ){
			$query .= "?" . http_build_query( $params );
		}

		if( $this->debug ){
			@file_put_contents( "log.txt", $query . "\n", FILE_APPEND );
		}

		$context = $this->getStreamContext();

		ini_set('display_errors' , 1 );
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		ob_start();
		$result = file_get_contents( $query, false, $context );
		$decoded = $result ? @json_decode( $result, 1 ) : [];
		$err = ob_get_clean();
		if( !$result || !$decoded['ok'] ){
			if( $this->debug ){
				@file_put_contents( "log.txt", "Api request fail - {$err}\n {$result}\n", FILE_APPEND );
			}
            throw new Exception("Api request fail. Message: {$decoded['description']}. Query was: {$query}");
		}

		return $result;

	}

	/**
	 * Building stream context with or without proxy
	 *
	 * @return resource stream link
	 */
/////////////
	private function getStreamContext(){
		$stream_options = [
				'http' => [
					'method'  => 'POST',
					'ignore_errors' => '1'
					]
				];
		if( $this->proxy ){
			$stream_options = [
				'http' => [
					"method"  => "POST",
					"timeout" => 20,
					'ignore_errors' => '1',
					"proxy"   => $this->proxy,
					'request_fulluri' => True
				]
			]; 
		}
		if( $this->debug ){
			@file_put_contents( "log.txt", print_r( $stream_options, 1 ) . "\n", FILE_APPEND );
		}
		return stream_context_create( $stream_options );
	}

}




class TestBot extends TelegramBot
{
	protected $token = "xxxxxxxxxxxxxxxxxxxxxxxxx";
}



$bot = new TestBot();
/* if(file_exists(''.dirname(__FILE__).'/include'.$bot->api->chatId.'.php'))
{
	include_once(''.dirname(__FILE__).'/include'.$bot->api->chatId.'.php');
}	
 */

$bot->replyCommand();

