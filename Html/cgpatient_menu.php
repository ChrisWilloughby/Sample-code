<?php
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once($_SESSION['CGPATH']."interface/globals.php");
require_once($_SESSION['CGPATH'].'/cg/lib/v1/class.patients.php');
?>
<script>
function sendForm(destination,form) {
	$('#'+destination).load(form);
}
</script>
<style>
/*
ul#cgpatientfolderbuttons {
margin: 0;
}
ul#cgpatientfolderbuttons li {
	list-style: none;
}
ul#cgpatientfolderbuttons li a.cgpatientdemographicsbtn {
display: block;
height: 132px;
width: 30px;
background-image: url(ui/images/folder_tabs.png);
background-repeat: no-repeat;
}
ul#cgpatientfolderbuttons li a.cgpatientvisitsbtn {
display: block;
height: 132px;
width: 30px;
background-image: url(ui/images/folder_tabs.png);
background-repeat: no-repeat;
background-position-y: -135px;
}
ul#cgpatientfolderbuttons li a.cgpatientfeesheetsbtn {
display: block;
height: 132px;
width: 30px;
background-image: url(ui/images/folder_tabs.png);
background-repeat: no-repeat;
}
ul#cgpatientfolderbuttons li a.cgpatientcheckoutbtn {
display: block;
height: 132px;
width: 30px;
background-image: url(ui/images/folder_tabs.png);
background-repeat: no-repeat;
}
*/
</style>
<?php

$GLOBALS['concurrent_layout']=1;

if ($GLOBALS['concurrent_layout'] && isset($_GET['set_pid'])) {
  include_once("$srcdir/pid.inc");
  setpid($_GET['set_pid']);
}

  $StringEcho= '<ul id="cgpatientfolderbuttons">';
	//
	// Patient Demographics
	//
/*
	if(isset($hide) && $hide == 1){
		$StringEcho.= "<li><a id='enc2' class='cgpatientfolderbutton ' >" . htmlspecialchars( xl('Patient Demographics'),ENT_NOQUOTES) . "</a></li>";
	}else{
		$StringEcho.= "<li><a id='enc2' onclick=\"sendForm('".$destination."','".$_SESSION['CGBASE']."cg/dispatch.php?action=patvdemographicsorig&pid=$pid&destination=$destination');\" >". htmlspecialchars( xl('Patient Demographics'),ENT_NOQUOTES) . "</a></li>";
	}
*/
	//
	// Patient Demographics New
	//
	if(isset($hide) && $hide == 1){
		$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Patient Demographics'),ENT_NOQUOTES) . " class='cgpatientfolderbutton cgpatientdemographicsbtn'>" . htmlspecialchars( xl('Patient Demographics'),ENT_NOQUOTES) . "</a></li>";
	}else{
		$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Patient Demographics'),ENT_NOQUOTES) . " class='cgpatientfolderbutton cgpatientdemographicsbtn' onclick=\"sendForm('".$destination."','".$_SESSION['CGBASE']."cg/dispatch.php?action=patvmenu&pid=$pid&destination=$destination');\" ></a></li>";
	}
	//
	// Ecounters
	//

	if(isset($hide) && $hide == 1){
		$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Visits'),ENT_NOQUOTES) ." class='cgpatientfolderbutton cgpatientvisitsbtn'></a></li>";
	}else{
		$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Visits'),ENT_NOQUOTES) ." class='cgpatientfolderbutton cgpatientvisitsbtn' onclick=\"sendForm('".$destination."','".$_SESSION['CGBASE']."cg/dispatch.php?action=patvdemographicsencounters&pid=$pid&formname=fee_sheet&destination=$destination');\" ></a></li>";
	}

	//
	// Fee Sheet
	//
	if ($_SESSION['encounter'] != "") {
		if(isset($hide) && $hide == 1){
			$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Fee Sheet'),ENT_NOQUOTES) ." class='cgpatientfolderbutton cgpatientfeesheetsbtn'></a></li>";
		}else{
			$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Fee Sheet'),ENT_NOQUOTES) ." class='cgpatientfolderbutton cgpatientfeesheetsbtn' onclick=\"sendForm('".$destination."','".$_SESSION['CGBASE']."cg/dispatch.php?action=sendform&pid=$pid&formname=fee_sheet&destination=".$destination."');\" ></a></li>";
		}

	}
	//
	// POS Checkout
	//
	if ($_SESSION['encounter'] != "") {
		if(isset($hide) && $hide == 1){
			$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Checkout'),ENT_NOQUOTES) ." class='cgpatientfolderbutton cgpatientcheckoutbtn'></a></li>";
		}else{
			$StringEcho.= "<li><a id='enc2' title=". htmlspecialchars( xl('Checkout'),ENT_NOQUOTES) ." class='cgpatientfolderbutton cgpatientcheckoutbtn' onclick=\"sendForm('".$destination."','".$_SESSION['CGBASE']."cg/dispatch.php?action=patientposcheckout&pid=$pid&destination=".$destination."');\" ></a></li>";
		}

	}

  $StringEcho.="</ul>";
echo $StringEcho;
?>
