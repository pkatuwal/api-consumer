<?php

namespace Pramod\ApiConsumer\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public $start_execution;
    public $stop_execution;
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
        $this->stop_execution = microtime(true);

        $this->log($request, $response);
    }

    protected function log($request, $response)
    {
        $duration = round(($this->stop_execution - $this->start_execution), 2);
        $url = $request->fullUrl();
        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $status = $response->getStatusCode();
        $payload = json_encode($request->all());
        $receivedContent = $response->getContent();

        $log = "[".config('app.name')."] {$ip} {$status} {$payload} {$method} {$url} {$receivedContent} {$duration}ms";
        Log::info($log);
    }
}
