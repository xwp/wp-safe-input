<?php

namespace XWP\SafeInputDemo;

/**
 * Our custom admin setting.
 */
class AwesomeSetting {
	protected $post_id;
	protected $meta_key;

	public function __construct( $post_id, $meta_key ) {
		$this->post_id = $post_id;
		$this->meta_key = $meta_key;
	}

	public function get() {
		return ( '1' === get_post_meta( $this->post_id, $this->meta_key, true ) );
	}

	public function set() {
		return update_post_meta( $this->post_id, $this->meta_key, 1 );
	}

	public function delete() {
		return delete_post_meta( $this->post_id, $this->meta_key );
	}
}
