<?php 

global $woo_title_type;
$is_woo = false;

if ($woo_title_type !=''){
	$title_bar = $woo_title_type;
	$is_woo = true;
	}else{
	$title_bar = get_post_meta( get_the_ID(), 'official_title', true );
	}


global $thdglkr_is_blog;
if($thdglkr_is_blog){$title_bar='cpmb_title';}



	switch ($title_bar) {
		
		case 'cpmb_no';
			//Nothing to do 
		break;
		
		
		case '':
		case 'cpmb_title':
		case 'cpmb_title_center':
		
		if (!$is_woo){
			$darktext = rwmb_meta('official_breadcrumbs_dark');
		}else{
			$darktext = _option('woo_dark_text',0);	
		}
		$darkclass = '';
		if ($darktext){$darkclass = ' dark';}
		
			?>
            
            <div class="breadcrumb-place <?php echo $darkclass; if ($title_bar=='cpmb_title_center'){echo ' centerstyle tac';}?>">
                <div class="row clearfix">
                    <h1 class="page-title"><?php get_template_part('functions/title-h1'); ?></h1>
                </div><!-- row -->
            </div><!-- breadcrumb -->
                    
            
            <?php
			
			if (!$is_woo){
			$breadcrumbs_bg = rwmb_meta('official_breadcrumbs');
			}else{
				$breadcrumbs_bg = _option('woo_breadcrumbs_bg_img','');
			}
			if ($breadcrumbs_bg!=''){
				?>
                <style >.breadcrumb-place{background-image:url(<?php if (!$is_woo){echo wp_get_attachment_url($breadcrumbs_bg);}else{echo $breadcrumbs_bg; } ?>);}</style>
                <?php
			}
			
		break;
		
		
		
		case 'cpmb_breadcrumbs':
		case 'cpmb_breadcrumbs_center':
		
		if (!$is_woo){
			$darktext = rwmb_meta('official_breadcrumbs_dark');
		}else{
			$darktext = _option('woo_dark_text',0);	
		}
		$darkclass = '';
		if ($darktext){$darkclass = ' dark';}
		
		?>
		
			<div class="breadcrumb-place<?php echo $darkclass; if ($title_bar=='cpmb_breadcrumbs_center'){echo ' centerstyle centerbread tac';}?>">
                <div class="row clearfix">
                    <h1 class="page-title"><?php get_template_part('functions/title-h1'); ?></h1>
                    <?php if (function_exists('official_breadcrumbs')){ official_breadcrumbs();} ?>
                </div><!-- row -->
            </div><!-- breadcrumb -->
		
		
		<?php
		
		if (!$is_woo){
			$breadcrumbs_bg = rwmb_meta('official_breadcrumbs');
		}else{
			$breadcrumbs_bg = _option('woo_breadcrumbs_bg_img','');
		}
		if ($breadcrumbs_bg!=''){
				?>
                <style >.breadcrumb-place{background-image:url(<?php if (!$is_woo){echo wp_get_attachment_url($breadcrumbs_bg);}else{echo $breadcrumbs_bg; } ?>);}</style>
                <?php
			}
		break;
		
		
		
		case 'cpmb_image';
		
			if(has_post_thumbnail()){
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fullwidth');
				?>
                <!-- Titlebar Image -->   
                    	<div class="image_titlebar">
                        	<img class="titlebar" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /> 
                        </div>             
               <?php 
              
			}

		break;
		
		
		case 'cpmb_nivo';
			get_template_part('functions/slider-nivoslider');
		break;
		
		
		case 'cpmb_flex';
			get_template_part('functions/slider-flexslider');
		break;
		
		
		case 'cpmb_kwick';
			get_template_part('functions/slider-kwicks');
		break;
		
		
		case 'cpmb_3dslice';
			get_template_part('functions/slider-3dslice');
		break;
		
		
		case 'cpmb_roundabout';
			get_template_part('functions/slider-roundabout');
		break;
		
		
		case 'cpmb_liteaccordion';
			get_template_part('functions/slider-liteaccordion');
		break;
		
		
		default: 
			
			//Revolution Slider
			?>
			<!-- SLIDER -->   
            <div class="revwrap">
            
				<?php 
						
					if ( function_exists( 'putRevSlider' ) ) {
						putRevSlider($title_bar);
					}
			
				?> 	

            </div>
            <!-- End SLIDER --> 
            
            
        <?php
			

		break;

		
	}

?>