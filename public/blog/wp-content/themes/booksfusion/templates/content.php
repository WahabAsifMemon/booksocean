<div <?php post_class( 'col-lg-4 col-md-6 col-xs-6 r-full-width' ); ?>>
	<div class="grid-blog">
		<div class="grid-blog-img">
			<?php if ( has_post_thumbnail() && !post_password_required() ): ?>
                <?php the_post_thumbnail(); ?>
            <?php else: ?>
                <h2>No image found!</h2>
            <?php endif ?>
		</div>
		<div class="product-detail blog-detail">
			<span class="date"><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></span>
			<?php if (is_single()) : ?>
                <h5><?php the_title();  ?></h5>
            <?php else: ?>
                <h5><a href="<?php echo the_permalink(); ?>"><?php the_title();  ?></a></h5>
            <?php endif ?>
			
			<?php if ( is_search() ) : ?>
                <p><?php the_excerpt(); ?></p>
            <?php else: ?>
                <p><?php the_excerpt(); ?></p>
            <?php endif ?>

			<div class="aurthor-detail">
				<span><img src="/assets/images/book-aurthor/img-01.jpg" alt=""><?php the_author() ?></span>
			</div>
		</div>
	</div>
</div>