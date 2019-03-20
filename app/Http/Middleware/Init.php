<?php

namespace App\Http\Middleware;

use Closure, MetaTag;
use App\Models\Client;
use App\Models\Setting;

class Init
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!cache()->has('_domain')) {
            $host = parse_url(url()->current(), PHP_URL_HOST);
            $domains = explode('.', $host);
            $domain_name = substr_replace($host, '', strrpos($host, '.'));
            cache()->forever('_domain', ['name' => $domain_name, 'host' => $host]);
        }
        config(['config.domain' => cache('_domain')]);
        
        if (!cache()->has('client')) {
            $client = Client::where('host', $request->getHttpHost())->first();
            cache(['client' => $client], env('CACHE_TIME', 5));
        }
        $client = cache('client');
        config(['config.client_id' => $client->id]);
        config(['config.title' => $client->setting['title']]);
        
        foreach ($client->setting as $key => $value) {
            if (is_string($value)) {
                MetaTag::set($key, $value);
            }elseif(is_array($value)){
                config(['config.'.$key => $value]);
            }
        }
        MetaTag::set('robots', env('APP_ENV') == 'local'? 'noindex, nofollow': 'index, follow');
        if (!cache()->has('routes')) {
            $routes = [];
            $accept = false;
            foreach (\Route::getRoutes() as $key => $route) {
                if ($route->getName() == 'home') {
                    $accept = true;
                }
                if (!is_null($route->getName()) && $accept) {
                    $routes[$route->getName()] = "/{$route->uri}";
                }
            }
            cache(['routes' => $routes], 60);
        }
        config(['config.routes' => cache('routes')]);
        if (!cache()->has('ads')) {
            $result = Setting::firstOrCreate(['title' => 'Quảng cáo', 'type' => 'ads', 'client_id' => $client->id]);
            $ads = is_null($result->content)? []: $result->content;
            cache()->put('ads', $ads, env('CACHE_TIME', 5));
        }
        $ads = cache('ads');
        config(['config.ads' => $ads]);
        return $next($request);
    }
}
