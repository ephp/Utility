<?php

namespace JF\UtilityBundle\Controller\Traits;

trait EnvironmentController {

    /**
     * 
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @throws \Exception
     */
    protected function getParam($name, $default = null) {
        $out = $this->getRequest()->get($name, null);
        if ($out === null) {
            if ($default instanceof \Exception) {
                throw $default;
            }
            $out = $default;
        }
        return $out;
    }

    /**
     * 
     * @return mixed
     * @throws \Exception
     */
    protected function getRoute() {
        return $this->getParam('_route');
    }

    /**
     * 
     * @return mixed
     * @throws \Exception
     */
    protected function getRouteParams() {
        return $this->getParam('_route_params');
    }

    protected function getQuery($unsets = array()) {
        $query = array_merge($this->getRequest()->query->all(), $this->getRequest()->attributes->all());
        unset($query['_route'], $query['_route_params'], $query['_template_streamable'], $query['_template_default_vars']);
        foreach ($unsets as $unset) {
            unset($query[$unset]);
        }
        return $query;
    }

}
