<?php

namespace Base;

abstract class Element
{
    protected function db($raw = false, $instance='rdn')
    {
        return Utils::getDb($raw, $instance);
    }
}


