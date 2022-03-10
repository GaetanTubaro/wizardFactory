<?php

namespace App\DataFixtures;

use App\Entity\Adopters;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
        $adoptersRequest = [];
        for ($i = 0; $i<6;$i++) {
            $adopter = new Adopters();

            $adopter->setPassword(
                $this->hasher->hashPassword($adopter, "1234")
            );
            $adopter->setUsername($adoptersUsername[$i]);
            $adopter->setMail($adoptersMail[$i]);
            $adopter->setPhone($adoptersPhone[$i]);
            $adopter->setCity($adoptersCity[$i]);
            $adopter->setDepartment($adoptersDepartement[$i]);
            $adopter->setFirstName($adoptersFirstName[$i]);
            $adopter->setSurname($adpotersSurname[$i]);
            $adopter->setChild($adoptersChild[$i]);
            $adopter->setGotAnimals($adoptersGotAnimals[$i]);

            $manager->persist($adopter);
        }


        $manager->flush();
    }
}
