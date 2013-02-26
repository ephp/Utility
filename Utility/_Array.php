<?php

namespace Ephp\UtilityBundle\Utility;

class _Array {

    public static function getFromArray($params, $name, $default = null) {
        return isset($params[$name]) ? $params[$name] : $default;
    }
    
}
