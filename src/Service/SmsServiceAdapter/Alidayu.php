<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 17:20
 */
namespace ApigilityCommunicate\Service\SmsServiceAdapter;

use ApigilityCommunicate\Service\Exception\SmsSendTooFrequentlyException;

class Alidayu implements SmsServiceAdapterInterface
{
    protected $key;
    protected $secret;
    protected $template_id;
    protected $sign_name;

    public function __construct($key, $secret, $template_id, $sign_name)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->template_id = $template_id;
        $this->sign_name = $sign_name;
    }

    public function sendVerificationCodeWithTemplateId($target, $code)
    {
        include dirname(__FILE__).'/../../../vendor/alidayu/TopSdk.php';

        $c = new \TopClient();
        $c->appkey = $this->key;
        $c->secretKey = $this->secret;
        $req = new \AlibabaAliqinFcSmsNumSendRequest();
        // $req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($this->sign_name);
        $req->setSmsParam('{"code":"' . $code . '","product":"' . $this->sign_name . '"}');
        $req->setRecNum($target);
        $req->setSmsTemplateCode($this->template_id);
        $resp = $c->execute($req);


        if ($resp->result->err_code != '0') {
            if ($resp->sub_code == 'isv.BUSINESS_LIMIT_CONTROL') {
                throw new SmsSendTooFrequentlyException();
            } else {
                throw new \Exception('阿里大鱼短信验证码发送异常'.$resp->sub_code);
            }
        }

        return true;
    }
}