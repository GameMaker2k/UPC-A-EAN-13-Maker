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
    Copyright 2011-2012 Kazuki Przyborowski - https://github.com/KazukiPrzyborowski

    $FileInfo: ean8.php - Last Update: 01/28/2012 Ver. 2.0.5 RC 1 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="ean8.php"||$File3Name=="/ean8.php") {
	chdir("../");
	require("./upc.php");
	exit(); }

function create_ean8($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL,$hidecd=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==7) { $upc = $upc.validate_ean8($upc,true); }
	if(strlen($upc)>8||strlen($upc)<8) { return false; }
	if(!isset($resize)||!preg_match("/^([0-9]*[\.]?[0-9])/", $resize)||$resize<1) { $resize = 1; }
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
	$upc_img = imagecreatetruecolor(83, 62);
	imagefilledrectangle($upc_img, 0, 0, 83, 62, 0xFFFFFF);
	imageinterlace($upc_img, true);
	$background_color = imagecolorallocate($upc_img, 255, 255, 255);
	$text_color = imagecolorallocate($upc_img, 0, 0, 0);
	$alt_text_color = imagecolorallocate($upc_img, 255, 255, 255);
	imagestring($upc_img, 2, 12, 47, $LeftLeftDigit, $text_color);
	imagestring($upc_img, 2, 25, 47, $LeftRightDigit, $text_color);
	imagestring($upc_img, 2, 45, 47, $RightLeftDigit, $text_color);
	imagestring($upc_img, 2, 58, 47, $RightRightDigit, $text_color);
	imageline($upc_img, 0, 10, 0, 47, $alt_text_color);
	imageline($upc_img, 1, 10, 1, 47, $alt_text_color);
	imageline($upc_img, 2, 10, 2, 47, $alt_text_color);
	imageline($upc_img, 3, 10, 3, 47, $alt_text_color);
	imageline($upc_img, 4, 10, 4, 47, $alt_text_color);
	imageline($upc_img, 5, 10, 5, 47, $alt_text_color);
	imageline($upc_img, 6, 10, 6, 47, $alt_text_color);
	imageline($upc_img, 7, 10, 7, 51, $text_color);
	imageline($upc_img, 8, 10, 8, 51, $alt_text_color);
	imageline($upc_img, 9, 10, 9, 51, $text_color);
	$NumZero = 0; $LineStart = 10;
	while ($NumZero < count($LeftDigit)) {
		$LineSize = 47;
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
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[0]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[1]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[1]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[2]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[2]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[3]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[3]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[4]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[4]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[5]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[5]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($left_text_color[6]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[6]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 38, 10, 38, 51, $alt_text_color);
	imageline($upc_img, 39, 10, 39, 51, $text_color);
	imageline($upc_img, 40, 10, 40, 51, $alt_text_color);
	imageline($upc_img, 41, 10, 41, 51, $text_color);
	imageline($upc_img, 42, 10, 42, 51, $alt_text_color);
	$NumZero = 0; $LineStart = 43;
	while ($NumZero < count($RightDigit)) {
		$LineSize = 47;
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
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($right_text_color[0]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[1]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($right_text_color[1]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[2]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($right_text_color[2]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[3]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($right_text_color[3]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[4]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($right_text_color[4]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[5]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($right_text_color[5]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		if($right_text_color[6]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($right_text_color[6]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$NumZero; }
	imageline($upc_img, 71, 10, 71, 51, $text_color);
	imageline($upc_img, 72, 10, 72, 51, $alt_text_color);
	imageline($upc_img, 73, 10, 73, 51, $text_color);
	imageline($upc_img, 74, 10, 74, 47, $alt_text_color);
	imageline($upc_img, 75, 10, 75, 47, $alt_text_color);
	imageline($upc_img, 76, 10, 76, 47, $alt_text_color);
	imageline($upc_img, 77, 10, 77, 47, $alt_text_color);
	imageline($upc_img, 78, 10, 78, 47, $alt_text_color);
	imageline($upc_img, 79, 10, 79, 47, $alt_text_color);
	imageline($upc_img, 80, 10, 80, 47, $alt_text_color);
	if($resize>1) {
	$new_upc_img = imagecreatetruecolor(83 * $resize, 62 * $resize);
	imagefilledrectangle($new_upc_img, 0, 0, 83, 62, 0xFFFFFF);
	imageinterlace($new_upc_img, true);
	if($resizetype=="resize") {
	imagecopyresized($new_upc_img, $upc_img, 0, 0, 0, 0, 83 * $resize, 62 * $resize, 83, 62); }
	if($resizetype=="resample") {
	imagecopyresampled($new_upc_img, $upc_img, 0, 0, 0, 0, 83 * $resize, 62 * $resize, 83, 62); }
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
?>