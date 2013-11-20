<?php
/*
Template Name: Homepage Layout 1
*/
?>

<?php get_header(); ?>
			

					<?php

					$use_carousel = of_get_option('showhidden_slideroptions');
      				if ($use_carousel) {

					?>

					<div id="myCarousel" class="carousel slide">

					    <!-- Carousel items -->
					    <div class="carousel-inner">

					    	<?php
							global $post;
							$tmp_post = $post;
							$show_posts = of_get_option('slider_options');
							$args = array( 'numberposts' => $show_posts ); // set this to how many posts you want in the carousel
							$myposts = get_posts( $args );
							$post_num = 0;
							foreach( $myposts as $post ) :	setup_postdata($post);
								$post_num++;
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-carousel' );
							?>

						    <div class="<?php if($post_num == 1){ echo 'active'; } ?> item">
						    	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'wpbs-featured-carousel' ); ?></a>

							   	<div class="carousel-caption">

					                <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					                <p>
					                	<?php
					                		$excerpt_length = 100; // length of excerpt to show (in characters)
					                		$the_excerpt = get_the_excerpt(); 
					                		if($the_excerpt != ""){
					                			$the_excerpt = substr( $the_excerpt, 0, $excerpt_length );
					                			echo $the_excerpt . '... ';
					                	?>
					                	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="btn btn-primary">Read more &rsaquo;</a>
					                	<?php } ?>
					                </p>

				                </div>
						    </div>

						    <?php endforeach; ?>
							<?php $post = $tmp_post; ?>

					    </div>

					    <!-- Carousel nav -->
					    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				    </div>
					
					

				    <?php } // ends the if use carousel statement ?>
					
					
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span8 clearfix" role="main">					
					
					
					<?php $home_category = of_get_option('showhidden_slideroptions'); ?>
					<?php $get_home_post_number = of_get_option('get_home_post_number'); ?>
					<?php query_posts( array ( 'cat' => $home_category, 'posts_per_page' => $get_home_post_number ) ); ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					
						<header>

							<?php 
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' ); 
								// not sure why this isn't working yet
							?>
												
							<?php get_post_video(); ?>
							<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'wpbs-featured' ); ?></a>
							<?php } ?>
													
							
							
							<header>

								<div class="page-header"><h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></div>
							
								<p class="meta"><span><i class="icon-calendar"></i> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></span> <span><i class="icon-user"></i> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?></span> <span class="amp">&</span> <?php _e("filed under", "bonestheme"); ?> <?php the_category(', '); ?>.</p>							
							
							</header> <!-- end article header -->
							
															
							

						</header>
						
						<section class="row-fluid post_content">
						
							<div class="home_content">
						
								<?php the_excerpt(); ?>
								
								<a href="<?php the_permalink() ?>" class="read-more">Continue Reading &rarr;</a>
								
							</div>
						
													
						</section> <!-- end article header -->
						
						<footer>
			
						<?php if(has_tag()) { ?>
						<p class="clearfix"><i class="icon-tags"></i> <?php the_tags('<span class="tags">' . __("Tags","bonestheme") . ': ', ', ', '</span>'); ?></p>
						<?php  } ?>
						
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
					<?php endwhile; ?>	
					
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
							</ul>
						</nav>
					<?php } ?>					
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>