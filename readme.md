# Safe Input Library for WordPress

A helper library for validating and sanitizing form input data.


## Setup

Use [Composer](https://getcomposer.org) to add [this library](https://packagist.org/packages/xwp/wp-safe-input) to your project:

```bash
composer require xwp/wp-safe-input
```


## Usage

Assuming that our custom setting and input are defined as a following objects:

```php
/**
 * Our custom admin setting object.
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

class AwesomeSettingInput {
    protected $input;

    public function __construct( $input ) {
        $this->input = $input;
    }

    public function is_selected() {
        return ( 'yes' === $this->input );
    }
}
```

we can use the library to prepare and validate the input data:

```php
use XWP\SafeInput\PostMeta;
use XWP\SafeInput\Request;

add_action( 'save_post', function ( $post_id ) {
    $request = new Request( INPUT_GET );
    $meta = new PostMeta( $post_id );

    $setting_input = new AwesomeSettingInput(
        $request->param( 'awesome-input-field-name' )
    );

    if ( $request->verify_nonce( 'awesome-nonce-action' ) && $meta->can_save() ) {
        $setting = new AwesomeSetting( $post_id, 'awesome-meta-key' );

        if ( $setting_input->is_selected() ) {
            $setting->set();
        } else {
            $setting->delete();
        }
    }
} );
```

Notice how everything related to the form input processing is separate from how the data is defined and stored.
