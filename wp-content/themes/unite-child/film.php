<?php
/*
*Template name: Films
*/
get_header();

$args = array('post_type' => 'films','posts_per_page' => -1, 'order' => 'DESC');
$query = new WP_Query( $args );

if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
$post_id = get_the_ID();

$film_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full');
?>
<div class="col-md-4 col-sm-4 col-xs-12 flim-block">
<div class="flim-img">
<img src="<?php echo $film_image_url[0]; ?>" alt="<?php the_title(); ?>">
</div>
<div class="flim-info">
<h3><?php the_title(); ?></h3>
<?php do_action( 'show_films', $post_id ); ?>	
<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Read More</a>
</div>
</div>
<?php 
endwhile; 			
wp_reset_postdata();
endif;

get_footer();