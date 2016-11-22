<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 20:00
 */
namespace ApigilityCommunicate\Service\Exception;

class SmsSendTooFrequentlyException extends \Exception
{
    const CODE = 10004;
    const MESSAGE = '短信发送太过频繁';
    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}