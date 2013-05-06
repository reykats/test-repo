/*
 FAQ Module by Damir Grgic
*/
$Core.mgfaq = {

    loadActions:function()
    {
    	var sidebar = $('#js_block_border_faq_panel');
    	var top = sidebar.offset().top - parseFloat(sidebar.css('marginTop'));
    	$(window).scroll(function (event) {
    		var ypos = $(this).scrollTop();
    		if (ypos >= top) {
    			sidebar.addClass('fixed');
    		}
    		else {
    			sidebar.removeClass('fixed');
    		}
    	});
    	$.localScroll.hash({
    		queue:true,
    		duration:500
    	});
        $.localScroll({
          queue:true,
          duration:500,
          hash:true,
          onAfter:function( anchor, settings ){}
        });
    	$('ul.faq_submenu li a').click(function(e){
    		var linkHref = $(this).attr('href');
            //var linkHrefID = linkHref;
            var linkHrefClass = linkHref.replace("#", ".");
            var relId = $(this).attr('rel');
            if(relId){
              $('.faq_subaction').hide();
              $('.'+relId).toggle();
            }
            setTimeout(function(){
                $(linkHrefClass).highlightFade({color:'rgb(255, 236, 142)', speed: 2000});
                //$(linkHrefID).highlightFade({color:'rgb(255, 236, 142)', speed: 2000});
            }, 600);
    	});
    	$('#js_block_border_faq_panel ul.action li a').click(function(e){
    		var linkHref = $(this).attr('href');
            //var linkHrefQID = linkHref;
    		var linkHrefID = $(this).attr('rel');
            linkHref = linkHref.replace("#", ".");
            if(linkHrefID){
              $('.faq_subaction').hide();
              $('.'+linkHrefID).toggle();
            }
            setTimeout(function(){
                $(linkHref).highlightFade({color:'rgb(255, 236, 142)', speed: 2000});
                //$(linkHrefQID).highlightFade({color:'rgb(255, 236, 142)', speed: 2000});
            }, 600);
    	});
    }

}

$Behavior.initMGFAQPage = function(){
    $Core.mgfaq.loadActions();
}

