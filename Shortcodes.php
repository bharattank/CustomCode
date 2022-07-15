<?php
/**
 * shortcode : CATEGORY_WISE_POST_TABLE
 * all product : [CATEGORY_WISE_POST_TABLE product_type="all" ids="4, 5, 6"]
 * Custom selected product : [CATEGORY_WISE_POST_TABLE post_type="custom_ids" ids="389843, 389837, 389831"]
 */
add_shortcode( 'CATEGORY_WISE_POST_TABLE', 'category_wise_post_table_function' );
if( !function_exists( 'category_wise_post_table_function' ) ) {
    function category_wise_post_table_function( $atts ) {
        $a = shortcode_atts( array(
            'post_type' => '',
            'ids' => '',
        ), $atts );
        $filter_value = $a['post_type'];
        switch ($filter_value) {
            case "all":
				$pid = $a['ids'];
                $cat_id = explode(', ', $pid);
                    ob_start();
                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page'  => 10,
						'cat'	=>	$cat_id,
						'order' => 'DESC'
                    );

                    $loop = new WP_Query( $args ); ?>
                    <div class="custom_post_table_main">
						<table class="custon_post_table">
							<thead>
								<tr>
									<th>Comapany</th>
									<th>Post Name</th>
									<th>Education</th>
									<th>Total Posts</th>
									<th>Location</th>
									<th>Last Date</th>
									<th>Apply Online</th>
								</tr>
							</thead>
							<?php
							while ( $loop->have_posts() ) : $loop->the_post();
							global $post;
							$company_name = get_post_meta( $post->ID, 'company_name', true );
							$post_name = get_post_meta( $post->ID, 'post_name', true );
							$education = get_post_meta( $post->ID, 'education', true );
							$total_post = get_post_meta( $post->ID, 'total_post', true );
							$location = get_post_meta( $post->ID, 'location', true );
							$last_date = get_post_meta( $post->ID, 'last_date', true );
							if( !empty($company_name) || !empty($post_name) || !empty($education) || !empty($total_post) || !empty($location) || !empty($last_date) ) { ?> 
							<tbody>
								<tr>
									<td><?php echo $company_name; ?></td>
									<td><?php echo $post_name; ?></td>
									<td><?php echo $education; ?></td>
									<td><?php echo $total_post; ?></td>
									<td><?php echo $location; ?></td>
									<td><?php echo $last_date; ?></td>
									<td class="apply-btn"><a href="<?php echo get_the_permalink($post->ID); ?>">Apply</a></td>
								</tr>
							</tbody>
							<?php } 
							endwhile; ?>
						</table>
                    </div>	
					<div class="custom_post_table_main mobile">
						<h4 class="custom_post_table_main_title">Latest Notifications</h4>
						<?php
						while ( $loop->have_posts() ) : $loop->the_post();
						global $post;
						$company_name = get_post_meta( $post->ID, 'company_name', true );
						$post_name = get_post_meta( $post->ID, 'post_name', true );
						$education = get_post_meta( $post->ID, 'education', true );
						$total_post = get_post_meta( $post->ID, 'total_post', true );
						$location = get_post_meta( $post->ID, 'location', true );
						$last_date = get_post_meta( $post->ID, 'last_date', true );
						if( !empty($company_name) || !empty($post_name) || !empty($education) || !empty($total_post) || !empty($location) || !empty($last_date) ) { ?> 
							<div class="custom_post_table_mobile_box">
								<h4 class="company__name"><?php echo $company_name; ?></h4>
								<p class="all_row"><strong>Post Name: </strong><?php echo $post_name; ?></p>
								<p class="all_row"><strong>Education: </strong><?php echo $education; ?></p>
								<p class="all_row"><strong>Total Posts: </strong><?php echo $total_post; ?></p>
								<p class="all_row"><strong>Location: </strong><?php echo $location; ?></p>
								<p class="all_row"><strong>Last Date: </strong><?php echo $last_date; ?></p>
								<div>
									<a href="<?php echo get_the_permalink($post->ID); ?>" class="apply_btn">Apply Online</a>
								</div>
							</div>
						<?php } 
						endwhile; ?>
                    </div>

                <?php $result = ob_get_clean();
                    return $result;
                break;
            case "custom_ids":
                $pid = $a['ids'];
                $post_id = explode(', ', $pid);
                ob_start();
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'post__in' => $post_id,
						'order' => 'DESC'
                    );
                    $loop = new WP_Query( $args ); ?>
					<div class="custom_post_table_main">
						<table class="custon_post_table">
							<thead>
								<tr>
									<th>Comapany</th>
									<th>Post Name</th>
									<th>Education</th>
									<th>Total Posts</th>
									<th>Location</th>
									<th>Last Date</th>
									<th>Apply Online</th>
								</tr>
							</thead>
							<?php
							while ( $loop->have_posts() ) : $loop->the_post();
							global $post;
							$company_name = get_post_meta( $post->ID, 'company_name', true );
							$post_name = get_post_meta( $post->ID, 'post_name', true );
							$education = get_post_meta( $post->ID, 'education', true );
							$total_post = get_post_meta( $post->ID, 'total_post', true );
							$location = get_post_meta( $post->ID, 'location', true );
							$last_date = get_post_meta( $post->ID, 'last_date', true );
							if( !empty($company_name) || !empty($post_name) || !empty($education) || !empty($total_post) || !empty($location) || !empty($last_date) ) { ?> 
							<tbody>
								<tr>
									<td><?php echo $company_name; ?></td>
									<td><?php echo $post_name; ?></td>
									<td><?php echo $education; ?></td>
									<td><?php echo $total_post; ?></td>
									<td><?php echo $location; ?></td>
									<td><?php echo $last_date; ?></td>
									<td class="apply-btn"><a href="<?php echo get_the_permalink($post->ID); ?>">Apply</a></td>
								</tr>
							</tbody>
							<?php } 
							endwhile; ?>
						</table>
                    </div>
                <?php $result = ob_get_clean();
                    return $result;
                break;
            default:
                echo "No Post available";
        }
    }
}