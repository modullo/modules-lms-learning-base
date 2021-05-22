<?php

return [
    'quizzes' => [
        'icon' => 'fa fa-home',
        'dashboard' => 'all',
        'title' => 'Quiz Management',
        'route' => 'learner/dashboard',
        'clickable' => true,
        'navbar' => true,
        'visibility' => false,
        'sub-menu' => [
            'product' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Product',
                'route' => 'password',
                'clickable' => true,
                'navbar' => true,
            ],
        ],
//        'sub-menu-display' => 'hide'
    ],
    'courses' => [
        'icon' => 'fa fa-home',
        'dashboard' => 'all',
        'title' => 'Courses',
        'route' => 'learner/courses',
        'clickable' => true,
        'navbar' => true,
        'visibility' => true,
        'sub-menu' => [
            'product' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Product',
                'route' => 'password',
                'clickable' => true,
                'navbar' => true,
            ],
            'school' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'School',
                'route' => 'password',
                'clickable' => true,
                'navbar' => true,
            ],
            'market' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Market',
                'route' => 'password',
                'clickable' => true,
                'navbar' => true,
            ],
        ],
    ]
];
