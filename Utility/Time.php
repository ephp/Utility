<?php

namespace Ephp\UtilityBundle\Utility;

class Time {

    public static function datetimeFromBirthday($data) {
        return \DateTime::createFromFormat('d/m/Y', "{$data['day']}/{$data['month']}/{$data['year']}");
    }

    public static function calcolaData(\DateTime $data, $giorni, $posticipa = false, $days = array(1, 2, 3, 4, 5)) {
        if($giorni == 0) {
            return $data;
        }
        if($giorni > 0) {
            $data = $data->add(new \DateInterval('P' . $giorni . 'D'));
        } else {
            $data = $data->sub(new \DateInterval('P' . -$giorni . 'D'));
        }
        while(!in_array(date('N', $data->getTimestamp()), $days)) {
            if($posticipa) {
                $data = $data->add(new \DateInterval('P1D'));
            } else {
                $data = $data->sub(new \DateInterval('P1D'));
            }
        }
        return $data;
    }

}
