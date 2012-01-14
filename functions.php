<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2011-2012 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2011-2012 Game Maker 2k - http://intdb.sourceforge.net/

    $FileInfo: functions.php - Last Update: 01/04/2012 Ver. 2.0.0 RC 8 - Author: cooldude2k $
*/

/*
UPC Resources and Info
http://en.wikipedia.org/wiki/Universal_Product_Code
http://en.wikipedia.org/wiki/Global_Trade_Item_Number
http://en.wikipedia.org/wiki/Barcode
http://www.ucancode.net/CPP_Library_Control_Tool/Draw-Print-encode-UPCA-barcode-UPCE-barcode-EAN13-barcode-VC-Code.htm
http://en.wikipedia.org/wiki/International_Article_Number
http://www.upcdatabase.com/docs/
http://www.accipiter.org/projects/cat.php
http://www.accipiter.org/download/kittycode.js
http://uscan.sourceforge.net/upc.txt
http://www.adams1.com/upccode.html
http://www.documentmedia.com/Media/PublicationsArticles/QuietZone.pdf
*/
function validate_upca($upc,$return_check=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>12||strlen($upc)<11) { return false; }
	if(strlen($upc)==11) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches); }
	if(strlen($upc)==12) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches); }
	$OddSum = ($upc_matches[1] + $upc_matches[3] + $upc_matches[5] + $upc_matches[7] + $upc_matches[9] + $upc_matches[11]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6] + $upc_matches[8] + $upc_matches[10];
	$AllSum = $OddSum + $EvenSum;
	$CheckSum = $AllSum % 10;
	if($CheckSum>0) {
	$CheckSum = 10 - $CheckSum; }
	if($return_check==false&&strlen($upc)==12) {
	if($CheckSum!=$upc_matches[12]) { return false; }
	if($CheckSum==$upc_matches[12]) { return true; } }
	if($return_check==true) { return $CheckSum; } 
	if(strlen($upc)==11) { return $CheckSum; } }
function validate_ean13($upc,$return_check=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>13||strlen($upc)<12) { return false; }
	if(strlen($upc)==12) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches); }
	if(strlen($upc)==13) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches); }
	$EvenSum = ($upc_matches[2] + $upc_matches[4] + $upc_matches[6] + $upc_matches[8] + $upc_matches[10] + $upc_matches[12]) * 3;
	$OddSum = $upc_matches[1] + $upc_matches[3] + $upc_matches[5] + $upc_matches[7] + $upc_matches[9] + $upc_matches[11];
	$AllSum = $OddSum + $EvenSum;
	$CheckSum = $AllSum % 10;
	if($CheckSum>0) {
	$CheckSum = 10 - $CheckSum; }
	if($return_check==false&&strlen($upc)==13) {
	if($CheckSum!=$upc_matches[13]) { return false; }
	if($CheckSum==$upc_matches[13]) { return true; } }
	if($return_check==true) { return $CheckSum; }
	if(strlen($upc)==12) { return $CheckSum; } }
function validate_ean8($upc,$return_check=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>8||strlen($upc)<7) { return false; }
	if(strlen($upc)==7) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches); }
	if(strlen($upc)==8) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches); }
	$EvenSum = ($upc_matches[1] + $upc_matches[3] + $upc_matches[5] + $upc_matches[7]) * 3;
	$OddSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6];
	$AllSum = $OddSum + $EvenSum;
	$CheckSum = $AllSum % 10;
	if($CheckSum>0) {
	$CheckSum = 10 - $CheckSum; }
	if($return_check==false&&strlen($upc)==8) {
	if($CheckSum!=$upc_matches[8]) { return false; }
	if($CheckSum==$upc_matches[8]) { return true; } }
	if($return_check==true) { return $CheckSum; }
	if(strlen($upc)==7) { return $CheckSum; } }
function validate_upce($upc,$return_check=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>8||strlen($upc)<7) { return false; }
	if(!preg_match("/^0/", $upc)) { return false; }
	$CheckDigit = null;
	if(strlen($upc)==8&&preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches)) {
	preg_match("/(\d{7})(\d{1})/", $upc, $upc_matches);
	$CheckDigit = $upc_matches[2]; }
	if(preg_match("/(\d{1})(\d{5})([0-3])/", $upc, $upc_matches)) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
	if($upc_matches[7]==0) {
	$OddSum = (0 + $upc_matches[3] + 0 + 0 + $upc_matches[4] + $upc_matches[6]) * 3;
	$EvenSum = $upc_matches[2] + 0 + 0 + 0 + $upc_matches[5]; }
	if($upc_matches[7]==1) {
	$OddSum = (0 + $upc_matches[3] + 0 + 0 + $upc_matches[4] + $upc_matches[6]) * 3;
	$EvenSum = $upc_matches[2] + 1 + 0 + 0 + $upc_matches[5]; }
	if($upc_matches[7]==2) {
	$OddSum = (0 + $upc_matches[3] + 0 + 0 + $upc_matches[4] + $upc_matches[6]) * 3;
	$EvenSum = $upc_matches[2] + 2 + 0 + 0 + $upc_matches[5]; }
	if($upc_matches[7]==3) {
	$OddSum = (0 + $upc_matches[3] + 0 + 0 + 0 + $upc_matches[6]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + 0 + 0 + $upc_matches[5]; } }
	if(preg_match("/(\d{1})(\d{5})([4-9])/", $upc, $upc_matches)) {
	preg_match("/(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
	if($upc_matches[7]==4) {
	$OddSum = (0 + $upc_matches[3] + $upc_matches[5] + 0 + 0 + $upc_matches[6]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + 0 + 0 + 0; }
	if($upc_matches[7]==5) {
	$OddSum = (0 + $upc_matches[3] + $upc_matches[5] + 0 + 0 + $upc_matches[7]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6] + 0 + 0; }
	if($upc_matches[7]==6) {
	$OddSum = (0 + $upc_matches[3] + $upc_matches[5] + 0 + 0 + $upc_matches[7]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6] + 0 + 0; }
	if($upc_matches[7]==7) {
	$OddSum = (0 + $upc_matches[3] + $upc_matches[5] + 0 + 0 + $upc_matches[7]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6] + 0 + 0; }
	if($upc_matches[7]==8) {
	$OddSum = (0 + $upc_matches[3] + $upc_matches[5] + 0 + 0 + $upc_matches[7]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6] + 0 + 0; }
	if($upc_matches[7]==9) {
	$OddSum = (0 + $upc_matches[3] + $upc_matches[5] + 0 + 0 + $upc_matches[7]) * 3;
	$EvenSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6] + 0 + 0; } }
	$AllSum = $OddSum + $EvenSum;
	$CheckSum = $AllSum % 10;
	if($CheckSum>0) {
	$CheckSum = 10 - $CheckSum; }
	if($return_check==false&&strlen($upc)==8) {
	if($CheckSum!=$CheckDigit) { return false; }
	if($CheckSum==$CheckDigit) { return true; } }
	if($return_check==true) { return $CheckSum; } 
	if(strlen($upc)==7) { return $CheckSum; } }
function validate_barcode($upc,$return_check=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==8) { return validate_upce($upc,$return_check); }
	if(strlen($upc)==12) { return validate_upca($upc,$return_check); }
	if(strlen($upc)==13) { return validate_ean13($upc,$return_check); } 
	return false; }
function convert_upce_to_upca($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>8||strlen($upc)<8) { return false; }
	if(!preg_match("/^0/", $upc)) { return false; }
	if(preg_match("/0(\d{5})([0-3])(\d{1})/", $upc, $upc_matches)) {
	$upce_test = preg_match("/0(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
	if($upce_test==false) { return false; }
	if($upc_matches[6]==0) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[6]."0000".$upc_matches[3].$upc_matches[4].$upc_matches[5].$upc_matches[7]; }
	if($upc_matches[6]==1) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[6]."0000".$upc_matches[3].$upc_matches[4].$upc_matches[5].$upc_matches[7]; }
	if($upc_matches[6]==2) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[6]."0000".$upc_matches[3].$upc_matches[4].$upc_matches[5].$upc_matches[7]; }
	if($upc_matches[6]==3) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3]."00000".$upc_matches[4].$upc_matches[5].$upc_matches[7]; } }
	if(preg_match("/0(\d{5})([4-9])(\d{1})/", $upc, $upc_matches)) {
	preg_match("/0(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
	if($upc_matches[6]==4) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4]."00000".$upc_matches[5].$upc_matches[7]; }
	if($upc_matches[6]==5) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7]; }
	if($upc_matches[6]==6) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7]; }
	if($upc_matches[6]==7) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7]; }
	if($upc_matches[6]==8) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7]; }
	if($upc_matches[6]==9) {
	$upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7]; } }
	return $upce; }
function convert_upca_to_ean13($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==12) { $ean13 = "0".$upc; }
	if(strlen($upc)==13) { $ean13 = $upc; }
	if(strlen($upc)>13||strlen($upc)<11) { return false; }
	return $ean13; }
function convert_upce_to_ean13($upc) {
	return convert_upca_to_ean13(convert_upce_to_upca($upc)); }
function convert_ean13_to_upca($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>13||strlen($upc)<13) { return false; }
	if(preg_match("/^0(\d{12})/", $upc, $upc_matches)) {
	$upca = $upc_matches[1]; }
	return $upca; }
function convert_upca_to_upce($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>12||strlen($upc)<12) { return false; }
	if(!preg_match("/0(\d{11})/", $upc)) { return false; }
	$upce = null;
	if(preg_match("/0(\d{2})00000(\d{3})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."0";
	$upce = $upce.$upc_matches[3]; }
	if(preg_match("/0(\d{2})10000(\d{3})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."1";
	$upce = $upce.$upc_matches[3]; }
	if(preg_match("/0(\d{2})20000(\d{3})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."2";
	$upce = $upce.$upc_matches[3]; }
	if(preg_match("/0(\d{3})00000(\d{2})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."3";
	$upce = $upce.$upc_matches[3]; }
	if(preg_match("/0(\d{4})00000(\d{1})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."4";
	$upce = $upce.$upc_matches[3]; }
	if(preg_match("/0(\d{5})00005(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."5";
	$upce = $upce.$upc_matches[2]; }
	if(preg_match("/0(\d{5})00006(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."6";
	$upce = $upce.$upc_matches[2]; }
	if(preg_match("/0(\d{5})00007(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."7";
	$upce = $upce.$upc_matches[2]; }
	if(preg_match("/0(\d{5})00008(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."8";
	$upce = $upce.$upc_matches[2]; }
	if(preg_match("/0(\d{5})00009(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."9";
	$upce = $upce.$upc_matches[2]; }
	if($upce==null) { return false; }
	return $upce; }
function convert_ean13_to_upce($upc) {
	return convert_upca_to_upce(convert_ean13_to_upca($upc)); }
function create_upca($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL) {
	if(strlen($upc)==8) { $upc = convert_upce_to_upca($upc); }
	if(strlen($upc)==13) { $upc = convert_ean13_to_upca($upc); }
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>12||strlen($upc)<12) { return false; }
	if(!isset($resize)||!is_numeric($resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if(validate_upca($upc)===false) { return false; }
	if($imgtype!="png"&&$imgtype!="gif"&&$imgtype!="xbm"&&$imgtype!="wbmp") { $imgtype = "png"; }
	preg_match("/(\d{1})(\d{5})(\d{5})(\d{1})/", $upc, $upc_matches);
	if(count($upc_matches)<=0) { return false; }
	$PrefixDigit = $upc_matches[1];
	$LeftDigit = str_split($upc_matches[2]);
	array_unshift($LeftDigit, $upc_matches[1]);
	$RightDigit = str_split($upc_matches[3]);
	array_push($RightDigit, $upc_matches[4]);
	$CheckDigit = $upc_matches[4];
	if($imgtype=="png") {
	if($outputimage==true) {
	header("Content-Type: image/png"); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	header("Content-Type: image/gif"); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	header("Content-Type: image/x-xbitmap"); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	header("Content-Type: image/vnd.wap.wbmp"); } }
	$upc_img = imagecreatetruecolor(113, 50);
	imagefilledrectangle($upc_img, 0, 0, 113, 50, 0xFFFFFF);
	imageinterlace($upc_img, true);
	$background_color = imagecolorallocate($upc_img, 255, 255, 255);
	$text_color = imagecolorallocate($upc_img, 0, 0, 0);
	$alt_text_color = imagecolorallocate($upc_img, 255, 255, 255);
	imagestring($upc_img, 2, 2, 37, $upc_matches[1], $text_color);
	imagestring($upc_img, 2, 22, 37, $upc_matches[2], $text_color);
	imagestring($upc_img, 2, 61, 37, $upc_matches[3], $text_color);
	imagestring($upc_img, 2, 106, 37, $upc_matches[4], $text_color);
	imageline($upc_img, 0, 0, 0, 37, $alt_text_color);
	imageline($upc_img, 1, 0, 1, 37, $alt_text_color);
	imageline($upc_img, 2, 0, 2, 37, $alt_text_color);
	imageline($upc_img, 3, 0, 3, 37, $alt_text_color);
	imageline($upc_img, 4, 0, 4, 37, $alt_text_color);
	imageline($upc_img, 5, 0, 5, 37, $alt_text_color);
	imageline($upc_img, 6, 0, 6, 37, $alt_text_color);
	imageline($upc_img, 7, 0, 7, 37, $alt_text_color);
	imageline($upc_img, 8, 0, 8, 37, $alt_text_color);
	imageline($upc_img, 9, 0, 9, 41, $text_color);
	imageline($upc_img, 10, 0, 10, 41, $alt_text_color);
	imageline($upc_img, 11, 0, 11, 41, $text_color);
	$NumZero = 0; $LineStart = 12;
	while ($NumZero < count($LeftDigit)) {
		if($NumZero!=0) { $LineSize = 37; }
		if($NumZero==0) { $LineSize = 41; }
		$left_text_color = array(0, 0, 0, 0, 0, 0, 0);
		if($LeftDigit[$NumZero]==0) { 
		$left_text_color = array(0, 0, 0, 1, 1, 0, 1); }
		if($LeftDigit[$NumZero]==1) { 
		$left_text_color = array(0, 0, 1, 1, 0, 0, 1); }
		if($LeftDigit[$NumZero]==2) { 
		$left_text_color = array(0, 0, 1, 0, 0, 1, 1); }
		if($LeftDigit[$NumZero]==3) { 
		$left_text_color = array(0, 1, 1, 1, 1, 0, 1); }
		if($LeftDigit[$NumZero]==4) { 
		$left_text_color = array(0, 1, 0, 0, 0, 1, 1); }
		if($LeftDigit[$NumZero]==5) { 
		$left_text_color = array(0, 1, 1, 0, 0, 0, 1); }
		if($LeftDigit[$NumZero]==6) { 
		$left_text_color = array(0, 1, 0, 1, 1, 1, 1); }
		if($LeftDigit[$NumZero]==7) { 
		$left_text_color = array(0, 1, 1, 1, 0, 1, 1); }
		if($LeftDigit[$NumZero]==8) { 
		$left_text_color = array(0, 1, 1, 0, 1, 1, 1); }
		if($LeftDigit[$NumZero]==9) {
		$left_text_color = array(0, 0, 0, 1, 0, 1, 1); }
		if($left_text_color[0]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[0]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[1]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[1]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[2]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[2]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[3]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[3]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[4]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[4]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[5]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[5]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[6]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[6]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 54, 0, 54, 41, $alt_text_color);
	imageline($upc_img, 55, 0, 55, 41, $text_color);
	imageline($upc_img, 56, 0, 56, 41, $alt_text_color);
	imageline($upc_img, 57, 0, 57, 41, $text_color);
	imageline($upc_img, 58, 0, 58, 41, $alt_text_color);
	$NumZero = 0; $LineStart = 59;
	while ($NumZero < count($RightDigit)) {
		if($NumZero!=5) { $LineSize = 37; }
		if($NumZero==5) { $LineSize = 41; }
		$right_text_color = array(0, 0, 0, 0, 0, 0, 0);
		if($RightDigit[$NumZero]==0) { 
		$right_text_color = array(1, 1, 1, 0, 0, 1, 0); }
		if($RightDigit[$NumZero]==1) { 
		$right_text_color = array(1, 1, 0, 0, 1, 1, 0); }
		if($RightDigit[$NumZero]==2) { 
		$right_text_color = array(1, 1, 0, 1, 1, 0, 0); }
		if($RightDigit[$NumZero]==3) { 
		$right_text_color = array(1, 0, 0, 0, 0, 1, 0); }
		if($RightDigit[$NumZero]==4) { 
		$right_text_color = array(1, 0, 1, 1, 1, 0, 0); }
		if($RightDigit[$NumZero]==5) { 
		$right_text_color = array(1, 0, 0, 1, 1, 1, 0); }
		if($RightDigit[$NumZero]==6) { 
		$right_text_color = array(1, 0, 1, 0, 0, 0, 0); }
		if($RightDigit[$NumZero]==7) { 
		$right_text_color = array(1, 0, 0, 0, 1, 0, 0); }
		if($RightDigit[$NumZero]==8) { 
		$right_text_color = array(1, 0, 0, 1, 0, 0, 0); }
		if($RightDigit[$NumZero]==9) { 
		$right_text_color = array(1, 1, 1, 0, 1, 0, 0); }
		if($right_text_color[0]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[0]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[1]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[1]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[2]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[2]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[3]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[3]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[4]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[4]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[5]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[5]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[6]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[6]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 101, 0, 101, 41, $text_color);
	imageline($upc_img, 102, 0, 102, 41, $alt_text_color);
	imageline($upc_img, 103, 0, 103, 41, $text_color);
	imageline($upc_img, 104, 0, 104, 37, $alt_text_color);
	imageline($upc_img, 105, 0, 105, 37, $alt_text_color);
	imageline($upc_img, 106, 0, 106, 37, $alt_text_color);
	imageline($upc_img, 107, 0, 107, 37, $alt_text_color);
	imageline($upc_img, 108, 0, 108, 37, $alt_text_color);
	imageline($upc_img, 109, 0, 109, 37, $alt_text_color);
	imageline($upc_img, 110, 0, 110, 37, $alt_text_color);
	imageline($upc_img, 111, 0, 111, 37, $alt_text_color);
	imageline($upc_img, 112, 0, 112, 37, $alt_text_color);
	if($resize>1) {
	$new_upc_img = imagecreatetruecolor(113 * $resize, 50 * $resize);
	imagefilledrectangle($new_upc_img, 0, 0, 113 * $resize, 50 * $resize, 0xFFFFFF);
	imageinterlace($new_upc_img, true);
	if($resizetype=="resize") {
	imagecopyresized($new_upc_img, $upc_img, 0, 0, 0, 0, 113 * $resize, 50 * $resize, 113, 50); }
	if($resizetype=="resample") {
	imagecopyresampled($new_upc_img, $upc_img, 0, 0, 0, 0, 113 * $resize, 50 * $resize, 113, 50); }
	imagedestroy($upc_img); 
	$upc_img = $new_upc_img; }
	if($imgtype=="png") {
	if($outputimage==true) {
	imagepng($upc_img); }
	if($outfile!=null) {
	imagepng($upc_img,$outfile); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	imagegif($upc_img); }
	if($outfile!=null) {
	imagegif($upc_img,$outfile); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	imagexbm($upc_img,NULL); }
	if($outfile!=null) {
	imagexbm($upc_img,$outfile); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	imagewbmp($upc_img); }
	if($outfile!=null) {
	imagewbmp($upc_img,$outfile); } }
	imagedestroy($upc_img); 
	return true; }
function create_upce($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL) {
	if(strlen($upc)==12) { $upc = convert_upca_to_upce($upc); }
	if(strlen($upc)==13) { $upc = convert_ean13_to_upce($upc); }
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>8||strlen($upc)<8) { return false; }
	if(!isset($resize)||!is_numeric($resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if(!preg_match("/^0/", $upc)) { return false; }
	if(validate_upce($upc)===false) { return false; }
	if($imgtype!="png"&&$imgtype!="gif"&&$imgtype!="xbm"&&$imgtype!="wbmp") { $imgtype = "png"; }
	preg_match("/(\d{1})(\d{6})(\d{1})/", $upc, $upc_matches);
	if(count($upc_matches)<=0) { return false; }
	if($upc_matches[1]>1) { return false; }
	$PrefixDigit = $upc_matches[1];
	$LeftDigit = str_split($upc_matches[2]);
	$CheckDigit = $upc_matches[3];
	if($imgtype=="png") {
	if($outputimage==true) {
	header("Content-Type: image/png"); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	header("Content-Type: image/gif"); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	header("Content-Type: image/x-xbitmap"); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	header("Content-Type: image/vnd.wap.wbmp"); } }
	$upc_img = imagecreatetruecolor(67, 50);
	imagefilledrectangle($upc_img, 0, 0, 67, 50, 0xFFFFFF);
	imageinterlace($upc_img, true);
	$background_color = imagecolorallocate($upc_img, 255, 255, 255);
	$text_color = imagecolorallocate($upc_img, 0, 0, 0);
	$alt_text_color = imagecolorallocate($upc_img, 255, 255, 255);
	imagestring($upc_img, 2, 2, 37, $upc_matches[1], $text_color);
	imagestring($upc_img, 2, 16, 37, $upc_matches[2], $text_color);
	imagestring($upc_img, 2, 62, 37, $upc_matches[3], $text_color);
	imageline($upc_img, 0, 0, 0, 37, $alt_text_color);
	imageline($upc_img, 1, 0, 1, 37, $alt_text_color);
	imageline($upc_img, 2, 0, 2, 37, $alt_text_color);
	imageline($upc_img, 3, 0, 3, 37, $alt_text_color);
	imageline($upc_img, 4, 0, 4, 37, $alt_text_color);
	imageline($upc_img, 5, 0, 5, 37, $alt_text_color);
	imageline($upc_img, 6, 0, 6, 37, $alt_text_color);
	imageline($upc_img, 7, 0, 7, 37, $alt_text_color);
	imageline($upc_img, 8, 0, 8, 37, $alt_text_color);
	imageline($upc_img, 9, 0, 9, 41, $text_color);
	imageline($upc_img, 10, 0, 10, 41, $alt_text_color);
	imageline($upc_img, 11, 0, 11, 41, $text_color);
	$NumZero = 0; $LineStart = 12;
	while ($NumZero < count($LeftDigit)) {
		$LineSize = 37;
		$left_text_color = array(0, 0, 0, 0, 0, 0, 0);
		$left_text_color_odd = array(0, 0, 0, 0, 0, 0, 0);
		$left_text_color_even = array(0, 0, 0, 0, 0, 0, 0);
		if($LeftDigit[$NumZero]==0) { 
		$left_text_color_odd = array(0, 0, 0, 1, 1, 0, 1); 
		$left_text_color_even = array(0, 1, 0, 0, 1, 1, 1); }
		if($LeftDigit[$NumZero]==1) { 
		$left_text_color_odd = array(0, 0, 1, 1, 0, 0, 1); 
		$left_text_color_even = array(0, 1, 1, 0, 0, 1, 1); }
		if($LeftDigit[$NumZero]==2) { 
		$left_text_color_odd = array(0, 0, 1, 0, 0, 1, 1); 
		$left_text_color_even = array(0, 0, 1, 1, 0, 1, 1); }
		if($LeftDigit[$NumZero]==3) { 
		$left_text_color_odd = array(0, 1, 1, 1, 1, 0, 1); 
		$left_text_color_even = array(0, 1, 0, 0, 0, 0, 1); }
		if($LeftDigit[$NumZero]==4) { 
		$left_text_color_odd = array(0, 1, 0, 0, 0, 1, 1); 
		$left_text_color_even = array(0, 0, 1, 1, 1, 0, 1); }
		if($LeftDigit[$NumZero]==5) { 
		$left_text_color_odd = array(0, 1, 1, 0, 0, 0, 1); 
		$left_text_color_even = array(0, 1, 1, 1, 0, 0, 1); }
		if($LeftDigit[$NumZero]==6) { 
		$left_text_color_odd = array(0, 1, 0, 1, 1, 1, 1); 
		$left_text_color_even = array(0, 0, 0, 0, 1, 0, 1); }
		if($LeftDigit[$NumZero]==7) { 
		$left_text_color_odd = array(0, 1, 1, 1, 0, 1, 1); 
		$left_text_color_even = array(0, 0, 1, 0, 0, 0, 1); }
		if($LeftDigit[$NumZero]==8) { 
		$left_text_color_odd = array(0, 1, 1, 0, 1, 1, 1); 
		$left_text_color_even = array(0, 0, 0, 1, 0, 0, 1); }
		if($LeftDigit[$NumZero]==9) {
		$left_text_color_odd = array(0, 0, 0, 1, 0, 1, 1);
		$left_text_color_even = array(0, 0, 1, 0, 1, 1, 1); }
		$left_text_color = $left_text_color_odd;
		if($upc_matches[3]==0&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==2) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==1&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==2&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==3&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==4&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==5&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==6&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==7&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==8&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==9&&$upc_matches[1]==0) {
		if($NumZero==0) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==0&&$upc_matches[1]==1) {
		if($NumZero==3) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==1&&$upc_matches[1]==1) {
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==2&&$upc_matches[1]==1) {
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==3&&$upc_matches[1]==1) {
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==4&&$upc_matches[1]==1) {
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==5&&$upc_matches[1]==1) {
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==6&&$upc_matches[1]==1) {
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==7&&$upc_matches[1]==1) {
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; }
		if($NumZero==5) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==8&&$upc_matches[1]==1) {
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==3) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; } }
		if($upc_matches[3]==9&&$upc_matches[1]==1) {
		if($NumZero==1) { $left_text_color = $left_text_color_even; }
		if($NumZero==2) { $left_text_color = $left_text_color_even; }
		if($NumZero==4) { $left_text_color = $left_text_color_even; } }
		if($left_text_color[0]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[0]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[1]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[1]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[2]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[2]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[3]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[3]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[4]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[4]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[5]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[5]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[6]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[6]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 54, 0, 54, 41, $alt_text_color);
	imageline($upc_img, 55, 0, 55, 41, $text_color);
	imageline($upc_img, 56, 0, 56, 41, $alt_text_color);
	imageline($upc_img, 57, 0, 57, 41, $text_color);
	imageline($upc_img, 58, 0, 58, 41, $alt_text_color);
	imageline($upc_img, 59, 0, 59, 41, $text_color);
	imageline($upc_img, 60, 0, 60, 37, $alt_text_color);
	imageline($upc_img, 61, 0, 61, 37, $alt_text_color);
	imageline($upc_img, 62, 0, 62, 37, $alt_text_color);
	imageline($upc_img, 63, 0, 63, 37, $alt_text_color);
	imageline($upc_img, 64, 0, 64, 37, $alt_text_color);
	imageline($upc_img, 65, 0, 65, 37, $alt_text_color);
	imageline($upc_img, 66, 0, 66, 37, $alt_text_color);
	if($resize>1) {
	$new_upc_img = imagecreatetruecolor(67 * $resize, 50 * $resize);
	imagefilledrectangle($new_upc_img, 0, 0, 67 * $resize, 50 * $resize, 0xFFFFFF);
	imageinterlace($new_upc_img, true);
	if($resizetype=="resize") {
	imagecopyresized($new_upc_img, $upc_img, 0, 0, 0, 0, 67 * $resize, 50 * $resize, 67, 50); }
	if($resizetype=="resample") {
	imagecopyresampled($new_upc_img, $upc_img, 0, 0, 0, 0, 67 * $resize, 50 * $resize, 67, 50); }
	imagedestroy($upc_img); 
	$upc_img = $new_upc_img; }
	if($imgtype=="png") {
	if($outputimage==true) {
	imagepng($upc_img); }
	if($outfile!=null) {
	imagepng($upc_img,$outfile); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	imagegif($upc_img); }
	if($outfile!=null) {
	imagegif($upc_img,$outfile); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	imagexbm($upc_img,NULL); }
	if($outfile!=null) {
	imagexbm($upc_img,$outfile); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	imagewbmp($upc_img); }
	if($outfile!=null) {
	imagewbmp($upc_img,$outfile); } }
	imagedestroy($upc_img); 
	return true; }
function create_ean13($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL) {
	if(strlen($upc)==8) { $upc = convert_upce_to_ean13($upc); }
	if(strlen($upc)==12) { $upc = convert_upca_to_ean13($upc); }
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==12) { $upc = "0".$upc; }
	if(strlen($upc)>13||strlen($upc)<13) { return false; }
	if(!isset($resize)||!is_numeric($resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if(validate_ean13($upc)===false) { return false; }
	if($imgtype!="png"&&$imgtype!="gif"&&$imgtype!="xbm"&&$imgtype!="wbmp") { $imgtype = "png"; }
	preg_match("/(\d{1})(\d{6})(\d{6})/", $upc, $upc_matches);
	if(count($upc_matches)<=0) { return false; }
	$PrefixDigit = $upc_matches[1];
	$LeftDigit = str_split($upc_matches[2]);
	$RightDigit = str_split($upc_matches[3]);
	if($imgtype=="png") {
	if($outputimage==true) {
	header("Content-Type: image/png"); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	header("Content-Type: image/gif"); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	header("Content-Type: image/x-xbitmap"); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	header("Content-Type: image/vnd.wap.wbmp"); } }
	$upc_img = imagecreatetruecolor(113, 50);
	imagefilledrectangle($upc_img, 0, 0, 113, 50, 0xFFFFFF);
	imageinterlace($upc_img, true);
	$background_color = imagecolorallocate($upc_img, 255, 255, 255);
	$text_color = imagecolorallocate($upc_img, 0, 0, 0);
	$alt_text_color = imagecolorallocate($upc_img, 255, 255, 255);
	imagestring($upc_img, 2, 4, 37, $upc_matches[1], $text_color);
	imagestring($upc_img, 2, 18, 37, $upc_matches[2], $text_color);
	imagestring($upc_img, 2, 65, 37, $upc_matches[3], $text_color);
	imageline($upc_img, 0, 0, 0, 37, $alt_text_color);
	imageline($upc_img, 1, 0, 1, 37, $alt_text_color);
	imageline($upc_img, 2, 0, 2, 37, $alt_text_color);
	imageline($upc_img, 3, 0, 3, 37, $alt_text_color);
	imageline($upc_img, 4, 0, 4, 37, $alt_text_color);
	imageline($upc_img, 5, 0, 5, 37, $alt_text_color);
	imageline($upc_img, 6, 0, 6, 37, $alt_text_color);
	imageline($upc_img, 7, 0, 7, 37, $alt_text_color);
	imageline($upc_img, 8, 0, 8, 37, $alt_text_color);
	imageline($upc_img, 9, 0, 9, 37, $alt_text_color);
	imageline($upc_img, 10, 0, 10, 41, $alt_text_color);
	imageline($upc_img, 11, 0, 11, 41, $text_color);
	imageline($upc_img, 12, 0, 12, 41, $alt_text_color);
	imageline($upc_img, 13, 0, 13, 41, $text_color);
	$NumZero = 0; $LineStart = 14;
	while ($NumZero < count($LeftDigit)) {
		$LineSize = 37;
		$left_text_color_l = array(0, 0, 0, 0, 0, 0, 0); 
		$left_text_color_g = array(1, 1, 1, 1, 1, 1, 1);
		if($LeftDigit[$NumZero]==0) { 
		$left_text_color_l = array(0, 0, 0, 1, 1, 0, 1); 
		$left_text_color_g = array(0, 1, 0, 0, 1, 1, 1); }
		if($LeftDigit[$NumZero]==1) { 
		$left_text_color_l = array(0, 0, 1, 1, 0, 0, 1); 
		$left_text_color_g = array(0, 1, 1, 0, 0, 1, 1); }
		if($LeftDigit[$NumZero]==2) { 
		$left_text_color_l = array(0, 0, 1, 0, 0, 1, 1); 
		$left_text_color_g = array(0, 0, 1, 1, 0, 1, 1); }
		if($LeftDigit[$NumZero]==3) { 
		$left_text_color_l = array(0, 1, 1, 1, 1, 0, 1); 
		$left_text_color_g = array(0, 1, 0, 0, 0, 0, 1); }
		if($LeftDigit[$NumZero]==4) { 
		$left_text_color_l = array(0, 1, 0, 0, 0, 1, 1); 
		$left_text_color_g = array(0, 0, 1, 1, 1, 0, 1); }
		if($LeftDigit[$NumZero]==5) { 
		$left_text_color_l = array(0, 1, 1, 0, 0, 0, 1); 
		$left_text_color_g = array(0, 1, 1, 1, 0, 0, 1); }
		if($LeftDigit[$NumZero]==6) { 
		$left_text_color_l = array(0, 1, 0, 1, 1, 1, 1); 
		$left_text_color_g = array(0, 0, 0, 0, 1, 0, 1); }
		if($LeftDigit[$NumZero]==7) { 
		$left_text_color_l = array(0, 1, 1, 1, 0, 1, 1); 
		$left_text_color_g = array(0, 0, 1, 0, 0, 0, 1); }
		if($LeftDigit[$NumZero]==8) { 
		$left_text_color_l = array(0, 1, 1, 0, 1, 1, 1); 
		$left_text_color_g = array(0, 0, 0, 1, 0, 0, 1); }
		if($LeftDigit[$NumZero]==9) {
		$left_text_color_l = array(0, 0, 0, 1, 0, 1, 1);
		$left_text_color_g = array(0, 0, 1, 0, 1, 1, 1); }
		$left_text_color = $left_text_color_l;
		if($upc_matches[1]==1) {
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==2) {
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==3) {
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==4) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==5) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==6) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==7) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==8) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==9) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; } }
		if($left_text_color[0]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[0]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[1]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[1]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[2]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[2]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[3]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[3]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[4]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[4]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[5]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[5]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[6]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[6]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 56, 0, 56, 41, $alt_text_color);
	imageline($upc_img, 57, 0, 57, 41, $text_color);
	imageline($upc_img, 58, 0, 58, 41, $alt_text_color);
	imageline($upc_img, 59, 0, 59, 41, $text_color);
	imageline($upc_img, 60, 0, 60, 41, $alt_text_color);
	$NumZero = 0; $LineStart = 61;
	while ($NumZero < count($RightDigit)) {
		$LineSize = 37;
		$right_text_color = array(0, 0, 0, 0, 0, 0, 0);
		if($RightDigit[$NumZero]==0) { 
		$right_text_color = array(1, 1, 1, 0, 0, 1, 0); }
		if($RightDigit[$NumZero]==1) { 
		$right_text_color = array(1, 1, 0, 0, 1, 1, 0); }
		if($RightDigit[$NumZero]==2) { 
		$right_text_color = array(1, 1, 0, 1, 1, 0, 0); }
		if($RightDigit[$NumZero]==3) { 
		$right_text_color = array(1, 0, 0, 0, 0, 1, 0); }
		if($RightDigit[$NumZero]==4) { 
		$right_text_color = array(1, 0, 1, 1, 1, 0, 0); }
		if($RightDigit[$NumZero]==5) { 
		$right_text_color = array(1, 0, 0, 1, 1, 1, 0); }
		if($RightDigit[$NumZero]==6) { 
		$right_text_color = array(1, 0, 1, 0, 0, 0, 0); }
		if($RightDigit[$NumZero]==7) { 
		$right_text_color = array(1, 0, 0, 0, 1, 0, 0); }
		if($RightDigit[$NumZero]==8) { 
		$right_text_color = array(1, 0, 0, 1, 0, 0, 0); }
		if($RightDigit[$NumZero]==9) { 
		$right_text_color = array(1, 1, 1, 0, 1, 0, 0); }
		if($right_text_color[0]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[0]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[1]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[1]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[2]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[2]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[3]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[3]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[4]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[4]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[5]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[5]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[6]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[6]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 103, 0, 103, 41, $text_color);
	imageline($upc_img, 104, 0, 104, 41, $alt_text_color);
	imageline($upc_img, 105, 0, 105, 41, $text_color);
	imageline($upc_img, 106, 0, 106, 37, $alt_text_color);
	imageline($upc_img, 107, 0, 107, 37, $alt_text_color);
	imageline($upc_img, 108, 0, 108, 37, $alt_text_color);
	imageline($upc_img, 109, 0, 109, 37, $alt_text_color);
	imageline($upc_img, 110, 0, 110, 37, $alt_text_color);
	imageline($upc_img, 111, 0, 111, 37, $alt_text_color);
	imageline($upc_img, 112, 0, 112, 37, $alt_text_color);
	if($resize>1) {
	$new_upc_img = imagecreatetruecolor(113 * $resize, 50 * $resize);
	imagefilledrectangle($new_upc_img, 0, 0, 113, 50, 0xFFFFFF);
	imageinterlace($new_upc_img, true);
	if($resizetype=="resize") {
	imagecopyresized($new_upc_img, $upc_img, 0, 0, 0, 0, 113 * $resize, 50 * $resize, 113, 50); }
	if($resizetype=="resample") {
	imagecopyresampled($new_upc_img, $upc_img, 0, 0, 0, 0, 113 * $resize, 50 * $resize, 113, 50); }
	imagedestroy($upc_img); 
	$upc_img = $new_upc_img; }
	if($imgtype=="png") {
	if($outputimage==true) {
	imagepng($upc_img); }
	if($outfile!=null) {
	imagepng($upc_img,$outfile); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	imagegif($upc_img); }
	if($outfile!=null) {
	imagegif($upc_img,$outfile); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	imagexbm($upc_img,NULL); }
	if($outfile!=null) {
	imagexbm($upc_img,$outfile); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	imagewbmp($upc_img); }
	if($outfile!=null) {
	imagewbmp($upc_img,$outfile); } }
	imagedestroy($upc_img); 
	return true; }
function create_ean8($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>8||strlen($upc)<8) { return false; }
	if(!isset($resize)||!is_numeric($resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if(validate_ean8($upc)===false) { return false; }
	if($imgtype!="png"&&$imgtype!="gif"&&$imgtype!="xbm"&&$imgtype!="wbmp") { $imgtype = "png"; }
	preg_match("/(\d{4})(\d{4})/", $upc, $upc_matches);
	if(count($upc_matches)<=0) { return false; }
	$LeftDigit = str_split($upc_matches[1]);
	preg_match("/(\d{2})(\d{2})/", $upc_matches[1], $upc_matches_new);
	$LeftLeftDigit = $upc_matches_new[1];
	$LeftRightDigit = $upc_matches_new[2];
	$RightDigit = str_split($upc_matches[2]);
	preg_match("/(\d{2})(\d{2})/", $upc_matches[2], $upc_matches_new);
	$RightLeftDigit = $upc_matches_new[1];
	$RightRightDigit = $upc_matches_new[2];
	if($imgtype=="png") {
	if($outputimage==true) {
	header("Content-Type: image/png"); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	header("Content-Type: image/gif"); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	header("Content-Type: image/x-xbitmap"); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	header("Content-Type: image/vnd.wap.wbmp"); } }
	$upc_img = imagecreatetruecolor(81, 50);
	imagefilledrectangle($upc_img, 0, 0, 81, 50, 0xFFFFFF);
	imageinterlace($upc_img, true);
	$background_color = imagecolorallocate($upc_img, 255, 255, 255);
	$text_color = imagecolorallocate($upc_img, 0, 0, 0);
	$alt_text_color = imagecolorallocate($upc_img, 255, 255, 255);
	imagestring($upc_img, 2, 12, 37, $LeftLeftDigit, $text_color);
	imagestring($upc_img, 2, 25, 37, $LeftRightDigit, $text_color);
	imagestring($upc_img, 2, 45, 37, $RightLeftDigit, $text_color);
	imagestring($upc_img, 2, 58, 37, $RightRightDigit, $text_color);
	imageline($upc_img, 0, 0, 0, 37, $alt_text_color);
	imageline($upc_img, 1, 0, 1, 37, $alt_text_color);
	imageline($upc_img, 2, 0, 2, 37, $alt_text_color);
	imageline($upc_img, 3, 0, 3, 37, $alt_text_color);
	imageline($upc_img, 4, 0, 4, 37, $alt_text_color);
	imageline($upc_img, 5, 0, 5, 37, $alt_text_color);
	imageline($upc_img, 6, 0, 6, 37, $alt_text_color);
	imageline($upc_img, 7, 0, 7, 41, $text_color);
	imageline($upc_img, 8, 0, 8, 41, $alt_text_color);
	imageline($upc_img, 9, 0, 9, 41, $text_color);
	$NumZero = 0; $LineStart = 10;
	while ($NumZero < count($LeftDigit)) {
		$LineSize = 37;
		$left_text_color_l = array(0, 0, 0, 0, 0, 0, 0); 
		$left_text_color_g = array(1, 1, 1, 1, 1, 1, 1);
		if($LeftDigit[$NumZero]==0) { 
		$left_text_color_l = array(0, 0, 0, 1, 1, 0, 1); 
		$left_text_color_g = array(0, 1, 0, 0, 1, 1, 1); }
		if($LeftDigit[$NumZero]==1) { 
		$left_text_color_l = array(0, 0, 1, 1, 0, 0, 1); 
		$left_text_color_g = array(0, 1, 1, 0, 0, 1, 1); }
		if($LeftDigit[$NumZero]==2) { 
		$left_text_color_l = array(0, 0, 1, 0, 0, 1, 1); 
		$left_text_color_g = array(0, 0, 1, 1, 0, 1, 1); }
		if($LeftDigit[$NumZero]==3) { 
		$left_text_color_l = array(0, 1, 1, 1, 1, 0, 1); 
		$left_text_color_g = array(0, 1, 0, 0, 0, 0, 1); }
		if($LeftDigit[$NumZero]==4) { 
		$left_text_color_l = array(0, 1, 0, 0, 0, 1, 1); 
		$left_text_color_g = array(0, 0, 1, 1, 1, 0, 1); }
		if($LeftDigit[$NumZero]==5) { 
		$left_text_color_l = array(0, 1, 1, 0, 0, 0, 1); 
		$left_text_color_g = array(0, 1, 1, 1, 0, 0, 1); }
		if($LeftDigit[$NumZero]==6) { 
		$left_text_color_l = array(0, 1, 0, 1, 1, 1, 1); 
		$left_text_color_g = array(0, 0, 0, 0, 1, 0, 1); }
		if($LeftDigit[$NumZero]==7) { 
		$left_text_color_l = array(0, 1, 1, 1, 0, 1, 1); 
		$left_text_color_g = array(0, 0, 1, 0, 0, 0, 1); }
		if($LeftDigit[$NumZero]==8) { 
		$left_text_color_l = array(0, 1, 1, 0, 1, 1, 1); 
		$left_text_color_g = array(0, 0, 0, 1, 0, 0, 1); }
		if($LeftDigit[$NumZero]==9) {
		$left_text_color_l = array(0, 0, 0, 1, 0, 1, 1);
		$left_text_color_g = array(0, 0, 1, 0, 1, 1, 1); }
		$left_text_color = $left_text_color_l;
		if($upc_matches[1]==1) {
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==2) {
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==3) {
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==4) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==5) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==6) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==7) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==5) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==8) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==3) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; } }
		if($upc_matches[1]==9) {
		if($NumZero==1) { $left_text_color = $left_text_color_g; }
		if($NumZero==2) { $left_text_color = $left_text_color_g; }
		if($NumZero==4) { $left_text_color = $left_text_color_g; } }
		if($left_text_color[0]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[0]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[1]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[1]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[2]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[2]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[3]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[3]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[4]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[4]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[5]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[5]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[6]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($left_text_color[6]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 38, 0, 38, 41, $alt_text_color);
	imageline($upc_img, 39, 0, 39, 41, $text_color);
	imageline($upc_img, 40, 0, 40, 41, $alt_text_color);
	imageline($upc_img, 41, 0, 41, 41, $text_color);
	imageline($upc_img, 42, 0, 42, 41, $alt_text_color);
	$NumZero = 0; $LineStart = 43;
	while ($NumZero < count($RightDigit)) {
		$LineSize = 37;
		$right_text_color = array(0, 0, 0, 0, 0, 0, 0);
		if($RightDigit[$NumZero]==0) { 
		$right_text_color = array(1, 1, 1, 0, 0, 1, 0); }
		if($RightDigit[$NumZero]==1) { 
		$right_text_color = array(1, 1, 0, 0, 1, 1, 0); }
		if($RightDigit[$NumZero]==2) { 
		$right_text_color = array(1, 1, 0, 1, 1, 0, 0); }
		if($RightDigit[$NumZero]==3) { 
		$right_text_color = array(1, 0, 0, 0, 0, 1, 0); }
		if($RightDigit[$NumZero]==4) { 
		$right_text_color = array(1, 0, 1, 1, 1, 0, 0); }
		if($RightDigit[$NumZero]==5) { 
		$right_text_color = array(1, 0, 0, 1, 1, 1, 0); }
		if($RightDigit[$NumZero]==6) { 
		$right_text_color = array(1, 0, 1, 0, 0, 0, 0); }
		if($RightDigit[$NumZero]==7) { 
		$right_text_color = array(1, 0, 0, 0, 1, 0, 0); }
		if($RightDigit[$NumZero]==8) { 
		$right_text_color = array(1, 0, 0, 1, 0, 0, 0); }
		if($RightDigit[$NumZero]==9) { 
		$right_text_color = array(1, 1, 1, 0, 1, 0, 0); }
		if($right_text_color[0]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[0]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[1]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[1]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[2]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[2]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[3]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[3]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[4]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[4]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[5]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[5]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[6]==1) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $text_color); }
		if($right_text_color[6]==0) {
		imageline($upc_img, $LineStart, 0, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 71, 0, 71, 41, $text_color);
	imageline($upc_img, 72, 0, 72, 41, $alt_text_color);
	imageline($upc_img, 73, 0, 73, 41, $text_color);
	imageline($upc_img, 74, 0, 74, 37, $alt_text_color);
	imageline($upc_img, 75, 0, 75, 37, $alt_text_color);
	imageline($upc_img, 76, 0, 76, 37, $alt_text_color);
	imageline($upc_img, 77, 0, 77, 37, $alt_text_color);
	imageline($upc_img, 78, 0, 78, 37, $alt_text_color);
	imageline($upc_img, 79, 0, 79, 37, $alt_text_color);
	imageline($upc_img, 80, 0, 80, 37, $alt_text_color);
	if($resize>1) {
	$new_upc_img = imagecreatetruecolor(81 * $resize, 50 * $resize);
	imagefilledrectangle($new_upc_img, 0, 0, 81, 50, 0xFFFFFF);
	imageinterlace($new_upc_img, true);
	if($resizetype=="resize") {
	imagecopyresized($new_upc_img, $upc_img, 0, 0, 0, 0, 81 * $resize, 50 * $resize, 81, 50); }
	if($resizetype=="resample") {
	imagecopyresampled($new_upc_img, $upc_img, 0, 0, 0, 0, 81 * $resize, 50 * $resize, 81, 50); }
	imagedestroy($upc_img); 
	$upc_img = $new_upc_img; }
	if($imgtype=="png") {
	if($outputimage==true) {
	imagepng($upc_img); }
	if($outfile!=null) {
	imagepng($upc_img,$outfile); } }
	if($imgtype=="gif") {
	if($outputimage==true) {
	imagegif($upc_img); }
	if($outfile!=null) {
	imagegif($upc_img,$outfile); } }
	if($imgtype=="xbm") {
	if($outputimage==true) {
	imagexbm($upc_img,NULL); }
	if($outfile!=null) {
	imagexbm($upc_img,$outfile); } }
	if($imgtype=="wbmp") {
	if($outputimage==true) {
	imagewbmp($upc_img); }
	if($outfile!=null) {
	imagewbmp($upc_img,$outfile); } }
	imagedestroy($upc_img); 
	return true; }
function create_barcode($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(!isset($resize)||!is_numeric($resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if(strlen($upc)==8) { return create_upce($upc,$imgtype,$outputimage,$resize,$outfile); }
	if(strlen($upc)==12) { return create_upca($upc,$imgtype,$outputimage,$resize,$outfile); }
	if(strlen($upc)==13) { return create_ean13($upc,$imgtype,$outputimage,$resize,$outfile); } 
	return false; }
?>