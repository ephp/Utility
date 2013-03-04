<?php

namespace Ephp\UtilityBundle\Utility;

class Collection {

    /**
     * Recupera un parametero da un array
     * 
     * @param array $array array dove ricercato il parametro
     * @param string|integer $name nome del parametro (per prendere $array[$name])
     * @param mixed $default Valore default restituito se il parametro non esiste (default: null)
     * @return mixed
     */
    public static function getFromArray($array, $name, $default = null) {
        return isset($array[$name]) ? $array[$name] : $default;
    }
    
}
