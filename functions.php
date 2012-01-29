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

    $FileInfo: functions.php - Last Update: 01/28/2012 Ver. 2.0.5 RC 1 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="functions.php"||$File3Name=="/functions.php") {
	require("./index.php");
	exit(); }

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
http://zxing.org/w/decode.jspx
http://code.google.com/p/zxing/
*/

require("./inc/validate.php");
require("./inc/convert.php");
require("./inc/upca.php");
require("./inc/upce.php");
require("./inc/ean13.php");
require("./inc/ean8.php");
require("./inc/itf14.php");
require("./inc/cuecat.php");
function validate_barcode($upc,$return_check=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(strlen($upc)==8) { return validate_upce($upc,$return_check); }
	if(strlen($upc)==12) { return validate_upca($upc,$return_check); }
	if(strlen($upc)==13) { return validate_ean13($upc,$return_check); } 
	return false; }
function create_barcode($upc,$imgtype="png",$outputimage=true,$resize=1,$resizetype="resize",$outfile=NULL,$hidecd=false) {
	if(!isset($upc)||!is_numeric($upc)) { return false; }
	if(!isset($resize)||!preg_match("/^([0-9]*[\.]?[0-9])/", $resize)||$resize<1) { $resize = 1; }
	if($resizetype!="resample"&&$resizetype!="resize") { $resizetype = "resize"; }
	if(strlen($upc)==7||strlen($upc)==8) { 
		return create_upce($upc,$imgtype,$outputimage,$resize,$resizetype,$outfile,$hidecd); }
	if(strlen($upc)==11||strlen($upc)==12) { 
		return create_upca($upc,$imgtype,$outputimage,$resize,$resizetype,$outfile,$hidecd); }
	if(strlen($upc)==13) { return create_ean13($upc,$imgtype,$outputimage,$resize,$resizetype,$outfile,$hidecd); } 
	if(strlen($upc)==14) { return create_itf14($upc,$imgtype,$outputimage,$resize,$resizetype,$outfile,$hidecd); } 
	return false; }
?>