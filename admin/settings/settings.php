<?php
/**
 * WordPress Settings Framework
 *
 * @author Gilbert Pellegrom, James Kemp
 * @link https://github.com/gilbitron/WordPress-Settings-Framework
 * @license MIT
 */

/**
 * Define your settings
 *
 * The first parameter of this filter should be wpsf_register_settings_[options_group],
 * in this case "my_example_settings".
 *
 * Your "options_group" is the second param you use when running new WordPressSettingsFramework()
 * from your init function. It's importnant as it differentiates your options from others.
 *
 * To use the tabbed example, simply change the second param in the filter below to 'wpsf_tabbed_settings'
 * and check out the tabbed settings function on line 156.
 */

add_filter('wpsf_register_settings_foosocial', 'foosocial_settings');

/**
 * Tabless example
 */
function foosocial_settings($wpsf_settings)
{

    // General Settings section
    $wpsf_settings[] = array(
        'section_id' => 'settings',
        'section_title' => 'Settings',
        'section_description' => '',
        'section_order' => 5,
        'fields' => array(

            /*array(
                'id' => 'theme',
                'title' => 'Select Theme',
                'desc' => '',
                'type' => 'radio',
                'std' => array(
                    'after',
                ),
                'choices' => array(
                    'theme1' => '<img src="https://avatars3.githubusercontent.com/u/1853915?v=3&s=40">',
                    'theme2' => '<img src="https://avatars3.githubusercontent.com/u/1853915?v=3&s=40">',
                )
            ),*/

            array(
                'id' => 'networks',
                'title' => 'Select Networks',
                'desc' => 'Please select social networks.',
                'type' => 'checkboxes',
                'std' => array(
                    'facebook',
                    'twitter',
                    'googleplus',
                    'linkedin',
                    'stumbleupon'
                ),
                'choices' => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'googleplus' => 'GooglePlus',
                    'linkedin' => 'LinkedIn',
                    'reddit' => 'Reddit',
                    'tumblr' => 'Tumblr',
                    'stumbleupon' => 'StumbleUpon'
                )
            ),

            array(
                'id' => 'effects',
                'title' => 'Effects',
                'desc' => '',
                'type' => 'checkboxes',
                'std' => array(
                ),
                'choices' => array(
                    'slidein' => 'Use Slide-In',
                    //'after' => 'After Content',
                )
            ),

            array(
                'id' => 'show_on',
                'title' => 'Show On',
                'desc' => 'Please chose where to show the share buttons',
                'type' => 'checkboxes',
                'std' => array(
                    'home',
                    'posts'
                ),
                'choices' => array(
                    'home' => 'Home Page',
                    'pages' => 'Pages',
                    'posts' => 'Posts',
                    'archives' => 'Archives',
                )
            )
        )
    );

    return $wpsf_settings;
}
