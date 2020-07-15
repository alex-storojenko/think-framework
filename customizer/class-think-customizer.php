<?php

if ( ! class_exists( 'Think_Customizer' ) ) {
	/**
	 * Customizer framework.
	 *
	 * Class Think_Customizer
	 */
	class Think_Customizer {
		/**
		 * @var null|Think_Customizer
		 *
		 * Container for only one exemplar of @static
		 *
		 * According with realization singleton
		 */
		protected static $instance = null;

		/**
		 * <code>
		 *[
		 *    [
		 *        'id'       => 'banner',
		 *        'title'    => 'Banner',
		 *        'priority' => 1,
		 *        'active_callback' => 'is_front_page'
		 *        'controls' => [
		 *            [
		 *                'id'          => 'custom_logo',
		 *                'label'       => 'Banner cropped IMG',
		 *                'type'        => 'cropped_image',
		 *                'description' => 'LOGO uploader',
		 *                'width'       => 1920,
		 *                'height'      => 1080
		 *            ],
		 *            [
		 *                'id'       => 'banner_simple_image',
		 *                'label'    => 'Banner Simple IMG',
		 *                'type'     => 'image',
		 *                'selector' => 'img.banner-simple-img'
		 *            ],
		 *            [
		 *                'id'       => 'banner_home_title',
		 *                'label'    => 'Banner Title',
		 *                'type'     => 'input',
		 *                'default'  => 'Bla bla bla bla',
		 *                'selector' => '.banner-title'
		 *            ],
		 *            [
		 *                'id'       => 'custom_background',
		 *                'label'    => 'Background COLOR',
		 *                'type'     => 'color',
		 *                'selector' => '.custom-background'
		 *            ],
		 *            [
		 *                'id'       => 'logo_position',
		 *                'label'    => 'Position for logo',
		 *                'type'     => 'radio',
		 *                'choices'  => [
		 *                    'inleft'  => 'Left',
		 *                    'inright' => 'Right',
		 *                ],
		 *                'selector' => '.logo',
		 *            ],
		 *            [
		 *                'id'       => 'banner_description',
		 *                'label'    => 'Description',
		 *                'type'     => 'textarea',
		 *                'default'  => 'Bla bla bla bla',
		 *                'selector' => '.banner-description'
		 *            ],
		 *            [
		 *                'id'    => 'banner_additional_info',
		 *                'label' => 'Display additional information',
		 *                'type'  => 'checkbox',
		 *            ],
		 *            [
		 *                'id'       => 'askjhdkjsah',
		 *                'label'    => 'Description',
		 *                'type'     => 'tinyMCE',
		 *                'selector' => '.banner_description'
		 *            ],
		 *            [
		 *                'id'       => 'kjdhkjasd',
		 *                'label'    => 'WrapDescription',
		 *                'type'     => 'tinyMCE',
		 *                'default'  => 'Bla bla bla bla',
		 *                'selector' => '.asdsadsds'
		 *            ],
		 *            [
		 *                'id'       => 'banner_description_hyap_editor',
		 *                'label'    => 'WrapDescription',
		 *                'type'     => 'tinyMCE',
		 *                'default'  => 'Bla bla bla bla',
		 *                'selector' => '.asdasdasdsadasdas'
		 *            ],
		 *            [
		 *                'id'       => 'ksudhfksdhfkjdshfkj',
		 *                'label'    => 'WrapDescription',
		 *                'type'     => 'tinyMCE',
		 *                'default'  => 'Bla bla bla bla',
		 *                'selector' => '.asdasdasdsadsadas'
		 *            ],
		 *        ]
		 *    ],
		 *    [
		 *        'id'       => 'test',
		 *        'title'    => 'TEST section',
		 *        'priority' => 1,
		 *        'controls' => [
		 *            [
		 *                'id'       => 'date',
		 *                'label'    => 'Date',
		 *                'type'     => 'date',
		 *                'selector' => '.copyright.date'
		 *            ],
		 *            [
		 *                'id'       => 'think_image',
		 *                'label'    => 'Image',
		 *                'type'     => 'image',
		 *                'selector' => 'img.think-image'
		 *            ],
		 *            [
		 *                'id'       => 'select',
		 *                'label'    => 'Select',
		 *                'type'     => 'select',
		 *                'choices'  => [
		 *                    'inleft'  => 'Left',
		 *                    'inright' => 'Right',
		 *                ],
		 *                'selector' => '.banner-title'
		 *            ],
		 *            [
		 *                'id'       => 'color',
		 *                'label'    => 'Color',
		 *                'type'     => 'color',
		 *                'selector' => '.think-color'
		 *            ],
		 *            [
		 *                'id'       => 'layout',
		 *                'label'    => 'Choice Layout',
		 *                'type'     => 'radio',
		 *                'choices'  => [
		 *                    0 => 'Without Sidebar',
		 *                    1 => 'With sidebar',
		 *                ],
		 *                'selector' => '.sidebar',
		 *            ]
		 *        ]
		 *    ],
		 *];
		 * </code>.
		 *
		 *
		 * @var array
		 */
		protected $structure = [];

		/** Think_Customizer constructor */
		protected function __construct() {
			add_action( 'customize_preview_init', function () {
				$this->js_for_preview();
			} );

			add_action( 'customize_register', function ( $wp_customize ) {
				$this->customize_register( $wp_customize );
			} );
		}

		/**
		 * Method returned only one exemplar of @static.
		 *
		 * According with realization singleton
		 *
		 * @param array $structure @see Think_Customizer::$structure
		 *
		 * @return static
		 */
		public static function customize( array $structure ) {
			if ( null === static::$instance ) {
				static::$instance = new static();
			}

			static::$instance->merge_structures( $structure );

			return static::$instance;
		}

		protected function merge_structures( array $structure ) {
			$this->structure = array_merge( $this->structure, $structure );

			return $this;
		}

		/**
		 * Ban on cloning.
		 *
		 * According with realization singleton
		 */
		private function __clone() {
			//
		}

		/**
		 * The ban on unserialization from outside the class.
		 *
		 * According with realization singleton
		 */
		protected function __wakeup() {
			//
		}

		/**
		 * Return theme option, replace with default value if empty.
		 *
		 * @param $key
		 * @param string $default
		 *
		 * @return string
		 */
		public static function get_customizer_value( $key, $default = '' ) {
			$mod = get_theme_mod( $key );

			return ( ! $mod ) ? $default : $mod;
		}

		/** Enqueue assets */
		protected function js_for_preview() {
			wp_enqueue_script( 'wp-think-framework-customizer', get_stylesheet_directory_uri() . '/inc/customizer/assets/js/customizer.preview.js', [
				'jquery',
				'customize-preview',
			], VERSION, true );

			wp_localize_script( 'wp-think-framework-customizer', str_snake_to_camel( get_class( $this ) ), [
				'structure' => $this->structure,
			] );
		}

		/**
		 * Register customizer elem's.
		 *
		 * @param WP_Customize_Manager $wp_customize
		 */
		protected function customize_register( WP_Customize_Manager $wp_customize ) {
			if ( ! empty( $this->structure ) ) {
				foreach ( $this->structure as $section ) {
					$section_args = array(
						'title'           => $section['title'],
						'priority'        => ( ! empty( $section['priority'] ) ) ? $section['priority'] : 99,
						'active_callback' => ( ! empty( $section['active_callback'] ) ) ? $section['active_callback'] : null
					);

					$wp_customize->add_section( $section['id'], $section_args );

					if ( ! empty( $section['controls'] ) ) {
						foreach ( $section['controls'] as $setting ) {
							$default     = ( ! empty( $setting['default'] ) ) ? $setting['default'] : '';
							$type        = ( ! empty( $setting['type'] ) ) ? $setting['type'] : 'input';
							$description = ( ! empty( $setting['description'] ) ) ? $setting['description'] : '';

							$wp_customize->add_setting( $setting['id'], [
								'default' => $default,
							] );

							$defaultTransport = 'postMessage';

							if ( $type === 'image' ||
							     $type === 'cropped_image' ) {
								$defaultTransport = 'refresh';
							}

							$wp_customize->get_setting( $setting['id'] )->transport = empty( $setting['transport'] ) ?
								$defaultTransport : $setting['transport'];

							$class_args = array(
								'label'       => $setting['label'],
								'description' => $description,
								'section'     => $section['id'],
								'settings'    => $setting['id'],
								'type'        => $type,
							);

							if ( $type === 'cropped_image' ) {
								$class_args = array_merge( $class_args, [
									'flex_width'  => ( empty( $setting['flex_width'] ) ) ? true : $setting['flex_width'],
									'flex_height' => ( empty( $setting['flex_height'] ) ) ? false : $setting['flex_height'],
									'width'       => ( empty( $setting['width'] ) ) ? 512 : $setting['width'],
									'height'      => ( empty( $setting['height'] ) ) ? 512 : $setting['height'],
								] );
							} elseif ( $type === 'radio' ) {
								$class_args = array_merge( $class_args, [
									'choices' => ( empty( $setting['choices'] ) ) ? [] : $setting['choices'],
								] );
							} elseif ( $type == 'select' ) {
								$class_args = array_merge( $class_args, [
									'choices' => ( empty( $setting['choices'] ) ) ? [] : $setting['choices'],
								] );
							}

							$wp_customize->add_control( $this->get_control( $wp_customize, $setting['id'], $class_args, $type ) );
						}
					}
				}
			}
		}

		/**
		 * Get controls.
		 *
		 * @param $wp_customize
		 * @param $setting_id
		 * @param $class_args
		 * @param string $type
		 *
		 * @return WP_Customize_Control|WP_Customize_Image_Control
		 */
		protected function get_control( $wp_customize, $setting_id, $class_args, $type = 'input' ) {
			switch ( $type ) {
				case 'image':
					return new WP_Customize_Image_Control( $wp_customize, $setting_id, $class_args );
					break;

				case 'cropped_image':
					return new WP_Customize_Cropped_Image_Control( $wp_customize, $setting_id, $class_args );
					break;

				case 'color':
				case 'background_color':
					return new WP_Customize_Color_Control( $wp_customize, $setting_id, $class_args );
					break;

				case 'tinyMCE':
				case 'tinymce':
					return new Think_Customize_TinyMCE_Control( $wp_customize, $setting_id, $class_args );
					break;

				case 'date':
					return new Think_Customize_Date_Control( $wp_customize, $setting_id, $class_args );
					break;

				default:
					return new WP_Customize_Control( $wp_customize, $setting_id, $class_args );
					break;
			}
		}
	}
}
