<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 15:17
 */
namespace ApigilityCommunicate\Service;

use ApigilityCommunicate\DoctrineEntity\Notification;
use ApigilityCommunicate\Service\PhoneNotifyServiceAdapter\PhoneNotifyServiceAdapterInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class PhoneNotifyService
{
    protected $classMethodsHydrator;

    /**
     * @var PhoneNotifyServiceAdapterInterface
     */
    protected $adapter;

    public function __construct(ServiceManager $services, PhoneNotifyServiceAdapterInterface $adapter)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->adapter = $adapter;
    }

    /**
     * 把通知发送到通知指定的用户
     *
     * @param $notification
     * @param callable $callback
     * @return boolean
     */
    public function sendNotification(Notification $notification , callable $callback)
    {
        $status = false;

        if ($this->adapter->pushAlertByAlias(
            $notification->getTitle().'：'.$notification->getContent(),
            $notification->getUser()->getId())) {

            $callback();
        }

        return $status;
    }
}