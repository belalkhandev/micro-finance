<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
    'font_path' => base_path('resources/fonts/'),
    'font_data' => [
        'kalpurush' => [
            'R'  => 'kalpurush.ttf',    // regular font
            'B'  => 'kalpurush.ttf',       // optional: bold font
            'I'  => 'kalpurush.ttf',     // optional: italic font
            'BI' => 'kalpurush.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
    ]
];
