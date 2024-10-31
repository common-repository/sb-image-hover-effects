<?php

namespace SA_EL_ADDONS\Elements\Twitter;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Scheme_Color;
use Elementor\Controls_Manager;
use \Elementor\Widget_Base as Widget_Base;

class Twitter extends Widget_Base {

    use \SA_EL_ADDONS\Helper\Elementor_Helper;

    public function get_name() {
        return 'sa_el_twitter';
    }

    public function get_title() {
        return esc_html__('Twitter', SA_EL_ADDONS_TEXTDOMAIN);
    }

    public function get_icon() {
        return 'eicon-twitter-embed  oxi-el-admin-icon';
    }

    public function get_categories() {
        return ['sa-el-addons'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_general',
            [
                'label' => __( 'General', SA_EL_ADDONS_TEXTDOMAIN )
            ]
        );

        $this->add_control(
            'embed_type',
            [
                'label'   => __( 'Type', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'handle',
                'options' => [
                    'collection'  => __( 'Collection', SA_EL_ADDONS_TEXTDOMAIN ),
                    'tweet'  => __( 'Tweet', SA_EL_ADDONS_TEXTDOMAIN ),
                    'profile'  => __( 'Profile', SA_EL_ADDONS_TEXTDOMAIN ),
                    'list'  => __( 'List', SA_EL_ADDONS_TEXTDOMAIN ),
                    'moments'  => __( 'Moments', SA_EL_ADDONS_TEXTDOMAIN ),
                    'likes'  => __( 'Likes', SA_EL_ADDONS_TEXTDOMAIN ),
                    'handle'  => __( 'Handle', SA_EL_ADDONS_TEXTDOMAIN ),
                    'hashtag' => __( 'Hashtag', SA_EL_ADDONS_TEXTDOMAIN ),
                ]
            ]
        );

        $this->add_control(
            'url_collection',
            [
                'label'       => __( 'Enter URL', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', SA_EL_ADDONS_TEXTDOMAIN ),
                'default'     => 'https://twitter.com/TwitterDev/timelines/539487832448843776',
                'condition'   => [
                    'embed_type' => 'collection'
                ]

            ]
        );

        $this->add_control(
            'url_profile',
            [
                'label'       => __( 'Enter URL', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/TwitterDev', SA_EL_ADDONS_TEXTDOMAIN ),
                'default'     => 'https://twitter.com/TwitterDev',
                'condition'   => [
                    'embed_type' => 'profile'
                ]

            ]
        );

        $this->add_control(
            'url_list',
            [
                'label'       => __( 'Enter URL', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', SA_EL_ADDONS_TEXTDOMAIN ),
                'default'     => 'https://twitter.com/TwitterDev/lists/national-parks',
                'condition'   => [
                    'embed_type' => 'list'
                ]

            ]
        );

        $this->add_control(
            'url_moments',
            [
                'label'       => __( 'Enter URL', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', SA_EL_ADDONS_TEXTDOMAIN ),
                'default'     => 'https://twitter.com/i/moments/625792726546558977',
                'condition'   => [
                    'embed_type' => 'moments'
                ]

            ]
        );

        $this->add_control(
            'url_likes',
            [
                'label'       => __( 'Enter URL', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', SA_EL_ADDONS_TEXTDOMAIN ),
                'default'     => 'https://twitter.com/TwitterDev/likes',
                'condition'   => [
                    'embed_type' => 'likes'
                ]

            ]
        );

        $this->add_control(
            'username',
            [
                'label'       => __( 'Enter UserName', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( '@username', SA_EL_ADDONS_TEXTDOMAIN ),
                'default'     => '@TwitterDev',
                'condition'   => [
                    'embed_type' => 'handle',
                ]
            ]

        );


        $this->add_control(
            'hashtag',
            [
                'label'       => __( 'Enter Hashtag', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( '#hashtag', SA_EL_ADDONS_TEXTDOMAIN ),
                'condition'   => [
                    'embed_type' => 'hashtag',
                ]
            ]

        );

        $this->add_control(
            'display_mode_collection',
            [
                'label'     => __( 'Display Mode', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'timeline',
                'options'   => [
                    'timeline' => __( 'Timeline', SA_EL_ADDONS_TEXTDOMAIN ),
                    'grid'     => __( 'Grid', SA_EL_ADDONS_TEXTDOMAIN ),
                ],
                'condition' => [
                    'embed_type' => 'collection'
                ]

            ]
        );

        $this->add_control(
            'no_of_tweets',
            [
                'label'     => __( 'Display No of Tweets', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 20,
                'min'       => '2',
                'max'       => '50',
                'step'      => '1',
                'condition' => [

                    'display_mode_collection' => 'grid',
                    'embed_type'              => 'collection',
                ]
            ]
        );

    
        $this->add_control(
            'height_collection_timeline',
            [
                'label'     => __( 'Height', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,

                ],
                'range'     => [
                    'px' => [
                        'min'  => 250,
                        'max'  => 1300,
                        'step' => 10
                    ]
                ],
                'condition' => [

                    'display_mode_collection' => 'timeline',
                    'embed_type'              => 'collection',
                ]
            ]
        );

        $this->add_control(
            'theme_collection_timeline',
            [
                'label'     => __( 'Theme', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'light',
                'options'   => [
                    'light' => __( 'Light', SA_EL_ADDONS_TEXTDOMAIN ),
                    'dark'  => __( 'Dark', SA_EL_ADDONS_TEXTDOMAIN ),
                ],
                'condition' => [
                    'display_mode_collection' => 'timeline',
                    'embed_type'              => 'collection',
                ]
            ]
        );

        $this->add_control(
            'link_color_collection',
            [
                'label'     => __( 'Display Link Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [

                    'display_mode_collection' => 'timeline',
                    'embed_type'              => 'collection',

                ]
            ]
        );

        $this->add_control(
            'display_mode_profile',
            [
                'label'     => __( 'Display Mode', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'timeline',
                'options'   => [
                    'timeline' => __( 'Timeline', SA_EL_ADDONS_TEXTDOMAIN ),
                    'button'   => __( 'Button', SA_EL_ADDONS_TEXTDOMAIN ),
                ],
                'condition' => [
                    'embed_type' => [ 'profile', 'handle' ]
                ]

            ]
        );

        $this->add_control(
            'height_profile_timeline',
            [
                'label'     => __( 'Height', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,

                ],
                'range'     => [
                    'px' => [
                        'min'  => 250,
                        'max'  => 1300,
                        'step' => 10
                    ]
                ],
                'condition' => [

                    'display_mode_profile' => 'timeline',
                    'embed_type'           => [ 'profile', 'handle' ]
                ]
            ]
        );

        $this->add_control(
            'theme_profile_timeline',
            [
                'label'     => __( 'Theme', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'light',
                'options'   => [
                    'light' => __( 'Light', SA_EL_ADDONS_TEXTDOMAIN ),
                    'dark'  => __( 'Dark', SA_EL_ADDONS_TEXTDOMAIN ),
                ],
                'condition' => [
                    'display_mode_profile' => 'timeline',
                    'embed_type'           => [ 'profile', 'handle' ]
                ]
            ]
        );

        $this->add_control(
            'link_color_profile',
            [
                'label'     => __( 'Display Link Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [

                    'display_mode_profile' => 'timeline',
                    'embed_type'           => [ 'profile', 'handle' ]


                ]
            ]
        );


        $this->add_control(
            'button_type',
            [
                'label'     => __( 'Button Type', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'follow-button',
                'options'   => [
                    'follow-button'  => __( 'Follow', SA_EL_ADDONS_TEXTDOMAIN ),
                    'mention-button' => __( 'Mention', SA_EL_ADDONS_TEXTDOMAIN ),
                ],
                'condition' => [
                    'display_mode_profile' => 'button',
                    'embed_type'           => [ 'profile', 'handle' ]
                ]
            ]
        );

        $this->add_control(
            'hide_name',
            [
                'label'        => __( 'Hide Name', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => __( 'Show', SA_EL_ADDONS_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', SA_EL_ADDONS_TEXTDOMAIN ),
                'return_value' => 'yes',
                'condition'    => [

                    'display_mode_profile' => 'button',
                    'button_type'          => 'follow-button',
                    'embed_type'           => [ 'profile', 'handle' ]

                ]
            ]

        );

        $this->add_control(
            'show_count',
            [
                'label'        => __( 'Show Count', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __( 'Show', SA_EL_ADDONS_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', SA_EL_ADDONS_TEXTDOMAIN ),
                'return_value' => 'yes',
                'condition'    => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button',
                    'button_type'          => 'follow-button'

                ]
            ]

        );

        $this->add_control(
            'prefill_text',
            [
                'label'       => __( 'Tweet Text', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'description' => __( 'Do you want to prefill the Tweet text?', SA_EL_ADDONS_TEXTDOMAIN ),
                'condition'   => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button',
                    'button_type'          => 'mention-button',
                ],

            ]
        );

        $this->add_control(
            'screen_name',
            [
                'label'     => __( 'Screen Name', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button',
                    'button_type'          => 'mention-button'
                ]
            ]
        );

        $this->add_control(
            'large_button',
            [
                'label'        => __( 'Large Button', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => __( 'Yes', SA_EL_ADDONS_TEXTDOMAIN ),
                'label_off'    => __( 'No', SA_EL_ADDONS_TEXTDOMAIN ),
                'return_value' => 'yes',
                'condition'    => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button'


                ]
            ]

        );
        $this->add_control(
            'height_list',
            [
                'label'     => __( 'Height', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,

                ],
                'range'     => [
                    'px' => [
                        'min'  => 250,
                        'max'  => 1300,
                        'step' => 10
                    ]
                ],
                'condition' => [

                    'embed_type' => [ 'list', 'likes' ],

                ]
            ]
        );

        $this->add_control(
            'theme_list',
            [
                'label'     => __( 'Theme', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'light',
                'options'   => [
                    'light' => __( 'Light', SA_EL_ADDONS_TEXTDOMAIN ),
                    'dark'  => __( 'Dark', SA_EL_ADDONS_TEXTDOMAIN ),
                ],
                'condition' => [
                    'embed_type' => [ 'list', 'likes' ]
                ]
            ]
        );

        $this->add_control(
            'link_color_list',
            [
                'label'     => __( 'Display Link Color', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [

                    'embed_type' => [ 'list', 'likes' ]


                ]
            ]
        );

        $prefill_options = [];
        if ( is_single() ) {
            $prefill_options = [
                'post_title' => __( 'Post Title', SA_EL_ADDONS_TEXTDOMAIN ),
                'excerpt'    => __( 'Post Excerpt', SA_EL_ADDONS_TEXTDOMAIN ),
            ];
        }

        $prefill_options['custom'] = 'Custom';
        $this->add_control(
            'prefill_text_hashtag',
            [
                'label'     => __( 'Pre Fill Text', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'post_title',
                'options'   => $prefill_options,
                'condition' => [
                    'embed_type' => 'hashtag',
                ],
                'description' => __( 'Do you want to prefill the Tweet text?', SA_EL_ADDONS_TEXTDOMAIN ),
            ]
        );
        $this->add_control(
            'prefill_custom',
            [
                'label'     => __( 'Custom Prefill Text', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'      => Controls_Manager::TEXTAREA,
                'condition' => [
                    'prefill_text_hashtag' => 'custom',
                    'embed_type'           => 'hashtag'
                ]

            ]
        );

        $this->add_control(
            'hashtag_url',
            [
                'label'       => __( 'Fix Url in Tweet' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'description' => __( 'Do you want to set a specific URL in the Tweet?', SA_EL_ADDONS_TEXTDOMAIN ),
                'condition'   => [
                    'embed_type' => 'hashtag'
                ]
            ]
        );


        $this->add_control(
            'language',
            [
                'label'   => __( 'Language', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->languages(),
                'default' => ''
            ]
        );

        $this->add_control(
            'hashtag_large_button',
            [
                'label'        => __( 'Large Button', SA_EL_ADDONS_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => __( 'Yes', SA_EL_ADDONS_TEXTDOMAIN ),
                'label_off'    => __( 'No', SA_EL_ADDONS_TEXTDOMAIN ),
                'return_value' => 'yes',
                'condition'    => [
                    'embed_type' => 'hashtag',
                ]
            ]

        );
        $this->end_controls_section();

        $this->Sa_El_Support();

    }

    public function languages() {
        $languages = [
            ''      => __( 'Automatic', SA_EL_ADDONS_TEXTDOMAIN ),
            'en'    => __( 'English', SA_EL_ADDONS_TEXTDOMAIN ),
            'ar'    => __( 'Arabic', SA_EL_ADDONS_TEXTDOMAIN ),
            'bn'    => __( 'Bengali', SA_EL_ADDONS_TEXTDOMAIN ),
            'cs'    => __( 'Czech', SA_EL_ADDONS_TEXTDOMAIN ),
            'da'    => __( 'Danish', SA_EL_ADDONS_TEXTDOMAIN ),
            'de'    => __( 'German', SA_EL_ADDONS_TEXTDOMAIN ),
            'el'    => __( 'Greek', SA_EL_ADDONS_TEXTDOMAIN ),
            'es'    => __( 'Spanish', SA_EL_ADDONS_TEXTDOMAIN ),
            'fa'    => __( 'Persian', SA_EL_ADDONS_TEXTDOMAIN ),
            'fi'    => __( 'Finnish', SA_EL_ADDONS_TEXTDOMAIN ),
            'fil'   => __( 'Filipino', SA_EL_ADDONS_TEXTDOMAIN ),
            'fr'    => __( 'French', SA_EL_ADDONS_TEXTDOMAIN ),
            'he'    => __( 'Hebrew', SA_EL_ADDONS_TEXTDOMAIN ),
            'hi'    => __( 'Hindi', SA_EL_ADDONS_TEXTDOMAIN ),
            'hu'    => __( 'Hungarian', SA_EL_ADDONS_TEXTDOMAIN ),
            'id'    => __( 'Indonesian', SA_EL_ADDONS_TEXTDOMAIN ),
            'it'    => __( 'Italian', SA_EL_ADDONS_TEXTDOMAIN ),
            'ja'    => __( 'Japanese', SA_EL_ADDONS_TEXTDOMAIN ),
            'ko'    => __( 'Korean', SA_EL_ADDONS_TEXTDOMAIN ),
            'msa'   => __( 'Malay', SA_EL_ADDONS_TEXTDOMAIN ),
            'nl'    => __( 'Dutch', SA_EL_ADDONS_TEXTDOMAIN ),
            'no'    => __( 'Norwegian', SA_EL_ADDONS_TEXTDOMAIN ),
            'pl'    => __( 'Polish', SA_EL_ADDONS_TEXTDOMAIN ),
            'pt'    => __( 'Portuguese', SA_EL_ADDONS_TEXTDOMAIN ),
            'ro'    => __( 'Romania', SA_EL_ADDONS_TEXTDOMAIN ),
            'ru'    => __( 'Rus', SA_EL_ADDONS_TEXTDOMAIN ),
            'sv'    => __( 'Swedish', SA_EL_ADDONS_TEXTDOMAIN ),
            'th'    => __( 'Thai', SA_EL_ADDONS_TEXTDOMAIN ),
            'tr'    => __( 'Turkish', SA_EL_ADDONS_TEXTDOMAIN ),
            'uk'    => __( 'Ukrainian', SA_EL_ADDONS_TEXTDOMAIN ),
            'ur'    => __( 'Urdu', SA_EL_ADDONS_TEXTDOMAIN ),
            'vi'    => __( 'Vietnamese', SA_EL_ADDONS_TEXTDOMAIN ),
            'zh-cn' => __( 'Chinese (Simplified)', SA_EL_ADDONS_TEXTDOMAIN ),
            'zh-tw' => __( 'Chinese (Traditional)', SA_EL_ADDONS_TEXTDOMAIN ),
        ];

        return $languages;

    }

	public function render() {
		$settings = $this->get_settings();


		switch ( $settings['embed_type'] ) {

			case "collection":
				$this->get_collection_html( $settings );
				break;

			case "profile":
				$this->get_profile_html( $settings );
				break;

			case "list":
				$this->get_list_html( $settings );
				break;

			case "moments":
				$this->get_moments_html( $settings );
				break;

			case "likes" :
				$this->get_likes_html( $settings );
				break;

			case "handle" :
				$this->get_handle_html( $settings );
				break;
			case "hashtag":
				$this->get_hashtag_html( $settings );
				break;

		}
		?>
       <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		<?php

	}

	public function get_collection_html( $settings ) {
		$this->add_render_attribute( 'collection', 'class', 'twitter-' . $settings['display_mode_collection'] );
		$this->add_render_attribute( 'collection', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'collection', 'data-partner', 'twitter-deck' );
		$this->add_render_attribute( 'collection', 'href', $settings['url_collection'] );

		if ( $settings['display_mode_collection'] == 'grid' ) {
			$this->add_render_attribute( 'collection', 'data-limit', $settings['no_of_tweets'] );
		}
		if ( $settings['display_mode_collection'] == 'timeline' ) {
			$this->add_render_attribute( 'collection', 'data-height', $settings['height_collection_timeline']['size'] );
			$this->add_render_attribute( 'collection', 'data-theme', $settings['theme_collection_timeline'] );
			$this->add_render_attribute( 'collection', 'data-link-color', $settings['link_color_collection'] );

		}

		?>
        <a <?php echo $this->get_render_attribute_string( 'collection' ); ?>></a>
		<?php
	}

	public function get_profile_html( $settings ) {
		$this->add_render_attribute( 'profile', 'href', $settings['url_profile'] );
		$this->add_render_attribute( 'profile', 'data-lang', $settings['language'] );
		if ( $settings['large_button'] == 'yes' ) {
			$this->add_render_attribute( 'profile', 'data-size', 'large' );
		}


		if ( $settings['display_mode_profile'] == 'timeline' ) {
			$this->add_render_attribute( 'profile', 'class', 'twitter-' . $settings['display_mode_profile'] );
			$this->add_render_attribute( 'profile', 'data-partner', 'twitter-deck' );
			$this->add_render_attribute( 'profile', 'data-height', $settings['height_profile_timeline']['size'] );
			$this->add_render_attribute( 'profile', 'data-theme', $settings['theme_profile_timeline'] );
			$this->add_render_attribute( 'profile', 'data-link-color', $settings['link_color_profile'] );

		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'follow-button' ) {
			$this->add_render_attribute( 'profile', 'class', 'twitter-' . $settings['button_type'] );
			if ( $settings['hide_name'] == 'yes' ) {
				$this->add_render_attribute( 'profile', 'data-show-screen-name', 'false' );
			}
			if ( $settings['show_count'] == '' ) {
				$this->add_render_attribute( 'profile', 'data-show-count', 'false' );
			}
		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'mention-button' ) {
			$this->add_render_attribute( 'profile', 'class', 'twitter-' . $settings['button_type'] );
			$this->add_render_attribute( 'profile', 'data-text', $settings['prefill_text'] );
			$this->add_render_attribute( 'profile', 'href', $settings['url_profile'] . '?screen_name=' . $settings['screen_name'] );

		}

		?>
    <a <?php echo $this->get_render_attribute_string( 'profile' ); ?> ></a><?php
	}

	public function get_list_html( $settings ) {
		if ( $settings['embed_type'] == 'list' ) {
			$this->add_render_attribute( 'list', 'class', 'twitter-timeline' );
		}
		$this->add_render_attribute( 'list', 'href', $settings['url_list'] );
		$this->add_render_attribute( 'list', 'data-height', $settings['height_list']['size'] );
		$this->add_render_attribute( 'list', 'data-theme', $settings['theme_list'] );
		$this->add_render_attribute( 'list', 'data-link-color', $settings['link_color_list'] );
		$this->add_render_attribute( 'list', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'list', 'data-partner', 'twitter-deck' );
		?>
    <a <?php echo $this->get_render_attribute_string( 'list' ); ?>> </a><?php

	}

	public function get_moments_html( $settings ) {
		if ( $settings['embed_type'] == 'moments' ) {
			$this->add_render_attribute( 'moments', 'class', 'twitter-moment' );
		}
		$this->add_render_attribute( 'moments', 'href', $settings['url_moments'] );
		$this->add_render_attribute( 'moments', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'moments', 'data-partner', 'twitter-deck' );
		?>
        <a <?php echo $this->get_render_attribute_string( 'moments' ); ?> > </a>
		<?php

	}

	public function get_likes_html( $settings ) {
		if ( $settings['embed_type'] == 'likes' ) {
			$this->add_render_attribute( 'likes', 'class', 'twitter-timeline' );
		}
		$this->add_render_attribute( 'likes', 'href', $settings['url_likes'] );
		$this->add_render_attribute( 'likes', 'data-height', $settings['height_list']['size'] );
		$this->add_render_attribute( 'likes', 'data-theme', $settings['theme_list'] );
		$this->add_render_attribute( 'likes', 'data-link-color', $settings['link_color_list'] );
		$this->add_render_attribute( 'likes', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'likes', 'data-partner', 'twitter-deck' );
		?>
        <a <?php echo $this->get_render_attribute_string( 'likes' ) ?> >Likes </a>
		<?php
	}

	public function get_handle_html( $settings ) {

		$this->add_render_attribute( 'handle', 'data-lang', $settings['language'] );
		if ( $settings['large_button'] == 'yes' ) {
			$this->add_render_attribute( 'handle', 'data-size', 'large' );
		}


		if ( $settings['display_mode_profile'] == 'timeline' ) {
            $this->add_render_attribute( 'handle', 'href', 'https://www.twitter.com/' . $settings['username'] );
			$this->add_render_attribute( 'handle', 'class', 'twitter-' . $settings['display_mode_profile'] );
			$this->add_render_attribute( 'handle', 'data-partner', 'twitter-deck' );
			$this->add_render_attribute( 'handle', 'data-height', $settings['height_profile_timeline']['size'] );
			$this->add_render_attribute( 'handle', 'data-theme', $settings['theme_profile_timeline'] );
			$this->add_render_attribute( 'handle', 'data-link-color', $settings['link_color_profile'] );

		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'follow-button' ) {
			$this->add_render_attribute( 'handle', 'class', 'twitter-' . $settings['button_type'] );
            $this->add_render_attribute( 'handle', 'href', 'https://www.twitter.com/' . $settings['username'] );
            if ( $settings['hide_name'] == 'yes' ) {
				$this->add_render_attribute( 'handle', 'data-show-screen-name', 'false' );
			}
			if ( $settings['show_count'] == '' ) {
				$this->add_render_attribute( 'handle', 'data-show-count', 'false' );
			}
		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'mention-button' ) {
			$this->add_render_attribute( 'handle', 'class', 'twitter-' . $settings['button_type'] );
			$this->add_render_attribute( 'handle', 'data-text', $settings['prefill_text'] );
            $this->add_render_attribute( 'handle', 'href','https://www.twitter.com/intent/tweet' . '?screen_name=' . $settings['screen_name'] );


		}

		?>
    <a <?php echo $this->get_render_attribute_string( 'handle' ); ?> > Handle <?php echo $settings['username']; ?></a><?php
	}

	public function get_hashtag_html( $settings ) {

		$this->add_render_attribute( 'hashtag', 'class', 'twitter-hashtag-button' );
		$this->add_render_attribute( 'hashtag', 'href', 'https://twitter.com/intent/tweet?button_hashtag=' . $settings['hashtag'] );
		$this->add_render_attribute( 'hashtag', 'data-lang', $settings['language'] );

		if ( $settings['prefill_text_hashtag'] == 'post_title' ) {

			$this->add_render_attribute( 'hashtag', 'data-text', $this->current_post_title() );
		}
		if ( $settings['prefill_text_hashtag'] == 'excerpt' ) {

			$this->add_render_attribute( 'hashtag', 'data-text', $this->current_post_excerpt() );
		}
		if ( $settings['prefill_text_hashtag'] == 'custom' ) {
			$this->add_render_attribute( 'hashtag', 'data-text', $settings['prefill_custom'] );
		}
		if ( $settings['hashtag_large_button'] == 'yes' ) {
			$this->add_render_attribute( 'hashtag', 'data-size', 'large' );
		}
		$this->add_render_attribute( 'hashtag', 'data-url', $settings['hashtag_url'] );

		?>
        <a <?php echo $this->get_render_attribute_string( 'hashtag' ); ?> >Tweet<?php echo $settings['hashtag']; ?> </a>
		<?php


	}

	public function current_post_title() {

		global $post;
		$title = $post->post_title;

		return $title;

	}

	public function current_post_excerpt() {
		global $post;


		if ( has_excerpt( $post->ID ) ) {
			return get_the_excerpt( $post->ID );
		} else {

		}
	}




}
