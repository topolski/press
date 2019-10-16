<?php

namespace topolski\Press;

use Illuminate\Support\Str;

class Press
{
    public function configNotPublished()
    {
        return is_null(config('press'));
    }

    public function driver()
    {
        $driver = Str::title(config('press.driver'));

        $class = 'topolski\Press\Drivers\\' . $driver . 'Driver';

        return new $class;
    }

    public function routePrefix()
    {
        return config('press.prefix', 'blogs');
    }
}