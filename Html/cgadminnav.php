<?php 

require_once($_SESSION['CGPATH'] . "/interface/globals.php");
require_once($_SESSION['CGPATH'] . "/library/acl.inc");
?> 

<style>
#admin_options{
    font-size: 124%;
}
#admin_options li {
    width: 100%;
}
</style>

<div id="cgleft_panel" class="cgadmin_left" style="width:135px;">

   <h3>Admin tools</h3>

        <div id="admin_options">
        
            <ul>
                       
            <?php if (acl_check('admin', 'users')) : ?>                              
	            <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION['CGBASE']; ?>cg/dispatch.php?action=facvfacilitiesview');return false;">
	                	<div class="facBtn"></div>
	                    <div class="sideTxt">Facilities</div>
	            </li>
            <?php endif ?>
            
            <?php if (acl_check('admin', 'users')) : ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION['CGBASE']; ?>cg/dispatch.php?action=admvnavlistview');return false;">
                      <div class="useBtn"></div>
                      <div class="sideTxt">Users</div>
                </li>    
            <?php endif ?>
                
            <?php if (acl_check('admin', 'forms') ) : ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION["CGBASE"]; ?>/cg/dispatch.php?action=admeforms&destination=cgmiddle_panel');return false;">
                        <div class="formBtn"></div>
                        <div class="sideTxt">Forms</div>
                </li>
            <?php endif ?>
            
            <?php if (acl_check('admin', 'practice') ) : ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION["CGBASE"]; ?>/cg/dispatch.php?action=lstvlistoptions&destination=cgmiddle_panel');return false;">
                        <div class="listBtn"></div>
                        <div class="sideTxt">Lists</div>
                </li>
            <?php endif ?>
            
            <?php if ( acl_check('admin', 'practice') ) : ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION['CGBASE']; ?>/cg/dispatch.php?action=pravnav&destination=cgmiddle_pannel');return false;">
                    	<div class="pacBtn"></div>
                    	<div class="sideTxt">Practice</div>
                </li>
            <?php endif ?>
            
            <?php if ( acl_check('admin', 'practice') ) : ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION['CGBASE']; ?>/cg/dispatch.php?action=srvvservicefees&destination=cgmiddle_pannel');return false;">
                    	<div class="servBtn"></div>
                    	<div class="sideTxt">Services</div>
                </li>
            <?php endif ?>

            <?php if (acl_check('admin', 'practice') ) : ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION['CGBASE']; ?>/cg/dispatch.php?action=pravnav&destination=cgmiddle_pannel');return false;">
	                    <div class="useBtn"></div>
	                    <div class="sideTxt">Fee Sheet</div>
                 </li>
            <?php endif ?>

            <?php if ( acl_check('admin', 'acl') ) : ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION["CGBASE"]; ?>/cg/dispatch.php?action=admvaclctl&destination=cgmiddle_panel');return false;">
	                  	<div class="aclBtn"></div>
	                  	<div class="sideTxt">ACL</div>
                </li>
            <?php endif ?>
                
            <?php if (acl_check('admin', 'super')): ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION["CGBASE"]; ?>/cg/dispatch.php?action=glbvglobalsmenu&destination=cgmiddle_pannel');return false;">
                    <div class="globalBtn"></div>
                    <div class="sideTxt">Globals</div>
                </li>         
            <?php endif ?>
            
            <?php if (acl_check('admin', 'super')): ?>
                <li class="leftpanelbtnadmin" onclick="$('#cgmiddle_panel').load('<?php echo $_SESSION["CGBASE"]; ?>/cg/dispatch.php?action=logvsystemlogs&destination=cgmiddle_pannel');return false;">
                    <div class="globalBtn"></div>
                    <div class="sideTxt">Logs</div>
                </li>         
            <?php endif ?>

            </ul>

        </div><!--/admin_options-->

</div><!--/cgleft_panel-->

<div id="cgmiddle_panel" class="cgadmin_middle">
	<div id="cgmiddle_panel_content"></div>
	<div id="cgmiddle_panel_subcontent"></div>		
</div>

<script>
$(document).ready(function() {
	$('#cgmiddle_panel').load('<?php echo $_SESSION['CGBASE']; ?>cg/dispatch.php?action=admvnavlistview');
});
</script>

