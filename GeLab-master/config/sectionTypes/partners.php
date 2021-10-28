<?php
return [
    'id' => 4,
    'type' => 2,
    'folder' => 'news',
	'paginate' => 9,
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',
            ],
			'link' => [
                'type' => 'text',
                'error_msg' => 'link_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',
            ],
            'active' => [
                'type' => 'checkbox',
            ],

        ],

        'nonTrans' => [
            'images' => [
                'type' => 'images',

            ],
            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20'
            ],



        ],




    ]

];
