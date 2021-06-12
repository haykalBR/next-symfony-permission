# SymfonyPermission Bundle
Associate users with roles.
Installation
---
### Step 1: Download the Bundle
Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require nexthb/symfony-permission
```
This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.


### Step 2: Enable the Bundle

With Symfony , the package will be activated automatically. But if something goes wrong, you can install it manually.

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
<?php
// config/bundles.php

return [
    //...
     next\SymfonyPermissionBundle\SymfonyPermissionBundle::class => ['all' => true]
];
```
### Step 3: Create User, Role, Class
##### A) Create User Class
Create the User class for your application. This class can look and act however you want: add any properties or methods you find useful. This is your User class.
```php
<?php 
//...
use \next\SymfonyPermissionBundle\Model\BaseUser;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;
    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="users",cascade={"persist"})
     */
    protected $accessRoles;
}
```
##### B) Create Role Class
Create the Role class for your application. This class can look and act however you want: add any properties or methods you find useful. This is your Role class.
```php
use next\SymfonyPermissionBundle\Model\Role as BaseRole;
/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Role extends BaseRole
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $name;
    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="roles")
     */
    protected $users;
}
```
### Step 4: Settings Bundle
Create a "symfony_permission.yaml" file for the settings.
```yaml
# config/packages/symfony_permission.yaml

symfony_permission:
  user: App\Entity\User
  role: App\Entity\Role
```
* __user:__ Define 'User' class address
* __role:__ Define 'Role' class address


### Step 5: What It Does
This package allows you to manage user and roles in a database.
Once installed you can do stuff like this:
##### PHP
```php
  $user->hasRole($role);
  $user->hasAllRole($role,$role1);
  $user->hasAnyRole([$role,$role1]);

```
##### COMMAND
```command
 php bin/console next:user:create
 php bin/console next:role:create
```
