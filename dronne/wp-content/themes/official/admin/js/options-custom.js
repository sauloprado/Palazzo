/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */
 


jQuery(document).ready(function($) {
	
	// Fade out the save message
	$('.fade').delay(200).fadeIn(500).delay(2000).fadeOut(1000);
	
	// Color Picker
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
		color: initialColor,
		onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
		},
		onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
		},
		onChange: function (hsb, hex, rgb) {
		$(Othis).children('div').css('backgroundColor', '#' + hex);
		$(Othis).next('input').attr('value','#' + hex);
	}
	});
	}); //end color picker
	
	// Switches option sections
	$('.group').hide();
	var activetab = '';
	if (typeof(localStorage) != 'undefined' ) {
		activetab = localStorage.getItem("activetab");
	}
	if (activetab != '' && $(activetab).length ) {
		$(activetab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	
	if (activetab != '' && $(activetab + '-tab').length ) {
		$(activetab + '-tab').addClass('nav-tab-active');
	}
	else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}
	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("activetab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
		
		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});
	
	});
           					
	$('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;		
					}
				$(this).addClass('hidden');
			});
           					
		}
	}
	
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide()
	
	
	$(":checkbox").iButton();
	
	$(".sslider").bind("slider:changed", function (event, data) {
	  $(this).next('.lblsldr').html(data.value);
	});

	//Maintenance Options
	if(!$('#main_mode').attr('checked')){
		$('#section-main_page').hide();
		$('#section-main_html').hide();
		}else{
			if($('#main_page').val()!='default'){
				$('#section-main_html').hide();
			}	
		}
	
	$('#main_mode').change(function(){
		if($('#main_mode').attr('checked')){
			if($('#main_page').val()=='default'){
				$('#section-main_html').show();
				}
			$('#section-main_page').show();
			
		}else{
			$('#section-main_page').hide();
			$('#section-main_html').hide();
		}
	});
	
	$('#main_page').change(function(){	
		if($('#main_page').val()=='default'){
			$('#section-main_html').show();
		}else{
			$('#section-main_html').hide();	
		}
	});	
		

	$('#of_import_button').live('click', function(){
	
		var answer = confirm("Click OK to import options.")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
			
			var import_data = $('#export_data').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
				security: nonce,
				data: import_data
			};
						
			$.post(ajaxurl, data, function(response) {

				if(response==-1){
					alert("Error!");
				}		
				else 
				{
					alert("Your theme has been restored.");
					location.reload(); 
				}
							
			});
			
		}
		
	return false;
					
	});
	
	
	$('#of_import_demo').live('click', function(){
		
		var dv = $('#demoselected').val();
		var answer = confirm("Are you sure you want to import all demo data?")
		
		if (answer){
			
			$('#optionsframework .group').hide();
			$('#of-option-importing').show();
			
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
			
			var data = {
				action: 'of_ajax_post_action',
				type: 'import_demo',
				security: nonce,
				data: dv
			};
						
			$.post(ajaxurl, data, function(response) {

				if(response==-1){
					alert("Error!");
				}		
				else 
				{
					
					alert(dv+' is imported successfully.');
					location.reload(); 

				}
							
			});
			
		}
		
	return false;
					
	});
	
});

function setDemo(d){
	jQuery('#demoselected').val(d);
	jQuery('#of_import_demo').show();
	return false;
	}
	
	
	
	
	