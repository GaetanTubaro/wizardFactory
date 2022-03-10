<?php

namespace App\DataFixtures;

use App\Entity\Requests;
use App\Repository\AdoptersRepository;
use App\Repository\DogsRepository;
use App\Repository\MessagesRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RequestsFixtures extends Fixture implements DependentFixtureInterface
{
    protected $adoptersRepository;
    protected $dogsRepository;
    protected $messageRepository;

    public function __construct(AdoptersRepository $adoptersRepository, DogsRepository $dogsRepository, MessagesRepository $messagesRepository)
    {
        $this->adoptersRepository = $adoptersRepository;
        $this->dogsRepository = $dogsRepository;
        $this->messagesRepository = $messagesRepository;
    }

    public function load(ObjectManager $manager)
    {
        $adopters = $this->adoptersRepository->findAll();
        $dogs = $this->dogsRepository->findAll();
        $messages = $this->messagesRepository->findAll();

        for ($i = 0; $i < 6; $i++) {
            $request = new Requests();

            $randomNumber = mt_rand(0, count($adopters) - 1);
            $request->setAdopter($adopters[$randomNumber]);

            $randomNumber = mt_rand(0, count($dogs) - 1);
            $request->setDog($dogs[$randomNumber]);

            $randomNumber = mt_rand(0, count($messages) - 1);
            $request->addMessage($messages[$randomNumber]);

            $manager->persist($request);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AdoptersFixtures::class, DogsFixtures::class, MessagesFixtures::class
        ];
    }
}
