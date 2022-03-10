<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    protected UserPasswordHasherInterface $hasher;


    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $tabUsers = [
            0 => ['Abdel', ['ROLE_ADMIN'], 'root', new DateTime('2020-11-25'), true],
            1 => ['MrsBengs', [], 'toor', new DateTime('2021-02-14'), false],
            2 => ['Ekki', ['ROLE_ADMIN'], 'hooty', new DateTime('2021-09-30'), true],
            3 => ['Shiryoa', ['ROLE_ADMIN'], 'mekouy', new DateTime(), true],
        ];
        for ($i = 0; $i <= 1; $i++) {
            $user = new User;
            $user->setUsername($tabUsers[$i][0]);
            $user->setRoles($tabUsers[$i][1]);
            $user->setPassword(
                $this->hasher->hashPassword($user, $tabUsers[$i][2])
            );
            $user->setCreationDate($tabUsers[$i][3]);
            $user->setIsAdmin($tabUsers[$i][4]);
<<<<<<< HEAD
            $user->discr = 'user';
=======
>>>>>>> 924a1cc (creation fixtures)
            $manager->persist($user);
        }
        $manager->flush();
    }
}
