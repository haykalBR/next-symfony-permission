<?php


namespace next\SymfonyPermissionBundle\Traits;
use next\SymfonyPermissionBundle\Model\RoleInterface;

trait HasRoles
{
    public function isSuperAdmin():bool
    {
        $role=RoleInterface::ROLE_SUPER_ADMIN;
        return $this->getAccessRoles()->exists(function($key, $value) use ($role){
            return $value->getName() === $role;
        });
    }
    public function hasRole(RoleInterface $role):bool{
        return $this->getAccessRoles()->exists(function($key, $value) use ($role){
            return $value === $role;
        });
    }
    public function hasAnyRole(...$roles):bool{
           foreach ($roles as $role){
               if ($this->getAccessRoles()->contains($role))
               {
                   return true;
               }
           }
           return false;
    }
    public function hasAllRole(...$roles):bool{
        foreach ($roles as $role){
            if (!$this->getAccessRoles()->contains($role))
            {
                return false;
            }
        }
        return true;
    }
}