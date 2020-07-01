<?php

namespace Pramod\ApiConsumer\Traits;

use GuzzleHttp\Client;

trait ConsumerHttpClient
{

    public function performRequest()
    {
        try {
            $client = new Client([
                'base_uri' => $this->baseUri
            ]);

            $response = $client->request($this->method, $this->requestUri, [
                'form_params' => $this->formParams,
                'headers' => $this->headers,
                'timeout'=>$this->timeout,
                'verify'=>$this->sslVerify
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $errorCode = 500;
            throw new \Exception($e->getResponse()->getBody()->getContents(), $errorCode);
        }
    }
}
