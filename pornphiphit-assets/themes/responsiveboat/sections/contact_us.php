<?php

/* CONTACT US */
global $wp_customize;

$zerif_contactus_show = get_theme_mod('zerif_contactus_show');

if( isset($zerif_contactus_show) && $zerif_contactus_show != 1 ):
	?>
	<section class="contact-us" id="contact">
		<div class="container">
			<!-- SECTION HEADER -->
			<div class="section-header">
				<?php
					$zerif_contactus_title = get_theme_mod('zerif_contactus_title','Get in touch');
					
					if ( !empty($zerif_contactus_title) ):
					
						echo '<h2 class="white-text">'.$zerif_contactus_title.'</h2>';
					
					elseif ( isset( $wp_customize ) ):
					
						echo '<h2 class="white-text zerif_hidden_if_not_customizer"></h2>';
					
					endif;
				
					$zerif_contactus_subtitle = get_theme_mod('zerif_contactus_subtitle');
					
					if( !empty($zerif_contactus_subtitle) ):
					
						echo '<h6 class="white-text">'.$zerif_contactus_subtitle.'</h6>';
						
					elseif ( isset( $wp_customize ) ):

						echo '<h6 class="white-text zerif_hidden_if_not_customizer">'.$zerif_contactus_subtitle.'</h6>';
						
					endif;
				?>
			</div>
			<!-- / END SECTION HEADER -->
			
			<?php
			if ( defined('PIRATE_FORMS_VERSION') && shortcode_exists( 'pirate_forms' ) ):
				echo '<div class="row">';
					echo do_shortcode('[pirate_forms]');
				echo '</div>';
			else:
			?>
			
				<!-- CONTACT FORM-->
				<div class="row">

					<?php 

						if(isset($emailSent) && $emailSent == true) :

							echo '<p class="error white-text error_thanks">'.__('Thanks, your email was sent successfully!','zerif').'</p>';                            

						elseif(isset($_POST['submitted'])):                                    

							echo '<p class="error white-text error_sorry">'.__('Sorry, an error occured. The email could not be sent.','zerif').'</p>';

						endif;

					

						if(isset($nameError) && $nameError != '') :																		 

							echo '<p class="error white-text">'.$nameError.'</p>';																 

						endif;	

						if(isset($emailError) && $emailError != '') :																		 

							echo '<p class="error white-text">'.$emailError.'</p>';																 

						endif;	

						if(isset($subjectError) && $subjectError != '') :																		 

							echo '<p class="error white-text">'.$subjectError.'</p>';																 

						endif;	

						if(isset($messageError) && $messageError != '') :																		 

							echo '<p class="error white-text">'.$messageError.'</p>';																 

						endif;	

					?>

					<form role="form" method="POST" action="" onSubmit="this.scrollPosition.value=(document.body.scrollTop || document.documentElement.scrollTop)" class="contact-form">

						<input type="hidden" name="scrollPosition">

						<input type="hidden" name="submitted" id="submitted" value="true" />

						<div class="col-lg-4 col-sm-4 zerif-rtl-contact-name" data-scrollreveal="enter left after 0s over 1s">

							<?php $zerif_contactus_name_placeholder = get_theme_mod('zerif_contactus_name_placeholder','Your Name'); ?>
							
							<input type="text" name="myname" placeholder="<?php if(!empty($zerif_contactus_name_placeholder)) echo $zerif_contactus_name_placeholder; ?>" class="form-control input-box" value="<?php if(isset($_POST['myname'])) echo esc_attr($_POST['myname']);?>">

						</div>

						<div class="col-lg-4 col-sm-4 zerif-rtl-contact-email" data-scrollreveal="enter left after 0s over 1s">
						
							<?php $zerif_contactus_email_placeholder = get_theme_mod('zerif_contactus_email_placeholder','Your Email'); ?>
							
							<input type="email" name="myemail" placeholder="<?php if(!empty($zerif_contactus_email_placeholder)) echo $zerif_contactus_email_placeholder; ?>" class="form-control input-box" value="<?php if(isset($_POST['myemail'])) echo is_email($_POST['myemail']) ? $_POST['myemail'] : ""; ?>">

						</div>

						<div class="col-lg-4 col-sm-4 zerif-rtl-contact-subject" data-scrollreveal="enter left after 0s over 1s">
						
							<?php $zerif_contactus_subject_placeholder = get_theme_mod('zerif_contactus_subject_placeholder','Subject'); ?>
							
							<input type="text" name="mysubject" placeholder="<?php if(!empty($zerif_contactus_subject_placeholder)) echo $zerif_contactus_subject_placeholder; ?>" class="form-control input-box" value="<?php if(isset($_POST['mysubject'])) echo esc_attr($_POST['mysubject']);?>">

						</div>
						
						<div class="col-lg-12 col-sm-12" data-scrollreveal="enter right after 0s over 1s">

							<?php $zerif_contactus_message_placeholder = get_theme_mod('zerif_contactus_message_placeholder','Your Message'); ?>
							
							<textarea name="mymessage" class="form-control textarea-box" placeholder="<?php if(!empty($zerif_contactus_message_placeholder)) echo $zerif_contactus_message_placeholder; ?>"><?php if(isset($_POST['mymessage'])) { echo stripslashes($_POST['mymessage']); } ?></textarea>

						</div>
						
						<?php
							$zerif_contactus_button_label = get_theme_mod('zerif_contactus_button_label','Send Message');
							
							if( !empty($zerif_contactus_button_label) ):
								
								echo '<button class="btn btn-primary custom-button red-btn" type="submit" data-scrollreveal="enter left after 0s over 1s">'.$zerif_contactus_button_label.'</button>';
								
							elseif ( isset( $wp_customize ) ):
							
								echo '<button class="btn btn-primary custom-button red-btn zerif_hidden_if_not_customizer" type="submit" data-scrollreveal="enter left after 0s over 1s"></button>';
								
							endif;
						?>

						<?php 

							$zerif_contactus_sitekey = get_theme_mod('zerif_contactus_sitekey');
							$zerif_contactus_secretkey = get_theme_mod('zerif_contactus_secretkey');
							$zerif_contactus_recaptcha_show = get_theme_mod('zerif_contactus_recaptcha_show');

							if( isset($zerif_contactus_recaptcha_show) && $zerif_contactus_recaptcha_show != 1 && !empty($zerif_contactus_sitekey) && !empty($zerif_contactus_secretkey) ) :

								echo '<div class="g-recaptcha zerif-g-recaptcha" data-sitekey="' . $zerif_contactus_sitekey . '"></div>';

							endif;

						?>

					</form>

				</div>

				<!-- / END CONTACT FORM-->
			<?php
			endif;
			?>

		</div> <!-- / END CONTAINER -->

	</section> <!-- / END CONTACT US SECTION-->
	<?php
endif;