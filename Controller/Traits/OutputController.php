<?php

namespace JF\UtilityBundle\Controller\Traits;

trait OutputController {

    /**
     * 
     * @return \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected function getTranslator() {
        return $this->get('translator');
    }

}