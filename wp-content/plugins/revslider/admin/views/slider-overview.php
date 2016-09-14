<?php

if( !defined( 'ABSPATH') ) exit();

$orders = false;
//order=asc&ot=name&type=reg
if(isset($_GET['ot']) && isset($_GET['order']) && isset($_GET['type'])){
	$order = array();
	switch($_GET['ot']){
		case 'alias':
			$order['alias'] = ($_GET['order'] == 'asc') ? 'ASC' : 'DESC';
		break;
		case 'favorite':
			$order['favorite'] = ($_GET['order'] == 'asc') ? 'ASC' : 'DESC';
		break;
		case 'name':
		default:
			$order['title'] = ($_GET['order'] == 'asc') ? 'ASC' : 'DESC';
		break;
	}
	
	$orders = $order;
}


$slider = new RevSlider();
$arrSliders = $slider->getArrSliders($orders);

$addNewLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDER);


$fav = get_option('rev_fav_slider', array());
if($orders == false){ //sort the favs to top
	if(!empty($fav) && !empty($arrSliders)){
		$fav_sort = array();
		foreach($arrSliders as $skey => $sort_slider){
			if(in_array($sort_slider->getID(), $fav)){
				$fav_sort[] = $arrSliders[$skey];
				unset($arrSliders[$skey]);
			}
		}
		if(!empty($fav_sort)){
			//revert order of favs
			krsort($fav_sort);
			foreach($fav_sort as $fav_arr){
				array_unshift($arrSliders, $fav_arr);
			}
		}
	}
}

global $revSliderAsTheme;

$exampleID = '"slider1"';
if(!empty($arrSliders))
	$exampleID = '"'.$arrSliders[0]->getAlias().'"';

$latest_version = get_option('revslider-latest-version', RevSliderGlobals::SLIDER_REVISION);
$stable_version = get_option('revslider-stable-version', '4.1');

?>

<div class='wrap'>
	<div class="clear_both"></div>
	<div class="title_line" style="margin-bottom:10px">
		<div id="icon-options-general" class="icon32"></div>
		<a href="<?php echo RevSliderGlobals::LINK_HELP_SLIDERS; ?>" class="button-secondary float_right mtop_10 mleft_10" target="_blank"><?php _e("Help",'revslider'); ?></a>

		<a id="button_general_settings" class="button-secondary float_right mtop_10"><?php _e("Global Settings",'revslider'); ?></a>
	</div>

	<div class="clear_both"></div>

	<div class="title_line nobgnopd" style="height:auto; min-height:50px">
		<div class="view_title">
			<?php _e("Revolution Sliders", 'revslider'); ?>			
		</div>
		<div class="slider-sortandfilter">
				<span class="slider-listviews slider-lg-views" data-type="rs-listview"><i class="eg-icon-align-justify"></i></span>
				<span class="slider-gridviews slider-lg-views active" data-type="rs-gridview"><i class="eg-icon-th"></i></span>
				<span class="slider-sort-drop"><?php _e("Sort By:",'revslider'); ?></span>
				<select id="sort-sliders" name="sort-sliders" style="max-width: 105px;" class="withlabel">
					<option value="id" selected="selected"><?php _e("By ID",'revslider'); ?></option>
					<option value="name"><?php _e("By Name",'revslider'); ?></option>
					<option value="type"><?php _e("By Type",'revslider'); ?></option>
					<option value="favorit"><?php _e("By Favorit",'revslider'); ?></option>
				</select>
				
				<span class="slider-filter-drop"><?php _e("Filter By:",'revslider'); ?></span>
				
				<select id="filter-sliders" name="filter-sliders" style="max-width: 105px;" class="withlabel">
					<option value="all" selected="selected"><?php _e("All",'revslider'); ?></option>
					<option value="posts"><?php _e("Posts",'revslider'); ?></option>
					<option value="gallery"><?php _e("Gallery",'revslider'); ?></option>
					<option value="vimeo"><?php _e("Vimeo",'revslider'); ?></option>
					<option value="youtube"><?php _e("YouTube",'revslider'); ?></option>
					<option value="twitter"><?php _e("Twitter",'revslider'); ?></option>
					<option value="facebook"><?php _e("Facebook",'revslider'); ?></option>
					<option value="instagram"><?php _e("Instagram",'revslider'); ?></option>
					<option value="flickr"><?php _e("Flickr",'revslider'); ?></option>
				</select>
		</div>
		<div style="width:100%;height:1px;float:none;clear:both"></div>
	</div>

	<?php
	$no_sliders = false;
	if(empty($arrSliders)){
		?>
		<span style="display:block;margin-top:15px;margin-bottom:15px;">
		<?php  _e("No Sliders Found",'revslider'); ?>
		</span>
		<?php
		$no_sliders = true;
	}

	require self::getPathTemplate('sliders-list');

	?>
	<!--
	THE INFO ABOUT EMBEDING OF THE SLIDER
	-->
	<div class="rs-dialog-embed-slider" title="<?php _e("Embed Slider",'revslider'); ?>" style="display: none;">
		<div class="revyellow" style="background: none repeat scroll 0% 0% #F1C40F; left:0px;top:55px;position:absolute;height:205px;padding:20px 10px;"><i style="color:#fff;font-size:25px" class="revicon-arrows-ccw"></i></div>
		<div style="margin:5px 0px; padding-left: 55px;">
			<div style="font-size:14px;margin-bottom:10px;"><strong><?php _e("Standard Embeding",'revslider'); ?></strong></div>
			<?php _e("For the",'revslider'); ?> <b><?php _e("pages or posts editor",'revslider'); ?></b> <?php _e("insert the shortcode:",'revslider'); ?> <code class="rs-example-alias-1"></code>
			<div style="width:100%;height:10px"></div>
			<?php _e("From the",'revslider'); ?> <b><?php _e("widgets panel",'revslider'); ?></b> <?php _e("drag the \"Revolution Slider\" widget to the desired sidebar",'revslider'); ?>
			<div style="width:100%;height:25px"></div>
			<div id="advanced-emeding" style="font-size:14px;margin-bottom:10px;"><strong><?php _e("Advanced Embeding",'revslider'); ?></strong><i class="eg-icon-plus"></i></div>
			<div id="advanced-accord" style="display:none; line-height:25px">
				<?php _e("From the",'revslider'); ?> <b><?php _e("theme html",'revslider'); ?></b> <?php _e("use",'revslider'); ?>: <code>&lt?php putRevSlider( '<span class="rs-example-alias">alias</span>' ); ?&gt</code><br>
				<span><?php _e("To add the slider only to homepage use",'revslider'); ?>: <code>&lt?php putRevSlider('<span class="rs-example-alias"><?php echo $exampleID; ?></span>', 'homepage'); ?&gt</code></span></br>
				<span><?php _e("To add the slider on specific pages or posts use",'revslider'); ?>: <code>&lt?php putRevSlider('<span class="rs-example-alias"><?php echo $exampleID; ?></span>', '2,10'); ?&gt</code></span></br>
			</div>
			
		</div>
	</div>
	<script>
		jQuery('#advanced-emeding').click(function() {
			jQuery('#advanced-accord').toggle(200);
		});
	</script>


	<div style="width:100%;height:40px"></div>
	
	<?php 
		/**
		 * include dashboard
		 */
		// include 'dashboard.php';
	?>
	
	<!-- THE UPDATE HISTORY OF SLIDER REVOLUTION -->
	<div style="width:100%;height:40px"></div>
	<div class="rs-update-history-wrapper">
		<div class="rs-dash-title-wrap">
			<div class="rs-dash-title"><?php _e("Update History",'revslider'); ?></div>				
		</div>	
		<div class="rs-update-history"><?php echo file_get_contents(RS_PLUGIN_PATH.'release_log.html'); ?></div>
	</div>
	
</div>

<!-- Import slider dialog -->
<div id="dialog_import_slider" title="<?php _e("Import Slider",'revslider'); ?>" class="dialog_import_slider" style="display:none">
	<form action="<?php echo RevSliderBase::$url_ajax; ?>" enctype="multipart/form-data" method="post">
		<br>
		<input type="hidden" name="action" value="revslider_ajax_action">
		<input type="hidden" name="client_action" value="import_slider_slidersview">
		<input type="hidden" name="nonce" value="<?php echo wp_create_nonce("revslider_actions"); ?>">
		<?php _e("Choose the import file",'revslider'); ?>:
		<br>
		<input type="file" size="60" name="import_file" class="input_import_slider">
		<br><br>
		<span style="font-weight: 700;"><?php _e("Note: styles templates will be updated if they exist!",'revslider'); ?></span><br><br>
		<table>
			<tr>
				<td><?php _e("Custom Animations:",'revslider'); ?></td>
				<td><input type="radio" name="update_animations" value="true" checked="checked"> <?php _e("overwrite",'revslider'); ?></td>
				<td><input type="radio" name="update_animations" value="false"> <?php _e("append",'revslider'); ?></td>
			</tr>
			<tr>
				<td><?php _e("Custom Navigations:",'revslider'); ?></td>
				<td><input type="radio" name="update_navigations" value="true" checked="checked"> <?php _e("overwrite",'revslider'); ?></td>
				<td><input type="radio" name="update_navigations" value="false"> <?php _e("append",'revslider'); ?></td>
			</tr>
			<tr>
				<td><?php _e("Static Styles:",'revslider'); ?></td>
				<td><input type="radio" name="update_static_captions" value="true"> <?php _e("overwrite",'revslider'); ?></td>
				<td><input type="radio" name="update_static_captions" value="false"> <?php _e("append",'revslider'); ?></td>
				<td><input type="radio" name="update_static_captions" value="none" checked="checked"> <?php _e("ignore",'revslider'); ?></td>
			</tr>
		</table>
		<br><br>
		<input type="submit" class="button-primary revblue tp-be-button rev-import-slider-button" style="display: none;" value="<?php _e("Import Slider",'revslider'); ?>">
	</form>
</div>

<div id="dialog_duplicate_slider" class="dialog_duplicate_layer" title="<?php _e('Duplicate', 'revslider'); ?>" style="display:none;">
	<div style="margin-top:14px">
		<span style="margin-right:15px"><?php _e('Title:', 'revslider'); ?></span><input id="rs-duplicate-animation" type="text" name="rs-duplicate-animation" value="" />
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		RevSliderAdmin.initSlidersListView();
		RevSliderAdmin.initNewsletterRoutine();
		
		jQuery('#benefitsbutton').hover(function() {
			jQuery('#benefitscontent').slideDown(200);
		}, function() {
			jQuery('#benefitscontent').slideUp(200);
		});
		
		jQuery('#why-subscribe').hover(function() {
			jQuery('#why-subscribe-wrapper').slideDown(200);
		}, function() {
			jQuery('#why-subscribe-wrapper').slideUp(200);				
		});
		
		jQuery('#tp-validation-box').click(function() {
			jQuery(this).css({cursor:"default"});
			if (jQuery('#rs-validation-wrapper').css('display')=="none") {
				jQuery('#tp-before-validation').hide();
				jQuery('#rs-validation-wrapper').slideDown(200);
			}
		});

		jQuery('body').on('click','.rs-dash-more-info',function() {
			var btn = jQuery(this),
				p = btn.closest('.rs-dash-widget-inner'),
				tmb = btn.data('takemeback'),
				btxt = '';

			btxt = btxt + '<div class="rs-dash-widget-warning-panel">';
			btxt = btxt + '	<i class="eg-icon-cancel rs-dash-widget-wp-cancel"></i>';
			btxt = btxt + '	<div class="rs-dash-strong-content">'+ btn.data("title")+'</div>';				
			btxt = btxt + '	<div class="rs-dash-content-space"></div>';
			btxt = btxt + '	<div>'+btn.data("content")+'</div>';
		
			if (tmb!=="false" && tmb!==false) {
				btxt = btxt + '	<div class="rs-dash-content-space"></div>';
				btxt = btxt + '	<span class="rs-dash-invers-button-gray rs-dash-close-panel">Thanks! Take me back</span>';
			}
			btxt = btxt + '</div>';

			p.append(btxt);
			var panel = p.find('.rs-dash-widget-warning-panel');

			punchgs.TweenLite.fromTo(panel,0.3,{y:-10,autoAlpha:0},{autoAlpha:1,y:0,ease:punchgs.Power3.easeInOut});
			panel.find('.rs-dash-widget-wp-cancel, .rs-dash-close-panel').click(function() {
				punchgs.TweenLite.to(panel,0.3,{y:-10,autoAlpha:0,ease:punchgs.Power3.easeInOut});
				setTimeout(function() {
					panel.remove();
				},300)
			})
		});
	});
</script>
<?php
require self::getPathTemplate('template-slider-selector');
?>