<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 16:09
 */
namespace ApigilityCommunicate\Service;

use Zend\ServiceManager\ServiceManager;

class SmsServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        $config = $services->get('config');
        $alidayu_config = $config['apigility-communicate']['alidayu'];
        return new SmsService($services, new SmsServiceAdapter\Alidayu($alidayu_config['key'], $alidayu_config['secret'], $alidayu_config['template_id'], $alidayu_config['sign_name']));
    }
}