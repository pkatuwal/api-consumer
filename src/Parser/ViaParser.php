<?php

namespace Pramod\ApiConsumer\Parser;

class ViaParser
{
    protected $activeUserDefinedMethod;
    protected $requestedUri;
    public function __construct($requestedUri, $activeUserDefinedMethod = false)
    {
        $this->activeUserDefinedMethod=$activeUserDefinedMethod;
        $this->requestedUri=$requestedUri;

        $this->checkActiveDefined();

        return $this;
    }

    protected function isActiveUserDefinedMethod()
    {
        return $this->activeUserDefinedMethod;
    }

    protected function checkActiveDefined()
    {
        if ($this->activeUserDefinedMethod) {
            $this->requestedUri=$this->getParsedUri();
        }
    }
    protected function getParsedUri()
    {
        return $this->activeUserDefinedMethod[$this->requestedUri]['uri'];
    }

    public function getRequestedUri()
    {
        return (isset($this->requestedUri[0]) && ($this->requestedUri[0]==='/'))?
                                    $this->requestedUri
                                    :
                                    '/'.$this->requestedUri;
    }
}
