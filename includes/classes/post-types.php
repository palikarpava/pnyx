<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh

if ( ! class_exists( 'TP_Post_Types' ) ) :

	/**
	 * Post types Class
	 *
	 * @package TotalPoll/Classes/PostTypes
	 * @since   3.0.0
	 */
	class TP_Post_Types {

		/**
		 * Post types constructor.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'poll' ) );
			add_action( 'init', array( $this, 'tax' ) );
			add_action( 'init', array( $this, 'gathered_emails' ) );
			add_filter( 'post_updated_messages', array( $this, 'poll_messages' ) );
		}

        /**
         * Poll post type
         *
         * @since 3.0.0
         * @return void
         */
        public function poll() {
            global $wp_version;

            $labels = array(
                'name'               => __( 'Polls', TP_TD ),
                'singular_name'      => __( 'Poll', TP_TD ),
                'add_new'            => __( 'Add New', TP_TD ),
                'add_new_item'       => __( 'Add New Poll', TP_TD ),
                'edit_item'          => __( 'Edit Poll', TP_TD ),
                'new_item'           => __( 'New Poll', TP_TD ),
                'all_items'          => __( 'All Polls', TP_TD ),
                'view_item'          => __( 'View Poll', TP_TD ),
                'search_items'       => __( 'Search Polls', TP_TD ),
                'not_found'          => __( 'No polls found', TP_TD ),
                'not_found_in_trash' => __( 'No polls found in Trash', TP_TD ),
                'parent_item_colon'  => '',
                'menu_name'          => __( 'Polls', TP_TD ),
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => _x( 'poll', 'slug', TP_TD ) ),
                'capability_type'    => 'post',
                'has_archive'        => _x( 'polls', 'slug', TP_TD ),
                'menu_position'      => null,
                'hierarchical'       => false,
                'menu_icon'          => version_compare( $wp_version, '3.8', '>=' ) ? 'dashicons-chart-bar' : TP_URL . 'assets/images/fallback-icon.png',
                'supports'           => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'comments' ),
            );

            /**
             * Post type registration arguments.
             *
             * @param array $args Args.
             *
             * @since  3.0.0
             * @filter totalpoll/filters/post-type/args
             */
            register_post_type( 'poll', apply_filters( 'totalpoll/filters/post-type/args', $args ) );
        }


        public function gathered_emails() {

            $labels = array(
                'name' => _x('Gathered emails', 'post type general name', TP_TD),
                'singular_name' => _x('Email', 'post type singular name', TP_TD),
                'menu_name' => _x('Gathered emails', 'admin menu', TP_TD),
                'name_admin_bar' => _x('Gathered emails', 'add new on admin bar', TP_TD),
                'add_new' => _x('Add new', 'book', TP_TD),
                'add_new_item' => __('Add new email', TP_TD),
                'new_item' => __('New email', TP_TD),
                'edit_item' => __('Edit email', TP_TD),
                'view_item' => __('Show email', TP_TD),
                'all_items' => __('All emails', TP_TD),
                'search_items' => __('Search email', TP_TD),
                'not_found' => __('Email not found.', TP_TD),
                'not_found_in_trash' => __('Emails in trash not found', TP_TD)
            );

            $args = array(
                'labels' => $labels,
                'public' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'capability_type' => 'post',
                'has_archive' => false,
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title')
            );

            register_post_type('gathered_emails', $args);
        }

		public function tax() {
			global $wp_version;

			register_taxonomy( 'poll_category', 'poll', array(
				'hierarchical' => true,
				'query_var' => 'poll_category_name',
				'rewrite' => false,
				'public' => true,
				'publicly_queryable'    => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'capabilities' => array(
					'manage_terms' => 'manage_categories',
					'edit_terms'   => 'edit_categories',
					'delete_terms' => 'delete_categories',
					'assign_terms' => 'assign_categories',
				),
				'show_in_rest' => true,
				'rest_base' => 'poll_categories',
				'rest_controller_class' => 'WP_REST_Terms_Controller',
			) );
		}

		/**
		 * Back-office messages.
		 *
		 * @param $messages Messages
		 *
		 * @return mixed messages
		 */
		function poll_messages( $messages ) {
			global $post, $post_ID;

			$messages['poll'] = array(
				0  => '', // Unused. Messages start at index 1.
				1  => sprintf( __( 'Poll updated. <a href="%s">View poll</a>', TP_TD ), esc_url( get_permalink( $post_ID ) ) ),
				2  => __( 'Custom field updated.', TP_TD ),
				3  => __( 'Custom field deleted.', TP_TD ),
				4  => __( 'Poll updated.', TP_TD ),
				5  => isset( $_GET['revision'] ) ? sprintf( __( 'Poll restored to revision from %s', TP_TD ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				6  => sprintf( __( 'Poll published. <a href="%s">View poll</a>', TP_TD ), esc_url( get_permalink( $post_ID ) ) ),
				7  => __( 'Poll saved.', TP_TD ),
				8  => sprintf( __( 'Poll submitted. <a target="_blank" href="%s">Preview poll</a>', TP_TD ),
					esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
				9  => sprintf( __( 'Poll scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview poll</a>', TP_TD ),
					date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
				10 => sprintf( __( 'Poll draft updated. <a target="_blank" href="%s">Preview poll</a>', TP_TD ),
					esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			);

			return $messages;
		}

	}


endif;