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

    $FileInfo: upc.php - Last Update: 01/28/2012 Ver. 2.0.5 RC 1 - Author: cooldude2k $
*/

@ob_start();
$website_url = "http://localhost/upc/";
$url_style = 0;
$url_file = "upc.php";
$appname = htmlspecialchars("UPC/EAN Barcode Generator");
$appmakerurl = "https://github.com/KazukiPrzyborowski/UPC-A-EAN-13-Maker";
$appmaker = htmlspecialchars("Game Maker 2k");
$appver = array(2,0,5,"RC 1");
@header("Content-Type: text/html; charset=UTF-8");
@header("Content-Language: en");
if(!isset($_SERVER['HTTP_USER_AGENT'])) {
	$_SERVER['HTTP_USER_AGENT'] = ""; }
if(strpos($_SERVER['HTTP_USER_AGENT'], "msie") && 
	!strpos($_SERVER['HTTP_USER_AGENT'], "opera")){
	header("X-UA-Compatible: IE=Edge"); }
if(strpos($_SERVER['HTTP_USER_AGENT'], "chromeframe")) {
	header("X-UA-Compatible: IE=Edge,chrome=1"); }
header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
header("Pragma: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
function version_info($proname,$subver,$ver,$supver,$reltype,$svnver,$showsvn) {
	$return_var = $proname." ".$reltype." ".$subver.".".$ver.".".$supver;
	if($showsvn==false) { $showsvn = null; }
	if($showsvn==true) { $return_var .= " SVN ".$svnver; }
	if($showsvn!=true&&$showsvn!=null) { $return_var .= " ".$showsvn." ".$svnver; }
	return $return_var; }
$appversion = version_info($appname,$appver[0],$appver[1],$appver[2],$appver[3]." Ver.",null,false);
require("./functions.php");
if(!isset($_GET['act'])) { $_GET['act'] = "view"; }
if($_GET['act']!="upca"&&$_GET['act']!="upce"&&
	$_GET['act']!="ean13"&&$_GET['act']!="ean8"&&
	$_GET['act']!="itf14"&&$_GET['act']!="view"&&
	$_GET['act']!="barcode") { $_GET['act'] = "view"; }
if($_GET['act']=="upca"||$_GET['act']=="upce"||$_GET['act']=="ean13"||$_GET['act']=="itf14"||$_GET['act']=="barcode") {
	if(!isset($_GET['resize'])||!is_numeric($_GET['resize'])||$_GET['resize']<1) { $_GET['resize'] = 1; }
	create_barcode($_GET['upc'],$_GET['imgtype'],true,$_GET['resize']); }
if($_GET['act']=="ean8") {
	if(!isset($_GET['resize'])||!is_numeric($_GET['resize'])||$_GET['resize']<1) { $_GET['resize'] = 1; }
	create_ean8($_GET['upc'],$_GET['imgtype'],true,$_GET['resize']); }
if($_GET['act']=="view") {
if(isset($_GET['upc'])&&!is_numeric($_GET['upc'])) {
  $_GET['upc'] = cuecat_decode($_GET['upc']); }
if(isset($_GET['upc'])&&strlen($_GET['upc'])==7) {
  $_GET['upc'] = $_GET['upc'].validate_upce($_GET['upc'],true); }
if(isset($_GET['upc'])&&strlen($_GET['upc'])==11) {
  $_GET['upc'] = $_GET['upc'].validate_upca($_GET['upc'],true); }
if(isset($_GET['upc'])&&strlen($_GET['upc'])==12&&validate_upca($_GET['upc'])===false) {
  $_GET['upc'] = $_GET['upc'].validate_ean13($_GET['upc'],true); }
  $addontitle = null;
  if(isset($_GET['upc'])&&$_GET['upc']!==null&&$_GET['upc']!=="") {
  if(validate_barcode($_GET['upc'])&&
  (strlen($_GET['upc'])==8||strlen($_GET['upc'])==12||strlen($_GET['upc'])==13)) { 
  $addontitle = " - ".htmlspecialchars($_GET['upc'], ENT_QUOTES); }
  if(validate_ean8($_GET['upc'])&&strlen($_GET['upc'])==8) { 
  $addontitle = " - ".htmlspecialchars($_GET['upc'], ENT_QUOTES); }
  if(strlen($_GET['upc'])==14) { 
  $addontitle = " - ".htmlspecialchars($_GET['upc'], ENT_QUOTES); } }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> <?php echo $appname.$addontitle; ?> </title>

  <meta http-equiv="Content-Language" content="en" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <meta http-equiv="Pragma" content="private, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0" />
  <meta http-equiv="Expires" content="<?php echo gmdate("D, d M Y H:i:s")." GMT"; ?>" />
  <meta name="generator" content="<?php echo $appname; ?>" />
  <meta name="author" content="<?php echo $appmaker; ?>" />
  <meta name="keywords" content="<?php echo $appname; ?>" />
  <meta name="description" content="<?php echo $appname; ?>" />
  <base href="<?php echo $website_url; ?>" />
  <link rel="icon" href="<?php echo $website_url; ?>favicon.ico" />
  <link rel="shortcut icon" href="<?php echo $website_url; ?>favicon.ico" />
<script type="text/javascript">
<!--
// Copyright (c) 2000  Dustin Sallings <dustin@spy.net>
// $Id: kittycode.js,v 1.2 2000/09/20 03:42:24 dustin Exp $
// Any work derived from this code must retain the above copyright.
// Please send all modifications of this script to me.

function kittyCode() {
	// Make sure there's something in there before we do this.
	if(document.upcform.upc.value.length > 0) {
		var parts=document.upcform.upc.value.split('.');
		// Valid data will have five parts (the first and last are empty)
		// Parts are as follows:
		// 0 = empty
		// 1 = id
		// 2 = type
		// 3 = code
		// 4 = empty
		if(parts.length == 5) {
			// We just care about the actual scanned code right now
			document.upcform.upc.value=decodePart(parts[3]);
		}
	}
}

function decodePart(str) {
	var m = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-";
	var result = "";
	var packer = 0;
	var count = 0;
	
	var i = 0;
	for (i=0; i < str.length; i++) {
		// Get the offset to the current character in our map
		var x = m.indexOf(str.charAt(i));

		// For invalid characters, point them out really well!
		if(x<0) {
			result += " > " + str.charAt(i) + " < ";
			continue;
		}

		// only count valid characters...why not?
		count++;

		// Pack them bits.
		packer = packer << 6 | x

		// every four bytes, we have three valid characters.
		if (count == 4) {
			result += String.fromCharCode((packer >> 16) ^ 67);
			result += String.fromCharCode((packer >> 8 & 255) ^ 67);
			result += String.fromCharCode((packer & 255) ^ 67);
			count=0; packer=0;
		}

	}

	// Now, deal with the remainders
	if(count==2) {
		result += String.fromCharCode((( (packer << 12) >> 16) ^ 67));
	} else if(count == 3) {
		result += String.fromCharCode(( (packer << 6) >> 16) ^ 67);
		result += String.fromCharCode(( (packer << 6) >> 8 & 255) ^ 67);
	}
	return result;
}
function validate_str_size(str) {
if(str==null||str=='') {
	alert("You need to enter a UPC/EAN!");
	return false; }
if(str.length==0) {
	alert("You need to enter a UPC/EAN!");
	return false; }
kittyCode();
<?php if($url_style==1) { ?>
location.href='<?php echo $website_url; ?>view/'+document.upcform.upc.value+'.htm';
<?php } if($url_style==0) { ?>
location.href='<?php echo $website_url.$url_file; ?>?act=view&amp;upc='+document.upcform.upc.value;
<?php } ?>
return true; }
//-->
</script>
 </head>

 <body>
  <form method="get" id="upcform" name="upcform" action="<?php echo $website_url.$url_file; ?>?act=view" onsubmit="validate_str_size(document.upcform.upc.value); return false;">
  <label for="upc">Enter UPC:</label><br />
  <?php if(isset($_GET['upc'])) { ?>
  <input type="text" id="upc" name="upc" value="<?php echo htmlspecialchars($_GET['upc'], ENT_QUOTES); ?>" /><br />
  <?php } if(!isset($_GET['upc'])) { ?>
  <input type="text" id="upc" name="upc" /><br />
  <?php } ?>
  <input type="submit" value="Get UPC" onclick="validate_str_size(document.upcform.upc.value); return false;" /> <button type="submit" onclick="validate_str_size(document.upcform.upc.value); return false;">CueCat Decode</button>
  <?php if(isset($_GET['upc'])) { ?>
  <br /><br />
  <?php } ?>
  </form>
  <?php 
  if(!isset($_GET['resize'])||!is_numeric($_GET['resize'])||$_GET['resize']<1) { $_GET['resize'] = 1; }
  $addresizeimg = null;
  if($url_style==1&&$_GET['resize']>1) { $addresizeimg = ".".urlencode($_GET['resize']); }
  if($url_style==0&&$_GET['resize']>1) { $addresizeimg = "&amp;resize=".urlencode($_GET['resize']); }
  $upca_code = null; $upce_code = null; $ean8_code = null; $ean13_code = null; $itf14_code = null;
  if(isset($_GET['upc'])&&strlen($_GET['upc'])==14) {
  $itf14_code = $_GET['upc'];
  if(preg_match("/^0(\d{13})/", $itf14_code, $upc_matches)) {
  $ean13_code = convert_itf14_to_ean13($_GET['upc']);
  $upca_code = convert_itf14_to_upca($_GET['upc']);
  $upce_code = convert_itf14_to_upce($_GET['upc']); } }
  if(isset($_GET['upc'])&&strlen($_GET['upc'])==8) {
  $upce_code = $_GET['upc']; 
  $upca_code = convert_upce_to_upca($_GET['upc']);
  $ean13_code = convert_upce_to_ean13($_GET['upc']); 
  $itf14_code =  convert_ean13_to_itf14($ean13_code); }
  if(isset($_GET['upc'])&&strlen($_GET['upc'])==12) {
  $upca_code = $_GET['upc'];
  $upce_code = convert_upca_to_upce($_GET['upc']);
  $ean13_code = convert_upca_to_ean13($_GET['upc']); 
  $itf14_code =  convert_ean13_to_itf14($ean13_code); }
  if(isset($_GET['upc'])&&strlen($_GET['upc'])==13) {
  $ean13_code = $_GET['upc']; 
  if(preg_match("/^0(\d{12})/", $ean13_code, $upc_matches)&&$upca_code==null) {
  $upca_code = convert_ean13_to_upca($_GET['upc']);
  $upce_code = convert_ean13_to_upce($_GET['upc']); } 
  $itf14_code =  convert_ean13_to_itf14($ean13_code); }
  if(isset($upce_code)&&strlen($upce_code)==8) {
  $ean8_code = $upce_code; }
  if(isset($_GET['upc'])&&strlen($_GET['upc'])==14) {
  $itf14_code = $_GET['upc']; }
  if(isset($_GET['upc'])) { ?>
  <table style="vertical-align: middle; width: 50%;">
  <?php if($upce_code!=null&&validate_upce($upce_code)===true) { ?>
  <tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">UPC-E: <?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=view&amp;upc=<?php echo urlencode($upce_code); ?>"><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>view/<?php echo urlencode($upce_code); ?>.htm"><?php } ?><?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td style="text-align: center; vertical-align: middle; width: 25%;"><?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=upce&amp;upc=<?php echo urlencode($upce_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=upce&amp;upc=<?php echo urlencode($upce_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url.$url_file; ?>?act=upce&amp;upc=<?php echo urlencode($upce_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=upce&amp;upc=<?php echo urlencode($upce_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>viewupce/<?php echo urlencode($upce_code); ?><?php echo $addresizeimg; ?>.png"><img style="border: 0px;" src="<?php echo $website_url; ?>viewupce/<?php echo urlencode($upce_code); ?><?php echo $addresizeimg; ?>.png" alt="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url; ?>viewupce/<?php echo urlencode($upce_code); ?><?php echo $addresizeimg; ?>.gif"><img style="border: 0px;" src="<?php echo $website_url; ?>viewupce/<?php echo urlencode($upce_code); ?><?php echo $addresizeimg; ?>.gif" alt="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($upce_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php } ?>
  <?php echo "\n"; } if($upca_code!=null&&validate_upca($upca_code)===true) { ?>
  <tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">UPC-A: <?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=view&amp;upc=<?php echo urlencode($upca_code); ?>"><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>view/<?php echo urlencode($upca_code); ?>.htm"><?php } ?><?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td style="text-align: center; vertical-align: middle; width: 25%;"><?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=upca&amp;upc=<?php echo urlencode($upca_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=upca&amp;upc=<?php echo urlencode($upca_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url.$url_file; ?>?act=upca&amp;upc=<?php echo urlencode($upca_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=upca&amp;upc=<?php echo urlencode($upca_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>viewupca/<?php echo urlencode($upca_code); ?><?php echo $addresizeimg; ?>.png"><img style="border: 0px;" src="<?php echo $website_url; ?>viewupca/<?php echo urlencode($upca_code); ?><?php echo $addresizeimg; ?>.png" alt="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url; ?>viewupca/<?php echo urlencode($upca_code); ?><?php echo $addresizeimg; ?>.gif"><img style="border: 0px;" src="<?php echo $website_url; ?>viewupca/<?php echo urlencode($upca_code); ?><?php echo $addresizeimg; ?>.gif" alt="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($upca_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php } ?>
  <?php echo "\n"; } if($ean13_code!=null&&validate_ean13($ean13_code)===true) { ?>
  <tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">EAN-13: <?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=view&amp;upc=<?php echo urlencode($ean13_code); ?>"><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>view/<?php echo urlencode($ean13_code); ?>.htm"><?php } ?><?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td style="text-align: center; vertical-align: middle; width: 25%;"><?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=ean13&amp;upc=<?php echo urlencode($ean13_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=ean13&amp;upc=<?php echo urlencode($ean13_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url.$url_file; ?>?act=ean13&amp;upc=<?php echo urlencode($ean13_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=ean13&amp;upc=<?php echo urlencode($ean13_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>viewean13/<?php echo urlencode($ean13_code); ?><?php echo $addresizeimg; ?>.png"><img style="border: 0px;" src="<?php echo $website_url; ?>viewean13/<?php echo urlencode($ean13_code); ?><?php echo $addresizeimg; ?>.png" alt="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url; ?>viewean13/<?php echo urlencode($ean13_code); ?><?php echo $addresizeimg; ?>.gif"><img style="border: 0px;" src="<?php echo $website_url; ?>viewean13/<?php echo urlencode($ean13_code); ?><?php echo $addresizeimg; ?>.gif" alt="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($ean13_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php } ?>
  <?php echo "\n"; } if($ean8_code!=null&&validate_ean8($ean8_code)===true) { ?>
  <tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">EAN-8: <?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=view&amp;upc=<?php echo urlencode($ean8_code); ?>"><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>view/<?php echo urlencode($ean8_code); ?>.htm"><?php } ?><?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td style="text-align: center; vertical-align: middle; width: 25%;"><?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=ean8&amp;upc=<?php echo urlencode($ean8_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=ean8&amp;upc=<?php echo urlencode($ean8_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url.$url_file; ?>?act=ean8&amp;upc=<?php echo urlencode($ean8_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=ean8&amp;upc=<?php echo urlencode($ean8_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>viewean8/<?php echo urlencode($ean8_code); ?><?php echo $addresizeimg; ?>.png"><img style="border: 0px;" src="<?php echo $website_url; ?>viewean8/<?php echo urlencode($ean8_code); ?><?php echo $addresizeimg; ?>.png" alt="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url; ?>viewean8/<?php echo urlencode($ean8_code); ?><?php echo $addresizeimg; ?>.gif"><img style="border: 0px;" src="<?php echo $website_url; ?>viewean8/<?php echo urlencode($ean8_code); ?><?php echo $addresizeimg; ?>.gif" alt="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($ean8_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php } ?>
  <?php echo "\n"; } if($itf14_code!=null) { ?>
  <tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">ITF-14: <?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=view&amp;upc=<?php echo urlencode($itf14_code); ?>"><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>view/<?php echo urlencode($itf14_code); ?>.htm"><?php } ?><?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td style="text-align: center; vertical-align: middle; width: 25%;"><?php if($url_style==0) { ?><a href="<?php echo $website_url.$url_file; ?>?act=itf14&amp;upc=<?php echo urlencode($itf14_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=itf14&amp;upc=<?php echo urlencode($itf14_code); ?>&amp;imgtype=png<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url.$url_file; ?>?act=itf14&amp;upc=<?php echo urlencode($itf14_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>"><img style="border: 0px;" src="<?php echo $website_url.$url_file; ?>?act=itf14&amp;upc=<?php echo urlencode($itf14_code); ?>&amp;imgtype=gif<?php echo $addresizeimg; ?>" alt="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php } if($url_style==1) { ?><a href="<?php echo $website_url; ?>viewitf14/<?php echo urlencode($itf14_code); ?><?php echo $addresizeimg; ?>.png"><img style="border: 0px;" src="<?php echo $website_url; ?>viewitf14/<?php echo urlencode($itf14_code); ?><?php echo $addresizeimg; ?>.png" alt="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> PNG" title="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> PNG" /></a></td><td style="text-align: center; vertical-align: middle; width: 25%;"><a href="<?php echo $website_url; ?>viewitf14/<?php echo urlencode($itf14_code); ?><?php echo $addresizeimg; ?>.gif"><img style="border: 0px;" src="<?php echo $website_url; ?>viewitf14/<?php echo urlencode($itf14_code); ?><?php echo $addresizeimg; ?>.gif" alt="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> GIF" title="<?php echo htmlspecialchars($itf14_code, ENT_QUOTES); ?> GIF" /></a></td></tr><?php echo "\n  "; ?><tr style="text-align: center; vertical-align: middle; width: 50%;"><td colspan="2" style="text-align: left; vertical-align: middle; width: 50%;">&nbsp;</td></tr><?php } ?>
  <?php echo "\n"; } ?>
  </table>
  <?php } ?>
  <div>&nbsp;<br />&nbsp;</div>
  <address><?php echo "<a href=\"".$appmakerurl."\" title=\"".$appname." by ".$appmaker."\">".$appname."</a> Ver. ".$appver[0].".".$appver[1].".".$appver[2]." ".$appver[3]; ?></address>
 </body>
</html>
<?php } ?>