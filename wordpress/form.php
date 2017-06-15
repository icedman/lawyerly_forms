<style>
/* legal */
@page {
    size: 8.5in 13in;
    margin-top: 1.2in;
    margin-left:1.5in;
    margin-right:1.0in;
    margin-bottom:1.0in;
}
* {
    font-family:Times;
    font-size:14pt;
}
</style>
<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', false);

/** Loads the WordPress Environment and Template */
// require( dirname( __FILE__ ) . '/wp-blog-header.php' );
require_once( dirname(__FILE__) . '/wp-load.php' );

ob_start();
wp([ 'p' => $_REQUEST['p'] ]);
the_title( '<h1 class="entry-title">', '</h1>' );
the_post();
the_content();
$content = ob_get_clean();

echo $content;