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

    $FileInfo: convert.php - Last Update: 01/28/2012 Ver. 2.0.5 RC 1 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="convert.php"||$File3Name=="/convert.php") {
	chdir("../");
	require("./upc.php");
	exit(); }

function convert_upce_to_upca($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==7) { $upc = $upc.validate_upce($upc,true); }
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
	if(strlen($upc)==11) { $upc = $upc.validate_upca($upc,true); }
	if(strlen($upc)>13||strlen($upc)<12) { return false; }
	if(strlen($upc)==12) { $ean13 = "0".$upc; }
	if(strlen($upc)==13) { $ean13 = $upc; }
	return $ean13; }
function convert_ean13_to_itf14($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==11) { $upc = $upc.validate_upca($upc,true); }
	if(strlen($upc)==12) { $upc = "0".$upc; }
	if(strlen($upc)>14||strlen($upc)<13) { return false; }
	if(strlen($upc)==13) { $itf14 = "0".$upc; }
	if(strlen($upc)==14) { $itf14 = $upc; }
	return $itf14; }
function convert_upce_to_ean13($upc) {
	return convert_upca_to_ean13(convert_upce_to_upca($upc)); }
function convert_ean13_to_upca($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==12) { $upc = "0".$upc; }
	if(strlen($upc)>13||strlen($upc)<13) { return false; }
	if(preg_match("/^0(\d{12})/", $upc, $upc_matches)) {
	$upca = $upc_matches[1]; }
	if(!preg_match("/^0(\d{12})/", $upc, $upc_matches)) {
	return false; }
	return $upca; }
function convert_itf14_to_ean13($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==13) { $upc = "0".$upc; }
	if(strlen($upc)>14||strlen($upc)<14) { return false; }
	if(preg_match("/^0(\d{13})/", $upc, $upc_matches)) {
	$ean13 = $upc_matches[1]; }
	if(!preg_match("/^0(\d{13})/", $upc, $upc_matches)) {
	return false; }
	return $ean13; }
function convert_upca_to_upce($upc) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==11) { $upc = $upc.validate_upca($upc,true); }
	if(strlen($upc)>12||strlen($upc)<12) { return false; }
	if(!preg_match("/0(\d{11})/", $upc)) { return false; }
	$upce = null;
	if(preg_match("/0(\d{2})00000(\d{3})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."0";
	$upce = $upce.$upc_matches[3]; return $upce; }
	if(preg_match("/0(\d{2})10000(\d{3})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."1";
	$upce = $upce.$upc_matches[3]; return $upce; }
	if(preg_match("/0(\d{2})20000(\d{3})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."2";
	$upce = $upce.$upc_matches[3]; return $upce; }
	if(preg_match("/0(\d{3})00000(\d{2})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."3";
	$upce = $upce.$upc_matches[3]; return $upce; }
	if(preg_match("/0(\d{4})00000(\d{1})(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1].$upc_matches[2]."4";
	$upce = $upce.$upc_matches[3]; return $upce; }
	if(preg_match("/0(\d{5})00005(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."5";
	$upce = $upce.$upc_matches[2]; return $upce; }
	if(preg_match("/0(\d{5})00006(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."6";
	$upce = $upce.$upc_matches[2]; return $upce; }
	if(preg_match("/0(\d{5})00007(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."7";
	$upce = $upce.$upc_matches[2]; return $upce; }
	if(preg_match("/0(\d{5})00008(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."8";
	$upce = $upce.$upc_matches[2]; return $upce; }
	if(preg_match("/0(\d{5})00009(\d{1})/", $upc, $upc_matches)) {
	$upce = "0".$upc_matches[1]."9";
	$upce = $upce.$upc_matches[2]; return $upce; }
	if($upce==null) { return false; }
	return $upce; }
function convert_ean13_to_upce($upc) {
	return convert_upca_to_upce(convert_ean13_to_upca($upc)); }
function convert_itf14_to_upca($upc) {
	return convert_ean13_to_upca(convert_itf14_to_ean13($upc)); }
function convert_itf14_to_upce($upc) {
	return convert_upca_to_upce(convert_itf14_to_upca($upc)); }
?>