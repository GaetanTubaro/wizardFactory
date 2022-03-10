<?php

namespace App\DataFixtures;

use App\Entity\Messages;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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
            $manager->persist($message);
        }
        $manager->flush();
    }
}
