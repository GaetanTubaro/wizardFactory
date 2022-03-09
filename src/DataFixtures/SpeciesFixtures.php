<?php

namespace App\DataFixtures;

use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpeciesFixtures extends Fixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $speciesNames = [
            'Berger Allemand',
            'Berger Australien',
            'Bouvier Bernois',
            'Spitz nain',
            'Berger islandais',
            'Chihuahua',
            'Dalmatien',
            'Husky'
        ];
        
        foreach ($speciesNames as $speciesName) {
            $species = new Species();
            $species->setName($speciesName);
            
            $manager->persist($species);
        }

        $manager->flush();
    }
}
