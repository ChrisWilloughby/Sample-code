<?php
require_once("$srcdir/pnotes.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/acl.inc");
require_once("$srcdir/log.inc");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/classes/Document.class.php");
require_once("$srcdir/gprelations.inc.php");
require_once("$srcdir/formatting.inc.php");
?>
<script type="text/javascript" src="../../../library/js/common.js"></script>

<!--JIM commented this out was breaking the History form likely due to the fact that we have already loaded a newer 
    version of JQuery-->
<!--<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/jquery.js"></script>-->

<style>
/*
#patientaddvisitforms {
width: 160px;
border: 1px solid #DDD;
color: #666;
padding: 15px;

background: #F9FCF7;
background: -moz-linear-gradient(top, #F9FCF7 0%, #F5F9F0 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#F9FCF7), color-stop(100%,#F5F9F0));
background: -webkit-linear-gradient(top, #F9FCF7 0%,#F5F9F0 100%);
background: -o-linear-gradient(top, #F9FCF7 0%,#F5F9F0 100%);
background: -ms-linear-gradient(top, #F9FCF7 0%,#F5F9F0 100%);
background: linear-gradient(top, #F9FCF7 0%,#F5F9F0 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9fcf7', endColorstr='#f5f9f0',GradientType=0 );
-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;
}
#patientvisitforms { width: 195px;float: left;}
.panelitemtitle { 
	float:left;
	padding: 5px;
	font-weight: bold;
	color: #333;
	width:98%;
	
	-webkit-border-top-left-radius: 9px;
	-webkit-border-top-right-radius: 9px;
	-moz-border-radius-topleft: 9px;
	-moz-border-radius-topright: 9px;
	border-top-left-radius: 9px;
	border-top-right-radius: 9px;
	
	background: rgb(229,230,150);
	background: rgb(224,243,250);
	background: -moz-linear-gradient(top,  rgba(224,243,250,1) 0%, rgba(216,240,252,1) 50%, rgba(184,226,246,1) 51%, rgba(182,223,253,1) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(224,243,250,1)), color-stop(50%,rgba(216,240,252,1)), color-stop(51%,rgba(184,226,246,1)), color-stop(100%,rgba(182,223,253,1))); 
	background: -webkit-linear-gradient(top,  rgba(224,243,250,1) 0%,rgba(216,240,252,1) 50%,rgba(184,226,246,1) 51%,rgba(182,223,253,1) 100%); 
	background: -o-linear-gradient(top,  rgba(224,243,250,1) 0%,rgba(216,240,252,1) 50%,rgba(184,226,246,1) 51%,rgba(182,223,253,1) 100%); 
	background: -ms-linear-gradient(top,  rgba(224,243,250,1) 0%,rgba(216,240,252,1) 50%,rgba(184,226,246,1) 51%,rgba(182,223,253,1) 100%);
	background: linear-gradient(top,  rgba(224,243,250,1) 0%,rgba(216,240,252,1) 50%,rgba(184,226,246,1) 51%,rgba(182,223,253,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e0f3fa', endColorstr='#b6dffd',GradientType=0 );
	
}
.panelitem { 
	float:left;
	min-height:200px;
	width:100%;
	max-width:500px;
	background:#fff;
	color:#000;
	border:1px solid #BBB;
	margin:1px;
	
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}

#clinical_reminders {
	width: 95%;
	height: 600px;
	background-color:  #FFF;
	padding: 20px;
	margin: 0px;

	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
#medical_problems {
	width: 95%;
	height: 600px;
	display: none;
	background-color:  #FFF;
	padding: 20px;

	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
#patient_notes {
	width: 95%;
	height: 600px;
	display: none;
	background-color:  #FFF;
	padding: 20px;
	
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}


		
		li.clinical_reminders {
		}
		li.medical_problems {
		}
		li.patient_notes {
		}
#cgpatientremindersproblemsnotescontainer {
	background: #FFF;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	margin: 0px 5px;
	width: 98%;
}
*/

</style>
<script>
$(document).ready(function(){
    tabbify();
    
    $("#clinical_reminders").load("<?php echo $_SESSION["CGBASE"];?>cg/dispatch.php?action=patvdashboardclinicalremindersview&patient_id=<?php echo $pid ?>&destination=clinical_reminders");
});
</script>
<script>
function EditNotes(mode) {
	$("#patient_notes").load("<?php echo $_SESSION["CGBASE"];?>interface/patient_file/summary/pnotes_full.php?mode="+mode+"&destination=patient_notes");
}
function show_div(name){
	var pid = <?php echo $pid ?>;
  if(name == 'clinical_reminders'){
  	$("li a").removeClass("active");
  	$('li.clinical_reminders a').addClass('active');
    document.getElementById('clinical_reminders').style.display = 'block';
    document.getElementById('medical_problems').style.display = 'none';
    $("#clinical_reminders").load("<?php echo $_SESSION["CGBASE"];?>cg/dispatch.php?action=patvdashboardclinicalremindersview&patient_id="+pid+"&destination=clinical_reminders");
  }
  if(name == 'medical_problems'){
  	$("li a").removeClass("active");
  	$('li.medical_problems a').addClass('active');
    document.getElementById('clinical_reminders').style.display = 'none';
    document.getElementById('medical_problems').style.display = 'block';
    $("#medical_problems").load("<?php echo $_SESSION["CGBASE"];?>cg/dispatch.php?action=patvdashboardclinicalissuesview&destination=medical_problems");
  }
}

function manageclinicalreminders(pid) {
	//alert(pid);
	$("#clinical_reminders").load("<?php echo $_SESSION["CGBASE"];?>cg/dispatch.php?action=patvdashboardclinicalremindersmanage&patient_id="+pid+"&destination=clinical_reminders");
}
</script>
<?php
	require_once($_SESSION["CGPATH"]."/cg/lib/v1/class.issues.php");
	$issues=new Issues();
	$issuecounts="(".$issues->getCountOfActiveIssues($pid)."/".$issues->getCountOfInactiveIssues($pid).")";
?>
<div style="margin-top: 5px;">
	<ul class="tabNavigation">
	  <li class="clinical_reminders" ><a class="active" onclick="show_div('clinical_reminders')" href="#"><?php echo htmlspecialchars(xl('Clinical Reminders'),ENT_NOQUOTES); ?></a></li>
	  <li class="medical_problems" ><a class="" onclick="show_div('medical_problems')" href="#"><?php echo htmlspecialchars(xl('Problems'),ENT_NOQUOTES)."&nbsp;$issuecounts"; ?></a></li>
	</ul>
	<div id="cgpatientremindersproblemsnotescontainer">
		<div id="clinical_reminders" class="tabContainer">
			<div class=""></div>
		</div>
		<div id="medical_problems" class="tabContainer">
			
		</div>
	</div>
</div>


<!--
</div>

		<div style='float:left;width:600px;margin-left:10px;'>
			<div id='clinicalreminders' class='panelitem'>
				<div id='clinicalreminderstitle' class='panelitemtitle'>Clinical Reminders</div>
				<div id='clinicalreminderdata' class='panelitemdata'></div>
			</div>
			<div id='stats' class='panelitem'>
				<div id='statstitle' class='panelitemtitle'>Stats</div>
				<div id='statdata' class='panelitemdata'></div>
			</div>
			<div id="issues" class="panelitem">
-->
				<?php //include('../../../cg/view/v1/cgpatientissuesview.php'); ?>
				<?php //include('../../../cg/view/v1/cgpatientclinicalreminders.php'); ?>
<!--
			</div>
			<div id='notes' class='panelitem'>
				<div id='notestitle' class='panelitemtitle'><span>Notes</span>
					<div id='notesedit' style='float:right;' onclick="EditNotes('new');">Add</div>
				</div>
				<div id='notesdata' class='inline medium_modal panelitemdata'></div>
			</div>
		</div>
</div>
-->

