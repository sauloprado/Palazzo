<?php if (_option('filtering')==1): ?>
    <div class="row clearfix mb">
        <div class="filterable <?php echo _option('filter_style','st1')?> <?php echo _option('filter_align','tal')?>">
        <?php	$portfolio_types = get_terms('portfolio_types');
                if($portfolio_types): ?>
                    <ul class="filter">
                        <li class="all current"><a href="#" data-filter="*" class="active"><?php _e('All', 'official'); ?></a></li>	
                        <?php foreach($portfolio_types as $portfolio_type): ?>
                            
                                <li class="<?php echo $portfolio_type->slug; ?>"><a href="#" ><?php echo $portfolio_type->name; ?></a></li>
        
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
        </div> 
    </div>        
<?php endif; ?>