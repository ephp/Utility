<?php

namespace JF\UtilityBundle\Utility;

class Time {

    /**
     * Dato l'array restituito dall'input type="date" costruisce un oggetto di tipo DateTime
     * 
     * @param array $data
     * @return \DateTime
     */
    public static function datetimeFromBirthday($data) {
        return \DateTime::createFromFormat('d/m/Y', "{$data['day']}/{$data['month']}/{$data['year']}");
    }
    
    /**
     * Data una data e un numero di giorni, calcola la data richiesta evitando che caschi in alcuni giorni della settimana
     * 
     * @param \DateTime $data data di partenza
     * @param type $giorni numero di giorni (può essere anche negativo)
     * @param boolean $posticipa se il giorno cercato non è fra quelli ammessi, posticipa l'impegno al primo giorno utile (default: false)
     * @param array $days giorni ammessi (default: array(1, 2, 3, 4, 5) ovvero da lunedì a venerdì)
     * @return \DateTime
     */
    public static function calcolaData(\DateTime $data, $giorni, $posticipa = false, $days = array(1, 2, 3, 4, 5)) {
        if ($giorni == 0) {
            return $data;
        }
        if ($giorni > 0) {
            $data = $data->add(new \DateInterval('P' . $giorni . 'D'));
        } else {
            $data = $data->sub(new \DateInterval('P' . -$giorni . 'D'));
        }
        while (!in_array(date('N', $data->getTimestamp()), $days)) {
            if ($posticipa) {
                $data = $data->add(new \DateInterval('P1D'));
            } else {
                $data = $data->sub(new \DateInterval('P1D'));
            }
        }
        return $data;
    }

    /**
     * -> y rende gli anni
     * -> m rebnde i mesi
     * -> d rende i giorni
     * 
     * @param type $data
     * @return \DateInterval
     */
    public static function calcolaAnni($data) {
        $date2 = new \DateTime(date('Y-m-d'));
        $interval = $data->diff($date2);
        return $interval;
    }

}
