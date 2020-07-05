<?php

namespace Pramod\IamServicePackage\Middleware;

use Closure;
use Pramod\IamServicePackage\Facades\Iam;

class IamMonitoringRequest
{
    public $start_execution;
    public function __construct()
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next)
    {
        $this->start_execution = microtime(true);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // return Iam::dispatchWebRequest(['status'=>200]);
        Iam::dispatchWebRequest([
            'status_code' => $response->getStatusCode(),
            'version' => $response->getProtocolVersion(),
            'content' => is_string($response->getContent()) ?
                                    substr($response->getContent(), 0, 250)
                                    :
                                    $response->getContent(),
            'charset' => $response->getCharset(),
            'headers' => $response->headers->all(),
            'payload'=>$response->all(),
            'ip'=>$request->getClientIp(),
            'url'=>$request->fullUrl(),
            'method'=>$request->getMethod(),
            'total_execution_time'=>round((microtime(true) - $this->start_execution), 2)
        ]);
    }
}
