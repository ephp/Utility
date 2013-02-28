<?php

namespace Ephp\UtilityBundle\Utility;

class Geo {

    const TERRA = 6372.795477598;

    public static function staticMap($lat, $lon, $x, $y, $zoom, $color = '337FC5', $type = 'roadmap') {
        return "http://maps.google.com/maps/api/staticmap?center={$lat},{$lon}&zoom={$zoom}&size={$x}x{$y}&maptype={$type}&sensor=true&markers=color:0x{$color}|{$lat},{$lon}&markers=size:tiny";
    }

    public static function getDistanzaRad($da, $a) {
        $da['lat'] = floatval($da['lat']);
        $da['lon'] = floatval($da['lon']);
        $a['lat'] = floatval($a['lat']);
        $a['lon'] = floatval($a['lon']);
        return acos(
                        (
                        sin($da['lat'])
                        *
                        sin($a['lat'])
                        ) + (
                        cos($da['lat'])
                        *
                        cos($a['lat'])
                        *
                        cos($da['lon'] - $a['lon'])
                        )
                ) * self::TERRA;
    }

    public static function getDistanza($da, $a) {
        return (
                acos(
                        (
                        sin(
                                deg2rad($da['lat'])
                        ) * sin(
                                deg2rad($a['lat'])
                        )
                        ) + (
                        cos(
                                deg2rad($da['lat'])
                        ) * cos(
                                deg2rad($a['lat'])
                        ) * cos(
                                deg2rad($da['lon'] - $a['lon'])
                        )
                        )
                )
                ) * 6372.795477598;
    }

    public static function km($distanza) {
        $distanza = floatval($distanza);
        if ($distanza < 0) {
            return 'n.d.';
        }
        if ($distanza < 1) {
            $distanza = $distanza * 1000;
            if ($distanza < 1) {
                return '1m';
            }
            if ($distanza < 100) {
                return round($distanza) . 'm';
            }
            return round($distanza, -1) . 'm';
        }
        if ($distanza < 10) {
            return round($distanza, 1) . 'km';
        }
        return round($distanza) . 'km';
    }

}
