<?php

// Add Meta Box
function custom_meta_box_markup( $post ) {   
    /* Heading */
    $company_name = get_post_meta( $post->ID, 'company_name', true );
	$post_name = get_post_meta( $post->ID, 'post_name', true );
	$education = get_post_meta( $post->ID, 'education', true );
	$total_post = get_post_meta( $post->ID, 'total_post', true );
	$location = get_post_meta( $post->ID, 'location', true );
	$last_date = get_post_meta( $post->ID, 'last_date', true );
    ?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="txtcompanyName">Company Name</label></th>
				<td><input name="txtcompanyName" type="text" id="txtcompanyName" placeholder="Enter Company Name" value="<?php echo $company_name; ?>" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="txtpostName">Post Name</label></th>
				<td><input name="txtpostName" type="text" id="txtpostName" placeholder="Enter Post Name" value="<?php echo $post_name; ?>" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="txtEducation">Education</label></th>
				<td><input name="txtEducation" type="text" id="txtEducation" placeholder="Enter Education" value="<?php echo $education; ?>" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="txtTotalPost">Total Post</label></th>
				<td><input name="txtTotalPost" type="text" id="txtTotalPost" placeholder="Enter Total Post" value="<?php echo $total_post; ?>" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="txtLocation">Location</label></th>
				<td><input name="txtLocation" type="text" id="txtLocation" placeholder="Enter Location" value="<?php echo $location; ?>" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="txtLastdate">Last Date</label></th>
				<td><input name="txtLastdate" type="text" id="txtLastdate" placeholder="Enter Last Date" value="<?php echo $last_date; ?>" class="regular-text"></td>
			</tr>
		</tbody>
	</table>
    <?php
}

function add_custom_meta_box()
{   
    add_meta_box("table_meta_in_post", "Table Meta Content", "custom_meta_box_markup", "post", "advanced", "high", null);
}

function wporg_save_postdata( $post_id ) {
	if ( array_key_exists( 'txtcompanyName', $_POST ) ) {
		update_post_meta(
			$post_id,
			'company_name',
			$_POST['txtcompanyName']
		);
	}
	if ( array_key_exists( 'txtpostName', $_POST ) ) {
		update_post_meta(
			$post_id,
			'post_name',
			$_POST['txtpostName']
		);
	}
	if ( array_key_exists( 'txtEducation', $_POST ) ) {
		update_post_meta(
			$post_id,
			'education',
			$_POST['txtEducation']
		);
	}
	if ( array_key_exists( 'txtTotalPost', $_POST ) ) {
		update_post_meta(
			$post_id,
			'total_post',
			$_POST['txtTotalPost']
		);
	}
	if ( array_key_exists( 'txtLocation', $_POST ) ) {
		update_post_meta(
			$post_id,
			'location',
			$_POST['txtLocation']
		);
	}
	if ( array_key_exists( 'txtLastdate', $_POST ) ) {
		update_post_meta(
			$post_id,
			'last_date',
			$_POST['txtLastdate']
		);
	}
}