<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'default'=>[
        'timeout'=>10,
        'ssl_verification'=>true
    ],
    'consumer' => [
        'ebill' => [
            'baseUri' => 'https://api-ebill.wlink.com.np/',
            'version' => 'v1',
            'secret' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaS1lYmlsbC53bGluay5jb20ubnAvL3YxL2xvZ2luIiwiaWF0IjoxNTQ1MDI4ODU5LCJuYmYiOjE1NDUwMjg4NTksImp0aSI6IkxKbEZuekppUGhlWGxJZlUiLCJzdWIiOiJlc2VydmljZS5hZG1pbiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJhcHBsaWNhdGlvbiI6ImVzZXJ2aWNlIn0.Rr7NNRYJRL9yYOk6C5DZVhbOW1NvGL0zZJLm4LW_GRs',
            'timeout'=>10,
            'consume_consumer' => [
                'App\\Consumers\\Ebill'
            ],
            'on' => [
                'exception' => [
                    'code' => true,
                    'message' => true
                ]
            ],
            'notify' => true
        ],
    ]
];
