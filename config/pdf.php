<?php
return [
    'mode'                       => '',
    'format'                     => 'A4',
    'default_font_size'          => '12',
    'margin_left'                => 10,
    'margin_right'               => 10,
    'margin_top'                 => 10,
    'margin_bottom'              => 10,
    'margin_header'              => 0,
    'margin_footer'              => 0,
    'orientation'                => 'P',
    'title'                      => 'Laravel mPDF',
    'author'                     => '',
    'watermark'                  => '',
    'show_watermark'             => false,
    'show_watermark_image'       => false,
    'watermark_font'             => 'sans-serif',
    'display_mode'               => 'fullpage',
    'watermark_text_alpha'       => 0.1,
    'watermark_image_path'       => '',
    'watermark_image_alpha'      => 0.2,
    'watermark_image_size'       => 'D',
    'watermark_image_position'   => 'P',
    'custom_font_dir'            => base_path('resources/fonts/'),
    'custom_font_data'           => [
        'kalpurush' => [
            'R'  => 'kalpurush.ttf',    // regular font
            'B'  => 'kalpurush.ttf',       // optional: bold font
            'I'  => 'kalpurush.ttf',     // optional: italic font
            'BI' => 'kalpurush.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
    ],
    'auto_language_detection'    => false,
    'temp_dir'                   => storage_path('app'),
    'pdfa'                       => false,
    'pdfaauto'                   => false,
    'use_active_forms'           => false,
    'default_font' => 'Roboto'
];
