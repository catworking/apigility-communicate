<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 17:19
 */
namespace ApigilityCommunicate\Service\SmsServiceAdapter;

class Aliyun implements SmsServiceAdapterInterface
{
    public function sendVerificationCodeWithTemplateId($template_id, $target, $code)
    {
        // TODO: Implement sendVerificationCodeWithTemplateId() method.
        return true;
    }
}