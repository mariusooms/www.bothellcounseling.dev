<?php
if ( !class_exists( 'CPT_Tax_Link' ) ) {

	class CPT_Tax_Link {

		/**
		 * Post type and taxonomy links
		 *
		 * @var array
		 */
		private static $links = array();

		private $post_name = '';

		function __construct( $post_type, $taxonomy ) {

			if ( !post_type_exists( $post_type ) || !taxonomy_exists( $taxonomy ) ) {
				if ( WP_DEBUG ) {
					trigger_error( sprintf( __( 'Post type: %1$s or taxonomy %2$s is not registered.', 'arche' ), $post_type, $taxonomy ) );
				}
				return;
			}

			if ( in_array( $post_type, self::$links ) ) {
				if ( WP_DEBUG ) {
					trigger_error( sprintf( __( 'Post type: %1$s is already linked to %2$s. Each post type can only be linked to 1 taxonomy.', 'arche' ), $post_type, self::$links[$post_type] ) );
				}
				return;
			}

			self::$links[$post_type] = $taxonomy;

			add_action( 'pre_post_update', array( $this, 'get_post_name' ), 100 );
			add_action( 'save_post', array( $this, 'save_or_update' ), 100, 2 );
			add_action( 'untrashed_post', array( $this, 'save_or_update' ), 100 );
			add_action( 'deleted_post', array( $this, 'delete' ), 100 );
			add_action( 'trashed_post', array( $this, 'delete' ), 100 );
		}

		public function get_post_name( $post_id ) {
			$post = get_post( $post_id );

			$this->post_name = $post->post_name;
		}

		public function save_or_update( $post_id, $new_post ) {

			global $post;

			$post_name = empty( $post->post_name ) ? $new_post->post_name : $post->post_name;

			if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || isset( $_REQUEST['bulk_edit'] ) )
				return $post_id;

			if ( !isset( $new_post->post_type ) || !in_array( $new_post->post_type, array_keys( self::$links ) ) )
				return $post_id;

			$post_type_object = get_post_type_object( $new_post->post_type );

			if ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) )
				return $post_id;

			$term = get_term_by( 'slug', $post_name, self::$links[$new_post->post_type] );

			if ( 'publish' !== $new_post->post_status ) {
				if (! empty( $term ) ) {
					// delete term if post not published
					wp_delete_term( intval( $term->term_id ), self::$links[$new_post->post_type] );
				}
			} elseif ( !empty( $term ) ) {
				// update term
				wp_update_term( intval( $term->term_id ), self::$links[$new_post->post_type], array(
						'name' => $new_post->post_title,
						'slug' => $new_post->post_name
					) );
			} else {
				// insert term
				wp_insert_term( $new_post->post_title, self::$links[$new_post->post_type], array(
						'slug' => $new_post->post_name
					) );
			}

		}

		public function delete( $post_id ) {
			global $post;

			if ( !isset( $post->post_type ) || !in_array( $post->post_type, array_keys( self::$links ) ) )
				return $post_id;

			$post_type_object = get_post_type_object( $post->post_type );

			if ( ! current_user_can( $post_type_object->cap->delete_post, $post_id ) )
				return $post_id;

			$term = get_term_by( 'slug', $post->post_name, self::$links[$post->post_type] );

			if ( !empty( $term ) ) {
				// delete term
				wp_delete_term( intval( $term->term_id ), self::$links[$post->post_type] );
			}
		}

	}
}
