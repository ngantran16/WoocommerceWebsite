<?php
/**
 * VW Newspaper Theme Customizer
 *
 * @package VW Newspaper
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_newspaper_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_newspaper_custom_controls' );

function vw_newspaper_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial( 'blogname', array( 
        'selector' => '.logo .site-title a', 
        'render_callback' => 'vw_newspaper_customize_partial_blogname', 
    )); 

    $wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
        'selector' => 'p.site-description', 
        'render_callback' => 'vw_newspaper_customize_partial_blogdescription', 
    ));

    //add home page setting pannel
	$VWNewspaperParentPanel = new VW_Newspaper_WP_Customize_Panel( $wp_customize, 'vw_newspaper_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => 'VW Settings',
		'priority' => 10,
	));

	$wp_customize->add_section( 'vw_newspaper_left_right', array(
    	'title'      => __( 'General Settings', 'vw-newspaper' ),
		'panel' => 'vw_newspaper_panel_id'
	) );

	$wp_customize->add_setting('vw_newspaper_width_option',array(
        'default' => __('Full Width','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Newspaper_Image_Radio_Control($wp_customize, 'vw_newspaper_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-newspaper'),
        'description' => __('Here you can change the width layout of Website.','vw-newspaper'),
        'section' => 'vw_newspaper_left_right',
        'choices' => array(
            'Full Width' => get_template_directory_uri().'/images/full-width.png',
            'Wide Width' => get_template_directory_uri().'/images/wide-width.png',
            'Boxed' => get_template_directory_uri().'/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_newspaper_theme_options',array(
        'default' => __('Right Sidebar','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_newspaper_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-newspaper'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-newspaper'),
        'section' => 'vw_newspaper_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-newspaper'),
            'Right Sidebar' => __('Right Sidebar','vw-newspaper'),
            'One Column' => __('One Column','vw-newspaper'),
            'Three Columns' => __('Three Columns','vw-newspaper'),
            'Four Columns' => __('Four Columns','vw-newspaper'),
            'Grid Layout' => __('Grid Layout','vw-newspaper')
        ),
	));

	$wp_customize->add_setting('vw_newspaper_page_layout',array(
        'default' => __('One Column','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
	));
	$wp_customize->add_control('vw_newspaper_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-newspaper'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-newspaper'),
        'section' => 'vw_newspaper_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-newspaper'),
            'Right Sidebar' => __('Right Sidebar','vw-newspaper'),
            'One Column' => __('One Column','vw-newspaper')
        ),
	) );

	//Pre-Loader
	$wp_customize->add_setting( 'vw_newspaper_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-newspaper' ),
        'section' => 'vw_newspaper_left_right'
    )));

	$wp_customize->add_setting('vw_newspaper_loader_icon',array(
        'default' => __('Two Way','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
	));
	$wp_customize->add_control('vw_newspaper_loader_icon',array(
        'type' => 'select',
        'label' => __('Pre-Loader Type','vw-newspaper'),
        'section' => 'vw_newspaper_left_right',
        'choices' => array(
            'Two Way' => __('Two Way','vw-newspaper'),
            'Dots' => __('Dots','vw-newspaper'),
            'Rotate' => __('Rotate','vw-newspaper')
        ),
	) );
    
	//Todays Headline
	$wp_customize->add_section('vw_newspaper_headline_section',array(
		'title'	=> __('Todays Headline','vw-newspaper'),
		'description'=> __('This section is about todays heading.','vw-newspaper'),
		'panel' => 'vw_newspaper_panel_id',
	));	

	//Sticky Header
	$wp_customize->add_setting( 'vw_newspaper_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','vw-newspaper' ),
        'section' => 'vw_newspaper_headline_section'
    )));

    $wp_customize->add_setting('vw_newspaper_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_headline_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_newspaper_search_hide_show',
       array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_search_hide_show',
       array(
      'label' => esc_html__( 'Show / Hide Search','vw-newspaper' ),
      'section' => 'vw_newspaper_headline_section'
    )));

    $wp_customize->add_setting('vw_newspaper_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_search_font_size',array(
		'label'	=> __('Search Font Size','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_headline_section',
		'type'=> 'text'
	));

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_newspaper_headline_title', array( 
        'selector' => '.headline h1', 
        'render_callback' => 'vw_newspaper_customize_partial_vw_newspaper_headline_title', 
    ));
	
	$wp_customize->add_setting('vw_newspaper_headline_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_newspaper_headline_title',array(
		'label'	=> __('Section Title','vw-newspaper'),
		'section'=> 'vw_newspaper_headline_section',
		'setting'=> 'vw_newspaper_headline_title',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_newspaper_headline_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_newspaper_sanitize_choices',
	));
	$wp_customize->add_control('vw_newspaper_headline_category',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Latest Post','vw-newspaper'),
		'section' => 'vw_newspaper_headline_section',
	));

	//Our Blog Category section
  	$wp_customize->add_section('vw_newspaper_category_section',array(
	    'title' => __('Category Section','vw-newspaper'),
	    'description' => '',
	    'priority'  => null,
	    'panel' => 'vw_newspaper_panel_id',
	)); 

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_newspaper_category', array( 
        'selector' => '.main-content-box h3 a', 
        'render_callback' => 'vw_newspaper_customize_partial_vw_newspaper_category', 
    ));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post1[]= 'select';
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cat_post1[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_newspaper_category',array(
	    'default' => 'select',
	    'sanitize_callback' => 'vw_newspaper_sanitize_choices',
  	));

  	$wp_customize->add_control('vw_newspaper_category',array(
	    'type'    => 'select',
	    'choices' => $cat_post1,
	    'label' => __('Select Category to display Latest Post','vw-newspaper'),
	    'section' => 'vw_newspaper_category_section',
	));

	//Blog Post
	$wp_customize->add_panel( $VWNewspaperParentPanel );

	$BlogPostParentPanel = new VW_Newspaper_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-newspaper' ),
		'panel' => 'vw_newspaper_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_newspaper_post_settings', array(
		'title' => __( 'Post Settings', 'vw-newspaper' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_newspaper_toggle_postdate', array( 
        'selector' => '.service-box h2 a', 
        'render_callback' => 'vw_newspaper_customize_partial_vw_newspaper_toggle_postdate', 
    ));

	$wp_customize->add_setting( 'vw_newspaper_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-newspaper' ),
        'section' => 'vw_newspaper_post_settings'
    )));

    $wp_customize->add_setting( 'vw_newspaper_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_toggle_author',array(
		'label' => esc_html__( 'Author','vw-newspaper' ),
		'section' => 'vw_newspaper_post_settings'
    )));

    $wp_customize->add_setting( 'vw_newspaper_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-newspaper' ),
		'section' => 'vw_newspaper_post_settings'
    )));

    $wp_customize->add_setting( 'vw_newspaper_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_newspaper_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-newspaper' ),
		'section' => 'vw_newspaper_post_settings'
    )));

    $wp_customize->add_setting( 'vw_newspaper_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_newspaper_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_newspaper_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-newspaper' ),
		'section'     => 'vw_newspaper_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_newspaper_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('vw_newspaper_blog_layout_option',array(
        'default' => __('Default','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Newspaper_Image_Radio_Control($wp_customize, 'vw_newspaper_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-newspaper'),
        'section' => 'vw_newspaper_post_settings',
        'choices' => array(
            'Default' => get_template_directory_uri().'/images/blog-layout1.png',
            'Center' => get_template_directory_uri().'/images/blog-layout2.png',
            'Left' => get_template_directory_uri().'/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('vw_newspaper_excerpt_settings',array(
        'default' => __('Excerpt','vw-newspaper'),
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
    ));
    $wp_customize->add_control('vw_newspaper_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-newspaper'),
        'section' => 'vw_newspaper_post_settings',
        'choices' => array(
            'Content' => __('Content','vw-newspaper'),
            'Excerpt' => __('Excerpt','vw-newspaper'),
            'No Content' => __('No Content','vw-newspaper')
        ),
    ) );

    $wp_customize->add_setting('vw_newspaper_excerpt_suffix',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_newspaper_excerpt_suffix',array(
        'label' => __('Add Excerpt Suffix','vw-newspaper'),
        'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-newspaper' ),
        ),
        'section'=> 'vw_newspaper_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting( 'vw_newspaper_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','vw-newspaper' ),
      'section' => 'vw_newspaper_post_settings'
    )));

	$wp_customize->add_setting( 'vw_newspaper_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_newspaper_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_newspaper_blog_pagination_type', array(
        'section' => 'vw_newspaper_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-newspaper' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-newspaper' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-newspaper' ),
    )));

    // Button Settings
	$wp_customize->add_section( 'vw_newspaper_button_settings', array(
		'title' => __( 'Button Settings', 'vw-newspaper' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_newspaper_button_border',
       array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_button_border',
       array(
      'label' => esc_html__( 'Show / Hide Button Border','vw-newspaper' ),
      'section' => 'vw_newspaper_button_settings'
    )));

	$wp_customize->add_setting('vw_newspaper_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_newspaper_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_newspaper_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_newspaper_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-newspaper' ),
		'section'     => 'vw_newspaper_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_newspaper_button_text', array( 
        'selector' => '.post-main-box .content-bttn a', 
        'render_callback' => 'vw_newspaper_customize_partial_vw_newspaper_button_text', 
    ));

    $wp_customize->add_setting('vw_newspaper_button_text',array(
		'default'=> 'Read More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_button_text',array(
		'label'	=> __('Add Button Text','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_newspaper_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-newspaper' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_newspaper_related_post_title', array( 
        'selector' => '.related-post h3', 
        'render_callback' => 'vw_newspaper_customize_partial_vw_newspaper_related_post_title', 
    ));

    $wp_customize->add_setting( 'vw_newspaper_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_related_post',array(
		'label' => esc_html__( 'Related Post','vw-newspaper' ),
		'section' => 'vw_newspaper_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_newspaper_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_newspaper_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_newspaper_sanitize_float'
	));
	$wp_customize->add_control('vw_newspaper_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_related_posts_settings',
		'type'=> 'number'
	));

    // Single Posts Settings
    $wp_customize->add_section( 'vw_newspaper_single_blog_settings', array(
        'title' => __( 'Single Post Settings', 'vw-newspaper' ),
        'panel' => 'blog_post_parent_panel',
    ));

    $wp_customize->add_setting( 'vw_newspaper_single_blog_post_navigation_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_single_blog_post_navigation_show_hide', array(
        'label' => esc_html__( 'Post Navigation','vw-newspaper' ),
        'section' => 'vw_newspaper_single_blog_settings'
    )));

    //navigation text
    $wp_customize->add_setting('vw_newspaper_single_blog_prev_navigation_text',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_newspaper_single_blog_prev_navigation_text',array(
        'label' => __('Post Navigation Text','vw-newspaper'),
        'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-newspaper' ),
        ),
        'section'=> 'vw_newspaper_single_blog_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('vw_newspaper_single_blog_next_navigation_text',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_newspaper_single_blog_next_navigation_text',array(
        'label' => __('Post Navigation Text','vw-newspaper'),
        'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-newspaper' ),
        ),
        'section'=> 'vw_newspaper_single_blog_settings',
        'type'=> 'text'
    ));

    //404 Page Setting
	$wp_customize->add_section('vw_newspaper_404_page',array(
		'title'	=> __('404 Page Settings','vw-newspaper'),
		'panel' => 'vw_newspaper_panel_id',
	));	

	$wp_customize->add_setting('vw_newspaper_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_newspaper_404_page_title',array(
		'label'	=> __('Add Title','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_newspaper_404_page_content',array(
		'label'	=> __('Add Text','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to the home page', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_404_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_newspaper_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-newspaper'),
		'panel' => 'vw_newspaper_panel_id',
	));	

	$wp_customize->add_setting('vw_newspaper_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_social_icon_width',array(
		'label'	=> __('Icon Width','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_social_icon_height',array(
		'label'	=> __('Icon Height','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_newspaper_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_newspaper_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_newspaper_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-newspaper' ),
		'section'     => 'vw_newspaper_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_newspaper_responsive_media',array(
		'title'	=> __('Responsive Media','vw-newspaper'),
		'panel' => 'vw_newspaper_panel_id',
	));

    $wp_customize->add_setting( 'vw_newspaper_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','vw-newspaper' ),
      'section' => 'vw_newspaper_responsive_media'
    )));

	$wp_customize->add_setting( 'vw_newspaper_metabox_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_metabox_hide_show',array(
      'label' => esc_html__( 'Show / Hide Metabox','vw-newspaper' ),
      'section' => 'vw_newspaper_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_newspaper_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-newspaper' ),
      'section' => 'vw_newspaper_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_newspaper_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-newspaper' ),
      'section' => 'vw_newspaper_responsive_media'
    )));

    $wp_customize->add_setting('vw_newspaper_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new vw_newspaper_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_newspaper_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-newspaper'),
		'transport' => 'refresh',
		'section'	=> 'vw_newspaper_responsive_media',
		'setting'	=> 'vw_newspaper_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_newspaper_res_close_menu_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new vw_newspaper_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_newspaper_res_close_menu_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-newspaper'),
		'transport' => 'refresh',
		'section'	=> 'vw_newspaper_responsive_media',
		'setting'	=> 'vw_newspaper_res_close_menu_icon',
		'type'		=> 'icon'
	)));

	//Content Craetion
	$wp_customize->add_section( 'vw_newspaper_content_section' , array(
    	'title' => __( 'Customize Home Page', 'vw-newspaper' ),
		'priority' => null,
		'panel' => 'vw_newspaper_panel_id'
	) );

	$wp_customize->add_setting('vw_newspaper_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Newspaper_Content_Creation( $wp_customize, 'vw_newspaper_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-newspaper' ),
		),
		'section' => 'vw_newspaper_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-newspaper' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_newspaper_footer',array(
		'title'	=> __('Footer','vw-newspaper'),
		'description'=> __('This section will appear in the footer','vw-newspaper'),
		'panel' => 'vw_newspaper_panel_id',
	));	

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_newspaper_footer_text', array( 
        'selector' => '.copyright p', 
        'render_callback' => 'vw_newspaper_customize_partial_vw_newspaper_footer_text', 
    ));
	
	$wp_customize->add_setting('vw_newspaper_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_newspaper_footer_text',array(
		'label'	=> __('Copyright Text','vw-newspaper'),
		'section'=> 'vw_newspaper_footer',
		'setting'=> 'vw_newspaper_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_newspaper_copyright_alingment',array(
        'default' => __('center','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Newspaper_Image_Radio_Control($wp_customize, 'vw_newspaper_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-newspaper'),
        'section' => 'vw_newspaper_footer',
        'settings' => 'vw_newspaper_copyright_alingment',
        'choices' => array(
            'left' => get_template_directory_uri().'/images/copyright1.png',
            'center' => get_template_directory_uri().'/images/copyright2.png',
            'right' => get_template_directory_uri().'/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_newspaper_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_newspaper_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-newspaper' ),
      	'section' => 'vw_newspaper_footer'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_newspaper_scroll_top_icon', array( 
        'selector' => '.scrollup i', 
        'render_callback' => 'vw_newspaper_customize_partial_vw_newspaper_scroll_top_icon', 
    ));

    $wp_customize->add_setting('vw_newspaper_scroll_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new vw_newspaper_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_newspaper_scroll_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-newspaper'),
		'transport' => 'refresh',
		'section'	=> 'vw_newspaper_footer',
		'setting'	=> 'vw_newspaper_scroll_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_newspaper_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-newspaper'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_newspaper_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_newspaper_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-newspaper'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-newspaper'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
		'section'=> 'vw_newspaper_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_newspaper_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_newspaper_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_newspaper_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-newspaper' ),
		'section'     => 'vw_newspaper_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_newspaper_scroll_top_alignment',array(
        'default' => __('Right','vw-newspaper'),
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Newspaper_Image_Radio_Control($wp_customize, 'vw_newspaper_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-newspaper'),
        'section' => 'vw_newspaper_footer',
        'settings' => 'vw_newspaper_scroll_top_alignment',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/layout1.png',
            'Center' => get_template_directory_uri().'/images/layout2.png',
            'Right' => get_template_directory_uri().'/images/layout3.png'
    ))));

    //Woocommerce settings
    $wp_customize->add_section('vw_newspaper_woocommerce_section', array(
        'title'    => __('WooCommerce Layout', 'vw-newspaper'),
        'priority' => null,
        'panel'    => 'woocommerce',
    ));

    //Woocommerce Shop Page Sidebar
    $wp_customize->add_setting( 'vw_newspaper_woocommerce_shop_page_sidebar',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_woocommerce_shop_page_sidebar',array(
        'label' => esc_html__( 'Shop Page Sidebar','vw-newspaper' ),
        'section' => 'vw_newspaper_woocommerce_section'
    )));

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting( 'vw_newspaper_woocommerce_single_product_page_sidebar',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_newspaper_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Newspaper_Toggle_Switch_Custom_Control( $wp_customize, 'vw_newspaper_woocommerce_single_product_page_sidebar',array(
        'label' => esc_html__( 'Single Product Sidebar','vw-newspaper' ),
        'section' => 'vw_newspaper_woocommerce_section'
    )));

    //Products per page
    $wp_customize->add_setting('vw_newspaper_products_per_page',array(
        'default'=> '9',
        'sanitize_callback' => 'vw_newspaper_sanitize_float'
    ));
    $wp_customize->add_control('vw_newspaper_products_per_page',array(
        'label' => __('Products Per Page','vw-newspaper'),
        'description' => __('Display on shop page','vw-newspaper'),
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 0,
            'max'              => 50,
        ),
        'section'=> 'vw_newspaper_woocommerce_section',
        'type'=> 'number',
    ));

    //Products per row
    $wp_customize->add_setting('vw_newspaper_products_per_row',array(
        'default'=> '3',
        'sanitize_callback' => 'vw_newspaper_sanitize_choices'
    ));
    $wp_customize->add_control('vw_newspaper_products_per_row',array(
        'label' => __('Products Per Row','vw-newspaper'),
        'description' => __('Display on shop page','vw-newspaper'),
        'choices' => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
        'section'=> 'vw_newspaper_woocommerce_section',
        'type'=> 'select',
    ));

    //Products padding
    $wp_customize->add_setting('vw_newspaper_products_padding_top_bottom',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_newspaper_products_padding_top_bottom',array(
        'label' => __('Products Padding Top Bottom','vw-newspaper'),
        'description'   => __('Enter a value in pixels. Example:20px','vw-newspaper'),
        'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
        'section'=> 'vw_newspaper_woocommerce_section',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('vw_newspaper_products_padding_left_right',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_newspaper_products_padding_left_right',array(
        'label' => __('Products Padding Left Right','vw-newspaper'),
        'description'   => __('Enter a value in pixels. Example:20px','vw-newspaper'),
        'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-newspaper' ),
        ),
        'section'=> 'vw_newspaper_woocommerce_section',
        'type'=> 'text'
    ));

    //Products box shadow
    $wp_customize->add_setting( 'vw_newspaper_products_box_shadow', array(
        'default'              => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'vw_newspaper_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'vw_newspaper_products_box_shadow', array(
        'label'       => esc_html__( 'Products Box Shadow','vw-newspaper' ),
        'section'     => 'vw_newspaper_woocommerce_section',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    //Products border radius
    $wp_customize->add_setting( 'vw_newspaper_products_border_radius', array(
        'default'              => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'vw_newspaper_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'vw_newspaper_products_border_radius', array(
        'label'       => esc_html__( 'Products Border Radius','vw-newspaper' ),
        'section'     => 'vw_newspaper_woocommerce_section',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Newspaper_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Newspaper_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_newspaper_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
    class VW_Newspaper_WP_Customize_Panel extends WP_Customize_Panel {
        public $panel;
        public $type = 'vw_newspaper_panel';
        public function json() {

          $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
          $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
          $array['content'] = $this->get_content();
          $array['active'] = $this->active();
          $array['instanceNumber'] = $this->instance_number;
          return $array;
        }
    }
}

if ( class_exists( 'WP_Customize_Section' ) ) {
    class VW_Newspaper_WP_Customize_Section extends WP_Customize_Section {
        public $section;
        public $type = 'vw_newspaper_section';
        public function json() {

          $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
          $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
          $array['content'] = $this->get_content();
          $array['active'] = $this->active();
          $array['instanceNumber'] = $this->instance_number;

          if ( $this->panel ) {
            $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
          } else {
            $array['customizeAction'] = 'Customizing';
          }
          return $array;
        }
    }
}

// Enqueue our scripts and styles
function vw_newspaper_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_newspaper_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Newspaper_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Newspaper_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_Newspaper_Customize_Section_Pro($manager,'example_1',array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW Newspaper Pro', 'vw-newspaper' ),
			'pro_text' => esc_html__( 'Upgrade Pro', 'vw-newspaper' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/newspaper-wordpress-theme/'),
		)));
	
		// Register sections.
		$manager->add_section(new VW_Newspaper_Customize_Section_Pro($manager,'example_2',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Documentation', 'vw-newspaper' ),
			'pro_text' => esc_html__( 'Docs', 'vw-newspaper' ),
			'pro_url'  => admin_url('themes.php?page=vw_newspaper_guide'),
		)));
	}
	

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-newspaper-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-newspaper-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Newspaper_Customize::get_instance();