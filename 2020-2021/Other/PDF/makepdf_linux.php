<?php

function clean($uncleaned) {
$uncleaned=preg_replace('/^\h*\v+/m', '', $uncleaned);
$uncleaned=preg_replace('/^[ \t]+|[ \t]+$/m', '', $uncleaned);
$uncleaned=preg_replace('/\A[ \t]*\r?\n|\r?\n[ \t]*\Z/m', '', $uncleaned);
$uncleaned=ltrim($uncleaned);
$uncleaned=rtrim($uncleaned);
$uncleaned=preg_replace('/\s{2,}/', ' ', $uncleaned);
return($uncleaned);}

function generate($length) {
    $include_chars = "abcdefghijklmnopqrstuvwxyz";
    /* Uncomment below to include symbols */
    /* $include_chars .= "[{(!@#$%^/&*_+;?\:)}]"; */
    $charLength = strlen($include_chars);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $include_chars [rand(0, $charLength - 1)];
    }
    return $randomString;
}
/////////////////////
require_once('/home/vip/pdf/tcpdf.php');
////////////////////
@system('rm -R /home/vip/pdf/result/');
if (file_exists('/home/vip/pdf/result/')==FALSE) { mkdir('/home/vip/pdf/result/'); }


$cnt=750;

$m3=file('/home/vip/pdf/subjects.txt');
$text=$m3[mt_rand(0, count($m3)-1)];
$text=clean($text);

$pic1="/home/vip/pdf/1.jpg";
$pic2="/home/vip/pdf/2.jpg";



for($i=0;$i<$cnt;$i++)
{
list($width1, $height1) = getimagesize($pic1);
list($width2, $height2) = getimagesize($pic2);
$width=$width1-35;
$height=$height1+$height2-15;
$pageLayout = array($width, $height); //  or array($height, $width) 
$pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false);

//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);

//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
//$pdf->setFooterData(array(0,0,0), array(0,0,0));


$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//$pdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER);

$pdf->setImageScale(1.38);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}


$m1=file('/home/vip/pdf/links1_1.txt');
$link1=$m1[mt_rand(0, count($m1)-1)];
$link1=clean($link1);

$m2=file('/home/vip/pdf/links1_2.txt');
$link2=$m2[mt_rand(0, count($m2)-1)];
$link2=clean($link2);
	
$m10=file('/home/vip/pdf/links1_3.txt');
$link3=$m10[mt_rand(0, count($m10)-1)];
$link3=clean($link3);

$randnum1=mt_rand(2, 7);
$randnum2=mt_rand(5, 9);
$randnum3=mt_rand(4, 8);
$randnum4=mt_rand(2, 5);
$randnum5=mt_rand(5, 8);
$randnum6=mt_rand(7, 9);
$randnum7=mt_rand(3, 8);
$randnum8=mt_rand(3, 9);
$randnum9=mt_rand(6, 8);
$randnum10=mt_rand(6, 9);
$randnum11=mt_rand(6, 7);
$randnumname=mt_rand(9, 12);
$randpercent=mt_rand(99, 100);
$randdepth=mt_rand(1, 2);
$randfont=mt_rand(13, 14);

//$randcolor1=mt_rand(253, 255);
//$randcolor2=mt_rand(253, 255);
//$randcolor3=mt_rand(253, 255);


$text1=generate($randnum1);
$text2=generate($randnum2);
$text3=generate($randnum3);
$text4=generate($randnum4);
$text5=generate($randnum5);
$text6=generate($randnum6);
$text7=generate($randnum7);
$text8=generate($randnum8);
$text9=generate($randnum9);
$text10=generate($randnum10);
$text11=generate($randnum11);
$text1=ucwords($text1);
$text6=ucwords($text6);

$bright=mt_rand(1, 2);
$contrast=mt_rand(1, 2);
$smooth=mt_rand(99, 100);

$name=generate($randnumname);



///1 pic///
$image=ImageCreateFromJpeg($pic1);
imagefilter($image, IMG_FILTER_BRIGHTNESS, $bright);
imagefilter($image, IMG_FILTER_CONTRAST, $contrast);
//imagefilter($image, IMG_FILTER_SMOOTH, $smooth);

list($width, $height) = getimagesize($pic1);
$percent=$randpercent/100;
$depth=$randdepth/100;
$newwidth = $width * $percent;
$newheight = $height * $percent;

$new=imagecreatetruecolor($newwidth, $newheight);
imagecopyresized($new, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($new, '/home/vip/pdf/tempimage1.jpg');

///2 pic///
$image=ImageCreateFromJpeg($pic2);
imagefilter($image, IMG_FILTER_BRIGHTNESS, $bright);
imagefilter($image, IMG_FILTER_CONTRAST, $contrast);
//imagefilter($image, IMG_FILTER_SMOOTH, $smooth);

list($width, $height) = getimagesize($pic2);
$percent=$randpercent/100;
$depth=$randdepth/100;
$newwidth = $width * $percent;
$newheight = $height * $percent;

$new=imagecreatetruecolor($newwidth, $newheight);
imagecopyresized($new, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($new, '/home/vip/pdf/tempimage2.jpg');
////////////////////
$pdf->setFontSubsetting(true);
//$pdf->SetFont('dejavusans', '', '16', '', true);
$pdf->SetFont('dejavusans', '', $randfont, '', true);

$pdf->AddPage();

//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>$depth, 'depth_h'=>$depth, 'color'=>array($randcolor1,$randcolor2,$randcolor3), 'opacity'=>1, 'blend_mode'=>'Normal'));

/* $html1 = <<<EOD
<div align="center"><a href="$link1" style="text-decoration: none; text-transform:none;" target="_blank">$text</a></div>
<div align="center"><a href="$link2" style="text-decoration: none; text-transform:none;" target="_blank"><img src="/home/vip/pdf/tempimage1.jpg"></a></div>
<div align="center"><a href="$link3" style="text-decoration: none; text-transform:none;" target="_blank"><img src="/home/vip/pdf/tempimage2.jpg"></a></div>
EOD; */

$html1 = <<<EOD
<div align="center"><center><a href="$link1" style="text-decoration: none; text-transform:none;" target="_blank">$text</a></div><br><br>
EOD;

$html2 = <<<EOD
<div align="center"><a href="$link2" style="text-decoration: none; text-transform:none;" target="_blank"><img src="/home/vip/pdf/tempimage1.jpg"></a></div>
EOD;

$html3 = <<<EOD
<div align="center"><a href="$link3" style="text-decoration: none; text-transform:none;" target="_blank"><img src="/home/vip/pdf/tempimage2.jpg"></a></div>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html1, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $html3, 0, 1, 0, true, '', true);


/* $html2 = <<<EOD
<div style="text-align:center; color:rgb($randcolor1, $randcolor2, $randcolor3); ">$text</div>
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true); */

$pdf->Output('/home/vip/pdf/result/'.$name.'.pdf', 'F');
unlink('/home/vip/pdf/tempimage1.jpg');
unlink('/home/vip/pdf/tempimage2.jpg');

}

///////////////////////////
$vars = array_keys(get_defined_vars());
foreach($vars as $var) {
unset(${'$var'}); }

exit();
