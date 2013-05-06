/*
 * Author: Teamwurkz Technologies Inc. 
 * tm-jqueryfx simple tabslide 1.1
 *
 */
 
function tmtabslide(tabname, fxtype, fxspeed, autoplay, playtime, fxcaption, fxcapspeed, captiontype, playcont,autohidearrows, isloader, slicetotal, slicedelay) {
	
	// initialize variables
	var tabwidth = $("#"+tabname).css('width').replace('px', '');
	var panelsize = tabwidth*($('#'+tabname+' ul.tm_tab_panel li').size()+1);
	var listItem = $('#'+tabname+' ul.tm_tab_menu li');
	var totalSlide = $('#'+tabname+' ul.tm_tab_menu li').size();
	var slidecounter = 0;
	var prevcounter = 0;
	var startslide;
	var isloaded = 0;
	
	if(fxtype=='random'){
		var sliderndNum = Math.ceil(Math.random()*4);
	}
	// for slice effect 
	var prev_image_src;
	
	// initialize loader
	if(isloader === true){
		$("#"+tabname+" div.tm_tab_panel_container ul li img").load(function(){
			$("#"+tabname+" div.loader").css('display','none');			
		});
	}
	
		// initialize css
		$('#'+tabname+' ul.tm_tab_menu li a:first').addClass('active');	
		$("#"+tabname+" div.tm_tab_panel_container").css("width",panelsize+"px");
		$("#"+tabname+" div.tm_tab_panel_container ul li").css("width",tabwidth+"px")
		
		// initialize special effects
		if(fxtype != ''){
			$("#"+tabname+" div.tm_tab_panel_container ul li").css('position','absolute');
			$("#"+tabname+" div.tm_tab_panel_container ul li").hide();
			if(fxtype=='random' || fxtype=='slice-box-fade' || fxtype=='slice-left-down' || fxtype=='slice-alternate' || fxtype=='slice-alternate-horizontal' || fxtype=='slice-blinds-vertical'){
				prev_image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(prevcounter).css('background-image');
				$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).css('background-image',prev_image_src)			
			}
			$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).fadeIn(fxspeed);
		}
	
		// initialize caption
		if(fxcaption===true) {
			var captionheight = $('#'+tabname+' ul.tm_tab_panel li div.scaption').css('height');
			var captionanime = parseInt($('#'+tabname+' ul.tm_tab_panel li').css('height').replace('px', '')) - parseInt($('#'+tabname+' ul.tm_tab_panel li div.scaption').css('height').replace('px',''));
			captionplay();
		}
	
		// autoplay is true
		if(autoplay===true){
			startslide = setTimeout(slidetrigger,playtime);
		}
		
		// play slideshow
		function slidetrigger() { 		
			slidecounter = slidecounter + 1; playslide(); 
		}		
			
		function playslide() {
				
				// if fade effect lets fadeout
				if(fxtype == 'fade'){					
					$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).fadeOut(fxspeed-500);									
				}
				else if(fxtype=='random' || fxtype=='slice-box-fade' || fxtype=='slice-left-down' || fxtype=='slice-alternate' || fxtype=='slice-alternate-horizontal' || fxtype=='slice-blinds-vertical'){					
						prev_image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(prevcounter).css('background-image');						
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).css('display','none');								
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(slidecounter).css('background-image',prev_image_src);					
				}
				
				captionout();
				prevcounter = slidecounter;
				
				if(slidecounter < totalSlide){
					menuActive();
					// effects
					showeffects();					
					captionplay();
					
				} else {
					slidecounter = 0;
					prevcounter = 0;
					menuActive();
					// effects
					showeffects(true);
					captionplay();
				}

				// randomize
				if(fxtype=='random'){
					sliderndNum = Math.ceil(Math.random()*5);
				}
				
				startslide = setTimeout(slidetrigger,playtime);			
		}
		
		// tab menu onclick
		$("#"+tabname+" ul.tm_tab_menu li a").click(		
			function(){
				showcontinue();

				// randomize
				if(fxtype=='random'){
					sliderndNum = Math.ceil(Math.random()*5);
				}

				slidecounter = $("#"+tabname+" ul.tm_tab_menu li a").index(this);
				menuActive();

				// initialize slice
				if(fxtype=='random' || fxtype=='slice-box-fade' || fxtype=='slice-alternate' || fxtype=='slice-left-down' || fxtype=='slice-alternate-horizontal' || fxtype=='slice-blinds-vertical'){
					var animBuffer = 0;				
					var slice_delay = slicedelay;		
					var slice_total = slicetotal;
					var slice_width = tabwidth / slice_total;
					var slice_height = $('#'+tabname).css('height').replace('px','');
					var bg_position = 0;
					var image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(slidecounter).css('background-image');
					var slicepanel = "#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li" ;

				}
				// effects
					if(fxtype == 'fade'){
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).fadeOut(fxspeed-500);
						$('#'+tabname+' ul.tm_tab_panel li div.scaption').eq(prevcounter).animate({top:$('#'+tabname+' ul.tm_tab_panel li').css('height')},fxcapspeed-1000);
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq($("#"+tabname+" ul.tm_tab_menu li a").index(this)).fadeIn(fxspeed);
					} else if(fxtype=='slice-box-fade' || sliderndNum=='1'){				

						setimagebg();
						var rowCount = 4;
						var itemCount = 0;
						for( var i=0, l = slice_total; i < l; i++){
							for( var r=0, rl = rowCount; r < rl; r++){
							bg_position = -(i*slice_height);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-color','#fff');
							$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
							$(slicepanel+' div.tm_slice').css('height',(slice_height/rowCount)+'px');
							$(slicepanel+' div.tm_slice').eq(itemCount).css('left',(i*slice_width)+'px');
							$(slicepanel+' div.tm_slice').eq(itemCount).css('opacity',1-(r*0.2));
							$(slicepanel+' div.tm_slice').eq(itemCount).css('top',(r*(slice_height/rowCount))+'px');										
							$(slicepanel+' div.tm_slice').slice(itemCount).css('background-position',(-(i*slice_width))+'px '+(-(r*(slice_height/rowCount)))+'px');					
							// $(slicepanel+' div.tm_slice').eq(r).css('display','none');
							$(slicepanel+' div.tm_slice').eq(itemCount).css('display','none');
							itemCount++;
							}
						}
						
						var islice = 0;
						gosliceanimate();
						
				
					} else if(fxtype=='slice-alternate-horizontal' || sliderndNum=='2'){				
				
						setimagebg();
						slice_height = slice_height / slice_total;
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_height);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('height',slice_height+'px');
							$(slicepanel+' div.tm_slice').eq(i).css('top',(i*slice_height)+'px');
							if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('left','0px'); } else { $(slicepanel+' div.tm_slice').eq(i).css('right','0px'); }
							$(slicepanel+' div.tm_slice').slice(i).css('background-position','0px '+bg_position+'px');					
						}
						
						var islice = 0;
						gosliceanimate();

					} else if(fxtype=='slice-alternate' || sliderndNum=='3'){						
						setimagebg();		
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_width);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
							if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('bottom','0px'); }
							$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');		
						}						
						var islice = 0;						
						gosliceanimate();

					} else if(fxtype=='slice-blinds-vertical' || sliderndNum=='4'){						
						setimagebg();		
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_width);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('height',slice_height+'px');							
							$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');		
						}						
						var islice = 0;						
						gosliceanimate();
					
					} else if(fxtype=='slice-left-down' || sliderndNum=='5'){
						setimagebg();						
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_width);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
							$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');		
						}						
						var islice = 0;						
						gosliceanimate();	
						
					} else {
						$("#"+tabname+" div.tm_tab_panel_container").animate({marginLeft: -($("#"+tabname+" ul.tm_tab_menu li a").index(this)*tabwidth)}, fxspeed);						
					}
					captionout();
					prevcounter = $("#"+tabname+" ul.tm_tab_menu li a").index(this);					
					captionplay();
				
				function setimagebg(){
						$(slicepanel).children('.tm_slice').remove();						
						prev_image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(prevcounter).css('background-image');						
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).css('display','none');								
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(slidecounter).css('background-image',prev_image_src);
						$(slicepanel).eq(slidecounter).show();	
				}
				// end setimagebg
				function gosliceanimate(){
					
				$(slicepanel+' div.tm_slice').each(
					function(){						
						var slicethis = $(this);
						if(fxtype=='slice-blinds-vertical' || sliderndNum=='4'){
							$(this).css('left',islice*slice_width);
							setTimeout(function(){					
								slicethis.animate({width:slice_width, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);
						} else if(fxtype=='slice-box-fade' || sliderndNum=='1'){
							setTimeout(function(){					
								slicethis.show(islice*slice_delay+500);
								slicethis.animate({opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);						
						} else if(fxtype=='slice-alternate-horizontal' || sliderndNum=='2'){
							setTimeout(function(){					
								slicethis.animate({width:tabwidth, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);						
						} else {
							$(this).css('left',islice*slice_width);
							setTimeout(function(){					
								slicethis.animate({height:slice_height, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);												
						}
						
						animBuffer +=slice_delay*4;
						islice++;					
						if(islice == slice_total) { islice=0;  }					
					}
				);				
				}
				// end gosliceanimate
			}
			
		);
		
		// show effects
		function showeffects(resetslide){
			if(resetslide===true){
				slidecontainer_width = 0 ;
			} else {
				slidecontainer_width = -(slidecounter*tabwidth);
			}
			
			if(fxtype=='random' || fxtype=='slice-box-fade' || fxtype=='slice-alternate' || fxtype=='slice-left-down' || fxtype=='slice-alternate-horizontal' || fxtype=='slice-blinds-vertical'){
				var animBuffer = 0;				
				var slice_delay = slicedelay;		
				var slice_total = slicetotal;
				var slice_width = tabwidth / slice_total;
				var slice_height = $('#'+tabname).css('height').replace('px','');
				var bg_position = 0;
				var image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(slidecounter).css('background-image');
				var slicepanel = "#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li" ;

			}
			
			if(fxtype == 'fade'){
				$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(slidecounter).fadeIn(fxspeed);				
			} 
			else if(fxtype=='slice-box-fade' || sliderndNum=='1'){				
				
				setimagebgshow();
				var rowCount = 4;
				var itemCount = 0;

				for( var i=0, l = slice_total; i < l; i++){
					for( var r=0, rl = rowCount; r < rl; r++){
					bg_position = -(i*slice_height);					
					$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
					$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
					$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-color','#fff');
					$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
					$(slicepanel+' div.tm_slice').css('height',(slice_height/rowCount)+'px');
					$(slicepanel+' div.tm_slice').eq(itemCount).css('left',(i*slice_width)+'px');
					$(slicepanel+' div.tm_slice').eq(itemCount).css('opacity',1-(r*0.2));
					$(slicepanel+' div.tm_slice').eq(itemCount).css('top',(r*(slice_height/rowCount))+'px');										
					$(slicepanel+' div.tm_slice').slice(itemCount).css('background-position',(-(i*slice_width))+'px '+(-(r*(slice_height/rowCount)))+'px');					
					//$(slicepanel+' div.tm_slice').eq(r).css('display','none');
					$(slicepanel+' div.tm_slice').eq(itemCount).css('display','none');
					itemCount++;
					}
				}
				
				var islice = 0;
				gosliceanimateshow();
				
			} 			
			else if(fxtype=='slice-blinds-vertical' || sliderndNum=='4'){				
				
				setimagebgshow();				
				
				for( var i=0, l = slice_total; i < l; i++){
					bg_position = -(i*slice_width);
					$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
					$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
					$(slicepanel+' div.tm_slice').css('height',slice_height+'px');
					if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('bottom','0px'); }
					$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');					
				}
				
				var islice = 0;
				gosliceanimateshow();
				
			} 			
			else if(fxtype=='slice-alternate' || sliderndNum=='3'){				
				
				setimagebgshow();
				
				for( var i=0, l = slice_total; i < l; i++){
					bg_position = -(i*slice_width);
					$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
					$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
					$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
					if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('bottom','0px'); }
					$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');					
				}
				
				var islice = 0;
				gosliceanimateshow();
				
			} 			
			else if(fxtype=='slice-alternate-horizontal' || sliderndNum=='2'){				
				
				setimagebgshow();
				slice_height = slice_height / slice_total;
				for( var i=0, l = slice_total; i < l; i++){
					bg_position = -(i*slice_height);
					$(slicepanel).eq(slidecounter).append('<div class="tm_slice" ></div>');							
					$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
					$(slicepanel+' div.tm_slice').css('height',slice_height+'px');
					$(slicepanel+' div.tm_slice').eq(i).css('top',(i*slice_height)+'px');
					if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('left','0px'); } else { $(slicepanel+' div.tm_slice').eq(i).css('right','0px'); }
					$(slicepanel+' div.tm_slice').slice(i).css('background-position','0px '+bg_position+'px');					
				}
				
				var islice = 0;
				gosliceanimateshow();
				
			} 						
			else if(fxtype=='slice-left-down' || sliderndNum=='5'){				
				setimagebgshow();

				for( var i=0, l = slice_total; i < l; i++){
					bg_position = -(i*slice_width);
					$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
					$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
					$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
					$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');		
				}
				
				var islice = 0;
				gosliceanimateshow();
				
			} 			
			else {
				$("#"+tabname+" div.tm_tab_panel_container").animate({marginLeft: slidecontainer_width}, fxspeed);
			}											
			
			function setimagebgshow(){
				$(slicepanel).children('.tm_slice').remove();				
				if(slidecounter==0){					
					prev_image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(totalSlide-1).css('background-image');					
					$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).css('display','none');								
					$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(slidecounter).css('background-image',prev_image_src);				
				} 				
				$(slicepanel).eq(slidecounter).show();			
			}
			// end setimagebgshow
			function gosliceanimateshow(){
				$(slicepanel+' div.tm_slice').each(
					function(){
						var slicethis = $(this);						
						
						if(fxtype=='slice-blinds-vertical' || sliderndNum=='4'){
							$(this).css('left',islice*slice_width);
							setTimeout(function(){					
								slicethis.animate({width:slice_width, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);
						} else if(fxtype=='slice-box-fade' || sliderndNum=='1'){
							setTimeout(function(){					
								slicethis.show(islice*slice_delay+500);
								slicethis.animate({opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);						
						} else if(fxtype=='slice-alternate-horizontal' || sliderndNum=='2'){
							setTimeout(function(){					
								slicethis.animate({width:tabwidth, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);						
						} else {
							$(this).css('left',islice*slice_width);
							setTimeout(function(){					
								slicethis.animate({height:slice_height, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);												
						}
						
						animBuffer +=slice_delay*4;
						islice++;					
						if(islice == slice_total) { islice=0;  }					
					}
				);				
			}
			// end gosliceanimateshow
		}
		
		function arrowtrigger() {
			menuActive();

				// randomize
				if(fxtype=='random'){
					sliderndNum = Math.ceil(Math.random()*5);
				}

				// initialize effects
				if(fxtype=='random' || fxtype=='slice-box-fade' || fxtype=='slice-alternate' || fxtype=='slice-left-down' || fxtype=='slice-alternate-horizontal' || fxtype=='slice-blinds-vertical'){ 
					captionout(); 
						prev_image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(prevcounter).css('background-image');						
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).css('display','none');								
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(slidecounter).css('background-image',prev_image_src);						
						prevcounter = slidecounter;

						var animBuffer = 0;				
						var slice_delay = slicedelay;		
						var slice_total = slicetotal;
						var slice_width = tabwidth / slice_total;
						var slice_height = $('#'+tabname).css('height').replace('px','');
						var bg_position = 0;
						var image_src = $("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li div.tm_img_holder").eq(slidecounter).css('background-image');
						var slicepanel = "#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li" ;
						
						$(slicepanel).children('.tm_slice').remove();				
						$(slicepanel).eq(slidecounter).show();					
				}

				//play effects
					if(fxtype == 'fade'){
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(prevcounter).fadeOut(fxspeed-500);
						$('#'+tabname+' ul.tm_tab_panel li div.scaption').eq(prevcounter).animate({top:$('#'+tabname+' ul.tm_tab_panel li').css('height')},fxcapspeed-1000);					
						prevcounter = slidecounter;
						$("#"+tabname+" div.tm_tab_panel_container ul.tm_tab_panel li").eq(slidecounter).fadeIn(fxspeed);
					} else if(fxtype=='slice-box-fade' || sliderndNum=='1'){				

						var rowCount = 4;
						var itemCount = 0;
						for( var i=0, l = slice_total; i < l; i++){
							for( var r=0, rl = rowCount; r < rl; r++){
							bg_position = -(i*slice_height);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-color','#fff');
							$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
							$(slicepanel+' div.tm_slice').css('height',(slice_height/rowCount)+'px');
							$(slicepanel+' div.tm_slice').eq(itemCount).css('left',(i*slice_width)+'px');
							$(slicepanel+' div.tm_slice').eq(itemCount).css('opacity',1-(r*0.2));
							$(slicepanel+' div.tm_slice').eq(itemCount).css('top',(r*(slice_height/rowCount))+'px');										
							$(slicepanel+' div.tm_slice').slice(itemCount).css('background-position',(-(i*slice_width))+'px '+(-(r*(slice_height/rowCount)))+'px');					
							//$(slicepanel+' div.tm_slice').eq(r).css('display','none');
							$(slicepanel+' div.tm_slice').eq(itemCount).css('display','none');
							itemCount++;
							}
						}
						
						var islice = 0;
						goslicetrigger();
						
					} else if(fxtype=='slice-alternate-horizontal' || sliderndNum=='2'){								
						
						slice_height = slice_height / slice_total;
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_height);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('height',slice_height+'px');
							$(slicepanel+' div.tm_slice').eq(i).css('top',(i*slice_height)+'px');
							if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('left','0px'); } else { $(slicepanel+' div.tm_slice').eq(i).css('right','0px'); }
							$(slicepanel+' div.tm_slice').slice(i).css('background-position','0px '+bg_position+'px');					
						}
						
						var islice = 0;
						goslicetrigger();

					} else if(fxtype == 'slice-blinds-vertical' || sliderndNum=='4'){
						
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_width);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('height',slice_height+'px');
							if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('bottom','0px'); }
							$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');		
						}
						
						var islice = 0;
						goslicetrigger();

					} else if(fxtype == 'slice-alternate' || sliderndNum=='3'){
						
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_width);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
							if(i%2==0){ $(slicepanel+' div.tm_slice').eq(i).css('bottom','0px'); }
							$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');		
						}
						
						var islice = 0;
						goslicetrigger();
						
					} else if(fxtype == 'slice-left-down' || sliderndNum=='5'){
		
						for( var i=0, l = slice_total; i < l; i++){
							bg_position = -(i*slice_width);
							$(slicepanel).eq(slidecounter).append('<div class="tm_slice"></div>');							
							$(slicepanel).eq(slidecounter).children('div.tm_slice').css('background-image',image_src);
							$(slicepanel+' div.tm_slice').css('width',slice_width+'px');
							$(slicepanel+' div.tm_slice').slice(i).css('background-position',bg_position+'px 0px');		
						}
						
						var islice = 0;
						goslicetrigger();
						
					} else {
						$("#"+tabname+" div.tm_tab_panel_container").animate({marginLeft: -(slidecounter*tabwidth)}, fxspeed);		
					}
				
				function goslicetrigger(){
				$(slicepanel+' div.tm_slice').each(
					function(){
						var slicethis = $(this);						
						
						if(fxtype=='slice-blinds-vertical' || sliderndNum=='4'){
							$(this).css('left',islice*slice_width);
							setTimeout(function(){					
								slicethis.animate({width:slice_width, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);
						} else if(fxtype=='slice-box-fade' || sliderndNum=='1'){
							setTimeout(function(){					
								slicethis.show(islice*slice_delay+500);
								slicethis.animate({opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);						
						} else if(fxtype=='slice-alternate-horizontal' || sliderndNum=='2'){
							setTimeout(function(){					
								slicethis.animate({width:tabwidth, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);						
						} else {
							$(this).css('left',islice*slice_width);
							setTimeout(function(){					
								slicethis.animate({height:slice_height, opacity:1},islice*slice_delay+500);						
								}
								, animBuffer);												
						}
						
						animBuffer +=slice_delay*4;
						islice++;					
						if(islice == slice_total) { islice=0;  }					
					}
				);				
				}
				// end

				captionplay();
		}

		// panel mouseover
		if(autohidearrows===true){		
			$("#"+tabname).hover(
				function(){
					$("#"+tabname+" .tm_arrownav a").css('display','inline');
				},
				function(){
					$("#"+tabname+" .tm_arrownav a").css('display','none');
				}		
			);
		}
		
		$("#"+tabname+" a#aLeft").click(
			function(){			
				showcontinue();
				prevcounter=slidecounter;
				if(slidecounter != 0 ){					
					slidecounter = slidecounter - 1;
					
				} else {
					slidecounter = totalSlide-1;
				}
				arrowtrigger();
			}
		);
		$("#"+tabname+" a#aRight").click(
			function(){
				showcontinue();
				prevcounter=slidecounter;
				if(slidecounter != (totalSlide-1) ){					
					slidecounter = slidecounter + 1;					
				} else {
					slidecounter = 0 ;
				}
				arrowtrigger();
			}
		);
		
		function captionplay(){
			// caption
			if(fxcaption===true) {
				if(captiontype=='vertical'){
					$('#'+tabname+' ul.tm_tab_panel li div.scaption').eq(slidecounter).animate({top:captionanime+'px'},fxcapspeed);
				}
				else {
					$('#'+tabname+' ul.tm_tab_panel li div.scaption').eq(slidecounter).fadeIn(fxcapspeed);
				}
			}	
		}
		
		function captionout(){
			if(captiontype=='vertical'){
				$('#'+tabname+' ul.tm_tab_panel li div.scaption').eq(prevcounter).animate({top:$('#'+tabname+' ul.tm_tab_panel li').css('height')},fxcapspeed-1000);
			}
			else {
				$('#'+tabname+' ul.tm_tab_panel li div.scaption').eq(prevcounter).hide(fxcapspeed);
			}
			
		}
		
		function showcontinue(){
				if(playcont===false){
					clearTimeout(startslide);
				} else {
					clearTimeout(startslide);
					startslide = setTimeout(slidetrigger,playtime*3);
				}		
		}
		
		function menuActive() {
				$('#'+tabname+' ul.tm_tab_menu li a.active').removeClass('active');			
				$('#'+tabname+' ul.tm_tab_menu li a').eq(slidecounter).addClass('active');
		}

}
