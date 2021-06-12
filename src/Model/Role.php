<?php


namespace next\SymfonyPermissionBundle\Model;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use next\SymfonyPermissionBundle\Traits\TimestampableTrait;
use next\SymfonyPermissionBundle\Model\BaseUser;
/**
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Role implements RoleInterface
{
    use TimestampableTrait;
    protected string $name;
    /**
     * @var BaseUser[]|Collection
     */
    protected $users;
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }
    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }
        return $this;
    }

    /**
     * a voir
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->name === static::ROLE_SUPER_ADMIN;
    }
}