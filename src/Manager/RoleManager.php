<?php


namespace next\SymfonyPermissionBundle\Manager;


class RoleManager implements RoleManagerInterface
{
    private $class;
    public function __construct($class)
    {
        $this->class=$class;
    }
    public function createRole()
    {
        $class = $this->getClass();
        $user = new $class();
        return $user;
    }
    public function getClass(){
        return $this->class;
    }
}