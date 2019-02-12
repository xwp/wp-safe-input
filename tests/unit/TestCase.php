<?php

namespace XWP\SafeInput\Tests;

use WP_Mock;
use WP_Mock\Tools;

/**
 * Our base test case.
 */
class TestCase extends Tools\TestCase {

	/**
	 * Runs before tests.
	 */
	public function setUp() {
		WP_Mock::setUp();
	}

	/**
	 * Runs after tests.
	 */
	public function tearDown() {
		WP_Mock::tearDown();
	}

}
