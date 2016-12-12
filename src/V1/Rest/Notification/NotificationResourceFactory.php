<?php
namespace ApigilityCommunicate\V1\Rest\Notification;

class NotificationResourceFactory
{
    public function __invoke($services)
    {
        return new NotificationResource($services);
    }
}
