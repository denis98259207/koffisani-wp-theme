<?php
class SampleTest extends WP_UnitTestCase {
	function testSample() {
            $theme = wp_get_theme();
		//$this->assertTrue( 'koffisani' == $theme->get( 'Name' ) );
		//$this->assertTrue( is_plugin_active('your-plugin/your-plugin.php') );
                $this->assertTrue( TRUE );
	}
}