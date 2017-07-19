<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.wpmaniax.com
 * @since      1.0.0
 *
 * @package    Foosocial
 * @subpackage Foosocial/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Foosocial
 * @subpackage Foosocial/public
 * @author     WP Maniax <plugins@wpmaniax.com>
 */
class Foosocial_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    private $settings;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $default_settings = 'a:12:{s:26:"settings_networks_facebook";s:8:"facebook";s:25:"settings_networks_twitter";s:7:"twitter";s:28:"settings_networks_googleplus";s:10:"googleplus";s:26:"settings_networks_linkedin";s:8:"linkedin";s:24:"settings_networks_reddit";s:1:"0";s:24:"settings_networks_tumblr";s:1:"0";s:29:"settings_networks_stumbleupon";s:11:"stumbleupon";s:24:"settings_effects_slidein";s:1:"0";s:21:"settings_show_on_home";s:4:"home";s:22:"settings_show_on_pages";s:1:"0";s:22:"settings_show_on_posts";s:5:"posts";s:25:"settings_show_on_archives";s:1:"0";}';
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->settings = wpsf_get_settings( 'foosocial');
        if($this->settings == '') $this->settings = unserialize($default_settings);

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Foosocial_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Foosocial_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/foosocial-public.css', array(), $this->version, 'all');
        wp_enqueue_style( 'font-awesome', plugin_dir_url(__FILE__) . 'css/font-awesome.min.css' );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Foosocial_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Foosocial_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/foosocial-public.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'foosocial_settings', array(
                            'slidein' => $this->settings['settings_effects_slidein'],
                        ));


    }

    public function show_foosocial()
    {
        global $post;

        $settings = $this->settings;
        //echo "<pre>"; print_r($settings); echo "</pre>";
        $url = get_permalink($post->ID);
        $title = get_the_title($post->ID);
        $url = 'http://www.wpspeedster.com';
        $url = esc_url($url);

        $networks = array('facebook','twitter','google-plus','linkedin','reddit','tumblr','stumbleupon');
        $links = array('http://www.facebook.com/sharer.php?u=$url','https://twitter.com/share?url=$url','https://plus.google.com/share?url=$url','http://www.linkedin.com/shareArticle?url=$url','http://reddit.com/submit?url=$url&title=$title','http://www.tumblr.com/share/link?url=$url&name=$title','http://www.stumbleupon.com/submit?url=$url&title=$title');
        $active = 0;
        for($i=0;$i<count($networks);$i++) {
            if($settings['settings_networks_'.$networks[$i]] != '0') $active++;
        }
        if(is_home() && $settings['settings_show_on_home'] != 'home' ) return;
        if(is_page() && $settings['settings_show_on_pages'] != 'pages') return;
        if(is_single() && $settings['settings_show_on_posts']!= 'posts') return;
        if(is_archive() && $settings['settings_show_on_archives'] != 'archives') return;
        echo '<div id="foosocial-div" style="display: none">';
        for($i=0;$i<count($networks);$i++) {
            if($settings['settings_networks_'.$networks[$i]] != '0') {
               $url_new = str_replace('$url',$url,$links[$i]);
               $url_new = str_replace('$title',$title,$url_new);
               echo '<a href="'.$url_new.'" target="_blank" style="width:'.round(100/$active,5).'%" class="foosocial-button foosocial-'.$networks[$i].'"><i class="fa fa-'.$networks[$i].' fa-1"></i>';
            }
        }
        ?>
        </div>
        <?php
    }
}
