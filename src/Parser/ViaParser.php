<?php

namespace Pramod\ApiConsumer\Parser;

class ViaParser
{
    protected $activeUserDefinedMethod;
    protected $requestedUri;
    public function __construct($requestedUri, bool $activeUserDefinedMethod = false)
    {
        $this->activeUserDefinedMethod=$activeUserDefinedMethod;

        if (!$this->activeUserDefinedMethod) {
            $this->requestedUri=$requestedUri;
        }
        return $this;
    }

    protected function isActiveUserDefinedMethod()
    {
        return $this->activeUserDefinedMethod;
    }

    public function getRequestedUri()
    {
        return (isset($this->requestedUri[0]) && ($this->requestedUri[0]==='/'))?
                                    $this->requestedUri
                                    :
                                    '/'.$this->requestedUri;
    }
}
