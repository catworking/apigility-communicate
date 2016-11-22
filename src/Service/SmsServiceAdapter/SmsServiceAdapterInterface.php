<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 17:07
 */
namespace ApigilityCommunicate\Service\SmsServiceAdapter;

interface SmsServiceAdapterInterface
{
    /**
     * 通过指定服务端短信模板发送手机验证码
     * @param $target
     * @param $code
     * @return boolean
     */
    public function sendVerificationCodeWithTemplateId($target, $code);
}