<?php


namespace next\SymfonyPermissionBundle\Model;


interface RoleInterface
{
    /**
     * Role ID for super admin users; should match what's in the "role" table.
     */
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    /**
     * Indicates that a role has all available permissions.
     *
     * @return bool
     * TRUE if the role has all permissions
     */
    public function isSuperAdmin():bool;

}