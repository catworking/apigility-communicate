<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 15:22
 */
namespace ApigilityCommunicate\Service\PhoneNotifyServiceAdapter;

use JPush\Client as JPushClient;

class JPush implements PhoneNotifyServiceAdapterInterface
{
    /**
     * @var JPushClient
     */
    protected $client;

    public function __construct($config)
    {
        if (isset($config['log_file'])) {
            $path = dirname($config['log_file']);
            if (!file_exists($path)) mkdir($path, 0777, true);
        }
        $this->client = new JPushClient($config['app_key'], $config['secret'], $config['log_file']);
    }

    /**
     * 把通知发给所有设备
     *
     * @param $content
     * @param array $alias
     * @return bool
     * @throws \Exception
     */
    public function pushAlertByAlias($content, $alias = [])
    {
        try {
            $response = $this->client->push()
                ->setPlatform('all')
                ->addAlias($alias)
                ->setNotificationAlert($content)
                ->send();

            if ($response['http_code'] == 200) return true;
            else return false;

        } catch (\Exception $e) {
            //throw $e;
            return false;
        }
    }

    public function pushNotificationAndMessageByAlias($title, $content, $extras, $alias = [])
    {
        try {
            $response = $this->client->push()
                ->setPlatform('all')
                ->addAlias($alias)
                ->iosNotification($title.'：'.$content, array(
                    'extras' => $extras,
                ))
                ->androidNotification($content, array(
                    'title' => $title,
                    'extras' => $extras,
                ))
                ->message($content, array(
                    'title' => $title,
                    'extras' => $extras,
                ))
                ->send();

            if ($response['http_code'] == 200) return true;
            else return false;

        } catch (\Exception $e) {
            //throw $e;
            return false;
        }
    }
}