<?php

namespace App\DataFixtures;

use App\Entity\Adopters;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class AdoptersFixtures extends Fixture
{
    protected UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager)
    {
        $adoptersMail = [
            "aaa.bbb@abc.fr",
            "ccc.ddd@dce.fr",
            "eee.fff@fgh.fr",
            "ggg.hhh@ijk.fr",
            "iii.jjj@lmn.fr",
            "kkk.lll@opq.fr"
        ];
        $adoptersPhone = [
            "0609050402",
            "0605040201",
            "0697956652",
            "0687565123",
            "0632154895",
            "0654848415"
        ];
        $adoptersCity = [
            "Lyon",
            "Vienne",
            "Lyon",
            "Mions",
            "Lyon",
            "Lyon"
        ];
        $adoptersDepartement = [
            "Rhône",
            "Isère",
            "Rhône",
            "Rhône",
            "Rhône",
            "Rhône"
        ];
        $adoptersFirstName = [
            "Liam",
            "Abdel",
            "Clara",
            "Gaëtan",
            "Yanni",
            "Fabien"
        ];
        $adpotersSurname = [
            "Trishula",
            "Mekouy",
            "Goncalves",
            "Tubaro",
            "Bou",
            "Farucci"
        ];
        $adoptersChild = [
            1,
            0,
            2,
            5,
            3,
            0
        ];
        $adoptersGotAnimals = [
            false,
            false,
            true,
            true,
            false,
            true
        ];
        $adoptersUsername = [
            "Obalmaské",
            "Memekoukouy",
            "Ekky",
            "Kaider",
            "Shiryolo",
            "Ludicolo"
        ];
        $adoptersCreationDate = [
        new DateTime('2020-11-25'),
        new DateTime('2020-10-20'),
        new DateTime('2020-06-22'),
        new DateTime('2020-03-02'),
        new DateTime('2020-01-09'),
        new DateTime('2020-09-30')
        ];
        $adoptersIsAdmin = [
            false,
            false,
            false,
            false,
            false,
            false
        ];
        $adoptersRoles = [];
        $adoptersRequest = [];
        for ($i = 0; $i<6;$i++) {
            $adopter = new Adopters();

            $adopter->setPassword(
                $this->hasher->hashPassword($adopter, "1234")
            );
            $adopter->setMail($adoptersMail[$i]);
            $adopter->setPhone($adoptersPhone[$i]);
            $adopter->setCity($adoptersCity[$i]);
            $adopter->setDepartment($adoptersDepartement[$i]);
            $adopter->setFirstName($adoptersFirstName[$i]);
            $adopter->setSurname($adpotersSurname[$i]);
            $adopter->setChild($adoptersChild[$i]);
            $adopter->setGotAnimals($adoptersGotAnimals[$i]);
            $adopter->setUsername($adoptersUsername[$i]);
            $adopter->setCreationDate($adoptersCreationDate[$i]);
            $adopter->setIsAdmin($adoptersIsAdmin[$i]);
            $adopter->setRoles($adoptersRoles);
            $adopter->discr = 'adoptant';

            $manager->persist($adopter);
        }


        $manager->flush();
    }
}
