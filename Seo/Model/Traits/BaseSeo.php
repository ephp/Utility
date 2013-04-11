<?php

namespace Ephp\UtilityBundle\Seo\Model\Traits;

trait BaseSeo {
    
    /**
     * @var \Ephp\UtilityBundle\Seo\Seo|boolean 
     */
    private $seo = false;

    public function setSeo(\Ephp\UtilityBundle\Seo\Seo $seo) {
        $this->seo = $seo;
    }

    public function generateSeo() {
        if ($this->seo) {
            $this->seo->generateSeo($this);
        }
    }

    /**
     * @ORM\Column(name="seo_title", type="string", length=255)
     */
    protected $seo_title;

    /**
     * @ORM\Column(name="seo_description", type="text", nullable=true)
     */
    protected $seo_description;

    /**
     * @ORM\Column(name="seo_keywords", type="text", nullable=true)
     */
    protected $seo_keywords;

    /**
     * @Gedmo\Slug(fields={"seo_title"}, unique=true, updatable=true)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    public function getSeoTitle() {
        return $this->seo_title;
    }

    public function setSeoTitle($seo_title) {
        $this->seo_title = $seo_title;
        return $this;
    }

    public function getSeoDescription() {
        return $this->seo_description;
    }

    public function setSeoDescription($seo_description) {
        $this->seo_description = $seo_description;
        return $this;
    }

    public function getSeoKeywords() {
        return $this->seo_keywords;
    }

    public function setSeoKeywords($seo_keywords) {
        $this->seo_keywords = $seo_keywords;
        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        parent::prePersist();
        if ($seo = $this->getSeo())
            $seo->getSeo($this);
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate() {
        parent::preUpdate();
        if ($seo = $this->getSeo())
            $seo->getSeo($this);
    }
}