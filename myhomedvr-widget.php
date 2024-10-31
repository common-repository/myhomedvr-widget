<?php
/*
Plugin Name: 
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 

/*  Copyright 2009 

	About the Wordpress widget implementation:
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
*/

function wp_widget_myhomedvr_tv($args) {
	extract($args);
	$options = get_option('widget_myhomedvr_tv');
	$title = $options['title'];
	if ( empty($title) )
		$title = 'MyHomeDVR';
?>
		<?php echo $before_widget; ?>
			<?php $title ? print($before_title . $title . $after_title) : null; ?>
	<?php echo $after_widget; ?>
<?php
}

function wp_widget_myhomedvr_tv_control() {
	$options = $newoptions = get_option('widget_myhomedvr_tv');
	if ( $_POST["myhomedvr-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["myhomedvr-title"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_myhomedvr_tv', $options);
	}
	$title = attribute_escape($options['title']);
?>
			<p><label for="myhomedvr-title"><?php _e('Title:'); ?> <input style="width: 200px;" id="myhomedvr-title" name="myhomedvr-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" id="myhomedvr-submit" name="myhomedvr-submit" value="1" />
<?php
}

function wp_widget_myhomedvr_tv_register() {
	$dimension = array('height' => 100, 'width' => 300);
	$class = array('classname' => 'widget_myhomedvr_tv');
	wp_register_sidebar_widget('myhomedvr', __('MyHomeDVR'), 'wp_widget_myhomedvr_tv', $class);
	wp_register_widget_control('myhomedvr', __('MyHomeDVR'), 'wp_widget_myhomedvr_tv_control', $dimension);
}

add_action('plugins_loaded','wp_widget_myhomedvr_tv_register');
?>