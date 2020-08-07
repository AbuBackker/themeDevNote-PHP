/*====================================================================================================================
Index
====================================================================================================================*/

style.css -> 39

Get Link Another Pages -> 55

Uses of the Specific Post -> 69

Navigation Menu -> 97

Data Validation -> 133

Search -> 141

Mandatory index.php & single.php -> 151

Different Layouts for Different Pages -> 178

Child Page Menu (Parent & Subpages) -> 202

Featured Image -> 248

Post Formats -> 281

Widget -> 318

WP_Query -> 346

Customize (Color Picker) -> 379

About the Author & Category -> 442

Pagination -> 482

/*=============================================================
style.css
===============================================================*/

// Mandatory Part
/*
Theme Name: Practice Theme
Theme URI: https://starter-theme.test
Author: Tawhidul Islam & Abu Backker
Author URI: https://johndone.me
Description: This is starter WordPress theme
Version: 1.1.0
License: GNU General Public License v2 or later
Text Domain: starter-theme
*/

/*=============================================================
Get Link Another Pages
===============================================================*/

// Displays Header.php & Footer.php
<?php get_header(); ?>
<?php get_footer(); ?>

// Displays Sidebar.php
<?php get_sidebar(); ?>

// Displays ContentFline.php
<?php get_template_part('folder-name/file-name(1st part)', '2nd-part'); ?>

/*=============================================================
Uses of the Specific Post
===============================================================*/

// Title
<?php the_title(); ?>

// Content & It's style many ways
<?php the_content(); ?>
<?php the_content(Continue Reading &raquo); ?>
<?php echo wp_trim_words(get_the_content(), 40, '...') ?>
<?php the_excerpt(); ?>

// Date Or Time
<?php the_date(); ?>
<?php the_time('F j, Y g:i a'); ?>

// Author
<?php the_author(); ?>
<a href="<?php get_author_posts_url(); ?>"><?php the_author(); ?></a>

// Link
<a href="<?php the_permalink(); ?>"></a>

// Thumbnail
<?php the_post_thumbnail(); ?>
<?php the_post_thumbnail('post_thumbnail', ['class'=> 'img-fluid']); ?>

/*=============================================================
Navigation Menu
===============================================================*/

// Set Link Page (With Example)
<?php echo site_url('')?>
<li><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>

// Step : 01
function register_my_menu() {
register_nav_menu('primary-menu',__( 'Primary Menu' ));
}

add_action( 'init', 'register_my_menu' );

// Step : 02
Create Pages for Menu (WordPress)

// Step : 03
Create Menu & Add to Menu

// Step : 04
Where You Want Menu

<?php
    wp_nav_menu([
      	'theme_location' => 'primary-menu',
      	'container' => 'div',
      	'container_class' => 'navbar-collapse collapse align-left',
      	'menu_class' => 'nav navbar-menu'
      	'depth' => '3'
      	'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback'
      	'walker' => new WP_Bootstrap_Navwalker()
    ]);
?>

/*=============================================================
Data Validation
===============================================================*/

<?php echo esc_html__('Search Result For :', 'domain-name'); ?>
//or
<?php esc_html_e('Search Result For :', 'domain-name'); ?>

/*=============================================================
Search
===============================================================*/

<?php echo get_search_query(); ?>
OR
<?php the_search_query(); ?>

<?php get_search_form();?>

/*=============================================================
Mandatory index.php & single.php
===============================================================*/

// Simple Blog Structure
<?php
   if (have_posts()) :  
     while ( have_posts() ) : the_post();
?>

<h2 id="<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>" <?php the_title(); ?>"><?php the_title(); ?></a>
</h2>

<p class="date-author"><?php the_date(); ?> by <?php the_author(); ?></p>

<?php the_content(); ?>

<?php
   endwhile;
   else :
?>
<p>Sorry no posts matched your criteria.</p>
<?php
endif;
?>

/*=============================================================
Different Layouts for Different Pages
===============================================================*/

// Conditional Logic

<?php if(is_page(portfolio)) {?>
Thounk you for viewing our work
<?php }?>

// Template File with Matching Name (Slug or ID)

create page > page-name: page-portfolio.php

// Very Specific Theme Files to Very Specific Pages Based Under Name or ID

- So we create a template that could be used multipale pages
- Create file (use any kind of name) but used comment. For e.g.
<?php 
   /*
   Template Name: Special Layout
   */
   ?>

/*=============================================================
Child Page Menu (Parent & Subpages)
===============================================================*/

1.
<?php $args = array(
	 'child_of' => get_top_ancestor_ID(),
	 'title_li' => ''
   );
?>

<?php wp_list_pages( $args ); ?>

// For No 1
function get_top_ancestor_ID(){
global $post;

if($post->post_parent){
$ancestors = array_reverse(get_top_ancestors($post->ID));
return $ancestors[0];
}

return $post->ID;
}

// Does page have children
<?php if(has_children() OR $post->post_parent > 0) ?>

function has_children(){
global $post;

if($post->post_parent){
$pages = get_pages('child_of' => $post->ID);
return count($pages);
}
}

2.
//Conect with Parent page
<?php
   $theParent = wp_get_post_parent(get_the_ID());
   if($theParent){ ?>

<?php } ?>


/*=============================================================
Featured Image
===============================================================*/

// Output image in theme and control aspect ratio of image
<?php
function add_featured_image(){

   // Add featured image support
   add_theme_support('post-thumbnails');

   // Set the image size by resizing the image proportionally (without distorting it):
   add_image_size( 'custom-size', 220, 180 );

  // Set the image size by cropping the image (not showing part of it):
  add_image_size( 'small-thumbnail', 220, 180, true );
  
  // Set the image size by cropping the image and defining a crop position:
    // x_crop_position accepts ‘left’ ‘center’, or ‘right’.
    // y_crop_position accepts ‘top’, ‘center’, or ‘bottom’.
  add_image_size( 'single-page', 220, 220, array( 'left', 'top' ) );
}

add_action('after_setup_theme', 'add_featured_image');
?>

<a href="<?php get_author_posts_url(); ?>"><?php the_post_thumbnail(small-thumbnail); ?></a>

// Conditional Logic for CSS class
<?php if(has_post_thumbnail) { ?>
use-css-class
<?php } ?>

/*=============================================================
Post Formats
===============================================================*/

// 9 Kinds of Post Formats
-aside
-gallery
-link
-image
-quote
-status
-video
-audio
-chat

// Post Formats is a Theme Feature
-Enable Post Formats
-Craft Different Presentations

// Setup 1
<?php
function add_post_formats(){

   // Add post format support
   add_theme_support('post-formats', array('aside','gallery','link'));

}

add_action('after_setup_theme', 'add_post_formats');
?>

// Setup 2
get_template_part('template-parts/content', get_post_format()) ;

// Setup 3
create page > content-aside.php

/*=============================================================
Widgets
===============================================================*/

// Step 01
<?php 
function st_widgets_register(){
  register_sidebar([
    'name' => 'Sidebar',
    'id' => 'sidebar1',
    'before_widget' => '<div class="p-4 mb-3 rounded">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="font-italic">',
    'after_title' => '</h4>'
  ]);
}

add_action('widgets_init', 'st_widgets_register');
?>

//Step 02
<?php dynamic_sidebar('sidebar1'); ?>

// Others
<?php if ( is_active_sidebar( 'sidebar1' ) ) { ?>
<?php dynamic_sidebar( 'sidebar1' ); ?>
<?php } ?>

/*=============================================================
WP_Query
===============================================================*/

// Step 01
<?php 
function wp_query_learining(){
  register_post_type('id-name', array(
           'labels' => array(
                        'name' => 'name-the-title'
                    ),
           'public' => true,
           'supports' => array('title', 'editor', 'thumbnail')
      ));
}

add_action('after_setup_theme', 'wp_query_learining')
?>

// Step 02
<?php 
  $post= new WP_Query(array(
        'post_type' => 'id-name',
        'posts_per_page' => -1
    ));

  if($post->have_posts()): 
    while($post->have_posts()): $post->the_post();

    endwhile ;
  endif;
?>

/*=============================================================
Customize (Color Picker)
===============================================================*/

<?php
function mytheme_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here

      $wp_customize->add_setting( 'header_textcolor' , array(
          'default'   => '#000000',
          'transport' => 'refresh',
         ) );

      $wp_customize->add_section( 'mytheme_new_section_name' , array(
         'title'      => __( 'Standard Color', 'mythemename' ),
         'priority'   => 30,
        ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
         'label'      => __( 'Link Color', 'mythemename' ),
         'section'    => 'your_section_id',
         'settings'   => 'your_setting_id',
        ) ) );
}

add_action( 'customize_register', 'mytheme_customize_register' );


function mytheme_customize_css()
{
    ?>
<style type="text/css">
color: <?php echo get_theme_mod('add_setting_name');
?>
</style>
<?php
}
add_action( 'wp_head', 'mytheme_customize_css');

?>

// Classes

// Creates a control that allows users to enter plain text. This is also the parent class for the classes that follow.
WP_Customize_Control()

// Creates a control that allows users to select a color from a color wheel.
WP_Customize_Color_Control()

// Creates a control that allows users to upload media.
WP_Customize_Upload_Control()

// Creates a control that allows users to select or upload an image.
WP_Customize_Image_Control()
WP_Customize_Cropped_Image_Control
[<img src="<?php echo wp_get_attachment_url( get_theme_mod('add_setting_name')) ?>">]

// Creates a control that allows users to select a new background image.
WP_Customize_Background_Image_Control()

// Creates a control that allows users to select a new header image.
WP_Customize_Header_Image_Control()

/*=============================================================
About the Author & Category
===============================================================*/

// Example :
<?php
$otherAuthorPosts = new WP_Query(array(
      'author' => 'get_the_author_meta('ID')'
      'pages_per_page' => '3'
      'posts__not_in' => array(get_the_ID())
));
?>

<?php echo get_avatar(get_the_author_meta('ID', 512)) ?> //For Image
<?php echo get_the_author_meta('nickname') ?>

<h4>About the Author</h4>
<?php wpautop(echo get_the_author_meta('description')) ?>

<?php if($otherAuthorPosts->have_posts()): { ?>

Other posted by <?php echo get_the_author_meta('nickname') ?>

<ul>
    <?php while($otherAuthorPosts->have_posts()): $otherAuthorPosts->the_post(); { ?>

    <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

    <?php } ?>
</ul>
<?php } wp_reset_postdata() ?>

<?php if( count_user_posts(get_the_author_meta('ID')) > 3 ) { ?>

<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
    View all posts by <?php echo get_the_author_meta('nickname') ?>
</a>

<?php } ?>

// Category
<?php 
$categories = get_the_category();
$separator  = ",";
$output     = '';

if($categories){
    foreach($categories as $category){

        $output = '<a href=" ' . get_category_link($category->trim_id) .' ">' . $category->cat_name . '</a>' . $separator;
    }
    echo $output;
}
?>

// Archive
<?php
				if(is_category()){
					single_cat_title();
				} elseif (is_tag()) {
					single_tag_title();
				} elseif (is_author()) {
				    the_author();
			   } elseif(is_day()){
				   the_date();
			   } elseif(is_month()){
				the_date('F Y');
			   } elseif(is_year()){
				the_date('Y');
			   } else {
				   echo 'Archives:';
			   }

				?>

/*=============================================================
Pagination
===============================================================*/

previous_posts_link();
next_posts_link();
echo paginate_links();