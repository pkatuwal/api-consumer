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
        if (is_array($this->activeUserDefinedMethod['original'])) {
            return str_replace(
                $this->replaceArrayKeyByBraces(),
                array_values($this->activeUserDefinedMethod['original']),
                $this->activeUserDefinedMethod['payload'][$this->requestedUri]['uri']
            );
        }
        if ($this->activeUserDefinedMethod['original']===true) {
            return $this->activeUserDefinedMethod['payload'][$this->requestedUri]['uri'];
        }
    }

    protected function replaceArrayKeyByBraces()
    {
        $replaceNewArray=[];
        foreach (array_keys($this->activeUserDefinedMethod['original']) as $key => $value) {
            $replaceNewArray[]='{'.$value.'}';
        }
        return $replaceNewArray;
    }

    public function getRequestedUri()
    {
        return (isset($this->requestedUri[0]) && ($this->requestedUri[0]==='/'))?
                                    $this->requestedUri
                                    :
                                    '/'.$this->requestedUri;
    }
}
