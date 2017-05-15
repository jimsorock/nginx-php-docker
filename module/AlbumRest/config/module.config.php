<?php

namespace AlbumRest;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'album-rest' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/album-rest[/:id][/]',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumRestController::class,
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ]
];