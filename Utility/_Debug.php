<?php

namespace Ephp\UtilityBundle\Utility;

class _Debug {
    
    public static function json($o, $continue = true) {
        $json = json_encode($o);
        if (!$continue) {
            echo $json;
            exit;
        }
        return $json;
    }
    
    public static function print_r($o) {
        return print_r($o, true);
    }

    public static function pr($o, $continue = false) {
        echo "<pre>";
        echo self::print_r($o);
        echo "</pre>";
        if (!$continue)
            exit;
    }

    public static function var_dump($o) {
        ob_start();
        var_dump($o);
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }
    
    public static function vd($o, $continue = false) {
        var_dump($o);
        if (!$continue)
            exit;
    }

    public static function typeof($s) {
        return (gettype($s) == 'object' ? 'Classe: ' . get_class($s) : 'Tipo: ' . gettype($s));
    }

    public static function info($s, $continue = false) {
        echo self::typeof($s);
        if (!$continue)
            exit;
    }

    public static function infoPr($s, $continue = false) {
        echo '<pre>'.(gettype($s) == 'object' ? 'Classe: ' . get_class($s) : 'Tipo: ' . gettype($s)).'<pre>';
        self::pr($s, $continue);
    }

    public static function infoVd($s, $continue = false) {
        echo '<pre>'.(gettype($s) == 'object' ? 'Classe: ' . get_class($s) : 'Tipo: ' . gettype($s)).'<pre>';
        self::vd($s, $continue);
    }

}
