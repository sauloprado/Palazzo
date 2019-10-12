<?php 

/*
 * Countdown Timer
 *
 * Theme: Official
 * Author: ThemeTor
 * Website: http://themetor.com
 */


$countdown_id = 'cd_' . rand();
global $thdglkr_cd_date;
global $thdglkr_cd_size;
global $thdglkr_cd_align;

wp_enqueue_script('jquery.countdown', get_template_directory_uri() . '/js/countdown.js');

?>
	
	<script language="javascript">
	
		jQuery(document).ready(function($) {
			
			// Countdown Timer /////////////////////////////
			try {
				$("#<?php echo $countdown_id ; ?>").countdown({
				date: "<?php echo $thdglkr_cd_date; ?>",
				format: "on"
				});
			} catch(e){}
		});	
	</script>

	
    <ul id="<?php echo $countdown_id ; ?>" class="countdown cd_<?php echo $thdglkr_cd_size; ?> cd_<?php echo $thdglkr_cd_align; ?> clearfix">
        <li>
            <span class="days">00</span>
            <p class="timeRefDays">days</p>
        </li>
        <li>
            <span class="hours">00</span>
            <p class="timeRefHours">hours</p>
        </li>
        <li>
            <span class="minutes">00</span>
            <p class="timeRefMinutes">min</p>
        </li>
        <li>
            <span class="seconds">00</span>
            <p class="timeRefSeconds">sec</p>
        </li>
    </ul> <!-- end timer -->