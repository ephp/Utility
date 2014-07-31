<?php

namespace JF\UtilityBundle\Controller\Traits;

trait ServiceController {

    /**
     * 
     * @return \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected function getTranslator() {
        return $this->get('translator');
    }

}