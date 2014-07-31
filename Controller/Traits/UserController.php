<?php

namespace JF\UtilityBundle\Controller\Traits;

trait UserController {

    protected function hasRole($role) {
        $user = $this->getUser();
        if (!$user) {
            return false;
        }
        return $user->hasRole($role);
    }

    protected function inRole($roles) {
        $user = $this->getUser();
        if (!$user) {
            return false;
        }
        $out = false;
        foreach ($roles as $role) {
            $out != $user->hasRole($role);
        }
        return $out;
    }

}