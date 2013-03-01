<?php

namespace Ephp\UtilityBundle\Utility;

class Dom {

    /**
     *
     * @param \DOMElement $element
     * @param string $tag
     * @return \BringOut\Bundle\GrabBundle\Controller\DOMElement
     */
    public static function getDOMBase(\DOMDocument $element, $tag = 'html') {
        return $element->getElementsByTagName($tag)->item(0);
    }

    /**
     *
     * @param \DOMElement $element
     * @param array $criteria
     * @param boolean $first
     * @return \BringOut\Bundle\GrabBundle\Controller\DOMElement
     */
    public static function getDOMElement(\DOMElement $element, $criteria = array(), $first = true) {
        $out = $first ? false : array();
        $i = 0;
        if (isset($criteria['vd'])) {
            Debug::pr('========================', true);
            Debug::pr($criteria, true);
        }
        if (isset($criteria['n'])) {
            $first = false;
            $out = false;
        }
        foreach ($element->childNodes as $tag) {
            if ($tag instanceof \DOMElement) {
                /* @var $tag \DOMElement */
                if (isset($criteria['vd'])) {
                    Debug::pr('------------------------', true);
                    $attributes = array();
                    foreach ($tag->attributes as $attr) {
                        /* @var $attr \DOMAttr */
                        $attributes[$attr->name] = $attr->value;
                    }
                    $vd = array(
                        'tag' => $tag->nodeName,
                        'attr' => $attributes,
                    );
                    if (isset($criteria['vd-value'])) {
                        $vd['value'] = $tag->nodeValue;
                    }
                    Debug::vd($vd, true);
                }
                if (isset($criteria['id'])) {
                    if ($tag->hasAttribute('id')) {
                        if ($tag->getAttribute('id') == $criteria['id']) {
                            if (isset($criteria['vd'])) {
                                Debug::pr('      \'RETURN\' => 1', true);
                            }
                            return $tag;
                        }
                    }
                }
                if (isset($criteria['tag'])) {
                    if ($tag->nodeName == $criteria['tag']) {
                        if ($first) {
                            if (isset($criteria['vd'])) {
                                Debug::pr('      \'RETURN\' => 1', true);
                            }
                            return $tag;
                        } elseif (isset($criteria['n'])) {
                            $i++;
                            if ($criteria['n'] == $i) {
                                if (isset($criteria['vd'])) {
                                    Debug::pr('      \'RETURN\' => 1', true);
                                }
                                return $tag;
                            }
                        } else {
                            if (isset($criteria['vd'])) {
                                Debug::pr('      \'RETURN\' => 1', true);
                            }
                            $out[] = $tag;
                        }
                    }
                }
                if (isset($criteria['class'])) {
                    if ($tag->hasAttribute('class')) {
                        if (strpos($tag->getAttribute('class'), $criteria['class']) !== false) {
                            if ($first) {
                                if (isset($criteria['vd'])) {
                                    Debug::pr('      \'RETURN\' => 1', true);
                                }
                                return $tag;
                            } elseif (isset($criteria['n'])) {
                                $i++;
                                if ($criteria['n'] == $i) {
                                    if (isset($criteria['vd'])) {
                                        Debug::pr('      \'RETURN\' => 1', true);
                                    }
                                    return $tag;
                                }
                            } else {
                                if (isset($criteria['vd'])) {
                                    Debug::pr('      \'RETURN\' => 1', true);
                                }
                                $out[] = $tag;
                            }
                        }
                    }
                }
            }
        }
        return $out;
    }

    
}
