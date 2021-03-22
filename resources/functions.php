<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);


    class WPSE_299521_Form {

        /**
         * Class constructor
         */
        public function __construct() {
    
            $this->define_hooks();
        }
    
        public function controller() {
    
            if( isset( $_POST['submit'] ) ) { // Submit button
    
                $full_name   = filter_input( INPUT_POST, 'full_name', FILTER_SANITIZE_STRING );
                $email       = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING | FILTER_SANITIZE_EMAIL );
                $color       = filter_input( INPUT_POST, 'color', FILTER_SANITIZE_STRING );
                $accessories = filter_input( INPUT_POST, 'accessories', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY );
                $comments    = filter_input( INPUT_POST, 'comments', FILTER_SANITIZE_STRING );
    
                // Send an email and redirect user to "Thank you" page.
            }
        }
    
        /**
         * Display form
         */
        public function display_form() {
    
            $full_name   = filter_input( INPUT_POST, 'full_name', FILTER_SANITIZE_STRING );
            $email       = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING | FILTER_SANITIZE_EMAIL );
            $color       = filter_input( INPUT_POST, 'color', FILTER_SANITIZE_STRING );
            $accessories = filter_input( INPUT_POST, 'accessories', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY );
            $comments    = filter_input( INPUT_POST, 'comments', FILTER_SANITIZE_STRING );
    
            // Default empty array
            $accessories = ( $accessories === null ) ? array() : $accessories;
    
            $output = '';
    
            $output .= '<form method="post">';
            $output .= '    <p>';
            $output .= '        ' . $this->display_text( 'full_name', 'Name', $full_name );
            $output .= '    </p>';
            $output .= '    <p>';
            $output .= '        ' . $this->display_text( 'email', 'Email', $email );
            $output .= '    </p>';
            $output .= '    <p>';
            $output .= '        ' . $this->display_radios( 'color', 'Color', $this->get_available_colors(), $color );
            $output .= '    </p>';
            $output .= '    <p>';
            $output .= '        ' . $this->display_checkboxes( 'accessories', 'Accessories', $this->get_available_accessories(), $accessories );
            $output .= '    </p>';
            $output .= '    <p>';
            $output .= '        ' . $this->display_textarea( 'comments', 'comments', $comments );
            $output .= '    </p>';
            $output .= '    <p>';
            $output .= '        <input type="submit" name="submit" value="Submit" />';
            $output .= '    </p>';
            $output .= '</form>';
    
            return $output;
        }
    
        /**
         * Display text field
         */
        private function display_text( $name, $label, $value = '' ) {
    
            $output = '';
    
            $output .= '<label>' . esc_html__( $label, 'wpse_299521' ) . '</label>';
            $output .= '<input type="text" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '">';
    
            return $output;
        }
    
        /**
         * Display textarea field
         */
        private function display_textarea( $name, $label, $value = '' ) {
    
            $output = '';
    
            $output .= '<label> ' . esc_html__( $label, 'wpse_299521' ) . '</label>';
            $output .= '<textarea name="' . esc_attr( $name ) . '" >' . esc_html( $value ) . '</textarea>';
    
            return $output;
        }
    
        /**
         * Display radios field
         */
        private function display_radios( $name, $label, $options, $value = null ) {
    
            $output = '';
    
            $output .= '<label>' . esc_html__( $label, 'wpse_299521' ) . '</label>';
    
            foreach ( $options as $option_value => $option_label ):
                $output .= $this->display_radio( $name, $option_label, $option_value, $value );
            endforeach;
    
            return $output;
        }
    
        /**
         * Display single checkbox field
         */
        private function display_radio( $name, $label, $option_value, $value = null ) {
    
            $output = '';
    
            $checked = ( $option_value === $value ) ? ' checked' : '';
    
            $output .= '<label>';
            $output .= '    <input type="radio" name="' . esc_attr( $name ) . '" value="' . esc_attr( $option_value ) . '"' . esc_attr( $checked ) . '>';
            $output .= '    ' . esc_html__( $label, 'wpse_299521' );
            $output .= '</label>';
    
            return $output;
        }
    
        /**
         * Display checkboxes field
         */
        private function display_checkboxes( $name, $label, $options, $values = array() ) {
    
            $output = '';
    
            $name .= '[]';
    
            $output .= '<label>' . esc_html__( $label, 'wpse_299521' ) . '</label>';
    
            foreach ( $options as $option_value => $option_label ):
                $output .= $this->display_checkbox( $name, $option_label, $option_value, $values );
            endforeach;
    
            return $output;
        }
    
        /**
         * Display single checkbox field
         */
        private function display_checkbox( $name, $label, $available_value, $values = array() ) {
    
            $output = '';
    
            $checked = ( in_array($available_value, $values) ) ? ' checked' : '';
    
            $output .= '<label>';
            $output .= '    <input type="checkbox" name="' . esc_attr( $name ) . '" value="' . esc_attr( $available_value ) . '"' . esc_attr( $checked ) . '>';
            $output .= '    ' . esc_html__( $label, 'wpse_299521' );
            $output .= '</label>';
    
            return $output;
        }
    
        /**
         * Get available colors
         */
        private function get_available_colors() {
    
            return array(
                'red' => 'Red',
                'blue' => 'Blue',
                'green' => 'Green',
            );
        }
    
        /**
         * Get available accessories
         */
        private function get_available_accessories() {
    
            return array(
                'case' => 'Case',
                'tempered_glass' => 'Tempered glass',
                'headphones' => 'Headphones',
            );
        }
    
        /**
         * Define hooks related to plugin
         */
        private function define_hooks() {
    
            /**
             * Add action to send email
             */
            add_action( 'wp', array( $this, 'controller' ) );
    
            /**
             * Add shortcode to display form
             */
            add_shortcode( 'contact', array( $this, 'display_form' ) );
        }
    }
    
    new WPSE_299521_Form();

//     // Change dashboard Posts to News
// function cp_change_post_object() {
//     $get_post_type = get_post_type_object('post');
//     $labels = $get_post_type->labels;
//         $labels->name = 'News';
//         // $labels->singular_name = 'News';
//         // $labels->add_new = 'Add News';
//         // $labels->add_new_item = 'Add News';
//         // $labels->edit_item = 'Edit News';
//         // $labels->new_item = 'News';
//         // $labels->view_item = 'View News';
//         // $labels->search_items = 'Search News';
//         // $labels->not_found = 'No News found';
//         // $labels->not_found_in_trash = 'No News found in Trash';
//         // $labels->all_items = 'All ';
//         $labels->menu_name = 'News';
//         $labels->name_admin_bar = 'News';
// }
