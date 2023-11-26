jQuery(window).on('load',function() {
	/* demo */

	jQuery('body').append(
	"<div class='switcher'>"+
		"<div class='switcherWrappper'>"+

			"<button class='switcherShowHide'><i class='fa fa-cog fa-spin'></i></button>"+
			"<div class='switcherContents'>"+
				// "<header><h5>Color</h5></header>"+
				"<!--  Skins Colors -->"+
				"<div class='switcherContent skinsColor'>"+
					"<ul class='demo-content demo-color'>"+
					    "<li data-name='gnrl_color' data-value='pink' data-value-2='ff6b6b' style='background-color: #ff9999;'></li>"+

                        "<li data-name='gnrl_color' data-value='blue' data-value-2='3498db' style='background-color: #3498db;'></li>"+

						"<li data-name='gnrl_color' data-value='green' data-value-2='16a085' style='background-color: #16a085;'></li>"+
						
						"<li data-name='gnrl_color' data-value='red' data-value-2='cd2f2e' style='background-color: #cd2f2e;'></li>"+
						
						"<li data-name='gnrl_color' data-value='purple' data-value-2='904eab' style='background-color: #904eab;'></li>"+

						"<li data-name='gnrl_color' data-value='brown' data-value-2='a57b4a' style='background-color: #a57b4a;'></li>"+

						"<li data-name='gnrl_color' data-value='cyan' data-value-2='2997ab' style='background-color: #2997ab;'></li>"+

						"<li data-name='gnrl_color' data-value='lightgreen' data-value-2='38cbcb' style='background-color: #38cbcb;'></li>"+

						"<li data-name='gnrl_color' data-value='yellow' data-value-2='f8ba01' style='background-color: #f8ba01;'></li>"+

					"</ul>"+
				"</div>"+
				"<!--  End Skins Colors -->"+

			"</div>"+
		"</div>"+
	"</div>");
	
	
		

	//-- show and hide switcher --
	var tB = new TimelineMax({paused:true});  
	tB
	.staggerTo(
		'.skinsColor ul li', .5, {
			left: 0,
			ease: Power4.easeOut,
		}, .2
	)
	jQuery('.switcherShowHide').click(function() {
		if ( jQuery('.switcherShowHide').hasClass('switcherToggle') ){
			jQuery('.switcherShowHide').removeClass('switcherToggle');
			jQuery('.switcher').removeClass('opened');
		}else{   
			jQuery('.switcherShowHide').addClass('switcherToggle');
			jQuery('.switcher').addClass('opened');
			tB.restart();
		}

	});

	jQuery('.switcher').click(function(e){
		e.stopPropagation();
	});

	jQuery('html').on( 'click', function ( _ev )
	{  
		jQuery('.switcherShowHide').removeClass('switcherToggle');
		jQuery('.switcher').removeClass('opened');
	});


   //-- controlling the position of switcher --
	var jQueryswitcherWrappper = jQuery('.switcherWrappper');

	jQueryswitcherWrappper.resize(function(){

		// jQuery('.switcher').css({ 'left' : - jQueryswitcherWrappper.width()});

	});

	jQueryswitcherWrappper.trigger('resize');



	var emerald_gnrl_color=false;
	
	// Pattern
	jQuery('li[data-name=gnrl_pattern]').click(function() {
		emerald_gnrl_gnrl_pattern = jQuery(this).attr("data-value");
		if(emerald_gnrl_gnrl_pattern!=false){
			pointer_pattern(emerald_gnrl_gnrl_pattern);
		}
	});
	
	// General Pattern
	function pointer_pattern(pattern_style){
		if (jQuery(".active-layout").attr("data-value") == "boxed" || jQuery(".active-layout").attr("data-value") == "boxed2") {
			jQuery("body").css("background","url(inc/switcher/images/patterns/"+pattern_style+".png) repeat");
		}
	}
	
	// Layout
	jQuery('li[data-name=gnrl_layout]').click(function() {
		jQuery("*").removeClass("active-layout");
		jQuery(this).addClass("active-layout");
		jQuery('.owl-stage').resize();
		emerald_gnrl_layout = jQuery(this).attr("data-value");
		if(emerald_gnrl_layout!=false){
			pointer_layout(emerald_gnrl_layout);
		}
	});
	
	// General Layout
	function pointer_layout(layout_style){
		if (layout_style == "wide") {
			jQuery("body").removeClass("body-box").removeClass("body-boxed-2");
			jQuery(".wrapper").removeClass("boxed").removeClass("boxed-2");
			jQuery('.owl-stage').resize();
			jQuery(window).resize();
			jQuery("body").attr("style","");
		}else if (layout_style == "boxed") {
			jQuery("body").addClass("body-box").removeClass("body-boxed-2");
			jQuery(".wrapper").addClass("boxed").removeClass("boxed-2");
			jQuery('.owl-stage').resize();
			jQuery(window).resize();
			jQuery("body").attr("style","");
		}else if (layout_style == "boxed2") {
			jQuery("body").removeClass("body-box").addClass("body-boxed-2");
			jQuery(".wrapper").removeClass("boxed").addClass("boxed-2");
			jQuery('.owl-stage').resize();
			jQuery(window).resize();
			jQuery("body").attr("style","");
		}
	}
	
	// Color
	jQuery('li[data-name=gnrl_color]').click(function() {
		emerald_gnrl_color = jQuery(this).attr("data-value");
		emerald_gnrl_color_2 = jQuery(this).attr("data-value-2");
		if(emerald_gnrl_color!=false){
			pointer_color(emerald_gnrl_color,emerald_gnrl_color_2);
		}
	});
	
	// General Color
	function pointer_color(color_style,color_style_2){
		if (color_style != "skins") {
			jQuery(".style-5 .ribbon").attr("src","inc/switcher/images/ribbon-"+color_style+".png");
			jQuery('head').append('<style type="text/css">.push_options{background:#'+color_style_2+'}</style>');
		}else if (color_style == "skins") {
			jQuery(".style-5 .ribbon").attr("src","inc/switcher/images/ribbon-pink.png");
			jQuery('head').append('<style type="text/css">.push_options{background:#'+color_style_2+'}</style>');
		}
		jQuery('head').append('<link rel="stylesheet" href="inc/switcher/css/'+color_style+'.css">');
	}
	
});