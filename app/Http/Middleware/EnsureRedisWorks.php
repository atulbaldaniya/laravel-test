<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Predis\Client;

class EnsureRedisWorks
{
      /**
       * check redis is working or not on the system.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
       * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
       */
      public function handle(Request $request, Closure $next)
      {
            try {
                  $redis = new Client();
                  $redis->ping();
            } catch (\Exception $exception) {
                  return apiResponse(
                        false,
                        config("constant.ERROR.REDIS_ERROR"),
                        $exception->getMessage()
                  );
            }

            return $next($request);
      }
}
