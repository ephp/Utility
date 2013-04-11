<?php

namespace Ephp\UtilityBundle\Seo\Model;

interface ISeo {

    /**
     * Deve restituire un array composto da elementi così composti
     * 
     * 'abbreviazione per pannello SEO' => array(
     *             'fx' =>'funzione da richiamare lato php',
     *             'descrizione' => 'descrizione output per help del pannello SEO'
     * @return array
     */
    public function getSeoFields();
            
    /**
     * Rialcola il SEO del contenuto
     */
    public function generateSeo();
    
    /**
     * Calcola il titolo
     */
    public function title();
    
    /**
     * Imposta il gestore Seo 
     */
    public function setSeo(\Ephp\UtilityBundle\Seo\Seo $seo);

    /**
     * Funzione ORM\HasLifecycleCallbacks
     * Nel codice della funzione deve essere presente
     * 
     * if($this->generateSeo())
     *     Seo::generateSeo($this);
     */
    public function prePersist();

    /**
     * Funzione ORM\HasLifecycleCallbacks
     * Nel codice della funzione deve essere presente
     * 
     * if($this->generateSeo())
     *     Seo::generateSeo($this);
     */
    public function preUpdate();
    
    public function setSeoDescription($seo_description);
    public function getSeoDescription();
    public function setSeoKeywords($seo_keywords);
    public function getSeoKeywords();
    public function setSeoTitle($seo_title);
    public function getSeoTitle();
}