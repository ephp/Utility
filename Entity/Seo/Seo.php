<?php

namespace Ephp\UtilityBundle\Entity\Seo;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ephp\UtilityBundle\Entity\Seo\Seo
 *
 * @ORM\Table(name="seo_config")
 * @ORM\Entity(repositoryClass="Ephp\UtilityBundle\Entity\Seo\SeoRepository")
 */
class Seo
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $entity_class
     *
     * @ORM\Column(name="entity_class", type="string", length=255)
     */
    private $entity_class;
    
    /**
     * @var string $entity_name
     *
     * @ORM\Column(name="entity_name", type="string", length=255)
     */
    private $entity_name;

    /**
     * @var text $description_base
     *
     * @ORM\Column(name="description_base", type="text")
     */
    private $description_base;

    /**
     * @var text $keywords_fields
     *
     * @ORM\Column(name="keywords_fields", type="text", nullable=true)
     */
    private $keywords_fields;

    /**
     * @var smallint $keywords_min_length
     *
     * @ORM\Column(name="keywords_min_length", type="smallint")
     */
    private $keywords_min_length;
    
    /**
     * @var smallint $keywords_max_length
     *
     * @ORM\Column(name="keywords_max_length", type="smallint")
     */
    private $keywords_max_length;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set entity_class
     *
     * @param string $entityClass
     */
    public function setEntityClass($entityClass)
    {
        $this->entity_class = $entityClass;
    }

    /**
     * Get entity_class
     *
     * @return string 
     */
    public function getEntityClass()
    {
        return $this->entity_class;
    }

    /**
     * Set entity_name
     *
     * @param string $entityName
     */
    public function setEntityName($entityName)
    {
        $this->entity_name = $entityName;
    }

    /**
     * Get entity_name
     *
     * @return string 
     */
    public function getEntityName()
    {
        return $this->entity_name;
    }

    /**
     * Set description_base
     *
     * @param text $descriptionBase
     */
    public function setDescriptionBase($descriptionBase)
    {
        $this->description_base = $descriptionBase;
    }

    /**
     * Get description_base
     *
     * @return text 
     */
    public function getDescriptionBase()
    {
        return $this->description_base;
    }

    /**
     * Set keywords_fields
     *
     * @param text $keywords_fields
     */
    public function setKeywordsFields($keywords_fields)
    {
        $this->keywords_fields = $keywords_fields;
    }

    /**
     * Get keywords_fields
     *
     * @return string 
     */
    public function getKeywordsFields()
    {
        return $this->keywords_fields;
    }

    /**
     * Set keywords_min_length
     *
     * @param smallint $keywordsMinLength
     */
    public function setKeywordsMinLength($keywordsMinLength)
    {
        $this->keywords_min_length = $keywordsMinLength;
    }

    /**
     * Get keywords_min_length
     *
     * @return smallint 
     */
    public function getKeywordsMinLength()
    {
        return $this->keywords_min_length;
    }

    /**
     * Set keywords_max_length
     *
     * @param smallint $keywordsMaxLength
     */
    public function setKeywordsMaxLength($keywordsMaxLength)
    {
        $this->keywords_max_length = $keywordsMaxLength;
    }

    /**
     * Get keywords_max_length
     *
     * @return smallint 
     */
    public function getKeywordsMaxLength()
    {
        return $this->keywords_max_length;
    }

}