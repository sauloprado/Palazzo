<?php

	$font_text = _option('font_text');
	$font_menu = _option('font_menu');
	$font_h1 = _option('font_h1');
	$font_h2 = _option('font_h2');
	$font_h3 = _option('font_h3');
	$font_h4 = _option('font_h4');
	$font_h5 = _option('font_h5');
	$font_h6 = _option('font_h6');
	
$customfont = '';

$default = array(
				'arial',
				'verdana',
				'trebuchet',
				'georgia',
				'times',
				'tahoma',
				'helvetica');

$googlefonts = array(
				$font_text['face'],
				$font_menu['face'],
				$font_h1['face'],
				$font_h2['face'],
				$font_h3['face'],
				$font_h4['face'],
				$font_h5['face'],
				$font_h6['face']
				);
			
foreach($googlefonts as $getfonts) {
	
	if(!in_array($getfonts, $default)) {
			$customfont = str_replace(' ', '+', $getfonts). ':400,400italic,700,700italic|' . $customfont;
	}
}

if($customfont != ''){
	echo "<link href='http://fonts.googleapis.com/css?family=" . substr_replace($customfont ,"",-1) . "&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese' rel='stylesheet' type='text/css'>";
}
?>