<?php

return [
    'meta' => [
        'title'       => 'Jago Bahasa Calculator',
        'description' => 'Jago Bahasa Calculator untuk menghitung deadline paket belajar dan minggu berdasarkan jumlah meeting.',
        'url'         => 'https://misteralku.github.io/jbcalculator/',
        'image'       => 'og-image.png',
        'site_name'   => 'misteralku.github.io/jbcalculator',
    ],

    'meetings_per_week'   => 5,
    'duration_offset_days' => -3,

    'packages' => [
        '2minggu' => ['label' => '2 Minggu',  'weeks' => 2,  'extension' => 7],
        '1bulan'  => ['label' => '1 Bulan',   'weeks' => 4,  'extension' => 14],
        '2bulan'  => ['label' => '2 Bulan',   'weeks' => 8,  'extension' => 30],
        '3bulan'  => ['label' => '3 Bulan',   'weeks' => 12, 'extension' => 30],
        '4bulan'  => ['label' => '4 Bulan',   'weeks' => 16, 'extension' => 30],
        '5bulan'  => ['label' => '5 Bulan',   'weeks' => 20, 'extension' => 30],
        '6bulan'  => ['label' => '6 Bulan',   'weeks' => 24, 'extension' => 60],
        '12bulan' => ['label' => '12 Bulan',  'weeks' => 48, 'extension' => 60],
    ],
];