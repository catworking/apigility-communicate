<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 17:19
 */
namespace ApigilityCommunicate\Service\SmsServiceAdapter;

use Sms\Request\V20160927 as Sms;

class Aliyun implements SmsServiceAdapterInterface
{
    protected $region_id;
    protected $access_key_id;
    protected $access_key_secret;
    protected $template_id;
    protected $sign_name;

    public function __construct($region_id, $access_key_id, $access_key_secret, $template_id, $sign_name)
    {
        $this->region_id = $region_id;
        $this->access_key_id = $access_key_id;
        $this->access_key_secret = $access_key_secret;
        $this->template_id = $template_id;
        $this->sign_name = $sign_name;
    }

    public function sendVerificationCodeWithTemplateId($target, $code)
    {
        include dirname(__FILE__).'/../../../vendor/aliyun/aliyun-php-sdk-core/Config.php';

        $iClientProfile = \DefaultProfile::getProfile($this->region_id, $this->access_key_id, $this->access_key_secret);
        $client = new \DefaultAcsClient($iClientProfile);
        $request = new Sms\SingleSendSmsRequest();
        $request->setSignName($this->sign_name);/*签名名称*/
        $request->setTemplateCode($this->template_id);/*模板code*/
        $request->setRecNum($target);/*目标手机号*/
        $request->setParamString('{"code":"' . $code . '","product":"' . $this->sign_name . '"}');/*模板变量，数字一定要转换为字符串*/

        try {
            $response = $client->getAcsResponse($request);
        } catch (\ClientException  $e) {
            throw new \Exception($e->getErrorMessage(), $e->getErrorCode());
        } catch (\ServerException  $e) {
            throw new \Exception($e->getErrorMessage(), $e->getErrorCode());
        }

        return true;
    }
}