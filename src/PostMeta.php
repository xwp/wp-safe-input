<?php

namespace XWP\SafeInput;

class PostMeta {

	/**
	 * Post ID that is currently being saved.
	 *
	 * @var integer
	 */
	protected $post_id;

	/**
	 * Setup the post meta.
	 *
	 * @param integer $post_id Post ID being currently saved.
	 *
	 * @return void
	 */
	public function __construct( $post_id ) {
		$this->post_id = intval( $post_id );
	}

	/**
	 * Return the current post ID.
	 *
	 * @return integer
	 */
	public function post_id() {
		return $this->post_id;
	}

	/**
	 * Get the full post object.
	 *
	 * @return WP_Post|null
	 */
	public function post() {
		return get_post( $this->post_id );
	}

	/**
	 * Post is an autosave.
	 *
	 * @return boolean
	 */
	public function is_autosave() {
		return wp_is_post_autosave( $this->post_id );
	}

	/**
	 * Post is a revision.
	 *
	 * @return boolean
	 */
	public function is_revision() {
		return wp_is_post_revision( $this->post_id );
	}

	/**
	 * Check if the current user can edit the post.
	 *
	 * This will also return false during cron runs and WP-CLI.
	 *
	 * @return boolean
	 */
	public function user_can_edit() {
		return current_user_can( 'edit_post', $this->post_id );
	}

	/**
	 * Check if the current user can save the post.
	 *
	 * @return boolean
	 */
	public function can_save() {
		if ( ! $this->is_autosave() && ! $this->is_revision() && $this->user_can_edit() ) {
			return true;
		}

		return false;
	}

}
