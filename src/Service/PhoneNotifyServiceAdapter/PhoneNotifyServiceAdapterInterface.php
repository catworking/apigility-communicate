<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 15:21
 */
namespace ApigilityCommunicate\Service\PhoneNotifyServiceAdapter;

interface PhoneNotifyServiceAdapterInterface
{
    /**
     * 把通知发给所有设备
     *
     * @param $content
     * @param array $alias
     * @return boolean
     */
    public function pushAlertByAlias($content, $alias = []);
}