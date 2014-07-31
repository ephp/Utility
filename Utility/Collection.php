<?php

namespace JF\UtilityBundle\Utility;

class Collection {

    public static function getFromArray($params, $name, $default = null) {
        return isset($params[$name]) ? $params[$name] : $default;
    }
    
}
