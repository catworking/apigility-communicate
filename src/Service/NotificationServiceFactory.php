<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/12
 * Time: 14:10
 */
namespace ApigilityCommunicate\Service;

use Zend\ServiceManager\ServiceManager;

class NotificationServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new NotificationService($services);
    }
}