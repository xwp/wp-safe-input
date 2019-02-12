# Safe Input Library for WordPress

A helper library for validating and sanitizing form input data.


## Setup

Use [Composer](https://getcomposer.org) to add [this library](https://packagist.org/packages/xwp/wp-safe-input) to your project:

```bash
composer require xwp/wp-safe-input
```


## Usage

```php
use XWP\SafeInput\PostMeta;
use XWP\SafeInput\Request;

class AwesomeAdminSetting {
    const NONCE_ACTION = 'our-nonce-action';
    const INPUT_NAME = 'our-input-field-name';
    const META_KEY = 'our-meta-key';

    public function is_selected( $input ) {
        return ( 'yes' === $input );
    }

    public function save_post( $post_id ) {
        $request = new Request( INPUT_GET );
        $meta = new PostMeta( $post_id );

        if ( $request->verify_nonce( self::NONCE_ACTION ) && $meta->can_save() ) {
            if ( $this->is_selected( $request->param( self::INPUT_NAME ) ) ) {
                update_post_meta( $post_id, self::META_KEY, 1 );
            } else {
                delete_post_meta( $post_id, self::META_KEY );
            }
        }
    }
}

// Now use the
$admin_setting = new AwesomeAdminSetting();
add_action( 'save_post', [ $admin_setting, 'save_post' ] );
```
