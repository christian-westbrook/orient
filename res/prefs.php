<?php
/******************************************************************************************
 * System	:																			  *
 * Version	: 1.0																		  *
 * System	: Optimized Research Interest Network									      *
 * Version	: Prototype System I														  *
 * File		: prefs.php																	  *
 * Developers	: Christian Westbrook, Anthony Todaro, Elias Nyantakanya				  *
 * Date Created	: 10/06/18																  *
 * Last Updated	: 10/08/18																  *
 * Abstract	: This file contains the preferences page of the ORIENT web					  *
 *                system. The preferences page displays the user information interface	  *
 *                to the user, who can choose to update or change it. 					  *
 * Developers	: Elias Nyantakanya, Anthony Todaro, Christian Westbrook				  *
 *																						  *
 * Abstract	: This file presents the preferences page of the ORIENT web system.			  *
 *                The page displays an preferences interface to the user,			      *
 *                who can choose to update on the site their user information			  *
 *                in an existing account. 												  *
 *                																		  *
 *****************************************************************************************/


//======================================================================
// Showing post state on profile page
//======================================================================
add_filter( 'display_post_states', 'ecs_add_post_state', 10, 2 );
function ecs_add_post_state( $post_states, $post ) {
	if( $post->post_name == 'edit-profile' ) {
		$post_states[] = 'Profile edit page';
	}
	return $post_states;
}

<?php
//======================================================================
// Adding notice to the profile edit page
//======================================================================
add_action( 'admin_notices', 'ecs_add_post_notice' );
function ecs_add_post_notice() {
	global $post;
	if( isset( $post->post_name ) && ( $post->post_name == 'edit-profile' ) ) {
	  /* Add a notice to the edit page */
		add_action( 'edit_form_after_title', 'ecs_add_page_notice', 1 );
		
	}	
}
function ecs_add_page_notice() {
	echo '<div class="notice notice-warning inline"><p>' . __( 'You are currently editing the profile edit page', 'textdomain' ) . '</p></div>';
}


<?php

	check_page_security();
	
	require_once('includes/update-profile.php');
?>

<?php get_header(); ?>

	<?php get_template_part('parts/dashboard/user'); ?>

	<?php if ( !have_posts() ) get_template_part( 'parts/notice/no-posts' ); ?>

	<?php while (have_posts()) : the_post(); ?>

		<section id="dashboard-content">
		
			<div class="wrap">

				<?php get_template_part( 'parts/dashboard/edit-profile/intro' ); ?>

				<?php if( !empty( $_GET['updated'] ) ): ?>
					<div class="success"><?php _e('Profile successfully updated', 'textdomain'); ?></div>
				<?php endif; ?>

				<?php if( !empty( $_GET['validation'] ) ): ?>
					
					<?php if( $_GET['validation'] == 'emailnotvalid' ): ?>
						<div class="error"><?php _e('Email address is not valid', 'textdomain'); ?></div>
					<?php elseif( $_GET['validation'] == 'emailexists' ): ?>
						<div class="error"><?php _e('The given email address already exists', 'textdomain'); ?></div>
					<?php elseif( $_GET['validation'] == 'passwordmismatch' ): ?>
						<div class="error"><?php _e('Passwords did not match', 'textdomain'); ?></div>
					<?php elseif( $_GET['validation'] == 'unknown' ): ?>
						<div class="error"><?php _e('An unknown error accurd, please try again or contact website administrator', 'textdomain'); ?></div>
					<?php endif; ?>

				<?php endif; ?>

				<?php $current_user = wp_get_current_user(); ?>

				<form method="post" id="adduser" action="<?php the_permalink(); ?>">

				    <h3><?php _e('Personal info', 'textdomain'); ?></h3>

				    <p>
				        <label for="first-name"><?php _e('Username', 'textdomain'); ?></label>
				        <input class="text-input" name="user_login" type="text" id="user_login" value="<?php the_author_meta( 'user_login', $current_user->ID ); ?>" disabled/>
				        <?php _e('It is not possible to change your username.', 'textdomain'); ?>
				    </p>

				    <p><?php _e('Please note, all information below is also shown on the website.', 'textdomain'); ?></p>

				    <p>
				        <label for="first-name"><?php _e('First name', 'textdomain'); ?></label>
				        <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
				    </p>

				    <p>
				        <label for="last-name"><?php _e('Last name', 'textdomain'); ?></label>
				        <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
				    </p>

				    <p>
				        <label for="email"><?php _e('E-mail *', 'textdomain'); ?></label>
				        <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
				    </p>

				    <p>
				        <label for="phone_number"><?php _e('Phone', 'textdomain'); ?></label>
				        <input class="text-input" name="phone_number" type="text" id="phone_number" value="<?php the_author_meta( 'phone_number', $current_user->ID ); ?>" />
				    </p>

				    <p>
				        <label for="user_specialisation"><?php _e('Specialisation', 'textdomain'); ?></label>
				        <input class="text-input" name="user_specialisation" type="text" id="user_specialisation" value="<?php the_author_meta( 'specialisation', $current_user->ID ); ?>" />
				    </p>

				    <?php 
					
					//================================================================================================================
				    // Image, Password and Name changes
					//================================================================================================================
					
				        do_action('edit_user_profile', $current_user); 
				    ?>

				    <p><?php _e('Upload an image of 150x150', 'textdomain'); ?></p>

				    <h3><?php _e('Change password', 'textdomain'); ?></h3>

				    <p><?php _e('When both password fields are left empty, your password will not change', 'textdomain'); ?></p>

				    <p class="form-password">
				        <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
				        <input class="text-input" name="pass1" type="password" id="pass1" />
				    </p><!-- .form-password -->
				    <p class="form-password">
				        <label for="pass2"><?php _e('Repeat password *', 'profile'); ?></label>
				        <input class="text-input" name="pass2" type="password" id="pass2" />
				    </p><!-- .form-password -->

				    <p class="form-submit">
				        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update profile', 'textdomain'); ?>" />
				        <?php wp_nonce_field( 'update-user' ) ?>
				        <input name="honey-name" value="" type="text" style="display:none;"></input>
				        <input name="action" type="hidden" id="action" value="update-user" />
				    </p><!-- .form-submit -->

				</form><!-- #adduser -->

			</div>

	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>




