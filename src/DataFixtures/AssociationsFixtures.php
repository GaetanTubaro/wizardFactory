<?php

namespace App\DataFixtures;

use App\Entity\Associations;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AssociationsFixtures extends Fixture
{
    protected $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher=$hasher;
    }

    public function load(ObjectManager $manager)
    {
        $asso1 = new Associations;
        $asso1->setUsername("30millions");
        $asso1->setPassword(
            $this->hasher->hashPassword($asso1, "30millions")
        );
        $asso1->setCreationDate(new DateTime());
        $asso1->setName("30 Millions d'Amis");
        $asso1->setIsAdmin(false);
        $asso1->discr = 'association';
        $manager->persist($asso1);

        $asso2 = new Associations;
        $asso2->setUsername("huskaddict");
        $asso2->setPassword(
            $this->hasher->hashPassword($asso2, "huskaddict")
        );
        $asso2->setCreationDate(new DateTime());
        $asso2->setName("Husky Addicts");
        $asso2->setIsAdmin(false);
        $asso2->discr = 'association';
        $manager->persist($asso2);

        $asso3 = new Associations;
        $asso3->setUsername("SPAMarennes");
        $asso3->setPassword(
            $this->hasher->hashPassword($asso3, "SPAMarennes")
        );
        $asso3->setCreationDate(new DateTime());
        $asso3->setName("SPA Marennes");
        $asso3->setIsAdmin(false);
        $asso3->discr = 'association';
        $manager->persist($asso3);

        $manager->flush();
    }
}
