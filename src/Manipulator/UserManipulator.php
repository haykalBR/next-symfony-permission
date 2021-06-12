<?php


namespace next\SymfonyPermissionBundle\Manipulator;
use Doctrine\ORM\EntityManagerInterface;
use next\SymfonyPermissionBundle\Manager\UserManagerInterface;


class UserManipulator
{
    /**
     * User manager.
     *
     * @var UserManagerInterface
     */
    private $userManager;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(UserManagerInterface $userManager,EntityManagerInterface $manager)
    {
        $this->userManager = $userManager;
        $this->manager = $manager;
    }
    public function create($email,$password)
    {
        $user = $this->userManager->createUser();
        $user->setEmail($email);
        $user->setPassword($password);
        $this->manager->persist($user);
        $this->manager->flush();
        return $user;
    }
}