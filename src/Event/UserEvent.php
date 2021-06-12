<?php


namespace next\SymfonyPermissionBundle\Event;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\User\UserInterface;

class UserEvent extends  Event
{
    protected UserInterface $user;
    /**
     * UserEvent constructor.
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * @return UserInterface
     */
    public function getUser():UserInterface{
        return $this->user;
    }
}