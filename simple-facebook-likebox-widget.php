<?php
/*
Plugin Name: Simple Facebook Like Box Widget
Plugin URI:  https://github.com/jeffersoncarrenho/simple-facebook-likebox-widget
Description: Simple Facebook Like Box Widget
Version:     -2
Author:      Jefferson Lima
Author URI:  https://github.com/jeffersoncarrenho
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
*/

class SimpleFacebookLikeBoxWidget extends WP_Widget{
	function __construct(){
		$params = array(
			'description' => __('Simple Widget Facebook Like Box','simple-facebook-like-box'),
			'name' => __('Simple Facebook Like Box Widget','simple-facebook-like-box')
		);
		parent::__construct('SimpleFacebookLikeBoxWidget', '', $params);
	}

	function form($instance){
		extract($instance);
		?>
			<p>
				<label><?php echo __('Widget Title', 'simple-facebook-like-box'); ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('title');?>" id="<?php echo $this->get_field_id('title');?>" value="<?php if(isset($title)) echo esc_attr($title); ?>">
			</p>
			<p>
				<label><?php echo __('Page Name', 'simple-facebook-like-box'); ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('page_name');?>" id="<?php echo $this->get_field_id('page_name');?>" value="<?php if(isset($page_name)) echo esc_attr($page_name); ?>">
			</p>
			<p>
				<label><?php echo __('Page ID', 'simple-facebook-like-box'); ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('page');?>" id="<?php echo $this->get_field_id('page');?>" value="<?php if(isset($title)) echo esc_attr($page); ?>">
			</p>
			<p>
				<label>datatabs (ex: timeline, messages, events)</label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('datatabs');?>" id="<?php echo $this->get_field_id('datatabs');?>" value="<?php if(isset($datatabs)) echo esc_attr($datatabs); ?>">
			</p>
			
			<div style="text-align:right;">
				<p>
					<label><?php echo __('Width (px)','simple-facebook-like-box'); ?></label>
					<input type="text" name="<?php echo $this->get_field_name('width');?>" id="<?php echo $this->get_field_id('width');?>" value="<?php if(isset($width)) echo esc_attr($width); ?>">
				</p>	
				<p>				
					<label><?php echo __('Height (px)','simple-facebook-like-box'); ?></label>
					<input type="text" name="<?php echo $this->get_field_name('height');?>" id="<?php echo $this->get_field_id('height');?>" value="<?php if(isset($height)) echo esc_attr($height); ?>">
				</p>	
				<p>
					<label>data-small-header</label>
					<select name="<?php echo $this->get_field_name('data_small_header'); ?>" id="<?php echo $this->get_field_id('data_small_header'); ?>">
						<?php
							if (isset($data_small_header)){
								if ($data_small_header === 'true') {
									echo '<option value="'. $data_small_header .'">'. $data_small_header .'</option>';
									echo '<option value="false">false</option>';
								}elseif($data_small_header === 'false'){
									echo '<option value="'. $data_small_header .'">'. $data_small_header .'</option>';
									echo '<option value="true">true</option>';
								}
							}else{
								echo '<option value="true">true</option>';
								echo '<option value="false">false</option>';
							}
						?>		
					</select>
				</p>
				<p>
					<label>data-adapt-container-width</label>
					<select name="<?php echo $this->get_field_name('adapt_container_width'); ?>" id="<?php echo $this->get_field_id('adapt_container_width'); ?>">
						<?php
							if (isset($adapt_container_width)){
								if ($adapt_container_width === 'true') {
									echo '<option value="'. $adapt_container_width .'">'. $adapt_container_width .'</option>';
									echo '<option value="false">false</option>';
								}elseif($adapt_container_width === 'false'){
									echo '<option value="'. $adapt_container_width .'">'. $adapt_container_width .'</option>';
									echo '<option value="true">true</option>';
								}
							}else{
								echo '<option value="true">true</option>';
								echo '<option value="false">false</option>';
							}
						?>
					</select>
				</p>
				<p>
					<label>data-hide-cover</label>
					<select name="<?php echo $this->get_field_name('data_hide_cover'); ?>" id="<?php echo $this->get_field_id('data_hide_cover'); ?>">
						<?php
							if (isset($data_hide_cover)){
								if ($data_hide_cover === 'true') {
									echo '<option value="'. $data_hide_cover .'">'. $data_hide_cover .'</option>';
									echo '<option value="false">false</option>';
								}elseif($data_hide_cover === 'false'){
									echo '<option value="'. $data_hide_cover .'">'. $data_hide_cover .'</option>';
									echo '<option value="true">true</option>';
								}
							}else{
								echo '<option value="true">true</option>';
								echo '<option value="false">false</option>';
							}
						?>
					</select>
				</p>

				<p>
					<label>data-show-facepile</label>
					<select name="<?php echo $this->get_field_name('data_show_facepile'); ?>" id="<?php echo $this->get_field_id('data_show_facepile'); ?>">
						<?php
							if (isset($data_show_facepile)){
								if ($data_show_facepile === 'true') {
									echo '<option value="'. $data_show_facepile .'">'. $data_show_facepile .'</option>';
									echo '<option value="false">false</option>';
								}elseif($data_show_facepile === 'false'){
									echo '<option value="'. $data_show_facepile .'">'. $data_show_facepile .'</option>';
									echo '<option value="true">true</option>';
								}
							}else{
								echo '<option value="true">true</option>';
								echo '<option value="false">false</option>';
							}
						?>
					</select>
				</p>
			</div>			
		<?php
	}
	function widget($args, $instance){
		extract($instance);
		extract($args);

		if (empty($title)) $title = 'Facebook';
		if (empty($page_name)) $page_name = 'Facebook';
		if (empty($page)) $page = 'facebook';
		if (empty($width)) $width = '200';
		if (empty($height)) $height = '200';
		

		echo $before_widget;
		echo $before_title.$title.$after_title;
		?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div class="fb-page" 
			data-href="https://www.facebook.com/<?php echo $page; ?>" 
			data-tabs="<?php echo $datatabs; ?>"
			data-width="<?php echo $width; ?>" 
			data-height="<?php echo $height; ?>"
			data-small-header="<?php echo $data_small_header; ?>" 
			data-adapt-container-width="<?php echo $data_adapt_container_width; ?>" 
			data-hide-cover="<?php echo $data_hide_cover; ?>" 
			data-show-facepile="<?php echo $data_show_facepile; ?>">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="https://www.facebook.com/<?php echo $page; ?>">
					<a href="https://www.facebook.com/<?php echo $page; ?>"><?php echo $page_name; ?></a>
				</blockquote>
			</div>
		</div>
		<?php
		echo $after_widget;

	}
}

function flbw_register(){
	register_widget('SimpleFacebookLikeBoxWidget');	
}

add_action('widgets_init', 'flbw_register');