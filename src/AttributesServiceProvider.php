<?php

namespace Joseph\Attributes;

use Illuminate\Support\ServiceProvider;
use Joseph\Attributes\Console\AttributeMakeCommand;

class AttributesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->commands([
            AttributeMakeCommand::class,
        ]);
    }
}