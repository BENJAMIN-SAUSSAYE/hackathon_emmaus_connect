<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un utilisateur
        $user = new User();
        $user->setEmail('user@monsite.com');
        $user->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'userpassword');
        $user->setPassword($hashedPassword);
        $user->setFirstname('Cedric');
        $user->setLastname('Durand');
        $manager->persist($user);
        $this->addReference('User_OPERATOR', $user);

        // Création d'un administrateur
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminpassword');
        $admin->setPassword($hashedPassword);
        $admin->setFirstname('Mike');
        $admin->setLastname('Xiong');
        $manager->persist($admin);
        $this->addReference('User_ADMIN', $admin);

        $manager->flush();
    }
}
