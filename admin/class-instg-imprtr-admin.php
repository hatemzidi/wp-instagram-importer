<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://wpinstagram.hatemzidi.com
 * @since      1.0.0
 *
 * @package    instg_imprtr
 * @subpackage instg_imprtr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    instg_imprtr
 * @subpackage instg_imprtr/admin
 * @author     Hatem ZIDI <hatem.zidi@gmail.com>
 */
class instg_imprtr_Admin {

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

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version     = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in instg_imprtr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The instg_imprtr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/instg-imprtr-admin.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in instg_imprtr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The instg_imprtr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/instg-imprtr-admin.js', array( 'jquery' ), $this->version, false );

    }

    /**
     * Handles any POSTs made by the plugin. Run using the 'init' action.
     */
    function action_handle_posts() {
        if ( isset( $_POST['wpinstimp_save'] ) ) {
            if ( ! current_user_can( 'manage_options' ) ) {
                die( __( 'You are not allowed to run the importer....', 'wp-inst-imp' ) );
            }
            check_admin_referer( "wpinst_saved" );

            $param               = array();
            $param['userid']     = $_POST['wpinstimp_userid'];
            $param['clientid']   = $_POST['wpinstimp_clientid'];
            $param['count']      = $_POST['wpinstimp_posts_count'];
            $param['category']   = $_POST['wpinstimp_category'];
            $param['author']     = $_POST['wpinstimp_author'];
            $param['isFeatured'] = $_POST['wpinstimp_featured'];
            $param['content']    = $_POST['wpinstimp_content'];

            // user entered empty userid, clientid
            if ( empty( $param['userid'] ) || empty( $param['clientid'] ) || empty( $param['count'] ) ) {
                wp_redirect( "options-general.php?page=" . $this->plugin_name . "-manage_options&errid=10" );

                return;
            }

            // The user entered something that wasn't a number.
            if ( ! is_numeric( $param['count'] ) ) {
                wp_redirect( "options-general.php?page=" . $this->plugin_name . "-manage_options&errid=11&st=" . urlencode( $param['count'] ) );

                return;
            } else if ( $param['count'] <= 0 ) {
                wp_redirect( "options-general.php?page=" . $this->plugin_name . "-manage_options&errid=11&st=" . urlencode( $param['count'] ) );

                return;
            }

            //add_schedule($name, $count, $display);
            wp_redirect( "options-general.php?page=" . $this->plugin_name . "-manage_options&errid=3" );

            //update options
            update_option( $this->plugin_name . '-settings-params', $param );
        }

    }

    /**
     * Adds options & management pages to the admin menu.
     *
     * Run using the 'admin_menu' action.
     *
     * @since    1.0.0
     */
    function action_admin_menu() {

        // add_options_page( $page_title, $menu_title, $capability, $menu_slug, $callback );
        add_options_page(
            apply_filters( $this->plugin_name . '-settings-page-title', __( 'WP Instagram Importer Settings', 'wp-inst-imp' ) ),
            apply_filters( $this->plugin_name . '-settings-menu-title', __( 'WP Instagram Importer', 'wp-inst-imp' ) ),
            'manage_options',
            $this->plugin_name . '-manage_options',
            array( $this, 'admin_options_page' )
        );

    }


    /**
     * Displays the options page for the plugin.
     */
    function admin_options_page() {
        if ( isset( $_GET['errid'] ) ) {
            $messages = array(
                '2'  => __( 'Successfully deleted the cron schedule %s', 'wp-inst-imp' ),
                '3'  => __( 'Successfully configured WP Instagram Importer', 'wp-inst-imp' ),
                '10' => __( 'Oops! Some empty fields.', 'wp-inst-imp' ),
                '11' => __( 'Oops! Number of posts can not be : %s', 'wp-inst-imp' )
            );
            $msg      = sprintf( $messages[ $_GET['errid'] ], '<strong>' . esc_html( stripslashes( $_GET['st'] ) ) . '</strong>' );

            echo '<div id="message" class="' . ( $_GET['errid'] < 10 ? 'updated' : 'error' ) . ' fade"><p>' . $msg . '</p></div>';
        }

        include_once( dirname( __FILE__ ) . '/partials/instg-imprtr-admin-display.php' );
    }

    // todo : refactor this
    function slug_exists( $post_name ) {
        global $wpdb;
        if ( $wpdb->get_row( "SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A' ) ):
            return true;
        else:
            return false;
        endif;
    }


    function set_featured_image( $post_id, $filename, $title ) {

        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents( $filename );
        $filename   = basename( $filename );
        if ( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }
        file_put_contents( $file, $image_data );

        $wp_filetype = wp_check_filetype( $filename, null );
        $attachment  = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $title ),
            'post_content'   => '',
            'post_author'    => 1,
            'post_status'    => 'inherit'
        );
        $attach_id   = wp_insert_attachment( $attachment, $file, $post_id );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        set_post_thumbnail( $post_id, $attach_id );
    }

    /**
     * fetch posts from instagram
     */
    function custom_posts_from_instagram() {
        $params = get_option( $this->plugin_name . '-settings-params', array() );

        $client_id = $params['clientid']; // '7bb2aa2b9c3b4e679a6e9119034f55d1';
        $user_id   = $params['userid']; //'8188639';
        $count = $params['count']; //4;
        $category = $params['category']; //6;
        $author = $params['author']; // 1;
        $content = $params['content']; // 1;

        // Get photos from Instagram
        $url = 'https://api.instagram.com/v1/users/' . $user_id . '/media/recent/?client_id=' . $client_id . "&count=" . $count;

        $args = stream_context_create( array(
            'http' => array(
                'timeout' => 2500
            )
        ) );

        $json_feed = file_get_contents( $url, false, $args );

        $json_feed = json_decode( $json_feed );

        // Import each photo as post

        foreach ( $json_feed->data as $post ) {
            if ( ! $this->slug_exists( $post->id ) ) {
                $new_post = wp_insert_post( array(
                    'post_content'  => !empty($content) ? $content : 'from <a href="' . esc_url( $post->link ) . '" target="_blank">Instagram</a> ...',  //todo add shortcut
                    'post_date'     => date( "Y-m-d H:i:s", $post->created_time ),
                    'post_date_gmt' => date( "Y-m-d H:i:s", $post->created_time ),
                    'post_status'   => 'publish',
                    'post_title'    => $post->caption->text,
                    'post_name'     => $post->id,
                    'post_author'   => $author,
                    'post_category' => array(
                        $category
                    )
                ), true );

                // set format
                $tag      = 'post-format-image';
                $taxonomy = 'post_format';
                wp_set_post_terms( $new_post, $tag, $taxonomy );

                // set featured image
                if ( ! empty( $params['isFeatured'] ) ) {
                    $this->set_featured_image( $new_post, esc_url( $post->images->standard_resolution->url ), $post->caption->text );
                }
            }
        }
    }

}
