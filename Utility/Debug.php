<?php

namespace JF\UtilityBundle\Utility;

class Debug {
    
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
    
    public static function time($label, $start, $continue = true) {
        $end = microtime(true);
        $time = $end - $start;
        echo "<pre><b>{$label}</b>: {$time} secondi</pre>\n";
        if (!$continue)
            exit;
        return $end;
    }
    
    public static function memory($punto, $max = 250) {
        $mem_usage = memory_get_usage(true); 
        if($mem_usage/1048576 > $max) {
            throw new \Exception("Superati {$max}Mb nel punto {$punto}");
        } else {
            echo ($mem_usage/1048576)."Mb nel punto {$punto}\n";
        }
    }
    
}
