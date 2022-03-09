<?php

namespace App\DataFixtures;

use App\Entity\Advertisements;
use App\Repository\AssociationsRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdvertisementsFixtures extends Fixture
{
    protected $AssociationsRepository;
    
    public function __construct(AssociationsRepository $AssociationsRepository)
    {
        $this->AssociationsRepository = $AssociationsRepository;
    }

    public function load(ObjectManager $manager)
    {
        $associations = $this->AssociationsRepository->findAll();

        $ad1 = new Advertisements;
        $RandNb = mt_rand(0, count($associations) -1);
        $ad1->setTitle("Chiens à adopter")
        ->setCreationDate(new DateTime())
        ->setAssociation($associations[$RandNb]);
        $manager->persist($ad1);

        $ad2 = new Advertisements;
        $RandNb = mt_rand(0, count($associations) -1);
        $ad2->setTitle("Boules de poil cherchent foyers confortables")
        ->setCreationDate(new DateTime())
        ->setAssociation($associations[$RandNb]);
        $manager->persist($ad2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AssociationsFixtures::class,
        ];
    }
}
