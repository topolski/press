<?php

namespace topolski\Press\Fields;

use topolski\Press\MarkdownParser;

class Body
{
    public static function process($type, $value)
    {
        return [
            $type => MarkdownParser::parse($value),
        ];
    }
}