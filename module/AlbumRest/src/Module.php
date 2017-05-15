<?php

namespace AlbumRest;

use Album\Model\AlbumTable;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AlbumRestController::class => function ($container) {
                    return new Controller\AlbumRestController(
                        $container->get(AlbumTable::class)
                    );
                },
            ],
        ];
    }

}