<?php

return [
    'tenant-course-management' => [
        'audience' => 'tenant',
        'icon' => 'fa fa-graduation-cap',
        'dashboard' => 'all',
        'title' => 'Learning Management',
        'route' => '',
        'link' => 's',
        'clickable' => true,
        'navbar' => true,
        'visibility' => true,
        'order' => 0,
        'sub-menu' => [
            'programs' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Programs',
                'route' => '',
                'link' => '/tenant/programs',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
            'course' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Courses',
                'route' => '',
                'link' => '/tenant/courses',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
            'modules' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Modules',
                'route' => '',
                'link' => '/tenant/modules',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
            'lesson' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Lessons',
                'route' => '',
                'link' => '/tenant/lessons',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
        ],
    ],
    'tenant-resources-management' => [
        'audience' => 'tenant',
        'icon' => 'fa fa-file',
        'dashboard' => 'all',
        'title' => 'Lesson Resources',
        'route' => '',
        'link' => '/tenant/quiz',
        'clickable' => true,
        'navbar' => true,
        'visibility' => true,
        'order' => 0,
        'sub-menu' => [
            'asset' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Media Assets',
                'route' => '',
                'link' => '/tenant/assets',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
            'quiz' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Quiz & Case Studies',
                'route' => '',
                'link' => '/tenant/quiz',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
        ],
    ],
    'courses' => [
        'audience' => 'learner',
        'icon' => 'fa fa-home',
        'dashboard' => 'all',
        'title' => 'Courses',
        'route' => '',
        'link' => '/learner/courses',
        'clickable' => true,
        'navbar' => true,
        'visibility' => true,
        'order' => 0,
        'sub-menu' => [
            'my-courses' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'My Courses',
                'route' => '',
                'link' => '/learner/courses',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
            'courses' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'Courses',
                'route' => '',
                'link' => '/learner/courses',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
        ],
    ],
    'programs' => [
        'audience' => 'learner',
        'icon' => 'fa fa-home',
        'dashboard' => 'all',
        'title' => 'Programs',
        'route' => '',
        'link' => '/learner/programs',
        'clickable' => true,
        'navbar' => true,
        'visibility' => true,
        'order' => 0,
        'sub-menu' => [
            'programs' => [
                'icon' => 'fa fa-home',
                'dashboard' => 'all',
                'title' => 'My Programs',
                'route' => '',
                'link' => '/learner/programs',
                'clickable' => true,
                'navbar' => true,
                'order' => 0,
            ],
        ],
    ]
];
