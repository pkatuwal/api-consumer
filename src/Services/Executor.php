<?php

namespace Pramod\ApiConsumer\Services;

use Pramod\ApiConsumer\ApiConsumer;
use Pramod\ApiConsumer\Traits\ConsumerHttpClient;

class Executor
{
    use ConsumerHttpClient;

    public $baseUri;
    public $requestUri;
    public $formParams;
    public $method;
    public $headers;
    public $timeout;
    public $sslVerify;
    protected $receivedContents;

    protected $apiConsumer;

    public function __construct(ApiConsumer $apiConsumer)
    {
        $this->apiConsumer = $apiConsumer;
        $this->finalRenderPayload();
        $this->receivedContents=$this->performRequest();
        return $this;
    }

    public function getReceivedContents()
    {
        return $this->receivedContents;
    }
    protected function finalRenderPayload()
    {
        $this->baseUri = $this->apiConsumer->consumePayload->getBaseUri();
        $this->requestUri = $this->getRequestedUri();
        $this->formParams = $this->apiConsumer->withPayload->payload;
        $this->method = $this->apiConsumer->withPayload->method;
        $this->headers = $this->getAuthorizationHeaders();
        $this->timeout=$this->apiConsumer->consumePayload->getTimeOut();
        $this->sslVerify=$this->apiConsumer->consumePayload->getSslVerify();
    }

    protected function getRequestedUri()
    {
        $version = $this->getActualVersion();
        return $version . $this->apiConsumer->viaPayload->getRequestedUri();
    }

    protected function getActualVersion()
    {
        return ($this->apiConsumer->withPayload->version) ?? $this->apiConsumer->consumePayload->getAppVersion();
    }

    protected function getAuthorizationHeaders()
    {
        if (empty($this->apiConsumer->withPayload->headers['Authorization'])
            &&
            !empty($this->apiConsumer->consumePayload->getSecret())) {
            $this->apiConsumer->withPayload->headers['Authorization']=$this->apiConsumer->consumePayload->getSecret();
        }
        return $this->apiConsumer->withPayload->headers;
    }

    protected function getSslVerify()
    {
        return $this->apiConsumer->consumePayload->ssl_verification??config('api-consumer.default_timeout');
    }
}
