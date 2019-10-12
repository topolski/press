<?php

namespace topolski\Press\Fields;

use Carbon\Carbon;

class Date
{
    public static function process($type, $value)
    {
        return [
            $type => Carbon::parse($value),
        ];
    }
}