<?php
// src/JFC/ModelBundle/DataFixtures/ORM/Categories.php

namespace JFC\ModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JFC\ModelBundle\Entity\Category;

/**
 * Fixtures for Category Entity
 */
class Categories extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setTitle('Category1');

        $category2 = new Category();
        $category2->setTitle('Category2');

        $category3 = new Category();
        $category3->setTitle('Category3');

        $category4 = new Category();
        $category4->setTitle('Category4');

        $category5 = new Category();
        $category5->setTitle('Category5');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->persist($category4);
        $manager->persist($category5);

        $manager->flush();

        $this->addReference('category-1', $category1);
        $this->addReference('category-2', $category2);
        $this->addReference('category-3', $category3);
        $this->addReference('category-4', $category4);
        $this->addReference('category-5', $category5);
    }

    /**
     * {inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}