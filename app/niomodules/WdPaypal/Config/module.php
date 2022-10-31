<?php

use NioModules\WdPaypal\WdPaypalModule;

return [
    WdPaypalModule::SLUG => [
        'name' => __('Crypto'),
        'slug' => WdPaypalModule::SLUG,
        'method' => WdPaypalModule::METHOD,
        'account' => __('Crypto Account'),
        'icon' => 'ni-invest',
        'full_icon' => 'ni-invest',
        'is_online' => false,
        'processor_type' => 'withdraw',
        'processor' => WdPaypalModule::class,
        'supported_currency' => [
            'USD', 'BTC', 'ETH', 'USDT', 'AUD', 'TRY', 'RUB', 'INR', 'BRL', 'NGN'
        ],
        'system' => [
            'kind' => 'Withdraw',
            'info' => 'Gateway / Offline',
            'type' => WdPaypalModule::MOD_TYPES,
            'version' => WdPaypalModule::VERSION,
            'update' => WdPaypalModule::LAST_UPDATE,
            'description' => 'Manage withdraw funds manually using Crypto.',
            'addons' => false,
        ]
    ],
];
