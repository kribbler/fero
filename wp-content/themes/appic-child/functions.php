<?php
define( 'CHILD_URL', get_stylesheet_directory_uri() );
define('CHILD_DIR', get_stylesheet_directory() );
require_once CHILD_DIR . '/includes/shortcodes/tinymce/tinymce_shortcodes.php';

wp_dequeue_style( 'bootstrap-font-awesome' );
function child_theme_widgets_init(){
	register_sidebar( array(
        'name' => __( 'Header Top Right', 'liva' ),
        'id' => 'header_top_right',
        'before_widget' => '<div id="%1$s" class="header_top_right sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	/*
	register_sidebar( array(
        'name' => __( 'Header Contact Link', 'liva' ),
        'id' => 'header_contact_link',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );*/
    
}

add_action( 'widgets_init', 'child_theme_widgets_init' );

function create_post_type_capabilities()
{
	register_post_type('capability', array(
		'label' => __('Capabilities', 'appic'),
		'labels' => array(
			'add_new_item' => __('Add New Capability', 'appic')
		),
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => PARENT_URL . '/includes/images/ico-services.png',
		'menu_position' => 6,
		'rewrite' => array(
			'slug' => 'capabilities',
			'with_front' => false,
		),
		'supports' => array(
			'title',
			'editor',
			'thumbnail'
		)
	));
}
add_action('init', 'create_post_type_capabilities'); // Add Capabilities custom post type

// Capabilities carousel
function capabilities_carousel_shortcode($atts, $content=null)
{
	$output = '';

	$items = get_posts(array(
		'post_type' => 'capability',
		'numberposts' => -1,
	));

	if (empty($items)) {
		return $output;
	}

	$iconsHtml = '';
	$descriptionsHtml = '';

	$itemOrder = 1;
	
	foreach ($items as $item) {
		$itemTitle = esc_html($item->post_title);
		$itemLink = get_permalink($item->ID);
		$image_url = wp_get_attachment_url( get_post_thumbnail_id($item->ID, 'thumbnail') );
		
		$capabilityMeta = get_post_meta($item->ID, 'capability_meta', true);
		$iconClass = isset($capabilityMeta['icon']) ? ' ' . $capabilityMeta['icon'] : '';

		if (!empty($capabilityMeta['short_description'])) {
			$itemDescription = $capabilityMeta['short_description'];
			if ($capabilityMeta['is_shown_read_more']) {
				$itemDescription .= ' <a href="' . $itemLink . '" class="link-button">' . $capabilityMeta['read_more_text'] . '<span class="link-arrow"></span></a>';
			}
		} else {
			$itemDescription = $item->post_content ? apply_filters('the_content', $item->post_content) : '';
		}

		$isActiveImageClass = ($itemOrder == 1) ? ' bxslider-active_C' : '';

		$iconsHtml .= '<li class="text-center' . $isActiveImageClass .'" data-order="' . $itemOrder . '">' .
			'<a href="' . $itemLink . '" class="bxslider-li-wrap______">' .
				'<img src=" ' . $image_url . '" />' . 
				'<i class="fa' . $iconClass . '"></i>' .
				'<h3>' . $itemTitle . '</h3>' .
			'</a>' .
		'</li>';

		$isActiveDescrClass = ($itemOrder == 1) ? ' class="description-active_C"' : '';
		$descriptionsHtml .= '<li' . $isActiveDescrClass .'>' .
			'<p class="simple-text-14">' . $itemDescription .'</p>' .
		'</li>';

		$itemOrder++;
	}

	wp_enqueue_script('bxslider');
	JsClientScript::addScript('init-capabilities-shortcodes',
		'$(".shortcode_carousel_lists_C").bxSlider({pager: true, minSlides: 2, maxSlides: 7, slideWidth: 140, slideMargin: 30}); ' .
		'$(".shortcode_carousel_lists_C").children().on("mouseenter",function(e) {' .
			'$(".shortcode_carousel_lists_C").children().removeClass("bxslider-active_C");' .
			'$(".bxslider-description_C").children().removeClass("description-active_C");' .
			'var number = parseInt( $(this).addClass("bxslider-active_C").data("order"));' .
			'$(".bxslider-description_C").children().eq(--number).addClass("description-active_C");' .
		'});'
	);

	return '<div class="shortcode capabilities-wrap horizontal-blue-lines stretch-over-container">' .
		'<section class="capabilities capabilities-carousel">' .
			'<ul class="clear-list bxslider shortcode_carousel_lists_C">' . $iconsHtml . '</ul>' .
			'<ul class="clear-list bxslider-description_C">' . $descriptionsHtml . '</ul>' .
		'</section>' .
	'</div>';
}
add_shortcode ('capabilities_carousel', 'capabilities_carousel_shortcode');

// Sections carousel
function create_post_type_sections()
{
	register_post_type('section', array(
		'label' => __('Sections', 'appic'),
		'labels' => array(
			'add_new_item' => __('Add New Section', 'appic')
		),
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => PARENT_URL . '/includes/images/ico-services.png',
		'menu_position' => 6,
		'rewrite' => array(
			'slug' => 'sections',
			'with_front' => false,
		),
		'supports' => array(
			'title',
			'editor',
			'thumbnail'
		)
	));
}
add_action('init', 'create_post_type_sections'); // Add Sections custom post type

// Sections carousel
function sections_carousel_shortcode($atts, $content=null)
{
	$output = '';

	$items = get_posts(array(
		'post_type' => 'section',
		'numberposts' => -1,
	));

	if (empty($items)) {
		return $output;
	}

	$iconsHtml = '';
	$descriptionsHtml = '';

	$itemOrder = 1;
	
	foreach ($items as $item) {
		$itemTitle = esc_html($item->post_title);
		$itemLink = get_permalink($item->ID);
		$image_url = wp_get_attachment_url( get_post_thumbnail_id($item->ID, 'thumbnail') );
		
		$sectionMeta = get_post_meta($item->ID, 'section_meta', true);
		$iconClass = isset($sectionMeta['icon']) ? ' ' . $sectionMeta['icon'] : '';

		if (!empty($sectionMeta['short_description'])) {
			$itemDescription = $sectionMeta['short_description'];
			if ($sectionMeta['is_shown_read_more']) {
				$itemDescription .= ' <a href="' . $itemLink . '" class="link-button">' . $sectionMeta['read_more_text'] . '<span class="link-arrow"></span></a>';
			}
		} else {
			$itemDescription = $item->post_content ? apply_filters('the_content', $item->post_content) : '';
		}

		$isActiveImageClass = ($itemOrder == 1) ? ' bxslider-active_S' : '';

		$iconsHtml .= '<li class="text-center' . $isActiveImageClass .'" data-order="' . $itemOrder . '">' .
			'<a href="' . $itemLink . '" class="bxslider-li-wrap______">' .
				'<img src=" ' . $image_url . '" />' . 
				'<i class="fa' . $iconClass . '"></i>' .
				'<h3>' . $itemTitle . '</h3>' .
			'</a>' .
		'</li>';

		$isActiveDescrClass = ($itemOrder == 1) ? ' class="description-active_S"' : '';
		$descriptionsHtml .= '<li' . $isActiveDescrClass .'>' .
			'<p class="simple-text-14">' . $itemDescription .'</p>' .
		'</li>';

		$itemOrder++;
	}

	wp_enqueue_script('bxslider');
	JsClientScript::addScript('init-sections-shortcodes',
		'$(".shortcode_carousel_lists_S").bxSlider({pager: true, minSlides: 2, maxSlides: 11, slideWidth: 75, slideMargin: 30}); ' .
		'$(".shortcode_carousel_lists_S").children().on("mouseenter",function(e) {' .
			'$(".shortcode_carousel_lists_S").children().removeClass("bxslider-active_S");' .
			'$(".bxslider-description_S").children().removeClass("description-active_S");' .
			'var number = parseInt( $(this).addClass("bxslider-active_S").data("order"));' .
			'$(".bxslider-description_S").children().eq(--number).addClass("description-active_S");' .
		'});'
	);

	return '<div class="shortcode sections-wrap horizontal-blue-lines stretch-over-container">' .
		'<section class="sections sections-carousel">' .
			'<ul class="clear-list bxslider shortcode_carousel_lists_S">' . $iconsHtml . '</ul>' .
			'<ul class="clear-list bxslider-description_S">' . $descriptionsHtml . '</ul>' .
		'</section>' .
	'</div>';
}
add_shortcode ('sections_carousel', 'sections_carousel_shortcode');

wp_register_script('respond_js', CHILD_URL . '/scripts/respond.js', array());
//wp_enqueue_script('time_line');
//var_dump($_SERVER['HTTP_USER_AGENT']);
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.') !== false) {
	wp_enqueue_style('style_ie8', CHILD_URL . '/ie8/css/style_ie8.css');
}
