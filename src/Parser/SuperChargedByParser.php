<?php

namespace Pramod\ApiConsumer\Parser;

class SuperChargedByParser
{
    protected $requestedChargedPayload;
    public $cache=[
        
    ];
    public function __construct($outOfBoxFeature)
    {
        $this->requestedChargedPayload=$outOfBoxFeature;
        $this->parsePayload();
        return $this;
    }

    protected function parsePayload()
    {
        foreach ($this->requestedChargedPayload as $key => $value) {
            $this->{$key}=$value;
        }
    }

    public function isValidCacheSetter()
    {
        return (count($this->cache)===2 && is_numeric($this->cache['ttl']) && strlen($this->cache['key_prefix'])>5);
    }
}
