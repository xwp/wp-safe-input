<?php

namespace XWP\SafeInput;

class Request {

	/**
	 * Request type: INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, or INPUT_ENV.
	 *
	 * @see http://php.net/manual/en/function.filter-input.php
	 *
	 * @var integer
	 */
	protected $type;

	/**
	 * Setup the request.
	 *
	 * @param integer $type Input request type.
	 */
	public function __construct( $type = INPUT_GET ) {
		$this->type = $type;
	}

	/**
	 * Get the current request type.
	 *
	 * @return integer
	 */
	public function type() {
		return $this->type;
	}

	/**
	 * Get a sanitized request parameter.
	 *
	 * Uses FILTER_SANITIZE_STRING as the default sanitizer.
	 *
	 * @see http://php.net/manual/en/function.filter-input.php
	 *
	 * @param  string $name     Parameter name.
	 * @param  integer $filters Input filters.
	 * @param  mixed  $options  Associative array of options or bitwise disjunction of flags.
	 *
	 * @return mixed
	 */
	public function param( $name, $filters = FILTER_SANITIZE_STRING, $options = [] ) {
		return filter_input( $this->type, $name, $filters );
	}

	/**
	 * Verify a nonce for the current request.
	 *
	 * @param  string $action Nonce action name.
	 * @param  string $name   Input field name.
	 *
	 * @return boolean
	 */
	public function verify_nonce( $action, $name = '_wpnonce' ) {
		return wp_verify_nonce( $this->param( $name ), $action );
	}

}
