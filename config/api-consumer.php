<?php

/*
 * you can place your custom package configuration in here.
 */
return [
    'default'=>[
        'timeout'=>10,
        'ssl_verification'=>true,
        'method'=>"GET"
    ],
    'consumer' => [
        'ebill' => [
            'baseUri' => 'https://api-ebill.wlink.com.np/',
            'version' => 'v1',
            'secret' => 'bearer eyj0exaioijkv1qilcjhbgcioijiuzi1nij9.eyjpc3mioijodhrwczovl2fwas1lymlsbc53bgluay5jb20ubnavl3yxl2xvz2luiiwiawf0ijoxntq1mdi4odu5lcjuymyioje1nduwmjg4ntksimp0asi6ikxkbezuekppughlwgxjzluilcjzdwiioijlc2vydmljzs5hzg1pbiisinbydii6ijizymq1yzg5ndlmnjawywrimzllnzaxyzqwmdg3mmrin2e1otc2zjcilcjhchbsawnhdglvbii6imvzzxj2awnlin0.rr7nnryjrl9yyok6c5dzvhbow1nvgl0zzjlm4lw_grs',
            'timeout'=>10,
            // 'custom_consumer' => [
            //     'Consumers\\covid'
            // ],
            // 'on' => [
            //     'exception' => [
            //         'code' => true,
            //         'message' => true
            //     ]
            // ],
            // 'notify' => true
        ],
        'covid19api'=>[
            'baseUri'=>'https://api.covid19api.com/',
            'custom_consumer' => [
                'Consumers/covid'
            ],
            'timeout'=>10
        ]
    ]
];
