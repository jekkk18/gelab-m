<?php
return [
    'id' => 5,
    'type' => 3,
	'paginate' => 9,
    'folder' => 'photo_gallery',
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',
    
            ],
            'keywords' => [
                'type' => 'keywords',
                'reqired' => 'required',
                'max' => '100',
                'min' => '3',
    
            ],
			'slug' => [

                'type' => 'text',
                'error_msg' => 'slug_is_required',
                'required' => 'required',
            ],

            'desc' => [
                'type' => 'textarea',
                'max' => '2000',
                'min' => '3',
                'validation' => 'min:3|max:20'
    
            ],
			'images' => [
                'type' => 'images',

            ],
			
            'active' => [
                'type' => 'checkbox',
            ],
            
        ],

        'nonTrans' => [
            
			
            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20'
            ],
			
            
            
        ],
        
        
        
        
    ]

];