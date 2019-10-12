<?php

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Columns
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	function official_full_column( $atts, $content = null ) {
		return '<div class="grid_12">' . do_shortcode($content) . '</div>';
	}
	
	function official_one_half( $atts, $content = null ) {
		extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_6' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	function official_one_third( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_4' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	function official_one_fourth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_3' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	function official_one_fifth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_1_5' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	
	function official_one_sixth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_2' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	
	function official_two_third( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_8' . $class . '">' . do_shortcode($content) . '</div>';
	}


	function official_three_fourth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_9' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	
	function official_two_fifth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_2_5' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	
	function official_three_fifth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_3_5' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	
	function official_four_fifth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_4_5' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	function official_five_sixth( $atts, $content = null ) {
	   extract(shortcode_atts(array('position' => ''), $atts));
		$class = "";
		if ($position=='first'){$class = " alpha";}elseif($position=='last'){$class = " omega";}
		return '<div class="grid_10' . $class . '">' . do_shortcode($content) . '</div>';
	}
	
	add_shortcode('full_column', 'official_full_column');
	add_shortcode('one_half', 'official_one_half');
	add_shortcode('one_third', 'official_one_third');
	add_shortcode('one_fourth', 'official_one_fourth');
	add_shortcode('one_fifth', 'official_one_fifth');
	add_shortcode('one_sixth', 'official_one_sixth');
	add_shortcode('two_third', 'official_two_third');
	add_shortcode('three_fourth', 'official_three_fourth');
	add_shortcode('two_fifth', 'official_two_fifth');
	add_shortcode('three_fifth', 'official_three_fifth');
	add_shortcode('four_fifth', 'official_four_fifth');
	add_shortcode('five_sixth', 'official_five_sixth');


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Accordion
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_accordion_shortcode($atts, $content=null, $code) {

	extract(shortcode_atts(array(
		'open' => '1'
	), $atts));

	if (!preg_match_all("/(.?)\[(accordion-item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion-item\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} 
	else {
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
						
			$output .= '<li class="sub-accordion"><div class="accordion-head"><div class="accordion-head-sign"></div><p>' . $matches[3][$i]['title'] . '</p></div><div class="accordion-content">' . do_shortcode(trim($matches[5][$i])) .'</div></li>';
		

		}
		return '<ul class="tt-accordion" >' . $output . '</ul>';
		
	}
	
}
add_shortcode('accordion', 'official_accordion_shortcode'); 




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : ActionBox
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_actionbox_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(
      'type' => 'light',
	  'style' 	=> 'style1',
      'title' 	=> '',
	  'sub_text' 	=> '',
	  'icon' 	=> '',
	  'icon_color' 	=> '',
	  'image' 	=> '',
      'button_default_color'	=> '',
	  'button_color'	=> '',
	  'button_style'	=> '',
	  'button_size'	=> '',
	  'button_text'	=> '',
	  'button_icon'	=> '',
	  'url' => '#',
	  'target' => '_self'
      ), $atts ) );
      

	  if($title == '') {
    	$return1 = "";
      } else{
		$return1 = "<h4>".$title."</h4>";
      }
	  
	  switch ($style){
		  case 'style1':
		  	$btn_style = 'flr';
			$box_style='style1';
		  break;
		  
		  case 'style2':
		  	$btn_style = 'fll';
			$box_style='rev style2';
		  break;
		  
		  
		  case 'style3':
		    $btn_style = 'mtt';
			$box_style='tac style3';
		  break;
		  
		  
		  }
	  
	  $btn_custom_color='';
	  if ($button_color !=''){
			$btn_custom_color = ' style="background-color:'.$button_color.';" ';
		  }
	  
	  
	  $btn_default_color='';
	  if ($button_default_color !='customcolor'){
			$btn_default_color = $button_default_color;
		  }
		  
	  if($button_text == '') {
    	$return2 = "";
      } else{
		 $btn ='[button button_default_color="'. $button_default_color .'" target="'. $target .'" size="'. $button_size.'" style="'. $button_style.'" button_custom_color="'. $button_color .'" url="'. $url .'" text="'. $button_text .'" icon="'. $button_icon.'"]';
		 $return2 ='<div class="'.$btn_style.'">' . do_shortcode($btn) . '</div>';
      }
	  
	  
	  if($sub_text == '') {
    	$return3 = "";
      } else{
		$return3 = "<p>".$sub_text."</p>";
      }
	  
	  $return5 ='';
	  if($image != '') {
		  	if(is_numeric($image)){$imgsrc = wp_get_attachment_url( $image );}else{$imgsrc= $image;}
			$return5 = '<img src="'. $imgsrc .'" class="service-icon" />';
	  } elseif ($icon != ''){
		  	
			if($icon_color != '') {
					$return6 = ' style="color:' . $icon_color . ' !important;" ';
			   } else{
				$return6 = '';
			   }
	   
			$return5 = '<i class="action-icon icon-'.$icon.'" ' . $return6 . '></i>';
      }
	  

	  $return4 = '<div class="matn">'.$return1. $return3 .'</div>';
	  
	  if ($type=='dark'){$type.='_action';}
  
  	  if ($style=='style3'){
		  	return '<div class="action mbf ' . $box_style . " " . $type . ' clearfix"><div class="inner">' . $return5 . $return4 . $return2 . '</div></div>';
		  }else{
			 return '<div class="action mbf ' . $box_style . " " . $type . ' clearfix"><div class="inner">' . $return5 . $return2 . $return4 . '</div></div>';	 
		  }
 	  
      
}

add_shortcode('actionbox', 'official_actionbox_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Button
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

add_shortcode('button', 'official_button_shortcode');

function official_button_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
			'style' => 'default',
			'size' => '',
			'button_default_color'	=> '',
	  		'button_custom_color'	=> '',
			'url' => '#',
			'text' => '',
			'target' => '_self',
			'icon' => ''
			
		), $atts));
	
	
		$btn_default_color='';
		if ($button_default_color !='customcolor'){
			$btn_default_color = $button_default_color;
		}
		
		$btn_custom_color='';
		$icon_custom_color ='';
	    if ($button_custom_color !='' && $button_default_color =='customcolor'){
			if ($style=='tbutton5' || $style=='tbutton6' || $style=='tbutton7'){
				$btn_custom_color = ' style="border-color:'.$button_custom_color.';color:'.$button_custom_color.';" ';
				$icon_custom_color = ' style="color:'.$button_custom_color.';" ';	
			}else{
				$btn_custom_color = ' style="background-color:'.$button_custom_color.';" ';	
			}
			
		  }
		  
		$return_icon ='';
		if ($icon!='') {
			$return_icon ='<i class="icon-'.$icon.'" ' . $icon_custom_color . ' ></i> ';
			}
	  
	  
		return "<a class='tbutton " . $size . " " . $style . " " . $btn_default_color . "' href='".$url."' target='" . $target . "' " . $btn_custom_color . "><span>" . $return_icon . $text . "</span></a>";
}
	
	




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Dropcap
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_dropcap_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'style'      => '',
		'radius'     => '',
		'color'     => '',
		'bg_color'     => '',
		'border_color'     => ''
    ), $atts));
    
    if($style == '') {
    	$return = "dropcap";
    }
    else{
    	$return = "dropcap".$style;
    }

    $return .= " rad".$radius;
  
	
	$return2 = "";
	if($color != '') {
	$return2 = " color:".$color."; ";
   }
   
   if($bg_color != '') {
	$return2 .= " background-color:".$bg_color."; ";
   }
   
   if($border_color != '') {
	$return2 .= " border-color:".$border_color."; ";
   }
   
   if($return2 != '') {
	 $return2 .= "style='".$return2."' ";
   }
   
	   
	$out = "<span class='". $return ."' " . $return2 . ">" .$content. "</span>";
    return $out;
}

add_shortcode( 'dropcap', 'official_dropcap_shortcode' );



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Google Font
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_gfont_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(
      	'font' => 'Monda',
      	'size' => '50px',
		'color' => '',
      	'margin' => '0px',
		'textalign' => ''
      ), $atts ) );
      
	  if($color != '') {
		$return = " color:".$color."; ";
	   } else{
		$return = "";
	   }
	   
	   if($textalign != '') {
		$return2 = " text-align:".$textalign."; ";
	   } else{
		$return2 = "";
	   }

	  $gfont = str_replace("+"," ",$font);
      
      return '<link href="http://fonts.googleapis.com/css?family='.$font.'" rel="stylesheet" type="text/css">
      			<div class="gfont clearfix" style="font-family:\'' .$gfont. '\', serif !important; font-size:' .$size. ' !important; line-height:' .$size. ' !important; ' . $return . $return2 . ' margin: ' .$margin. ' !important;">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'gfont', 'official_gfont_shortcode' );



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Google Map
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_gmap_shortcode($atts) {

	extract( shortcode_atts( array(	
		'lat'   => '0', 
		'long'    => '0',
		'zoom' => '15',
		'width' => '100%',
		'height' => '350',
		'maptype' => 'ROADMAP',
		'address' => '',
		'marker' => '',
		'markerimage' => '',
		'traffic' => 'no',
		'start' => '',
		'end' => '',
		'infowindow' => '',
		'infowindowdefault' => 'yes',
		'directions' => '',
		'style' => ''		
	), $atts ) );
	
	$mapid = 'map' . rand();
							
	$str = '<div id="' . $mapid . '" style="width:'.$width.';height:' . $height . 'px;" class="gmap ' . $style . '"></div>';
	
	if($start != '' && $end != '') 
	{
		$str .= '<div id="directionsPanel" style="width:100%;height:' . $height . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>';
	}

	$str .= '
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
		var latlng = new google.maps.LatLng(' . $lat . ', ' . $long . ');
		var myOptions = {
			zoom: ' . $zoom . ',
			center: latlng,
			scrollwheel: true,
			scaleControl: true,
			disableDefaultUI: false,
			mapTypeId: google.maps.MapTypeId.' . $maptype . '
		};
		var ' . $mapid . ' = new google.maps.Map(document.getElementById("' . $mapid . '"),
		myOptions);
		';


		if($start != '' && $end != '') 
		{
			$str .= '
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
		    directionsDisplay = new google.maps.DirectionsRenderer();
		    directionsDisplay.setMap(' . $mapid . ');
    		directionsDisplay.setPanel(document.getElementById("directionsPanel"));

				var start = \'' . $start . '\';
				var end = \'' . $end . '\';
				var request = {
					origin:start, 
					destination:end,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});


			';
		}

		if($traffic == 'yes')
		{
			$str .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . $mapid . ');
			';
		}


		if($address != '')
		{
			$str .= '
		    var geocoder_' . $mapid . ' = new google.maps.Geocoder();
			var address = \'' . $address . '\';
			geocoder_' . $mapid . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . $mapid . '.setCenter(results[0].geometry.location);
					';
					
					if ($markerimage !='')
					{


						$str .= 'var image = "'. $markerimage .'";';

						$str .= '
						var marker = new google.maps.Marker({
							map: ' . $mapid . ', 
							';
							if ($markerimage !='')
							{
								$str .= 'icon: image,';
							}
						$str .= '
							position: ' . $mapid . '.getCenter()
						});
						';

						if($infowindow != '') 
						{

							$thiscontent = htmlspecialchars_decode($infowindow);
							$str .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
										
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . $mapid . ',marker);
							});
							';

							if ($infowindowdefault == 'yes')
							{
								$str .= '
									infowindow.open(' . $mapid . ',marker);
								';
							}
						}
					}
						$str .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
			';
		}

		if ($markerimage != '' && $address == '')
		{
			if ($markerimage !='')
			{
				$str .= 'var image = "'. $markerimage .'";';
			}

			$str .= '
				var marker = new google.maps.Marker({
				map: ' .$mapid . ', 
				';
				if ($markerimage !='')
				{
					$str .= 'icon: image,';
				}
			$str .= '
				position: ' . $mapid . '.getCenter()
			});
			';

			if($infowindow != '') 
			{
				$str .= '
				var contentString = \'' . $infowindow . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . $mapid . ',marker);
				});
				';
				
				if ($infowindowdefault == 'yes')
				{
					$str .= '
						infowindow.open(' . $mapid . ',marker);
					';
				}				
			}
		}
		
		$str .= '</script>';
		
		
		return $str;
}
add_shortcode('gmap', 'official_gmap_shortcode');




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Highlight
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_highlight_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'background' => '#CC0000',
        'textcolor' => '#FFFFFF'
    ), $atts));
   
   	
   return '<span class="highlighter rad2" style="background-color:' . $background . '; color: ' . $textcolor . '; ">'. do_shortcode($content) . '</span>';
}

add_shortcode('highlight', 'official_highlight_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : HR Line (divider)
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_divider_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(
		'style'      => 'line',
		'color'      => '#eee',
		'size'      => '1px',
		'margin_top'	=> '',
		'margin_bottom'	=> ''
	), $atts ) );
    
	$mrgT = '';
	if ($margin_top !=''){$mrgT='margin-top:'.$margin_top.';';}
	
	$mrgB ='';
	if ($margin_bottom !=''){$mrgB='margin-bottom:'. $margin_bottom .';';}
	
	$r1 = '';
	if ($size!='1px'){
		if ($style=='dotted'){$r1 = 'border-width:'.$size.';';}else{$r1 = 'height:'.$size.';';}
		}
		
	$r2 = '';
	if ($color!='#eee' && $style!='grad'){
		if ($style=='dotted' || $style=='double'){$r2 = 'border-color:'.$color.';';}else{$r2 = 'background-color:'.$color.';';}
		}
	
	
	return '<hr class="'.$style.'" style="' . $r1 . $r2 . $mrgT . $mrgB . '" >';

	
}

add_shortcode('divider', 'official_divider_shortcode');


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : List Style
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_list_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'icon'      => ''
	), $atts));
	
	global $thdglkr_list_icon;
	$thdglkr_list_icon = $icon;
	
	$out = '<ul class="liststyle">'. do_shortcode($content) . '</ul>';
    return $out;
}


function official_item_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(), $atts));
	
	global $thdglkr_list_icon;
	
	if (!$thdglkr_list_icon){$thdglkr_list_icon='ok-1';}
	
	$out = '<li><i class="icon-'.$thdglkr_list_icon.'"></i>'. do_shortcode($content) . '</li>';
    return $out;
}

add_shortcode('liststyle', 'official_list_shortcode');
add_shortcode('item', 'official_item_shortcode');




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Message
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_message_shortcode( $atts, $content = null) {

extract( shortcode_atts( array(
	  'message' => '',
      'type' 	=> 'warning',
      'close_button'	=> 'false',
	  'icon' => 'false'
      ), $atts ) );
      
      if($close_button == 'false') {
		  $return1 = '';
	  }
	  else{
		  $return1 = '<a class="notification-close" href="#"><i class="icon-remove"></i></a>';
	  }
      
	  if($icon == 'false') {
		  $return2 = '';
	  }
	  else{

		switch($type){
			
		case 'success':
			$return2 = '<i class="icon-ok"></i>';
		break;
		
		case 'info':
			$return2 = '<i class="icon-info-sign"></i>';
		break;
		
		case 'warning':
			$return2 = '<i class="icon-warning-sign"></i>';
		break;
		
		case 'error':
			$return2 = '<i class="icon-remove-sign"></i>';
		break;
		
		}
		  
	  }
	  
	  
	  $return3 = '<p>' . $return2 . $message . '</p>';
	  
      return '<div class="notification-box notification-box-' . $type . ' notif-anim" >' . $return3 . $return1 . '</div>';
}

add_shortcode( 'message', 'official_message_shortcode' );





//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Pricing Table 
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_pricing_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'columns'      => '3',
		'style'      => 'dark'
    ), $atts));
	
	$GLOBALS['thdglkr_pricing_table_columns'] = $columns;
	$GLOBALS['thdglkr_pricing_table_style'] = $style;
	

	$out = do_shortcode($content);

	
    return $out;
}

function official_plan_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'title'      => 'Column Title',
		'price'      => '29.99',
		'symbol'      => '$',
		'per'      => false,
		'color'    => false,
		'featured' => false,
		'icon'=>''
    ), $atts));
    
    $featclass= "";
    if($featured != '') {
		$featclass = " featured";
    }
	
	
	
    $return2 = "";
    if($color != false) {
    	$return2 = "style='background-color:".$color.";' ";
    }
    else{
    	$return2 = "";
    }
	
	
	$columns = $GLOBALS['thdglkr_pricing_table_columns'];
	$grid_class = "";
	switch ($columns) {
		case 2 :
			$grid_class = "grid_6";
		break;
		
		case 3 :
			$grid_class = "grid_4";
		break;
		
		case 4 :
			$grid_class = "grid_3";
		break;
		
		case 5 :
			$grid_class = "grid_1_5";
		break;
	}
	
	
	$header_icon = "";
	if ($icon !=''){
		$header_icon = "<i class='icon-".$icon." table-badge' > </i>";
		}
	
	
	
	
	$style = $GLOBALS['thdglkr_pricing_table_style'];
	
	$out = "<div class='price-table ".$grid_class . $featclass." ". $style . "'>
				<div class='Bdetails'>
					<div class='Bhead'><h4>".$title."</h4>".$header_icon." <span> ".$symbol.$price." <small>".$per."</small></span></div>
					<div class='Blist'>" .do_shortcode($content). "</div>
				</div>
			</div>";
		

	
    return $out;
}
add_shortcode('pricing', 'official_pricing_shortcode');
add_shortcode('plan', 'official_plan_shortcode');




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Progress Bar
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_progress_bar_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'type'      => 'bar',
       	'percent'   => '0',
       	'title'	 => '',
		'style'	 => 'simple',
		'color'	 => ''
    ), $atts));
	
	
	if($style == 'simple') {
    	$return1 = "";
      } else{
    	$return1 = " stripes";
      }
	
	if ($type=='bar'){
		
		$out = '<div class="progress-bar'.$return1.'">
			<span rel="'.$percent.'" style="background-color:'.$color.' !important;"></span>
			<div class="progress-bar-text">'.$title.'
			<span>'.$percent.'%</span></div>
			</div>';
		
		}else{
		
		$out = '<input class="knob" data-width="70" data-height="70" data-angleOffset=180 data-thickness=".1" data-readOnly=true data-fgColor="#191919" data-skin="tron" value="0" rel="'. $percent .'">';	
			
			}
	
    return $out;
}

add_shortcode('progress_bar', 'official_progress_bar_shortcode');




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Quote
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_quote_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(
		'style'      => 'full'
	), $atts ) );
    
	
	return '<div class="blockquote '. $style .'">' . do_shortcode($content) .'</div>';	

}

add_shortcode('quote', 'official_quote_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Social Icons
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_social_shortcode( $atts, $content = null) {

extract( shortcode_atts( array(
		'target' 	=> '_blank',
		'style'=>'square',
		'tooltip'=>'notip',
		'facebook'=>'',
		'twitter'=>'',
		'google_plus'=>'',
		'dribbble'=>'',
		'rss'=>'',
		'flickr'=>'',
		'pinterest'=>'',
		'instagram'=>'',
		'skype'=>'',
		'tumblr'=>'',
		'youtube'=>'',
		'xing'=>'',
		'dropbox'=>'',
		'stackexchange'=>'',
		'bitbucket'=>'',
		'weibo'=>'',
		'github'=>'',
		'foursquare'=>''

      ), $atts ) );
      
	  
	  $class="";
	  switch ($style){
		  case "square_wb";
		  	$class="without_border";
		  break;
		  
		  case "circular";
		  	$class="circular";
		  break;
		  
		  case "circular_wb";
		  	$class="circular without_border";
		  break;
		  
		  case "colorful_square";
		  	$class="with_color";
		  break;
		  
		  case "colorful_circular";
		  	$class="circular with_color";
		  break;
		  
		  }
	  
	  
	  $icons = array(
		'facebook','twitter','google_plus','dribbble','rss','flickr','pinterest','instagram','skype','tumblr','youtube','xing','dropbox','stackexchange','bitbucket','weibo','github','foursquare'
	  );
	  
	  $out = '';
	  
	  foreach ($icons as $icon){
		  if ($$icon!=''){
			  	$capital = ucfirst($icon);
			  	$out.='<a href="'.$$icon.'" class="toptip" title="'. $capital .'" target="'. $target.'"><i class="icon-'.str_replace("_","-",$icon).'"></i></a>';
		  }
	 }	
      
      return '<div class="social '.$class.' mbf clearfix">'.$out.'</div>';
}

add_shortcode('social', 'official_social_shortcode');





//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Table
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_table_shortcode( $atts, $content = null) {
      
      return '<div class="table">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'table', 'official_table_shortcode' );





//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Tab
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_tabs_shortcode( $atts, $content = null ) {
	
	$GLOBALS['thdglkr_tab_count'] = 0;
	$i = 1;
	$randomid = rand();
	$active = ' class="active" ';
	
	do_shortcode( $content );

	if( is_array( $GLOBALS['thdglkr_tabs'] ) ){
	
		foreach( $GLOBALS['thdglkr_tabs'] as $tab ){	
			
			if ($i !=1 ){$active = '';} 
			
			if($tab['icon'] == '') {$return = '';}else{$return = '<i class="icon-'. $tab['icon'] .'" ></i>';}
			
			$tabs[] = '<li><a '.$active.' href="#panel'.$randomid.$i.'">' . $return . $tab['title'].'</a></li>';
			$panels[] = '<li '.$active.' id="panel'.$randomid.$i.'">'. do_shortcode($tab['content']) .'</li>';
			$i++;	
			$icon = '';
		}
		$return = '<div class="clearfix"><ul class="tabs">'.implode( "\n", $tabs ).'</ul><ul class="tabs-content">'.implode( "\n", $panels ).'</ul></div>';
	}
	return $return;
}
add_shortcode( 'tabs', 'official_tabs_shortcode' );

function official_tab_shortcode( $atts, $content = null) {
	extract(shortcode_atts(array(
			'title' => '',
			'icon' => ''
	), $atts));
	
	$x = $GLOBALS['thdglkr_tab_count'];
	$GLOBALS['thdglkr_tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['thdglkr_tab_count'] ), 'icon' => $icon, 'content' =>  $content );
	$GLOBALS['thdglkr_tab_count']++;
}
add_shortcode( 'tab', 'official_tab_shortcode' );




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Testimonial
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_testimonial_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(
      'type' => 'testimonial',
	  'style' => 'light',
	  'title' => '',
	  'items' => '',
	  'cat' => '',
	  'transition' => ''
      ), $atts ) );
	  
	  
	global $thdglkr_tq_type,$thdglkr_tq_style,$thdglkr_tq_title,$thdglkr_tq_items,$thdglkr_tq_cat,$thdglkr_tq_transition;
	$thdglkr_tq_type = $type;
	$thdglkr_tq_style = $style;
	$thdglkr_tq_title = $title;
	$thdglkr_tq_items = $items;
	$thdglkr_tq_cat = $cat;
	$thdglkr_tq_transition = $transition;
	
	$file = locate_template('functions/testimonial.php');

    ob_start();
    include $file;
    $template = ob_get_contents();
    ob_end_clean();
    return $template;
	
}

add_shortcode('testimonial', 'official_testimonial_shortcode');


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Toggle
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_toggle_shortcode( $atts, $content = null){
	extract(shortcode_atts(array(
        'title' => '',
        'open' => "false"
    ), $atts));

    
    if($open == "true" || $open == "yes" ) {
	    $return = " open";
		$return2 = " active";
    }
    else{
	    $return = '';
		$return2 = '';
    }
   
   return '<ul class="tt-toggle">
			<li class="sub-toggle'. $return2 . '">
				<div class="toggle-head">
					<div class="toggle-head-sign'. $return . '">&minus;</div>
					<p>'.$title.'</p>
				</div>
				<div class="toggle-content'. $return . '">
				'. do_shortcode($content) . '
				</div>
			</li></ul>';
}
add_shortcode('toggle', 'official_toggle_shortcode'); 



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Tooltip
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_tooltip_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array(
        'text' => '',
		'placement' => 'toptip'
    ), $atts));
   
   	
   return '<span class="' . $placement . '" title="'.$text.'">'. do_shortcode($content) . '</span>';
}

add_shortcode('tooltip', 'official_tooltip_shortcode');


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Video
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_video_shortcode($atts) {
	extract(shortcode_atts(array(
		'type' 	=> '',
		'id' 	=> '',
		'width' 	=> false,
		'height' 	=> false,
		'autoplay' 	=> ''
	), $atts));
	
	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16);
	if (!$height && !$width){
		$height = 315;
		$width = 560;
	}
	
	$autoplay = ($autoplay == 'yes' ? '1' : false);
		
	if($type == "vimeo") $return = "<div class='video-embed'><iframe src='http://player.vimeo.com/video/$id?autoplay=$autoplay&amp;title=0&amp;byline=0&amp;portrait=0' width='$width' height='$height' class='iframe'></iframe></div>";
	
	else if($type == "youtube") $return = "<div class='video-embed'><iframe src='http://www.youtube.com/embed/$id?HD=1;rel=0;showinfo=0' width='$width' height='$height' class='iframe'></iframe></div>";
	
	else if($type == "dailymotion") $return ="<div class='video-embed'><iframe src='http://www.dailymotion.com/embed/video/$id?width=$width&amp;autoPlay={$autoplay}&foreground=%23FFFFFF&highlight=%23CCCCCC&background=%23000000&logo=0&hideInfos=1' width='$width' height='$height' class='iframe'></iframe></div>";
		
	if (!empty($id)){
		return $return;
	}
}
add_shortcode( 'video', 'official_video_shortcode' );


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Service Box
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_service_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(
	  'style' 	=> 'style1',
      'title' 	=> 'Your Title',
	  'sub_title' 	=> '',
	  'icon'	=>	'',
	  'icon_color'	=>	'',
	  'image'	=>	'',
      'button_default_color'	=> '',
	  'button_custom_color'	=> '',
	  'button_size'	=> '',
	  'button_style'	=> '',
	  'button_text'	=> '',
	  'button_icon'	=> '',
	  'url' => '',
	  'target' => '_self'
      ), $atts ) );
      
	  
	  $return1 = "";
	  if($title != '') {
 
		$return1 = "<h3>";

		if ($url !=''){$return1 .= '<a href="'. $url .'" target="'. $target .'" >' . $title . '</a>'; }else{$return1 .= $title;}
		
		if ($sub_title!='' && $style!='style6'){$return1 .='<small>'. $sub_title .'</small>';}
		
		$return1 .= "</h3>";
		
      }
  
	  $return2 = '';
	  if($image != '') {
		  	if(is_numeric($image)){$imgsrc = wp_get_attachment_url( $image );}else{$imgsrc= $image;}
			$return2 = '<img src="'. $imgsrc .'" class="service-icon" />';
	  }elseif ($icon != ''){
		  	
			if($icon_color != '') {
				if($style=='style4' || $style=='style5' || $style=='style6'){
					$return3 = ' style="background-color:' . $icon_color . ' !important;color:#fff !important;" ';
					}else{
					$return3 = ' style="color:' . $icon_color . ' !important;" ';
					}
				
			   } else{
				$return3 = '';
			   }
	   
			$return2 = '<i class="service-icon icon-'.$icon.'" ' . $return3 . '></i>';
      }
	  
	  $btn='';
	  if($button_text !=''){
		  $btn ='[button button_default_color="'. $button_default_color .'" target="'. $target .'" size="'. $button_size.'" style="'. $button_style.'" button_custom_color="'. $button_custom_color .'" url="'. $url .'" text="'. $button_text .'" icon="'. $button_icon.'"]';
		  $btn =do_shortcode($btn);
		  
		  }
	  
	  $return = '';
	  switch ($style){
		  case 'style1':
		  	$return = '<div class="services sb1 clearfix">';
			$return .= '<div class="stitle mb clearfix">';
			$return .= $return2 . $return1;
			$return .= '</div>';
			$return .= '<p>'. $content .'</p>';
			$return .= $btn;
			$return .= '</div>';

		  break;
		  
		  case 'style2':
			$return = '<div class="services sb2 clearfix tac">';
			$return .= '<div class="stitle mb clearfix">';
			$return .= $return2 . $return1;
			$return .= '</div>';
			$return .= '<p>'. $content .'</p>';
			$return .= $btn;
			$return .= '</div>';
		  break;
		  
		  
		  case 'style3':
			$return = '<div class="services sb3 clearfix">';
			$return .= '<div class="inline ic">' . $return2 . '</div>';
			$return .= '<div class="inline">' . $return1 ;
			$return .= '<p>'. $content .'</p>';
			$return .= $btn;
			$return .= '</div></div>';
		  break;
		  
		  
		  case 'style4':
			$return = '<div class="service-i sb4 clearfix">';
			$return .= '<div class="circle-icon">' . $return2 . '</div>';
			$return .= '<div class="sb-desc">' . $return1 ;
			$return .= '<p>'. $content .'</p>';
			$return .= $btn;
			$return .= '</div></div>';
		  break;
		  
		  case 'style5':
			$return = '<div class="service-i sb5 clearfix">';
			$return .= '<div class="circle-icon">' . $return2 . '</div>';
			$return .= '<div class="sb-desc">' . $return1 ;
			$return .= '<p>'. $content .'</p>';
			$return .= $btn;
			$return .= '</div></div>';
		  break;
		  
		  case 'style6':
		  	if($icon_color != '') {
				$return5 = ' style="background-color:' . $icon_color . ' !important;" ';
		   } else{
			$return5 = '';
		   }
			$return = '<div class="service-old sb6 clearfix tac">';
			$return .= '<div class="stitle mb clearfix" '.$return5.'>';
			$return .= $return2 . $return1;
			$return .= '</div>';
			$return .= '<p>'. $content .'</p>';
			$return .= $btn;
			$return .= '</div>';
		  break;
		  
		  
		  }
	  
	return $return;

}

add_shortcode('service', 'official_service_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Title
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_title_shortcode( $atts, $content = null) {
      extract( shortcode_atts( array(
	  'icon'	=>	'',
	  'icon_color'	=>	''
      ), $atts ) );
	  
	  
	  $return1 = '';
	  if ($icon != ''){
		  	
			if($icon_color != '') {
				$return2 = ' style="color:' . $icon_color . ' !important;" ';
			   } else{
				$return2 = '';
			   }
	   
			$return1 = '<i class="title-icon icon-'.$icon.'" ' . $return2 . '></i>';
      }
	  
      return '<h3 class="col-title">' . $return1 . $content . '</h3>
	  			<span class="liner"></span>';
}

add_shortcode( 'title', 'official_title_shortcode' );




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Gap
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_gap_shortcode( $atts, $content = null) {

	extract( shortcode_atts( array(
		  'height' 	=> '10'
		  ), $atts ) );
		  
		  if($height == '') {
			  $return = '';
		  }
		  else{
			  $return = 'style="height: '.$height.'px;"';
		  }
		  
		  return '<div class="gap clearfix" ' . $return . '></div>';
}
add_shortcode('gap', 'official_gap_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Anchor
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_anchor_shortcode( $atts, $content = null) {
		  
		  extract( shortcode_atts( array(
		  'padding_top' 	=> '120px'
		  ), $atts ) );
		  
		  $retutn = '';
		  if($padding_top!=''){$retutn=' style="padding-top:'. $padding_top .'" '; }
		  
		  if($atts['id'] == '') {
			  $return = '';
		  }
		  else{
			  return '<div class="clearfix" id="' . $atts['id'] . '" ' . $retutn . '></div>';
		  }
		  
		  
}
add_shortcode('anchor', 'official_anchor_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : code
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	
	function official_code_shortcode( $atts, $content = null ) {
	   return '<pre>' . $content . '</pre>';
	}

add_shortcode( 'code', 'official_code_shortcode' );




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Clearfix
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function official_clearfix_shortcode( $atts, $content = null) {
	 
    return '<div class="clearfix">' . do_shortcode($content) . '</div>';  
}

add_shortcode('clearfix', 'official_clearfix_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Featured
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_featured_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(	
      'image' 	=> '',
	  'icon' 	=> '',
	  'icon_color' 	=> '',
	  'icon_size' 	=> '',
      'title' 	=> '',
      'subtitle'	=> '',
      ), $atts ) );
      
	  if($icon_color != '') {
		$return1 = ' style="color:' . $icon_color . ' !important;" ';
	   } else{
		$return1 = '';
	   }
	   
	  if($icon_size != '') {
		$return3 = ' sz-' . $icon_size;
	  } else{
		$return3 = ' sz-xl';
	  }
	   
	  if($image == '') {
		  if($icon == '') {$return2 = '';}else{$return2 = '<i class="icon-'.$icon . $return3 .'" '.$return1.'></i>';}
      } else{
    	$return2 = "<img src='".$image."' />";
      }
	  

	  return '<div class="services"><div class="featured animtt" data-gen="fadeInUp" data-gen-offset="bottom-in-view" >
			 '.$return2.'
			 <h4 class="p-title">'.$title.'<small>'.$subtitle.'</small> </h4>
			 <p>' . do_shortcode($content) . '</p>
			 </div></div>';

}

add_shortcode('featured', 'official_featured_shortcode');





//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Icons
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_icon_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
       	'icon'      => 'globe',
		'color'	 => '',
		'size'	  => ''
    ), $atts));
	
	  if($color != '') {
		$return = ' style="color:' . $color . ' !important;" ';
	   } else{
		$return = '';
	   }
	   
	  if($size != '' ) {
		$return2 = " icon-" . $size ;
	   } else{
		$return2 = "";
	   }
    

	
	$out = '<i class="icon-'. $icon . $return2 . '" ' . $return . ' ></i>';
    return $out;
}

add_shortcode('icon', 'official_icon_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Member
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_member_shortcode( $atts, $content = null) {
extract( shortcode_atts( array(
      'image' 	=> '',
      'name' 	=> '',
      'role'	=> '',
	  'facebook' => '',
      'twitter' => '',
      'linkedin' => '',
	  'google_plus' => '',
	  'skype' => '',
	  'dribbble' => '',
	  'flickr' => '',
	  'instagram' => '',
      'email' => '',
      ), $atts ) );
      
      if($image == '') {
    	$return = "";
      } else{
		if(is_numeric($image)){$imgsrc = wp_get_attachment_url( $image );}else{$imgsrc= $image;}
    	$return = "<div class='member-img hover-fx zoom'><img src='".$imgsrc."' /></div>";
      }
       
      if( $twitter != '' || $facebook != '' || $linkedin != '' || $google_plus != '' || $dribbble != '' || $flickr != '' || $skype != '' || $instagram != '' || $email != '' ){
	      $return6 = '<div class="member-social"><ul>';
	      $return7 = '</ul></div>';
	      
	      if($twitter != '') {
	    	$return2 = '<li><a href="' .$twitter. '" target="_blank" title="Twitter" class="toptip"><i class="icon-twitter"></i></a></li>';
	      } else{
		     $return2 = ''; 
	      }
	      
	      if($facebook != '') {
	    	$return3 = '<li><a href="' .$facebook. '" target="_blank" title="Facebook" class="toptip"><i class="icon-facebook"></i></a></li>';
	      } else{
		      $return3 = ''; 
	      }
		  
	      if($linkedin != '') {
	    	$return4 = '<li><a href="' .$linkedin. '" target="_blank" title="LinkedIn" class="toptip"><i class="icon-linkedin"></i></a></li>';
	      }
	      else{
		      $return4 = ''; 
	      }
	      
		  if($google_plus != '') {
	    	$return8 = '<li><a href="' .$google_plus. '" target="_blank" title="Google+" class="toptip"><i class="icon-google-plus"></i></a></li>';
	      }
	      else{
		      $return8 = ''; 
	      }
		  
		  if($dribbble != '') {
	    	$return9 = '<li><a href="' .$linkedin. '" target="_blank" title="Dribbble" class="toptip"><i class="icon-dribbble"></i></a></li>';
	      }
	      else{
		      $return9 = ''; 
	      }
		  
		  
		  if($skype != '') {
	    	$return10 = '<li><a href="' .$skype. '" target="_blank" title="Skype" class="toptip"><i class="icon-skype"></i></a></li>';
	      }
	      else{
		      $return10 = ''; 
	      }
		  
		  if($flickr != '') {
	    	$return11 = '<li><a href="' .$flickr. '" target="_blank" title="Flickr" class="toptip"><i class="icon-flickr"></i></a></li>';
	      }
	      else{
		      $return11 = ''; 
	      }
		  
		  
		  if($instagram != '') {
	    	$return12 = '<li><a href="' .$instagram. '" target="_blank" title="Instagram" class="toptip"><i class="icon-instagram"></i></a></li>';
	      }
	      else{
		      $return12 = ''; 
	      }
		  

	      if($email != '') {
	    	$return5 = '<li><a href="mailto:' .$email. '" title="Mail" class="toptip"><i class="icon-envelope-alt"></i></a></li>';
	      }
	      else{
		      $return5 = ''; 
	      }
      }  else {
	      $return2 = '';
	      $return3 = ''; 
	      $return4 = ''; 
	      $return5 = '';
	      $return6 = ''; 
	      $return7 = ''; 
		  $return8 = '';
		  $return9 = '';
		  $return10 = '';
		  $return11 = '';
		  $return12 = '';
      }   
      return '<div class="member">' .$return. '
      	<h4>' .$name. '</h4>
      	<div class="member-role">' .$role. '</div>' . do_shortcode($content) . '' .$return6. '' .$return3. '' .$return2. '' .$return4. '' .$return8. '' .$return10. '' .$return9. '' .$return11. '' .$return12. '' .$return5. '' .$return7. '</div>';
}

add_shortcode('member', 'official_member_shortcode');




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Wrap Section
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_wrap_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'bg_color'	 => '',
		'border_color'	 => '',
		'shadow'	 => '',
		'image'	 => '',
		'parallax' => '',
		'ratio' => '0.6'
    ), $atts));
	
	
	
	  if($bg_color != '') {
		$return1 = 'background-color:' . $bg_color . ' !important;';
	   } else{
		$return1 = '';
	   }
	
	if($border_color != '') {
		$return2 = 'border-top:solid 1px ' . $border_color . ' !important;border-bottom:solid 1px ' . $border_color . ' !important;';
	   } else{
		$return2 = '';
	   }
	   
	if($image != '') {
		if(is_numeric($image)){$imgsrc = wp_get_attachment_url( $image );}else{$imgsrc= $image;}
		$return3 = 'background-image:url(' . $imgsrc . ') !important;';
	   } else{
		$return3 = '';
	   }
	   
	$return4 = ' style="' .$return1 . $return2 . $return3 .'"';
	
	$return5= '';
	if ($shadow=='yes'){$return5= ' with-shadow';}
	
	
	$return6= '';
	if ($parallax=='yes'){
		$return6 = ' data-stellar-background-ratio="'. $ratio .'" ';
		$return5 .= ' parallax ';
		}
	
	   
	$out = '<div class="wrapbox'.$return5.'" ' . $return4 . $return6 . ' ><div class="row clearfix">' . do_shortcode($content) . '</div></div>';
    return $out;
}

add_shortcode('wrap', 'official_wrap_shortcode');







//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Clients Carousel
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_clients_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'columns' =>'4',
        'title' => '',
		'category' => '',
		'nav' =>'side'
    ), $atts));
	
	
	global $thdglkr_cc_title,$thdglkr_cc_cat,$thdglkr_cc_col,$thdglkr_cc_nav;
	$thdglkr_cc_title = $title;
	$thdglkr_cc_cat = $category;
	$thdglkr_cc_col = $columns;
	$thdglkr_cc_nav = $nav;
	
	$file = locate_template('functions/carousel-clients.php');

    ob_start();
    include $file;
    $template = ob_get_contents();
    ob_end_clean();
    return $template;

}

add_shortcode('clients', 'official_clients_shortcode');



//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Count Down Timer
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_countdown_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'date' =>'30 December 2015 23:59:59',
        'size' => 'large',
		'align' => 'center'
    ), $atts));
	
	
	global $thdglkr_cd_date,$thdglkr_cd_size,$thdglkr_cd_align;
	$thdglkr_cd_date = $date;
	$thdglkr_cd_size = $size;
	$thdglkr_cd_align = $align;
	
	$file = locate_template('functions/countdown.php');

    ob_start();
    include $file;
    $template = ob_get_contents();
    ob_end_clean();
    return $template;

}

add_shortcode('countdown', 'official_countdown_shortcode');


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Portfolio Items & Carousel
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_portfolio_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'columns' =>'4',
        'title' => '',
		'items' => '10',
		'category' => '',
		'carousel' =>'false',
		'nav' =>'side'
    ), $atts));
	
	global $thdglkr_pc_col,$thdglkr_pc_title,$thdglkr_pc_cat,$thdglkr_pc_car,$thdglkr_pc_items,$thdglkr_pc_nav;
	$thdglkr_pc_col = $columns;
	$thdglkr_pc_title = $title;
	$thdglkr_pc_cat = $category;
	$thdglkr_pc_car = $carousel;
	$thdglkr_pc_items = $items;
	$thdglkr_pc_nav = $nav;
	
	$file_pc = locate_template('functions/carousel-portfolio.php');


    ob_start();
    include $file_pc;
    $template_pc = ob_get_contents();
    ob_end_clean();
    return $template_pc;

}

add_shortcode('portfolio', 'official_portfolio_shortcode');






//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : Recent Posts Carousel
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_recentposts_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array(
        'columns' =>'4',
        'title' => '',
		'items' => '10',
		'category' => '',
		'carousel' =>'false',
		'nav' =>'side'
    ), $atts));
	
	global $thdglkr_poc_col,$thdglkr_poc_title,$thdglkr_poc_cat,$thdglkr_poc_car,$thdglkr_poc_items,$thdglkr_poc_nav;
	$thdglkr_poc_col = $columns;
	$thdglkr_poc_title = $title;
	$thdglkr_poc_cat = $category;
	$thdglkr_poc_car = $carousel;
	$thdglkr_poc_items = $items;
	$thdglkr_poc_nav = $nav;
	
	
	$file = locate_template('functions/carousel-posts.php');

    ob_start();
    include $file;
    $template = ob_get_contents();
    ob_end_clean();
    return $template;

}

add_shortcode('recentposts', 'official_recentposts_shortcode');




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// Shortcode : News Ticker
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function official_newsticker_shortcode( $atts, $content = null)
{
	extract(shortcode_atts(array(
        'title' => '',
		'items' => '10',
		'category' => '',
		'orderby' => '',
		'order' => '',
		'title_color' => '',
		'blink' => ''
    ), $atts));
	
	global $thdglkr_nt_title,$thdglkr_nt_cat,$thdglkr_nt_orderby,$thdglkr_nt_order,$thdglkr_nt_items,$thdglkr_nt_color,$thdglkr_nt_blink;
	
	$thdglkr_nt_title = $title;
	$thdglkr_nt_cat = $category;
	$thdglkr_nt_items = $items;
	$thdglkr_nt_orderby = $orderby;
	$thdglkr_nt_order = $order;
	$thdglkr_nt_color = $title_color;
	$thdglkr_nt_blink = $blink;
	
	$file = locate_template('functions/news-ticker.php');

    ob_start();
    include $file;
    $template = ob_get_contents();
    ob_end_clean();
    return $template;

}

add_shortcode('newsticker', 'official_newsticker_shortcode');




?>