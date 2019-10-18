<?php

namespace topolski\Press;

use Illuminate\Support\Str;

class Press
{
    /**
     * Check if Press config file has been published and set.
     *
     * @return bool
     */
    public function configNotPublished()
    {
        return is_null(config('press'));
    }

    /**
     * Get an instance of the set driver.
     *
     * @return mixed
     */
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