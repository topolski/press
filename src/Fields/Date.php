<?php

namespace topolski\Press\Fields;

use Carbon\Carbon;

class Date extends FieldContract
{
    public static function process($type, $value, $data)
    {
        return [
            $type => Carbon::parse($value),
        ];
    }
}