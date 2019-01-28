<?php

acf_add_options_page( [ 'page_title' => 'Countdown' ] );

acf_add_local_field_group( [
	'key' => 'group_5c4f4ba584c85',
	'title' => 'Countdown',
	'fields' => [
		[
			'key' => 'field_5c4f4ba590d9d',
			'label' => 'Countdown Mode',
			'name' => 'fxc_mode',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => [
				'width' => '',
				'class' => '',
				'id' => '',
			],
			'choices' => [
				'default' => 'Default',
				'custom' => 'Custom',
			],
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => 'default',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		],
		[
			'key' => 'field_5c4f4ba590eeb',
			'label' => 'Custom Countdown Start',
			'name' => 'fxc_start',
			'type' => 'date_time_picker',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => [
				[
					[
						'field' => 'field_5c4f4ba590d9d',
						'operator' => '==',
						'value' => 'custom',
					],
				],
			],
			'wrapper' => [
				'width' => '',
				'class' => '',
				'id' => '',
			],
			'display_format' => 'F j, Y g:i a',
			'return_format' => 'Y-m-d H:i:s',
			'first_day' => 1,
		],
		[
			'key' => 'field_5c4f4ba5910c8',
			'label' => 'Custom Countdown End',
			'name' => 'fxc_end',
			'type' => 'date_time_picker',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => [
				[
					[
						'field' => 'field_5c4f4ba590d9d',
						'operator' => '==',
						'value' => 'custom',
					],
				],
			],
			'wrapper' => [
				'width' => '',
				'class' => '',
				'id' => '',
			],
			'display_format' => 'F j, Y g:i a',
			'return_format' => 'Y-m-d H:i:s',
			'first_day' => 1,
		],
	],
	'location' => [
		[
			[
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-countdown',
			],
		],
	],
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
] );
