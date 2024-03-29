<?php

namespace Si6\Base;

use BenSampo\Enum\EnumServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Si6\Base\Exceptions\Handler;
use Si6\Base\Http\Middleware\BeforeResponse;
use Si6\Base\Http\Middleware\Unacceptable;
use Si6\Base\Http\Middleware\Unsupported;

class Si6BaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
        $this->app->register(EnumServiceProvider::class);
        $this->app->middleware([
            Unsupported::class,
            Unacceptable::class,
            BeforeResponse::class,
        ]);
    }

    public function boot()
    {
        //
    }
}
