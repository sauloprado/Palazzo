<?php //Share Widget in Blog and Portfolio ?>


<div class="grid_12 alpha omega share-post mb50 mt50 clearfix">
	
    <div class="clearfix">
        <h3 class="col-title"><?php echo _option('share_title_' . get_post_type()); ?></h3>
        <span class="liner"></span>
    </div>

    <div class="btn-share"><a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a></div>
    <div class="btn-share"><div id="fb-root"></div><div class="fb-like" data-send="false" data-layout="box_count" data-show-faces="false"></div></div>
    <div class="btn-share"><script type="IN/Share" data-counter="top"></script></div>
    <div class="btn-share"><script data-counter="top" type="XING/Share"></script></div>
    <div class="btn-share"><g:plusone size="tall"></g:plusone></div>
    <div class="btn-share"><a class='DiggThisButton DiggMedium'></a></div>
    <div class="btn-share"><script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script></div>
</div><!-- close share post -->

<script type="text/javascript">	
	/* <![CDATA[ */
	
		// Twitter Share
		! function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0],
				p = /^http:/.test(d.location) ? 'http' : 'https';
			if (!d.getElementById(id)) {
				js = d.createElement(s);
				js.id = id;
				js.src = p + '://platform.twitter.com/widgets.js';
				fjs.parentNode.insertBefore(js, fjs);
			}
		}(document, 'script', 'twitter-wjs');

		// Facebook Like
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=138798126277575";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		// Xing
		;(function (d, s) {
			var x = d.createElement(s),
			s = d.getElementsByTagName(s)[0];
			x.src = "https://www.xing-share.com/js/external/share.js";
			s.parentNode.insertBefore(x, s);
		})(document, "script");
	/* ]]> */
	</script>
	<script type="text/javascript" src="http://widgets.digg.com/buttons.js"></script>
	<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
	<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script>