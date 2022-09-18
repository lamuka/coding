
<?php

session_start();

$authorized = false;

# LOGOUT
if (isset($_GET['logout']) && !isset($_GET["login"]) && isset($_SESSION['auth']))
{
    $_SESSION = array();
    unset($_COOKIE[session_name()]);
    session_destroy();
    echo "logging out...";
}

# checkup login and password
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
	include_once(''.dirname(__FILE__).'/AdminBotAuth.php');
	$auth=new Auth;
	$user = Auth::login();
	$pass = Auth::password();
/*     $user = 'test';
    $pass = 'test'; */
    if (($user == $_SERVER['PHP_AUTH_USER']) && ($pass == ($_SERVER['PHP_AUTH_PW'])) && isset($_SESSION['auth']))
    {
    $authorized = true;
    }
}

# login
if (isset($_GET["login"]) && !$authorized ||
# relogin
    isset($_GET["login"]) && isset($_GET["logout"]) && !isset($_SESSION['reauth']))
{
    header('WWW-Authenticate: Basic Realm="Login please"');
    header('HTTP/1.0 401 Unauthorized');
    $_SESSION['auth'] = true;
    $_SESSION['reauth'] = true;
    echo "Login now or forever hold your clicks...";
    exit;
}
$_SESSION['reauth'] = null;


?>

<?php
// try to mimic cpanel logout style
// only diff is usr & pwd field is cleared when re-login
// tested with ff2 & ie8

//session_start();

include_once(''.dirname(__FILE__).'/AdminBotAuth.php');
$auth=new Auth;
$username = Auth::login();
$password = Auth::password();

if(isset($_GET['logout']))
{
  unset($_SESSION["login"]);
  echo "You have logged out ... ";
  echo "[<a href='" . $_SERVER['PHP_SELF'] . "'>Login</a>]";
  exit;
}

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || !isset($_SESSION["login"]))
{
  header("WWW-Authenticate: Basic realm=\"Test\"");
  header("HTTP/1.0 401 Unauthorized");
  $_SESSION["login"] = true;
  echo "You are unauthorized ... ";
  echo "[<a href='" . $_SERVER['PHP_SELF'] . "'>Login</a>]";
  exit;
}
else
{
  if($_SERVER['PHP_AUTH_USER'] == $username && $_SERVER['PHP_AUTH_PW'] == $password)
  {
    
    echo "<a style='padding-left:1800px;' href='" . $_SERVER['PHP_SELF'] . "?logout'>[Logout]</a>";
  }
  else
  {
    unset($_SESSION["login"]);
    header("Location: " . $_SERVER['PHP_SELF']);
  }
}

// content here
include_once(''.dirname(__FILE__).'/DataBot.php');

new DataBot;

$folder=$_SERVER['SCRIPT_NAME'];
$folder=preg_replace('/^\//', '', $folder);
$folder=preg_replace('/\/.*/', '', $folder);

$boturl='https://'.$_SERVER['HTTP_HOST'].'/'.$folder.'/StarterBot.php';


$get = file_get_contents(''.dirname(__FILE__).'/DataBot.php');

preg_match_all('/protected.*\/\/token/', $get, $out);
$token=str_replace('protected $token = "', '', $out[0][0]);
$token=str_replace('"; //token', '', $token);

?>




<!doctype html>
<html lang="en">
<head><meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.6" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script></head>
<body>



<style type="text/css">
.multiselect {
  width: 500px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>



<script>
function myFunction() {
  // Get the checkbox
  var checkbox = document.getElementById("webhookid");
  // Get the output text
  var text = document.getElementById("boturl");
  var text1 = document.getElementById("proxyname");
  var label1 = document.getElementById("label1");
  var label2 = document.getElementById("label2");
  // If the checkbox is checked, display the output text
  if (checkbox.checked == true){
    text.style.display = "block";
	label1.style.display = "block";
	text1.style.display = "block";
	label2.style.display = "block";
	
	webhookdel.style.display = "none"
	botcha.style.display = "none"
	label4.style.display = "none"
	label5.style.display = "none"
  } else {
    text.style.display = "none";
	text1.style.display = "none";
	label1.style.display = "none";
	label2.style.display = "none";
	
	webhookdel.style.display = "inline-block"
	botcha.style.display = "inline-block"
	label4.style.display = "inline-block"
	label5.style.display = "inline-block"
  };
} 
</script>


<script>
function myFunction1() {
  // Get the checkbox
  var checkbox = document.getElementById("webhookdel");
  // Get the output text
  var text = document.getElementById("proxyname");
	var label2 = document.getElementById("label2");
  // If the checkbox is checked, display the output text
  if (checkbox.checked == true){
    text.style.display = "block";
	label2.style.display = "block";
	
	webhookid.style.display = "none"
	botcha.style.display = "none"
	label3.style.display = "none"
	label5.style.display = "none"
	
  } else {
    text.style.display = "none";
	label2.style.display = "none";
	
	webhookid.style.display = "inline-block"
	botcha.style.display = "inline-block"
	label3.style.display = "inline-block"
	label5.style.display = "inline-block"
  };
} 
</script>


<script>
function myFunction2() {
  // Get the checkbox
  var checkbox = document.getElementById("botcha");
  // Get the output text
  var text = document.getElementById("proxyname");
	var label2 = document.getElementById("label2");
  // If the checkbox is checked, display the output text
  if (checkbox.checked == true){
    text.style.display = "block";
	label2.style.display = "block";
	
	webhookid.style.display = "none"
	webhookdel.style.display = "none"
	label3.style.display = "none"
	label4.style.display = "none"
	
  } else {
    text.style.display = "none";
	label2.style.display = "none";
	
	webhookid.style.display = "inline-block"
	webhookdel.style.display = "inline-block"
	label3.style.display = "inline-block"
	label4.style.display = "inline-block"
  };
} 
</script>




<?php echo '
<script>
window.onload = function () {

	$("#privateip").val("")
	$("#privateip1").val("")
	$("#ipsnumber").val("")
	$("#resourcegroup").val("")
	$("#proxyname").val("")
	$("#proxypassword").val("")
	$("#proxyport").val("")
	$("#username").val("")
	$("#userpassword").val("")
	$("#instancename").val("")
	$("#mainserverip").val("")
	$("#urlofficial").val("")
	$("#urldownload").val("")
	$("#boturl").val("")
	

	boturl.onfocus = function() {
		$(boturl).val("'.$boturl.'");
	}
	proxyname.onfocus = function() {
		$(proxyname).val("'.$token.'");
	}
    privateip.onfocus = function() {
		$(privateip).val("'.DataBot::URLMIRROR.'");
	}
	privateip1.onfocus = function() {
		$(privateip1).val("'.DataBot::URLMIRROR1.'");
	}
	ipsnumber.onfocus = function() {
		$(ipsnumber).val("'.DataBot::URLCASINO.'");
	}
	instancename.onfocus = function() {
		$(instancename).val("'.DataBot::URLCHANNEL.'");
	}
	mainserverip.onfocus = function() {
		$(mainserverip).val("'.DataBot::URLGROUP.'");
	}
	urlofficial.onfocus = function() {
		$(urlofficial).val("'.DataBot::URLOFCHANNEL.'");
	}
	urldownload.onfocus = function() {
		$(urldownload).val("'.DataBot::URLDOWNLOAD.'");
	}
	resourcegroup.onfocus = function() {
		$(resourcegroup).val("'.DataBot::CHATIDADMIN.'");
	}
	userpassword.onfocus = function() {
		$(userpassword).val("'.DataBot::ADMINUSERNAMES.'");
	}
	proxypassword.onfocus = function() {
		$(proxypassword).val("'.DataBot::COUNTERLIMIT.'");
	}
	proxyport.onfocus = function() {
		$(proxyport).val("'.DataBot::REFRESHTIME.'");
	}
	username.onfocus = function() {
		$(username).val("'.DataBot::REFRESHCASINO.'");
	}
	
}
</script>';
?>



<script>
$(document).ready(function() {
document.addEventListener('keydown', function(event) {
  if (event.keyCode == 13) {
    event.preventDefault();
    return false;
  }
});
});
</script>



<table style="width:1800px">
<tr>
<td style="width:1800px">
<form action="AdminBotChange.php" id="formContact4" method="post">

<div style="padding-left:50px;"><input type="checkbox" id="webhookid" name="webhookname" onclick="myFunction()"><label id="label3" for="webhookid">&nbsp;&nbsp;<b>Зарегистрировать webhook?</b></label></div>

<div style="padding-left:50px;padding-top:15px;"><input type="checkbox" id="webhookdel" name="webhookdelete" onclick="myFunction1()"><label id="label4" for="webhookdel">&nbsp;&nbsp;<b>Удалить webhook?</b></label></div>

<div style="padding-left:50px;padding-top:15px;"><input type="checkbox" id="botcha" name="botchange" onclick="myFunction2()"><label  id="label5" for="botcha">&nbsp;&nbsp;<b>Поменять токен бота?</b></label></div>

<div style="padding-left:50px; padding-top:25px;"><span id="label1" style="display:none";><b>URL бота</b></span><input style="width:500px; display:none" id="boturl" name="botu" placeholder="URL бота"></div>

<div style="padding-left:50px; padding-top:12px;"><span id="label2" style="display:none";><b>Токен бота</b></span><input style="width:500px; display:none" id="proxyname" name="prname" placeholder="Токен бота" type="text"></div><br><br><br>


<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="privateip" name="privip" placeholder="Актуальное зеркало Casino-Z основное" type="text"  onclick="myFunction3(this)">&nbsp;&nbsp;<b>Актуальное зеркало Casino-Z основное</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="privateip1" name="privip1" placeholder="Актуальное зеркало Casino-Z регистрация" type="text">&nbsp;&nbsp;<b>Актуальное зеркало Casino-Z регистрация</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="ipsnumber" name="ipnum" placeholder="URL получения данных Casino-Z" type="text">&nbsp;&nbsp;<b>URL получения данных Casino-Z</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="instancename" name="instname" placeholder="Ссылка-приглашение в канал" type="text">&nbsp;&nbsp;<b>Ссылка-приглашение в канал розыгрыша</b></div>
<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="mainserverip" name="mainip" placeholder="Ссылка-приглашение в группу" type="text">&nbsp;&nbsp;<b>Ссылка-приглашение в группу розыгрыша</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="urlofficial" name="urloffic" placeholder="Ссылка-приглашение в официальный канал Casino-Z" type="text">&nbsp;&nbsp;<b>Ссылка-приглашение в официальный канал Casino-Z</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="urldownload" name="urldown" placeholder="Ссылка для скачивания приложения для Android" type="text">&nbsp;&nbsp;<b>Ссылка для скачивания приложения для Android</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="resourcegroup" name="group" placeholder="Телеграм чат id главного админа" type="text">&nbsp;&nbsp;<b>Телеграм чат id главного админа</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="userpassword" name="upass" placeholder="Телеграм чат id или юзернеймы админов" type="text">&nbsp;&nbsp;<b>Телеграм чат id или юзернеймы админов</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="proxypassword" name="prpass" placeholder="Попытки неправильного ввода ID Casino-Z" type="text">&nbsp;&nbsp;<b>Количество попыток неправильного ввода ID Casino-Z</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="proxyport" name="prport" placeholder="Частота нажатия на кнопку Хочу больше билетов в секундах" type="text">&nbsp;&nbsp;<b>Частота нажатия на кнопку Хочу больше билетов в секундах</b></div>

<div style="padding-left:50px; padding-top:10px;"><input style="width:500px;" id="username" name="uname" placeholder="Частота обновления данных в секундах" type="text">&nbsp;&nbsp;<b>Тайминг запроса данных по казино в секундах</b></div>


<div style="padding-left:185px; padding-top:50px;"><button style="width:120px; height:35px;" type="Submit" text="ВЫПОЛНИТЬ">ВЫПОЛНИТЬ</button></div>



</table>

</body>
</html>


