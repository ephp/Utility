<?php

namespace Ephp\UtilityBundle\Seo;

use Doctrine\ORM\Mapping as ORM;
use Ephp\UtilityBundle\Seo\Model\ISeo;

class Seo {
    
    /**
     * @var \Doctrine\ORM\EntityManager 
     */
    private $em = null;
    
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function generateSeo(ISeo &$entity) {
        $classe = get_class($entity);
        $_seo = $this->em->getRepository('EphpUtilityBundle:Seo\Seo');
        $seo = $_seo->findOneBy(array('entity_class' => $classe));
        if($seo) {
            $personalizzazione = array('comando' => array(), 'valore' => array(), 'keyword' => array());
            $entity->setSeoTitle($entity->title());
            foreach ($entity->getSeoFields() as $field => $info) {
                $fx = $info['fx'];
                $personalizzazione['comando'][] = "[{$field}]";
                $personalizzazione['valore'][] = $entity->$fx();
                $personalizzazione['keyword']["[{$field}]"] = $entity->$fx();
            }
            $description = str_replace($personalizzazione['comando'], $personalizzazione['valore'], $seo->getDescriptionBase());
            $entity->setSeoDescription($description);
            
            $delimitatore = '/\'[,.\\-;:\\/ ]\'/';
            $keyword_fields = explode("\n", $seo->getKeywordsFields());
            $keywords = array();
            foreach ($keyword_fields as $keyword_field) {
                if(preg_match($delimitatore, $keyword_field, $delimiter) == 0) {
                    $delimiter = ' ';
                } else {
                    $delimiter = str_replace("'", '', $delimiter[0]);
                    $keyword_field = preg_replace($delimitatore, '', $keyword_field);
                }
                $keyword_field = trim($keyword_field);
                if(isset($personalizzazione['keyword'][$keyword_field])) {
                    $_keywords = explode($delimiter, $personalizzazione['keyword'][$keyword_field]);
                } else {
                    $_keywords = explode($delimiter, $keyword_field);
                }
                foreach ($_keywords as $_keyword) {
                    if(strlen($_keyword) >= intval($seo->getKeywordsMinLength()) && strlen($_keyword) <= intval($seo->getKeywordsMaxLength()))
                        $keywords[$_keyword] = trim($_keyword);
                }
            }
            $entity->setSeoKeywords(implode(', ', $keywords));
        }
    }

    
}