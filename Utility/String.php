<?php

namespace Ephp\UtilityBundle\Utility;

class String {

    /**
     * Restituisce un array contenente l'alfabeto
     * 
     * @return array
     */
    public static function alfabeto() {
        return array(
            'A', 'B', 'C', 'D', 'E',
            'F', 'G', 'H', 'I', 'J',
            'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y',
            'Z'
        );
    }

    public static function currency($euro, $migliaia = '.', $decimali = ',') {
        return str_replace(array('€', $migliaia, $decimali, ' '), array('', '', '.', ''), $euro);
    }

    public static function tronca($testo, $lunghezza, $space = true) {
        $testo = str_replace('  ', ' ', strip_tags(str_replace('<', ' <', $testo)));
        if (strlen($testo) <= $lunghezza) {
            return $testo;
        }
        if($space) {
            $len = strpos($testo, ' ', $lunghezza);
            return substr($testo, 0, $len) . '...';
        } else {
            return substr($testo, 0, $lunghezza-3) . '...';
        }
    }

    public static function cercaRegExp($testo, $find) {
        $parole = explode(' ', $find);
        foreach ($parole as $k => $parola) {
            $parole[$k] = "({$parola}){1}";
        }
        $regexp = implode('[a-z0-9\.\, \-]+', $parole);
        preg_match_all("/{$regexp}/i", $testo, $match);
        return count($match[0]) > 0;
    }

    public static function isEmail($email) {
        $regexp_email = "^([a-zA-Z0-9_\\.\\-\\+])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$";
        preg_match("/{$regexp_email}/", $email, $match);
        return count($match) > 0;
    }

    public static function pulisci($frase) {
        $remove = $replace = array();
        $not_remove = array_merge(array(32, 39, 45, 46, 47), range(48, 57), range(65, 90), range(97, 122));
        for ($i = 0; $i < 127; $i++) {
            if (!in_array($i, $not_remove)) {
                $remove[] = chr($i);
                $replace[] = ' ';
            }
        }
        for ($i = 65; $i < 91; $i++) {
            $remove[] = chr($i);
            $replace[] = chr($i + 32);
        }
        $remove = array_merge(array('.', '`', '&agrave;', '&egrave;', '&eacute;', '&igrave;', '&ograve;', '&ugrave;'), $remove, array('     ', '    ', '   ', '  '));
        $replace = array_merge(array('', '\'', 'a', 'e', 'e', 'i', 'o', 'u'), $replace, array(' ', ' ', ' ', ' '));

        return str_replace($remove, $replace, strip_tags($frase));
    }

    public static function normalizza($frase) {
        return strtolower(str_replace(
                                array('`', "'A", "'E", "'I", "'O", "'U"), array('', 'a', 'e', 'i', 'o', 'u'), iconv("utf-8", "ascii//TRANSLIT", $frase)
                        ));
    }
    
    public static function ripulisci($frase) {
        $frase = str_replace(array('>', "\n", "\r"), array('> ', ' ', ' '), $frase);
        $frase = strip_tags($frase);
        $frase = self::pulisci($frase);
        $frase = self::normalizza($frase);
        return $frase;
    }
    
    public static function strip_tags($txt) {
        return str_replace(array('&nbsp;', '   ', '  ', "\\n", "\n \n", "\n\n"), array(' ', ' ', ' ', "\n", "\n", "\n"), strip_tags(str_replace(array(' />', '<br/>', '<br>', '</p>', '</div>', '>'), array('/>', "<br/>\n", "<br/>\n", "</p>\n", "</div>\n", '> '), $txt)));
    }
    
    /**
     * Trasforma una stringa, una data in un codice di 8 caratteri
     * 
     * @param type $obj
     * @return string
     */
    public static function ep8($obj) {
        if(is_array($obj)) {
            $out = array();
            foreach ($obj as $o) {
                $out[] = self::ep8($o);
            }
            return implode('-', $out);
        } else if($obj instanceof \DateTime) {
            /* @var $obj \DateTime */
            $str = $obj->getTimestamp();
        } else if($obj instanceof \Ephp\UtilityBundle\Interfaces\EP8) {
            /* @var $obj \Ephp\UtilityBundle\Interfaces\EP8 */
            $str = $obj->ep8String();
        } else {
            $str = 'ep8 '.$obj;
        }
        $str = md5($str).sha1($str);
        $n = 0;
        for($i = 0; $i < strlen($str); $i++) {
            $n += ord($str{$i}) * (1 + $i % 10);
        }
        $n = dechex($ts).'';
        return str_repeat('0', 8-strlen($n)).$n;
    }

}
