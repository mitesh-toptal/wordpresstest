<?php
// load parent stylesheet first if this is a child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
// Hooking up our function to theme setup
add_action( 'init', 'cpt_films_init' );
// Films custom post type function
function cpt_films_init() {
	// Set UI labels for Custom Post Type
	$labels = array(
		'name'               => _x( 'Films', 'post type general name', 'unite-child' ),
		'singular_name'      => _x( 'Film', 'post type singular name', 'unite-child' ),
		'menu_name'          => _x( 'Films', 'admin menu', 'unite-child' ),
		'name_admin_bar'     => _x( 'Film', 'add new on admin bar', 'unite-child' ),
		'add_new'            => _x( 'Add New', 'film', 'unite-child' ),
		'add_new_item'       => __( 'Add New Film', 'unite-child' ),
		'new_item'           => __( 'New Film', 'unite-child' ),
		'edit_item'          => __( 'Edit Film', 'unite-child' ),
		'view_item'          => __( 'View Film', 'unite-child' ),
		'all_items'          => __( 'All Films', 'unite-child' ),
		'search_items'       => __( 'Search Films', 'unite-child' ),
		'parent_item_colon'  => __( 'Parent Films:', 'unite-child' ),
		'not_found'          => __( 'No films found.', 'unite-child' ),
		'not_found_in_trash' => __( 'No films found in Trash.', 'unite-child' )
	);
	// Set other options for Custom Post Type
	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'unite-child' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'films' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	// Registering film Custom Post Type
	register_post_type( 'films', $args );
}
// create four taxonomies, genres,country,year and actor for the post type "films"
function unite_register_taxonomies() {	
		$taxonomies = array(
			array(
				'slug'         => 'genre',
				'single_name'  => 'Genre',
				'plural_name'  => 'Genres',
				'post_type'    => 'films',
				'rewrite'      => array( 'slug' => 'genre' ),
			),
			array(
				'slug'         => 'country',
				'single_name'  => 'Country',
				'plural_name'  => 'Countries',
				'post_type'    => 'films',
				'hierarchical' => true,
				'rewrite'      => array( 'slug' => 'country' ),
			),
			array(
				'slug'         => 'year',
				'single_name'  => 'Year',
				'plural_name'  => 'Years',
				'post_type'    => 'films',
				'hierarchical' => true,
				'rewrite'      => array( 'slug' => 'year' ),
			),
			array(
				'slug'         => 'actor',
				'single_name'  => 'Actor',
				'plural_name'  => 'Actors',
				'post_type'    => 'films',
				'hierarchical' => true,
				'rewrite'      => array( 'slug' => 'actor' )
			),
		);
		foreach( $taxonomies as $taxonomy ) {
			$labels = array(
				'name' => $taxonomy['plural_name'],
				'singular_name' => $taxonomy['single_name'],
				'search_items' =>  'Search ' . $taxonomy['plural_name'],
				'all_items' => 'All ' . $taxonomy['plural_name'],
				'parent_item' => 'Parent ' . $taxonomy['single_name'],
				'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
				'edit_item' => 'Edit ' . $taxonomy['single_name'],
				'update_item' => 'Update ' . $taxonomy['single_name'],
				'add_new_item' => 'Add New ' . $taxonomy['single_name'],
				'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
				'menu_name' => $taxonomy['plural_name']
			);
			
			$rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
			$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;
		
			register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
				'hierarchical' => $hierarchical,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => $rewrite,
			));
		}
	}
// hook into the init action and call create_films_taxonomies when it fires
add_action( 'init', 'unite_register_taxonomies' );

// Function to add recent films shortcode to widget, posts and pages
function recent_films_function($atts){
   extract(shortcode_atts(array(
      'posts' => 5,
	  'order' => 'DESC'  
   ), $atts));
   ob_start();	
   ?>
   <div class="row">
   <div class="widget film-widget">
   <div class="tab-content">
   <?php
   $return_string = '<ul id="popular-posts" class="tab-pane active">';
   $args = array('post_type' => 'films','posts_per_page' => $posts, 'order' => $order);
   // Define our WP Query Parameters	
   $query = new WP_Query( $args );
   // Start our WP Query	
   if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
   	  $film_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full');	
	  $release_date = get_field('release_date');
	  $ticket_price = get_field('ticket_price');
	?>
	<li>
	<a href="<?php the_permalink(); ?>" class="tab-thumb" title="<?php the_title(); ?>">
	<img src="<?php echo $film_image_url[0]; ?>" class="attachment-tab-small size-tab-small wp-post-image" alt="<?php the_title(); ?>"></a>
	<div class="content">
	<a class="tab-entry" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	<i><?php echo $release_date; ?></i>
	</div>
	</li>
   <?php
   endwhile; 			
   wp_reset_postdata();
   endif;
   $return_string .= '</ul>';	
   ?>
   </div>
   </div>
   </div>
   <?php   
   // Return a string to display on the page	
   $myvariable = ob_get_clean();
   return $myvariable;
}
/* Register [recent-films] shortcodes */ 
function register_shortcodes(){
   add_shortcode('recent-films', 'recent_films_function');
}
add_action( 'init', 'register_shortcodes');

/* Define callback function */
function show_films_data( $post_id ,$country ) {
	$release_date = get_field('release_date',$post_id);
	$ticket_price = get_field('ticket_price',$post_id);
?>
<div class="country">Country : 	
<?php
$category = get_the_terms( $post_id, 'country' ); 
foreach ( $category as $cat){ echo $cat->name; }
?>
</div>
<div class="genre">Genre : 	
<?php
$category = get_the_terms( $post_id, 'genre' ); 
foreach ( $category as $cat){ echo $cat->name; }
?>
</div>
<?php if($ticket_price){ ?>	
<div class="ticket-price">Ticket price : <?php echo $ticket_price; ?></div>
<?php } ?>
<?php if($release_date){ ?>	
<div class="release-date">Release date : <?php echo $release_date; ?></div>
<?php } ?>
<div class="year">Year : 	
<?php
$category = get_the_terms( $post_id, 'year' ); 
foreach ( $category as $cat){ echo $cat->name; }
?>
</div>
<div class="actor">Actor : 	
<?php
$category = get_the_terms( $post_id, 'actor' ); 
foreach ( $category as $cat){ echo $cat->name; }
?>
</div>
<?php
}
add_action( 'show_films', 'show_films_data' );