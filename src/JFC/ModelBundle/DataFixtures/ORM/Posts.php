<?php
// src/JFC/ModelBundle/DataFixtures/ORM/Posts.php

namespace JFC\ModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JFC\ModelBundle\Entity\Post;
use JFC\ModelBundle\Entity\Reply;

/**
 * Fixtures for Post Entity
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post1 = new Post();
        $post1->setCategory($this->getReference('category-1'));
        $post1->addReply($this->getReference('reply-1'));
        $post1->addReply($this->getReference('reply-2'));
        $post1->addReply($this->getReference('reply-3'));
        $post1->setTitle('Lorem Ipsum 1');
        $post1->setAuthor('Foo1');
        $post1->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas lobortis nisi non sapien elementum,
        id placerat urna pulvinar. Nam ut varius erat. Ut malesuada rhoncus euismod. Nam sed suscipit justo. In bibendum
        eleifend est id ultrices. Phasellus at lectus quis lectus tristique faucibus eu in lacus. Nullam convallis sapien
        sed nulla euismod lacinia. Aliquam scelerisque mi a porta tincidunt. Donec sed porta nibh. Mauris arcu risus,
        tempor ut turpis eget, aliquam vulputate nisi. Aenean quis erat luctus turpis auctor placerat sed quis tortor.
        Aliquam erat volutpat.

Suspendisse potenti. Morbi rutrum dictum nunc, in tincidunt quam porttitor id. Morbi sit amet nisi quis nulla egestas
sodales. Nullam iaculis, sem non pharetra commodo, metus felis tristique tellus, consectetur condimentum augue metus ut
orci. Nunc non purus vel enim bibendum facilisis. Nam porta nisi sed porta feugiat. Morbi vestibulum enim et dapibus molestie.
Nam ac sapien sed libero condimentum placerat a eget nulla. Aenean scelerisque magna tortor, at molestie lorem gravida at.');

        $post2 = new Post();
        $post2->setCategory($this->getReference('category-1'));
        $post2->addReply($this->getReference('reply-2'));
        $post2->addReply($this->getReference('reply-1'));
        $post2->addReply($this->getReference('reply-4'));
        $post2->addReply($this->getReference('reply-5'));
        $post2->addReply($this->getReference('reply-3'));
        $post2->setTitle('Pellentesque ac imperdiet dolor 2');
        $post2->setAuthor('Foo2');
        $post2->setBody('Pellentesque ac imperdiet dolor. Phasellus scelerisque mattis orci a feugiat. Proin vitae libero
        tortor. Vestibulum nec elit ac erat mattis aliquet. Sed pellentesque, justo nec lobortis iaculis, diam massa varius
        ante, in sagittis odio diam nec elit. Maecenas gravida euismod justo, ac pulvinar quam vulputate eget. In hac
        habitasse platea dictumst. Integer id molestie lectus. Etiam vel ante semper, ultricies justo eget, accumsan lacus.
        Vestibulum sed lacinia sapien. Donec iaculis quis turpis sed tristique. Integer a nibh congue, placerat est
        tincidunt, ullamcorper nulla. Donec pharetra pharetra ligula, gravida pellentesque lorem facilisis a. Donec
        sollicitudin fringilla elit, et pharetra mauris laoreet vel.

Sed ut pharetra ante. Phasellus nec blandit dui. Phasellus a lacinia tellus. Donec sagittis elit ante, sit amet elementum
justo condimentum sed. Quisque id sapien justo. Duis vel erat nisl. Donec at tempor arcu. Vivamus congue malesuada augue
vitae iaculis. Cras bibendum, diam tincidunt sagittis scelerisque, nisi quam sagittis leo, eget mollis massa sapien ac
massa. Praesent sagittis suscipit tincidunt. Nullam ultrices diam sit amet sollicitudin molestie. Interdum et malesuada
fames ac ante ipsum primis in faucibus.');


        $post3 = new Post();
        $post3->setCategory($manager->merge($this->getReference('category-1')));
        $post3->addReply($manager->merge($this->getReference('reply-3')));
        $post3->addReply($manager->merge($this->getReference('reply-1')));
        $post3->addReply($manager->merge($this->getReference('reply-5')));
        $post3->addReply($manager->merge($this->getReference('reply-2')));
        $post3->setTitle('Duis in feugiat ligula 3');
        $post3->setAuthor('Foo3');
        $post3->setBody('Nunc euismod quam nulla, et facilisis est consectetur nec. Aenean sed tortor odio. Ut nisl massa,
        condimentum vitae risus nec, aliquam sagittis lorem. Donec dignissim accumsan metus. Vivamus congue a purus eget
        faucibus. Cras elit neque, consectetur ac interdum in, fringilla vitae justo. Suspendisse eget commodo felis.
        Morbi in augue et elit vehicula rhoncus. Aliquam gravida dapibus sollicitudin. Sed varius porttitor sapien, sit
        amet posuere erat egestas nec. Cras fermentum tortor in nisi varius aliquam. Maecenas ac elit lectus. Duis in
        feugiat ligula. Donec congue mollis libero, ut sollicitudin nisi aliquam non.');


        $post4 = new Post();
        $post4->setCategory($this->getReference('category-4'));
        $post4->addReply($this->getReference('reply-4'));
        $post4->addReply($this->getReference('reply-1'));
        $post4->addReply($this->getReference('reply-2'));
        $post4->addReply($this->getReference('reply-3'));
        $post4->setTitle('Duis facilisis ipsum sed odio pharetra 4');
        $post4->setAuthor('Foo3');
        $post4->setBody('Duis facilisis ipsum sed odio pharetra, vitae congue odio tincidunt. Mauris eget vulputate lacus,
        nec varius odio. In egestas scelerisque ullamcorper. Mauris pretium enim ac pellentesque sagittis. Cras fringilla
        iaculis sodales. Pellentesque at vehicula elit. Curabitur laoreet rutrum purus eget luctus. Fusce aliquet nunc augue,
        vitae dignissim lacus sodales ac. Donec a est et libero tempor mattis. In sed eleifend magna. Proin vel malesuada justo.
        Donec ac diam felis. In eget metus vitae tellus aliquam tristique vitae a mi. Vestibulum pretium laoreet venenatis.');


        $post5 = new Post();
        $post5->setCategory($this->getReference('category-5'));
        $post5->addReply($this->getReference('reply-5'));
        $post5->addReply($this->getReference('reply-1'));
        $post5->setTitle('Nunc at sem ut tellus porta porttitor 5');
        $post5->setAuthor('Foo3');
        $post5->setBody('Nunc at sem ut tellus porta porttitor non sit amet sapien. Aenean consequat diam non ipsum malesuada,
        quis lacinia eros varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec convallis diam orci, ut sagittis
        risus cursus ac. Curabitur eleifend elit arcu. Fusce cursus ante id molestie tempor. Proin mollis sodales nulla,
        vitae dignissim nisi malesuada ac. Fusce sit amet pharetra tortor. Ut viverra, nunc euismod consequat sagittis,
        turpis mauris pharetra nunc, eget aliquet metus metus at quam. In dignissim facilisis urna, vitae tincidunt mauris
        scelerisque aliquam. Nulla nec nibh leo. Mauris viverra tincidunt lectus ut accumsan. Duis dictum convallis mattis.
        Ut pellentesque nulla ac diam pulvinar, sit amet semper risus tempor. Vestibulum et nisl ullamcorper, lobortis nibh ut,
        tristique elit. Nunc ac scelerisque mi.');


        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);
        $manager->persist($post5);

        $manager->flush();
    }

    /**
     * {inheritDoc}
     */
    public function getOrder()
    {
        return 40;
    }
}