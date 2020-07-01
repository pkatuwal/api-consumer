<?php

namespace Pramod\ApiConsumer\Tests;

use Pramod\ApiConsumer\Facades\Api;

class ExampleTest extends TestCase
{

    public function testFirst()
    {
        return $this->assertEquals(
            Api::consume('ebill')->consumePayload->getBaseUri(),
            'https://api-ebill.wlink.com.np/'
        );
    }

    public function testVia()
    {
        $data=Api::consume('ebill')
                ->via('customers/pramodk_home/documents');
        return $this->assertEquals($data->viaPayload->getRequestedUri(), 'customers/pramodk_home/documents');
    }

    public function testWith()
    {
        $data=Api::consume('ebill')
                ->via('customers/pramodk_home/documents')
                ->with([
                        'headers'=>[
                            'Authorization'=>'xx',
                            'Content-Type'=>'',
                            'Accept'=>''
                        ],
                        'method'=>'POST',
                        'version'=>'v1',
                        'payload'=>[
                            'name'=>'name is here'
                        ]
                    ]);
        return $this->assertEquals($data->withPayload->method, 'POST');
    }

    public function testCharge()
    {
        $data=Api::consume('ebill')
                ->via('customers/pramodk_home/documents')
                ->with([
                        'headers'=>[
                            'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaS1lYmlsbC53bGluay5jb20ubnAvL3YxL2xvZ2luIiwiaWF0IjoxNTQ1MDI4ODU5LCJuYmYiOjE1NDUwMjg4NTksImp0aSI6IkxKbEZuekppUGhlWGxJZlUiLCJzdWIiOiJlc2VydmljZS5hZG1pbiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJhcHBsaWNhdGlvbiI6ImVzZXJ2aWNlIn0.Rr7NNRYJRL9yYOk6C5DZVhbOW1NvGL0zZJLm4LW_GRs',
                        ],
                        'method'=>'POST',
                        'version'=>'v1',
                        'payload'=>[
                            'name'=>'name is here'
                        ]
                    ])
                ->superChargedBy([
                    'cache'=>[
                        'ttl'=>20,
                        'key_prefix'=>'documents'
                    ]
                ]);
        return $this->assertContains('documents', $data->superChargedByPayload->cache, 'Does not contains');
    }

    public function testFull()
    {
        $data=Api::consume('ebill')
                ->via('customers/pramodk_home/info')
                ->with([
                        'headers'=>[
                            // 'Authorization'=>'xx',
                            'Content-Type'=>'',
                            'Accept'=>''
                        ],
                        'method'=>'GET',
                        'version'=>'v1',
                        'payload'=>[
                            'name'=>'name is here'
                        ]
                    ])
                ->superChargedBy([
                    'cache'=>[
                        'ttl'=>20,
                        'key_prefix'=>'documents'
                    ]
                ]);
        dd($data->toCollection());
        return $this->assertContains('documents', $data->superChargedByPayload->cache, 'Does not contains');
    }
}
