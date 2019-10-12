<?php 
	global $thdglkr_embed_code,$thdglkr_thumbnail_type,$thdglkr_permalink;
	$portfolio_to=get_post_meta( get_the_ID(), 'official_portfolio-to', true );
	$image = wp_get_attachment_url( get_post_thumbnail_id());
	
	// Set Thumbnail Zoom Effect on Hover 
	if (_option('zoom_effect',1)==1){
		$zoom_effect_class = 'zoom';
	}else{
		$zoom_effect_class = '';
	}


	if( $portfolio_to == "lightbox") { 
		if( get_post_meta( get_the_ID(), 'official_embed', true ) != "") {
				
				if ( get_post_meta( get_the_ID(), 'official_portfolio-video', true ) == 'youtube' ) {
					$thdglkr_link = '<a class="fLeft cntr" href="http://www.youtube.com/watch?v='.get_post_meta( get_the_ID(), 'official_embed', true ).'" data-gal="photo" title="'. get_the_title() .'"><span><i class="icon-youtube-play"></i></span></a>'; 
				} else if ( get_post_meta( get_the_ID(), 'official_portfolio-video', true ) == 'vimeo' ) {
					$thdglkr_link = '<a class="fLeft cntr" href="http://vimeo.com/'. get_post_meta( get_the_ID(), 'official_embed', true ) .'" data-gal="photo" title="'. get_the_title() .'"><span><i class="icon-facetime-video"></i></span></a>';
				} else if ( get_post_meta( get_the_ID(), 'official_portfolio-video', true ) == 'other' ) {
					$randomid = rand();
					$thdglkr_link = '<a class="fLeft cntr" href="#embeded-video-'.$randomid.'" title="'. get_the_title() .'" data-gal="photo"><span><i class="icon-facetime-video"></i></span></a>';
					$thdglkr_embed_code .= '<div id="embeded-video-'.$randomid.'" class="embeded-video"><p>'. get_post_meta( get_the_ID(), 'official_embed', true ) .'</p></div>';
				}
		} else {
	
			$thdglkr_link = '<a class="fLeft" href="'. get_permalink() .'" title="'. get_the_title() .'"><span><i class="icon-file-text"></i></span></a>';
			$thdglkr_link .='<a class="fRight" href="'. $image .'" data-gal="photo" title="'. get_the_title() .'"><span><i class="icon-zoom-in"></i></span></a>';
		}
		
	}elseif ($portfolio_to=='details'){

		$thdglkr_link = '<a  class="fLeft cntr" href="'. get_permalink() .'" title="'. get_the_title() .'"><span><i class="icon-file-text"></i></span></a>';
	
	}elseif($portfolio_to=='projecturl'){

		$projecturl = get_post_meta( get_the_ID(), 'official_portfolio-url', true );
		$thdglkr_link = '<a class="fLeft" href="'. $projecturl .'" title="'. get_the_title() .'" target="_blank"  ><span><i class="icon-link"></i></span></a>';
		$thdglkr_link .='<a class="fRight" href="'. $image .'" data-gal="photo" title="'. get_the_title() .'"><span><i class="icon-zoom-in"></i></span></a>';
	
	} else{

		$thdglkr_link='<a class="fLeft" href="'. $image .'" data-gal="photo" title="'. get_the_title() .'"><span><i class="icon-zoom-in"></i></span></a>
				  <a class="fRight" href="'. get_permalink() .'"><span><i class="icon-file-text"></i></span></a>';
	}


	$thdglkr_permalink = get_permalink();

?>


<div class="hover-fx <?php echo $zoom_effect_class;?>">
	<?php
	if ($thdglkr_thumbnail_type==''){$thdglkr_thumbnail_type='portfolio1';}
	the_post_thumbnail($thdglkr_thumbnail_type);
	 echo $thdglkr_link; 
	?>
</div>