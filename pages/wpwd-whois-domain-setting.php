<?php
global $wpdb;
//sanitize all post values
$whois_setting_submit= sanitize_text_field( $_POST['whois_setting_submit'] );
$color_pic= sanitize_text_field( $_POST['color_pic'] );
$result_color_pic= sanitize_text_field( $_POST['result_color_pic'] );
$result_color_text= sanitize_text_field( $_POST['result_color_text'] );
$saved= sanitize_text_field( $_POST['saved'] );

if($whois_setting_submit!='') { 
    if(isset($color_pic) ) {
		update_option('color_pic', $color_pic);
    }
    if(isset($result_color_pic) ) {
		update_option('result_color_pic', $result_color_pic);
    }
    if(isset($result_color_text) ) {
		update_option('result_color_text', $result_color_text);
    }
	if($saved==true) {
		$message='saved';
	} 
}
?>
  <?php
        if ( $message == 'saved' ) {
		echo ' <div class="added-success"><p><strong>Settings Saved.</strong></p></div>';
		}
   ?>
   
<div class="wrap netgo-whois-post-setting">
    <form method="post" id="whoisSettingForm" action="">
	<h2><?php _e('Whois Domain Setting','');?></h2>
		<table class="form-table">
			<tr valign="top">
				<th scope="row" style="width: 370px;">
					<label for="color_pic"><?php _e('Background Color','');?></label>
				</th>
				<td>
				<input name="color_pic" type="text" value="<?php echo get_option('color_pic'); ?>" class="wp-color-picker-field" data-default-color="#ffffff" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" style="width: 370px;">
					<label for="color_pic"><?php _e('Result Background Color','');?></label>
				</th>
				<td>
				<input name="result_color_pic" type="text" value="<?php echo get_option('result_color_pic'); ?>" class="wp-color-picker-field" data-default-color="#ffffff" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" style="width: 370px;">
					<label for="color_pic"><?php _e('Result Text Color','');?></label>
				</th>
				<td>
				<input name="result_color_text" type="text" value="<?php echo get_option('result_color_text'); ?>" class="wp-color-picker-field" data-default-color="#ffffff" />
				</td>
			</tr>
		</table>
		
        <p class="submit">
		<input type="hidden" name="saved" value="saved"/>
        <input type="submit" name="whois_setting_submit" class="button-primary" value="Save Changes" />
		  <?php if(function_exists('wp_nonce_field')) wp_nonce_field('whois_setting_submit', 'whois_setting_submit'); ?>
        </p>
    </form>
</div>

