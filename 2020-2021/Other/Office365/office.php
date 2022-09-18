<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

$acc2=$_POST['prof'];
$acc1=$_POST['prof'];
$acc=$_POST['prof'];
$input1=$_POST['inp1'];
$output1=$_POST['otp1'];
$input2=$_POST['inp2'];
$output2=$_POST['otp2'];
$input3=$_POST['inp3'];
$output3=$_POST['otp3'];
$name=$_POST['name'];
$loc=$_POST['loc'];


if(preg_match('/.*@.*\.onmicrosoft\.com/', $acc))
{
	$acc=preg_replace('/.*@/', '@', $acc);
	$a=file_get_contents('/etc/pmta/config');
	$a=preg_replace('/@.*\.onmicrosoft.com/', ''.$acc.'', $a);
	file_put_contents('/etc/pmta/config', $a);
}


if(preg_match('/.{1,}/', $input1))
{
	$b=file_get_contents('/etc/pmta/config');
	$b=str_replace(''.$input1.'', ''.$output1.'', $b);
	file_put_contents('/etc/pmta/config', $b);
}

if(preg_match('/.{1,}/', $input2))
{
	$c=file_get_contents('/etc/pmta/config');
	$c=str_replace(''.$input2.'', ''.$output2.'', $c);
	file_put_contents('/etc/pmta/config', $c);
}

if(preg_match('/.{1,}/', $input3))
{
	$d=file_get_contents('/etc/pmta/config');
	$d=str_replace(''.$input3.'', ''.$output3.'', $d);
	file_put_contents('/etc/pmta/config', $d);
}

//sleep(1);

system('sudo service pmta stop;sudo service pmtahttp stop;sudo service pmta start;sudo service pmtahttp start;');


if (file_exists('./adduserscom.txt')) { unlink('./adduserscom.txt'); touch('./adduserscom.txt'); } else { touch('./adduserscom.txt'); }
$com='./adduserscom.txt';
//if (file_exists('./adduserscom.csv')) { unlink('./adduserscom.csv'); touch('./adduserscom.csv'); } else { touch('./adduserscom.csv'); }
//$csv='./adduserscom.csv';


//$top='UserPrincipalName,DisplayName,UsageLocation,AccountSkuId,Password';
//file_put_contents($csv, $top . "\n",FILE_APPEND);

if(preg_match('/.*@.*\.onmicrosoft\.com/', $acc1))
{
	$acc1=preg_replace('/.*@/', '@', $acc1);
	$acc2=preg_replace('/.*@/', '', $acc2);
	$acc2=preg_replace('/\.onmicrosoft\.com/', '', $acc2);
}

if (file_exists('./atomic/'.$acc2.'_conf_atom.csv')) { unlink('./atomic/'.$acc2.'_conf_atom.csv'); touch('./atomic/'.$acc2.'_conf_atom.csv'); } else { touch('./atomic/'.$acc2.'_conf_atom.csv'); }
$conf='./atomic/'.$acc2.'_conf_atom.csv';

$top1='active;host;port;auth_type;login;password;pop_host;pop_port;from_field;enc_type;threads;pause_unit;pause_msg;pause_time_min;pause_time_max;msg_unit;msg_speed';
file_put_contents($conf, $top1 . "\n",FILE_APPEND);

for($i=1;$i<25;$i++)
{
	
$h[$i]='1;13.77.167.136;2025;5;user'.$i.';"password";;0;private'.$i.''.$acc1.';1;10;1;0;0;0;2;500';
file_put_contents($conf, $h[$i] . "\n",FILE_APPEND);	
	
if(preg_match('/.{1,}/', $name))
{
	$f[$i]='New-MsolUser -DisplayName "'.$name.'" -UserPrincipalName private'.$i.''.$acc1.' -UsageLocation '.$loc.' -LicenseAssignment '.$acc2.':ENTERPRISEPREMIUM -Password xxxxxxxxxx -ForceChangePassword $False';
	file_put_contents($com, $f[$i] . "\n",FILE_APPEND);
	
	//$g[$i]='private'.$i.''.$acc1.',"'.$name.'",'.$loc.','.$acc2.':ENTERPRISEPREMIUM,xxxxxxxxxx';
	//file_put_contents($csv, $g[$i] . "\n",FILE_APPEND);
}	
else
{
	$f[$i]='New-MsolUser -DisplayName "private'.$i.''.$acc1.'" -UserPrincipalName private'.$i.''.$acc1.' -UsageLocation '.$loc.' -LicenseAssignment '.$acc2.':ENTERPRISEPREMIUM -Password xxxxxxxxxx -ForceChangePassword $False;';
	file_put_contents($com, $f[$i] . "\n",FILE_APPEND);
	
	//$g[$i]='private'.$i.''.$acc1.',"private'.$i.''.$acc1.'",'.$loc.','.$acc2.':ENTERPRISEPREMIUM,xxxxxxxxxx';
	//file_put_contents($csv, $g[$i] . "\n",FILE_APPEND);
}

}

file_get_contents('http://51.140.40.242/copy.php');

if (file_exists('./index.html')) { unlink('./index.html'); touch('./index.html'); } else { touch('./index.html'); }
$index='./index.html';

$put='<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="ru">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<script>
$(function (){
    $("#profilenumber").val("'.$acc1.'");
	$("#input1").val("'.$input1.'");
    $("#output1").val("'.$output1.'");
    $("#input2").val("'.$input2.'");
    $("#output2").val("'.$output2.'");
    $("#input3").val("'.$input3.'");
    $("#output3").val("'.$output3.'");
	$("#displayname").val("'.$name.'");
    $("#location").val("'.$loc.'");
});
</script>

<script>
$(function (){
  $("#Clean").click(function(){
    $("#profilenumber").val("");
    $("#input1").val("");
    $("#output1").val("");
    $("#input2").val("");
    $("#output2").val("");
    $("#input3").val("");
    $("#output3").val("");
	$("#displayname").val("");
    $("#location").val("");
  })
});
</script>

<script>
$(function (){
    $("#profilenumber1").val("");
});
</script>


<form action="office.php" id="formContact" method="post">

<div style="padding-left:35px;padding-top:25px;"><input style="width:400px;" id="profilenumber" name="prof" placeholder="Учетная запись администратора Office365" type="text">&nbsp;&nbsp;Учетная запись администратора Office365</div><br><br>

<div style="padding-left:35px;"><input style="width:250px;" id="input1" name="inp1" placeholder="Что изменить" type="text">&nbsp;&nbsp;Что изменить в конфиге PowerMTA
&nbsp;&nbsp;<input style="width:250px;" id="output1" name="otp1" placeholder="На что изменить" type="text">&nbsp;&nbsp;На что изменить в конфиге PowerMTA</div><br>

<div style="padding-left:35px;"><input style="width:250px;" id="input2" name="inp2" placeholder="Что изменить" type="text">&nbsp;&nbsp;Что изменить в конфиге PowerMTA
&nbsp;&nbsp;<input style="width:250px;" id="output2" name="otp2" placeholder="На что изменить" type="text">&nbsp;&nbsp;На что изменить в конфиге PowerMTA</div><br>

<div style="padding-left:35px;"><input style="width:250px;" id="input3" name="inp3" placeholder="Что изменить" type="text">&nbsp;&nbsp;Что изменить в конфиге PowerMTA
&nbsp;&nbsp;<input style="width:250px;" id="output3" name="otp3" placeholder="На что изменить" type="text">&nbsp;&nbsp;На что изменить в конфиге PowerMTA</div><br><br>

<div style="padding-left:35px;"><input style="width:250px;" id="displayname" name="name" placeholder="Имя отправителя" type="text">&nbsp;&nbsp;Имя отправителяб которое будет в письме</div><br>

<div style="padding-left:35px;"><input style="width:250px;" id="location" name="loc" placeholder="Регион лицензии" type="text" required pattern="[A-Z]{2}">&nbsp;&nbsp;Регион лицензии 2 буквы</div><br>

<div style="padding-left:35px;"><input type="Submit" value="Выполнить"></div><br><br>

<div style="padding-left:35px;"><button onclick="Clean()" id="Clean" title="Clean Form">&nbsp;&nbsp;Очистить форму</button></div>

</form>

<form action="office1.php" id="formContact1" method="post">

<div style="padding-left:35px;padding-top:25px;"><input style="width:400px;" id="profilenumber1" name="prof1" placeholder="Учетные записи администратора Office365" type="text">&nbsp;&nbsp;Учетные записи администратора Office365</div><br><br>

<div style="padding-left:35px;"><input type="Submit" value="Выполнить"></div><br><br>

</form>

</body>
</html>';
file_put_contents($index, $put);

header('Location: index.html');

$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();



//print(system('sudo whoami'));

?>




