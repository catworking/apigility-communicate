<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 15:17
 */
namespace ApigilityCommunicate\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class PhoneNotifyService
{
    protected $classMethodsHydrator;
    protected $adapter;

    public function __construct(ServiceManager $services, SmsServiceAdapter\SmsServiceAdapterInterface $adapter)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->adapter = $adapter;
    }
}