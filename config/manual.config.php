<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 21:02
 */
return [
    // 配置短信适配器
    'apigility-communicate' => [
        'sms'=>[
            'adapter' => [
                'type'=> 'aliyun',
                'params' => [
                    'region_id' => '',
                    'access_key_id' => '',
                    'access_key_secret' => '',
                    'template_id'=>'',
                    'sign_name' => ''
                ],
                /*'type'=> 'alidayu',
                'params' => [
                    'key' => '',
                    'secret' => '',
                    'template_id'=>'',
                    'sign_name' => ''
                ],*/
            ],
        ],
        'phone-notify' => [
            'adapter' => [
                'type' =>'jpush',
                'params' => [
                    'app_key' => '',
                    'secret' => '',
                    'log_file' => ''
                ]
            ]
        ]
    ],
];