<?php
/**
 * @package Legal Forms Plugin
 * @version 1.0
 */
/*
Plugin Name: Legal Forms Plugin
Plugin URI: 
Description: 
Author: 
Version: 1.0
Author URI: 
*/

require_once 'lf-forms/Parsedown.php';

class LegalFormsPlugin
{
	private static $_instance;
	private $data = [];
	private $parsedown;

	public function __construct()
	{
		LegalFormsPlugin::$_instance = $this;
		$this->parsedown = new Parsedown();
	}

	public function sc_scilicet($atts = [], $content = null, $tag = '') {
		ob_start();
		print_r($atts);
		echo "# Republic of the Philippines\n";
		echo $content. '..' . $tag;
		return $this->parsedown->text(ob_get_clean());
	}

	public function sc_parties($atts = [], $content = null, $tag = '') {
		$this->data = array_merge($atts);
		return 'parties';
	}

	public function sc_data($atts = [], $content = null, $tag = '') {
		$this->data = array_merge($atts);
		return '';
	}

	public function content($content) {
		
		return $this->parsedown->text(strip_tags($content));
	}

	public static function getInstance() {
		if (LegalFormsPlugin::$_instance)
			return LegalFormsPlugin::$_instance;
		new LegalFormsPlugin();
		return LegalFormsPlugin::$_instance;
	}
}

// This just echoes the chosen line, we'll position it later
function lf_shortcode($atts = [], $content = null, $tag = '') {
	$lf = LegalFormsPlugin::getInstance();
	$func = str_replace('lf_','sc_', $tag);
	return $lf->$func($atts, $content, $tag);
}

function lf_content($content) {
	$lf = LegalFormsPlugin::getInstance();
	return $lf->content($content);
}

add_shortcode('lf_init', 'lf_shortcode');
add_shortcode('lf_scilicet', 'lf_shortcode');
add_shortcode('lf_parties', 'lf_shortcode');
add_filter('the_content', 'lf_content');

?>
