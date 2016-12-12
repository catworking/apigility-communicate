<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 15:17
 */
namespace ApigilityCommunicate\Service;

use Zend\ServiceManager\ServiceManager;

class PhoneNotifyServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        /*$config = $services->get('config');
        $adapter_config = $config['apigility-communicate']['sms']['adapter'];
        $adapter_params = $adapter_config['params'];
        $adapter = null;
        switch ($adapter_config['type']) {
            case 'aliyun':
                $adapter =  new SmsServiceAdapter\Aliyun($adapter_params['region_id'], $adapter_params['access_key_id'], $adapter_params['access_key_secret'], $adapter_params['template_id'], $adapter_params['sign_name']);
                break;

            case 'alidayu':
                $adapter = new SmsServiceAdapter\Alidayu($adapter_params['key'], $adapter_params['secret'], $adapter_params['template_id'], $adapter_params['sign_name']);
        }*/

        return new PhoneNotifyService($services);
    }
}