<?php

namespace Ephp\UtilityBundle\Controller\Traits;

trait CurlController {

    protected function curlPost($url, $params = array(), $header = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $this->curlHeader($ch, $header);
        $this->curlBase($ch);
        curl_setopt($ch, CURLOPT_POST, 1);
        if (is_array($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        $out = curl_exec($ch);

        if ($out === false) {
            throw new \Exception('Errore CURL POST in ' . $url . ': ' . curl_error($ch));
        }

        curl_close($ch);

        return $out;
    }

    protected function curlPostFile($url, $file, $param_file = 'files', $params = array()) {
        $file_name_with_full_path = realpath($file);
        $params['filename'] = $file_name_with_full_path;
        $params[$param_file] = '@' . $file_name_with_full_path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $this->curlBase($ch);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        
        $out = curl_exec($ch);
        
        if ($out === false) {
            throw new \Exception('Errore CURL POST File in ' . $url . ': ' . curl_error($ch));
        }

        curl_close($ch);

        return $out;
    }

    protected function curlGet($url, $header = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $this->curlHeader($ch, $header);
        $this->curlBase($ch);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $out = curl_exec($ch);

        if ($out === false) {
            throw new \Exception('Errore CURL GET in ' . $url);
        }

        curl_close($ch);

        return $out;
    }

    private function curlBase($ch) {
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/" . time() . ".cookie");
        curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/" . time() . ".cookie");
        curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
        curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    }

    private function curlHeader($ch, $header) {
        curl_setopt($ch, CURLOPT_HEADER, isset($header['show']) && $header['show']);
        if (isset($header['cookies'])) {
            $strCookie = implode('; ', $header['cookies']);
            curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
        }
        $headers = array();
        if (isset($header['content-type'])) {
            $headers[] = $header['content-type'];
        } else {
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

}
