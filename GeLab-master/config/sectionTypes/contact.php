<?php
return [
    'id' => 8,
    'type' => 1,
    'folder' => 'contact',
    'fields' => [
        'trans' => [
            'address' => [
                'type' => 'text',
                'error_msg' => 'address_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ]

        ],

        'nonTrans' => [
            'address_link' => [
                'type' => 'text',
            ],
			'email' => [
                'type' => 'text',
            ],
            'phone' => [
                'type' => 'text',
            ],
            'facebook_text' => [
                'type' => 'text',
            ],
            'facebook_link' => [
                'type' => 'text',
            ],
            'linkedin_text' => [
                'type' => 'text',
            ],
            'linkedin_link' => [
                'type' => 'text',
            ],
            'google_maps_iframe' => [
                'type' => 'text',
            ],



        ],




    ]

];
