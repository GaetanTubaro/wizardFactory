<?php

namespace App\DataFixtures;

use App\Entity\Messages;
use App\Repository\RequestsRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessagesFixtures extends Fixture implements DependentFixtureInterface
{
    protected $advertismentsRepository;

    public function __construct(RequestsRepository $requestsRepository)
    {
        $this->requestsRepository = $requestsRepository;
    }


    public function load(ObjectManager $manager): void
    {
        $requests = $this->requestsRepository->findAll();

        $tabMessages = [
            0 => [new DateTime('2021-04-15'), true, 'mhEOPFDOPFHmldhfmhdfmDHFMOH'],
            1 => [new DateTime('2021-01-05'), false, 'dpfijqmlfhqmlfhlqmihfdmlqfh'],
            2 => [new DateTime(), true, 'sqdqdskqlshdqlshlqfshlkshqsd'],
            3 => [new DateTime(), true, 'sqpjdqspjdqmkdhqpshdqmdmqj'],
            4 => [new DateTime('2020-08-25'), false, 'qspdjqsdiqlhdklqihdllldsq'],
            5 => [new DateTime(), false, 'qldhhshsqldlhsidhzlandlqkhm'],
            6 => [new DateTime('2021-02-20'), true, 'qspdhqsdqsdhqlkdlqkhdlqklhl']
        ];
        for ($i = 0; $i <= 5; $i++) {
            $message = new Messages;
            $message->setCreationDate($tabMessages[$i][0]);
            $message->setIsRead($tabMessages[$i][1]);
            $message->setDescription($tabMessages[$i][2]);
            $nb = mt_rand(0, count($requests) - 1);
            $message->setRequest($requests[$nb]);
            $manager->persist($message);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RequestsFixtures::class,
        ];
    }
}
