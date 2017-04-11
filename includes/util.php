<?php
function find_wp_config_path () {
    $dir = dirname(__FILE__);
    do {
        if( file_exists( $dir . '/wp-config.php' ) ) {
            return $dir ;
        }
    } while ( $dir = realpath( "$dir/.." ) );
    
    return null;
}

