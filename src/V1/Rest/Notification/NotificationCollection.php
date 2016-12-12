<?php
namespace ApigilityCommunicate\V1\Rest\Notification;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class NotificationCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = NotificationEntity::class;
}
