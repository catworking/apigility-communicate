<?php
namespace ApigilityCommunicate\V1\Rest\Verification;

class VerificationEntity
{
    const TYPE_SMS = 1;   // 手机号码验证
    const TYPE_EMAIL = 2; // 邮件地址验证

    protected $type;
    protected $target;
    protected $code;
    protected $send_time;
    
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getSendTime()
    {
        return $this->send_time;
    }

    public function setSendTime($send_time)
    {
        $this->send_time = $send_time;
        return $this;
    }
}
