<?php


namespace next\SymfonyPermissionBundle\Manipulator;


use Doctrine\ORM\EntityManagerInterface;
use next\SymfonyPermissionBundle\Manager\RoleManagerInterface;

class RoleManipulator
{
    /**
     * User manager.
     *
     * @var RoleManagerInterface
     */
    private $roleManager;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(RoleManagerInterface $roleManager,EntityManagerInterface $manager)
    {
        $this->roleManager = $roleManager;
        $this->manager = $manager;
    }
    public function create($name)
    {
        $role = $this->roleManager->createRole();
        $role->setName($name);
        $this->manager->persist($role);
        $this->manager->flush();
        return $role;
    }
}