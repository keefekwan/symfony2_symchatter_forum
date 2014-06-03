<?php
// src/JFC/ModelBundle/DataFixtures/ORM/Replies.php

namespace JFC\ModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JFC\ModelBundle\Entity\Reply;

/**
 * Fixtures for Category Entity
 */
class Replies extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $reply1 = new Reply();
        $reply1->setAuthor('Foo1');
        $reply1->setBody('Phasellus at lectus quis lectus tristique faucibus eu in lacus. Nullam convallis sapien
        sed nulla euismod lacinia.');

        $reply2 = new Reply();
        $reply2->setAuthor('Foo2');
        $reply2->setBody('Phasellus at lectus quis lectus tristique faucibus eu in lacus. Nullam convallis sapien
        sed nulla euismod lacinia.');

        $reply3 = new Reply();
        $reply3->setAuthor('Foo1');
        $reply3->setBody('Phasellus at lectus quis lectus tristique faucibus eu in lacus. Nullam convallis sapien
        sed nulla euismod lacinia.');

        $reply4 = new Reply();
        $reply4->setAuthor('Foo3');
        $reply4->setBody('Phasellus at lectus quis lectus tristique faucibus eu in lacus. Nullam convallis sapien
        sed nulla euismod lacinia.');

        $reply5 = new Reply();
        $reply5->setAuthor('Foo3');
        $reply5->setBody('Phasellus at lectus quis lectus tristique faucibus eu in lacus. Nullam convallis sapien
        sed nulla euismod lacinia.');

        $manager->persist($reply1);
        $manager->persist($reply2);
        $manager->persist($reply3);
        $manager->persist($reply4);
        $manager->persist($reply5);

        $manager->flush();

        $this->addReference('reply-1', $reply1);
        $this->addReference('reply-2', $reply2);
        $this->addReference('reply-3', $reply3);
        $this->addReference('reply-4', $reply4);
        $this->addReference('reply-5', $reply5);
    }

    /**
     * {inheritDoc}
     */
    public function getOrder()
    {
        return 30;
    }
}