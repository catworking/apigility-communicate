<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityCommunicate\V1\Rest\Verification\VerificationResource::class => \ApigilityCommunicate\V1\Rest\Verification\VerificationResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'apigility-communicate.rest.verification' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/verification[/:verification_id]',
                    'defaults' => [
                        'controller' => 'ApigilityCommunicate\\V1\\Rest\\Verification\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-communicate.rest.verification',
        ],
    ],
    'zf-rest' => [
        'ApigilityCommunicate\\V1\\Rest\\Verification\\Controller' => [
            'listener' => \ApigilityCommunicate\V1\Rest\Verification\VerificationResource::class,
            'route_name' => 'apigility-communicate.rest.verification',
            'route_identifier_name' => 'verification_id',
            'collection_name' => 'verification',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityCommunicate\V1\Rest\Verification\VerificationEntity::class,
            'collection_class' => \ApigilityCommunicate\V1\Rest\Verification\VerificationCollection::class,
            'service_name' => 'verification',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityCommunicate\\V1\\Rest\\Verification\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ApigilityCommunicate\\V1\\Rest\\Verification\\Controller' => [
                0 => 'application/vnd.apigility-communicate.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'ApigilityCommunicate\\V1\\Rest\\Verification\\Controller' => [
                0 => 'application/vnd.apigility-communicate.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \ApigilityCommunicate\V1\Rest\Verification\VerificationEntity::class => [
                'entity_identifier_name' => 'code',
                'route_name' => 'apigility-communicate.rest.verification',
                'route_identifier_name' => 'verification_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityCommunicate\V1\Rest\Verification\VerificationCollection::class => [
                'entity_identifier_name' => 'code',
                'route_name' => 'apigility-communicate.rest.verification',
                'route_identifier_name' => 'verification_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'ApigilityCommunicate\\V1\\Rest\\Verification\\Controller' => [
            'input_filter' => 'ApigilityCommunicate\\V1\\Rest\\Verification\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'ApigilityCommunicate\\V1\\Rest\\Verification\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'type',
                'description' => '类型',
                'error_message' => '请输入要发送的验证码类型',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'target',
                'description' => '发送目标',
                'field_type' => 'string',
                'error_message' => '请输入发送目标（手机号码或邮件地址）',
            ],
            2 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'code',
                'description' => '验证码',
                'field_type' => 'string',
            ],
            3 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'send_time',
                'description' => '发送时间',
                'field_type' => 'timestamp',
            ],
        ],
    ],
];
