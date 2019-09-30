"use strict";
function gt3_mob_menu() {
    if (jQuery(window).width() > 667) {
        jQuery('body').removeClass('active_mobile_menu');
    } else {
        jQuery('body').not('.active_mobile_menu').addClass('active_mobile_menu');
    }
}

function parallaxF() {
	jQuery('header').each(function(){
		if(jQuery(window).width()>1025){
			jQuery(this).parallax("50%",-0.5)
		}
	});
}

jQuery(document).ready(function () {
    "use strict";
    jQuery('.mobile_menu_button').live("click", function () {
        jQuery('header .menu').slideToggle('fast');
    });
    gt3_mob_menu();
});

jQuery(window).load(function () {
    "use strict";
    jQuery('.top_slider_blog').css('opacity', '1');
    jQuery('.spinwrap_cont').hide();
	
	parallaxF();
});

jQuery(window).resize(function () {
    "use strict";
    gt3_mob_menu();
	
	parallaxF();
});


//	Parallax
(function(jQuery){var jQuerywindow=jQuery(window);var windowHeight=jQuerywindow.height();jQuerywindow.resize(function(){windowHeight=jQuerywindow.height()});jQuery.fn.parallax=function(xpos,speedFactor,outerHeight){var jQuerythis=jQuery(this);var getHeight;var firstTop;var paddingTop=0;jQuerythis.each(function(){firstTop=jQuerythis.offset().top});if(outerHeight){getHeight=function(jqo){return jqo.outerHeight(true)}}else{getHeight=function(jqo){return jqo.height()}}if(arguments.length<1||xpos===null)xpos="50%";if(arguments.length<2||speedFactor===null)speedFactor=0.1;if(arguments.length<3||outerHeight===null)outerHeight=true;function update(){var pos=jQuerywindow.scrollTop();jQuerythis.each(function(){var jQueryelement=jQuery(this);var top=jQueryelement.offset().top;var height=getHeight(jQueryelement);if(top+height<pos||top>pos+windowHeight){return}jQuerythis.css('backgroundPosition',xpos+" "+Math.round((firstTop-pos)*speedFactor)+"px")})}jQuerywindow.bind('scroll',update).resize(update);update()}})(jQuery);