<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 15:17
 */
namespace ApigilityCommunicate\Service;

use ApigilityCommunicate\Service\PhoneNotifyServiceAdapter\JPush;
use Zend\ServiceManager\ServiceManager;

class PhoneNotifyServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        $config = $services->get('config');
        $adapter_config = $config['apigility-communicate']['phone-notify']['adapter'];
        $adapter_params = $adapter_config['params'];
        $adapter = null;
        switch ($adapter_config['type']) {
            case 'jpush':
                $adapter = new JPush($adapter_params);
        }

        return new PhoneNotifyService($services, $adapter);
    }
}