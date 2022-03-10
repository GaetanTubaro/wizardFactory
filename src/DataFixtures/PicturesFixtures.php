<?php

namespace App\DataFixtures;

use App\Entity\Pictures;
use App\Repository\DogsRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PicturesFixtures extends Fixture implements DependentFixtureInterface
{
    protected $dogRepository;
    
    public function __construct(DogsRepository $dogRepository)
    {
        $this->dogRepository = $dogRepository;
    }

    public function load(ObjectManager $manager)
    {
        $picturesPath = [
            'https://leparisien.fr/resizer/Ic7r3A1QUUrSgnmSqst4IibwvXA=/1200x675/cloudfront-eu-central-1.images.arcpublishing.com/leparisien/Q6MTNENGOZGU3BR5OUEO2GNMOI.jpg',
            'https://lemagduchien.ouest-france.fr/images/dossiers/2020-11/chien-boude-070451.jpg',
            'https://media.discordapp.net/attachments/914258377843028008/951462993781207050/IMG_8804.png?width=277&height=493',
            'https://www.zoomalia.com/blogz/2130/adorable-animal-breed-canine-374906.jpeg',
            'https://preview.redd.it/x8iqw9jtccz41.jpg?auto=webp&s=6224d302f54c7ddac3f7128df740cde1e038548c'
        ];
        
        $dogs = $this->dogRepository->findAll();

        foreach ($picturesPath as $picturePath) {
            $picture = new Pictures();
            $picture->setPath($picturePath);
            $randomNb = mt_rand(0, count($dogs) - 1);
            $picture->setDog($dogs[$randomNb]);
            
            $manager->persist($picture);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DogsFixtures::class,
        ];
    }
}
