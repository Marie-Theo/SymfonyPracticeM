<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // utilisateur 'user' avec le rôle ROLE_USER
        $user = new User();
        $user->setEmail("user@example.com")
             ->setIsVerified(true)
             ->setRoles(['ROLE_USER'])
             ->setPassword($this->userPasswordHasher->hashPassword($user, "user"));
        $manager->persist($user);

        // utilisateur 'admin' avec le rôle ROLE_ADMIN
        $admin = new User();
        $admin->setEmail("admin@example.com")
             ->setIsVerified(true)
             ->setRoles(['ROLE_ADMIN'])
             ->setPassword($this->userPasswordHasher->hashPassword($admin, "admin"));
        $manager->persist($admin);

        // utilisateur 'superadmin' avec le rôle ROLE_SUPER_ADMIN
        $superadmin = new User();
        $superadmin->setEmail("superadmin@example.com")
             ->setIsVerified(true)
             ->setRoles(['ROLE_SUPER_ADMIN'])
             ->setPassword($this->userPasswordHasher->hashPassword($superadmin, "superadmin"));
        $manager->persist($superadmin);

        $manager->flush();
    }
}
