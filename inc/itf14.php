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

    $FileInfo: itf14.php - Last Update: 01/28/2012 Ver. 2.0.5 RC 1 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="itf14.php"||$File3Name=="/itf14.php") {
	require("./index.php");
	exit(); }

function create_itf14($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL,$hidecd=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)>14||strlen($upc)<14) { return false; }
	if(!isset($resize)||!preg_match("/^([0-9]*[\.]?[0-9])/", $resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if($imgtype!="png"&&$imgtype!="gif"&&$imgtype!="xbm"&&$imgtype!="wbmp") { $imgtype = "png"; }
	preg_match("/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/", $upc, $upc_matches);
	if(count($upc_matches)<=0) { return false; }
	//$ITF14Digits = str_split($upc_matches[1]);
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
	$upc_img = imagecreatetruecolor(169, 62);
	imagefilledrectangle($upc_img, 0, 0, 169, 62, 0xFFFFFF);
	imageinterlace($upc_img, true);
	$background_color = imagecolorallocate($upc_img, 255, 255, 255);
	$text_color = imagecolorallocate($upc_img, 0, 0, 0);
	$alt_text_color = imagecolorallocate($upc_img, 255, 255, 255);

	$ArrayDigit = str_split($upc_matches[1]);
	imagestring($upc_img, 2, 23, 50, $ArrayDigit[0], $text_color);
	imagestring($upc_img, 2, 32, 50, $ArrayDigit[1], $text_color);

	$ArrayDigit = str_split($upc_matches[2]);
	imagestring($upc_img, 2, 41, 50, $ArrayDigit[0], $text_color);
	imagestring($upc_img, 2, 50, 50, $ArrayDigit[1], $text_color);

	$ArrayDigit = str_split($upc_matches[3]);
	imagestring($upc_img, 2, 59, 50, $ArrayDigit[0], $text_color);
	imagestring($upc_img, 2, 68, 50, $ArrayDigit[1], $text_color);

	$ArrayDigit = str_split($upc_matches[4]);
	imagestring($upc_img, 2, 77, 50, $ArrayDigit[0], $text_color);
	imagestring($upc_img, 2, 86, 50, $ArrayDigit[1], $text_color);

	$ArrayDigit = str_split($upc_matches[5]);
	imagestring($upc_img, 2, 95, 50, $ArrayDigit[0], $text_color);
	imagestring($upc_img, 2, 104, 50, $ArrayDigit[1], $text_color);

	$ArrayDigit = str_split($upc_matches[6]);
	imagestring($upc_img, 2, 113, 50, $ArrayDigit[0], $text_color);
	imagestring($upc_img, 2, 122, 50, $ArrayDigit[1], $text_color);

	$ArrayDigit = str_split($upc_matches[7]);
	imagestring($upc_img, 2, 131, 50, $ArrayDigit[0], $text_color);
	imagestring($upc_img, 2, 140, 50, $ArrayDigit[1], $text_color);

	imagerectangle($upc_img, 0, 0, 168, 51, $text_color);
	imagerectangle($upc_img, 1, 1, 167, 50, $text_color);
	imagerectangle($upc_img, 2, 2, 166, 49, $text_color);
	imagerectangle($upc_img, 3, 3, 165, 48, $text_color);
	imageline($upc_img, 4, 4, 4, 47, $alt_text_color);
	imageline($upc_img, 5, 4, 5, 47, $alt_text_color);
	imageline($upc_img, 6, 4, 6, 47, $alt_text_color);
	imageline($upc_img, 7, 4, 7, 47, $alt_text_color);
	imageline($upc_img, 8, 4, 8, 47, $alt_text_color);
	imageline($upc_img, 9, 4, 9, 47, $alt_text_color);
	imageline($upc_img, 10, 4, 10, 47, $alt_text_color);
	imageline($upc_img, 11, 4, 11, 47, $alt_text_color);
	imageline($upc_img, 12, 4, 12, 47, $alt_text_color);
	imageline($upc_img, 13, 4, 13, 47, $alt_text_color);
	imageline($upc_img, 14, 4, 14, 47, $alt_text_color);
	imageline($upc_img, 15, 4, 15, 47, $alt_text_color);
	imageline($upc_img, 16, 4, 16, 47, $alt_text_color);
	imageline($upc_img, 17, 4, 17, 47, $text_color);
	imageline($upc_img, 18, 4, 18, 47, $alt_text_color);
	imageline($upc_img, 19, 4, 19, 47, $text_color);
	imageline($upc_img, 20, 4, 20, 47, $alt_text_color);
	$NumZero = 1; $LineStart = 21; $LineSize = 47;
	while ($NumZero < 8) {
		$ArrayDigit = str_split($upc_matches[$NumZero]);
		$left_text_color = array(0, 0, 1, 1, 0);
		if($ArrayDigit[0]==0) {
		$left_text_color = array(0, 0, 1, 1, 0); }
		if($ArrayDigit[0]==1) {
		$left_text_color = array(1, 0, 0, 0, 1); }
		if($ArrayDigit[0]==2) {
		$left_text_color = array(0, 1, 0, 0, 1); }
		if($ArrayDigit[0]==3) {
		$left_text_color = array(1, 1, 0, 0, 0); }
		if($ArrayDigit[0]==4) {
		$left_text_color = array(0, 0, 1, 0, 1); }
		if($ArrayDigit[0]==5) {
		$left_text_color = array(1, 0, 1, 0, 0); }
		if($ArrayDigit[0]==6) {
		$left_text_color = array(0, 1, 1, 0, 0); }
		if($ArrayDigit[0]==7) {
		$left_text_color = array(0, 0, 0, 1, 1); }
		if($ArrayDigit[0]==8) {
		$left_text_color = array(1, 0, 0, 1, 0); }
		if($ArrayDigit[0]==9) {
		$left_text_color = array(0, 1, 0, 1, 0); }
		$right_text_color = array(0, 0, 1, 1, 0);
		if($ArrayDigit[1]==0) {
		$right_text_color = array(0, 0, 1, 1, 0); }
		if($ArrayDigit[1]==1) {
		$right_text_color = array(1, 0, 0, 0, 1); }
		if($ArrayDigit[1]==2) {
		$right_text_color = array(0, 1, 0, 0, 1); }
		if($ArrayDigit[1]==3) {
		$right_text_color = array(1, 1, 0, 0, 0); }
		if($ArrayDigit[1]==4) {
		$right_text_color = array(0, 0, 1, 0, 1); }
		if($ArrayDigit[1]==5) {
		$right_text_color = array(1, 0, 1, 0, 0); }
		if($ArrayDigit[1]==6) {
		$right_text_color = array(0, 1, 1, 0, 0); }
		if($ArrayDigit[1]==7) {
		$right_text_color = array(0, 0, 0, 1, 1); }
		if($ArrayDigit[1]==8) {
		$right_text_color = array(1, 0, 0, 1, 0); }
		if($ArrayDigit[1]==9) {
		$right_text_color = array(0, 1, 0, 1, 0); }
		if($left_text_color[0]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($left_text_color[0]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($right_text_color[0]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; }
		if($right_text_color[0]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color);
		$LineStart += 1; }
		if($left_text_color[1]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($left_text_color[1]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($right_text_color[1]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; }
		if($right_text_color[1]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color);
		$LineStart += 1; }
		if($left_text_color[2]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($left_text_color[2]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($right_text_color[2]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1;}
		if($right_text_color[2]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color);
		$LineStart += 1; }
		if($left_text_color[3]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1;
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1;}
		if($left_text_color[3]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($right_text_color[3]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; }
		if($right_text_color[3]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color);
		$LineStart += 1; }
		if($left_text_color[4]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($left_text_color[4]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $text_color); 
		$LineStart += 1; }
		if($right_text_color[4]==1) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; 
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color); 
		$LineStart += 1; }
		if($right_text_color[4]==0) {
		imageline($upc_img, $LineStart, 4, $LineStart, $LineSize, $alt_text_color);
		$LineStart += 1; }
		++$NumZero; }
	imageline($upc_img, 147, 4, 147, 47, $text_color);
	imageline($upc_img, 148, 4, 148, 47, $text_color);
	imageline($upc_img, 149, 4, 149, 47, $text_color);
	imageline($upc_img, 150, 4, 150, 47, $alt_text_color);
	imageline($upc_img, 151, 4, 151, 47, $text_color);
	imageline($upc_img, 4, 4, 4, 47, $alt_text_color);
	imageline($upc_img, 5, 4, 5, 47, $alt_text_color);
	imageline($upc_img, 6, 4, 6, 47, $alt_text_color);
	imageline($upc_img, 7, 4, 7, 47, $alt_text_color);
	imageline($upc_img, 8, 4, 8, 47, $alt_text_color);
	imageline($upc_img, 9, 4, 9, 47, $alt_text_color);
	imageline($upc_img, 10, 4, 10, 47, $alt_text_color);
	imageline($upc_img, 11, 4, 11, 47, $alt_text_color);
	imageline($upc_img, 12, 4, 12, 47, $alt_text_color);
	imageline($upc_img, 13, 4, 13, 47, $alt_text_color);
	imageline($upc_img, 14, 4, 14, 47, $alt_text_color);
	imageline($upc_img, 15, 4, 15, 47, $alt_text_color);
	imageline($upc_img, 16, 4, 16, 47, $alt_text_color);
	if($resize>1) {
	$new_upc_img = imagecreatetruecolor(169 * $resize, 62 * $resize);
	imagefilledrectangle($new_upc_img, 0, 0, 169, 62, 0xFFFFFF);
	imageinterlace($new_upc_img, true);
	if($resizetype=="resize") {
	imagecopyresized($new_upc_img, $upc_img, 0, 0, 0, 0, 169 * $resize, 62 * $resize, 169, 62); }
	if($resizetype=="resample") {
	imagecopyresampled($new_upc_img, $upc_img, 0, 0, 0, 0, 169 * $resize, 62 * $resize, 169, 62); }
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