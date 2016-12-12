<?php
namespace ApigilityCommunicate\V1\Rest\Notification;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class NotificationResource extends ApigilityResource
{
    /**
     * @var \ApigilityCommunicate\Service\NotificationService
     */
    protected $notificationService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->notificationService = $this->serviceManager->get('ApigilityCommunicate\Service\NotificationService');
    }

    public function create($data)
    {
        try {
            return new NotificationEntity($this->notificationService->createNotification($data), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetch($id)
    {
        try {
            return new NotificationEntity($this->notificationService->getNotification($id), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetchAll($params = [])
    {
        try {
            return new NotificationCollection($this->notificationService->getNotifications($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function patch($id, $data)
    {
        try {
            return new NotificationEntity($this->notificationService->updateNotification($id, $data), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
