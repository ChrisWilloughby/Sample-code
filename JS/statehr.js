//use this to open or close any div on the site with noce anumation
function opencloseUpDown(div,height) {
	div.animate({'height':height},500);
}
function opencloseLeftRight(div,width) {
	div.animate({'width':width},500);
}

//use this function to show a status bar for any event you call
function showEventProgress(text) {
	var statusbox = $('#eventstatusbox');
	if($(statusbox).is(':hidden')){
		$(statusbox).empty().show().append(text);
	}else{
		$(statusbox).empty().append(text);
	}
}
function showEventStatus(text) {
	var statusbox = $('#eventstatusbox');
	if($(statusbox).is(':hidden')){
		$(statusbox).empty().show().append(text).delay(3000);
		$(statusbox).fadeOut(2000, "linear");	
	}else{
		$(statusbox).empty().append(text).delay(800);
		$(statusbox).fadeOut(2000, "linear");
	}	
}

//use this function to run another function on the page at set intervals
function autoRun(yourfunction,time) {
	setInterval(function(){yourfunction},time);
}

//make cg_left_panel height = to screen height - 48px
var leftpanelnewheight = $(window).height() - 48;
$("#leftpanel").height(leftpanelnewheight);
//make cg_middle_panel height = to screen height - 110px
var middlepanelnewheight = $(window).height() - 110;
$("#middlepanel").height(middlepanelnewheight);

var minidemographicinfonewwidth = $(window).width() - 240;
//console.log($(window).width());
//console.log(minidemographicinfonewwidth);

$("#middlepanel").width(minidemographicinfonewwidth);

$(window).resize(function() {
	//make cg_left_panel height = to screen height - 48px
	var cgleftpanelnewheight = $(window).height() - 40;
	$("#leftpanel").height(cgleftpanelnewheight);
	//console.log('leftpanel= '+cgleftpanelnewheight);
	//make cg_middle_panel height = to screen height - 110px
	var cgmiddlepanelnewheight = $(window).height() - 105;
	$("#middlepanel").height(cgmiddlepanelnewheight);
	//console.log('middlepanel= '+cgmiddlepanelnewheight);

	var cgminidemographicinfonewwidth = $(window).width() - 240;
  	//console.log('middlepanel width= '+cgminidemographicinfonewwidth);
	
	$("#middlepanel").width(cgminidemographicinfonewwidth);
	
	var screenheight = $(window).height() - 50;
	//chat box//
	$("#chat_box").height(screenheight);
});

function cookieToObject(cookie) {
    var cookieObj = new Object;
    var cookie_vars = cookie.split(';');
    for (var i in cookie_vars) {
        var pair = cookie_vars[i];
        pair = pair.split('=');
        var key = pair[0];
        var val = pair[1];
        cookieObj[key] = val;
    }
    return cookieObj;
}

//START DOCUMENT READY
jQuery(document).ready(function(){
    
    var cookie = cookieToObject(document.cookie);
    
	//load calender view into #content at login
	if ( cookie.userauthorized !== '1' ) {
    	$('#content').load('../../dispatch.php?action=calvfull');
    } else {
        $('#content').load('../../dispatch.php?action=patvaddfindpatient');
    }

	//open navigation when you click cg_uinavigationtab
	$('#cg_uinavigationtab').click(function() {
			var originalnavwidth = $("#cg_uinavigation").width();
			var newwidth = 755;
			var backtooriginalnavwidth = 50;
		$("#cg_uinavigation").animate(800, 'linear', function(){
			if(originalnavwidth == 50){
				//alert($("#cg_uinavigation").width());
				$("#cg_uinavigation").width(newwidth);
				//alert($("#cg_uinavigation").width());
				$("#cg_uinavigationlinks").show();
			}
			else {
				//alert("still big");
				$("#cg_uinavigation").width(backtooriginalnavwidth);
				$("#cg_uinavigationlinks").hide();
				//alert("all done");
				//alert($("#cg_uinavigation").width());
			}
		});

		$('#cg_uinavigationlinks ul li a').click(function() {
			var backtooriginalnavwidth = 50;
			$("#cg_uinavigation").width(backtooriginalnavwidth);
			$("#cg_uinavigationlinks").hide();
		});

	});
	
	$("#settings").click(function(){
		if($("#cgadminnavigation").is(":hidden")){$("#cgadminnavigation").animate({'height':100},500).css({'display':'block','bottom':0,'position': 'fixed'});
		}else{opencloseUpDown($("#cgadminnavigation"),1);$("#cgadminnavigation").css({'display':'none'})}
	});
	//open chat box//////////////////////////////////////
	$(".cgheader_right span.chat").click(function() {
		//get screen size
		var screenheight = $(window).height() - 50;
        if ( $("#chat_box").is(":hidden") ) {
        	$("#chat_box").height(screenheight);
            $("#chat_box").css("display", "block");
            $("#chat_box").load('../../dispatch.php?action=blavchat').css("display", "block");
            opencloseLeftRight($('#chat_box'),350);
            
        } else {
        	opencloseLeftRight($('#chat_box'),0);
            $("#chat_box").hide("fast");
        }
    });
    
    //Site on and off switch//
     $('.slider').click(function() {
   		if (confirm("You are about to log out out")){
   			$('.slider').animate({'background-position-x':92},1000);
   			$(this).removeClass('on');
			$(this).addClass('off');
			$('body').delay(1000).queue(function( nxt ) {
				$(this).load('../../../interface/logout.php?auth=logout');
			nxt();
			});
		 }					
	});
	//END site on and of switch//
	
});//END DOCUMENT READY