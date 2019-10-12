<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
    <!-- Content -->
    <div class="row clearfix">	
            <?php the_content(); ?>
    </div>
    <!-- End: content -->

<?php endwhile; endif; ?>