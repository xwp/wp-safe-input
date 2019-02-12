# Safe Input Library for WordPress

A helper library for validating and sanitizing form input data.


## Setup

Use [Composer](https://getcomposer.org) to add [this library](https://packagist.org/packages/xwp/wp-safe-input) to your project:

```bash
composer require xwp/wp-safe-input
```


## Usage

See the sample plugin in the [`example` directory](example).

The core logic looks like this:

```php
use XWP\SafeInput\PostMeta;
use XWP\SafeInput\Request;

add_action( 'save_post', function ( $post_id ) {
	$request = new Request( INPUT_POST );
	$meta = new PostMeta( $post_id );

	if ( $request->verify_nonce( 'nonce-action', 'nonce-input-name' ) && $meta->can_save() ) {
		if ( 'on' === $request->param( 'input-field-name' ) ) {
			// Update post meta value.
		} else {
			// Delete post meta value.
		}
	}
} );
```

TODO: Document what happens in the example above.
