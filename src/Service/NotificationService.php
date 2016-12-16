<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/12
 * Time: 14:10
 */
namespace ApigilityCommunicate\Service;

use ApigilityCommunicate\DoctrineEntity;
use ApigilityCommunicate\DoctrineEntity\Notification;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Doctrine\ORM\QueryBuilder;

class NotificationService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityUser\Service\UserService
     */
    protected $userService;

    /**
     * @var \ApigilityCommunicate\Service\PhoneNotifyService
     */
    protected $phoneNotifyService;

    public function __construct(ServiceManager $services)
    {
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->userService = $services->get('ApigilityUser\Service\UserService');
        $this->phoneNotifyService = $services->get('ApigilityCommunicate\Service\PhoneNotifyService');
    }

    /**
     * 创建一个通知
     * @param $data
     * @param bool $phone_notify
     * @return Notification
     * @throws \Exception
     */
    public function createNotification($data, $phone_notify = true)
    {
        if (!isset($data->user_id)) throw new \Exception('没有指定接受通知的目标用户', 500);
        else {
            $notification = new Notification();
            $notification->setUser($this->userService->getUser($data->user_id));
            $notification->setCreateTime(new \DateTime());
            $notification->setStatus(Notification::STATUS_UNREAD)
                ->setPushStatus(Notification::PUSH_STATUS_WAIT);

            // 保存输入的数据
            if (isset($data->title)) $notification->setTitle($data->title);
            if (isset($data->content)) $notification->setContent($data->content);
            if (isset($data->type)) $notification->setType($data->type);
            if (isset($data->object_id)) $notification->setObjectId($data->object_id);

            $this->em->persist($notification);
            $this->em->flush();

            // 发送手机通知
            if ($phone_notify) {
                $em = $this->em;
                $this->phoneNotifyService->sendNotification($notification, function () use ($notification, $em){
                    $notification->setPushStatus(Notification::PUSH_STATUS_DONE);
                    $em->flush();
                });
            }

            return $notification;
        }
    }

    public function updateNotification($id, $data)
    {
        $notification = $this->getNotification($id);

        // 保存输入的数据
        if (isset($data->title)) $notification->setTitle($data->title);
        if (isset($data->content)) $notification->setContent($data->content);
        if (isset($data->type)) $notification->setType($data->type);
        if (isset($data->object_id)) $notification->setObjectId($data->object_id);
        if (isset($data->status)) {
            switch ($data->status) {
                case Notification::STATUS_UNREAD:
                    $notification->setStatus(Notification::STATUS_UNREAD);
                    break;

                case Notification::STATUS_READ:
                    $notification->setStatus(Notification::STATUS_READ);
                    break;

                default:
                    throw new \Exception('输入了未知的状态类型', 500);
            }
        }

        $this->em->flush();

        return $notification;
    }

    /**
     * 获取一条通知
     *
     * @param $notification_id
     * @return Notification
     * @throws \Exception
     */
    public function getNotification($notification_id)
    {
        $notification = $this->em->find('ApigilityCommunicate\DoctrineEntity\Notification', $notification_id);
        if (empty($notification)) throw new \Exception('通知不存在', 404);
        else return $notification;
    }

    /**
     * 获取通知列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     */
    public function getNotifications($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('n')->from('ApigilityCommunicate\DoctrineEntity\Notification', 'n');

        $where = '';
        if (isset($params->type)) {
            if (!empty($where)) $where .= ' AND ';
            $where .= 'n.type = :type';
        }

        if (isset($params->user_id)) {
            $qb->innerJoin('n.user', 'user');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'user.id = :user_id';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->type)) $qb->setParameter('type', $params->type);
            if (isset($params->user_id)) $qb->setParameter('user_id', $params->user_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}