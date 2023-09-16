<?php

return [
    'guest_booking_code' => env('GUEST_BOOKING_CODE'),
    'year' => env('YEAR'),
    'guest_booking_limit' => env('GUEST_BOOKING_LIMIT'),
    'member_booking_limit' => env('MEMBER_BOOKING_LIMIT'),
    'guest_slot_today' => env('SLOT_ID_TODAY_GUEST'),
    'member_slot_today' => env('SLOT_ID_TODAY_MEMBER'),
    'display_disclosure_prompt' => env('DISPLAY_DISCLOSURE_PROMPT'),
    'api_key' => env('API_KEY'),
    'slots_allotment' => [
        'Day 1' => [1, 5],
        'Day 2' => [2, 6],
        'Day 3' => [3, 7],
        'Day 4' => [4, 8]
    ],
    'chart_color' => [
        'Day 1' => [
            'all' => '#fd7f6f',
            'member' => '#e60049',
            'guest' => '#ffa300'
        ],
        'Day 2' => [
            'all' => '#7eb0d5',
            'member' => '#0bb4ff',
            'guest' => '#dc0ab4'
        ],
        'Day 3' => [
            'all' => '#beb9db',
            'member' => '#50e991',
            'guest' => '#b3d4ff'
        ],
        'Day 4' => [
            'all' => '#fdcce5',
            'member' => '#e6d800',
            'guest' => '#00bfa0'
        ]
    ]
];
