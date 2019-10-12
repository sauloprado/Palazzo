<?php 
// Custom WPML Language Selector
// by Tohid Golkar
// ThemeTor.com



if(_option('wpml_lang_selector',1)==1){
	add_filter( 'wp_nav_menu_items', 'new_nav_menu_items',10,2 );
}


function new_nav_menu_items($items,$args) {
	
	$wpml_menu = _option('wpml_menu','Main Menu');
	$wpml_style = _option('wpml_style',3);
	$done = false;
	
	if (function_exists('icl_get_languages') && $args->menu==$wpml_menu) {
		$languages = icl_get_languages('skip_missing=0');
		
		if(1 < count($languages)){
			
			foreach($languages as $l){
				
				switch ($wpml_style) {

				case 1; //Flag + Native Name
					if($l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /> '.$l['native_name'].' </a><ul class="sub-menu">'.wpml_lang_selector_submenu($languages,1).'</ul></li>';         
					}
				break;
				
				
				case 2; //Flag + Translated Name
					if($l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /> '.$l['translated_name'].' </a><ul class="sub-menu">'.wpml_lang_selector_submenu($languages,2).'</ul></li>';         
					}
				break;
				
				
				case 3; //Flags (In a Line)
					if(!$l['active']){
						$items = $items.'<li class="menu-item langflag"><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a></li>';
					}
				break;
				
				
				case 4; //Flags (Dropdown Menu)
					if($l['active']){
						$items = $items.'<li class="menu-item langflag"><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a><ul class="sub-menu">'.wpml_lang_selector_submenu($languages,4).'</ul></li>';
					}
				break;
				
				
				case 5; //Native Name
					if($l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'">'.$l['native_name'].' </a><ul class="sub-menu">'.wpml_lang_selector_submenu($languages,5).'</ul></li>';         
					}
				break;
				
				case 6; //Translated Name
					if($l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'">'.$l['translated_name'].' </a><ul class="sub-menu">'.wpml_lang_selector_submenu($languages,6).'</ul></li>';         
					}
				break;
		
				}
				
				
			}
			
		}
	}
	return $items;
}


function wpml_lang_selector_submenu($languages,$wpml_style){
	
	$items = '';
	foreach($languages as $l){
				
				switch ($wpml_style) {

				case 1; //Flag + Native Name
					if(!$l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /> '.$l['native_name'].' </a></li>';         
					}
				break;
				
				
				case 2; //Flag + Translated Name
					if(!$l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /> '.$l['translated_name'].' </a></li>';         
					}
				break;
				
				
				
				case 4; //Flags (Dropdown Menu)
					if(!$l['active']){
						$items = $items.'<li class="menu-item langflag"><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a></li>';
					}
				break;
				
				
				case 5; //Native Name
					if(!$l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'">'.$l['native_name'].' </a></li>';         
					}
				break;
				
				case 6; //Translated Name
					if(!$l['active']){
						$items = $items.'<li class="menu-item"><a href="'.$l['url'].'">'.$l['translated_name'].' </a></li>';         
					}
				break;
		
				}
				
				
			}
			
		return $items;
			
	}


?>