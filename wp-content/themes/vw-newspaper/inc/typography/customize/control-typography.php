<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Newspaper_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-newspaper' ),
				'family'      => esc_html__( 'Font Family', 'vw-newspaper' ),
				'size'        => esc_html__( 'Font Size',   'vw-newspaper' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-newspaper' ),
				'style'       => esc_html__( 'Font Style',  'vw-newspaper' ),
				'line_height' => esc_html__( 'Line Height', 'vw-newspaper' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-newspaper' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-newspaper-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-newspaper-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-newspaper' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-newspaper' ),
        'Acme' => __( 'Acme', 'vw-newspaper' ),
        'Anton' => __( 'Anton', 'vw-newspaper' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-newspaper' ),
        'Arimo' => __( 'Arimo', 'vw-newspaper' ),
        'Arsenal' => __( 'Arsenal', 'vw-newspaper' ),
        'Arvo' => __( 'Arvo', 'vw-newspaper' ),
        'Alegreya' => __( 'Alegreya', 'vw-newspaper' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-newspaper' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-newspaper' ),
        'Bangers' => __( 'Bangers', 'vw-newspaper' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-newspaper' ),
        'Bad Script' => __( 'Bad Script', 'vw-newspaper' ),
        'Bitter' => __( 'Bitter', 'vw-newspaper' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-newspaper' ),
        'BenchNine' => __( 'BenchNine', 'vw-newspaper' ),
        'Cabin' => __( 'Cabin', 'vw-newspaper' ),
        'Cardo' => __( 'Cardo', 'vw-newspaper' ),
        'Courgette' => __( 'Courgette', 'vw-newspaper' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-newspaper' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-newspaper' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-newspaper' ),
        'Cuprum' => __( 'Cuprum', 'vw-newspaper' ),
        'Cookie' => __( 'Cookie', 'vw-newspaper' ),
        'Chewy' => __( 'Chewy', 'vw-newspaper' ),
        'Days One' => __( 'Days One', 'vw-newspaper' ),
        'Dosis' => __( 'Dosis', 'vw-newspaper' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-newspaper' ),
        'Economica' => __( 'Economica', 'vw-newspaper' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-newspaper' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-newspaper' ),
        'Francois One' => __( 'Francois One', 'vw-newspaper' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-newspaper' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-newspaper' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-newspaper' ),
        'Handlee' => __( 'Handlee', 'vw-newspaper' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-newspaper' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-newspaper' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-newspaper' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-newspaper' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-newspaper' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-newspaper' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-newspaper' ),
        'Kanit' => __( 'Kanit', 'vw-newspaper' ),
        'Lobster' => __( 'Lobster', 'vw-newspaper' ),
        'Lato' => __( 'Lato', 'vw-newspaper' ),
        'Lora' => __( 'Lora', 'vw-newspaper' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-newspaper' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-newspaper' ),
        'Merriweather' => __( 'Merriweather', 'vw-newspaper' ),
        'Monda' => __( 'Monda', 'vw-newspaper' ),
        'Montserrat' => __( 'Montserrat', 'vw-newspaper' ),
        'Muli' => __( 'Muli', 'vw-newspaper' ),
        'Marck Script' => __( 'Marck Script', 'vw-newspaper' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-newspaper' ),
        'Open Sans' => __( 'Open Sans', 'vw-newspaper' ),
        'Overpass' => __( 'Overpass', 'vw-newspaper' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-newspaper' ),
        'Oxygen' => __( 'Oxygen', 'vw-newspaper' ),
        'Orbitron' => __( 'Orbitron', 'vw-newspaper' ),
        'Patua One' => __( 'Patua One', 'vw-newspaper' ),
        'Pacifico' => __( 'Pacifico', 'vw-newspaper' ),
        'Padauk' => __( 'Padauk', 'vw-newspaper' ),
        'Playball' => __( 'Playball', 'vw-newspaper' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-newspaper' ),
        'PT Sans' => __( 'PT Sans', 'vw-newspaper' ),
        'Philosopher' => __( 'Philosopher', 'vw-newspaper' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-newspaper' ),
        'Poiret One' => __( 'Poiret One', 'vw-newspaper' ),
        'Quicksand' => __( 'Quicksand', 'vw-newspaper' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-newspaper' ),
        'Raleway' => __( 'Raleway', 'vw-newspaper' ),
        'Rubik' => __( 'Rubik', 'vw-newspaper' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-newspaper' ),
        'Russo One' => __( 'Russo One', 'vw-newspaper' ),
        'Righteous' => __( 'Righteous', 'vw-newspaper' ),
        'Slabo' => __( 'Slabo', 'vw-newspaper' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-newspaper' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-newspaper'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-newspaper' ),
        'Sacramento' => __( 'Sacramento', 'vw-newspaper' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-newspaper' ),
        'Tangerine' => __( 'Tangerine', 'vw-newspaper' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-newspaper' ),
        'VT323' => __( 'VT323', 'vw-newspaper' ),
        'Varela Round' => __( 'Varela Round', 'vw-newspaper' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-newspaper' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-newspaper' ),
        'Volkhov' => __( 'Volkhov', 'vw-newspaper' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-newspaper' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-newspaper' ),
			'100' => esc_html__( 'Thin',       'vw-newspaper' ),
			'300' => esc_html__( 'Light',      'vw-newspaper' ),
			'400' => esc_html__( 'Normal',     'vw-newspaper' ),
			'500' => esc_html__( 'Medium',     'vw-newspaper' ),
			'700' => esc_html__( 'Bold',       'vw-newspaper' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-newspaper' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-newspaper' ),
			'italic'  => esc_html__( 'Italic', 'vw-newspaper' ),
			'oblique' => esc_html__( 'Oblique', 'vw-newspaper' )
		);
	}
}
