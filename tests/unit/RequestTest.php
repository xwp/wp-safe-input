<?php

namespace XWP\SafeInput\Tests;

use XWP\SafeInput\Request;

class RequestTest extends TestCase {

	/**
	 * Test library setup.
	 *
	 * @covers XWP\SafeInput\Request::__construct
	 * @covers XWP\SafeInput\Request::type
	 */
	public function test_is_setup() {
		$request = new Request( INPUT_GET );

		$this->assertEquals(
			INPUT_GET,
			$request->type(),
			'Sets up correct request type.'
		);
	}

}
