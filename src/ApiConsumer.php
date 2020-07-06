<?php

namespace Pramod\ApiConsumer;

use Illuminate\Database\Eloquent\Collection;
use Pramod\ApiConsumer\Parser\ConsumerParser;
use Pramod\ApiConsumer\Parser\SuperChargedByParser;
use Pramod\ApiConsumer\Parser\ViaParser;
use Pramod\ApiConsumer\Parser\WithParser;
use Pramod\ApiConsumer\Services\Executor;
use ReflectionMethod;

class ApiConsumer
{
    public $consumerPayload;
    public function consume(string $apiConsumerName)
    {
        $this->consumePayload=new ConsumerParser($apiConsumerName);
        return $this;
    }

    public function via($requestedUri, $activeUserDefinedMethod = false)
    {
        $this->viaPayload=new ViaParser(
            $requestedUri,
            $activeUserDefinedMethod
                ?
                $this->getViaSecondParams($activeUserDefinedMethod)
                :
                $activeUserDefinedMethod
        );
        return $this;
    }
    protected function getViaSecondParams($activeUserDefinedMethod)
    {
        return $activeUserDefinedMethod
                ?
                [
                    'payload'=>$this->consumePayload->getRegisteredConsumers(),
                    'original'=>$activeUserDefinedMethod
                ]
                :
                $activeUserDefinedMethod;
    }

    public function with(array $headersPayload)
    {
        $this->withPayload=new WithParser($headersPayload);
        return $this;
    }

    // public function notify(bool $isNotify)
    // {
    //     return $this;
    // }
    // public function on(array $onTriggeredEvent)
    // {
    //     return $this;
    // }
    public function superChargedBy(array $outOfBoxFeature)
    {
        $this->superChargedByPayload=new SuperChargedByParser($outOfBoxFeature);
        return $this;
    }

    public function toCollection()
    {
        $executor=new Executor($this);
        return collect($executor->getReceivedContents());
    }

    public function toArray()
    {
        return $this->toCollection()->toArray();
    }

    public function toJson()
    {
        return $this->toCollection()->toJson(JSON_PRETTY_PRINT);
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $arguments);
        }
    }

    public function __toString()
    {
        return $this->toCollection()->toJson();
    }
}
