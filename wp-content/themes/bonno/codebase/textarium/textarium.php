<?php
	/**
	 * Bonno text collections for post types and CPTs
	 * 
	 * @package Aisconverse
	 * @subpackage Bonno
	 * @since Bonno 1.0
	 */
	
	class textarium {
		private $post_type = null;
		private $fields = null;
		private $meta_box_name = null;

		public function __construct($post_type, $fields = null, $meta_box_name = 'Extra text data') {
			if ( is_admin() ) {
				$this->post_type = $post_type;
				$this->fields = $fields;
				$this->meta_box_name = $meta_box_name;
				add_action( 'admin_init', array( &$this, 'admin_init' ) );
				add_action( 'admin_init', array( &$this, 'enqueue_scripts' ) );
				add_action( 'save_post', array( &$this, 'save_meta_box_data' ) );
			}
		}

		public function admin_init() {
			if ( !$this->post_type || !$this->fields ) {
				return;
			}
			add_meta_box( 'bonno_textarium__create_metabox', $this->meta_box_name, array( $this, 'add_meta_box' ), $this->post_type, 'advanced', 'default' );
		}

		public function add_meta_box() {

			global $post;
			if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $post->post_type != $this->post_type ) {
				return $post->ID;
			}
			$meta = get_post_meta( $post->ID, '_textarium', true );
			require 'templates/meta_box.php';
		}

		public function save_meta_box_data() {
			global $post;
			if ( !( $post instanceof WP_Post ) ) {
				return;
			}
			if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || $post->post_type != $this->post_type ) {
				return $post->ID;
			}
			if ( empty( $_POST['_textarium'] ) ) {
				$_POST['_textarium'] = array();
			}
			update_post_meta($post->ID, "_textarium", $_POST["_textarium"]);
		}

		public function enqueue_scripts() {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-sortable' );
		}

	}