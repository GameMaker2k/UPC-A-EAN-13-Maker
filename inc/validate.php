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

    $FileInfo: validate.php - Last Update: 01/28/2012 Ver. 2.0.5 RC 1 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="validate.php"||$File3Name=="/validate.php") {
	require("./index.php");
	exit(); }

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
?>