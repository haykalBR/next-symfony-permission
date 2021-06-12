<?php


namespace next\SymfonyPermissionBundle\Manager;
use next\SymfonyPermissionBundle\Manager\UserManagerInterface;

 class UserManager implements UserManagerInterface
{
    private $class;
    public function __construct($class)
    {
        $this->class=$class;
    }

    public function createUser()
    {
        $class = $this->getClass();
        $user = new $class();
        return $user;
    }
    public function getClass(){
      return $this->class;
    }
}