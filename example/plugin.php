<?php
/**
 * Plugin Name: WP Safe Input Demo
 */

namespace XWP\SafeInputDemo;

// Don't include the autoload if using a project-level autoload.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

$plugin = new AwesomeMetaBox();
$plugin->init_hooks();
