<?php
namespace ApigilityCommunicate;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Config\Config;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        $service_config = new Config(include __DIR__ . '/config/service.config.php');

        $module_config = new Config(include __DIR__ . '/config/module.config.php');
        $module_config->merge($service_config);

        return $module_config;
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}
