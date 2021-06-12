<?php


namespace next\SymfonyPermissionBundle\Model;


use Doctrine\Common\Collections\ArrayCollection;
use next\SymfonyPermissionBundle\Model\RoleInterface;
use next\SymfonyPermissionBundle\Traits\HasRoles;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseUser implements UserInterface
{
    use HasRoles;
    /**
     * @var RoleInterface[]|Collection
     */
    protected $accessRoles;
    public function getPassword(){}
    public function getSalt(){}
    public function getUsername(){}
   
    public function eraseCredentials(){}
    public function __construct()
    {
        $this->accessRoles = [];
    }
    public function getRoles(): array
    {
        
        $roleNames = [];
        $roles     = $this->getAccessRoles();

        foreach ($roles as $role) {
            $roleNames[] = $role->getGuardName();
        }

        return array_unique($roleNames);
    }
    /**
     * add One role to user
     * @param \Hb\SymfonyPermissionBundle\src\Model\RoleInterface $role
     * @return $this
     */
    public function addAccessRole(RoleInterface $role)
    {
        if (!$this->accessRoles->contains($role)) {
            $this->accessRoles[] = $role;
        }
        return $this;
    }
    /**
     * add multiple role a faire
     * @param Collection $roles
     */
    public function setAccessRoles(Collection $roles)
    {
        $this->accessRoles=$roles;
    }
    /**
     * @return Collection|RoleInterface[]
     */
    public function getAccessRoles(): Collection
    {
        return $this->accessRoles;
    }
}