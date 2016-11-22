<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 16:08
 */
namespace ApigilityCommunicate\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Math\Rand;

class SmsService
{
    protected $classMethodsHydrator;
    protected $adapter;

    public function __construct(ServiceManager $services, SmsServiceAdapter\SmsServiceAdapterInterface $adapter)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->adapter = $adapter;
    }

    public function sendVerificationCode($target)
    {
        $code = $this->generateVerificationCode();

        $this->adapter->sendVerificationCodeWithTemplateId($target, $code);

        return $code;
    }

    public function generateVerificationCode()
    {
        $string = Rand::getString(6, '123456789');
        return $string;
    }
}