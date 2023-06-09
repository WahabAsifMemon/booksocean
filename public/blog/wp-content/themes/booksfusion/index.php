<?php get_header(); ?>

	<!-- BEGIN MAIN CONTENT -->
		<main class="main-content">

		<!-- Blog Grid -->
		<div class="tc-padding">
			<div class="container">
				<div class="row">
					
					<!-- Content -->
					<div class="col-lg-9 col-md-8 col-xs-12">

						<!-- Grid Blog -->
						<div class="blog-grid">
							<div class="row">
								<?php if ( have_posts() ) : while( have_posts() ) : the_post() ?>
									<?php get_template_part( 'templates/content' ); ?>
								<?php endwhile ?>
								<?php else: ?>
									<?php get_template_part( 'templates/content-none' ); ?>
								<?php endif ?>
								
							</div>
						</div>
						<!-- Grid Blog -->
					</div>
					<!-- Content -->

					<!-- Aside -->
					<?php get_sidebar(); ?>
					<!-- Aside -->

				</div>
			</div>
		</div>
		<!-- Blog Grid -->

	</main>
	<!-- END MAIN CONTENT -->

	<!-- Footer -->
	<?php get_footer(); ?>