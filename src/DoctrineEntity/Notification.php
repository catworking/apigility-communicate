<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 16:04
 */
namespace ApigilityCommunicate\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use ApigilityUser\DoctrineEntity\User;

/**
 * Class Notification
 * @package ApigilityCommunicate\DoctrineEntity
 * @Entity @Table(name="apigilitycommunication_notification")
 */
class Notification
{
    const STATUS_UNREAD = 1;  // 已读
    const STATUS_READ = 2;    // 未读

    const PUSH_STATUS_NONE = 1;  // 不推送
    const PUSH_STATUS_WAIT = 2;  // 等待推送
    const PUSH_STATUS_DONE = 3;  // 已推送

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 发送目标，ApigilityUser组件的User对象
     *
     * @ManyToOne(targetEntity="ApigilityUser\DoctrineEntity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * 消息标题
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $title;

    /**
     * 消息正文
     *
     * @Column(type="string", length=800, nullable=true)
     */
    protected $content;

    /**
     * 消息类型
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $type;

    /**
     * 消息目标类型的对象标识
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $object_id;

    /**
     * 创建时间
     *
     * @Column(type="datetime", nullable=false)
     */
    protected $create_time;

    /**
     * 阅读状态
     *
     * @Column(type="smallint", nullable=false)
     */
    protected $status;

    /**
     * 推送状态
     *
     * @Column(type="smallint", nullable=false)
     */
    protected $push_status;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setObjectId($object_id)
    {
        $this->object_id = $object_id;
        return $this;
    }

    public function getObjectId()
    {
        return $this->object_id;
    }

    public function setCreateTime(\DateTime $create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }

    public function getCreateTime()
    {
        return $this->create_time;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setPushStatus($push_status)
    {
        $this->push_status = $push_status;
        return $this;
    }

    public function getPushStatus()
    {
        return $this->push_status;
    }
}