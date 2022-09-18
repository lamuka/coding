<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

$acc=$_POST['prof'];

for($i=1;$i<25;$i++)
{

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
  })
});
</script>

<form action="office.php" id="formContact" method="post">

<div style="padding-left:35px;padding-top:25px;"><input style="width:400px;" id="profilenumber" name="prof" placeholder="Учетная запись администратора Office365" type="text">&nbsp;&nbsp;Учетная запись администратора Office365</div><br><br>

<div style="padding-left:35px;"><input style="width:250px;" id="input1" name="inp1" placeholder="Что изменить" type="text">&nbsp;&nbsp;Что изменить в конфиге PowerMTA
<input style="width:250px;" id="output1" name="otp1" placeholder="На что изменить" type="text">&nbsp;&nbsp;На что изменить в конфиге PowerMTA</div><br>

<div style="padding-left:35px;"><input style="width:250px;" id="input2" name="inp2" placeholder="Что изменить" type="text">&nbsp;&nbsp;Что изменить в конфиге PowerMTA
<input style="width:250px;" id="output2" name="otp2" placeholder="На что изменить" type="text">&nbsp;&nbsp;На что изменить в конфиге PowerMTA</div><br>

<div style="padding-left:35px;"><input style="width:250px;" id="input3" name="inp3" placeholder="Что изменить" type="text">&nbsp;&nbsp;Что изменить в конфиге PowerMTA
<input style="width:250px;" id="output3" name="otp3" placeholder="На что изменить" type="text">&nbsp;&nbsp;На что изменить в конфиге PowerMTA</div><br><br>

<div style="padding-left:35px;"><input type="Submit" value="Выполнить"></div><br><br>

<div style="padding-left:35px;"><button onclick="Clean()" id="Clean" title="Clean Form">&nbsp;&nbsp;Очистить форму</button></div>

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




