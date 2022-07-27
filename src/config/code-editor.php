<?php

return [
    'languages' => [
        'html' => [
            'title' => 'HTML',
            'mode' => 'htmlmixed',
            'dependencies' => [
                'xml','javascript','css','htmlmixed'
            ],
        ],
        'css' => [
            'title' => 'CSS',
            'mode' => 'htmlmixed',
            'dependencies' => [
                'xml','javascript','css','htmlmixed'
            ],
        ],
        'javascript' => [
            'title' => 'Javascript',
            'mode' => 'htmlmixed',
            'dependencies' => [
                'xml','javascript','css','htmlmixed'
            ],
        ],
        'php' => [
            'title' => 'PHP',
            'mode' => 'php',
            'dependencies' => [
                'xml','javascript','css','htmlmixed','clike','php'
            ],
        ],
        'dart' => [
            'title' => 'Dart',
            'mode' => 'dart',
            'dependencies' => [
                'clike','dart'
            ],
        ],
        'python' => [
            'title' => 'Python',
            'mode' => 'python',
            'dependencies' => [
                'python'
            ],
        ]
    ],
];
