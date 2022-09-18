<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

//////////////////////////////////////
$row1=$_POST['servernum'];
$row2=$_POST['ips'];
$row3=$_POST['domain'];
$row4=$_POST['monitorips'];
$row5=$_POST['adminips'];
/////////////////////////////////////
$host='35.228.165.192'; $user='mine'; $pass='xxxxxxxxxx'; $dbn='servers';
$con_sql1=mysqli_connect($host, $user, $pass);
if (mysqli_connect_errno()) {
    printf('Connect failed: %s\n', mysqli_connect_error());
    exit(); }
if($result=mysqli_query($con_sql1, 'CREATE DATABASE servers')) { }
else { }
mysqli_close($con_sql1);

$con_sql2=mysqli_connect($host, $user, $pass, $dbn);
if (mysqli_connect_errno()) {
    printf('Connect failed: %s\n', mysqli_connect_error());
    exit(); }
mysqli_set_charset($con_sql2, 'utf8');
///
if($result1=mysqli_query($con_sql2, 'SELECT 1 FROM serv'.$row1.' LIMIT 1')) 
{ 
$drop1=mysqli_query($con_sql2, 'DROP TABLE serv'.$row1.'') or die(mysqli_error($con_sql2));
$query1='CREATE TABLE serv'.clean($row1).' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,ips VARCHAR(16),domain VARCHAR(30),monitorips VARCHAR(16),adminips VARCHAR(16)) ENGINE = MyISAM;';
$result1=mysqli_query($con_sql2, $query1) or die(mysqli_error($con_sql2)); 
}
else 
{
$query1='CREATE TABLE serv'.clean($row1).' (id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,ips VARCHAR(16),domain VARCHAR(30),monitorips VARCHAR(16),adminips VARCHAR(16)) ENGINE = MyISAM;';
$result1=mysqli_query($con_sql2, $query1) or die(mysqli_error($con_sql2)); 
}

/////////////////////////////////////
preg_match_all('/\d{1,}\.\d{1,}\.\d{1,}\.\d{1,}/', $row2, $out1);
$cnt1=count($out1[0]);
//print ''.$cnt1.'<br>';
for($i1=0;$i1<$cnt1;$i1++)
{
$que1[$i1]='INSERT INTO serv'.clean($row1).' (ips) VALUES ("'.clean($out1[0][$i1]).'")';
$res1[$i1]=mysqli_query($con_sql2, $que1[$i1]) or die(mysqli_error($con_sql2));
}

/////

$que2='INSERT INTO serv'.clean($row1).' (domain) VALUES ("'.clean($row3).'")';
$res2=mysqli_query($con_sql2, $que2) or die(mysqli_error($con_sql2));

/////
preg_match_all('/\d{1,}\.\d{1,}\.\d{1,}\.\d{1,}/', $row4, $out2);
$cnt2=count($out2[0]);
//print ''.$cnt2.'<br>';
for($i2=0;$i2<$cnt2;$i2++)
{
$que3[$i2]='INSERT INTO serv'.clean($row1).' (monitorips) VALUES ("'.clean($out2[0][$i2]).'")';
$res3[$i2]=mysqli_query($con_sql2, $que3[$i2]) or die(mysqli_error($con_sql2));
}

/////
preg_match_all('/\d{1,}\.\d{1,}\.\d{1,}\.\d{1,}/', $row5, $out3);
$cnt3=count($out3[0]);
//print ''.$cnt3.'<br>';
for($i3=0;$i3<$cnt3;$i3++)
{
$que4[$i3]='INSERT INTO serv'.clean($row1).' (adminips) VALUES ("'.clean($out3[0][$i3]).'")';
$res4[$i3]=mysqli_query($con_sql2, $que4[$i3]) or die(mysqli_error($con_sql2));
}



if (file_exists('./index.html')) { unlink('./index.html'); touch('./index.html'); } else { touch('./index.html'); }
$parse1='./index.html';

$put1='<!doctype html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>
<form action="putserver.php" id="formContact" method="post">
<div>serv<input list="Servers" style="width:200px;" id="input-servernum" name="servernum" placeholder="Server number" type="text" required pattern="\d{1,4}"></div>
<datalist id="Servers">';
file_put_contents($parse1, $put1 . "\n",FILE_APPEND);

$result9=mysqli_query($con_sql2, 'SHOW TABLES');

$i5=0;
while($tab1=mysqli_fetch_array($result9)) 
{
$tab1[0]=str_replace('serv', '', $tab1[0]);
$put4[$i5]='<option>'.$tab1[0].'</option>'; 
file_put_contents($parse1, $put4[$i5] . "\n",FILE_APPEND);
$i5++;
}


$put5='</datalist><button id="btn">Show info</button>';
file_put_contents($parse1, $put5 . "\n",FILE_APPEND);



/* for($ew=0;$ew<$con11;$ew++)
{
mysqli_data_seek($query1, $ew);
$row[$ew]=mysqli_fetch_row($query1);
} */

$query12=mysqli_query($con_sql2, 'SHOW TABLES');
//$con12=mysqli_num_rows($query12);

$i6=0;
while($tab2=mysqli_fetch_array($query12))
{
$query[$i6]=mysqli_query($con_sql2, 'SELECT ips FROM '.$tab2[0].' WHERE ips>0') or die(mysqli_error($con_sql2));
//$con11=mysqli_num_rows($query1);

$put6[$i6]='<script>
$("#btn").click(function(){
	if($("#input-servernum").val()=="'.$i6.'") {
	$("#input-ips").val("';
file_put_contents($parse1, $put6[$i6],FILE_APPEND);

$i7=0;
while($tab4[$i6]=mysqli_fetch_array($query[$i6]))
{
$put7[$i7]=''.$tab4[$i6][0].' ';
file_put_contents($parse1, $put7[$i7],FILE_APPEND);
$i7++;
}
$put8[$i6]='");
	}
});
</script>';
file_put_contents($parse1, $put8[$i6] . "\n",FILE_APPEND);
$i6++;
}

$put9='
<div><input style="width:400px;" id="input-ips" name="ips" placeholder="IPs" type="text" required pattern="(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}(,|;| )){0,}((\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(| ){0,}){1}"></div><br>
<div><input style="width:400px;" id="input-domain" name="domain" placeholder="Domain" type="text" required pattern="\w{1,}\.\w{1,5}"></div><br>
<div><input style="width:400px;" id="input-monitorips" name="monitorips" placeholder="Pmta monitor IPs" type="text" required pattern="(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}(,|;| )){0,}((\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(| ){0,}){1}"></div><br>
<div><input style="width:400px;" id="input-adminips" name="adminips" placeholder="Pmta admin IPs" type="text" required pattern="(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}(,|;| )){0,}((\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(| ){0,}){1}"></div><br>
<div><input type="Submit" value="Send"></div><br>
</form>

<form action="index.html" id="index" method="post">
<div><input type="Submit" value="Reload"></div>
</form>

<form action="config_sql.php" id="sql" method="post">
<div>serv<input list="Servers" style="width:200px;" id="load-servernum" name="servernumload" placeholder="Server number" type="text" required pattern="\d{1,4}"></div>
<datalist id="Servers">';
file_put_contents($parse1, $put9 . "\n",FILE_APPEND);

$result10=mysqli_query($con_sql2, 'SHOW TABLES');

$i4=0;
while($tab=mysqli_fetch_array($result10)) 
{
$tab[0]=str_replace('serv', '', $tab[0]);
$put2[$i4]='<option>'.$tab[0].'</option>'; 
file_put_contents($parse1, $put2[$i4] . "\n",FILE_APPEND);
$i4++;
}

$put3='</datalist>
<div><input type="Submit" value="Create PMTA config"></div><br>
</form> 
</body>
</html>';
file_put_contents($parse1, $put3 . "\n",FILE_APPEND);

mysqli_close($con_sql2);
header('Location: https://kindofcloudserver.com/index.html');
print "Good";