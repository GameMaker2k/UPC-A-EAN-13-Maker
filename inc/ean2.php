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

    $FileInfo: ean2.php - Last Update: 02/05/2012 Ver. 2.1.7 RC 1 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="ean2.php"||$File3Name=="/ean2.php") {
	chdir("../");
	require("./upc.php");
	exit(); }

function create_ean2($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL,$hidecd=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>2||strlen($upc)<2) { return false; }
	if(!isset($resize)||!preg_match("/^([0-9]*[\.]?[0-9])/", $resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if($imgtype!="png"&&$imgtype!="gif"&&$imgtype!="xbm"&&$imgtype!="wbmp") { $imgtype = "png"; }
	preg_match("/(\d{2})/", $upc, $upc_matches);
	if(count($upc_matches)<=0) { return false; }
	$CheckSum = $upc_matches[1] % 4;
	$LeftDigit = str_split($upc_matches[1]);
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
	$upc_img = imagecreatetruecolor(21, 62);
	imagefilledrectangle($upc_img, 0, 0, 21, 62, 0xFFFFFF);
	imageinterlace($upc_img, true);
	$background_color = imagecolorallocate($upc_img, 255, 255, 255);
	$text_color = imagecolorallocate($upc_img, 0, 0, 0);
	$alt_text_color = imagecolorallocate($upc_img, 255, 255, 255);
	imagestring($upc_img, 2, 5, 47, $LeftDigit[0], $text_color);
	imagestring($upc_img, 2, 13, 47, $LeftDigit[1], $text_color);
	imageline($upc_img, 0, 10, 0, 47, $alt_text_color);
	imageline($upc_img, 1, 10, 1, 47, $text_color);
	imageline($upc_img, 2, 10, 2, 47, $alt_text_color);
	imageline($upc_img, 3, 10, 3, 47, $text_color);
	imageline($upc_img, 4, 10, 4, 47, $text_color);
	$NumZero = 0; $LineStart = 5;
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
		if($CheckSum==0&&$NumZero==0) { $left_text_color = $left_text_color_l; }
		if($CheckSum==0&&$NumZero==1) { $left_text_color = $left_text_color_l; }
		if($CheckSum==1&&$NumZero==0) { $left_text_color = $left_text_color_l; }
		if($CheckSum==1&&$NumZero==1) { $left_text_color = $left_text_color_g; }
		if($CheckSum==2&&$NumZero==0) { $left_text_color = $left_text_color_g; }
		if($CheckSum==2&&$NumZero==1) { $left_text_color = $left_text_color_l; }
		if($CheckSum==3&&$NumZero==0) { $left_text_color = $left_text_color_g; }
		if($CheckSum==3&&$NumZero==1) { $left_text_color = $left_text_color_g; }
		$InnerUPCNum = 0;
		while ($InnerUPCNum < count($left_text_color)) {
		if($left_text_color[$InnerUPCNum]==1) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color); }
		if($left_text_color[$InnerUPCNum]==0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color); }
		$LineStart += 1;
		++$InnerUPCNum; }
		if($NumZero == 0) {
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $alt_text_color);
		$LineStart += 1;
		imageline($upc_img, $LineStart, 10, $LineStart, $LineSize, $text_color);
		$LineStart += 1; }
		++$NumZero; }
	if($resize>1) {
	$new_upc_img = imagecreatetruecolor(21 * $resize, 62 * $resize);
	imagefilledrectangle($new_upc_img, 0, 0, 21, 62, 0xFFFFFF);
	imageinterlace($new_upc_img, true);
	if($resizetype=="resize") {
	imagecopyresized($new_upc_img, $upc_img, 0, 0, 0, 0, 21 * $resize, 62 * $resize, 21, 62); }
	if($resizetype=="resample") {
	imagecopyresampled($new_upc_img, $upc_img, 0, 0, 0, 0, 21 * $resize, 62 * $resize, 21, 62); }
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